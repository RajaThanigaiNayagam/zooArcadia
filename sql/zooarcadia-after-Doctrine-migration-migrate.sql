-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 sep. 2024 à 22:12
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zooarcadia`
--
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`id`, `nom`, `description`, `commentaire_habitat`) VALUES
(1, 'FORÊTS', 'Les Forêts', 'La jungle est un environnement à la végétation dense et luxuriante. Les jungles sont situées le long de l\'équateur, ce qui leur apporte un climat équatorial / tropical c\'est-à-dire chaud et humide.'),
(2, 'La Savane', 'La savane', 'La savane est une région chaude qui possède un climat tropical. Elle possède une saison sèche et une saison des pluies. Les animaux de la savane doivent pouvoir résister à la chaleur pour survivre'),
(3, 'La jungle', 'La jungle', 'La jungle est un environnement à la végétation dense et luxuriante. Les jungles sont situées le long de l\'équateur, ce qui leur apporte un climat équatorial / tropical c\'est-à-dire chaud et humide. La jungle est riche d\'une très grande biodiversité où de nombreuses espèces restent encore à découvrir.');

-- --------------------------------------------------------
--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id`, `label`) VALUES
(1, 'Le Lion d\'Asie'),
(2, 'Girafe d\'afrique'),
(3, 'Éléphant d\'Afrique'),
(4, 'Lion blan'),
(10, 'Autriche d\'afrique'),
(11, 'Jaguar');
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `prenom`, `etat`, `race_id`, `habitat_id`) VALUES
(1, 'Lion', 'Bonne Etat', 1, 2),
(2, 'La girafe', 'Bonne santé', 2, 2),
(3, 'Lion', 'Bonne santé', 4, 2),
(4, 'Éléphant', 'Bonne santé', 3, 2),
(5, 'Autriche', 'Bonne santé', 10, 2),
(6, 'Jaguar', 'Bonne santé', 11, 1);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `animal_image`
--

INSERT INTO `animal_image` (`id`, `animal_id`, `image_data`, `nb_clique`) VALUES
(1, 2, 'image\\animal\\La girafe.jpg', 2),
(2, 1, 'image\\animal\\lion-de-l-atlas.jpg', 1),
(3, 4, 'image\\animal\\elephant-afrique.jpg', 2),
(4, 6, 'https://www.parrotworld.fr/fr/m_enhance/75?filename=jaguar', 3),
(5, 5, 'image\\animal\\autruche-afrique.jpg', NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `commentaire`, `is_visible`, `created_at`) VALUES
(8, 'Jerome', 'Les zoos offrent l\'opportunité de voir une grande', 1, '2024-09-24 18:58:27'),
(9, 'Sylvain', 'Super zoo, vaste, très bien entretenu. De nombreux animaux, des animations. Des points de restauration disponibles. Aussi bien pour les petits comme les grands!\r\n', 1, '2024-09-24 18:59:27'),
(13, 'Remi', 'Par un journée pas trop chaude nous avons eu le plaisr de visiter le Parc avec nos deux petits enfants de 5 ans.', 1, '2024-09-24 19:11:52'),
(14, 'Michel', 'super visite mon fils de 3 ans été émerveillé', 1, '2024-09-24 19:12:29');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `titre`, `description`, `created_at`, `is_read`) VALUES
(1, 'Nicolas', 'nicolas@toto.fr', 'test test', '2024-09-17 22:56:11', NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `day`, `open_time`, `close_time`) VALUES
(1, 'Lundi', '10:00:00', '20:00:00'),
(2, 'Mardi', '10:00:00', '20:00:00'),
(3, 'Mercredi', '11:00:00', '20:00:00'),
(4, 'Jeudi', '10:00:00', '20:00:00'),
(5, 'vendredi', '10:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'ROLE_ADMIN'),
(5, 'ROLE_EMPLOYEE'),
(6, 'ROLE_VETERINAIRE');

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `nom`, `prenom`, `is_verified`, `role_id`) VALUES
(1, 'Raja', '[\"ROLE_ADMIN\"]', '$2y$13$Q6H0cIgkZIyHS3LibH5ZLOtfPNunR34uWZjX.IB6Wdfj8lPlf2vue', 'thanigainayagam@yahoo.fr', NULL, NULL, 1, 1),
(7, 'vete@zoo.fr', '[\"ROLE_VETERINAIRE\"]', '$2y$13$t89a1AFt6HFiJEM9fPzKYe3uPFbaUdGn079MCt.uyJpU3j1ad982S', 'vete@vete.fr', NULL, NULL, 1, 5),
(8, 'empl@zoo.fr', '[\"ROLE_EMPLOYEE\"]', '$2y$13$zQYiCZzwl2JW8xxJzc2eO.xAGJlF511eww1Js/qIEfLRw3Wm9Arne', 'empl@empl.fr', NULL, NULL, 1, 6),
(9, 'admin@zoo.fr', '[\"ROLE_ADMIN\"]', '$2y$13$WK43hpQDF8tWTa9C8JKsWecqmOxGQYa331wQ.NJ9Wdu9GGdVsWnJG', 'admin@zoo.fr', NULL, NULL, 1, 1);

--
-- Index pour les tables déchargées
--
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Déchargement des données de la table `rapport_employee`
--

INSERT INTO `rapport_employee` (`id`, `nourriture`, `created_at`, `quantity`, `user_id`, `animal_id`) VALUES
(1, 'Viande', '2024-08-31 21:13:00', 10000, 8, 1),
(2, 'Viande', '2024-08-31 21:56:00', 10000, 8, 1),
(3, 'Viande', '0000-00-00 00:00:00', 5000, 8, 1),
(4, 'Repas éléphant', '2024-09-13 06:37:06', 10000, 8, 4),
(5, 'Viande', '2024-09-13 08:48:52', 5000, 8, 6);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `rapport_veterinaire`
--

INSERT INTO `rapport_veterinaire` (`id`, `detail`, `created_at`, `user_id`, `animal_id`, `status`, `food`, `foodgrammage`) VALUES
(1, 'Lion', '2024-09-19 11:01:38', 7, 1, 'Bonne santé', 'Viande', 5000),
(2, 'élephant', '2024-09-19 11:02:36', 7, 4, 'Bonne santé', 'Legume', 10000);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `nom`, `description`) VALUES
(1, 'Restauration', 'Restaurants'),
(2, 'Guide', 'visite des habitats avec un guide (gratuit)'),
(3, 'Petit train', 'visite du zoo en petit train');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240822124759', '2024-08-22 12:48:52', 102),
('DoctrineMigrations\\Version20240824180236', '2024-08-24 18:21:23', 594),
('DoctrineMigrations\\Version20240824184106', '2024-08-24 18:42:24', 166),
('DoctrineMigrations\\Version20240826181436', '2024-08-26 18:14:50', 274),
('DoctrineMigrations\\Version20240827111106', '2024-08-27 11:12:00', 101);

-- --------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
