<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 13:55
 */

class Ms
{
    public static function createObject($name)
    {
        $config = require(MS_PATH . "/config/$name.php");
        $instance = new $config['class']();
        unset($config['class']);
        foreach ($config as $key => $value) {
            $instance->$key = $value;
        }
        if ($instance instanceof \ms\base\Component) {
            $instance->init();
        }
        return $instance;
    }
}