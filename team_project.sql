-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2014 at 04:13 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `team_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `LecturerID` varchar(15) NOT NULL,
  `LecturerName` varchar(100) NOT NULL,
  `Faculty` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `Trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`LecturerID`,`unitcode`),
  UNIQUE KEY `LecturerID` (`LecturerID`,`unitcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`LecturerID`, `LecturerName`, `Faculty`, `Department`, `Email`, `unitcode`, `Trimester`) VALUES
('123456', 'James', 'FES', 'IT', 'ooieh@utar.edu.my', 'uecs 2094', 'Jan2014');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `LecturerID` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  PRIMARY KEY (`LecturerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LecturerID`, `Password`) VALUES
('123456', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `unit file`
--

CREATE TABLE IF NOT EXISTS `unit file` (
  `FileName` varchar(100) NOT NULL,
  `Year/Trimester` varchar(10) NOT NULL,
  `UnitCode` varchar(10) NOT NULL,
  `UnitName` varchar(100) NOT NULL,
  `Last Uploaded` date NOT NULL,
  `FileStatus` tinyint(1) NOT NULL,
  `HOD in charge` varchar(100) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `Num of Quizzes` int(11) NOT NULL,
  `Num of Tests` int(11) NOT NULL,
  `Num of Labs` int(11) NOT NULL,
  `Num of Assignments` int(11) NOT NULL,
  PRIMARY KEY (`FileName`,`Year/Trimester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
