-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2013 a las 04:21:00
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `trueque`
--
CREATE DATABASE `trueque` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trueque`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `nombre`) VALUES
(1, 'Cine'),
(2, 'Electrodomesticos'),
(3, 'Videojuegos'),
(4, 'Vehiculos'),
(5, 'Musica'),
(6, 'Antiguedades'),
(7, 'Deportes'),
(8, 'Libros'),
(9, 'Camaras'),
(10, 'Celulares'),
(11, 'Computadores'),
(12, 'Joyas'),
(13, 'Casas'),
(14, 'Juguetes'),
(15, 'Licores'),
(16, 'Otras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidad`
--

CREATE TABLE IF NOT EXISTS `cuidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Volcado de datos para la tabla `cuidad`
--

INSERT INTO `cuidad` (`id`, `nombre`) VALUES
(1, 'Popayan'),
(2, 'Cali'),
(3, 'Aguachica Cesar'),
(4, 'Apartadó Antioquia'),
(5, 'Arauca'),
(6, 'Armenia Quindío'),
(7, ' Barrancabermeja '),
(8, 'Barranquilla'),
(9, 'Bello Antioquia'),
(10, 'Bogotá '),
(11, 'Bucaramanga '),
(12, 'Buenaventura '),
(13, 'Buga '),
(14, 'Cali '),
(15, 'Cartago '),
(16, 'Cartagena Bolívar'),
(17, ' Caucasia Antioquia'),
(18, ' Cereté Córdoba'),
(19, 'Chia Cundinamarca'),
(20, 'Ciénaga '),
(21, 'Chia Cundinamarca'),
(22, 'Ciénaga Magdalena'),
(23, 'Cúcuta Norte '),
(24, 'Dosquebradas '),
(25, 'Duitama Boyacá'),
(26, 'Envigado Antioquia'),
(27, 'Facatativá '),
(28, 'Florencia Caqueta'),
(29, 'Floridablanca '),
(30, 'Fusagasugá '),
(31, 'Girardot'),
(32, 'Girón Santander'),
(33, 'Ibagué Tolima'),
(34, 'Ipiales Nariño'),
(35, 'Itagüí Antioquia'),
(36, 'Jamundí '),
(37, 'Lorica Córdoba'),
(38, 'Los Patios '),
(39, 'Magangué Bolivar'),
(40, 'Maicao Guajira'),
(41, 'Malambo Atlántico'),
(42, 'Manizales Caldas'),
(43, 'Medellín Antioquia'),
(44, 'Melgar Tolima'),
(45, 'Montería Córdoba'),
(46, 'Neiva Huila'),
(47, 'Ocaña Santander'),
(48, ' Paipa, Boyacá'),
(49, 'Palmira '),
(50, 'Pamplona '),
(51, 'Pasto Nariño'),
(52, 'Pereira Risaralda'),
(53, 'Piedecuesta '),
(54, 'Pitalito Huila'),
(55, 'Popayán Cauca'),
(56, 'Quibdó Choco'),
(57, 'Riohacha Guajira'),
(58, 'Rionegro'),
(59, 'Sabanalarga'),
(60, 'Sahagún Córdoba'),
(61, 'San Andrés Isla'),
(62, 'Santa Marta'),
(63, 'Sincelejo Sucre'),
(64, 'Soacha '),
(65, 'Sogamoso'),
(66, 'Soledad Atlántico'),
(67, 'Tibú '),
(68, 'Tuluá '),
(69, 'Tumaco Nariño'),
(70, 'Tunja Boyacá'),
(71, 'Turbo Antioquia'),
(72, ' Valledupar Cesar'),
(73, 'Villa de leyva'),
(74, 'Villa del Rosario'),
(75, 'Villavicencio Meta'),
(76, 'Yopal Casanare'),
(77, 'Yumbo '),
(78, 'Zipaquirá ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permuta`
--

