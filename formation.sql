-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 nov. 2024 à 12:46
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
-- Base de données : `formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `nom` varchar(225) NOT NULL,
  `idTheme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `nom`, `idTheme`) VALUES
(1, 'Quantité de travail', 1),
(2, 'Qualité du travail', 1),
(3, 'Organisation', 1),
(4, 'Actualisation des compéte', 1),
(5, 'Service à la population cible', 1),
(18, 'Quantité de travail', 12),
(19, 'Qualité du travail', 12),
(20, 'Esprit critique et jugement', 13),
(21, 'Esprit critique et jugement', 14),
(22, 'Autonomie', 13);

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `modeformation` text NOT NULL,
  `groupecible` text NOT NULL,
  `nbrBenefi` int(11) DEFAULT NULL,
  `nbrJours` varchar(255) NOT NULL,
  `nbrcours` varchar(255) NOT NULL,
  `organisateur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `name`, `datedebut`, `datefin`, `modeformation`, `groupecible`, `nbrBenefi`, `nbrJours`, `nbrcours`, `organisateur`) VALUES
(1, 'لقاء مسؤولات ومسؤولي المصالح المركزية والخارجية للتعاون الوطني المناديب', '2024-02-14', '2024-02-15', 'حضوري', 'رؤساء أقسام ومصالح الإدارة المركزية والمنسقة والمنسقين الجهويين للتعاون الوطني', NULL, '2', '0', 'التعاون الوطني مصلحة استكمال التكوين والتكوين المستمر'),
(2, 'إدماج الأطر الجديدة برسم 2024', '2024-01-15', '2024-01-26', 'عن بعد', 'المستخدمون الجدد برسم 2024', NULL, '12', '5', 'لم يحدد بعد'),
(3, 'إدماج الأطر الجديدة برسم 2024( زيارات ميدانية لكل من مندوبية التعاون الوطني بتمارة وسلا)', '2024-01-30', '2024-01-31', 'حضوري', 'المستخدمون الجدد برسم 2024', NULL, '2', '0', '0'),
(5, 'إدماج الأطر الجديدة برسم 2024', NULL, NULL, 'عن بعد', 'المستخدمون الجدد المكلفين بالسياقة برسم 2024', NULL, '2', '0', 'لم يحدد بعد'),
(6, 'إدماج الأطر الجديدة برسم 2024(الوقاية المدنية)', '2024-04-14', '2024-07-26', 'حضوري', 'المستخدمون الجدد برسم 2022/2023', NULL, '5 ايام لكل مجموعة', '0', '0'),
(13, 'تكوين في مجال علم النفس الاجتماعي والإكلينيكي', NULL, NULL, 'حضوري', 'العامل(ة) الاجتماعي(ة)', NULL, '4', '0', 'التعاون الوطني مصلحة استكمال التكوين والتكوين المستمر'),
(16, 'تقنيات ممارسة أعمال السكرتارية الحديثة', NULL, NULL, 'حضوري', 'الأطر المكلفة بالكتابة', NULL, 'لم يحدد بعد', '0', '0');

-- --------------------------------------------------------

--
-- Structure de la table `coursformation`
--

CREATE TABLE `coursformation` (
  `id` int(11) NOT NULL,
  `idFormation` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coursformation`
--

INSERT INTO `coursformation` (`id`, `idFormation`, `name`) VALUES
(23, 16, 'CV_IKRAM_DJEDIDI_Lvr.pdf'),
(57, 1, 'CV_IKRAM_DJEDIDI_Lvr.pdf'),
(58, 13, 'CV_IKRAM_DJEDIDI_Lvr.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `departementusers`
--

CREATE TABLE `departementusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iddepart` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departementusers`
--

INSERT INTO `departementusers` (`id`, `name`, `iddepart`) VALUES
(1, 'Departement1', NULL),
(2, 'sousdep1-1', 1),
(3, 'sousdep1-2', 1),
(4, 'Departement2', NULL),
(5, 'sousdep2-1', 4),
(6, 'sousdep2-2', 4),
(7, 'sousdep2-3', 4);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `idCompetence` int(11) NOT NULL,
  `idFormation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `note` float NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`id`, `idCompetence`, `idFormation`, `idUser`, `note`, `commentaire`) VALUES
