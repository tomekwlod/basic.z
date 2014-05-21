<?php
class Restriction_EditRole extends Base_Form_Abstract {

    public function init() {
        $this->setAttrib('id', 'role_edit_form');

        // role name
        $this->addElement('text', 'name', array(
            'label' => 'Role name:',
            'readonly' => true,
            'ignore' => true,
        ));

        // role description
        $this->addElement('textarea', 'description', array(
            'filters' => array('StringTrim'),
            'required' => true,
            'label' => 'Description:',
        ));

        // resources
        $group_model = new Group();
        $group_data = $group_model->fetchAll();
//        diee($group_data->toArray());
//        $r = null;
        foreach ($group_data as $row) {
            $this->addElement('checkbox', 'group_'.$row['id'], array(
                'required' => false,
                'label' => $row['title'],
            ));
            $this->getElement('group_'.$row['id'])->addDecorators(array(
                'ViewHelper',
                'Errors',
                array('Label', array('tag' => 'div', 'style' => '')),
                array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'row role_edit')))
            );
        }
        
        $this->submit();
        $this->cancel();
    }
}