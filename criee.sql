-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 17 Janvier 2019 à 12:36
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `acheteur` (
  `IdAcheteur` int(5) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `raisonSocialeEntreprise` varchar(50) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `numRue` int(5) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` int(5) DEFAULT NULL,
  `numHabilitation` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acheteur`
--

INSERT INTO `acheteur` (`IdAcheteur`, `login`, `pwd`, `raisonSocialeEntreprise`, `rue`, `numRue`, `ville`, `codePostal`, `numHabilitation`) VALUES
(1, 'a', 'a', 'a', 'a', 1, 'a', 1, 1),
(2, 'administrateur', 'mdp', NULL, 'rue', 1, 'feg', 64000, NULL),
(3, 'miragouledead', 'mdp', NULL, 'rue', 11, 'feg', 64000, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bac`
--

CREATE TABLE `bac` (
  `IdBac` varchar(50) NOT NULL,
  `tare` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bac`
--

INSERT INTO `bac` (`IdBac`, `tare`) VALUES
('1', 50);

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `IdBateau` varchar(50) NOT NULL,
  `nomBateau` varchar(50) DEFAULT NULL,
  `immatriculationBateau` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bateau`
--

INSERT INTO `bateau` (`IdBateau`, `nomBateau`, `immatriculationBateau`) VALUES
('leBat', 'Obato', 'EC748ER');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `IdEspece` varchar(50) NOT NULL,
  `nomEspece` varchar(50) DEFAULT NULL,
  `nomCommunEspece` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `espece`
--

INSERT INTO `espece` (`IdEspece`, `nomEspece`, `nomCommunEspece`) VALUES
('cbd', 'cabillaud', 'cabillaud'),
('cha', 'Poisson chat', 'Un poisson chat'),
('trt', 'truite', 'truite');

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `IdLot` int(5) NOT NULL,
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
  `prixActuel` float DEFAULT NULL,
  `prixEncheresMax` float DEFAULT NULL,
  `dateEnchere` datetime DEFAULT NULL,
  `dateHeureFin` datetime DEFAULT NULL,
  `codeEtat` varchar(50) DEFAULT NULL,
  `IdFacture` varchar(50) DEFAULT NULL,
  `nbreJourLot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lot`
--

INSERT INTO `lot` (`IdLot`, `IdBateau`, `datePeche`, `IdEspece`, `IdTaille`, `IdPresentation`, `IdBac`, `IdAcheteur`, `IdQualite`, `poidsBrutLot`, `prixPlancher`, `prixDepart`, `prixActuel`, `prixEncheresMax`, `dateEnchere`, `dateHeureFin`, `codeEtat`, `IdFacture`, `nbreJourLot`) VALUES
(1, 'leBat', '2018-12-19', 'trt', 'grd', 'pres1', '1', 1, 'ma', 60, 25, 25, 1000, 1000, '2019-01-05 12:00:00', '2019-12-25 15:00:00', 'en cours', '154', 12),
(2, 'leBat', '2018-12-19', 'trt', 'grd', 'pres1', '1', 1, 'mo', 89, 25, 25, 1015, 2500, '2019-01-09 15:00:00', '2019-12-21 16:30:00', 'en cours', '154', 8),
(3, 'leBat', '2018-12-19', 'cbd', 'grd', 'pres1', '1', 1, 'or', 60, 50, 50, 50, 5000, '2019-02-08 10:00:00', '2019-02-08 12:00:00', 'programmée', '541', -22),
(4, 'leBat', '2018-12-19', 'trt', 'grd', 'pres1', '1', 1, 'ma', 54, 75, 75, 150, 3500, '2018-12-20 15:30:00', '2019-01-16 16:00:00', 'terminé', '154', 28),
(5, 'leBat', '2018-12-19', 'cbd', 'grd', 'pres1', '1', 1, 'ma', 300, 70, 70, 70, 6500, '2018-01-08 10:00:00', '2018-01-08 12:00:00', 'terminé', '541', 374),
(6, 'leBat', '2018-12-19', 'cha', 'grd', 'pres1', '1', 1, 'ma', 100, 1000, 25, 100, 1000, '2018-12-21 00:00:00', '2019-01-21 00:00:00', 'en cours', '66', 27),
(7, 'leBat', '2018-12-19', 'cbd', 'grd', '2', '1', 1, 'bo', 100, 1000, 20, 20, 500, '2019-01-16 00:00:00', '2019-01-31 00:00:00', 'en cours', '100', 1);

--
-- Déclencheurs `lot`
--
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
-- Structure de la table `peche`
--

CREATE TABLE `peche` (
  `IdBateau` varchar(50) NOT NULL,
  `datePeche` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `peche`
--

INSERT INTO `peche` (`IdBateau`, `datePeche`) VALUES
('leBat', '2018-12-19');

-- --------------------------------------------------------

--
-- Structure de la table `poster`
--

CREATE TABLE `poster` (
  `IdLot` int(5) NOT NULL,
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

--
-- Contenu de la table `presentation`
--

INSERT INTO `presentation` (`IdPresentation`, `libellePresentation`, `IdEspece`) VALUES
('2', 'C\'est un bon poisson même s\'il est moche ! ', 'cha'),
('pres1', 'presentation 1', 'trt');

-- --------------------------------------------------------

--
-- Structure de la table `qualite`
--

CREATE TABLE `qualite` (
  `IdQualite` varchar(50) NOT NULL,
  `LibelleQualite` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `qualite`
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

CREATE TABLE `taille` (
  `IdTaille` varchar(50) NOT NULL,
  `specification` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `taille`
--

INSERT INTO `taille` (`IdTaille`, `specification`) VALUES
('grd', 'grand'),
('moy', 'moyenne'),
('pet', 'petite');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_admin`
--
CREATE TABLE `view_admin` (
`login` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_admin`
--
DROP TABLE IF EXISTS `view_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_admin`  AS  select `acheteur`.`login` AS `login` from `acheteur` where (`acheteur`.`login` = 'administrateur') ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`IdAcheteur`);

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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acheteur`
--
ALTER TABLE `acheteur`
  MODIFY `IdAcheteur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `IdLot` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
