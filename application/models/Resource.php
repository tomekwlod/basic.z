<?php
class Resource extends Zend_Db_Table {
    protected $_name = 'resource';
    protected $_rowClass = 'Row_Resource';

    /**
     * Function return all resources
     *
     * @param integer $id
     * @return object
     */
    public function getResources($id = null, $sql = false) {
        return (($id) ?
                (($sql) ? $this->select()->where('ghost = false and id = ?',$id) : $this->fetchRow($this->getDefaultAdapter()->quoteInto('ghost = false and id = ?',$id)))
                :
                (($sql) ? $this->select()->where('ghost = false')->order('controller asc') : $this->fetchAll('ghost = false', 'controller asc')));
    }

    public function isResourceExist($controller, $action) {
        $row = $this->fetchRow(array(
            'ghost = false',
            $this->getDefaultAdapter()->quoteInto('controller = ?', $controller),
            $this->getDefaultAdapter()->quoteInto('action = ?', $action),
        ));

        return ($row) ? true : false;
    }
}