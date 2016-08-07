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
        $auth_id = intval(I("auth_id"));         //当前节点id
        $auth_ac = I("auth_ac");                //控制器或方法名
        $auth_name = I("auth_name");           //显示名
        $auth_level = intval(I('auth_level'));      //层级
        $auth_pid= intval(I('auth_pid'));     //父节点
        $sort = intval(I("sort"));         //排序


        if($auth_level == 0){             //模块
            $where['auth_id'] = $auth_id;
            $where['auth_name'] = I("auth_name");
            $where['auth_pid'] = 0;
            $where['auth_c'] = ucfirst($auth_ac);     //控制器名 首字母大写
            $where['auth_a'] = '';
            $where['auth_path'] = $auth_id;
            $where['auth_level'] = 0;
            $where['sort'] = $sort;
            $where['is_display'] = 1;
        }else if ($auth_level == 1 ) {       //操作
            $Pauth_c = M("Auth_access")->field("auth_c")->where("auth_id =".$auth_pid)->find();

            $where['auth_id'] = $auth_id;
            $where['auth_name'] = $auth_name;
            $where['auth_pid'] = $auth_pid;
            $where['auth_c'] = ucfirst($Pauth_c['auth_c']);
            $where['auth_a'] = strtolower($auth_ac);
            $where['auth_path'] = $auth_pid.'-'.$auth_id;   //全路径 父节点id-当前节点id
            $where['auth_level'] = 1;
            $where['sort'] = $sort;
            $where['is_display'] = 1;
        }else{                            //右侧具体操作
            $Pauth_c = M("Auth_access")->field("auth_c")->where("auth_id =".$auth_pid)->find();

            $where['auth_id'] = $auth_id;
            $where['auth_name'] = $auth_name;
            $where['auth_pid'] = $auth_pid;
            $where['auth_c'] = ucfirst($Pauth_c['auth_c']);
            $where['auth_a'] = strtolower($auth_ac);
            $where['auth_path'] = $auth_pid.'-'.$auth_id;   //全路径 父节点id-当前节点id
            $where['auth_level'] = 2;
            $where['sort'] = $sort;
            $where['is_display'] = 0;
        }
        $res = $this->save($where);
        return $res;
    }

    //添加节点
    public function add_node(){
        $auth_id = intval(I("auth_id"));         //当前节点id
        $auth_ac = I("auth_ac");                //控制器或方法名
        $auth_name = I("auth_name");           //显示名
        $auth_level = intval(I('auth_level'));      //层级
        $auth_pid= intval(I('auth_pid'));     //父节点
        $sort = intval(I("sort"));         //排序

        if($auth_level == 0){             //模块
            $where['auth_name'] = I("auth_name");
            $where['auth_pid'] = 0;
            $where['auth_c'] = ucfirst($auth_ac);     //控制器名 首字母大写
            $where['auth_a'] = '';
            $where['auth_level'] = 0;
            $where['sort'] = $sort;
            $where['is_display'] = 1;
            $auth_id = $this->add($where);
            $res = false;
            if($auth_id){
                $where['auth_id'] =  $auth_id;
                $where['auth_path'] =  $auth_id;
                $res = $this->save($where);
            }
            return $res;
        }else if ($auth_level == 1 ) {       //操作
            $Pauth_c = M("Auth_access")->field("auth_c")->where("auth_id =".$auth_pid)->find();

            $where['auth_name'] = $auth_name;
            $where['auth_pid'] = $auth_pid;
            $where['auth_c'] = ucfirst($Pauth_c['auth_c']);
            $where['auth_a'] = strtolower($auth_ac);
            $where['auth_level'] = 1;
            $where['sort'] = $sort;
            $where['is_display'] = 1;
            $auth_id = $this->add($where);
            $res = false;
            if($auth_id){
                $where['auth_id'] =  $auth_id;
                $where['auth_path'] =  $auth_pid.'-'.$auth_id;
                $res = $this->save($where);
            }
            return $res;
        }else{                            //右侧具体操作
            $Pauth_c = M("Auth_access")->field("auth_c")->where("auth_id =".$auth_pid)->find();

            $where['auth_name'] = $auth_name;
            $where['auth_pid'] = $auth_pid;
            $where['auth_c'] = ucfirst($Pauth_c['auth_c']);
            $where['auth_a'] = strtolower($auth_ac);
            $where['auth_level'] = 2;
            $where['sort'] = $sort;
            $where['is_display'] = 0;
            $auth_id = $this->add($where);
            $res = false;
            if($auth_id){
                $where['auth_id'] =  $auth_id;
                $where['auth_path'] =  $auth_pid.'-'.$auth_id;
                $res = $this->save($where);
            }
            return $res;
        }
    }
}
