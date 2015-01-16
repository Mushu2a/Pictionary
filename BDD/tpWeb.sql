-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 16 Janvier 2015 à 15:01
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tpWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `drawings`
--

CREATE TABLE IF NOT EXISTS `drawings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `commande` text NOT NULL,
  `dessin` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `nom` varchar(65) DEFAULT NULL,
  `prenom` varchar(65) DEFAULT NULL,
  `tel` varchar(16) DEFAULT NULL,
  `website` varchar(65) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `ville` varchar(65) DEFAULT NULL,
  `taille` smallint(3) DEFAULT NULL,
  `couleur` char(6) DEFAULT '000000',
  `profilepic` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
