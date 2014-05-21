<?php 
class Restriction_AddGroup extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'group_add_form');

        // group title
        $this->addElement('text', 'title', array(
            'filters' => array('StringTrim'),
            'required' => true,
            'label' => 'Title:',
        ));
        $this->getElement('title')->addValidator(
            'Db_NoRecordExists',
            true,
            array('group','title','messages' => array(
                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => 'Group title already exists. Try another one.'))
        );
        
        // group description
        $this->addElement('textarea', 'description', array(
            'filters' => array('StringTrim'),
            'required' => false,
            'label' => 'Description:',
        ));
        
        $this->submit('save','OK');
    }
}