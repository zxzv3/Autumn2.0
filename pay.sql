-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-01 08:19:06
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
-- Database: `pay`
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
(1, 'admin123', 'ad6916af2136815599c76530ca6f01df', 1, '2017-07-31 19:30:12', '127.0.0.1', 23, 0, '325462'),
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
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_order`
--

INSERT INTO `autumn_order` (`id`, `from_user`, `paytype`, `money`, `rate`, `platform_order_id`, `merchant_order_id`, `create_time`, `arrive_time`, `notice_url`, `active_url`, `attribute`, `notice`, `notice_count`, `type`) VALUES
(11, 10002, 1, 0.01, 12, '2017073116081082465820', '1231232131', '2017-07-31 16:08:10', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 0, 0, 1),
(12, 10002, 1, 0.01, 12, '2017073116081590180969', '1231232131', '2017-07-31 16:08:15', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 0, 0, 1),
(10, 10002, 1, 0.01, 12, '2017073116074691507568', '1231232131', '2017-07-31 16:07:46', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 0, 0, 1),
(9, 10002, 1, 0.01, 12, '2017073114363411398010', '1231232131', '2017-07-31 14:36:34', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 1, 0, 1),
(13, 10002, 1, 0.01, 12, '2017073116081697225952', '1231232131', '2017-07-31 16:08:16', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 0, 0, 1),
(14, 10002, 1, 0.01, 12, '2017073116341391356506', '2017073116081697225952', '2017-07-31 16:34:13', '0000-00-00 00:00:00', 'http://127.0.0.1/pay/api/v1/test', 'http://127.0.0.1/pay/api/v1/test', '', 0, 10, 1);

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
(4, '爱扬微信', '[\"微信\",\"{\\\"file\\\" : \\\"aiyang\\\" , \\\"function\\\" : \\\"wxpay\\\"}\",\"https://www.baidu.com/\",\"10002\",\"kjl3kljkl4nmkl2n1llknlk\",\"5\"]', 'input', '[\"\"]', 'wxpay', 0, '微信');

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
(12, '商户最大通知次数', '10', 'input', '[\"\"]', 'merchantCount'),
(13, '客服工号', '80037', 'input', '[\"\"]', 'customerServiceNumber'),
(14, '客服QQ', '69384331', 'input', '[\"\"]', 'customerServiceQQ'),
(15, '客服手机', '12345678901', 'input', '[\"\"]', 'customerServicePhone');

-- --------------------------------------------------------

--
-- 表的结构 `autumn_user`
--

CREATE TABLE `autumn_user` (
  `id` int(11) NOT NULL,
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
  `state` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `autumn_user`
--

INSERT INTO `autumn_user` (`id`, `username`, `password`, `slat`, `money`, `merchant_key`, `from_group`, `lost_time`, `lost_ip`, `count`, `paytype`, `email`, `phone`, `qq`, `present_password`, `real_name`, `state`) VALUES
(1, '测试213455', 'b41558ea6c8951aa8f7a4234484a6bf2', 317089, 0, '411258d4ca2fd0cba8699b53dcf264ca', 1, '0000-00-00 00:00:00', '', 0, '[\"\\u652f\\u4ed8\\u5b9d\"]', '', '', '', '', 0, 0),
(10002, '1234567890', '31f21c8f0b6313581a22324c0b6b3475', 352675, 0.16, '592614f9ef10dace1d46e3fa1f164aa9', 1, '2017-07-31 19:31:45', '127.0.0.1', 2, '[\"\\u5fae\\u4fe1\",\"\\u652f\\u4ed8\\u5b9d\"]', '', '', '', '', 0, 0);

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
(1, '普通商户', '[\"ds\"]', '2017-07-31 08:29:11');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `autumn_passageway`
--
ALTER TABLE `autumn_passageway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `autumn_setting`
--
ALTER TABLE `autumn_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `autumn_user`
--
ALTER TABLE `autumn_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;
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
