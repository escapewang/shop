<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>"><?php echo ($accdatas["add"]); ?></a>
                </span>
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>商品名称</td>
                         <td>分类</td>
                         <td>品牌</td>
                        <td>库存</td>
                        <td>价格</td>
                        <td>排序</td>
                        <td>缩略图</td>
                       
                        <td>创建时间</td>
                        <td>目前状态</td>
                        <td align="center" colspan="4">操作</td>
                    </tr>
                    <?php if(is_array($data)): foreach($data as $key=>$val): ?><tr id="product1">
                        <td><?php echo ($val["id"]); ?></td>
                        <!-- 注意U函数第二个参数不能写点语法 -->
                        <td><a href="<?php echo U('home/goods/detail',array('id'=>$val['id']));?>" target="_blank"><?php echo ($val["goods_title"]); ?></a></td>
                        <td><?php echo ($val["cate_name"]); ?></td>
                        <td><?php echo ($val["name"]); ?></td>
                        <td><?php echo ($val["goods_count"]); ?></td>
                       <!--  <td><img src="__ADMIN__/img/20121018-174034-58977.jpg" height="60" width="60"></td> 
                        <td><img src="__ADMIN__/img/20121018-174034-97960.jpg" height="40" width="40"></td> -->
                        <!-- <td><?php echo ($val["name"]); ?></td> -->
                        
                        <td><?php echo ($val["goods_price"]); ?></td> <td><?php echo ($val["goods_sort"]); ?></td> 
                        <td><img src="/Public/Upload/goods/<?php echo ($val["goods_thumb_img"]); ?>" ></td>
                        <td><?php echo (date('Y-m-d H:i:s',$val["created_time"])); ?></td>
                        <td><font color="red"><?php echo (getStatus($val["goods_status"])); ?></font></td>
                        
                        <td><a href="javascript:void(0)" class="status" data-id="<?php echo ($val['id']); ?>">
                            <?php if(!empty($accdatas['ajaxUD'])): echo (toggleStatus($val["goods_status"])); endif; ?></a></td>
                        <td><a href="<?php echo U('update',array('id'=>$val['id']));?>"><?php echo ($accdatas["update"]); ?></a></td>
                        <td><a href="javascript:;" onclick="shangchu(<?php echo ($val['id']); ?>,'<?php echo ($val['goods_title']); ?>')"><?php echo ($accdatas["del"]); ?></a></td>
                        <td><a href="<?php echo U('photos',array('id'=>$val['id']));?>"><?php echo ($accdatas["photos"]); ?></a></td>
                    </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($show); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<script type="text/javascript">
        function shangchu(id,name){
            if(confirm("你确定删除"+name+"么")){
                location.href="/Admin/Goods/del/id/"+id
            }
        }
</script>



<script type="text/javascript">
    $(function(){
        $('.status').click(function(){
            var _this= $(this);
            //注意这种获取id的方式，增加属性通过jq可以轻松得到id数据
            //注意第四个参数表示返回的数据格式，建议直接json，这样不用使用JSON.parse函数
            //注意在ajax函数的$this并不是当前调用对象.需要提前保存
           var id= $(this).attr('data-id');
           $.get('<?php echo U('ajaxUD');?>',{"id":id},function(data){
            // console.log(data);
                _this.parent().prev().html('<font color="red">'+data.nowStatus+'</font>')
                _this.html(data.toggleStatus)
           },'json')

        })
    })

</script>