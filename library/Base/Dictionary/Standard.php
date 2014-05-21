<?php
class Base_Dictionary_Standard extends Base_Dictionary_Abstract {
    /**
     * @return Zend_Db_Select
     */
    protected function _buildDictonarySelect() {
        $select = $this->_source
            ->select()
            ->from($this->_source, array_merge($this->_nameFields, array($this->_idField)))
            ->order($this->_order);

        if ($this->_where) {
            foreach ($this->_where as $w) {
                $select->where($w);
            }
        }

        if ($this->_source instanceof DictionaryEntry) {
            if (is_integer($this->_dictType)) {
                $select->where('id_dictionary = \'' . (int) $this->_dictType . '\'');
            } else {
                $select->where($this->_source->getAdapter()->quoteInto('id_dictionary = (SELECT id FROM dictionary WHERE code = ? LIMIT 1)', $this->_dictType));
            }
        }

        return $select;
    }
}
