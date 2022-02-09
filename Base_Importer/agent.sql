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
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `idAgent` varchar(255) NOT NULL,
  `nomAgent` varchar(255) NOT NULL,
  `prenomAgent` varchar(255) NOT NULL,
  `dateNaissanceAg` date NOT NULL,
  `LieuNaissanceAg` varchar(255) NOT NULL,
  `poste` enum('SUPERVISEUR','PRESIDENT','SECRETAIRE','TRESORIER(E)') DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `AdressAg` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  PRIMARY KEY (`idAgent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`idAgent`, `nomAgent`, `prenomAgent`, `dateNaissanceAg`, `LieuNaissanceAg`, `poste`, `mot_de_passe`, `AdressAg`, `telephone`, `date_debut`) VALUES
('AGOU', 'AGOU', 'Norbert', '1999-01-01', 'COTONOU', 'SUPERVISEUR', 'ea22657f9c5477cf7dac8b4ceeef21c96b789cce', 'COTONOU', '94545214', '2021-09-06'),
('MIGNON', 'MIGNON', 'Orpheline', '2000-01-01', 'COTONOU', 'SECRETAIRE', 'b6035445c7f3eebfe023fca4a769333bb46163af', 'PORTO', '95142030', '2021-09-06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
