<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <script src="/Public/layui/layui.js"></script>
    <style>
        #div{width:800px;margin-top: 100px}
    </style>
</head>
<body>
   <!--  <h1>请添加练习方式</h1> -->
    <div id="div" >
    <form class="layui-form" action="" method="post">
  <div class="layui-form-item">
    <label class="layui-form-label">收货人姓名</label>
    <div class="layui-input-block">
      <input type="text" name="uname" required  lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
    </div>
  </div>

   <div class="layui-form-item">
    <label class="layui-form-label">收货人地址</label>
    <div class="layui-input-block">
      <input type="text" name="address" required  lay-verify="required" placeholder="请输入地址" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">联系方式</label>
    <div class="layui-input-block">
      <input type="text" name="phone" required  lay-verify="required" placeholder="请输入联系方式" autocomplete="off" class="layui-input">
    </div>
  </div>

    <div class="layui-form-item">
    <label class="layui-form-label">是否设置为默认地址</label>
    <div class="layui-input-block">
      <input type="radio" name="is_default" value="1" title="是">
      <input type="radio" name="is_default" value="0" title="否" checked>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
    
    layui.use('form', function(){
  var form = layui.form;
  
});
</script>
</script>