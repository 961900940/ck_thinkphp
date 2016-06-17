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
                        <font id="today"></font>您的位置：权限管理 > 节点管理
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
                    <div class="Item hr">
                        <div class="current">节点管理</div>
                    </div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
					    <thead>
					        <tr>
					            <td>序号</td>
					            <td>节点结构
					                <b title="单击分类隐藏/显示该分类下在子类">[i]</b></td>
					            <td>节点ID</td>
					            <td>名称</td>
					            <td>显示名</td>
					            <td>排序名称</td>
					            <td>类型</td>
					            <td>状态</td>
					            <td width="150">操作</td></tr>
					    </thead>
					    <tr align="center" id="1" pid="0">
					        <td>1</td>
					        <td align="left" class="tree" style="cursor: pointer;">后台管理</td>
					        <td>1</td>
					        <td>Admin</td>
					        <td>后台管理</td>
					        <td edit="0" fd="sort">10</td>
					        <td>项目（GROUP_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=1" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="2" pid="1">
					        <td>2</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;├ 管理首页</td>
					        <td>2</td>
					        <td>Index</td>
					        <td>管理首页</td>
					        <td edit="0" fd="sort">1</td>
					        <td>模块(MODEL_NAME)</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=2" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="5" pid="2">
					        <td>3</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 默认页</td>
					        <td>5</td>
					        <td>index</td>
					        <td>默认页</td>
					        <td edit="0" fd="sort">5</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=5" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="6" pid="2">
					        <td>4</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 我的个人信息</td>
					        <td>6</td>
					        <td>myInfo</td>
					        <td>我的个人信息</td>
					        <td edit="0" fd="sort">6</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=6" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="3" pid="1">
					        <td>5</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;├ 注册会员管理</td>
					        <td>3</td>
					        <td>Member</td>
					        <td>注册会员管理</td>
					        <td edit="0" fd="sort">3</td>
					        <td>模块(MODEL_NAME)</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=3" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="7" pid="3">
					        <td>6</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 会员首页</td>
					        <td>7</td>
					        <td>index</td>
					        <td>会员首页</td>
					        <td edit="0" fd="sort">7</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=7" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="4" pid="1">
					        <td>7</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;├ 系统管理</td>
					        <td>4</td>
					        <td>Webinfo</td>
					        <td>系统管理</td>
					        <td edit="0" fd="sort">4</td>
					        <td>模块(MODEL_NAME)</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=4" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="10" pid="4">
					        <td>8</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 系统设置首页</td>
					        <td>10</td>
					        <td>index</td>
					        <td>系统设置首页</td>
					        <td edit="0" fd="sort">10</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=10" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="11" pid="4">
					        <td>9</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 设置系统邮件</td>
					        <td>11</td>
					        <td>setEmailConfig</td>
					        <td>设置系统邮件</td>
					        <td edit="0" fd="sort">12</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=11" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="12" pid="4">
					        <td>10</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 发送测试邮件</td>
					        <td>12</td>
					        <td>testEmailConfig</td>
					        <td>发送测试邮件</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=12" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="13" pid="4">
					        <td>11</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 系统安全设置</td>
					        <td>13</td>
					        <td>setSafeConfig</td>
					        <td>系统安全设置</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=13" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="14" pid="1">
					        <td>12</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;├ 权限管理</td>
					        <td>14</td>
					        <td>Access</td>
					        <td>权限管理</td>
					        <td edit="0" fd="sort">0</td>
					        <td>模块(MODEL_NAME)</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=14" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="8" pid="14">
					        <td>13</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 管理员列表</td>
					        <td>8</td>
					        <td>index</td>
					        <td>管理员列表</td>
					        <td edit="0" fd="sort">8</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=8" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="9" pid="14">
					        <td>14</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加管理员</td>
					        <td>9</td>
					        <td>addAdmin</td>
					        <td>添加管理员</td>
					        <td edit="0" fd="sort">9</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=9" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="15" pid="14">
					        <td>15</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 查看节点</td>
					        <td>15</td>
					        <td>nodeList</td>
					        <td>查看节点</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=15" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="16" pid="14">
					        <td>16</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 角色列表查看</td>
					        <td>16</td>
					        <td>roleList</td>
					        <td>角色列表查看</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=16" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="17" pid="14">
					        <td>17</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加角色</td>
					        <td>17</td>
					        <td>addRole</td>
					        <td>添加角色</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=17" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="18" pid="14">
					        <td>18</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑角色</td>
					        <td>18</td>
					        <td>editRole</td>
					        <td>编辑角色</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=18" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="19" pid="14">
					        <td>19</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 便捷开启禁用节点</td>
					        <td>19</td>
					        <td>opNodeStatus</td>
					        <td>便捷开启禁用节点</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=19" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="20" pid="14">
					        <td>20</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 便捷开启禁用角色</td>
					        <td>20</td>
					        <td>opRoleStatus</td>
					        <td>便捷开启禁用角色</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=20" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="21" pid="14">
					        <td>21</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑节点</td>
					        <td>21</td>
					        <td>editNode</td>
					        <td>编辑节点</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=21" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="22" pid="14">
					        <td>22</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加节点</td>
					        <td>22</td>
					        <td>addNode</td>
					        <td>添加节点</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=22" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="23" pid="14">
					        <td>23</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加管理员</td>
					        <td>23</td>
					        <td>addAdmin</td>
					        <td>添加管理员</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=23" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="24" pid="14">
					        <td>24</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑管理员信息</td>
					        <td>24</td>
					        <td>editAdmin</td>
					        <td>编辑管理员信息</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=24" class="edit">编辑</a>]</td></tr>
					    <tr align="center" id="25" pid="14">
					        <td>25</td>
					        <td align="left" class="tree" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 权限分配</td>
					        <td>25</td>
					        <td>changeRole</td>
					        <td>权限分配</td>
					        <td edit="0" fd="sort">0</td>
					        <td>操作（ACTION_NAME）</td>
					        <td>启用</td>
					        <td>[
					            <a href="javascript:void(0);" class="opStatus" val="1">禁用</a>] [
					            <a href="/Tprbac/index.php/conist/Access/editNode?id=25" class="edit">编辑</a>]</td></tr>
					</table>
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

    <script type="text/javascript">
        $(function(){
            //快捷启用禁用操作
            $(".opStatus").click(function(){
                var obj=$(this);
                var id=$(this).parents("tr").attr("id");
                var status=$(this).attr("val");
                $.getJSON("/Tprbac/index.php/conist/Access/opNodeStatus", { id:id, status:status }, function(json){
                    if(json.status==1){
                        popup.success(json.info);
                        $(obj).attr("val",json.data.status).html(status==1?"启用":"禁用").parents("td").prev().html(status==1?"禁用":"启用");
                    }else{
                        popup.alert(json.info);
                    }
                });
            });

            //快捷改变操作排序dblclick
            $("tbody>tr>td[fd]").click(function(){
                var inval = $(this).html();
                var infd = $(this).attr("fd");
                var inid =  $(this).parents("tr").attr("id");
                if($(this).attr('edit')==0){
                    $(this).attr('edit','1').html("<input class='input' size='5' id='edit_"+infd+"_"+inid+"' value='"+inval+"' />").find("input").select();
                }
                $("#edit_"+infd+"_"+inid).focus().bind("blur",function(){
                    var editval = $(this).val();
                    $(this).parents("td").html(editval).attr('edit','0');
                    if(inval!=editval){
                        $.post("/Tprbac/index.php/conist/Access/opSort",{id:inid,fd:infd,sort:editval});
                    }
                })
            });

            var chn=function(cid,op){
                if(op=="show"){
                    $("tr[pid='"+cid+"']").each(function(){
                        $(this).removeAttr("status").show();
                        chn($(this).attr("id"),"show");
                    });
                }else{
                    $("tr[pid='"+cid+"']").each(function(){
                        $(this).attr("status",1).hide();
                        chn($(this).attr("id"),"hide");
                    });
                }
            }
            $(".tree").click(function(){
                if($(this).attr("status")!=1){
                    chn($(this).parent().attr("id"),"hide");
                    $(this).attr("status",1);
                }else{
                    chn($(this).parent().attr("id"),"show");
                    $(this).removeAttr("status");
                }
            });
        });
    </script>
    </body>
</html>