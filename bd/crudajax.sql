-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 nov. 2022 à 21:33
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
  `NumQuai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bateaux`
--

INSERT INTO `bateaux` (`ID`, `Nombateau`, `Marque`, `categories`, `chargemax`, `chargemin`, `typeproduit`, `NumQuai`) VALUES
(3, 'sambo', 'botry', 'B', '21113', '11313', 'Produit métallurgiques', 1);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `IDchauffeur` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Adresse` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `codeClient` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Adresse` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `engin`
--

CREATE TABLE `engin` (
  `numMatricule` int(11) NOT NULL,
  `typesEngin` varchar(20) NOT NULL,
  `chauffeur` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

CREATE TABLE `magasin` (
  `idMagasin` int(11) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `machandiseEntree` varchar(20) NOT NULL,
  `marchandiseSortie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `marchandise`
--

CREATE TABLE `marchandise` (
  `codeMarchandise` int(11) NOT NULL,
  `bateau` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `typesMarchandise` varchar(20) NOT NULL,
  `quantite` varchar(20) NOT NULL
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

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `numTransport` int(11) NOT NULL,
  `dateTransport` varchar(20) NOT NULL,
  `machandise` int(11) NOT NULL,
  `vehicule` int(11) NOT NULL,
  `magasin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bateaux`
--
ALTER TABLE `bateaux`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NumQuai` (`NumQuai`);

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`IDchauffeur`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`codeClient`);

--
-- Index pour la table `engin`
--
ALTER TABLE `engin`
  ADD PRIMARY KEY (`numMatricule`),
  ADD KEY `chauffeur` (`chauffeur`);

--
-- Index pour la table `magasin`
--
ALTER TABLE `magasin`
  ADD PRIMARY KEY (`idMagasin`);

--
-- Index pour la table `marchandise`
--
ALTER TABLE `marchandise`
  ADD PRIMARY KEY (`codeMarchandise`),
  ADD KEY `bateau` (`bateau`);

--
-- Index pour la table `quai`
--
ALTER TABLE `quai`
  ADD PRIMARY KEY (`NumQuai`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`numTransport`),
  ADD KEY `machandise` (`machandise`,`vehicule`,`magasin`),
  ADD KEY `transportvehicule` (`vehicule`),
  ADD KEY `transportmagasin` (`magasin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateaux`
--
ALTER TABLE `bateaux`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `IDchauffeur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magasin`
--
ALTER TABLE `magasin`
  MODIFY `idMagasin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marchandise`
--
ALTER TABLE `marchandise`
  MODIFY `codeMarchandise` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `quaibateau` FOREIGN KEY (`NumQuai`) REFERENCES `quai` (`NumQuai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`codeClient`) REFERENCES `magasin` (`idMagasin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `engin`
--
ALTER TABLE `engin`
  ADD CONSTRAINT `chauffeurengin` FOREIGN KEY (`chauffeur`) REFERENCES `chauffeur` (`IDchauffeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `marchandise`
--
ALTER TABLE `marchandise`
  ADD CONSTRAINT `marchandise_ibfk_1` FOREIGN KEY (`bateau`) REFERENCES `bateaux` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transportmagasin` FOREIGN KEY (`magasin`) REFERENCES `magasin` (`idMagasin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportmarchandise` FOREIGN KEY (`machandise`) REFERENCES `marchandise` (`codeMarchandise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportvehicule` FOREIGN KEY (`vehicule`) REFERENCES `engin` (`numMatricule`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
