-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.32-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database ecommerce
CREATE DATABASE IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ecommerce`;

-- Dump della struttura di tabella ecommerce.carrelli
CREATE TABLE IF NOT EXISTS `carrelli` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantitativo` int(10) unsigned NOT NULL,
  `id_prodotto` int(10) unsigned NOT NULL,
  `id_utente` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.carrelli: ~5 rows (circa)
DELETE FROM `carrelli`;
INSERT INTO `carrelli` (`id`, `quantitativo`, `id_prodotto`, `id_utente`) VALUES
	(1, 1, 1, 1),
	(2, 1, 1, 1),
	(3, 1, 1, 1),
	(4, 1, 11, 2),
	(5, 1, 12, 1),
	(6, 6, 2, 1),
	(7, 1, 1, 1);

-- Dump della struttura di tabella ecommerce.categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.categorie: ~9 rows (circa)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`id`, `titolo`, `descrizione`) VALUES
	(1, 'Mobili da cucina', 'Mobili per la cucina, come armadietti e cassetti'),
	(2, 'Mobili da soggiorno', 'Mobili per il soggiorno, come divani e tavoli'),
	(3, 'Mobili da camera', 'Mobili per la camera da letto, come letti e comodini'),
	(4, 'Mobili da cucina', 'Mobili per la cucina, come armadietti e cassetti'),
	(5, 'Mobili da soggiorno', 'Mobili per il soggiorno, come divani e tavoli'),
	(6, 'Mobili da camera', 'Mobili per la camera da letto, come letti e comodini'),
	(7, 'Mobili da cucina', 'Mobili per la cucina, come armadietti e cassetti'),
	(8, 'Mobili da soggiorno', 'Mobili per il soggiorno, come divani e tavoli'),
	(9, 'Mobili da camera', 'Mobili per la camera da letto, come letti e comodini');

-- Dump della struttura di tabella ecommerce.categorie_prodotti
CREATE TABLE IF NOT EXISTS `categorie_prodotti` (
  `id_prodotto` int(10) unsigned DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.categorie_prodotti: ~10 rows (circa)
DELETE FROM `categorie_prodotti`;
INSERT INTO `categorie_prodotti` (`id_prodotto`, `id_categoria`) VALUES
	(1, 1),
	(2, 1),
	(3, 2),
	(4, 3),
	(5, 2),
	(6, 2),
	(7, 3),
	(8, 3),
	(9, 2),
	(10, 3);

-- Dump della struttura di tabella ecommerce.dettagli_ordini
CREATE TABLE IF NOT EXISTS `dettagli_ordini` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ordine` int(10) unsigned NOT NULL,
  `id_prodotto` int(10) unsigned NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `quantitativo` int(10) unsigned NOT NULL,
  `data_ordine` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.dettagli_ordini: ~0 rows (circa)
DELETE FROM `dettagli_ordini`;

-- Dump della struttura di tabella ecommerce.immagini
CREATE TABLE IF NOT EXISTS `immagini` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_prodotto` int(10) unsigned DEFAULT NULL,
  `percorso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.immagini: ~0 rows (circa)
DELETE FROM `immagini`;

-- Dump della struttura di tabella ecommerce.indirizzi
CREATE TABLE IF NOT EXISTS `indirizzi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_utente` int(10) unsigned NOT NULL,
  `indirizzo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.indirizzi: ~0 rows (circa)
DELETE FROM `indirizzi`;

-- Dump della struttura di tabella ecommerce.ordini
CREATE TABLE IF NOT EXISTS `ordini` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_utente` int(10) unsigned NOT NULL,
  `costo_totale` decimal(10,2) NOT NULL,
  `quantitativo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.ordini: ~0 rows (circa)
DELETE FROM `ordini`;

-- Dump della struttura di tabella ecommerce.prodotti
CREATE TABLE IF NOT EXISTS `prodotti` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `tipologia` enum('prodotto','accessorio') NOT NULL,
  `prezzo` decimal(10,2) NOT NULL,
  `data_aggiunta` datetime NOT NULL,
  `id_creatore` int(10) unsigned NOT NULL,
  `id_prodotto` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.prodotti: ~10 rows (circa)
DELETE FROM `prodotti`;
INSERT INTO `prodotti` (`id`, `titolo`, `descrizione`, `tipologia`, `prezzo`, `data_aggiunta`, `id_creatore`, `id_prodotto`) VALUES
	(1, 'Armadio da cucina', 'Armadio per riporre utensili da cucina', 'prodotto', 499.99, '2024-02-15 17:00:38', 2, NULL),
	(2, 'Tavolo da pranzo', 'Tavolo in legno massiccio per la sala da pranzo', 'prodotto', 299.99, '2024-02-15 17:00:38', 2, NULL),
	(3, 'Divano in pelle', 'Divano a tre posti in pelle nera', 'prodotto', 799.99, '2024-02-15 17:00:38', 2, NULL),
	(4, 'Letto matrimoniale', 'Letto matrimoniale con testiera imbottita', 'prodotto', 699.99, '2024-02-15 17:00:38', 2, NULL),
	(5, 'Scrivania per ufficio', 'Scrivania in legno per l\'ufficio', 'prodotto', 199.99, '2024-02-15 17:00:38', 2, NULL),
	(6, 'Sedia da ufficio', 'Sedia girevole con schienale ergonomico per l\'ufficio', 'prodotto', 129.99, '2024-02-15 17:00:38', 2, NULL),
	(7, 'Scaffale a muro', 'Scaffale a muro in legno per libri e oggetti decorativi', 'prodotto', 79.99, '2024-02-15 17:00:38', 2, NULL),
	(8, 'Comodino moderno', 'Comodino con cassetto e mensola', 'prodotto', 49.99, '2024-02-15 17:00:38', 2, NULL),
	(9, 'Poltrona reclinabile', 'Poltrona imbottita reclinabile con poggiapiedi', 'prodotto', 349.99, '2024-02-15 17:00:38', 2, NULL),
	(10, 'Cassettiera per camera', 'Cassettiera a tre cassetti in legno', 'prodotto', 149.99, '2024-02-15 17:00:38', 2, NULL),
	(11, 'poggiapane', 'coso quadrato per metterci il pane', 'accessorio', 22.00, '2024-02-16 18:54:33', 2, 1),
	(12, 'fiorellino', 'fiorellino da decoro', 'accessorio', 2.00, '2024-02-17 20:34:33', 2, 1);

-- Dump della struttura di tabella ecommerce.utenti
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_utente` varchar(40) NOT NULL,
  `pw_hash` varchar(255) NOT NULL,
  `privilegi` enum('visualizzatore','creatore') NOT NULL,
  `data_creazione` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_utente` (`nome_utente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella ecommerce.utenti: ~3 rows (circa)
DELETE FROM `utenti`;
INSERT INTO `utenti` (`id`, `nome_utente`, `pw_hash`, `privilegi`, `data_creazione`) VALUES
	(1, 'Daniel', '$2y$10$P8Qkhc/3CdRJ2GDYKo7Pt.7SA3jrtsa3SomfipWYQw06OHCbwY9mi', 'visualizzatore', '2024-02-02 21:28:02'),
	(2, 'DanielH', '$2y$10$qK6zdxi.jYUod/RDFkaVK.xUimV90SaBIvXrwme1dqJTFptsCMHZW', 'visualizzatore', '2024-02-02 21:28:40'),
	(3, 'Utente3', '$2y$10$fcDC.GIqnvolg.hSkP7Hv.UMTiSeEWc3ls9VWkFjdVOa71jqLyx6a', 'visualizzatore', '2024-02-02 21:39:59');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
