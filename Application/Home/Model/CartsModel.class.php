<?php 
namespace Home\Model;
use Think\Model;

class CartsModel extends Model{
        //用户登录收藏增加
        public function addCart($datas){
            // dump($datas);
            $goods_id=$datas['goods_id'];
            //根据用户是否登录使用不同的保存方式
           if(session('uid')){
               return  $this->aadd($goods_id,$datas);
            }else{
                    //将数据保存到cookie中
                     //首先判断是否有商品COOKIE,没有就直接添加，有就直接合并
                    if($old=cookie('cartdatas')){
                        //首先判断是否添加是否是同一件商品，是就直接更新掉
                        $old=unserialize($old);
                        //将数组合并
                        $old[$goods_id]=$datas;
                          // dump($old);die;
                        $old=serialize($old);

                        cookie('cartdatas',$old,3600*24*7);
                    }else{
                        //注意购物车里面不知一条数据，所以我们需要给升维,我们可以使用商品的id作为键，
                        //后面你会看到有很多的妙处

                        $new[$goods_id]=$datas;
                        //序列化处理
                        $new=serialize($new);
                        cookie('cartdatas',$new,3600*24*7);
                    }
                    return true;
            }
           
                  
        }

        public function loginAdd()
        {
            $datas=unserialize(cookie('cartdatas'));
            // dump($datas);
            //此时循环将数据插到数据表中
            foreach ($datas as $key => $val) {
                $goods_id=$key;
                // dump($goods_id);die;
                $res=$this->aadd($goods_id,$val);
                if(!$res){
                    return false;
                }
            }
            return true;
        }


        public function cookieData(&$datas){
            //获取cookie数据
            // dump($datas);die;
            foreach ($datas as $key => $val) {
                if($key!=""){
                     $gooddatas=M('Goods')->where('id='.$key)->find();
                    $datas[$key]['created_time']=time();
                    $datas[$key]['exp_time']=time()+3600*7*24;
                    $datas[$key]['goods_title']=$gooddatas['goods_title'];
                    $datas[$key]['goods_thumb_img']=$gooddatas['goods_thumb_img'];
                    $datas[$key]['goods_price']=$gooddatas['goods_price'];
                    $datas[$key]['goods_mprice']=$gooddatas['goods_mprice'];
                }else{
                    unset($datas[$key]);
                }
               
            }
        }


        public function delCarts($id){
            $where=array('goods_id'=>$id,
                'user_id'=>session('uid'));
            return $this->where($where)->delete();
        }

        public function editCarts($goods_id,$goods_number){
            $where=array('goods_id'=>$goods_id,
                'user_id'=>session('uid'));
            $datas=$this->where($where)->find();
            $datas['goods_number']=$goods_number;
            $res=$this->save($datas);
            if($res){
                return 1;
            }else{
                return 0;
            }
        }


        public function aadd($goods_id,$datas){
            // dump($datas);dump($goods_id);
            // dump('user_id='.session('uid')." and goods_id=".$goods_id);die;
                //首先加一个判断该商品是否已经存在购物车中
         $res=$this->where('user_id='.session('uid')." and goods_id=".$goods_id)->find();
         // dump($res);
                if(!$res){
                    //不存在此时就保存
                     $goods=M('Goods')->where('id='.$goods_id)->find();
                    // dump($goods);
                    //生成数据
                    $datas['user_id']=session('uid');
                    $datas['goods_attr']=serialize($datas['val']);
                    $datas['created_time']=time();
                    $datas['exp_time']=time()+3600*7*24;
                    //生成商品信息
                    $datas['goods_title']=$goods['goods_title'];
                    $datas['goods_thumb_img']=$goods['goods_thumb_img'];
                    $datas['goods_price']=$goods['goods_price'];
                    $datas['goods_mprice']=$goods['goods_mprice'];
                   return $this->add($datas);
                    // dump($res);die;
                }else{
                    //存在此时就更新
                      $datas['goods_attr']=serialize($datas['val']);
                      return $this->where('id='.$res['id'])->save($datas);
                }
        }


        public function money(&$datas){
            $total=0;
            foreach ($datas as  &$value) {
                $value['subtotal']=$value['goods_price']*$value['goods_number'];
                $total+=$value['subtotal'];
            }
            return $total;
        }   

        public function cart_money($datas){
            $cart_total=0;
            foreach ($datas as  $value) {
               $data=$this->where('id='.$value)->find();
               $cart_total+=$data['goods_number']*$data['goods_price'];
            }
            return $cart_total;
        }

}



 ?>