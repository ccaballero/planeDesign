-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2016 a las 05:18:37
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sau3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` int(11) NOT NULL,
  `comentario` text,
  `fecha` datetime DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `publicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `idconfig` int(11) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `forgot` int(11) DEFAULT NULL,
  `smtp` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `fromname` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `messagemail` text,
  `messagechange` text,
  `renewmessage` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`idconfig`, `login`, `register`, `forgot`, `smtp`, `port`, `fromname`, `mail`, `password`, `url`, `messagemail`, `messagechange`, `renewmessage`) VALUES
(1, 1, 1, 1, 'mail.mydoamin.com', 587, 'Webmaster SAU', 'noreply@mail.com', 'desarrollo', 'http://www.mydoamin.com/', 'Hola! muchas gracias por registrarte, ahora solo debes de registrar tu cuenta usando el siguiente link', 'Has cambiado de correo electronico! usa el siguiente link para confirmar tu correo electronico', 'Has pedido recuperar tu cuenta, tu nueva contraseña es:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `idcontacts` int(11) NOT NULL,
  `contact` int(11) DEFAULT NULL,
  `fromcontact` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likepost`
--

CREATE TABLE IF NOT EXISTS `likepost` (
  `idlike` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `idmessage` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `de` int(11) DEFAULT NULL,
  `para` int(11) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `mensaje` text,
  `leido` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`idmessage`, `fecha`, `de`, `para`, `asunto`, `mensaje`, `leido`) VALUES
(2, '2016-06-14 08:43:58', 1, 1, 'Que pedo', 'xDDD', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferiences`
--

CREATE TABLE IF NOT EXISTS `preferiences` (
  `idpreference` int(11) NOT NULL,
  `theme` int(11) DEFAULT NULL,
  `lang` int(11) DEFAULT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preferiences`
--

INSERT INTO `preferiences` (`idpreference`, `theme`, `lang`, `usuario`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE IF NOT EXISTS `publicaciones` (
  `idpublicacion` int(11) NOT NULL,
  `publicacion` text,
  `fecha` datetime DEFAULT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `apellido` varchar(250) DEFAULT NULL,
  `profile` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `registro` date DEFAULT NULL,
  `permalink` varchar(250) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `ranker` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `profile`, `email`, `password`, `registro`, `permalink`, `activo`, `ranker`) VALUES
(2, 'Administrador', 'SAUv3', '1', 'admin@jhcodes.com', '58d0aff38247e1e3862a2adb46b668afe9e6433b', '2016-06-29', 'ad1c1e268f', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verify`
--

CREATE TABLE IF NOT EXISTS `verify` (
  `idactive` int(11) NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `verify`
--

INSERT INTO `verify` (`idactive`, `token`, `email`, `fecha`) VALUES
(1, '03669190632308f2d9cfc572d79e5f6d671cf20b', 'admin@jhcodes.com', '2016-06-29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentario`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`idconfig`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`idcontacts`);

--
-- Indices de la tabla `likepost`
--
ALTER TABLE `likepost`
  ADD PRIMARY KEY (`idlike`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idmessage`);

--
-- Indices de la tabla `preferiences`
--
ALTER TABLE `preferiences`
  ADD PRIMARY KEY (`idpreference`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idpublicacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`idactive`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `idconfig` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `idcontacts` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `likepost`
--
ALTER TABLE `likepost`
  MODIFY `idlike` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `preferiences`
--
ALTER TABLE `preferiences`
  MODIFY `idpreference` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idpublicacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `verify`
--
ALTER TABLE `verify`
  MODIFY `idactive` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
