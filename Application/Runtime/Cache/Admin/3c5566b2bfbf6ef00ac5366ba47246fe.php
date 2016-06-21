<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
		<title>权限管理-后台管理-ck RBAC权限管理</title>
		<!--公共头文件-->
        <link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/Admin/css/base.css" />
<link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/Admin/css/layout.css" />
<link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/static/asyncbox/skins/default.css" />
<link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/static/layer-v2.3/layer/skin/layer.css" />
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery.lazyload.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/Admin/js/functions.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/Admin/js/base.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/asyncbox/asyncbox.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/layer-v2.3/layer/layer.js"></script>
<style media="screen">
    .logo img{margin: 5px 0 0 10px;vertical-align:bottom;}
    #Tags .userPhoto img{height: 45px;margin:8px 0 0 9px;width: 45px;}
</style>

    </head>
	<body class="loginWeb">
	    <div class="loginBox">
	        <div class="innerBox">
	            <div class="logo" style="position: relative;line-height:0;">
					<img src="/ck_thinkphp/Public/Admin/images/logo.png" style="margin: 5px 0 0 10px;vertical-align:bottom;"/>
				</div>
	            <form id="form1" action="/ck_thinkphp/index.php/Admin/Public/index" method="post">
	                <div class="loginInfo">
	                    <ul>
	                        <li class="row1">登录账号：</li>
	                        <li class="row2"><input class="input" name="username" id="email" size="30" type="text" /></li>
	                    </ul>
	                    <ul>
	                        <li class="row1">登录密码：</li>
	                        <li class="row2"><input class="input" name="pwd" id="pwd" size="30" type="password" /></li>
	                    </ul>
	                    <ul>
	                        <li class="row1">验证码：</li>
	                        <li class="row2">
								<input class="input" id="verify_code" name="verify_code" type="text" style="width:100px;" />
								<img src="/ck_thinkphp/index.php/Admin/Public/verify_code"  title="看不清？单击此处刷新" onclick="this.src+='?rand='+Math.random();"  style="cursor: pointer; vertical-align: middle;"/>
							</li>
	                    </ul>
	                </div>
	                <input type="hidden" name="op_type" id="op_type" value="1"/>
	            </form>
	            <div class="clear"></div>
	            <div class="operation"><button class="btn submit">登录</button>   <button class="btn findPwd">忘记密码？</button></div>
	        </div>
	    </div>
	    <script type="text/javascript">
	        $(function(){
	            $(".submit").click(function(){
	                $("#op_type").val("1");
	                if($("#email").val()==''||$("#pwd").val()==''||$("#verify_code").val()==''){
	                    popup.alert("填写完整方可登陆");
	                    return false;
	                }
                    $("#form1").submit();
	            });


	            $(".findPwd").click(function(){
	                $("#op_type").val("2");
	                if($("#email").val()==''){
	                    popup.alert("填写了你的邮箱方可找回密码");
	                    return false;
	                }
	                if($("#verify_code").val()==''){
	                    popup.alert("请写验证码方可找回密码");
	                    return false;
	                }
	                commonAjaxSubmit();
	            });
	        });
	    </script>
	</body>
</html>