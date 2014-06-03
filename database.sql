-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2014 at 06:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `LecturerID` int(11) NOT NULL,
  `LecturerName` varchar(50) NOT NULL,
  `UnitCode` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Faculty` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `NumberOfStudents` int(100) NOT NULL,
  PRIMARY KEY (`LecturerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit file`
--

CREATE TABLE IF NOT EXISTS `unit file` (
  `Unit Code` varchar(10) NOT NULL,
  `Unit Name` varchar(50) NOT NULL,
  `Location of directory` longtext NOT NULL,
  `Date of uploaded` date NOT NULL,
  `Date of modified` date NOT NULL,
  `Status of approval` tinyint(1) NOT NULL,
  `Lecturer ID` varchar(10) NOT NULL,
  `Lecturer name` varchar(50) NOT NULL,
  `Total No. of Files` int(100) NOT NULL,
  PRIMARY KEY (`Unit Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
