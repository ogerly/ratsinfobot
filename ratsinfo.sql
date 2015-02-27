-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Feb 2015 um 07:53
-- Server Version: 5.5.41
-- PHP-Version: 5.4.36-0+deb7u3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ratsinfo`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mandat`
--

DROP TABLE IF EXISTS `mandat`;
CREATE TABLE IF NOT EXISTS `mandat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `ort` varchar(50) DEFAULT NULL,
  `plz` varchar(5) NOT NULL,
  `street` varchar(150) DEFAULT NULL,
  `phonDiFest` varchar(50) DEFAULT NULL,
  `phonDiMo` varchar(50) NOT NULL,
  `phonPrfest` varchar(50) NOT NULL,
  `phonPrMo` varchar(50) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `kpenr_id` varchar(10) NOT NULL,
  `zusatz` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
