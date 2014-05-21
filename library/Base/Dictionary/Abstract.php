<?php
/**
 * Base_Dictionary_Abstract
 *
 * @category My
 * @package Base_Dictionary
 * @version $Revision$
 */
abstract class Base_Dictionary_Abstract {
    protected $_dictType;
    protected $_idField;
    /**
     * @var array
     */
    protected $_nameFields = array('entry');
    /**
     * @var string
     */
    protected $_order;
    /**
     * @var Zend_Db_Select
     */
    protected $_select;
    /**
     * @var mixed
     */
    protected $_source;
    /**
     * @var array
     */
    protected $_where;

    /**
     * @return array
     */
    public function getDictionary($hashId = false, $separator = ' ') {
        if ($separator == null) {
            $separator = ' ';
        }

        $dict = array();
        $rawDictionaryEntries = $this->_source->fetchAll($this->_select);
        foreach ($rawDictionaryEntries as $rawDictionaryEntry) {
            $rawDictionaryEntryData = $rawDictionaryEntry->toArray();

            $key = (string) $rawDictionaryEntryData[$this->_idField];

            if (!in_array($this->_idField, $this->_nameFields))
                unset($rawDictionaryEntryData[$this->_idField]);

            $nameFields = array_combine($this->_nameFields, array_keys($this->_nameFields));

            $rawDictionaryEntryData = array_intersect_key($rawDictionaryEntryData, $nameFields);

            if ($hashId) {
                $key = Base_Convert::strToHex($key);
            }

            $dict[$key] = implode($separator, $rawDictionaryEntryData);
        }


        return $dict;
    }
    /**
     * @param mixed Zend_Db_Table|int|string $source
     * @param array $where
     * @param string $order
     * @param string $idField
     * @param array $nameFields
     * @return Base_Dictionary Provides fluent interface
     */
    public function setSource($source, array $where = array('ghost = false'), $order = 'id ASC', $idField = 'id', array $nameFields = array()) {
        if (!$source) {
            throw new Base_Exception('Could not retrieve dictionary');
        }

        if (!is_object($source)) {
            $this->_dictType = $source;
            $this->_source = new DictionaryEntry();
            $this->_idField = $idField == 'value' ? 'value' : 'id_entry';
            $this->_nameFields = array('entry');
        } elseif ($source instanceof Zend_Db_Table) {
            $this->_canUseCache = false;
            $this->_source = $source;
            $this->_idField = $idField;
            if ($nameFields) {
                $this->_nameFields = $nameFields;
            } else {
                $this->_nameFields = array('id');
            }
        } elseif ($source instanceof Zend_Db_Select) {
            return $source;
        } else {
            throw new Base_Exception('Could not retrieve dictionary');
        }

        $this->_where = $where;
        $this->_order = $order;
        $this->_select = $this->_buildDictonarySelect();

        return $this;
    }
}
