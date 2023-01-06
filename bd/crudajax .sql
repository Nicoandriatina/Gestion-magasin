-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 06 jan. 2023 à 06:08
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

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
  `ID` int(11) NOT NULL,
  `Nombateau` varchar(30) NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `categories` varchar(20) NOT NULL,
  `chargemax` varchar(10) NOT NULL,
  `datetimes` datetime NOT NULL,
  `typeproduit` varchar(100) NOT NULL,
  `NumQuai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bateaux`
--

INSERT INTO `bateaux` (`ID`, `Nombateau`, `Marque`, `categories`, `chargemax`, `datetimes`, `typeproduit`, `NumQuai`) VALUES
(1, 'MV joby', 'MCCL', 'A', '1000', '2022-12-13 10:54:00', 'Produit Forestiers', 1),
(2, ' MORGES', 'LA SEAL', 'A', '10000', '2022-09-29 12:42:00', 'Produit Alimentaires', 1),
(3, 'BAO SHUN', 'SSA', 'A', '20000', '2022-11-08 20:06:00', 'Produit Alimentaires', 3),
(4, 'TIDJANY', 'ALY AHMED', 'A', '30000', '2022-11-01 08:07:00', 'Produit Forestiers', 4),
(5, 'BARGE EXPRESS', 'BOLLORE', 'A', '10000', '2022-10-14 03:10:00', 'Produit Alimentaires', 4),
(6, 'AMORY', 'CELERO', '1', '20000', '2022-10-12 21:11:00', 'Produit Alimentaires', 8),
(7, 'BALTIC TRADER', 'MCCL', 'A', '10000', '2022-12-14 22:16:00', 'Produit Alimentaires', 2),
(8, 'FUMIKA', 'GMS', 'A', '10000', '2022-11-07 21:19:00', 'Produit Alimentaires', 4),
(9, 'SERAYA', 'GMS', 'A', '20000', '2022-10-05 22:59:00', 'Produit Alimentaires', 8),
(11, 'MAHATSANGY', 'BOLLORE', 'A', '5000', '2022-10-23 21:45:00', 'Produit Alimentaires', 3),
(12, 'HAFNIA AFRICA', 'STURROCK ', 'A', '50000', '2022-11-16 21:46:00', 'Produit métallurgiques', 5),
(13, '| MERATUS JAYAKARTA', 'SSA', 'A', '15000', '2023-01-05 16:53:00', 'Produit Alimentaires', 3),
(14, ' IVS CRIMSON CREEK', ' JET', 'A', '25000', '2022-12-08 22:03:00', 'Produit Alimentaires', 1),
(15, 'KIARA', 'CMA CGM', '', '14000', '2022-11-25 17:05:00', 'Produit métallurgiques', 4),
(16, 'MAERSK DOUALA', 'SSA', 'A', '18000', '2022-11-17 22:06:00', 'Produit Alimentaires', 4),
(17, 'ALLIANCE NORFOLK', ' BOLLORE', 'A', '15000', '0000-00-00 00:00:00', 'Produit métallurgiques', 3),
(18, 'KOTA NEBULA', 'LA SEAL', 'A', '4200', '2022-12-02 19:40:00', 'Produit Alimentaires', 3),
(19, 'HAFNIA AFRICA ', ' STURROCK', 'A', '32000', '2022-11-25 17:43:00', 'Produit Alimentaires', 3);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `IDchauffeur` int(11) NOT NULL,
  `matChauffeur` int(11) NOT NULL,
  `Nom` varchar(40) NOT NULL,
  `Adresse` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`IDchauffeur`, `matChauffeur`, `Nom`, `Adresse`) VALUES
(1, 2018071, 'Nick', 'Tanambao V');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `codeClient` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Adresse` varchar(20) NOT NULL,
  `statClient` int(11) NOT NULL,
  `nifClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`codeClient`, `Nom`, `Adresse`, `statClient`, `nifClient`) VALUES
(1, 'Societe NH', 'Tanambao V', 1232421, 12323123);

-- --------------------------------------------------------

--
-- Structure de la table `engin`
--

