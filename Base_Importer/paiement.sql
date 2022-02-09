-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2021 at 11:08 PM
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
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `matricule` varchar(255) NOT NULL,
  `numCarnet` varchar(255) NOT NULL,
  `idAgent` varchar(255) NOT NULL,
  `date_paiement` date DEFAULT NULL,
  `nature_paiement` enum('NATURE','ESPECE','A DISTANCE') DEFAULT NULL,
  `montant_paye` float DEFAULT NULL,
  PRIMARY KEY (`matricule`,`numCarnet`,`idAgent`),
  KEY `matricule` (`matricule`),
  KEY `matricule_2` (`matricule`,`numCarnet`),
  KEY `matricule_3` (`matricule`),
  KEY `numCarnet` (`numCarnet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`matricule`, `numCarnet`, `idAgent`, `date_paiement`, `nature_paiement`, `montant_paye`) VALUES
('01', '01', '01', '2021-09-08', 'ESPECE', 25000),
('01', '01', '02', '2021-09-22', 'ESPECE', 45000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
