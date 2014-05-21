<?php
/**
 * 
 */
class Base_Acl extends Zend_Acl {
    
    public function __construct() {
        $this->_setResources();
        $this->_setRoles();
        $this->_setPermissions();
    }

    protected function _setResources() {
        $resource_model = new Resource();
        $resource_data = $resource_model->fetchAll('ghost = false');

        if (count($resource_data)) {
            foreach ($resource_data as $resource) {
                $controller = $resource->controller;
                $action = (!$resource->action || $resource->action == '*') ? (null) : ('.'.$resource->action);

                if (!$action) {
                    $resource_model2 = new Resource();
                    $resource_data2 = $resource_model2->fetchAll("controller = '".$controller."' and action != '*' and ghost = false");
                    foreach ($resource_data2 as $resource2) {
                         if (!$this->has($resource2->controller.'.'.$resource2->action)) {
                            $this->addResource(new Zend_Acl_Resource($resource2->controller.'.'.$resource2->action));
                        }
                    }
                }

                if (!$this->has($resource->controller.'.'.$resource->action) && ($action))
                    $this->addResource(new Zend_Acl_Resource($controller.$action));
            }
        }
    }

    protected function _setRoles() {
        $role_model = new Role();
        $role_data = $role_model->fetchAll('ghost = false');

        if (count($role_data)) {
            foreach($role_data as $role) {
                $this->addRole(new Zend_Acl_Role($role->id));
            }
        }
    }

    protected function _setPermissions() {
        $roleGroup_model = new RoleGroup();
        $roleGroup_select = $roleGroup_model
            ->select()
            ->setIntegrityCheck(false)
            ->from(array('rr' => 'role_group'), array('rr.id_role'))
            ->joinLeft(array('gr' => 'group_resource'), 'rr.id_group = gr.id_group',array())
            ->joinLeft(array('r' => 'resource'), 'r.id = gr.id_resource',array('controller', 'action'));

        $roleGroup_data = $roleGroup_model->fetchAll($roleGroup_select);
        if(count($roleGroup_data)) {
            foreach($roleGroup_data as $roleResource) {
                $controller = $roleResource->controller;
                $action = (!$roleResource->action || $roleResource->action == '*') ? (null) : ('.'.$roleResource->action);

                /*
                 * Jeśli jest dostęp do wszystkich akcji kontrolera to dajemy do nich uprawnienia nawet jeśli nie ma
                 *    ich w tabeli role_resource
                 */
                if (!$action) {
                    $resource_model = new Resource();
                    $resource_data = $resource_model->fetchAll("controller = '".$controller."' and action != '*' and ghost = false");
                    foreach ($resource_data as $resource) {
                        if (!$this->isAllowed($roleResource->id_role,$resource->controller.'.'.$resource->action)) {
                            $this->allow($roleResource->id_role,$resource->controller.'.'.$resource->action);
                        }
                    }
                }

                if ($action) {
                    if (!$this->isAllowed($roleResource->id_role, $controller.$action)) {
                        $this->allow($roleResource->id_role, $controller.$action);
                    }
                }
            }
        }
    }
}