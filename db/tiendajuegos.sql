-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 05:59:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendajuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `Id_Juego` int(11) NOT NULL,
  `nombre_juego` varchar(20) NOT NULL,
  `generos` varchar(20) NOT NULL,
  `califiacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juego`
--

INSERT INTO `juego` (`Id_Juego`, `nombre_juego`, `generos`, `califiacion`) VALUES
(5, 'FarCry 5', 'Disparos', 6),
(1, 'Jhon Warhammer', 'fdf', 4),
(4, 'Elden Ring', 'GG', 10),
(2, 'Hades', 'Rouge', 7),
(7, 'FarCry 76', 'Shooter', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidojuegos`
--

CREATE TABLE `pedidojuegos` (
  `Id_Juego` int(11) NOT NULL,
  `Id_Usario` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidojuegos`
--

INSERT INTO `pedidojuegos` (`Id_Juego`, `Id_Usario`, `id_pedido`, `cantidad`, `precio`) VALUES
(2, 2, 1, 6, 6),
(1, 4, 3, 1, 1),
(1, 2, 4, 23, 21),
(4, 2, 5, 31, 1),
(5, 2, 6, 5, 5),
(5, 2, 7, 11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `contraseña` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usario`, `nombre_usuario`, `mail`, `contraseña`) VALUES
(1, 'algo', 'titi@gmail.com', '2024-09-10'),
(2, 'Titi', 'cholo@gmail.com', '2024-09-26'),
(3, 'antonio', 'antonioi@gmail.com', '2024-09-10'),
(4, 'Mateo', 'm@gmail.com', '2024-09-15'),
(5, 'webadmin', 'algito@gmail.com', '$2y$10$xYOCAaTnEmoIFKcKlMsOFOx2vABsJlxRWGFh2FoOHUrVNhjv.q6LK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`generos`),
  ADD UNIQUE KEY `nombre_juego` (`nombre_juego`),
  ADD UNIQUE KEY `Id_Juego` (`Id_Juego`);

--
-- Indices de la tabla `pedidojuegos`
--
ALTER TABLE `pedidojuegos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `Id_Juego` (`Id_Juego`) USING BTREE,
  ADD KEY `Id_Usario` (`Id_Usario`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juego`
--
ALTER TABLE `juego`
  MODIFY `Id_Juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidojuegos`
--
ALTER TABLE `pedidojuegos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidojuegos`
--
ALTER TABLE `pedidojuegos`
  ADD CONSTRAINT `pedidojuegos_ibfk_1` FOREIGN KEY (`Id_Juego`) REFERENCES `juego` (`Id_Juego`),
  ADD CONSTRAINT `pedidojuegos_ibfk_2` FOREIGN KEY (`Id_Usario`) REFERENCES `usuario` (`Id_Usario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
