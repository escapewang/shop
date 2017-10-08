<?php 
namespace Home\Model;
use Common\Model\BaseModel;

class OrderModel extends BaseModel{
    public function orderAdd($datas){
          //注意，在这里我们需要开启事务
            $this->startTrans();

           $datas['user_id']=session('uid');
           //生成订单号
           $datas['number']=date('ymdhis') . session('uid') . rand(1000, 9999);
           $res=D('Carts')->cart_money($datas['cart_id']);
            $datas['price']=$res;
            $datas['status']=0;
            $datas['pay_status']=0;
            $datas['created_time']=time();
            $datas['pay_time']=0;
            $order_id=$this->add($datas);
            if(!$order_id){
                $this->rollback();
                return false;
            }
            // dump($datas);die;
            //此时将用户选择的商品添加到订单商品表中去
            foreach ($datas['cart_id'] as  $value) {
                //根据购物车id去找到商品信息
                $goods=M('Carts')->where('id='.$value)->find();
                //根据商品基本信息组装订单商品表信息
                $ordergoods['order_id']=$order_id;
                $ordergoods['goods_id']=$goods['goods_id'];
                $ordergoods['goods_title']=$goods['goods_title'];
                $ordergoods['goods_price']=$goods['goods_price'];
                $ordergoods['goods_count']=$goods['goods_number'];
                $ordergoods['goods_attr_value']=$goods['goods_attr'];
                $res=M('OrderGoods')->add($ordergoods);
                if(!$res){
                    $this->rollback();
                    return false;
                }else{
                    //订单商品表数据插入成功后要删除购物表中的对应商品
                    M('Carts')->where('id='.$value)->delete();
                }
            };
            $this->commit();
            return $order_id;
    }
}



 ?>