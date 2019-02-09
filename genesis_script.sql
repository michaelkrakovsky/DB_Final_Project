-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Assn_1_Committee_And_Attendees
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Assn_1_Committee_And_Attendees
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Assn_1_Committee_And_Attendees` DEFAULT CHARACTER SET utf8 ;
USE `Assn_1_Committee_And_Attendees` ;

-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Committee_Members`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Committee_Members` (
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `MemberID` INT NOT NULL,
  PRIMARY KEY (`MemberID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`HotelRoom`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`HotelRoom` (
  `RoomNumber` VARCHAR(10) NOT NULL,
  `NumberOfBeds` INT NOT NULL,
  PRIMARY KEY (`RoomNumber`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Students` (
  `StudentID` INT NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `HotelRoom` VARCHAR(10) NULL,
  PRIMARY KEY (`StudentID`),
  INDEX `RoomNumber_idx` (`HotelRoom` ASC) VISIBLE,
  CONSTRAINT `RoomNumber`
    FOREIGN KEY (`HotelRoom`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`HotelRoom` (`RoomNumber`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Session` (
  `StartTime` DATETIME NOT NULL,
  `EndTime` DATETIME NOT NULL,
  `RoomLocation` VARCHAR(40) NOT NULL,
  `Name` VARCHAR(40) NOT NULL,
  `SessionID` INT NOT NULL,
  PRIMARY KEY (`SessionID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Student_Session_Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Student_Session_Schedule` (
  `AttendeeID` INT NOT NULL,
  `SessionID` INT NOT NULL,
  PRIMARY KEY (`AttendeeID`, `SessionID`),
  INDEX `SessionID_idx` (`SessionID` ASC) VISIBLE,
  CONSTRAINT `SessionStudentsID`
    FOREIGN KEY (`SessionID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Session` (`SessionID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `AttendeeID`
    FOREIGN KEY (`AttendeeID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Students` (`StudentID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Speakers` (
  `FirstName` VARCHAR(40) NOT NULL,
  `LastName` VARCHAR(40) NOT NULL,
  `SpeakerID` INT NOT NULL,
  PRIMARY KEY (`SpeakerID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Sponsors` (
  `SponsorType` VARCHAR(20) NOT NULL,
  `NumEmails` INT NOT NULL,
  `CompanyID` INT NOT NULL,
  `CompanyName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`CompanyID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Sponsor_Attendee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Sponsor_Attendee` (
  `SponsorID` INT NOT NULL,
  `CompanyID` INT NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`SponsorID`),
  INDEX `ComapnyID_idx` (`CompanyID` ASC) VISIBLE,
  CONSTRAINT `ComapnyID`
    FOREIGN KEY (`CompanyID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Sponsors` (`CompanyID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`JobAdds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`JobAdds` (
  `CompanyID` INT NOT NULL,
  `JobTitle` VARCHAR(40) NOT NULL,
  `Location` VARCHAR(40) NOT NULL,
  `PayRate` INT UNSIGNED NOT NULL,
  CONSTRAINT `ComapanyID`
    FOREIGN KEY (`CompanyID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Sponsors` (`CompanyID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Committee_List`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Committee_List` (
  `SubCommittee` VARCHAR(45) NOT NULL,
  `ChairMemberID` INT NOT NULL,
  PRIMARY KEY (`SubCommittee`),
  UNIQUE INDEX `SubCommittee_UNIQUE` (`SubCommittee` ASC) VISIBLE,
  INDEX `ChairMemberID_idx` (`ChairMemberID` ASC) VISIBLE,
  CONSTRAINT `ChairMemberID`
    FOREIGN KEY (`ChairMemberID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Committee_Members` (`MemberID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Membership`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Membership` (
  `SubCommittee` VARCHAR(45) NOT NULL,
  `MemberID` INT NOT NULL,
  INDEX `MemberID_idx` (`MemberID` ASC) VISIBLE,
  INDEX `SubCommittee_idx` (`SubCommittee` ASC) VISIBLE,
  PRIMARY KEY (`SubCommittee`, `MemberID`),
  CONSTRAINT `MemberID`
    FOREIGN KEY (`MemberID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Committee_Members` (`MemberID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `SubCommittee`
    FOREIGN KEY (`SubCommittee`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Committee_List` (`SubCommittee`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Sponsor_Session_Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Sponsor_Session_Schedule` (
  `SponsorID` INT NOT NULL,
  `SessionID` INT NOT NULL,
  PRIMARY KEY (`SponsorID`, `SessionID`),
  INDEX `SessionDropID_idx` (`SessionID` ASC) VISIBLE,
  CONSTRAINT `SponsorID`
    FOREIGN KEY (`SponsorID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Sponsor_Attendee` (`SponsorID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `SessionSponsors!D`
    FOREIGN KEY (`SessionID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Session` (`SessionID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Speaker_Session_Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Speaker_Session_Schedule` (
  `SpeakerID` INT NOT NULL,
  `SessionID` INT NOT NULL,
  PRIMARY KEY (`SpeakerID`, `SessionID`),
  CONSTRAINT `SpeakerID`
    FOREIGN KEY (`SpeakerID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Speakers` (`SpeakerID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `SessionSpeakerID`
    FOREIGN KEY (`SessionID`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Session` (`SessionID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Professionals`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Professionals` (
  `ProfessionalID` INT NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ProfessionalID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Assn_1_Committee_And_Attendees`.`Professional_Session_Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Assn_1_Committee_And_Attendees`.`Professional_Session_Schedule` (
  `ProfessionalId` INT NOT NULL,
  `SessionId` INT NOT NULL,
  PRIMARY KEY (`SessionId`, `ProfessionalId`),
  INDEX `ProfessionalID_idx` (`ProfessionalId` ASC) VISIBLE,
  CONSTRAINT `ProfessionalSessionID`
    FOREIGN KEY (`SessionId`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Session` (`SessionID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `ProfessionalID`
    FOREIGN KEY (`ProfessionalId`)
    REFERENCES `Assn_1_Committee_And_Attendees`.`Professionals` (`ProfessionalID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
