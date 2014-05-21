<?php

class Row_Dictionary extends Base_Db_Table_Row {

    protected $_tableClass = 'Dictionary';
    
    public function delete() {
        $this->ghost = true;
        $this->save();
    }

}