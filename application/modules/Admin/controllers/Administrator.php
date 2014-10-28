<?php

/**
 * 管理员控制器
 */

class AdministratorController extends \Base\AdminController {

    public function indexAction() {
        $this->assign('title', '管理员列表');
        $adminMapper = \mapper\AdminModel::getInstance();
        $administrators = $adminMapper->fetchAll();       
        $groupsMapper = \mapper\AdminGroupModel::getInstance(); 
//        $groups = $groupsMapper->fetchAll();
        $this->assign('administrators', $administrators);
//        $this->assign('groups', $groups);
    }
    
    public function addAction(){
        $request = $this->getRequest();
        if ($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/administrator/');
                return false;
            }
        }
        $groupMapper = \mapper\AdminGroupModel::getInstance();
        $groups = $groupMapper->getGroups();
        $this->assign('groups',$groups);
    }
    
    public function editAction(){
        $request = $this->getRequest();
        $id = $request->get('id',0);
        $adminMapper = \mapper\AdminModel::getInstance();
        $admin = $adminMapper->find($id);
        $this->assign('model', $admin);
        $groupMapper = \mapper\AdminGroupModel::getInstance();
        $groups = $groupMapper->getGroups();
        $this->assign('groups',$groups);
        if ($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/administrator/');
                return false;
            }
        }
       
    }
    public function _save() {
        $request = $this->getRequest();
        $id = $request->get('id','');
        $adminModel = new AdminModel();
        $adminMapper = \mapper\AdminModel::getInstance();
        $admin = $adminMapper->find($id);
        if($admin){
            $adminModel = $admin;
        }
        $form = array(
            'username' => \Fan\Tool::filter($request->get('username')),
            'password' => \Fan\Tool::filter($request->get('password')),
            'groups' => \Fan\Tool::filter($request->get('group')),
            'disabled' => \Fan\Tool::filter($request->get('disabled',0))
        );

        if(empty($form['username'])||empty($form['password'])){
            $this->redirect('/admin/administrator/');
            return false;
        }
        
        $adminModel->setUsername($form['username']);
        $adminModel->setPassword(md5($form['password']));
        $adminModel->setGroups($form['groups']);
        $adminModel->setDisabled($form['disabled']);
        if($id){
            $adminMapper->update($adminModel);
        }else{
            $adminMapper->insert($adminModel);     
        }
        return $adminMapper;
    }
}