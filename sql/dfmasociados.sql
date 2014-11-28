-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-11-2014 a las 00:08:29
-- Versión del servidor: 5.1.36-community-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dfmasociados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nrocliente` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nrodocumento` int(11) DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`) VALUES
(4, 'Saupurein Marcos', 'Sa0001', '', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdetallefactura`
--

CREATE TABLE IF NOT EXISTS `dbdetallefactura` (
  `iddetallefactura` int(11) NOT NULL AUTO_INCREMENT,
  `importe` decimal(18,2) NOT NULL,
  `refiva` smallint(6) NOT NULL,
  `reffactura` int(11) NOT NULL,
  PRIMARY KEY (`iddetallefactura`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbfacturas`
--

CREATE TABLE IF NOT EXISTS `dbfacturas` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `nrofactura` varchar(45) NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `usuacrea` varchar(45) NOT NULL,
  `refformapago` int(5) DEFAULT NULL,
  `refcliente` int(11) DEFAULT NULL,
  `cancelada` bit(1) NOT NULL DEFAULT b'0',
  `reftipoiva` int(1) NOT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `retencion` decimal(18,2) DEFAULT NULL,
  `otros` decimal(6,2) DEFAULT NULL,
  `percepcion` decimal(18,2) DEFAULT NULL,
  `refactividad` int(11) DEFAULT NULL,
  `exento` decimal(18,2) DEFAULT NULL,
  `gravado` decimal(18,2) DEFAULT NULL,
  `importe` decimal(18,2) DEFAULT NULL,
  `baseimponible` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`idfactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbactividad`
--

CREATE TABLE IF NOT EXISTS `tbactividad` (
  `idactividad` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(45) NOT NULL,
  `porcentaje` varchar(10) NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idactividad`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbactividad`
--

INSERT INTO `tbactividad` (`idactividad`, `actividad`, `porcentaje`, `activo`) VALUES
(1, 'Minorista', '3,5%', b'1'),
(2, 'Intermediario', '8%', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpercepciones`
--

CREATE TABLE IF NOT EXISTS `tbpercepciones` (
  `idpercepcion` int(1) NOT NULL AUTO_INCREMENT,
  `percepcion` varchar(5) NOT NULL,
  `monto` decimal(4,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idpercepcion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbretenciones`
--

CREATE TABLE IF NOT EXISTS `tbretenciones` (
  `idretencion` int(1) NOT NULL AUTO_INCREMENT,
  `retencion` varchar(5) NOT NULL,
  `monto` decimal(4,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idretencion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbretenciones`
--

INSERT INTO `tbretenciones` (`idretencion`, `retencion`, `monto`) VALUES
(1, '5%', '0.05'),
(2, '35%', '0.35'),
(3, '0%', '0.00'),
(4, '10%', '0.10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoiva`
--

CREATE TABLE IF NOT EXISTS `tbtipoiva` (
  `idtipoiva` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `activo` bit(1) NOT NULL,
  `monto` decimal(4,2) NOT NULL,
  PRIMARY KEY (`idtipoiva`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbtipoiva`
--

INSERT INTO `tbtipoiva` (`idtipoiva`, `descripcion`, `activo`, `monto`) VALUES
(1, '21%', b'1', '0.21'),
(2, '10,5%', b'1', '0.11'),
(3, '0%', b'1', '0.00'),
(4, '27%', b'1', '0.27');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewfacturas`
--
CREATE TABLE IF NOT EXISTS `viewfacturas` (
`idfactura` int(11)
,`nrofactura` varchar(45)
,`fechacreacion` datetime
,`mes` varchar(20)
,`refcliente` int(11)
,`actividad` varchar(45)
,`descripcion` varchar(30)
,`retencion` decimal(18,2)
,`percepcion` decimal(18,2)
,`exento` decimal(18,2)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `viewfacturas`
--
DROP TABLE IF EXISTS `viewfacturas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewfacturas` AS select `dbfacturas`.`idfactura` AS `idfactura`,`dbfacturas`.`nrofactura` AS `nrofactura`,`dbfacturas`.`fechacreacion` AS `fechacreacion`,`dbfacturas`.`mes` AS `mes`,`dbfacturas`.`refcliente` AS `refcliente`,`tbactividad`.`actividad` AS `actividad`,`tbtipoiva`.`descripcion` AS `descripcion`,`dbfacturas`.`retencion` AS `retencion`,`dbfacturas`.`percepcion` AS `percepcion`,`dbfacturas`.`exento` AS `exento` from (((`dbfacturas` join `dbclientes` on((`dbclientes`.`idcliente` = `dbfacturas`.`refcliente`))) join `tbactividad` on((`tbactividad`.`idactividad` = `dbfacturas`.`refactividad`))) join `tbtipoiva` on((`tbtipoiva`.`idtipoiva` = `dbfacturas`.`reftipoiva`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
