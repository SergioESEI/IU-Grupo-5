/*
DROP DATABASE IF EXISTS 'MOOVET';
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
CREATE DATABASE `IU2016` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `IU2016`;
GRANT USAGE ON *.* TO 'admin'@'localhost';
DROP USER 'admin'@'localhost';
CREATE USER 'admin'@'localhost' IDENTIFIED BY  'admin';
GRANT USAGE ON * . * TO  'admin'@'localhost' IDENTIFIED BY  'admin'
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON  `IU2016` . * TO  'admin'@'localhost' WITH GRANT OPTION ;
*/


DROP TABLE Inscripcion CASCADE CONSTRAINTS;
DROP TABLE Masaje CASCADE CONSTRAINTS;
DROP TABLE Reserva_Masaje CASCADE CONSTRAINTS;
DROP TABLE Calendario CASCADE CONSTRAINTS;
DROP TABLE Servicio CASCADE CONSTRAINTS;
DROP TABLE Cobro CASCADE CONSTRAINTS;
DROP TABLE Espacio CASCADE CONSTRAINTS;
DROP TABLE Reserva_Espacio CASCADE CONSTRAINTS;
DROP TABLE Horario CASCADE CONSTRAINTS;
DROP TABLE Caja CASCADE CONSTRAINTS;
DROP TABLE Cliente_Externo CASCADE CONSTRAINTS;
DROP TABLE Factura CASCADE CONSTRAINTS;
DROP TABLE Linea_Factura CASCADE CONSTRAINTS;

/*
-----------------------------------------------------
-------------------			DUDAS			-------------------
-----------------------------------------------------
*/

/*
EVENTO Revisar si está bien y la tablas que se relación con ella

ASISTENCIA
CLASE
*/

DROP TABLE Controlador CASCADE CONSTRAINTS;
DROP TABLE Grupo CASCADE CONSTRAINTS;
DROP TABLE Permisos CASCADE CONSTRAINTS;
DROP TABLE Trabajador CASCADE CONSTRAINTS;
DROP TABLE Usuario CASCADE CONSTRAINTS;
DROP TABLE Telefonos_t CASCADE CONSTRAINTS;
DROP TABLE Alumno CASCADE CONSTRAINTS;
DROP TABLE Telefonos_a CASCADE CONSTRAINTS;
DROP TABLE Documento CASCADE CONSTRAINTS;
DROP TABLE Descuento CASCADE CONSTRAINTS;

/*EN DUDA:  */
DROP TABLE Evento CASCADE CONSTRAINTS;
DROP TABLE Reserva_Evento CASCADE CONSTRAINTS;
DROP TABLE Trabajador_Evento CASCADE CONSTRAINTS;
/*
DROP TABLE Asistencia CASCADE CONSTRAINTS;
DROP TABLE Clase CASCADE CONSTRAINTS;
DROP TABLE Jornada CASCADE CONSTRAINTS;
*/

DROP TABLE Lesion CASCADE CONSTRAINTS;
DROP TABLE Log_Lesion CASCADE CONSTRAINTS;

