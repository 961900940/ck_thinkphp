<?php
namespace Admin\Controller;
use Think\Controller;
//内容管理模块
class SysDataController extends CommonController {


	//数据管理
	public function index(){
		$M = M();
        $tabs = $M->query('SHOW TABLE STATUS');
        $total = 0;
		/**
		*	Name表的名称
		*	Engine表的存储引擎
		*	Rows这个表的行数
		*	Create_time表第一次创建的时间
		*	Comment表的额外信息
		*	Index_length索引所消耗的硬盘空间,
		*	Data_length整个表包含的字节
		**/
        foreach ($tabs as $k => $v) {
            $tabs[$k]['size'] = byteFormat($v['data_length'] + $v['index_length']);
            $total+=$v['data_length'] + $v['index_length'];
        }
        $this->assign("list", $tabs);
        $this->assign("total", byteFormat($total));
        $this->assign("tables", count($tabs));
        $this->display();

    }

	//数据库备份
	public function backup(){
		if(!IS_POST){
			$this->error("访问出错！");
		}
		
		$tables = I("data");
		$Arrtable = array();
		$Arrtable = explode(',',$tables);

		$M = M();
		$time = time();
		$date = date('Y-m-d H:i:s',$time);
        function_exists('set_time_limit') && set_time_limit(0); //防止备份数据过程超时

        if (count($Arrtable) == 0 && !isset($_POST['data'])) {
            echo json_encode(array("status" => 0, "info" => "请先选择要备份的表"));exit;
        }

		$type = "管理员后台手动备份";
		
        $path = "./Database/" ;
		$file_name = "CUSTOM_" . date("Ymd") . "_" . randCode(5).".sql";
		$filename = $path.$file_name;
		if(!file_exists($path)){
			mkdir($path);
		}
		//var_dump($path);exit;
		$pre = "# -----------------------------------------------------------\n" .
               "# database backup files\n" .
               "# 日期:  {$date} \n" .
               "# Type: {$type}\n";

		//$bdTable = D("SysData")->bakupTable($Arrtable); //取得表结构信息
		$bdTable = $this->bakupTable($Arrtable); //取得表结构信息
		$pernum = 10000;
		foreach($Arrtable as $table){
			$tableInfo = $M->query("SHOW TABLE STATUS LIKE '{$table}'");
			$page = ceil($tableInfo[0]['rows'] / $pernum ) - 1;
			for($i=0;$i<=$page;$i++){
				$query = $M->query("SELECT * FROM {$table} LIMIT " . ($i * $pernum ) . ", $pernum ");
				//var_dump($query);exit;
				foreach($query as $key=>$value){
					$temSql = '';
					$count = count($value);
					foreach ($value as $v) {
                        if($count == 1){
							$temSql .= "'".$v."'";
						}else{
							$temSql .= " '".$v."',";
						}
                    }
					$temSql = rtrim(rtrim($temSql,','));
					$temSql = "INSERT INTO `{$table}` VALUES ({$temSql});";
					$arr[$table][$key] = $temSql;
				}
			}
		}

		foreach($arr as $key=>$value){
			foreach($Arrtable as $v){
				if($key == $v){
					$bdTable[$key][2] = $value;
				}
			}
		}
		unset($arr);
		unset($Arrtable);
		//var_dump($path);
		//var_dump($bdTable);exit;
		//表依次的相关数据数组  key[ 0  1  2 ]
		file_put_contents($filename, $pre."\n\n\n", FILE_APPEND);
		foreach($bdTable as $key=>$value){
			foreach($value as $k=>$v){
				if($k == 0){
					file_put_contents($filename, $v."\n", FILE_APPEND);
				}elseif($k ==1){
					file_put_contents($filename, $v.";\n", FILE_APPEND);
				}else{
					foreach($v as $k1=>$v2){
						file_put_contents($filename, $v2."\n", FILE_APPEND);
					}	
				}
			}
			file_put_contents($filename, "\n\n\n", FILE_APPEND);
		}
		unset($bdTable);
		$time = time()-$time;	
		echo json_encode(array("status" => 1, "info" => "成功备份所选数据库表结构和数据,  耗时：{$time} 秒", "url" => U('SysData/restore')));
	}
	
	public function bakupTable($table_list) {	

		$arr =array();
        if (!is_array($table_list) || empty($table_list)) {
            return false;
        }
        foreach ($table_list as $table) {
			$outPut = '';
            $outPut .="# 数据库表：{$table} 结构信息\n";
            $outPut .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $tmp = M()->query("SHOW CREATE TABLE {$table}");
			$arr[$table][0] = $outPut;
			$arr[$table][1] = $tmp[0]['create table'];
        }
        return $arr;
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

}
