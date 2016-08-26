# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-26 14:12:15 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_article_category,ks_auth_access共2个表的数据



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



