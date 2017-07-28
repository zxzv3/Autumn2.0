-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-07-28 08:15:06
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
(1, 'admin123', 'ad6916af2136815599c76530ca6f01df', 1, '2017-07-27 20:49:42', '127.0.0.1', 13, 0, '325462'),
(5, '231233122', '4eed63e5a174dd9d2fd9e065e437b138', 9, '0000-00-00 00:00:00', '', 0, 0, '180751');

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

--
-- 转存表中的数据 `autumn_notice`
--

INSERT INTO `autumn_notice` (`id`, `title`, `content`, `type`, `from_user`, `create_time`) VALUES
(2, '12321321', '&lt;p&gt;cs&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://127.168.0.1/assets/bin/umeditor/php/upload/20170727/1501166961238.jpg&quot; style=&quot;width: 1189px; height: 317px;&quot;/&gt;&lt;/p&gt;', 'notice', -1, '2017-07-27 22:50:40'),
(3, '12321“321321”321321', '&lt;p&gt;12321“321321”321321&lt;/p&gt;', 'notice', -1, '2017-07-27 23:01:24'),
(4, '萨达萨达三阿斯顿撒&amp;quot;dasdas&amp;quot;', '&lt;p&gt;&lt;span xss=removed&gt;萨达萨达三阿斯顿撒&quot;dasdas&quot;&lt;/span&gt;&lt;/p&gt;', 'notice', -1, '2017-07-27 23:02:13');

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
(3, '测试2', '312', 'input', '[\"\"]', '213');

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
(1, '312321', 'b62b8706ad616305a72a60e95eec9dcf', 293168, 1, '0000-00-00 00:00:00', '', 0, 0);

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
(4, '钻石会员', '[\"ds\"]', '2017-07-25 10:40:37'),
(6, '1232', '[\"ds\"]', '2017-07-27 17:16:14');

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
-- Indexes for table `autumn_notice`
--
ALTER TABLE `autumn_notice`
  ADD PRIMARY KEY (`id`);

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
-- 使用表AUTO_INCREMENT `autumn_notice`
--
ALTER TABLE `autumn_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `autumn_setting`
--
ALTER TABLE `autumn_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
