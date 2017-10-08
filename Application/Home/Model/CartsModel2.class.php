<?php 
namespace Home\Model;
use Think\Model;

class CartsModel extends Model{
        //用户登录收藏增加
        public function addCart($goods_id,$datas){
            // dump($datas);die;
            //这里要特别注意数组是无法直接放入数据库的需要我们将其序列化一下
            $goods_attr=serialize($datas['val']);
            //判断数据库是否已经添加该商品收藏
            //注意还要加一个限制条件是属于某一个用户
            $user_id=session('uid');
            $has=$this->
            where('goods_id='.$goods_id." and goods_attr='$goods_attr'"." and user_id=".$user_id)
            ->find();
            if(!$has){
                 $gooddatas=M('Goods')->where('id='.$goods_id)->find();
                    $datas['user_id']=session('uid');
                    $datas['goods_id']=$goods_id;
                    $datas['goods_attr']=$goods_attr;
                    $datas['created_time']=time();
                    $datas['exp_time']=time()+3600*7*24;
                    $datas['goods_title']=$gooddatas['goods_title'];
                    $datas['goods_thumb_img']=$gooddatas['goods_thumb_img'];
                    $datas['goods_price']=$gooddatas['goods_price'];
                    $datas['goods_mprice']=$gooddatas['goods_mprice'];
                   $res= $this->add($datas);
                   return $res;
            }else{
                return 'a';
            }
           
                  
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
}



 ?>