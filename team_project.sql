CREATE TABLE IF NOT EXISTS  `unitFile` (
  `fileName` varchar(100) NOT NULL,
  `unitCode` varchar(255) NOT NULL,
  `trimester` varchar(100) NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `lastUpload` varchar(255) NOT NULL,
  `fileStatus` varchar(50) NOT NULL,
  `hod` varchar(100) NOT NULL,
  `dir` varchar(255) NOT NULL,
   PRIMARY KEY (`fileName`,`trimester`)
) ;

CREATE TABLE IF NOT EXISTS `login` (
  `lecturerID` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`lecturerID`)
) ;

CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturerID` varchar(30) NOT NULL,
  `lecturerName` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `unitcode` varchar(40) NOT NULL,
  `trimester` varchar(50) NOT NULL,
  PRIMARY KEY (`lecturerID`,`unitcode`)
) ;

INSERT INTO `login` (`LecturerID`, `Password`) VALUES
 ('123456', '123456');

INSERT INTO `lecturer`() VALUES
('123456','Mr. Ooi','FES','CS', 'ooieh@utar.edu.my','UECS 2094','Jan2014');