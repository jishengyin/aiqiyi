<?php
namespace  app\admins\controller;
use app\admins\Controller\BaseAdmin;
use Util\data\Sysdb;

class Roles extends BaseAdmin
{
    public function index()
    {

        $list = $this->db->table('admins_groups')->lists();
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function add()
    {
        $gid = (int)input('get.gid');
        $role = $this->db->table('admins_groups')->where(array('gid'=>$gid))->item();
        $role && $role['rights'] && $role['rights'] = json_decode($role['rights']);

        $this->assign('role',$role);
        $menus_list = $this->db->table('admins_menus')->where(array('status'=>0))->cates('mid');
        $menus = $this->getTreeItems($menus_list);
        $results = array();
        foreach ($menus as $value){
            $value['children'] = isset($value['children'])?$this->formatMenus($value['children']):false;
            $results[] = $value;
        }
        $this->assign('menus',$results);

        return $this->fetch();
    }

    private function getTreeItems($items){
        $tree = array();
        foreach ($items as $item) {
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['children'][] = &$items[$item['mid']];
            }else{
                $tree[] = &$items[$item['mid']];
            }
        }
        return $tree;
    }

    private function formatMenus($items , &$res = array())
    {
         foreach ($items as $item){
             if(!isset($item['children'])){
                 $res[] = $item;
             }else{
                 $tem = $item['children'];
                 unset($item['children']);
                 $res[] = $item;
                 $this->formatMenus($tem,$res);
             }
         }
         return $res;
    }

    public function save()
    {
        $gid = (int)input('post.gid');
        $data['title'] = trim(input('post.title'));
        $menus = input('post.menu/a');

        if(!$data['title']){
            exit(json_encode(array('code'=>1,'msg'=>'角色不能为空')));
        }
        $menus && $data['rights'] = json_encode(array_keys($menus));
        if($gid){
            $this->db->table('admins_groups')->where(array('gid'=>$gid))->update($data);
        }else{
            $this->db->table('admins_groups')->insert($data);
        }
        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }

    //删除
    public function delete()
    {
        $gid = intval(input('post.gid'));
        $res = $this->db->table('admins_groups')->where(array('gid'=>$gid))->delete();
        if(!$res){
            exit(json_encode(array('code'=>1 ,'msg'=>'删除失败')));
        }
        exit(json_encode(array('code'=>0 ,'msg'=>'删除成功')));
    }

}