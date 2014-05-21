<?php 
class Restriction_EditResource extends Base_Form_Abstract {

    public function init() {

        $this->setAttrib('id', 'resource_edit_form');

        // resource controller
        $this->addElement('text', 'controller', array(
            'label' => 'Resource controller:',
            'readonly' => true,
            'ignore' => true,
        ));

        // resource action
        $this->addElement('text', 'action', array(
            'label' => 'Resource action:',
            'ignore' => true,
            'readonly' => true,
        ));

        $this->submit('save','OK');
    }
}