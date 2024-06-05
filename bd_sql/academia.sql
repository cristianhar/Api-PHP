-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-06-2024 a las 23:29:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `codasig` varchar(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  `intensidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`codasig`, `nombre`, `valor`, `intensidad`) VALUES
('1', 'Logica', 5, 2),
('2', 'PHP Intermedio', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `ident` varchar(12) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`ident`, `apellidos`, `nombres`, `correo`, `contrasena`) VALUES
('121212', 'aas', 'www', 'wasw@gmail.com', '111'),
('1214742451', 'Arboleda Henao', 'Cristian Johao', 'yohan4752@gmail.com', '123456'),
('1214742452', 'Arboleda Henao', 'Cristian Johao', 'prueba@gmail.com', '123456'),
('23', 'sfdsf', 'sdfdsf', 'dfsd', '456'),
('454577', 'PÃ©rez', 'Maria Salome', 'pperez@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `ident` varchar(12) NOT NULL,
  `codasig` varchar(3) NOT NULL,
  `periodo` varchar(6) NOT NULL,
  `notam1` double NOT NULL,
  `notam2` double NOT NULL,
  `notam3` double NOT NULL,
  `id_nota` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`ident`, `codasig`, `periodo`, `notam1`, `notam2`, `notam3`, `id_nota`, `activo`) VALUES
('121212', '1', '3', 4, 3, 4, 1, 0),
('121212', '1', '1', 4, 3, 4, 2, 0),
('121212', '2', '3', 4, 3, 4, 3, 0),
('23', '2', '1', 3, 5, 5, 4, 0),
('23', '2', '2', 4, 4, 5, 5, 0),
('454577', '2', '3', 5, 5, 2, 6, 1),
('1214742451', '2', '3', 4, 4, 4, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `edad`) VALUES
(2, 'Ana Gomez Gil', 'ana@example.com', 29),
(3, 'Luis Martinez', 'luis@example.com', 28),
(4, 'Cristian Arboleda', 'yohan4752@gmail.com', 25),
(5, 'Cristian Johao', 'yohan4752@gmail.es', 26),
(10, 'Edison', 'edisondelsena@gmail.com', 41);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`codasig`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`ident`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `ident` (`ident`),
  ADD KEY `codasig` (`codasig`),
  ADD KEY `periodo` (`periodo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_asignatura` FOREIGN KEY (`codasig`) REFERENCES `asignatura` (`codasig`),
  ADD CONSTRAINT `fk_nota_estudiante` FOREIGN KEY (`ident`) REFERENCES `estudiante` (`ident`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
