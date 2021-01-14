-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 jan. 2021 à 18:47
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
-- Base de données : `mesappartements`
--

-- --------------------------------------------------------

--
-- Structure de la table `appareil`
--

DROP TABLE IF EXISTS `appareil`;
CREATE TABLE IF NOT EXISTS `appareil` (
  `IdAppareil` int(11) NOT NULL,
  `NomAppareil` varchar(50) DEFAULT NULL,
  `TypeAppareil` varchar(50) DEFAULT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `Emplacement` varchar(50) DEFAULT NULL,
  `Video` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdAppareil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

DROP TABLE IF EXISTS `appartement`;
CREATE TABLE IF NOT EXISTS `appartement` (
  `IdAppartement` int(11) NOT NULL,
  `Deg_sec` varchar(50) DEFAULT NULL,
  `IdMaison` int(11) NOT NULL,
  PRIMARY KEY (`IdAppartement`),
  KEY `IdMaison` (`IdMaison`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `consommer`
--

DROP TABLE IF EXISTS `consommer`;
CREATE TABLE IF NOT EXISTS `consommer` (
  `IdAppareil` int(11) NOT NULL,
  `DateOn` datetime NOT NULL,
  `DateOff` datetime DEFAULT NULL,
  `IdRessource` int(11) NOT NULL,
  PRIMARY KEY (`IdAppareil`,`DateOn`),
  KEY `DateOn` (`DateOn`),
  KEY `IdRessource` (`IdRessource`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `datel`
--

DROP TABLE IF EXISTS `datel`;
CREATE TABLE IF NOT EXISTS `datel` (
  `DateDebutL` datetime NOT NULL,
  PRIMARY KEY (`DateDebutL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dateon`
--

DROP TABLE IF EXISTS `dateon`;
CREATE TABLE IF NOT EXISTS `dateon` (
  `DateOn` datetime NOT NULL,
  PRIMARY KEY (`DateOn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `datepos`
--

DROP TABLE IF EXISTS `datepos`;
CREATE TABLE IF NOT EXISTS `datepos` (
  `DateDebutPos` datetime NOT NULL,
  PRIMARY KEY (`DateDebutPos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `IdDepartement` int(11) NOT NULL,
  `nom_departement` varchar(50) DEFAULT NULL,
  `IdRegion` int(11) NOT NULL,
  PRIMARY KEY (`IdDepartement`),
  KEY `IdRegion` (`IdRegion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`IdDepartement`, `nom_departement`, `IdRegion`) VALUES
(1, 'Ain', 84),
(2, 'Aisne', 32),
(3, 'Allier', 84),
(4, 'Alpes-de-Haute-Provence', 93),
(5, 'Hautes-Alpes', 93),
(6, 'Alpes-Maritimes', 93),
(7, 'Ardeche', 84),
(8, 'Ardennes', 44),
(9, 'Ariege', 76),
(10, 'Aube', 44),
(11, 'Aude', 76),
(12, 'Aveyron', 76),
(13, 'Bouches-du-Rhone', 93),
(14, 'Calvados', 28),
(15, 'Cantal', 84),
(16, 'Charente', 75),
(17, 'Charente-Maritime', 75),
(18, 'Cher', 24),
(19, 'Correze', 75),
(21, 'Cote-d\'Or', 27),
(22, 'Cotes-d\'Armor', 53),
(23, 'Creuse', 75),
(24, 'Dordogne', 75),
(25, 'Doubs', 27),
(26, 'Drome', 84),
(27, 'Eure', 28),
(28, 'Eure-et-Loir', 24),
(29, 'Finistere', 53),
(201, 'Corse-du-Sud', 94),
(202, 'Haute-Corse', 94),
(30, 'Gard', 76),
(31, 'Haute-Garonne', 76),
(32, 'Gers', 76),
(33, 'Gironde', 75),
(34, 'Herault', 76),
(35, 'Ille-et-Vilaine', 53),
(36, 'Indre', 24),
(37, 'Indre-et-Loire', 24),
(38, 'Isere', 84),
(39, 'Jura', 27),
(40, 'Landes', 75),
(41, 'Loir-et-Cher', 24),
(42, 'Loire', 84),
(43, 'Haute-Loire', 84),
(44, 'Loire-Atlantique', 52),
(45, 'Loiret', 24),
(46, 'Lot', 76),
(47, 'Lot-et-Garonne', 75),
(48, 'Lozere', 76),
(49, 'Maine-et-Loire', 52),
(50, 'Manche', 28),
(51, 'Marne', 44),
(52, 'Haute-Marne', 44),
(53, 'Mayenne', 52),
(54, 'Meurthe-et-Moselle', 44),
(55, 'Meuse', 44),
(56, 'Morbihan', 53),
(57, 'Moselle', 44),
(58, 'Nievre', 27),
(59, 'Nord', 32),
(60, 'Oise', 32),
(61, 'Orne', 28),
(62, 'Pas-de-Calais', 32),
(63, 'Puy-de-Dome', 84),
(64, 'Pyrenees-Atlantiques', 75),
(65, 'Hautes-Pyrenees', 76),
(66, 'Pyrenees-Orientales', 76),
(67, 'Bas-Rhin', 44),
(68, 'Haut-Rhin', 44),
(69, 'Rhone', 84),
(70, 'Haute-Saone', 27),
(71, 'Saone-et-Loire', 27),
(72, 'Sarthe', 52),
(73, 'Savoie', 84),
(74, 'Haute-Savoie', 84),
(75, 'Paris', 11),
(76, 'Seine-Maritime', 28),
(77, 'Seine-et-Marne', 11),
(78, 'Yvelines', 11),
(79, 'Deux-Sevres', 75),
(80, 'Somme', 32),
(81, 'Tarn', 76),
(82, 'Tarn-et-Garonne', 76),
(83, 'Var', 93),
(84, 'Vaucluse', 93),
(85, 'Vendee', 52),
(86, 'Vienne', 75),
(87, 'Haute-Vienne', 75),
(88, 'Vosges', 44),
(89, 'Yonne', 27),
(90, 'Territoire de Belfort', 27),
(91, 'Essonne', 11),
(92, 'Hauts-de-Seine', 11),
(93, 'Seine-Saint-Denis', 11),
(94, 'Val-de-Marne', 11),
(95, 'Val-d\'Oise', 11),
(971, 'Guadeloupe', 1),
(972, 'Martinique', 2),
(973, 'Guyane', 3),
(974, 'La Reunion', 4),
(976, 'Mayotte', 6);

-- --------------------------------------------------------

--
-- Structure de la table `engendrer`
--

DROP TABLE IF EXISTS `engendrer`;
CREATE TABLE IF NOT EXISTS `engendrer` (
  `IdAppareil` int(11) NOT NULL,
  `DateOn` datetime NOT NULL,
  `DateOff` datetime DEFAULT NULL,
  `IdSubstance` int(11) NOT NULL,
  PRIMARY KEY (`IdAppareil`,`DateOn`),
  KEY `DateOn` (`DateOn`),
  KEY `IdSubstance` (`IdSubstance`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entraîner`
--

DROP TABLE IF EXISTS `entraîner`;
CREATE TABLE IF NOT EXISTS `entraîner` (
  `IdRessource` int(11) NOT NULL,
  `IdTypePiece` int(11) NOT NULL,
  `IdSubstance` int(11) NOT NULL,
  PRIMARY KEY (`IdRessource`,`IdTypePiece`),
  KEY `IdTypePiece` (`IdTypePiece`),
  KEY `IdSubstance` (`IdSubstance`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `epuiser`
--

DROP TABLE IF EXISTS `epuiser`;
CREATE TABLE IF NOT EXISTS `epuiser` (
  `IdSubstance` int(11) NOT NULL,
  `IdTypePiece` int(11) NOT NULL,
  `IdRessource` int(11) NOT NULL,
  PRIMARY KEY (`IdSubstance`,`IdTypePiece`),
  KEY `IdTypePiece` (`IdTypePiece`),
  KEY `IdRessource` (`IdRessource`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

DROP TABLE IF EXISTS `louer`;
CREATE TABLE IF NOT EXISTS `louer` (
  `IdUser` int(11) NOT NULL,
  `DateDebutL` datetime NOT NULL,
  `DateFinL` datetime DEFAULT NULL,
  `IdAppartement` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`,`DateDebutL`),
  KEY `DateDebutL` (`DateDebutL`),
  KEY `IdAppartement` (`IdAppartement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `maison`
--

DROP TABLE IF EXISTS `maison`;
CREATE TABLE IF NOT EXISTS `maison` (
  `IdMaison` int(11) NOT NULL AUTO_INCREMENT,
  `NomMaison` varchar(50) DEFAULT NULL,
  `NumeroMaison` int(11) DEFAULT NULL,
  `Eval` varchar(50) DEFAULT NULL,
  `Deg_iso` varchar(50) DEFAULT NULL,
  `IdVille` int(11) NOT NULL,
  PRIMARY KEY (`IdMaison`),
  KEY `IdVille` (`IdVille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `occuper`
--

DROP TABLE IF EXISTS `occuper`;
CREATE TABLE IF NOT EXISTS `occuper` (
  `IdAppartement` int(11) NOT NULL,
  `IdPiece` int(11) NOT NULL,
  PRIMARY KEY (`IdAppartement`,`IdPiece`),
  KEY `IdPiece` (`IdPiece`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `IdPiece` int(11) NOT NULL,
  `NomPiece` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdPiece`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `IdUser` int(11) NOT NULL,
  `DateDebutPos` datetime NOT NULL,
  `DateFinPos` datetime DEFAULT NULL,
  `IdMaison` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`,`DateDebutPos`),
  KEY `DateDebutPos` (`DateDebutPos`),
  KEY `IdMaison` (`IdMaison`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

DROP TABLE IF EXISTS `ressources`;
CREATE TABLE IF NOT EXISTS `ressources` (
  `IdRessource` int(11) NOT NULL,
  `NomRessource` varchar(50) DEFAULT NULL,
  `VarMinCons` double DEFAULT NULL,
  `VarMinProd` double DEFAULT NULL,
  `VarMaxProd` double DEFAULT NULL,
  `VarMaxCons` double DEFAULT NULL,
  PRIMARY KEY (`IdRessource`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `région`
--

DROP TABLE IF EXISTS `région`;
CREATE TABLE IF NOT EXISTS `région` (
  `IdRegion` int(11) NOT NULL,
  `nom_region` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdRegion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `région`
--

INSERT INTO `région` (`IdRegion`, `nom_region`) VALUES
(1, 'Guadeloupe'),
(2, 'Martinique'),
(3, 'Guyane'),
(4, 'La Reunion'),
(6, 'Mayotte'),
(11, 'Ile-de-France'),
(24, 'Centre-Val de Loire'),
(27, 'Bourgogne-Franche-Comtee'),
(28, 'Normandie'),
(32, 'Hauts-de-France'),
(44, 'Grand Est'),
(52, 'Pays de la Loire'),
(53, 'Bretagne'),
(75, 'Nouvelle-Aquitaine'),
(76, 'Occitanie'),
(84, 'Auvergne-Rhone-Alpes'),
(93, 'Provence-Alpes-Cote d\'Azur'),
(94, 'Corse');

-- --------------------------------------------------------

--
-- Structure de la table `substances`
--

DROP TABLE IF EXISTS `substances`;
CREATE TABLE IF NOT EXISTS `substances` (
  `IdSubstance` int(11) NOT NULL,
  `NomSubstance` varchar(50) DEFAULT NULL,
  `VarMinCons` double DEFAULT NULL,
  `VarMinProd` double DEFAULT NULL,
  `VarMaxCons` double DEFAULT NULL,
  `VarMaxProd` double DEFAULT NULL,
  PRIMARY KEY (`IdSubstance`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeappartement`
--

DROP TABLE IF EXISTS `typeappartement`;
CREATE TABLE IF NOT EXISTS `typeappartement` (
  `IdTypeAppartement` int(11) NOT NULL,
  `Libellé` varchar(50) DEFAULT NULL,
  `IdAppartement` int(11) NOT NULL,
  PRIMARY KEY (`IdTypeAppartement`),
  KEY `IdAppartement` (`IdAppartement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typepieces`
--

DROP TABLE IF EXISTS `typepieces`;
CREATE TABLE IF NOT EXISTS `typepieces` (
  `IdTypePiece` int(11) NOT NULL,
  `NomType` varchar(50) NOT NULL,
  `IdPiece` int(11) NOT NULL,
  PRIMARY KEY (`IdTypePiece`),
  KEY `IdPiece` (`IdPiece`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `Age` int(11) NOT NULL,
  `DateCrea` datetime DEFAULT NULL,
  `EtatCompte` varchar(50) DEFAULT NULL,
  `AdresseMail` varchar(50) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Genre` varchar(50) DEFAULT NULL,
  `NumeroTel` int(11) DEFAULT NULL,
  `nom_utilisateur` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `Admin` varchar(50) NOT NULL,
  `IdVille` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`),
  KEY `IdVille` (`IdVille`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`IdUser`, `Age`, `DateCrea`, `EtatCompte`, `AdresseMail`, `Nom`, `Prenom`, `Genre`, `NumeroTel`, `nom_utilisateur`, `password`, `Admin`, `IdVille`) VALUES
(1, 20, '2021-01-13 18:39:36', 'Actif', 'Pierre.Laroche@gmail.com', 'Laroche', 'Pierre', 'Homme ', 769420545, 'PierreTheRock', 'azerty', 'administrateur', 3),
(2, 40, '2021-01-13 18:42:32', 'Actif', 'qutheo@gmail.com', 'Mischeau', 'Quentheo', 'Homme ', 712345677, 'Tesmichau', 'aaaaaaaaa', 'utilisateur', 4),
(3, 68, '2021-01-13 18:47:34', 'Actif', 'Gricha.Jaja@hotmail.fr', 'Jager', 'Gricha', 'Autre ', 654549812, 'GrichaJager', 'password', 'utilisateur', 5);

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
CREATE TABLE IF NOT EXISTS `utiliser` (
  `IdAppareil` int(11) NOT NULL,
  `IdPiece` int(11) NOT NULL,
  PRIMARY KEY (`IdAppareil`,`IdPiece`),
  KEY `IdPiece` (`IdPiece`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `IdVille` int(11) NOT NULL AUTO_INCREMENT,
  `CodePostal` int(11) DEFAULT NULL,
  `Rue` varchar(50) DEFAULT NULL,
  `num_maison` int(11) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `IdDepartement` int(11) NOT NULL,
  PRIMARY KEY (`IdVille`),
  KEY `IdDepartement` (`IdDepartement`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`IdVille`, `CodePostal`, `Rue`, `num_maison`, `ville`, `IdDepartement`) VALUES
(1, 37200, 'Jean Portalis', 64, 'Tours', 37),
(2, 37200, 'Jean Portalis', 64, 'Tours', 37),
(3, 37200, 'Jean Portalis', 64, 'Tours', 37),
(4, 13000, 'AllÃ©e du prado', 13, 'Marseille', 13),
(5, 75000, 'Allee de Versaille', 154, 'Paris', 75);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
