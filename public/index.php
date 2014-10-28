<?php

define('DS', DIRECTORY_SEPARATOR);
define('APPICATION_PATH', realpath(dirname(__FILE__) . DS . '..' . DS));
$application = new \Yaf\Application(APPICATION_PATH.DS."conf".DS."application.ini");

$application->Bootstrap()->run();
