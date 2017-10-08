<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="<?php echo C('CSS_URL');?>/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：产品中心-》品牌管理</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【<?php echo ($acc["add"]); ?>】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="/Admin/Brand/search1" method="post">
                    品牌<select name="id" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <?php if(is_array($data1)): foreach($data1 as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>品牌名称</td>
                        <td>排序</td>
                        <td align="center" colspan="2" style="text-align: center">操作</td>
                    </tr>

                    <?php if(is_array($data)): foreach($data as $key=>$val): ?><tr id="product1">
                        <td><?php echo ($val["id"]); ?></td>
                        <td><a href="#"><?php echo ($val["name"]); ?></a></td>
                        <td><?php echo ($val["sort"]); ?></td>
                        
                        <td><a href="<?php echo U('edit',array('id'=>$val[id]));?>"><?php echo ($acc["edit"]); ?></a></td>
                        <td><a href="javascript:void(0)" onclick="del(<?php echo ($val["id"]); ?>,'<?php echo ($val["name"]); ?>')"><?php echo ($acc["del"]); ?></a></td>
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
    <script type="text/javascript">
        function del(id,name){
            // alert('name')
            if(confirm("你确定删除"+name+"么")){
                location.href="/Admin/Brand/del/id/"+id;
            }
        }
    </script>
</html>