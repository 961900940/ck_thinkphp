<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<xmp>
局域网下，他人访问本地文件设置：
D:\wamp\bin\apache\Apache2.2.21\conf\httpd.conf
</xmp>
<pre style='color:#000000;background:#f1f0f0;'><span style='color:#806030; '>&lt;</span>Directory <span style='color:#806030; '>/</span><span style='color:#806030; '>></span>
Options FollowSymLinks
AllowOverride all
Order deny<span style='color:#806030; '>,</span>allow
Allow from all
<span style='color:#806030; '>&lt;</span><span style='color:#806030; '>/</span>Directory<span style='color:#806030; '>></span>
</pre>
<xmp>
注意：
     1、在 AllowOverride 设置为 None 时， .htaccess 文件将被完全忽略。当此指令设置为 All 时，所有具有 ".htaccess" 作用域的指令都允许出现在 .htaccess 文件中。
     2、Deny,Allow”中间只有一个逗号，也只能有一个逗号，有空格都会出错；单词的大小写不限。上面设定的含义是先设定“先检查禁止设定，没有禁止的全部允许”
     3、Allow from All 没有Deny，也就是没有禁止访问的设定，直接就是允许所有访问了

    下面的设定是无条件禁止访问：
        Order Allow,Deny
        Deny from All

        如果要禁止部分内容的访问，其他的全部开放：
        Order Deny,Allow
        Deny from ip1 ip2
        或者
        Order Allow,Deny
        Allow from all
        Deny from ip1 ip2

        注意：Directory 已修改为 Allow from all，仍然没有权限访问，Require local注释掉即可
        Forbidden
        You don't have permission to access /demo.php on this server.
        Apache/2.4.9 (Win64) PHP/5.5.12 Server at 192.168.30.76 Port 80
</xmp>
<pre style='color:#000000;background:#f1f0f0;'><span style='color:#806030; '>&lt;</span>Directory <span style='color:#800000; '>"</span><span style='color:#e60000; '>F:/software/wamp/www/</span><span style='color:#800000; '>"</span><span style='color:#806030; '>></span>
<span style='color:#004a43; '>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#004a43; '>#</span><span style='color:#004a43; '>Require local</span>
     Allow from all
<span style='color:#806030; '>&lt;</span><span style='color:#806030; '>/</span>Directory<span style='color:#806030; '>></span>
</pre>

</body>
</html>