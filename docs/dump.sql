-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `id_rol` int(11) unsigned NOT NULL,
  `nombre_usuario` varchar(300) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `hash_reset_clave` varchar(300) DEFAULT NULL COMMENT 'es el código de la url que ingresa el usuario cuando pidió reset de su clave.',
  `tel_fijo_area` varchar(30) DEFAULT NULL,
  `tel_fijo_numero` varchar(30) DEFAULT NULL,
  `celu_area` varchar(30) DEFAULT NULL,
  `celu_numero` varchar(30) DEFAULT NULL,
  `id_localizacion` int(11) NOT NULL DEFAULT '0',
  `cuit` varchar(11) DEFAULT NULL,
  `iibb` varchar(45) DEFAULT NULL,
  `razon_social` varchar(250) DEFAULT NULL,
  `id_tipo_empresa` int(10) DEFAULT NULL,
  `tipo_empresa_otra` varchar(300) DEFAULT NULL,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 -> Inactivo  |  1 -> Activo',
  PRIMARY KEY (`id_usuario`,`email`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuarios_id_roles` (`id_rol`),
  CONSTRAINT `fk_usuarios_id_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-09-30 14:43:00