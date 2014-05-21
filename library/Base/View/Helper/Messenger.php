<?php

/**
 * @category   My
 * @package    Base_View
 * @subpackage Base_View_Helper_Messenger
 */
class Base_View_Helper_Messenger extends Zend_View_Helper_Abstract {

    protected $_messages = null;
    protected $_allMessages = null;
    protected $_suffix = '_message';
    protected $_types = array(
        'msg',
        'error',
        'info',
        'success',
        'warning',
        'trace');
    protected $_options = array('class' => ''); //umieścić tu ewentualnie klasy do dekoracji messangera

    public function messenger($type = null, $message = null) {
        if ($type) {
            $this->addMessage($type, $message);
        }
        return $this;
    }

    public function toArray($includeCurrent = false, $type = '') {
        if ($includeCurrent) {
            $all = $this->getAllMessages();
        } else {
            $all = $this->getMessages();
        }
        $result = array();
        foreach ($all as $t => $messages) {
            if ($type AND $type != $t) {
                continue;
            }
            foreach ($messages as $m) {
                $result[] = array('type' => $t, 'message' => $m);
            }
        }
        return $result;
    }

    public function getMessages() {
        if ($this->_messages !== null) {
            return $this->_messages;
        }
        $result = array();
        $fm = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        foreach ($this->_types as $type) {
            $fm->setNamespace($type . $this->_suffix);
            $messages = array();
            if ($fm->hasMessages()) {
                $messages = $fm->getMessages();
            }
            if (!count($messages)) {
                continue;
            }
            $result[$type] = $messages;
        }
        $this->_messages = $result;
        return $result;
    }

    public function getAllMessages() {
        if ($this->_allMessages !== null) {
            return $this->_allMessages;
        }
        $result = $this->getMessages();
        $fm = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        foreach ($this->_types as $type) {
            $fm->setNamespace($type . $this->_suffix);

            if ($fm->hasCurrentMessages()) {
                $messages = $fm->getCurrentMessages();
                if (!isset($result[$type])) {
                    $result[$type] = $messages;
                } else {
                    $result[$type] = array_merge($result[$type], $messages);
                }
                $fm->clearCurrentMessages();
            }
        }
        $this->_allMessages = $result;
        return $result;
    }

    public function __toString() {
        $output = '';
        $messages = $this->getAllMessages();
        foreach ($messages as $type => $messages) {
            $output .= $this->view->htmlList($messages, false, array('class' => $type . ' ' . $this->_options['class'], false));
        }
        return $output;
    }

    /**
     * Dodanie wiadomości
     *
     * @param string|Exception $type typ wiadomości lub obiekt wyjątku
     * @param string $message treść wiadomości
     * @return Base_View_Helper_Message
     */
    public function addMessage($type=null, $message=null) {
        if ($type instanceof Exception) {
            $message = $type;
            $type = 'error';
        }

        if (!in_array($type, $this->_types)) {
            throw new Exception($type . ' jest złym typem wiadomosci, nie zostanie wyswietlony');
        }
        $translate = null;
        if (Zend_Registry::isRegistered('Zend_Translate')) {
            $translate = Zend_Registry::get('Zend_Translate');
        }

        if (!$type && !$message) {
            return $this;
        }
        $ns = $type . $this->_suffix;
        $fm = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        $fm->setNamespace($ns);
        $fm->addMessage($translate->translate("$message"));

        return $this;
    }
    
}