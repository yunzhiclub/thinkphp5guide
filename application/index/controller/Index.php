<?php
namespace app\index\controller;
use think\Db;   // 引用数据库操作类

class Index
{
    public function index()
    {
        var_dump(Db::name('teacher')->find());//获取数据表中第一条数据
    }
}
