<?php
class AdminController extends Base_Controller_Action {

    public function indexAction() {
        $stats = array();
        
        $user_model = new User();
        $stats['Users count'] = $user_model->fetchAll('ghost = false and locked = false')->count();
        $stats['Today logins'] = $user_model->fetchAll('ghost = false and locked = false and date(last_login_at) = date(now())')->count();
		
        $team_model = new Team();
        $stats['Active teams'] = $team_model->fetchAll('ghost = false and locked = false')->count();
        
        $group_model = new Group();
        $stats['Groups count'] = $group_model->fetchAll()->count();
        
        $this->view->data = $stats;
    }
}