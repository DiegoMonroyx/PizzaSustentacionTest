-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2025 a las 03:49:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzapaisa3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `idIngrediente` varchar(30) NOT NULL,
  `Descripcion` varchar(40) NOT NULL,
  `Existenciaskg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`idIngrediente`, `Descripcion`, `Existenciaskg`) VALUES
('Act', 'Aceitunas', 39.3),
('Cbll', 'Cebolla', 10.775),
('Cdr', 'Carne de Res', 92.65),
('Chpm', 'Champinones', 14.6),
('Chz', 'Chorizo', 7.3),
('Cra', 'Cereza Almibar', 5),
('Drl', 'Duraznos Almibar', 5),
('jlp', 'Jalapenos', 4.575),
('Jm', 'Jamon', 9),
('Mng', 'Mango', 5),
('Ms', 'Masa', 12.375),
('Mz', 'Maiz', 5),
('Pll', 'Pollo', 8.5),
('Plt', 'Platano', 5),
('Pmto', 'Pimiento', 19.7875),
('Pna', 'Pina', 5),
('Pprn', 'Pepperoni', 10.5),
('Pst', 'Pasta de Tomate', 7.15),
('Qs', 'Queso', 15.15),
('sBBQ', 'Salsa BBQ', 36),
('Slch', 'Salchicha', 4.625),
('Tcn', 'Tocino', 5),
('Uvp', 'Uvas Pasas', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `idSabor` varchar(20) NOT NULL,
  `idPedido` int(6) NOT NULL,
  `NumeroPorciones` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idSabor`, `idPedido`, `NumeroPorciones`) VALUES
('Crt', 1, 1),
('PcBBQ', 2, 1),
('Pmx', 2, 1),
('Pllc', 3, 2),
('Pps', 4, 1),
('PcBBQ', 5, 1),
('Prh', 5, 1),
('Crt', 6, 1),
('PcBBQ', 6, 1),
('Pps', 6, 1),
('Phw', 7, 1),
('Pmx', 8, 1),
('Pmt', 8, 1),
('Phw', 8, 2),
('Phw', 8, 2),
('PcBBQ', 8, 3),
('Crt', 8, 2),
('Crt', 15, 1),
('Phw', 15, 2),
('Pllc', 15, 2),
('Phw', 15, 2),
('Phw', 17, 4),
('Phw', 18, 4),
('Phw', 19, 10),
('Phw', 20, 11),
('Phw', 21, 5),
('Phw', 22, 3),
('Crt', 23, 2),
('Phw', 24, 2),
('Pllc', 24, 1),
('PcBBQ', 31, 1),
('Phw', 31, 5),
('Pm', 31, 3),
('Phw', 32, 5),
('PcBBQ', 32, 1),
('Pm', 32, 3),
('Pmx', 33, 2),
('Pm', 33, 3),
('Phw', 34, 15),
('Phw', 35, 7),
('PcBBQ', 36, 20),
('Phw', 36, 1),
('PcBBQ', 37, 3),
('Pm', 37, 2),
('Phw', 38, 1),
('Pllc', 38, 2),
('Pllc', 38, 1),
('Crt', 39, 10),
('Pllc', 40, 10),
('Pmx', 41, 10),
('Pmx', 42, 2),
('Pmx', 43, 5);

--
-- Disparadores `linea`
--
DELIMITER $$
CREATE TRIGGER `ingrediente` AFTER INSERT ON `linea` FOR EACH ROW update ingrediente, (select * from saboringrediente where idSabor = (select idSabor from linea order by idPedido desc limit 1)) as  Nuevo, (select * from linea order by idPedido desc limit 1) as linea set ingrediente.Existenciaskg = ingrediente.Existenciaskg - (Nuevo.Cantidadkg * linea.NumeroPorciones) where ingrediente.idIngrediente =Nuevo.idIngrediente
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordendecompra`
--

CREATE TABLE `ordendecompra` (
  `idOrden` int(5) NOT NULL,
  `UsuarioDocumento` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordendecompra`
--

