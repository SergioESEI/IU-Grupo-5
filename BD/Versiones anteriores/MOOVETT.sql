-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-11-2016 a las 21:41:33
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Moovett`
--

DROP DATABASE IF EXISTS `MOOVETT`;
SET SQL_MODE=`NO_AUTO_VALUE_ON_ZERO`;
CREATE DATABASE `MOOVETT` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `MOOVETT`;
GRANT USAGE ON * . * TO  'root'@'localhost' IDENTIFIED BY  'iu'
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON  `MOOVETT` . * TO  'root'@'localhost' WITH GRANT OPTION ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `Id_Actividad` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_Trabajador` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Espacio` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Precio` float NOT NULL,
  `Categoria` enum('Baile','Deportiva','','') COLLATE latin1_spanish_ci NOT NULL,
  `Capacidad_Max` int(11) NOT NULL,
  `Duracion` enum('Mensual','Bimensual','Trimensual','Cuatrimestral') COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Id_Calendario` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE IF NOT EXISTS `Alumno` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Apellidos` varchar(70) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Observaciones` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `Profesion` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE IF NOT EXISTS `Asistencia` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Asistencia` date NOT NULL,
  `Asistencia` tinyint(1) NOT NULL,
  `Id_Actividad` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Caja`
--

CREATE TABLE IF NOT EXISTS `Caja` (
  `Id_Caja` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Tipo` enum('Ingreso','Pago','','') COLLATE latin1_spanish_ci NOT NULL,
  `Importe` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calendario`
--

CREATE TABLE IF NOT EXISTS `Calendario` (
  `Id_Calendario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente_Externo`
--

CREATE TABLE IF NOT EXISTS `Cliente_Externo` (
  `Id_Cliente` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `DNI` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Tlf` smallint(10) NOT NULL,
  `Email` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cobro`
--

CREATE TABLE IF NOT EXISTS `Cobro` (
  `Id_Cobro` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_Alumno` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Importe` float NOT NULL,
  `Fecha_Cobro` date NOT NULL,
  `Fecha_Confirmacion` date NOT NULL,
  `Tipo` enum('Efectivo','Domiciliacion','TPV','') COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Controlador`
--

