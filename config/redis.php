<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 15:11
 */
return [
    'class'=>'ms\cache\RedisCache',
    'redis'=>[
        'host'=>'localhost',
        'port'=>6379,
        'database'=>0,
        'password'=>'foobared',
        // 'options' => [Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP],
    ]
];