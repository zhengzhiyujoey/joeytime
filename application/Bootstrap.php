<?php

class Bootstrap extends \Yaf\Bootstrap_Abstract {
    
    protected $config = null;
        
    public function _initConfig() {
        $this->config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set("config",$this->config);
    }
    
    //连接数据库
    public function _initMysql() {        
        $conf = $this->config->get('resources.database');
        if (!$conf)
            return false;

        $adapter = new \Zend\Db\Adapter\Adapter($conf->toArray());
        \Yaf\Registry::set('adapter', $adapter);
    }
    
    public function _initRoute(\Yaf\Dispatcher $dispatcher){
        $router = $dispatcher->getRouter();
        $config = new \Yaf\Config\Ini($this->config->get('config.route'));
        if ($config->routes) {
            $router->addConfig($config->routes);
        }

        $modules = new \Fan\Route();
        $route = $dispatcher::getInstance()->getRouter();
        $route->addRoute('module',$modules);
    }
    
    public function _initLayout(\Yaf\Dispatcher $dispatcher){
        $layout = new \Fan\Layout($this->config->get('application.layouts.directory'));
        $dispatcher->setView($layout);
        \Yaf\Registry::set('layout',$layout);
        
    }

     /**
     * 检测当前的访问网址是否是以/结尾
     * 如果从最后个/到结尾处的字符不包含".",则自动跳转到到补齐/的地址
     */
    protected function _checkIsNoEndBySlash(\Yaf\Dispatcher $dispatcher) {
        $request = $dispatcher->getRequest();
        $currentUrl = $request->getRequestUri();
        $urlArray = parse_url($currentUrl);
        //排除合法的地址
        if ($urlArray['path'][strlen($urlArray['path']) - 1] === '/') {
            return;
        }
        //排除首页
        if (strrpos($urlArray['path'], '/') === false) {
            return;
        }
        //排除xxx/1.htm, xxx/2.xml这样的地址
        $last = substr($urlArray['path'], strrpos($urlArray['path'], '/') + 1);
        if (strpos($last, '.') !== false) {
            return;
        }

        $newUrl = '';
        $urlArray['path'] = $urlArray['path'] . '/';
        foreach ($urlArray as $k => $v) {
            switch ($k) {
                case 'scheme':
                    $newUrl .= $v . '://';
                    break;
                case 'host':
                case 'path':
                    $newUrl .= $v;
                    break;
                case 'query':
                    $newUrl .= '?' . $v;
                    break;
                default:
                    break;
            }
        }

        Fan\Tool::redirect($newUrl, 301);
    }

}

