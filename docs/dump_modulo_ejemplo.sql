-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `modulo_uno`;
CREATE TABLE `modulo_uno` (
  `id_modulo_uno` int(11) NOT NULL AUTO_INCREMENT,
  `texto_uno` varchar(300) DEFAULT NULL,
  `texto_dos` varchar(300) DEFAULT NULL,
  `textarea_uno` text,
  `textarea_dos` text,
  `fecha` date DEFAULT NULL,
  `id_select_opc` int(11) NOT NULL COMMENT 'tipo select con relacion a select_opc',
  `select_enum` enum('opcion1','opcion2','opcion3') NOT NULL COMMENT 'tipo select definiendo campo enum',
  `id_radiobutton` int(11) NOT NULL COMMENT 'Va a ser un radio button seleccionando elementos de tabla radiobutton',
  `radiobutton` enum('opcion_uno','opcion_dos','opcion_tres','opcion_cuatro','opcion_cinco') NOT NULL,
  `check` int(1) NOT NULL COMMENT 'Puede ser 1 o 0',
  `archivo` varchar(300) NOT NULL COMMENT 'Vamos a ingresar el nombre del archivo que va a subir al servidor',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_modulo_uno`),
  KEY `id_select_opc` (`id_select_opc`),
  CONSTRAINT `modulo_uno_ibfk_1` FOREIGN KEY (`id_select_opc`) REFERENCES `select_opc` (`id_select_opc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pepe';


DROP TABLE IF EXISTS `modulo_uno_mult_opc`;
CREATE TABLE `modulo_uno_mult_opc` (
  `id_modulo_uno_mult_opc` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo_uno` int(11) NOT NULL,
  `id_mult_opc` int(11) NOT NULL,
  PRIMARY KEY (`id_modulo_uno_mult_opc`),
  KEY `id_mult_opc` (`id_mult_opc`),
  KEY `id_modulo_uno` (`id_modulo_uno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `mult_opc`;
CREATE TABLE `mult_opc` (
  `id_mult_opc` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_mult_opc` varchar(300) NOT NULL,
  PRIMARY KEY (`id_mult_opc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `radiobutton`;
CREATE TABLE `radiobutton` (
  `id_radiobutton` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_radiobutton` varchar(300) NOT NULL,
  PRIMARY KEY (`id_radiobutton`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `select_opc`;
CREATE TABLE `select_opc` (
  `id_select_opc` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_select_opc` varchar(300) NOT NULL,
  PRIMARY KEY (`id_select_opc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-10-02 13:06:51
