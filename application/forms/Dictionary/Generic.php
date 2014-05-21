<?php 
class Dictionary_Generic extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'dictionary_generic_form');
        
        $this->addElement('text','code',array(
            'label' => 'Code:',
            'required' => true,
        ));
        
        $this->addElement('text','dictionary_name',array(
            'label' => 'Dictionary name:',
            'required' => true,
        ));

        $this->submit('save','OK');
    }
}