<?php

class IndexController extends Base_Controller_Action {
    
    public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()) {
        $this->_config = Zend_Registry::get('config');
//        $this->_acl = new Base_Acl();
//        $this->_role = (Zend_Auth::getInstance()->hasIdentity()) ? Zend_Auth::getInstance()->getIdentity()->role : $this->_config['user']['guest'];
        
        parent::__construct($request, $response, $invokeArgs);
    }

    public function indexAction() {
//        if ($this->_acl->isAllowed(($this->_role), '.index_panel1')) {
//            debug('są uprawnienia dla .jakis_zasob');
//        } else {
//            debug('brak uprawnien');
//        }
		$identity = Zend_Auth::getInstance()->getIdentity();
        if (!$identity) $this->_redirect("/".$this->_config['default']['url']['notauth']);
		$this->_redirect("/".$this->_config['default']['url']['isauth']);
        
    }

}