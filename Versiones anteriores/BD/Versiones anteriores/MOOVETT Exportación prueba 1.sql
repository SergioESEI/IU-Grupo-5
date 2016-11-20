-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2016 a las 14:08:29
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

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`Id_Actividad`, `Nombre`, `DNI_Trabajador`, `Id_Espacio`, `Precio`, `Categoria`, `Capacidad_Max`, `Duracion`, `Fecha`, `Hora_Inicio`, `Hora_Fin`, `Id_Calendario`) VALUES
('0123456789', 'Actividad 1', '22222222A', '9874563210', 10.5, 'Baile', 20, 'Mensual', '2016-12-17', '15:30:00', '16:30:00', '3210654987');

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

--
-- Volcado de datos para la tabla `Alumno`
--

INSERT INTO `Alumno` (`DNI`, `Apellidos`, `Nombre`, `Direccion`, `Email`, `Fecha_Nacimiento`, `Observaciones`, `Profesion`) VALUES
('11111111A', 'ApellidoA ApellidoA', 'NombreA', 'Direccion alumno, calle alumno', 'alumno@hotmail.com', '2017-10-31', 'Observo que este tío tiene esta lesión', 'Contable');

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

--
-- Volcado de datos para la tabla `Caja`
--

INSERT INTO `Caja` (`Id_Caja`, `Fecha`, `Tipo`, `Importe`) VALUES
('0231989898', '2017-02-15', '', 500.5);

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

--
-- Volcado de datos para la tabla `Calendario`
--

INSERT INTO `Calendario` (`Id_Calendario`, `Fecha_Inicio`, `Fecha_Fin`, `Hora_Inicio`, `Hora_Fin`) VALUES
('3210654987', '2016-10-31', '2016-12-31', '09:00:00', '20:00:00');

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

--
-- Volcado de datos para la tabla `Cliente_Externo`
--

INSERT INTO `Cliente_Externo` (`Id_Cliente`, `Nombre`, `DNI`, `Tlf`, `Email`, `Direccion`) VALUES
('48484848K', 'Fulanito', '48484848K', 32767, 'fulanito@gmail.com', 'Progeso 24, 3A');

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

--
-- Volcado de datos para la tabla `Cobro`
--

