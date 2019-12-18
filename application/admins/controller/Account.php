<?php
namespace  app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Account extends Controller
{
    public function login()
    {
        $_admin = session('admin');
        if($_admin){
            $this->redirect('/admins.php/admins/Home/index');
//            header('Location:/admins.php/admins/Account/login');
            exit();
        }
        return $this->fetch('new_login');
    }

    public function demo($name , $lesson='tp5')
    {
        return '我叫:'.$name.'我上'.$lesson.'课程';
    }


    public function she()
    {
        return $this->fetch();

    }

    public function dologin()
    {

        $username = trim(input('post.username'));
        $password = trim(input('post.password'));
//        $verifycode = trim(input('post.verifycode'));
        if($username == ''){
            exit(json_encode(array('code'=>1,'msg'=>'用户名不能为空')));
        }
        if($password == ''){
            exit(json_encode(array('code'=>1,'msg'=>'密码不能为空')));
        }
//        if($verifycode == ''){
//            exit(json_encode(array('code'=>1,'msg'=>'验证码不能为空')));
//        }
//        if(!captcha_check($verifycode)){
//            exit(json_encode(array('code'=>1,'msg'=>'验证码错误')));
//        }
        $this->db = new Sysdb;
        $admin = $this->db->table('admins')->where(array('username'=>$username))->item();
        if(!$admin){
            exit(json_encode(array('code'=>1,'msg'=>'用户不存在')));
        }
        if(md5($password) != $admin['password']){
            exit(json_encode(array('code'=>1,'msg'=>'密码错误')));
        }
        if($admin['status'] !=0){
            exit(json_encode(array('code'=>1,'msg'=>'用户已被禁用')));
        }
        //设置session
        session('admin',$admin);
        exit(json_encode(array('code'=>0,'msg'=>'登录成功')));

    }

    public function logout()
    {
        session('admin' ,null);
        exit(json_encode(array('code'=>0,'msg'=>'退出成功')));
    }
}