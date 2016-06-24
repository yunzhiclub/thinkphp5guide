<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\model\Teacher;  // 教师模型
/**
 * 教师管理, 继承think\Controller后，就可以利用V层对数据进行打包了。
 */
class TeacherController extends Controller
{
    public function index()
    {
        $Teacher = new Teacher; 
        $teachers = $Teacher->select();

        // 向V层传数据
        $this->assign('teachers', $teachers);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function insert()
    {
        // 新建测试数据
        $teacher = array(); // 这种写法也可以 $teacher = [];
        $teacher['name'] = '王五';
        $teacher['username'] = 'wangwu';
        $teacher['sex'] = '1';
        $teacher['email'] = 'wangwu@yunzhi.club';
        var_dump($teacher);

        // 引用teacher数据表对应的模型
        $Teacher = new Teacher();
        var_dump($Teacher);

        // 向teacher表中插入数据并判断是否插入成功
        $state = $Teacher->data($teacher)->save();
        var_dump($state);
    }
}