<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="YONGDA商城" />
        <meta name="Description" content="YONGDA商城" />
        
        <title>YONGDA商城 - Powered by YongDa</title>
        
        <link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css" />
       <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
       
    </head>
    <body class="index_body">
       
        <div class="block clearfix" style="position: relative; height: 98px;">
            <a href="#" name="top"><img class="logo" src="/Public/Home/images/logo.gif"></a>

            <div id="topNav" class="clearfix">
                <!-- 注意condition里面不能使用$think.session.uname -->
                <!--condition里面的条件要写$符号 -->
                <?php if(session('uname')): ?><div style="float: left;"> 
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        <font class="f4_b"><?php echo (session('uname')); ?></font>, 欢迎您回来！
                        <a href="#">用户中心</a>
                        <a href="<?php echo U('login/logout');?>">退出</a>

                    </font>
                    </div>
                <?php else: ?>
                    <div style="float: left;"> 
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        欢迎光临本店&nbsp;
                        <a href="<?php echo U('login/login');?>"> 登录</a>
                        <a href="<?php echo U('login/register');?>">注册</a>
                    </font>
                    </div><?php endif; ?>
                

                <div style="float: right;">
                    <a href="<?php echo U('Carts/index');?>">查看购物车</a>
                    |
                    <a href="#">选购中心</a>
                    |
                    <a href="#">标签云</a>
                    |
                    <a href="#">报价单</a>
                </div>
            </div>
            <div id="mainNav" class="clearfix">
                <a href="<?php echo U('index/index');?>" class="cur">首页<span></span></a>
                <a href="<?php echo U('goods/showlist');?>">GSM手机<span></span></a>
                <a href="#">双模手机<span></span></a>
                <a href="#">手机配件<span></span></a>
                <a href="#">优惠活动<span></span></a>
                <a href="#">留言板<span></span></a>
            </div>
        </div>

        <div class="header_bg">
            <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
            </div>  

            <form id="searchForm" method="get" action="#">
                <input name="keywords" id="keyword" type="text" />
                <input name="imageField" value=" " class="go" style="cursor: pointer; background: url('/Public/Home/images/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;" type="submit" />

            </form>
        </div>
        <div class="blank5"></div>
        <div class="header_bg_b">
            <div class="f_l" style="padding-left: 10px;">
                <img src="/Public/Home/images/biao6.gif" />
                    北京市区，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
            </div>
            <div class="f_r" style="padding-right: 10px;">
                <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 0 件商品，总计金额 ￥0.00元。</a></span>
                    <a href="#"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

            </div>
        </div>




        
        <!-- 引入jquery文件和验证文件 -->
        <script type="text/javascript" src="/Public/js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.validate.min.js"></script>

        <div class="block block1">  

            <div class="block box">
                <div class="blank"></div>
                <div id="ur_here">
                    当前位置: <a href="#">首页</a> <code>&gt;</code> 用户注册 
                </div>
            </div>
            <div class="blank"></div>


            <!--放入view具体内容-->

            <div class="block box">

                <div class="usBox">
                    <div class="usBox_2 clearfix">
                        <div class="logtitle3"></div>
                        <form id="checkform" action="/Home/login/register.html" method="post">                <table cellpadding="5" cellspacing="3" style="text-align:left; width:100%; border:0;">
                                <tbody>
                                    <tr>
                                        <td style="width:13%; text-align: right;"><label for="User_username" class="required">用户名 
                                        <span class="required">*</span></label>
                                        </td>

                                        <td style="width:87%;">
                                            <input class="inputBg" size="25" name="username" id="user_name" type="text" value="" />

                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <label for="User_password" class="required">密码 <span class="required">*</span></label>
                                        </td>

                                        <td>
                                            <input class="inputBg" size="25" name="password" id="password" type="password" value="" />         
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label for="User_password2">密码确认</label></td>
                                        <td>
                                            <input class="inputBg" size="25" name="password2" id="password2" type="password" />
                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="right"><label for="User_user_email">邮箱</label></td>
                                        <td>
                                            <input class="inputBg" size="25" name="email" id="email" type="text" value="" />    
                                        </td>
                                    </tr>
                                    <tr>

                                        <td align="right"><label for="User_user_qq">qq号码</label></td>
                                        <td>
                                            <input class="inputBg" size="25" name="qq" id="qq" type="text" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"><label for="User_user_tel">手机</label></td>
                                        <td>
                                            <input class="inputBg" size="25" name="phone" id="phone" type="text" value="" />
                                             <input type="button" value="点我获取验证码" 
                                             id="shouji">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td align="right">手机验证码</td>
                                        <td>
                                            <input class="inputBg" size="10" name="phone_code"  type="text" value="" />
                                           
                                        </td>
                                    </tr>
                                  
                                    <tr>

                                        <!--textArea($model,$attribute,$htmlOptions=array())-->
                                        <td align="right"><label for="User_user_introduce">验证码</label></td>
                                        <td>
                                        <input class="inputBg" size="25" name="captcha" id="captcha" type="text" value="" /><img src='<?php echo U("login/verify");?>' id="verify"/>
                                                                 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>

                                        <td align="left">
                                            <input name="Submit" value="" class="us_Submit_reg" type="submit" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>        </div>
                </div>
            </div>
            <!--放入view具体内容-->

        </div>

        <div class="blank"></div>
     <script type="text/javascript">
                verify.onclick=function(){
                    this.src="/Home/Login/verify/t/"+Math.random()
                }


                $(function(){
                    $('#checkform').validate({
                        rules:{
                            username:"required",
                            password:{
                                required:true,
                                number:true
                            },
                            password2:{
                                required:true,
                                equalTo:'#password'
                            }
                        },
                        messages:{
                            username:"用户名不能为空",
                            password:{
                                required:"密码不能为空",
                                number:"密码必须是数字"
                            },
                            password2:{
                                required:'重复密码不能为空',
                                equalTo:"密码不一致"
                            }
                        }
                    })
                })

                $('#shouji').click(function(){
                    var a=5;
                    $('#shouji').attr('disabled',true)
                    $('#shouji').val(a+'秒后重新获取验证码');
                    timer=setInterval(function(){
                        a--;
                        $('#shouji').val(a+'秒后重新获取验证码');
                        if(a<1){
                            clearInterval(timer)
                            $('#shouji').attr('disabled',false)
                            $('#shouji').val('获取验证码');
                        }
                      
                    },1000)

                    var phone=$('#phone').val();
                    $.get('<?php echo U("login/sendMess");?>',{"phone":phone},function(data){
                        console.log(data);
                    })
                // alert(11)
                })
     </script>




         <div class="block">
            <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="/Public/Home/images/di.jpg"></a>
            <div class="blank"></div>
        </div>
        <div class="block">
            <div class="box">
                <div class="helpTitBg" style="clear: both;">
                    <dl>
                        <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                        <dd><a href="#" title="售后流程">售后流程</a></dd>
                        <dd><a href="#" title="购物流程">购物流程</a></dd>
                        <dd><a href="#" title="订购方式">订购方式</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                        <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                        <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                        <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                        <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                        <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                        <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="会员中心">会员中心</a></dt>
                        <dd><a href="#" title="资金管理">资金管理</a></dd>
                        <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                        <dd><a href="#" title="我的订单">我的订单</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                        <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                        <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                        <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                        <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                        <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                        <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
                    </dl>
                </div>
            </div>


        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
            <div class="box_1">
                <div class="links clearfix"> 
                  

                    


                    [<a href="#" target="_blank" title="免费申请网店">免费申请网店</a>]
                    [<a href="#" target="_blank" title="免费开独立网店">免费开独立网店</a>]


                    [<a href="#" target="_blank" title="免费开独立网店">yongda商城</a>]
                </div>
            </div>
        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
            <div class="bNavList clearfix">
                <a href="#">免责条款</a>
                |
                <a href="#">隐私保护</a>
                |
                <a href="#">咨询热点</a>
                |
                <a href="#">联系我们</a>
                |
                <a href="#">Powered&nbsp;by&nbsp;<strong><span style="color: rgb(51, 102, 255);">YongDa</span></strong></a>
                |
                <a href="#">批发方案</a>
                |
                <a href="#">配送方式</a>

            </div>
        </div>

        <div id="footer">
            <div class="text">
                © 2005-2012 YONGDA 版权所有，并保留所有权利。<br />
            </div>
        </div>
    </body>
</html>