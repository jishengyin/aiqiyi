<?php
namespace  app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Test extends Controller
{
    public function index()
    {
       $this->db = new Sysdb;
       $res = $this->db->table('admins')->field('id,username')->where(array('id'=>1))->lists();

       return $this->fetch();
    }

    public function login(){
        return $this->fetch();
    }
    public function ajax()
    {
        $json = '{
              "code": 0
              ,"msg": ""
              ,"count": 30
              ,"data": [{
                "id": "10001"
                ,"username": "杜甫"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "浙江杭州"
                ,"sign": "点击此处，显示更多。当内容超出时，点击单元格会自动显示更多内容。"
                ,"experience": "116"
                ,"ip": "192.168.0.8"
                ,"logins": "108"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10002"
                ,"username": "李白"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "浙江杭州"
                ,"sign": "君不见，黄河之水天上来，奔流到海不复回。 君不见，高堂明镜悲白发，朝如青丝暮成雪。 人生得意须尽欢，莫使金樽空对月。 天生我材必有用，千金散尽还复来。 烹羊宰牛且为乐，会须一饮三百杯。 岑夫子，丹丘生，将进酒，杯莫停。 与君歌一曲，请君为我倾耳听。(倾耳听 一作：侧耳听) 钟鼓馔玉不足贵，但愿长醉不复醒。(不足贵 一作：何足贵；不复醒 一作：不愿醒/不用醒) 古来圣贤皆寂寞，惟有饮者留其名。(古来 一作：自古；惟 通：唯) 陈王昔时宴平乐，斗酒十千恣欢谑。 主人何为言少钱，径须沽取对君酌。 五花马，千金裘，呼儿将出换美酒，与尔同销万古愁。"
                ,"experience": "12"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
                ,"LAY_CHECKED": true
              }, {
                "id": "10003"
                ,"username": "王勃"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "浙江杭州"
                ,"sign": "人生恰似一场修行"
                ,"experience": "65"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10004"
                ,"username": "李清照"
                ,"email": "xianxin@layui.com"
                ,"sex": "女"
                ,"city": "浙江杭州"
                ,"sign": "人生恰似一场修行"
                ,"experience": "666"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10005"
                ,"username": "冰心"
                ,"email": "xianxin@layui.com"
                ,"sex": "女"
                ,"city": "浙江杭州"
                ,"sign": "人生恰似一场修行"
                ,"experience": "86"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10006"
                ,"username": "贤心"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "浙江杭州"
                ,"sign": "人生恰似一场修行"
                ,"experience": "12"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10007"
                ,"username": "贤心"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "北京朝阳"
                ,"sign": "人生恰似一场修行"
                ,"experience": "16"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }, {
                "id": "10008"
                ,"username": "贤心"
                ,"email": "xianxin@layui.com"
                ,"sex": "男"
                ,"city": "上海奉贤"
                ,"sign": "人生恰似一场修行"
                ,"experience": "106"
                ,"ip": "192.168.0.8"
                ,"logins": "106"
                ,"joinTime": "2016-10-14"
              }]
            } ';
        $json_de = json_decode($json , true);

        exit($json);

    }
}