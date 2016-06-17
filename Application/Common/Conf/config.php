<?php
return array(
	//'配置项'=>'配置值'

    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'), // 配置你原来的分组列表
        //'MODULE_ALLOW_LIST'     =>  array('Home','Webmaster'), // 配置你原来的分组列表
    'DEFAULT_MODULE'        =>  'Home', // 配置你原来的默认分组
	'MODULE_DENY_LIST'      =>  array('Common','Runtime'),
	   //'URL_MODULE_MAP'    =>    array('webmaster'=>'admin'),	//模块映射


    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__UPLOAD__'      => __ROOT__ . '/Uploads',		           //上传文件
        '--PUBLIC--'      => __ROOT__ . '/Public' ,
        '__STATIC__'      => __ROOT__ . '/Public/static',          //公共资源  静态目录

        '__Admin_JS__' 	  => __ROOT__ . '/Public/Admin/js',		   //后台 js 目录
		'__Admin_CSS__'    => __ROOT__ . '/Public/Admin/css',	   //后台 css 目录
        '__Admin_IMG__'    => __ROOT__ . '/Public/Admin/images',   //后台 images 目录
		'__Admin_FONT__'   => __ROOT__ . '/Public/Admin/font',	   //后台 字体 目录
        '__Home_JS__' 	  => __ROOT__ . '/Public/Home/js',		   //前台 js 目录
		'__Home_CSS__'     => __ROOT__ . '/Public/Home/css',		   //前台 css 目录
        '__Home_IMG__'     => __ROOT__ . '/Public/Home/images',     //前台 images 目录
		'__Home_FONT__'    => __ROOT__ . '/Public/Home/font',	   //前台 字体 目录
    ),

    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'systemConfig',//扩展配置可以支持自动加载额外的自定义配置文件
);
