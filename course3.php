<?php
namespace Admin\Controller;
use Think\Controller;
class AAAController extends Controller {
        public function getOrderByName(){
            $name=I('post.');
            $sql="select a.*,b.name as user_name,c.name as goods_name from order as a ";
            $sql.=" left join user as b on a.user_id=b.id left join";
            $sql.=" goods as c on a.goods_id=c.id where b.name='$name'";
            $model= M();
            $datas=$model->query($sql);
            $this->ajaxReturn($datas);
        }

        public function getOrderByTime(){
            $time1=strtotime(I('post.time1'));
            $time2=strtotime(I('post.time2'));
            $sql="select a.*,b.name as user_name,c.name as goods_name from order as a ";
            $sql.=" left join user as b on a.user_id=b.id left join";
            $sql.=" goods as c on a.goods_id=c.id where b.created_time > $time1 and b.created < $time2";
            $model= M();
            $datas=$model->query($sql);
            $this->ajaxReturn($datas);
        }
   
}