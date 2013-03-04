-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2012 at 12:08 PM
-- Server version: 5.5.28-cll
-- PHP Version: 5.3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maze5405`
--

-- --------------------------------------------------------

--
-- Table structure for table `Invader`
--

CREATE TABLE IF NOT EXISTS `Invader` (
  `Superiorocity` int(10) NOT NULL AUTO_INCREMENT,
  `Height` double NOT NULL,
  `Name` varchar(20) NOT NULL,
  `BotName` varchar(20) NOT NULL,
  `ShipTypeID` char(1) NOT NULL,
  PRIMARY KEY (`Superiorocity`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1006 ;

--
-- Dumping data for table `Invader`
--

INSERT INTO `Invader` (`Superiorocity`, `Height`, `Name`, `BotName`, `ShipTypeID`) VALUES
(100, 3.5, 'Zim', 'Gir', 'V'),
(290, 3.4, 'Pax', 'Gip', 'B'),
(10, 3.1, 'Tak', 'Mimi', 'D'),
(342, 3.8, 'Alexovich', 'Gigi', 'B'),
(343, 3.1, 'Chin', 'Dur', 'T'),
(341, 3.3, 'Dooky', 'Lisk', 'T'),
(534, 3.4, 'Nak', 'Lor', 'C'),
(984, 3.7, 'El', 'Tuk', 'B'),
(993, 3.7, 'Flobee', 'Pos', 'D'),
(503, 3.3, 'Grapa', 'Miq', 'T'),
(474, 3.4, 'Kim', 'Tuv', 'V'),
(948, 3.1, 'Koot', 'Pim', 'V'),
(384, 3.2, 'Krunk', 'Gam', 'C'),
(972, 3.9, 'Larb', 'Gak', 'V'),
(483, 3.7, 'Lardnar', 'Goz', 'T'),
(390, 2.8, 'Nen', 'Geb', 'C'),
(849, 3.5, 'Poot', 'Poki', 'B'),
(945, 3, 'Sklud', 'Lint', 'T'),
(378, 3.8, 'Skoo', 'Lipo', 'B'),
(234, 3.2, 'Skoodge', 'Chipz', 'D'),
(344, 3.4, 'Skutch', 'Rom', 'V'),
(122, 3.3, 'Slant', 'Hulu', 'D'),
(233, 3.7, 'Sneakyonfo', 'Arma', 'V'),
(455, 3.1, 'Spleen', 'Liver', 'C'),
(566, 3.4, 'Stink', 'Bug', 'B'),
(666, 3.9, 'Tenn', 'Sixx', 'D'),
(667, 3.6, 'Tim', 'Mot', 'B'),
(778, 3.6, 'Zee', 'Emm', 'D'),
(889, 3.3, 'Shin', 'Calf', 'V'),
(1, 4.6, 'TallestPur', 'Tall', 'D'),
(2, 4.5, 'TallestRed', 'Taller', 'C'),
(777, 3.1, 'Knee', 'Elbow', ''),
(995, 3.3, 'Nim', 'Pip', 'D'),
(996, 3.3, 'Nim', 'Pip', 'D'),
(997, 3.3, 'Nim', 'Pip', 'D'),
(1003, 2.8, 'Toe', 'Gim', 'C'),
(1004, 3.5, 'Amby', 'Lib', 'D');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
