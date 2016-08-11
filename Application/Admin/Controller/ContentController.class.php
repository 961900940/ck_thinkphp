<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class ContentController extends CommonController {


	//内容管理列表
    public function index(){
		$this->display();
    }
	
	//内容添加
	public function addContent(){
		if(IS_POST){
			var_dump($_POST);
		}else{
			$this->display();
		}
    }
	
}
