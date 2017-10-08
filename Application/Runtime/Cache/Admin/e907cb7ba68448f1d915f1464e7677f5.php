<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>相册列表</title>
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />

    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：相册管理-》<font color="red"><strong><?php echo ($data["goods_title"]); ?></strong></font>的相册列表</span>
              
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>大图</td>
                        <td>缩略图</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($imgs)): foreach($imgs as $key=>$val): ?><tr >
                        <td><?php echo ($val["id"]); ?></td>
                        <td><img src="/Public/Upload/goods/<?php echo ($val["big_img"]); ?>" height="60" width="60"></td>
                        <td><img src="/Public/Upload/goods/<?php echo ($val["thumb_img"]); ?>" height="40" width="40"></td>
                   
                        <td><a href="javascript:;" class="delimg"  data-id="<?php echo ($val["id"]); ?>">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
         <form action="/Admin/Goods/photos/id/1.html" method="post" enctype="multipart/form-data" >
         <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                    <!-- <input type="hidden"  value="<?php echo ($data["id"]); ?>" name="id"/> -->
                    <tr style="font-weight: bold;">
                        <td>选择图片<a href="javascript:void(0);" id='add'>[+]</a></td>
                       
                    </tr>
                  <tbody id="img_files">
                    <tr>
                        <td><input type="file" name='image[]'/></td>
                    </tr>
                </tbody>

            </table>
             <input type="submit" value="确认保存" >
         </div>
         </form>
    </body>
</html>
<script type="text/javascript">
    $(function(){
        //增加文件上传数量
       $('#add').click(function(){
            var str="<tr><td> <strong><a href='javascript:void' class='dis'>[-]</a></strong> <input type='file' name='image[]'/></td></tr>";
            $("#img_files").append(str);
       })

       //动态绑定
      $('.dis').live('click',function(){
           $(this).parents('tr').remove();
      })

      //ajax删除图片
      $('.delimg').click(function(){
        var _this=$(this);
        var id=$(this).attr('data-id');
        $.get('<?php echo U("ajaxDel");?>',{'id':id},function(data){
                if(data.status==1){
                    _this.parents('tr').remove();
                }
        },'json')
      })


    })
</script>