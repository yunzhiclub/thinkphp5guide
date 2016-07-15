<?php
namespace app\index\controller;
use think\Db;   // 引用数据库操作类

class IndexController
{
    public function index()
    {
        var_dump(Db::name('teacher')->find());//获取数据表中第一条数据
        dump(Db::name('teacher')->find());
        $teachers = DB::name('teacher')->select();
        var_dump($teachers);
        dump($teachers);
        echo $teachers[0]['name'];
    }
}