CREATE TABLE IF NOT EXISTS `permuta` (
  `producto_recibe` int(20) NOT NULL,
  `producto_solicita` int(20) NOT NULL,
  `fechapermuta` date NOT NULL DEFAULT '0000-00-00',
  KEY `fk_producto_solicita` (`producto_solicita`),
  KEY `fk_producto_recibe` (`producto_recibe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permuta`
--

INSERT INTO `permuta` (`producto_recibe`, `producto_solicita`, `fechapermuta`) VALUES
(37, 37, '2013-06-04'),
(40, 37, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `producto_id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL DEFAULT 'http://localhost/trueque_10/images/default.jpg',
  `fechaingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(20) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `nombre` (`nombre`),
  KEY `fk_usuario_producto` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `nombre`, `descripcion`, `categoria_id`, `imagen`, `fechaingreso`, `usuario_id`) VALUES
(37, '1', '1', 16, 'http://localhost/trueque_10//images/default1.jpg', '2013-06-04 05:00:00', 6),
(38, '2', '2', 16, 'http://localhost/trueque_10//images/default2.jpg', '2013-06-04 05:00:00', 6),
(39, '3', '3', 16, 'http://localhost/trueque_10//images/default3.jpg', '2013-06-04 05:00:00', 6),
(40, '4', '4', 16, 'http://localhost/trueque_10//images/default4.jpg', '2013-06-04 05:00:00', 6),
(41, '5', '5', 1, 'http://localhost/trueque_10//images/default5.jpg', '2013-06-04 05:00:00', 6),
(42, '6', '6', 2, 'http://localhost/trueque_10//images/default6.jpg', '2013-06-04 05:00:00', 6),
(43, '7', '7', 2, 'http://localhost/trueque_10//images/default7.jpg', '2013-06-04 05:00:00', 6),
(44, '8', '8', 2, 'http://localhost/trueque_10//images/default8.jpg', '2013-06-04 05:00:00', 6),
(45, '9', '9', 2, 'http://localhost/trueque_10//images/default9.jpg', '2013-06-04 05:00:00', 6),
(46, '10', '10', 2, 'http://localhost/trueque_10//images/default10.jpg', '2013-06-04 05:00:00', 6),
(47, '11', '11', 2, 'http://localhost/trueque_10//images/default11.jpg', '2013-06-04 05:00:00', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE IF NOT EXISTS `telefono` (
  `telefono_id` int(20) NOT NULL AUTO_INCREMENT,
  `telefono` int(20) NOT NULL,
  `usuario_id` int(20) NOT NULL,
  PRIMARY KEY (`telefono_id`),
  KEY `fk_usuario_telefono` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '1',
  `id_ciudad` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellido`, `email`, `contrasena`, `nivel`, `id_ciudad`) VALUES
(1, 'wilian', 'pantoja', 'wf', '12', 1, 0),
(2, 'Kelly', 'Zuniga', 'yohannazg@hotmail.com', '123', 1, 1),
(3, 'jess', 'gamboa', 'yygamboa@gmail.com', '6a336772f9af64a44a0559dd7f9dfc0551542c47', 1, 0),
(4, 'andres', 'castillo', 'acastillo119@gmail.com', '6a336772f9af64a44a0559dd7f9dfc0551542c47', 0, 58),
(5, 'Aelxis', 'Ruano', 'williamruano@unicauca.edu.co', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 0),
(6, 'Alexis', 'Ruano', 'waruano9212@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0),
(7, 'Alexis', 'Ruano', 'waruano@hotmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0),
(8, 'jess', 'adrada', 'jess@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0),
(9, 'jess', 'adrada', 'jess1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0),
(10, 'Jennifer', 'Erazo', 'jendaerma@hotmail.com', 'be721facfe42aed047e2b3c19aad1539389df71e', 0, 0),
(12, 'usuario', 'de prueba', 'deprueba@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0),
(13, 'usuario', 'de prueba', 'deprueba2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permuta`
--
ALTER TABLE `permuta`
  ADD CONSTRAINT `fk_producto_recibe` FOREIGN KEY (`producto_recibe`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `fk_producto_solicita` FOREIGN KEY (`producto_solicita`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `fk_sol_rec` FOREIGN KEY (`producto_solicita`) REFERENCES `producto` (`producto_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_usuario_producto` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk_usuario_telefono` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
