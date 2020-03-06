-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2020 at 12:52 PM
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
-- Database: `proc204`
--
CREATE DATABASE IF NOT EXISTS `proc204` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `proc204`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `insert_User`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_User` (IN `EmailAddress` VARCHAR(255), IN `FirstName` VARCHAR(32), IN `LastName` VARCHAR(32), IN `Password` BINARY(32))  NO SQL
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
