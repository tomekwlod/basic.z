<?php 
class User_Lock extends Base_Form_Abstract {

    public function init() {

        $this->setAttrib('id', 'user_lock_form');

        // user login
        $this->addElement('text', 'login', array(
            'ignore' => true,
            'readonly' => true,
            'label' => 'User login:',
        ));

        // lock reason
        $this->addElement('textarea', 'locked_reason', array(
            'filters' => array('StringTrim'),
            'label' => 'Lock reason:',
        ));

        $this->submit('save','OK');
    }
}