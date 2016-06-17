<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    1、控制器给前台传递变量:
    <pre style='color:#55cc66;background:#001800;'>
    控制器：
    $userinfo = '111';
    $this->assign('userinfo',$userinfo);
    $this->display();
    视图：
    用户信息:<?php echo ($userinfo); ?>

    $this->display("Index/codeigniter/codeigniter_1");  //显示到指定页面
    </pre>
    2、tp3.2.3视图页面直接访问：
    <pre style="color:#000000;background:#f1f0f0;">
    http://localhost/项目目录/Application(应用目录)/模块目录/View/Index/thinkphp/thinkphp_1.html
    </pre>
</body>
</html>