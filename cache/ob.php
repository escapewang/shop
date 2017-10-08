<?php 
//开启缓冲
ob_start();
echo "111";
ob_flush();//刷新缓冲区并直接输出之前的内容
echo "222";
$content=ob_get_contents();//获取缓冲区的内容
ob_end_clean();
// header('content-type:text/html;charset=utf-8');
// echo $content;

 ?>