<?php
namespace Admin\Controller;

class CategorysController extends CommonController {
    public function index(){
        $cate=D('Categorys');
        $total=$cate->where('cate_status=1')->count();
       
       //分页
       $page=new \Think\Page($total,3);
       $datas=$cate->limit($page->firstRow,$page->listRows)->where('cate_status=1')->select();

       $show=$page->show();

       $this->assign('datas',$datas);
       $this->assign('show',$show);
       $this->display();
    }

    public function add(){
        if(IS_POST){
                $cate=D('Categorys');
               $res= $cate->create();
               if(!$res){
                $this->error('数据不能为空',U('add'),1);
               }

               $res=$cate->add();
               if($res){
                $this->success('添加成功',U('index'),1);
               }

        }else{
                $cate=M('Categorys');
                $datas=$cate->where('cate_status=1')->select();

                // dump($datas);die;
                //使用分类树排序
                getTree($datas);
                $datas=$GLOBALS['tree'];

                $this->assign('datas',$datas);
                $this->display();
            }
        }


    // public function del(){
    //       $id=I('id');
    //     $cate=M('Categorys');
    //     $cate->cate_status=0;
    //    $res= $cate->where(array('id'=>$id))->save();
    //   if($res){
    //     $this->success("删除成功",U('index'),1);
    //   }
    // }

        //使用ajax删除分类数据
    public function ajaxDel(){
     
      $id=(int)$_GET['id'];
      // $id=8;
      $cate=D('Categorys');
      $data=$cate->alias('b')->where('cate_status=1')->find($id);
      // dump($data);
      // dump($data['status']);die;
      if($data['status']==1){

          $cate->cate_status=0;
         $cate->where("id=$id")->alias('b')->save();
      }
          
          $total=$cate->where('cate_status=1')->count();
          //生成分页对象
          $Page=new \Think\Page($total,3);
          $data['show']=$Page->show();
          $data['list'] = $cate->where('cate_status=1')->limit($Page->firstRow.','.$Page->listRows)->select();



      echo $this->ajaxReturn(array('status'=>$data['status'],
                                  'show'=>$data['show'],
                                  'list'=>$data['list'],
                              ));
    }
       
}