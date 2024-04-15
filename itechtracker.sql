-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 15. Apr 2024 um 20:18
-- Server-Version: 5.7.39
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `itechtracker`
--
CREATE DATABASE IF NOT EXISTS `itechtracker` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `itechtracker`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `asset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ram` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `storage` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warranty_end` date DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `assets`
--

INSERT INTO `assets` (`asset_id`, `user_id`, `device_name`, `model`, `manufacturer`, `purchase_date`, `price`, `color`, `processor`, `ram`, `storage`, `warranty_end`, `image_path`, `public`) VALUES
(1, 1, 'iPhone von Hans', 'iPhone 15 Pro', 'Apple', '2024-02-08', '1193.45', 'Titan Blau', 'A17 Pro', '8 GB LPDDR5', '256 GB', '2025-02-07', 'public/asset-media/661d7b12ecb8e_iphone-15-pro-finish-select-202309-6-1inch-bluetitanium.jpeg', 1),
(2, 1, 'MacBook von Hans', '14&quot; MacBook Pro M3', 'Apple', '2024-04-02', '2389.40', 'Space Grau', 'M3', '24 GB gemeinsamer Arbeitsspeicher', '1 TB SSD Speicher', NULL, 'public/asset-media/661d7ca52944a_mbp14-spacegray-gallery1-202310.jpeg', 1),
(3, 1, 'iMac', 'G3', 'Apple', '1999-07-15', '1199.00', 'Lime', 'PowerPC 750 G3', '256 MB', '6 GB', NULL, 'public/asset-media/661d7d7d9f3fb_G3.jpg', 1),
(4, 2, 'iPhone von John', 'iPhone 13 Pro', 'Apple', '2022-08-03', '999.00', 'Gold', 'A15', '6 GB LPDDR4X', '128 GB', '2023-08-02', 'public/asset-media/661d7fcc48c52_13-Pro-gold.png', 1),
(5, 2, 'Mac Pro', 'Mac Pro 2013', 'Apple', '2015-06-11', '3500.00', 'Schwarz', 'Intel Xeon', '64 GB', '1 TB SSD', NULL, NULL, 1),
(6, 2, 'Mac Pro Privat', 'Mac Pro Late 2013', 'Apple', '2014-06-05', '3999.00', 'Schwarz', 'Intel Xeon E5 2697', '64 GB', '512 GB', NULL, 'public/asset-media/661d851526d19_mac-pro-e-2013-600x600.jpg', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`) VALUES
(1, 'Hans', 'Muster', 'itechtracker-demo', '$2y$10$thKHpkPQYJSP4qxqSXSONu06Y6E0ggW2ZrLUbQGJP5kErp/tQo9ua', 'Hans.Muster@bl.ch'),
(2, 'John', 'Doe', 'itechtracker-demo2', '$2y$10$WKrP2m15hRJMKVyt6lJkquR.Yk61Pl/rss37V4/bd2VpWqKFR8nzy', 'John.Doe@bl.ch');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `assets`
--
ALTER TABLE `assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
