<?php 
class Restriction_AddResource extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'resource_add_form');

        // resource controller
        $this->addElement('text', 'controller', array(
            'label' => 'Resource controller:',
//            'required' => true,
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'Alpha',
                array(
                    'StringLength',
                    false,
                    array(3, 20)),
            ),
        ));

        // resource action
        $this->addElement('text', 'action', array(
            'label' => 'Resource action:',
            'required' => true,
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array(
                    'StringLength',
                    false,
                    array(1, 20)),
            ),
        ));
        
        $this->submit('save','OK');
    }
}