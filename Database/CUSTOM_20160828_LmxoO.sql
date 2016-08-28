# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-28 20:46:33 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_auth_role共1个表的数据



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



