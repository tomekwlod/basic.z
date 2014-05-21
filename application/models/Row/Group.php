<?php
class Row_Group extends Base_Db_Table_Row {
    protected $_rowActions = array(
        array(
            'label' => 'test',
            'controller' => 'user',
            'action' => 'index',
            'resource' => 'user.index',
            'params' => array('id' => null),
//            'class' => 'show_new'
        )
    );
}