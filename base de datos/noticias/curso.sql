-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2016 a las 23:50:59
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso`
--
CREATE DATABASE IF NOT EXISTS `curso` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `curso`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `categoria` varchar(100) NOT NULL DEFAULT 'promociones',
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `texto`, `categoria`, `fecha`, `imagen`) VALUES
(1, 'Nueva promoción en Nervión', '145 viviendas de lujo en urbanización ajardinada situadas en un entorno privilegiado', 'promociones', '2007-02-04', NULL),
(2, 'Ultimas viviendas junto al rio', 'Apartamentos de 1 y 2 dormitorios, con fantásticas vistas. Excelentes condiciones de financiación.', 'ofertas', '2007-02-05', NULL),
(3, 'Apartamentos en el Puerto de Sta María', 'En la playa de Valdelagrana, en primera línea de playa. Pisos reformados y completamente amueblados.', 'costas', '2007-02-06', 'apartamento8.jpg'),
(4, 'Casa reformada en el barrio de la Judería', 'Dos plantas y ático, 5 habitaciones, patio interior, amplio garaje. Situada en una calle tranquila y a un paso del centro histórico.', 'promociones', '2004-02-07', NULL),
(5, 'Promoción en Costa Ballena', 'Con vistas al campo de golf, magníficas calidades, entorno ajardinado con piscina y servicio de vigilancia.', 'costas', '2007-02-09', 'apartamentos9.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
