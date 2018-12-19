-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 23 Novembre 2018 à 13:57
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

drop database if exists criee;

Create database criee default character set UTF8 collate UTF8_general_ci;

Use criee;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `criee_ppe_grp1`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE `acheteur` (
  `IdAcheteur` int(5)  NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `raisonSocialeEntreprise` varchar(50) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `numRue` int(5) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` int(5) DEFAULT NULL,
  `numHabilitation` int(5) DEFAULT NULL,
  PRIMARY KEY (`IdAcheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bac`
--

CREATE TABLE `bac` (
  `IdBac` varchar(50) NOT NULL,
  `tare` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `IdBateau` varchar(50) NOT NULL,
  `nomBateau` varchar(50) DEFAULT NULL,
  `immatriculationBateau` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `IdEspece` varchar(50) NOT NULL,
  `nomEspece` varchar(50) DEFAULT NULL,
  `nomCommunEspece` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `IdLot` varchar(50) NOT NULL,
  `IdBateau` varchar(50) NOT NULL,
  `datePeche` date NOT NULL,
  `IdEspece` varchar(50) NOT NULL,
  `IdTaille` varchar(50) NOT NULL,
  `IdPresentation` varchar(50) NOT NULL,
  `IdBac` varchar(50) NOT NULL,
  `IdAcheteur` int(5) NOT NULL,
  `IdQualite` varchar(50) NOT NULL,
  `poidsBrutLot` float DEFAULT NULL,
  `prixPlancher` float DEFAULT NULL,
  `prixDepart` float DEFAULT NULL,
  `prixEncheresMax` float DEFAULT NULL,
  `dateEnchere` float DEFAULT NULL,
  `heureDebutEnchere` date DEFAULT NULL,
  `codeEtat` varchar(50) DEFAULT NULL,
  `IdFacture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `peche`
--

CREATE TABLE `peche` (
  `IdBateau` varchar(50) NOT NULL,
  `datePeche` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `poster`
--

CREATE TABLE `poster` (
  `IdLot` varchar(50) NOT NULL,
  `datePeche` date DEFAULT NULL,
  `IdBateau` varchar(50) NOT NULL,
  `IdAcheteur` int(5) NOT NULL,
  `prixEnchere` float DEFAULT NULL,
  `heureEnchere` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

CREATE TABLE `presentation` (
  `IdPresentation` varchar(50) NOT NULL,
  `libellePresentation` varchar(50) DEFAULT NULL,
  `IdEspece` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

CREATE TABLE `qualite` (
  `IdQualite` varchar(50) NOT NULL,
  `LibelleQualite` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `IdTaille` varchar(50) NOT NULL,
  `specification` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acheteur`
--


--
-- Index pour la table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`IdBac`);

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`IdBateau`);

--
-- Index pour la table `espece`
--
ALTER TABLE `espece`
  ADD PRIMARY KEY (`IdEspece`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`IdLot`,`IdBateau`,`datePeche`),
  ADD KEY `FK_Espece_Lot` (`IdEspece`),
  ADD KEY `FK_Bateau_Lot` (`IdBateau`,`datePeche`),
  ADD KEY `FK_Taille_Lot` (`IdTaille`),
  ADD KEY `fkLot_Presentation` (`IdPresentation`),
  ADD KEY `fkLot_Bac` (`IdBac`),
  ADD KEY `fkLot_Acheteur` (`IdAcheteur`),
  ADD KEY `fkLot_Qualite` (`IdQualite`);

--
-- Index pour la table `peche`
--
ALTER TABLE `peche`
  ADD PRIMARY KEY (`datePeche`),
  ADD KEY `FK_Peche_Bateau` (`IdBateau`);

--
-- Index pour la table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`IdLot`,`IdAcheteur`,`IdBateau`),
  ADD KEY `FK_ACHETEUR_POSTER` (`IdAcheteur`),
  ADD KEY `FK_LOT_POSTER` (`IdLot`,`IdBateau`,`datePeche`),
  ADD KEY `FK_BATEAU_POSTER` (`IdBateau`);

--
-- Index pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`IdPresentation`),
  ADD KEY `FK_Presentation_Espece` (`IdEspece`);

--
-- Index pour la table `qualite`
--
ALTER TABLE `qualite`
  ADD PRIMARY KEY (`IdQualite`);

--
-- Index pour la table `taille`
--
ALTER TABLE `taille`
  ADD PRIMARY KEY (`IdTaille`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `FK_Bateau_Lot` FOREIGN KEY (`IdBateau`,`datePeche`) REFERENCES `peche` (`IdBateau`, `datePeche`),
  ADD CONSTRAINT `FK_Espece_Lot` FOREIGN KEY (`IdEspece`) REFERENCES `espece` (`IdEspece`),
  ADD CONSTRAINT `FK_Taille_Lot` FOREIGN KEY (`IdTaille`) REFERENCES `taille` (`IdTaille`),
  ADD CONSTRAINT `fkLot_Acheteur` FOREIGN KEY (`IdAcheteur`) REFERENCES `acheteur` (`IdAcheteur`),
  ADD CONSTRAINT `fkLot_Bac` FOREIGN KEY (`IdBac`) REFERENCES `bac` (`IdBac`),
  ADD CONSTRAINT `fkLot_Presentation` FOREIGN KEY (`IdPresentation`) REFERENCES `presentation` (`IdPresentation`),
  ADD CONSTRAINT `fkLot_Qualite` FOREIGN KEY (`IdQualite`) REFERENCES `qualite` (`IdQualite`);

--
-- Contraintes pour la table `peche`
--
ALTER TABLE `peche`
  ADD CONSTRAINT `FK_Peche_Bateau` FOREIGN KEY (`IdBateau`) REFERENCES `bateau` (`IdBateau`);

--
-- Contraintes pour la table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `FK_ACHETEUR_POSTER` FOREIGN KEY (`IdAcheteur`) REFERENCES `acheteur` (`IdAcheteur`),
  ADD CONSTRAINT `FK_BATEAU_POSTER` FOREIGN KEY (`IdBateau`) REFERENCES `bateau` (`IdBateau`),
  ADD CONSTRAINT `FK_LOT_POSTER` FOREIGN KEY (`IdLot`,`IdBateau`,`datePeche`) REFERENCES `lot` (`IdLot`, `IdBateau`, `datePeche`);

--
-- Contraintes pour la table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `FK_Presentation_Espece` FOREIGN KEY (`IdEspece`) REFERENCES `espece` (`IdEspece`);



INSERT INTO espece values("trt","truite","truite");
INSERT INTO espece values("cbd","cabillaud","cabillaud");

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
