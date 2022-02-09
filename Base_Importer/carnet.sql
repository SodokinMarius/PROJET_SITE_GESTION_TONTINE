-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2021 at 10:58 PM
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
-- Database: `tontine`
--

-- --------------------------------------------------------

--
-- Table structure for table `carnet`
--

DROP TABLE IF EXISTS `carnet`;
CREATE TABLE IF NOT EXISTS `carnet` (
  `numCarnet` int(11) NOT NULL,
  `date_enregistrement` date DEFAULT NULL,
  `prix_unit` float DEFAULT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`numCarnet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carnet`
--

INSERT INTO `carnet` (`numCarnet`, `date_enregistrement`, `prix_unit`, `stock`) VALUES
(1, '2021-09-06', 500, 1000),
(2, '2021-09-06', 500, 1000),
(3, '2021-09-06', 500, 1000),
(4, '2021-09-06', 500, 1000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
