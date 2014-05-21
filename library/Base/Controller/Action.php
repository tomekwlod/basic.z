<?php
abstract class Base_Controller_Action extends Zend_Controller_Action {
    public function init() {
        // context switching
        $cs = $this->_helper->contextSwitch();
        $cs->initContext();

        // redirect to home page when try to use json context as html
        $action = $this->_request->getActionName();
        if (in_array('json', $cs->getActionContexts($action))
                && !$this->getRequest()->isXmlHttpRequest()
                && count($cs->getActionContexts($action)) == 1) {
            $this->_helper->redirector->setGotoUrl('/index');
        }

        // jesli jest zapytanie ajaxowe to przelaczamy sie na jsona
        if ($this->getRequest()->isXmlHttpRequest()) {
            $cs->initContext('json');
        }  
    }
}