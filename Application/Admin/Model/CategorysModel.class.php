<?php 
namespace Admin\Model;
use Think\Model;
class CategorysModel extends Model{
    //设置检测限制
     protected $_validate    = array(
        array('cate_name','require','不能为空'),
        // array('name','','该用户名已被注册',0,'unique'),
        // array('pwd','require','不能为空',2),
        // array('sort','require','不能为空'),
        );






    public function _after_select(&$datas){

        $ca=M('Categorys');

        $all=$ca->where('cate_status=1')->select();
        // dump($all);die;
        foreach ($datas as $key => &$val) {
            if($val['pid']==0){
                $val['pid']="顶级分类";
            }

            foreach ($all as $key => $value) {
                if($val['pid']==$value['id']){
                $val['pid']=$value['cate_name'];
            }
            }
        }


        // dump($datas);die;
    }





    public function _after_find(&$datas,$op){
        // dump($op);
        if($op['alias']=='b'){
            $id=$datas['id'];
            //判断有没有孩子分类
            $cate=M('Categorys');
            $all=$cate->select();
            $datas['status']=1;
            foreach ($all as $key => $val) {
               if($val['pid']==$id){
                    $datas['status']=0;
                    return false;
               }
            }

            //判断该分类下有没有商品
            $goods=M('Goods');
            $res= $goods->where("category_id=$id")->find();
            if(!empty($res)){
                 $datas['status']=0;
                 return false;
            }
        }
        
        // $datas['status']=1;
    }






}



 ?>