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
        $where['auth_id'] = intval(I("auth_id"));            //当前节点id
        $where['auth_name'] = I("auth_name");                //显示名称
        $where['auth_level'] = intval(I('auth_level'));      //层级
        $where['sort'] = intval(I("sort"));         //排序
        //$where['status'] = intval(I("status"));     //是否启用

        $auth_pid = intval(I("auth_pid"));
        var_dump($auth_pid);

        if($auth_level == -1){
            var_dump($auth_pid);exit;
        }else if ($auth_level==0) {       //父节点
            $where['auth_pid'] = 0;
            $where['auth_c'] = ucfirst(I("auth_ac"));         //控制器名 首字母大写
            $where['auth_a'] = '';
            $where['auth_path'] = intval(I("auth_id"));
            $where['is_display'] = 1;
        }else{
            $map['auth_id'] = $auth_pid;
            $auth_id_infos = M("Auth_access")->where($map)->find(); //如果不是一级节点，则查找当前节点的父节点
            var_dump($auth_id_infos);
            var_dump(M("Auth_access")->getLastSql());exit;
            // exit;
            $where['auth_pid'] = $auth_id_infos['auth_id'];
            $where['auth_c'] = $auth_id_infos['auth_c'];
            $where['auth_a'] = I("auth_ac");
            $where['auth_path'] =$auth_pid.'-'.intval(I("auth_id"));     //全路径 父节点id-当前节点id
            if ($auth_level==1) {
                $where['is_display'] = 1;
            }else{
                $where['is_display'] = 0;
            }
        }
        $res = $this->save($where);
        return $res;
    }
}
