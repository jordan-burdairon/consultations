-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 20 Avril 2018 à 17:35
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `veterinaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `idAnimal` tinyint(3) UNSIGNED NOT NULL,
  `Type` varchar(50) NOT NULL DEFAULT '',
  `PEC` float UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `animaux`
--

INSERT INTO `animaux` (`idAnimal`, `Type`, `PEC`) VALUES
(1, 'chien', 850),
(2, 'chat', 1200),
(3, 'souris', 500),
(4, 'perroquet', 420);

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `IdConsult` int(10) UNSIGNED NOT NULL,
  `Sexe` char(1) NOT NULL DEFAULT '',
  `NomClient` varchar(40) NOT NULL DEFAULT '',
  `CP` varchar(5) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `DC` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IdAnimal` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `Paye` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consultation`
--

INSERT INTO `consultation` (`IdConsult`, `Sexe`, `NomClient`, `CP`, `Ville`, `DC`, `IdAnimal`, `Paye`) VALUES
(1, 'M', 'ALAZART', '3720', 'IVRY', '1968-05-11 00:00:00', 1, 1),
(2, 'F', 'AUD', '68000', 'COLMAR', '1979-07-12 00:00:00', 3, 0),
(3, 'M', 'AUSSENAC', '34080', 'MONTPELLIER', '1978-08-13 00:00:00', 1, 1),
(4, 'M', 'BAGNOL', '13270', 'FOS', '1956-02-05 00:00:00', 4, 1),
(5, 'M', 'BAGNOL', '13100', 'ST REMY', '1978-03-06 00:00:00', 1, 1),
(6, 'F', 'BATISTE', '84100', 'ORANGE', '1958-06-07 00:00:00', 2, 1),
(7, 'M', 'Animaux Câlins', '30250', 'Le Lac', '1975-11-05 00:00:00', 2, 1),
(8, 'F', 'Jean Adams', '94000', 'IVRY', '1977-11-15 00:00:00', 4, 1),
(9, 'F', 'Bruce Adams', '12200', 'Hauterive', '1997-11-25 00:00:00', 1, 1),
(10, 'M', 'Animaux exotiques S.A.', '30000', 'Nîmes', '1999-12-05 00:00:00', 1, 1),
(11, 'F', 'Animaux Familiers', '30000', 'Nîmes', '2000-12-15 00:00:00', 2, 0),
(12, 'M', 'Aquarium de Baillargues', '84750', 'FOS', '2001-12-25 00:00:00', 4, 0),
(13, 'M', 'Stéphane Brun', '12200', 'Hauterive', '2004-01-04 00:00:00', 3, 1),
(14, 'F', 'Jean Bruneteau', '34300', 'La Montagne', '2004-01-14 00:00:00', 3, 0),
(15, 'M', 'Bow Wow House', '30250', 'Le Lac', '2004-01-24 00:00:00', 4, 1),
(16, 'M', 'Châtons Calins', '12200', 'Hauterive', '2004-02-03 00:00:00', 1, 0),
(17, 'F', 'Au Chat Malin', '30000', 'Nîmes', '2004-02-13 00:00:00', 4, 0),
(18, 'M', 'La Cuve à Poissons SARL', '34125', 'Baillargues', '2004-02-23 00:00:00', 2, 1),
(19, 'M', 'Refuge aviaire George Brun', '94000', 'IVRY', '2004-03-04 00:00:00', 1, 1),
(20, 'F', 'La Grange au Poil', '30250', 'Le Lac', '2004-03-14 00:00:00', 3, 1),
(21, 'M', 'George Grandjean', '30250', 'Le Lac', '2004-03-24 00:00:00', 3, 0),
(22, 'M', 'Ced', '1000', 'Bruxelles', '2007-06-11 00:00:00', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'bob', '$2y$10$2YlAqEwGGqWPiWKHWYVz/u3BFQcxqWTD6TEK7X5nDRUrrlLnNzyom');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`idAnimal`),
  ADD UNIQUE KEY `Type` (`Type`),
  ADD KEY `Type_2` (`Type`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`IdConsult`),
  ADD KEY `NomClient` (`NomClient`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `idAnimal` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `IdConsult` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
