<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    几个定义的常量（PATH结尾的常量表示目录路径，DIR结尾的变量表示目录名）：
    <pre>
    APPPATH（应用程序路径）               F:\software\wamp\www\CodeIgniter-3.0.6\application\
    SYSDIR（系统system目录名）         system
    FCPATH（前端控制器的路径）         F:\software\wamp\www\CodeIgniter-3.0.6\
    BASEPATH（system文件夹的路径）F:\software\wamp\www\CodeIgniter-3.0.6\system\
    SELF（这里指index.php文件）           index.php
    查看所有定义的常量的方法：            Print_r(get_defined_constants());
</pre>
</body>
</html>