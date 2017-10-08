<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
header('content-type:text/html;charset=utf-8');
// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

//网站根路径
define('WEB_PATH', str_replace('\\', '/', __DIR__));

//定义上传根目录
define('UPLOAD_PATH', WEB_PATH."/Public/Upload/");
// echo UPLOAD_PATH;die;

// 定义应用目录
define('APP_PATH','./Application/');

//绑定模块,一般用于初始化后台
// define('BIND_MODULE', 'Admin');

//关闭安全目录
define('DIR_SECURE_FILENAME', false);

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单