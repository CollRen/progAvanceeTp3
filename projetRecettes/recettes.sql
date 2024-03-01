-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 26 fév. 2024 à 04:04
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
-- Base de données : `recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`) VALUES
(1, 'de Montigny', 'René'),
(2, 'Dallair', 'Ismael'),
(3, 'Young', 'Robert'),
(4, 'Martel', 'Didier'),
(5, 'Larrivée', 'Ricardo'),
(7, 'Dubé', 'Nancy');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `ingredient_categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`, `ingredient_categorie_id`) VALUES
(1, 'Sel de célerie', 3),
(2, 'Poivre', 1),
(3, 'Boeuf', 3),
(4, 'Parmesan', 2),
(5, 'Pomme', 5),
(6, 'Paprika', 1),
(7, 'Poire', 5);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_categorie`
--

CREATE TABLE `ingredient_categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient_categorie`
--

INSERT INTO `ingredient_categorie` (`id`, `nom`) VALUES
(1, 'Les épices'),
(2, 'Fromage'),
(3, 'Viande'),
(4, 'Fines herbes'),
(5, 'Fruit'),
(6, 'Légume');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `temps_preparation` double NOT NULL DEFAULT '1',
  `temps_cuisson` double NOT NULL DEFAULT '1',
  `recette_categorie_id` int(4) NOT NULL DEFAULT '1',
  `auteur_id` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `titre`, `description`, `temps_preparation`, `temps_cuisson`, `recette_categorie_id`, `auteur_id`) VALUES
(1, 'Ma recette', 'Description simple', 28, 11, 1, 4),
(2, 'Recette de ricardo', 'asdg', 55, 5, 1, 5),
(3, 'Recette avec catégorie', 'Et auteur plus', 7, 5, 6, 2),
(11, 'Côtelettes de porc aux champignons et feta', 'Cuisiner des côtelettes de porc aux champignons et feta avec 5 ingrédients seulement: voilà la définition de «souper facile»!', 10, 10, 2, 2),
(14, 'La recette de tibi', 'Description Col', 11, 11, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `recette_categorie`
--

CREATE TABLE `recette_categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette_categorie`
--

INSERT INTO `recette_categorie` (`id`, `nom`) VALUES
(1, 'Dessert'),
(2, 'Plats principaux'),
(6, 'Accompagnement'),
(7, 'Soupe'),
(8, 'Repas Vegan');

-- --------------------------------------------------------

--
-- Structure de la table `recette_has_ingredient`
--

CREATE TABLE `recette_has_ingredient` (
  `recette_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL,
  `quantite` varchar(45) DEFAULT NULL,
  `unite_mesure_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unite_mesure`
--

CREATE TABLE `unite_mesure` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unite_mesure`
--

INSERT INTO `unite_mesure` (`id`, `nom`) VALUES
(1, 'tsp'),
(2, 'Tbs'),
(3, 'ml'),
(4, '---'),
(5, 'lb'),
(6, 'gr'),
(7, '---'),
(8, 'oz'),
(9, 'Cup');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `ingredient_categorie`
--
ALTER TABLE `ingredient_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recette_categorie`
--
ALTER TABLE `recette_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recette_has_ingredient`
--
ALTER TABLE `recette_has_ingredient`
  ADD KEY `fk_recette_id` (`recette_id`),
  ADD KEY `fk_ingredient_id` (`ingredient_id`);

--
-- Index pour la table `unite_mesure`
--
ALTER TABLE `unite_mesure`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ingredient_categorie`
--
ALTER TABLE `ingredient_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `recette_categorie`
--
ALTER TABLE `recette_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `unite_mesure`
--
ALTER TABLE `unite_mesure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `recette_has_ingredient`
--
ALTER TABLE `recette_has_ingredient`
  ADD CONSTRAINT `fk_ingredient_id` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `fk_recette_id` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
