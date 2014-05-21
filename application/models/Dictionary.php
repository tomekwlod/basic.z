<?php

class Dictionary extends Zend_Db_Table {
    protected $_name = 'dictionary';
    protected $_rowClass = 'Row_Dictionary';

    protected $_dependentTables = array('DictionaryEntry');

    public function getDictionaries($id = null, $sql = false) {
        return ($id) ? 
            ($sql ? $this->select()->where('id = ?',$id) : $this->fetchRow($this->getDefaultAdapter()->quoteInto('id = ?', $id)))
            : 
            ($sql ? $this->select() : $this->fetchAll(null, array('code')));
    }
}
?>
