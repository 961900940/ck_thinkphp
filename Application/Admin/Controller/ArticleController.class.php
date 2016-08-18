<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class ArticleController extends CommonController {


	//内容管理列表
	public function index(){
		// $Newscontent =  M('Content');
        // $Article_category = M('ArticleCategory')->select();
        // $this->assign('Article_category',$Article_category);	//选择分类
        //
        // $article = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
        //     ->field('a.*,b.category_name')
        //     ->where('a.cid=b.cid')
        //     ->select();
        //
        // $this->assign('article',$article);
        // $this->display();

        $title = I("title");
        $cid = I("cid");
        $status = I("status");
        $is_hot = I("is_hot");
        $is_top = I("is_top");

        $where = ' a.cid=b.cid ';

        if($cid !=''){
            $where .= " and a.cid = $cid";
        }
        if($status !=''){
            $where .= " and status = $status";
        }
        if($is_top !=''){
            $where .= " and is_top = $is_top";
        }
        if($is_hot !=''){
            $where .= " and is_hot = $is_hot";
        }
        if($title !=''){
            $where .= " and title like '%".$title."%'";
        }


        $Article_category = M('ArticleCategory')->select();
		$this->assign('Article_category',$Article_category);	//选择分类

		$article = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->select();
		//var_dump(M()->getLastSql());

		$this->assign('article',$article);
        $this->assign("var",I());
        $this->display();

    }

    //编辑文章
    public function editArticle(){
        $id = I("id");
        $ArticleContent = M("Content");
        if(IS_POST){
            $data['id'] = $id;
            $data['title'] = I("title");
            $content = I("content");
    		$data['content'] = htmlspecialchars_decode($content);
			$data['status'] = I("status");
			$data['is_hot'] = I("is_hot");
			$data['is_top'] = I("is_top");
			$data['cid'] = I("cid");

    		$Article =  M('Content');
    		$res = $Article->save($data);
    		if($res){
    			$this->success('修改成功,即将跳转...', U('Article/index'),3);
    		}else{
    			$this->error('修改失败，请重试...');
    		}
        }else{
            $res = $ArticleContent->where("id = $id")->find();
            $this->assign("content",$res);                  //获得当前文章信息

            $Article_category = M('ArticleCategory')->select();
    		$this->assign('Article_category',$Article_category);	//选择分类

            $this->display();
        }
    }

    //删除文章
    public function delArticle(){
        $id = I("id");
        $ArticleContent = M("Content");
        $res = $ArticleContent->where("id = $id")->delete();
        if($res){
            $xdata['status'] = 'success';
        }else{
            $xdata['status'] = 'failure';
        }
        echo json_encode($xdata);exit;
    }

	//添加文章
	public function addArticle(){
        if(IS_POST){

			$data['title'] =I("title");
            $content = I("content");
    		$data['content'] = htmlspecialchars_decode($content);
			$data['status'] =I("status");
			$data['is_hot'] =I("is_hot");
			$data['is_top'] =I("is_top");
			$data['cid'] =I("cid");
    		$data['create_time'] = date('Y-m-d H:i:s',time());

    		$Article =  M('Content');
    		$res = $Article->add($data);
    		if($res){
    			$this->success('添加成功,即将跳转...', U('Article/index'),3);
    		}else{
    			$this->error('添加失败，请重试...');
    		}
        }else{
			$Article_category = M('ArticleCategory')->select();
			$this->assign('Article_category',$Article_category);
            $this->display();
        }
    }

	//文章title检测是否重复
	public function checkContentsTitle(){
		$data = array();
		$data['title'] = I('title');
		$Articletitle =  M('Content');
		$resTitle = $Articletitle ->where($data)->select();
		//var_dump($Articletitle->getLastSql());exit;
		if($resTitle){
			$xdata['status'] = 'failure';	//已存在,不可使用
		}else{
			$xdata['status'] = 'success';	//可以使用
		}
		echo json_encode($xdata);exit;

	}

	//文章分类管理
	public function category(){
		$ArticleCategory =  M('ArticleCategory');
		if(IS_POST){
			$act = I("act");			//添加 、修改 or 删除
			if($act == 'add'){
				$data['category_name'] = I("category_name");
				$data['create_time'] = date('Y-m-d H:i:s',time());
				$res = $ArticleCategory->add($data);
			}elseif($act == 'update'){
				$data['cid'] = I("cid");
				$data['category_name'] = I("category_name");
				$res = $ArticleCategory->save($data);
			}else{
				$cid = I("cid");
				$res = $ArticleCategory->where("cid = $cid")->delete();
			}

			if($res){
				$xdata['status'] = 'success';
			}else{
				$xdata['status'] = 'failure';
			}
			echo json_encode($xdata);exit;
        }else{
			$Article_category = $ArticleCategory->select();
			$this->assign('Article_category',$Article_category);
            $this->display();
        }
	}
}
