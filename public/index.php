<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/24 0024
 * Time: 11:02
 */
define('MS_PATH',dirname(__DIR__));
require __DIR__ .'/../vendor/autoload.php';

require MS_PATH.'/src/Ms.php';
$application = new ms\web\Application();
$application->run();

//$router = $_GET['r'];
//list($controllerName,$actionName) = explode('/',$router);
//$ucController = ucfirst($controllerName);
//$controllerName = 'app\\controllers\\'.$ucController.'Controller';
//$controller = new $controllerName();
//return call_user_func([$controller,'action'.ucfirst($actionName)]);
