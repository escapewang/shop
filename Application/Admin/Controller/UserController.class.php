<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class UserController extends CommonController {
    public function index(){

        //显示所有的管理员信息
        $datas=M('Admin')->where('status=1')->select();
        // dump($datas);die;
        $this->assign('datas',$datas);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $res=M('Admin')->add(I('post.'));
            if($res){
                $this->success('添加成功',U('index'));die;
            }else{
                $this->error('添加失败');die;
            }
        }

        //显示角色列表
        $roles=M('Role')->where('status=1')->select();
        // dump($roles);die;
        $this->assign('roles',$roles);
        $this->display();
    }




    public function test(){
        $gn="三";
        $where['goods_title'] = array('like', "%$gn%"); 
        $where['goods_price'] = array('between', array(2000, 3000));
            $datas=M('Goods')->where($where)->select();
            dump($datas);
    }


    public function test2(){
        $datas=D('Brand')->getMessage();
        dump($datas);
    }
  
}