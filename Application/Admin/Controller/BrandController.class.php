<?php
namespace Admin\Controller;

class BrandController extends CommonController {
    //页面显示
    public function index(){
         $brand=M('Brand');

         //获取权限
         $acc=$this->curd();
         // dump($acc);die;
    
        $data= $brand->select();
        $this->assign('acc',$acc);
        $this->assign('data',$data);
        $this->assign('data1',$data);
        $this->display();
    }

    //删除
    public function del(){
        $id=I('id');
         $brand=M('Brand');
         $res=$brand->delete($id);
          if($res){
                $this->redirect('index',array(),1,'删除成功');
            }
    }

    //添加
    public function add(){

        if(IS_POST){
            $brand=D('Brand');
            $res=$brand->create();
            if(!$res){
               // $brand->getError();
                $this->error('有误');
                die;
            }
            // var_dump($res);die;
            // var_dump($brand);die;
            // var_dump($info);
            // die;
            $res=$brand->add();
            if($res){
                $this->redirect('index',array(),1,'添加成功');
            }
        }else{
            $this->display();
        }
        
    }

    public function edit(){
        $brand=D('Brand');
        $id=I('get.id');
        if(IS_POST){
            // var_dump($_POST);
            // echo "<hr>";
            //也可以在表单里面直接加个隐藏域id,将整个post数据放进save即可
            // $data=I('post.');
            // var_dump($data);die;
            $brand->create();
            // var_dump($brand);die;
            $res=$brand->where("id=$id")->save();
            // var_dump($res);
             if($res){
                $this->redirect('index',array(),1,'修改成功');
            }
        }else{
             $data=$brand->find($id);
             $this->assign('data',$data);
             $this->display();
        }
    }

    public function search1(){
           // phpinfo();die;
            $id=I('id');
            $brand=M('Brand');
            $data=$brand->select($id);
            $data1=$brand->select();
            $this->assign('data',$data);
            $this->assign('data1',$data1);
            $this->display('index');              
    }
    //特殊表的操作
    public function special(){
        $cate=D('Cate');
        var_dump($cate->select());
    }

    //session练习
    public function ses(){
        session('name','wangzheng');

    }
    public function des(){
       echo  session('name',null);
    }

    public function coo(){
        cookie('username','小红');
        cookie('age',111);
    }

    public function showcoo(){

        cookie(null);

        // echo C(COOKIE_EXPIRE);
    }

    //其它方法对于字段映射的处理
        public function six(){
           
            $brand=D('Brand');
            var_dump($brand->find(7));//没有转换，是真实的数据库字段
        }

        public function seven(){
             // echo C('A');die;
            // aaa();die;
            // bbb();
            // getTree();
            //这种load方式只能加载当前模块下的函数
            // load('@/fun');
            // ccc();
            var_dump(session());
        }


        //常规验证码的输出
        public function test11(){
            $config =   array(
               // 验证码过期时间（s）
        'useZh'     => true,           // 使用中文验证码 

        
        );
            $verify=new \Think\Verify($config);
            $verify->entry();
        }
            
}