<?php 
class Dictionary_EntryAdd extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'dictionary_entry_add_form');
        
        $this->addElement('text','id_entry',array(
            'label' => 'Id entry:',
            'validators' => array(
                'int',
            ),
            'required' => true,
        ));
        
        $this->addElement('text','entry',array(
            'label' => 'Dictionary entry:',
            'required' => true,
        ));

        $this->submit('save','OK');
        $this->cancel();
    }
}