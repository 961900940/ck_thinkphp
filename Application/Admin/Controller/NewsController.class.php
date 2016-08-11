<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends CommonController {

	/**咨询首页列表**/
    public function index(){

		$Newscontent =  M('Content');
		$content = $Newscontent->where("id=2")->find();
		$this->assign('content',$content);
		$this->display();
    }

	public function addNews(){
		if(IS_POST){
			$data['content'] = htmlspecialchars_decode(I('content'));
			$data['updatetime'] = date('Y-m-d H:i:s',time());
			$Newscontent =  M('Content');
			$res = $Newscontent->add($data);
			if($res){
				$this->success('添加成功,即将跳转...', U('News/index'),3);
			}else{
				$this->error('添加失败，请重试...');
			}
		}else{
			$this->display();
		}
	}
}
