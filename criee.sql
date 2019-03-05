-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 05 mars 2019 à 08:53
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `criee`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `nombreLot`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `nombreLot` ()  BEGIN
	DECLARE dateActuelle datetime;
	DECLARE nbrLot INTEGER;
    DECLARE dateEn datetime;
	DECLARE iter INTEGER DEFAULT 0;
	SELECT NOW() INTO dateActuelle;
	SELECT COUNT(IdLot) INTO nbrLot FROM lot;
	WHILE iter < nbrLot DO
		SET iter = iter + 1;
		SELECT dateEnchere INTO dateEn FROM lot WHERE IdLot = iter;
		if (dateActuelle != dateEn) then
			UPDATE lot SET nbreJourLot =  DATEDIFF(dateActuelle, dateEn) where IdLot = iter;
		end IF ;
	end WHILE;
END$$

DROP PROCEDURE IF EXISTS `p_indicationQualite`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_indicationQualite` ()  BEGIN
	UPDATE 	lot
    SET IdQualite = 'or'
    WHERE nbreJourLot < 0;
    
	UPDATE lot 
    SET IdQualite = 'bo'
    WHERE nbreJourLot > 0
    AND nbreJourLot < 5; 
    
    
    UPDATE lot 
    SET IdQualite = 'mo'
    WHERE nbreJourLot > 5
    AND nbreJourLot < 10;
    
    
    UPDATE lot 
    SET IdQualite = 'ma'
    WHERE nbreJourLot > 10
    AND nbreJourLot > 15;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `IdAcheteur` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `raisonSocialeEntreprise` varchar(50) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `numRue` int(5) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` int(5) DEFAULT NULL,
  `numHabilitation` int(5) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `cgu` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IdAcheteur`, `login`, `pwd`, `raisonSocialeEntreprise`, `rue`, `numRue`, `ville`, `codePostal`, `numHabilitation`, `message`, `cgu`) VALUES
(0, 'Personne', 'test', 'test', 'test', 0, 'test', 0, 0, NULL, NULL),
(1, 'a', 'a', 'a', 'a', 1, 'a', 1, 1, NULL, NULL),
(2, 'administrateur', 'mdp', NULL, 'rue', 1, 'feg', 64000, NULL, NULL, NULL),
(3, 'miragouledead', 'mdp', NULL, 'rue', 8, 'feg', 64000, NULL, NULL, NULL),
(4, 'malex', 'a', NULL, 'a', 11, 'a', 6, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bac`
--

