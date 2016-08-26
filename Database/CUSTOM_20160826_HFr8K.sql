# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-26 13:25:56 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_article_category,ks_auth_access,ks_auth_admin,ks_auth_role,ks_content共5个表的数据



# 数据库表：ks_article_category 结构信息
DROP TABLE IF EXISTS `ks_article_category`;

CREATE TABLE `ks_article_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) DEFAULT NULL COMMENT '分类名称',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章分类表';
INSERT INTO `ks_article_category` VALUES ( '1', '小说', '2016-08-18 15:55:05', '2016-08-18 15:55:05');
INSERT INTO `ks_article_category` VALUES ( '2', '诗歌', '2016-08-18 15:55:15', '2016-08-18 15:55:15');
INSERT INTO `ks_article_category` VALUES ( '3', '戏剧', '2016-08-18 15:55:30', '2016-08-18 15:55:30');
INSERT INTO `ks_article_category` VALUES ( '4', '散文', '2016-08-18 15:55:38', '2016-08-18 15:55:38');



# 数据库表：ks_auth_access 结构信息
DROP TABLE IF EXISTS `ks_auth_access`;

CREATE TABLE `ks_auth_access` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) DEFAULT NULL COMMENT '控制器',
  `auth_a` varchar(32) DEFAULT NULL COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '级别: 0一级分类 ，1二级分类,左侧菜单 2二级分类，详情操作',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `is_display` tinyint(1) NOT NULL COMMENT '操作分类 1显示 0不显示(右侧操作详情)',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='权限表';
INSERT INTO `ks_auth_access` VALUES ( '1', '管理首页', '0', 'Index', '', '1', '0', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '3', '权限管理', '0', 'Access', '', '3', '0', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '4', '系统信息', '1', 'Index', 'index', '1-4', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '5', '修改密码', '1', 'Index', 'myInfo', '1-5', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '6', '后台用户', '3', 'Access', 'index', '3-6', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '7', '编辑管理员', '3', 'Access', 'editAdmin', '3-7', '2', '2', '0');
INSERT INTO `ks_auth_access` VALUES ( '8', '添加管理员', '3', 'Access', 'addAdmin', '3-8', '1', '3', '1');
INSERT INTO `ks_auth_access` VALUES ( '9', '角色管理', '3', 'Access', 'roleList', '3-9', '1', '4', '1');
INSERT INTO `ks_auth_access` VALUES ( '10', '角色快捷开启禁用', '3', 'Access', 'roleStatus', '3-10', '2', '5', '0');
INSERT INTO `ks_auth_access` VALUES ( '11', '编辑角色', '3', 'Access', 'editRole', '3-11', '2', '6', '0');
INSERT INTO `ks_auth_access` VALUES ( '12', '角色分配权限', '3', 'Access', 'changeRole', '3-12', '2', '7', '0');
INSERT INTO `ks_auth_access` VALUES ( '13', '添加角色', '3', 'Access', 'addRole', '3-13', '1', '8', '1');
INSERT INTO `ks_auth_access` VALUES ( '14', '节点管理', '3', 'Access', 'nodeList', '3-14', '1', '9', '1');
INSERT INTO `ks_auth_access` VALUES ( '15', '节点快捷开启禁用', '3', 'Access', 'nodeStatus', '3-15', '2', '10', '0');
INSERT INTO `ks_auth_access` VALUES ( '16', '编辑节点', '3', 'Access', 'editNode', '3-16', '2', '11', '0');
INSERT INTO `ks_auth_access` VALUES ( '17', '添加节点', '3', 'Access', 'addNode', '3-17', '1', '12', '1');
INSERT INTO `ks_auth_access` VALUES ( '20', '咨询管理', '0', 'News', '', '20', '0', '3', '1');
INSERT INTO `ks_auth_access` VALUES ( '21', '咨询列表', '20', 'News', 'index', '20-21', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '22', '添加咨询', '20', 'News', 'addNews', '20-22', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '23', '内容管理', '0', 'Content', '', '23', '0', '4', '1');
INSERT INTO `ks_auth_access` VALUES ( '24', '内容列表', '23', 'Content', 'index', '23-24', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '25', '添加内容', '23', 'Content', 'addContent', '23-25', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '26', '文章管理', '0', 'Article', '', '26', '0', '5', '1');
INSERT INTO `ks_auth_access` VALUES ( '27', '文章列表', '26', 'Article', 'index', '26-27', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '28', '添加文章', '26', 'Article', 'addArticle', '26-28', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '29', '文章分类管理', '26', 'Article', 'category', '26-29', '1', '3', '1');
INSERT INTO `ks_auth_access` VALUES ( '30', '检测title是否重复', '26', 'Article', 'checkContentsTitle', '26-30', '2', '4', '0');
INSERT INTO `ks_auth_access` VALUES ( '31', '编辑', '26', 'Article', 'editArticle', '26-31', '2', '5', '0');
INSERT INTO `ks_auth_access` VALUES ( '32', '删除', '26', 'Article', 'delArticle', '26-32', '2', '6', '0');
INSERT INTO `ks_auth_access` VALUES ( '33', '导出记录', '26', 'Article', 'down_excel', '26-33', '2', '7', '0');
INSERT INTO `ks_auth_access` VALUES ( '34', '数据管理', '0', 'SysData', '', '34', '0', '6', '1');
INSERT INTO `ks_auth_access` VALUES ( '35', '数据库列表', '34', 'SysData', 'index', '34-35', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '36', '数据库导入', '34', 'SysData', 'restore', '34-36', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '37', '数据库压缩包', '34', 'SysData', 'zipList', '34-37', '1', '3', '1');
INSERT INTO `ks_auth_access` VALUES ( '38', '数据库优化修复', '34', 'SysData', 'repair', '34-38', '1', '4', '1');
INSERT INTO `ks_auth_access` VALUES ( '39', '数据库备份', '34', 'SysData', 'backup', '34-39', '2', '5', '0');



# 数据库表：ks_auth_admin 结构信息
DROP TABLE IF EXISTS `ks_auth_admin`;

CREATE TABLE `ks_auth_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID（唯一识别号）',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '登录密码',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `email` varchar(50) DEFAULT NULL COMMENT '用户邮箱',
  `status` int(11) DEFAULT '1' COMMENT '启用状态：0:表示禁用；1:表示启用',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `logintime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最近一次登录时间',
  `loginip` varchar(15) DEFAULT NULL COMMENT '最近登录的IP地址',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表';
INSERT INTO `ks_auth_admin` VALUES ( '1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', 'admin', 'a@a.com', '1', '我是超级管理员 哈哈~~', '2016-06-07 16:25:44', '2016-06-17 12:03:26', '127.0.0.1');
INSERT INTO `ks_auth_admin` VALUES ( '2', 'ck', 'e10adc3949ba59abbe56e057f20f883e', '2', 'ck', 'b@b.com', '1', '一般管理员', '2016-06-07 16:26:51', '2016-06-17 12:03:31', '127.0.0.1');
INSERT INTO `ks_auth_admin` VALUES ( '3', 'wtf', 'e10adc3949ba59abbe56e057f20f883e', '3', '王腾飞', 'c@c.com', '1', '权限管理员', '2016-06-07 16:27:39', '2016-06-20 17:21:59', '127.0.0.1');
INSERT INTO `ks_auth_admin` VALUES ( '4', 'cyd', 'e10adc3949ba59abbe56e057f20f883e', '4', '', '', '1', '内容发布管理员', '2016-06-16 10:20:24', '2016-06-17 16:11:59', '127.0.0.1');
INSERT INTO `ks_auth_admin` VALUES ( '5', 'grz', 'e10adc3949ba59abbe56e057f20f883e', '2', '', '', '0', '一般管理员', '2016-06-17 15:49:35', '2016-06-22 10:12:37', '127.0.0.1');
INSERT INTO `ks_auth_admin` VALUES ( '6', 'zxl', 'e10adc3949ba59abbe56e057f20f883e', '6', '', '', '1', '内容发布员', '2016-06-17 16:00:37', '2016-06-21 13:06:47', '127.0.0.1');



# 数据库表：ks_auth_role 结构信息
DROP TABLE IF EXISTS `ks_auth_role`;

CREATE TABLE `ks_auth_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) DEFAULT NULL COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '模块-操作',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0禁用 1启用',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='角色表';
INSERT INTO `ks_auth_role` VALUES ( '1', '超级管理员', '*', '*', '1', '系统内置超级管理员组，不受权限分配账号限制');
INSERT INTO `ks_auth_role` VALUES ( '2', '管理员', '*', '*', '1', '拥有系统仅此于超级管理员的权限');
INSERT INTO `ks_auth_role` VALUES ( '3', '权限管理员', '1,5,3,16,15,12,11,10,7,6,8,9,13,14,17', 'Index-myInfo,Access-index,Access-editAdmin,Access-addAdmin,Access-roleList,Access-roleStatus,Access-editRole,Access-changeRole,Access-addRole,Access-nodeList,Access-nodeStatus,Access-editNode,Access-addNode', '1', '权限栏目管理所有权限');
INSERT INTO `ks_auth_role` VALUES ( '4', '内容管理员', '1,2,5', 'Index-myInfo', '1', '内容栏目管理所有权限，修改密码，系统信息');
INSERT INTO `ks_auth_role` VALUES ( '5', '网站维护员', '1,5,2', 'Index-myInfo', '0', '修改密码，内容管理所有权限');



