-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Mar 13, 2020 at 06:16 PM
-- Server version: 8.0.16
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prco204_y`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `insert_User`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_User` (IN `EmailAddress` VARCHAR(255), IN `FirstName` VARCHAR(32), IN `LastName` VARCHAR(32), IN `Password` BINARY(32))  NO SQL
BEGIN
insert into User (EmailAddress,FirstName,LastName,Password) values (EmailAddress,FirstName,LastName,Password); 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `EventDate` datetime NOT NULL,
  `EventTitle` varchar(32) NOT NULL,
  `EventDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `FK_Event` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sleepinstance`
--

DROP TABLE IF EXISTS `sleepinstance`;
CREATE TABLE IF NOT EXISTS `sleepinstance` (
  `SleepID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `SleepStart` datetime NOT NULL,
  `SleepEnd` datetime NOT NULL,
  `SleepMood` int(11) NOT NULL,
  PRIMARY KEY (`SleepID`),
  KEY `FK_SleepInstance` (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sleepinstance`
--

INSERT INTO `sleepinstance` (`SleepID`, `UserID`, `SleepStart`, `SleepEnd`, `SleepMood`) VALUES
(1, 1, '2020-03-07 06:22:20', '2020-03-08 04:07:05', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(255) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `Password` binary(32) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `EmailAddress`, `FirstName`, `LastName`, `Password`) VALUES
(1, 'bob.mill@plymouth.gov', 'Robert', 'Mill', 0x3132333435000000000000000000000000000000000000000000000000000000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
