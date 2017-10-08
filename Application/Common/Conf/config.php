<?php
return array(
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀


    //自动加载副配置文件
    'LOAD_EXT_CONFIG'  =>'develop',
    //自动加载函数文件
    'LOAD_EXT_FILE'  =>'dicFunction',


//增加上传配置项，提高后期扩张性

    'GOODSUPLOAD_CONFIG'=>array(
             'rootPath'      => UPLOAD_PATH.'goods/',
             'exts'          =>  array('jpeg','png','gif','jpg'), 
             'maxSize'       => 4000000,
         ),

    'NEWSUPLOAD_CONFIG'=>array(
             'rootPath'      => UPLOAD_PATH.'news/',
             'exts'          =>  array('jpeg','png','gif','jpg'), 
             'maxSize'       =>  4000000,
         ),


     //验证码发送配置项
    'SEND_MSG'          => array(

//主帐号,对应开官网发者主账号下的 ACCOUNT SID
        'accountSid'   => '8aaf07085ea24877015ec2fb90ff0bce',

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        'accountToken' => '5657fb8216694d32a66c4ece7b22136f',

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        'appId'        => '8aaf07085ea24877015ec2fb91530bd4',

//请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        'serverIP'     => 'sandboxapp.cloopen.com',

//请求端口，生产环境和沙盒环境一致
        'serverPort'   => '8883',

//REST版本号，在官网文档REST介绍中获得。
        'softVersion'  => '2013-12-26',
    ),
);