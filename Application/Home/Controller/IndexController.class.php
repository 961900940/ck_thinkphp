<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**首页**/
    public function index(){
		$this->display();
    }

    /**默认显示页面**/
	public function versioninfo(){
//		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #ff91a7; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <p>当前框架为: <b>ThinkPHP</b>V{$Think.version}完整版</p></div>');
		echo "<p>当前框架为: <b>ThinkPHP</b>V3.2.3完整版</p>";
		echo '操作系统：'.PHP_OS."<br>";
		echo 'php版本：'.phpversion()."<br>";
		echo 'Apache版本：'.apache_get_version()."<br>";

		mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'));
		if(empty(mysql_get_server_info())){
			echo 'MySQL版本：请先配置mysql_connect参数'."<br>";
		}else{
			/**第一种方式**/
			//echo 'MySQL版本：'.mysql_get_server_info()."<br>";

			/**第二种方式**/
			$system_info = M()->query("select version() as v;");
			echo 'MySQL版本:'.$system_info[0]['v']."<br>";
		}
		echo "<br>"."本地测试采用wamp集成环境：php(5.5.12) + apache(2.4.9) + mysql(5.6.17)"."<br>";
		$this->display();
	}

	/***快捷键**************************************************************/
	public function Shortcut_key(){
		$this->display("Index/shortcut_key/shortcut_key_1");
	}

	
	/**自定义函数库******************************************************************/
	public function library(){
		$this->display();
	}

	/**php常用函数总结******************************************************************/
	public function comfunc(){
		$this->display();
	}

	/**前端******************************************************************/
	public function web_1(){					//js
		$this->display("Index/web/web_1");
	}

	public function web_2(){					//css
		$this->display("Index/web/web_2");
	}

	public function web_3(){					//css
		$this->display("Index/web/web_3");
	}


	/***mysql、mysqli、pdo操作数据库**************************************************/
	public function database_statement_1(){		//tip
		$this->display("Index/database_statement/database_statement_1");
	}
	public function database_statement_2(){		//mysql
		$this->display("Index/database_statement/database_statement_2");
	}
	public function database_statement_3(){		//mysqli
		$this->display("Index/database_statement/database_statement_3");
	}
	public function database_statement_4(){		//pdo
		$this->display("Index/database_statement/database_statement_4");
	}

	/***Apache配置******************************************/
	public function apache_1(){		//局域网下，他人访问本地文件
		$this->display("Index/apache/apache_1");
	}
	public function apache_2(){		//配置虚拟域名
		$this->display("Index/apache/apache_2");
	}

	/***Thinkphp框架****************************************/
	public function thinkphp_1(){	// URL访问
		$this->display("Index/thinkphp/thinkphp_1");
	}
	public function thinkphp_2(){	// 配置文件
		$this->display("Index/thinkphp/thinkphp_2");
	}
	public function thinkphp_3(){	// 数据库操作
		$this->display("Index/thinkphp/thinkphp_3");
	}
	public function thinkphp_4(){	// 视图、控制器、模型交互
		$userinfo = '111';
	    $this->assign('userinfo',$userinfo);
		$this->display("Index/thinkphp/thinkphp_4");
	}
	public function thinkphp_5(){	// 预定义常量、系统常量、路径常量
		$this->display("Index/thinkphp/thinkphp_5");
	}

	/***CodeIgniter框架*************************************/
	public function codeigniter_1(){	// URL访问
		$this->display("Index/codeigniter/codeigniter_1");
	}
	public function codeigniter_2(){	// 配置文件
		$this->display("Index/codeigniter/codeigniter_2");
	}
	public function codeigniter_3(){	// 数据库操作
		$this->display("Index/codeigniter/codeigniter_3");
	}
	public function codeigniter_4(){	// 视图、控制器、模型交互
		$userinfo = '111';
	    $this->assign('userinfo',$userinfo);
		$this->display("Index/codeigniter/codeigniter_4");
	}
	public function codeigniter_5(){	// 预定义常量、系统常量、路径常量
		$this->display("Index/codeigniter/codeigniter_5");
	}

	/***Yii框架*************************************/
	public function yii_1(){
		$this->display("Index/yii/yii_1");	//安装及URL访问
	}
	public function yii_2(){
		$this->display("Index/yii/yii_2");	//Yii配置文件
	}
	public function yii_3(){
		$this->display("Index/yii/yii_3");	// 数据库操作
	}
	public function yii_4(){
		$this->display("Index/yii/yii_4");	// 视图、控制器、模型交互
	}
	public function yii_5(){
		$this->display("Index/yii/yii_5");	// 预定义常量、系统常量、路径常量
	}

	/***测试方法****************************************************/
	public function test(){
		header("Content-Type:text/html;   charset=utf-8");
		$Action = M('Action');
		$res = $Action->select();
		//var_dump($res);

		$Model = M(); // 实例化一个空模型
		$sql = "select * from onethink_action ";
		$count=$Model->query($sql);
		var_dump( $Model->getLastSql() );
		var_dump($count);

	}


	/**
	*空操作单独处理
	*/
	public function _empty(){
        return $this->error('亲，您访问的页面不存在 :(');
    }
}