CREATE TABLE `engin` (
  `numMatricule` int(11) NOT NULL,
  `numInventaire` int(11) NOT NULL,
  `typesEngin` varchar(20) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `chauffeur` int(11) NOT NULL,
  `dateAquis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `engin`
--

INSERT INTO `engin` (`numMatricule`, `numInventaire`, `typesEngin`, `marque`, `chauffeur`, `dateAquis`) VALUES
(1, 125, 'Tracteurs portuaire', 'HYSTER', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `magasinentree`
--

CREATE TABLE `magasinentree` (
  `idMagEntree` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `codeMarchandise` int(11) NOT NULL,
  `typesMarchandise` varchar(20) NOT NULL,
  `nombreSacs` int(11) NOT NULL,
  `dateEntree` datetime NOT NULL,
  `numInventaire` int(11) NOT NULL,
  `matriculeChauffeur` int(11) NOT NULL,
  `dateNav` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `magasinsortie`
--

CREATE TABLE `magasinsortie` (
  `idMagSortie` int(11) NOT NULL,
  `Nom` varchar(10) NOT NULL,
  `codeMarchandise` int(11) NOT NULL,
  `nombreSacs` int(11) NOT NULL,
  `numInventaire` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `statClient` int(11) NOT NULL,
  `dateSortie` date NOT NULL
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
  `nombreSacs` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `marchandise`
--

INSERT INTO `marchandise` (`codeMarchandise`, `bateau`, `libelle`, `typesMarchandise`, `nombreSacs`, `quantite`) VALUES
(2, 1, 'Vary', 'Produit Alimentaires', 2000, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `quai`
--

CREATE TABLE `quai` (
  `NumQuai` int(11) NOT NULL,
  `Capacite` varchar(30) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `occupation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quai`
--

INSERT INTO `quai` (`NumQuai`, `Capacite`, `ville`, `occupation`) VALUES
(1, '2 Navire', 'Toamasina', 'oui'),
(2, '1Navire', 'Toamasina', 'oui'),
(3, '4Navire', 'Toamasina', 'oui'),
(4, '3Navire', 'Mahajanga', 'non'),
(5, '2Navire', 'Toliara', 'non'),
(6, '3Navire', 'Antsiranana', 'non'),
(7, '1 Navire', 'Toamasina', 'oui'),
(8, '2Navire', 'Toamasina', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `numTransport` int(11) NOT NULL,
  `dateTransport` datetime NOT NULL,
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
-- Index pour la table `magasinentree`
--
ALTER TABLE `magasinentree`
  ADD PRIMARY KEY (`idMagEntree`),
  ADD KEY `codeMarchandise` (`codeMarchandise`);

--
-- Index pour la table `magasinsortie`
--
ALTER TABLE `magasinsortie`
  ADD PRIMARY KEY (`idMagSortie`),
  ADD KEY `client` (`client`);

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
  ADD KEY `machandise` (`machandise`),
  ADD KEY `vehicule` (`vehicule`),
  ADD KEY `magasin` (`magasin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateaux`
--
ALTER TABLE `bateaux`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `IDchauffeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `codeClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `magasinentree`
--
ALTER TABLE `magasinentree`
  MODIFY `idMagEntree` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magasinsortie`
--
ALTER TABLE `magasinsortie`
  MODIFY `idMagSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `marchandise`
--
ALTER TABLE `marchandise`
  MODIFY `codeMarchandise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `quai`
--
ALTER TABLE `quai`
  MODIFY `NumQuai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `numTransport` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bateaux`
--
ALTER TABLE `bateaux`
  ADD CONSTRAINT `quaibateau` FOREIGN KEY (`NumQuai`) REFERENCES `quai` (`NumQuai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `engin`
--
ALTER TABLE `engin`
  ADD CONSTRAINT `chauffeurengin` FOREIGN KEY (`chauffeur`) REFERENCES `chauffeur` (`IDchauffeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magasinentree`
--
ALTER TABLE `magasinentree`
  ADD CONSTRAINT `entreesortie` FOREIGN KEY (`idMagEntree`) REFERENCES `magasinsortie` (`idMagSortie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magasinsortie`
--
ALTER TABLE `magasinsortie`
  ADD CONSTRAINT `magasinclient` FOREIGN KEY (`client`) REFERENCES `client` (`codeClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `marchandise`
--
ALTER TABLE `marchandise`
  ADD CONSTRAINT `marchandisebateau` FOREIGN KEY (`bateau`) REFERENCES `bateaux` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transportmagasin` FOREIGN KEY (`magasin`) REFERENCES `magasinentree` (`idMagEntree`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportmarchandise` FOREIGN KEY (`machandise`) REFERENCES `marchandise` (`codeMarchandise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportvehicule` FOREIGN KEY (`vehicule`) REFERENCES `engin` (`numMatricule`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
