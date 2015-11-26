SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `flowMeter` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `flowMeter` ;

-- -----------------------------------------------------
-- Table `flowMeter`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `flowMeter`.`users` ;

CREATE  TABLE IF NOT EXISTS `flowMeter`.`users` (
  `id_users` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id_users`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `flowMeter`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `flowMeter`.`login_attempts` ;

CREATE  TABLE IF NOT EXISTS `flowMeter`.`login_attempts` (
  `ip` VARCHAR(45) NOT NULL ,
  `first_attempt` TIMESTAMP NOT NULL ,
  `tries` SMALLINT NOT NULL ,
  PRIMARY KEY (`ip`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flowMeter`.`readings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `flowMeter`.`readings` ;

CREATE  TABLE IF NOT EXISTS `flowMeter`.`readings` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `flow` INT NOT NULL ,
  `volume` INT NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `flowMeter`.`broker_entries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `flowMeter`.`broker_entries` ;

CREATE  TABLE IF NOT EXISTS `flowMeter`.`broker_entries` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(45) NOT NULL ,
  `port` INT NOT NULL ,
  `topic` VARCHAR(256) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `flowMeter`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `flowMeter`;
INSERT INTO `flowMeter`.`users` (`id_users`, `name`, `email`, `password`) VALUES (1, 'Rogers Guedes', 'rogerguedes.ft@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI=');
INSERT INTO `flowMeter`.`users` (`id_users`, `name`, `email`, `password`) VALUES (2, 'Vinícius Carvalho', 'viniciuscarvalho789@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI=');
INSERT INTO `flowMeter`.`users` (`id_users`, `name`, `email`, `password`) VALUES (3, 'Nídia S. Campos', 'nidiascampos@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI=');

COMMIT;
