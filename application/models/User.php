<?php
class User extends Zend_Db_Table {
    protected $_name = 'user';
    protected $_rowClass = 'Row_User';

    /**
     * Function return user(s)
     *
     * @param integer $id
     * @return object 
     */
    public function getUsers($id = null, $sql = false) {
        return ($id) ? 
            ($sql ? $this->select()->where('id = ?',$id) : $this->fetchRow($this->getDefaultAdapter()->quoteInto('id = ?', $id)))
            : 
            ($sql ? $this->select() : $this->fetchAll(null, array('login asc','first_name asc','surname asc')));
    }

    public function getUsersByRole($id_role) {
        return $this->fetchAll('role = '.$id_role, array('login asc','first_name asc','surname asc'));
    }

}