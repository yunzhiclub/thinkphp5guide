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
        try {
            $Teacher = new Teacher; 
            $teachers = $Teacher->select();

            // 向V层传数据
            $this->assign('teachers', $teachers);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;
        } catch (\Exception $e) {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下代码的注释去掉。
            // throw $e;
            return '系统错误' . $e->getMessage();
        }
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
                $message =  '更新失败' . $teacher->getError();
            }

        } catch (\Exception $e)
        {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下的代码的注释去掉
            // throw $e;
            $message = $e->getMessage();
        }
       
        return $message;
    }
}