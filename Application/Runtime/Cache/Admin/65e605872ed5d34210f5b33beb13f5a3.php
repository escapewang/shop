<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>管理员列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：管理员管理-》管理员列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加管理员】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>管理员名称</td>
                        <td>角色</td>
                      
                        <td style="text-align: center;" colspan="4">操作</td>
                    </tr>

                    <?php if(is_array($datas)): foreach($datas as $key=>$val): ?><tr id="product1">
                        <td><?php echo ($val["id"]); ?></td>
                        <td><a href="#"><?php echo ($val["username"]); ?></a></td>
                      
                        <!-- <td><a href="<?php echo U('Access/index',array('id'=>$role_data[id]));?>">权限管理</a></td> -->
                        <td><?php echo (rolename($val["role_id"])); ?></td>
                        <td>权限管理</a></td>
                        <td><a>修改</a></td>
                        <td><a href="javascript:void(0);" onclick="del(1)" >删除</a></td>
                    </tr><?php endforeach; endif; ?>
                  
                  
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            [1]
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
   
   
</html>