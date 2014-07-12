
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
  `lecturerID` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`lecturerID`)
 
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
  PRIMARY KEY (`lecturerID`,`unitcode`)
) ;



INSERT INTO `login` (`LecturerID`, `Password`) VALUES
 ('123456', '123456');

INSERT INTO `lecturer` VALUES
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2094','WEB APPLICATION DEVELOPMENT','Jan/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS3333','WEB ENGINEERING','May/2014'),
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS2373','TEAM PROJECT','May/2014');


