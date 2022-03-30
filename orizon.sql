
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `orizon`
--
CREATE DATABASE IF NOT EXISTS `orizon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `orizon`;

-- --------------------------------------------------------

--
-- Struttura della tabella `paesi`
--

CREATE TABLE `paesi` (
  `id_paese` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `paesi`
--

INSERT INTO `paesi` (`id_paese`, `nome`, `id_viaggio`) VALUES
(1, 'Italia', 1),
(2, 'Francia', 1),
(3, 'Svizzera', 1),
(4, 'Russia', 2),
(5, 'Cina', 2),
(6, 'Giappone', 2),
(7, 'usa', 3),
(8, 'francia', 3),
(9, 'Giappone', 3),
(10, 'Australia', 3),
(11, 'Italia', 3),
(12, 'Usa', 4),
(13, 'Canada', 4),
(14, 'Brasile', 4),
(15, 'Argentina', 4),
(16, 'India', 2),
(17, 'Siberia', 2),
(20, 'Scozia', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggi`
--

CREATE TABLE `viaggi` (
  `id_viaggio` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `n_posti` int(11) NOT NULL,
  `n_posti_occupati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `viaggi`
--

INSERT INTO `viaggi` (`id_viaggio`, `nome`, `n_posti`, `n_posti_occupati`) VALUES
(1, 'culturaEuropea', 140, 120),
(2, 'culturaOrientale', 140, 120),
(3, 'AroundWorld', 140, 120),
(4, 'americanTravel', 200, 140);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `paesi`
--
ALTER TABLE `paesi`
  ADD PRIMARY KEY (`id_paese`);

--
-- Indici per le tabelle `viaggi`
--
ALTER TABLE `viaggi`
  ADD PRIMARY KEY (`id_viaggio`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `paesi`
--
ALTER TABLE `paesi`
  MODIFY `id_paese` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `viaggi`
--
ALTER TABLE `viaggi`
  MODIFY `id_viaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
