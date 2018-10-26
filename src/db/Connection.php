<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 13:58
 */

namespace ms\db;

class Connection
{
    public $dns;

    public $username;

    public $password;

    public $attributes;

    public function getDb(){
        return new \PDO($this->dns,$this->username,$this->password,$this->attributes);
    }
}