-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2019 at 09:22 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `debtorsmaster`
--

DROP TABLE IF EXISTS `debtorsmaster`;
CREATE TABLE IF NOT EXISTS `debtorsmaster` (
  `accCode` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address1` varchar(60) DEFAULT NULL,
  `address2` varchar(60) DEFAULT NULL,
  `address3` varchar(60) DEFAULT NULL,
  `costYearToDate` double NOT NULL DEFAULT '0',
  `salesYearToDate` double NOT NULL DEFAULT '0',
  `paid` double DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`accCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debtorsmaster`
--

INSERT INTO `debtorsmaster` (`accCode`, `name`, `address1`, `address2`, `address3`, `costYearToDate`, `salesYearToDate`, `paid`, `balance`) VALUES
(4029, 'Edmore', NULL, NULL, NULL, 1050, 1288, 70, 1218),
(12101, 'Sam', 'er', '', '', 3752, 4032, 300, 3732);

-- --------------------------------------------------------

--
-- Table structure for table `debtorstransaction`
--

DROP TABLE IF EXISTS `debtorstransaction`;
CREATE TABLE IF NOT EXISTS `debtorstransaction` (
  `date` date NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `accCode` varchar(25) NOT NULL,
  `transactionType` varchar(60) NOT NULL,
  `invoiceNumber` int(11) NOT NULL,
  `grossTransactionValue` double NOT NULL,
  `vatValue` double NOT NULL,
  PRIMARY KEY (`invoiceNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debtorstransaction`
--

INSERT INTO `debtorstransaction` (`date`, `name`, `accCode`, `transactionType`, `invoiceNumber`, `grossTransactionValue`, `vatValue`) VALUES
('2019-11-11', 'Edmore', '12100', 'Credit', 2558885, 274, 41.1),
('2019-11-01', 'Desmond', '11100', 'Credit', 2558886, 367, 55.05),
('2019-11-14', 'Voms', '14100', 'Credit', 2558888, 641, 96.15),
('2019-11-27', 'Edmore', '14600', 'Credit', 2558896, 367, 55.05),
('2019-11-27', 'Edmore', '14600', 'Credit', 2558897, 367, 55.05),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558902, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558906, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558907, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558908, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558909, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558910, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558911, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558912, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558913, 144, 21.6),
('2019-11-05', 'Edmore', '12100', 'Credit', 2558914, 144, 21.6),
('2019-11-05', 'Sam', '12101', 'Credit', 2558916, 144, 21.6),
('2019-11-30', 'Sam', '12101', 'Credit', 2558927, 144, 21.6),
('2019-11-06', 'Edmore', '4029', 'Credit', 2558940, 636, 95.4),
('2019-11-06', 'Edmore', '4029', 'Credit', 2558941, 636, 95.4);

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetail`
--

DROP TABLE IF EXISTS `invoicedetail`;
CREATE TABLE IF NOT EXISTS `invoicedetail` (
  `date` date DEFAULT NULL,
  `invoiceNumber` int(11) NOT NULL AUTO_INCREMENT,
  `accCode` varchar(25) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `itemNumber` smallint(6) NOT NULL,
  `stockCode` varchar(20) DEFAULT NULL,
  `quantitySold` smallint(6) DEFAULT NULL,
  `unitCost` double DEFAULT NULL,
  `unitSell` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `subTotal` double DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `transactionType` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`invoiceNumber`)
) ENGINE=MyISAM AUTO_INCREMENT=2558942 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedetail`
--

INSERT INTO `invoicedetail` (`date`, `invoiceNumber`, `accCode`, `name`, `itemNumber`, `stockCode`, `quantitySold`, `unitCost`, `unitSell`, `discount`, `subTotal`, `description`, `transactionType`) VALUES
('2019-11-20', 2558843, '12100', 'EFAZ', 7, 'yc5', 13, 56, 70, 4, 906, NULL, NULL),
('2019-11-11', 2558826, '14600', 'Edmore', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56, NULL, NULL),
('2019-11-05', 2558824, '12100', 'Ediezzle', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56, NULL, NULL),
('2019-11-05', 2558825, '12100', 'Ediezzle', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56, NULL, NULL),
('2019-11-20', 2558842, '12100', 'EFAZ', 7, 'yc5', 13, 56, 70, 4, 906, NULL, NULL),
('2019-11-05', 2558819, '12100', 'ffd', 1, 's203u', 2, 12.29, 15.37, 2, 28.74, NULL, NULL),
('2019-11-05', 2558820, '12100', 'ffd', 1, 's203u', 2, 12.29, 15.37, 2, 28.74, NULL, NULL),
('2019-11-04', 2558821, '12100', 'diezzle', 1, 's203j', 2, 12.29, 72, 2, 142, NULL, NULL),
('2019-11-18', 2558828, '11100', 'Desmond', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56, NULL, NULL),
('2019-11-20', 2558829, '14100', 'ffd', 1, 'r132152j', 1, 12.29, 15.37, 3, 12.37, NULL, NULL),
('2019-11-04', 2558830, '12100', 'Desmond', 1, 'fs538dn', 2, 23, 0.7, 2, -0.6, NULL, NULL),
('2019-11-19', 2558831, '14100', 'Edmore', 1, 'vjhi87', 1, 17, 21, 1, 20, NULL, NULL),
('2019-11-20', 2558844, '12100', 'EFAZ', 7, 'yc5', 13, 56, 70, 4, 906, NULL, NULL),
('2019-11-19', 2558833, '14100', 'Edmore', 1, 'vjhi87', 1, 17, 21, 1, 20, NULL, NULL),
('2019-11-19', 2558834, '14100', 'Edmore', 1, 'vjhi87', 1, 17, 21, 1, 20, NULL, NULL),
('2019-11-04', 2558835, '24553', 'G Ruin', 1, 'qwerty', 62, 4, 5, 12.3, 297.7, NULL, NULL),
('2019-11-06', 2558837, '12100', 'ETM', 1, 'r076198l', 2, 832.4, 1002.5, 3, 2002, NULL, NULL),
('2019-11-06', 2558838, '12100', 'ETM', 1, 'r076198l', 2, 832.4, 1002.5, 3, 2002, NULL, NULL),
('2019-11-06', 2558839, '12100', 'ETM', 1, 'r076198l', 2, 832.4, 1002.5, 3, 2002, NULL, NULL),
('2019-11-12', 2558840, '14600', 'AM ', 1, 'rj45', 4, 4, 5, 1, 19, NULL, NULL),
('2019-11-12', 2558841, '14600', 'TMZ', 1, 'vz', 4, 4, 6, 1, 23, NULL, NULL),
('2019-11-29', 2558845, '11100', 'Dasy', 6, 'july', 5, 75, 92, 3, 457, NULL, NULL),
('2019-11-29', 2558846, '11100', 'Dasy', 6, 'july', 5, 75, 92, 3, 457, NULL, NULL),
('2019-11-29', 2558847, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-29', 2558848, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-29', 2558849, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-29', 2558850, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-29', 2558851, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-29', 2558852, '11100', 'Dasy', 6, 'july', 1, 75, 92, 3, 89, NULL, NULL),
('2019-11-05', 2558853, '14600', 'Edmore', 1, 'july', 2, 75, 92, 2, 182, NULL, NULL),
('2019-11-05', 2558854, '14600', 'Edmore', 1, 'july', 2, 75, 92, 2, 182, NULL, NULL),
('2019-11-05', 2558855, '14600', 'Edmore', 1, 'july', 2, 75, 92, 2, 182, NULL, NULL),
('2019-11-05', 2558856, '14600', 'Edmore', 1, 'july', 2, 75, 92, 2, 182, NULL, NULL),
('2019-11-05', 2558857, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558858, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558859, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558860, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558861, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558862, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558863, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558864, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558865, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558866, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558867, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558868, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558869, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558870, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558871, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-05', 2558872, '14600', 'Edmore', 1, 'damn', 2, 6, 7, 2, 12, NULL, NULL),
('2019-11-11', 2558873, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, ''),
('2019-11-11', 2558874, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, ''),
('2019-11-11', 2558875, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558876, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558877, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558878, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558879, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558880, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558881, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558882, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558883, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558884, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-11', 2558885, '12100', 'Edmore', 1, 'july', 3, 75, 92, 2, 274, NULL, 'Credit'),
('2019-11-01', 2558886, '11100', 'Desmond', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Credit'),
('2019-11-14', 2558887, '14100', 'Tatenda', 2, 'june', 7, 75, 92, 3, 641, NULL, 'Cash'),
('2019-11-14', 2558888, '14100', 'Voms', 2, 'june', 7, 75, 92, 3, 641, NULL, 'Credit'),
('2019-11-14', 2558889, '14100', 'Voms', 2, 'june', 7, 75, 92, 3, 641, NULL, 'Credit'),
('2019-11-27', 2558890, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-27', 2558891, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-27', 2558892, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-27', 2558893, '12100', 'Edmore', 1, 'july', 2, 75, 92, 0, 184, NULL, 'Cash'),
('2019-11-27', 2558894, '12100', 'Edmore', 1, 'july', 2, 75, 92, 0, 184, NULL, 'Credit'),
('2019-11-27', 2558895, '12100', 'Edmore', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Credit'),
('2019-11-27', 2558896, '14600', 'Edmore', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Credit'),
('2019-11-27', 2558897, '14600', 'Edmore', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Credit'),
('2019-11-27', 2558898, '14600', 'Edmore', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Cash'),
('2019-11-27', 2558899, '14600', 'Edmore', 1, 'june', 4, 75, 92, 1, 367, NULL, 'Cash'),
('2019-11-05', 2558900, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558901, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558902, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558903, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558904, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558905, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558906, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558907, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558908, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558909, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558910, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558911, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558912, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558913, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558914, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558915, '12100', 'Edmore', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558916, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-05', 2558917, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558918, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-05', 2558919, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558920, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558921, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, ''),
('2019-11-30', 2558922, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558923, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558924, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558925, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558926, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558927, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Credit'),
('2019-11-30', 2558928, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558929, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558930, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558931, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558932, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558933, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558934, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558935, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-30', 2558936, '12101', 'Sam', 1, 's203j', 2, 67, 72, 0, 144, NULL, 'Cash'),
('2019-11-06', 2558937, '12100', 'Edmore', 1, 'july', 1, 75, 92, 2, 90, NULL, 'Cash'),
('2019-11-05', 2558938, '', 'ffd', 1, 'july', 6, 75, 92, 5, 547, NULL, 'Cash'),
('2019-11-06', 2558939, '14100', 'Edmore', 1, 'july', 7, 75, 92, 8, 636, NULL, 'Cash'),
('2019-11-06', 2558940, '4029', 'Edmore', 1, 'july', 7, 75, 92, 8, 636, NULL, 'Credit'),
('2019-11-06', 2558941, '4029', 'Edmore', 1, 'july', 7, 75, 92, 8, 636, NULL, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stockCode` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `transactionType` varchar(60) NOT NULL,
  `documentNumber` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitCost` double NOT NULL,
  `unitSell` double NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`stockCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockCode`, `date`, `transactionType`, `documentNumber`, `quantity`, `unitCost`, `unitSell`, `description`) VALUES
('R120392L', '2019-11-01', 'Cash', 23415, 80, 345, 426, 'summer deals'),
('r134762j', '2019-11-22', 'cash', 32769, 34, 772.4, 922.5, 'goodies'),
('r142637t', '2019-11-22', 'Cash', 13456, 22, 332, 442, ''),
('s203j', '2019-11-04', 'Credit', 13692, -60, 67, 72, 'fayt ayt ayt'),
('fhg', '2019-11-03', 'Cash', 35465, 5, 6, 7, 'ola ola'),
('rj45', '2019-11-04', 'Cash', 13692, 0, 4, 5, 'cool stuff'),
('s21', '2019-11-04', 'Credit', 13692, 4, 4, 5, 'gooda gooda'),
('qwerty', '2019-11-04', 'Credit', 13692, -62, 4, 5, 'gwara gwara'),
('n', '2019-11-05', 'Cash', 8, 7, 6, 8, 'yuuh'),
('vz', '2019-11-06', 'Cash', 324, 4, 4, 6, 'agshgdf'),
('z68', '2019-11-06', 'Cash', 8765, 12, 45, 52, 'adhesive glue'),
('yc5', '2019-11-04', 'Cash', 76589, 7, 56, 70, 'yyyyyyyyyy'),
('june', '2019-11-12', 'Cash', 13692, -32, 75, 92, 'juneeeeeeeeeeeeeeee'),
('july', '2019-11-12', 'Cash', 13692, -94, 75, 92, 'julyyyyyyyyyyyyyy'),
('damn', '2019-11-04', 'Cash', 34567, -27, 6, 7, 'qazsxdcf');

-- --------------------------------------------------------

--
-- Table structure for table `stockmaster`
--

DROP TABLE IF EXISTS `stockmaster`;
CREATE TABLE IF NOT EXISTS `stockmaster` (
  `date` date DEFAULT NULL,
  `stockCode` varchar(30) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `cost` double NOT NULL,
  `sellingPrice` double NOT NULL,
  `tpev` double DEFAULT '0',
  `tsev` double DEFAULT '0',
  `quantityPurchased` int(11) NOT NULL,
  `quantitySold` int(11) DEFAULT '0',
  `stockOnHand` double DEFAULT '0',
  PRIMARY KEY (`stockCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockmaster`
--

INSERT INTO `stockmaster` (`date`, `stockCode`, `description`, `cost`, `sellingPrice`, `tpev`, `tsev`, `quantityPurchased`, `quantitySold`, `stockOnHand`) VALUES
(NULL, 'rj45', 'cool stuff', 24, 29, NULL, NULL, 14, 8, NULL),
(NULL, 's21', 'gooda gooda', 4, 5, NULL, NULL, 4, NULL, NULL),
(NULL, 'qwerty', 'gwara gwara', 4, 5, NULL, NULL, 62, NULL, NULL),
(NULL, 'n', 'yuuh', 6, 8, NULL, NULL, 7, NULL, NULL),
(NULL, 'vz', 'agshgdf', 4, 6, NULL, NULL, 8, 8, NULL),
(NULL, 'z68', 'adhesive glue', 45, 52, 459, NULL, 12, 0, NULL),
(NULL, 'yc5', 'yyyyyyyyyy', 56, 70, 2189.6, 773.5, 46, 13, NULL),
(NULL, 'june', 'juneeeeeeeeeeeeeeee', 75, 92, 828.75, NULL, 13, 45, 975),
(NULL, 'july', 'julyyyyyyyyyyyyyy', 75, 92, 828.75, 7294.399999999998, 13, 121, 975),
(NULL, 'damn', 'qazsxdcf', 6, 7, 25.5, 47.6, 5, 32, 30),
('2019-11-26', 'R140392L', 'hot hot', 50025, 61770, 63342, 0, 216, 0, 74520),
('2019-11-01', 'R120392L', 'summer deals', 345, 426, 21114, 0, 72, 0, 24840);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
