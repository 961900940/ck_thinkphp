###csv导入、导出(ajax导入文件)
注意:导出时，输出到浏览器直接给个URL;隐式保存到指定目录时，用ajax即可

数据库sql:

		-- ----------------------------
		-- Table structure for ks_student
		-- ----------------------------
		DROP TABLE IF EXISTS `ks_student`;
		CREATE TABLE `ks_student` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(32) DEFAULT NULL,
		  `sex` char(2) DEFAULT NULL,
		  `age` tinyint(3) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
		
		-- ----------------------------
		-- Records of ks_student
		-- ----------------------------
		INSERT INTO `ks_student` VALUES ('1', '张三', '男', '20');
		INSERT INTO `ks_student` VALUES ('2', '李四', '女', '21');
		INSERT INTO `ks_student` VALUES ('3', '小王', '男', '18');
		INSERT INTO `ks_student` VALUES ('4', '小李', '男', '20');
		INSERT INTO `ks_student` VALUES ('5', '小红', '女', '21');
		INSERT INTO `ks_student` VALUES ('6', '王朝', '男', '18');

导出简单方式：

		//1、title
		$str = "姓名,性别,年龄\n";
		$str = iconv('utf-8','gb2312',$str); 
		//$str = mb_convert_encoding($str, "GBK", "UTF-8");
		
		//2、内容
		$result = M("Student")->select();   
		foreach($result as $key=>$value){
			
			$name = iconv('utf-8','gb2312',$value['name']); //中文转码
			//$name = mb_convert_encoding($value['name'], "GBK", "UTF-8");				
			$sex  = iconv('utf-8','gb2312',$value['sex']);
			//$sex = mb_convert_encoding($value['sex'], "GBK", "UTF-8");	
			$sex  = $value['age']; 
			$str .= $name.",".$sex.",".$sex."\n"; 			//用引文逗号分开   
		}   
		
		$filename = date('Y-m-d').'.csv'; 					//设置文件名   
		file_put_contents($filename, $str);

具体代码：

		1、添加HTML代码		
		<form id="uploadForm" action="__URL__/action?act=import" method="post" enctype="multipart/form-data"> 
		    <input type="text" name="username" class="username"> <br/>
			<p>请选择要导入的CSV文件：<br/>
		    <input type="file" name="file" class="file"> 
			<input type="hidden" name="act" class="act" value="import"> 
		    <input type="submit" class="btn import" value="导入CSV"> 
		</form> 
		<a href="__URL__/action?act=export">
			<button type="submit" class="btn btn-default record">导出CSV</button>
		</a>
		<!--<input type="button" class="btn export" value="导出CSV"></p>--> 
		<div class="content" style="width:300px;height:auto;">
		</div>
		<script>
			$(function(){
	
				$('#uploadForm').ajaxForm({  
					dataType: 'json',  
					success: processJson  
				});  
				function processJson(re){  
					if(re.status == '1'){
						var re = re.info;
						for(var i=0; i < re.length;i++){
							var html="";
							html +="<div>";
							html +='<span class="name" style="padding-right: 30px;">'+re[i].name+'</span>';
							html +='<span class="sex" style="padding-right: 30px;">'+re[i].sex+'</span>';
							html +='<span class="age">'+re[i].age+'</span>';
							html +="</div>";
							$(html).appendTo(".content");
						}
						
					} else{
						alert(re.info);
					}
				}  
				
				$(".export").click(function(){
					var url ="__URL__/action?act=export";
					window.location.href=url;
				});
			});
		</script>
		
		2、控制器代码
		public function index(){
			$this->display();
	    }
		
		/*
		csv文件是由逗号分割符组成的纯文本文件，你可以用excel打开，效果跟xls表个一样。
		导出CSV处理流程：读取学生信息表->循环记录构建逗号分隔的字段信息->设置header信息->导出文件（下载）到本地
		*/
		//导入导出csv
		public function action(){
			header('Content-type:text/html;charset=utf8');
			$action = I("act");
			if ($action == 'import'){ 							//导入CSV 
				$username = I("username");
				$filename = $_FILES['file']['tmp_name'];
				
				if(empty($filename)){
					echo '请选择要导入的CSV文件！'; exit;   
				} 
				$handle = fopen($filename, 'r'); 
				$result = $this->input_csv($handle); 					//解析csv   
				$len_result = count($result); 
				if($len_result==0){
					echo '没有任何数据！';exit;  
				}
				for($i = 1; $i < $len_result; $i++){ 			//循环获取各字段值   
					$name = iconv('gb2312', 'utf-8', $result[$i][0]); //中文转码   
					$sex = iconv('gb2312', 'utf-8', $result[$i][1]);   
					//$name = mb_convert_encoding($result[$i][0], "GBK", "UTF-8");
					//$sex = mb_convert_encoding($result[$i][1], "GBK", "UTF-8");
					$age = $result[$i][2];   
					$data_values .= "('$name','$sex','$age'),";   
				}   
				$data_values = rtrim($data_values,',');
				//$data_values = substr($data_values,0,-1); 		//去掉最后一个逗号   
				fclose($handle); 								//关闭指针
				
				$sql = "insert into ks_student (name,sex,age) values $data_values";//批量插入数据表中   
				$res = M()->execute($sql);
				if($res){   
					$xdata['status'] = '1';
					$data = M("Student")->order("id desc")->select();
					$xdata['info'] = $data;
				}else{  
					$xdata['status'] = '0';
					$xdata['info'] = '导入失败！'; 
				}   
				echo json_encode($xdata);exit;
			}elseif($action=='export'){ 							//导出CSV  
				//1、title
				$arrtitle = array("name"=>"姓名","sex"=>"性别","age"=>"年龄");
				$str = "";
				foreach($arrtitle as $value){
					$str .= $value .",";
				}
				$str = rtrim($str,',')."\n"; 
	
				//2、内容
				$result = M("Student")->select();   
				$content = '';
				foreach($result as $key=>$value){
					foreach($arrtitle as $k=>$v){
						$content .= $value[$k] .",";
					}
					$content = rtrim($content,",") . "\n";
				}   
	
				$type = 2;
				$filename = date('Y-m-d').'.csv'; 					//设置文件名   
				$string  = iconv('utf-8','gb2312',$str.$content);	//中文转码	
				//$string  = mb_convert_encoding($str.$content, "GBK", "UTF-8");
				if($type == 1){
					file_put_contents($filename, $string);exit;
				}else{												//从浏览器输出
					$this->export_csv($filename,$string);
				}
			}else{	
				$this->error("错误操作!");
			}  
		}
		
		/*注意php自带的fgetcsv函数可以轻松处理csv，
		使用该函数可以从文件指针中读入一行并解析CSV字段。
		下面的函数将csv文件字段解析并以数组的形式返回*/
		public function input_csv($handle){   
			$out = array ();   
			$n = 0;   
			while ($data = fgetcsv($handle, 10000)){   
				$num = count($data);   
				for ($i = 0; $i < $num; $i++){   
					$out[$n][$i] = $data[$i];   
				}   
				$n++;   
			}   
			return $out;   
		}  
		//输出到浏览器
		public function export_csv($filename,$data){ 
			header("Content-type:text/csv;");
			header("Content-Disposition:attachment;filename=" . $filename);
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
			header('Expires:0');
			header('Pragma:public');
			echo $data;exit;
		} 