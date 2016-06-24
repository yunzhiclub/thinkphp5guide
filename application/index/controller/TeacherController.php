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

    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }

    public function insert()
    {
        // 接收传入数据
        $teacher = input('post.');
        $teacher['create_time'] = time();   // 加入时间戳

        // 引用Teacher模型
        $Teacher = new Teacher();

        // 加入验证信息
        $result = $Teacher->validate(true)->data($teacher)->save();

        // 反馈结果
        if (false === $result)
        {
            return '新增失败:' . $Teacher->getError();
        } else {
            return $teacher['name'] . '新增成功';
        }
    }
}