DROP TABLE IF EXISTS `bac`;
CREATE TABLE IF NOT EXISTS `bac` (
  `IdBac` varchar(50) NOT NULL,
  `tare` float DEFAULT NULL,
  PRIMARY KEY (`IdBac`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bac`
--

INSERT INTO `bac` (`IdBac`, `tare`) VALUES
('1', 50);

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

DROP TABLE IF EXISTS `bateau`;
CREATE TABLE IF NOT EXISTS `bateau` (
  `IdBateau` varchar(50) NOT NULL,
  `nomBateau` varchar(50) DEFAULT NULL,
  `immatriculationBateau` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdBateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`IdBateau`, `nomBateau`, `immatriculationBateau`) VALUES
('LaVoile', 'La voile', 'AAFOE465'),
('leBat', 'Obato', 'EC748ER');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `IdEspece` varchar(50) NOT NULL,
  `nomEspece` varchar(50) DEFAULT NULL,
  `nomCommunEspece` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`IdEspece`, `nomEspece`, `nomCommunEspece`) VALUES
('cbd', 'cabillaud', 'cabillaud'),
('cdm', 'chiendemer', 'Chien de mer'),
('cha', 'poisson-chat', 'Un poisson chat'),
('har', 'hareng', 'hareng'),
('mor', 'morue', 'morue'),
('sau', 'saumon', 'saumon'),
('trt', 'truite', 'truite');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `IdFacture` int(5) NOT NULL,
  `libelleFacture` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdFacture`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`IdFacture`, `libelleFacture`) VALUES
(0, NULL),
(1, NULL),
(2, 'test2'),
(3, 'test3'),
(4, 'test4');

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

DROP TABLE IF EXISTS `lot`;
CREATE TABLE IF NOT EXISTS `lot` (
  `IdLot` int(5) NOT NULL AUTO_INCREMENT,
  `IdBateau` varchar(50) NOT NULL,
  `datePeche` date NOT NULL,
  `IdEspece` varchar(50) NOT NULL,
  `IdTaille` varchar(50) DEFAULT NULL,
  `IdPresentation` varchar(50) DEFAULT NULL,
  `IdBac` varchar(50) DEFAULT NULL,
  `IdAcheteur` int(5) NOT NULL,
  `IdQualite` varchar(50) DEFAULT NULL,
  `poidsBrutLot` float DEFAULT NULL,
  `prixPlancher` float DEFAULT NULL,
  `prixDepart` float DEFAULT NULL,
  `prixActuel` float DEFAULT NULL,
  `prixEncheresMax` float DEFAULT NULL,
  `dateEnchere` datetime DEFAULT NULL,
  `dateHeureFin` datetime DEFAULT NULL,
  `codeEtat` varchar(50) DEFAULT NULL,
  `nbreJourLot` int(11) DEFAULT NULL,
  `IdFacture` int(4) DEFAULT NULL,
  PRIMARY KEY (`IdLot`,`IdBateau`,`datePeche`),
  KEY `FK_Espece_Lot` (`IdEspece`),
  KEY `FK_Bateau_Lot` (`IdBateau`,`datePeche`),
  KEY `FK_Taille_Lot` (`IdTaille`),
  KEY `fkLot_Presentation` (`IdPresentation`),
  KEY `fkLot_Bac` (`IdBac`),
  KEY `fkLot_Acheteur` (`IdAcheteur`),
  KEY `fkLot_Qualite` (`IdQualite`),
  KEY `FK_FACTURE_Lot` (`IdFacture`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`IdLot`, `IdBateau`, `datePeche`, `IdEspece`, `IdTaille`, `IdPresentation`, `IdBac`, `IdAcheteur`, `IdQualite`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixActuel`, `prixEncheresMax`, `dateEnchere`, `dateHeureFin`, `codeEtat`, `nbreJourLot`, `IdFacture`) VALUES
(1, 'leBat', '2018-12-19', 'trt', 'grd', 'pres1', '1', 1, 'ma', 60, 25, 25, 1000, 1000, '2019-01-18 15:00:00', '2019-12-25 15:00:00', 'en cours', 38, 0),
(2, 'leBat', '2018-12-19', 'trt', 'grd', 'pres1', '1', 1, 'ma', 80, 25, 25, 1500, 2500, '2019-01-09 00:00:00', '2019-12-21 16:30:00', 'en cours', 47, 0),
(3, 'leBat', '2018-12-19', 'cbd', 'grd', 'pres1', '1', 1, 'ma', 80, 50, 50, 50, 5000, '2019-01-10 00:00:00', '2019-02-08 12:00:00', 'terminé', 46, 0),
(4, 'LaVoile', '2019-01-11', 'cbd', 'grd', '2', '1', 1, 'ma', 89, 2000, 30, 30, 2000, '2019-01-11 00:00:00', '2019-01-16 00:00:00', 'terminé', 45, 3),
(5, 'LaVoile', '2019-01-11', 'har', 'grd', '2', '1', 1, 'ma', 100, 100, 50, 50, 100, '2019-02-01 00:00:00', '2019-03-02 00:00:00', 'terminé', 24, 0),
(7, 'leBat', '2018-12-19', 'cbd', 'grd', '2', '1', 2, 'ma', 100, 1000, 20, 73, 500, '2019-01-11 00:00:00', '2019-01-31 00:00:00', 'terminé', 45, 0),
(8, 'leBat', '2018-12-19', 'cdm', 'pet', '2', '1', 1, 'ma', 100, 3000, 50, 50, 3000, '2019-01-13 00:00:00', '2019-02-03 00:00:00', 'terminé', 43, 0),
(9, 'LaVoile', '2019-01-11', 'har', 'grd', '2', '1', 2, 'ma', 100, 2000, 50, 130, 2000, '2019-01-13 00:00:00', '2019-03-01 00:00:00', 'terminé', 43, 0),
(10, 'LaVoile', '2019-01-11', 'sau', 'grd', '2', '1', 1, 'ma', 100, 3000, 30, 100, 100, '2019-01-15 00:00:00', '2019-01-15 00:00:00', 'terminé', 41, 0),
(13, 'LaVoile', '2019-01-11', 'cbd', 'grd', '3', '1', 2, 'ma', 100, 1000, 25, 30, 1000, '2019-01-23 00:00:00', '2019-02-08 00:00:00', 'terminé', 33, NULL),
(14, 'LaVoile', '2019-01-11', 'cha', 'grd', '4', '1', 0, 'ma', 100, 50, 20, 20, 1000, '2020-02-20 00:00:00', '2020-03-09 00:00:00', 'en cours', 360, NULL),
(15, 'LaVoile', '2019-01-11', 'mor', 'grd', '3', '1', 0, 'bo', 100, 50, 20, 20, 1000, '2019-03-18 00:00:00', '2019-03-19 00:00:00', 'programmée', 10, NULL);

--
-- Déclencheurs `lot`
--
DROP TRIGGER IF EXISTS `prixAc`;
DELIMITER $$
CREATE TRIGGER `prixAc` BEFORE UPDATE ON `lot` FOR EACH ROW BEGIN
	IF OLD.prixActuel > NEW.prixActuel THEN
		SET NEW.prixActuel = OLD.prixActuel;
	ELSEIF OLD.prixEncheresMax < NEW.prixActuel THEN
		SET NEW.prixActuel = OLD.prixActuel;
	END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `minichat`
--

DROP TABLE IF EXISTS `minichat`;
CREATE TABLE IF NOT EXISTS `minichat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL,
  `IdAcheteur` int(5) NOT NULL,
  `dateHeure` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Acheteur` (`IdAcheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `minichat`
--

INSERT INTO `minichat` (`id`, `message`, `IdAcheteur`, `dateHeure`) VALUES
(1, 'cc', 1, '2019-02-25 14:21:59'),
(2, 'hello', 4, '2019-02-25 15:13:17');

-- --------------------------------------------------------

--
-- Structure de la table `peche`
--

DROP TABLE IF EXISTS `peche`;
CREATE TABLE IF NOT EXISTS `peche` (
  `IdBateau` varchar(50) NOT NULL,
  `datePeche` date NOT NULL,
  PRIMARY KEY (`datePeche`),
  KEY `FK_Peche_Bateau` (`IdBateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `peche`
--

INSERT INTO `peche` (`IdBateau`, `datePeche`) VALUES
('LaVoile', '2019-01-11'),
('leBat', '2018-12-19');

-- --------------------------------------------------------

--
-- Structure de la table `poster`
--

DROP TABLE IF EXISTS `poster`;
CREATE TABLE IF NOT EXISTS `poster` (
  `IdLot` int(5) NOT NULL,
  `datePeche` date DEFAULT NULL,
  `IdBateau` varchar(50) NOT NULL,
  `IdAcheteur` int(5) NOT NULL,
  `prixEnchere` float DEFAULT NULL,
  `heureEnchere` int(5) DEFAULT NULL,
  PRIMARY KEY (`IdLot`,`IdAcheteur`,`IdBateau`),
  KEY `FK_ACHETEUR_POSTER` (`IdAcheteur`),
  KEY `FK_LOT_POSTER` (`IdLot`,`IdBateau`,`datePeche`),
  KEY `FK_BATEAU_POSTER` (`IdBateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `IdPresentation` varchar(50) NOT NULL,
  `libellePresentation` varchar(50) DEFAULT NULL,
  `IdEspece` varchar(50) NOT NULL,
  PRIMARY KEY (`IdPresentation`),
  KEY `FK_Presentation_Espece` (`IdEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`IdPresentation`, `libellePresentation`, `IdEspece`) VALUES
('2', 'C\'est un bon poisson même s\'il est moche ! ', 'cha'),
('3', 'Des poissons frais !', 'cbd'),
('4', 'De bons poissons ! ', 'har'),
('pres1', 'presentation 1', 'trt');

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

DROP TABLE IF EXISTS `qualite`;
CREATE TABLE IF NOT EXISTS `qualite` (
  `IdQualite` varchar(50) NOT NULL,
  `LibelleQualite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdQualite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `qualite`
--

INSERT INTO `qualite` (`IdQualite`, `LibelleQualite`) VALUES
('bo', 'bonne'),
('ma', 'mauvaise'),
('mo', 'moyenne'),
('or', 'original');

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

DROP TABLE IF EXISTS `taille`;
CREATE TABLE IF NOT EXISTS `taille` (
  `IdTaille` varchar(50) NOT NULL,
  `specification` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdTaille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`IdTaille`, `specification`) VALUES
('grd', 'grand'),
('moy', 'moyenne'),
('pet', 'petite');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_admin`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `view_admin`;
CREATE TABLE IF NOT EXISTS `view_admin` (
`login` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_admin`
--
DROP TABLE IF EXISTS `view_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_admin`  AS  select `acheteur`.`login` AS `login` from `acheteur` where (`acheteur`.`login` = 'administrateur') ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `FK_Bateau_Lot` FOREIGN KEY (`IdBateau`,`datePeche`) REFERENCES `peche` (`IdBateau`, `datePeche`),
  ADD CONSTRAINT `FK_Espece_Lot` FOREIGN KEY (`IdEspece`) REFERENCES `espece` (`IdEspece`),
  ADD CONSTRAINT `FK_FACTURE_Lot` FOREIGN KEY (`IdFacture`) REFERENCES `facture` (`IdFacture`),
  ADD CONSTRAINT `FK_Taille_Lot` FOREIGN KEY (`IdTaille`) REFERENCES `taille` (`IdTaille`),
  ADD CONSTRAINT `fkLot_Acheteur` FOREIGN KEY (`IdAcheteur`) REFERENCES `acheteur` (`IdAcheteur`),
  ADD CONSTRAINT `fkLot_Bac` FOREIGN KEY (`IdBac`) REFERENCES `bac` (`IdBac`),
  ADD CONSTRAINT `fkLot_Presentation` FOREIGN KEY (`IdPresentation`) REFERENCES `presentation` (`IdPresentation`),
  ADD CONSTRAINT `fkLot_Qualite` FOREIGN KEY (`IdQualite`) REFERENCES `qualite` (`IdQualite`);

--
-- Contraintes pour la table `minichat`
--
ALTER TABLE `minichat`
  ADD CONSTRAINT `FK_Acheteur` FOREIGN KEY (`IdAcheteur`) REFERENCES `acheteur` (`IdAcheteur`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
