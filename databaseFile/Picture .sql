-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-02-17 17:13:33
-- 服务器版本： 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Picture`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `uid` int(16) NOT NULL COMMENT '用户id',
  `name` varchar(32) COLLATE utf8mb4_bin NOT NULL COMMENT '用户名',
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '密码',
  `avatar` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '用户头像',
  `profile` text COLLATE utf8mb4_bin COMMENT '个人简介',
  `sex` int(2) NOT NULL COMMENT '性别',
  `email` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '电子邮件',
  `regist_time` datetime NOT NULL COMMENT '注册时间',
  `login_time` datetime NOT NULL COMMENT '登录时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='用户信息表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `name`, `password`, `avatar`, `profile`, `sex`, `email`, `regist_time`, `login_time`) VALUES
(8, 'mars', '$2y$10$Mkcih5bov4.Xwx01rbq5j.yb0Sxm5dpLBPHQe8cZaRH0p2VoivC9u', NULL, NULL, 1, 'asdf@asd.com', '2018-02-16 17:45:50', '2018-02-17 15:00:08'),
(11, 'mars1231', '$2y$10$/YnQDn6OURquk92BIU7aLu/MFxYyZW3SKfrEq.qly1NpRly1Pt0g.', '20180217165222.png', 'asdfasd', 0, 'qwe2@Asd', '2018-02-17 15:00:33', '2018-02-17 15:00:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(16) NOT NULL AUTO_INCREMENT COMMENT '用户id', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
