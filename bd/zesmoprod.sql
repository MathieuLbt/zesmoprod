-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 26 Juin 2017 à 10:50
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `zesmoprod`
--

-- --------------------------------------------------------

--
-- Structure de la table `contenue`
--

CREATE TABLE `contenue` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contenue`
--

INSERT INTO `contenue` (`id`, `created`, `updated`, `titre`, `texte`) VALUES
(2, '2017-06-20 09:58:33', '2017-06-20 09:58:33', '2016 - 2017', 'Evènement avec Contrast System:\r\n<br>\r\nAssistant technicien son et lumière<br>\r\nAide à l\'installation de matériel<br>\r\nMise en place des platines et des lumières\r\nDécharge du matériel d\'accueil<br>\r\n2ème année à l\'ESRA - Paris, section ISTS.'),
(3, '2017-06-20 10:00:28', '2017-06-20 10:00:28', '2015 - 2016', '1ère année à l\'ESRA - Paris, section ISTS<br>\r\nApprentissage des logiciels Ableton Live et Pro Tools'),
(4, '2017-06-20 10:02:03', '2017-06-20 10:02:03', '2014 - 2015', 'Passage du Bac Scientifique');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` datetime NOT NULL,
  `titre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `lien` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `movie`
--

INSERT INTO `movie` (`id`, `created`, `updated`, `titre`, `description`, `lien`, `cover`) VALUES
(2, '2017-06-19', '2017-06-19 15:13:09', 'Naqoyqatsi Ists2A21', 'Composition musicale: Alexandre Poinseaux , Roman Prazuck et François Bénard \r\nImages : Naqoyqatsi', 'https://www.youtube.com/watch?v=x8wXSxMNfHI', 'cover-002.jpg'),
(8, '2017-06-21', '2017-06-21 11:11:24', 'Gladiator (re)composition', 'Recomposition de la musique d\'un extrait du film \"Gladiator\" , 2002 ,par Alexandre Poinseaux , Roman Prazuck et moi-même.', 'https://www.youtube.com/watch?v=41wZbyxOxmI', 'cover-004.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `titre` varchar(25) DEFAULT NULL,
  `fichier` varchar(250) NOT NULL,
  `playlist_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `music`
--

INSERT INTO `music` (`id`, `created`, `updated`, `titre`, `fichier`, `playlist_id`) VALUES
(1, '2017-06-25 12:53:14', '2017-06-25 12:53:14', 'untest', 'data/audio/test001.mp3', NULL),
(2, '2017-06-25 12:53:14', '2017-06-25 12:53:14', 'deuxtest', 'data/audio/test002.mp3', NULL),
(3, '2017-06-25 12:53:14', '2017-06-25 12:53:14', 'troistest', 'data/audio/test003.mp3', NULL),
(4, '2017-06-25 12:53:14', '2017-06-25 12:53:14', 'quatretest', 'data/audio/test004.mp3', NULL),
(5, '2017-06-26 09:10:14', '2017-06-26 09:10:14', 'Le Miracle de l\'Etre', 'data/audio/Le Miracle de l\'Etre.wav', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `pochette` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reseaux`
--

CREATE TABLE `reseaux` (
  `id` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `lien` text CHARACTER SET utf8 NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `reseaux`
--

INSERT INTO `reseaux` (`id`, `updated`, `created`, `name`, `lien`, `logo`) VALUES
(1, '2017-06-19 16:47:42', '2017-06-19 16:47:42', 'Facebook', 'https://www.facebook.com/zesmoprod/', 'data/reseaux/facebook.png'),
(2, '2017-06-19 16:49:04', '2017-06-19 16:49:04', 'Soundcloud', 'https://soundcloud.com/fran-ois-b-nard/tracks', 'data/reseaux/soundcloud.png'),
(3, '2017-06-19 16:50:03', '2017-06-19 16:50:03', 'Youtube', 'https://www.youtube.com/channel/UCFTNsCODc0PG5ATbKPPfiSw/videos?sort=dd&view=0&shelf_id=0', 'data/reseaux/youtube.png'),
(4, '2017-06-19 16:50:33', '2017-06-19 16:50:33', 'Linkedin', 'https://www.linkedin.com/in/fran%C3%A7ois-b%C3%A9nard-68632213b/', 'data/reseaux/linkedin.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contenue`
--
ALTER TABLE `contenue`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reseaux`
--
ALTER TABLE `reseaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contenue`
--
ALTER TABLE `contenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reseaux`
--
ALTER TABLE `reseaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;