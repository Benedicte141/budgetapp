-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 31 mars 2025 à 23:18
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
-- Base de données : `budget_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id` int(11) NOT NULL,
  `type_abonnement_id` int(11) DEFAULT NULL,
  `periodicite_id` int(11) DEFAULT NULL,
  `organisme_id` int(11) DEFAULT NULL,
  `numero_client` varchar(255) NOT NULL,
  `date_souscription` datetime NOT NULL,
  `montant` double NOT NULL,
  `objet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `type_abonnement_id`, `periodicite_id`, `organisme_id`, `numero_client`, `date_souscription`, `montant`, `objet`) VALUES
(1, 5, 1, 3, '05-56-8956', '2025-03-30 20:22:42', 5, 'Abonnement avec publicité'),
(2, 5, 2, 2, '56-8956-46862', '2025-03-30 20:22:42', 60, 'Abonnement Prime Vidéo');

-- --------------------------------------------------------

--
-- Structure de la table `bank_api`
--

CREATE TABLE `bank_api` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `version` varchar(15) NOT NULL,
  `field_mapping` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`field_mapping`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE `banque` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `bank_api_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id`, `nom`, `bank_api_id`) VALUES
(1, 'LCL', NULL),
(2, 'BNP', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Loisirs'),
(2, 'Epargne');

-- --------------------------------------------------------

--
-- Structure de la table `compagnie`
--

CREATE TABLE `compagnie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compagnie`
--

INSERT INTO `compagnie` (`id`, `libelle`) VALUES
(1, 'TQ Group'),
(2, 'ABM Transports');

-- --------------------------------------------------------

--
-- Structure de la table `compagnie_assurance`
--

CREATE TABLE `compagnie_assurance` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compagnie_assurance`
--

INSERT INTO `compagnie_assurance` (`id`, `nom`, `adresse`, `cp`, `ville`) VALUES
(1, 'AXA Caen', '14 rue de la belle porte', '14000', 'Caen'),
(2, 'CNP Paris', '56 avenue de la rose blanche', '61100', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `banque_id` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `solde` double NOT NULL,
  `type_compte_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `banque_id`, `numero`, `nom`, `solde`, `type_compte_id`) VALUES
(1, 2, 'AV-595-44510', 'Courses', 50, 1),
(2, 1, '456-78916', 'Compte Moi', 46000, 2);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id` int(11) NOT NULL,
  `periodicite_id` int(11) DEFAULT NULL,
  `compagnie_id` int(11) DEFAULT NULL,
  `type_contrat_id` int(11) DEFAULT NULL,
  `date_sous` date NOT NULL,
  `montant` double NOT NULL,
  `libelle_couverture` varchar(255) NOT NULL,
  `num_client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`id`, `periodicite_id`, `compagnie_id`, `type_contrat_id`, `date_sous`, `montant`, `libelle_couverture`, `num_client`) VALUES
(1, 1, 1, 2, '2025-03-29', 200, 'Ménage chez Mamie', '456-789-52');

-- --------------------------------------------------------

--
-- Structure de la table `contrat_assurance_vie`
--

CREATE TABLE `contrat_assurance_vie` (
  `id` int(11) NOT NULL,
  `compagnie_assurance_id` int(11) NOT NULL,
  `mode_gestion_id` int(11) NOT NULL,
  `periodicite_id` int(11) DEFAULT NULL,
  `solde` decimal(15,2) NOT NULL,
  `montant_value_latente` decimal(15,2) NOT NULL,
  `total_investit` decimal(15,2) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `total_rachete` decimal(15,2) NOT NULL,
  `date_ouverture` date NOT NULL,
  `montant_versement_libre` decimal(15,2) DEFAULT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrat_assurance_vie`
--

INSERT INTO `contrat_assurance_vie` (`id`, `compagnie_assurance_id`, `mode_gestion_id`, `periodicite_id`, `solde`, `montant_value_latente`, `total_investit`, `numero`, `total_rachete`, `date_ouverture`, `montant_versement_libre`, `nom`) VALUES
(1, 1, 1, 2, 16000.00, 4500.00, 15000.00, '456-78916', 6000.00, '2024-12-17', 5698.00, 'Assurance tout risques');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241206144254', '2024-12-06 15:44:27', 81),
('DoctrineMigrations\\Version20241217103402', '2024-12-17 11:34:19', 201),
('DoctrineMigrations\\Version20241219145949', '2024-12-19 16:00:15', 719),
('DoctrineMigrations\\Version20250116075831', '2025-01-16 08:58:54', 214),
('DoctrineMigrations\\Version20250116080841', '2025-01-16 09:08:47', 18),
('DoctrineMigrations\\Version20250327173251', '2025-03-27 18:33:04', 183);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id` int(11) NOT NULL,
  `periodicite_id` int(11) NOT NULL,
  `type_emprunt_id` int(11) NOT NULL,
  `banque_id` int(11) NOT NULL,
  `montant_initial` double NOT NULL,
  `montant_echeance` double NOT NULL,
  `cout_interet` double NOT NULL,
  `montant_rest_du` double DEFAULT NULL,
  `date_deb` date NOT NULL,
  `taux` double NOT NULL,
  `objet` varchar(255) NOT NULL,
  `duree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `periodicite_id`, `type_emprunt_id`, `banque_id`, `montant_initial`, `montant_echeance`, `cout_interet`, `montant_rest_du`, `date_deb`, `taux`, `objet`, `duree`) VALUES
