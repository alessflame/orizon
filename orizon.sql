-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 10, 2022 alle 12:01
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `orizon`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `countries`
--

CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `countries`
--

INSERT INTO `countries` (`id_country`, `name`) VALUES
(9, 'Belgium'),
(3, 'Brazil'),
(2, 'Canada'),
(12, 'China'),
(8, 'Denmark'),
(10, 'England'),
(5, 'France'),
(6, 'Germany'),
(13, 'India'),
(4, 'Italy'),
(11, 'Japan'),
(7, 'Spain'),
(1, 'Usa');

-- --------------------------------------------------------

--
-- Struttura della tabella `travels`
--

CREATE TABLE `travels` (
  `id_travel` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `travels`
--

INSERT INTO `travels` (`id_travel`, `name`, `places`) VALUES
(1, 'AmericanTravel', 400),
(2, 'Europe', 600),
(3, 'NorthEurope', 600),
(4, 'Explore World', 220),
(5, 'Asian Travel', 220);

-- --------------------------------------------------------

--
-- Struttura della tabella `travels_countries`
--

CREATE TABLE `travels_countries` (
  `id_row` int(11) NOT NULL,
  `id_travel` int(11) NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `travels_countries`
--

INSERT INTO `travels_countries` (`id_row`, `id_travel`, `id_country`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 6),
(9, 3, 8),
(10, 3, 6),
(11, 3, 9),
(12, 3, 10),
(13, 4, 1),
(14, 4, 4),
(15, 4, 11),
(16, 4, 12),
(17, 4, 5),
(18, 4, 7),
(19, 5, 11),
(20, 5, 12),
(21, 5, 13);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`id_travel`);

--
-- Indici per le tabelle `travels_countries`
--
ALTER TABLE `travels_countries`
  ADD PRIMARY KEY (`id_row`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `travels`
--
ALTER TABLE `travels`
  MODIFY `id_travel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `travels_countries`
--
ALTER TABLE `travels_countries`
  MODIFY `id_row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;
