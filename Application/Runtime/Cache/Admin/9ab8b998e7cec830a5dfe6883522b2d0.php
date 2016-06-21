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
                    <font id="today"></font>您的位置：权限管理 > 权限分配
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
                        <div class="current">权限分配</div></div>
                    <p>你正在为用户组：
                        <b style="color:red;"><?php echo ($role_info_roleName); ?></b>分配权限 。项目和版块有全选和取消全选功能</p>
                    <form action="/ck_thinkphp/index.php/Admin/Access/changeRole?id=3" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                            <tr>
                                <td style="font-size: 14px;">
                                    <label>
                                        <input name="data[]" level="1" type="checkbox" obj="node_1" value="0" />
                                        <b>[项目]</b>后台管理</label>
                                </td>
                            </tr>
                            <?php foreach ($Prole_list as $k => $v): ?>
                                <tr>
                                    <td style="padding-left: 30px; font-size: 14px;">
                                        <label>
                                            <input name="data[]" level="2" type="checkbox" obj="node_1_<?php echo ($v["auth_id"]); ?>" value="<?php echo ($v["auth_id"]); ?>" />
                                            <b>[模块]</b><?php echo ($v["auth_name"]); ?>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-left: 50px;">
                                        <?php foreach ($Srole_list as $k2 => $v2): ?>
                                        <?php if ($v2['auth_pid'] == $v['auth_id']): ?>
                                            <label>
                                                <input name="data[]" level="3" type="checkbox" obj="node_1_<?php echo ($v["auth_id"]); ?>_<?php echo ($v2["auth_id"]); ?>" value="<?php echo ($v2["auth_id"]); ?>" />
                                                <?php echo ($v2["auth_name"]); ?>
                                            </label>&nbsp;&nbsp;&nbsp;
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <!-- <tr>
                                <td style="padding-left: 30px; font-size: 14px;">
                                    <label>
                                        <input name="data[]" level="2" type="checkbox" obj="node_1_1" value="1:0:0" />
                                        <b>[模块]</b>权限管理</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 50px;">
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_1_10" value="10:1:1" />管理员列表</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_1_11" value="11:1:1" />添加管理员</label>&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px; font-size: 14px;">
                                    <label>
                                        <input name="data[]" level="2" type="checkbox" obj="node_1_3" value="3:0:0" />
                                        <b>[模块]</b>管理首页</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 50px;">
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_3_4" value="4:1:3" />管理员列表</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_3_5" value="5:1:3" />添加管理员</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_3_6" value="6:1:3" />查看节点</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_3_7" value="7:1:3" />角色列表查看</label>&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px; font-size: 14px;">
                                    <label>
                                        <input name="data[]" level="2" type="checkbox" obj="node_1_8" value="" />
                                        <b>[模块]</b>系统管理</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 50px;">
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_8_9" value="" />管理员列表</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_8_9" value="" />添加管理员</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input name="data[]" level="3" type="checkbox" obj="node_1_8_10" value="" />查看节点</label>&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr> -->
                        </table>
                        <input type="hidden" name="id" value="<?php echo ($role_id); ?>" /></form>
                    <div class="commonBtnArea">
                        <button class="btn submit" type="submit">提交</button>
                        <button class="btn reset">重置</button>
                        <button class="btn empty">清空</button></div>
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

        <script type="text/javascript">//初始化数据
            function setAccess() {
                //清空所有已选中的
                $("input[type='checkbox']").prop("checked", false);
                //数据格式：
                //节点ID：node_id；1，项目；2，模块；3，操作
                //节点级别：level；
                //父级节点ID：pid
                // var access = $.parseJSON('[{"val":"1:1:0"},{"val":"1:0:0"},{"val":"10:1:1"},{"val":"11:1:1"},{"val":"3:0:0"},{"val":"4:1:3"},{"val":"5:1:3"},{"val":"6:1:3"},{"val":"7:1:3"}]');
                var access = $.parseJSON('<?php echo ($role_auth_ids_list); ?>');
                var access_length = access.length;
                if (access_length > 0) {
                    for (var i = 0; i < access_length; i++) {
                        $("input[type='checkbox'][value='" + access[i]['val'] + "']").prop("checked", "checked");
                    }
                }
            }
            $(function() {
                //执行初始化数据操作
                setAccess();
                //为项目时候全选本项目所有操作
                $("input[level='1']").click(function() {
                    var obj = $(this).attr("obj") + "_";
                    $("input[obj^='" + obj + "']").prop("checked", $(this).prop("checked"));
                });
                //为模块时候全选本模块所有操作
                $("input[level='2']").click(function() {
                    var obj = $(this).attr("obj") + "_";
                    $("input[obj^='" + obj + "']").prop("checked", $(this).prop("checked"));
                    //分隔obj为数组
                    var tem = obj.split("_");
                    //将当前模块父级选中
                    if ($(this).prop('checked')) {
                        $("input[obj='node_" + tem[1] + "']").prop("checked", "checked");
                    }
                });
                //为操作时只要有勾选就选中所属模块和所属项目
                $("input[level='3']").click(function() {
                    var tem = $(this).attr("obj").split("_");
                    if ($(this).prop('checked')) {
                        //所属项目
                        $("input[obj='node_" + tem[1] + "']").prop("checked", "checked");
                        //所属模块
                        $("input[obj='node_" + tem[1] + "_" + tem[2] + "']").prop("checked", "checked");
                    }
                });
                //重置初始状态，勾选错误时恢复
                $(".reset").click(function() {
                    setAccess();
                });
                //清空当前已经选中的
                $(".empty").click(function() {
                    $("input[type='checkbox']").prop("checked", false);
                });
                $(".submit").click(function() {
                    $('form').submit();
                });
            });</script>
    </body>

</html>