CREATE TABLE IF NOT EXISTS `Controlador` (
  `Nombre_Controlador` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descuento`
--

CREATE TABLE IF NOT EXISTS `Descuento` (
  `Id_Descuento` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Requisitos` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `Porcentaje` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documento`
--

CREATE TABLE IF NOT EXISTS `Documento` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo_Documento` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Documento` date NOT NULL,
  `Url_Documento` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espacio`
--

CREATE TABLE IF NOT EXISTS `Espacio` (
  `Id_Espacio` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `Id_Evento` int(20) NOT NULL,
  `Descripcion` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE IF NOT EXISTS `Grupo` (
  `Nombre_Grupo` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horario`
--

CREATE TABLE IF NOT EXISTS `Horario` (
  `Id_Horario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Calendario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inscripcion`
--

CREATE TABLE IF NOT EXISTS `Inscripcion` (
  `DNI_A` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Actividad` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Cobro` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jornada`
--

CREATE TABLE IF NOT EXISTS `Jornada` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Hora_Salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lesion`
--

CREATE TABLE IF NOT EXISTS `Lesion` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Lesion` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Curada` bool NOT NULL,
  `Descripcion` varchar(500) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Linea_Factura`
--

CREATE TABLE IF NOT EXISTS `Linea_Factura` (
  `Id_Factura` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Importe` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log_Lesion`
--

CREATE TABLE IF NOT EXISTS `Log_Lesion` (
  `DNI_T` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_A` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Lesion` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Log` date NOT NULL,
  `Hora_Log` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Masaje`
--

CREATE TABLE IF NOT EXISTS `Masaje` (
  `Id_Masaje` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `Nombre_Grupo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Controlador` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Espacio`
--

CREATE TABLE IF NOT EXISTS `Reserva_Espacio` (
  `Id_Reserva` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Espacio` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_Alumno` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `ID_Trabajador` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Fecha` date NOT NULL,
  `Evento` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Evento`
--

CREATE TABLE IF NOT EXISTS `Reserva_Evento` (
  `Id_Evento` int(20) NOT NULL,
  `Id_Reserva` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Masaje`
--

CREATE TABLE IF NOT EXISTS `Reserva_Masaje` (
  `Id_Masaje` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Reserva` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_A` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `DNI_T` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicio`
--

CREATE TABLE IF NOT EXISTS `Servicio` (
  `Id_Servicio` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Trabajador` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Cliente` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Descripcion` varchar(500) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Alumno`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Alumno` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Trabajador`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Trabajador` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador`
--

CREATE TABLE IF NOT EXISTS `Trabajador` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Apellidos` varchar(70) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Url_Foto` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Observaciones` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `Numero_Cuenta` int(20) NOT NULL,
  `Horas_Extra` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Grupo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo_Empleado` enum('administrador','secretario','monitor','fisioterapeuta','cafeteria','limpieza','otros') COLLATE latin1_spanish_ci NOT NULL,
  `Externo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador_Evento`
--

CREATE TABLE IF NOT EXISTS `Trabajador_Evento` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Evento` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Grupo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Password` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Actividad`
--
ALTER TABLE `Actividad`
 ADD PRIMARY KEY (`Id_Actividad`), ADD KEY `DNI_Trabajador` (`DNI_Trabajador`), ADD KEY `Id_Espacio` (`Id_Espacio`), ADD KEY `Id_Calendario` (`Id_Calendario`);

--
-- Indices de la tabla `Alumno`
--
ALTER TABLE `Alumno`
 ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
 ADD PRIMARY KEY (`DNI`,`Fecha_Asistencia`,`Id_Actividad`), ADD KEY `Id_Actividad` (`Id_Actividad`);

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
 ADD PRIMARY KEY (`Id_Cliente`), ADD UNIQUE KEY `DNI` (`DNI`), ADD UNIQUE KEY `Direccion` (`Direccion`), ADD UNIQUE KEY `Direccion_2` (`Direccion`);

--
-- Indices de la tabla `Cobro`
--
ALTER TABLE `Cobro`
 ADD PRIMARY KEY (`Id_Cobro`), ADD KEY `DNI_Alumno` (`DNI_Alumno`);

--
-- Indices de la tabla `Controlador`
--
ALTER TABLE `Controlador`
 ADD PRIMARY KEY (`Nombre_Controlador`,`Accion`);

--
-- Indices de la tabla `Descuento`
--
ALTER TABLE `Descuento`
 ADD PRIMARY KEY (`Id_Descuento`);

--
-- Indices de la tabla `Documento`
--
ALTER TABLE `Documento`
 ADD PRIMARY KEY (`DNI`,`Tipo_Documento`,`Fecha_Documento`);

--
-- Indices de la tabla `Espacio`
--
ALTER TABLE `Espacio`
 ADD PRIMARY KEY (`Id_Espacio`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
 ADD PRIMARY KEY (`Id_Evento`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
 ADD PRIMARY KEY (`Nombre_Grupo`);

--
-- Indices de la tabla `Horario`
--
ALTER TABLE `Horario`
 ADD PRIMARY KEY (`Id_Horario`), ADD KEY `Id_Calendario` (`Id_Calendario`);

--
-- Indices de la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
 ADD PRIMARY KEY (`DNI_A`,`Id_Actividad`,`Id_Cobro`), ADD KEY `Id_Actividad` (`Id_Actividad`), ADD KEY `Id_Cobro` (`Id_Cobro`);

--
-- Indices de la tabla `Jornada`
--
ALTER TABLE `Jornada`
 ADD PRIMARY KEY (`DNI`,`Hora_Entrada`,`Hora_Salida`);

--
-- Indices de la tabla `Lesion`
--
ALTER TABLE `Lesion`
 ADD PRIMARY KEY (`DNI`,`Id_Lesion`);

--
-- Indices de la tabla `Linea_Factura`
--
ALTER TABLE `Linea_Factura`
 ADD PRIMARY KEY (`Id_Factura`);

--
-- Indices de la tabla `Log_Lesion`
--
ALTER TABLE `Log_Lesion`
 ADD PRIMARY KEY (`DNI_T`,`DNI_A`,`Id_Lesion`), ADD KEY `DNI_A` (`DNI_A`);

--
-- Indices de la tabla `Masaje`
--
ALTER TABLE `Masaje`
 ADD PRIMARY KEY (`Id_Masaje`);

--
-- Indices de la tabla `Permisos`
--
ALTER TABLE `Permisos`
 ADD PRIMARY KEY (`Nombre_Grupo`,`Nombre_Controlador`,`Accion`), ADD KEY `Nombre_Controlador` (`Nombre_Controlador`);

--
-- Indices de la tabla `Reserva_Espacio`
--
ALTER TABLE `Reserva_Espacio`
 ADD PRIMARY KEY (`Id_Reserva`), ADD KEY `Id_Espacio` (`Id_Espacio`,`DNI_Alumno`,`ID_Trabajador`), ADD KEY `DNI_Alumno` (`DNI_Alumno`), ADD KEY `ID_Trabajador` (`ID_Trabajador`);

--
-- Indices de la tabla `Reserva_Evento`
--
ALTER TABLE `Reserva_Evento`
 ADD PRIMARY KEY (`Id_Evento`,`Id_Reserva`);

--
-- Indices de la tabla `Reserva_Masaje`
--
ALTER TABLE `Reserva_Masaje`
 ADD PRIMARY KEY (`Id_Masaje`,`Id_Reserva`,`DNI_A`,`DNI_T`), ADD KEY `Id_Masaje` (`Id_Masaje`), ADD KEY `DNI_A` (`DNI_A`), ADD KEY `DNI_T` (`DNI_T`);

--
-- Indices de la tabla `Servicio`
--
ALTER TABLE `Servicio`
 ADD PRIMARY KEY (`Id_Servicio`), ADD KEY `Id_Trabajador` (`Id_Trabajador`,`Id_Cliente`), ADD KEY `Id_Cliente` (`Id_Cliente`);

--
-- Indices de la tabla `Telefonos_Alumno`
--
ALTER TABLE `Telefonos_Alumno`
 ADD PRIMARY KEY (`DNI`,`Telefono`);

--
-- Indices de la tabla `Telefonos_Trabajador`
--
ALTER TABLE `Telefonos_Trabajador`
 ADD PRIMARY KEY (`DNI`,`Telefono`);

--
-- Indices de la tabla `Trabajador`
--
ALTER TABLE `Trabajador`
 ADD PRIMARY KEY (`DNI`), ADD KEY `Nombre_Grupo` (`Nombre_Grupo`);

--
-- Indices de la tabla `Trabajador_Evento`
--
ALTER TABLE `Trabajador_Evento`
 ADD PRIMARY KEY (`DNI`,`Id_Evento`), ADD KEY `Id_Evento` (`Id_Evento`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
 ADD PRIMARY KEY (`DNI`), ADD KEY `Nombre_Grupo` (`Nombre_Grupo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividad`
--
ALTER TABLE `Actividad`
ADD CONSTRAINT `Actividad_ibfk_3` FOREIGN KEY (`Id_Calendario`) REFERENCES `Calendario` (`Id_Calendario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Actividad_ibfk_1` FOREIGN KEY (`DNI_Trabajador`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Actividad_ibfk_2` FOREIGN KEY (`Id_Espacio`) REFERENCES `Espacio` (`Id_Espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
ADD CONSTRAINT `Asistencia_ibfk_2` FOREIGN KEY (`Id_Actividad`) REFERENCES `Actividad` (`Id_Actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Asistencia_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Cobro`
--
ALTER TABLE `Cobro`
ADD CONSTRAINT `Cobro_ibfk_1` FOREIGN KEY (`DNI_Alumno`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Documento`
--
ALTER TABLE `Documento`
ADD CONSTRAINT `Documento_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Horario`
--
ALTER TABLE `Horario`
ADD CONSTRAINT `Horario_ibfk_1` FOREIGN KEY (`Id_Calendario`) REFERENCES `Calendario` (`Id_Calendario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
ADD CONSTRAINT `Inscripcion_ibfk_3` FOREIGN KEY (`Id_Cobro`) REFERENCES `Cobro` (`Id_Cobro`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Inscripcion_ibfk_1` FOREIGN KEY (`DNI_A`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Inscripcion_ibfk_2` FOREIGN KEY (`Id_Actividad`) REFERENCES `Actividad` (`Id_Actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Jornada`
--
ALTER TABLE `Jornada`
ADD CONSTRAINT `Jornada_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Lesion`
--
ALTER TABLE `Lesion`
ADD CONSTRAINT `Lesion_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Log_Lesion`
--
ALTER TABLE `Log_Lesion`
ADD CONSTRAINT `Log_Lesion_ibfk_2` FOREIGN KEY (`DNI_A`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Log_Lesion_ibfk_1` FOREIGN KEY (`DNI_T`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Permisos`
--
ALTER TABLE `Permisos`
ADD CONSTRAINT `Permisos_ibfk_2` FOREIGN KEY (`Nombre_Controlador`) REFERENCES `Controlador` (`Nombre_Controlador`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Permisos_ibfk_1` FOREIGN KEY (`Nombre_Grupo`) REFERENCES `Grupo` (`Nombre_Grupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Reserva_Espacio`
--
ALTER TABLE `Reserva_Espacio`
ADD CONSTRAINT `Reserva_Espacio_ibfk_3` FOREIGN KEY (`ID_Trabajador`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Reserva_Espacio_ibfk_1` FOREIGN KEY (`Id_Espacio`) REFERENCES `Espacio` (`Id_Espacio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Reserva_Espacio_ibfk_2` FOREIGN KEY (`DNI_Alumno`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Reserva_Evento`
--
ALTER TABLE `Reserva_Evento`
ADD CONSTRAINT `Reserva_Evento_ibfk_1` FOREIGN KEY (`Id_Evento`) REFERENCES `Evento` (`Id_Evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Reserva_Masaje`
--
ALTER TABLE `Reserva_Masaje`
ADD CONSTRAINT `Reserva_Masaje_ibfk_1` FOREIGN KEY (`Id_Masaje`) REFERENCES `Masaje` (`Id_Masaje`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Reserva_Masaje_ibfk_2` FOREIGN KEY (`DNI_A`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Reserva_Masaje_ibfk_3` FOREIGN KEY (`DNI_T`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Servicio`
--
ALTER TABLE `Servicio`
ADD CONSTRAINT `Servicio_ibfk_2` FOREIGN KEY (`Id_Cliente`) REFERENCES `Cliente_Externo` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Servicio_ibfk_1` FOREIGN KEY (`Id_Trabajador`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Telefonos_Alumno`
--
ALTER TABLE `Telefonos_Alumno`
ADD CONSTRAINT `Telefonos_Alumno_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Telefonos_Trabajador`
--
ALTER TABLE `Telefonos_Trabajador`
ADD CONSTRAINT `Telefonos_Trabajador_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Trabajador_Evento`
--
ALTER TABLE `Trabajador_Evento`
ADD CONSTRAINT `Trabajador_Evento_ibfk_2` FOREIGN KEY (`Id_Evento`) REFERENCES `Evento` (`Id_Evento`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Trabajador_Evento_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
ADD CONSTRAINT `Usuario_ibfk_2` FOREIGN KEY (`Nombre_Grupo`) REFERENCES `Grupo` (`Nombre_Grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
