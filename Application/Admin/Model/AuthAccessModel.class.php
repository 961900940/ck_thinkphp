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

    /**
    * 查询当前 节点id的详细信息
    *  @param   $auth_id
    *  return array
    */
    public function auth_id_info($auth_id){
        $map['auth_id'] = $auth_id;
        $res = $this->where($map)->find();
        return $res;
    }

    //模块
    public function Prole_list(){
        return $this->where("auth_level = 0")->order("sort asc")->select();
    }

    //方法
    public function Srole_list(){
        return $this->where("auth_level != 0")->order("auth_id asc,sort asc")->select();
    }

    //节点编辑
    public function edit_node(){
        $where['auth_name'] = I("auth_name");
        $auth_ac = I("auth_ac");
        $where['status'] = intval(I("status"));
        $where['auth_level'] = intval(I('auth_level'));
        $map['auth_id'] = intval(I("auth_pid"));
        $where['sort'] = intval(I("sort"));
        $where['auth_id'] = intval(I("auth_id"));
        $auth_id_infos =$this->where($map)->find();
        var_dump(I());
        var_dump($auth_id_infos);exit;
    }
}
