<?php
class AuthController extends Base_Controller_Action {

    /**
     * Checking if there is somebody login
     */
    public function indexAction() {
        $identity = Zend_Auth::getInstance()->getIdentity();
        if (!$identity) $this->_redirect('auth/login');

        $this->view->login = $identity->login;
    }
    
    public function loginAction() {
        if (Zend_Auth::getInstance()->hasIdentity()) $this->_redirect('auth');

        $translate = new Zend_View_Helper_Translate();
        $request = $this->getRequest();
        $form = new Auth_Login();
        $this->view->form = $form;

        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $userModel = new User();
                $data = $form->getValues();
                $auth = Zend_Auth::getInstance();
                $adapter = new Zend_Auth_Adapter_DbTable(
                    $userModel->getAdapter(),
                    'user',
                    'login',
                    'password',
                    'MD5(?) AND ghost = false AND locked = false');
                $adapter
                    ->setIdentity($data['login'])
                    ->setCredential($data['password']);
                
                $result = $auth->authenticate($adapter);

                if ($result->isValid()) {
                    $storage = $auth->getStorage();
                    $storageRow = $adapter->getResultRowObject(null, 'password');
                    $storage->write($storageRow);

                    $user = $userModel->fetchRow($userModel->select()->where('login = ?',$result->getIdentity()));
                    $user->last_ip = $this->getRequest()->getServer('REMOTE_ADDR');
                    $user->last_login_at = date('c');
                    $user->save();

                    $config = Zend_Registry::get('config');

                    $url = ($config['default']['url']['afterlogin']) ? 
                        ($uri = ($request->getControllerName() == 'auth' && $request->getActionName() == 'login')) ? 
                            $request->REQUEST_URI
                            : 
                            $config['default']['url']['afterlogin']
                        : 
                        'auth';
                    $this->_redirect($url);
                } else {
                    switch($result->getCode()) {
                        case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                            $this->view->errorMessage = $translate->translate("Invalid username, password or account is locked. Please try again.");
                            break;
                        case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                            $this->view->errorMessage = $translate->translate("Specified account doesn't exist or account is inactive.");
                            break;
                        default:
                            $this->view->errorMessage = $translate->translate("Error while logging in.");
                            break;
                    }
                }         
            }
        }
    }

    public function oauthAction() {
    	$request = $this->getRequest();
    	
   		switch (($request->getParam('type'))) {
   			case 'Facebook' :
   				$this->FacebookOAuth();
   			break;

   			case 'GooglePlus' :
   				$this->GooglePlusOAuth();
   			break;

   			default:
   				$this->_redirect('auth/login');
    	}
    }
    
	private function FacebookOAuth() {
    	$Config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/Facebook.ini', array('FacebookAPI'));
    	
    	require_once ('FacebookAPI/FacebookAPI.php');
    	
    	$Facebook = new FacebookAPI($Config->toArray());
    	
    	$User = $Facebook->getUser();
		
		if ($User) {
			try {
				$User = $Facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$User = null;
			}
		}
		
		if ($User == null) {
			$this->_redirect(
				$Facebook->getLoginUrl(
					Array(
						'scope' => Array('email', 'publish_stream', 'user_photos')
					)
				)
			);
		} else {
			// tu select z sprawdzeniem czy jest w bazie o podanym fb id user
		}
    }
	
	private function GooglePlusOAuth() {
		$Config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/GooglePlus.ini', array('GooglePlusAPI'));
		
		require_once ('GooglePlusAPI/GooglePlusAPI.php');
		
		$GooglePlus = new Google_Plus($Config->toArray());
		
		$GooglePlusNamespace = Zend_Session_Namespace('GooglePlus');
		
		if ($this->getRequest()->getParam('code')) {
			$GooglePlus->getClient()->authenticate();
			
			$GooglePlusNamespace->AccessToken = $GooglePlus->getClient()->getAccessToken();
			$this->_redirect('/auth/oauth?Type=GooglePlus');
		}
		
		if ($GooglePlusNamespace->AccessToken) $GooglePlus->getClient()->setAccessToken($AccessToken);
		
		if (!$GooglePlus->getClient()->getAccessToken()) $this->_redirect($GooglePlus->getClient()->createAuthUrl());
		
		$User = $GooglePlus->getUser();
		
		// kod od select user itd. ...
	}
	
    public function signupAction() {
        if (Zend_Auth::getInstance()->hasIdentity()) $this->_redirect('auth/login');

        $request = $this->getRequest();
        $config = Zend_Registry::get('config');
        $translate = new Zend_View_Helper_Translate();

        if ($type = $request->getParam('type')) {
            switch (Base_Convert::hexToStr($type)) {
                case 'Self':
                    $form = new Auth_Registration();
                    break;
                case 'Facebook':
                    break;
                case 'GooglePlus':
                	break;
                default:
                    break;
            }
            $this->view->form = $form;
        } else {
            $this->view->choose_type = true;
        }
        
        if ($request->isPost()) {
            if ($form->isValid($_POST)) {
                $data = $form->getValues();
                
                if (Base_Convert::hexToStr($type) == 'Self') {
                    if ($data['password'] != $data['confirmPassword']){
                        $this->view->errorMessage = $translate->translate("Password and confirm password don't match.");
                        return;
                    }

                    $userModel = new User();
                    $row = $userModel->createRow($data);
                    $row->password = md5($data['password']);
                    $row->created_at = date('c');
                    $row->last_ip = $request->getServer('REMOTE_ADDR');
                    $row->save();
                }
                
                $url = ($config['default']['url']['aftersignup']) ? $config['default']['url']['aftersignup'] : '';
                $this->_redirect($url);
            }
        }
    }
    
    public function logoutAction() {
        $config = Zend_Registry::get('config');
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();

        $url = ($config['default']['url']['afterlogout']) ? $config['default']['url']['afterlogout'] : '';
        $this->_redirect($url);
    }
}