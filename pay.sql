/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3300
Source Database       : pay

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-01 12:25:03
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
INSERT INTO `autumn_admin_user` VALUES ('1', 'admin123', 'ad6916af2136815599c76530ca6f01df', '1', '2017-07-31 19:30:12', '127.0.0.1', '23', '0', '325462');
INSERT INTO `autumn_admin_user` VALUES ('5', '231233122', '4eed63e5a174dd9d2fd9e065e437b138', '9', '0000-00-00 00:00:00', '', '0', '0', '180751');

-- ----------------------------
-- Table structure for autumn_article
-- ----------------------------
DROP TABLE IF EXISTS `autumn_article`;
CREATE TABLE `autumn_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `keywords` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `from_class` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autumn_article
-- ----------------------------
INSERT INTO `autumn_article` VALUES ('12', '支付宝通道维护完毕,请知晓', '支付宝通道维护完毕,请知晓', 0x266C743B702667743BE694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993E694AFE4BB98E5AE9DE9809AE98193E7BBB4E68AA4E5AE8CE6AF952CE8AFB7E79FA5E69993266C743B2F702667743B, '支付宝通道维护完毕,请知晓', '2017-08-01 08:43:46', '2017-08-01 08:43:46', '186', '');

-- ----------------------------
-- Table structure for autumn_card
-- ----------------------------
DROP TABLE IF EXISTS `autumn_card`;
CREATE TABLE `autumn_card` (
  `id` int(11) NOT NULL,
  `card_number` varchar(63) DEFAULT NULL,
  `opening_bank` varchar(255) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autumn_card
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
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of autumn_class
-- ----------------------------
INSERT INTO `autumn_class` VALUES ('185', '185', '0', '0', '新闻管理', '新闻管理', 'class/view', null);
INSERT INTO `autumn_class` VALUES ('186', '185,186', '1', '185', '会员公告', '平台公告', 'class/view', null);

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

-- ----------------------------
-- Table structure for autumn_order
-- ----------------------------
DROP TABLE IF EXISTS `autumn_order`;
CREATE TABLE `autumn_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `paytype` int(11) NOT NULL,
  `money` float NOT NULL,
  `rate` int(11) DEFAULT '0',
  `platform_order_id` varchar(32) NOT NULL,
  `merchant_order_id` varchar(32) NOT NULL,
  `create_time` datetime NOT NULL,
  `arrive_time` datetime NOT NULL,
  `notice_url` varchar(512) NOT NULL,
  `active_url` varchar(512) NOT NULL,
  `attribute` varchar(216) NOT NULL,
  `notice` int(11) DEFAULT '0',
  `notice_count` int(11) DEFAULT '0',
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_order
-- ----------------------------
INSERT INTO `autumn_order` VALUES ('11', '10002', '1', '0.01', '12', '2017073116081082465820', '1231232131', '2017-07-31 16:08:10', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '0', '0', '0');
INSERT INTO `autumn_order` VALUES ('12', '10002', '1', '0.01', '12', '2017073116081590180969', '1231232131', '2017-07-31 16:08:15', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '0', '0', '0');
INSERT INTO `autumn_order` VALUES ('10', '10002', '1', '0.01', '12', '2017073116074691507568', '1231232131', '2017-07-31 16:07:46', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '0', '0', '0');
INSERT INTO `autumn_order` VALUES ('9', '10002', '1', '0.01', '12', '2017073114363411398010', '1231232131', '2017-07-31 14:36:34', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '0', '0', '0');
INSERT INTO `autumn_order` VALUES ('13', '10002', '1', '0.01', '12', '2017073116081697225952', '1231232131', '2017-07-31 16:08:16', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '1', '0', '0');
INSERT INTO `autumn_order` VALUES ('14', '10002', '1', '0.01', '12', '2017073116341391356506', '2017073116081697225952', '2017-07-31 16:34:13', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', '1', '0', '0');

-- ----------------------------
-- Table structure for autumn_passageway
-- ----------------------------
DROP TABLE IF EXISTS `autumn_passageway`;
CREATE TABLE `autumn_passageway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `type` varchar(32) NOT NULL,
  `valueSplit` varchar(1024) NOT NULL,
  `name_key` varchar(26) NOT NULL,
  `open` int(11) NOT NULL,
  `paytype` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_passageway
-- ----------------------------
INSERT INTO `autumn_passageway` VALUES ('1', '花旗支付宝', '[\"支付宝\",\"{\\\"file\\\" : \\\"huaqi\\\" , \\\"function\\\" : \\\"alipay\\\"}\",\"https://www.baidu.com/\",\"10001\",\"kjl3kljkl4nmkl2n1llknlk\",\"12\"]', 'input', '[\"\"]', 'alipay', '0', '支付宝');
INSERT INTO `autumn_passageway` VALUES ('2', '爱扬支付宝', '[\"支付宝\",\"{\\\"file\\\" : \\\"aiyang\\\" , \\\"function\\\" : \\\"alipay\\\"}\",\"https://www.baidu.com/\",\"10001\",\"kjl3kljkl4nmkl2n1llknlk\",\"12\"]', 'input', '[\"\"]', 'alipay', '1', '支付宝');
INSERT INTO `autumn_passageway` VALUES ('4', '爱扬微信', '[\"微信\",\"{\\\"file\\\" : \\\"aiyang\\\" , \\\"function\\\" : \\\"wxpay\\\"}\",\"https://www.baidu.com/\",\"10002\",\"kjl3kljkl4nmkl2n1llknlk\",\"5\"]', 'input', '[\"\"]', 'wxpay', '0', '微信');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_setting
-- ----------------------------
INSERT INTO `autumn_setting` VALUES ('12', '商户最大通知次数', '10', 'input', '[\"\"]', 'merchantCount');
INSERT INTO `autumn_setting` VALUES ('13', '客服工号', '80037', 'input', '[\"\"]', 'customerServiceNumber');
INSERT INTO `autumn_setting` VALUES ('14', '客服QQ', '69384331', 'input', '[\"\"]', 'customerServiceQQ');
INSERT INTO `autumn_setting` VALUES ('15', '客服手机', '12345678901', 'input', '[\"\"]', 'customerServicePhone');

-- ----------------------------
-- Table structure for autumn_user
-- ----------------------------
DROP TABLE IF EXISTS `autumn_user`;
CREATE TABLE `autumn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `slat` int(11) NOT NULL,
  `money` float DEFAULT '0',
  `merchant_key` varchar(32) DEFAULT NULL,
  `from_group` int(11) NOT NULL,
  `lost_time` datetime NOT NULL,
  `lost_ip` varchar(19) NOT NULL,
  `count` int(11) NOT NULL,
  `paytype` varchar(1024) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `present_password` varchar(32) NOT NULL,
  `real_name` int(1) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10003 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of autumn_user
-- ----------------------------
INSERT INTO `autumn_user` VALUES ('1', '测试213455', 'b41558ea6c8951aa8f7a4234484a6bf2', '317089', '0', '411258d4ca2fd0cba8699b53dcf264ca', '1', '0000-00-00 00:00:00', '', '0', '[\"\\u652f\\u4ed8\\u5b9d\"]', '', '', '', '', '0', '0');
INSERT INTO `autumn_user` VALUES ('10002', '1234567890', '31f21c8f0b6313581a22324c0b6b3475', '352675', '0.16', '592614f9ef10dace1d46e3fa1f164aa9', '1', '2017-08-01 08:42:48', '127.0.0.1', '3', '[\"\\u5fae\\u4fe1\",\"\\u652f\\u4ed8\\u5b9d\"]', '', '', '', '', '0', '0');

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
INSERT INTO `autumn_user_group` VALUES ('1', '普通商户', '[\"ds\"]', '2017-07-31 08:29:11');

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

-- ----------------------------
-- Table structure for autumn_withdrawals
-- ----------------------------
DROP TABLE IF EXISTS `autumn_withdrawals`;
CREATE TABLE `autumn_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(32) DEFAULT NULL,
  `money` float DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL,
  `from_card` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of autumn_withdrawals
-- ----------------------------
