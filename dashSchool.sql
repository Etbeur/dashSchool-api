-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 18 Janvier 2017 à 00:19
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
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `birthDate`, `address`, `phone`, `email`, `emergencyContact`, `github`, `linkedIn`, `personalProject`, `photo`) VALUES
(1, 'solenn', 'baer', '1989-07-04 00:00:00', 'impasse des ports 42840 MONTAGNY', '0669629615', 'solenn.baer@gmail.com', NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `skill_student`
--
ALTER TABLE `skill_student`
  ADD CONSTRAINT `FK_ADD6311A5585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `FK_ADD6311ACB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
