-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mar 17 Janvier 2017 à 10:53
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dashSchool`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competence` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `competences`
--

INSERT INTO `competences` (`id_competence`, `nom`) VALUES
(1, 'HTML5'),
(2, 'CSS3'),
(3, 'Javascript'),
(4, 'PHP'),
(5, 'Angular2'),
(6, 'Symfony3'),
(7, 'React'),
(8, 'AngularJS'),
(9, 'Git'),
(10, 'Developpement front-end'),
(11, 'Developpement back-end'),
(12, 'Photoshop'),
(13, 'Illustrator'),
(14, 'Ruby'),
(15, 'Wordpress'),
(16, 'Drupal'),
(17, 'TypeScript'),
(18, 'MySQL');

-- --------------------------------------------------------

--
-- Structure de la table `competences_eleves`
--

CREATE TABLE `competences_eleves` (
  `id_competence` int(20) NOT NULL,
  `id_eleve` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id_eleve` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `birthDate` date NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `emergencyContact` varchar(255) COLLATE utf8_bin NOT NULL,
  `github` varchar(255) COLLATE utf8_bin NOT NULL,
  `linkedin` varchar(255) COLLATE utf8_bin NOT NULL,
  `personalProject` varchar(255) COLLATE utf8_bin NOT NULL,
  `photo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `competences_eleves`
--
ALTER TABLE `competences_eleves`
  ADD PRIMARY KEY (`id_eleve`,`id_competence`),
  ADD KEY `link_competence` (`id_competence`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id_eleve`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competences_eleves`
--
ALTER TABLE `competences_eleves`
  ADD CONSTRAINT `link_competence` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competence`) ON DELETE CASCADE,
  ADD CONSTRAINT `link_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleves` (`id_eleve`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
