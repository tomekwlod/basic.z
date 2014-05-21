<?php

class UserController extends Base_Controller_Action {

    public function indexAction() {
        $config = Zend_Registry::get('config');
        $user_model = new User();
        $user_select = $user_model->getUsers(null,true);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($user_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
        $this->view->paginator = $paginator;
        $this->view->header = array('login','first_name','surname','created_at','email','role');
    }

    public function showAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $user_model = new User();
        $user_data = $user_model->getUsers($id);

        $this->view->data = $user_data;
        $this->view->header = array('login','created_at','first_name','surname','email','ghost','ghost_at','locked','locked_at','locked_reason','last_ip','last_login_at','sex','role','note');
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new User_Edit();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $user_model = new User();

                $transaction = $user_model->getDefaultAdapter()->beginTransaction();

                $user_data = $user_model->getUsers($id);
                $user_data->setFromArray($form->getValues());
                $user_data->save();

                $transaction->commit();

                $this->view->messenger('success','Contact was successfully edited.');
                $this->_redirect('user');
            }
        } else {
            $user_model = new User();
            $user_data = $user_model->getUsers($id)->toArray();

            $form->setDefaults($user_data);

        }
        $this->view->form = $form;
    }

    public function lockAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new User_Lock();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $user_model = new User();

                $transaction = $user_model->getDefaultAdapter()->beginTransaction();

                $user_data = $user_model->getUsers($id);
                $user_data->setFromArray($form->getValues());
                $user_data->locked_at = date('c');
                $user_data->locked = true;
                $user_data->save();

                $transaction->commit();
                
                $this->view->messenger('success','Contact was successfully locked.');
                $this->_redirect('user');
            }
        } else {
            $user_model = new User();
            $user_data = $user_model->getUsers($id)->toArray();

            $form->setDefaults($user_data);

        }
        $this->view->form = $form;
    }

    public function unlockAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $user_model = new User();

        $transaction = $user_model->getDefaultAdapter()->beginTransaction();

        $user_data = $user_model->getUsers($id);
        $user_data->locked = false;
        $user_data->save();

        $transaction->commit();
        
        $this->view->messenger('success','Contact was successfully unlocked.');
        $this->_redirect('/user');
    }

    public function deleteAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $user_model = new User();

        $transaction = $user_model->getDefaultAdapter()->beginTransaction();

        $user_data = $user_model->getUsers($id);
        $user_data->ghost = true;
        $user_data->ghost_at = date('c');
        $user_data->save();

        $transaction->commit();

        $this->view->messenger('success','Contact was successfully deleted.');
        $this->_redirect('user');
    }

    public function undeleteAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $user_model = new User();

        $transaction = $user_model->getDefaultAdapter()->beginTransaction();

        $user_data = $user_model->getUsers($id);
        $user_data->ghost = false;
        $user_data->save();

        $transaction->commit();

        $this->view->messenger('success','Contact was successfully undeleted.');
        $this->_redirect('user');
    }

}