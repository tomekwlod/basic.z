<?php
class Row_User extends Base_Db_Table_Row {
    protected $_tableClass = 'User';
    
//    public $headerMappings = array(
//        'role' => array('title' => 'Rola', 'sort' => true),
//    );
    protected $dictMappings = array(
        'role' => array('source'=>'Role', 'nameFields'=>array('description')),
        'ghost' => array('dictionary' => 'ghost'),
        'locked' => array('dictionary' => 'locked'),
        'sex' => array('dictionary' => 'sex'),
    );

    public function getFullName() {
        return ucfirst($this->first_name).' '.ucfirst($this->surname);
    }
}