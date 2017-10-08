<?php 
namespace Admin\Model;
use \Think\Model;
class AccessModel extends Model{
   
    public function getAccess($role_id){
        //根据角色id来查询菜单
       $sql="select b.* from shop_access as a left join shop_menu as b on a.menu_id=b.id";
       $sql.=" where  a.role_id=".$role_id;
       return $this->query($sql);

    }


}
 ?>