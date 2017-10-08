<?php 
namespace Home\Model;
use Common\Model\BaseModel;

class UserModel extends BaseModel{
    protected $patchValidate    =   false;
    protected $_validate    = array(
        array('username','require','用户名不能为空'),
        array('username','','帐号名称已经存在！',0,'unique',1), 
// 设置用户名长度
        array('username','2,16','字符数在4-16之间',0,'length'),

        array('password','require','密码不能为空'),
        array('password2','password','密码不一致',0,'confirm'),
        array('email','email','邮箱格式不正确',2),
        // array('goods_count','require','数量不能为空'),
        // array('name','','该用户名已被注册',0,'unique'),
        // array('pwd','require','不能为空',2),
        // array('sort','require','不能为空'),
        );


    public function _before_insert(&$datas){
        $datas['created_time']=time();
    }
}



 ?>