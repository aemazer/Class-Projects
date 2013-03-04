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
-- Table structure for table `Planet`
--

CREATE TABLE IF NOT EXISTS `Planet` (
  `PLName` varchar(20) NOT NULL,
  `Superiorocity` int(10) NOT NULL,
  `StatusID` char(5) NOT NULL,
  `InhabType` varchar(1) NOT NULL,
  PRIMARY KEY (`PLName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Planet`
--

INSERT INTO `Planet` (`PLName`, `Superiorocity`, `StatusID`, `InhabType`) VALUES
('Earth', 100, 'U', 'N'),
('Vort', 972, 'C', 'N'),
('Blorch', 234, 'C', 'N'),
('Meekrob', 666, 'C', 'N'),
('Plookesia', 122, 'C', 'N'),
('Devastis', 233, 'C', 'N'),
('Callnowia', 344, 'C', 'N'),
('Humblia', 455, 'C', 'N'),
('Piltar', 566, 'U', 'N'),
('Tunn', 667, 'U', 'N'),
('Mazia', 778, 'C', 'N'),
('Funtimia', 889, 'C', 'N'),
('Lazia', 948, 'U', 'N'),
('Fightia', 290, 'U', 'N'),
('Mintor', 341, 'C', 'N'),
('Pluto', 342, 'U', 'N'),
('Callisto', 343, 'U', 'N'),
('Cradlia', 474, 'C', 'N'),
('Crowdia', 483, 'C', 'N'),
('Nurmb', 503, 'U', 'N'),
('Quarm', 534, 'U', 'N'),
('Wandia', 849, 'C', 'N'),
('Dirtia', 945, 'C', 'N'),
('Vorlt', 984, 'U', 'N'),
('Cilk', 993, 'U', 'N'),
('Hobo13', 2, 'C', 'I'),
('FoodCourtia', 1, 'C', 'I'),
('Judgementia', 2, 'C', 'I'),
('Conventia', 1, 'C', 'I'),
('Nort', 997, 'U', 'N'),
('Peag', 1003, 'U', 'N'),
('Purt', 1004, 'U', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