(69, 1, 1, 1, 5000, 4, 550, 2500, '2000-11-10', 2.5, 'Achat Porsche', 200),
(70, 1, 1, 1, 2000, 50, 125, 1500, '2000-10-10', 2.5, 'Emprunt vélo', 300),
(81, 1, 1, 1, 5000, 400, 550, 2500, '2001-10-10', 2.5, 'Achat reve', 200),
(82, 1, 1, 1, 5000, 400, 550, 2500, '2001-10-10', 2.5, 'Emprunt ndun truc', 200);

-- --------------------------------------------------------

--
-- Structure de la table `import_error`
--

CREATE TABLE `import_error` (
  `id` int(11) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `error_type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `raw_data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:165:\\\"http://127.0.0.1:8000/verify/email?expires=1742654900&signature=5rroIYWEWFTNIwb0Whu73xs4vYbe24EULWbm4hFoyuI%3D&token=1KlLcmd2Ko%2BuShOMiTAvCyZP6nOLBXQ5Jv7c9kQvl7Q%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:32:\\\"benedicte.gady@sts-sio-caen.info\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:8:\\\"No Reply\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:32:\\\"benedicte.gady@sts-sio-caen.info\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-03-22 13:48:20', '2025-03-22 13:48:20', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:169:\\\"http://127.0.0.1:8000/verify/email?expires=1743100724&signature=wg614CcyeN%2FfXa7ZtsBy6OKjGWyeLJPmBsZQFC1XfvY%3D&token=35DmgxL3xNVip%2FV3WO6aJIfDmvgBmEMBMRI3dn%2FzsMg%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:32:\\\"anaelle.bargas@sts-sio-caen.info\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:8:\\\"No Reply\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:32:\\\"anaelle.bargas@sts-sio-caen.info\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-03-27 17:38:45', '2025-03-27 17:38:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mode_gestion`
--

CREATE TABLE `mode_gestion` (
  `id` int(11) NOT NULL,
  `libelle` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_gestion`
--

INSERT INTO `mode_gestion` (`id`, `libelle`) VALUES
(1, 'prudent'),
(2, 'équilibré'),
(3, 'risqué');

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `libelle` varchar(25) DEFAULT NULL,
  `external_id` varchar(100) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `compte_id`, `montant`, `libelle`, `external_id`, `date`) VALUES
(1, 1, 20, 'achat côte de boeuf', NULL, '2025-03-27'),
(2, 1, 10, 'Jupe H&M', NULL, '2025-03-27');

-- --------------------------------------------------------

--
-- Structure de la table `organisme`
--

CREATE TABLE `organisme` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `organisme`
--

INSERT INTO `organisme` (`id`, `nom`) VALUES
(2, 'Amazon'),
(3, 'Netflix');

-- --------------------------------------------------------

--
-- Structure de la table `periodicite`
--

CREATE TABLE `periodicite` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `periodicite`
--

INSERT INTO `periodicite` (`id`, `libelle`) VALUES
(1, 'Mensuelle'),
(2, 'Annuelle'),
(3, 'Mensuelle'),
(4, 'Annuelle');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `budget_mensuel` double DEFAULT NULL,
  `budget_annuel` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `categorie_id`, `libelle`, `budget_mensuel`, `budget_annuel`) VALUES
(1, 1, 'Voyage', 50, 500),
(2, 2, 'Livret', 10, NULL),
(5, 2, 'PEL', NULL, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `type_abonnement`
--

CREATE TABLE `type_abonnement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_abonnement`
--

INSERT INTO `type_abonnement` (`id`, `nom`) VALUES
(2, 'Coûts téléphoniques'),
(5, 'Plateformes Vidéo');

-- --------------------------------------------------------

--
-- Structure de la table `type_compte`
--

CREATE TABLE `type_compte` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_compte`
--

INSERT INTO `type_compte` (`id`, `libelle`) VALUES
(1, 'Livret jeune'),
(2, 'Courant');

-- --------------------------------------------------------

--
-- Structure de la table `type_contrat`
--

CREATE TABLE `type_contrat` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_contrat`
--

INSERT INTO `type_contrat` (`id`, `libelle`) VALUES
(1, 'Livraison professionnelles'),
(2, 'Contrat de Service de Ménage');

-- --------------------------------------------------------

--
-- Structure de la table `type_emprunt`
--

CREATE TABLE `type_emprunt` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_emprunt`
--

INSERT INTO `type_emprunt` (`id`, `libelle`) VALUES
(1, 'Immobilier'),
(2, 'Voiture'),
(3, 'Immobilier'),
(4, 'Voiture');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `civilite` varchar(15) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `nom`, `prenom`, `civilite`, `cp`, `pays`, `adresse`, `ville`) VALUES
(1, 'benedicte.gady@sts-sio-caen.info', '[]', '$2y$13$Fuy6IwB8X.NbMGR7JuV5OeASH4RdFPzPTLFJDDl9zzJwNbUxlu19a', 0, 'gady', 'bénédicte', 'Mme', '14210', 'France', '33 rue des ormes', 'Cheux'),
(2, 'anaelle.bargas@sts-sio-caen.info', '[]', '$2y$13$hLD7jWebiwZGmDWbPoJqjuYJSKAU7BbdQjmBEguOz6odtGZp926ma', 0, 'Bargas', 'Anaëlle', 'Mme', '14000', 'France', '12 rue de Caen', 'Caen');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_351268BB813AF326` (`type_abonnement_id`),
  ADD KEY `IDX_351268BB2928752A` (`periodicite_id`),
  ADD KEY `IDX_351268BB5DDD38F5` (`organisme_id`);

--
-- Index pour la table `bank_api`
--
ALTER TABLE `bank_api`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B1F6CB3C74F31645` (`bank_api_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compagnie`
--
ALTER TABLE `compagnie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compagnie_assurance`
--
ALTER TABLE `compagnie_assurance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFF6526037E080D9` (`banque_id`),
  ADD KEY `IDX_CFF6526046032730` (`type_compte_id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_603499932928752A` (`periodicite_id`),
  ADD KEY `IDX_6034999352FBE437` (`compagnie_id`),
  ADD KEY `IDX_60349993520D03A` (`type_contrat_id`);

--
-- Index pour la table `contrat_assurance_vie`
--
ALTER TABLE `contrat_assurance_vie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_964C7F46849F67FD` (`compagnie_assurance_id`),
  ADD KEY `IDX_964C7F464F001650` (`mode_gestion_id`),
  ADD KEY `IDX_964C7F462928752A` (`periodicite_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_364071D72928752A` (`periodicite_id`),
  ADD KEY `IDX_364071D7B37C39B1` (`type_emprunt_id`),
  ADD KEY `IDX_364071D737E080D9` (`banque_id`);

--
-- Index pour la table `import_error`
--
ALTER TABLE `import_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B08813BFF2C56620` (`compte_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `mode_gestion`
--
ALTER TABLE `mode_gestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1981A66DF2C56620` (`compte_id`);

--
-- Index pour la table `organisme`
--
ALTER TABLE `organisme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `periodicite`
--
ALTER TABLE `periodicite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52743D7BBCF5E72D` (`categorie_id`);

--
-- Index pour la table `type_abonnement`
--
ALTER TABLE `type_abonnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_compte`
--
ALTER TABLE `type_compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_emprunt`
--
ALTER TABLE `type_emprunt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `bank_api`
--
ALTER TABLE `bank_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `banque`
--
ALTER TABLE `banque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `compagnie`
--
ALTER TABLE `compagnie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `compagnie_assurance`
--
ALTER TABLE `compagnie_assurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contrat_assurance_vie`
--
ALTER TABLE `contrat_assurance_vie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `import_error`
--
ALTER TABLE `import_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `mode_gestion`
--
ALTER TABLE `mode_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `organisme`
--
ALTER TABLE `organisme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `periodicite`
--
ALTER TABLE `periodicite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_abonnement`
--
ALTER TABLE `type_abonnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type_compte`
--
ALTER TABLE `type_compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_emprunt`
--
ALTER TABLE `type_emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `FK_351268BB2928752A` FOREIGN KEY (`periodicite_id`) REFERENCES `periodicite` (`id`),
  ADD CONSTRAINT `FK_351268BB5DDD38F5` FOREIGN KEY (`organisme_id`) REFERENCES `organisme` (`id`),
  ADD CONSTRAINT `FK_351268BB813AF326` FOREIGN KEY (`type_abonnement_id`) REFERENCES `type_abonnement` (`id`);

--
-- Contraintes pour la table `banque`
--
ALTER TABLE `banque`
  ADD CONSTRAINT `FK_B1F6CB3C74F31645` FOREIGN KEY (`bank_api_id`) REFERENCES `bank_api` (`id`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `FK_CFF6526037E080D9` FOREIGN KEY (`banque_id`) REFERENCES `banque` (`id`),
  ADD CONSTRAINT `FK_CFF6526046032730` FOREIGN KEY (`type_compte_id`) REFERENCES `type_compte` (`id`);

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `FK_603499932928752A` FOREIGN KEY (`periodicite_id`) REFERENCES `periodicite` (`id`),
  ADD CONSTRAINT `FK_60349993520D03A` FOREIGN KEY (`type_contrat_id`) REFERENCES `type_contrat` (`id`),
  ADD CONSTRAINT `FK_6034999352FBE437` FOREIGN KEY (`compagnie_id`) REFERENCES `compagnie` (`id`);

--
-- Contraintes pour la table `contrat_assurance_vie`
--
ALTER TABLE `contrat_assurance_vie`
  ADD CONSTRAINT `FK_964C7F462928752A` FOREIGN KEY (`periodicite_id`) REFERENCES `periodicite` (`id`),
  ADD CONSTRAINT `FK_964C7F464F001650` FOREIGN KEY (`mode_gestion_id`) REFERENCES `mode_gestion` (`id`),
  ADD CONSTRAINT `FK_964C7F46849F67FD` FOREIGN KEY (`compagnie_assurance_id`) REFERENCES `compagnie_assurance` (`id`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_364071D72928752A` FOREIGN KEY (`periodicite_id`) REFERENCES `periodicite` (`id`),
  ADD CONSTRAINT `FK_364071D737E080D9` FOREIGN KEY (`banque_id`) REFERENCES `banque` (`id`),
  ADD CONSTRAINT `FK_364071D7B37C39B1` FOREIGN KEY (`type_emprunt_id`) REFERENCES `type_emprunt` (`id`);

--
-- Contraintes pour la table `import_error`
--
ALTER TABLE `import_error`
  ADD CONSTRAINT `FK_B08813BFF2C56620` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `FK_1981A66DF2C56620` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `FK_52743D7BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
