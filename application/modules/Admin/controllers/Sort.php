<?php

class SortController extends \Base\AdminController{
    public function init() {
        parent::init();
    }

    public function indexAction(){
        $this->assign('title','管理');
        $sortMapper = \mapper\SortModel::getInstance();
        $list = $sortMapper->fetchAll();
        $this->assign('list', $list);
    }
    
    public function editAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/sort/');
                return false;
            }
        }
    }
    
    public function addAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            if($this->_save()){
                $this->redirect('/admin/sort/');
                return false;
            }
        }
    }

    public function _save(){
        $request = $this->getRequest();
        $id = $request->get('id',0);
                
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->find($id);
        $sortModel = new SortModel();
        if($sort){
            $sortModel = $sort;
        }

        $form = array(
            'name'      => \Fan\Tool::filter($request->get('name')),
            'mappath'   => \Fan\Tool::filter($request->get('mappath')),
            'parentid'   => \Fan\Tool::filter($request->get('parentid',0)),
        );
        if(empty($form['name']) && empty($form['mappath'])&& (int)$id !==0){
            $sortMapper->delete($id);
            return true;
        }elseif(empty($form['name']) || empty ($form['mappath'])){
            $this->redirect('/admin/sort/');
            return false;
        }
        

        $sortModel->setName($form['name']);
        $sortModel->setMappath($form['mappath']);
        if($id){
            $sortMapper->update($sortModel);
        }else{
            $sortMapper->insert($sortModel);
        }

        return $sortModel;
        
    }
}