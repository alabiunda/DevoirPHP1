-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 27 avr. 2020 à 10:13
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `log`
--

INSERT INTO `log` (`pk`, `action`, `ts`) VALUES
(4, 'test', '2020-04-20 21:09:01'),
(5, 'test', '2020-04-26 19:54:18'),
(6, 'test', '2020-04-26 19:54:35');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `vat` int(11) NOT NULL,
  `price_vat` float NOT NULL,
  `price_total` float NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`pk`, `name`, `price`, `vat`, `price_vat`, `price_total`, `quantity`) VALUES
(1, 'Super Smash Bros Ultimate', 40, 21, 8.4, 48.4, 11),
(2, 'Tekken 4', 20, 6, 1.2, 21.2, 12),
(3, 'The Witcher 3', 100, 10, 10, 110, 2),
(4, 'World Of Warcraft', 30, 0, 0, 30, 21),
(5, 'Warcraft 3', 10, 0, 0, 10, 9),
(6, 'Farm Simulator', 5, 0, 0, 5, 2),
(18, 'Test', 25, 0, 0, 0, 4),
(19, 'Test', 25, 0, 0, 0, 4),
(23, 'Test', 123, 0, 0, 0, 1234);

--
-- Déclencheurs `products`
--
DROP TRIGGER IF EXISTS `prod_vat`;
DELIMITER $$
CREATE TRIGGER `prod_vat` BEFORE UPDATE ON `products` FOR EACH ROW BEGIN
DECLARE compute_vat float;
IF new.price != 0 AND new.price IS NOT NULL THEN
	SET compute_vat = new.vat/100;
    SET new.price_vat = new.price * compute_vat;
    SET new.price_total = new.price * compute_vat + new.price;
ELSE 
	SET new.price_vat = 0;
    SET new.price_total = 0;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`pk`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'johndoe', '123456789', '2020-04-20 20:55:01', '2020-04-20 20:55:01'),
(2, 'admin', 'password123', '2020-03-11 20:30:47', '2020-03-11 20:30:47'),
(4, 'ramon', '123456', '2020-03-12 17:16:40', '2020-03-12 17:16:40'),
(9, 'test', '123456', '2020-04-26 19:54:18', '2020-04-26 19:54:18');

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `log_crea_users`;
DELIMITER $$
CREATE TRIGGER `log_crea_users` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO log (action, ts) VALUES (new.username, NOW())
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trig_updateTS`;
DELIMITER $$
CREATE TRIGGER `trig_updateTS` BEFORE UPDATE ON `users` FOR EACH ROW SET NEW.updated_at = NOW()
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
