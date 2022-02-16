-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 jan. 2022 à 11:50
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_inscription`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `num` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `date_enregistrement` date NOT NULL,
  `contenu_dossier` text NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descriptif` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `mat` varchar(255) NOT NULL,
  `nom_etudiant` varchar(255) NOT NULL,
  `pnom_etudiant` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `contact` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`mat`, `nom_etudiant`, `pnom_etudiant`, `date_naissance`, `contact`, `mail`, `genre`) VALUES
('ETUDIANT_001', 'Lamine', 'Traoré', '2021-12-18', '0141253698', 'lamineT@gmail.com', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_filiere` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fournir`
--

DROP TABLE IF EXISTS `fournir`;
CREATE TABLE IF NOT EXISTS `fournir` (
  `num_dossier` int NOT NULL,
  `mat_etudiant` varchar(255) NOT NULL,
  KEY `num_dossier` (`num_dossier`),
  KEY `mat_etudiant` (`mat_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `num` int NOT NULL AUTO_INCREMENT,
  `date_inscription` date NOT NULL,
  `id_filiere` int NOT NULL,
  PRIMARY KEY (`num`),
  KEY `id_filiere` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fournir`
--
ALTER TABLE `fournir`
  ADD CONSTRAINT `fournir_ibfk_1` FOREIGN KEY (`num_dossier`) REFERENCES `dossier` (`num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fournir_ibfk_2` FOREIGN KEY (`mat_etudiant`) REFERENCES `etudiant` (`mat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
