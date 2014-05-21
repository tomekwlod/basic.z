<?php 
class User_Edit extends Base_Form_Abstract {

    public function init() {

        $this->setAttrib('id', 'user_edit_form');

        // user login
        $this->addElement('text', 'login', array(
            'ignore' => true,
            'readonly' => true,
            'label' => 'User login:',
        ));

        // user first_name
        $this->addElement('text', 'first_name', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                'Alpha',
                array(
                    'StringLength',
                    false,
                    array(4, 30)),
            ),
            'label' => 'User first name:',
        ));
        
        // user surname
        $this->addElement('text', 'surname', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                'Alpha',
                array(
                    'StringLength',
                    false,
                    array(4, 30)),
            ),
            'label' => 'User surname:',
        ));
        
        // user email
        $this->addElement('text', 'email', array(
            'filters' => array('StringTrim','StripTags'),
            'validators' => array(
                'Alpha',
                array(
                    'StringLength',
                    false,
                    array(6, 50)),
            ),
            'label' => 'User email:',
        ));
        $this->getElement('email')->setValidators(array(new Zend_Validate_EmailAddress));

        // user note
        $this->addElement('textarea', 'note', array(
            'filters'    => array('StringTrim'),
            'label'      => 'Note about user:',
        ));

        // role
        $role_model = new Role();
        $role_data = $role_model->getRoles();
        foreach ($role_data as $role) {
            $options[$role->id] = $role->description;
        }
        $this->addElement('select','role',array(
            'multioptions' => $options,
            'label' => 'User role:',
        ));

        $this->submit('save','OK');
    }
}