<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>权限管理-后台管理-ck RBAC权限管理</title>
        <!--公共头文件-->
        <link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/Admin/css/base.css" />
<link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/Admin/css/layout.css" />
<link rel="stylesheet" type="text/css" href="/ck_thinkphp/Public/static/asyncbox/skins/default.css" />
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery.lazyload.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/Admin/js/functions.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/Admin/js/base.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/ck_thinkphp/Public/static/asyncbox/asyncbox.js"></script>
<style media="screen">
    .logo img{margin: 5px 0 0 10px;vertical-align:bottom;}
    #Tags .userPhoto img{height: 45px;margin:8px 0 0 9px;width: 45px;}
</style>

    </head>
    <body>
        <div class="wrap">
            <!--顶部导航菜单-->
	        <div id="Top">
                <div class="logo"><a target="_blank" href="http://localhost/Tprbac/"><img src="/ck_thinkphp/Public/Admin/images/logo.png" /></a></div>
<div class="help"><a href="http://www.uc22.net/bbs" target="_blank">使用帮助</a><span><a href="http://www.uc22.net" target="_blank">关于</a></span></div>
<div class="menu">
    <ul class="moudle">
        <li class="fisrt controller_name" data_name="Index"><span><a href="/ck_thinkphp/index.php/Admin/Index/index">首页</a></span></li>
        <li class="controller_name" data_name="Member"><span><a href="/ck_thinkphp/index.php/Admin/Member/index">内容管理</a></span></li>
        <li class="controller_name" data_name="News"><span><a href="/ck_thinkphp/index.php/Admin/News/index">资讯管理</a></span></li>
        <li class="controller_name" data_name="Product"><span><a href="/ck_thinkphp/index.php/Admin/Product/index">产品管理</a></span></li>
        <li class="controller_name" data_name="Siteinfo"><span><a href="/ck_thinkphp/index.php/Admin/Siteinfo/index">网站功能</a></span></li>
        <li class="controller_name" data_name="Models"><span><a href="/ck_thinkphp/index.php/Admin/Models/index">模型管理</a></span></li>
        <li class="controller_name" data_name="SysData"><span><a href="/ck_thinkphp/index.php/Admin/SysData/index">数据管理</a></span></li>
        <li class="end controller_name" data_name="Access"><span><a href="/ck_thinkphp/index.php/Admin/Access/index">权限管理</a></span></li>
    </ul>
    <script>
    	$(function(){
    		var controller_name = "<?php echo $controller_name; ?>";
    		$('.controller_name').each(function(i){
    			controller_name2 = $(this).attr("data_name");
    			if(controller_name == controller_name2){
    				$(this).addClass("current");
                    $(this).siblings().removeClass("current");
    			}
    		})
    	});
    </script>
</div>

	        </div>
            <!--Tags标签-->
	        <div id="Tags">
                <div class="userPhoto">
    <img src="/ck_thinkphp/Public/Admin/images/userPhoto.jpg" />
</div>
<div class="navArea">
    <div class="userInfo">
        <div>
            <a href="/Tprbac/index.php/conist/Webinfo/index" class="sysSet"><span>&nbsp;</span>系统设置</a>
            <a href="/ck_thinkphp/index.php/Admin/Public/loginOut" class="loginOut"><span>&nbsp;</span>退出系统</a>
        </div>
        欢迎您，a@a.com
    </div>
</div>

                    <div class="nav">
                        <font id="today"></font>您的位置：网站管理 > 系统信息
                    </div>
                </div>
	        </div>
	        <div class="clear"></div>
	        <div class="mainBody">
                <!--子菜单列表-->
	            <div id="Left">
                    <div id="control" class=""></div>
<div class="subMenuList">
    <div class="itemTitle">常用操作 </div>
    <ul>
        <!-- <li><a href="/ck_thinkphp/index.php/Admin/Index/index">后台用户</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Index/nodeList">节点管理</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Index/roleList">角色管理</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Index/addAdmin">添加管理员</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Index/index">添加节点</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Index/addNode">添加角色</a></li> -->
        <?php if(is_array($MenuItem)): foreach($MenuItem as $key=>$vo): ?><li><a href="/ck_thinkphp/index.php/Admin/<?php echo ($vo["auth_c"]); ?>/<?php echo ($vo["auth_a"]); ?>"><?php echo ($vo["auth_name"]); ?></a></li><?php endforeach; endif; ?>
    </ul>
</div>

	            </div>
                <!--content内容主体-->
	            <div id="Right">
                    <div class="Item hr">
                        <div class="current">系统信息</div></div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <tr>
                            <td width="120" align="right">操作系统：</td>
                            <td>WINNT</td>
                            <td width="120" align="right">主机名IP端口：</td>
                            <td>localhost (127.0.0.1:80)</td></tr>
                        <tr>
                            <td width="120" align="right">运行环境：</td>
                            <td>Apache/2.4.9 (Win64) PHP/5.5.12</td>
                            <td width="120" align="right">PHP运行方式：</td>
                            <td>apache2handler</td></tr>
                        <tr>
                            <td width="120" align="right">程序目录：</td>
                            <td>F:\software\wamp\www\Tprbac/Application/</td>
                            <td width="120" align="right">MYSQL版本：</td>
                            <td>mysqlnd 5.0.11-dev - 20120503 - $Id: bf9ad53b11c9a57efdb1057292d73b928b8c5c77 $</td></tr>
                        <tr>
                            <td width="120" align="right">GD库版本：</td>
                            <td>bundled (2.1.0 compatible)</td>
                            <td width="120" align="right">上传附件限制：</td>
                            <td>64M</td></tr>
                        <tr>
                            <td width="120" align="right">执行时间限制：</td>
                            <td>120秒</td>
                            <td width="120" align="right">剩余空间：</td>
                            <td>110253.68M</td></tr>
                        <tr>
                            <td width="120" align="right">服务器时间：</td>
                            <td>2016年6月6日 18:19:23</td>
                            <td width="120" align="right">北京时间：</td>
                            <td>2016年6月6日 18:19:23</td></tr>
                        <tr>
                            <td width="120" align="right">采集函数检测：</td>
                            <td>支持</td>
                            <td width="120" align="right">register_globals：</td>
                            <td>OFF</td></tr>
                        <tr>
                            <td width="120" align="right">magic_quotes_gpc：</td>
                            <td>NO</td>
                            <td width="120" align="right">magic_quotes_runtime：</td>
                            <td>NO</td></tr>
                    </table>
                </div>
	    	</div>
    	<div class="clear"></div>
    <!--尾部js css-->
    <script type="text/javascript">
    $(window).resize(autoSize);
    $(function(){
        autoSize();
        $(".loginOut").click(function(){
            var url=$(this).attr("href");
            popup.confirm('你确定要退出吗？','你确定要退出吗',function(action){
                if(action == 'ok'){ window.location=url; }
            });
            return false;
        });

        var time=self.setInterval(function(){$("#today").html(date("Y-m-d H:i:s"));},1000);


    });
</script>

    </body>
</html>