(13, 18, 2, 14, 18, 'normales et qui demande une amélioration significative.'),
(14, 19, 2, 14, 16, 'besoin d\'une formation et encadrement, pour amiliorer'),
(16, 22, 2, 14, 20, 'good'),
(18, 18, 2, 15, 15, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formateurformation`
--

CREATE TABLE `formateurformation` (
  `id` int(11) NOT NULL,
  `idFormation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formateurformation`
--

INSERT INTO `formateurformation` (`id`, `idFormation`, `idUser`) VALUES
(31, 2, 16),
(32, 2, 17),
(33, 5, 16);

-- --------------------------------------------------------

--
-- Structure de la table `imageformation`
--

CREATE TABLE `imageformation` (
  `id` int(11) NOT NULL,
  `idFormation` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `imageformation`
--

INSERT INTO `imageformation` (`id`, `idFormation`, `name`) VALUES
(18, 1, 'entraidenational.png'),
(19, 13, 'entraidenational.png');

-- --------------------------------------------------------

--
-- Structure de la table `personelleformation`
--

CREATE TABLE `personelleformation` (
  `id` int(11) NOT NULL,
  `idFormation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personelleformation`
--

INSERT INTO `personelleformation` (`id`, `idFormation`, `idUser`) VALUES
(25, 2, 14),
(26, 2, 15),
(27, 5, 14),
(28, 5, 15);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `idFormation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `nom`, `idFormation`) VALUES
(1, 'THEME1', 1),
(12, 'Them1', 2),
(13, 'Them2', 2),
(14, 'Them2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `cin` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Personnel',
  `departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `cin`, `age`, `genre`, `password`, `role`, `departement`) VALUES
(13, 'Admin', 'admin@gmail.com', 666666666, 'AE111111', 34, 'Homme', '$2y$12$YAe5pYij8fcjLd.2qKx15OD.Z7cIQyd3kYB4okIbyuFC/8cEPmLm2', 'Admin', 2),
(14, 'personnel1', 'personnel1@gmail.com', 777777777, 'AB222222', 35, 'Femme', '$2y$12$s.PSadL2GCsnhoww3HByse1F2zhnyNeNXtahhISsfIhAC/5wF2pFe', 'Personnel', 3),
(15, 'personnel2', 'personnel2@gmail.com', 777777777, 'AB222222', 35, 'Homme', '$2y$12$95HzNpcdAAcJzA.2lA0E2uZkNZgPIuR6Lp5RilJFAFVjnEQv4mjeK', 'Personnel', 5),
(16, 'formateur1', 'formateur1@gmail.com', 611223344, 'AB112233', 35, 'Homme', '$2y$12$bNfESsQ9Tt30/.7LYatk/eKZSTOAkSkCYMnrj4e3POtUYJVbC3ahi', 'Formateur', 6),
(17, 'formateur2', 'formateur2@gmail.com', 611223344, 'AB112233', 35, 'Femme', '$2y$12$d6QFi4A/IUNmTBgn8Be85.yrhL6M5g8KBclnCth.AfYFSVNA6HKMS', 'Formateur', 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testthem` (`idTheme`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coursformation`
--
ALTER TABLE `coursformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`idFormation`);

--
-- Index pour la table `departementusers`
--
ALTER TABLE `departementusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testdepart` (`iddepart`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testcomp` (`idCompetence`),
  ADD KEY `testforma` (`idFormation`),
  ADD KEY `testtu` (`idUser`);

--
-- Index pour la table `formateurformation`
--
ALTER TABLE `formateurformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testf` (`idFormation`),
  ADD KEY `testu` (`idUser`);

--
-- Index pour la table `imageformation`
--
ALTER TABLE `imageformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testt` (`idFormation`);

--
-- Index pour la table `personelleformation`
--
ALTER TABLE `personelleformation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testp` (`idFormation`),
  ADD KEY `testuser` (`idUser`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testform` (`idFormation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testdepuser` (`departement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `coursformation`
--
ALTER TABLE `coursformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `departementusers`
--
ALTER TABLE `departementusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `formateurformation`
--
ALTER TABLE `formateurformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `imageformation`
--
ALTER TABLE `imageformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `personelleformation`
--
ALTER TABLE `personelleformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `testthem` FOREIGN KEY (`idTheme`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coursformation`
--
ALTER TABLE `coursformation`
  ADD CONSTRAINT `test` FOREIGN KEY (`idformation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `departementusers`
--
ALTER TABLE `departementusers`
  ADD CONSTRAINT `testdepart` FOREIGN KEY (`iddepart`) REFERENCES `departementusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `testcomp` FOREIGN KEY (`idCompetence`) REFERENCES `competence` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testforma` FOREIGN KEY (`idFormation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testtu` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formateurformation`
--
ALTER TABLE `formateurformation`
  ADD CONSTRAINT `testf` FOREIGN KEY (`idFormation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testu` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `imageformation`
--
ALTER TABLE `imageformation`
  ADD CONSTRAINT `testt` FOREIGN KEY (`idFormation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personelleformation`
--
ALTER TABLE `personelleformation`
  ADD CONSTRAINT `testp` FOREIGN KEY (`idFormation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testuser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `testform` FOREIGN KEY (`idFormation`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `testdepuser` FOREIGN KEY (`departement`) REFERENCES `departementusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
