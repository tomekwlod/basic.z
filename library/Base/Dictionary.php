<?php

class Base_Dictionary {

    protected $_handler;
    /**
     * @var string
     */
    public static $mode;
    /**
     * Konstruktor z wyborem adaptera
     * 
     * @param mixed $backendApplicationId
     */
    public function __construct() {
        $this->_handler = new Base_Dictionary_Standard();
    }
    /**
     * Proxy do setSource handlera
     *
     * @param mixed Zend_Db_Table|int|string $source
     * @param array $where
     * @param string $order
     * @param string $idField
     * @param array $nameFields
     * @throws Base_Exception
     * @return Base_Dictionary Provides fluent interface
     */
    public function setSource($source, array $where = array('ghost = false'), $order = 'id ASC', $idField = 'id', array $nameFields = array()) {
        $this->_handler->setSource($source, $where, $order, $idField, $nameFields);
        return $this;
    }
    public function getDictionary($hashId = false, $separator = ' ') {
        return $this->_handler->getDictionary($hashId, $separator);
    }
}
