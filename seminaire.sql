-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 mars 2025 à 16:31
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `seminaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_bin NOT NULL,
  `intervenant_id` int(11) DEFAULT NULL,
  `salle` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nbplaces` int(11) DEFAULT NULL,
  `creneau_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `intervenant_id` (`intervenant_id`),
  KEY `creneau_id` (`creneau_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `conference`
--

INSERT INTO `conference` (`id`, `description`, `intervenant_id`, `salle`, `nbplaces`, `creneau_id`) VALUES
(1, 'Enjeux émergents, enjeux à construire pour la recherche urbaine', 1, 'salle Mozart', 50, 1),
(2, 'L’activité urbaine et l’environnement: de nouveaux modèles à construire', 2, 'salle Berlioz', 60, 1),
(3, 'Des infrastructures et des services urbains pour une ville économe?', 3, 'salle Beethoven', 30, 1),
(4, 'Métropoles et aménagements métropolitains', 4, 'salle Berlioz', 50, 2),
(5, 'La ville pour tous', 5, 'salle Mozart', 50, 2),
(6, 'Quelles dynamiques d’innovations pour les villes ?', 6, 'salle Beethoven', 60, 2),
(7, 'Urbanisme et environnement: des exemples en Europe', 7, 'salle Berlioz', 30, 3),
(8, 'Nouvelles vulnérabilités, nouvelles gouvernances', 8, 'salle Beethoven', 30, 3),
(9, 'La ville et ses périphéries, quelles relations ?', 9, 'salle Berlioz', 30, 4),
(10, 'La ville, quel avenir, quelles contraintes ?', 10, 'salle Beethoven', 30, 4);

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

DROP TABLE IF EXISTS `creneau`;
CREATE TABLE IF NOT EXISTS `creneau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure` time NOT NULL,
  `seminaire_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seminaire_id` (`seminaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `creneau`
--

INSERT INTO `creneau` (`id`, `heure`, `seminaire_id`) VALUES
(1, '10:00:00', 1),
(2, '11:30:00', 1),
(3, '14:00:00', 1),
(4, '16:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`id`, `nom`) VALUES
(1, 'Alain Lecastel'),
(2, 'Yves Renard'),
(3, 'Anne-Marie Brelinsky'),
(4, 'Joseph Demongeot'),
(5, 'Marc Touati'),
(6, 'Hervé Bachelard'),
(7, 'Yann Berlinne'),
(8, 'Hamed Djalaoui'),
(9, 'Omar Azdine'),
(10, 'Sophie Radon');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`id`, `nom`, `prenom`, `profession`, `ville`, `mail`) VALUES
(1, 'Roberto', 'Jean', 'Directeur de l\'urbanisme', 'Rennes', 'jroberto@free.fr');

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `conference_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  PRIMARY KEY (`conference_id`,`participant_id`),
  KEY `participant_id` (`participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `participer`
--

INSERT INTO `participer` (`conference_id`, `participant_id`) VALUES
(1, 1),
(5, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `seminaire`
--

DROP TABLE IF EXISTS `seminaire`;
CREATE TABLE IF NOT EXISTS `seminaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `seminaire`
--

INSERT INTO `seminaire` (`id`, `intitule`) VALUES
(1, 'Seminaire du 12 octobre 2222, la ville et ses enjeux');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenant` (`id`),
  ADD CONSTRAINT `conference_ibfk_2` FOREIGN KEY (`creneau_id`) REFERENCES `creneau` (`id`);

--
-- Contraintes pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD CONSTRAINT `creneau_ibfk_1` FOREIGN KEY (`seminaire_id`) REFERENCES `seminaire` (`id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
