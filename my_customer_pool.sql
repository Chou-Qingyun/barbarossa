-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 11 月 20 日 09:17
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `barbarossa`
--

-- --------------------------------------------------------

--
-- 表的结构 `xmls_my_customer_pool`
--

CREATE TABLE IF NOT EXISTS `xmls_my_customer_pool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_open` int(1) NOT NULL DEFAULT '0',
  `recycle_period` int(11) NOT NULL,
  `recycle_scope` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xmls_my_customer_pool`
--

INSERT INTO `xmls_my_customer_pool` (`id`, `is_open`, `recycle_period`, `recycle_scope`) VALUES
(1, 1, 2, '11,9,12,13,21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
