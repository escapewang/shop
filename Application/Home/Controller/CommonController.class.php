<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    //防翻墙操作，对于订单提交，用户中心等来说，需要登录后才能操作
    public function __construct(){
        parent::__construct();
        if(!session('uid')){
            $this->error('请登录后操作',U('login/login'),1);
        }
    }
} 