CREATE TABLE Controlador
(
  Nombre_Controlador VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
  Accion  VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
      PRIMARY KEY (Nombre_Controlador,Accion)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Grupo
(
  Nombre_Grupo VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
       	PRIMARY KEY (Nombre_Grupo)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Permisos
(
  Nombre_Grupo VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_Controlador VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
  Accion  VARCHAR2(30) COLLATE latin1_spanish_ci NOT NULL,
      PRIMARY KEY (Nombre_Grupo, Nombre_Controlador, Accion),
      FOREIGN KEY (Nombre_Controlador, Accion) REFERENCES Controlador (Nombre_Controlador, Accion)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Trabajador
(
  Dni_t VARCHAR2(9) NOT NULL,
  Apellidos_t VARCHAR2(70) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_t  VARCHAR2(50) COLLATE latin1_spanish_ci NOT NULL,
  Url_foto  VARCHAR2(100) NOT NULL,
  Direccion VARCHAR2(100) COLLATE latin1_spanish_ci NOT NULL,
  Email VARCHAR2(50) NOT NULL,
  Fecha_nacimiento_t  DATE NOT NULL,
  Observaciones VARCHAR2(500) COLLATE latin1_spanish_ci,
  Numero_cuenta NUMBER(20) NOT NULL,
  Horas_extra VARCHAR2(200) COLLATE latin1_spanish_ci,
  Tipo_empleado ENUM ('administrador','secretario','monitor','fisioterapeuta','cafetería','limpieza', 'otros') NOT NULL,
  Externo BOOLEAN NOT NULL DEFAULT(0)),
       	PRIMARY KEY (Dni_t),
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Usuario
(
  Dni_t VARCHAR2(9) NOT NULL,
  Nombre_Grupo  VARCHAR2(50) COLLATE latin1_spanish_ci NOT NULL,
  Password  VARCHAR2(20) NOT NULL,
       	PRIMARY KEY (Dni_t),
        FOREIGN KEY (Dni_t) REFERENCES Trabajador (Dni_t), FOREIGN KEY (Nombre_Grupo) REFERENCES Grupo (Nombre_Grupo)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Telefonos_t
(
  Dni_t VARCHAR2(9) NOT NULL,
  Telefono_t  NUMBER(9) NOT NULL,
      PRIMARY KEY (Dni_t,Telefono_t),
      FOREIGN KEY (Dni_t) REFERENCES Trabajador (Dni_t)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Alumno
(
  Dni_a VARCHAR2(9) NOT NULL,
  Apellidos_a VARCHAR2(70) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_a  VARCHAR2(50) COLLATE latin1_spanish_ci NOT NULL,
  Direccion VARCHAR2(100) COLLATE latin1_spanish_ci,
  Email VARCHAR2(50) NOT NULL,
  Fecha_nacimiento_a  DATE NOT NULL,
  Observaciones VARCHAR2(500) COLLATE latin1_spanish_ci,
  Profesion VARCHAR2(50) COLLATE latin1_spanish_ci,
      PRIMARY KEY (Dni_a),
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Telefonos_a
(
  Dni_a VARCHAR2(9) NOT NULL,
  Telefono_a  NUMBER(9) NOT NULL,
      PRIMARY KEY (Dni_a,Telefono_a),
      FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
		
CREATE TABLE Evento
(
  Id_evento NUMBER(20) NOT NULL,
  Descripcion VARCHAR2(500) COLLATE latin1_spanish_ci NOT NULL,
       	PRIMARY KEY (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Reserva_Evento
(
  Id_evento NUMBER(20) NOT NULL,
  Id_reserva NUMBER(20) NOT NULL,
       	PRIMARY KEY (Id_evento,Id_reserva),
        FOREIGN KEY (Id_evento) REFERENCES Evento (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Trabajador_Evento
(
  Dni_t VARCHAR2(9) NOT NULL,
  Id_evento NUMBER(20) NOT NULL,
       	PRIMARY KEY (Dni_t,Id_evento),
        FOREIGN KEY(Dni_t) REFERENCES Trabajor (Dni_t),FOREIGN KEY (Id_evento) REFERENCES Evento (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Documento
(
  Dni_a VARCHAR2(9) NOT NULL,
  Tipo_Doc  VARCHAR2(20) NOT NULL,
  Fecha_Doc DATE NOT NULL,
  Url_Doc VARCHAR2(100) NOT NULL,
       	PRIMARY KEY (Dni_a,Tipo_Doc,Fecha_Doc),
        FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Descuento
(
  Id_descuento  VARCHAR2(20) NOT NULL,
  Requisitos  VARCHAR2(150) COLLATE latin1_spanish_ci NOT NULL,
  Porcentaje  NUMBER(4) NOT NULL,
       	PRIMARY KEY (Id_descuento)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Jornada
(
  Dni_t VARCHAR2(9) NOT NULL,
  Hora_entrada TIME NOT NULL,
  Hora_salida TIME NOT NULL,
  Fecha_Jornada DATE NOT NULL,
  Libre
       	PRIMARY KEY (Dni_t,Hora_entrada,Hora_salida),
        FOREIGN KEY (Dni_t) REFERENCES TRABAJADOR (Dni_t) 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*
CREATE TABLE Asistencia
(
  Dni_a VARCHAR2(9) NOT NULL,
  Fecha_asistencia  DATE NOT NULL,
       	PRIMARY KEY (),
        FOREIGN KEY () 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Clase
(
	
       	PRIMARY KEY (),
        FOREIGN KEY () 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
*/
CREATE TABLE Lesion
(
  Dni_a VARCHAR2(9) NOT NULL,
  Id_Lesion VARCHAR2(9) NOT NULL,
  Tipo VARCHAR2(50),
  Curada BOOLEAN NOT NULL DEFAULT(0)),
  Descripcion VARCHAR2(500) NOT NULL,
       	PRIMARY KEY (Dni_a, Id_Lesion),
        FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a) 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Log_Lesion
(
  Dni_t VARCHAR2(9) NOT NULL,
  Dni_a VARCHAR2(9) NOT NULL,
  Id_Lesion VARCHAR2(9) NOT NULL,
  Fecha_Log DATE NOT NULL,
  Hora_Log  TIME NOT NULL,
       	PRIMARY KEY (Dni_t,Dni_a,Id_Lesion),
        FOREIGN KEY (Dni_t) REFERENCES Trabajador (Dni_t), FOREIGN KEY (Dni_a,Id_Lesion) REFERENCES Lesion (Dni_a,Id_Lesion) 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Inscripcion
(
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY REFERENCES Alumno,
	Id_Actividad VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY REFERENCES Actividad,
	Id_Cobro VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY REFERENCES Cobro,
	Fecha DATE NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Masaje
(
  Id_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
  Nombre_M VARCHAR(50) COLLATE latin1_spanish_ci NOT NULL,
  
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Reserva_Masaje
(
  Id_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Masaje,
	--Id_Reserva_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Dni_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Tipo_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Fecha DATE NOT NULL
        PRIMARY KEY (Id_Masaje, Dni_Alumno, Dni_Trabajador)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Calendario
(
	Id_Calendario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Fecha_inicio DATE NOT NULL,
	Fecha_Fin DATE NOT NULL,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5)  COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Servicio
(
	Id_Servicio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Id_Cliente VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Cliente_Externo,
	Nombre VARCHAR (30) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Cobro
(
	Id_Cobro VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Importe SMALLINT COLLATE latin1_spanish_ci NOT NULL,
	Fecha_Cobro DATE NOT NULL,
	Fecha_Confirmacion DATE NOT NULL,
	Tipo VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL /* Duda */

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Espacio
(
	Id_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Nombre VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Reserva_Espacio
(
	Id_Reserva_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Espacio,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Id_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Fecha DATE NOT NULL,
	Evento VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Horario
(
	Id_Horario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Calendario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Calendario,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Caja
(
	Id_Caja VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Fecha DATE NOT NULL,
	Tipo VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL /* Misma duda */
	Importe FLOAT NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Cliente_Externo
(
	Id_Cliente VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Nombre VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
	Dni VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL UNIQUE,
	Tlf SMALLINT NOT NULL,
	Email VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
	Direccion VARCHAR(40) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE Linea_Factura
(
	Id_Factura VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Cantidad SMALLINT NOT NULL,
	IMPORTE FLOAT NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
