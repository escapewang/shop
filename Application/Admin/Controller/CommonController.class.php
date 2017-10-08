<?php 
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    // public function __construct(){
    //     parent::__construct();
    //     $uname=session('uname');
    //     if(empty($uname)){
    //         $this->error('请登录',U('login/login'));
    //     }
    // }

    //TP框架给我们提供了一个_initialize函数，当生成对象时这个函数会自动触发
    //通常用来替代构造函数
    public function _initialize(){
        //首先判断后台用户登录
        $uname=session('uname');
        if(empty($uname)){
            $this->error('请登录',U('login/login'));die;
        }

        //判断后台用户权限
        $id=session('role_id');
        //根据该角色得到其权限，将getAccess封装到Model中
        $datas=D('Access')->getAccess($id);
        //将返回的数据将控制器和方法拼接起来

        foreach ($datas as  $val) {
            if(!empty($val['menu_action'])){
                $arr[]=strtolower($val['menu_controller'].$val['menu_action']);
            }
            
        }
        // dump($arr);die;

        //获得当前访问的控制器和方法名
        $ca=strtolower(CONTROLLER_NAME.ACTION_NAME);
        // dump($ca);
        // dump($arr);die;
        //判断是否拥有该控制器的访问权限和方法
        //设置了超级管理员为lianzi
        if(!in_array($ca,$arr) && session('uname')!='lianzi'){
            $this->error('你搞啥，没权限');die;
        }
       

    }

    //增删改查权限控制
    public function curd(){

         //获取所有的权限数据
        $accdatas=D('Access')->getAccess(session('role_id'));
         //获取当前控制器下的所有权限
        $condatas=M('Menu')->field('id')->where('menu_controller="'.CONTROLLER_NAME.'" and menu_action="index"')->find();

        $accdatas=getTree2($accdatas,$condatas['id']);
          foreach ($accdatas as  $val) {
             $action=$val['menu_action'];
             $acc[$action]=$val['menu_name'];
          }
          return $acc;
    }
    
}



 ?>