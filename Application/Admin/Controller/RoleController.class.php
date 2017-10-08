<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;

class RoleController extends CommonController{
    public function index(){
        $datas=M('Role')->where('status=1')->select();
        $this->assign('datas',$datas);
        $this->display();
    }

    public function add(){
        if(IS_POST){
          
            $datas=I('post.');

           $res= M('Role')->add($datas);
           if($res){
                $this->success('添加成功',U('index'));die;
           }else{
                $this->error('添加失败');die;
           }
        }

        $this->display();
    }

    public function edit(){
        if(IS_POST){
            $datas=I('post.');
            // dump($datas);die;
           $res= M('Role')->save($datas);
           if($res){
                $this->success('修改成功',U('index'));die;
           }else{
                $this->error('修改失败');die;
           }
        }
        $data=M('Role')->find(I('id'));
        // dump($data);die;
        $this->assign('data',$data);
        $this->display();
    }


}





 ?>