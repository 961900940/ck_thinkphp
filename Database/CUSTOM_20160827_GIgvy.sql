# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-27 23:45:53 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_auth_role,ks_content共2个表的数据



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
INSERT INTO `ks_content` VALUES ( '1', '我喜欢大美女', '1', '0', '1', '1', '<p>大美女</p><p><img src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317178348.jpg" _src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317178348.jpg" style=""/></p><p><img src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317195986.jpg" _src="http://localhost/ck_thinkphp/Public/static/umeditor1_2_2-utf8-php/php/images/20160817/14714317195986.jpg" style=""/></p><p><br/></p>', '2016-08-18 17:00:13', '2016-08-17 19:02:04');
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



