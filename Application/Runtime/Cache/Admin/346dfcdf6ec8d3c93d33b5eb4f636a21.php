<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">

        <!-- 应入ue文件 -->
         <link href="/Public/Admin/ue/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
   
        <script type="text/javascript" src="/Public/Admin/ue/third-party/template.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/umeditor.min.js"></script>
        <script type="text/javascript" src="/Public/Admin/ue/lang/zh-cn/zh-cn.js"></script>
        <!-- 引入ue文件 -->
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_title" /><font color="red"> (*)</font></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="category_id">
                           
                            <option value="0">请选择</option>
                             <?php if(is_array($cadatas)): foreach($cadatas as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"> <?php echo str_repeat("&nbsp;",$val['level']*4); echo ($val["cate_name"]); ?></option><?php endforeach; endif; ?>
                        </select><font color="red"> (*)</font>
                    </td>
                </tr>
                   <tr>
                    <td>商品类型</td>
                    <td>
                        <select name="cate_id" id="cate_sel">
                           
                            <option value="0">请选择</option>
                             <?php if(is_array($cate)): foreach($cate as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["cate_name"]); ?>
                               </option><?php endforeach; endif; ?>
                        </select><font color="red"> (*)</font>
                    </td>
                </tr>
                 <tr>
                    <td>商品属性</td>
                    <td id="attr">
                        
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="brand_id">
                            
                            <option value="0">请选择</option>
                            <?php if(is_array($brdatas)): foreach($brdatas as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                        </select><font color="red"> (*)</font>
                    </td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" /><font color="red"> (*)</font></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="goods_image" /></td>
                </tr>
                 <tr>
                    <td>商品数量</td>
                    <td><input type="text" name="goods_count" /><font color="red"> (*)</font></td>
                </tr>
                <tr>
                    <td>商品排序</td>
                    <td><input type="text" name="goods_sort" /></td>
                </tr>
                <tr>
                    <!-- 这里我们使用ueeditor插件丰富化插入操作 -->
                    <td>商品详细描述</td>
                    <td> <script type="text/plain" id="myEditor" style="width:600px;height:240px;" name="goods_description"></script>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript">
     var um = UM.getEditor('myEditor');
     $('#cate_sel').change(function(){
           //获取选择的类型id
           var id=$(this).val();
           //发送ajax请求
           $.get('<?php echo U("Attribute/getAttribute");?>',{'id':id},function(data){
            //根据返回的数据组建dom

            var str="";
                for(var i=0;i<data.length;i++){
                    if(data[i].attr_type==2){
                     
                        str+="<p><a href='javascript:void(0)' class='add'>[+]</a>"+data[i].attr_name+" &nbsp;&nbsp;<select name='goods_attr_value["+data[i].id+"][]'>"
                        
                        var da=data[i].attr_value.split(',');
                        // console.log(da)
                            for(var j=0;j<da.length;j++){
                                str+="<option value='"+da[j]+"'>"+da[j]+"</option>"
                            }
                        str+="</select></p>"  
                        }else{
                            str+="<p><a href='javascript:void(0)' class='add'>[+]</a>"+data[i].attr_name+" &nbsp;&nbsp; <input type='text' name='goods_attr_value["+data[i].id+"][]'/></p>"
                       
                    }
                }
                // console.log(str)
                $('#attr').html(str);


           },'json')
     })
        //注意live函数只能在1.7.2版本下使用
        $('.add').live('click',function(){
            var add=$(this).parent('p').clone();
             //加完了之后要将加号改为减号
            add.find("a").remove();
            add.prepend("<a href='javascript:void(0)' class='del'>[-]</a>")

            add.insertAfter($(this).parent('p'));


        })

        $('.del').live('click',function(){
            $(this).parent('p').remove()
        })
</script>