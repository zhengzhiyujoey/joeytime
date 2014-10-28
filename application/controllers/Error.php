<?php

/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时被调用
 * @link http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author joey
 */
class ErrorController extends \Yaf\Controller_Abstract {

    //从2.1开始, errorAction支持直接通过参数获取异常
    /**
     *
     * @param \Yaf\Exception $exception   Yaf定义的异常类
     * @return boolean
     */
    public function errorAction($exception) {
        switch ($exception->getCode()) {
            case YAF\ERR\NOTFOUND\MODULE:
            case YAF\ERR\NOTFOUND\CONTROLLER:
            case YAF\ERR\NOTFOUND\ACTION:
            case YAF\ERR\NOTFOUND\VIEW:
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            default :
                header('HTTP/1.1 500');
                break;
        }
        if($exception->getCode() == 555){
            $this->initView();
            $this->layout = 'admin';
            $this->getView()->assign('errorMessage', $exception->getMessage());
        }else{
            echo '<h1> Error No.: ', $exception->getCode(), '</h1>';
            echo '<h2>Message:</h2>';
            echo '<div>', $exception->getMessage(), '</div>';
            echo '<h2>File:</h2>';
            echo '<div>', $exception->getFile(), '</div>';
            echo '<h2>Line:</h2>';
            echo '<div>', $exception->getLine(), '</div>';
            echo '<h2>Trace:</h2>';
            echo '<pre>', $exception->getTraceAsString(), '</pre>';
        }
    }
}
