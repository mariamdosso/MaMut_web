-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : sam. 01 fév. 2025 à 18:29
-- Version du serveur :  10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-mutuel`
--

-- --------------------------------------------------------

--
-- Structure de la table `cash flow`
--

DROP TABLE IF EXISTS `cash flow`;
CREATE TABLE IF NOT EXISTS `cash flow` (
  `cash_flow_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description_cash_flow` varchar(255) NOT NULL,
  `amount_cash_flow` decimal(10,0) NOT NULL,
  `type_cash_flow` varchar(255) NOT NULL,
  `date_cash_flow` date NOT NULL,
  `fund_id` int(11) NOT NULL,
  PRIMARY KEY (`cash_flow_id`),
  KEY `fk_fund` (`fund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `event_label` varchar(255) NOT NULL,
  `event_type` text NOT NULL,
  `event_domain` text NOT NULL,
  `event_date_start` date NOT NULL,
  `event_date_end` date NOT NULL,
  `event_periodicity` varchar(255) NOT NULL,
  `event_contribution_amount` decimal(10,0) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `event_fund`
--

DROP TABLE IF EXISTS `event_fund`;
CREATE TABLE IF NOT EXISTS `event_fund` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_event` bigint(20) NOT NULL,
  `id_fund` bigint(20) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fund` (`id_fund`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `fund`
--

DROP TABLE IF EXISTS `fund`;
CREATE TABLE IF NOT EXISTS `fund` (
  `fund_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fund_name` varchar(255) NOT NULL,
  `tatal_amount_fund` decimal(10,0) NOT NULL,
  `date_ceation_fund` date NOT NULL,
  PRIMARY KEY (`fund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL,
  `firstname_member` varchar(255) NOT NULL,
  `date_ birth_member` date NOT NULL,
  `membership_date` date NOT NULL,
  `gender_member` varchar(255) NOT NULL,
  `member_city` text NOT NULL,
  `member_municipality` text NOT NULL,
  `member_district` text NOT NULL,
  `contact_member` text NOT NULL,
  `professio_member` text NOT NULL,
  `role_member` text NOT NULL,
  `email_member` text NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `participation_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `member_id` bigint(10) NOT NULL,
  `event_id` bigint(10) NOT NULL,
  `added_date` date NOT NULL,
  `label` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`participation_id`),
  KEY `fk_member` (`member_id`),
  KEY `fk_event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `event_fund`
--
ALTER TABLE `event_fund`
  ADD CONSTRAINT `fk_fund` FOREIGN KEY (`id_fund`) REFERENCES `fund` (`fund_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
