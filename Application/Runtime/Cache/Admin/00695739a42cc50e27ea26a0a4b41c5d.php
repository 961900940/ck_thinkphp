<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
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
                        <font id="today"></font>您的位置：权限管理 > 添加编辑角色
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
        <!-- <li><a href="/ck_thinkphp/index.php/Admin/Access/index">后台用户</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Access/nodeList">节点管理</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Access/roleList">角色管理</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Access/addAdmin">添加管理员</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Access/index">添加节点</a></li>
        <li><a href="/ck_thinkphp/index.php/Admin/Access/addNode">添加角色</a></li> -->
        <?php if(is_array($MenuItem)): foreach($MenuItem as $key=>$vo): ?><li><a href="/ck_thinkphp/index.php/Admin/<?php echo ($vo["auth_c"]); ?>/<?php echo ($vo["auth_a"]); ?>"><?php echo ($vo["auth_name"]); ?></a></li><?php endforeach; endif; ?>
    </ul>
</div>

	            </div>
				<!--content内容主体-->
                <div id="Right">
                    <div class="contentArea">
                        <div class="Item hr">
                            <div class="current">添加编辑角色</div></div>
                        <form action="/ck_thinkphp/index.php/Admin/Access/addRole" method="post">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                                <tr>
                                    <th width="120">角色组名称：</th>
                                    <td>
                                        <input name="role_name" type="text" class="input" size="40" value="" /></td>
                                </tr>
                                <tr>
                                    <th>状态：</th>
                                    <td>
                                        <select name="status" style="width: 80px;">
                                            <option value="1" selected>启用</option>
                                            <option value="0" >禁用</option></select>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th>父级组ID：</th>
                                    <td>
                                        <select name="pid" style="min-width: 80px;">
                                            <option value="1">超级管理员</option>
                                            <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 管理员</option>
                                            <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;├ 领导</option>
                                            <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;└ 测试组</option></select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>显示排序：</th>
                                    <td>
                                        <input class="input" name="sort" type="text" size="40" value="" /></td>
                                </tr>-->
                                <tr>
                                    <th>描 述：</th>
                                    <td>
                                        <textarea name="remark" style="width: 400px;"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <div class="commonBtnArea">
                            <button class="btn submit">提交</button></div>
                    </div>
                </div>
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

        <script type="text/javascript">$(function() {
                $(".submit").click(function() {
                    $("form").submit();
                });
            });
		</script>
    </body>
</html>