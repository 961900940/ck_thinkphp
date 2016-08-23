###导出excel表格
		1、ck_thinkphp\ThinkPHP\Library\Org\Util\PHPExcel添加PHPExcel导出类
		   ck_thinkphp\ThinkPHP\Library\Org\Util\PHPExcel.php  文件名修改为 PHPExcel.class
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