CREATE TABLE  `unitFile` (
  `lecturerID` varchar(200) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `unitCode` varchar(10) NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `lastUpload` date NOT NULL,
  `fileStatus` varchar(200) NOT NULL,
  `hod` varchar(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
   PRIMARY KEY (`lecturerID`,`fileName`,`semester`)
) ;

CREATE TABLE IF NOT EXISTS `login` (
  `lecturerID` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`lecturerID`)
 ) ;


CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturerID` varchar(20) NOT NULL,
  `lecturerName` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(200) ,
  `unitdesc` varchar(100),
  `trimester` varchar(200) NOT NULL,
  `is_hod` BOOL,
  `hodunitcode` varchar(200),
  `hodunitdesc` varchar(200) ,
  PRIMARY KEY (`lecturerID`,`unitcode`, `trimester`,`hodunitcode`,`hodunitdesc`)
) ;


INSERT INTO `login` (`lecturerID`, `password`) VALUES
('1', '1'),
 ('2', '2' );

INSERT INTO `lecturer` VALUES
('1','Mr.James','FES','CS','jamesooi@utar.edu.my','UECS2094','WebApp','Jan/2014',FALSE,NULL,NULL),
('1','Mr.James','FES','CS','jamesooi@utar.edu.my','UECS1094','TCPIP','Jan/2014',FALSE,NULL,NULL),
('2','Dr. Victor', 'FES','CS', 'victortan@utar.edu.my',NULL,NULL,"Jan/2014",TRUE,'UECS2094','Web Application Development'),
('2','Dr. Victor', 'FES','CS', 'victortan@utar.edu.my',NULL,NULL,"Jan/2014" ,TRUE,'UECS1094','TCPIP'),
('2','Dr. Victor', 'FES','CS', 'victortan@utar.edu.my',"UECS9993","GameEngine","Jan/2014" ,TRUE,NULL,NULL),
('2','Dr. Victor', 'FES','CS', 'victortan@utar.edu.my',"UECS1993","Software Testing","Jan/2014" ,TRUE,NULL,NULL);
