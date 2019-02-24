-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 07 Février 2019 à 20:55
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.2.10-1+0~20181001133118.7+stretch~1.gbpb6e829

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `soares`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `Id` int(5) NOT NULL,
  `NomCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`Id`, `NomCat`) VALUES
(1, 'Ordinateur fixe'),
(2, 'Ordinateur portable'),
(3, 'Imprimante'),
(4, 'Scanner');

-- --------------------------------------------------------

--
-- Structure de la table `demande_emprunt`
--

CREATE TABLE `demande_emprunt` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `id_materiel` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `idEmprunt` int(11) NOT NULL,
  `DatePret` date NOT NULL,
  `DateRetourDemander` date NOT NULL,
  `DateRetourEffectif` date DEFAULT NULL,
  `idEmprunteur` int(11) DEFAULT NULL,
  `Id` int(11) DEFAULT NULL,
  `Statut_emprunt` int(3) DEFAULT NULL,
  `Incident` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`idEmprunt`, `DatePret`, `DateRetourDemander`, `DateRetourEffectif`, `idEmprunteur`, `Id`, `Statut_emprunt`, `Incident`) VALUES
(1, '2018-08-16', '2019-01-19', '2018-11-14', 1, 34, 0, NULL),
(3, '2018-11-16', '2021-01-01', '2018-11-18', 1, 35, 0, NULL),
(4, '2018-11-18', '2013-08-01', '2018-11-18', 5, 36, 0, NULL),
(5, '2018-11-17', '2019-01-01', '2018-11-18', 1, 34, 0, NULL),
(6, '2018-11-18', '2019-04-03', '2018-11-18', 7, 36, 0, NULL),
(7, '2018-11-18', '2020-05-06', NULL, 7, 36, 0, NULL),
(8, '2018-11-18', '2020-04-01', '2018-11-18', 3, 35, 0, NULL),
(9, '2018-11-18', '2017-04-09', '2018-11-18', 3, 34, 0, NULL),
(10, '2018-12-14', '2013-01-01', NULL, 2, 34, 0, NULL),
(11, '2019-01-23', '2019-01-01', '2019-01-23', 5, 35, 0, NULL),
(12, '2019-02-05', '2019-05-05', NULL, 28, 35, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `emprunteur`
--

CREATE TABLE `emprunteur` (
  `idEmprunteur` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Formation` varchar(50) NOT NULL,
  `nom_connexion` varchar(10) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `droit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `emprunteur`
--

INSERT INTO `emprunteur` (`idEmprunteur`, `Nom`, `Prenom`, `Formation`, `nom_connexion`, `password`, `droit`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'root', 1),
(2, 'soares', 'francis', 'STMG', NULL, NULL, 0),
(3, 'Upton', 'Vladimir', 'Donec tincidunt.', NULL, NULL, 0),
(4, 'Myles', 'Chaney', 'dolor. Fusce', NULL, NULL, 0),
(5, 'Farrah', 'Breanna', 'arcu. Nunc', NULL, NULL, 0),
(6, 'Nasim', 'Diana', 'nec, leo.', NULL, NULL, 0),
(7, 'Kirestin', 'Alyssa', 'nostra, per', NULL, NULL, 0),
(8, 'Deanna', 'Jennifer', 'risus. Donec', NULL, NULL, 0),
(9, 'Allistair', 'Candace', 'ut aliquam', NULL, NULL, 0),
(10, 'Wilma', 'April', 'eleifend egestas.', NULL, NULL, 0),
(11, 'Jonah', 'Lamar', 'vehicula et,', NULL, NULL, 0),
(12, 'Macy', 'Declan', 'tortor. Nunc', NULL, NULL, 0),
(13, 'Yvonne', 'Grady', 'molestie arcu.', NULL, NULL, 0),
(14, 'Alec', 'Illiana', 'ante ipsum', NULL, NULL, 0),
(15, 'Emery', 'James', 'Curabitur massa.', NULL, NULL, 0),
(16, 'Gray', 'Patrick', 'sit amet', NULL, NULL, 0),
(17, 'Mohammad', 'Jennifer', 'dapibus id,', NULL, NULL, 0),
(18, 'Cedric', 'Lars', 'vitae sodales', NULL, NULL, 0),
(19, 'Charlotte', 'Melinda', 'enim commodo', NULL, NULL, 0),
(20, 'Benedict', 'Blake', 'dolor. Fusce', NULL, NULL, 0),
(21, 'Ori', 'Hammett', 'non arcu.', NULL, NULL, 0),
(22, 'Fiona', 'Kasimir', 'gravida mauris', NULL, NULL, 0),
(23, 'TaShya', 'Iola', 'iaculis enim,', NULL, NULL, 0),
(24, 'Orla', 'Kerry', 'habitant morbi', NULL, NULL, 0),
(25, 'Mariam', 'Mari', 'pede. Cum', NULL, NULL, 0),
(26, 'Cairo', 'Yeo', 'neque sed', NULL, NULL, 0),
(27, 'Ainsley', 'Connor', 'vitae odio', NULL, NULL, 0),
(28, 'Ali', 'Kyla', 'auctor velit.', NULL, NULL, 0),
(29, 'Inez', 'India', 'et, rutrum', NULL, NULL, 0),
(30, 'Seth', 'Imani', 'enim. Nunc', NULL, NULL, 0),
(31, 'Wallace', 'Gwendolyn', 'arcu imperdiet', NULL, NULL, 0),
(32, 'Clarke', 'Nathan', 'purus mauris', NULL, NULL, 0),
(33, 'Shea', 'Hollee', 'suscipit nonummy.', NULL, NULL, 0),
(34, 'Nasim', 'Mannix', 'ac libero', NULL, NULL, 0),
(35, 'Noelani', 'Dean', 'tellus faucibus', NULL, NULL, 0),
(36, 'Amaya', 'Celeste', 'nibh. Donec', NULL, NULL, 0),
(37, 'Beverly', 'Phelan', 'netus et', NULL, NULL, 0),
(38, 'Arthur', 'Chaim', 'nisi. Mauris', NULL, NULL, 0),
(39, 'Ciara', 'Alana', 'Curabitur vel', NULL, NULL, 0),
(40, 'Conan', 'Brianna', 'pretium et,', NULL, NULL, 0),
(41, 'Alea', 'Lillian', 'bibendum. Donec', NULL, NULL, 0),
(42, 'Jackson', 'Russell', 'non, egestas', NULL, NULL, 0),
(43, 'Neville', 'Hadassah', 'egestas nunc', NULL, NULL, 0),
(44, 'Hope', 'Nina', 'at sem', NULL, NULL, 0),
(45, 'Deacon', 'August', 'Praesent eu', NULL, NULL, 0),
(46, 'Georgia', 'Dana', 'fermentum risus,', NULL, NULL, 0),
(47, 'Kiara', 'Wayne', 'nec urna', NULL, NULL, 0),
(48, 'Josiah', 'Kylynn', 'elit. Curabitur', NULL, NULL, 0),
(49, 'Kerry', 'Xena', 'eleifend vitae,', NULL, NULL, 0),
(50, 'Ebony', 'Tatiana', 'est. Mauris', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Etat`
--

