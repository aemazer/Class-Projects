-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2012 at 12:09 PM
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
-- Table structure for table `Robot`
--

CREATE TABLE IF NOT EXISTS `Robot` (
  `BotName` varchar(10) NOT NULL,
  `Superiorocity` int(20) NOT NULL,
  PRIMARY KEY (`BotName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Robot`
--

INSERT INTO `Robot` (`BotName`, `Superiorocity`) VALUES
('Gir', 100),
('Gip', 290),
('Mimi', 10),
('Lor', 534),
('Lisk', 341),
('Gigi', 342),
('Dur', 343),
('Tuk', 984),
('Pos', 993),
('Miq', 503),
('Tuv', 474),
('Pim', 948),
('Gam', 384),
('Gak', 972),
('Goz', 483),
('Geb', 390),
('Poki', 849),
('Lint', 945),
('Lipo', 378),
('Chipz', 234),
('Rom', 344),
('Hulu', 122),
('Arma', 233),
('Liver', 455),
('Bug', 566),
('Sixx', 666),
('Mot', 667),
('Emm', 778),
('Calf', 889),
('Tall', 1),
('Taller', 2),
('Pip', 997),
('Gim', 1003),
('Lib', 1004);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
