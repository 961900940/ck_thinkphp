<?php
namespace Admin\Model;
use Think\Model;

class PublicModel extends Model{
    // protected $tableName = 'auth_admin'; //外部调用此 MODEL,但是不存在此表名时，需  先声明此表名
    
    // public function auth(){
    //     $Auth_admin = M('Auth_admin');
    //     $count = $Auth_admin -> where(" username='%s' ",array(I("post.username"))) ->count();
    //     if($count >= 1){        //存在注册用户
    //         $userinfo = $Auth_admin ->where(" username='%s' ",array(I("post.username")))->find();
    //         // var_dump($Auth_admin->getLastSql());
    //         // var_dump($userinfo);exit;
    //         if($userinfo['status'] == 0){
    //             $this->error("您的账号已被禁用，请联系管理员!", U("Public/index"));
    //         }
    //         if($userinfo['pwd'] == md5( I("post.pwd") ) ){
    //             $authInfo = Rbac::authenticate(array('username'=>$userinfo['username']));
    //             cookie('loginmark',true,1800);
    //             session('my_info',$userinfo);
    //             session('aid',$authInfo['aid']);
    //             Rbac::saveAccessList($authInfo['aid']);
                
    //             $this->success("登陆成功", U("Index/index"));
    //         }else{
    //             $this->error("用户名或密码错误!", U("Public/index"));
    //         }
    //     }else{
    //         $this->error("该用户".$email."不存在!", U("Public/index"));
    //     }
    }
}
