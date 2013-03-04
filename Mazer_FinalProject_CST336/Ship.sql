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
-- Table structure for table `Ship`
--

CREATE TABLE IF NOT EXISTS `Ship` (
  `ShipName` varchar(20) NOT NULL,
  `Superiorocity` int(10) NOT NULL,
  `ShipTypeID` char(1) NOT NULL,
  PRIMARY KEY (`ShipName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Ship`
--

INSERT INTO `Ship` (`ShipName`, `Superiorocity`, `ShipTypeID`) VALUES
('VoyagerZim', 100, 'V'),
('BattleshipPax', 290, 'B'),
('CarrierNak', 534, 'C'),
('DestroyerTak', 10, 'D'),
('TravelShipDooky', 341, 'T'),
('BattleShipAlexovich', 342, 'B'),
('TravelShipChin', 343, 'T'),
('BattleShipEl', 984, 'B'),
('DestroyerFlobee', 993, 'D'),
('TravelShipGrapa', 503, 'T'),
('VoyagerKim', 474, 'V'),
('VoyagerKoot', 948, 'V'),
('CarrierKrunk', 384, 'C'),
('VoyagerLarb', 972, 'V'),
('TravelShipLardnar', 483, 'T'),
('CarrierNen', 390, 'C'),
('BattleShipPoot', 849, 'B'),
('TravelShipSklud', 945, 'D'),
('BattleShipSkoo', 378, 'B'),
('VoyagerSkutch', 344, 'V'),
('DestroyerSlant', 122, 'D'),
('VoyagerSneaky', 233, 'V'),
('CarrierSpleen', 455, 'C'),
('BattleShipStink', 566, 'B'),
('DestroyerTenn', 666, 'D'),
('BattleShipTim', 667, 'B'),
('DestroyerZee', 778, 'D'),
('VoyagerShin', 889, 'V'),
('CarrierToe', 1003, 'C'),
('CarrierOne', 2, 'C'),
('The Missive', 1, 'D'),
('DestroyerNim', 997, 'D'),
('DestroyerAmby', 1004, 'D');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
