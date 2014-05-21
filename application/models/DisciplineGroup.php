<?php

class DisciplineGroup extends Zend_Db_Table {
    protected $_name = 'discipline_group';
    protected $_rowClass = 'Row_DisciplineGroup';

    const TeamDiscipline = 1;
    const SingleDiscipline = 2;
}
?>
