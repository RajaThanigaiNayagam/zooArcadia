-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 sep. 2024 à 22:51
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
-- Base de données : `qoj04s3dl85bg68z`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `etat` varchar(50) DEFAULT NULL,
  `race_id` int(11) DEFAULT NULL,
  `habitat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `prenom`, `etat`, `race_id`, `habitat_id`) VALUES
(1, 'Lion', 'Bonne Etat', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `animal_image`
--

CREATE TABLE `animal_image` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `image_data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animal_image`
--

INSERT INTO `animal_image` (`id`, `animal_id`, `image_data`) VALUES
(1, 1, 'image/animal/La girafe.jpg'),
(2, 1, 'image\\animal\\La girafe.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `commentaire`, `is_visible`) VALUES
(1, '1', 'Les zoos offrent l\'opportunité de voir une grande', 1),
(2, 'Raja', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240822124759', '2024-08-22 12:48:52', 102),
('DoctrineMigrations\\Version20240824180236', '2024-08-24 18:21:23', 594),
('DoctrineMigrations\\Version20240824184106', '2024-08-24 18:42:24', 166),
('DoctrineMigrations\\Version20240826181436', '2024-08-26 18:14:50', 274),
('DoctrineMigrations\\Version20240827111106', '2024-08-27 11:12:00', 101),
('DoctrineMigrations\\Version20240828090040', '2024-08-28 09:30:02', 269);

-- --------------------------------------------------------

--
-- Structure de la table `habitat`
--

CREATE TABLE `habitat` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `commentaire_habitat` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `habitat`
--

INSERT INTO `habitat` (`id`, `nom`, `description`, `commentaire_habitat`) VALUES
(1, 'FORÊTS', 'Les Forêts', 'La jungle est un environnement à la végétation dense et luxuriante. Les jungles sont situées le long de l\'équateur, ce qui leur apporte un climat équatorial / tropical c\'est-à-dire chaud et humide.'),
(2, 'La Savane', 'La savane', 'La savane est une région chaude qui possède un climat tropical. Elle possède une saison sèche et une saison des pluies. Les animaux de la savane doivent pouvoir résister à la chaleur pour survivre');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image_data` longblob DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:170:\\\"http://localhost:8000/verify/email?expires=1725131159&id=3&signature=OAXnpO0LfWV954WDQ2adsxvaFVARCbgJD0vl3w5XLQw%3D&token=2Q3eLia3BhNq6Q55ed9G6TuAhB9G6VtTQ%2B0RvdQFHdk%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"mailer@zooarcadia.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:8:\\\"no reply\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:12:\\\"toto@toto.fr\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:30:\\\"Veuillez confirmer votre email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-08-31 18:05:59', '2024-08-31 18:05:59', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:172:\\\"http://localhost:8000/verify/email?expires=1725134291&id=4&signature=D6BH0IcwBBcX6ecn1pjnkQKLppHExf2K2dRrI8RqyZI%3D&token=UPZiTQXBmkGTilbMFJWz87VLCNc8kBHJ0wF%2Bv8FtJ%2Fw%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"mailer@zooarcadia.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:8:\\\"no reply\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:12:\\\"toto@toto.fr\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:30:\\\"Veuillez confirmer votre email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-08-31 18:58:11', '2024-08-31 18:58:11', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id`, `label`) VALUES
(1, 'Le Lion d\'Asie');

-- --------------------------------------------------------

--
-- Structure de la table `rapport_employee`
--

CREATE TABLE `rapport_employee` (
  `id` int(11) NOT NULL,
  `nourriture` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `quantity` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rapport_employee`
--

INSERT INTO `rapport_employee` (`id`, `nourriture`, `created_at`, `quantity`, `user_id`, `animal_id`) VALUES
(1, 'Viande', '2024-08-31 21:13:00', 10000, 6, 1),
(2, 'Viande', '2024-08-31 21:56:00', 10000, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapport_veterinaire`
--

CREATE TABLE `rapport_veterinaire` (
  `id` int(11) NOT NULL,
  `detail` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `food` varchar(50) NOT NULL,
  `foodgrammage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `nom`, `description`) VALUES
(1, 'Restauration', 'Restaurants'),
(2, 'Guide', 'visite des habitats avec un guide (gratuit)'),
(3, 'Petit train', 'visite du zoo en petit train');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `nom`, `prenom`, `is_verified`) VALUES
(1, 'admin@zoo.fr', '[\"ROLE_ADMIN\"]', '$2y$13$Q6H0cIgkZIyHS3LibH5ZLOtfPNunR34uWZjX.IB6Wdfj8lPlf2vue', NULL, NULL, NULL, 1),
(6, 'toto@zoo.fr', '[]', '$2y$13$aykCnT68QkEWSQ/JG/X5Gee6uiZRJBnyTCLDcWJRATVfDkWZyWIv6', 'toto@toto.fr', NULL, NULL, 1),
(7, 'vete@zoo.fr', '[\"ROLE_VETERINAIRE\"]', '$2y$13$t89a1AFt6HFiJEM9fPzKYe3uPFbaUdGn079MCt.uyJpU3j1ad982S', 'vete@vete.fr', NULL, NULL, 1),
(8, 'empl@zoo.fr', '[\"ROLE_EMPLOYEE\"]', '$2y$13$zQYiCZzwl2JW8xxJzc2eO.xAGJlF511eww1Js/qIEfLRw3Wm9Arne', 'empl@empl.fr', NULL, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6AAB231F6E59D40D` (`race_id`),
  ADD KEY `IDX_6AAB231FAFFE2D26` (`habitat_id`);

--
-- Index pour la table `animal_image`
--
ALTER TABLE `animal_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E4CEDDAB8E962C16` (`animal_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FAFFE2D26` (`habitat_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rapport_employee`
--
ALTER TABLE `rapport_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_895F9523A76ED395` (`user_id`),
  ADD KEY `IDX_895F95238E962C16` (`animal_id`);

--
-- Index pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CE729CDEA76ED395` (`user_id`),
  ADD KEY `IDX_CE729CDE8E962C16` (`animal_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_57698A6AA76ED395` (`user_id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `animal_image`
--
ALTER TABLE `animal_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `habitat`
--
ALTER TABLE `habitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rapport_employee`
--
ALTER TABLE `rapport_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6AAB231F6E59D40D` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`),
  ADD CONSTRAINT `FK_6AAB231FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`);

--
-- Contraintes pour la table `animal_image`
--
ALTER TABLE `animal_image`
  ADD CONSTRAINT `FK_E4CEDDAB8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`);

--
-- Contraintes pour la table `rapport_employee`
--
ALTER TABLE `rapport_employee`
  ADD CONSTRAINT `FK_895F95238E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_895F9523A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD CONSTRAINT `FK_CE729CDE8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `FK_CE729CDEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `FK_57698A6AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
