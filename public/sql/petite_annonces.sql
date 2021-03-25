-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 mars 2021 à 15:59
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petite_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `nom_annonce` varchar(225) NOT NULL,
  `description_annonce` text NOT NULL,
  `prix_annonce` decimal(10,0) NOT NULL,
  `photo_annonce` varchar(255) NOT NULL,
  `date_depot` datetime NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `regions_id` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `Id de la catégorie` (`categorie_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `regions_id` (`regions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES
(1, 'Vélo', 'VTT bon état 26 vitesses', '12', '../assets/img/velo.jpg', '2021-03-24 07:50:07', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `type_categorie`) VALUES
(1, 'Multimedias'),
(2, 'Electro-menager'),
(3, 'Meubles'),
(4, 'Véhicules'),
(5, 'Modes'),
(6, 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_regions` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) NOT NULL,
  PRIMARY KEY (`id_regions`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_regions`, `nom_region`) VALUES
(1, 'grand_est'),
(2, 'aquitaine'),
(3, 'ra_auvergne'),
(4, 'normandie'),
(5, 'bourgogne_fc'),
(6, 'bretagne'),
(7, 'centre'),
(8, 'corse'),
(9, 'ile_france'),
(10, 'occitanie'),
(11, 'haut_france'),
(12, 'pays_loire'),
(13, 'paca');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES
(1, 'micvendeur', 'micvendeur@hotmail.fr', 'azerty'),
(2, 'micvendeur', 'micvendeur@hotmail.fr', 'azerty'),
(3, 'testvendeur', 'robert@ok.fr', 'test'),
(4, 'levendeur', 'LEVENDEUR@COOL.FR', 'CMOI'),
(5, 'levendeur', 'LEVENDEUR@COOL.FR', 'CMOI'),
(6, 'micvendeur', 'sophie@cool.fr', 'test'),
(7, 'lebonvendeur', 'lebonvendeur@cool.fr', 'cacabon'),
(8, 'retest', 'restet@cgood.fr', 'retest'),
(9, 'lacbon', 'lacbon@ok.com', 'azert'),
(10, 'micvendeurtetst', 'lebonvendeur@cool.fr', 'thth');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonces_ibfk_3` FOREIGN KEY (`regions_id`) REFERENCES `regions` (`id_regions`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
