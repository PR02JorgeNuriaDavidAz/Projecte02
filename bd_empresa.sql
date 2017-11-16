-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2017 a las 17:45:43
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_incidencia`
--

CREATE TABLE `tbl_incidencia` (
  `idIncidencia` int(4) NOT NULL,
  `descripcionIncidencia` varchar(100) DEFAULT NULL,
  `fechaIncidencia` date DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_incidencia`
--

INSERT INTO `tbl_incidencia` (`idIncidencia`, `descripcionIncidencia`, `fechaIncidencia`, `idRecurso`) VALUES
(1, 'fsdfsdf', '0111-01-01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recurso`
--

CREATE TABLE `tbl_recurso` (
  `idRecurso` int(4) NOT NULL,
  `nombreRecursos` varchar(35) DEFAULT NULL,
  `tipoRecursos` enum('Sala','Material') DEFAULT NULL,
  `Ocupado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_recurso`
--

INSERT INTO `tbl_recurso` (`idRecurso`, `nombreRecursos`, `tipoRecursos`, `Ocupado`) VALUES
(1, 'Aula teoría con proyector 01', 'Sala', 1),
(2, 'Aula teoría con proyector 02', 'Sala', 1),
(3, 'Aula teoría sin proyector', 'Sala', 1),
(4, 'Aula informática 01', 'Sala', 1),
(5, 'Aula informática 02', 'Sala', 1),
(6, 'Despacho para entrevistas 01', 'Sala', 0),
(7, 'Despacho para entrevistas 02', 'Sala', 0),
(8, 'Sala de reuniones', 'Sala', 0),
(9, 'Proyector portátil', 'Material', 0),
(10, 'Carro de portátiles', 'Material', 0),
(11, 'Portátil', 'Material', 0),
(12, 'Portátil ', 'Material', 0),
(13, 'Portátil', 'Material', 0),
(14, 'Móvil', 'Material', 0),
(15, 'Móvil', 'Material', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `idReserva` int(4) NOT NULL,
  `fechaReserva` datetime DEFAULT NULL,
  `fechaLiberamiento` datetime DEFAULT NULL,
  `idUsuario` int(4) DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`idReserva`, `fechaReserva`, `fechaLiberamiento`, `idUsuario`, `idRecurso`) VALUES
(375, '2017-11-16 15:23:55', '2017-11-16 15:26:52', 1, 1),
(376, '2017-11-16 15:23:56', '2017-11-16 15:26:52', 1, 2),
(377, '2017-11-16 15:23:56', '2017-11-16 15:26:52', 1, 3),
(378, '2017-11-16 16:13:51', NULL, 1, 1),
(379, '2017-11-16 16:13:55', NULL, 1, 2),
(380, '2017-11-16 16:52:09', NULL, 3, 3),
(381, '2017-11-16 16:55:28', NULL, 3, 4),
(382, '2017-11-16 16:55:28', NULL, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `idUsuario` int(4) NOT NULL,
  `nombreUsuario` varchar(15) DEFAULT NULL,
  `apellidoUsuario` varchar(15) DEFAULT NULL,
  `dniUsuario` varchar(9) DEFAULT NULL,
  `mailUsuario` varchar(35) DEFAULT NULL,
  `telefonoUsuario` int(9) DEFAULT NULL,
  `direccionUsuario` varchar(60) DEFAULT NULL,
  `passwordUsuario` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `dniUsuario`, `mailUsuario`, `telefonoUsuario`, `direccionUsuario`, `passwordUsuario`) VALUES
(1, 'Juan', 'Alvarez', '45246798L', 'juanalvarez@gmail.com', 612346789, 'juanalvarez@gmail.com', '12345'),
(2, 'Carlos', 'Pedro', '56934567F', 'carlospedro@gmail.com', 625678946, 'C/ Balmes nº 2 1º4', '5678'),
(3, 'Helena', 'Perez', '67434678N', 'helenaperez@gmail.com', 634689457, 'C/ Gerona nº 4 2º1', '6789'),
(4, 'Jordi', 'Baró', '56746745M', 'jordibaro@gmail.com', 634683456, 'C/ Amalia nº 6  2º4', '23456'),
(5, 'Victor', 'Cabrera', '54237854R', 'victorcabrera@gmail.com', 623578546, 'victorcabrera@gmail.com', '3456'),
(6, 'Xavi', 'Campo', '26745778F', 'xavicampo@gmail.com', 623577878, 'C/ Ribes nº 9 3º1', '67890'),
(7, 'Ricardo', 'Jaume', '45736896L', 'ricardojaume@gmail.com', 675456854, 'C/ Gava nº 4 1º2', '7890'),
(8, 'Fran', 'López', '86456567G', 'franlopez@gmail.com', 633478789, 'C/ Miro nº 2 4º2', '234567'),
(9, 'Sergi', 'Mateo', '34656546D', 'sergimateo@gmail.com', 635457567, 'C/ Tarragona', '567890'),
(10, 'Alba', 'Vilanova', '63468246K', 'albavilanova@gmail.com', 634687804, 'C/ Olesa nº 3 2º2', '345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD PRIMARY KEY (`idIncidencia`),
  ADD KEY `FK_incidencia_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  ADD PRIMARY KEY (`idRecurso`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_reserva_usuario` (`idUsuario`),
  ADD KEY `FK_reserva_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  MODIFY `idIncidencia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  MODIFY `idRecurso` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `idReserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD CONSTRAINT `FK_incidencia_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`);

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `FK_reserva_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`),
  ADD CONSTRAINT `FK_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
