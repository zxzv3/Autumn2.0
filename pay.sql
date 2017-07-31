-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-07-31 08:18:29
-- 服务器版本： 5.5.56-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autumn2.0`
--

-- --------------------------------------------------------

--
-- 表的结构 `autumn_admin_group`
--

CREATE TABLE `autumn_admin_group` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `limit` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_admin_group`
--

INSERT INTO `autumn_admin_group` (`id`, `name`, `create_time`, `limit`) VALUES
(1, '超级管理员', '0000-00-00 00:00:00', 'all'),
(8, '321', '2017-07-24 23:50:32', '[\"admin_user_edit\"]'),
(9, '21321321', '2017-07-24 23:51:02', '[\"admin_user_create\"]');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_admin_user`
--

CREATE TABLE `autumn_admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `from_group` int(11) NOT NULL,
  `lost_time` datetime NOT NULL,
  `lost_ip` varchar(19) NOT NULL,
  `count` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `slat` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `autumn_admin_user`
--

INSERT INTO `autumn_admin_user` (`id`, `username`, `password`, `from_group`, `lost_time`, `lost_ip`, `count`, `state`, `slat`) VALUES
(1, 'admin123', 'ad6916af2136815599c76530ca6f01df', 1, '2017-07-30 23:02:14', '127.0.0.1', 20, 0, '325462'),
(5, '231233122', '4eed63e5a174dd9d2fd9e065e437b138', 9, '0000-00-00 00:00:00', '', 0, 0, '180751');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_article`
--

CREATE TABLE `autumn_article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `keywords` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `from_class` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `autumn_class`
--

