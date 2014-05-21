<?php
class Role extends Zend_Db_Table {
    protected $_name = 'role';
    protected $_rowClass = 'Row_Role';

    /**
     * Function return all roles
     *
     * @param integer
     * @return object
     */
    public function getRoles($id = null, $sql = false) {
        return ($id) ?
                (($sql) ? $this->select()->where('id = ?',$id) : $this->fetchRow($this->getDefaultAdapter()->quoteInto('id = ?',$id)))
                :
                (($sql) ? $this->select()->order('id asc') : $this->fetchAll(null,'id asc'));
    }
}