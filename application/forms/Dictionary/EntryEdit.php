<?php 
class Dictionary_EntryEdit extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'dictionary_entry_edit_form');
        
        $this->addElement('text','code',array(
            'label' => 'Code:',
        ));
        
        $this->addElement('text','dictionary_name',array(
            'label' => 'Dictionary name:',
        ));

        $this->submit('save','OK');
    }
}