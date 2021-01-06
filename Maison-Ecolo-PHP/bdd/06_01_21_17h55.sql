-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 jan. 2021 à 16:53
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
  PRIMARY KEY (`IdAppartement`)
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
  `IdVille` int(11) NOT NULL,
  PRIMARY KEY (`IdDepartement`),
  KEY `IdVille` (`IdVille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `determiner`
--

DROP TABLE IF EXISTS `determiner`;
CREATE TABLE IF NOT EXISTS `determiner` (
  `IdVille` int(11) NOT NULL,
  `IdRegion` int(11) NOT NULL,
  PRIMARY KEY (`IdVille`,`IdRegion`),
  KEY `IdRegion` (`IdRegion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `IdMaison` int(11) NOT NULL,
  `NomMaison` varchar(50) DEFAULT NULL,
  `NumeroMaison` int(11) DEFAULT NULL,
  `Eval` varchar(50) DEFAULT NULL,
  `Deg_iso` varchar(50) DEFAULT NULL,
  `IdAppartement` int(11) NOT NULL,
  PRIMARY KEY (`IdMaison`),
  KEY `IdAppartement` (`IdAppartement`)
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
  `IdMaison` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  PRIMARY KEY (`IdRegion`),
  KEY `IdMaison` (`IdMaison`),
  KEY `IdUser` (`IdUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `Rue` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`IdUser`, `Age`, `DateCrea`, `EtatCompte`, `AdresseMail`, `Nom`, `Prenom`, `Genre`, `NumeroTel`, `Rue`) VALUES
(1, 20, NULL, NULL, 'pierre@gmail.com', 'Laroche', 'Pierre', 'Homme ', 706050403, NULL);

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
  `IdVille` int(11) NOT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `CodePostal` int(11) DEFAULT NULL,
  `Rue` varchar(50) DEFAULT NULL,
  `NumMaison` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdVille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
