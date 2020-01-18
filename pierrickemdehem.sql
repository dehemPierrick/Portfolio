-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : pierrickemdehem.mysql.db
-- Généré le :  sam. 18 jan. 2020 à 14:10
-- Version du serveur :  5.6.46-log
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pierrickemdehem`
--

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioCompetences`
--

CREATE TABLE `PortfolioCompetences` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `photo` varchar(32) NOT NULL,
  `path` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PortfolioCompetences`
--

INSERT INTO `PortfolioCompetences` (`id`, `title`, `photo`, `path`) VALUES
(1, 'HTML 5', 'html5.png', 'images'),
(2, 'CSS 3', 'css3.png', 'images'),
(3, 'JAVASCRIPT', 'JS.png', 'images'),
(4, 'JQUERY', 'jquery.png', 'images'),
(5, 'PHP', 'php.png', 'images'),
(6, 'MYSQL', 'mysql.png', 'images'),
(7, 'MVC', 'mvc.png', 'images'),
(8, 'WORDPRESS', 'WordPress-Logo.png', 'images'),
(9, 'BOOTSTRAP', 'bootstrap.png', 'images');

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioEducations`
--

CREATE TABLE `PortfolioEducations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `nameSchool` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `periode` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PortfolioEducations`
--

INSERT INTO `PortfolioEducations` (`id`, `title`, `nameSchool`, `city`, `periode`) VALUES
(1, 'Développeur Intégrateur en réalisation d\'applications Web (Titre RNCP Niveau3)', '3W Academy', 'Paris 18éme', '2018'),
(2, 'BTS IRIS (Informatique et Réseaux pour l\'Industrie et les Services Techniques)', 'Lycée Gustave Eiffel', 'Armentières', '2005'),
(3, 'BAC STI Electronique ', 'Lycée Gustave Eiffel', 'Armentières', '2003');

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioExperiences`
--

CREATE TABLE `PortfolioExperiences` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `society` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `periode` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PortfolioExperiences`
--

INSERT INTO `PortfolioExperiences` (`id`, `title`, `society`, `city`, `content`, `periode`) VALUES
(1, 'Planificateur / Prévisionniste', 'Teleperformance France', 'Villeneuve d’Ascq', 'Réalisation de la planification des ressources humaines afin de répondre aux besoins du client en fonction des taux d’absentéisme, de turnover, de productivité et ce dans le respect des directives en matière de gestion du temps de travail (Accord, équités …)', 'Depuis Avril 2011'),
(2, 'Vigiste', 'Teleperformance France', 'Villeneuve d’Ascq', 'En charge de la gestion des flux d’appels, des pauses, des incidents sur le plateau, des bilans et des statistiques afin d’assurer un suivi de la production sur le plateau.', 'Juin 2008 – Mars 2011'),
(3, 'Technicien Support Hotline', 'Techcity Solution', 'Villeneuve d’Ascq', 'En charge de traiter  les appels reçus et émis, + diverses missions (Aide Support Terrain pour les conseillers, Chargé de la validation des interventions et de la détection des incidents …)', 'Février 2006 – Mai 2008');

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioProjects`
--

CREATE TABLE `PortfolioProjects` (
  `id` int(11) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `content` text NOT NULL,
  `photo` varchar(32) NOT NULL,
  `periode` varchar(32) DEFAULT NULL,
  `path` varchar(32) NOT NULL,
  `description` text,
  `langages` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PortfolioProjects`
--

INSERT INTO `PortfolioProjects` (`id`, `title`, `content`, `photo`, `periode`, `path`, `description`, `langages`) VALUES
(4, 'Green Office', 'Projet Réalisé durant la formation 3W Academy', 'desktopGreenOffice.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant le float', 'HTML, CSS'),
(5, 'Fish & Chips', 'Projet Réalisé durant la formation 3W Academy', 'desktopFish&Chips.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant le inline-block', 'HTML, CSS'),
(6, 'Ila Yoga 1', 'Projet Réalisé durant la formation 3W Academy', 'desktopIlaYoga1.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant le float ou le inline-block', 'HTML, CSS'),
(7, 'Realty Group', 'Projet Réalisé durant la formation 3W Academy', 'desktopRealtyGroup.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant le positionnement en CSS(position absolute, display block..)', 'HTML, CSS'),
(8, 'Creasoul', 'Projet Réalisé durant la formation 3W Academy', 'desktopCreasoul.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en responsive', 'HTML, CSS'),
(9, 'Wolf Gang', 'Projet Réalisé durant la formation 3W Academy', 'desktopWolfGang.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant Jquery et intégration d\'une vidéo', 'HTML, CSS'),
(10, 'Mindgeek', 'Projet Réalisé durant la formation 3W Academy', 'desktopMindgeek-home.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette en utilisant les flexbox', 'HTML, CSS'),
(11, 'Cup of Tea', 'Projet Réalisé durant la formation 3W Academy', 'desktopCupOfTea-home.jpg', '09/2018 - 11/2018', 'images/projets/', 'Intégration d\'une maquette ', 'HTML, CSS'),
(12, 'Selecteur de Photos(JAVASCRIPT)', 'Projet Réalisé durant la formation 3W Academy', 'SelecteurPhotos.jpg', '09/2018 - 11/2018', 'images/projets/', 'Afficher une liste de photos sélectionnable d\'un clic de souris', ' avec un message indiquant le nombre de photos sélectionnées à chaque instant.'),
(13, 'Ardoise_Magique(JAVASCRIPT)', 'Projet Réalisé durant la formation 3W Academy', 'ArdoiseMagique.jpg', '09/2018 - 11/2018', 'images/projets/', 'API HTML5 Canvas et le JavaScript', 'HTML, CSS, JS Programmation Orientée Objets'),
(14, 'Snake (Javascript)', 'Développement en javascript', 'Snake.jpg', '10/2018', 'images/projets/', 'Projet Personel', 'HTML, CSS, JS'),
(15, 'Restaurant(PHP site e-commerce)', 'Projet Réalisé durant la formation 3W Academy', 'Restaurant.jpg', '09/2018 - 11/2018', 'images/projets/', 'Projet d\'un restaurant réalisé à la fin de la formation 3W Academy', 'PHP, JS, SQL, HTML, CSS, AJAX, JQUERY');

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioUsers`
--

CREATE TABLE `PortfolioUsers` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` int(2) NOT NULL,
  `email` varchar(64) NOT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PortfolioUsers`
--

INSERT INTO `PortfolioUsers` (`id`, `name`, `password`, `role`, `email`, `birthday`) VALUES
(1, 'Pierrick Dehem', '$2y$11$9825ef53962875a25b998uHeQJsh3WIfhj6F.vo2m820bV5r2.8uS', 1, 'p.dehem@gmail.com', '1985-01-03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `PortfolioCompetences`
--
ALTER TABLE `PortfolioCompetences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PortfolioEducations`
--
ALTER TABLE `PortfolioEducations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PortfolioExperiences`
--
ALTER TABLE `PortfolioExperiences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PortfolioProjects`
--
ALTER TABLE `PortfolioProjects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PortfolioUsers`
--
ALTER TABLE `PortfolioUsers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `PortfolioCompetences`
--
ALTER TABLE `PortfolioCompetences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `PortfolioEducations`
--
ALTER TABLE `PortfolioEducations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `PortfolioExperiences`
--
ALTER TABLE `PortfolioExperiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `PortfolioProjects`
--
ALTER TABLE `PortfolioProjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `PortfolioUsers`
--
ALTER TABLE `PortfolioUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
