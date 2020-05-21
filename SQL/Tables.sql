-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: May 21, 2020 at 04:27 PM
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
DROP PROCEDURE IF EXISTS `change_Theme_Setting`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `change_Theme_Setting` (IN `userID` INT, IN `newTheme` INT)  BEGIN
UPDATE settings
SET Theme = newTheme
WHERE UserID = userID;
END$$

DROP PROCEDURE IF EXISTS `check_For_Email`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `check_For_Email` (IN `EmailAddressIn` VARCHAR(255))  NO SQL
SELECT CASE WHEN COUNT(*) > 0 THEN TRUE ELSE FALSE END AS EmailAddress
FROM user WHERE user.EmailAddress COLLATE utf8_unicode_ci = EmailAddressIn$$

DROP PROCEDURE IF EXISTS `get_LogIn_Info`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_LogIn_Info` (IN `emailaddress` VARCHAR(255))  NO SQL
BEGIN
    SELECT Password, user.UserID, FirstName, LastName, settings.Theme
    FROM user
    LEFT JOIN settings ON user.UserID = settings.UserID
    WHERE user.EmailAddress COLLATE utf8_unicode_ci = emailaddress;
END$$

DROP PROCEDURE IF EXISTS `get_Setting_Theme`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_Setting_Theme` (IN `InUserID` INT)  NO SQL
SELECT Theme FROM settings
WHERE UserID = InUserID$$

DROP PROCEDURE IF EXISTS `get_Sleep_Range`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_Sleep_Range` (IN `Start` DATETIME, IN `End` DATETIME, IN `Userid` INT)  NO SQL
BEGIN
SELECT SleepStart, SleepEnd, TIMEDIFF(SleepEnd, SleepStart) 
FROM sleepinstance 
WHERE sleepinstance.Userid = UserID
AND  SleepStart BETWEEN Start and End 
ORDER BY SleepStart ASC;
END$$

DROP PROCEDURE IF EXISTS `get_User_Calendar_Events`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_User_Calendar_Events` (IN `UserID` INT, IN `StartDate` DATE, IN `EndDate` DATE)  NO SQL
SELECT EventTitle as Title,EventStart as StartTime,EventEnd as EndTime,EventID as ID
FROM event
WHERE UserID = event.UserID AND EventStart > StartDate AND EventStart < EndDate 
Order by StartTime$$

DROP PROCEDURE IF EXISTS `get_User_Calendar_Sleeps`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `get_User_Calendar_Sleeps` (IN `UserID` INT, IN `StartDate` DATE, IN `EndDate` DATE)  NO SQL
SELECT 'Sleep' as Title,SleepStart as StartTime,SleepEnd as EndTime,SleepID as ID
FROM sleepinstance
WHERE UserID = sleepinstance.UserID AND SleepStart > StartDate AND SleepStart < EndDate
Order by StartTime$$

DROP PROCEDURE IF EXISTS `insert_Event`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_Event` (IN `userID` INT, IN `eventTitle` VARCHAR(32), IN `eventStart` DATETIME, IN `eventEnd` DATETIME)  NO SQL
BEGIN
INSERT INTO event
(userID,eventTitle,eventStart,eventEnd) VALUES
(userID,eventTitle,eventStart,eventEnd);
END$$

DROP PROCEDURE IF EXISTS `insert_Settings`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_Settings` (IN `UserID` INT)  NO SQL
BEGIN
insert into settings (UserID,Theme) values (UserID,0); 
END$$

DROP PROCEDURE IF EXISTS `insert_Sleep`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_Sleep` (IN `userID` INT, IN `sleepStart` DATETIME, IN `sleepEnd` DATETIME, IN `sleepMood` INT)  NO SQL
BEGIN
INSERT INTO sleepinstance
(userID,sleepStart,sleepEnd,sleepMood) VALUES
(userID,sleepStart,sleepEnd,sleepMood);
END$$

DROP PROCEDURE IF EXISTS `insert_User`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `insert_User` (IN `EmailAddress` VARCHAR(255), IN `FirstName` VARCHAR(32), IN `LastName` VARCHAR(32), IN `Password` VARCHAR(255))  NO SQL
BEGIN
insert into User (EmailAddress,FirstName,LastName,Password) values (EmailAddress,FirstName,LastName,Password); 
END$$

DROP PROCEDURE IF EXISTS `remove_User`$$
CREATE DEFINER=`PRCO204_Y`@`%` PROCEDURE `remove_User` (IN `InputUserID` INT)  NO SQL
DELETE FROM user
WHERE
UserID = InputUserID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `EventTitle` varchar(32) NOT NULL,
  `EventStart` datetime NOT NULL,
  `EventEnd` datetime DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `FK_Event_Cascade` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `UserID`, `EventTitle`, `EventStart`, `EventEnd`) VALUES
(14, 24, 'Meeting', '2020-05-20 12:50:00', '2020-05-20 12:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `SettingsID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Theme` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SettingsID`),
  KEY `FK_Settings_Cascade` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SettingsID`, `UserID`, `Theme`) VALUES
(4, 24, 0),
(5, 24, 0),
(7, 24, 0),
(9, 29, 0);

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
  KEY `FK_SleepInstance_Cascade` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sleepinstance`
--

INSERT INTO `sleepinstance` (`SleepID`, `UserID`, `SleepStart`, `SleepEnd`, `SleepMood`) VALUES
(31, 24, '2020-05-19 22:13:00', '2020-05-20 06:41:00', 5),
(32, 24, '2020-05-18 21:42:00', '2020-05-19 07:28:00', 2),
(36, 24, '2020-05-15 04:19:00', '2020-05-15 12:19:00', 5),
(37, 24, '2020-05-21 04:19:00', '2020-05-21 12:19:00', 4),
(40, 29, '2020-05-21 05:16:00', '2020-05-21 14:16:00', 3),
(41, 29, '2020-05-20 05:16:00', '2020-05-20 19:16:00', 5),
(43, 29, '2020-05-18 05:20:00', '2020-05-18 20:20:00', 3),
(44, 29, '2020-05-19 05:20:00', '2020-05-19 21:20:00', 5),
(45, 29, '2020-05-20 22:21:00', '2020-05-20 23:21:00', 1);

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
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `EmailAddress` (`EmailAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `EmailAddress`, `FirstName`, `LastName`, `Password`) VALUES
(24, 'test@test.com', 'test', 'test', '$2y$10$jrkKW1UAuPAb4Ne.0W9HFuoBcK2VxAKVvgHG3VqrmD.kYMDDPWSeW'),
(29, 'demo@test.com', 'Demo', 'Video', '$2y$10$l/1PKPsYb6pBOHEHLAf8w..5hPoMQs6nDh9dd5kclFzaHuyVC6d6m');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_Event_Cascade` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `FK_Settings_Cascade` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `sleepinstance`
--
ALTER TABLE `sleepinstance`
  ADD CONSTRAINT `FK_SleepInstance_Cascade` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
