<?php
namespace Home\Controller;
use Think\Controller;
class CartsController extends Controller {
        //收藏列表
        public function index(){
            //如果用户已登录
            if(session('uid')){
                //获取收藏数据
                $datas=M('Carts')->where('user_id='.session('uid'))->select();
               //   将属性反序列化
                foreach ($datas as $key => $value) {
                    $val=unserialize($value['goods_attr']);
                   $datas[$key]['val']=$val;
                }

                
            }else{
                //用户未登录，从cookie读取数据
                // dump(unserialize(cookie('cartdatas')));
                $datas=unserialize(cookie('cartdatas'));
                //获取cookie数据
                 D('Carts')->cookieData($datas);
                // dump($datas);die;
            }
            $this->assign('datas',$datas);
            $this->display();
           
        }


        //商品添加收藏
        public function add(){
            $datas=I('post.');
            dump($datas);die;
            $goods_id=$datas['goods_id'];
            // dump($datas);die;
            //这时需要判断用户是否登录，
            // 如果没有登录就需要我们将商品信息保存到cookie中
            //如果登录了我们就将信息保存到数据表中去
            if(session('uid')){
                //将数据保存到数据表中
                $res=D('Carts')->addCart($goods_id,$datas);
                if($res=='a'){
                    $this->error('该商品已被收藏',U('index'),1);
                }else{
                    if($res){
                        $this->success('添加成功',U('index'),1);
                    }else{
                        $this->error('添加失败');
                    }
                }

            }else{
                //保存到cookie中,注意这里可能会有多条cookie数据，所以我们需要将数组
                //进一步升维

                //判断cookie中是否已经存在商品数据,如果存在需要将数据合并
                if($old=cookie('cartdatas')){
                 

                    $old=unserialize($old);
                       //判断该商品是否已被收藏
                    // dump($old);
                    // dump($datas);die;
                    foreach ($old as  $value) {
                        if($value==$datas){
                              $this->error("该商品已被添加",U('index'));die;
                        }
                    }
                    //这里就有一个问题，如果用户选择了同一件商品的不同属性，
                    //后面选择的会把前面选择的给覆盖掉
                    $old[$goods_id]=$datas;
                    $new=$old;
                }else{
                    $new[$goods_id]=$datas;
                }
                // dump($new);die;
                $new=serialize($new);
                $res=cookie('cartdatas',$new);
                $this->success('收藏成功',U('index'));
                // dump(unserialize(cookie('cartdatas')));die;

            }


        }


        //ajax删除
        public function del(){
            $goods_id=I('id');
            if(session('uid')){
                $res=D('Carts')->delCarts($goods_id);
                if($res){
                    $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));
                }else{
                      $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败'));
                }
            }else{

                //cookie删除
                $cartdatas=unserialize(cookie('cartdatas'));

                unset($cartdatas[$goods_id]);
              
                cookie('cartdatas',serialize($cartdatas),3600*60*24);
                // dump($cartdatas);die;
                $this->ajaxReturn(array('status'=>1,'msg'=>'删除成功'));

            }
        }

        //ajax修改
        public function edit(){
            $datas=I('get.');//少了一个点搞了半天
            $goods_id=$datas['goods_id'];
            $goods_number=$datas['goods_number'];
            // dump($datas);
            if(session('uid')){
                //登录用户修改
                $res=D('Carts')->editCarts($goods_id,$goods_number);
                if($res){
                    $this->ajaxReturn(array('status'=>1));
                }else{
                      $this->ajaxReturn(array('status'=>0));
                }
            }else{
                // cookie修改
               
                $cartdatas=unserialize(cookie('cartdatas'));
                 // dump($cartdatas);
                $cartdatas[$goods_id]['goods_number']=$goods_number;
                // dump($cartdatas);die;
                $cartdatas=serialize($cartdatas);
                cookie('cartdatas',$cartdatas,3600*24*7);
            }
        }

}