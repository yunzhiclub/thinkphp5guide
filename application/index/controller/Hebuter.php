<?php
namespace app\index\controller;

class Hebuter
{
    static public function  isSchoolMoreThan100()
    {
        return true;
    }

    public function whatIsYouId()
    {
        return rand(100000,999999);
    }

    static public function get()
    {
        return new Hebuter;
    }
}