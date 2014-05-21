<?php
class Restriction_EditGroup extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'group_edit_form');

        // role name
        $this->addElement('text', 'title', array(
            'label' => 'Group name:',
        ));

        // role description
        $this->addElement('textarea', 'description', array(
            'filters' => array('StringTrim'),
            'required' => true,
            'label' => 'Description:',
        ));
        
        $this->submit();
        $this->cancel();
    }
}