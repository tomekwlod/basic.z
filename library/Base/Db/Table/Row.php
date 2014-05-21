<?php

class Base_Db_Table_Row extends Zend_Db_Table_Row {

    protected $_rowActions = array();
    protected $_oldData = array();
    protected $dictMappings = array();

    /**
     * Mapowanie słownikowe wartości
     * Przystosowane do mapowania na wierszu
     *
     * @param string $key
     * @return string
     */
    public function DictMap($key, $old = false) {
        $ret = $this->getDictMapping($key, $old?null:$this);

        $k = $old ? $this->_oldData[$key] : (($this[$key] instanceof Zend_Db_Expr)?$this[$key]->__toString():$this[$key]);
        if (isset($ret[(int) $k])) {
            return $ret[(int) $k];
        }
        return $k;
    }

    /**
     * Pobieranie słownika dla kolumny
     *
     * @param string $key kolumna, dla której tłumaczymy
     * @return string słownik lub null
     */
    public function getDictMapping($key, $row = null) {
        $src_name = isset($this->dictMappings[$key]['source']) ? $this->dictMappings[$key]['source'] : '';
        $dict_name = isset($this->dictMappings[$key]['dictionary']) ? $this->dictMappings[$key]['dictionary'] : '';
        $where = isset($this->dictMappings[$key]['where']) ? $this->dictMappings[$key]['where'] : array('ghost = false');
        $order = isset($this->dictMappings[$key]['order']) ? $this->dictMappings[$key]['order'] : 'id asc';
        $idField = isset($this->dictMappings[$key]['idField']) ? $this->dictMappings[$key]['idField'] : 'id';
        $nameFields = isset($this->dictMappings[$key]['nameFields']) ? $this->dictMappings[$key]['nameFields'] : array();

        if (!is_array($where))
            $where = array($where);

        if ($src_name) {
            $dict_name = new $src_name();
        }
        if (!$dict_name)
            return null;

        if ($row && $src_name) {
            if ($row->$key)
                $where[] = $idField . " = '" . $row->$key . "'";
            else
                return null;
        }

        $dict = new Base_Dictionary();
        return $dict->setSource($dict_name, $where, $order, $idField, $nameFields)->getDictionary();
    }

    public function __set($columnName, $value) {
        $columnName = $this->_transformColumn($columnName);
        if (!array_key_exists($columnName, $this->_data)) {
            require_once 'Zend/Db/Table/Row/Exception.php';
            throw new Zend_Db_Table_Row_Exception("Specified column \"$columnName\" is not in the row");
        }
        if($this->_data[$columnName] !== $value) {
            $this->_oldData[$columnName] = $this->_data[$columnName];
            $this->_data[$columnName] = $value;
            $this->_modifiedFields[$columnName] = true;
        }
    }

    function __call($method, array $args) {
        $prefix = strtolower(substr($method, 0, 3));
        $property = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', substr($method, 3)));

        if (empty($prefix) || empty($property)) {
            return;
        }

        if ($prefix == "get" && array_key_exists($property, $this->_data) && isset($this->$property)) {
            return $this->$property;
        }

        if ($prefix == "set" && array_key_exists($property, $this->_data)) {
            $this->$property = $args[0];
        }
    }
    
    // jeśli w bazie jest pole created_by - uzupełniamy je id-kiem z Zend_auth
    protected function fillCreatedBy() {
        $info = $this->getTable()->info();
        if (isset($info['metadata']['created_by'])) {
            $this->created_by = Zend_Auth::getInstance()->getIdentity()->id;
        }
    }
    
    protected function _insert() {
        parent::_insert();
        $this->fillCreatedBy();
    }

}
