<?php 
namespace Admin\Controller;


class AttributeController extends CommonController{
    public function index($id){
      $datas=D('Attribute')->alias('a')->where('cate_id='.$id)->select();
      // dump($datas);die;
      $this->assign('datas',$datas);
      $this->display();
    }

    public function add(){
      if(IS_POST){
        $data=I('post.');
        $res=M('Attribute')->add(I('post.'));
        if($res){
          $this->success('添加成功',U('index',array('id'=>$data['cate_id'])));die;
        }else{
          $this->error('添加失败');die;
        }

      }
      $this->assign('datas',M('Cate')->select());
      $this->display();
    }

    public function getAttribute($id){
        $datas=M('Attribute')->where('cate_id='.$id)->select();
        $this->ajaxReturn($datas);
    }


}





 ?>