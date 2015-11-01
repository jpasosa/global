-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


DROP TABLE IF EXISTS `modulo_dos`;
CREATE TABLE `modulo_dos` (
  `id_modulo_dos` int(10) NOT NULL AUTO_INCREMENT,
  `texto_uno` varchar(300) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_modulo_dos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE `archivos` (
  `id_archivo` int(10) NOT NULL AUTO_INCREMENT,
  `id_modulo_dos` int(10) NOT NULL,
  `nombre` varchar(300) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `posicion` int(2) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `id_modulo_dos` (`id_modulo_dos`),
  CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`id_modulo_dos`) REFERENCES `modulo_dos` (`id_modulo_dos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- 2015-10-06 20:36:54
