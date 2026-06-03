-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 03-06-2026 a les 20:34:14
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `inventari`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `categories`
--

INSERT INTO `categories` (`id`, `nombre`) VALUES
(1, 'Sistemes de Computació'),
(2, 'Perifèrics i Inputs'),
(3, 'Infraestructura de Xarxa'),
(4, 'Llicències i Programari'),
(5, 'Mobiliari Tecnològic');

-- --------------------------------------------------------

--
-- Estructura de la taula `products`
--

CREATE TABLE `products` (
  `cod` int(11) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `pvp` decimal(5,2) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Bolcament de dades per a la taula `products`
--

INSERT INTO `products` (`cod`, `short_name`, `categoria_id`, `pvp`, `nombre`) VALUES
(1, 'SRV-DELL-R750', 1, 999.99, 'Servidor Rack Dell PowerEdge'),
(2, 'LAP-MAC-M3', 1, 999.99, 'MacBook Pro 16\" M3 Max'),
(3, 'MON-ASUS-32', 2, 549.50, 'Monitor Asus ProArt 32\" 4K'),
(4, 'KEY-MXKEYS', 2, 115.00, 'Teclat Mecànic Logitech MX'),
(5, 'SWI-CISCO-24', 3, 890.00, 'Switch Cisco Catalyst 24P'),
(6, 'RTR-FORTI-60', 3, 999.99, 'Firewall Fortinet FortiGate'),
(7, 'LIC-ADOBE-CC', 4, 620.00, 'Subscripció Adobe Creative Cloud'),
(8, 'LIC-WIN-SRV', 4, 450.00, 'Llicència Windows Server 2025'),
(9, 'TAU-ELEV-01', 5, 380.00, 'Taula de Treball Elevable'),
(10, 'CAD-AERON', 5, 999.99, 'Cadira Ergonòmica Herman Miller');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_products_categories` (`categoria_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `products`
--
ALTER TABLE `products`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`categoria_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
