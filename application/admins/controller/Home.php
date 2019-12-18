<?php
namespace  app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Home extends BaseAdmin
{
    public function index()
    {
        echo 222;die;
        $menus = false;
        $role = $this->db->table('admins_groups')->where(array('gid'=>$this->_admin['gid']))->item();
//        debug($role);
        if($role){
            $role['rights'] = (isset($role['rights'])&& $role['rights']) ? json_decode($role['rights'], true):[];
        }
        if($role['rights']){
            $where['mid'] = array('in',$role['rights']);
            $where['ishidden'] = 0;
            $where['status'] = 0;
            $menus = $this->db->table('admins_menus')->where($where)->cates('mid');
            $menus && $menus = $this->getTreeItems($menus);
        }
        $site = $this->db->table('sites')->where(array('names'=>'site'))->item();
        $site && $site['values']  = json_decode($site['values']);

        $this->assign('site' ,$site);
        $this->assign('role' ,$role);
        $this->assign('menus' ,$menus);
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
    public function welcome()
    {
        return $this->fetch();
    }
}