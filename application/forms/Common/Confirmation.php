<?php 
class Common_Confirmation extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'common_confirmation_form');

        $this->addElement('hidden', 'info', array(
            'ignore' => true,
            'label' => 'Are You sure You want to delete selected item?',
        ));

        $this->submit('yes','Yes');
        $this->cancel();
    }

}