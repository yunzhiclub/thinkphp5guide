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

    public function delete()
    {
        // 接收ID，并转换为int类型
        $id = input('get.id/d');

        // 直接删除相关关键字记录
        if ($count = Teacher::destroy($id))
        {
            $message = '成功删除' . $count . '条数据';
        } else {
            $message = '删除失败';
        }
        
        // 进行跳转
        return $this->success($message, url('index'));
    }

    public function edit()
    {
        // 获取传入ID
        $id = input('get.id/d');

        // 在Teacher表模型中获取当前记录
        if (false === $teacher = Teacher::get($id))
        {
            return '系统未找到ID为' . $id . '的记录';
        } 
        
        // 将数据传给V层
        $this->assign('teacher', $teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }
    
    public function update()
    {
        // 接收数据
        $teacher = input('post.');

        // 将数据存入Teacher表
        $Teacher = new Teacher();
        $message = '更新成功';

        // 依据状态定制提示信息
        try
        {
            if (false === $Teacher->validate(true)->isUpdate()->save($teacher))
            {
                $message = '更新失败：' . $Teacher->getError();
            }
        } catch (\Exception $e)
        {
            $message = '更新失败:' . $e->getMessage();
        }

        return $message;
    }
}