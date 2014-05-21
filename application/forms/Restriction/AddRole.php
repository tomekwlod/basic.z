<?php 
class Restriction_AddRole extends Base_Form_Abstract {

    public function init() {

        $this->setAttrib('id', 'role_add_form');

        // role name
        $this->addElement('text', 'name', array(
            'label' => 'Role name:',
            'required' => true,
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
//                'Alpha',
                array(
                    'StringLength',
                    false,
                    array(4, 20)),
            ),
        ));
        $this->getElement('name')->addValidator(
            'Db_NoRecordExists',
            true,
            array('role','name','messages' => array(
                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => 'Role already exists. Try another one.'))
        );

        // role description
        $this->addElement('textarea', 'description', array(
            'filters' => array('StringTrim'),
            'required' => false,
            'label' => 'Description:',
        ));

        //  signin button
        $this->submit('save','OK');
        $this->cancel();
    }
}