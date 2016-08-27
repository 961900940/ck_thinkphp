# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-27 23:45:45 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_auth_access共1个表的数据



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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='权限表';
INSERT INTO `ks_auth_access` VALUES ( '1', '管理首页', '0', 'Index', '', '1', '0', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '2', '内容管理', '0', 'Content', '', '2', '0', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '3', '权限管理', '0', 'Access', '', '3', '0', '3', '1');
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
INSERT INTO `ks_auth_access` VALUES ( '18', '内容管理列表', '2', 'Content', 'index', '2-18', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '19', '资讯管理', '0', 'News', '', '19', '0', '4', '1');
INSERT INTO `ks_auth_access` VALUES ( '20', '咨询列表', '19', 'News', 'index', '19-20', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '21', '添加咨询', '19', 'News', 'addNews', '19-21', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '22', '添加内容', '2', 'Content', 'addContent', '2-22', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '23', '文章管理', '0', 'Article', '', '23', '0', '5', '1');
INSERT INTO `ks_auth_access` VALUES ( '24', '文章列表', '23', 'Article', 'index', '23-24', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '25', '添加文章', '23', 'Article', 'addArticle', '23-25', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '26', '文章分类管理', '23', 'Article', 'category', '23-26', '1', '3', '1');
INSERT INTO `ks_auth_access` VALUES ( '27', '检测title是否重复', '23', 'Article', 'checkContentsTitle', '23-27', '2', '4', '0');
INSERT INTO `ks_auth_access` VALUES ( '28', '编辑', '23', 'Article', 'editArticle', '23-28', '2', '5', '0');
INSERT INTO `ks_auth_access` VALUES ( '29', '删除', '23', 'Article', 'delArticle', '23-29', '2', '6', '0');
INSERT INTO `ks_auth_access` VALUES ( '30', '数据管理', '0', 'SysData', '', '30', '0', '6', '1');
INSERT INTO `ks_auth_access` VALUES ( '31', '数据库列表', '30', 'SysData', 'index', '30-31', '1', '1', '1');
INSERT INTO `ks_auth_access` VALUES ( '32', '数据库备份', '30', 'SysData', 'backup', '30-32', '2', '2', '0');
INSERT INTO `ks_auth_access` VALUES ( '33', '数据库导入', '30', 'SysData', 'restore', '30-33', '1', '2', '1');
INSERT INTO `ks_auth_access` VALUES ( '34', '发送邮箱', '30', 'SysData', 'sendSql', '30-34', '2', '3', '0');
INSERT INTO `ks_auth_access` VALUES ( '35', '删除备份文件', '30', 'SysData', 'delSqlFiles', '30-35', '2', '4', '0');
INSERT INTO `ks_auth_access` VALUES ( '36', '打包备份文件', '30', 'SysData', 'zipSql', '30-36', '2', '5', '0');



