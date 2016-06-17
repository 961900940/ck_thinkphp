<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <xmp>
    1、入口文件配置：
    </xmp>
    <pre style='color:#55cc66;background:#001800;'>
    define('APP_DEBUG',true);// 开启调试模式 建议开发阶段开启 True ,部署阶段注释或者设为 false
    define('APP_NAME','Application');// 定义应用目录名称
    define('APP_PATH','./Application/');// 定义应用目录
    require './ThinkPHP/ThinkPHP<span style='color:#778c77; '>.</span>php';// 引入ThinkPHP入口文件
    </pre>

    <xmp>
    2、thinkphp配置文件：
    项目目录\应用目录\模块\Conf\config.php、
    项目目录\应用目录\Common公共目录\Conf\config.php
    </xmp>
    <pre style='color:#55cc66;background:#001800;'>
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'), // 配置你原来的分组列表
    'DEFAULT_MODULE'        =>  'Home', // 默认模块
    'MODULE_DENY_LIST'      =>  array('Common','Runtime','Api'),// 设置禁止访问的模块列表
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '/ck_thinkphp/Uploads'      => /ck_thinkphp . '/Uploads',		           //上传文件
        '/ck_thinkphp/Public/static'      => /ck_thinkphp . '/Public/static',          //公共资源  静态目录

        '/ck_thinkphp/Public/Admin/js' 	  => /ck_thinkphp . '/Public/Admin/js',		   //后台 js 目录
		'/ck_thinkphp/Public/Admin/css'    => /ck_thinkphp . '/Public/Admin/css',	   //后台 css 目录
        '/ck_thinkphp/Public/Admin/images'    => /ck_thinkphp . '/Public/Admin/images',   //后台 images 目录
		'/ck_thinkphp/Public/Admin/font'   => /ck_thinkphp . '/Public/Admin/font',	   //后台 字体 目录
    ),
    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'systemConfig',//扩展配置可以支持自动加载额外的自定义配置文件(定义方式同 config.php)

    /* 数据库设置 */
	'DB_TYPE'   => 'mysql',		// 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'knowledgesummary',  // 数据库名
    'DB_USER'   => 'root',		// 用户名
    'DB_PWD'    => '',		// 密码
    'DB_PORT'   => 3306,		// 端口
    'DB_PREFIX' => 'ks_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8',		// 字符集
    'DB_DEBUG'  =>  TRUE,		// 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'SHOW_PAGE_TRACE' =>true,   // //让页面显示追踪日志信息
    'URL_MODEL'             =>  1, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
        // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    /* URL设置:URL大小写 */
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

    'URL_HTML_SUFFIX'=>'shtml|html|xml',	//URL伪静态后缀设置
    /* 日志设置 */
	'LOG_RECORD' => true,		// 开启日志记录
    'LOG_LEVEL'  =>'INFO,EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误
    </pre>
    <xmp>
    3、自定义函数库文件：
    项目目录\应用目录\模块\Common\function.php
    项目目录\应用目录\Common公共目录\Common\function.php
    </xmp>
    <xmp>
    4、加载自定义配置
     a:某个文件具体位置加载该配置文件
        $systemConfigPath = APP_PATH.'Common/Conf/systemConfig.php';
        $config = array_merge(C(),include_once($systemConfigPath));
     b:加载扩展配置文件     config.php文件添加
          //'LOAD_EXT_CONFIG' => 'systemConfig',
    </xmp>
    <xmp>
    5、sae数据库访问配置信息
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'SAE_MYSQL_HOST_M', // 服务器地址
    'DB_NAME'   => 'app_ck961900940', // 数据库名
    'DB_USER'   => 'SAE_MYSQL_USER', // 用户名
    'DB_PWD'    => 'SAE_MYSQL_PASS', // 密码
    'DB_PORT'   => 'SAE_MYSQL_PORT' , // 端口
    'DB_PREFIX' => 'tb_', // 数据库表前缀

    </xmp>
</body>
</html>