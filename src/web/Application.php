<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 13:54
 */
namespace ms\web;
class Application extends \ms\base\Application{
    public function handleRequest()
    {
        // TODO: Implement handleRequest() method.
        $router = $_GET['r'];
        list($controllerName,$actionName) = explode('/',$router);
        $ucController = ucfirst($controllerName);
        $controllerNameall = $this->controllerNamespace .'\\'.$ucController.'Controller';
        $controller = new $controllerNameall();
        $controller->id=$controllerName;
        $controller->action=$actionName;
        return call_user_func([$controller,'action'.ucfirst($actionName)]);
    }

}