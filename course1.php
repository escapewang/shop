<?php 
namespace Admin\Model;
use \Think\Model;
class UserModel extends Model{
   
    //自动验证
    protected $_validate    = array(

        array('name','/^\w{6,12}$/','必须为6-12位字母数字下划线'),
        array('passwd','require','密码不能为空'),
         array('password2','passwd','密码不一致',0,'confirm'),
        );
    //自动完成
    protected $_auto=array(
        array('roleid','1'),
        array('addtime','time',1,'function'),
        )
}



 ?>