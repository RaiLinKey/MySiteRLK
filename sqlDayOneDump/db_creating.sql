-- MySQL Script generated by MySQL Workbench
-- Sat Apr 11 17:32:01 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema site_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema site_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `site_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `site_db` ;

-- -----------------------------------------------------
-- Table `site_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_db`.`users` (
  `id_users` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_users`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_db`.`big_cat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_db`.`big_cat` (
  `id_big_cat` INT NOT NULL AUTO_INCREMENT,
  `big_cat_name` VARCHAR(255) NOT NULL,
  `big_cat_url` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_big_cat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_db`.`cat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_db`.`cat` (
  `id_cat` INT NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(255) NOT NULL,
  `cat_url` VARCHAR(255) NOT NULL,
  `id_of_big_cat` INT NOT NULL,
  PRIMARY KEY (`id_cat`),
  CONSTRAINT `fk_cat_big_cat1`
    FOREIGN KEY (`id_of_big_cat`)
    REFERENCES `site_db`.`big_cat` (`id_big_cat`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_cat_big_cat1_idx` ON `site_db`.`cat` (`id_of_big_cat` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `site_db`.`work_cards`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_db`.`work_cards` (
  `id_work_cards` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `img_url` VARCHAR(255) NOT NULL,
  `href_url` VARCHAR(255) NOT NULL,
  `id_of_cat` INT NOT NULL,
  PRIMARY KEY (`id_work_cards`),
  CONSTRAINT `fk_work_cards_cat`
    FOREIGN KEY (`id_of_cat`)
    REFERENCES `site_db`.`cat` (`id_cat`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_work_cards_cat_idx` ON `site_db`.`work_cards` (`id_of_cat` ASC) VISIBLE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
