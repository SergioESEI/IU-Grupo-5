-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2016 a las 00:45:26
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

--
-- Base de datos: `MOOVETT`
--

DROP DATABASE IF EXISTS `MOOVETT`;
SET SQL_MODE=`NO_AUTO_VALUE_ON_ZERO`;
CREATE DATABASE `MOOVETT` DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci;
USE `MOOVETT`;
GRANT USAGE ON *.* TO 'moovett'@'localhost';
   DROP USER 'moovett'@'localhost';

CREATE USER 'moovett'@'localhost' IDENTIFIED BY  'moovett2016';

GRANT USAGE ON * . * TO  'moovett'@'localhost' IDENTIFIED BY  'moovett2016' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON  `MOOVETT` . * TO  'moovett'@'localhost' WITH GRANT OPTION ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `Id_Actividad` varchar(10) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `DNI_Trabajador` varchar(9) NOT NULL,
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

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`Id_Actividad`, `Nombre`, `DNI_Trabajador`, `Id_Espacio`, `Precio`, `Categoria`, `Capacidad_Max`, `Duracion`, `Fecha`, `Hora_Inicio`, `Hora_Fin`, `Id_Calendario`, `Borrado`) VALUES
('0123456789', 'Actividad 1', '22222222J', '9874563210', 10.5, 'Baile', 20, 'Mensual', '2016-12-17', '15:30:00', '16:30:00', '3210654987', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumno`
--

CREATE TABLE IF NOT EXISTS `Alumno` (
  `DNI` varchar(9) NOT NULL,
  `Apellidos` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Observaciones` varchar(500) NOT NULL,
  `Profesion` varchar(50) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Alumno`
--

INSERT INTO `Alumno` (`DNI`, `Apellidos`, `Nombre`, `Direccion`, `Email`, `Fecha_Nacimiento`, `Observaciones`, `Profesion`, `Borrado`) VALUES
('33333333P', 'ApellidoA ApellidoA', 'NombreA', 'Direccion alumno, calle alumno', 'alumno@hotmail.com', '2017-10-31', 'Observo que este tío tiene esta lesión', 'Contable', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE IF NOT EXISTS `Asistencia` (
  `DNI` varchar(9) NOT NULL,
  `Fecha_Asistencia` date NOT NULL,
  `Asistencia` tinyint(1) NOT NULL,
  `Id_Actividad` varchar(10) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Asistencia`
--

INSERT INTO `Asistencia` (`DNI`, `Fecha_Asistencia`, `Asistencia`, `Id_Actividad`, `Borrado`) VALUES
('33333333P', '2016-12-17', 1, '0123456789', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Caja`
--

CREATE TABLE IF NOT EXISTS `Caja` (
  `Id_Caja` mediumint(9) PRIMARY KEY AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Tipo` enum('Ingreso','Pago') NOT NULL,
  `Importe` float NOT NULL,
  `Comentario` varchar(300) DEFAULT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Caja`
--

INSERT INTO `Caja` (`Id_Caja`,`Fecha`, `Tipo`, `Importe`, `Borrado`) VALUES
(1,'2016-11-15', 'Ingreso', 50.5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calendario`
--

CREATE TABLE IF NOT EXISTS `Calendario` (
  `Id_Calendario` varchar(10) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Calendario`
--

INSERT INTO `Calendario` (`Id_Calendario`, `Fecha_Inicio`, `Fecha_Fin`, `Hora_Inicio`, `Hora_Fin`, `Borrado`) VALUES
('3210654987', '2016-10-31', '2016-12-31', '09:00:00', '20:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente_Externo`
--

CREATE TABLE IF NOT EXISTS `Cliente_Externo` (
  `Id_Cliente` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Tlf` int(9) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0',
  `Direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Cliente_Externo`
--

INSERT INTO `Cliente_Externo` (`Id_Cliente`, `Nombre`, `DNI`, `Tlf`, `Email`, `Borrado`, `Direccion`) VALUES
('34281271R', 'Iago Fernandez', '34281271R', 214748347, 'iago@gmail.com', 0, 'Progeso 24, 3C'),
('48484848K', 'Fulanito', '48484848K', 327673456, 'fulanito@gmail.com', 0, 'Progeso 24, 3A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cobro`
--

CREATE TABLE IF NOT EXISTS `Cobro` (
  `Id_Cobro` varchar(10) NOT NULL,
  `DNI_Alumno` varchar(9) NOT NULL,
  `Id_Actividad` varchar(10) NOT NULL,
  `Importe` float NOT NULL,
  `Fecha_Cobro` date NOT NULL,
  `Fecha_Confirmacion` date NOT NULL,
  `Tipo` enum('Efectivo','Domiciliacion','TPV') NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Cobro`
--

INSERT INTO `Cobro` (`Id_Cobro`, `DNI_Alumno`, `Id_Actividad`, `Importe`, `Fecha_Cobro`, `Fecha_Confirmacion`, `Tipo`, `Borrado`) VALUES
('1010101010', '33333333P', '0123456789', 18.9, '2016-12-17', '2016-12-17', 'Efectivo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Controlador`
--

CREATE TABLE IF NOT EXISTS `Controlador` (
  `Nombre_Controlador` varchar(30) NOT NULL,
  `Accion` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Controlador`
--

INSERT INTO `Controlador` (`Nombre_Controlador`, `Accion`, `Borrado`) VALUES
('Factura', 'Add', 0),
('Factura', 'Delete', 0),
('Factura', 'Edit', 0),
('Factura', 'List', 0),
('Factura', 'Show', 0),
('Linea_Factura', 'Add', 0),
('Linea_Factura', 'Delete', 0),
('Linea_Factura', 'Edit', 0),
('Linea_Factura', 'List', 0),
('Linea_Factura', 'Show', 0),
('Caja', 'Add', 0),
('Caja', 'Delete', 0),
('Caja', 'Edit', 0),
('Caja', 'List', 0),
('Caja', 'Show', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descuento`
--

CREATE TABLE IF NOT EXISTS `Descuento` (
  `Id_Descuento` varchar(20) NOT NULL,
  `Requisitos` varchar(150) NOT NULL,
  `Porcentaje` float NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Descuento`
--

INSERT INTO `Descuento` (`Id_Descuento`, `Requisitos`, `Porcentaje`, `Borrado`) VALUES
('8588588585', 'Los requitos son...', 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documento`
--

CREATE TABLE IF NOT EXISTS `Documento` (
  `DNI` varchar(9) NOT NULL,
  `Tipo_Documento` varchar(20) NOT NULL,
  `Fecha_Documento` date NOT NULL,
  `Doc` longblob NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Documento`
--

INSERT INTO `Documento` (`DNI`, `Tipo_Documento`, `Fecha_Documento`, `Doc`, `Borrado`) VALUES
('33333333P', 'SEPA', '2017-10-31', 'Documento.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espacio`
--

CREATE TABLE IF NOT EXISTS `Espacio` (
  `Id_Espacio` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Espacio`
--

INSERT INTO `Espacio` (`Id_Espacio`, `Nombre`, `Borrado`) VALUES
('9874563210', 'Aula 1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `Id_Evento` int(20) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`Id_Evento`, `Descripcion`, `Nombre`, `Borrado`) VALUES
(1, 'Esta es la descripción del evento del Magosto', 'Magosto', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

CREATE TABLE IF NOT EXISTS `Factura` (
  `Id_Factura` mediumint(9) PRIMARY KEY AUTO_INCREMENT,
  `Id_Cliente` varchar(10) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Fecha_Cobro` date DEFAULT NULL,
  `Total` float NOT NULL DEFAULT 0,
  `Pagada` enum('No','Efectivo','Domiciliacion','TPV') NOT NULL DEFAULT 'No',
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Factura`
--

INSERT INTO `Factura` (`Id_Factura`, `Id_Cliente`, `Fecha`, `Fecha_Cobro`, `Total`, `Pagada`, `Borrado`) VALUES
(1, '48484848K', NULL, NULL, 0, 'No', 0),
(2, '34281271R', '2016-11-25', '2016-11-29', 30, 'Efectivo', 0),
(3, '34281271R', '2016-11-29', NULL, 85, 'NO', 0);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE IF NOT EXISTS `Grupo` (
  `Nombre_Grupo` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`Nombre_Grupo`, `Borrado`) VALUES
('Admin', 0),
('Monitor', 0),
('Secretario', 0),
('Usuario', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horario`
--

CREATE TABLE IF NOT EXISTS `Horario` (
  `Id_Horario` varchar(10) NOT NULL,
  `Id_Calendario` varchar(10) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Horario`
--

INSERT INTO `Horario` (`Id_Horario`, `Id_Calendario`, `Hora_Inicio`, `Hora_Fin`, `Borrado`) VALUES
('1616161616', '3210654987', '09:00:00', '19:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inscripcion`
--

CREATE TABLE IF NOT EXISTS `Inscripcion` (
  `DNI_A` varchar(9) NOT NULL,
  `Id_Actividad` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Inscripcion`
--

INSERT INTO `Inscripcion` (`DNI_A`, `Id_Actividad`, `Fecha`, `Borrado`) VALUES
('33333333P', '0123456789', '2016-12-17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jornada`
--

CREATE TABLE IF NOT EXISTS `Jornada` (
  `DNI` varchar(9) NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Hora_Salida` time NOT NULL,
  `Observaciones` varchar(50) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Jornada`
--

INSERT INTO `Jornada` (`DNI`, `Hora_Entrada`, `Hora_Salida`, `Observaciones`, `Borrado`) VALUES
('22222222J', '08:55:00', '17:03:00', 'Observaciones', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lesion`
--

CREATE TABLE IF NOT EXISTS `Lesion` (
  `DNI` varchar(9) NOT NULL,
  `Id_Lesion` varchar(9) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Curada` tinyint(1) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Lesion`
--

INSERT INTO `Lesion` (`DNI`, `Id_Lesion`, `Tipo`, `Curada`, `Descripcion`, `Borrado`) VALUES
('33333333P', '252525252', 'Lesion cervical', 0, 'La lesion se encuentra en...', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Linea_Factura`
--

CREATE TABLE IF NOT EXISTS `Linea_Factura` (
`Id_Linea_Factura` mediumint(9) PRIMARY KEY AUTO_INCREMENT,
  `Id_Factura` mediumint(9) NOT NULL,
  `Id_Servicio` varchar(10) NOT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Importe` float NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Linea_Factura`
--

INSERT INTO `Linea_Factura` (`Id_Linea_Factura`, `Id_Factura`, `Id_Servicio`, `Descripcion`, `Importe`, `Borrado`) VALUES
(1, 1, '963852741', 'La descripcion de la linea', 100.99, 0),
(2, 2, '963852741', 'La descripcion de la linea', 30, 0),
(3, 3, '963852741', 'La descripcion', 45, 0),
(4, 3, '963852742', '', 40, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log_Lesion`
--

CREATE TABLE IF NOT EXISTS `Log_Lesion` (
  `DNI_T` varchar(9) NOT NULL,
  `DNI_A` varchar(9) NOT NULL,
  `Id_Lesion` varchar(9) NOT NULL,
  `Fecha_Log` date NOT NULL,
  `Hora_Log` time NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Log_Lesion`
--

INSERT INTO `Log_Lesion` (`DNI_T`, `DNI_A`, `Id_Lesion`, `Fecha_Log`, `Hora_Log`, `Borrado`) VALUES
('22222222J', '33333333P', '252525252', '2017-10-31', '15:05:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Masaje`
--

CREATE TABLE IF NOT EXISTS `Masaje` (
  `Id_Masaje` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Masaje`
--

INSERT INTO `Masaje` (`Id_Masaje`, `Nombre`, `Borrado`) VALUES
('2424242424', 'Exfoliante', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `Nombre_Grupo` varchar(30) NOT NULL,
  `Nombre_Controlador` varchar(30) NOT NULL,
  `Accion` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Permisos`
--

INSERT INTO `Permisos` (`Nombre_Grupo`, `Nombre_Controlador`, `Accion`, `Borrado`) VALUES
('Secretario','Factura', 'Add', 0),
('Secretario','Factura', 'Delete', 0),
('Secretario','Factura', 'Edit', 0),
('Secretario','Factura', 'List', 0),
('Secretario','Factura', 'Show', 0),
('Secretario','Linea_Factura', 'Add', 0),
('Secretario','Linea_Factura', 'Delete', 0),
('Secretario','Linea_Factura', 'Edit', 0),
('Secretario','Linea_Factura', 'List', 0),
('Secretario','Linea_Factura', 'Show', 0),
('Secretario','Caja', 'Add', 0),
('Secretario','Caja', 'Delete', 0),
('Secretario','Caja', 'Edit', 0),
('Secretario','Caja', 'List', 0),
('Secretario','Caja', 'Show', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Espacio`
--

CREATE TABLE IF NOT EXISTS `Reserva_Espacio` (
  `Id_Reserva` varchar(10) NOT NULL,
  `Id_Espacio` varchar(10) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Fecha` date NOT NULL,
  `Descripción` varchar(50) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0',
  `DNI_Reserva` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Reserva_Espacio`
--

INSERT INTO `Reserva_Espacio` (`Id_Reserva`, `Id_Espacio`, `Hora_Inicio`, `Hora_Fin`, `Fecha`, `Descripción`, `Borrado`, `DNI_Reserva`) VALUES
('3232323232', '9874563210', '12:00:00', '13:00:00', '2017-02-15', 'Descripcion reserva', 0, '22222222J');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Evento`
--

CREATE TABLE IF NOT EXISTS `Reserva_Evento` (
  `Id_Evento` int(20) NOT NULL,
  `Id_Reserva` int(20) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Reserva_Evento`
--

INSERT INTO `Reserva_Evento` (`Id_Evento`, `Id_Reserva`, `Borrado`) VALUES
(1, 2147483647, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Masaje`
--

CREATE TABLE IF NOT EXISTS `Reserva_Masaje` (
  `Id_Masaje` varchar(10) NOT NULL,
  `Id_Reserva` varchar(10) NOT NULL,
  `DNI_Alumno` varchar(9) NOT NULL,
  `DNI_Trabajador` varchar(9) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Fecha` date NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Reserva_Masaje`
--

INSERT INTO `Reserva_Masaje` (`Id_Masaje`, `Id_Reserva`, `DNI_Alumno`, `DNI_Trabajador`, `Tipo`, `Hora_Inicio`, `Hora_Fin`, `Fecha`, `Borrado`) VALUES
('2424242424', '5656565656', '33333333P', '22222222J', 'Exfoliante', '16:00:00', '17:00:00', '2016-11-23', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicio`
--

CREATE TABLE IF NOT EXISTS `Servicio` (
  `Id_Servicio` varchar(10) NOT NULL,
  `Id_Trabajador` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` float NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Servicio`
--

INSERT INTO `Servicio` (`Id_Servicio`, `Id_Trabajador`, `Nombre`, `Precio`, `Descripcion`, `Borrado`) VALUES
('963852741', '22222222J', 'Cena de empresa', 30, 'PreparaciÃ³n de cena para 50 personas', 0),
('963852742', '22222222J', 'Actividad externa', 40, 'Act externas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Alumno`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Alumno` (
  `DNI` varchar(9) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Telefonos_Alumno`
--

INSERT INTO `Telefonos_Alumno` (`DNI`, `Telefono`, `Borrado`) VALUES
('33333333P', 777777777, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Trabajador`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Trabajador` (
  `DNI` varchar(9) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Telefonos_Trabajador`
--

INSERT INTO `Telefonos_Trabajador` (`DNI`, `Telefono`, `Borrado`) VALUES
('11111111H', 666666666, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador`
--

CREATE TABLE IF NOT EXISTS `Trabajador` (
  `DNI` varchar(9) NOT NULL,
  `Apellidos` varchar(70) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Foto` longblob NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Observaciones` varchar(500) NOT NULL,
  `Numero_Cuenta` int(20) NOT NULL,
  `Horas_Extra` varchar(200) NOT NULL,
  `Tipo_Empleado` enum('administrador','secretario','monitor','fisioterapeuta','cafeteria','limpieza','otros') NOT NULL,
  `Externo` tinyint(1) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Trabajador`
--

INSERT INTO `Trabajador` (`DNI`, `Apellidos`, `Nombre`, `Foto`, `Direccion`, `Email`, `Fecha_Nacimiento`, `Observaciones`, `Numero_Cuenta`, `Horas_Extra`, `Tipo_Empleado`, `Externo`, `Borrado`) VALUES
('11111111H', 'ApellidoTr ApellidoTr', 'NombreTr', 0xffd8ffe000104a46494600010101006000600000ffe100224578696600004d4d002a00000008000101120003000000010001000000000000fffe003c43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763632292c207175616c697479203d2039300a00ffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc00011080050005003012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fdf655c71fd69c11987ff5e841f39fc69c12801bb1bfc9aabae6b367e18d22e750d4af6d74fd3ece332dc5cdcce2186041c9677620281ea4e2ae6dafc4ff00f8285fedd5ae7eda9f1a2eb46d1eeaea4f00e957c6d341d32d3732ea922b6c178e83996490e4c608f9119400199cb7ca71771551c8f08ab4e3cd393b463b5df56df44baefba5d4f6b23c96a6635bd9c5f2c56adf6ff82cfd1ef1affc15abe01f826fe5b56f1c8d5a785b6b7f6569f757911f759923f2987bab9a9be1f7fc1573e03fc44d562b187c750e937531daa358b3b8d3e2fc6695044bf8b8afca7f895fb14f8f3e13fc27b7f176b1636f1dab381776714be65ce9a8d80924c00da016383b49da4ae71938f25ea6bf1fa9e2de754eafef28d34bb5a57b7af36ff2f91f76b81f00e168ce57ef75f958fe8e2da55bdb68e686449a19543a3a3ee5753c820f420f5c8a936367ff00af5f93ff00f047ff00dba754f85df14f4bf85be22d425baf07789a6fb2e902772dfd8d7cc498d23279114cdf218c70247461b77485bf58f68afd9f85f89686778258ba2b95a76945ef17faa7ba7d7d6e8f80ce329ab97e23d8d4775ba7dd7f9f7433cb6c753f9d1b1bd7f5a76d14a5457d21e48c4ff587f1a907151a70e7f1a767de803ce7f6c7f13dd7827f645f8a5ac58c8d05f697e12d56eada45eb1c89672b237e0c01afcdaff8257feccf69a278162f88fab5b2cdaa6a9be1d1448b9fb1db2931b4abe8f230600f50838e1cd7ea7fc50f87d63f173e1a788bc29aa34c34bf13e9973a4ddf92db64f26789a27da7b36d7383eb5f2c7c35f03dbfc36f85be15d06d5fcdb7d2747b6b359366cf37cb4085f6e4e0b6338c9ebdebf22f12b07296230f5e5f0a524bd6ebfcd1fa0705d58aa7569f5bafbacffc99bb6fa55beb51cd6b75043756b751b433432a078e6460432b29e0a904820f0457ce3f143fe08e5e1ff146a125ef83fc4d79e198a4258d85e5b7dbede3cf68df7a48abecc5cfbd7d35e1d19bafc457a168b0ab59b67d2be4f2fc9f0d8e872e2237fc1fdeb53e8730c755c3cb9a9bb1f963fb5dfec3d75fb167823c33e32d1fc4175acde58dfa8bd9dadc4096d70a7cdb7922504955cc654ee627705208ce07ed3a9ca83fcfb57cdbf15fe12e95f1c34e83c2bad46b3697ab5fda0b84db92c91dc472903d0908467b6735f48e7debefbc3dca160aa62a54b4a7270495f67152befe4d1f21c598cf6d1a3197c4949b7e4ed6fc98ea3a5373ef467dc57e967c68d8fef9fc6a4a8d07cff9d4839a004cd7cb4f6ed6ba4dac0c312593496927b346e508fcd4d7d4d5f3d7c5af0adcf817c49a94979098b47d4af9ae6d2f81cc28f2905a394ffcb3632b385ddf2b6e500963b47c0f881839d5c242b415f95bbf9276777e5eeefe67d7708e2610c44a9c9db9ad6f36aeadeba989a34be55d7eb5db699a9ecb5c7b57011b35bce33c153835b967aae2202bf34cab19ecae8fb6c7e1fda599d0786e4fb6fc4df0fc7fdebb66cffbb04aff00fb2d7b6d78afc03d39fc6be2e5d7a031c9a4696258639c383e7dc1014ec1fdd542f963804b0c64648f6aafd7783a9cd605d59ab73c9b5e6ac927f81f9df12548bc52845fc2927eb76ff50a28a2beb0f9f234e1cfe34f1d3ffad5f3ff00fc14b7f6edd27fe09d7fb256bdf112fede1d4b56f3134af0ee94f2796356d527dc20889ea2350af34acb96586099943150a7f9c0f8f9fb6478ebf6afd76fb51f8a1e35d7fc7126a5299a6b0bfbd94e8b01381b6df4dde6d60400000247b8800bbc8e59d803fa4ef8cdff000530fd9fff0067fbebab1f15fc60f00586af66712e9106af15eeac0fb59405ee1ba768cd791e8fff00052ff861fb785fde785be1d5f6b3a85ae8cd16a17f36a7a35c696b7d18dc152286e9239d82c9b1999a3551b5473bb8fe77f4cf8836fa258adad9241676b1f0b0c08238d7e8ab802ba4f863fb506bdf06bc75a7f897c35aacda5eb3a63ef867420820f0c8ea786461c153c115e5e7582ab8bc0d4c351972ca4ad7fd1f935a3f53bb2dc5430f8a857a8aea2ef6fd7e5b9fd052e853e99c69b742187b5b4e866853fdce4327d012a3b28a98f876f752b2f3752b859acb76cf2218fca8643e8f925a4f7190a7ba9afceff847ff00070d78765d1a187c79e07d560d4a35024bad0268a68273fde114cc8d1e7d37bfd69bf18bfe0e26d225d08da780fc13a94974aa561b9d7ee238e1b727f8bc98598bfd0c8b5f8b4783f35f68e9ba2efdeeadf7ded63f4d9712603914d545f73bfdd6bdcfbea5ff008298fc25fd87fc6175e13f891ad6b3a3dc6bc5358b39acfc3f7faac09194480a3fd92295a33ba12c37a85c1273d71ecdf08ffe0a45f007e3bdfdbd8f84fe327c37d5f56bafb9a5aebf6d0ea5f46b49196753ecc80d7f345f143f6a2d7be33f8ef50f12f89b549353d63527df34cf85000e1511470a8a380a3803f1ae6b54f8816fadd9b5bdf4705e5bbfde8ae11658dbeaad915fb4e4b819e0f034f0d51ddc559b5b7cbd363f32ccb151c4e2a75e0aca4ffaff0033faeecd26715fca97ec99fb76f8dbf615f1fe9be22f85fac4ba2c5a7cc925d78712e1a1d0b5d841f9edae6d57f7437aee559d53cd88b6e53f795ffa6efd96ff00691f0dfed7dfb3cf847e2678426925f0ff008cb4e8efed9260a27b5639596de655242cd0caaf148a09db246eb938af50e13f123fe0efbfdac98fed17f097e12db5c32daf86344b8f16dfc4b26e492e6f656b5b62c3b491456b758cf3b6f3d0d7e407fc2d1ffa69fad7eda7fc1c51ff0006ea7c57fdb2ff00690d43e3c7c0dd417c5daff88e0b4b3d73c1fa9ea1059c9035bc31db452d84f33470888c681a4865752ae247567f37cb4fcd1ff88647f6f6ff00a21fff00979f87ff00f93e803e79ff0085a3ff004d3f5a3fe1697fd34fd6be86ff008864bf6f6ffa21ff00f979f87fff0093e8ff0088647f6f6ffa21ff00f979f87fff0093e803e783f143fe9a7eb47fc2d0ff00a69fad7d0fff0010c8fededff4443ff2f3f0ff00ff0027d1ff0010c8fededff4443ff2f3f0ff00ff0027d007cf1ff0b47fe9a7eb487e28e3fe5a7eb5f447fc4323fb7b7fd110ff00cbcfc3ff00fc9f47fc4323fb7b7fd110ff00cbcfc3ff00fc9f401f3bff00c2d2ff00a69fad7ee67fc1a0bfb70af8d3c29f13be03ea578af71a04cbe33f0f44cec585a5c32c37f120e8b1c773e44bc725f5090d7e5dff00c4323fb7b7fd110ffcbcfc3fff00c9f5fa6fff0006e7ff00c1bbff0017ff00625fda2ed7e3a7c6ad68f8375ad26caef4ed33c19a4dfc178f7ab711b45236a33c45e13128db22430bb1322c4ece9e518e400fffd9, 'Direccion 1, calle 1', 'email1@gmail.com', '1990-12-25', 'Observo que este trabajador se esfuerza', 2147483647, '+1 hora extra X dia', 'secretario', 0, 0),
('12345678Z', 'ApellidoTr3 Apellido2Tr3', 'NobreTr3', 0xffd8ffe000104a46494600010101006000600000ffe100224578696600004d4d002a00000008000101120003000000010001000000000000ffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc00011080050005003012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fdf355dbd2976b7f9342fdff00c6a455ddde802360c07d2be2bfdbcffe0ae9a67ece3e27bcf07f816c6c7c51e2eb1263bfbab9763a6e93277888421a695780c8acaa84e0bee0c83d6bfe0a59fb52cdfb257eca7ad6bda7ccb0f88b5591345d0d88cecba983664f4cc5124b28cf04c601eb5f87705e35dbb49248f2cb231677762cd231e4924f2493c927a935f92f895c6b5f2c51c0e01daa495dcbf956cade6f7bbd97ae9f67c2bc3f4f197c4627582d12eefcfc91f496bdff000569fda035bd464b88fc7834d8d9895b7b3d1ec5628c7a0df13363eac4fbd751f0bffe0b51f1a7c137b1ff006e4fe1ff001a59ee1e6457fa7a5a4c57b8496dc20527d591fe95f24bb88d0b31daaa3249ed5ec1e26fd867e227867e0de9be386d256ef4cbeb5fb65c5ac04b5ee9d09e564962c67694c39da49507e60b835f8ae1b89b3f7375a8e22a371d5fbcdaf9a6dafc0fbfab93e59caa13a3157f24bf1dcfd61fd8bffe0a0de09fdb3f4a920d29a6d13c55631096f741bd914ce8bc032c2c389a20481b800465772a6e5cfbcaa37fbd9e9ed5fceefc3cf887ad7c2af1ae97e26f0dea13699ae68f3add595d47d5187623a32b025594f0cacc0e4122bf773f644fda32c7f6aef801e1ff001a59471dac9a8c262beb456ddf61bb8c949a2f5c0704a93c94646ef5fbc787bc712ce612c2e2ecab415f4d14968af6e8d37aadb54d765f9bf12f0fac04956a1fc3969e8fb7a763d1b631f6c52956229fd3f3a3001fbd9afd30f95235fbff004a902e413bb6d469cbd499f90fd6803f2a7fe0e16f8a726a1f16fe1d78261793cbd2349bad76e114f1234f27931923d516da6fc2435f01f87564d6351b6b2b38deeaf2ea558218631b9e576215540ee492057d31ff00057bf182eb5ff0535f1a4774cb35af87f4bd3f4d55c9c61ace39997ff2624e9eb5f790f839e0fd36f74b7b3f0b787ede3d1658eeb4c30d8c719b36d9f2b4642e46031fe7d6bf9838ba8cb1f9ce2a6de91928fdcadfa1fb264105432fa296ed37f7bbfea7c37ff04f8fd90a6f8cff0019eeaffc416aade1df045e18eed1b0d1dfdf46d85b7f4655237bf5180a0fdfafd3cb8d3596db7639eb5c7fc15f01e97f0dfc3d1e97a55badbdbf9f2dcc98eb34b2c8d248ec7bb33313ec303a015e957b101a7ab77c74af6b86f27a54308edbeedff5d0e2cd319275d23f2d7fe0a61fb3059fc1af1fd9f8a341b54b3d0bc512c8b3dbc6bb62b4bc0371d83b2c8b960a38051f180401eddff040df8bf25a78b3c79f0fe7958dbde5bc5e21b24cfca9246cb6f7071eacaf6df8475d37fc1523478751fd963589994799a7df59dc447fbade72c67ff1d9187e35f2effc124bc5e7c23fb7d78257cc31c3ac25ee9b2ffb41ed65751ff7f238ebe7b26a8b2de29a13a7a465249fa4bdd7f99d99a53face51514b74aebd56a7ed728f95be94638cfbd20e7f334b8e3db3d2bfa98fc70629dd337d2bcf3f68efdabfe1ffec9de0c9f5ef1ef89f4bd06da38cc90dbcb329bcbf23f82de007cc99cf4c2838e49c0048dff008abf093c3ff1b7c1579e1cf14581d4349be189635b896da453d03472c4cb246c39c3232b0c9e79afe70bf6bff0e786fe0f7ed15e34f09ffc207e20f0ff00887c37aa4da7dc2ea5e2b7d4eddd15b314a8ad6b15c18e488a4885e76255d4e4835f3dc439c55cbe8aa94e29df44db7a3f44b5fbd1ea65797c31553964dab764b6fbff00426fda5ff686bcfda4fe3ff8e3c7b2db49a7b78b7519af23b5670ef6b0e02431161c3324491a923824123835fb41e02d757c59f0dbc31aac6432ea7a359dc820f5df021afc0eb0bddedb9bf8bd3031f974fc2bf547fe097dfb6be8bf163e1668bf0e755923d3bc59e16b316b662493e4d5ad907cac84ff00cb45500327a0c8e338fc12b393ab39cf793bb7ddff004cfd530dcb05182d9688fb43c2d702323fd935d44fa8ff00a1e09e82b83d36ebecd2f27e5ec2abf8bbe38784fc0d73f65d73c51e1dd16ebcaf3bc8bed4a1b794a76608ec188383c8073835ebe031ca9d1716ce6c660dceaf323c37fe0aade274d37f6699ad37287d6355b6b751ddb69329ff00d17fad7c67fb0b5eb69dfb687c2b96366563e27b188e3ae1e5087f4635da7fc144bf6b6d3be3b78bec7c3fa1fefb48f0eccf2fdb04a196fa67451b940c8daab900f5249e95cfff00c1383c25378d3f6e6f8636b1a9260d656fdf1fc2b6f149704ffe42af87f6cf139ed074ff009e097fe048f56b53f6597d4e6fe597e4cfdd25e0d38ffab5fad110233f4a76edabf357f5e9f8590a70ff00cabe3fff0082b97c11d0b56f8543c79ff0ce9e1ff8edae6890b4170bf6e974fd5acad704ac886089a6ba851c92d02b8203165072d8fa43e3ff00c7ef09fecb7f073c43f103c75ac5be87e15f0b5a1bbbfbc9416dabb822222282d24b248c91c71a02d23ba2282cc057e23fed3fff00073afc60f8abac5fdafc31d2fc3ff0afc34f230b3babbb38f58f116c04ec91da466b2859860b4420b80a781337de3cf8ac3c6bd274e5d7c93fcd35f81a51aae9cd4d74f36bf23e25b4d4c0492691e38d2324c87ee247cf3d49da07a13c57baff00c131353d2fe29fedc5e04d2eceea1d41619ae6fa431ab496ec90dbc8cebe681e596e47cbbb760938c026be6df8a5f17ae3e39fc48bdf18f8e2fe6f1878ab527125cea7ab049a49580c061180218c81ff003ca34038e2bd57f603f8e2be16fdbcfe0bdf34f856f14c3a4e338046a10cda681f4dd78a71fec8afce719c0718e1ead59546e49369256d52babeff00858fb0c3f14375a1050b26d27777ea7ee8c7a6ea360365bdf45343d156f2269648c7fbe1816ff810cfab1aa1e2af83ba4fc4ad1d7fe12ed2f4df14db46e4431dfd9a3dbdbb11cf948d9dac7fbd92dfed638ae897a572ff001efe33dbfc00f817e2cf1c6a589ac3c11a2de6b26066dab39821694440fac8ca107bb0afcb2953551fb35ab7a25e6de87df5493a6b9fb6afd0fca3fdac3e247c39f0efed63e34f0e787357d1f4fb5d23537d356d1cb5aaa5c400457114466c09364c92212858655b9e2bf417fe0861fb2b5e2ea9aa7c5ed62ce4b7b37b77d23c3a654ff8f9dcc3ed37299fe11b562561d49987619fc38b4f89335c68eb0ead73fda57571996fe5946e17970e4bcd2b03c12f233b1f7635db7c11fdb5fe217eccb346df0dfe2278c7c0b1c2dbe3b3d2b5271a6ab7f78d84bbec9cff00bf0357eaf94f86782c0e650cc7da3972eaa2d2b7377bf65ba56deda9f9d661c5d88c561a587714b9baeb7b76f99fd5d2305eff00a52b36ff00bbcd7e147ec7bff073c7c44f873e2ed3f4ff008d967a3f8efc1723ac379ade95a6fd835fd3559866e5a2849b7bc441d618a181f6e4a9918089ff00713c17e33d2be21783b49f10683a859eb1a2ebd6716a3a75f5a4a2582f6da641245346e38647465604704106bf4a3e48fc3bff0083be3f6d89b4cf1bfc2df817a7dd797676d6ade3ad76353feba56796d34e427d1025f4850e7e6681b00aa9afc5ff00f859dff4d2bf6ebfe0e29ff83773e2afeda1fb445efc76f81fa97fc25de21d76d6d2cb5af07ea7a8c366f07d9e24823974f9a6290888c69b9e195d487f31d59ccbb13f337fe2196fdbd3fe887bff00e163e1ff00fe4ea00f9dcfc4fcff00cb5ab1a3fc79baf01eb9a76bd63315bef0fdedbead6a54e089ada549e33ff7dc6b5f407fc432dfb7a7fd10f7ff00c2c7c3ff00fc9d48ff00f06c9fede4e855be07c9b48c1ff8ac7c3fff00c9d49c53567b0e3269dd6e7f483a76b369e23d3adf52d3e459b4fd4224bab5917a4b148a1d187d5483f8d7c07ff071e7ed189f073f613b1f0ac37421d43e257882dac0c60e19acad08bd9dbd76f9915ac67da7c77afaf7f630f84bf15be1efec7ff0bfc3fe36f877e20b2f17f877c2da7e91ab5bc5776172ab3db5ba40c44a97251f77961b2ac7ef7ad7e76ffc17cbfe0963fb5f7fc142ff00685f05cdf0d7e0fea7a8781fc1ba0b5bc32de788745b191efee2767b9611cb7a1b6f971daa6481931b75afc6387786f131cda2ebd36a106ddda693b6d67d6eedf23f49ce33aa12cb9aa534e5249593d75dff000b9f911ff0b3bfe9a0a3fe167ffd3415f447fc432dfb7a7fd10f7ffc2c7c3fff00c9d41ff83653f6f427fe487c9ff858f87fff0093abf683f353e773f1400ff968bf9d7ef67fc1a45ff05035f8b7f04fc61f00f58bef3356f876e75ff0e2bb659f48ba9489e1518cedb7bc62724f0b7d120e12bf264ffc1b25fb799ff9a1f27fe165e1ff00fe4eafd3cff83747fe0de3f8bdfb0ffed096ff001cbe336bd278375cd36c6eb4dd3fc17a45fc378d7a97086373a8cf11784c430b22430bb132244ece9e598dc03fffd9, 'Direccion , calle', 'email@gmail.com', '1988-05-07', 'Observaciones', 2147483647, '+1 hora extra X dia', 'limpieza', 0, 0),
('22222222J', 'ApellidoTr2 Apellido2Tr', 'Nombre2Tr', 0xffd8ffe000104a46494600010101006000600000ffe100924578696600004d4d002a000000080005013e0005000000020000004a013f0005000000060000005a511000010000000101000000511100040000000100000b13511200040000000100000b130000000000007a25000186a000008083000186a00000f9ff000186a0000080e8000186a000005208000186a000011558000186a000003a97000186a00000176f000186a0ffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc00011080050005003012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fdfca28a2800afc83ff838affe0ad3f133f67bf8f9e0ff00803f0975c6f075eeb5a22f88bc4be21b601afd209a69a0b7b4b77eb093f67964775c4841876ba00e1ff5f2bf9f5ff82cafec69f123f6a4ff008384ef7c27e168f4f82ebc41e06d335eb4bfbe93f7363a6c3e65acaf8c1f9bed29228183f7b38e722675a9d28ba955da2b5654294ea4953a6aed9f9aede30f167c5ef8af2c9e2ef1e78e3c517c6e096bad5b5c9efa72dbbef6e9998e7dce6bedaf0378bbe2afc08f837a8788bc21f1abc71a07f665bfda361bd9422ede79f2e48e3603d244753dc1ac5f8bbff041dfdac3f65df1243aa69fa1e9ff0013fc3970dbc49a44eb33459e7e7b793050f6dc809f715ec5f0d3fe09aff1f3f681f0549e1fd53c02be0fb5962f9af35a90a5bda91cee484caed249c7cb841ce3e65eb59cb36c128f34aa25a5f5dfeedff035a796e29caca0df9f4fbf6fc4fb23fe08f5ff00071558fedbbe3af09fc24f885e15bcd17e21df6971c6be20b4b88e5d375bbb8e1cc8d245b636b392628cc91a8913276ef53b41fd48afe6ff00f61afd823c7ffb26ff00c156be14f81ef859ead797de24d3b58b0d434f0fe50d2ed59ae6e5db700d18d96f22302705801c965cff004815a53ad4ab538d6a2ef192ba665528d4a3374ab2b4968d05145154485145140057c73fb4d7c28b3d27fe0a3de17f8a170db2fadfc0f79e18882c3f2bc125edb5c296933f79648e60171d24ce7d7ec6af3afda63e142fc4df87b3496d6a27d6b4906e6c703e77e312463d4ba6e001e376c3dabc1e24c3e22b65f523857efad6ddedab5f35b79d8f6321af4296360f10bdd7a5fb5f67f2ebe5739ebff88311f0542dbc6eda3bd72bff000b0e31fc75e63e12f115e6bde1410b48d235bb9889f5c60a9ffbe4af35620d26e269555a4f293abbb9dab1a8e5989ec00c927d057e378ae22c45671705d123f50a391d1a5cca4fab6745f0c3e0f59ea1ff000500f0df8fad38bfd37c157ba2dcc4600c86dae6ea39d640f9f95d65b75518072b338e3bfd695c2fc10f0047e1cd266d5ae2d8c3a96b0173bc112416ebc45160fdde32ec3190d21073b457755fb470fe1eb51c14635deaf5b764f65fabf36cfcb73aaf4aae2e52a4b45a5fbb5bbfd3d10514515ed1e4851457ca7ff0518ff82b97c3cff82726a3a3e8baf58eafe20f156bf6c6eecf4db031c71c31ee288f712bb7eed1d9245528b23131b6540e6aa30727689152a460b9a5b1f56562fc40f883a4fc33f0e36a7ac5e41676e654b78bcc6c19e69182c7128e4b3331000009fc01afc5bf8e1ff0721fc56f1cc93c1e0fd2fc35e04b3247972470ff0069df203eb24c3ca3ff007e05788786ff006fdf1878e2e23f1878cbc5fe22f155d69624bb54d4af1e44b5bb4ff58228b3e544a0a8082255053693f3b38aeea797ce5f13b1e756cd211d209bfc8fb07c53f12be23ffc1387e33db7836e349d37c69a36b0f3cfa70b866b7fb5c26562b2dbcb9230bbc2bc2c498c90380559bdfe2d03c5dfb567850e97ab5b69be134d7acd91b4bb293ce6581be57b8ba973f2c201c089483236149c1da3ca3fe0a73fb687c31f0bfeccb71e1ef19693ae78b7c47a8ca6ebc236ba0948b50d3aeb6b982ffed52031dac442b0cb87332f98ab14aab26c87fe097dff00050ff06fc5ff0080b1f83b4fb3f10683f1434a8a297c516bae3a4d71ab48411f6ab6b88c08e5b750182c41637842b6632b999ff2bff55f0eb30787e75c92f7b96fef2eeadd7d7f5d4fd73fb4b1b3ca7fb515197bad45cedee5fa3bf47b2b77d3c8fd2cf873f1034ff88fe1cfb6585e5add496b33d95f240fbbec97511db2c2c3a8656ec7a8208c8209deafe767e2cfeddde21f0ef8935cf1b782f5dd7f45d42f8dc4de768f7725bc92c8f33b5b990a7063596442fbc14d85f20e715ec1f017fe0e38f8b5f0e8dbdbf8c2cfc3fe3fb15e647b887fb3ef980e30b3403cb1f56858fbd7ea9532f9249c5dcfc8e9e6906da9a6b5b1fb8d457c99ff0004f9ff0082c1fc38ff008281f8aef3c2da4d8eade1bf1969f623509b4dbf68e48ae230c15fc8991bf79b372921911b0d90a40623eb3ae19c2517691e8d3a919ae68bd02bf945ff0082bffed577dfb497edbdf153c4135c3b416faf5c5869c33c4569652fd9a0c0e8b98e10e40fe2773d4935fd2efededfb4edafec6bfb1cfc44f89770d1897c2fa3cb358a4832b3df49886d223ecf7124287d0366bf8f7f14eb12eaab792cd2c93cb32c8d248e72d231392c4fa93cd75e122ece470e3a5ac61f3febf13b387e22c97d625848cad2227cc3f84fad7a83fc428fc41f0b62bcb70908f23ecf2c09f76ddd06d68c0fee83d33d5483debe6bf0eea9bec76eee816babf03f8bdb4ababbd3e47ff44d586dc13c24c07ca7fe043e53efb6bbe151a5ea79752945b5e4cfd4df1d7ed13a5dff00fc12a3e17d8f87e1824f1f7c4ed56c7cebf9221797569269f0ac5713a89376e60b0476caa410ab380060003d9bf62af8a3a6fc25ff008278fed027c7d69a6dc78e7e1cacde2a4d404096f73790cd62ff006125a30a03a4d14f08d981c7192cccdf9cbff04dff008a96ed75716bae7fa52fc3c86ece8d6edc8537f2c6ce40f5dd111c73f3638c9ad0fdbcbe3a6bde05d2bc41a34976f1dd7c54d3ad74fd4ad90ffc7b4369789731abe38dc46f52bfc224c7ae3f1e966bcdc66b06a0bdd872b9595d5d732d77f92e976ecadcdfd3787e1b6fc2d9e67ccd7ef39f7766d4d53692bdac96adb56e6b2d5ede79e18f8943c21f0c3fb4ee36ccd630858e36e97321f95633ecec707b609cf15e6569e3c96c74c8d6495a4686dcab31fe23c7358be33f1635f3e9fa5c6dfe8ba58f324c1ff593b2ff00ec8a71f563e95cceb3aa14b12bbbef257ec32a8da4bb1fccb0a6936fb9f537fc12b7f6aeb8fd9dff006def877e3492e8dbdbc3e27b68afdc9e0594edf65b9f6e2de5931ef835fd6657f123e15d43ecf650fcd8dcfc906bfaf8ff0082657ed33ff0d7ff00b05fc2ff008812dc1b9d4b58d1228355909e5b50b626daecfe33c3211ec4570e2a2eca47a5819252943e7fd7e07e7eff00c1cfd1fc65f1c7c30d13c3da2f87f56d43e1a5bde0d47537d2a0334ad3223089a455f99a34dccdb477dad82556bf02f55d067922b88add92e245055a3538953fde438653ec4035fdb35fe9d6faadb343750c5710b8c3248a194fe06bc3be2f7fc1323e01fc779e49bc55f0afc1faacf27de964d3e3127fdf4066b3a38ae48f2b5a1ad7c1fb4973a7667f1d9a65adce9b2f97343247eccb8ad095bcd52b92b939ce79071d6bfa62f8ebff0006c57ecdff00146d656f0ed8eb9e03bc604a3e937cde4a9f789f721fcabe29f8d9ff0006947c40d167964f03f8ff00c33e22b50498e2d5ad1ecae08f432444a7fe4315d54f154f691c95b0756f78ea7e64fec59f1761f86bf1ee3bebd961b68f54b29ad259e442c2d66003a4aaa3abfca42e7bc8391d451fdab3e35b7c53f8a51cf0c6d1e9fa2c461b389db733c8e7733b9fe276c264fa280000001f6178a3fe0d89fda9f4cd455f4df0ef85a468d81df1ebc195b1c82331a9159f61ff0006d27ed5f79ab492ea1e0fd0a47918b6e5d7234404f53f749fa715f312c830d2cf566ee5b42c97696dcdeae3eeebb25a6ecfd129f1c6323c192e16e57ad553bff72d7e4f455173fcd9f01c4ed1a0dcc59b2cccc4f2cc4f27f1aaf7b04da9388a18e491880a0015faa9f0dbfe0d55f8fde24b88ff00b66f3c07e1a858fccd2decd7eca3fdd558c7fe3d5f5efecdff00f069e7803c237105d7c4af1b6b5e2c2b82fa7d846ba7d9bfa86d9fbc65f66735f535313492b2d4fce29e16b3776ac7e0168da04b1470c12cd6d0cca798da51e667fddfbc4fb015fbe5ff0006b978abe287877e126bde13d4340d561f87efa9b6a7a7dd6a16cd6ec92491c6b2f96180611b18c305207258e01635fa21f04ffe09c7f047f67bd12dec7c2bf0dfc2ba7c76ca155c5846d21c772c4649af64d2b45b3d0ad560b2b5b7b4857a24518451f80ae3ad89e78f2a47750c1fb39f3b7767ffd9, 'Direccion 2, calle 2', 'email2@gmail.com', '1989-07-21', 'Observo que este trabajador...', 2147483647, '+1 hora extra X dia', 'monitor', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador_Evento`
--

CREATE TABLE IF NOT EXISTS `Trabajador_Evento` (
  `DNI` varchar(9) NOT NULL,
  `Id_Evento` int(20) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Trabajador_Evento`
--

INSERT INTO `Trabajador_Evento` (`DNI`, `Id_Evento`, `Borrado`) VALUES
('22222222J', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `DNI` varchar(9) DEFAULT NULL,
  `Nombre_Grupo` varchar(30),
  `Password` varchar(40) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`DNI`, `Nombre_Grupo`, `Password`, `Usuario`, `Borrado`) VALUES
('11111111H', 'Monitor', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'usuario2', 0),
('22222222J', 'Secretario', '09ca0d5095609fe35bb7c9c7246e3cae', 'secretario', 0);
INSERT INTO `Usuario` (`Nombre_Grupo`, `Password`, `Usuario`, `Borrado`) VALUES
('Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0);

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
-- Indices de la tabla `Calendario`
--
ALTER TABLE `Calendario`
 ADD PRIMARY KEY (`Id_Calendario`);

--
-- Indices de la tabla `Cliente_Externo`
--
ALTER TABLE `Cliente_Externo`
 ADD PRIMARY KEY (`Id_Cliente`), ADD UNIQUE KEY `DNI` (`DNI`);
 
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
-- Indices de la tabla `Factura`
--
ALTER TABLE `Factura`
 ADD KEY `Factura_ibfk_1` (`Id_Cliente`);

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
 ADD PRIMARY KEY (`DNI_A`,`Id_Actividad`), ADD KEY `Id_Actividad` (`Id_Actividad`);

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
 ADD PRIMARY KEY (`Id_Reserva`), ADD KEY `Id_Espacio` (`Id_Espacio`);

--
-- Indices de la tabla `Reserva_Evento`
--
ALTER TABLE `Reserva_Evento`
 ADD PRIMARY KEY (`Id_Evento`,`Id_Reserva`);

--
-- Indices de la tabla `Reserva_Masaje`
--
ALTER TABLE `Reserva_Masaje`
 ADD PRIMARY KEY (`Id_Masaje`,`Id_Reserva`,`DNI_Alumno`,`DNI_Trabajador`), ADD KEY `Id_Masaje` (`Id_Masaje`), ADD KEY `DNI_A` (`DNI_Alumno`), ADD KEY `DNI_T` (`DNI_Trabajador`);

--
-- Indices de la tabla `Servicio`
--
ALTER TABLE `Servicio`
 ADD PRIMARY KEY (`Id_Servicio`);

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
 ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `Trabajador_Evento`
--
ALTER TABLE `Trabajador_Evento`
 ADD PRIMARY KEY (`DNI`,`Id_Evento`), ADD KEY `Id_Evento` (`Id_Evento`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
 ADD PRIMARY KEY (`Usuario`), ADD KEY `Nombre_Grupo` (`Nombre_Grupo`), ADD KEY `Usuario_ibfk_3` (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividad`
--
ALTER TABLE `Actividad`
ADD CONSTRAINT `Actividad_ibfk_1` FOREIGN KEY (`DNI_Trabajador`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Actividad_ibfk_2` FOREIGN KEY (`Id_Espacio`) REFERENCES `Espacio` (`Id_Espacio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Actividad_ibfk_3` FOREIGN KEY (`Id_Calendario`) REFERENCES `Calendario` (`Id_Calendario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
ADD CONSTRAINT `Asistencia_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Asistencia_ibfk_2` FOREIGN KEY (`Id_Actividad`) REFERENCES `Actividad` (`Id_Actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Cobro`
--
ALTER TABLE `Cobro`
ADD CONSTRAINT `Cobro_ibfk_1` FOREIGN KEY (`DNI_Alumno`) REFERENCES `Inscripcion` (`DNI_A`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Documento`
--
ALTER TABLE `Documento`
ADD CONSTRAINT `Documento_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Factura`
--
ALTER TABLE `Factura`
ADD CONSTRAINT `Factura_ibfk_1` FOREIGN KEY (`Id_Cliente`) REFERENCES `Cliente_Externo` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Horario`
--
ALTER TABLE `Horario`
ADD CONSTRAINT `Horario_ibfk_1` FOREIGN KEY (`Id_Calendario`) REFERENCES `Calendario` (`Id_Calendario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
ADD CONSTRAINT `Inscripcion_ibfk_1` FOREIGN KEY (`DNI_A`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Inscripcion_ibfk_2` FOREIGN KEY (`Id_Actividad`) REFERENCES `Actividad` (`Id_Actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Jornada`
--
ALTER TABLE `Jornada`
ADD CONSTRAINT `Jornada_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Linea_Factura`
--
ALTER TABLE `Linea_Factura`
ADD CONSTRAINT `Linea_Factura_ibfk_1` FOREIGN KEY (`Id_Servicio`) REFERENCES `Servicio` (`Id_Servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Linea_Factura_ibfk_2` FOREIGN KEY (`Id_Factura`) REFERENCES `Factura` (`Id_Factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Log_Lesion`
--
ALTER TABLE `Log_Lesion`
ADD CONSTRAINT `Log_Lesion_ibfk_1` FOREIGN KEY (`DNI_T`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Log_Lesion_ibfk_2` FOREIGN KEY (`DNI_A`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Permisos`
--
ALTER TABLE `Permisos`
ADD CONSTRAINT `Permisos_ibfk_1` FOREIGN KEY (`Nombre_Grupo`) REFERENCES `Grupo` (`Nombre_Grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Permisos_ibfk_2` FOREIGN KEY (`Nombre_Controlador`) REFERENCES `Controlador` (`Nombre_Controlador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Reserva_Espacio`
--
ALTER TABLE `Reserva_Espacio`
ADD CONSTRAINT `Reserva_Espacio_ibfk_1` FOREIGN KEY (`Id_Espacio`) REFERENCES `Espacio` (`Id_Espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

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
ADD CONSTRAINT `Reserva_Masaje_ibfk_2` FOREIGN KEY (`DNI_Alumno`) REFERENCES `Alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Reserva_Masaje_ibfk_3` FOREIGN KEY (`DNI_Trabajador`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Servicio`
--
ALTER TABLE `Servicio`
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
ADD CONSTRAINT `Trabajador_Evento_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Trabajador_Evento_ibfk_2` FOREIGN KEY (`Id_Evento`) REFERENCES `Evento` (`Id_Evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
ADD CONSTRAINT `Usuario_ibfk_2` FOREIGN KEY (`Nombre_Grupo`) REFERENCES `Grupo` (`Nombre_Grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Usuario_ibfk_3` FOREIGN KEY (`DNI`) REFERENCES `Trabajador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

