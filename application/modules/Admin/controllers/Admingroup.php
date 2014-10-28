<?php

/**
 * 问题管理控制器
 */
class AdmingroupController extends Base\AdminController {

    public function indexAction() {
        $this->assign('title', '管理组列表');
        $mapper = \mapper\AdminGroupModel::getInstance();
        $groups = $mapper->fetchAll();
        $this->assign('groups', $groups);
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $id = $request->get('id',0);
        $adminGroupMapper = \mapper\AdminGroupModel::getInstance();
        $adminGroup = $adminGroupMapper->find($id);
        $this->assign('model', $adminGroup);
        if ($request->isPost()){
            if($this->_save($id)){
                $this->redirect('/admin/admingroup/');
                return false;
            }
        }
    }

    public function addAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/admingroup');
                return false;
            }
        }
    }
    
    public function _save($id = 0){
        $request = $this->getRequest();
        $groupModel = new AdminGroupModel();
        $adminGroupMapper = \mapper\AdminGroupModel::getInstance();
        $group = $adminGroupMapper->find($id);
        if($group){
           $groupModel = $group; 
        }
        $form = array(
            'group_name' => \Fan\Tool::filter($request->get('group_name')),
            'purview' => \Fan\Tool::filter($request->get('purview',''))
        );
        if(empty($form['group_name'])){
            $this->redirect('/admin/admingroup/');
            return false;
        }

        $groupModel->setGroup_name($form['group_name']);
        $groupModel->setPurview($form['purview']);
        if($id){
            $adminGroupMapper->update($groupModel);
        }else{
            $adminGroupMapper->insert($groupModel);
        }
        return $adminGroupMapper;
    }
}