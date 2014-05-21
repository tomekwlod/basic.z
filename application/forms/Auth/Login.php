<?php 
class Auth_Login extends Base_Form_Abstract {

    public function init() {

        $this->setAttrib('id', 'login_form');

        // login
        $this->addElement('text', 'login', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'NotEmpty',
            ),
            'required' => true,
            'label' => 'Login:',
        ));

        // password
        $this->addElement('password', 'password', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                'Alnum',
                'NotEmpty',
            ),
            'required' => true,
            'label' => 'Password:',
        ));

        $this->submit('signin','OK');
    }

}