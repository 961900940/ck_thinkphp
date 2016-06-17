<?php
namespace Admin\Model;
use Think\Model;

/**
*   权限管理
*/
class AuthRoleModel extends Model{

    /**
    * 获取角色列表信息
    * @param    is_full     是否获取 包含超级用户 所有数据
    * return array
    */
    public function role_list($is_full= null){
        if($is_full){
            $role_list = $this->field("role_id,role_name,remark,status")->select();
        }else{
            $role_list = $this->field('role_id,role_name,remark,status')->where("status ='%s' and role_id !=1",array(1))->select();
        }
        return $role_list;
    }

    //便捷开启禁用节点
    public function role_status($status,$role_id){
        if($status ==0){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        $res = $this->where("role_id='%s'",array($role_id))->save($data);
        if($res){
            if($status == 0){   //去开启
                $xdata['status'] = 'success';
                $xdata['data'] = 1;
            }else{  //去禁用
                $xdata['status'] = 'success';
                $xdata['data'] = 0;
            }
        }else{
            $xdata['status'] ='failure';
            $xdata['data'] ='操作失败，请刷新重试~';
        }
        return $xdata;
    }

    //查询当前角色的 详细信息
    public function role_info(){
        $id = intval(I("id"));
        $role_info = $this->where("role_id = '%s'",array($id))->field("role_id,role_name,remark,status")->find();
        return $role_info;
    }

    //编辑当前角色信息
    public function edit_role(){
        $id = intval(I("id"));
        $data['status'] = intval(I("status"));
        $data['remark'] = I("remark");
        $data['role_name'] = I("role_name");
        $res = $this->where("role_id ='%s'",array($id))->save($data);
        return $res;
    }


    //层次显示权限列表
    // public function didui(){
    //     $Auth_access = M("Auth_access");
    //     $access_list = $Auth_access->select();
    //     // $access_list = $Auth_access->group("auth_path")->select();
    //     // $access_list_data = $this->access_list($access_list);   //递归。查询全部的权限分配信息
    //     $access_list_data = $this->access_list_data($access_list);
    // }
    //递归。查询全部的权限分配信息
    public function access_list($data,$parentid=0,$level = 0){
        static $arr = array();
        foreach ($data as $k => $v) {
            if ($v['auth_pid'] == $parentid ) {
                $v['level']=$level;
                $arr[] = $v;
                $this->access_list($data,$v['auth_id'],$v['auth_level']+1);
            }
        }
        return $arr;
    }

    /**
    * 核查、并查询当前用户组信息
    * @param    role_id     角色组id
    * return array
    */
    public function role_group_check($role_id){
        $role_info = $this->field("role_id,role_name")->where("role_id ='%s'",array($role_id))->find();
        if(!$role_info){
            $this->error("不存在该用户组", U('Access/roleList'));exit;
        }
        return $role_info;
    }

    /**
    * 给当前角色分配权限
    * @param    data     角色组id
    * return array
    */
    public function change_role($data){
        var_dump($data);
    }
}
