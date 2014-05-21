<?php

class RestrictionController extends Base_Controller_Action {

    public function indexAction() {
    }
    
    public function linkresourcegroupAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Restriction_LinkResourceToGroup();

        if ($request->isPost()) {
            $formValues = $request->getPost();
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('restriction/group');
            }
            if ($form->isValid($formValues)) {
                $translate = new Zend_View_Helper_Translate();
                
                $groupResource_model = new GroupResource();
                foreach ($formValues['id_resource'] as $id_resource) {
                    $row = $groupResource_model->fetchRow(array('id_resource = '.$id_resource,'id_group = '.$id));
                    if (!$row) {
                        $groupResource_model->createRow(array('id_resource' => $id_resource,'id_group' => $id))
                            ->save();
                    }
                }
                
                $this->view->messenger('success',$translate->translate('Link added successfully'));
                $this->_redirect('restriction/group');
            }
        } else {
            $groupResource_model = new GroupResource();
            $groupResource_data = $groupResource_model->fetchAll('id_group = '.$id);
            
            $defaults = array();
            foreach ($groupResource_data as $row) {
                $defaults[] = $row->id_resource;
            }
            $form->setDefaults(array('id_resource' => $defaults));
        }
        $this->view->form = $form;
    }
    
    public function groupAction() {
        $group_model = new Group();
        $group_select = $group_model->select()->order('title asc');

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($group_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
        $this->view->paginator = $paginator;
        $this->view->header = array('title','description');
    }
    
    public function addgroupAction() {
        $request = $this->getRequest();
        $form = new Restriction_AddGroup();

        if ($request->isPost()) {
            $formValues = $request->getPost();
            if ($form->isValid($formValues)) {
                $translate = new Zend_View_Helper_Translate();
                
                $group_model = new Group();
                $row = $group_model->createRow($form->getValues());
                $row->save();

                $this->view->messenger('success',$translate->translate('Group added successfully'));
                $this->_redirect('restriction/group');
            }
        }
        $this->view->form = $form;
    }
    
    public function editgroupAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Restriction_EditGroup();

        if ($request->isPost()) {
            $formValues = $request->getPost();
            if ($form->isValid($formValues)) {
                $translate = new Zend_View_Helper_Translate();
                
                $group_model = new Group();
                $row = $group_model->fetchRow('id = '.$id);
                $row->setFromArray($form->getValues());
                $row->save();

                $this->view->messenger('success',$translate->translate('Group edited successfully'));
                $this->_redirect('restriction/group');
            }
        } else {
            $group_model = new Group();
            $row = $group_model->fetchRow('id = '.$id);
            $form->setDefaults($row->toArray());
        }
        $this->view->form = $form;
    }
    
    public function deletegroupAction() {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            if ($request->getParam('yes')) {
                $hex_id = $request->getParam('id');
                $id = Base_Convert::hexToStr($hex_id);
                
                Zend_Db_Table::getDefaultAdapter()->beginTransaction();

                    $roleGroup_model = new RoleGroup();
                    $roleGroup_data = $roleGroup_model->fetchAll('id_group = '.$id);
                    foreach ($roleGroup_data as $row) {
                        $row->delete();
                    }
                    
                    $groupResource_model = new GroupResource();
                    $groupResource_data = $groupResource_model->fetchAll('id_group = '.$id);
                    foreach ($groupResource_data as $row) {
                        $row->delete();
                    }
                    
                    $group_model = new Group();
                    $group_row = $group_model->fetchRow('id = '.$id);
                    $group_row->delete();
                
                Zend_Db_Table::getDefaultAdapter()->commit();
                
                $this->view->messenger('success','Group was successfully deleted.');
            } 
            $this->_redirect('restriction/group');
        } else {
            $form = new Common_Confirmation();
            $this->view->form = $form;
        }
    }
    
    public function resourceAction() {
        $resource_model = new Resource();
        $resource_select = $resource_model->getResources(null,true);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($resource_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
//        $paginator->setDefaultItemCountPerPage(555);
        $this->view->paginator = $paginator;
        $this->view->header = array('controller','action');
    }

    public function editresourceAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Restriction_EditResource();

        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $resource_model = new Resource();
                $resource_data = $resource_model->getResources($id);
                $resource_data->setFromArray($form->getValues());
                $resource_data->save();

                $this->view->messenger('success','Resource was successfully edited.');
                $this->_redirect('restriction/resource');
            }
        } else {
            // role
            $resource_model = new Resource();
            $resource_data = $resource_model->getResources($id)->toArray();

            $form->setDefaults($resource_data);

        }
        $this->view->form = $form;
    }

    public function addresourceAction() {
        $request = $this->getRequest();
        $form = new Restriction_AddResource();

        if ($request->isPost()) {
            $formValues = $request->getPost();
            if ($form->isValid($formValues)) {
                $resource_model = new Resource();
                $is_exist = $resource_model->isResourceExist($formValues['controller'], $formValues['action']);

                $translate = new Zend_View_Helper_Translate();
                if ($is_exist) {
                    $form->getElement('action')->addError(sprintf($translate->translate('Resource %1$s already exist'), $formValues['controller'].'.'.$formValues['action']));
                } else {
                    $resource_model = new Resource();
                    $row = $resource_model->createRow($form->getValues());
                    $row->save();

                    $this->view->messenger('success',sprintf($translate->translate('Resource %1$s added successfully'), $formValues['controller'].'.'.$formValues['action']));
                    $this->_redirect('restriction/resource');
                }
            }
        }
        $this->view->form = $form;
    }
    
    public function deleteresourceAction() {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            if ($request->getParam('yes')) {
                $hex_id = $request->getParam('id');
                $id = Base_Convert::hexToStr($hex_id);
                
                Zend_Db_Table::getDefaultAdapter()->beginTransaction();

                    // delete resource
                    $resource_model = new Resource();
                    $resource_data = $resource_model->fetchRow('id = '.$id);
                    $resource_data->delete();

                    // delete all privileges
                    $groupResource_model = new GroupResource();
                    $groupResource_data = $groupResource_model->fetchAll('id_resource = '.$id);
                    foreach ($groupResource_data as $row) {
                        $row->delete();
                    }

                Zend_Db_Table::getDefaultAdapter()->commit();
            }

            $this->view->messenger('success','Resource was successfully deleted.');
            $this->_redirect('restriction/resource');
        } else {
            $form = new Common_Confirmation();
            $this->view->form = $form;
        }
    }

    public function roleAction() {
        $role_model = new Role();
        $role_select = $role_model->getRoles(null,true);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($role_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
        $this->view->paginator = $paginator;
        $this->view->header = array('name','description');
    }

    public function showroleAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $role_model = new Role();
        $role_data = $role_model->getRoles($id);

        $this->view->data = $role_data;
        $this->view->header = array('name','description','ghost');
    }

    public function editroleAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Restriction_EditRole();

        if ($request->isPost()) {
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('restriction/role');
            }
            if ($form->isValid($request->getPost())) {
                $roleGroup_model = new RoleGroup();
                $role_model = new Role();

                Zend_Db_Table::getDefaultAdapter()->beginTransaction();
                
                $roleGroup_data = $roleGroup_model->fetchAll('id_role = '.$id);
                foreach ($roleGroup_data as $row) {
                    $row->delete();
                }

                $formValues = $form->getValues();
                $new_row = array();
                foreach ($formValues as $key => $value) {
                    if (strpos($key,'group_') !== false && $value == 1) {
                        $res = str_replace('group_', '', $key);
                        $new_row['id_role'] = $id;
                        $new_row['id_group'] = $res;
                        $row = $roleGroup_model->createRow($new_row);
                        $row->save();
                    } elseif ($form->getElement($key)->getType() != 'Zend_Form_Element_Checkbox') {
                        $row = $role_model->fetchRow('id = '.$id);
                        $row->$key = $value;
                        $row->save();
                    }
                }
                
                Zend_Db_Table::getDefaultAdapter()->commit();

                $this->view->messenger('success','Role was successfully edited.');
                $this->_redirect('restriction/role');
            }
        } else {
            $role_model = new Role();
            $role_data = $role_model->getRoles($id)->toArray();

            $roleGroup_model = new RoleGroup();
            $roleGroup_data = $roleGroup_model->fetchAll('id_role = '.$id)->toArray();
            foreach ($roleGroup_data as $row) {
                $form->getElement('group_'.$row['id_group'])->setAttrib('checked', true);
            }
            $form->setDefaults($role_data);

        }
        $this->view->form = $form;
    }

    public function addroleAction() {
        $request = $this->getRequest();
        $form = new Restriction_AddRole();

        if($request->isPost()){
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('restriction/role');
            }
            if ($form->isValid($request->getPost())) {
                $role_model = new Role();
                $row = $role_model->createRow($form->getValues());
                $row->save();

                $this->view->messenger('success','Role was successfully added.');
                $this->_redirect('restriction/role');
            }
        }
        $this->view->form = $form;
    }

    public function deleteroleAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Restriction_DeleteConfirmationRole(array('idRole' => $id));

        if ($request->isPost()) {
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('restriction/role');
            }
            if ($form->isValid($request->getPost())) {
                $role_model = new Role();
                $roleResource_model = new RoleResource();
                $user_model = new User();
                
                $transaction = $role_model->getDefaultAdapter()->beginTransaction();
                
                // delete role
                $role_data = $role_model->getRoles($id);
                $role_data->delete();
                
                // delete all privileges
                $roleResource_data = $roleResource_model->fetchAll('id_role = '.$id);
                if (count($roleResource_data)) {
                    foreach ($roleResource_data as $row) {
                        $row->delete();
                    }
                }

                // changing roles for users
                $user_data = $user_model->getUsersByRole($id);
                if (count($user_data)) {
                    foreach ($user_data as $row) {
                        $row->setFromArray($form->getValues());
                        $row->save();
                    }
                }

                $this->view->messenger('success','Role was successfully deleted.');
                $transaction->commit();
            }
            $this->_redirect('restriction/role');
        } else {

            $label = "Role and all privileges will be removed. Users with this role will get selected role!";
            $form->getElement('info')
                    ->setLabel($form->getElement('info')->getLabel().' '.$label)
                    ->setIgnore(true);
            $this->view->form = $form;
        }
    }

}