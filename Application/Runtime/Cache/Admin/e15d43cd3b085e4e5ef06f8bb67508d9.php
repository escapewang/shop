<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：角色管理-》权限列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('role/index');?>">【返回角色管理】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
        <form action="<?php echo U('add');?>" method="post" name='access'>
       
            <table id="menu_list" class="table_a" border="1" width="100%">
                <tbody>
                      <tr>
                        <td>当前角色：</td>
                         <td>
                           <strong><font color="green"><?php echo ($data["role_name"]); ?></font></strong>
                         </td>
                       
                    </tr>
                    <input type="hidden" name="role_id" value="<?php echo ($data["id"]); ?>"/>
                    <?php if(is_array($menudatas)): foreach($menudatas as $key=>$d): ?><tr >
                        <td><input  class="checkpart" data-id="<?php echo ($d["id"]); ?>" type="checkbox" name="menu_id[]" value="<?php echo ($d["id"]); ?>" <?php echo (getChecked2($d["id"],$checked)); ?>><?php echo ($d["menu_name"]); ?></td>

                         <td id="menu_<?php echo ($d["id"]); ?>">
                          
                            <?php if(is_array($d["_child"])): foreach($d["_child"] as $key=>$dd): ?><div style="width:800px;">
                                    <input  type="checkbox" name="menu_id[]" value="<?php echo ($dd["id"]); ?>" <?php echo (getChecked2($dd["id"],$checked)); ?> data-id="<?php echo ($dd["id"]); ?>" class="checkmodule"/><?php echo ($dd["menu_name"]); ?>
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                <span id="menu_<?php echo ($dd["id"]); ?>">
                                    <?php if(is_array($dd["_child"])): foreach($dd["_child"] as $key=>$ddd): ?><input  type="checkbox" name="menu_id[]" value="<?php echo ($ddd["id"]); ?>" <?php echo (getChecked2($ddd["id"],$checked)); ?> class="aaa"/><?php echo ($ddd["menu_name"]); endforeach; endif; ?>
                                </span>
                                </div><?php endforeach; endif; ?> 
                       
                         </td>
                       
                    </tr><?php endforeach; endif; ?>
                    
                  
               
                  
                    
                </tbody>
            </table>
            <table class="table_a" border="1" width="100%">
                <tbody>
                     <tr >
                        <td  style="text-align: center;"><input class="checkall" type="checkbox" /> 全选/反选</td>
                        <td>&nbsp <input type="submit" name="保存"/>
                         </td>
                       
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
        
    </body>
   
    <script type="text/javascript">
            $(function(){
                $('.checkpart').click(function(){
                    var id=$(this).attr('data-id');
                    $("#menu_"+id+" :input").attr('checked',$(this).is(':checked'));
                })

               


                $('.checkall').click(function(){
                    $(':input').attr('checked',$(this).is(":checked"))
                })

                $('.aaa').click(function(){
                    if($(this).parent().prev().children(':input').has(":checked")){
                        $(this).parent().prev().attr('checked',true)
                        $(this).parents('td').prev().find(':input').attr('checked',true);
                    }
                    
                    
                })
            })
    </script>
</html>
<script type="text/javascript">
          $('.checkmodule').click(function(){
                    var id=$(this).attr('data-id');
                    // alert(id)
                    $("#menu_"+id+" :input").attr('checked',$(this).is(':checked'));
                   if($(this).parents('td').children('.checkmodule').has(":checked")){
                        $(this).parents('td').prev().find(':input').attr('checked',true)
                   }
                })

</script>