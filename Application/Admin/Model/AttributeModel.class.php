<?php 
namespace Admin\Model;
use \Think\Model;
class AttributeModel extends Model{
   
    public function _after_select(&$datas,$op){

        if($op['alias']=='a'){
            foreach ($datas as $key => $val) {
                $ca=M('Cate')->field('cate_name')->where('id='.$val['cate_id'])->find();
                $datas[$key]['cate_name']=$ca['cate_name'];
            
            }
          
        } 
        // dump($datas);
        // dump($cate_name);die;
    }


}
 ?>