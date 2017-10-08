<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;

class MenuController extends CommonController{
    public function index(){
         $datas=M('Menu')->select();
          $datas=getTree2($datas);
          // dump($datas);die;
        $this->assign('datas',$datas);
        $this->display();
    }

    public function add(){
          if(IS_POST){
            $datas=I('post.');

           $res= M('Menu')->add($datas);

           if($res){
                $this->success('添加成功',U('index'));die;
           }else{
                $this->error('添加失败');die;
           }
        }

         $datas=M('Menu')->select();

        $datas=getTree2($datas);
         
        $this->assign('datas',$datas);
        $this->display();
    }

    public function edit(){

      if(IS_POST){
        $data=I('post.');

        // 对数据进行判断，首先选择的不能是自己
        if($data['id']==$data['pid']){
          $this->error('父级分类不能是自己');die;
        }
        //第二不能修改成自己的子集分类
        //遍历自己的儿子
        $datas=M('Menu')->select();
        $datas=getTree2($datas,$data['id']);
        if(!empty($datas)){
          foreach ($datas as  $value) {
              if($value['id']==$data['pid']){
                $this->error('父级分类不能是自己的儿子');die;
              }
          }
        }
        // dump($datas);die;
        $res=M('Menu')->where("id=".$data['id'])->save($data);
        if($res){
          $this->success('修改成功',U('index'));die;
        }else{
          $this->error('修改失败');die;
        }

      }
      //得到该条权限信息的记录
        $data=M('Menu')->find(I('id'));

      //得到所有权限的信息记录
        $datas=M('Menu')->select();
        $datas=getTree2($datas);
        $this->assign('data',$data);
        $this->assign('datas',$datas);
        $this->display();
    }


}





 ?>