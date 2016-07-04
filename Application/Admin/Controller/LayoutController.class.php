<?php
namespace Admin\Controller;
use Think\Controller;
class LayoutController extends Controller {

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
	}
	public function index(){
		$this->display();
	}
}
