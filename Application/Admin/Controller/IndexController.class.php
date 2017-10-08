<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
        $this->display();
    }

    public function left(){

        //这个时候根据role_id来获取权限信息，可以直接使用原生sql
        $sql="select b.* from shop_access as a left join shop_menu as b on a.menu_id=b.id";
        $sql.=" where b.is_show=1 and a.role_id=".session('role_id');
        $datas=M()->query($sql);
        // dump($datas);die;
       $datas=list_to_tree($datas);
       // dump($datas);die; 
        $this->assign('datas',$datas);
        $this->display();
    }

    public function head(){
        $this->display();
    }

    public function right(){
        $this->display();
    }
}