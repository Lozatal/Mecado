-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 07 Novembre 2017 à 16:02
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mecado`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE `acheteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `participation` int(11) DEFAULT NULL,
  `message` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `url_article` varchar(255) DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `tarif` int(11) NOT NULL,
  `groupe` tinyint(1) NOT NULL DEFAULT '0',
  `cagnote` tinyint(1) NOT NULL DEFAULT '0',
  `appartient_a` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_liste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `nom`, `url_article`, `url_image`, `tarif`, `groupe`, `cagnote`, `appartient_a`, `created_at`, `updated_at`, `id_liste`) VALUES
(1, 'Voiture', NULL, NULL, 25, 0, 0, NULL, '2017-11-07 14:55:49', '2017-11-07 14:55:49', 1),
(2, '4 Mariages et 1 mort', NULL, NULL, 80, 0, 0, NULL, '2017-11-07 14:58:34', '2017-11-07 14:58:34', 1);

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `description` longtext,
  `token` varchar(255) NOT NULL,
  `date_limite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `destinataire` tinyint(1) NOT NULL,
  `nom_dest` varchar(25) NOT NULL,
  `prenom_dest` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liste`
--

INSERT INTO `liste` (`id`, `nom`, `description`, `token`, `date_limite`, `destinataire`, `nom_dest`, `prenom_dest`, `created_at`, `updated_at`, `id_user`) VALUES
(1, 'Anniversaire Thor', 'La mort aux mort', '', '2017-11-29 23:00:00', 1, 'Luc', 'Jean', '2017-11-07 14:50:44', '2017-11-07 14:50:44', 1),
(2, 'Anniversaire Loki', 'qzfsbyuroij<nmoheughuielsghliuhiehuhbbeslksbuebvusebvluisebvliusbeliusbevlisev', '', '2017-11-07 15:00:51', 1, 'Luc', 'Le', '2017-11-07 15:00:51', '2017-11-07 15:00:51', 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `texte` longtext,
  `auteur` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_liste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `password`) VALUES
(1, 'test', 'test', 'test@test.fr', '$2y$10$cTiHpkpj3liY8F0mz2Gz7utTOf2DLB6xDnY9vNIjpOGF8MWe4Swbq');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_acheteur_id_item` (`id_item`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_item_id_liste` (`id_liste`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_liste_id_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_message_id_liste` (`id_liste`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acheteur`
--
ALTER TABLE `acheteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `FK_acheteur_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_item_id_liste` FOREIGN KEY (`id_liste`) REFERENCES `liste` (`id`);

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `FK_liste_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id_liste` FOREIGN KEY (`id_liste`) REFERENCES `liste` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
