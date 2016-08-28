# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-28 20:46:23 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_content共1个表的数据



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
INSERT INTO `ks_content` VALUES ( '12', '8888', '1', '1', '1', '2', '<img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115706_35364.jpg" alt="" height="400" width="284" /><img src="/ck_thinkphp/Public/static/kindeditor/php/../../../../upload/image/20160819/20160819115706_70688.jpg" alt="" height="399" width="421" />', '2016-08-19 11:57:24', '2016-08-23 23:12:47');



