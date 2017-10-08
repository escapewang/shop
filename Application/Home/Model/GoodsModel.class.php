<?php 
namespace Home\Model;
use Common\Model\BaseModel;

class GoodsModel extends BaseModel{
    public function _after_find(&$data){

       // $brand=M('Brand');
        //使用父类方法，提高重用性
    $name =$this->getMessage('Brand','name',$data['brand_id']);
      // $name=$brand->field('name')->find($data['brand_id']);
      $data['brand_name']=$name['name'];
    
    }
}



 ?>