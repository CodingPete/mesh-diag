-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mesh
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mesh
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mesh` DEFAULT CHARACTER SET utf8 ;
USE `mesh` ;

-- -----------------------------------------------------
-- Table `mesh`.`testcases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mesh`.`testcases` ;

CREATE TABLE IF NOT EXISTS `mesh`.`testcases` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `start` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `end` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mesh`.`samples`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mesh`.`samples` ;

CREATE TABLE IF NOT EXISTS `mesh`.`samples` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `timestamp` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `latitude` DOUBLE NOT NULL,
  `longitude` DOUBLE NOT NULL,
  `UUID` VARCHAR(128) NOT NULL,
  `testcases_id` INT NOT NULL,
  PRIMARY KEY (`id`, `testcases_id`),
  INDEX `timestamp_index` (`timestamp` ASC),
  INDEX `fk_samples_testcases_idx` (`testcases_id` ASC),
  CONSTRAINT `fk_samples_testcases`
    FOREIGN KEY (`testcases_id`)
    REFERENCES `mesh`.`testcases` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mesh`.`proximity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mesh`.`proximity` ;

CREATE TABLE IF NOT EXISTS `mesh`.`proximity` (
  `ID` INT NOT NULL,
  `UUID` VARCHAR(128) NOT NULL,
  `samples_id` INT NOT NULL,
  `samples_testcases_id` INT NOT NULL,
  PRIMARY KEY (`ID`, `samples_id`, `samples_testcases_id`),
  INDEX `fk_proximity_samples1_idx` (`samples_id` ASC, `samples_testcases_id` ASC),
  CONSTRAINT `fk_proximity_samples1`
    FOREIGN KEY (`samples_id` , `samples_testcases_id`)
    REFERENCES `mesh`.`samples` (`id` , `testcases_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mesh`.`remote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mesh`.`remote` ;

CREATE TABLE IF NOT EXISTS `mesh`.`remote` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `UUID` VARCHAR(128) NOT NULL,
  `samples_id` INT NOT NULL,
  `samples_testcases_id` INT NOT NULL,
  PRIMARY KEY (`id`, `samples_id`, `samples_testcases_id`),
  INDEX `fk_remote_samples1_idx` (`samples_id` ASC, `samples_testcases_id` ASC),
  CONSTRAINT `fk_remote_samples1`
    FOREIGN KEY (`samples_id` , `samples_testcases_id`)
    REFERENCES `mesh`.`samples` (`id` , `testcases_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
