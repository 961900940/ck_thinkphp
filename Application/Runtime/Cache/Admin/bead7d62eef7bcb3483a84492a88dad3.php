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
                        <font id="today"></font>您的位置：权限管理 > 编辑节点
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
                            <div class="current">编辑节点</div></div>
                        <form action="" method="post">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                                <tr>
                                    <th width="120">名称：</th>
                                    <td>
                                        <input name="auth_ac" type="text" class="input" size="40" value="<?php
 if($auth_id_info['auth_level'] ==0){ echo $auth_id_info['auth_c']; }else{ echo $auth_id_info['auth_a']; } ?>" />
                                        英文，为MODEL_NAME的时候首字母大写
                                    </td>
                                </tr>
                                <tr>
                                    <th>显示名：</th>
                                    <td>
                                        <input class="input" name="auth_name" type="text" size="40" value="<?php echo $auth_id_info['auth_name'];?>" />中英文均可</td></tr>
                                <tr>
                                    <th>状态：</th>
                                    <td>
                                        <select name="status" style="width: 80px;">
                                            <option value="1" selected>启用</option>
                                            <option value="0">禁用</option></select>如果禁用那么只有超级管理员才可以访问，其他用户都无权访问</td>
                                </tr>
                                <tr>
                                    <th>类型：</th>
                                    <td>
                                        <select name="auth_level" style="min-width: 80px;">
                                            <option value="0" <?php if($auth_id_info['auth_level'] ==0) echo selected; ?>>模块</option>
                                            <option value="1" <?php if($auth_id_info['auth_level'] ==1) echo selected; ?>>操作</option>
                                            <option value="2" <?php if($auth_id_info['auth_level'] ==2) echo selected; ?>>具体操作</option>
                                        </select>模块(MODEL_NAME); 操作(ACTION_NAME);右侧具体操作(ACTION_NAME);若为右侧具体操作，则不显示
                                    </td>
                                </tr>
                                <tr>
                                    <th>父级节点：</th>
                                    <td>
                                        <select name="auth_pid" style="min-width: 80px;">
                                            <option value="0" level="-1">根节点(后台管理)</option>
                                            <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["auth_pid"]); ?>" level="<?php echo ($vo["auth_level"]); ?>" <?php if($auth_id_info['auth_id'] ==$vo['auth_id']) echo selected;?>>

                                                    <?php if($vo['auth_level'] == 0 ): ?>&nbsp;&nbsp;&nbsp;&nbsp;├ <?php echo ($vo["auth_name"]); ?>
                                                        <?php else: ?> &nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ <?php echo ($vo["auth_name"]); endif; ?>
                                                </option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            <!-- <option value="2" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 管理首页</option>
                                            <option value="6" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 我的个人信息</option>
                                            <option value="5" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 默认页</option>
                                            <option value="3" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 注册会员管理</option>
                                            <option value="7" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 会员首页</option>
                                            <option value="4" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 系统管理</option>
                                            <option value="10" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 系统设置首页</option>
                                            <option value="11" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 设置系统邮件</option>
                                            <option value="12" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 发送测试邮件</option>
                                            <option value="13" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 系统安全设置</option>
                                            <option value="14" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 权限管理</option>
                                            <option value="8" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 管理员列表</option>
                                            <option value="9" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加管理员</option>
                                            <option value="15" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 查看节点</option>
                                            <option value="16" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 角色列表查看</option>
                                            <option value="17" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加角色</option>
                                            <option value="18" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑角色</option>
                                            <option value="19" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 便捷开启禁用节点</option>
                                            <option value="20" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 便捷开启禁用角色</option>
                                            <option value="21" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑节点</option>
                                            <option value="22" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加节点</option>
                                            <option value="23" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加管理员</option>
                                            <option value="24" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑管理员信息</option>
                                            <option value="25" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 权限分配</option>
                                            <option value="26" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 资讯管理</option>
                                            <option value="27" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 新闻列表</option>
                                            <option value="28" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 新闻分类管理</option>
                                            <option value="29" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 发布新闻</option>
                                            <option value="30" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑新闻</option>
                                            <option value="31" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除信息</option>
                                            <option value="76" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 快速推荐</option>
                                            <option value="77" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 快速审核</option>
                                            <option value="32" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 数据库管理</option>
                                            <option value="33" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 查看数据库表结构信息</option>
                                            <option value="34" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 备份数据库</option>
                                            <option value="35" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 查看已备份SQL文件</option>
                                            <option value="36" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 执行数据库还原操作</option>
                                            <option value="37" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除SQL文件</option>
                                            <option value="38" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 邮件发送SQL文件</option>
                                            <option value="39" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 打包SQL文件</option>
                                            <option value="40" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 查看已打包SQL文件</option>
                                            <option value="41" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 解压缩ZIP文件</option>
                                            <option value="42" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除zip压缩文件</option>
                                            <option value="43" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 下载备份的SQL,ZIP文件</option>
                                            <option value="44" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 数据库优化修复</option>
                                            <option value="46" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 网站功能</option>
                                            <option value="47" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 菜单列表</option>
                                            <option value="48" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加/编辑菜单</option>
                                            <option value="49" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 轮播列表</option>
                                            <option value="50" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加/编辑轮播</option>
                                            <option value="51" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 单页列表</option>
                                            <option value="52" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加/编辑单页</option>
                                            <option value="53" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 标签列表</option>
                                            <option value="54" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加/编辑标签</option>
                                            <option value="55" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 模版标签生成</option>
                                            <option value="56" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 文件管理</option>
                                            <option value="57" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 友情链接列表</option>
                                            <option value="58" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加/编辑友情链接</option>
                                            <option value="59" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 留言信息列表</option>
                                            <option value="61" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除单页</option>
                                            <option value="62" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除轮播</option>
                                            <option value="63" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除友情链接</option>
                                            <option value="64" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除留言</option>
                                            <option value="65" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除标签</option>
                                            <option value="66" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 文章分类</option>
                                            <option value="60" level="2">&nbsp;&nbsp;&nbsp;&nbsp;├ 产品管理</option>
                                            <option value="67" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 产品列表</option>
                                            <option value="68" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 编辑产品</option>
                                            <option value="69" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 添加产品</option>
                                            <option value="70" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 分类列表</option>
                                            <option value="71" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 删除产品</option>
                                            <option value="72" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 快速推荐</option>
                                            <option value="73" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 快速审核</option>
                                            <option value="74" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├ 手机推荐</option>
                                            <option value="75" level="3">&nbsp;&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;└ 标题检查</option>
                                            <option value="78" level="2">&nbsp;&nbsp;&nbsp;&nbsp;└ 模型管理</option>
                                            <option value="79" level="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ 模型列表</option>
                                            <option value="80" level="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ 添加模型</option></select> -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>显示排序：</th>
                                    <td>
                                        <input class="input" name="sort" type="text" size="40" value="<?php echo $auth_id_info['sort'];?>" /></td>
                                </tr>
                            </table>
                            <input type="hidden" name="auth_id" value="<?php echo ($auth_id_info["auth_id"]); ?>" /></form>
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

        <script type="text/javascript">
            $(function() {
                $(".submit").click(function() {
                    $("form").submit();
                });
            });
        </script>
    </body>
</html>