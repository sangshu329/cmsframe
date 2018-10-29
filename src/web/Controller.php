<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 14:13
 */

namespace ms\web;

use ms\view\Compiler;

class Controller extends \ms\base\Controller
{
    public function render($view,$params=[]){

        (new Compiler())->compile($view, $params);
    }

    public function toJson($data)
    {
        if(is_string($data)){
            return $data;
        }
        return json_encode($data);
    }
}