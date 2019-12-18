<?php
/**
 * Created by PhpStorm.
 * User: syuser1
 * Date: 2019/12/13
 * Time: 14:27
 */
namespace app\index\controller\user;

class Demo{
    public function index()
    {
        return '多级控制器';
    }

    public function _empty($method)
    {
        return '访问的方法'.$method.'不存在';
    }
}