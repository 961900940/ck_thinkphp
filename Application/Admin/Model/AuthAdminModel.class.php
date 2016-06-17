<?php
namespace Admin\Model;
use Think\Model;

/**
*   权限管理
*/
class AuthAdminModel extends Model{

    //后台用户列表
    public function admin_list(){
        $admin_list = $this->field("aid,username,status,remark,create_time")->select();
        return $admin_list;
    }

    /**
    * 查询当前用户的所有信息
    */
    public function admin_info(){
        $table_prefix =	C("DB_PREFIX");
        $aid =  I("get.aid",'','int');
        if (empty($aid)) {          //容错
            $this->error("该用户不存在...",U('Access/index'),3);
        }
        // $admin_list =$Auth_admin ->join('left join '.$table_prefix.'auth_role on '.$table_prefix.'auth_role.role_id = '.$table_prefix.'auth_admin.role_id')
        // ->where($table_prefix.'auth_admin.aid ='.$aid)
        // ->find();
        $admin_info = $this->field("aid,username,role_id,status,remark")->where("aid =".$aid)->find();
        return $admin_info;
    }

    //添加管理员
    public function add_admin(){
        $data['username'] =  I('username');
        $data['pwd'] = md5(I('pwd'));
        $data['status'] = intval(I('status'));
        $data['role_id'] = intval(I('role_id'));
        $data['remark'] = I('remark');
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $data['loginip'] = getIP();
        $res = $this->data($data)->add();
        return $res;
    }

    //编辑管理员
    public function edit_admin(){
        $data['status'] = intval(  I("status") );
        $data['role_id'] = intval( I('role_id'));
        $aid = intval(I('aid'));
        $data['remark'] = I('remark');
        $res = $this ->where("aid = $aid")->save($data);
        return $res;
    }

}
