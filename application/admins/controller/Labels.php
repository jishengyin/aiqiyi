<?php
namespace  app\admins\controller;
use app\admins\Controller\BaseAdmin;
use Util\data\Sysdb;

class Labels extends BaseAdmin
{
    //频道
    public function channel()
    {
        $list = $this->db->table('video_label')->where(array('flag'=>'channel'))->lists();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //资费
    public function charge()
    {
        $list = $this->db->table('video_label')->where(array('flag'=>'charge'))->lists();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //地区
    public function area()
    {
        $list = $this->db->table('video_label')->where(array('flag'=>'area'))->lists();
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function save()
    {
        $flag = trim(input('post.flag'));
        $ords = input('post.ords/a');
        $titles = input('post.titles/a');
        $status = input('post.status/a');

        foreach ($ords as $key => $value){
            $data['flag'] = $flag;
            $data['ord']  =$value;
            $data['title']  =$titles[$key];
            $data['status']  = isset($status[$key])?1:0;
            if($key == 0 && $data['title'])
            {
                $this->db->table('video_label')->insert($data);
            }else{
                if($data['title'] == '' ){
                    //删除
                    $this->db->table('video_label')->where(array('id'=>$key))->delete();
                }else{
                    //修改
                    $this->db->table('video_label')->where(array('id'=>$key))->update($data);
                }
            }

        }

        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }

}