-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2019 at 07:02 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Assn_1_Committee_And_Attendees`
--

-- --------------------------------------------------------

--
-- Table structure for table `Committee_List`
--

CREATE TABLE `Committee_List` (
  `SubCommittee` varchar(45) NOT NULL,
  `ChairMemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Committee_Members`
--

CREATE TABLE `Committee_Members` (
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `HotelRoom`
--

CREATE TABLE `HotelRoom` (
  `RoomNumber` varchar(10) NOT NULL,
  `NumberOfBeds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `JobAdds`
--

CREATE TABLE `JobAdds` (
  `CompanyID` int(11) NOT NULL,
  `JobTitle` varchar(40) NOT NULL,
  `Location` varchar(40) NOT NULL,
  `PayRate` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Membership`
--

CREATE TABLE `Membership` (
  `SubCommittee` varchar(45) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Professionals`
--

CREATE TABLE `Professionals` (
  `ProfessionalID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Professional_Session_Schedule`
--

CREATE TABLE `Professional_Session_Schedule` (
  `ProfessionalId` int(11) NOT NULL,
  `SessionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE `Session` (
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `RoomLocation` varchar(40) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `SessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Speakers`
--

CREATE TABLE `Speakers` (
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `SpeakerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Speaker_Session_Schedule`
--

CREATE TABLE `Speaker_Session_Schedule` (
  `SpeakerID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Sponsors`
--

CREATE TABLE `Sponsors` (
  `SponsorType` varchar(20) NOT NULL,
  `NumEmails` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `CompanyName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Sponsor_Attendee`
--

CREATE TABLE `Sponsor_Attendee` (
  `SponsorID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Sponsor_Session_Schedule`
--

CREATE TABLE `Sponsor_Session_Schedule` (
  `SponsorID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `HotelRoom` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Student_Session_Schedule`
--

CREATE TABLE `Student_Session_Schedule` (
  `AttendeeID` int(11) NOT NULL,
  `SessionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Committee_List`
--
ALTER TABLE `Committee_List`
  ADD PRIMARY KEY (`SubCommittee`),
  ADD UNIQUE KEY `SubCommittee_UNIQUE` (`SubCommittee`),
  ADD KEY `ChairMemberID_idx` (`ChairMemberID`);

--
-- Indexes for table `Committee_Members`
--
ALTER TABLE `Committee_Members`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `HotelRoom`
--
ALTER TABLE `HotelRoom`
  ADD PRIMARY KEY (`RoomNumber`);

--
-- Indexes for table `JobAdds`
--
ALTER TABLE `JobAdds`
  ADD KEY `ComapanyID` (`CompanyID`);

--
-- Indexes for table `Membership`
--
ALTER TABLE `Membership`
  ADD PRIMARY KEY (`SubCommittee`,`MemberID`),
  ADD KEY `MemberID_idx` (`MemberID`),
  ADD KEY `SubCommittee_idx` (`SubCommittee`);

--
-- Indexes for table `Professionals`
--
ALTER TABLE `Professionals`
  ADD PRIMARY KEY (`ProfessionalID`);

--
-- Indexes for table `Professional_Session_Schedule`
--
ALTER TABLE `Professional_Session_Schedule`
  ADD PRIMARY KEY (`SessionId`,`ProfessionalId`),
  ADD KEY `ProfessionalID_idx` (`ProfessionalId`);

--
-- Indexes for table `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`SessionID`);

--
-- Indexes for table `Speakers`
--
ALTER TABLE `Speakers`
  ADD PRIMARY KEY (`SpeakerID`);

--
-- Indexes for table `Speaker_Session_Schedule`
--
ALTER TABLE `Speaker_Session_Schedule`
  ADD PRIMARY KEY (`SpeakerID`,`SessionID`),
  ADD KEY `SessionSpeakerID` (`SessionID`);

--
-- Indexes for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `Sponsor_Attendee`
--
ALTER TABLE `Sponsor_Attendee`
  ADD PRIMARY KEY (`SponsorID`),
  ADD KEY `ComapnyID_idx` (`CompanyID`);

--
-- Indexes for table `Sponsor_Session_Schedule`
--
ALTER TABLE `Sponsor_Session_Schedule`
  ADD PRIMARY KEY (`SponsorID`,`SessionID`),
  ADD KEY `SessionDropID_idx` (`SessionID`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `RoomNumber_idx` (`HotelRoom`);

--
-- Indexes for table `Student_Session_Schedule`
--
ALTER TABLE `Student_Session_Schedule`
  ADD PRIMARY KEY (`AttendeeID`,`SessionID`),
  ADD KEY `SessionID_idx` (`SessionID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Committee_List`
--
ALTER TABLE `Committee_List`
  ADD CONSTRAINT `ChairMemberID` FOREIGN KEY (`ChairMemberID`) REFERENCES `Committee_Members` (`MemberID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `JobAdds`
--
ALTER TABLE `JobAdds`
  ADD CONSTRAINT `ComapanyID` FOREIGN KEY (`CompanyID`) REFERENCES `Sponsors` (`CompanyID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Membership`
--
ALTER TABLE `Membership`
  ADD CONSTRAINT `MemberID` FOREIGN KEY (`MemberID`) REFERENCES `Committee_Members` (`MemberID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `SubCommittee` FOREIGN KEY (`SubCommittee`) REFERENCES `Committee_List` (`SubCommittee`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Professional_Session_Schedule`
--
ALTER TABLE `Professional_Session_Schedule`
  ADD CONSTRAINT `ProfessionalID` FOREIGN KEY (`ProfessionalId`) REFERENCES `Professionals` (`ProfessionalID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ProfessionalSessionID` FOREIGN KEY (`SessionId`) REFERENCES `Session` (`SessionID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Speaker_Session_Schedule`
--
ALTER TABLE `Speaker_Session_Schedule`
  ADD CONSTRAINT `SessionSpeakerID` FOREIGN KEY (`SessionID`) REFERENCES `Session` (`SessionID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `SpeakerID` FOREIGN KEY (`SpeakerID`) REFERENCES `Speakers` (`SpeakerID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Sponsor_Attendee`
--
ALTER TABLE `Sponsor_Attendee`
  ADD CONSTRAINT `ComapnyID` FOREIGN KEY (`CompanyID`) REFERENCES `Sponsors` (`CompanyID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Sponsor_Session_Schedule`
--
ALTER TABLE `Sponsor_Session_Schedule`
  ADD CONSTRAINT `SessionSponsors` FOREIGN KEY (`SessionID`) REFERENCES `Session` (`SessionID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `SponsorID` FOREIGN KEY (`SponsorID`) REFERENCES `Sponsor_Attendee` (`SponsorID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `RoomNumber` FOREIGN KEY (`HotelRoom`) REFERENCES `HotelRoom` (`RoomNumber`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `Student_Session_Schedule`
--
ALTER TABLE `Student_Session_Schedule`
  ADD CONSTRAINT `AttendeeID` FOREIGN KEY (`AttendeeID`) REFERENCES `Students` (`StudentID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `SessionStudentsID` FOREIGN KEY (`SessionID`) REFERENCES `Session` (`SessionID`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
