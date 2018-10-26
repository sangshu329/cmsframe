<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 14:25
 */

namespace ms\cache;


interface CacheInterface
{
    public function buildKey($key);

    public function get($key);

    public function exists($key);

    public function mget($keys);

    public function set($key,$value,$duration=0);

    public function mset($items,$duration = 0);

    public function add($key,$value,$duration = 0);

    public function madd($items,$duration =0);

    public function delete($key);

    public function flush();

}