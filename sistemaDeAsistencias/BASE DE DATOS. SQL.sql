-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.39 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para asistencia
CREATE DATABASE IF NOT EXISTS `asistencia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `asistencia`;

-- Volcando estructura para tabla asistencia.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumnos` int NOT NULL AUTO_INCREMENT,
  `id_institucion` int DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `dni` varchar(50) DEFAULT NULL,
  `nota1` int DEFAULT '0',
  `nota2` int DEFAULT '0',
  `nota3` int DEFAULT '0',
  PRIMARY KEY (`id_alumnos`),
  KEY `id_institucion` (`id_institucion`),
  CONSTRAINT `FK_alumnos_instituciones` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla asistencia.alumnos: ~22 rows (aproximadamente)
INSERT INTO `alumnos` (`id_alumnos`, `id_institucion`, `nombre`, `apellido`, `fecha_nacimiento`, `dni`, `nota1`, `nota2`, `nota3`) VALUES
	(5, 1, 'Valentino', 'Andrade', '1999-03-12 00:00:00', '35123456', 0, 0, 0),
	(6, 2, 'Lucas', 'Cedres', '1998-09-07 00:00:00', '34876543', 0, 0, 0),
	(7, 2, 'Facundo', 'Figun', '2000-11-25 00:00:00', '40123789', 0, 0, 0),
	(8, 1, 'Luca', 'Giordano', '1997-06-02 00:00:00', '32456789', 0, 0, 0),
	(9, 2, 'Bruno', 'Godoy', '1999-01-18 00:00:00', '36789123', 0, 0, 0),
	(10, 1, 'Agustin', 'Gomez', '1996-04-30 00:00:00', '33567890', 0, 0, 0),
	(11, 2, 'Brian', 'Gonzalez', '1997-12-05 00:00:00', '35678901', 0, 0, 0),
	(12, 2, 'Federico', 'Guigou Scottini', '1998-08-15 00:00:00', '37890123', 0, 0, 0),
	(13, 1, 'Luna', 'Marrano', '1999-03-10 00:00:00', '38901234', 0, 0, 0),
	(14, 1, 'Giuliana', 'Mercado Aviles', '1995-10-22 00:00:00', '33345678', 0, 0, 0),
	(15, 2, 'Lucila', 'Mercado Ruiz', '1996-12-08 00:00:00', '32567890', 0, 0, 0),
	(16, 2, 'Angel', 'Murillo', '1998-02-27 00:00:00', '34890123', 0, 0, 0),
	(17, 1, 'Juan', 'Nissero', '1999-07-17 00:00:00', '36123456', 0, 0, 0),
	(18, 2, 'Fausto', 'Parada', '1997-11-06 00:00:00', '35234567', 0, 0, 0),
	(19, 2, 'Ignacio', 'Piter', '1996-05-19 00:00:00', '32789012', 0, 0, 0),
	(20, 2, 'Tomas', 'Planchon', '2000-09-03 00:00:00', '40456789', 0, 0, 0),
	(21, 1, 'Elisa', 'Ronconi', '1995-01-24 00:00:00', '31678123', 0, 0, 0),
	(22, 1, 'Exequiel', 'Sanchez', '1998-04-11 00:00:00', '33234567', 0, 0, 0),
	(23, 1, 'Melina', 'Schimpf Baldo', '1996-10-09 00:00:00', '33789456', 0, 0, 0),
	(24, 1, 'Diego', 'Segovia', '1997-02-13 00:00:00', '34567890', 5, 6, 9),
	(25, 1, 'Camila', 'Sittner', '1999-08-20 00:00:00', '36456789', 8, 7, 8),
	(26, 2, 'Yamil', 'Villa', '1998-06-28 00:00:00', '35345678', 0, 0, 0),
	(38, 1, 'TADEDO', 'LUISELLIY', '2002-11-20 00:00:00', '3456743', 0, 0, 0);

-- Volcando estructura para tabla asistencia.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `id_alumno` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `presente` enum('presente','ausente') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumnos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla asistencia.asistencias: ~9 rows (aproximadamente)
INSERT INTO `asistencias` (`id_asistencia`, `id_alumno`, `fecha`, `presente`) VALUES
	(6, 5, '2024-11-07', 'presente'),
	(7, 8, '2024-11-07', 'presente'),
	(8, 10, '2024-11-07', 'presente'),
	(9, 13, '2024-10-16', 'presente'),
	(10, 25, '2024-11-06', 'presente'),
	(11, 24, '2024-11-06', 'presente'),
	(12, 23, '2024-11-07', 'presente'),
	(13, 24, '2024-11-08', 'presente'),
	(14, 23, '2024-11-08', 'presente'),
	(17, 14, '2024-11-08', 'presente'),
	(18, 5, '2024-11-08', 'presente');

-- Volcando estructura para tabla asistencia.instituciones
CREATE TABLE IF NOT EXISTS `instituciones` (
  `id_institucion` int NOT NULL AUTO_INCREMENT,
  `nombre_institucion` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla asistencia.instituciones: ~2 rows (aproximadamente)
INSERT INTO `instituciones` (`id_institucion`, `nombre_institucion`, `direccion`) VALUES
	(1, 'sedes', 'santa fe'),
	(2, 'utn', 'consepcion');

-- Volcando estructura para tabla asistencia.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_institucion` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `id_institucion` (`id_institucion`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla asistencia.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `telefono`, `usuario`, `contrasena`, `id_institucion`) VALUES
	(1, 'camila', 'sittner', '1234', 'pepito', '123', 1),
	(2, 'pepe', 'loco', '123', 'hola', '098', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
