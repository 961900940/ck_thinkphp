###导出excel表格
		1、ck_thinkphp\ThinkPHP\Library\Org\Util\PHPExcel添加PHPExcel导出类
		   ck_thinkphp\ThinkPHP\Library\Org\Util\PHPExcel.php  文件名修改为 PHPExcel.class.php
		2、控制器ck_thinkphp\Application\Admin\Controller\ArticleController.class.php  添加导出数据方法

		   注意：excel_header参数定义导出数据article 【key 和 excel表格title（自己命名）】 一一对应即可
				article 字段可全部


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


###导入excel数据
	//从excel导入数据
	public function import_excel(){
		header('Content-type:text/html;charset=utf-8');//php代码里面设置编码
		$filename="./Public/1.xls";
		
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Reader.Excel5");
		$reader=new \PHPExcel_Reader_Excel5();

		$PHPExcel = $reader->load($filename); // 载入excel文件
		$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumm = $sheet->getHighestColumn(); // 取得总列数
		 
		/** 循环读取每个单元格的数据 */
		for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
			for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
				$arr[$row][] = $sheet->getCell($column.$row)->getValue();
			}
		}
		var_dump($arr);exit;
	}

	结果：
		array (size=4)
		  1 => 
		    array (size=2)
		      0 => string '姓名' (length=6)
		      1 => string '成绩' (length=6)
		  2 => 
		    array (size=2)
		      0 => string '崔凯' (length=6)
		      1 => float 100
		  3 => 
		    array (size=2)
		      0 => string '王腾飞' (length=9)
		      1 => float 90
		  4 => 
		    array (size=2)
		      0 => string '陈亚丁' (length=9)
		      1 => float 80
	

	public function import_excel2(){
		header('Content-type:text/html;charset=utf-8');//php代码里面设置编码
		//要导入的xls文件，位于根目录下的Public文件夹
		$filename="./Public/1.xls";

		//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
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

	结果：
		array (size=4)
		  1 => 
		    array (size=2)
		      'A' => string '姓名' (length=6)
		      'B' => string '成绩' (length=6)
		  2 => 
		    array (size=2)
		      'A' => string '崔凯' (length=6)
		      'B' => float 100
		  3 => 
		    array (size=2)
		      'A' => string '王腾飞' (length=9)
		      'B' => float 90
		  4 => 
		    array (size=2)
		      'A' => string '陈亚丁' (length=9)
		      'B' => float 80
	
