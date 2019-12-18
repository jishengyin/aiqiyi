<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//think\Route::rule('login','admins/Account/login','GET|POST',['ext'=>'html|shtml']);
think\Route::rule('myjump','http://www.baidu.com');
think\Route::rule('demo/:name/[:lesson]','admins/Account/demo','GET',['ext'=>'shtml'],['name'=>'\w{3,8}','lesson'=>'\w{1,8}']);
//think\Route::rule('she/:name/:lesson','admins/Account/she','GET',['ext'=>'shtml'] ,['name'=>'\w{3,8}','lesson'=>'\w{1,8}']);
//think\Route::group('hello',[
//    ':id'   => ['index/hello/demo', ['method' => 'get'], ['id' => '\d+']],
//    ':name' => ['index/hello/demo1', ['method' => 'get'], ['name'=>'[a-zA-Z]+']],
//]);
//think\Route::group('hello' ,function(){
//    think\Route::get(':id','index/hello/demo',[] ,['id' => '\d+']);
//    think\Route::get(':name','index/hello/demo1',[] ,['name' => '[a-zA-Z]+']);
//});

think\Route::group(['name'=>'hello','method'=>'get','prefix'=>'index/hello/'],[
    ':id'   => ['demo', ['method' => 'get'], ['id' => '\d+']],
    ':name' => ['demo1', ['method' => 'get'], ['name'=>'[a-zA-Z]+']],
]);


think\Route::group('hello',[
    ':id'   => 'demo',
    ':name' => 'demo1',
],[
    'method'=>'get',
    'prefix'=>'index/hello/'
],[
    'id' => '\d+',
    'name'=>'[a-zA-Z]+'
]);


//think\Route::get('add/:n/:m' , 'index/demo/add');
//think\Route::get('sub/:n/:m' , 'index/demo/sub');
//think\Route::get('mult/:n/:m' , 'index/demo/mult');
//think\Route::get('div/:n/:m' , 'index/demo/div');


think\Route::alias('math' , 'index/demo',[
    'ext'=>'html',
//    'allow'=>'add,sub',//白名单，允许访问的方法
    'except'=>'add,sub',//黑名单，不允许访问的方法
]);

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
    'login'     =>[
//        'admins/Account/login'  ,['method'=>'get','callback'=>'mycheck']
        'admins/Account/login'  ,['method'=>'get','deny_ext'=>'']
    ],
    'demo'     =>[
        'admins/Account/demo'  ,['method'=>'get']
    ],

    '__alias__' =>[
      'math'=>['index/demo',['ext'=>'html','allow'=>'add,sub']]
    ],
];

