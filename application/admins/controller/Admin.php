<?php
namespace  app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Admin extends BaseAdmin
{
    //管理员列表
    public function index()
    {

        $list = $this->db->table('admins')->lists();

        $groups = $this->db->table('admins_groups')->cates('gid');
//        debug($list);
        $this->assign('list',$list);
        $this->assign('groups',$groups);
        return $this->fetch();
    }
    public function add()
    {
        $id = intval(input('get.id'));
        $item = $this->db->table('admins')->where(array('id'=>$id))->item();

        $list = $this->db->table('admins_groups')->cates('gid');

        $this->assign('groups',$list);
        $this->assign('item',$item);
        return $this->fetch();
    }

    public function save()
    {
        $id = (int)input('post.id');

        $data['username'] = trim(input('post.username'));
        $data['gid'] = (int)input('post.gid');
        $password = trim(input('post.pwd'));
        $data['truename'] = trim(input('post.truename'));
        $data['status'] = (int)input('post.status');


        if(!$data['username']){
            exit(json_encode(array('code'=>1 ,'msg'=>'用户名不能为空')));
        }
        if(!$data['gid']){
            exit(json_encode(array('code'=>1 ,'msg'=>'角色不能为空')));
        }

        if($id==0 && !$password){
            exit(json_encode(array('code'=>1 ,'msg'=>'密码不能为空')));
        }
        if(!$data['truename']){
            exit(json_encode(array('code'=>1 ,'msg'=>'真实姓名不能为空')));
        }
        $res = true;
        if($id == 0){

            $item = $this->db->table('admins')->where('username="%s"',array($data['username']))->item();
            if($item){
                exit(json_encode(array('code'=>1 ,'msg'=>'该用户已存在')));
            }
            $data['add_time'] = time();
            $data['password'] = md5($data['username'].$password);
            //保存用户
            $res = $this->db->table('admins')->insert($data);
        }else{

             $this->db->table('admins')->where(array('id'=>$id))->update($data);
//            debug($this->db->getLastSql());
        }

        if(!$res){
            exit(json_encode(array('code'=>1 ,'msg'=>'保存失败')));
        }
        exit(json_encode(array('code'=>0 ,'msg'=>'保存成功')));
    }

    //删除
    public function delete()
    {
        $id = intval(input('post.id'));
        $res = $this->db->table('admins')->where(array('id'=>$id))->delete();
        if(!$res){
            exit(json_encode(array('code'=>1 ,'msg'=>'删除失败')));
        }
        exit(json_encode(array('code'=>0 ,'msg'=>'删除成功')));
    }
}