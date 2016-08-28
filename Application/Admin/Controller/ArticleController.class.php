<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class ArticleController extends CommonController {

	//内容管理列表
	public function index(){
        $where = ' a.cid=b.cid ';
		$page = $_GET['p'] ? $_GET['p'] : 1;

		if(IS_POST){
			$title = I("title");
			$cid = I("cid");
			$status = I("status");
			$is_hot = I("is_hot");
			$is_top = I("is_top");

			if($cid !='-1'){
				$where .= " and a.cid = $cid";
			}
			if($status !='-1'){
				$where .= " and status = $status";
			}
			if($is_top !='-1'){
				$where .= " and is_top = $is_top";
			}
			if($is_hot !='-1'){
				$where .= " and is_hot = $is_hot";
			}
			if($title !=''){
				$where .= " and title like '%".$title."%'";
			}

			$page = 1;
		}

		//搜索条件
		if(isset($cid) && $cid !='-1'){
			$this->assign('cid',$cid);
		}
		if(isset($status) && $status !='-1'){
			$this->assign('status',$status);
		}
		if(isset($is_top) && $is_top !='-1'){
			$this->assign('is_top',$is_top);
		}
		if(isset($is_hot) && $is_hot !='-1'){
			$this->assign('is_hot',$is_hot);
		}
		if(isset($title) && $title !=''){
			$this->assign('title',$title);
		}


        $Article_category = M('ArticleCategory')->select();
		$this->assign('Article_category',$Article_category);	//选择分类


		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		//$pagenum = 2;
		$pagenum = $_GET['pagenum'] ? $_GET['pagenum'] : 2;

		$article = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->order("update_time desc")
			->page($page,$pagenum)
			->select();
		//var_dump(M()->getLastSql());
		//var_dump($status);
		//var_dump($article);
		$this->assign('article',$article);	// 赋值数据集

		// 查询满足要求的总记录数
		$count = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->order("a.update_time desc")
			->count("a.id");
		//var_dump(M()->getLastSql());
		//var_dump($count);exit;
		//$Page = new \Think\Page($count,$pagenum);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page = new \Admin\Util\Page($count,$pagenum);// 实例化分页类
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出

		$this->assign('pagenum',$pagenum);
        $this->display();
    }

	//导出记录
	public function down_excel(){
		$where = ' a.cid=b.cid ';
		$article = M()->table(array('ks_content'=>'a','ks_article_category'=>'b'))
			->field('a.*,b.category_name')
			->where($where)
			->order("update_time desc")
			->select();
		//var_dump($article);exit;
		$excel_header = array('id'=>'id', 'title'=>'title','status'=>'状态','is_hot'=>'热门与否','category_name'=>'分类','content'=>'内容');
		$excel_name = "文章管理";
		$this->download_excel($article,$excel_header,$excel_name);
	}

	/**
     * 导出数据到excel表格(浏览器弹出选择要保存的路径)
     * @param array $data_list        数据
     * @param array $downloadexcel_title     title
     * @param string $file_name        文件名
     */
    public function download_excel($data_list,$downloadexcel_title,$file_name){
        header('Content-type:text/html;charset=utf-8');//php代码里面设置编码
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.IOFactory");

        $objPHPExcel = new \PHPExcel;
        //$sheetExcel = $objPHPExcel->getActiveSheet();//获得当前活动sheet的操作对象

        //var_dump($data_list);
        foreach($downloadexcel_title as $k=>$y){
				$fields[]=$k;
				$title_new[]=$y;
		}

		//var_dump($fields);
		//var_dump($title_new);exit;
		$col = 0;
        foreach ($title_new as $title_t) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $title_t); //excel第一行
            $col++;
        }

        $row = 2;
        foreach ($data_list as $data_k) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data_k[$field]);
                $col++;
            }
            $row++;
        }

        ob_end_clean();
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel;charset=utf-8;');
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $encoded_filename = urlencode($file_name);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        header('Content-Type: application/octet-stream');
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . date('Ymd') . '.xls"');
        } else if (preg_match("/Firefox/", $ua)) {
            header('Content-Disposition: attachment; filename*="utf8\'\'' . $file_name . date('Ymd') . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="' . $file_name . date('Ymd') . '.xls"');
        }
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;

    }

	//从excel导入数据
	public function import_excel(){
		header('Content-type:text/html;charset=utf-8');//php代码里面设置编码
		//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		//要导入的xls文件，位于根目录下的Public文件夹
		$filename="./Public/1.xls";
		//创建PHPExcel对象，注意，不能少了\
		$PHPExcel=new \PHPExcel();
		//如果excel文件后缀名为.xls，导入这个类
		import("Org.Util.PHPExcel.Reader.Excel5");
		//如果excel文件后缀名为.xlsx，导入这下类
		//import("Org.Util.PHPExcel.Reader.Excel2007");
		//$PHPReader=new \PHPExcel_Reader_Excel2007();

		$PHPReader=new \PHPExcel_Reader_Excel5();
		//载入文件
		$PHPExcel=$PHPReader->load($filename);
		//获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
		$currentSheet=$PHPExcel->getSheet(0);
		//获取总列数
		$allColumn=$currentSheet->getHighestColumn();
		//获取总行数
		$allRow=$currentSheet->getHighestRow();
		//循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
		for($currentRow=1;$currentRow<=$allRow;$currentRow++){
			//从哪列开始，A表示第一列
			for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
				//数据坐标
				$address=$currentColumn.$currentRow;
				//读取到的数据，保存到数组$arr中
				$arr[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
			}

		}
		var_dump($arr);
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
