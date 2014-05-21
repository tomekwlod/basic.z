<?php 
class Auth_Registration extends Base_Form_Abstract {

    public function init() {
        
        $this->setAttrib('id', 'registration_form');

        $this->addElement('text','first_name',array(
            'required' => true,
            'label' => 'First name:'
        ));

        $this->addElement('text','surname',array(
            'required' => true,
            'label' => 'Surname:'
        ));

        $this->email();
        $this->phone();

        $this->addElement('text', 'login', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'Alpha',
                array(
                    'StringLength', 
                    false, 
                    array(5, 20)
                )),
            'required' => true,
            'label' => 'Login:',
        ));
        $this->getElement('login')->addValidator(
            'Db_NoRecordExists',
            true,
            array('user','login','messages' => array(
                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => 'Login already exists. Try another one.'))
        );

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'label'      => 'Password:',
        ));

        $this->addElement('password', 'confirmPassword', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'label'      => 'Confirm password:',
        ));

        $this->submit('register','Sign up');
    }
}