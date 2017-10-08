<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if(IS_POST){
            $datas=I('post.');
  
            // 验证码验证
            $verify=new \Think\Verify();
            $res=$verify->check($datas['captcha']);
            if(!$res){
                $this->error("验证码错误");die;
            }

           //账号密码验证
            $admin=M('User');
            $arr=array('username'=>$datas['name'],'passwd'=>$datas['passwd']);
            $admin->where($arr);
            $res=$admin->find();
            if(empty($res)){
                $this->error("用户名或账号错误");die;
            }else{
                $this->success('登录成功',U('main/index'),1);die;
            }

        }else{
            $this->display(); 
        }  
    }

    public function verify(){
        ob_clean();
        $config =   array(
            'useCurve'  => false,          
            'useNoise'  => false, 
            'length'=>4,
            'fontSize'=>10,
            'imageH'     => 20,          
            'imageW'     => 80      
            );
            $verify=new \Think\Verify($config);
            $verify->entry();
    }


  
   
}