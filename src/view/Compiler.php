<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/26 0026
 * Time: 17:25
 */

namespace ms\view;


class Compiler
{
    protected $compilers = [
        'Statements',
        'Echos'
    ];

    protected $echoCompilers = [
        'RawEchos',
        'EscapedEchos'
    ];

    protected function compileEchos($content){
        foreach ($this->echoCompilers as $type) {
            $content = $this->{"compile{$type}"}($content);
        }
        return $content;
    }

    protected function compileEscapedEchos($content){

    }

}