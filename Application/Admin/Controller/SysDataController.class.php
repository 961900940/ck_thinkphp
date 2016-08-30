<?php
namespace Admin\Controller;
use Think\Controller;
use ZipArchive;
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

	public function sendSql(){
		$path = "./Database/" ;
		$datafile = explode(',',I('data'));
		$address = explode(",",I('email'));//功能支持发送给多个邮箱,没有正则验证

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

			//$address = array("961900940@qq.com","3399351991@qq.com");
			// 添加收件人地址，可以多次使用来添加多个收件人
			if(is_array($address)){
				foreach($address as $addressv){
					$mail->AddAddress($addressv);
				}
			}else{
				$mail->AddAddress($address);
			}

			$mail->AddReplyTo("505704504@qq.com","ck");//回复地址
			if(is_array($datafile)){
				foreach($datafile as $file){
					$mail->addAttachment($path.$file);	//附件内容
				}
			}else{
				$mail->addAttachment($path.$datafile);	//附件内容
			}


			$mail->WordWrap = 50; 					// 设置每行字符串的长度
			$mail->IsHTML(true); 					// 是否HTML格式邮件
			$mail->CharSet ='UTF-8'; 				//设置邮件编码
			$mail->Subject = '邮件主题'; 			//邮件主题
			$mail->Body = "<h1>phpmail演示4</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示

			$res = $mail->Send();
			$xdata['status'] = 'success';
			$xdata['info'] = '邮件已发送';
		} catch (phpmailerException $e) {
			$xdata['status'] = 'failure';
			$xdata['info'] = "邮件发送失败：".$e->errorMessage();
		}
		echo json_encode($xdata);exit;
	}


	//删除备份文件
	public function delSqlFiles(){
		$path = "./Database/" ;
		$datafile = explode(',',I('data'));
		foreach ($datafile as $file) {
			unlink($path.$file);
		}
		$xdata['status'] = 'success';
		$xdata['info'] = count($datafile).'个备份文件,删除成功';
		echo json_encode($xdata);exit;
	}

	//打包压缩备份文件
	public function zipSql(){
		$path = "./Database/" ;
		$ZipBackDir = './ZipBackDir/';
		$toZip = explode(',',I('data'));
		foreach ($toZip as $zipOut => $files) {
			$arrfiles =  explode('.',$files);
            if ($this->zip($files, $arrfiles[0] . ".zip", $ZipBackDir,$path)) {
                unlink($path.$files);
            }
        }
		$xdata['status'] = 'success';
		$xdata['info'] = "打包的sql文件成功，本次打包" . count($toZip) . "个zip文件";
		echo json_encode($xdata);exit;
	}

	/**
     * 功能：生成zip压缩文件，存放都 WEB_CACHE_PATH 中
     * @param $files        array   需要压缩的文件
     * @param $filename     string  压缩后的zip文件名  包括zip后缀
     * @param $path         string  文件所在目录
     * @param $outDir       string  输出目录
     * @return array
     */
    public function zip($files, $filename, $outDir , $path ) {
        $zip = new ZipArchive();
        mkdirs($outDir);
        if ($zip->open($outDir  . $filename, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($path . $files, str_replace('/', '', $files));
			$zip->close();
            return TRUE;
        }
        return FALSE;
    }


    /*
    *列出以打包sql文件
    */
    public function zipList(){
        $data = $this->getZipFilesList();
        $this->assign("list", $data['list']);
        $this->assign("total", $data['size']);
        $this->assign("files", count($data['list']));
        $this->display();
    }

    public function getZipFilesList(){
        $list = array();
        $size = 0;
        $ZipBackDir = './ZipBackDir/';
        $handle = opendir($ZipBackDir);

        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                $tem = array();
                $tem['file'] = $file; //  checkCharset($file);
                $_size = filesize($ZipBackDir . "$file");
                $tem['size'] = byteFormat($_size);
                $tem['time'] = date("Y-m-d H:i:s", filectime($ZipBackDir . "$file"));
                $size+=$_size;
                $list[] = $tem;
            }
        }
        return array("list" => $list, "size" => byteFormat($size));
    }

    //删除压缩包
    public function delZipFiles(){
        $ZipBackDir = './ZipBackDir/';
		$datafile = explode(',',I('data'));
		foreach ($datafile as $file) {
			unlink($ZipBackDir.$file);
		}
		$xdata['status'] = 'success';
		$xdata['info'] = count($datafile).'个备份文件,删除成功';
		echo json_encode($xdata);exit;
    }

    /**
     * 功能：解压缩zip文件，存放都 DatabaseBackDir 中
     * @param $file         string   需要压缩的文件
     * @return array
     */
    public function unzip($file) {
        $zip = new ZipArchive();
		$path = "./Database/" ;
        $ZipBackDir = './ZipBackDir/';
        if ($zip->open($ZipBackDir. $file) === TRUE){
            $zip->extractTo($path);
            $zip->close();
            return TRUE;
        }
        return FALSE;

    }

	//解压缩所选
    public function unzipSqlfile(){
		$ZipBackDir = './ZipBackDir/';
        $datafile = explode(',',I('data'));

		foreach ($datafile as $file) {
            if($this->unzip($file)){
                unlink($ZipBackDir.$file);
            }
		}
		$xdata['status'] = 'success';
		$xdata['info'] = count($datafile).'个备份文件,解压缩成功';
		echo json_encode($xdata);exit;
    }
	
	//下载压缩包或sql文件
	public function downFile() {
		$path = "./Database/" ;
        $ZipBackDir = './ZipBackDir/';
        if (empty($_GET['file']) || empty($_GET['type']) || !in_array($_GET['type'], array("zip", "sql"))) {
            $this->error("下载地址不存在");
        }
        $path = array("zip" => $ZipBackDir, "sql" => $path);
        $filePath = $path[$_GET['type']] . $_GET['file'];
        if (!file_exists($filePath)) {
            $this->error("该文件不存在，可能是被删除");
        }
        $filename = basename($filePath);
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Length: " . filesize($filePath));
        readfile($filePath);
		exit;
    }

	//数据库优化修复
	public function repair() {
        $M = M("Auth_admin");
        if (IS_POST) {
			$tables = I("data");
			$act = I("act");
            if (empty($tables)) {
                echo json_encode(array("status" => 0, "info" => "请选择要处理的表"));exit;
            }
            if ($act == 'repair') {
                if ($M->query("REPAIR TABLE {$tables} "))
                    echo json_encode(array("status" => 1, "info" => "修复表成功", 'url' => U('SysData/repair')));exit;
            } elseif ($act == 'optimize') {
                if ($M->query("OPTIMIZE TABLE $tables"))
                    echo json_encode(array("status" => 1, "info" => "优化表成功", 'url' => U('SysData/repair')));exit;
            }
            echo json_encode(array("status" => 0, "info" => "请选择操作"));exit;
        } else {
            $tabs = $M->query('SHOW TABLE STATUS');
            $totalsize = array('table' => 0, 'index' => 0, 'data' => 0, 'free' => 0);
            $tables = array();
            foreach ($tabs as $k => $table) {
                $table['size'] = byteFormat($table['data_length'] + $table['index_length']);
                $totalsize['table'] += $table['data_length'] + $table['index_length'];
                $totalsize['data']+=$table['data_length'];
                $table['data_length'] = byteFormat($table['data_length']);
                $totalsize['index']+=$table['index_length'];
                $table['index_length'] = byteFormat($table['index_length']);
                $totalsize['free']+=$table['data_free'];
                $table['data_free'] = byteFormat($table['data_free']);
                $tables[] = $table;
            }
            $this->assign("list", $tables);
            $this->assign("totalsize", $totalsize);
            $this->display();
        }
    }

}
