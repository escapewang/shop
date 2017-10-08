<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function detail(){

        //生成静态页面
        // $url="http://www.tp.com/index.php?p=Home&c=Goods&a=showlist&brand_id=5";
        // $content=file_get_contents($url);
        // file_put_contents('./showlist.html', $content);
        // die;
        $id=(int)$_GET['id'];

        // die;
        // 生成真静态缓存
        if(file_exists('./html/goods_detail_'.$id.".html")){
            echo "我是缓存";
            return require './html/goods_detail_'.$id.".html";
        }

        //根据商品id得到属性信息,这里建议直接使用原生sql，很快
        $sql="select a.*,b.* from shop_goods_attr as a left join shop_attribute as b on a.attribute_id=b.id";
        $sql.=" where goods_id=".$id;
        $attrdatas=M()->query($sql);
        foreach ($attrdatas as $key=> $val) {
            if($attrdatas[$key]['attr_type']==2){
                 $attrdatas[$key]['goods_attr_value']= explode(',',$val['goods_attr_value']);
            }
         
        }
      
        // dump($attrdatas);die;


        //得到该商品的基本信息
        $goods=D('Goods');
        $data=$goods->find($id);

        //得到该商品的图片信息
        $imgs=M('GoodsImg');
        $imgdatas=$imgs->where("goods_id=$id")->select();

        // dump($data);die;
        $this->assign('data',$data);
        $this->assign('attrdatas',$attrdatas);
        $this->assign('imgdatas',$imgdatas);
        $content=$this->fetch();

        file_put_contents('./html/goods_detail_'.$id.".html",$content);
        // $ctime=fileatime('./html/goods_detail_'.$id.".html");
        // $ctime=fileatime("./showlist.html");

        // $exptime=$ctime+60;
        // dump($ctime);
        // dump($exptime);
        echo $content;
        // $this->display();
    }


    public function showlist(){

        // return require './showlist.html';
        // exit;

        $where=" goods_status=1 ";
        $brand_id=I('get.brand_id');
        $price=I('get.price');
        if(!empty($brand_id)){
            $where.=" and brand_id=".$brand_id;
        }

        if(!empty($price)){
            $arr=explode('-',$price);
            if(count($arr)==1){
                $where.=" and goods_price>".$arr[0];
            }else{
                $where.=" and goods_price between ".$arr[0]." and ".$arr[1];
            }
        }

        $total=M('Goods')->where($where)->count();
        $goods=M('Goods');
        //分页配置
        $page=new \Think\Page($total,8);
        $datas = $goods->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        // dump($datas);die;
        // 这里建议复杂的sql语句我们每次打印出来观察sql语句的具体执行情况
            dump($goods->_sql());
        $show=$page->show();


        //获取所有的品牌信息
        $brand=M('Brand')->where('brand_status=1')->select();

        // dump($brand_id);die;
        $this->assign('show',$show);
        $this->assign('brand_id',$brand_id);
        $this->assign('price',$price);
        $this->assign('brand',$brand);
        $this->assign('datas',$datas);
        $this->display();
    }
}