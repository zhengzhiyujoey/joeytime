<?php

class IndexController extends \Yaf\Controller_Abstract{
    public function init(){
        
    }
    public function indexAction() {
        
    }
    
    public function channelAction() {
        $sort = $this->getRequest()->getParam('source','');
        $articleMapper = \mapper\ArticleModel::getInstance();
        $article = $articleMapper->getArticleBySort($sort);
        $groups = array();
        foreach ($article as $value) {
            $groups[strtoupper($value['letter'])][] = $value;
        }
        
        $this->getView()->assign('sort',$sort);
        $this->getView()->assign('groups',$groups);
    }
    
    public function detailAction() {
        $sort = $this->getRequest()->getParam('source','');
        $id = $this->getRequest()->getParam('id','');
        $articleMapper = \mapper\ArticleModel::getInstance();
        $article = $articleMapper->find($id);
        $this->getView()->assign('content',$article);
        $this->getView()->assign('sort',$sort);
    }
}

