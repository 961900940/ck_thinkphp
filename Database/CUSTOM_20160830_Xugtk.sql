# -----------------------------------------------------------
# database backup files
# 日期:  2016-08-30 12:59:17 
# Type: 管理员后台手动备份
# Description:当前SQL文件包含了表：ks_article_category共1个表的数据



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