CREATE TABLE `Etat` (
  `id` int(5) NOT NULL,
  `libelle` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Etat`
--

INSERT INTO `Etat` (`id`, `libelle`) VALUES
(0, 'test'),
(1, 'Neuf'),
(2, 'Très bon'),
(3, 'Bon'),
(4, 'Correct'),
(5, 'HS');

-- --------------------------------------------------------

--
-- Structure de la table `Marque`
--

CREATE TABLE `Marque` (
  `id` int(5) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Marque`
--

INSERT INTO `Marque` (`id`, `libelle`) VALUES
(1, 'APPLE'),
(2, 'MICROSOFT'),
(3, 'HP'),
(4, 'EPSON'),
(5, 'DELL'),
(6, 'ASUS');

-- --------------------------------------------------------

--
-- Structure de la table `Materiel`
--

CREATE TABLE `Materiel` (
  `Id` int(11) NOT NULL,
  `Categorie` int(5) NOT NULL,
  `Marque` int(1) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `Provenance` varchar(50) NOT NULL,
  `Etat` int(5) NOT NULL,
  `StatutEmprunt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Materiel`
--

INSERT INTO `Materiel` (`Id`, `Categorie`, `Marque`, `description`, `Provenance`, `Etat`, `StatutEmprunt`) VALUES
(34, 3, 3, 'blue colors', 'Mozambique', 1, 1),
(35, 3, 4, '2000X', 'Liberia', 1, 1),
(36, 3, 3, 'jet 1000', 'Burundi', 1, 1),
(37, 3, 3, 'Tango X', 'Bouvet Island', 1, 0),
(38, 3, 3, 'Envy ', 'Faroe Islands', 1, 0),
(39, 3, 4, 'ECO TANK-4700', 'Lesotho', 1, 0),
(40, 3, 4, 'WOKFORCE PRO', 'Dominica', 1, 0),
(41, 3, 4, 'expression premium XP 7100', 'Fiji', 2, 0),
(42, 4, 3, 'Scanjet Pro 2000', 'Costa Rica', 2, 0),
(43, 4, 3, 'Scanjet pro 3000', 'Mauritania', 3, 0),
(44, 4, 4, 'Fastfoto FF-680W', 'Seychelles', 1, 0),
(45, 1, 1, 'Imac 27P', 'France', 1, 0),
(46, 1, 1, 'Mac Mini', 'Marshall Islands', 1, 0),
(47, 2, 2, 'Surface 6', 'French Southern Territories', 1, 0),
(48, 1, 5, '4UM66EA', 'Niger', 2, 0),
(49, 1, 3, 'Omen 880-131NF', 'El Salvador', 3, 0),
(50, 2, 1, 'Macbook pro 2018 15P', 'Nigeria', 3, 0),
(51, 2, 1, 'Macbook air 2015 ', 'Chine', 4, 0),
(52, 2, 2, 'chromeBook', 'Chine', 1, 0),
(53, 1, 6, 'GL12 CP-FR118T', 'Chine', 1, 0),
(54, 1, 6, 'V241ICUK', 'Pekin', 2, 0),
(55, 1, 6, 'G11DF-FR172T', 'Pekin', 3, 0),
(59, 3, 1, 'Macbook pro 2016', 'Bop city', 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `statut_demande_emprunt`
--

CREATE TABLE `statut_demande_emprunt` (
  `id` int(11) UNSIGNED NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `statut_demande_emprunt`
--

INSERT INTO `statut_demande_emprunt` (`id`, `libelle`) VALUES
(0, 'Demande en cours'),
(1, 'Valider'),
(2, 'Refuser');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `V_Materiel`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `V_Materiel` (
`Id` int(11)
,`Categorie` varchar(50)
,`Marque` varchar(30)
,`description` varchar(50)
,`Etat` char(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `V_Materiel`
--
DROP TABLE IF EXISTS `V_Materiel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`soares`@`%` SQL SECURITY DEFINER VIEW `V_Materiel`  AS  select `m`.`Id` AS `Id`,`c`.`NomCat` AS `Categorie`,`ma`.`libelle` AS `Marque`,`m`.`description` AS `description`,`e`.`libelle` AS `Etat` from (((`Materiel` `m` join `Etat` `e` on((`m`.`Etat` = `e`.`id`))) join `categorie` `c` on((`m`.`Categorie` = `c`.`Id`))) join `Marque` `ma` on((`m`.`Marque` = `ma`.`id`))) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `demande_emprunt`
--
ALTER TABLE `demande_emprunt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`idEmprunt`),
  ADD KEY `emprunt_emprunteur_FK` (`idEmprunteur`),
  ADD KEY `emprunt_Materiel2_FK` (`Id`);

--
-- Index pour la table `emprunteur`
--
ALTER TABLE `emprunteur`
  ADD PRIMARY KEY (`idEmprunteur`);

--
-- Index pour la table `Etat`
--
ALTER TABLE `Etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Marque`
--
ALTER TABLE `Marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Materiel`
--
ALTER TABLE `Materiel`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Categorie` (`Categorie`),
  ADD KEY `Etat` (`Etat`),
  ADD KEY `Marque` (`Marque`);

--
-- Index pour la table `statut_demande_emprunt`
--
ALTER TABLE `statut_demande_emprunt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `demande_emprunt`
--
ALTER TABLE `demande_emprunt`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `idEmprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `emprunteur`
--
ALTER TABLE `emprunteur`
  MODIFY `idEmprunteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `Etat`
--
ALTER TABLE `Etat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Marque`
--
ALTER TABLE `Marque`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Materiel`
--
ALTER TABLE `Materiel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT pour la table `statut_demande_emprunt`
--
ALTER TABLE `statut_demande_emprunt`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_Materiel2_FK` FOREIGN KEY (`Id`) REFERENCES `Materiel` (`Id`),
  ADD CONSTRAINT `emprunt_emprunteur_FK` FOREIGN KEY (`idEmprunteur`) REFERENCES `emprunteur` (`idEmprunteur`);

--
-- Contraintes pour la table `Materiel`
--
ALTER TABLE `Materiel`
  ADD CONSTRAINT `Materiel_ibfk_1` FOREIGN KEY (`Categorie`) REFERENCES `categorie` (`Id`),
  ADD CONSTRAINT `Materiel_ibfk_2` FOREIGN KEY (`Etat`) REFERENCES `Etat` (`id`),
  ADD CONSTRAINT `Materiel_ibfk_3` FOREIGN KEY (`Marque`) REFERENCES `Marque` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
