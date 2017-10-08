<?php 
namespace Common\Model;
use Think\Model;
class BaseModel extends Model{ 
    //开启批量检测
     protected $patchValidate    =   true;

     // $name 模型名，$F 目标字段 $pk查询主键
    public function getMessage($name,$f,$pk){
        $model=M($name);
        return $model->field($f)->find($pk);
    }
}




 ?>