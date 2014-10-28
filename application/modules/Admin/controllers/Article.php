<?php

class ArticleController extends \Base\AdminController{
    public function init(){
        parent::init();
    }
    
    public function indexAction(){
        $this->assign('title', '文章管理');
        $articleMapper = \mapper\ArticleModel::getInstance();
        $articles = $articleMapper->fetchAll();
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('model', $articles);
        $this->assign('sort', $sort);
        //分页数据
        $this->assign('pager', '');
    }
    
    public function addAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/article/');
                return false;
            }
        }
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('sort', $sort);
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $id = $request->get('id');
        $articleMapper = \mapper\ArticleModel::getInstance();
        $article = $articleMapper->find($id);
        $this->assign('model', $article);
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('sort', $sort);

    }
    
    public function _save(){
        $request = $this->getRequest();
        $session = \Yaf\Session::getInstance();
        $login_info = $session->get('login_admin');
        $adminMapper = \mapper\AdminModel::getInstance();
        $admin = $adminMapper->find($login_info['adminId']);
   
        $form = array(
            'title'  => \Fan\Tool::filter($request->get('title')),
            'sort'  => \Fan\Tool::filter($request->get('sort')),
//            'image'  => \Fan\Tool::filter($request->get('image')),
            'body'  => \Fan\Tool::filter($request->get('body')),
            'letter'  => \Fan\Tool::filter($request->get('letter')),
            'recommended'  => \Fan\Tool::filter($request->get('recommended'),0),
            'author'     =>  $admin->getUsername()
        );

        if(empty($form['title']) || empty($form['body']) || empty($form['letter'])){
            $this->redirect('/admin/article/');
            return false;
        }
  
        $articleMapper = \mapper\ArticleModel::getInstance();
        $articleModel = new ArticleModel();
        $articleModel->setTitle($form['title']);
        $articleModel->setSort_ids($form['sort']);
//        $articleModel->setImage($form['image']);
        $articleModel->setBody($form['body']);
        $articleModel->setLetter($form['letter']);
        $articleModel->setRecommended($form['recommended']);
        $articleModel->setAuthor($form['author']);
        $id = $request->get('id','');

        if($id){
            $articleModel->setId($id);
            $articleModel->setUptime(time());
            $articleMapper->update($articleModel);
        }else{
            $articleModel->setAddtime(time());
            $articleModel->setUptime(time());
            $articleMapper->insert($articleModel);
        }
        return $articleMapper;
    }
}

