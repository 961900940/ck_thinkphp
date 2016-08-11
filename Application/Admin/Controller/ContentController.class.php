<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class ContentController extends CommonController {


	//内容管理列表
    public function index(){
        $Newscontent =  M('Content');
		$content = $Newscontent->where("id=1")->find();
		$this->assign('content',$content);
		$this->display();
    }

	//内容添加
	public function addContent(){
		if(IS_POST){
            $data['content'] = htmlspecialchars_decode(I('editor'));
			$data['updatetime'] = date('Y-m-d H:i:s',time());
			$Newscontent =  M('Content');
			$res = $Newscontent->add($data);
			if($res){
				$this->success('添加成功,即将跳转...', U('Content/index'),3);
			}else{
				$this->error('添加失败，请重试...');
			}
		}else{
			$this->display();
		}
    }

}
