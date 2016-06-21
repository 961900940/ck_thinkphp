<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'mysql',		// 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'knowledgesummary',  // 数据库名
    'DB_USER'   => 'root',		// 用户名
    'DB_PWD'    => '',		// 密码
    'DB_PORT'   => 3306,		// 端口
    'DB_PREFIX' => 'ks_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8',		// 字符集
    'DB_DEBUG'  =>  TRUE,		// 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'SHOW_PAGE_TRACE' =>true,   // 显示页面Trace信息

	/* 日志设置 */
	'LOG_RECORD' => true,		// 开启日志记录
    'LOG_LEVEL'  =>'INFO,EMERG,ALERT,CRIT,ERR' // 只记录EMERG ALERT CRIT ERR 错误
);
