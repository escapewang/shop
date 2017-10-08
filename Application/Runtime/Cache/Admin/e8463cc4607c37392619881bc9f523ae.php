<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>分类管理</title>
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：分类管理-》分类列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加分类】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>分类名称</td>
                        <td>所属上级分类</td>
                        <td>品牌排序</td>
                      
                        <td align="center" colspan="2">操作</td>
                    </tr>

                    <?php if(is_array($datas)): foreach($datas as $key=>$val): ?><tr id="product1">
                        <td><?php echo ($val["id"]); ?></td>
                        <td><?php echo ($val["cate_name"]); ?></td>
                        <td><a href="#"><?php echo ($val["pid"]); ?></a></td>
                        <td><?php echo ($val["cate_sort"]); ?></td>
                        <td><a href="#">修改</a></td>
                 <td><a href="javascript::void(0)"  class="del" data-id="<?php echo ($val["id"]); ?>"
                    data-name="<?php echo ($val["cate_name"]); ?>">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                
      
                    <tr>
                        <td colspan="20" style="text-align: center;" id="showajax">
                            <?php echo ($show); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        // function shangchu(id,name){
        //     if(confirm("你确定要删除"+name+"么")){
        //         location.href="/Admin/Categorys/del/id/"+id;
        //     }
        // }
    </script>
    
    <script type="text/javascript">
        $(function(){
            $('.del').click(function(){

                var id=$(this).attr('data-id');
                var name=$(this).attr('data-name');
                var _this=$(this);
                if(confirm("请确定"+name+"分类下没有子级分类或商品")){
                    $.get('<?php echo U("ajaxDel");?>',{'id':id},function(data){
                        if(data.status==1){
                            // _this.parents('tr').remove();
                            location.href="<?php echo U('index');?>"  
                        }else{
                            alert("不能删除，请确定"+name+"分类下没有子级分类或商品");
                        }
                    },'json')
                }
                
            })
        })
    </script>

   
   
</html>