# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-28 20:46:28 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_auth_admin共1个表的数据



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



