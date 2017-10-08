<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
            if(IS_POST){
                $datas=I('post.');
                $name=$datas['username'];
                $pwd=$datas['password'];
                $res=M('User')->where(array('username'=>$name,'password'=>$pwd,'email_status'=>1))->find();
                // dump($res);die;
                if($res){
                    session('uname',$name);
                    session('uid',$res['id']);
                    //登录成功之后，我们需要将COOKIE数据保存到数据表中
                    if($cookiedata=cookie('cartdatas')){
                        $datas=unserialize($cookiedata);
                        $res=D('Carts')->loginAdd($datas);
                        if($res){
                            //销毁cookie数据
                            cookie('cartdatas',null);
                        }
                    }

                    $this->success('登录成功',U('index/index'));die;
                }else{
                    $this->error("登录失败，请重新登录");die;
                }

            }

            $this->display();
    }


    public function register(){
        if(IS_POST){
            $user=D('User');

            $datas=$user->create(); 

            if(!$datas){
            $this->error(D('User')->getError());
            }
            $phone_code=I('phone_code');
            //增加手机验证判断
            // if(session('phone_code')!=$phone_code || empty($phone_code)){
            //     $this->error('手机验证码不正确');die;
            // }


            $res=$user->add($datas);
            if($res){
                //注册成功之后还需要邮箱激活
                //生成随机邮箱验证码
                $code=md5(time().$res.rand(10000,90000));
                $aa=sendMail(I('email'),'注册邮箱激活',"尊敬的用户，
                    感谢你注册本网站，
                    点击下面的链接<a href='http://www.tp.com/home/login/checkMail/code/$code'>请点击我</a>激活账户，
                    感谢遇到你，让我爱了好多年");
                //邮箱验证发送成功
                if($aa){
                    //将数据插入到email表中
                    $email['uid']=$res;
                    $email['code']=$code;

                    M('EmailSend')->add($email);
                }

                $this->success('注册成功,请邮箱激活账号',U('login/login'));die;
            }
        }
        $this->display();
    }

    //验证码
    public function verify(){
        ob_clean();
        $ver=new \Think\Verify();
        $ver->entry();
    }


    //退出登录
    public function logout(){
        session(null);
        if(!session('uname')){
            $this->success('退出成功',U('login/login'),1);
        }
    }


     public function test(){
        sendMail('wz1131253913@163.com','nihao','我是真的爱你');
    }


    public function sendMess(){
        $phone=I('phone');
        //生成随机验证码
        $phone_code=rand(1000,10000);
        session('phone_code',$phone_code);
        //发送手机验证
        $res=sendTemplateSMS($phone,array($phone_code,'5'),'1');
        if($res['status']==1){
            $this->ajaxReturn(array('status'=>1,'msg'=>"发送成功"));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>"服务器错误"));
        }
    }


    public function checkMail(){
        $code=I('code');
        $res=M('EmailSend')->where(array('code'=>$code))->find();
        // dump($res);die;
        if($res){
            if($res['status']==1){
                $this->error('您的账号已生效，请不要重复激活');die;
            }
     
            //验证成功修改邮箱的状态
          $a= M('EmailSend')->where(array('uid'=>$res['uid'],'code'=>$code))->save(array('status'=>1));
          $b= M('User')->where('id='.$res['uid'])->save(array('email_status'=>1));
          // dump($b);
          // dump(M('User')->_sql());die;
          if($a && $b){
            $this->success('账户激活成功',U('login/login'));
            }else{
                $this->error('服务器繁忙，请稍后再试');
            }
           
        }else{
            $this->error('链接已失效');
        }
           
           
        
    }

}