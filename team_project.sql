CREATE TABLE  `unitFile` (
  `fileName` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `unitCode` varchar(10) NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `lastUpload` date NOT NULL,
  `fileStatus` tinyint(1) NOT NULL,
  `hod` varchar(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
   PRIMARY KEY (`fileName`,`semester`)
) ;

CREATE TABLE IF NOT EXISTS `login` (
  `loginID` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `user` varchar(15) NOT NULL,	
  PRIMARY KEY (`loginID`, `user`)
 ) ;


CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturerID` varchar(15) NOT NULL,
  `lecturerName` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `unitdesc` varchar(100) NOT NULL,
  `trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`lecturerID`,`unitcode`, `trimester`)
) ;

CREATE TABLE  `hod` (
  `hodID` varchar(100) NOT NULL,
  `hodName` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `unitdesc` varchar(100) NOT NULL,
  `trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`hodID`,`unitcode`, `trimester`)
  ) ;


INSERT INTO `hod` VALUES
('lol','Crazy Lai','lol','FES','CS' ,'lai@utar.edu.my','UECS2094','WEB APPLICATION DEVELOPMENT','Jan/2014'),
('lol','Crazy Lai','lol','FES','CS' ,'lai@utar.edu.my','UECS2373','TEAM PROJECT','Jan/2014');



INSERT INTO `login` (`loginID`, `password`, `user`) VALUES
('123456', '123456', 'admin'),
 ('123456', '123456', 'lecturer');

INSERT INTO `lecturer` VALUES
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2094','WEB APPLICATION DEVELOPMENT','Jan/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS3333','WEB ENGINEERING','May/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2373','TEAM PROJECT','May/2014');CREATE TABLE  `unitFile` (
  `fileName` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `unitCode` varchar(10) NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `lastUpload` date NOT NULL,
  `fileStatus` tinyint(1) NOT NULL,
  `hod` varchar(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
   PRIMARY KEY (`fileName`,`semester`)
) ;

CREATE TABLE IF NOT EXISTS `login` (
  `loginID` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `user` varchar(15) NOT NULL,	
  PRIMARY KEY (`loginID`, `user`)
 ) ;


CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturerID` varchar(15) NOT NULL,
  `lecturerName` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `unitdesc` varchar(100) NOT NULL,
  `trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`lecturerID`,`unitcode`, `trimester`)
) ;

CREATE TABLE  `hod` (
  `hodID` varchar(100) NOT NULL,
  `hodName` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `unitdesc` varchar(100) NOT NULL,
  `trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`hodID`,`unitcode`, `trimester`)
  ) ;


INSERT INTO `hod` VALUES
('lol','Crazy Lai','lol','FES','CS' ,'lai@utar.edu.my','UECS2094','WEB APPLICATION DEVELOPMENT','Jan/2014'),
('lol','Crazy Lai','lol','FES','CS' ,'lai@utar.edu.my','UECS2373','TEAM PROJECT','Jan/2014');



INSERT INTO `login` (`loginID`, `password`, `user`) VALUES
('123456', '123456', 'admin'),
 ('123456', '123456', 'lecturer');

INSERT INTO `lecturer` VALUES
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2094','WEB APPLICATION DEVELOPMENT','Jan/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS3333','WEB ENGINEERING','May/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2373','TEAM PROJECT','May/2014');