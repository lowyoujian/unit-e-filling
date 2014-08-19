-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2014 at 06:17 PM
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
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`ID`, `department_name`) VALUES
(1, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `files_of_unit`
--

CREATE TABLE IF NOT EXISTS `files_of_unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `datetime_uploaded` datetime NOT NULL,
  `file_status` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `trimester` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `file_unit_id_fk` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `files_of_unit`
--

INSERT INTO `files_of_unit` (`ID`, `user_id`, `datetime_uploaded`, `file_status`, `location`, `unit_id`, `file_name`, `trimester`) VALUES
(1, '10101010', '2014-08-19 09:32:59', 0, 'upload/UECS 2094/May2014', 1, 'UECS 2094_May2014_lecture1.pdf', 'May2014'),

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_and_unit_files`
--

CREATE TABLE IF NOT EXISTS `lecturer_and_unit_files` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `unit_code` varchar(255) NOT NULL,
  `trimester` varchar(100) NOT NULL,
  `num_lecture` int(100) DEFAULT NULL,
  `num_tutorial` int(100) DEFAULT NULL,
  `num_practical` int(100) DEFAULT NULL,
  `num_assignment` int(100) DEFAULT NULL,
  `num_test` int(100) DEFAULT NULL,
  `num_quiz` int(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `luf_unit_id` (`unit_id`),
  KEY `luf_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lecturer_and_unit_files`
--

INSERT INTO `lecturer_and_unit_files` (`ID`, `user_id`, `unit_id`, `unit_code`, `trimester`, `num_lecture`, `num_tutorial`, `num_practical`, `num_assignment`, `num_test`, `num_quiz`) VALUES
(1, '10101010', 1, 'UECS 2094', 'May2014', 14, 14, 14, 1, 2, 2),
(2, '10101010', 2, 'UECS 2093', 'May2014', 4, 2, 3, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mod_and_unit`
--

CREATE TABLE IF NOT EXISTS `mod_and_unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `unit_code` varchar(20) NOT NULL,
  `trimester` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `md_unit_id` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_and_unit`
--

INSERT INTO `mod_and_unit` (`ID`, `user_id`, `unit_id`, `unit_code`, `trimester`) VALUES
(1, '20202020', 1, 'UECS 2094', 'May2014');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `programme_name` varchar(255) NOT NULL,
  `short_code` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`ID`, `programme_name`, `short_code`) VALUES
(1, 'Software Engineering', 'SE');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(255) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `programme_id` int(100) NOT NULL,
  `department_id` int(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `unit_pg_id` (`programme_id`),
  KEY `unit_dpt_id_fk` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`ID`, `unit_code`, `unit_name`, `programme_id`, `department_id`) VALUES
(1, 'UECS 2094', 'Web Application Development', 1, 1),
(2, 'UECS 2093', 'Web Application Development', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` int(3) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `name`, `position`) VALUES
('10101010', '10101010', 'Lim Ah Meh', 1),
('10101011', '10101011', 'Lim Ah Mei', 1),
('20202020', '20202020', 'Mod1', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files_of_unit`
--
ALTER TABLE `files_of_unit`
  ADD CONSTRAINT `file_unit_id_fk` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `lecturer_and_unit_files`
--
ALTER TABLE `lecturer_and_unit_files`
  ADD CONSTRAINT `luf_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `luf_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `mod_and_unit`
--
ALTER TABLE `mod_and_unit`
  ADD CONSTRAINT `md_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_dpt_id_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_pg_id` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
