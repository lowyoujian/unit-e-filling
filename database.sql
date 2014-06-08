-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2014 at 11:02 AM
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
  `Unit Name` varchar(100) NOT NULL,
  `Location of Directory` varchar(5000) NOT NULL,
  `Date of Uploaded` date NOT NULL,
  `Date of Modified` date NOT NULL,
  `Status of Approval` tinyint(1) NOT NULL DEFAULT '0',
  `Lecturer ID` varchar(10) NOT NULL,
  `Lecturer Name` varchar(100) NOT NULL,
  `Lecturer Email` varchar(50) NOT NULL,
  `Total No. of Files` int(100) NOT NULL,
  `Total No. of Students` int(100) NOT NULL,
  PRIMARY KEY (`Unit Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
