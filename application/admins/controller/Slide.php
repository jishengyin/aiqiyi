<?php
namespace  app\admins\controller;
use app\admins\Controller\BaseAdmin;
use Util\data\Sysdb;

class Slide extends BaseAdmin
{
    public function index()
    {
        $list = $this->db->table('slide')->where(array('type'=>'0'))->lists();

//        $site && $site['values']  = json_decode($site['values']);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {
        $id = (int)input('get.id');
        $slide = $this->db->table('slide')->where(array('id'=>$id))->item();

        $this->assign('data',$slide);
        return $this->fetch();
    }
    public function save()
    {
        $id =(int)input('post.id');
        $data['type'] =(int)input('post.type');
        $data['ord'] =(int)input('post.ord');
        $data['title'] = trim(input('post.title'));
        $data['url'] = trim(input('post.url'));
        $data['img'] = trim(input('post.img'));

//        $site = $this->db->table('sites')->where(array('names'=>'site'))->item();
        if(!$id){
            $this->db->table('slide')->insert($data);
        }else{
            $this->db->table('slide')->where(array('id'=>$id))->update($data);
        }
          exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }

    //删除
    public function delete()
    {
        $id = intval(input('post.id'));

        $res = $this->db->table('Slide')->where(array('id'=>$id))->delete();
        if(!$res){
            exit(json_encode(array('code'=>1 ,'msg'=>'删除失败')));
        }
        exit(json_encode(array('code'=>0 ,'msg'=>'删除成功')));
    }
}