<?php
namespace Base;
/* 
 * 控制器基类
 */
class ApplicationController extends \Yaf\Controller_abstract{
    
    public function init(){
        $this->initView();
    }
    
    public function getConfig(){
        return \Yaf\Application::app()->getConfig();
    }
    public function initView(array $options = NULL) {
        $view = $this->getView();
        $prePath = $this->getConfig()->get('application.directory');
        $view->setLayoutPath($prePath."/views/layouts/");
        $view->setLayout($this->_layout);
    }
    
    public function assign($name,$value) {
        return $this->getView()->assign($name,$value);
    }
}

