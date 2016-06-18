<?php
namespace Admin\Model;
use Think\Model;

/**
*   权限管理
*/
class AuthAccessModel extends Model{

    /**
    * 查询符合条件的 权限列表
    * @param    $sting 符合条件的 auth_id 列表
    * return    $sting
    */
    public function access_list($sting){
        $map['auth_id']  = array('in',$sting);
        $access_list = $this->where($map)->select();
        $role_auth_ac = '';
        foreach ($access_list as $key => $value) {
            if(!empty($value['auth_c']) && !empty($value['auth_a'])){
                $role_auth_ac .= $value['auth_c'].'-'.$value['auth_a'].',';
            }
        }
        $role_auth_ac = rtrim($role_auth_ac,',');
        return $role_auth_ac;
    }
}
