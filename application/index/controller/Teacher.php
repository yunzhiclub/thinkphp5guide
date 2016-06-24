<?php
namespace app\index\controller;
use app\model\Teacher as SmallTeacher;  // 教师模型 带有别名
/**
 * 教师管理
 */
class Teacher
{
    public function index()
    {
        $SmallTeacher = new SmallTeacher;
        dump($SmallTeacher);
    }
}