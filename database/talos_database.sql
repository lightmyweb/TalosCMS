-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 10 juin 2019 à 17:28
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `talos_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `_talos_bloc`
--

CREATE TABLE `_talos_bloc` (
  `id` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `entity_id_withBlocTexts` int(11) DEFAULT NULL,
  `entity_id_withBlocSections` int(11) DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_bloc_section`
--

CREATE TABLE `_talos_bloc_section` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_bloc_section_translation`
--

CREATE TABLE `_talos_bloc_section_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_bloc_text`
--

CREATE TABLE `_talos_bloc_text` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_bloc_text_translation`
--

CREATE TABLE `_talos_bloc_text_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_contact`
--

CREATE TABLE `_talos_contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_generalentity`
--

CREATE TABLE `_talos_generalentity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_id_update` int(11) DEFAULT NULL,
  `seo_id` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_help`
--

CREATE TABLE `_talos_help` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_image`
--

CREATE TABLE `_talos_image` (
  `id` int(11) NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `externa_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `width` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heigth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_locale`
--

CREATE TABLE `_talos_locale` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `def` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `_talos_locale`
--

INSERT INTO `_talos_locale` (`id`, `user_id`, `name`, `slug`, `state`, `def`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'Français', 'fr', 1, 1, '2019-06-03 11:20:54', NULL),
(2, 1, 'English', 'en', 1, 0, '2019-06-03 11:21:15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `_talos_page`
--

CREATE TABLE `_talos_page` (
  `id` int(11) NOT NULL,
  `image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_page_and_image_relation`
--

CREATE TABLE `_talos_page_and_image_relation` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `orderPosition` int(11) DEFAULT NULL,
  `leftPosition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TopPosition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_page_translation`
--

CREATE TABLE `_talos_page_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suptitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_seo`
--

CREATE TABLE `_talos_seo` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_seo_translation`
--

CREATE TABLE `_talos_seo_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_settings`
--

CREATE TABLE `_talos_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `installed` tinyint(1) DEFAULT NULL,
  `widthForCrop` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heigthForCrop` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `_talos_settings`
--

INSERT INTO `_talos_settings` (`id`, `title`, `email`, `favicon`, `installed`, `widthForCrop`, `heigthForCrop`) VALUES
(1, '', '', '', 0, NULL, NULL),
(2, 'TALOS', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `_talos_settings_translation`
--

CREATE TABLE `_talos_settings_translation` (
  `id` int(11) NOT NULL,
  `translatable_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_talos_user`
--

CREATE TABLE `_talos_user` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `_talos_user`
--

INSERT INTO `_talos_user` (`id_user`, `first_name`, `last_name`, `email`, `username`, `password`, `role`, `date_create`, `last_active`, `is_active`, `salt`) VALUES
(1, 'Salim', 'mejdoub', 'salim@lightmyweb.fr', 'salim', '$2y$13$lb7YIvuSJm4RTObG3f46dOaF0XObWKG7H5qQhUboViP6c9fbaCKpi', 'ROLE_DEV', '2019-01-15 06:24:22', '2019-01-15 00:00:00', 1, '3vstesg828w08koo0gcgo804kkcs0s8');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `_talos_bloc`
--
ALTER TABLE `_talos_bloc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F08CCC0982FBABC` (`entity_id_withBlocTexts`),
  ADD KEY `IDX_1F08CCC0AB77039D` (`entity_id_withBlocSections`);

--
-- Index pour la table `_talos_bloc_section`
--
ALTER TABLE `_talos_bloc_section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_bloc_section_translation`
--
ALTER TABLE `_talos_bloc_section_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_talos_bloc_section_translation_unique_translation` (`translatable_id`,`locale`),
  ADD KEY `IDX_71BFD3612C2AC5D3` (`translatable_id`);

--
-- Index pour la table `_talos_bloc_text`
--
ALTER TABLE `_talos_bloc_text`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_bloc_text_translation`
--
ALTER TABLE `_talos_bloc_text_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_talos_bloc_text_translation_unique_translation` (`translatable_id`,`locale`),
  ADD KEY `IDX_C02A924F2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `_talos_contact`
--
ALTER TABLE `_talos_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_generalentity`
--
ALTER TABLE `_talos_generalentity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CF56159EA76ED395` (`user_id`),
  ADD KEY `IDX_CF56159EBEF20D71` (`user_id_update`),
  ADD KEY `IDX_CF56159E97E3DD86` (`seo_id`);

--
-- Index pour la table `_talos_help`
--
ALTER TABLE `_talos_help`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_image`
--
ALTER TABLE `_talos_image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_locale`
--
ALTER TABLE `_talos_locale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D8999528989D9B62` (`slug`),
  ADD KEY `IDX_D8999528A76ED395` (`user_id`);

--
-- Index pour la table `_talos_page`
--
ALTER TABLE `_talos_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CC7AEFBAC53D045F` (`image`);

--
-- Index pour la table `_talos_page_and_image_relation`
--
ALTER TABLE `_talos_page_and_image_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1802D24CC4663E4` (`page_id`),
  ADD KEY `IDX_1802D24C3DA5256D` (`image_id`);

--
-- Index pour la table `_talos_page_translation`
--
ALTER TABLE `_talos_page_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_talos_page_translation_unique_translation` (`translatable_id`,`locale`),
  ADD KEY `IDX_7F58F4782C2AC5D3` (`translatable_id`);

--
-- Index pour la table `_talos_seo`
--
ALTER TABLE `_talos_seo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_seo_translation`
--
ALTER TABLE `_talos_seo_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_talos_seo_translation_unique_translation` (`translatable_id`,`locale`),
  ADD KEY `IDX_2BECC6CD2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `_talos_settings`
--
ALTER TABLE `_talos_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_talos_settings_translation`
--
ALTER TABLE `_talos_settings_translation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `_talos_settings_translation_unique_translation` (`translatable_id`,`locale`),
  ADD KEY `IDX_749202CC2C2AC5D3` (`translatable_id`);

--
-- Index pour la table `_talos_user`
--
ALTER TABLE `_talos_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UNIQ_55E38FD3E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_55E38FD3F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `_talos_bloc`
--
ALTER TABLE `_talos_bloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_bloc_section_translation`
--
ALTER TABLE `_talos_bloc_section_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_bloc_text_translation`
--
ALTER TABLE `_talos_bloc_text_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_contact`
--
ALTER TABLE `_talos_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_generalentity`
--
ALTER TABLE `_talos_generalentity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_image`
--
ALTER TABLE `_talos_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_locale`
--
ALTER TABLE `_talos_locale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `_talos_page_and_image_relation`
--
ALTER TABLE `_talos_page_and_image_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_page_translation`
--
ALTER TABLE `_talos_page_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_seo`
--
ALTER TABLE `_talos_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_seo_translation`
--
ALTER TABLE `_talos_seo_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_settings`
--
ALTER TABLE `_talos_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `_talos_settings_translation`
--
ALTER TABLE `_talos_settings_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `_talos_user`
--
ALTER TABLE `_talos_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `_talos_bloc`
--
ALTER TABLE `_talos_bloc`
  ADD CONSTRAINT `FK_1F08CCC0982FBABC` FOREIGN KEY (`entity_id_withBlocTexts`) REFERENCES `_talos_generalentity` (`id`),
  ADD CONSTRAINT `FK_1F08CCC0AB77039D` FOREIGN KEY (`entity_id_withBlocSections`) REFERENCES `_talos_generalentity` (`id`);

--
-- Contraintes pour la table `_talos_bloc_section`
--
ALTER TABLE `_talos_bloc_section`
  ADD CONSTRAINT `FK_26C3AB64BF396750` FOREIGN KEY (`id`) REFERENCES `_talos_bloc` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_bloc_section_translation`
--
ALTER TABLE `_talos_bloc_section_translation`
  ADD CONSTRAINT `FK_71BFD3612C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `_talos_bloc_section` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_bloc_text`
--
ALTER TABLE `_talos_bloc_text`
  ADD CONSTRAINT `FK_7069319FBF396750` FOREIGN KEY (`id`) REFERENCES `_talos_bloc` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_bloc_text_translation`
--
ALTER TABLE `_talos_bloc_text_translation`
  ADD CONSTRAINT `FK_C02A924F2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `_talos_bloc_text` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_generalentity`
--
ALTER TABLE `_talos_generalentity`
  ADD CONSTRAINT `FK_CF56159E97E3DD86` FOREIGN KEY (`seo_id`) REFERENCES `_talos_seo` (`id`),
  ADD CONSTRAINT `FK_CF56159EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `_talos_user` (`id_user`),
  ADD CONSTRAINT `FK_CF56159EBEF20D71` FOREIGN KEY (`user_id_update`) REFERENCES `_talos_user` (`id_user`);

--
-- Contraintes pour la table `_talos_help`
--
ALTER TABLE `_talos_help`
  ADD CONSTRAINT `FK_D0F70536BF396750` FOREIGN KEY (`id`) REFERENCES `_talos_generalentity` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_locale`
--
ALTER TABLE `_talos_locale`
  ADD CONSTRAINT `FK_D8999528A76ED395` FOREIGN KEY (`user_id`) REFERENCES `_talos_user` (`id_user`);

--
-- Contraintes pour la table `_talos_page`
--
ALTER TABLE `_talos_page`
  ADD CONSTRAINT `FK_CC7AEFBABF396750` FOREIGN KEY (`id`) REFERENCES `_talos_generalentity` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CC7AEFBAC53D045F` FOREIGN KEY (`image`) REFERENCES `_talos_image` (`id`);

--
-- Contraintes pour la table `_talos_page_and_image_relation`
--
ALTER TABLE `_talos_page_and_image_relation`
  ADD CONSTRAINT `FK_1802D24C3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `_talos_image` (`id`),
  ADD CONSTRAINT `FK_1802D24CC4663E4` FOREIGN KEY (`page_id`) REFERENCES `_talos_page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_page_translation`
--
ALTER TABLE `_talos_page_translation`
  ADD CONSTRAINT `FK_7F58F4782C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `_talos_page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_seo_translation`
--
ALTER TABLE `_talos_seo_translation`
  ADD CONSTRAINT `FK_2BECC6CD2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `_talos_seo` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `_talos_settings_translation`
--
ALTER TABLE `_talos_settings_translation`
  ADD CONSTRAINT `FK_749202CC2C2AC5D3` FOREIGN KEY (`translatable_id`) REFERENCES `_talos_settings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
