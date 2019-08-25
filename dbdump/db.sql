-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `mycompany`;
CREATE DATABASE `mycompany` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mycompany`;

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `cid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`cid`, `fname`, `lname`, `email`) VALUES
(1,	'John',	'Doe',	'john@doe.com'),
(2,	'Pink',	'Floyd',	'pink@floyd.com');

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` bigint(20) unsigned NOT NULL,
  `purchase_date` date NOT NULL,
  `country_id` int(11) NOT NULL,
  `device` int(11) NOT NULL,
  PRIMARY KEY (`oid`),
  KEY `cid` (`cid`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order` (`oid`, `cid`, `purchase_date`, `country_id`, `device`) VALUES
(1,	1,	'2019-08-23',	1,	111);

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `oid` int(11) NOT NULL,
  `EAN` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  KEY `oid` (`oid`),
  CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order_item` (`oid`, `EAN`, `quantity`, `price`) VALUES
(1,	123123123,	2,	290.44),
(1,	222333444,	4,	355.21);

-- 2019-08-25 01:31:41
