<?php 
namespace Admin\Model;
use \Think\Model;
class BrandModel extends Model{
   
    //第四个参数是验证条件，1必须验证，0表单存在该字段就验证（默认）
    //2表示值不为空的时候验证
    protected $_validate    = array(
        array('name','require','不能为空'),
        // array('name','','该用户名已被注册',0,'unique'),
        // array('pwd','require','不能为空',2),
        array('sort','require','不能为空'),
        );

    //$_map实现字段的映射
    protected $_map=array(
        'username'=>'name',  //表单的username映射到数据的name字段
        );


    public function getMessage(){
       return  $this->query("select * from shop_goods");
    }
}



 ?>