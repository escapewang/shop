<?php
namespace Home\Controller;

class OrderController extends CommonController {
    public function index(){
        //获取购物车信息
        $cartdatas=M('Carts')->where('user_id='.session('uid'))->select();
        foreach ($cartdatas as $key => &$value) {
            $value['goods_attr']=unserialize($value['goods_attr']);
        }
         // dump($cartdatas);die;
        $total=D('Carts')->money($cartdatas);
        // dump($total);dump($cartdatas);die;
        //获取收货地址信息
        $address=M('Address')->where('user_id='.session('uid'))->select();

        $this->assign('address',$address);
        $this->assign('total',$total);
        $this->assign('cartdatas',$cartdatas);
        $this->display();
    }


    public function addressAdd(){

        if(IS_POST){
            $datas=I('post.');
            $datas['user_id']=session('uid');
            $datas['created_time']=time();
            $res=M('Address')->add($datas);
            if($res){
                $this->success('添加成功',U('index'));die;
            }
        }
        $this->display();
    }

    public function add(){
            $datas=I('post.');
            //提交的订单如果没有商品直接报错
            if(empty($datas['cart_id'])){
                $this->error('商品为空，请在购物车中选择商品');
            }
            $res=D('Order')->orderAdd($datas);
            if($res){
                $this->redirect('orderPay',array('order_id'=>$res));
            }else{
                $this->error('订单生成失败');
            }
    }

    public function orderPay(){
        $order_id=I('order_id');
        //根据订单id得到订单信息
        //这里虽然直接可以使用id来唯一区别，但为了防止用户随便改oid可以再加一个用户id限制；
        $datas=M('Order')->where(array('id'=>$order_id,'user_id'=>session('uid')))->find();
        // dump($datas);die;
        $this->assign('datas',$datas);
        $this->display();
    }

    public function payNow(){
        $order_id=I('order_id');
        $datas=M('Order')->where(array('id'=>$order_id,'user_id'=>session('uid')))->find();
        if(!$datas){
            $this->error('不要瞎改');
        }
        //根据不同的支付方式请求不同的支付接口
        switch ($datas['pay_type']) {
            case '1':
                echo "余额支付";
                break;
            case '2':
                echo "支付宝支付";
                break;
            default:
                # code...
                break;
        }
    }
   
}