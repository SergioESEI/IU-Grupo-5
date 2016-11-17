-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2016 a las 18:13:20
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `MOOVETT`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `Id_Actividad` varchar(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `DNI_Trabajador` varchar(10) NOT NULL,
  `Id_Espacio` varchar(10) NOT NULL,
  `Precio` float NOT NULL,
  `Categoria` enum('Baile','Deportiva','','') NOT NULL,
  `Capacidad_Max` int(11) NOT NULL,
  `Duracion` enum('Mensual','Bimensual','Trimensual','Cuatrimestral') NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Id_Calendario` varchar(10) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE IF NOT EXISTS `Alumno` (
  `Dni_a` varchar(9) NOT NULL,
  `Apellidos_a` varchar(70) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_a` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Fecha_nacimiento_a` datetime NOT NULL,
  `Observaciones` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Profesion` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Caja`
--

CREATE TABLE IF NOT EXISTS `Caja` (
  `Id_Caja` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `Tipo` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Importe` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calendario`
--

CREATE TABLE IF NOT EXISTS `Calendario` (
  `Id_Calendario` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_inicio` datetime NOT NULL,
  `Fecha_Fin` datetime NOT NULL,
  `Hora_Inicio` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Fin` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente_Externo`
--

CREATE TABLE IF NOT EXISTS `Cliente_Externo` (
  `Id_Cliente` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Dni` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Tlf` decimal(38,0) NOT NULL,
  `Email` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cobro`
--

CREATE TABLE IF NOT EXISTS `Cobro` (
  `Id_Cobro` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Dni_Alumno` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Actividad` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Importe` decimal(38,0) NOT NULL,
  `Fecha_Cobro` datetime NOT NULL,
  `Fecha_Confirmacion` datetime NOT NULL,
  `Tipo` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Controlador`
--

CREATE TABLE IF NOT EXISTS `Controlador` (
  `Nombre_Controlador` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descuento`
--

CREATE TABLE IF NOT EXISTS `Descuento` (
  `Id_descuento` varchar(20) NOT NULL,
  `Requisitos` varchar(150) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Porcentaje` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documento`
--

CREATE TABLE IF NOT EXISTS `Documento` (
  `Dni_a` varchar(9) NOT NULL,
  `Tipo_Doc` varchar(20) NOT NULL,
  `Fecha_Doc` datetime NOT NULL,
  `Url_Doc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espacio`
--

CREATE TABLE IF NOT EXISTS `Espacio` (
  `Id_Espacio` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `Id_evento` decimal(20,0) NOT NULL,
  `Descripcion` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE IF NOT EXISTS `Grupo` (
  `Nombre_Grupo` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horario`
--

CREATE TABLE IF NOT EXISTS `Horario` (
  `Id_Horario` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Calendario` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Fin` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inscripcion`
--

CREATE TABLE IF NOT EXISTS `Inscripcion` (
  `Dni_Alumno` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Actividad` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jornada`
--

CREATE TABLE IF NOT EXISTS `Jornada` (
  `Dni_t` varchar(9) NOT NULL,
  `Fecha_Jornada` datetime NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_fin` time NOT NULL,
  `Libre` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lesion`
--

CREATE TABLE IF NOT EXISTS `Lesion` (
  `Dni_a` varchar(9) NOT NULL,
  `Id_Lesion` varchar(9) NOT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Curada` tinyint(1) NOT NULL DEFAULT '0',
  `Descripcion` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Linea_Factura`
--

CREATE TABLE IF NOT EXISTS `Linea_Factura` (
  `Id_Factura` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Cantidad` decimal(38,0) NOT NULL,
  `IMPORTE` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log_Lesion`
--

CREATE TABLE IF NOT EXISTS `Log_Lesion` (
  `Dni_t` varchar(9) NOT NULL,
  `Dni_a` varchar(9) NOT NULL,
  `Id_Lesion` varchar(9) NOT NULL,
  `Fecha_Log` datetime NOT NULL,
  `Hora_Log` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Masaje`
--

CREATE TABLE IF NOT EXISTS `Masaje` (
  `Id_Masaje` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_M` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `Nombre_Grupo` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Controlador` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Espacio`
--

CREATE TABLE IF NOT EXISTS `Reserva_Espacio` (
  `Id_Reserva_Espacio` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Espacio` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Dni_Alumno` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Trabajador` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Fin` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `Evento` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Evento`
--

CREATE TABLE IF NOT EXISTS `Reserva_Evento` (
  `Id_evento` decimal(20,0) NOT NULL,
  `Id_reserva` decimal(20,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Masaje`
--

CREATE TABLE IF NOT EXISTS `Reserva_Masaje` (
  `Id_Masaje` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Dni_Alumno` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Dni_Trabajador` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Tipo_Masaje` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Fin` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicio`
--

CREATE TABLE IF NOT EXISTS `Servicio` (
  `Id_Servicio` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Trabajador` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Id_Cliente` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_a`
--

CREATE TABLE IF NOT EXISTS `Telefonos_a` (
  `Dni_a` varchar(9) NOT NULL,
  `Telefono_a` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_t`
--

CREATE TABLE IF NOT EXISTS `Telefonos_t` (
  `Dni_t` varchar(9) NOT NULL,
  `Telefono_t` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador`
--

CREATE TABLE IF NOT EXISTS `Trabajador` (
  `DNI` varchar(9) NOT NULL,
  `Apellidos_t` varchar(70) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_t` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Url_foto` varchar(100) NOT NULL,
  `Direccion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Fecha_nacimiento_t` datetime NOT NULL,
  `Observaciones` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Numero_cuenta` decimal(20,0) NOT NULL,
  `Horas_extra` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Tipo_empleado` enum('administrador','secretario','monitor','fisioterapeuta','cafeterÃ­a','limpieza','otros') NOT NULL,
  `Externo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador_Evento`
--

CREATE TABLE IF NOT EXISTS `Trabajador_Evento` (
  `Dni_t` varchar(9) NOT NULL,
  `Id_evento` decimal(20,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `DNI` varchar(9) NOT NULL,
  `Usuario` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Apellidos` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Grupo` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumno`
--
ALTER TABLE `Alumno`
 ADD PRIMARY KEY (`Dni_a`);

--
-- Indices de la tabla `Caja`
--
ALTER TABLE `Caja`
 ADD PRIMARY KEY (`Id_Caja`);

--
-- Indices de la tabla `Calendario`
--
ALTER TABLE `Calendario`
 ADD PRIMARY KEY (`Id_Calendario`);

--
-- Indices de la tabla `Cliente_Externo`
--
ALTER TABLE `Cliente_Externo`
 ADD PRIMARY KEY (`Id_Cliente`), ADD UNIQUE KEY `Dni` (`Dni`);

--
-- Indices de la tabla `Cobro`
--
ALTER TABLE `Cobro`
 ADD PRIMARY KEY (`Id_Cobro`), ADD KEY `Dni_Alumno` (`Dni_Alumno`,`Id_Actividad`);

--
-- Indices de la tabla `Controlador`
--
ALTER TABLE `Controlador`
 ADD PRIMARY KEY (`Nombre_Controlador`,`Accion`);

--
-- Indices de la tabla `Descuento`
--
ALTER TABLE `Descuento`
 ADD PRIMARY KEY (`Id_descuento`);

--
-- Indices de la tabla `Documento`
--
ALTER TABLE `Documento`
 ADD PRIMARY KEY (`Dni_a`,`Tipo_Doc`,`Fecha_Doc`);

--
-- Indices de la tabla `Espacio`
--
ALTER TABLE `Espacio`
 ADD PRIMARY KEY (`Id_Espacio`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
 ADD PRIMARY KEY (`Id_evento`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
 ADD PRIMARY KEY (`Nombre_Grupo`);

--
-- Indices de la tabla `Horario`
--
ALTER TABLE `Horario`
 ADD PRIMARY KEY (`Id_Horario`);

--
-- Indices de la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
 ADD PRIMARY KEY (`Dni_Alumno`,`Id_Actividad`);

--
-- Indices de la tabla `Jornada`
--
ALTER TABLE `Jornada`
 ADD PRIMARY KEY (`Dni_t`,`Fecha_Jornada`,`Hora_inicio`,`Hora_fin`);

--
-- Indices de la tabla `Lesion`
--
ALTER TABLE `Lesion`
 ADD PRIMARY KEY (`Dni_a`,`Id_Lesion`);

--
-- Indices de la tabla `Linea_Factura`
--
ALTER TABLE `Linea_Factura`
 ADD PRIMARY KEY (`Id_Factura`);

--
-- Indices de la tabla `Log_Lesion`
--
ALTER TABLE `Log_Lesion`
 ADD PRIMARY KEY (`Dni_t`,`Dni_a`,`Id_Lesion`), ADD KEY `Dni_a` (`Dni_a`,`Id_Lesion`);

--
-- Indices de la tabla `Masaje`
--
ALTER TABLE `Masaje`
 ADD PRIMARY KEY (`Id_Masaje`);

--
-- Indices de la tabla `Permisos`
--
ALTER TABLE `Permisos`
 ADD PRIMARY KEY (`Nombre_Grupo`,`Nombre_Controlador`,`Accion`), ADD KEY `Nombre_Controlador` (`Nombre_Controlador`,`Accion`);

--
-- Indices de la tabla `Reserva_Espacio`
--
ALTER TABLE `Reserva_Espacio`
 ADD PRIMARY KEY (`Id_Reserva_Espacio`);

--
-- Indices de la tabla `Reserva_Evento`
--
ALTER TABLE `Reserva_Evento`
 ADD PRIMARY KEY (`Id_evento`,`Id_reserva`);

--
-- Indices de la tabla `Reserva_Masaje`
--
ALTER TABLE `Reserva_Masaje`
 ADD PRIMARY KEY (`Id_Masaje`,`Dni_Alumno`,`Dni_Trabajador`);

--
-- Indices de la tabla `Servicio`
--
ALTER TABLE `Servicio`
 ADD PRIMARY KEY (`Id_Servicio`);

--
-- Indices de la tabla `Telefonos_a`
--
ALTER TABLE `Telefonos_a`
 ADD PRIMARY KEY (`Dni_a`,`Telefono_a`);

--
-- Indices de la tabla `Telefonos_t`
--
ALTER TABLE `Telefonos_t`
 ADD PRIMARY KEY (`Dni_t`,`Telefono_t`);

--
-- Indices de la tabla `Trabajador`
--
ALTER TABLE `Trabajador`
 ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `Trabajador_Evento`
--
ALTER TABLE `Trabajador_Evento`
 ADD PRIMARY KEY (`Dni_t`,`Id_evento`), ADD KEY `Id_evento` (`Id_evento`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
 ADD PRIMARY KEY (`Usuario`), ADD KEY `Nombre_Grupo` (`Nombre_Grupo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
