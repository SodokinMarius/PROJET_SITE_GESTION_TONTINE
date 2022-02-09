-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2021 at 10:57 PM
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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `matricule` int(11) NOT NULL,
  `nomClient` varchar(255) NOT NULL,
  `prenomClient` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `LieuNaissance` varchar(255) NOT NULL,
  `sexe` enum('M','F') DEFAULT NULL,
  `profession` varchar(255) NOT NULL,
  `AdressClient` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `sous_journalier` int(11) NOT NULL,
  `date_sous` date DEFAULT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`matricule`, `nomClient`, `prenomClient`, `dateNaissance`, `LieuNaissance`, `sexe`, `profession`, `AdressClient`, `telephone`, `sous_journalier`, `date_sous`) VALUES
(1, 'ASSOU', 'Mahougnon', '1000-12-10', 'ALADAH', 'M', 'Menusietr', 'ALLADAH', '51514212', 500, '2021-09-06'),
(2, 'MEGNONWOU', 'Eric', '2012-02-02', 'ETOHOUE', 'M', 'TAILLEUR', 'AZOVE', '90504217', 700, '2021-09-06'),
(3, 'GREGOIRE', 'ALIVE', '0222-10-12', 'ALADAH', 'M', 'COIFFEUR', 'gvhjkl', '5050505050', 300, '2021-09-06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
