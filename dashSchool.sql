-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 23 Janvier 2017 à 10:21
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.9

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
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `skill`
--

INSERT INTO `skill` (`id`, `name`) VALUES
(6, 'Angular2'),
(5, 'AngularJS'),
(2, 'CSS3'),
(14, 'Developpement Back-End'),
(13, 'Developpement Front-End'),
(20, 'Django'),
(16, 'Drupal'),
(1, 'HTML5'),
(12, 'Illustrator'),
(3, 'Javascript'),
(8, 'MySQL'),
(11, 'Photoshop'),
(4, 'PHP'),
(18, 'Python'),
(19, 'Rails'),
(9, 'React'),
(17, 'Ruby'),
(7, 'Symfony3'),
(10, 'TypeScript'),
(15, 'Wordpress');

-- --------------------------------------------------------

--
-- Structure de la table `skill_student`
--

CREATE TABLE `skill_student` (
  `student_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `skill_student`
--

INSERT INTO `skill_student` (`student_id`, `skill_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 8),
(1, 11),
(1, 14),
(2, 1),
(2, 9),
(2, 12),
(2, 18),
(2, 20),
(3, 1),
(3, 2),
(3, 11),
(3, 12),
(3, 15);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emergencyContact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedIn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personalProject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `birthDate`, `address`, `phone`, `email`, `emergencyContact`, `github`, `linkedIn`, `personalProject`, `photo`, `gender`) VALUES
(1, 'solenn', 'baer', '1989-07-04 00:00:00', 'impasse des ports 42840 MONTAGNY', '0669629615', 'solenn.baer@gmail.com', NULL, NULL, NULL, NULL, NULL, 'female'),
(2, 'fifi', 'brindacier', '2000-10-20 00:00:00', 'rue des couettes ', '0102030405', 'fifi.brindacier@gmail.com', 'Brenda Brindacier 0909090909', 'githubDeFifi', 'Linkedin de fifi', 'ProjetPersonnelDeFifi', 'https://www.afds.tv/wp-content/uploads/2009/10/pipilangimage.png', 'female'),
(3, 'Bob', 'Leponge', '1999-11-17 00:00:00', 'l''ananas au fond de la mer', '0102030405', 'bob.leponge@crabecroustillant.sousleau', 'Patrick au rocher a cote', 'GithubDeBob', 'LinkedinDeBob', 'ProjetDeBob', 'http://www.bob-l-eponge.info/Images/Bob_eponge/spongebob.png', 'male');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin', 'admin', 'dead', 'luke');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5E3DE4775E237E06` (`name`);

--
-- Index pour la table `skill_student`
--
ALTER TABLE `skill_student`
  ADD PRIMARY KEY (`student_id`,`skill_id`),
  ADD KEY `IDX_ADD6311ACB944F1A` (`student_id`),
  ADD KEY `IDX_ADD6311A5585C142` (`skill_id`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B723AF33E7927C74` (`email`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