CREATE TABLE `autumn_class` (
  `id` int(11) NOT NULL,
  `path` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `topid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `view` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `song` text COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `autumn_class`
--

INSERT INTO `autumn_class` (`id`, `path`, `level`, `topid`, `name`, `description`, `view`, `song`) VALUES
(185, '185', 0, 0, '新闻管理', '新闻管理', 'class/view', NULL),
(186, '185,186', 1, 185, '平台公告', '平台公告', 'class/view', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `autumn_notice`
--

CREATE TABLE `autumn_notice` (
  `id` int(11) NOT NULL,
  `title` varchar(125) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(21) NOT NULL,
  `from_user` int(11) NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `autumn_order`
--

CREATE TABLE `autumn_order` (
  `id` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `paytype` int(11) NOT NULL,
  `money` float NOT NULL,
  `platform_order_id` varchar(32) NOT NULL,
  `merchant_order_id` varchar(32) NOT NULL,
  `create_time` datetime NOT NULL,
  `arrive_time` datetime NOT NULL,
  `notice_url` varchar(512) NOT NULL,
  `active_url` varchar(512) NOT NULL,
  `attribute` varchar(216) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_order`
--

INSERT INTO `autumn_order` (`id`, `from_user`, `paytype`, `money`, `platform_order_id`, `merchant_order_id`, `create_time`, `arrive_time`, `notice_url`, `active_url`, `attribute`, `type`) VALUES
(1, 0, 0, 0.01, '3213213', '21321321', '2017-07-27 00:00:00', '2017-07-31 00:00:00', 'http://www.baidu.com/', 'http://www.baidu.com/', '12321', 0),
(2, 1, 1, 312, '2017073102081430205218', '321', '2017-07-31 02:08:14', '0000-00-00 00:00:00', 'ads', '12312', '321', 0),
(3, 1, 1, 312, '2017073102133117662287', '321', '2017-07-31 02:13:31', '0000-00-00 00:00:00', 'ads', '12312', '321', 0),
(4, 1, 1, 312, '2017073102135647372000', '21321312', '2017-07-31 02:13:56', '0000-00-00 00:00:00', 'ads', '12312', '321', 0),
(5, 1, 1, 312, '2017073102240150176492', '2312321312', '2017-07-31 02:24:01', '0000-00-00 00:00:00', 'ads', '12312', '321', 0),
(6, 1, 1, 312, '2017073102264047096689', '2331232312', '2017-07-31 02:26:40', '0000-00-00 00:00:00', 'http://127.168.0.1/api/v1?money=312', 'http://127.168.0.1/api/v1?money=312', '321', 0);

-- --------------------------------------------------------

--
-- 表的结构 `autumn_passageway`
--

CREATE TABLE `autumn_passageway` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `type` varchar(32) NOT NULL,
  `valueSplit` varchar(1024) NOT NULL,
  `name_key` varchar(26) NOT NULL,
  `open` int(11) NOT NULL,
  `paytype` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_passageway`
--

INSERT INTO `autumn_passageway` (`id`, `name`, `value`, `type`, `valueSplit`, `name_key`, `open`, `paytype`) VALUES
(1, '花旗支付宝', '[\"支付宝\",\"{\\\"file\\\" : \\\"huaqi\\\" , \\\"function\\\" : \\\"alipay\\\"}\",\"https://www.baidu.com/\",\"10001\",\"kjl3kljkl4nmkl2n1llknlk\",\"12\"]', 'input', '[\"\"]', 'alipay', 0, '支付宝'),
(2, '爱扬支付宝', '[\"支付宝\",\"{\\\"file\\\" : \\\"aiyang\\\" , \\\"function\\\" : \\\"alipay\\\"}\",\"https://www.baidu.com/\",\"10001\",\"kjl3kljkl4nmkl2n1llknlk\",\"12\"]', 'input', '[\"\"]', 'alipay', 1, '支付宝'),
(4, '爱扬微信', '[\"微信\",\"wxpay\",\"https://www.baidu.com/\",\"10002\",\"kjl3kljkl4nmkl2n1llknlk\",\"5\"]', 'input', '[\"\"]', 'wxpay', 0, '微信');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_setting`
--

CREATE TABLE `autumn_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `type` varchar(32) NOT NULL,
  `valueSplit` varchar(1024) NOT NULL,
  `name_key` varchar(26) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_setting`
--

INSERT INTO `autumn_setting` (`id`, `name`, `value`, `type`, `valueSplit`, `name_key`) VALUES
(6, '是否允许用户注册', 'yes', 'input', '[\"\"]', 'allowUserRegedit'),
(5, '是否开启站点', 'yes', 'input', '[\"\"]', 'allowWebOpen'),
(7, '短信接口密钥', '7c1cadb6887373dacb595c47166bfbd9', 'input', '[\"\"]', 'SmsInterfaceKey'),
(8, '客服QQ', '208006737', 'input', '[\"\"]', 'serviceQq'),
(9, '商户注册是否审核', 'no', 'input', '[\"\"]', 'auditReviewed');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_user`
--

CREATE TABLE `autumn_user` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `slat` int(11) NOT NULL,
  `from_group` int(11) NOT NULL,
  `lost_time` datetime NOT NULL,
  `lost_ip` varchar(19) NOT NULL,
  `count` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_user`
--

INSERT INTO `autumn_user` (`id`, `username`, `password`, `slat`, `from_group`, `lost_time`, `lost_ip`, `count`, `state`) VALUES
(1, '123456789', '14ba8fb06c154a427de22d77c4df47dc', 399621, 1, '2017-07-30 11:34:57', '127.0.0.1', 4, 0);

-- --------------------------------------------------------

--
-- 表的结构 `autumn_user_group`
--

CREATE TABLE `autumn_user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `limit` text NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_user_group`
--

INSERT INTO `autumn_user_group` (`id`, `name`, `limit`, `create_time`) VALUES
(1, '普通会员', '[\"ds\"]', '2017-07-26 17:58:19'),
(2, '白银会员', '[\"ds\"]', '2017-07-25 10:40:11'),
(3, '黄金会员', '[\"ds\"]', '2017-07-25 10:40:24'),
(4, '钻石会员', '[\"ds\"]', '2017-07-25 10:40:37');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_user_setting`
--

CREATE TABLE `autumn_user_setting` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `name` varchar(125) NOT NULL,
  `value` varchar(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `from_group` int(11) NOT NULL,
  `valueSplit` varchar(2048) NOT NULL,
  `name_key` varchar(125) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_user_setting`
--

INSERT INTO `autumn_user_setting` (`id`, `type`, `name`, `value`, `from_group`, `valueSplit`, `name_key`) VALUES
(8, 'input', '31232', '3123123212', -1, '[\"\"]', '312321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autumn_admin_group`
--
ALTER TABLE `autumn_admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_admin_user`
--
ALTER TABLE `autumn_admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_article`
--
ALTER TABLE `autumn_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_class`
--
ALTER TABLE `autumn_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_notice`
--
ALTER TABLE `autumn_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_order`
--
ALTER TABLE `autumn_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_passageway`
--
ALTER TABLE `autumn_passageway`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `autumn_setting`
--
ALTER TABLE `autumn_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `autumn_user`
--
ALTER TABLE `autumn_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `autumn_user_group`
--
ALTER TABLE `autumn_user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autumn_user_setting`
--
ALTER TABLE `autumn_user_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `autumn_admin_group`
--
ALTER TABLE `autumn_admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `autumn_admin_user`
--
ALTER TABLE `autumn_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `autumn_article`
--
ALTER TABLE `autumn_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `autumn_class`
--
ALTER TABLE `autumn_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
--
-- 使用表AUTO_INCREMENT `autumn_notice`
--
ALTER TABLE `autumn_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `autumn_order`
--
ALTER TABLE `autumn_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `autumn_passageway`
--
ALTER TABLE `autumn_passageway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `autumn_setting`
--
ALTER TABLE `autumn_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `autumn_user`
--
ALTER TABLE `autumn_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `autumn_user_group`
--
ALTER TABLE `autumn_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `autumn_user_setting`
--
ALTER TABLE `autumn_user_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
