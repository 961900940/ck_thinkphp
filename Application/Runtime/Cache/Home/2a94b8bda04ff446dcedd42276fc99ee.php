<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <!--公共头-->
    
        <title>jQuery MiniUI V3.0 Api Documentation</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="jquery,datagrid,grid,表格控件,ajax,web开发,java开发,.net开发,tree,table,treegrid" />
        <meta name="description" content="jQuery MiniUI - 专业WebUI控件库。jQuery MiniUI是使用Javascript实现的前端Ajax组件库，支持所有浏览器，可以跨平台开发，如Java、.Net、PHP等。" />
        <script src="/ck_thinkphp/Public/static/miniui/scripts/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script src="/ck_thinkphp/Public/static/miniui/scripts/miniui/miniui.js" type="text/javascript"></script>
        <link href="/ck_thinkphp/Public/static/miniui/scripts/miniui/themes/default/miniui.css" rel="stylesheet" type="text/css" />
        <style type="text/css">html, html body{ padding:0;border:0;margin:0; width:100%;height:100%;overflow:hidden; font-family:Verdana; font-size:12px; line-height:22px; } .header{ background:url("/ck_thinkphp/Public/static/miniui/docs/api/images/header.gif") repeat-x; } .header div{ font-family:'Trebuchet MS',Arial,sans-serif; font-size:25px;line-height:60px;padding-left:10px;font-weight:bold;color:#333; } body .header .topNav{ position:absolute;right:8px;top:10px; font-size:12px; line-height:25px; } .header .topNav a{ text-decoration:none; color:#222; font-weight:normal; font-size:12px; line-height:25px; margin-left:3px; margin-right:3px; } .header .topNav a:hover{ text-decoration:underline; color:Blue; } .mini-layout-region-south img{ vertical-align:top; }</style>
        <script src="/ck_thinkphp/Public/static/miniui/docs/core.js" type="text/javascript"></script>


</head>
<body>
    <div class="mini-layout" style="width:100%;height:100%;">
        <!-- <div title="north" region="north" class="header" bodyStyle="overflow:hidden;" height="80" showHeader="false" allowResize="false">
            <div>jQuery MiniUI Api Documentation</div>
            <div class="topNav">
                <a href="<?php echo U('Index/versioninfo');?>">首页</a>|
                <a href="<?php echo U('Index/versioninfo');?>">在线示例</a>|
                <a href="<?php echo U('Index/versioninfo');?>">Api手册</a>|
                <a href="<?php echo U('Index/versioninfo');?>">开发教程</a>|
                <a href="<?php echo U('Index/versioninfo');?>">快速入门</a></div>
        </div>
        <div showHeader="false" region="south" style="border:0;text-align:center;" height="25" showSplit="false">Copyright © 上海普加软件有限公司版权所有</div> -->
        <div region="west" title="Api Documentation" showHeader="true" bodyStyle="padding-left:1px;" width="230" minWidth="100" maxWidth="350">
            <!--菜单-->
            
    <ul id="apiTree" class="mini-tree" showTreeIcon="true" style="width:100%;height:100%;" enableHotTrack="false" onbeforeexpand="onBeforeExpand">
        <li>
            <a href="<?php echo U('Index/versioninfo');?>" target="main">Overview</a></li>
        <li>
            <span expanded="true">Apache配置<span style="color:Red;">New!</span></span>
            <ul>
                <li>
                    <a href="<?php echo U('Index/apache_1');?>" target="main">局域网下，他人访问本地文件</a></li>
                <li>
                    <a href="<?php echo U('Index/apache_2');?>" target="main">配置虚拟域名</a></li>
            </ul>
        </li>
        <li>
            <span expanded="false">Thinkphp框架</span>
            <ul>
                <li>
                    <a href="<?php echo U('Index/thinkphp_1');?>" target="main">URL访问</a></li>
                <li>
                    <a href="<?php echo U('Index/thinkphp_2');?>" target="main">thinkPHP配置文件</a></li>
                <li>
                    <a href="<?php echo U('Index/thinkphp_3');?>" target="main">数据库操作</a></li>
                <li>
                    <a href="<?php echo U('Index/thinkphp_4');?>" target="main">视图、控制器、模型交互</a></li>
                <li>
                    <a href="<?php echo U('Index/thinkphp_5');?>" target="main">预定义常量、系统常量、路径常量</a></li>
                    <li>
                        <span expanded="false">Lists</span>
                        <ul>
                            <li>
                                <a href="<?php echo U('Index/versioninfo');?>" target="main">DataGrid</a></li>
                            <li>
                                <a href="<?php echo U('Index/versioninfo');?>" target="main">Tree</a></li>
                            <li>
                                <a href="<?php echo U('Index/versioninfo');?>" target="main">TreeGrid</a></li>
                        </ul>
                    </li>
            </ul>
        </li>
        <li>
            <span expanded="false">CodeIgniter框架</span>
            <ul>
                <li>
                    <a href="<?php echo U('Index/codeigniter_1');?>" target="main">URL访问</a></li>
                <li>
                    <a href="<?php echo U('Index/codeigniter_2');?>" target="main">CodeIgniter配置文件</a></li>
                <li>
                    <a href="<?php echo U('Index/codeigniter_3');?>" target="main">数据库操作</a></li>
                <li>
                    <a href="<?php echo U('Index/codeigniter_4');?>" target="main">视图、控制器、模型交互</a></li>
                <li>
                    <a href="<?php echo U('Index/codeigniter_5');?>" target="main">预定义常量、系统常量、路径常量</a></li>
            </ul>
        </li>
        <li>
            <span expanded="false">Layouts</span>
            <ul>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Fit</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Panel</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Window</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Splitter</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Layout</a></li>
            </ul>
        </li>
        <li>
            <span expanded="false">Navigations</span>
            <ul>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Pager</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">OutlookBar</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">OutlookMenu</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">OutlookTree</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Tree</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Tabs</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">Menu</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>" target="main">MenuItem</a></li>
                <li>
                    <a href="<?php echo U('Index/versioninfo');?>l" target="main">Toolbar</a></li>
            </ul>
        </li>
    </ul>


        </div>
        <div title="center" region="center" bodyStyle="overflow:hidden;">
            <iframe onload="onIFrameLoad(this)" src="<?php echo U('Index/versioninfo');?>" id="mainframe" frameborder="0" name="main" style="width:100%;height:100%;" border="0"></iframe>
        </div>  
    </div>  
    <!--公共尾-->
    
	<script type="text/javascript">
	    mini.parse();
	    function onBeforeExpand(e) {
	        var tree = e.sender;
	        var nowNode = e.node;
	        var level = tree.getLevel(nowNode);

	        var root = tree.getRootNode();        
	        tree.cascadeChild(root, function (node) {
	            if (tree.isExpandedNode(node)) {
	                var level2 = tree.getLevel(node);
	                if (node != nowNode && !tree.isAncestor(node, nowNode) && level == level2) {
	                    tree.collapseNode(node, true);
	                }
	            }
	        });
	    }
	</script>
	<script src="/ck_thinkphp/Public/static/miniui/scripts/tongji.js" type="text/javascript"></script>

</body>
</html>