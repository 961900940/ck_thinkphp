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
		$count_table = count($Arrtable);

		$M = M();
		$time = $t1 = microtime(true);
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
               "# Type: {$type}\n" .
			   "# Description:当前SQL文件包含了表：{$tables}共{$count_table}个表的数据\n";

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
		$time = $t2 = microtime(true);
		$time = round($t2-$t1,3);
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
	
	
	
	
	//数据库导入
	public function restore(){
		$data = $this->getSqlFilesList();
		$this->assign("list", $data['list']);
        $this->assign("total", $data['size']);
        $this->assign("files", count($data['list']));
		$this->display();
	}
	
	/**
     * 功能：读取已经备份SQL文件列表，并按备份时间倒序，名称升序排列
     * @return array
     */
    public function getSqlFilesList() {
		$path = "./Database/" ;
        $list = array();
        $size = 0;
        $handle = opendir($path);

        while ($file = readdir($handle)) {
            if (preg_match('#\.sql$#i', $file)) {
                $fp = fopen($path . "/$file", 'rb');
                $bakinfo = fread($fp, 2000);
				
                fclose($fp);
                $detail = explode("\n", $bakinfo);
                $bk = array();
                $bk['name'] = $file;
                $bk['time'] = substr($detail[2], 11);
                $bk['type'] = substr($detail[3], 8);		//文件内容创建时间
				$bk['description'] = substr($detail[4], 14);
                $_size = filesize($path . "/$file");
                $bk['size'] = byteFormat($_size);
                $size+=$_size;
                $bk['pre'] = substr($file, 0, strrpos($file, '_'));
                $bk['num'] = substr($file, strrpos($file, '_') + 1, strrpos($file, '.') - 1 - strrpos($file, '_'));
                $mtime = filemtime($path . "/$file");
                $list[$mtime][$file] = $bk;
            }
        }
        closedir($handle);
        krsort($list); //按备份时间倒序排列
        $newArr = array();
        foreach ($list as $k => $array) {
            ksort($array); //按备份文件名称顺序排列
            foreach ($array as $arr) {
                $newArr[] = $arr;
            }
        }
        unset($list);
        return array("list" => $newArr, "size" => byteFormat($size));
    }
	
	
	/*
	* 邮件发送类
	* 支持发送纯文本邮件和HTML格式的邮件，可以多收件人，多抄送，多秘密抄送，带附件(单个或多个附件),支持到服务器的ssl连接
	* 需要的php扩展：sockets、Fileinfo和openssl。
	* 编码格式是UTF-8，传输编码格式是base64
	* @example
	* $mail = new MySendMail();
	* $mail->setServer("smtp@126.com", "XXXXX@126.com", "XXXXX"); //设置smtp服务器，普通连接方式
	* $mail->setServer("smtp.gmail.com", "XXXXX@gmail.com", "XXXXX", 465, true); //设置smtp服务器，到服务器的SSL连接
	* $mail->setFrom("XXXXX"); //设置发件人
	* $mail->setReceiver("XXXXX"); //设置收件人，多个收件人，调用多次
	* $mail->setCc("XXXX"); //设置抄送，多个抄送，调用多次
	* $mail->setBcc("XXXXX"); //设置秘密抄送，多个秘密抄送，调用多次
	* $mail->addAttachment( array("XXXX","xxxxx") ); //添加附件，多个附件，可调用多次，第一个文件名是 程序要去抓的文件名，第二个文件名是显示在邮件中的文件名。
	* $mail->setMail("test", "<b>test</b>"); //设置邮件主题、内容
	* $mail->sendMail(); //发送
	*/
	//http://blog.csdn.net/u010081689/article/details/49334315
	//结合QQ邮箱发送邮件
	public function sendSql(){
		header("content-type:text/html;charset=utf-8"); 
		/*
		添加附件如果报错：
		那是因为（set_magic_quotes_runtime()）已经关闭。并且在PHP6中已经完全移除此特性。
		你可以注释或者删除掉出错的行，或者是在set_magic_quotes_runtime()前面加@符号
		或者是配置;error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECATED
		*/
		ini_set("magic_quotes_runtime",0); 
		Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new \PHPMailer; //实例化
		
		try {
			$mail->IsSMTP(); 						// 启用SMTP
			$mail->Host="smtp.qq.com";  			//smtp服务器的名称smtp.163.com|smtp.qq.com|smtp.exmail.qq.com
			$mail->SMTPAuth = true; 				//启用smtp认证
			$mail->Username = '505704504@qq.com';   //你的邮箱名
			$mail->Password = 'vwendrowtiddbggf' ;  //qq邮箱的话要开启smtp，开启的时候会返回一个客户端授权码，密码那里就用这个授权码来验证
			$mail->Port = '465'; 					//端口465
			$mail->SMTPSecure = 'ssl'; 				//非SSL协议端口号tls: 25 | SSL协议端口:	465
			
			$mail->From = '505704504@qq.com'; //发件人地址（也就是你的邮箱地址）
			$mail->FromName = '505704504@qq.com'; //发件人姓名
			$address = array("961900940@qq.com","3399351991@qq.com");
			// 添加收件人地址，可以多次使用来添加多个收件人
			if(is_array($address)){
				foreach($address as $addressv){
					$mail->AddAddress($addressv);
				}
			}else{
				$mail->AddAddress($address);
			}
			$mail->AddReplyTo("505704504@qq.com","ck");//回复地址 
			$mail->addAttachment('./Database/CUSTOM_20160826_KQGkt.sql');	//附件内容
			
			$mail->WordWrap = 50; 					// 设置每行字符串的长度
			$mail->IsHTML(true); 					// 是否HTML格式邮件
			$mail->CharSet ='UTF-8'; 				//设置邮件编码
			$mail->Subject = '邮件主题'; 			//邮件主题
			$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
			
			$res = $mail->Send();
			echo '邮件已发送'; 
		} catch (phpmailerException $e) { 
			echo "邮件发送失败：".$e->errorMessage(); 
		} 
		
		exit;
	}
	
	public function sendSql2(){
		require_once './ThinkPHP/Library/Org/Util/class.phpmailer.php';
		require_once './ThinkPHP/Library/Org/Util/class.smtp.php';
        $mail = new \PHPMailer; //实例化
		try {
			$mail->IsSMTP(); 						// 启用SMTP
			$mail->Host="smtp.qq.com";  			//smtp服务器的名称smtp.163.com|smtp.qq.com|smtp.exmail.qq.com
			$mail->SMTPAuth = true; 				//启用smtp认证
			$mail->Username = '505704504@qq.com';   //你的邮箱名
			$mail->Password = 'vwendrowtiddbggf' ;  //qq邮箱的话要开启smtp，开启的时候会返回一个客户端授权码，密码那里就用这个授权码来验证
			$mail->Port = '465'; 					//端口465
			$mail->SMTPSecure = 'ssl'; 				//非SSL协议端口号tls: 25 | SSL协议端口:	465
			
			$mail->From = '505704504@qq.com'; //发件人地址（也就是你的邮箱地址）
			$mail->FromName = '505704504@qq.com'; //发件人姓名
			$address = array("961900940@qq.com","3399351991@qq.com");
			// 添加收件人地址，可以多次使用来添加多个收件人
			if(is_array($address)){
				foreach($address as $addressv){
					$mail->AddAddress($addressv);
				}
			}else{
				$mail->AddAddress($address);
			}
			$mail->AddReplyTo("505704504@qq.com","ck");//回复地址 
			$mail->addAttachment('./Database/CUSTOM_20160826_KQGkt.sql');	//附件内容
			
			$mail->WordWrap = 50; 					// 设置每行字符串的长度
			$mail->IsHTML(true); 					// 是否HTML格式邮件
			$mail->CharSet ='UTF-8'; 				//设置邮件编码
			$mail->Subject = '邮件主题'; 			//邮件主题
			$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
			
			$res = $mail->Send();
			echo '邮件已发送'; 
		} catch (phpmailerException $e) { 
			echo "邮件发送失败：".$e->errorMessage(); 
		} 
		
		exit;
	}
	
	//结合QQ企业邮箱发送邮件
	public function sendSql3(){		
		Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new \PHPMailer;
		
		try {
			$mail->IsSMTP(); 						// 启用SMTP
			$mail->Host="smtp.exmail.qq.com";  		//smtp服务器的名称smtp.163.com|smtp.qq.com|smtp.exmail.qq.com
			$mail->SMTPAuth = true; 				//启用smtp认证
			$mail->Username = 'cuikai@xiaoneng.cn'; //你的邮箱名
			$mail->Password = 'Ck_123' ; 			//QQ企业邮箱登录密码
			
			$mail->From = 'cuikai@xiaoneng.cn'; 	//发件人地址（也就是你的邮箱地址）
			$mail->FromName = 'cuikai@xiaoneng.cn'; 
			$to = "961900940@qq.com"; 
			$mail->AddAddress($to);
			$mail->AddReplyTo("cuikai@xiaoneng.cn","ck"); 
			$mail->addAttachment('./Database/CUSTOM_20160826_KQGkt.sql');	
			
			$mail->WordWrap = 50; 
			$mail->IsHTML(true); 
			$mail->CharSet ='UTF-8'; 
			$mail->Subject = '邮件主题'; 
			$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; 
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; 
			
			$res = $mail->Send();
			echo '邮件已发送'; 
		} catch (phpmailerException $e) { 
			echo "邮件发送失败：".$e->errorMessage(); 
		} 
		
		exit;
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