# 数据库表：ks_content 结构信息
DROP TABLE IF EXISTS `ks_content`;

CREATE TABLE `ks_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL COMMENT '标题',
  `status` tinyint(1) DEFAULT NULL COMMENT '1 发布，0 未发布',
  `is_hot` tinyint(1) DEFAULT NULL COMMENT '1热门，0不热门',
  `is_top` tinyint(1) DEFAULT NULL COMMENT '1 置顶，0 不置顶',
  `cid` int(3) DEFAULT NULL COMMENT '文章分类',
  `content` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章列表';
INSERT INTO `ks_content` VALUES ( '1', '我喜欢大美女', '1', '0', '1', '1', '<p>
	大美女
</p>
<p>
	<img src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317178348.jpg" height="679" width="449" /><img src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317195986.jpg" height="676" width="517" />
</p>
<p>
	<br />
</p>', '2016-08-18 17:00:13', '2016-08-24 18:18:52');
INSERT INTO `ks_content` VALUES ( '2', '大美女', '1', '1', '0', '2', '<p>我爱美女</p><p><img src="/ck_thinkphp/upload/image/20160817/1471431760395203.jpg" title="1471431760395203.jpg"/></p><p><img src="/ck_thinkphp/upload/image/20160817/1471431760147254.jpg" title="1471431760147254.jpg"/></p><p><br/></p>', '2016-08-18 17:00:19', '2016-08-17 19:02:44');
INSERT INTO `ks_content` VALUES ( '3', '小妖精', '0', '0', '0', '3', '哈哈哈<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160817/20160817190352_41582.jpg" alt="" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160817/20160817190352_84729.jpg" alt="" />', '2016-08-18 17:00:26', '2016-08-17 19:03:58');
INSERT INTO `ks_content` VALUES ( '4', '看美女喽', '0', '1', '1', '1', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160818/20160818175719_32370.jpg" alt="" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160818/20160818175719_84679.jpg" alt="" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160818/20160818175719_75541.jpg" alt="" />', '2016-08-18 17:57:26', '2016-08-18 17:57:26');
INSERT INTO `ks_content` VALUES ( '5', '111', '0', '1', '0', '1', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819114856_32423.jpg" alt="" />', '2016-08-19 11:49:00', '2016-08-19 11:49:00');
INSERT INTO `ks_content` VALUES ( '6', '222', '1', '1', '0', '2', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819114936_35339.jpg" alt="" />', '2016-08-19 11:49:38', '2016-08-19 11:51:13');
INSERT INTO `ks_content` VALUES ( '7', '333', '0', '1', '1', '3', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819114958_24400.jpg" alt="" />', '2016-08-19 11:50:00', '2016-08-19 11:51:17');
INSERT INTO `ks_content` VALUES ( '8', '444', '1', '1', '0', '2', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115152_58559.jpg" alt="" />', '2016-08-19 11:51:58', '2016-08-19 11:51:58');
INSERT INTO `ks_content` VALUES ( '9', '5555', '1', '1', '1', '4', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115358_40838.jpg" alt="" />', '2016-08-19 11:54:03', '2016-08-19 11:54:03');
INSERT INTO `ks_content` VALUES ( '10', '66666', '0', '1', '1', '4', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115530_94399.jpg" alt="" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115530_17069.jpg" alt="" height="498" width="340" />', '2016-08-19 11:55:50', '2016-08-19 11:55:50');
INSERT INTO `ks_content` VALUES ( '11', '777777', '1', '0', '0', '4', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115611_52398.jpg" alt="" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115611_68364.jpg" alt="" height="610" width="499" />', '2016-08-19 11:56:32', '2016-08-19 11:56:32');
INSERT INTO `ks_content` VALUES ( '12', '8888', '1', '1', '1', '2', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115706_35364.jpg" alt="" height="400" width="284" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115706_70688.jpg" alt="" />', '2016-08-19 11:57:24', '2016-08-19 11:57:24');



