-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 oct. 2023 à 12:00
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `daba`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande_valider`
--

CREATE TABLE `commande_valider` (
  `num_commande` int(11) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `prenom_client` varchar(50) NOT NULL,
  `taureau_acheter` varchar(50) NOT NULL,
  `date_achat` date NOT NULL,
  `prix_achat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commande_valider`
--

INSERT INTO `commande_valider` (`num_commande`, `nom_client`, `prenom_client`, `taureau_acheter`, `date_achat`, `prix_achat`) VALUES
(14, 'hilalbik', 'taha', 'name 9', '2023-09-12', 12000),
(15, 'ahmadi', 'achraf', 'name 15', '2023-09-23', 13500),
(19, 'moukat', 'zineb', 'name 12', '2023-09-29', 12500),
(23, 'moumni', 'ayman', 'name 14', '2023-10-01', 13500),
(25, 'hilalbik', 'taha', 'name 3', '2023-10-03', 0),
(26, 'hilalbik', 'taha', 'name 5', '2023-10-03', 12000),
(28, 'hilalbik', 'taha', 'name 1', '2023-10-03', 14350);

-- --------------------------------------------------------

--
-- Structure de la table `formulaire`
--

CREATE TABLE `formulaire` (
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numero_telephone` int(11) NOT NULL,
  `taureau` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `numero_commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `formulaire`
--

INSERT INTO `formulaire` (`nom`, `prenom`, `email`, `numero_telephone`, `taureau`, `commentaire`, `numero_commande`) VALUES
('moukat', 'zineb', 'zineb_mk@gmail.com', 654356789, 'name 12', 'plus d\'infos', 15),
('ahmadi', 'achraf', 'ahmadi.achraf@gmail.com', 765431234, 'name 15', '', 19),
('moumni', 'ayman', 'ayman_mn@gmail.com', 678908765, 'name 14', 'urgent', 23),
('hilalbik', 'taha', 'tama@gmail.com', 987654345, 'name 3', 'urgent', 25),
('hilalbik', 'taha', 'tahha@gmail.com', 987654345, 'name 5', 'urgent', 26),
('hilalbik', 'taha', 'tahha@gmail.com', 987654345, 'name 15', 'sos', 27),
('hilalbik', 'taha', 'tahha@gmail.com', 987654345, 'name 1', 'tha', 28);

-- --------------------------------------------------------

--
-- Structure de la table `taureaux`
--

CREATE TABLE `taureaux` (
  `code_ref` int(11) NOT NULL,
  `nom_taureau` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL,
  `remarque` varchar(100) NOT NULL,
  `prix_min` decimal(10,2) DEFAULT NULL,
  `prix_max` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `taureaux`
--

INSERT INTO `taureaux` (`code_ref`, `nom_taureau`, `quantite`, `remarque`, `prix_min`, `prix_max`) VALUES
(987876, 'Charolais', 25, 'neauvau', 12000.00, 15000.00),
(992476, 'belge', 10, 'promotion', 10000.00, 11000.00);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mot_de_passe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(7, 'housayni', 'khalid', 'houssa@gmail.com', '$2y$10$iyu'),
(10, 'hilalbik', 'taha', 'HILALBIK_TAHA@emsi-edu.ma', '$2y$10$zN2'),
(13, 'allabou', 'kamar', 'kamar@gmail.com', '$2y$10$JmT'),
(18, 'moukat', 'zineb', 'zineb_mk@gmail.com', '$2y$10$LfK'),
(19, 'ahmadi', 'achraf', 'ahmadi.achraf@gmail.com', '$2y$10$mA.'),
(21, 'moumni', 'ayman', 'ayman_mn@gmail.com', '$2y$10$Vvm'),
(22, 'hilalbik', 'taha', 'hilalbiktaha@gmail.com', '$2y$10$55T'),
(23, 'mouzani', 'mohamed', 'm.mouzani@gmail.com', '$2y$10$zOI');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande_valider`
--
ALTER TABLE `commande_valider`
  ADD PRIMARY KEY (`num_commande`);

--
-- Index pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD PRIMARY KEY (`numero_commande`);

--
-- Index pour la table `taureaux`
--
ALTER TABLE `taureaux`
  ADD PRIMARY KEY (`code_ref`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `formulaire`
--
ALTER TABLE `formulaire`
  MODIFY `numero_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
