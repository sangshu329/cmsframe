<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 15:37
 */

namespace app\models;

use ms\db\Model;

class User extends Model
{
    public static function tableName()
    {
        return 'user';
    }
}