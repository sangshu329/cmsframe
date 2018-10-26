<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 13:48
 */
return [
    'class' => '\ms\db\Connection',
    'dns'=>'mysql:host=localhost;dbname=sf',
    'username'=>'root',
    'password'=>'root',
    'options'=>[
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STRINGIFY_FETCHES=>false
    ],
];