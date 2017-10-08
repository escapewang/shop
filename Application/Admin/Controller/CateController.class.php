<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;

class CateController extends CommonController{
    public function index(){
      $this->assign('datas',M('Cate')->select());
      $this->display();
    }

    public function add(){
      if(IS_POST){
        $res=M('Cate')->add(I('post.'));
        if($res){
          $this->success('添加成功',U('index'));die;
        }else{
          $this->error('添加失败');die;
        }

      }
      $this->display();
    }
}





 ?>