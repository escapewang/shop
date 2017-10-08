<?php 
//获取属性值的类型
function getAttr($id){
    if($id==1){
        return "手动输入";
    }elseif($id==2){
        return '下拉列表';
    }
}

//获取属性值的类型
function getInsertAttr($id){
    if($id==1){
        return "手工录入";
    }elseif($id==2){
        return '列表选择';
    }
}

function priceSearch(){
    $arr=array(
        '0-500'=>'0元-500元',
        '500-1000'=>'500元-1000元',
        '1000'=>'1000元以上',
        );
    return $arr;
}


function getMoney($a,$b){
    return $a*$b;
}
 ?>