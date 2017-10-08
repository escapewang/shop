<?php 
$datas=filectime('b.php');
echo $datas;
echo "<hr>";
$datas=filectime('index.php');
// echo $datas;
echo time();
die;
echo date('Y-m-d H:i:s',$datas);


 ?>