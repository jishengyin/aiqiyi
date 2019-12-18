<?php
/**
 * Created by PhpStorm.
 * User: syuser1
 * Date: 2019/12/12
 * Time: 15:10
 */
namespace app\index\controller;

class Demo extends  \think\Controller
{
    protected  $beforeActionList = [
        'before1'=>'',//为空，表示before1是当前类中的全部操作的前置操作
        'before2'=>['only'=>'demo2'],//仅对demo2方法有效
        'before3'=>['except'=>'demo1,demo2'],//仅对除demo1,demo2之外的方法有效
    ];
    protected  $siteName;
    protected  function before1()
    {
        $this->siteName = $this->request->param('name');
    }

    protected  function before2()
    {
        $this->siteName = 'love';
    }

    protected  function before3()
    {
        $this->siteName = '11111111111111111';
    }
    public function demo1()
    {
        return $this->siteName;
    }
    public function demo2()
    {
        return $this->siteName;
    }
    public function demo3()
    {
        return $this->siteName;
    }

    public function hello($name)
    {
        if($name=='jsy'){
            $this->success('输入正确','ok');
        }else{
            $this->error('输入错误','fail');
        }
    }
    public function ok()
    {
        return 'ok';
    }

    public function fail()
    {
        return 'fail';
    }
    public function index()
    {
        debug(111);
    }
    public function add($n , $m)
    {
        return $n.'+'.$m.'='.($n+$m);


    }

   public function sub($n ,$m)
    {
        return $n.'-'.$m.'='.($n-$m);
    }

    public function mult($n ,$m)
    {
        return $n.'*'.$m.'='.($n*$m);
    }

    public function div($n ,$m)
    {
        return $n.'/'.$m.'='.round($n/$m, 2);
    }
}