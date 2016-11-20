DROP DATABASE IF EXISTS `MOOVETT`;
SET SQL_MODE=`NO_AUTO_VALUE_ON_ZERO`;
CREATE DATABASE `MOOVETT` DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci;
USE `MOOVETT`;
GRANT USAGE ON * . * TO  'root'@'localhost' IDENTIFIED BY  'iu'
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON  `MOOVETT` . * TO  'root'@'localhost' WITH GRANT OPTION ;

/*
EVENTO Revisar si está bien y la tablas que se relación con ella
ASISTENCIA
CLASE
*/

CREATE TABLE Controlador
(
  Nombre_Controlador VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Accion  VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
      PRIMARY KEY (Nombre_Controlador,Accion)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

INSERT INTO Controlador (Nombre_Controlador,Accion) VALUES('Gestión controladores','Añadir');
INSERT INTO Controlador (Nombre_Controlador,Accion) VALUES('Gestión grupos','Añadir');

CREATE TABLE Grupo
(
  Nombre_Grupo VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
       	PRIMARY KEY (Nombre_Grupo)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

INSERT INTO Grupo(Nombre_Grupo) VALUES('Admin');
INSERT INTO Grupo(Nombre_Grupo) VALUES('Secretario');
INSERT INTO Grupo(Nombre_Grupo) VALUES('Monitor');

CREATE TABLE Permisos
(
  Nombre_Grupo VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_Controlador VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Accion  VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
      PRIMARY KEY (Nombre_Grupo, Nombre_Controlador, Accion),
      FOREIGN KEY (Nombre_Controlador, Accion) REFERENCES Controlador (Nombre_Controlador, Accion)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

INSERT INTO Permisos(Nombre_Grupo,Nombre_Controlador,Accion) VALUES('Admin','Gestión controladores','Añadir');
INSERT INTO Permisos(Nombre_Grupo,Nombre_Controlador,Accion) VALUES('Admin','Gestión grupos','Añadir');

CREATE TABLE Trabajador
(
  DNI VARCHAR(9) NOT NULL,
  Apellidos_t VARCHAR(70) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_t  VARCHAR(50) COLLATE latin1_spanish_ci NOT NULL,
  Url_foto  VARCHAR(100) NOT NULL,
  Direccion VARCHAR(100) COLLATE latin1_spanish_ci NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Fecha_nacimiento_t  DATETIME NOT NULL,
  Observaciones VARCHAR(500) COLLATE latin1_spanish_ci,
  Numero_cuenta DECIMAL(20) NOT NULL,
  Horas_extra VARCHAR(200) COLLATE latin1_spanish_ci,
  Tipo_empleado ENUM ('administrador','secretario','monitor','fisioterapeuta','cafetería','limpieza', 'otros') NOT NULL,
  Externo BOOLEAN NOT NULL DEFAULT 0,
       	PRIMARY KEY (DNI)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;



CREATE TABLE Usuario
(
  DNI VARCHAR(9) NOT NULL, 
  Usuario VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Nombre VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Apellidos VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Email VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  Telefono VARCHAR(9) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_Grupo  VARCHAR(50) COLLATE latin1_spanish_ci NOT NULL,
  Password  VARCHAR(50) NOT NULL,
  Borrado BOOLEAN NOT NULL DEFAULT 0,
       	PRIMARY KEY (Usuario),
        FOREIGN KEY (Nombre_Grupo) REFERENCES Grupo (Nombre_Grupo)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

INSERT INTO Usuario (DNI,Usuario,Nombre,Apellidos,Email,Telefono,Nombre_Grupo,Password) VALUES ('12345678A','admin','abc','abc','abc@gmail.com','123456789','Admin','21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE Telefonos_t
(
  Dni_t VARCHAR(9) NOT NULL,
  Telefono_t  BIGINT NOT NULL,
      PRIMARY KEY (Dni_t,Telefono_t),
      FOREIGN KEY (Dni_t) REFERENCES Trabajador (Dni_t)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Alumno
(
  Dni_a VARCHAR(9) NOT NULL,
  Apellidos_a VARCHAR(70) COLLATE latin1_spanish_ci NOT NULL,
  Nombre_a  VARCHAR(50) COLLATE latin1_spanish_ci NOT NULL,
  Direccion VARCHAR(100) COLLATE latin1_spanish_ci,
  Email VARCHAR(50) NOT NULL,
  Fecha_nacimiento_a  DATETIME NOT NULL,
  Observaciones VARCHAR(500) COLLATE latin1_spanish_ci,
  Profesion VARCHAR(50) COLLATE latin1_spanish_ci,
      PRIMARY KEY (Dni_a)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Telefonos_a
(
  Dni_a VARCHAR(9) NOT NULL,
  Telefono_a  BIGINT NOT NULL,
      PRIMARY KEY (Dni_a,Telefono_a),
      FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;
		
CREATE TABLE Evento
(
  Id_evento DECIMAL(20) NOT NULL,
  Descripcion VARCHAR(500) COLLATE latin1_spanish_ci NOT NULL,
       	PRIMARY KEY (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Reserva_Evento
(
  Id_evento DECIMAL(20) NOT NULL,
  Id_reserva DECIMAL(20) NOT NULL,
       	PRIMARY KEY (Id_evento,Id_reserva),
        FOREIGN KEY (Id_evento) REFERENCES Evento (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Trabajador_Evento
(
  Dni_t VARCHAR(9) NOT NULL,
  Id_evento DECIMAL(20) NOT NULL,
       	PRIMARY KEY (Dni_t,Id_evento),
        FOREIGN KEY(Dni_t) REFERENCES Trabajor (Dni_t),FOREIGN KEY (Id_evento) REFERENCES Evento (Id_evento)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Documento
(
  Dni_a VARCHAR(9) NOT NULL,
  Tipo_Doc  VARCHAR(20) NOT NULL,
  Fecha_Doc DATETIME NOT NULL,
  Url_Doc VARCHAR(100) NOT NULL,
       	PRIMARY KEY (Dni_a,Tipo_Doc,Fecha_Doc),
        FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Descuento
(
  Id_descuento  VARCHAR(20) NOT NULL,
  Requisitos  VARCHAR(150) COLLATE latin1_spanish_ci NOT NULL,
  Porcentaje  SMALLINT NOT NULL,
       	PRIMARY KEY (Id_descuento)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Jornada
(
  Dni_t VARCHAR(9) NOT NULL,
  Fecha_Jornada DATETIME NOT NULL,
  Hora_inicio TIME NOT NULL,
  Hora_fin TIME NOT NULL,
  Libre BOOLEAN NOT NULL DEFAULT 0,
       	PRIMARY KEY (Dni_t,Fecha_Jornada,Hora_inicio,Hora_fin),
        FOREIGN KEY (Dni_t) REFERENCES TRABAJADOR (Dni_t) 
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;
/*
CREATE TABLE Asistencia
(
  Dni_a VARCHAR2(9) NOT NULL,
  Fecha_asistencia  DATE NOT NULL,
       	PRIMARY KEY (),
        FOREIGN KEY () 
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Clase
(
	
       	PRIMARY KEY (),
        FOREIGN KEY () 
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;
*/
CREATE TABLE Lesion
(
  Dni_a VARCHAR(9) NOT NULL,
  Id_Lesion VARCHAR(9) NOT NULL,
  Tipo VARCHAR(50),
  Curada BOOLEAN NOT NULL DEFAULT 0,
  Descripcion VARCHAR(500) NOT NULL,
       	PRIMARY KEY (Dni_a, Id_Lesion),
        FOREIGN KEY (Dni_a) REFERENCES Alumno (Dni_a) 
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Log_Lesion
(
  Dni_t VARCHAR(9) NOT NULL,
  Dni_a VARCHAR(9) NOT NULL,
  Id_Lesion VARCHAR(9) NOT NULL,
  Fecha_Log DATETIME NOT NULL,
  Hora_Log  TIME NOT NULL,
       	PRIMARY KEY (Dni_t,Dni_a,Id_Lesion),
        FOREIGN KEY (Dni_t) REFERENCES Trabajador (Dni_t), FOREIGN KEY (Dni_a,Id_Lesion) REFERENCES Lesion (Dni_a,Id_Lesion) 
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Inscripcion
(
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Id_Actividad VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Actividad,
	Fecha DATETIME NOT NULL,
		PRIMARY KEY (Dni_Alumno,Id_Actividad)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Masaje
(
  Id_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
  Nombre_M VARCHAR(50) COLLATE latin1_spanish_ci NOT NULL
  
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Reserva_Masaje
(
  Id_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Masaje,
	-- Id_Reserva_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Dni_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Tipo_Masaje VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Fecha DATETIME NOT NULL,
        PRIMARY KEY (Id_Masaje, Dni_Alumno, Dni_Trabajador)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Calendario
(
	Id_Calendario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Fecha_inicio DATETIME NOT NULL,
	Fecha_Fin DATETIME NOT NULL,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5)  COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Servicio
(
	Id_Servicio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Id_Cliente VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Cliente_Externo,
	Nombre VARCHAR (30) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Cobro
(
	Id_Cobro VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Id_Actividad VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Actividad,
	Importe DECIMAL(38) COLLATE latin1_spanish_ci NOT NULL,
	Fecha_Cobro DATETIME NOT NULL,
	Fecha_Confirmacion DATETIME NOT NULL,
		FOREIGN KEY (Dni_Alumno,Id_Actividad) REFERENCES Inscripcion (Dni_Alumno,Id_Actividad),
	Tipo VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL 

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Espacio
(
	Id_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Nombre VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Reserva_Espacio
(
	Id_Reserva_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Espacio VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Espacio,
	Dni_Alumno VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Alumno,
	Id_Trabajador VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Trabajador,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Fecha DATETIME NOT NULL,
	Evento VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Horario
(
	Id_Horario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Id_Calendario VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL REFERENCES Calendario,
	Hora_Inicio VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL,
	Hora_Fin VARCHAR(5) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Caja
(
	Id_Caja VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Fecha DATETIME NOT NULL,
	Tipo VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
	Importe FLOAT NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Cliente_Externo
(
	Id_Cliente VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Nombre VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
	Dni VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL UNIQUE,
	Tlf DECIMAL(38) NOT NULL,
	Email VARCHAR(20) COLLATE latin1_spanish_ci NOT NULL,
	Direccion VARCHAR(40) COLLATE latin1_spanish_ci NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;

CREATE TABLE Linea_Factura
(
	Id_Factura VARCHAR(10) COLLATE latin1_spanish_ci NOT NULL PRIMARY KEY,
	Cantidad DECIMAL(38) NOT NULL,
	IMPORTE DOUBLE NOT NULL

)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_general_ci;
