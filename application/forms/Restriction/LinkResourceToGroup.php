<?php 
class Restriction_LinkResourceToGroup extends Base_Form_Abstract {
    public function init() {
        $this->setAttrib('id', 'linkresourcetogroup_form');

        $resource_model = new Resource();
        $resource_data = $resource_model->fetchAll('ghost = false','controller asc');
        $options = array();
        if (count($resource_data)) {
            foreach ($resource_data as $row) {
                $options[$row->id] = $row->controller.'-'.$row->action;
            }
        }
        $this->addElement('multiselect','id_resource',array(
            'required' => true,
            'MultiOptions' => $options,
            'size' => 25
        ));
        
        $this->submit('save','Link');
        $this->cancel();
    }
}