<?php
/**
 * Created by PhpStorm.
 * User: syuser1
 * Date: 2019/12/13
 * Time: 14:31
 */

namespace app\index\controller;

class  Error{
    public function test()
    {
            return 'Error';
    }

    public function _empty($method)
    {
        return '访问的方法'.$method.'不存在';
    }
}