<?php 
namespace Admin\Model;
use Common\Model\BaseModel;
class GoodsModel extends BaseModel{

  
  //数据限制
   protected $patchValidate    =   true;
   protected $_validate    = array(
        array('goods_title','require','商品名称不能为空'),
        array('category_id','require','商品分类不能为空'),
        array('brand_id','require','品牌不能为空'),
        array('goods_price','require','价格不能为空'),
        array('goods_count','require','数量不能为空'),
        // array('name','','该用户名已被注册',0,'unique'),
        // array('pwd','require','不能为空',2),
        // array('sort','require','不能为空'),
        );





    //对于数据的处理尽量在model层处理
    //钩子函数，在插入之前执行的函数
   public function _before_insert(&$datas){
    // dump($datas);die;
      
        //在商品 加入之前对数据desc数据进行单独的xss过滤，
    //这里我们使用purifier过滤script脚本,如果你用了ue，会将js转化为字符实体，
    //也没必要进行xss过滤
        // dump(htmlXss($datas['goods_title']));die;
        //增加商品的添加时间
        $datas['created_time']=time();
   }

   //选择之后将数据进行跨表查询，这种查询比连表查询效率要高的多
   //还可以传第二个参数，代表一些插入信息，比如limit,where,表名等条件
   public function _after_select(&$datas){
    // dump($options);die;
        // $cate=M('Categorys');
        // $brand=M('Brand');
        foreach ($datas as $key => $val) {
          $catearr =$this->getMessage('Categorys','cate_name',$val['category_id']);
            // $catearr=$cate->field('cate_name')->find($val['category_id']);
            $datas[$key]['cate_name']=$catearr['cate_name'];
             $brarr =$this->getMessage('Brand','name',$val['brand_id']);
            // $brarr=$brand->field('name')->find($val['brand_id']);
            $datas[$key]['name']=$brarr['name'];
        }
        // dump($datas);die;
   }


   //因为控制器里面可能有很多的find函数，但每个find函数之后可能会有不同的需求，此时我们可以
   //利用第二个参数来进行判断
   //这里还有一种方法那就是定义模型直接定义M,这样就可以不用走D
   public function _after_find(&$res,$op){
        if($op['alias']=='a'){
          echo "我是aaa";
        }elseif($op['alias']=='b'){
          echo "我是bbb";
        }
   }




   public function _before_update(&$a,$b){
    //对于商品数据进行修改之前的操作，加了限制条件，不会影响到其他操作
     if($b['alias']=='a'){
        if(!empty($_FILES['goods_image']['name'])){
              $info=uploadFile('GOODSUPLOAD_CONFIG');
              // dump($info);die;
              if(empty($info['goods_image']['name'])){
                  return false;
              }
              // dump($info);die;
              //此时图片以保存需要生成缩略图和保存数据库

              $a['goods_big_img']=$info['goods_image']['savepath'].$info['goods_image']['savename'];
                $openpath=UPLOAD_PATH.'goods/'.$a['goods_big_img'];
                $savepath=UPLOAD_PATH.'goods/'.$info['goods_image']['savepath'].'_thumb'.$info['goods_image']['savename'];
                //同时生成缩略图
                $res=getThumb($openpath,$savepath);
                if(!$res){
                    return false;
                }
                $a['goods_thumb_img']=$info['goods_image']['savepath'].'_thumb'.$info['goods_image']['savename'];
        }
     }
   }
}



 ?>