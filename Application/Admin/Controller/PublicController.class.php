<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

    /***登录首页***/
    public function index(){
        if(IS_POST){
            $username =  I("post.username");
            $pwd = I("post.pwd");
            $verify_code = I("post.verify_code");
            if(empty($username) || empty($pwd)){
                $this->error("用户名或密码不能为空!", U("Public/index"));
            }
            if(check_verify($verify_code) == false){
                $this->error("验证码错误!", U("Public/index"),3);
            }
            $Auth_admin = M('Auth_admin');
            $count = $Auth_admin -> where(" username='%s' ",array($username)) ->count();
            if($count >= 1){        //存在注册用户
                $userinfo = $Auth_admin ->where(" username='%s' ",array($username))->find();
                // var_dump($Auth_admin->getLastSql());
                // var_dump($userinfo);exit;
                if($userinfo['status'] == 0){
                    $this->error("您的账号已被禁用，请联系管理员!", U("Public/index"));
                }
                if($userinfo['pwd'] == md5( $pwd ) ){
                    cookie('loginmark',true,3600);//1800
                    session('my_info',$userinfo);
                    session('aid',$userinfo['aid']);

                    $this->success("登陆成功", U("Index/index"));
                }else{
                    $this->error("用户名或密码错误!", U("Public/index"));
                }
            }else{
                $this->error("该用户".$email."不存在!", U("Public/index"));
            }
        }else{
            $this->display("Public:login");
        }
    }

    //验证码
    public function verify_code(){
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 17;             // 验证码字体大小（像素） 默认为25
        $Verify->length   = 4;              // 验证码位数
        $Verify->useNoise = false;          // 是否添加杂点 默认为true
        $Verify->useImgBg = true;           // 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        $Verify->fontttf = '5.ttf';         // 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
        $Verify->codeSet = '0123456789';    // 设置验证码字符为纯数字
        $Verify->entry();
    }

    //退出
    public function loginOut(){
        setcookie("loginmark", NULL, time()-1, "/");
        if(!empty( $_SESSION['aid'])){
            $_SESSION = array(); //清除SESSION值.
            unset($_SESSION['aid']);
            unset($_SESSION['my_info']);
            session_destroy();
        }
        $this->redirect("Admin/Index/index");
    }


    /**
	*后台空操作处理
	*/
	public function _empty(){
        return $this->error('亲，您访问的页面不存在 :(');
    }
}
