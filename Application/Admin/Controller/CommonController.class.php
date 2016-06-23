<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	public $loginMarked;
	/**
      *----------------------------------------------------------
      * 1、初始化 ,继承本来的子类都会执行该方法  （可以作为   后台判断用户是否登录  的公用方法）
	  * 子类中 ,没有 _initialize 初始化，会自动调用父类的 初始化。
	  * 子类中，也有 _initialize 初始化时，需加上 parent::_initialize();才会调用 父类 _initialize； 否则会重写父类的初始化


	  *2、用构造函数 __construct , 因为本类也是继承Controller,所以本类在使用 __construct 时，需先 parent::__construct(),
	  *   子类在继承 CommonController时，构造函数体内 也需先加 parent::__construct(); 否则会报错;
      *----------------------------------------------------------
     */
	public function _initialize(){
		header("Content-Type:text/html; charset=utf-8");
		// 检查用户登录
		$this->checkLogin();
		//获取用户id
		$aid = session('aid');

		//当前请求操作
	    $now_ac = CONTROLLER_NAME."-".ACTION_NAME;
	    //过滤控制器和方法，避免用户非法请求
    	//通过角色获得用户可以访问的控制器和方法信息
		$table_prefix =	C("DB_PREFIX");
        // $sql ="select b.role_auth_ac from ".$table_prefix."auth_admin a join ".$table_prefix."auth_role b on a.role_id = b.role_id where a.aid=".$aid;
        // $auth_ac = M()->query($sql);
        // $auth_ac = $auth_ac[0]['role_auth_ac'];

        /*判断$now_ac是否在$auth_ac字符串里边有出现过
        strpos函数如果返回false是没有出现，返回0 1 2 3表示有出现
        超级管理员没有权限限制
        默认以下访问不需要访问限制   Index/index
        $allow_ac = array('Index-index');
        if(!in_array($now_ac,$allow_ac) && $_SESSION['aid'] !=1 && strpos($auth_ac,$now_ac) === false){
            $this -> error('没有权限访问',U("Index/index"));
        }*/

		// 根据用户aid,查询 角色id (role_id)
		$Auth_admin = M('Auth_admin');
		$userinfo = $Auth_admin ->where("aid='%s' ",array($aid))->find();
		$role_id = $userinfo['role_id'];
		//根据角色id,获取 权限列表ids的信息
		$Auth_role = M("Auth_role");
		if(!in_array($role_id,array('1','2'))){
			$auth_ids = $Auth_role ->field("role_auth_ids")->where("role_id='%s' ",array($role_id))->find();
			$auth_ids = $auth_ids['role_auth_ids'];
		}
		//根据$auth_ids查询全部拥有的权限信息
		//① 获得顶级权限
		/*$sql = "select * from ".$table_prefix."auth_access where auth_level=0 ";
		if($role_id != 0){
			$sql .= " and auth_id in ($auth_ids)";
		}
		$res = M()->query($sql);*/
		//② 获得次顶级权限
		$sql = "select * from ".$table_prefix."auth_access where auth_c='".CONTROLLER_NAME."' and auth_level !=0 ";
		if(!in_array($role_id,array('1','2'))){
			$sql .= " and auth_id in ($auth_ids)";
		}
		$res = M()->query($sql);
		$auth_list =array();
		foreach ($res as $key => $value) {
			$auth_list[$key] = $value['auth_c'].'-'.$value['auth_a'];
		}

		array_push($auth_list,'Index-index');		//默认允许访问,无需进行权限认证
		//访问权限认证
		if(!in_array($now_ac,$auth_list)){
			// $this -> error('没有权限访问',U("Index/index"));
			$this->error('没有权限访问',$_SERVER["HTTP_REFERER"]);exit;
		}

		//顶部导航菜单

		//左侧子菜单
		$Auth_access = M('Auth_access');
		$MenuItem = $Auth_access ->where("auth_c='%s' and auth_level ='%s' and is_display=1",array(CONTROLLER_NAME,1))->order("sort asc")->select();	//二级菜单所有列表
		$this->assign('MenuItem',$MenuItem);

	    $this->assign('controller_name',CONTROLLER_NAME);
	}

	//检查用户是否登录
	public function checkLogin() {
		if(empty( session('aid') )){
			$this->redirect('Public/index');
			//redirect('Public/index', 3, '登录已超时，请重新登录,页面跳转中...');
			$this->error('请重新登录,页面跳转中...', U('Public/index'),3);exit;
		}else{
			if( empty(cookie('loginmark')) ){
				$_SESSION = array(); //清除SESSION值.
				unset($_SESSION['aid']);
	            unset($_SESSION['my_info']);
	            session_destroy();
				$this->error('登录已超时,请重新登录,页面跳转中...', U('Public/index'),3);exit;
			}

			$admin_info = M('Auth_admin')->field("status")->where("aid = '%s'",array(session('aid')))->find();
			if($admin_info['status'] == 0){		//用户是否已被禁用
				session(null);
				$this->error('用户权限已更改,请重新登录,页面跳转中...', U('Public/index'),3);exit;
			}

			return TRUE;
		}
    }


	/**
	*后台空操作    公共处理
	*/
	public function _empty(){
        return $this->error('亲，您访问的页面不存在 :(');
    }
}
