{\rtf1\ansi\ansicpg1252\cocoartf1504\cocoasubrtf830
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.6.5.2\
-- https://www.phpmyadmin.net/\
--\
-- Client :  localhost:8889\
-- G\'e9n\'e9r\'e9 le :  Lun 03 Juillet 2017 \'e0 15:08\
-- Version du serveur :  5.6.35\
-- Version de PHP :  7.1.1\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Base de donn\'e9es :  `zesmoprod`\
--\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `contenue`\
--\
\
CREATE TABLE `contenue` (\
  `id` int(11) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `titre` varchar(50) NOT NULL,\
  `texte` text NOT NULL\
) ENGINE=MyISAM DEFAULT CHARSET=utf8;\
\
--\
-- Contenu de la table `contenue`\
--\
\
INSERT INTO `contenue` (`id`, `created`, `updated`, `titre`, `texte`) VALUES\
(1, '2017-06-20 09:58:33', '2017-06-20 09:58:33', '2016 - 2017', 'Ev\'e8nement avec Contrast System:\\r\\n<br>\\r\\nAssistant technicien son et lumi\'e8re<br>\\r\\nAide \'e0 l\\'installation de mat\'e9riel<br>\\r\\nMise en place des platines et des lumi\'e8res\\r\\nD\'e9charge du mat\'e9riel d\\'accueil<br>\\r\\n2\'e8me ann\'e9e \'e0 l\\'ESRA - Paris, section ISTS.'),\
(2, '2017-06-20 10:00:28', '2017-06-20 10:00:28', '2015 - 2016', '1\'e8re ann\'e9e \'e0 l\\'ESRA - Paris, section ISTS<br>\\r\\nApprentissage des logiciels Ableton Live et Pro Tools'),\
(3, '2017-06-20 10:02:03', '2017-07-03 09:13:35', '2014 - 2015', 'Passage du Bac Scientifique');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `cv`\
--\
\
CREATE TABLE `cv` (\
  `id` int(255) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `lien` text NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Contenu de la table `cv`\
--\
\
INSERT INTO `cv` (`id`, `created`, `updated`, `lien`) VALUES\
(1, '2017-07-02 15:14:29', '2017-07-02 15:14:29', 'https://drive.google.com/file/d/0BxWEeVuQ7T1Zel9vUDc1VE45ekE/view');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `mescreations`\
--\
\
CREATE TABLE `mescreations` (\
  `id` int(11) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `titre` varchar(255) NOT NULL,\
  `fichier` varchar(255) NOT NULL\
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;\
\
--\
-- Contenu de la table `mescreations`\
--\
\
INSERT INTO `mescreations` (`id`, `created`, `updated`, `titre`, `fichier`) VALUES\
(2, '2017-07-02 23:00:26', '2017-07-03 09:29:19', '3-Liberty', ''),\
(4, '2017-07-02 23:02:12', '2017-07-03 09:31:04', '2-Brotherhood', ''),\
(5, '2017-07-02 23:02:37', '2017-07-03 09:29:31', '1-Egality', '');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `mesenregistrements`\
--\
\
CREATE TABLE `mesenregistrements` (\
  `id` int(11) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `titre` text NOT NULL,\
  `fichier` varchar(255) NOT NULL\
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;\
\
--\
-- Contenu de la table `mesenregistrements`\
--\
\
INSERT INTO `mesenregistrements` (`id`, `created`, `updated`, `titre`, `fichier`) VALUES\
(2, '2017-07-02 23:05:56', '2017-07-03 09:13:59', 'Le Miracle de l\\'Etre', '');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `movie`\
--\
\
CREATE TABLE `movie` (\
  `id` int(11) NOT NULL,\
  `created` date NOT NULL,\
  `updated` datetime NOT NULL,\
  `titre` varchar(250) NOT NULL,\
  `description` text NOT NULL,\
  `lien` varchar(255) NOT NULL,\
  `cover` varchar(255) NOT NULL\
) ENGINE=MyISAM DEFAULT CHARSET=utf8;\
\
--\
-- Contenu de la table `movie`\
--\
\
INSERT INTO `movie` (`id`, `created`, `updated`, `titre`, `description`, `lien`, `cover`) VALUES\
(2, '2017-06-19', '2017-06-19 15:13:09', 'Naqoyqatsi Ists2A21', 'Composition musicale: Alexandre Poinseaux , Roman Prazuck et Fran\'e7ois B\'e9nard \\r\\nImages : Naqoyqatsi', 'https://www.youtube.com/watch?v=x8wXSxMNfHI', 'cover-002.jpg'),\
(8, '2017-06-21', '2017-07-02 15:26:32', 'Gladiator (re)composition', 'Recomposition de la musique d\\'un extrait du film \\"Gladiator\\" , 2002 ,par Alexandre Poinseaux , Roman Prazuck et moi-m\'eame.', 'https://www.youtube.com/watch?v=41wZbyxOxmI', 'cover-1499001966.jpg');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `playlist`\
--\
\
CREATE TABLE `playlist` (\
  `id` int(11) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `titre` varchar(50) NOT NULL,\
  `description` text,\
  `pochette` varchar(255) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;\
\
--\
-- Contenu de la table `playlist`\
--\
\
INSERT INTO `playlist` (`id`, `created`, `updated`, `titre`, `description`, `pochette`) VALUES\
(4, '2017-07-02 19:26:31', '2017-07-02 19:26:31', 'Mes Cr\'e9ations Musicales', 'Cette playlist met en avant mes r\'e9alisations. En esp\'e9rant que vous appr\'e9cierez', 'data/pochette/onde.jpg'),\
(5, '2017-07-02 19:26:58', '2017-07-02 19:26:58', 'Mes Enregistrements', 'Cette playlist met en avant les enregistrements et mixes que j\\'ai r\'e9alis\'e9 pour des artistes.', 'data/pochette/micro.jpg');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `reseaux`\
--\
\
CREATE TABLE `reseaux` (\
  `id` int(11) NOT NULL,\
  `updated` datetime NOT NULL,\
  `created` datetime NOT NULL,\
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,\
  `lien` text CHARACTER SET utf8 NOT NULL,\
  `logo` varchar(255) CHARACTER SET utf8 NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;\
\
--\
-- Contenu de la table `reseaux`\
--\
\
INSERT INTO `reseaux` (`id`, `updated`, `created`, `name`, `lien`, `logo`) VALUES\
(1, '2017-07-02 18:33:53', '2017-06-19 16:47:42', 'Facebook', 'https://www.facebook.com/zesmoprod/', 'data/reseaux/facebook.png'),\
(2, '2017-07-02 16:17:32', '2017-06-19 16:49:04', 'Soundcloud', 'https://soundcloud.com/fran-ois-b-nard/tracks', 'data/reseaux/soundcloud.png'),\
(3, '2017-07-02 16:17:40', '2017-06-19 16:50:03', 'Youtube', 'https://www.youtube.com/channel/UCFTNsCODc0PG5ATbKPPfiSw/videos?sort=dd&view=0&shelf_id=0', 'data/reseaux/youtube.png'),\
(4, '2017-07-02 16:17:18', '2017-06-19 16:50:33', 'Linkedin', 'https://www.linkedin.com/in/fran%C3%A7ois-b%C3%A9nard-68632213b/', 'data/reseaux/linkedin.png');\
\
-- --------------------------------------------------------\
\
--\
-- Structure de la table `user`\
--\
\
CREATE TABLE `user` (\
  `id` int(11) NOT NULL,\
  `created` datetime NOT NULL,\
  `updated` datetime NOT NULL,\
  `username` varchar(25) NOT NULL,\
  `password` varchar(255) NOT NULL\
) ENGINE=MyISAM DEFAULT CHARSET=utf8;\
\
--\
-- Contenu de la table `user`\
--\
\
INSERT INTO `user` (`id`, `created`, `updated`, `username`, `password`) VALUES\
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'francois', '4fb712068711c39a12c6a835b21e352fcf757e90adecf4f96dabf00bcbea738caeaabfb91e0e901cc6fd9261f49f46211d784c8052a73c5dbffa3456480d4adc');\
\
--\
-- Index pour les tables export\'e9es\
--\
\
--\
-- Index pour la table `contenue`\
--\
ALTER TABLE `contenue`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `cv`\
--\
ALTER TABLE `cv`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `mescreations`\
--\
ALTER TABLE `mescreations`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `mesenregistrements`\
--\
ALTER TABLE `mesenregistrements`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `movie`\
--\
ALTER TABLE `movie`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `playlist`\
--\
ALTER TABLE `playlist`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `reseaux`\
--\
ALTER TABLE `reseaux`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Index pour la table `user`\
--\
ALTER TABLE `user`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- AUTO_INCREMENT pour les tables export\'e9es\
--\
\
--\
-- AUTO_INCREMENT pour la table `contenue`\
--\
ALTER TABLE `contenue`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;\
--\
-- AUTO_INCREMENT pour la table `cv`\
--\
ALTER TABLE `cv`\
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;\
--\
-- AUTO_INCREMENT pour la table `mesenregistrements`\
--\
ALTER TABLE `mesenregistrements`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;\
--\
-- AUTO_INCREMENT pour la table `movie`\
--\
ALTER TABLE `movie`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;\
--\
-- AUTO_INCREMENT pour la table `playlist`\
--\
ALTER TABLE `playlist`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;\
--\
-- AUTO_INCREMENT pour la table `reseaux`\
--\
ALTER TABLE `reseaux`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;\
--\
-- AUTO_INCREMENT pour la table `user`\
--\
ALTER TABLE `user`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;}