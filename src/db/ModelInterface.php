<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 14:52
 */

namespace ms\db;


interface ModelInterface
{
    public static function tableName();

    public static function primaryKey();

    public static function findOne($condition);

    public static function findCount($condition);

    public static function findAll($condition);

    public static function updateAll($condition, $attributes);

    public static function deleteAll($condition);

    public function insert($data);

    public  function update();

    public  function delete();
}