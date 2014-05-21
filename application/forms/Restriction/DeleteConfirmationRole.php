<?php 
class Restriction_DeleteConfirmationRole extends Base_Form_Abstract {
    protected $_idRole = false;

    public function init() {
        $this->setAttrib('id', 'role_confirmation_form');

        $this->addElement('hidden', 'info', array(
            'ignore' => true,
            'label' => 'Are You sure You want to delete selected item?',
        ));

        $role_model = new Role();
        $role_data = $role_model->fetchAll('id not in ('.$this->_idRole.')');
        $options = array();
        if (count($role_data)) {
            foreach ($role_data as $role) {
                $options[$role->id] = $role->description;
            }
        }
        $this->addElement('select','role',array(
            'label' => 'Use this role for replacement:',
            'Multioptions' => $options,
        ));

        $this->submit('submit','Yes');
        $this->cancel('cancel','No');
        
        $this->clear();
    }

    public function setIdRole($value) {
        $this->_idRole = $value;
        return $this;
    }

}