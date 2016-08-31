<?php
// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 True ,部署阶段注释或者设为 false
define('APP_DEBUG',true);

// 定义应用目录名称
define('APP_NAME','Application');
// 定义应用目录
define('APP_PATH','./Application/');
define('DIR_SECURE_FILENAME', 'index.html');	//目录安全文件
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
