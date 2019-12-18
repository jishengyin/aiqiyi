<?php
namespace  app\admins\controller;
use app\admins\Controller\BaseAdmin;
use Util\data\Sysdb;

class Video extends BaseAdmin
{
    public function index()
    {
        $data['wd'] = trim(input('get.wd'));
        $where = [];
        if( $data['wd']){
            $where['title'] = array('like',array('%'. $data['wd'].'%'));
        }
        $data['pageSize'] = 15;
        $data['page'] = max(1,(int)input('get.page'));

        $data['data'] = $this->db->table('video')->where($where)->order('id desc')->pages($data['pageSize']);
        $channel_ids ='';
        $charge_ids ='';
        $area_ids ='';
        foreach ($data['data']['lists'] as $key =>$item){

            if(strlen($channel_ids) != 0){
                $channel_ids .= ',';
            }
            $channel_ids .= $item['channel_id'];
            if(strlen($charge_ids) != 0){
                $charge_ids .= ',';
            }
            $charge_ids .= $item['charge_id'];
            if(strlen($area_ids) != 0){
                $area_ids .= ',';
            }
            $area_ids .= $item['area_id'];

//            !in_array($item['channel_id'],$labels_ids) && $labels_ids[] = $item['channel_id'];
//            !in_array($item['charge_id'],$labels_ids) && $labels_ids[] = $item['charge_id'];
//            !in_array($item['area_id'],$labels_ids) && $labels_ids[] = $item['area_id'];
        }


        $label_where['id'] = array('in',$channel_ids.','.$charge_ids.','.$area_ids);


       $data['labels'] = $this->db->table('video_label')->where($label_where)->cates('id');

        $this->assign('data',$data);
        return $this->fetch();
    }

    public function add()
    {
        $data['channel'] = $this->db->table('video_label')->where(array('flag'=>'channel'))->lists();
        $data['charge'] = $this->db->table('video_label')->where(array('flag'=>'charge'))->lists();
        $data['area'] = $this->db->table('video_label')->where(array('flag'=>'area'))->lists();

        $id = (int)input('get.id');
        $data['item'] = $this->db->table('video')->where(array('id'=>$id))->item();
        $this->assign('data',$data);
        return $this->fetch();
    }

    //图片上传
    public function upload_img()
    {
            $file = request()->file('file');
            if($file == null){
                exit(json_encode(array('code'=>1,'msg'=>'没有图片上传')));
            }
            $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
            $ext = $info->getExtension();
            if(!in_array($ext , array('jpg','jpeg','gif','png'))){
                exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
            }
            $img = '/uploads/'.$info->getSaveName();
            exit(json_encode(array('code'=>0,'msg'=>$img)));

    }

    public function save()
    {
        $id = (int)input('post.id');
        $data['title'] = trim(input('post.title'));
        $data['channel_id'] = (int)(input('post.channel_id'));
        $data['charge_id'] = (int)(input('post.charge_id'));
        $data['area_id'] = (int)(input('post.area_id'));
        $data['url'] = trim(input('post.url'));
        $data['keywords'] = trim(input('post.keywords'));
        $data['desc'] = trim(input('post.desc'));
        $data['status'] = (int)(input('post.status'));
        $data['img'] = trim(input('post.img'));

        if($data['title'] == ''){
            exit(json_encode(array('code'=>1,'msg'=>'影片名称不能为空')));
        }
        if($data['url'] == ''){
            exit(json_encode(array('code'=>1,'msg'=>'影片地址不能为空')));
        }
        if($id){
            $this->db->table('video')->where(array('id'=>$id))->update($data);
        }else{
            $data['add_time'] = time();
            $this->db->table('video')->insert($data);
        }
        exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }


    //删除
    public function delete()
    {
        $id = intval(input('post.id'));
        $res = $this->db->table('video')->where(array('id'=>$id))->delete();
        if(!$res){
            exit(json_encode(array('code'=>1 ,'msg'=>'删除失败')));
        }
        exit(json_encode(array('code'=>0 ,'msg'=>'删除成功')));
    }

}