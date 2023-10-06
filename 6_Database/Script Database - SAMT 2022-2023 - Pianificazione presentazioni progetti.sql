-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gestionepresentazioniprogetti
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `gestionepresentazioniprogetti` ;

-- -----------------------------------------------------
-- Schema gestionepresentazioniprogetti
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestionepresentazioniprogetti` DEFAULT CHARACTER SET utf8mb4 ;
USE `gestionepresentazioniprogetti` ;

-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`docente` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`docente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cognome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`progetto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`progetto` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`progetto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` TEXT NOT NULL,
  `docenteId` INT NOT NULL,
  `allievoId` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`docenteId`)
    REFERENCES `gestionepresentazioniprogetti`.`docente` (`id`),
    FOREIGN KEY (`allievoId`)
    REFERENCES `gestionepresentazioniprogetti`.`allievo` (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`allievo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`allievo` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`allievo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `cognome` VARCHAR(50) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`classe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`classe` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`classe` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`anno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`anno` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`anno` (
  `id` INT(3) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`allievoClasseAnno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`allievoClasseAnno` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`allievoClasseAnno` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `allievoId` INT(11) NOT NULL,
  `classeId` INT(11) NOT NULL,
  `annoId` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`allievoId`)
    REFERENCES `gestionepresentazioniprogetti`.`allievo` (`id`),
    FOREIGN KEY (`classeId`)
    REFERENCES `gestionepresentazioniprogetti`.`classe` (`id`),
    FOREIGN KEY (`annoId`)
    REFERENCES `gestionepresentazioniprogetti`.`anno` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`orariProgettiClasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`orariProgettiClasse` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`orariProgettiClasse` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `classeId` INT(11) NOT NULL,
  `inizio` DATETIME NOT NULL,
  `fine` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`classeId`)
    REFERENCES `gestionepresentazioniprogetti`.`classe` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`sessione`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`sessione` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`sessione` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numeroProgetto` INT(1) NOT NULL,
  `annoId` INT(3) NOT NULL,
  `responsabile` VARCHAR(45) NULL,
  `capoLaboratorio` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`annoId`)
    REFERENCES `gestionepresentazioniprogetti`.`anno` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`pianificazione`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`pianificazione` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`pianificazione` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `versione` INT NOT NULL,
  `sessioneId` INT NOT NULL,
  `inizio` DATETIME NOT NULL,
  `fine` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`sessioneId`)
    REFERENCES `gestionepresentazioniprogetti`.`sessione` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`aula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`aula` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`aula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `WIFI` TINYINT NOT NULL,
  `nome` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`presentazione`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`presentazione` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`presentazione` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `progettoId` INT NOT NULL,
  `docente2Id` INT NOT NULL,
  `aulaId` INT NOT NULL,
  `dataOra` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`progettoId`)
    REFERENCES `gestionepresentazioniprogetti`.`progetto` (`id`),
    FOREIGN KEY (`docente2Id`)
    REFERENCES `gestionepresentazioniprogetti`.`docente` (`id`),
    FOREIGN KEY (`aulaId`)
    REFERENCES `gestionepresentazioniprogetti`.`aula` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`pianificazionePresentazione`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`pianificazionePresentazione` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`pianificazionePresentazione` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pianificazioneId` INT NOT NULL,
  `presentazioneId` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`pianificazioneId`)
    REFERENCES `gestionepresentazioniprogetti`.`pianificazione` (`id`),
    FOREIGN KEY (`presentazioneId`)
    REFERENCES `gestionepresentazioniprogetti`.`presentazione` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`impegniAllievo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`impegniAllievo` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`impegniAllievo` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `inizio` DATETIME NOT NULL,
  `fine` DATETIME NOT NULL,
  `allievoId` INT NOT NULL,
  PRIMARY KEY (`ID`, `inizio`, `fine`),
    FOREIGN KEY (`allievoId`)
    REFERENCES `gestionepresentazioniprogetti`.`allievo` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`orariProgettiDocente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`orariProgettiDocente` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`orariProgettiDocente` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `inizio` DATETIME NOT NULL,
  `fine` DATETIME NOT NULL,
  `docenteId` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`docenteId`)
    REFERENCES `gestionepresentazioniprogetti`.`docente` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`orariProgettiAula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`orariProgettiAula` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`orariProgettiAula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `inizio` DATETIME NOT NULL,
  `fine` DATETIME NOT NULL,
  `aulaId` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`aulaId`)
    REFERENCES `gestionepresentazioniprogetti`.`aula` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`login`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`login` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`login` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
INSERT INTO login (username,password) VALUES("root","4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2");



-- -----------------------------------------------------
-- Table `gestionepresentazioniprogetti`.`approva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestionepresentazioniprogetti`.`approva` ;

CREATE TABLE IF NOT EXISTS `gestionepresentazioniprogetti`.`approva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `docenteId` INT NOT NULL,
  `pianificazioneId` INT NOT NULL,
  `approvata` TINYINT NOT NULL,
  `motivazione` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`pianificazioneId`)
    REFERENCES `gestionepresentazioniprogetti`.`pianificazione` (`id`),
    FOREIGN KEY (`docenteId`)
    REFERENCES `gestionepresentazioniprogetti`.`docente` (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
