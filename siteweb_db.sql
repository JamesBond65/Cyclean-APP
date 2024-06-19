-- --------------------------------------------------------
-- Hôte:                         
-- Version du serveur:           5.7.31-0ubuntu0.16.04.1 - (Ubuntu)
-- SE du serveur:                Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `amis` (
  `NumeroRelation` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `IdAmi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amis`
--

INSERT INTO `amis` (`NumeroRelation`, `Id`, `IdAmi`) VALUES
(1, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `demandesamis`
--

CREATE TABLE `demandesamis` (
  `NumeroDemande` int(11) NOT NULL,
  `IdDemandeur` int(11) NOT NULL,
  `IdReceveur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demandesamis`
--

INSERT INTO `demandesamis` (`NumeroDemande`, `IdDemandeur`, `IdReceveur`) VALUES
(1, 6, 3),
(2, 8, 3);

-- Table structure for table `faq`
CREATE TABLE `faq` (
  `idQuestion` int(11) NOT NULL,
  `texte` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `question` tinyint(1) NOT NULL DEFAULT '0',
  `reponse` tinyint(1) NOT NULL DEFAULT '0',
  `reponse_de_la_question` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `faq`
INSERT INTO `faq` (`idQuestion`, `texte`, `pseudo`, `question`, `reponse`, `reponse_de_la_question`, `date`) VALUES
(1, 'discussion', 'Stanley', 1, 0, 0, '2022-01-25 20:47:00'),
(2, 'réponse', 'Stanley', 0, 1, 1, '2022-01-25 20:47:00'),
(3, 'réponse', 'Stanley', 0, 1, 1, '2022-01-25 20:47:00'),
(4, 'réponse', 'Stanley', 0, 1, 1, '2022-01-25 20:49:00');


-- Table structure for table `mesures`
CREATE TABLE `mesures` (
  `NumeroMesure` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `NumSerie` int(11) NOT NULL,
  `TypeCapteur` varchar(255) DEFAULT NULL,
  `DateMesure` datetime DEFAULT NULL,
  `ValeurMesure` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `mesures`
INSERT INTO `mesures` (`NumeroMesure`, `Id`, `NumSerie`, `TypeCapteur`, `DateMesure`, `ValeurMesure`) VALUES
	(11, 3, 1, 'FrequenceC', '2020-12-12 01:58:06', 50),
	(12, 3, 1, 'FrequenceC', '2020-12-12 01:58:07', 54),
	(13, 3, 1, 'FrequenceC', '2020-12-12 01:58:09', 51),
	(14, 3, 1, 'FrequenceC', '2020-12-12 01:58:19', 61),
	(15, 3, 1, 'FrequenceC', '2020-12-12 01:58:20', 56),
	(16, 3, 1, 'FrequenceC', '2020-12-12 01:58:21', 48),
	(17, 3, 1, 'FrequenceC', '2020-12-12 01:58:22', 56),
	(18, 3, 1, 'Sonore', '2020-12-12 01:58:06', 47),
	(19, 3, 1, 'Sonore', '2020-12-12 01:58:07', 48),
	(20, 3, 1, 'Sonore', '2020-12-12 01:58:09', 41),
	(21, 3, 1, 'Sonore', '2020-12-12 01:58:10', 42),
	(22, 3, 2, 'FrequenceC', '2021-11-25 01:58:22', 82),
	(23, 3, 2, 'FrequenceC', '2021-11-25 01:58:23', 84),
	(24, 3, 2, 'FrequenceC', '2021-11-25 01:58:24', 89),
	(25, 3, 2, 'FrequenceC', '2021-11-25 01:58:25', 106),
	(26, 3, 2, 'FrequenceC', '2021-11-25 01:58:29', 108),
	(27, 3, 2, 'Sonore', '2021-11-25 01:58:06', 84),
	(28, 3, 2, 'Sonore', '2021-11-25 01:58:09', 88),
	(29, 3, 3, 'Sonore', '2021-12-01 00:00:00', 190),
	(30, 3, 3, 'Sonore', '2021-12-01 01:58:10', 206),
	(31, 3, 3, 'Sonore', '2021-12-01 01:58:12', 57),
	(32, 3, 3, 'Sonore', '2021-12-01 01:59:12', 69),
	(33, 3, 3, 'Sonore', '2021-12-01 01:59:13', 75),
	(34, 3, 3, 'Sonore', '2021-12-01 01:59:15', 79),
	(35, 3, 3, 'FrequenceC', '2021-12-01 01:58:29', 186),
	(36, 3, 3, 'FrequenceC', '2021-12-01 01:58:30', 176),
	(37, 3, 3, 'FrequenceC', '2021-12-01 01:58:31', 154),
	(38, 3, 3, 'FrequenceC', '2021-12-01 01:58:33', 138),
	(39, 3, 3, 'FrequenceC', '2021-12-01 01:58:35', 120),
	(90, 3, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(91, 3, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(92, 3, 3, 'Gaz', '2021-12-01 02:59:36', 780),
	(93, 3, 3, 'Gaz', '2021-12-01 01:57:15', 840),
	(97, 1, 3, 'Gaz', '2021-12-01 02:59:36', 780),
	(98, 1, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(99, 1, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(100, 1, 3, 'Sonore', '2021-12-01 01:59:15', 79),
	(101, 1, 3, 'Sonore', '2021-12-01 01:59:13', 75),
	(102, 1, 3, 'Sonore', '2021-12-01 01:59:12', 69),
	(103, 1, 3, 'FrequenceC', '2021-12-01 01:58:35', 120),
	(104, 1, 3, 'FrequenceC', '2021-12-01 01:58:33', 138),
	(105, 1, 3, 'FrequenceC', '2021-12-01 01:58:31', 154),
	(106, 1, 3, 'FrequenceC', '2021-12-01 01:58:30', 176),
	(107, 1, 3, 'FrequenceC', '2021-12-01 01:58:29', 186),
	(108, 1, 3, 'Sonore', '2021-12-01 01:58:12', 57),
	(109, 1, 3, 'Sonore', '2021-12-01 01:58:10', 206),
	(110, 1, 3, 'Gaz', '2021-12-01 01:57:15', 840),
	(111, 1, 3, 'Sonore', '2021-12-01 00:00:00', 190),
	(112, 1, 2, 'FrequenceC', '2021-11-25 01:58:29', 108),
	(113, 1, 2, 'FrequenceC', '2021-11-25 01:58:25', 106),
	(114, 1, 2, 'FrequenceC', '2021-11-25 01:58:24', 89),
	(115, 1, 2, 'FrequenceC', '2021-11-25 01:58:23', 84),
	(116, 1, 2, 'FrequenceC', '2021-11-25 01:58:22', 82),
	(117, 1, 2, 'Sonore', '2021-11-25 01:58:09', 88),
	(118, 1, 2, 'Sonore', '2021-11-25 01:58:06', 84),
	(119, 1, 1, 'FrequenceC', '2020-12-12 01:58:22', 56),
	(120, 1, 1, 'FrequenceC', '2020-12-12 01:58:21', 48),
	(121, 1, 1, 'FrequenceC', '2020-12-12 01:58:20', 56),
	(122, 1, 1, 'FrequenceC', '2020-12-12 01:58:19', 61),
	(123, 1, 1, 'Sonore', '2020-12-12 01:58:10', 42),
	(124, 1, 1, 'Sonore', '2020-12-12 01:58:09', 41),
	(125, 1, 1, 'FrequenceC', '2020-12-12 01:58:09', 51),
	(126, 1, 1, 'Sonore', '2020-12-12 01:58:07', 48),
	(127, 1, 1, 'FrequenceC', '2020-12-12 01:58:07', 54),
	(128, 1, 1, 'FrequenceC', '2020-12-12 01:58:06', 50),
	(129, 1, 1, 'Sonore', '2020-12-12 01:58:06', 47),
	(130, 42, 3, 'Gaz', '2021-12-01 02:59:36', 780),
	(131, 42, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(132, 42, 3, 'Gaz', '2021-12-01 01:59:15', 580),
	(133, 42, 3, 'Sonore', '2021-12-01 01:59:15', 79),
	(134, 42, 3, 'Sonore', '2021-12-01 01:59:13', 75),
	(135, 42, 3, 'Sonore', '2021-12-01 01:59:12', 69),
	(136, 42, 3, 'FrequenceC', '2021-12-01 01:58:35', 120),
	(137, 42, 3, 'FrequenceC', '2021-12-01 01:58:33', 138),
	(138, 42, 3, 'FrequenceC', '2021-12-01 01:58:31', 154),
	(139, 42, 3, 'FrequenceC', '2021-12-01 01:58:30', 176),
	(140, 42, 3, 'FrequenceC', '2021-12-01 01:58:29', 186),
	(141, 42, 3, 'Sonore', '2021-12-01 01:58:12', 57),
	(142, 42, 3, 'Sonore', '2021-12-01 01:58:10', 206),
	(143, 42, 3, 'Gaz', '2021-12-01 01:57:15', 840),
	(144, 42, 3, 'Sonore', '2021-12-01 00:00:00', 190),
	(145, 42, 2, 'FrequenceC', '2021-11-25 01:58:29', 108),
	(146, 42, 2, 'FrequenceC', '2021-11-25 01:58:25', 106),
	(147, 42, 2, 'FrequenceC', '2021-11-25 01:58:24', 89),
	(148, 42, 2, 'FrequenceC', '2021-11-25 01:58:23', 84),
	(149, 42, 2, 'FrequenceC', '2021-11-25 01:58:22', 82),
	(150, 42, 2, 'Sonore', '2021-11-25 01:58:09', 88),
	(151, 42, 2, 'Sonore', '2021-11-25 01:58:06', 84),
	(152, 42, 1, 'FrequenceC', '2020-12-12 01:58:22', 56),
	(153, 42, 1, 'FrequenceC', '2020-12-12 01:58:21', 48),
	(154, 42, 1, 'FrequenceC', '2020-12-12 01:58:20', 56),
	(155, 42, 1, 'FrequenceC', '2020-12-12 01:58:19', 61),
	(156, 42, 1, 'Sonore', '2020-12-12 01:58:10', 42),
	(157, 42, 1, 'Sonore', '2020-12-12 01:58:09', 41),
	(158, 42, 1, 'FrequenceC', '2020-12-12 01:58:09', 51),
	(159, 42, 1, 'Sonore', '2020-12-12 01:58:07', 48),
	(160, 42, 1, 'FrequenceC', '2020-12-12 01:58:07', 54),
	(161, 42, 1, 'FrequenceC', '2020-12-12 01:58:06', 50),
	(162, 42, 1, 'Sonore', '2020-12-12 01:58:06', 47);


-- Table structure for table `news`
CREATE TABLE `news` (
  `idnews` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `contenu` text,
  `date` datetime DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `news`
INSERT  `news` (`idnews`, `pseudo`, `contenu`, `date`, `titre`) VALUES
	(22, 'Stanley', 'Cette premiÃ¨re publication a pour but d\'introduire le produit cyclean aux yeux du monde.\r\nCyclean est un produit developpÃ© par l\'entreprise GREEN SENSE, leader mondial dans son domaine.\r\n\r\nIl a pour but de rendre les trajets en vÃ©lo plus interactifs avec sa propre santÃ© ainsi que la santÃ© de l\'environnement qui vous entoure.', '2022-01-21 12:18:01', 'PremiÃ¨re publication - Cyclean');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Table structure for table `utilisateurs`
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `APropos` text,
  `CreditsCyclean` int(11) DEFAULT NULL,
  `TypeUtilisateur` varchar(255) DEFAULT NULL,
  `Extension` varchar(10) DEFAULT NULL,
  `Compte` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `utilisateurs`
INSERT INTO `utilisateurs` (`id`, `pseudo`, `Nom`, `prenom`, `email`, `password`, `date`, `APropos`, `CreditsCyclean`, `TypeUtilisateur`, `Extension`, `Compte`) VALUES
(1, 'Stanley', 'BRADLEY', 'Steven', 'steven.bradley@gmail.com', '$2y$12$6B5DfKVteHR1kWAsg.Oh8ufCd1B4OUzmh2qByfmQ/tC2gGa36q4SC', '2022-01-20 12:43:37', 'Ahefjodfsqpks^mfds', 98, 'Administrateur', 'png', 'publique'),
(3, 'Nemo2', 'BRADLEY', 'Bras', 'nemo@gmail.com', '$2y$12$ck5.Cb3AmGqJ5bgAb1ivJecxNbZ2fqrm5jtrRZ0HifgudDjePyr4G', '2021-10-28 15:45:53', 'Je suis un poisson \r\nclown', 999999999, 'Administrateur', 'png', 'prive'),
(42, 'AD', 'free', 'adrien', 'adrien.frieh@eleve.isep.fr', '$2y$12$yCZy2q0ef70n92hywPAQ/e2CKrIdwhjulj2a1SzWvoGzD95dFCX6i', '2022-01-21 08:47:04', '', 90, 'Administrateur', NULL, 'publique'),
(55, '007', 'Bond', 'James', 'james@gmail.com', '$2y$12$IOUrZAu5Lo.x8UNHvFQp4OlTgwhU972NC0195gfecds2swIBoMcQa', '2022-01-21 10:56:24', '', 87, 'Administrateur', 'jpg', 'publique'),
(71, 'Convalescence', 'SY', 'Mouhamed', 'mouhamed.sy@gmail.com', '$2y$12$6DHdebhn13tEP49T8Kj9Ue57hTPSjIVMSWDXgIvRpAdYZwkxd5pHu', '2022-01-21 11:44:34', '', 18, 'Administrateur', 'png', 'publique'),
(108, 'administrateur', 'administrateur', 'administrateur', 'admin@admin.admin', '$2y$12$xg6D8n1zIYetM7feOV22hex4SVT9otEHH0U.b6q8wYHYwvxKxjqkS', '2022-01-22 12:19:02', '', 0, 'Administrateur', NULL, 'publique'),
(109, 'utilisateur', 'Î»', 'utilisateur', 'utilisateur@utilisateur.utilisateur', '$2y$12$anfbdiAKp.7OMRzv1Ae3FOjXx13gMsKj.zbvfGRhYaMukKihA6/Z.', '2022-01-23 13:53:50', '', 0, 'Utilisateur', NULL, 'prive');



/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
