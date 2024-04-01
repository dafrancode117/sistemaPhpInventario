-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2024 a las 02:05:14
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
-- Base de datos: `sistema_inventario`
--
CREATE DATABASE IF NOT EXISTS `sistema_inventario` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `sistema_inventario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL,
  `categoriaNombre` varchar(50) NOT NULL,
  `categoriaUbicacion` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `productoId` int(11) NOT NULL,
  `productoCodigo` varchar(100) NOT NULL,
  `productoNombre` varchar(100) NOT NULL,
  `productoPrecio` decimal(30,2) NOT NULL,
  `productoStock` int(30) NOT NULL,
  `productoFoto` varchar(254) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL,
  `usuarioNombre` varchar(50) NOT NULL,
  `usuarioApellido` varchar(50) NOT NULL,
  `usuarioLogin` varchar(50) NOT NULL,
  `usuarioPassword` varchar(254) NOT NULL,
  `usuarioEmail` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `usuarioNombre`, `usuarioApellido`, `usuarioLogin`, `usuarioPassword`, `usuarioEmail`) VALUES
(1, 'Daniel Franco', 'Coila Corini', 'dafrancode', '$2y$10$rNyU8WNZI/MVQ5nYLrOxI.ajr8Nd8KRvya4HZuWIGrPhVKv2AiERq', 'frank117js@gmail.com'),
(2, 'Javier Silverio', 'Acarapi Carvajal', 'javierAcarapi', '$2y$10$hz/GDxCvZGE8SBn2XHns4.1dNsxKAzXLVggTnDmoDj8fHwKFWpEN6', 'javieracarapi@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `productoId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
