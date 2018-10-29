<?php
/**
 * Created by PhpStorm.
 * User: 201709290001
 * Date: 2018/10/24 0024
 * Time: 11:22
 */
namespace app\Controllers;

use app\models\User;

class SiteController extends \ms\web\Controller {
    public function actionTest()
    {
        $rs = User::findCount(['age' => 20,'id'=>1]);
        echo $this->toJson($rs);

//        $user =new User();
//        $user->name = 'xiaoming';
//        $user->age = '11';
//        var_dump(User::updateAll(['id'=>4],['age'=>'11']));

    }

    public function actionView()
    {
//        $this->render('site/view',['body'=>'test view']);
        $this->render('site/view', ['body' => 'Test body information', 'users' => [1, 2,3]]);
    }

    public function actionCache()
    {
        $cache = \Ms::createObject('predis');
        $cache->set('test','测试数据');
        var_dump($cache->get('test'));
    }
}