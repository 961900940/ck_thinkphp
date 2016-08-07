<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {

	/**首页**/
    public function index(){
		$this->display();
    }

	/**修改账号密码**/
	public function myInfo(){
		$this->display();
	}



	/**
	*空操作单独处理
	*/
	// public function _empty(){
    //     return $this->error('亲，您访问的页面不存在 :(');
    // }
}
