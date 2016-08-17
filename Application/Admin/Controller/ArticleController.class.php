<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class ArticleController extends CommonController {


	//内容管理列表
	public function index(){
		$Newscontent =  M('Content');
		$content = $Newscontent->where("id=3")->find();
		$content['content'] = ($content['content']);
		$this->assign('content',$content);
        $this->display();
    }

	public function addArticle(){
        if(IS_POST){
            $content = I("content");
    		$data['content'] = htmlspecialchars_decode($content);
    		$data['updatetime'] = date('Y-m-d H:i:s',time());
    		$Newscontent =  M('Content');
    		$res = $Newscontent->add($data);
    		if($res){
    			$this->success('添加成功,即将跳转...', U('Article/index'),3);
    		}else{
    			$this->error('添加失败，请重试...');
    		}
        }else{
            $this->display();
        }
    }
}
