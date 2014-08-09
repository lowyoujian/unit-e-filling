-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2014 at 05:52 AM
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
-- Table structure for table `lecturer_and_unit`
--
CREATE TABLE IF NOT EXISTS `lecturer_and_unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `unit_id` varchar(30) NOT NULL,
  `unit_code` varchar(20) NOT NUll,
  `trimester` varchar(100) NOT NULL,
  `num_lecture` int(100) ,
  `num_tutorial` int(100),
  `num_practical` int(100),
  `num_assignment` int(100),
  `num_test` int(100),
  `num_quiz` int(100),
  PRIMARY KEY (`ID`)
  )ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- --------------------------------------------------------
--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_lecturer` int(3) NOT NULL,
  `is_hod` int(3) NOT NULL,
  `is_admin` int(3) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `programme_id` int(255) NOT NULL,
  PRIMARY KEY (`ID`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `files_of_unit`
--

CREATE TABLE IF NOT EXISTS `files_of_unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `lecturer_id` int(100) NOT NULL,
  `date_uploaded` date NOT NULL,
  `file_status` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `trimester` varchar(200) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `programme_name` varchar(255) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `short_code` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(255) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `programme_id` int(100) NOT NULL,
  `department_id` int(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- -------------------------------------
  ALTER TABLE `department`
  ADD CONSTRAINT `dp_pg_id` FOREIGN KEY (`programme_id`)
    REFERENCES programme(id)
    ON DELETE CASCADE;
-- ------------------------------------------------
ALTER TABLE `files_of_unit`
  ADD CONSTRAINT `file_unit_id_fk` FOREIGN KEY (`unit_id`)
    REFERENCES unit(id)
    ON DELETE CASCADE;

-- --------------------------------------------------------
  ALTER TABLE unit 
  ADD CONSTRAINT `unit_pg_id` FOREIGN KEY (`programme_id`)
    REFERENCES programme(id)
    ON DELETE CASCADE;
    
  ALTER TABLE unit
  ADD CONSTRAINT `unit_dpt_id_fk` FOREIGN KEY (`department_id`)
    REFERENCES department(id)
    ON DELETE CASCADE;
 -- -----------------------------------------------------   
  ALTER TABLE programme
  ADD CONSTRAINT `pg_unit_id_fk` FOREIGN KEY (`unit_id`)
    REFERENCES unit(id)
    ON DELETE CASCADE;
-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
