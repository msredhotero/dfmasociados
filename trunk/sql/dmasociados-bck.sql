/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : dmasociados

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2014-09-04 19:31:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `dbcontactos`
-- ----------------------------
DROP TABLE IF EXISTS `dbcontactos`;
CREATE TABLE `dbcontactos` (
  `idcontacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(400) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `fecha` datetime NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idcontacto`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dbcontactos
-- ----------------------------
INSERT INTO `dbcontactos` VALUES ('1', 'Marcos daniel saupurein safar', 'msredhotero@msn.com', 'Te queria preguntar cuanto sale ser un empresario exitoso jaja', '2014-09-04 19:11:42', '156184415');

-- ----------------------------
-- Table structure for `dbnoticiasusuarios`
-- ----------------------------
DROP TABLE IF EXISTS `dbnoticiasusuarios`;
CREATE TABLE `dbnoticiasusuarios` (
  `idnoticiasusuario` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idnoticiasusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dbnoticiasusuarios
-- ----------------------------

-- ----------------------------
-- Table structure for `dbusuarios`
-- ----------------------------
DROP TABLE IF EXISTS `dbusuarios`;
CREATE TABLE `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `refroll` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombrecompleto` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dbusuarios
-- ----------------------------
INSERT INTO `dbusuarios` VALUES ('3', 'marcos', 'rhcp7575', '1', 'msredhotero@msn.com', 'Saupurein Marcos');

-- ----------------------------
-- Table structure for `tbroles`
-- ----------------------------
DROP TABLE IF EXISTS `tbroles`;
CREATE TABLE `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbroles
-- ----------------------------
INSERT INTO `tbroles` VALUES ('1', 'Administrador');
INSERT INTO `tbroles` VALUES ('2', 'Cliente');
