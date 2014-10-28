<?php

class SentenceController extends \Base\AdminController{
    
    public function indexAction() {
        $this->assign('title', '心情短语');
        $sentenceMapper = \mapper\SentenceModel::getInstance();
        $sentence = $sentenceMapper->fetchAll();
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('model', $sentence);
        $this->assign('sort', $sort);
    }
    
    public function addAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/sentence');
                return false;
            }
        }
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchALl();
        $this->assign('sort', $sort);
    }
    
    public function editAction(){
        $id = $this->getRequest()->get('id','');
        $sentenceMapper = \mapper\SentenceModel::getInstance();
        $sentence = $sentenceMapper->find($id);
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('model', $sentence);
        $this->assign('sort', $sort);
        
    }
    
    public function _save(){
        $request = $this->getRequest();
        $session = \Yaf\Session::getInstance();
        $login_info = $session->get('login_admin');
        $adminMapper = \mapper\AdminModel::getInstance();
        $admin = $adminMapper->find($login_info['adminId']);
        $form = array(
            'sort' => \Fan\Tool::filter($request->get('sort')),
            'body' => \Fan\Tool::filter($request->get('body',null)),
            'letter' => \Fan\Tool::filter($request->get('letter',null)),
            'author'     =>  $admin->getUsername(),
            'recommended' => \Fan\Tool::filter($request->get('recommended',0))
        );
        
        if($form['body']===null){
            $this->redirect('/admin/sentence/add/');
            return false;
        }
        $sentenceModel = new SentenceModel();
        $sentenceModel->setBody($form['body']);
        $sentenceModel->setLetter($form['letter']);
        $sentenceModel->setSort_ids($form['sort']);
        $sentenceModel->setAuthor($form['author']);
        $sentenceModel->setRecommended($form['recommended']);
        
        $sentenceMapper = \mapper\SentenceModel::getInstance();
        $id = $request->get('id','');
        if($id){
            $sentenceModel->setId($id);
            $sentenceModel->setUptime(time());
            $sentenceMapper->update($sentenceModel);
        }else{
            $sentenceModel->setUptime(time());
            $sentenceModel->setAddtime(time());
            $sentenceMapper->insert($sentenceModel);
        }
        return $sentenceMapper;
        
    }
} 
 