INSERT INTO `ordendecompra` (`idOrden`, `UsuarioDocumento`, `created_at`, `updated_at`) VALUES
(3, '987654321', '2025-03-28 20:02:51', '2025-03-28 20:02:51'),
(4, '987654321', '2025-03-28 20:02:51', '2025-03-28 20:02:51'),
(5, '5566778899', '2025-03-28 20:02:51', '2025-03-28 20:02:51'),
(6, '987654321', '2025-03-28 20:02:51', '2025-03-28 20:02:51'),
(7, '5566778899', '2025-03-28 20:02:51', '2025-03-28 20:02:51'),
(8, '1124217751', '2025-03-28 20:27:39', '2025-03-29 01:27:39'),
(9, '1124217751', '2025-03-28 20:53:56', '2025-03-29 01:53:56'),
(10, '1124217751', '2025-04-01 20:51:45', '2025-04-02 01:51:45'),
(11, '1124217751', '2025-04-01 21:46:33', '2025-04-02 02:46:33'),
(12, '1124217751', '2025-04-01 22:14:12', '2025-04-02 03:14:12'),
(13, '1124217751', '2025-04-01 22:15:38', '2025-04-02 03:15:38'),
(14, '1124217751', '2025-04-01 22:23:13', '2025-04-02 03:23:13'),
(15, '1124217751', '2025-04-01 22:25:15', '2025-04-02 03:25:15'),
(16, '1124217751', '2025-04-02 19:14:20', '2025-04-03 00:14:20'),
(17, '1124217751', '2025-04-02 19:32:26', '2025-04-03 00:32:26'),
(18, '1124217751', '2025-04-02 19:33:16', '2025-04-03 00:33:16'),
(19, '1124217751', '2025-04-02 19:36:18', '2025-04-03 00:36:18'),
(20, '1124217751', '2025-04-02 19:53:08', '2025-04-03 00:53:08'),
(21, '1124217751', '2025-04-02 20:07:50', '2025-04-03 01:07:50'),
(22, '1124217751', '2025-04-02 20:07:59', '2025-04-03 01:07:59'),
(23, '1124217751', '2025-04-02 20:08:10', '2025-04-03 01:08:10'),
(24, '1124217751', '2025-04-02 20:14:31', '2025-04-03 01:14:31'),
(25, '1124217751', '2025-04-02 20:14:42', '2025-04-03 01:14:42'),
(26, '1124217751', '2025-04-02 20:14:53', '2025-04-03 01:14:53'),
(27, '1124217751', '2025-04-02 20:19:18', '2025-04-03 01:19:18'),
(28, '1124217751', '2025-04-02 20:25:30', '2025-04-03 01:25:30'),
(29, '1124217751', '2025-04-02 20:30:52', '2025-04-03 01:30:52'),
(30, '1124217751', '2025-04-02 20:37:51', '2025-04-03 01:37:51'),
(31, '1124217751', '2025-04-02 20:38:42', '2025-04-03 01:38:42'),
(32, '1124217751', '2025-04-02 20:39:19', '2025-04-03 01:39:19'),
(33, '1124217751', '2025-04-02 20:43:25', '2025-04-03 01:43:25'),
(34, '1124217751', '2025-04-02 20:47:25', '2025-04-03 01:47:25'),
(35, '1124217751', '2025-04-02 20:57:46', '2025-04-03 01:57:46'),
(36, '1124217751', '2025-04-02 21:54:41', '2025-04-03 02:54:41'),
(37, '1124217751', '2025-04-02 21:58:20', '2025-04-03 02:58:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordeningrediente`
--

CREATE TABLE `ordeningrediente` (
  `idOrden` int(5) NOT NULL,
  `idIngrediente` varchar(30) NOT NULL,
  `CantidadSolicitada` float NOT NULL,
  `idProveedor` int(6) NOT NULL,
  `CantidadComprada` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordeningrediente`
--

INSERT INTO `ordeningrediente` (`idOrden`, `idIngrediente`, `CantidadSolicitada`, `idProveedor`, `CantidadComprada`) VALUES
(3, 'Act', 5, 1, 5),
(3, 'Cbll', 5, 1, 5),
(3, 'Cdr', 5, 1, 5),
(3, 'Chpm', 5, 1, 5),
(3, 'Chz', 5, 1, 5),
(3, 'Cra', 5, 1, 5),
(3, 'Drl', 5, 1, 5),
(3, 'jlp', 5, 1, 5),
(3, 'Jm', 5, 1, 5),
(3, 'Mng', 5, 1, 5),
(3, 'Ms', 5, 1, 5),
(3, 'Mz', 5, 1, 5),
(4, 'Pll', 5, 2, 5),
(4, 'Plt', 5, 2, 5),
(4, 'Pmto', 5, 2, 5),
(4, 'Pna', 5, 2, 5),
(4, 'Pprn', 5, 2, 5),
(4, 'Pst', 5, 2, 5),
(4, 'Qs', 5, 2, 5),
(4, 'sBBQ', 5, 2, 5),
(4, 'Slch', 5, 2, 5),
(4, 'Tcn', 5, 2, 5),
(4, 'Uvp', 5, 2, 5),
(5, 'Qs', 6, 3, 6),
(5, 'Ms', 8, 3, 8),
(5, 'Cdr', 4, 3, 4),
(5, 'Pprn', 6, 3, 6),
(6, 'Qs', 6, 1, 6),
(6, 'Ms', 4, 1, 4),
(6, 'Pst', 4, 1, 4),
(6, 'sBBQ', 8, 1, 8),
(7, 'Chpm', 7, 2, 7),
(7, 'Pll', 4, 2, 4),
(7, 'Jm', 4, 2, 4),
(7, 'sBBQ', 3, 2, 3),
(7, 'sBBQ', 20, 2, 20),
(7, 'cdr', 5, 2, 5),
(4, 'cdr', 10, 2, 10),
(4, 'Cdr', 10, 2, 10),
(4, 'Cdr', 10, 2, 15),
(4, 'Pmto', 10, 2, 15),
(8, 'Act', 0, 1, 3.4),
(9, 'Act', 0, 1, 3.4),
(29, 'Act', 0, 1, 5),
(33, 'Act', 0, 1, 20),
(34, 'Act', 0, 1, 2.5),
(34, 'Cbll', 0, 1, 3),
(35, 'Chz', 0, 1, 2.3),
(35, 'Chpm', 0, 1, 3.1),
(36, 'Cbll', 0, 1, 3.2),
(37, 'Cdr', 0, 1, 45);

--
-- Disparadores `ordeningrediente`
--
DELIMITER $$
CREATE TRIGGER `ingrediente_suma` AFTER INSERT ON `ordeningrediente` FOR EACH ROW update ingrediente i set Existenciaskg =(select SUM(oi.CantidadComprada) from ordeningrediente oi where i.idIngrediente = oi.idIngrediente) where idIngrediente = idIngrediente
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(6) NOT NULL,
  `NombreProveedor` varchar(40) NOT NULL,
  `NumeroTelefono` varchar(11) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `Barrio` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `NombreProveedor`, `NumeroTelefono`, `direccion`, `Barrio`) VALUES
(1, 'Lichigo el Mono', '456321', 'kr13 sur k', 'Perdomo'),
(2, 'Lichi la mona', '458541', 'kr18-nort-c', 'Candelaria'),
(3, 'FurvePaisita', '478541', 'kr8-tv-73', 'Madelena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idPedido` int(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `Entregada` tinyint(1) NOT NULL,
  `FechaHoraEntrega` datetime NOT NULL,
  `PrecioTotal` int(20) NOT NULL,
  `UsuarioDocumento` varchar(12) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idPedido`, `created_at`, `Entregada`, `FechaHoraEntrega`, `PrecioTotal`, `UsuarioDocumento`, `updated_at`) VALUES
(1, '2024-07-25 03:47:00', 0, '2024-07-25 04:14:00', 0, '1122334455', NULL),
(2, '2024-07-25 04:40:00', 0, '2024-07-25 05:10:00', 0, '123456789', NULL),
(3, '2024-07-25 05:10:10', 0, '2024-07-25 05:40:15', 0, '4512754', NULL),
(4, '2024-07-25 06:00:00', 0, '2024-07-25 06:30:00', 0, '2233445566', NULL),
(5, '2024-07-25 06:10:00', 0, '2024-07-25 06:40:00', 0, '3344556677', NULL),
(6, '2024-07-25 06:25:00', 0, '2024-07-25 06:55:00', 0, '4455667788', NULL),
(7, '2024-07-25 07:00:00', 0, '2024-07-25 07:30:00', 0, '5566778890', NULL),
(8, '2024-07-25 07:40:00', 0, '2024-07-25 08:10:00', 0, '6677889901', NULL),
(9, '2024-07-30 07:00:00', 0, '2024-07-30 07:27:10', 0, '6677889901', NULL),
(10, '2024-07-30 08:52:00', 0, '2024-07-30 09:21:15', 0, '6677889901', NULL),
(12, '2024-10-08 15:24:00', 0, '2024-10-09 15:24:00', 0, '123456789', NULL),
(15, '2024-12-04 14:30:00', 0, '2024-12-04 15:30:00', 0, '6677889901', NULL),
(16, '2024-12-08 23:05:30', 0, '2024-07-25 04:14:00', 0, '1122334455', '2024-12-08 23:05:30'),
(17, '2024-12-08 23:09:30', 0, '2024-12-09 20:09:00', 52000, '1124217751', '2024-12-08 23:09:30'),
(18, '2024-12-08 23:13:28', 0, '2024-12-09 20:09:00', 52000, '1124217751', '2024-12-08 23:13:28'),
(19, '2024-12-09 19:44:49', 0, '2024-12-09 17:45:00', 130000, '1124217751', '2024-12-09 19:44:49'),
(20, '2024-12-09 19:46:07', 0, '2024-12-10 17:45:00', 143000, '1124217751', '2024-12-09 19:46:07'),
(21, '2024-12-09 21:45:23', 0, '2024-12-10 19:48:00', 70000, '1124217751', '2024-12-09 21:45:23'),
(22, '2024-12-10 19:46:08', 0, '2024-12-10 19:50:00', 70000, '1124217751', '2024-12-10 19:46:08'),
(23, '2025-02-26 22:04:03', 0, '2025-02-12 19:05:00', 28000, '1124217751', '2025-02-26 22:04:03'),
(24, '2025-03-17 19:22:35', 0, '2025-03-18 18:24:00', 42000, '1124217751', '2025-03-17 19:22:35'),
(25, '2025-03-21 22:55:23', 0, '2025-03-21 06:14:00', 28000, '1124217754', '2025-03-21 22:55:23'),
(26, '2025-03-21 18:05:14', 0, '2025-03-21 06:14:00', 28000, '1122334459', '2025-03-21 23:05:14'),
(27, '2025-03-21 18:34:54', 0, '2025-03-22 03:00:00', 112, '1124217754', '2025-03-21 23:34:54'),
(28, '2025-03-21 19:19:20', 0, '2025-03-22 18:30:00', 140000, '1124217751', '2025-03-22 00:19:20'),
(29, '2025-03-21 19:21:29', 0, '2025-03-22 18:00:00', 42000, '1124217751', '2025-03-22 00:21:29'),
(30, '2025-03-22 16:35:54', 0, '2025-03-22 18:30:00', 56000, '1124217752', '2025-03-22 21:35:54'),
(31, '2025-03-22 17:30:29', 0, '2025-03-23 20:30:00', 126000, '1124217752', '2025-03-22 22:30:29'),
(32, '2025-03-22 17:31:25', 0, '2025-03-23 20:30:00', 126000, '1124217752', '2025-03-22 22:31:25'),
(33, '2025-03-22 22:17:55', 1, '2025-03-23 16:30:00', 70000, '1124217752', '2025-03-26 20:47:16'),
(34, '2025-03-22 22:47:30', 1, '2025-03-23 20:30:00', 210000, '1124217751', '2025-03-26 20:44:40'),
(35, '2025-03-23 19:07:22', 1, '2025-03-24 17:30:00', 98000, '1124217751', '2025-03-26 20:53:06'),
(36, '2025-03-25 14:37:12', 1, '2025-03-25 18:30:00', 294000, '1124217751', '2025-03-26 20:44:35'),
(37, '2025-03-26 16:36:49', 1, '2025-03-26 18:30:00', 70000, '1122334469', '2025-03-26 21:39:24'),
(38, '2025-03-26 17:13:06', 1, '2025-03-26 06:00:00', 42000, '1122334469', '2025-03-27 20:47:52'),
(39, '2025-04-21 17:18:11', 0, '2025-04-25 17:30:00', 140000, '33343334343', '2025-04-21 22:18:11'),
(40, '2025-04-21 17:21:45', 0, '2025-04-26 18:00:00', 140000, '33343334343', '2025-04-21 22:21:45'),
(41, '2025-04-21 17:22:39', 0, '2025-04-27 18:00:00', 140000, '33343334343', '2025-04-21 22:22:39'),
(42, '2025-04-21 20:40:14', 0, '2025-04-26 21:30:00', 14000, '33343334343', '2025-04-22 01:40:14'),
(43, '2025-04-21 20:41:51', 0, '2025-04-27 21:30:00', 70000, '33343334343', '2025-04-22 01:41:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabor`
--

CREATE TABLE `sabor` (
  `idSabor` varchar(20) NOT NULL,
  `Nombre_Pizza` varchar(40) NOT NULL,
  `Precio_Porcion` smallint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabor`
--

INSERT INTO `sabor` (`idSabor`, `Nombre_Pizza`, `Precio_Porcion`) VALUES
('Crt', 'Pizza Carne Tradicional', 14000),
('PcBBQ', 'Pizza de CarneBBQ', 14000),
('Phw', 'Pizza Hawaiana', 14000),
('Pllc', 'Pollo Champi?ones', 14000),
('Pm', 'Pizza de Maduro', 14000),
('Pmt', 'Pizaa MangoTocineta', 14000),
('Pmx', 'Pizza Mexicana', 14000),
('Pps', 'Pizza Paisa', 14000),
('Prh', 'Pizza Ranchera', 14000),
('Ptrp', 'Pizza Tropical', 14000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saboringrediente`
--

CREATE TABLE `saboringrediente` (
  `idSabor` varchar(20) NOT NULL,
  `idIngrediente` varchar(30) NOT NULL,
  `Cantidadkg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `saboringrediente`
--

INSERT INTO `saboringrediente` (`idSabor`, `idIngrediente`, `Cantidadkg`) VALUES
('Crt', 'Ms', 0.125),
('Crt', 'Pprn', 0.05),
('Crt', 'Cdr', 0.05),
('Crt', 'Pst', 0.05),
('Crt', 'Qs', 0.05),
('Crt', 'Slch', 0.0375),
('PcBBQ', 'Ms', 0.125),
('PcBBQ', 'Pprn', 0.05),
('PcBBQ', 'Cdr', 0.05),
('PcBBQ', 'Pst', 0.05),
('PcBBQ', 'Qs', 0.05),
('PcBBQ', 'sBBQ', 0.05),
('PcBBQ', 'Pmto', 0.025),
('Phw', 'Ms', 0.125),
('Phw', 'Jm', 0.0375),
('Phw', 'Pst', 0.05),
('Phw', 'Qs', 0.05),
('Phw', 'Pna', 0.0375),
('Pllc', 'Ms', 0.125),
('Pllc', 'Pll', 0.05),
('Pllc', 'Chpm', 0.05),
('Pllc', 'Pst', 0.05),
('Pllc', 'Qs', 0.05),
('Pm', 'Ms', 0.125),
('Pm', 'Cdr', 0.05),
('Pm', 'Plt', 0.05),
('Pm', 'Pst', 0.05),
('Pm', 'Qs', 0.05),
('Pmt', 'Ms', 0.125),
('Pmt', 'Mng', 0.0375),
('Pmt', 'Pst', 0.05),
('Pmt', 'Qs', 0.05),
('Pmt', 'Tcn', 0.0375),
('Pmx', 'Ms', 0.125),
('Pmx', 'Cdr', 0.05),
('Pmx', 'Pst', 0.05),
('Pmx', 'Qs', 0.05),
('Pmx', 'jlp', 0.025),
('Pmx', 'Pmto', 0.0125),
('Pmx', 'Cbll', 0.025),
('Pps', 'Ms', 0.125),
('Pps', 'Tcn', 0.0375),
('Pps', 'Pst', 0.05),
('Pps', 'Qs', 0.05),
('Pps', 'Cbll', 0.0375),
('Pps', 'Chz', 0.0375),
('Pps', 'Mz', 0.0375),
('Prh', 'Ms', 0.125),
('Prh', 'Cdr', 0.05),
('Prh', 'Pst', 0.05),
('Prh', 'Qs', 0.05),
('Prh', 'jlp', 0.025),
('Ptrp', 'Ms', 0.125),
('Ptrp', 'Uvp', 0.025),
('Ptrp', 'Pst', 0.05),
('Ptrp', 'Qs', 0.05),
('Ptrp', 'Pna', 0.0375),
('Ptrp', 'Drl', 0.025),
('Ptrp', 'Cra', 0.025);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idTipoDocumento` int(6) NOT NULL,
  `tipoDocumento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idTipoDocumento`, `tipoDocumento`) VALUES
(1, 'Cedula de Ciudadania'),
(2, 'Cedula de Extranjeria'),
(3, 'Numero de Pasaporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTipoUsuario` int(5) NOT NULL,
  `tipoUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `tipoUsuario`) VALUES
(1, 'Gerente'),
(2, 'Encargado de Reserva'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `UsuarioDocumento` varchar(20) NOT NULL,
  `UsuarioTelefono` varchar(11) NOT NULL,
  `Contrasena` varchar(70) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `UsuarioPrimerNombre` varchar(40) NOT NULL,
  `UsuarioApellido` varchar(40) NOT NULL,
  `idTipoDocumento` int(5) NOT NULL,
  `idTipoUsuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`UsuarioDocumento`, `UsuarioTelefono`, `Contrasena`, `Correo`, `UsuarioPrimerNombre`, `UsuarioApellido`, `idTipoDocumento`, `idTipoUsuario`) VALUES
('1122334455', '12368451', '.....', 'Edison@gmial.com', 'Edison', 'Torres', 3, 3),
('1122334459', '12368451', '.....', 'Edison@gmial.com', 'Johanna', 'Torres', 3, 3),
('1122334469', '12368451', 'hahahaha', 'Edison@gmial.com', 'Johanna', 'Torres', 3, 3),
('1124217751', '3012864378', 'odmb7750', 'odmarulandab@unal.edu.co', 'Oscar', 'Marulanda', 1, 1),
('1124217752', '3012864378', 'odmb7750', 'oscarmarulandab@unal.edu.co', 'Oscar', 'Marulanda', 1, 1),
('1124217753', '3012864379', 'odmb', 'odmarulandab@unal.edu.co', 'Oscar', 'Marulandaxxx', 1, 1),
('1124217754', '3012864398', 'odmb', 'oscarmarulandab@gmail.com', 'Oscar', 'MarulandabBb', 2, 2),
('12345678', '123456789', 'password123', 'user@example.com', 'John', 'Doe', 1, 2),
('123456789', '1234575', 'lara1', 'lara@gmail.com', 'Lara', 'Carillo', 1, 3),
('12345679', '123456789', 'password123', 'user@example.com', 'John', 'Doe', 1, 2),
('15554', '32284566611', '', 'miguel@gmail.com', 'Miguel', 'Suarez', 1, 1),
('1564654', '4122353', '$2y$10$1LqbbwlmDGmGktTaIcPPbeO9EXoo6ycnUe4Vicwcyfp9hXLoK3Oci', 'Takeshi123@gmail.com', 'Eien', 'Takeshi12', 1, 1),
('2233445566', '654321', 'Pedro12', 'Pedro@gmail.com', 'Pedro1515', 'Gonzalez', 1, 3),
('3230213123', '4122353', '$2y$10$UqVw8fW.fBUcJIQUD9M9iO.yQ6QbhAsb1SIzevouPSfPU53LnQYcG', 'Takeshi123@gmail.com', 'Eien', 'Takeshi12', 1, 1),
('33343334343', '3455888', '$2y$12$O6J7AF6r5OmPbySFos99ju.6xPfID00Dn0tvHbLDN2kbrb4FDCAfy', 'jhon@gmail.com', 'jhon', 'esteban', 3, 1),
('3344556677', '765432', 'Ana34', 'Ana@gmail.com', 'Ana', 'Ramirez', 2, 3),
('4444444', '44445', 'agogo4', 'juanagogo@gmail.com', 'juan', 'agogo', 2, 3),
('4455667788', '87654', 'Luis56', 'Luis@gmail.com', 'Luis', 'Hernandez', 3, 3),
('4512324', '4123', 'Carlos12', 'Carlos@gmail.com', 'Carlos', 'Muro', 2, 3),
('4512754', '41478', 'Henry12', 'Henry@gmail.com', 'Henry', 'yabe', 2, 3),
('464545456', '322154587', 'deivison12', 'deiviso@gmail.com', 'deivison', 'ortega', 1, 1),
('5566778890', '9876541', 'Maria78', 'Maria@gmail.com', 'Maria', 'Lopez', 1, 3),
('5566778899', '123857', 'Juan12', 'Juan@gmial.com', 'Juan', 'Monroy', 1, 1),
('6677889901', '543210', 'Jose90', 'Jose@gmail.com', 'Jose', 'Martinez1', 2, 3),
('777777', '8888888', 'hola1111', 'hola1@gmail.com', 'hola', 'hola2', 1, 1),
('8889', '32154', 'juan123', 'estaban@gmail.com', 'esteban', 'ju', 2, 1),
('987654321', '12357854', 'Lautaro22', 'Lautaro@gmail.com', 'Lautaro', 'Lescano2', 2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idIngrediente`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD KEY `idSabor` (`idSabor`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `ordendecompra`
--
ALTER TABLE `ordendecompra`
  ADD PRIMARY KEY (`idOrden`),
  ADD KEY `UsuarioTelefono` (`UsuarioDocumento`);

--
-- Indices de la tabla `ordeningrediente`
--
ALTER TABLE `ordeningrediente`
  ADD KEY `idOrden` (`idOrden`),
  ADD KEY `idIngrediente` (`idIngrediente`),
  ADD KEY `fk_ordeningrediente_proveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `UsuarioTelefono` (`UsuarioDocumento`);

--
-- Indices de la tabla `sabor`
--
ALTER TABLE `sabor`
  ADD PRIMARY KEY (`idSabor`);

--
-- Indices de la tabla `saboringrediente`
--
ALTER TABLE `saboringrediente`
  ADD KEY `idSabor` (`idSabor`),
  ADD KEY `idIngrediente` (`idIngrediente`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idTipoDocumento`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`UsuarioDocumento`),
  ADD KEY `idTipoDocumento` (`idTipoDocumento`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ordendecompra`
--
ALTER TABLE `ordendecompra`
  MODIFY `idOrden` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idPedido` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idTipoDocumento` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTipoUsuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `linea`
--
ALTER TABLE `linea`
  ADD CONSTRAINT `linea` FOREIGN KEY (`idSabor`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `linea_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `reserva` (`idPedido`);

--
-- Filtros para la tabla `ordendecompra`
--
ALTER TABLE `ordendecompra`
  ADD CONSTRAINT `ordendecompra_ibfk_1` FOREIGN KEY (`UsuarioDocumento`) REFERENCES `usuario` (`UsuarioDocumento`);

--
-- Filtros para la tabla `ordeningrediente`
--
ALTER TABLE `ordeningrediente`
  ADD CONSTRAINT `fk_ordeningrediente_proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`),
  ADD CONSTRAINT `ordeningrediente_ibfk_1` FOREIGN KEY (`idOrden`) REFERENCES `ordendecompra` (`idOrden`),
  ADD CONSTRAINT `ordeningrediente_ibfk_2` FOREIGN KEY (`idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`UsuarioDocumento`) REFERENCES `usuario` (`UsuarioDocumento`);

--
-- Filtros para la tabla `saboringrediente`
--
ALTER TABLE `saboringrediente`
  ADD CONSTRAINT `saboringrediente_ibfk_1` FOREIGN KEY (`idSabor`) REFERENCES `sabor` (`idSabor`),
  ADD CONSTRAINT `saboringrediente_ibfk_2` FOREIGN KEY (`idIngrediente`) REFERENCES `ingrediente` (`idIngrediente`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
