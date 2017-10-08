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
            // dump($datas);die;
            //根据用户是否登录将商品信息保存到表或cookie中
           $res= D('Carts')->addCart($datas);
           if($res){
            $this->success('收藏成功',U('index'),1);
           }else{
            $this->error('收藏失败');
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
                 dump($cartdatas);
                $cartdatas[$goods_id]['goods_number']=$goods_number;
                // dump($cartdatas);die;
                $cartdatas=serialize($cartdatas);
                cookie('cartdatas',$cartdatas,3600*24*7);
            }
        }

}