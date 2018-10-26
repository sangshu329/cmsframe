<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 15:05
 */

namespace ms\db;


use Ms;
use ms\db\ModelInterface;

class Model implements ModelInterface
{
    public static $pdo;

    public static function tableName()
    {
        // TODO: Implement tableName() method.
        return get_called_class();
    }

    public static function primaryKey()
    {
        // TODO: Implement primaryKey() method.
        return ['id'];
    }

    public static function findOne($condition, $debug = 0)
    {
        // TODO: Implement findOne() method.
        list($where, $params) = static::buildWhere($condition);
        $sql = 'select * from ' . static::tableName() . $where;
        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);
        $debug ? static::lastSql($stmt) : '';

        if ($rs) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                $model = static::arr2Model($row);
                return $model;
            }
        }
        return null;
    }

    public static function findCount($condition)
    {
        list($where, $params) = static::buildWhere($condition);
        $sql = 'select count(1) as count from ' . static::tableName() . $where;
        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);

        if ($rs) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                $model = static::arr2Model($row);
                return $model;
            }
        }
        return null;
    }

    public static function findAll($condition)
    {
        // TODO: Implement findAll() method.
        list($where, $params) = static::buildWhere($condition);
        $sql = 'select * from ' . static::tableName() . $where;
        $stmt = static::getDb()->prepare($sql);
        $rs = $stmt->execute($params);
        $models = [];

        if ($rs) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                if (!empty($row)) {
                    $model = static::arr2Model($row);
                    array_push($models, $model);
                }
            }
        }
        return $models;
    }

    public static function updateAll($condition, $attributes)
    {
        // TODO: Implement updateAll() method.
        $sql = 'update ' . static::tableName();
        $params = [];
        if (!empty($attributes)) {
            $sql .= ' set ';
            $params = array_values($attributes);
            $keys = [];
            foreach ($attributes as $key => $value) {
                array_push($keys, "$key = ? ");
            }
            $sql .= implode(' , ', $keys);
        }
        list($where, $params) = static::buildWhere($condition, $params);
        $sql .=  $where;

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        if ($execResult) {
            $execResult = $stmt->rowCount();
        }
        return $execResult;
    }

    public static function deleteAll($condition)
    {
        // TODO: Implement deleteAll() method.
        list($where, $params) = static::buildWhere($condition);
        $sql = 'delete from ' . static::tableName() . $where;

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        if ($execResult) {
            $execResult = $stmt->rowCount();
        }
        return $execResult;
    }


    public function insert($data = null)
    {
        // TODO: Implement insert() method.
        $sql = ' insert into ' . static::tableName();
        $params = [];
        $keys = [];
        is_null($data) ? $data = $this : '';
        foreach ($data as $key => $value) {
            array_push($keys, $key);
            array_push($params, $value);
        }
        $holders = array_fill(0, count($keys), '?');
        $sql .= ' (' . implode(' , ', $keys) . ') values ( ' . implode(' , ', $holders) . ')';
        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        $primaryKeys = static::primaryKey();
        foreach ($primaryKeys as $name) {
            $lastId = static::getDb()->lastInsertId($name);
            $this->$name = (int)$lastId;
        }
        return $execResult;
    }

    public function update()
    {
        // TODO: Implement updata() method.
        $primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $name) {
            $condition[$name] = isset($this->$name) ? $this->$name : null;
        }

        $attributes = [];
        foreach ($this as $key => $value) {
            if (!in_array($key, $primaryKeys, true)) {
                $attributes[$key] = $value;
            }
        }
        return static::updateAll($condition, $attributes) !== false;
    }

    public  function delete()
    {
        // TODO: Implement delete() method.
        $primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $name) {
            $condition[$name] = isset($this->name) ? $this->$name:null;
        }
        return static::deleteAll($condition) !== false;
    }

    public static function getDb()
    {
        if (empty(static::$pdo)) {

            static::$pdo = Ms::createObject('db')->getDb();
            static::$pdo->exec("set names 'utf-8'");
        }
        return static::$pdo;
    }

    public static function lastSql($stmt)
    {
        var_dump($stmt->debugDumpParams());
    }

    public static function buildWhere($condition, $params = null)
    {
        if (is_null($params)) {
            $params = [];
        }
        $where = ' ';
        if (!empty($condition)) {
            $where .= ' where ';
            $keys = [];
            foreach ($condition as $key => $value) {
                array_push($keys, "$key = ? ");
                array_push($params, $value);
            }
            $where .= implode(' and ', $keys);
        }
        return [$where, $params];
    }

    public static function arr2Model($row)
    {
        $model = new static();
        foreach ($row as $rowKey => $valueValue) {
            $model->$rowKey = $valueValue;
        }
        return $model;
    }


}