<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/25 0025
 * Time: 14:13
 */

namespace ms\web;


class Controller extends \ms\base\Controller
{
    public function render($view,$params=[]){

        $file = MS_PATH.'/views/'.$view.'.ms';
        $fileContent = file_get_contents($file);
        $result ='';
        foreach (token_get_all($fileContent) as $token) {
            if(is_array($token)){
                list($id,$content) = $token;
                if($id==T_INLINE_HTML){
                    $content = preg_replace('/{{(.*)}}/','<?php echo $1?>',$content);
                }
                $result .=$content;
            }else{
                $result .=$token;
            }
        }
        $generatedFile = MS_PATH.'/runtime/cache/'.md5($file);
        file_put_contents($generatedFile,$result);
        extract($params);
        require $generatedFile;
    }

    public function toJson($data)
    {
        if(is_string($data)){
            return $data;
        }
        return json_encode($data);
    }
}