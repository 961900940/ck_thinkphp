##发送邮件	下载：https://github.com/PHPMailer/PHPMailer
	smtp服务器的名称smtp.126.com|smtp.163.com|smtp.qq.com|smtp.exmail.qq.com
##相关博客：http://blog.csdn.net/u010081689/article/details/49334315


####qq邮箱发送：本人qq、个人qq、企业qq、126、163均可

		第一种引用方式：
		1、下载 PHPMailer ，把整个文件夹放在 ck_thinkphp\ThinkPHP\Library\Vendor\PHPMailer 文件夹下
		2、第一种方式：
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
 
			$path = "./Database/" ;
			$datafile = explode(',',I('data'));
			$address = explode(",",I('email'));//前台功能暂不支持多个邮箱
	
			Vendor('PHPMailer.PHPMailerAutoload');
	        $mail = new \PHPMailer; //实例化
			
			try {
				$mail->IsSMTP(); 						// 启用SMTP
				$mail->Host="smtp.qq.com";  			
				$mail->SMTPAuth = true; 					//启用smtp认证
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
				$mail->Subject = '邮件主题'; 				//邮件主题
				$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
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


 ####qq邮箱发送：本人qq、个人qq、企业qq、126、163均可
 
		第二种引用方式：
		1、下载 PHPMailer ，
			把 class.phpmailer.php 文件放在 ck_thinkphp\ThinkPHP\Library\Org\Util\class.phpmailer.php
			把 class.smtp.php 文件放在 ck_thinkphp\ThinkPHP\Library\Org\Util\class.smtp.php
		2、
		//第二种引入方式
	public function sendSql(){
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
			$xdata['status'] = 'success';
			$xdata['info'] = '邮件已发送';
		} catch (phpmailerException $e) {
			$xdata['status'] = 'failure';
			$xdata['info'] = "邮件发送失败：".$e->errorMessage();
		}
		echo json_encode($xdata);exit;
	}


####qq企业邮箱发送：本人qq、个人qq、企业qq、126、163均可

		2、第二种方式：
		//结合QQ企业邮箱发送邮件
		public function sendSql3(){		
			Vendor('PHPMailer.PHPMailerAutoload');     
	        $mail = new \PHPMailer;
			
			try {
				$mail->IsSMTP(); 
				$mail->Host="smtp.exmail.qq.com";  		
				$mail->SMTPAuth = true; 				
				$mail->Username = 'cuikai@xiaoneng.cn'; 		//企业邮箱名称
				$mail->Password = '***' ; 					//QQ企业邮箱登录密码
				
				$mail->From = 'cuikai@xiaoneng.cn'; 			//发件人地址
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
				$xdata['status'] = 'success';
				$xdata['info'] = '邮件已发送';
			} catch (phpmailerException $e) { 
				$xdata['status'] = 'failure';
				$xdata['info'] = "邮件发送失败：".$e->errorMessage();
			} 
			echo json_encode($xdata);exit;
		}




####163邮箱发送：个人qq、企业qq、126、163、本人163均可
	1、下载 PHPMailer ，把整个文件夹放在 ck_thinkphp\ThinkPHP\Library\Vendor\PHPMailer 文件夹下
	2、
	public function sendSql(){
		$path = "./Database/" ;
		$datafile = explode(',',I('data'));
		$address = explode(",",I('email'));//前台功能暂不支持多个邮箱

		Vendor('PHPMailer.PHPMailerAutoload');
        $mail = new \PHPMailer; //实例化

		try {
			$mail->IsSMTP(); 						
			$mail->Host="smtp.163.com";  			
			$mail->SMTPAuth = true; 				
			$mail->Username = 'm18210890833@163.com'; //163邮箱邮箱名称
			$mail->Password = 'c961900940' ;  		//163邮箱的话要开启smtp，开启的时候会返回一个客户端授权码，密码那里就用这个授权码来验证

			$mail->From = 'm18210890833@163.com'; 		//发件人地址（也就是你的邮箱地址）
			$mail->FromName = 'm18210890833@163.com'; 	//发件人姓名

			$mail->AddAddress("m18210890833@163.com");
			$mail->AddAddress("c961900940@126.com");
			$mail->AddAddress("961900940@qq.com");

			$mail->AddReplyTo("m18210890833@163.com","ck");//回复地址
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
			$mail->Body = "<h1>phpmail演示2</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示

			$res = $mail->Send();
			$xdata['status'] = 'success';
			$xdata['info'] = '邮件已发送';
		} catch (phpmailerException $e) {
			$xdata['status'] = 'failure';
			$xdata['info'] = "邮件发送失败：".$e->errorMessage();;
		}
		echo json_encode($xdata);exit;
	}

####163邮箱发送：个人qq、企业qq、163、126、本人126均可
	1、下载 PHPMailer ，把整个文件夹放在 ck_thinkphp\ThinkPHP\Library\Vendor\PHPMailer 文件夹下
	2、
	public function sendSql(){
		$path = "./Database/" ;
		$datafile = explode(',',I('data'));
		$address = explode(",",I('email'));//前台功能暂不支持多个邮箱

		Vendor('PHPMailer.PHPMailerAutoload');
        $mail = new \PHPMailer; //实例化

		try {
			$mail->IsSMTP(); 						
			$mail->Host="smtp.126.com";  			
			$mail->SMTPAuth = true; 				
			$mail->Username = 'c961900940@126.com'; //126邮箱邮箱名称
			$mail->Password = 'c123456' ;  			//126邮箱的话要开启smtp，开启的时候会返回一个客户端授权码，密码那里就用这个授权码来验证

			$mail->From = 'c961900940@126.com'; 		//发件人地址（也就是你的邮箱地址）
			$mail->FromName = 'c961900940@126.com'; 	//发件人姓名

			$mail->AddAddress("m18210890833@163.com");
			$mail->AddAddress("c961900940@126.com");
			$mail->AddAddress("961900940@qq.com");

			$mail->AddReplyTo("c961900940@126.com","ck");//回复地址
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
			$mail->Body = "<h1>phpmail演示3</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容"; //邮件内容
			$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示

			$res = $mail->Send();
			$xdata['status'] = 'success';
			$xdata['info'] = '邮件已发送';
		} catch (phpmailerException $e) {
			$xdata['status'] = 'failure';
			$xdata['info'] = "邮件发送失败：".$e->errorMessage();;
		}
		echo json_encode($xdata);exit;
	}