INSERT INTO `Cobro` (`Id_Cobro`, `DNI_Alumno`, `Importe`, `Fecha_Cobro`, `Fecha_Confirmacion`, `Tipo`) VALUES
('1010101010', '11111111A', 18.9, '2016-12-17', '2016-12-17', 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Controlador`
--

CREATE TABLE IF NOT EXISTS `Controlador` (
  `Nombre_Controlador` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Controlador`
--

INSERT INTO `Controlador` (`Nombre_Controlador`, `Accion`) VALUES
('Controlador1', 'Accion1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Descuento`
--

CREATE TABLE IF NOT EXISTS `Descuento` (
  `Id_Descuento` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Requisitos` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `Porcentaje` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Descuento`
--

INSERT INTO `Descuento` (`Id_Descuento`, `Requisitos`, `Porcentaje`) VALUES
('8588588585', 'Los requitos son...', 1050);

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

--
-- Volcado de datos para la tabla `Documento`
--

INSERT INTO `Documento` (`DNI`, `Tipo_Documento`, `Fecha_Documento`, `Url_Documento`) VALUES
('11111111A', 'SEPA', '2017-10-31', 'url2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espacio`
--

CREATE TABLE IF NOT EXISTS `Espacio` (
  `Id_Espacio` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Espacio`
--

INSERT INTO `Espacio` (`Id_Espacio`, `Nombre`) VALUES
('9874563210', 'Aula 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE IF NOT EXISTS `Evento` (
  `Id_Evento` int(20) NOT NULL,
  `Descripcion` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`Id_Evento`, `Descripcion`, `Nombre`) VALUES
(1, 'Esta es la descripción del evento del Magosto', 'Magosto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE IF NOT EXISTS `Grupo` (
  `Nombre_Grupo` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`Nombre_Grupo`) VALUES
('Grupo1');

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

--
-- Volcado de datos para la tabla `Horario`
--

INSERT INTO `Horario` (`Id_Horario`, `Id_Calendario`, `Hora_Inicio`, `Hora_Fin`) VALUES
('1616161616', '3210654987', '09:00:00', '19:00:00');

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

--
-- Volcado de datos para la tabla `Inscripcion`
--

INSERT INTO `Inscripcion` (`DNI_A`, `Id_Actividad`, `Id_Cobro`, `Fecha`) VALUES
('11111111A', '0123456789', '1010101010', '2016-12-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jornada`
--

CREATE TABLE IF NOT EXISTS `Jornada` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Hora_Salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Jornada`
--

INSERT INTO `Jornada` (`DNI`, `Hora_Entrada`, `Hora_Salida`) VALUES
('22222222A', '08:55:00', '17:03:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lesion`
--

CREATE TABLE IF NOT EXISTS `Lesion` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Lesion` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Curada` tinyint(1) NOT NULL,
  `Descripcion` varchar(500) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Lesion`
--

INSERT INTO `Lesion` (`DNI`, `Id_Lesion`, `Tipo`, `Curada`, `Descripcion`) VALUES
('11111111A', '252525252', 'Lesion cervical', 0, 'La lesion se encuentra en...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Linea_Factura`
--

CREATE TABLE IF NOT EXISTS `Linea_Factura` (
  `Id_Factura` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Importe` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Linea_Factura`
--

INSERT INTO `Linea_Factura` (`Id_Factura`, `Cantidad`, `Importe`) VALUES
('5656565656', 32, 10.5);

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

--
-- Volcado de datos para la tabla `Log_Lesion`
--

INSERT INTO `Log_Lesion` (`DNI_T`, `DNI_A`, `Id_Lesion`, `Fecha_Log`, `Hora_Log`) VALUES
('22222222A', '11111111A', '252525252', '2017-10-31', '15:05:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Masaje`
--

CREATE TABLE IF NOT EXISTS `Masaje` (
  `Id_Masaje` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Masaje`
--

INSERT INTO `Masaje` (`Id_Masaje`, `Nombre`) VALUES
('242424242', 'Exfoliante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `Nombre_Grupo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre_Controlador` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Permisos`
--

INSERT INTO `Permisos` (`Nombre_Grupo`, `Nombre_Controlador`, `Accion`) VALUES
('Grupo1', 'Controlador1', 'Accion1');

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

--
-- Volcado de datos para la tabla `Reserva_Espacio`
--

INSERT INTO `Reserva_Espacio` (`Id_Reserva`, `Id_Espacio`, `DNI_Alumno`, `ID_Trabajador`, `Hora_Inicio`, `Hora_Fin`, `Fecha`, `Evento`) VALUES
('3232323232', '9874563210', '11111111A', '22222222A', '12:00:00', '13:00:00', '2017-02-15', 'Evento');

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

--
-- Volcado de datos para la tabla `Reserva_Masaje`
--

INSERT INTO `Reserva_Masaje` (`Id_Masaje`, `Id_Reserva`, `DNI_A`, `DNI_T`, `Tipo`, `Hora_Inicio`, `Hora_Fin`, `Fecha`) VALUES
('2424242424', '5656565656', '11111111A', '22222222A', 'Exfoliante', '16:00:00', '17:00:00', '2016-11-23');

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

--
-- Volcado de datos para la tabla `Servicio`
--

INSERT INTO `Servicio` (`Id_Servicio`, `Id_Trabajador`, `Id_Cliente`, `Nombre`, `Descripcion`) VALUES
('963852741', '22222222A', '48484848K', 'Cena de empresa', 'Preparación de cena para 50 personas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Alumno`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Alumno` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Telefonos_Alumno`
--

INSERT INTO `Telefonos_Alumno` (`DNI`, `Telefono`) VALUES
('11111111A', 777777777);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos_Trabajador`
--

CREATE TABLE IF NOT EXISTS `Telefonos_Trabajador` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Telefonos_Trabajador`
--

INSERT INTO `Telefonos_Trabajador` (`DNI`, `Telefono`) VALUES
('00000000Z', 666666666);

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

--
-- Volcado de datos para la tabla `Trabajador`
--

INSERT INTO `Trabajador` (`DNI`, `Apellidos`, `Nombre`, `Password`, `Url_Foto`, `Direccion`, `Email`, `Fecha_Nacimiento`, `Observaciones`, `Numero_Cuenta`, `Horas_Extra`, `Nombre_Grupo`, `Tipo_Empleado`, `Externo`) VALUES
('00000000Z', 'ApellidoTr ApellidoTr', 'NombreTr', '25f9e794323b453885f5', 'url1', 'Direccion 1, calle 1', 'email1@gmail.com', '1990-12-25', 'Observo que este trabajador se esfuerza', 2147483647, '+1 hora extra X dia', 'Grupo 2', 'secretario', 0),
('12345678A', 'Admin', 'Admin', '21232f297a57a5a74389', 'url', 'Direccion , calle', 'email@gmail.com', '1988-05-07', 'Observaciones', 2147483647, '+1 hora extra X dia', 'Grupo 1', 'administrador', 0),
('22222222A', 'ApellidoTr2 Apellido2Tr', 'Nombre2Tr', 'd8578edf8458ce06fbc5', 'url2', 'Direccion 2, calle 2', 'email2@gmail.com', '1989-07-21', 'Observo que este trabajador...', 2147483647, '+1 hora extra X dia', 'Grupo 3', 'monitor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Trabajador_Evento`
--

CREATE TABLE IF NOT EXISTS `Trabajador_Evento` (
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Id_Evento` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `Trabajador_Evento`
--

INSERT INTO `Trabajador_Evento` (`DNI`, `Id_Evento`) VALUES
('22222222A', 1);

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
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`DNI`, `Nombre_Grupo`, `Password`) VALUES
('00000000Z', 'Grupo1', 'd8578edf8458ce06fbc5'),
('12345678A', 'Grupo1', '21232f297a57a5a74389');

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
