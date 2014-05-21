<?php
date_default_timezone_set('Europe/Warsaw');
require_once ('Base/Utils.inc');

require_once ('Zend/Session.php');
Zend_Session::start();

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Init registry global vars
     */
    public function _initRegistry() {
        $config = $this->getApplication()->getOptions();
        Zend_Registry::set('config', $config);
    }

    /**
     * Autoloading classes without namespaces
     */
    public function _initAutoloader() {
        Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
    }

    /**
     * Init Navigation
     */
    protected function navigation() {
        $config = Zend_Registry::get('config');
        
        $this->_acl = new Base_Acl();
        $this->_role = (Zend_Auth::getInstance()->hasIdentity()) ? Zend_Auth::getInstance()->getIdentity()->role : $config['user']['guest'];

        $this->bootstrap('view');
        $view = $this->getResource('view');

        $nav = new Zend_Config_Ini(APPLICATION_PATH . '/configs/navigation.ini', array('navigation'));
        $navigation = new Zend_Navigation($nav);

        $view->navigation($navigation)
            ->setAcl($this->_acl)
            ->setRole($this->_role);
    }

    public function run() {
        $this->navigation();

        parent::run();
        debug(
"\n -Przyciski ujednolicić. hM i sort.\n -Przyciski zrobić na Row-ach. \n ");
    }
}