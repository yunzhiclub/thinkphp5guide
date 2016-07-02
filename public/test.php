<?php
class Test
{
    public function test()
    {
        // 只要是我们学校的学生，回答学校是否建校100年，答案都是一个。
        var_dump(Hebuter::isSchoolMoreThan100()); 

        $Hebuter = new Hebuter;
        $xiaohong = $Hebuter::get('xiaohong'); // 小红
        $xiaoming = $Hebuter::get('xiaoming'); // 小明
        
        // 小红和小明回答自己的身份证号码，答案不一致
        var_dump($xiaohong->whatIsYouId());
        var_dump($xiaoming->whatIsYouId());
    }
}


class Hebuter
{
    private $name;  // 姓名

    // 设置姓名
    public function setName($name)
    {
        $this->name = $name;
    }

    // 学校是否有百年历史
    static public function isSchoolMoreThan100()
    {
        return true;
    }

    // 获取ID信息
    public function whatIsYouId()
    {
        if ($this->name === 'xiaohong')
        {
            return '1234567';
        }

        if ($this->name === 'xiaoming')
        {
            return '7654321';
        }

        return '88888888';
    }

    // 根据名字获取Hebuter对象
    static public function get($name)
    {
        $Hebuter = new Hebuter;
        $Hebuter->setName($name);
        return $Hebuter;
    }
}

// 以下是测试代码
$Test = new Test;   // 实例化
$Test->test();      // 调用对象中的方法
