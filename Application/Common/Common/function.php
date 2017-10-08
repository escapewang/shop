<?php 
//防Xss攻击
function htmlXss($dirty){
    //vendor函数专门用于导入第三方类库,注意参数
    // 注意直接过滤js脚本，而不是将其转化为字符实体
    vendor('Xss.HTMLPurifier#auto');
    $config=HTMLPurifier_Config::createDefault();
    $a=new HTMLPurifier($config);
    // dump($a);
    $c=$a->purify($dirty);
    // dump($c);
}

//分类树
function getTree($categorys, $pid = 0, $level = 0)
    {
        foreach ($categorys as $category) {
            if ($category['pid'] == $pid) {
                //给$category变量增加一个键
                $category['level'] = $level;
                $GLOBALS['tree'][] = $category;
                //查找当前父级分类所有子级
                    getTree($categorys, $category['id'], $level + 1);
            }
        }

    }

//上传函数封装，但这种扩展性不够高，将配置信息放到配置文件中
function uploadFile1(){
     $config=array(
             'rootPath'      => UPLOAD_PATH,
             'exts'          =>  array('jpeg','png','gif','jpg'), 
             'maxSize'       =>  4000000,
         );
     //
     $upload=new \Think\Upload($config);
     $info=$upload->upload();
     if(!$info){
        return $upload->getError();
     }
     return $info;
}


//上传封装进化版
function uploadFile($type){
        $config=C($type);
     //
     $upload=new \Think\Upload($config);
     $info=$upload->upload();
     if(!$info){
        return $upload->getError();
     }
     return $info;
}

//切换上下架函数
function toggleStatus($val){
    $arr=array(
    '0'=>'删除',
    '1'=>'下架',
    '-1'=>'上架',
        );
    return $arr[$val];
}

//获取上下架信息
function getStatus($val){
    $arr=array(
    '0'=>'删除',
    '1'=>'上架',
    '-1'=>'下架',
        );
    return $arr[$val];
}

//修改时的默认选择
function xuanze($a,$b){
    if($a==$b){
        return "selected";
    }
}

//生成缩略图函数
function getThumb($openpath,$savepath){
    $thumb=new \Think\Image();
    $thumb->open($openpath);
   return $res=$thumb->thumb(60,60)->save($savepath);
}

/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent           = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

#递归方法实现无限极分类
function getTree2($list,$pid=0,$level=0) {
    static $tree = array();
    foreach($list as $row) {
        if($row['pid']==$pid) {
            $row['level'] = $level;
            $tree[] = $row;
            getTree2($list, $row['id'], $level + 1);
        }
    }
    return $tree;
}

function getColor($c){
    if($c==0){
        return "red";
    }
}

function roleStatus($r){
    if($r==1){
        return "<font color='green'>正常</font>";
    }elseif($r==0){
        return "<font color='red'>禁用</font>";
    }
}



function getChecked($r,$b){
    if($r==$b){
        return "selected";
    }
}

function getChecked2($r,$b){
    if(in_array($r,$b)){
        return "checked";
    }
}

function rolename($val){
    $arr=array(
        1=>'超级管理员',
        2=>'管理员',
        5=>'业务员',
        // 4=>'销售',
        );
    return $arr[$val];
}



/*发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */

function sendMail($to, $title, $content)
{

    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    vendor('PHPMailer.PHPMailerAutoload');
    //实例化PHPMailer核心类
    $mail = new PHPMailer();

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 0;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';

    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '王政';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = '1131253913@qq.com';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'oiipurwcehntgafj';

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = '1131253913@qq.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, '医生算啥');

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');

    //添加该邮件的主题
    $mail->Subject = $title;

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if ($status) {
        return true;
    } else {
        return false;
    }
}






//发送验证码 函数

/**
 * 发送模板短信
 * @param to 手机号码集合,用英文逗号分开
 * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 */
function sendTemplateSMS($to, $datas, $tempId)
{
    // 初始化REST SDK
    $config       = C('SEND_MSG');
    $accountSid   = $config['accountSid'];
    $accountToken = $config['accountToken'];
    $appId        = $config['appId'];
    $serverIP     = $config['serverIP'];
    $serverPort   = $config['serverPort'];
    $softVersion  = $config['softVersion'];
    //引入发送验证码的SDK
    vendor('sendmsg.CCPRestSmsSDK');
    $rest = new \REST($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
    if ($result == null) {

        return array('status' => 0, 'msg' => 'result error!');
    }
    if ($result->statusCode != 0) {

        return array('status' => 0, 'msg' => $result->statusMsg);
        //TODO 添加错误处理逻辑
    } else {
        return array('status' => 1, 'msg' => '发送成功!');
    }
}
 ?>


