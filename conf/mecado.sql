-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 10 Novembre 2017 à 14:29
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
  `participation` int(11) DEFAULT NULL,
  `message` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acheteur`
--

INSERT INTO `acheteur` (`id`, `nom`, `participation`, `message`, `created_at`, `updated_at`, `id_item`) VALUES
(1, 'test', NULL, 'test\r\n', '2017-11-09 11:37:53', '2017-11-09 11:37:53', 2),
(2, 'tes', NULL, 'test\r\n', '2017-11-09 14:02:45', '2017-11-09 14:02:45', 1),
(3, 'test', 10, 'est\r\n', '2017-11-09 14:10:12', '2017-11-09 14:10:12', 4),
(4, 'tes', 5, 'hey', '2017-11-09 16:17:55', '2017-11-09 16:17:55', 4),
(5, 'wsvwsv', 5, 'qzfzqf', '2017-11-09 16:18:19', '2017-11-09 16:18:19', 4),
(6, 'TestPasCo', NULL, 'Coucou', '2017-11-09 16:31:26', '2017-11-09 16:31:26', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `principale` tinyint(1) NOT NULL DEFAULT '0',
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `principale` tinyint(1) NOT NULL DEFAULT '0',
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `url_article` varchar(255) DEFAULT NULL,
  `tarif` float NOT NULL,
  `groupe` tinyint(1) NOT NULL DEFAULT '0',
  `cagnotte` tinyint(1) NOT NULL DEFAULT '0',
  `appartient_a` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_liste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `nom`, `description`, `url_article`, `tarif`, `groupe`, `cagnotte`, `appartient_a`, `created_at`, `updated_at`, `id_liste`) VALUES
(1, 'test', 'qzfqzf', 'url', 20, 0, 0, NULL, '2017-11-07 14:55:49', '2017-11-08 16:33:42', 1),
(2, '4 Mariages et 1 mort', 'description zqzfqzqf', NULL, 80, 0, 0, NULL, '2017-11-07 14:58:34', '2017-11-07 14:58:34', 1),
(3, 'test', 'test', 'ets', 20, 0, 0, NULL, '2017-11-09 13:14:45', '2017-11-09 13:14:45', 1),
(4, 'testcagnote', 'test', 'test', 20, 0, 1, NULL, '2017-11-09 13:15:33', '2017-11-09 13:15:33', 1);

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
(1, 'Anniversaire Thor', 'La mort aux mort', '$2y$10$1VXHXD7wBaQxve0CoEQEBeMLRv7a6G7yXF92.2Ig/mCJ0R7MvzQbq', '2017-11-29 23:00:00', 1, 'Luc', 'Jean', '2017-11-07 14:50:44', '2017-11-08 13:17:37', 1),
(2, 'Anniversaire Loki', 'qzfsbyuroij<nmoheughuielsghliuhiehuhbbeslksbuebvusebvluisebvliusbeliusbevlisev', '$2y$10$BPYxedaanqnsxFxc2j.IhOS.r2JNjGRpHizNtb4Wg51uoq2guLWgm', '2017-11-07 15:00:51', 0, 'Luc', 'Le', '2017-11-07 15:00:51', '2017-11-08 13:17:32', 1),
(3, 'test', 'test', '$2y$10$n6RDobMQ6dzGGvkFXz2gw.VF66mdOBRGyOS1Dwwwom4PBMe2syzra', '1980-10-09 23:00:00', 0, 'test', 'test', '2017-11-08 09:36:11', '2017-11-08 14:04:03', 1),
(6, 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at purus ut lorem egestas sagittis. Fusce sit amet nisl mauris. Cras eget dolor ut purus varius fermentum. Vestibulum placerat eros neque, sed viverra dui mollis a. Praesent nec enim a eros bibendum luctus. Maecenas vel mattis lectus, non euismod dui. Etiam scelerisque nisl ut auctor finibus. Praesent tempus mollis elit et rutrum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum do', '$2y$10$CSnXqtlkMbg/r0O.NuxG5uxTuh8zF/lR7DrjKz1wtQX1TTq86kTUu', '2017-11-08 13:24:40', 1, 'test', 'test', '2017-11-08 13:22:54', '2017-11-08 13:24:33', 1),
(12, 'testdate', 'qzfzqf', '$2y$10$M7RW8FZrGt4ozijUzpCgBeXZ3W7/pDVec80XOTfsB/QRSWSfFErFS', '2019-12-15 12:50:09', 1, 'test', 'test', '2017-11-09 12:50:09', '2017-11-09 12:50:09', 1),
(13, 'test', 'zdzd', '$2y$10$Cx5miWCkDN5AF7Z0RwVgBuxUxyJgxgNsdz/cj4gvXAgwjXoGEOzx.', '2019-12-10 16:05:30', 0, '', '', '2017-11-09 16:05:30', '2017-11-09 16:05:30', 1),
(14, 'test', 'zqdzqd', '$2y$10$eU/Veyarjf62MNqEaLLN9O.fglYwJXZIz3.wtE3KY3yJmhwR3xvfi', '2019-12-15 16:05:40', 0, '', '', '2017-11-09 16:05:40', '2017-11-09 16:05:40', 1),
(15, 'zfq', 'qzfqzf', '$2y$10$U51K35P1JpWCXNXRry1AdevikGo9iBYNyqInpSl8u3GENGY4b9NUW', '2020-08-10 15:05:51', 0, '', '', '2017-11-09 16:05:51', '2017-11-09 16:05:51', 1),
(16, 'zqfzqf', 'qzfzqf', '$2y$10$y8ruA7yMZ6hCLQrCl.NJz.NVcqW5EAoaycfsdvWetEqcX8RvpdrHW', '2019-12-10 16:09:28', 0, '', '', '2017-11-09 16:09:28', '2017-11-09 16:09:28', 1),
(17, 'qzfzqf', 'qzfzqf', '$2y$10$46eqf9wgucZAfdwJL.aZ8uYYo24PunY991u1Y2UnblcZbw88Z5bAm', '1990-09-03 15:09:55', 0, '', '', '2017-11-09 16:09:55', '2017-11-09 16:09:55', 1);

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

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `texte`, `auteur`, `created_at`, `updated_at`, `id_liste`) VALUES
(1, 'test', 'test', '2017-11-07 17:28:44', '2017-11-07 17:28:44', 1),
(2, 'test\r\n', 'test', '2017-11-09 14:38:03', '2017-11-09 14:38:03', 1),
(3, 'salut', 'Salut', '2017-11-09 16:31:34', '2017-11-09 16:31:34', 1),
(4, 'salut', 'Salut', '2017-11-09 16:40:46', '2017-11-09 16:40:46', 1),
(5, 'salut', 'Salut', '2017-11-09 16:41:20', '2017-11-09 16:41:20', 1),
(6, 'salut', 'Salut', '2017-11-09 16:41:43', '2017-11-09 16:41:43', 1),
(7, 'salut', 'Salut', '2017-11-09 16:41:53', '2017-11-09 16:41:53', 1),
(8, 'salut', 'Salut', '2017-11-09 16:42:13', '2017-11-09 16:42:13', 1),
(9, 'salut', 'Salut', '2017-11-09 16:42:45', '2017-11-09 16:42:45', 1),
(10, 'salut', 'Salut', '2017-11-09 16:42:47', '2017-11-09 16:42:47', 1),
(11, 'salut', 'Salut', '2017-11-09 16:43:31', '2017-11-09 16:43:31', 1),
(12, 'salut', 'Salut', '2017-11-09 16:43:52', '2017-11-09 16:43:52', 1),
(13, 'salut', 'Salut', '2017-11-09 16:44:08', '2017-11-09 16:44:08', 1),
(14, 'salut', 'Salut', '2017-11-09 16:45:15', '2017-11-09 16:45:15', 1),
(15, 'salut', 'Salut', '2017-11-09 16:45:29', '2017-11-09 16:45:29', 1),
(16, 'salut', 'Salut', '2017-11-09 16:45:47', '2017-11-09 16:45:47', 1);

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
(1, 'test', 'test', 'test@test.fr', '$2y$10$cTiHpkpj3liY8F0mz2Gz7utTOf2DLB6xDnY9vNIjpOGF8MWe4Swbq'),
(2, 'test1', 'test1', 'test1@test.fr', '$2y$10$4R5gxP897DtD7Ixti7dC3uZ0x9GocPglH92/qTJrLGP8ya5UMY6xe'),
(3, 'test2', 'test2', 'test2@test.fr', '$2y$10$712PbUWKle6eAAvlFJBw8eAIcojVWyq1fkKnlmax5uENSo/Dd5ZYu');

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
-- Index pour la table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_item` (`id_item`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_item` (`id_item`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Image`
--
ALTER TABLE `Image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `FK_acheteur_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`);

--
-- Contraintes pour la table `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `FK_image_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`);

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
