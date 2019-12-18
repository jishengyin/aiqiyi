<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//打印函数
function debug($v) {
    echo "<pre>";
    print_r($v);
    echo "</pre>";
}


function mycheck()
{
    $domain = \think\Config::get('site_domain');
    if($domain){
        return true;
    }else{
        return false;
    }
}