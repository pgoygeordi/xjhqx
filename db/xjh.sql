-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2017 年 01 月 13 日 06:16
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xjh`
--

-- --------------------------------------------------------

--
-- 表的结构 `xjh_customers`
--
-- 创建时间: 2016 年 10 月 19 日 02:27
--

CREATE TABLE IF NOT EXISTS `xjh_customers` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT 'customer name',
  `tel` varchar(100) DEFAULT NULL COMMENT 'customer contact number',
  `addr` text COMMENT 'customer address',
  `idNum` varchar(200) DEFAULT NULL COMMENT 'customer identity number',
  `c1` varchar(200) DEFAULT NULL,
  `c2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `idCard` (`idNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='customer table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xjh_part`
--
-- 创建时间: 2016 年 10 月 19 日 03:24
--

CREATE TABLE IF NOT EXISTS `xjh_part` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'parts table primary key',
  `name` varchar(500) NOT NULL COMMENT 'car part name',
  `carTypeId` int(11) DEFAULT NULL COMMENT 'car type id reference',
  `partPrice` double NOT NULL COMMENT 'car part price',
  `labourPrice` double NOT NULL COMMENT 'price for the labour',
  `partCode` varchar(200) DEFAULT NULL COMMENT 'pn code for the car parts',
  `supplier` varchar(500) DEFAULT NULL,
  `stock` int(11) DEFAULT '0' COMMENT 'number of item in stock',
  `partDescription` varchar(500) DEFAULT NULL COMMENT 'car part description',
  `p1` varchar(500) DEFAULT NULL,
  `p2` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `carTypeId` (`carTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xjh_part`
--

INSERT INTO `xjh_part` (`p_id`, `name`, `carTypeId`, `partPrice`, `labourPrice`, `partCode`, `supplier`, `stock`, `partDescription`, `p1`, `p2`) VALUES
(1, '机油', 1, 20, 30, 'JL0001', '平谷区大市场', 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `xjh_record`
--
-- 创建时间: 2016 年 11 月 01 日 09:43
--

CREATE TABLE IF NOT EXISTS `xjh_record` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `carReg` varchar(10) NOT NULL COMMENT '车号',
  `serviceDate` varchar(10) NOT NULL,
  `nextServiceDate` varchar(10) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `addr` text,
  `idNum` varchar(100) DEFAULT NULL,
  `mileage` int(10) DEFAULT NULL COMMENT '公里数',
  `carTypeId` int(11) DEFAULT NULL,
  `Services` text,
  `r1` int(11) DEFAULT NULL,
  `r2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customerId` (`customerId`,`carTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xjh_type`
--
-- 创建时间: 2016 年 10 月 19 日 03:47
--

CREATE TABLE IF NOT EXISTS `xjh_type` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'car type table primary key',
  `parentId` int(11) NOT NULL DEFAULT '0' COMMENT 'car type parent id',
  `childrenIds` varchar(500) NOT NULL DEFAULT '0' COMMENT 'car type children ids',
  `name` varchar(500) NOT NULL COMMENT 'car type name',
  `fuelType` varchar(10) NOT NULL DEFAULT '汽油' COMMENT 'car fuel type',
  `capacity` float DEFAULT NULL COMMENT 'engine displacement',
  `t1` varchar(500) DEFAULT NULL,
  `t2` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `parentId` (`parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `xjh_type`
--

INSERT INTO `xjh_type` (`t_id`, `parentId`, `childrenIds`, `name`, `fuelType`, `capacity`, `t1`, `t2`) VALUES
(1, 0, '0', '任何车', '汽油/柴油', 1.6, NULL, NULL),
(2, 0, '0', '汽油车', '汽油', 2, NULL, NULL),
(3, 0, '0', '柴油车', '柴油', 1.8, NULL, NULL),
(4, 0, '0', '标志', '汽油/柴油', 0, NULL, NULL),
(5, 0, '0', '宝马', '汽油', 0, NULL, NULL),
(6, 4, '0', '307', '汽油', 1.8, NULL, NULL),
(9, 4, '0', '207', '汽油', 1.6, NULL, NULL),
(10, 4, '0', '308', '柴油', 1.8, NULL, NULL),
(12, 5, '0', '3系', '汽油/柴油', 2, NULL, NULL),
(13, 5, '0', '5系', '汽油/柴油', 0, NULL, NULL),
(14, 5, '0', '7系', '汽油/柴油', 0, NULL, NULL),
(15, 5, '0', 'R4', '汽油', 3, NULL, NULL),
(16, 12, '0', '325', '汽油', 1.9, NULL, NULL),
(17, 4, '0', '206', '汽油', 1.4, NULL, NULL),
(18, 13, '0', '525', '汽油', 1.8, NULL, NULL),
(19, 12, '0', '325i', '汽油', 2, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
