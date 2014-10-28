<?php

class LogoutController extends \Base\AdminController{
    
    public function indexAction() {
        $this->setLoginOut();
        $this->redirect('/admin/login/');
        return false;
    }
}

