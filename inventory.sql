-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2019 at 03:40 AM
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
  PRIMARY KEY (`invoiceNumber`)
) ENGINE=MyISAM AUTO_INCREMENT=2558831 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedetail`
--

INSERT INTO `invoicedetail` (`date`, `invoiceNumber`, `accCode`, `name`, `itemNumber`, `stockCode`, `quantitySold`, `unitCost`, `unitSell`, `discount`, `subTotal`) VALUES
('2019-11-04', 2558827, '500', 'Taty', 19, 'cj45m', 6, 6, 6, 0, 36),
('2019-11-11', 2558826, '14600', 'Edmore', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56),
('2019-11-05', 2558824, '12100', 'Ediezzle', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56),
('2019-11-05', 2558825, '12100', 'Ediezzle', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56),
('2019-11-05', 2558823, '12100', 'Tims', 1, 's203u', 9, 12.29, 15.37, 2, 136.33),
('2019-11-05', 2558819, '12100', 'ffd', 1, 's203u', 2, 12.29, 15.37, 2, 28.74),
('2019-11-05', 2558820, '12100', 'ffd', 1, 's203u', 2, 12.29, 15.37, 2, 28.74),
('2019-11-04', 2558821, '12100', 'diezzle', 1, 's203j', 2, 12.29, 72, 2, 142),
('2019-11-18', 2558828, '11100', 'Desmond', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56),
('2019-11-20', 2558829, '14100', 'ffd', 1, 'r132152j', 1, 12.29, 15.37, 3, 12.37),
('2019-11-04', 2558830, '12100', 'Ediezzle', 1, 'r076198l', 1, 45.9, 62.56, 5, 57.56);

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
  PRIMARY KEY (`stockCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockCode`, `date`, `transactionType`, `documentNumber`, `quantity`, `unitCost`, `unitSell`) VALUES
('fs538dt', '2019-11-03', 'Cash', 13692, 18, 9, 9.7),
('fs538dn', '2019-11-03', 'Cash', 13692, 8, 23, 0.7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
