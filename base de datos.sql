-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `biblioteca`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombreCategoria` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Pais` (
  `idPais` INT NOT NULL AUTO_INCREMENT,
  `nombrePais` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idPais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Formato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Formato` (
  `idFormatos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`idFormatos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Idioma` (
  `idIdioma` INT NOT NULL AUTO_INCREMENT,
  `nombreIdioma` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`idIdioma`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Libro` (
  `idLibro` INT NOT NULL AUTO_INCREMENT,
  `tituloLibro` VARCHAR(64) NOT NULL,
  `isbn` VARCHAR(32) NULL,
  `añoEdicion` INT NULL,
  `numeroPaginas` INT NOT NULL,
  `sinopsis` VARCHAR(2048) NULL,
  `portada` VARCHAR(64) NULL,
  `disponibilidad` TINYINT NOT NULL,
  `Pais_idPais` INT NOT NULL,
  `Categoria_idCategoria` INT NOT NULL,
  `Formato_idFormatos` INT NOT NULL,
  `Idioma_idIdioma` INT NOT NULL,
  PRIMARY KEY (`idLibro`),
  CONSTRAINT `fk_Libro_Pais1`
    FOREIGN KEY (`Pais_idPais`)
    REFERENCES `biblioteca`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libro_Categoria1`
    FOREIGN KEY (`Categoria_idCategoria`)
    REFERENCES `biblioteca`.`Categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libro_Formato1`
    FOREIGN KEY (`Formato_idFormatos`)
    REFERENCES `biblioteca`.`Formato` (`idFormatos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libro_Idioma1`
    FOREIGN KEY (`Idioma_idIdioma`)
    REFERENCES `biblioteca`.`Idioma` (`idIdioma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Editorial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Editorial` (
  `idEditorial` INT NOT NULL AUTO_INCREMENT,
  `nombreEditorial` VARCHAR(64) NOT NULL,
  `Libro_idLibro` INT NOT NULL,
  PRIMARY KEY (`idEditorial`),
    CONSTRAINT `fk_Editorial_Libro1`
    FOREIGN KEY (`Libro_idLibro`)
    REFERENCES `biblioteca`.`Libro` (`idLibro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Universidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Universidad` (
  `idUniversidad` INT NOT NULL AUTO_INCREMENT,
  `nombreUniversidad` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idUniversidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Autor` (
  `idAutor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL,
  `paisProcedencia` INT NOT NULL,
  PRIMARY KEY (`idAutor`),
    CONSTRAINT `fk_Autor_Pais`
    FOREIGN KEY (`paisProcedencia`)
    REFERENCES `biblioteca`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`NivelUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`NivelUsuario` (
  `idNivelUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idNivelUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(16) NOT NULL,
  `apellidoPaterno` VARCHAR(16) NOT NULL,
  `apellidoMaterno` VARCHAR(16) NOT NULL,
  `correroElectronico` VARCHAR(32) NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `contraseña` VARCHAR(32) NOT NULL,
  `nombreUsuario` VARCHAR(32) NOT NULL,
  `sexo` CHAR(1) NULL,
  `bloqueado` TINYINT NULL,
  `pais` INT NOT NULL,
  `nivelUsuario` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
    CONSTRAINT `fk_Usuario_Pais1`
    FOREIGN KEY (`pais`)
    REFERENCES `biblioteca`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_NivelUsuario1`
    FOREIGN KEY (`nivelUsuario`)
    REFERENCES `biblioteca`.`NivelUsuario` (`idNivelUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Facultades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Facultades` (
  `idFacultades` INT NOT NULL AUTO_INCREMENT,
  `nombreFacultad` VARCHAR(32) NOT NULL,
  `direccion` VARCHAR(64) NULL,
  `codigoPostal` INT NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `Pais` INT NOT NULL,
  `idUniversidad` INT NOT NULL,
  `idAdministador` INT NOT NULL,
  `Facultadescol` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFacultades`),
  CONSTRAINT `fk_Facultades_Pais1`
    FOREIGN KEY (`Pais`)
    REFERENCES `biblioteca`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Facultades_Universidad1`
    FOREIGN KEY (`idUniversidad`)
    REFERENCES `biblioteca`.`Universidad` (`idUniversidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Facultades_Usuario1`
    FOREIGN KEY (`idAdministador`)
    REFERENCES `biblioteca`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`AutorLibro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`AutorLibro` (
  `idLibro` INT NOT NULL,
  `idAutor` INT NOT NULL,
  PRIMARY KEY (`idLibro`, `idAutor`),
    CONSTRAINT `fk_Libro_has_Autor_Libro1`
    FOREIGN KEY (`idLibro`)
    REFERENCES `biblioteca`.`Libro` (`idLibro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libro_has_Autor_Autor1`
    FOREIGN KEY (`idAutor`)
    REFERENCES `biblioteca`.`Autor` (`idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Subidas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Subidas` (
  `Libro_idLibro` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`Libro_idLibro`, `Usuario_idUsuario`),
    CONSTRAINT `fk_Libro_has_Usuario_Libro1`
    FOREIGN KEY (`Libro_idLibro`)
    REFERENCES `biblioteca`.`Libro` (`idLibro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libro_has_Usuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `biblioteca`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Prestamo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Prestamo` (
  `Facultades_idFacultades` INT NOT NULL,
  `Libro_idLibro` INT NOT NULL,
  `fechaSolicitud` DATE NOT NULL,
  `fechaEntrega` DATE NULL,
  `fechaDevolucion` DATE NOT NULL,
  PRIMARY KEY (`Facultades_idFacultades`, `Libro_idLibro`),
    CONSTRAINT `fk_Facultades_has_Libro_Facultades1`
    FOREIGN KEY (`Facultades_idFacultades`)
    REFERENCES `biblioteca`.`Facultades` (`idFacultades`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Facultades_has_Libro_Libro1`
    FOREIGN KEY (`Libro_idLibro`)
    REFERENCES `biblioteca`.`Libro` (`idLibro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
