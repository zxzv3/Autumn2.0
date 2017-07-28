/*
Navicat MySQL Data Transfer

Source Server         : localhost_3300
Source Server Version : 50505
Source Host           : localhost:3300
Source Database       : autumn2.0

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-28 18:29:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for autumn_admin_group
-- ----------------------------
DROP TABLE IF EXISTS `autumn_admin_group`;
CREATE TABLE `autumn_admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `limit` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_admin_group
-- ----------------------------
INSERT INTO `autumn_admin_group` VALUES ('1', '超级管理员', '0000-00-00 00:00:00', 'all');
INSERT INTO `autumn_admin_group` VALUES ('8', '321', '2017-07-24 23:50:32', '[\"admin_user_edit\"]');
INSERT INTO `autumn_admin_group` VALUES ('9', '21321321', '2017-07-24 23:51:02', '[\"admin_user_create\"]');

-- ----------------------------
-- Table structure for autumn_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `autumn_admin_user`;
CREATE TABLE `autumn_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `from_group` int(11) NOT NULL,
  `lost_time` datetime NOT NULL,
  `lost_ip` varchar(19) NOT NULL,
  `count` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `slat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autumn_admin_user
-- ----------------------------
INSERT INTO `autumn_admin_user` VALUES ('1', 'admin123', 'ad6916af2136815599c76530ca6f01df', '1', '2017-07-28 08:36:13', '127.0.0.1', '14', '0', '325462');
INSERT INTO `autumn_admin_user` VALUES ('5', '231233122', '4eed63e5a174dd9d2fd9e065e437b138', '9', '0000-00-00 00:00:00', '', '0', '0', '180751');

-- ----------------------------
-- Table structure for autumn_article
-- ----------------------------
DROP TABLE IF EXISTS `autumn_article`;
CREATE TABLE `autumn_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `from_class` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autumn_article
-- ----------------------------

-- ----------------------------
-- Table structure for autumn_class
-- ----------------------------
DROP TABLE IF EXISTS `autumn_class`;
CREATE TABLE `autumn_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `topid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `view` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `song` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of autumn_class
-- ----------------------------
INSERT INTO `autumn_class` VALUES ('182', '182', '0', '0', '顶级栏目2', '顶级栏目', 'class/view', null);
INSERT INTO `autumn_class` VALUES ('183', '182,183', '1', '182', '二级栏目', '二级栏目', 'class/view', null);

-- ----------------------------
-- Table structure for autumn_notice
-- ----------------------------
DROP TABLE IF EXISTS `autumn_notice`;
CREATE TABLE `autumn_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(21) NOT NULL,
  `from_user` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_notice
-- ----------------------------
INSERT INTO `autumn_notice` VALUES ('6', '123123', '&lt;p&gt;12321321312222222222&lt;/p&gt;', 'notice', '-1', '2017-07-28 08:50:48');
INSERT INTO `autumn_notice` VALUES ('10', '312321', '&lt;p&gt;321321&lt;/p&gt;', 'letter', '1', '2017-07-28 09:55:27');

-- ----------------------------
-- Table structure for autumn_setting
-- ----------------------------
DROP TABLE IF EXISTS `autumn_setting`;
CREATE TABLE `autumn_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `type` varchar(32) NOT NULL,
  `valueSplit` varchar(1024) NOT NULL,
  `name_key` varchar(26) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_setting
-- ----------------------------
INSERT INTO `autumn_setting` VALUES ('6', '是否允许用户注册', 'yes', 'input', '[\"\"]', 'allowUserRegedit');
INSERT INTO `autumn_setting` VALUES ('5', '是否开启站点', 'yes', 'input', '[\"\"]', 'allowWebOpen');

-- ----------------------------
-- Table structure for autumn_user
-- ----------------------------
DROP TABLE IF EXISTS `autumn_user`;
CREATE TABLE `autumn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `slat` int(11) NOT NULL,
  `from_group` int(11) NOT NULL,
  `lost_time` datetime NOT NULL,
  `lost_ip` varchar(19) NOT NULL,
  `count` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_user
-- ----------------------------
INSERT INTO `autumn_user` VALUES ('1', '312321', 'b62b8706ad616305a72a60e95eec9dcf', '293168', '1', '0000-00-00 00:00:00', '', '0', '0');

-- ----------------------------
-- Table structure for autumn_user_group
-- ----------------------------
DROP TABLE IF EXISTS `autumn_user_group`;
CREATE TABLE `autumn_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `limit` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_user_group
-- ----------------------------
INSERT INTO `autumn_user_group` VALUES ('1', '普通会员', '[\"ds\"]', '2017-07-26 17:58:19');
INSERT INTO `autumn_user_group` VALUES ('2', '白银会员', '[\"ds\"]', '2017-07-25 10:40:11');
INSERT INTO `autumn_user_group` VALUES ('3', '黄金会员', '[\"ds\"]', '2017-07-25 10:40:24');
INSERT INTO `autumn_user_group` VALUES ('4', '钻石会员', '[\"ds\"]', '2017-07-25 10:40:37');

-- ----------------------------
-- Table structure for autumn_user_setting
-- ----------------------------
DROP TABLE IF EXISTS `autumn_user_setting`;
CREATE TABLE `autumn_user_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `name` varchar(125) NOT NULL,
  `value` varchar(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `from_group` int(11) NOT NULL,
  `valueSplit` varchar(2048) NOT NULL,
  `name_key` varchar(125) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_user_setting
-- ----------------------------
INSERT INTO `autumn_user_setting` VALUES ('8', 'input', '31232', '3123123212', '-1', '[\"\"]', '312321');
