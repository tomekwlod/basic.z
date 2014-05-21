<?php
class TeamController extends Base_Controller_Action {
    public $contexts = array(
        'add' => array('html'),
    );
    
    public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array()) {
//        $this->_config = Zend_Registry::get('config');
//        $this->_acl = new Base_Acl();
//        $this->_role = (Zend_Auth::getInstance()->hasIdentity()) ? Zend_Auth::getInstance()->getIdentity()->role : $this->_config['user']['guest'];
//        
        parent::__construct($request, $response, $invokeArgs);
    }

    public function indexAction() {
		$auth = Zend_Auth::getInstance()->getIdentity();

		$team_model = new Team();
		$team_select = $team_model
			->select()
			->from(array('t' => 'team'),array('title','sex','created_at','discipline','id','picture'))
			->where('created_by = '.$auth->id)
			->order('created_at DESC');
		$team_data = $team_model->fetchAll($team_select);

		$this->view->data = $team_data;
    }
    
    public function addAction() {
        $request = $this->getRequest();
        
        $form = new Team_Add();
        
        if ($request->isPost()) {
			if ($form->isCancelled($request->getPost())) {
				$this->_redirect('team'); 
			}
            if ($form->isValid($request->getPost())) {
                try {
                    $team_model = new Team();
                    $row = $team_model->createRow($form->getValues());
                    $id = $row->save();
                
                    $this->view->messenger('success','Team was successfully added.');
                    /**
                     * @todo:  przekierowanie do utworzonego teamu! 
                     */
					$this->_redirect('team/show/id/'.Base_Convert::strToHex($id)); 
                } catch (Exception $e) {
                    /**
                     *@todo: zapisać do logów! 
                     */
                    $this->view->messenger('success',"We\'re sorry, but something was wrong. Please try to add this team later. We're working now to resolve this problem.");
                    $this->_redirect('team'); 
                }
            }
        }
        $this->view->form = $form;
    }
	
	public function showAction() {
		$reguest = $this->getRequest();
		
		if ($id = $reguest->getParam('id')) {
			$team_model = new Team();
			$team_select = $team_model
				->select()
				->setIntegrityCheck(false)
				->from(array('t' => 'team'))
				->joinLeft(array('d' => 'discipline'), 'd.id = t.discipline',array('discipline' => 'title'))
				->joinLeft(array('dg' => 'discipline_group'), 'dg.id = d.id_discipline_group',array('discipline_group' => 'description'))
				->where('t.id = ?',Base_Convert::hexToStr($id),'INTEGER');
			$team_row = $team_model->fetchRow($team_select);
			$this->view->data = $team_row;
		}
	}

}