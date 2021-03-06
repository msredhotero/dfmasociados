-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-11-2014 a las 21:59:24
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
  `reftipocliente` int(11) DEFAULT NULL,
  `cuit` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`, `reftipocliente`, `cuit`) VALUES
(6, 'Saupurein Marcos', 'Sa0001', '', NULL, '', 5, '20315524661'),
(7, 'El pueblito S.A', 'El0007', '', NULL, '', 2, '468198654'),
(8, 'Capability S.A', 'Ca0008', '', NULL, '', 1, '2342355'),
(9, 'Ventura & Cía', 'Ve0009', '', NULL, '', 1, '54555');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `dbdetallefactura`
--

INSERT INTO `dbdetallefactura` (`iddetallefactura`, `importe`, `refiva`, `reffactura`) VALUES
(27, '0.00', 4, 9),
(26, '9300.00', 1, 9),
(25, '0.00', 2, 9),
(24, '0.00', 4, 8),
(23, '7500.00', 1, 8),
(22, '0.00', 2, 8),
(21, '0.00', 4, 7),
(20, '5000.00', 1, 7),
(19, '0.00', 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbfacturas`
--

CREATE TABLE IF NOT EXISTS `dbfacturas` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `nrofactura` varchar(45) NOT NULL,
  `fechacreacion` date NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dbfacturas`
--

INSERT INTO `dbfacturas` (`idfactura`, `nrofactura`, `fechacreacion`, `usuacrea`, `refformapago`, `refcliente`, `cancelada`, `reftipoiva`, `comentarios`, `mes`, `retencion`, `otros`, `percepcion`, `refactividad`, `exento`, `gravado`, `importe`, `baseimponible`) VALUES
(7, 'p', '2014-11-21', 'diego', 1, 7, b'1', 1, '', 'Noviembre', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '6050.00', '5000.00'),
(8, 'g', '2014-07-17', 'diego', 1, 8, b'1', 1, '', 'Octubre', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '9075.00', '7500.00'),
(9, 'd', '2014-07-18', 'diego', 1, 8, b'1', 1, '', 'Noviembre', '0.00', '0.00', '0.00', 1, '0.00', '0.00', '11253.00', '9300.00');

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
-- Estructura de tabla para la tabla `tbtipocliente`
--

CREATE TABLE IF NOT EXISTS `tbtipocliente` (
  `idtipocliente` int(11) NOT NULL AUTO_INCREMENT,
  `TipoCliente` varchar(50) NOT NULL,
  `proveedor` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipocliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbtipocliente`
--

INSERT INTO `tbtipocliente` (`idtipocliente`, `TipoCliente`, `proveedor`) VALUES
(1, 'Proveedor', b'1'),
(2, 'Responsable inscripto', b'1'),
(3, 'Monotributista', b'1'),
(4, 'Exento', b'1'),
(5, 'Consumidor Final', b'0'),
(6, 'Responsable inscripto', b'0'),
(7, 'Responsable monotributo', b'0');

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
,`fechacreacion` date
,`mes` varchar(20)
,`refcliente` int(11)
,`actividad` varchar(45)
,`retencion` decimal(18,2)
,`percepcion` decimal(18,2)
,`exento` decimal(18,2)
,`importeBase` decimal(18,2)
,`descripcion` varchar(30)
,`monto` decimal(4,2)
,`gravado` decimal(18,2)
,`importe` decimal(18,2)
,`baseimponible` decimal(18,2)
,`nombre` varchar(45)
,`TipoCliente` varchar(50)
,`proveedor` bit(1)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `viewfacturas`
--
DROP TABLE IF EXISTS `viewfacturas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewfacturas` AS select `dbfacturas`.`idfactura` AS `idfactura`,`dbfacturas`.`nrofactura` AS `nrofactura`,`dbfacturas`.`fechacreacion` AS `fechacreacion`,`dbfacturas`.`mes` AS `mes`,`dbfacturas`.`refcliente` AS `refcliente`,`tbactividad`.`actividad` AS `actividad`,`dbfacturas`.`retencion` AS `retencion`,`dbfacturas`.`percepcion` AS `percepcion`,`dbfacturas`.`exento` AS `exento`,`dbdetallefactura`.`importe` AS `importeBase`,`tbtipoiva`.`descripcion` AS `descripcion`,`tbtipoiva`.`monto` AS `monto`,`dbfacturas`.`gravado` AS `gravado`,`dbfacturas`.`importe` AS `importe`,`dbfacturas`.`baseimponible` AS `baseimponible`,`dbclientes`.`nombre` AS `nombre`,`tbtipocliente`.`TipoCliente` AS `TipoCliente`,`tbtipocliente`.`proveedor` AS `proveedor` from (((((`dbfacturas` join `dbclientes` on((`dbclientes`.`idcliente` = `dbfacturas`.`refcliente`))) join `tbactividad` on((`tbactividad`.`idactividad` = `dbfacturas`.`refactividad`))) join `dbdetallefactura` on((`dbdetallefactura`.`reffactura` = `dbfacturas`.`idfactura`))) join `tbtipoiva` on((`tbtipoiva`.`idtipoiva` = `dbdetallefactura`.`refiva`))) join `tbtipocliente` on((`tbtipocliente`.`idtipocliente` = `dbclientes`.`reftipocliente`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
