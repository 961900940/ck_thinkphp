<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
	<!-- <a href='/ck_thinkphp/index.php/Home/Index/index'>当前地址</a> -->
 	<a data_url="<?php echo U('Index/index');?>" href="">当前地址</a>
    <a href="<?php echo U('Index/index');?>"  target="top">当前地址</a>
 	<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
 	<script>
 		$(function(){
 			$("a").click(function(){
 				var href = $(this).attr("data_url");
 				top.location.href=href;
 			})
 		})
 	</script>
 </body>
 </html>