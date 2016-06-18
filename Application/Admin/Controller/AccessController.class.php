<?php
namespace Admin\Controller;
use Think\Controller;
//权限管理模块
class AccessController extends CommonController {


    /*************************************************管理员管理***********************************/
    public function index(){
        $admin_list = D("Auth_admin")->admin_list();
        $this->assign('admin_list',$admin_list);
		$this->display();
    }
	//添加管理员
	public function addAdmin(){
        if(IS_POST){
            $res = D("Auth_admin")->add_admin();
            if($res){
                $this->success("添加成功,用户列表跳转中...",U("Access/index"),3);
            }else{
                $this->error("添加失败,请重试....");
            }
        }else {
            //所属用户组列表
            $role_list = D('Auth_role')->role_list();
            $this->assign('role_list',$role_list);
    		$this->display();
        }
	}

    //编辑管理员信息
	public function editAdmin(){
        if(IS_POST){
            $res = D("Auth_admin")->edit_admin();
            if($res){
                $this->success("更新成功,用户列表跳转中...",U("Access/index"),3);
            }else{
                $this->error("更新失败,请重试....");
            }
        }else{
            //当前用户的个人信息
            $admin_info = D("Auth_admin")->admin_info();
            $this->assign('admin_info',$admin_info);

            //所属用户组列表
            $role_list = D('Auth_role')->role_list();
            $this->assign('role_list',$role_list);
            $this->display();
        }
	}




	/*************************************************节点管理***********************************/
	public function nodeList(){
		$this->display();
	}

    //编辑节点
	public function editNode(){

	}

	//添加节点
	public function addNode(){
		$this->display();
	}


	/***********************************************角色管理************************************/
	public function roleList(){
        $role_list = D("Auth_role")->role_list(true);
        $this->assign('role_list',$role_list);
        $this->display();
	}

    //便捷开启禁用节点
	public function roleStatus(){
        $role_id = intval( I("id") );
        $status = intval( I("status") );
        if(!empty($role_id) ){
            $xdata = D("Auth_role")->role_status($status,$role_id);
        }else{
            $xdata['status'] ='failure';
            $xdata['data'] ='信息错误，请刷新重试~';
        }
        echo json_encode($xdata); exit;
	}

	//编辑角色
	public function editRole(){
        if(IS_POST){
            $res = D("Auth_role")->edit_role();
            if($res){
                $this->success("更新成功,角色列表跳转中...",U("Access/roleList"),3);
            }else{
                $this->error("更新失败，请重试...");
            }
        }else{
            $role_info = D("Auth_role")->role_info();
            $this->assign('role_info',$role_info);
            $this->display();
        }
	}

	//权限分配
	public function changeRole(){
        $role_id = intval(I("id"));
        if(IS_POST){
            if(empty(I('data'))){
                $this->error("请添加权限...");
            }
            $res = D("Auth_role")->change_role(I('data'),$role_id);
            if($res){
                $this->success("权限分配成功,权限列表跳转中...",U("Access/roleList"),3);
            }else{
                $this->error("权限分配失败，请重试...");
            }
        }else{
            // 核查、并查询当前用户组信息
            $role_info = D("Auth_role")->role_group_check($role_id);

            $this->assign("role_info_roleName",$role_info['role_name']);//角色名称
            $this->assign("role_id",$role_id);//角色id
            //获得当前角色的权限列表信息
            $role_auth_ids =explode(',', $role_info['role_auth_ids']);
            $role_auth_ids_list = '[';
            if (!empty($role_auth_ids)) {
                $role_auth_ids_list .='{"val":"0"},';
                foreach ($role_auth_ids as $key => $value) {
                    // $role_auth_ids_list .="{'val':'".$value."'},";
                    $role_auth_ids_list .='{"val":"'.$value.'"},';
                }
            }
            $role_auth_ids_list =rtrim($role_auth_ids_list,','). ']';
            $this->assign("role_auth_ids_list",$role_auth_ids_list);  //当前角色的权限
            
            //模块
            $Prole_list = M("Auth_access")->where("auth_level = 0")->order("sort asc")->select();
            $this->assign('Prole_list',$Prole_list);
            //方法
            $Srole_list = M("Auth_access")->where("auth_level != 0")->order("sort asc")->select();
            $this->assign('Srole_list',$Srole_list);

            $this->display();
        }
	}

    public function access_list_data($data){
        $arr = array();
        foreach ($data as $key => $value) {
            if ($value['auth_level'] == 0) {
                $arr[] = $value;
            }
        }
        // var_dump($arr);exit;
        foreach ($arr as $key => $value) {
            foreach ($data as $k => $v) {
                if($v['auth_pid'] == $value['auth_id']){
                    $arr[$key]['children'][] =$v;
                }
            }
        }
        var_dump($arr);exit;
    }

    //添加角色
	public function addRole(){
		$this->display();
	}
}
