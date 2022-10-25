-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 25 oct. 2022 à 08:20
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crudajax`
--

-- --------------------------------------------------------

--
-- Structure de la table `bateaux`
--

CREATE TABLE `bateaux` (
  `ID` int(20) NOT NULL,
  `Nombateau` varchar(100) NOT NULL,
  `Marque` varchar(200) NOT NULL,
  `categories` varchar(10) NOT NULL,
  `chargemax` varchar(20) NOT NULL,
  `chargemin` varchar(20) NOT NULL,
  `typeproduit` varchar(100) NOT NULL,
  `numQuai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `quai`
--

CREATE TABLE `quai` (
  `NumQuai` int(11) NOT NULL,
  `Capacite` varchar(30) NOT NULL,
  `ville` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quai`
--

INSERT INTO `quai` (`NumQuai`, `Capacite`, `ville`) VALUES
(1, '3 Navires', 'Toamasina'),
(2, '1 Navire', 'Toamasina');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bateaux`
--
ALTER TABLE `bateaux`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `numQuai` (`numQuai`);

--
-- Index pour la table `quai`
--
ALTER TABLE `quai`
  ADD PRIMARY KEY (`NumQuai`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateaux`
--
ALTER TABLE `bateaux`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `quai`
--
ALTER TABLE `quai`
  MODIFY `NumQuai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bateaux`
--
ALTER TABLE `bateaux`
  ADD CONSTRAINT `bateaux_ibfk_1` FOREIGN KEY (`numQuai`) REFERENCES `bateaux` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
