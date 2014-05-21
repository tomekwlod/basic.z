<?php
/**
 * @var: $acl
 * 
 * @author: johny
 */
class Base_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        try {
            $acl = new Base_Acl();

            $controller = $request->getControllerName();
            $action = $request->getActionName();

            $config = Zend_Registry::get('config');
            $role = (Zend_Auth::getInstance()->hasIdentity()) ? Zend_Auth::getInstance()->getIdentity()->role : $config['user']['guest'];

            if ($acl->has($controller)) {
                $resource = $controller;
            } elseif ($acl->has($controller.'.'.$action)) {
                $resource = $controller.'.'.$action;
            } else {
                $resource = null;
            }
            if ($resource === null) { /** @todo: obsługa błędu braku zasobu */
                throw new Zend_Acl_Exception();
            }
            if (!$acl->isAllowed($role, $resource)) {
                $request
//                    ->setModuleName('auth')
                    ->setControllerName('auth')
                    ->setActionName('login');
//                    ->setParam('error_handler', 'login'); //parametry
            }
        } catch (Exception $e) {
//            diee($e->getMessage());
//            $request->setModuleName('default');
            $request->setControllerName('error');
            $request->setActionName('error');

            // Set up the error handler
            $error = new Zend_Controller_Plugin_ErrorHandler();
            $error->type = Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER;
            $error->request = clone($request);
            $error->exception = $e;
            $request->setParam('error_handler', $error);
        }
    }
}