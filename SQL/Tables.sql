-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Apr 08, 2020 at 07:55 PM
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
DROP PROCEDURE IF EXISTS `get_Sleep_Range`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_Sleep_Range` (IN `Start` DATETIME, IN `End` DATETIME, IN `Userid` INT)  NO SQL
BEGIN
SELECT SleepStart, SleepEnd, TIMEDIFF(SleepEnd, SleepStart) 
FROM sleepinstance 
WHERE Userid = UserID
AND  SleepStart BETWEEN Start and End 
ORDER BY SleepStart ASC;
END$$

DROP PROCEDURE IF EXISTS `get_User_Calender_Events`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_User_Calender_Events` (IN `UserID` INT, IN `StartDate` DATE, IN `EndDate` DATE)  NO SQL
SELECT EventTitle as Title,EventStart as StartTime,EventEnd as EndTime,EventID as ID
FROM event
WHERE UserID = UserID AND EventStart > StartDate AND EventStart < EndDate 
Order by StartTime$$

DROP PROCEDURE IF EXISTS `get_User_Calender_Sleeps`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_User_Calender_Sleeps` (IN `UserID` INT, IN `StartDate` DATE, IN `EndDate` DATE)  NO SQL
SELECT 'Sleep' as Title,SleepStart as StartTime,SleepEnd as EndTime,SleepID as ID
FROM sleepinstance
WHERE UserID = UserID AND SleepStart > StartDate AND SleepStart < EndDate
Order by StartTime$$

DROP PROCEDURE IF EXISTS `insert_Event`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_Event` (IN `userID` INT, IN `eventTitle` VARCHAR(32), IN `eventStart` DATETIME, IN `eventEnd` DATETIME)  NO SQL
BEGIN
INSERT INTO event
(userID,eventTitle,eventStart,eventEnd) VALUES
(userID,eventTitle,eventStart,eventEnd);
END$$

DROP PROCEDURE IF EXISTS `insert_Sleep`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_Sleep` (IN `userID` INT, IN `sleepStart` DATETIME, IN `sleepEnd` DATETIME, IN `sleepMood` INT)  NO SQL
BEGIN
INSERT INTO sleepinstance
(userID,sleepStart,sleepEnd,sleepMood) VALUES
(userID,sleepStart,sleepEnd,sleepMood);
END$$

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
  `EventTitle` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EventStart` datetime NOT NULL,
  `EventEnd` datetime DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `FK_Event` (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `UserID`, `EventTitle`, `EventStart`, `EventEnd`) VALUES
(2, 0, 'Doctor\'s apointment', '2020-03-23 12:00:00', '2020-03-23 13:00:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sleepinstance`
--

INSERT INTO `sleepinstance` (`SleepID`, `UserID`, `SleepStart`, `SleepEnd`, `SleepMood`) VALUES
(2, 0, '2020-03-22 20:00:00', '2020-03-23 08:00:00', 1),
(3, 0, '2020-03-21 18:00:00', '2020-03-22 08:00:00', 5),
(4, 0, '2020-03-20 18:00:00', '2020-03-21 06:00:00', 6),
(5, 0, '2020-03-23 19:00:00', '2020-03-24 08:00:00', 3),
(6, 0, '2020-03-19 21:00:00', '2020-03-20 07:00:00', 7),
(7, 0, '2020-03-18 20:00:00', '2020-03-19 08:00:00', 4);

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
(0, 'bob.mill@plymouth.gov', 'Robert', 'Mill', 0x3132333435000000000000000000000000000000000000000000000000000000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
