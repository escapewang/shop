<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;

class AccessController extends CommonController{
    public function index(){
        //获取所有的权限信息
        $menudatas=M('Menu')->select();
        $menudatas=list_to_tree($menudatas);
        // dump($menudatas);die;
        // dump($datas);die;

        //获取该角色信息
        $data=M('Role')->find(I('id'));

        //获取该角色的权限菜单值,生成一个一维数组
        $menu=M('Access')->where('role_id='.$data['id'])->field('menu_id')->select();
        foreach ($menu as  $value) {
          $checked[]=$value['menu_id'];
        }


        $this->assign('checked',$checked);
        $this->assign('menudatas',$menudatas);
        $this->assign('data',$data);
        $this->display();
    }

    public function add(){
      $datas=I('post.');
      // dump($datas);die;
      M('Access')->where('role_id='.$datas['role_id'])->delete();
      // dump($datas);die;
      foreach ($datas['menu_id'] as $key => $val) {
          $data[$key]['role_id']=$datas['role_id'];
          $data[$key]['menu_id']=$val;
      }
      $res=M('Access')->addAll($data);
      if($res){
        $this->success('操作成功',U('index',array('id'=>$datas['role_id'])));
      }else{
        $this->error('操作失败');
      }

    }



}





 ?>