-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 22 fév. 2024 à 14:43
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_petites_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int(10) UNSIGNED NOT NULL,
  `id_photos` int(10) UNSIGNED DEFAULT NULL,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `id_categories` int(10) NOT NULL,
  `titre_annonce` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `ville` varchar(150) NOT NULL,
  `duree_de_publication_en_mois` int(11) NOT NULL,
  `prix_vente` decimal(7,2) NOT NULL,
  `prix_annonce` decimal(7,2) NOT NULL,
  `date_debut_publication` datetime NOT NULL,
  `date_fin_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_vente` datetime DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Immobilier'),
(2, 'Multimédia'),
(3, 'Véhicule'),
(4, 'Objets'),
(5, 'Animaux'),
(6, 'Fashion'),
(7, 'Vente'),
(8, 'Location'),
(9, 'Mode');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id_utilisateur` int(10) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `adresse_postale` varchar(150) NOT NULL,
  `code_postale` int(5) NOT NULL,
  `n_de_telephone` varchar(10) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_TOKEN` varchar(250) DEFAULT NULL,
  `ville` varchar(150) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(50) DEFAULT NULL,
  `perim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id_utilisateur`, `nom`, `prenom`, `is_admin`, `email`, `password`, `adresse_postale`, `code_postale`, `n_de_telephone`, `date_de_naissance`, `sexe`, `date_inscription`, `reset_TOKEN`, `ville`, `actif`, `token`, `perim`) VALUES
(1, 'Heidenreich', 'Séléna', 1, 'selena@gmail.com', NULL, '858 Avenue Jonasside', 6670, '694675347', '1987-09-30', 0, '2024-01-30 11:29:03', NULL, 'Levens', 0, NULL, NULL),
(2, 'Barnes', 'Théodore', 0, 'theodore@gmail.com', NULL, '994 Boulevard Kemmerberg', 6000, '683462453', '1981-11-23', 1, '2024-01-30 11:29:03', NULL, 'Nice', 0, NULL, NULL),
(3, 'Larson', 'Mathias', 0, 'mathias@gmail.com', NULL, '340 Rue Hailiemouth', 6340, '689657893', '1974-10-04', 1, '2024-01-30 11:29:03', NULL, 'La Trinité', 0, NULL, NULL),
(4, 'Gopinatha', 'Kayla', 0, 'kayla@gmail.com', NULL, '601 Chemin de Keelingbury', 6210, '684765698', '1975-02-08', 0, '2024-01-30 11:29:03', NULL, 'Mandelieu-la-Napoule', 0, NULL, NULL),
(6, 'DFD', 'FDGDF', 0, 'sara@gmail.com', '$2y$10$gazBtpM1oAzJyhL/WsvR8e9Q0wWb3rHIwM.DZ3Jz.O/J3ZvsEHUu6', 'KLKJK', 6800, '0690345624', '1987-09-30', 0, '2024-02-15 14:07:43', NULL, 'CAGNES SUR MER', 1, NULL, NULL),
(7, 'kdvb', 'hggd', 0, 'az@gmail.com', '$2y$10$luI0YoYJPCKRcDgmlwgUPeaGyt5sMO5mz1Gss/JKXCoGbKDy.W2Gq', 'DSJNJKC', 6700, '0707078765', '1988-02-17', 0, '2024-02-15 14:41:38', NULL, 'ST LO', 0, '09ff02f82b04d48dcdd39532b30f84b3', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `FK3` (`id_utilisateur`),
  ADD KEY `fk_annonces_Categories1` (`id_categories`),
  ADD KEY `fk_annonces_Photos1` (`id_photos`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id_utilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
