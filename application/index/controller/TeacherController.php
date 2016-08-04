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
        // try {
        //     $pageSize = 5; // 每次显示5条数据
        //     $Teacher = new Teacher; 

        //     // 调用分页
        //     $teachers = $Teacher->paginate($pageSize);

        //     // 向V层传数据
        //     $this->assign('teachers', $teachers);

        //     // 取回打包后的数据
        //     $htmls = $this->fetch();

        //     // 将数据返回给用户
        //     return $htmls;
        // } catch (\Exception $e) {
        //     return '系统错误' . $e->getMessage();
        // }
        $Teacher = new Teacher;
        $teachers = $Teacher->select();
        $teacher = $teachers[1];
        echo $teacher->getData('name');
        return $teacher->getData('name');
        var_dump($teacher->getdata('name'));
        
    }

    public function add()
    {
        try {
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }

    public function insert()
    {
        $message    = '';   // 反馈消息
        $error      = '';   // 反馈错误信息
        
        try
        {
            // 实例化空模型，写入数据。
            $teacher            = new Teacher;
            $teacher->name      = input('post.name');
            $teacher->username  = input('post.username');
            $teacher->sex       = input('post.sex');
            $teacher->email     = input('post.email');

            // 加入验证信息
            if (false === $teacher->validate(true)->save())
            {
                $error = '新增失败:' . $teacher->getError();
            } else {
                $message = $teacher->name . '新增成功';
            }
        } catch (\Exception $e) {
            $error = '系统错误:' . $e->getMessage();
        }

        // 判断是否发生错误，返回不同信息。
        if ($error === '')
        {
            return $this->success($message, url('index'));
        } else {
            return $this->error($error);
        }
    }

    public function delete()
    {
        $message    = '';   // 反馈消息
        $error      = '';   // 反馈错误信息

        try {
            // 接收ID，并转换为int类型
            $id = input('get.id/d');

            // 直接删除相关关键字记录
            if ($count = Teacher::destroy($id))
            {
                $message = '成功删除' . $count . '条数据';
            } else {
                $error = '删除失败';
            }
        } catch (\Exception $e) {
            $error = '系统错误' . $e->getMessage();
        }

        // 进行跳转
        if ($error === '')
        {
            return $this->success($message, url('index'));
        } else {
            return $this->error($error);
        }
    }

    public function edit()
    {
        try {
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
        } catch (\Exception $e)
        {
            return '系统错误:' . $e->message();
        }
    }
    
    public function update()
    {
        $message    = '';   // 反馈消息
        $error      = '';   // 反馈错误信息

        try
        {
            // 接收数据，取要更新的关键字信息
            $id = input('post.id');

            // 获取当前对象
            $teacher = Teacher::get($id);

            // 写入要更新的数据
            $teacher->name = input('post.name');
            $teacher->username = input('post.username');
            $teacher->sex = input('post.sex');
            $teacher->email = input('post.email');

            // 更新
            $message = '更新成功';
            if (false === $teacher->validate(true)->save())
            {
                $error =  '更新失败' . $teacher->getError();
            }

        } catch (\Exception $e)
        {
            $error = '系统错误:' . $e->getMessage();
        }
        
        // 进行跳转
        if ($error === '')
        {
            return $this->success($message, url('index'));
        } else {
            return $this->error($error);
        }
    }
}