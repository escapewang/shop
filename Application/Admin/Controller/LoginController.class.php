<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if(IS_POST){
            $datas=I('post.');
            // var_dump($datas);die;
            //验证码验证
            // $verify=new \Think\Verify();
            // $res=$verify->check($datas['captcha']);
            // if(!$res){
            //     $this->error("验证码错误");die;
            // }

            //验证数据，注意防sql注入,where里面放数组参数默认有sql过滤效果
            $admin=M('Admin');
            $arr=array('username'=>$datas['admin_user'],'password'=>$datas['admin_psd']);
            $admin->where($arr);
            $res=$admin->find();
            if(empty($res)){
                $this->error("用户名或账号错误");die;
            }else{
                // dump($res);die;
                //设置session信息
                session('uname',$res['username']);
                //保存角色id
                session('role_id',$res['role_id']);

                $this->success($datas['admin_user'],U('index/index'),1);die;
                // $this->redirect('index/index',array(),1,'登录成功');
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


    public function logout(){
        session(null);
        if(!session('uname')){
            $this->success('退出成功',U('login/login'));
        }
    }

   
}