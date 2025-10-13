-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nomeUsuario` VARCHAR(255) NOT NULL,
  `emailUsuario` VARCHAR(255) NOT NULL,
  `senhaUsuario` VARCHAR(255) NOT NULL,
  `tipoUsuario` ENUM('cliente', 'administrador') NOT NULL,
  `categoriaCliente` ENUM('PF', 'PJ') NOT NULL,
  `nivelAcessoUsuario` VARCHAR(50) NOT NULL,
  `cpf_cnpjUsuario` VARCHAR(20) NOT NULL,
  `telefoneUsuario` VARCHAR(50) NULL,
  `enderecoUsuario` TEXT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `emailUsuario_UNIQUE` (`emailUsuario` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ferramenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ferramenta` (
  `idFerramenta` INT NOT NULL AUTO_INCREMENT,
  `nomeFerramenta` VARCHAR(255) NOT NULL,
  `modeloFerramenta` VARCHAR(255) NOT NULL,
  `categoriaFerramenta` VARCHAR(255) NULL,
  `precoFerramenta` DECIMAL(10,2) NOT NULL,
  `disponibilidadeFerramenta` ENUM('disponivel', 'reservada', 'inativa') NOT NULL,
  `fotoFerramenta` VARCHAR(255) NULL,
  PRIMARY KEY (`idFerramenta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `dataReserva` DATE NOT NULL,
  `dataDevolucaoReserva` DATE NOT NULL,
  `statusReserva` ENUM('ativa', 'finalizada', 'cancelada') NOT NULL,
  `statusPagamentoReserva` ENUM('efetuado', 'pendente') NOT NULL,
  `idUsuario` INT NOT NULL,
  `idFerramenta` INT NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_reserva_usuario_idx` (`idUsuario` ASC) VISIBLE,
  INDEX `fk_reserva_ferramenta1_idx` (`idFerramenta` ASC) VISIBLE,
  CONSTRAINT `fk_reserva_usuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `mydb`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_ferramenta1`
    FOREIGN KEY (`idFerramenta`)
    REFERENCES `mydb`.`ferramenta` (`idFerramenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
