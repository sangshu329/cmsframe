<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 13:49
 */
namespace ms\base;
abstract class Application{
    public $controllerNamespace = 'app\\controllers';

    public function run()
    {
        try{
            return $this->handleRequest();
        }catch (\Exception $e){
            return $e;
        }
    }

    abstract public function handleRequest();
}