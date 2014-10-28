<?php

class OutsentenceController extends \Base\AdminController{
    public function init(){
        parent::init();
    }
    
    public function indexAction(){
        $this->assign('title', '短语栏目页生成');

    }
        
    public function outAction() {

    }
}

