-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 11 Février 2020 à 14:37
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Croiss`
--

-- --------------------------------------------------------

--
-- Structure de la table `Class`
--

CREATE TABLE `Class` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Class`
--

INSERT INTO `Class` (`id`, `name`) VALUES
(1, 'IMR1');

-- --------------------------------------------------------

--
-- Structure de la table `Croissantage`
--

CREATE TABLE `Croissantage` (
  `id` int(11) NOT NULL,
  `idCed` int(11) NOT NULL COMMENT 'Croissanted person',
  `idCer` int(11) NOT NULL COMMENT 'person who croissanted, the croissanter',
  `dateC` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateCommand` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Deadline for pastry choice ',
  `deadline` date NOT NULL COMMENT 'max date to bring the command'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Croissantage`
--

INSERT INTO `Croissantage` (`id`, `idCed`, `idCer`, `dateC`, `dateCommand`, `deadline`) VALUES
(1, 1, 2, '2019-01-16 07:30:41', '2019-01-18 07:30:41', '2019-02-02');

-- --------------------------------------------------------

--
-- Structure de la table `CurrentCommand`
--

CREATE TABLE `CurrentCommand` (
  `id` int(11) NOT NULL,
  `idCroissantage` int(11) NOT NULL,
  `pastryType` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `PastryCommandItems`
--

CREATE TABLE `PastryCommandItems` (
  `nb` int(11) NOT NULL DEFAULT '0',
  `idType` int(11) NOT NULL,
  `idC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `PastryCommandItems`
--

INSERT INTO `PastryCommandItems` (`nb`, `idType`, `idC`) VALUES
(42, 1, 1),
(0, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `PastryType`
--

CREATE TABLE `PastryType` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `PastryType`
--

INSERT INTO `PastryType` (`id`, `name`, `isAvailable`) VALUES
(1, 'Pain au Chocolat', 1),
(2, 'Croissant', 1),
(3, 'Chocolatine', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Promo`
--

CREATE TABLE `Promo` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL DEFAULT '1986',
  `idClass` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Promo`
--

INSERT INTO `Promo` (`id`, `year`, `idClass`, `idStudent`) VALUES
(1, 1986, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Rights`
--

CREATE TABLE `Rights` (
  `id` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `role` enum('Admin','BDE','Delegue','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Rights`
--

INSERT INTO `Rights` (`id`, `idS`, `role`) VALUES
(1, 1, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `Student`
--

CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `pwd` char(32) NOT NULL,
  `defaultPastry` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Student`
--

INSERT INTO `Student` (`id`, `login`, `alias`, `pwd`, `defaultPastry`) VALUES
(1, 'max', 'mad', 'ab4f63f9ac65152575886860dde480a1', NULL),
(2, 'min', 'plop', 'ab4f63f9ac65152575886860dde480a1', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Croissantage`
--
ALTER TABLE `Croissantage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Croissanted` (`idCed`),
  ADD KEY `FK_Croissanter` (`idCer`);

--
-- Index pour la table `CurrentCommand`
--
ALTER TABLE `CurrentCommand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CmdStudent` (`idStudent`),
  ADD KEY `FK_CmdPastryType` (`pastryType`),
  ADD KEY `FK_CmdCroissantage` (`idCroissantage`);

--
-- Index pour la table `PastryCommandItems`
--
ALTER TABLE `PastryCommandItems`
  ADD KEY `FK_TypeItem` (`idType`),
  ADD KEY `FK_CroissantageItem` (`idC`);

--
-- Index pour la table `PastryType`
--
ALTER TABLE `PastryType`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Class` (`idClass`),
  ADD KEY `FK_StudentPromo` (`idStudent`);

--
-- Index pour la table `Rights`
--
ALTER TABLE `Rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Right_Student` (`idS`);

--
-- Index pour la table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `U_alias` (`alias`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Class`
--
ALTER TABLE `Class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Croissantage`
--
ALTER TABLE `Croissantage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `CurrentCommand`
--
ALTER TABLE `CurrentCommand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `PastryType`
--
ALTER TABLE `PastryType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Promo`
--
ALTER TABLE `Promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Rights`
--
ALTER TABLE `Rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Croissantage`
--
ALTER TABLE `Croissantage`
  ADD CONSTRAINT `FK_Croissanted` FOREIGN KEY (`idCed`) REFERENCES `Student` (`id`),
  ADD CONSTRAINT `FK_Croissanter` FOREIGN KEY (`idCer`) REFERENCES `Student` (`id`);

--
-- Contraintes pour la table `CurrentCommand`
--
ALTER TABLE `CurrentCommand`
  ADD CONSTRAINT `FK_CmdCroissantage` FOREIGN KEY (`idCroissantage`) REFERENCES `Croissantage` (`id`),
  ADD CONSTRAINT `FK_CmdPastryType` FOREIGN KEY (`pastryType`) REFERENCES `PastryType` (`id`),
  ADD CONSTRAINT `FK_CmdStudent` FOREIGN KEY (`idStudent`) REFERENCES `Student` (`id`);

--
-- Contraintes pour la table `PastryCommandItems`
--
ALTER TABLE `PastryCommandItems`
  ADD CONSTRAINT `FK_CroissantageItem` FOREIGN KEY (`idC`) REFERENCES `Croissantage` (`id`),
  ADD CONSTRAINT `FK_TypeItem` FOREIGN KEY (`idType`) REFERENCES `PastryType` (`id`);

--
-- Contraintes pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD CONSTRAINT `FK_Class` FOREIGN KEY (`idClass`) REFERENCES `Class` (`id`),
  ADD CONSTRAINT `FK_StudentPromo` FOREIGN KEY (`idStudent`) REFERENCES `Student` (`id`);

--
-- Contraintes pour la table `Rights`
--
ALTER TABLE `Rights`
  ADD CONSTRAINT `FK_Right_Student` FOREIGN KEY (`idS`) REFERENCES `Student` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
