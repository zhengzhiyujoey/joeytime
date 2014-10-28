<?php
class LoginController extends \Yaf\Controller_Abstract{
    
    public function indexAction() {
        if ($this->getRequest()->isPost()){
            $request = $this->getRequest();
            $username = trim($request->get('username',''));
            $pwd = trim($request->get('password',''));
            try {
                $adminModel = $this->_login($username,$pwd);     
            } catch (Exception $exc) {
                $adminModel = null;
                $errorMsg = $exc->getMessage();
                $this->getView()->assign('errormessage',$errorMsg);
            }
            //放入session中
            if ($adminModel){
                $this->setLoginAdmin($adminModel);
                $this->redirect('/admin/');
                return false;
            }
        }

    }
    
    public function _login($username,$password){
        if(empty($username)){
            throw new \Exception('用户名为空');
        }elseif(empty ($password)){
            throw new \Exception('密码为空');
        }
        $adminMapper = new mapper\AdminModel();
        $adminObj = $adminMapper->findByUsername($username);
        if ($adminObj instanceof AdminModel){
            if($adminObj->getPassword() !== md5($password)){
                throw new \Exception('密码错误');
            }
            return $adminObj;
        }elseif (empty ($adminObj)) {
            throw new \Exception('用户名错误');
        }
        
        return $adminObj;
    }
    public function setLoginAdmin($adminModel) {
        //session 用户id ip 时间 cookie
        $session = \Yaf\Session::getInstance();
        $clientIp = \Fan\Tool::getClientIp();
        $data = array(
            'adminId'   => $adminModel->getId(),
            'loginTime' => time(),
            'loginIp'   => $clientIp
        );
        
        $session->set('login_admin',$data);
        $expire = 86400;
        $adminSession = serialize($adminModel->toArray()) ."_".time()."_".  mt_rand(10000, 999999);
        setcookie('admin_cookie', $adminSession, time()+$expire, '/', null,false,true);
    }
    
}
