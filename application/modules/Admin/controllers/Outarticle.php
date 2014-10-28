<?php

class OutarticleController extends \Base\AdminController{
    
    public function indexAction(){
        $this->assign('title', '日志栏目页生成');
        $sortMapper = \mapper\SortModel::getInstance();
        $sort = $sortMapper->fetchAll();
        $this->assign('sort', $sort);
    }
    
    public function outAction(){
        
    }
}
