<?php
namespace Admin\Controller;

class GoodsController extends CommonController {
    public function index(){
        $goods=D('Goods');
        $total=$goods->where('goods_status<>0')->count();
        // var_dump($total);die;
        $page=new \Think\Page($total,5);

        // $datas=$goods->alias('a')
        // ->field('a.*,b.name,c.cate_name')
        // ->limit($page->firstRow,$page->listRows)
        // ->join('left join shop_brand as b on a.brand_id=b.id left join shop_categorys as c on a.category_id=c.id')
        // ->where('goods_status=1')
        // ->select();
        //这里的<>表示的是不等于
        $datas=$goods->limit($page->firstRow,$page->listRows)->where('goods_status<>0')->select();
        // dump($datas);die;
        // var_dump($datas);die;
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $show=$page->show();
        // $page->show()
        //分页
        // var_dump($datas);
      
        $acc=$this->curd();
        // dump($acc);die;

        $this->assign('data',$datas);
        $this->assign('accdatas',$acc);
        $this->assign('show',$show);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $goods=D('Goods');   
            $data=I('post.');
            // dump($data);die;
            $desc=$_POST['goods_description'];
            $res=$goods->create();

            if(!$res){
                 $er=$goods->getError();
                foreach ($er as  $val) {
                    $ers[]=$val;
                }
                $this->error($ers[0],'add',1);
            }
            $goods->goods_description=$desc;

            //上传配置,注意一个点，给数据对象增加属性需要写在create函数之后，不然会被清空
            if(!empty($_FILES['goods_image']['name'])){
                //配置上传信息
               $info= uploadFile('GOODSUPLOAD_CONFIG');
               // dump($info);die;
                if(empty($info['goods_image']['name'])){
                    $this->error($info);die;
                }
                $goods->goods_big_img=$info['goods_image']['savepath'].$info['goods_image']['savename'];
                $openpath=UPLOAD_PATH.'goods/'.$goods->goods_big_img;
                $savepath=UPLOAD_PATH.'goods/'.$info['goods_image']['savepath'].'_thumb'.$info['goods_image']['savename'];
                //同时生成缩略图
                $thumb=new \Think\Image();
                $thumb->open($openpath);
                $res=$thumb->thumb(60,60)->save($savepath);
                if(!$res){
                    $this->error('操作失败');
                }
                $goods->goods_thumb_img=$info['goods_image']['savepath'].'_thumb'.$info['goods_image']['savename'];
            }
            $data=$data['goods_attr_value'];
          
           // dump($arr);die;
            $res=$goods->add();
            if($res){
                //注意将属性插入到表中时，需要先插入商品基础字段，这样才能获得该商品的id,
                //注意addAll只能是二维数组，且数组第一维数组下标是0开始
                   foreach ($data as $key => $val) {
                    $arr['attribute_id']=$key;
                    $arr['goods_id']=$res;
                    $arr['goods_attr_value']=implode(',',$val);
                    $ress=M('GoodsAttr')->add($arr);
                } 
                if($ress){
                     $this->success('添加成功','index',1);
                }
               
            }else{
                $this->error('添加失败','add',1);
            }

        }else{
            $brands=M('Brand');
            $cates=M('Categorys');
            $brdatas=$brands->where('brand_status=1')->select();
            $cadatas=$cates->where('cate_status=1')->select();
            //对查询出来的品牌数据进行分类排序
           getTree($cadatas);
            $cadatas=$GLOBALS['tree'];
            // dump($cadatas);die;

            $this->assign('cate',M('Cate')->select());
            $this->assign('brdatas',$brdatas);
            $this->assign('cadatas',$cadatas);
            $this->display();
        }
    }

    public function del(){
        // echo "111";
        $id=I('id');
        $goods=M('Goods');
        $goods->goods_status=0;
      $res= $goods->where(array('id'=>$id))->save();
      if($res){
        $this->success("删除成功",U('index'),1);
      }
    }


    //修改商品信息,注意将和数据库打交道的封装到自定义model层之中
    public function update(){
         $id=I('get.id');
         $goods=D('Goods');
            if(IS_POST){
            $datas=I('post.');
                //修改之前判断是否上传图片和增加缩略图
            $res=$goods->alias('a')->where("id=$id")->save($datas);
            if($res){
                $this->success('修改成功',U('index'));
            }else{
                $this->error('修改失败');
            }

         }else{
           
            
            $res=$goods->find($id);

            //查找分类数据
            $cate=M('Categorys');
            //注意分类之后需要将数据进行排序操作
            getTree($cate->select());
            $cadatas=$GLOBALS['tree'];

            //查找品牌数据
            $brand=M('Brand');
            $brdatas=$brand->select();
       
            $this->assign('res',$res);
            $this->assign('brdatas',$brdatas);
            $this->assign('cadatas',$cadatas);

            $this->display();
        }
       
    }


    //ajax上下架操作
    public function ajaxUD(){
        $id=I('id');
        $goods=M('Goods');
       $data= $goods->find($id);
       // dump($data);die;
       //判断该商品此时的状态
       if($data['goods_status']==1){
            $data['goods_status']=-1;

            $nowStatus="下架";
            $toggleStatus="上架";
       }else{
             $data['goods_status']=1;
            $nowStatus="上架";
            $toggleStatus="下架";
       }
       $goods->where("id=$id")->save($data);

       //传统方式，将数据组成数组让后使用json_encode函数
       // echo json_encode(array('nowStatus'=>$nowStatus,
       //  'toggleStatus'=>$toggleStatus,
       //  ));

       //TP框架封装ajaxReturn函数，默认返回json数据
       $arr=array('nowStatus'=>$nowStatus,
        'toggleStatus'=>$toggleStatus,
        );
        echo  $this->ajaxReturn($arr);


    }

    //商品图片管理
    public function photos(){
        $goods_id=I('get.id');
        if(IS_POST){
            // dump($_FILES);die;
             if(!empty($_FILES['image']['name'][0])){
                    //上传图片保存到服务器
                    $info=uploadFile('GOODSUPLOAD_CONFIG');
                 
                    if(empty($info['0']['name'])){
                        $this->error($info);die;
                    }
                    //循环生成缩略图
                    $thumb=new \Think\Image();
                    $datas=array();
                    foreach ($info as $key => $val) {
                        $datas[$key]['big_img']=$val['savepath'].$val['savename'];
                        $datas[$key]['thumb_img']=$val['savepath'].'_thumb'.$val['savename'];
                        $datas[$key]['goods_id']=$goods_id;
                        $openpath=UPLOAD_PATH.'goods/'. $datas[$key]['big_img'];
                        $savepath=UPLOAD_PATH.'goods/'. $datas[$key]['thumb_img'];
                        $thumb->open($openpath);
                        $res=$thumb->thumb(60,60)->save($savepath);
                        if(!$res){
                            $this->error('上传失败');die;
                        }
                    }
                    // dump($datas);die;
                    //这里我们用到一个新的函数addALL();这个函数第一个参数需要是一个
                    //二维数组，这样就可以直接将多条记录直接插入，不需要一条一条的插
                    $img=M('GoodsImg');
                    $res=$img->addAll($datas);
                    if($res){
                        $this->success("上传成功",U('photos',array('id'=>$goods_id)));
                    }else{
                         $this->error("上传失败");
                    }



             }else{
                $this->error('请上传图片');
             }
        }else{
            
            $goods=M('Goods');

            $img=M('GoodsImg');
            $imgs=$img->where("goods_id=$goods_id")->select();
            $data=$goods->find($goods_id);
            $this->assign('data',$data);
            $this->assign('imgs',$imgs);
            $this->display();
        }
       
    }

    //ajax删除图片,使用物理真实删除
    public function ajaxDel(){
        $id=(int)$_GET['id'];
        //在这里注意一个问题，在记录删除成功的条件下才可以删除保存在服务器的图片文件
        $imgs=M('GoodsImg');
        //删除成功之前先保存路径信息
        $data=$imgs->find($id);
        $res=$imgs->delete($id);
        if($res){

            $res2=unlink(UPLOAD_PATH.'goods/'.$data['big_img']);
           
            unlink(UPLOAD_PATH.'goods/'.$data['thumb_img']);
            echo $this->ajaxReturn(array('status'=>1));die;
        }
         echo $this->ajaxReturn(array('status'=>0));
    }

  

}