<?php

class DictionaryController extends Base_Controller_Action {

    public function indexAction() {
        $config = Zend_Registry::get('config');
        $dictionary_model = new Dictionary();
        $dictionary_select = $dictionary_model->getDictionaries(null,true);

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($dictionary_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
        $this->view->paginator = $paginator;
        $this->view->header = array('dictionary_name','code');
    }

    public function showAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $dictionary_model = new Dictionary();
        $dictionary_data = $dictionary_model->getDictionaries($id);

        $dictionaryEntry_model = new DictionaryEntry();
        $dictionaryEntry_select = $dictionaryEntry_model->getDictionaryEntries($id, true);
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($dictionaryEntry_select));

        if ($this->_request->getParam('page')) {
            $paginator->setCurrentPageNumber($this->_request->getParam('page'));
        }
        $this->view->paginator = $paginator;
        $this->view->paginator_header = array('id_entry','entry','code');

        $this->view->data = $dictionary_data;
        $this->view->header = array('dictionary_name','code');
    }
    
    public function addAction() {
        $request = $this->getRequest();
        $form = new Dictionary_Generic();

        if ($request->isPost()){
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('dictionary');
            }
            if ($form->isValid($request->getPost())) {
                $dictionary_model = new Dictionary();
                $row = $dictionary_model->createRow($form->getValues());
                $row->save();

                $this->view->messenger('success','Dictionary was successfully added.');
                $this->_redirect('dictionary');
            }
        }
        $this->view->form = $form;
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        $form = new Dictionary_Generic();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $dictionary_model = new Dictionary();

                $transaction = $dictionary_model->getDefaultAdapter()->beginTransaction();

                $dictionary_data = $dictionary_model->getDictionaries($id);
                $dictionary_data->setFromArray($form->getValues());
                $dictionary_data->save();

                $transaction->commit();

                $this->view->messenger('success','Dictionary was successfully edited.');
                $this->_redirect('dictionary');
            }
        } else {
            $dictionary_model = new Dictionary();
            $dictionary_data = $dictionary_model->getDictionaries($id)->toArray();  

            $dictionaryEntry_model = new DictionaryEntry();
            $dictionaryEntry_select = $dictionaryEntry_model->getDictionaryEntries($id, true);
            
            $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($dictionaryEntry_select));

            if ($this->_request->getParam('page')) {
                $paginator->setCurrentPageNumber($this->_request->getParam('page'));
            }
            $this->view->paginator = $paginator;
            $this->view->header = array('id_entry','entry','code');

            $form->setDefaults($dictionary_data);

        }
        $this->view->dictionary_id = $hex_id;
        $this->view->form = $form;
    }

    public function deleteAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $dictionary_model = new Dictionary();
        $transaction = $dictionary_model->getDefaultAdapter()->beginTransaction();
        
        $dictionary_row = $dictionary_model->getDictionaries($id);
        $dictionary_row->delete();
        
        $dictionaryEntry_model = new DictionaryEntry();
        $dictionaryEntry_data = $dictionaryEntry_model->getDictionaryEntries($id);
        foreach ($dictionaryEntry_data as $row) {
            $row->delete();
        }
        
        $transaction->commit();

        $this->view->messenger('success','Dictionary and all dictionary entries were successfully deleted.');
        $this->_redirect('dictionary');
    }

    public function undeleteAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $dictionary_model = new Dictionary();
        $transaction = $dictionary_model->getDefaultAdapter()->beginTransaction();
        
        $dictionary_data = $dictionary_model->getDictionaries($id);
        $dictionary_data->ghost = false;
        $dictionary_data->save();
        
        $dictionaryEntry_model = new DictionaryEntry();
        $dictionaryEntry_data = $dictionaryEntry_model->getDictionaryEntries($id);
        foreach ($dictionaryEntry_data as $row) {
            $row->ghost = false;
            $row->save();
        }
        
        $transaction->commit();

        $this->view->messenger('success','Dictionary was successfully undeleted.');
        $this->_redirect('dictionary');
    }
    
    public function entrydeleteAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);
        
        $dictionaryEntry_model = new DictionaryEntry();
        $dictionaryEntry_row = $dictionaryEntry_model->fetchRow('id = '.$id);
        $id_dictionary = $dictionaryEntry_row->id_dictionary;
        $dictionaryEntry_row->delete();

        $this->view->messenger('success','Dictionary entry was deleted.');
        $this->_redirect('dictionary/edit/id/'.Base_Convert::strToHex($id_dictionary));
    }
    
    public function entryaddAction() {
        $request = $this->getRequest();
        $hex_id = $request->getParam('id');
        $id = Base_Convert::hexToStr($hex_id);

        $form = new Dictionary_EntryAdd();
        if ($request->isPost()){
            if ($form->isCancelled($request->getPost())) {
                $this->_redirect('dictionary/edit/id/'.$hex_id);
            }
            if ($form->isValid($request->getPost())) {
                $dictionaryEntry_model = new DictionaryEntry();
                $row = $dictionaryEntry_model->createRow(array_merge($form->getValues(),array('id_dictionary' => $id)));
                $row->save();

                $this->view->messenger('success','Dictionary entry was successfully added.');
                $this->_redirect('dictionary/edit/id/'.$hex_id);
            }
        }
        $this->view->form = $form;
    }

}