<?php

class DictionaryEntry extends Zend_Db_Table {

    protected $_name = 'dictionary_entry';
    protected $dictionaryNameFields = array('entry');
    protected $_rowClass = 'Row_DictionaryEntry';

    protected $_referenceMap = array(
		'Dictionary' => array(
		    'columns' => array('id_dictionary'),
			'refTableClass' => 'Dictionary',
			'refColumns' => 'id'
		)
    );
    
    public function getDictionaryEntries($id, $sql = false) {
        return 
            $sql ? 
                $this->select()->where('id_dictionary = ?',$id,'INTEGER') 
                : 
                $this->fetchAll($this->getDefaultAdapter()->quoteInto('id_dictionary = ?', $id, 'INTEGER'));
    }
}