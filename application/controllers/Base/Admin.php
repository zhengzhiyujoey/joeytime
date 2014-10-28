<?php
namespace Base;
class AdminController extends \Base\ApplicationController{
    
    protected $_layout ='admin';
    
    public function init(){       
        $loginAdmin = $this->getLoginAdmin();
        if(!$loginAdmin){
            $this->redirect('/admin/login/');
            return false;
        }
        parent::init();
        $this->getView()->assign('admin',$loginAdmin);
    }
    
    public function getLoginAdmin(){
        $session = \Yaf\Session::getInstance();
        $login = $session->get('login_admin');

        if (!empty($login) && is_array($login)){
            $adminMapper = \mapper\AdminModel::getInstance();
            return $adminMapper->find($login['adminId']);
        }
        //cookie
    }
    public function setLoginOut() {
        \Yaf\Session::getInstance()->del('login_admin');
    }
}

