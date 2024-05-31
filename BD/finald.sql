-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2024 a las 23:30:00
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
-- Base de datos: `finald`
--
CREATE DATABASE IF NOT EXISTS `finald` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `finald`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `id_Usuari` int(11) NOT NULL,
  `titol` varchar(40) NOT NULL,
  `missatge` varchar(250) NOT NULL,
  `img` varchar(50) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `id_Usuari`, `titol`, `missatge`, `img`, `data`) VALUES
(45, 4, 'Prova1', 'aquesta és la prova 1\r\n', '', '2024-05-29'),
(46, 4, 'Article2', 'article 2', '', '2024-05-30'),
(47, 5, 'D&D', 'Reclutament per jugar ', '', '2024-05-31'),
(48, 5, 'Mantenir-se amb vida', 'Recordeu que es importat mantenir-se amb vida', '', '2024-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_Personaje` int(11) NOT NULL,
  `nom_Objeto` varchar(20) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `categoria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_Personaje`, `nom_Objeto`, `descripcion`, `cantidad`, `categoria`) VALUES
(1, 82, 'qwe', 'dwq', 1, 'arma'),
(3, 82, 'Cota ', '', 1, 'armadura'),
(4, 82, 'espasa', 'haha', 1, 'arma'),
(5, 83, 'daga', 'tira la daga', 1, 'arma'),
(6, 83, 'daga', 'tira la daga', 1, 'arma'),
(9, 83, 'qwe', '123', 1, 'armadura'),
(10, 83, 'eee', 'ee', 1, 'arma'),
(12, 83, 'ytrewq', 'qwertyytrewq', 1, 'arma'),
(14, 83, 'pera', 'comida', 1, 'pocio'),
(15, 83, 'baston', 'comida', 1, 'arma'),
(16, 82, 'peto de malla', '', 1, 'armadura'),
(28, 82, 'Mana', '', 1, 'pocio'),
(29, 82, 'Maraña', '', 2, 'pocio'),
(34, 82, 'Veneno', 'Et resta 10 de vida', 1, 'pocio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

DROP TABLE IF EXISTS `mapas`;
CREATE TABLE `mapas` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `nom_mapa` text NOT NULL,
  `titol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `id_usuari`, `nom_mapa`, `titol`) VALUES
(62, 4, 'mazmorra', '6659df690a7ebm'),
(63, 5, 'mazmorra', '6659df690a7ebm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personatges`
--

DROP TABLE IF EXISTS `personatges`;
CREATE TABLE `personatges` (
  `id` int(11) NOT NULL,
  `id_Usuari` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `raza` text NOT NULL,
  `clase` varchar(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `Vida` int(11) NOT NULL,
  `Iniciativa` int(11) NOT NULL,
  `Fuerza` int(11) NOT NULL,
  `Destreza` int(11) NOT NULL,
  `Constitucion` int(11) NOT NULL,
  `Inteligencia` int(11) NOT NULL,
  `Sabiduria` int(11) NOT NULL,
  `Carisma` int(11) NOT NULL,
  `Img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personatges`
--

INSERT INTO `personatges` (`id`, `id_Usuari`, `nom`, `raza`, `clase`, `nivel`, `Vida`, `Iniciativa`, `Fuerza`, `Destreza`, `Constitucion`, `Inteligencia`, `Sabiduria`, `Carisma`, `Img`) VALUES
(81, 4, 'Experimento0', 'Elf', 'Guerrer', 3, 121, 5, 5, 5, 5, 3, 5, 5, '664cbf0275f122a53cc1fcfab1a930753da45b4e74526c9876223_full.jpg'),
(82, 5, 'EEWW', 'Elf', 'Arquer', 2, 6, 5, 6, 5, 6, 5, 5, 3, '664cc58d27ca7ñojo.jpg'),
(84, 4, 'Prova', 'Elf', 'Guerrer', 1, 110, 5, 5, 5, 5, 3, 5, 5, '664f8f7e9062f2a53cc1fcfab1a930753da45b4e74526c9876223_full.jpg'),
(87, 4, 'jesus', 'Humà', 'Assassí', 0, 5, 5, 5, 5, 5, 5, 5, 5, '665760c49689d2a53cc1fcfab1a930753da45b4e74526c9876223_full.jpg'),
(88, 5, 'AO', 'Humà', 'Guerrer', 0, 199, 15, 5, 5, 15, 5, 5, 5, '665a2aa22b765Captura_de_pantalla_2024-03-17_132056.png'),
(89, 5, 'ROQUEFORT', 'Orc', 'Guerrer', 0, 123, 15, 5, 5, 5, 5, 5, 5, '665a2aea292c82a53cc1fcfab1a930753da45b4e74526c9876223_full.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

DROP TABLE IF EXISTS `salas`;
CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `Codi_sala` varchar(6) NOT NULL,
  `ID_Admin` int(11) NOT NULL,
  `Usuaris_Conectats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `Codi_sala`, `ID_Admin`, `Usuaris_Conectats`) VALUES
(266, '203568', 15, 0),
(355, '876376', 7, 0),
(369, '651986', 17, 0),
(466, '464711', 14, 0),
(595, '943465', 20, 0),
(601, '966215', 9, 0),
(767, '796047', 22, 0),
(1126, '435488', 13, 0),
(1146, '534057', 5, 0),
(1149, '112524', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiracio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `email`, `Password`, `token`, `expiracio`) VALUES
(4, 'sergi', 'sergi@gmail.com', '$2y$10$qnmxB8I8Gu5iinaBz1kFt.OMRn4YdZDJP4Wd7asfVoODW7n45Dw.C', '', NULL),
(5, 'Pere', 'perepi@gmail.com', '$2y$10$Es1iTMkE14H7BsR0L8T5jetNUMucrzDua.DuDfD8XOJZXLlYdnCVG', '', NULL),
(7, 'Corescan', 'Corescan620@gmail.com', '$2y$10$eZMGFg4OdfzG6CcdOQhSOuQHXTzkGuZzTSIfO7RoXlfmf52xYmUMe', '', NULL),
(8, 'ASTOLFO', 'astolfo_theRealOne@gmail.com', '$2y$10$48/Dy9Pbu/0wBSj17RC9fecaNBXajxJVthNMdQe1OlBqVVqbhlruW', '', NULL),
(9, 'root', 'root@root.es', '$2y$10$pIxwbURA/3UO3G8uuz2Ov.6cvCO6aM73s.jeK2Hc4puSdgWc22e5K', '', NULL),
(10, 'Biel', 'bielmailerphp@gmail.com', '$2y$10$Roep3DWRyXCP6PfbQVlmAu2XxIuylDr/eOTE5qzR6IZQb1eT11TYu', '', NULL),
(14, 'Astolfo2', 'astolfo2@gmail.com', '$2y$10$y/vwF.LkNYhh52/wzQubuecgEheazw8bYyUjsEA.MetGT62RmRSVG', '', NULL),
(15, 'buiby', 'buiby@gmail.com', '$2y$10$l8YwaNB8qVW1LTvDgwVH.eb/Is.2lAZYrrgO5pUCK4GgeoZfd.L8a', '', NULL),
(16, 'php', 'php@email.com', '$2y$10$0lELnbWkNw8rUb2.pwYzduy8LjJCzbqboMWnnDEMuSFmHBgzSljrW', '', NULL),
(17, 'martinh118', 'martinjaime118@gmail.com', '$2y$10$wE/zzFnYmEMCa8eiEXrYYOn8yEmiDX.I7v7NxQgHQGvGar4Yy11MC', '', NULL),
(18, '123', '123@gmail.com', '$2y$10$oemWPeTNwglHiGBwLDSxZOBMTo9ykhh57LwMbTeSpTIoVD1dLpWJq', '', NULL),
(19, 'vuybasd', 'php@gmail.com', '$2y$10$krOweDWlg0U7Zyxs/w6zSOPPwv1/YxRWiJaRT0WqBj90bh5TqM71q', '', NULL),
(20, 'soygay', 'theforgottennine9x9@gmail.com', '$2y$10$aSxsceRNYeCR8.vFW4t66ePbcSRpleC5XZImwAV/luB/vF07C0ni6', '', NULL),
(21, 'e.rubio', 'e.rubio@sapalomera.com', '$2y$10$048MSxdfS5ahbCmFYhfnmeSm8QnlEQp46WFLQ/8J/XxGFvQAgB7Ci', '', NULL),
(22, 'hada', 'hada@gmail.com', '$2y$10$bs0toDbQMVur7qu5ue3oMeoE4gWCyfji7gwjGULymNZREeOO094nu', '', NULL),
(26, 'pedro', 'pedro@gmail.com', '$2y$10$CmE6XdL7hGO7wbIkHR5kfuxlxyFkiv.uTYqPy/3WS4AtGjTNB4DFS', '', NULL),
(27, 'sergi', 'sergisato70@gmail.com', '$2y$10$pH3UQjAdB4wKdn28v215q.KAI.CUs70U3yj17XX1T1lLORmSydRxy', 'e9d6dd6f816107095e0ee8d10bbbe2a7', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personatges`
--
ALTER TABLE `personatges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `personatges`
--
ALTER TABLE `personatges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1150;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
