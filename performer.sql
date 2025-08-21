-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 août 2025 à 20:52
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
-- Base de données : `performer`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url_endpoints` varchar(255) NOT NULL,
  `method` varchar(255) DEFAULT NULL COMMENT 'HTTP method (GET, POST, etc.)',
  `description` varchar(255) NOT NULL,
  `nom_module` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `url_endpoints`, `method`, `description`, `nom_module`, `created_at`, `updated_at`) VALUES
(16, 'api/cycles', 'GET', 'Lister tous les cycles', 'Cycles', '2025-08-18 09:15:29', '2025-08-18 09:15:29'),
(17, 'api/objectifs', 'POST', 'Créer les objectifs', 'Objectifs', '2025-08-18 09:17:38', '2025-08-18 09:17:38'),
(18, 'api/objectifs/{id}', 'PUT', 'Mettre à jour objectifs', 'Objectifs', '2025-08-18 11:54:40', '2025-08-18 11:54:40'),
(19, 'api/objectifs', 'GET', 'Lister les objectifs', 'Objectifs', '2025-08-18 16:53:56', '2025-08-18 16:53:56'),
(20, 'api/objectifs/users/{userId}/objectifs', 'GET', 'récupérer les objectifs d\'un employé', 'Objectifs', '2025-08-21 06:45:25', '2025-08-21 06:45:25');

-- --------------------------------------------------------

--
-- Structure de la table `appreciations`
--

CREATE TABLE `appreciations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cycle` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `valeur_min` decimal(8,2) DEFAULT NULL,
  `valeur_max` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appreciations`
--

INSERT INTO `appreciations` (`id`, `id_cycle`, `code`, `description`, `valeur_min`, `valeur_max`, `created_at`, `updated_at`) VALUES
(12, 1, 'SG', 'Significant Gap', 0.00, 3.99, '2025-07-31 11:43:11', '2025-07-31 11:43:11'),
(13, 1, 'NI', 'Need Improvement', 4.00, 7.99, '2025-07-31 11:44:17', '2025-07-31 11:44:17'),
(14, 1, 'ME', 'Meet Expectations', 8.00, 11.99, '2025-07-31 11:44:42', '2025-07-31 11:44:42'),
(15, 1, 'EE', 'Exceed Expectations', 12.00, 15.99, '2025-07-31 11:49:53', '2025-07-31 11:49:53'),
(16, 1, 'O', 'Outstanding', 16.00, 20.00, '2025-07-31 11:50:55', '2025-07-31 11:50:55');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('2OaNdQlBbcIJ65QM', 'a:1:{s:11:\"valid_until\";i:1754056940;}', 1755266540),
('m6vxr3gKe2bL9q4y', 's:7:\"forever\";', 2069416508),
('pFsfzwvNSVpkesth', 'a:1:{s:11:\"valid_until\";i:1755097928;}', 1756304408),
('tkZzr8lVWGEK3CD6', 's:7:\"forever\";', 2069416820);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comites`
--

CREATE TABLE `comites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_comite` varchar(255) NOT NULL,
  `cycle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comites`
--

INSERT INTO `comites` (`id`, `nom_comite`, `cycle_id`, `created_at`, `updated_at`) VALUES
(6, 'Comité DISI', 1, '2025-08-10 12:23:45', '2025-08-10 12:41:44'),
(7, 'Comité Finance', 1, '2025-08-10 12:32:42', '2025-08-10 12:32:42'),
(9, 'Comité RH', 1, '2025-08-10 12:42:40', '2025-08-10 12:42:40'),
(10, 'Comité Logistique', 1, '2025-08-13 14:48:16', '2025-08-13 14:50:01'),
(12, 'Commité commerciale', 1, '2025-08-21 17:42:57', '2025-08-21 17:42:57');

-- --------------------------------------------------------

--
-- Structure de la table `comites_agents`
--

CREATE TABLE `comites_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comite_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comites_agents`
--

INSERT INTO `comites_agents` (`id`, `comite_id`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 9, 8, NULL, NULL),
(16, 9, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comites_responsables`
--

CREATE TABLE `comites_responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comite_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comites_responsables`
--

INSERT INTO `comites_responsables` (`id`, `user_id`, `comite_id`, `created_at`, `updated_at`) VALUES
(12, 10, 9, NULL, NULL),
(14, 12, 9, NULL, NULL),
(15, 12, 10, NULL, NULL),
(16, 13, 10, NULL, NULL),
(17, 11, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `destinataire_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auteur_id` bigint(20) UNSIGNED NOT NULL,
  `role_auteur` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cycles_evaluation`
--

CREATE TABLE `cycles_evaluation` (
  `id_cycle` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `notation_max` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cycles_evaluation`
--

INSERT INTO `cycles_evaluation` (`id_cycle`, `titre`, `description`, `date_debut`, `date_fin`, `notation_max`, `created_at`, `updated_at`) VALUES
(1, 'Cycle test', 'Un cyle normal avec quatres phases', '2025-01-01', '2025-12-31', 20, '2025-07-30 10:44:00', '2025-07-30 10:45:49');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

CREATE TABLE `directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `chef` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id`, `name`, `chef`, `employee_count`, `created_at`, `updated_at`) VALUES
(1, 'DISI', 1, 13, '2025-06-03 08:51:52', '2025-06-04 09:58:55'),
(4, 'Direction commerciale', 5, 1, '2025-06-03 09:37:03', '2025-07-15 01:52:59');

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objectif_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comite_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Cycle_id` bigint(20) UNSIGNED NOT NULL,
  `note_auto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note_comite_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gauss`
--

CREATE TABLE `gauss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comite_id` bigint(20) UNSIGNED NOT NULL,
  `appreciation_id` bigint(20) UNSIGNED NOT NULL,
  `quota_max` float NOT NULL COMMENT 'Quota max en pourcentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `metrics`
--

CREATE TABLE `metrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_statut` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `metrics`
--

INSERT INTO `metrics` (`id`, `nom_statut`, `created_at`, `updated_at`) VALUES
(1, 'temps', '2025-08-05 15:19:37', '2025-08-05 15:19:37'),
(2, 'pourcentage', '2025-08-05 15:19:55', '2025-08-05 15:19:55');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_28_143911_create_personal_access_tokens_table', 1),
(5, '2025_06_03_003503_create_directions_table', 2),
(6, '2025_06_03_103705_create_users_table', 3),
(7, '2025_06_03_135635_create_triggers_after_insert_users', 4),
(8, '2025_06_04_075509_create_colonnes_manager_id_et_role_users', 5),
(9, '2025_06_04_082616_modify_chef_in_directions_table', 6),
(10, '2025_06_04_113558_create_objectifs_users', 7),
(11, '2025_06_05_140207_create_personal_access_tokens_table', 8),
(12, '2025_06_08_232155_create_cycle_evaluation_table', 9),
(13, '2025_06_08_235806_create_criteres_notation_table', 10),
(14, '2025_06_09_132912_create_commentaires_table', 11),
(15, '2025_06_09_153646_create__evaluation_objectif_table', 12),
(16, '2025_06_12_093712_create_fichier_table', 13),
(17, '2025_06_12_095114_edit_commentaire_table', 14),
(18, '2025_06_12_113308_create_evaluation_objectifs_table', 15),
(19, '2025_06_12_113503_create_fichiers_table', 16),
(20, '2025_06_12_113624_create_commentaires_table', 17),
(21, '2025_06_12_201649_create__cycles_table', 18),
(22, '2025_06_12_203524_edit_objectifs_user', 19),
(23, '2025_06_12_204246_edit_evaluation_table', 19),
(24, '2025_06_13_103238_edit_evaluation_table', 20),
(25, '2025_06_13_134851_modifier_table_evaluationv2', 21),
(26, '2025_06_16_090414_create_roles_table', 22),
(27, '2025_06_16_093917_modifier_user_table', 23),
(28, '2025_06_16_095147_create_role_users_table', 24),
(29, '2025_06_16_135200_create__role_users_table', 25),
(30, '2025_06_16_183941_delete_role_users_table', 26),
(31, '2025_06_16_184524_delete_roles_table', 27),
(33, '2025_06_17_104248_create_roles_table', 28),
(34, '2025_06_17_104458_create_roles_users_table', 28),
(35, '2025_06_17_122150_ajouter_contrainte_direction', 29),
(36, '2025_06_24_090805_update_objectif_id_to_destinataire_id_in_votre_table', 30),
(37, '2025_06_25_155304_create_criteres_table', 31),
(38, '2025_06_25_162704_create_appreciations_table', 32),
(39, '2025_06_25_163313_alter_evaluations_add_appreciation_fk', 33),
(40, '2025_07_24_105011_update_appreciation', 34),
(41, '2025_07_24_112544_updatecommentairedate', 35),
(42, '2025_07_24_115231_updatecycleperiode', 36),
(43, '2025_07_24_123107_create_sous_directions_table', 37),
(44, '2025_07_24_140826_create_comites_table', 38),
(45, '2025_07_24_141857_create_comites_responsables_table', 39),
(46, '2025_07_24_142628_create_comites_agents_table', 40),
(47, '2025_07_24_143338_modifierevaluation', 41),
(48, '2025_07_25_045253_remove_direction_columns_from_comite', 42),
(49, '2025_07_30_074118_create_cycles_evaluation_table', 43),
(50, '2025_07_30_090604_update_appreciations_table', 44),
(54, '2025_07_30_101338_create_periodes_evaluations_table', 45),
(55, '2025_07_30_135253_create_gauss_table', 45),
(56, '2025_08_01_142236_create_actions_table', 45),
(57, '2025_08_04_111346_rename_periodes_evaluations_to_periodes_actions', 45),
(58, '2025_08_05_104649_updateobjectiftables', 46),
(59, '2025_08_05_112230_add_id_cycle_to_objectifs_users_table', 47),
(60, '2025_08_05_140636_update_comite_table', 48),
(61, '2025_08_05_144345_delete_cycles_table', 49),
(62, '2025_08_05_145942_drop_cycles_tables', 50),
(63, '2025_08_05_152518_create_metrics_tables', 51),
(64, '2025_08_05_163449_create_statuts_table', 52),
(65, '2025_08_06_094049_update_objectifs_metrics_statuts', 53),
(66, '2025_08_08_104016_add_url_photo_to_users_table', 54),
(67, '2025_08_15_150715_update_actions_tables', 55);

-- --------------------------------------------------------

--
-- Structure de la table `objectifs_users`
--

CREATE TABLE `objectifs_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_cycle` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `metric` bigint(20) UNSIGNED DEFAULT NULL,
  `statut_objectif` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objectifs_users`
--

INSERT INTO `objectifs_users` (`id`, `titre`, `description`, `valeur`, `poids`, `date_debut`, `date_fin`, `id_cycle`, `manager_id`, `agent_id`, `created_at`, `updated_at`, `metric`, `statut_objectif`) VALUES
(273, 'Améliorer la satisfaction client', 'Mener une enquête de satisfaction auprès des clients et obtenir un score supérieur à 80%', 50, 25, '2025-09-01', '2025-12-31', 1, 1, 8, '2025-08-08 15:22:44', '2025-08-08 15:22:44', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `periodes_actions`
--

CREATE TABLE `periodes_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_action` bigint(20) UNSIGNED NOT NULL,
  `cycle_id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `periodes_actions`
--

INSERT INTO `periodes_actions` (`id`, `id_action`, `cycle_id`, `date_debut`, `date_fin`, `created_at`, `updated_at`) VALUES
(3, 17, 1, '2025-08-18', '2025-10-18', '2025-08-18 14:00:55', '2025-08-18 14:00:55'),
(4, 16, 1, '2025-08-18', '2025-10-18', '2025-08-18 16:48:40', '2025-08-18 16:48:40'),
(5, 19, 1, '2025-08-18', '2025-11-18', '2025-08-18 16:55:14', '2025-08-18 16:55:14'),
(6, 20, 1, '2025-08-17', '2025-12-30', '2025-08-21 06:49:44', '2025-08-21 06:49:44');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_role` varchar(255) NOT NULL,
  `role_description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom_role`, `role_description`, `created_at`, `updated_at`) VALUES
(1, 'Agent', 'un agent peut créer un objectif et s\'auto-évaluer', '2025-06-17 11:00:39', '2025-06-17 11:00:39'),
(2, 'Manager', 'un manager peut évaluer un agent valider ou rejeter des obejctifs', '2025-06-17 11:07:47', '2025-06-17 11:07:47'),
(3, 'Admin', 'un admin doit etre capable de configurer le système et les période d\'évaluation', '2025-06-17 11:10:13', '2025-06-17 11:10:13'),
(4, 'comite', 'personne qui ont accès au évaluation de plusieurs employé et manager', '2025-07-25 10:56:38', '2025-07-25 10:56:38'),
(5, 'RH', 'personne qui gère les config de cycle d\'appréciation et autre', '2025-07-25 10:58:03', '2025-07-25 10:58:03');

-- --------------------------------------------------------

--
-- Structure de la table `roles_users`
--

CREATE TABLE `roles_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(7, 1),
(8, 3),
(10, 1),
(10, 2),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3Q8JxgFuWmE5uFE0huhJM8tL6TaWJ9BKaDemo6Z3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWFUWXJzeDhuOW9VMHdGZXp4WXlxUkFvRmQ2NkFrbU9mdWtKYW03byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLW1hbmFnZS1hY3Rpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755793339),
('ngQbwzU2eKH4hnRemsmv1kJDQaIQvRabu75BkJtN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU5MNzlCOTlTN0tUWVU3eVNCSk4yN1oyMjN1dlVsN1NWSnpNM05wdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1755801513),
('xNnnSy0Xkf8LRuaDTOlUZJeHUtnLY54lwWTpljLQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmN1WWFCU0sxTUw4QWhwOWZhQzdlVFRkbjE3S0p1NFZNSkdjYzB5RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jcmVhdGUtY29taXRlLXJlc3BvbnNhYmxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755801799);

-- --------------------------------------------------------

--
-- Structure de la table `sous_directions`
--

CREATE TABLE `sous_directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `chef_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_employes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE `statuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statuts`
--

INSERT INTO `statuts` (`id`, `libelle`, `module`, `created_at`, `updated_at`) VALUES
(1, 'Valider', 'objectifs', '2025-08-05 15:50:56', '2025-08-05 15:50:56'),
(2, 'Rejeter', 'objectifs', '2025-08-05 15:51:16', '2025-08-05 15:51:16'),
(3, 'En attente', 'objectifs', '2025-08-05 15:51:35', '2025-08-05 15:51:35'),
(4, 'auto-evaluation', 'evaluations', '2025-08-05 15:51:56', '2025-08-05 15:51:56'),
(5, 'evaluation-manager', 'evaluations', '2025-08-05 15:52:13', '2025-08-05 15:52:13'),
(6, 'evaluation-comite', 'evaluations', '2025-08-05 15:52:34', '2025-08-05 15:52:34');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url_photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `secondname` varchar(255) NOT NULL,
  `user_job_name` varchar(255) NOT NULL,
  `direction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `statut_user` varchar(255) NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `url_photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `secondname`, `user_job_name`, `direction_id`, `statut_user`, `manager_id`) VALUES
(1, 'Jean', 'jean.dupont@example.com', NULL, NULL, '$2y$12$tfcvY4Q/0yxzddVJIRwMr.Sa2kY0R/pm6BA8VZA1kh6Foia3ukl.2', NULL, '2025-06-03 14:23:51', '2025-06-21 19:00:55', 'Dupont', 'IT Support', 1, 'Actif', NULL),
(2, 'Yoan', 'yoantioma4@gmail.com', NULL, NULL, '$2y$12$6NRNsXe17kkSQPKSnLs9YO1Fx6RsoA/NrfUBYLsHtd2H2dYCDfR3q', NULL, '2025-06-04 03:04:57', '2025-06-04 09:58:55', 'Tioma', 'Analyste Développeur', 1, 'Actif', 1),
(5, 'Jonathan', 'jonathan@example.com', NULL, NULL, '$2y$12$43JSgZ0/.IDUnL/hN6S6QOOsW1U2.00snOCgKA.UCYWdDovYjDAfC', NULL, '2025-06-16 14:03:33', '2025-06-16 14:03:33', 'Aspirine', 'Développeur', 1, 'Actif', NULL),
(7, 'Aspirine', 'jesuisfort@gmail.com', NULL, NULL, '$2y$12$GfAHpGB0.17XmZNSUmiP4ejKl9LVhGgYOQD0smd4z0GvBu.19VqJ6', NULL, '2025-06-17 12:27:38', '2025-06-23 07:35:54', 'Jonathan', 'Développeur Frontend', 1, 'Actif', 1),
(8, 'Yoan', 'azebaze@gmail.com', NULL, NULL, '$2y$12$WuNOGIZm3XXrDzjW79Onpehjyk/sO3XxaXCkyDd2vJsfHtPMJAcQe', NULL, '2025-06-27 18:00:49', '2025-07-10 08:34:13', 'AZEBAZE', 'Data Base Administrator', 1, 'Actif', NULL),
(10, 'comite1', 'comite1@gmail.com', NULL, NULL, '$2y$12$W9kI9c.SDpXTj.4c4knmhOP/PMR8T9HJJQhx0lXWZM1mfJx2XCkby', NULL, '2025-07-25 11:03:45', '2025-07-25 11:03:45', 'comite1', 'comite1', NULL, 'Actif', NULL),
(11, 'Alice', 'alice.ngono@example.com', NULL, NULL, '$2y$12$dgRtGZ4xp76Nxkv6BK5Kcu66QftvLPJCnOA6i5QogTC9E.qhHOUkW', NULL, '2025-07-27 01:18:39', '2025-07-27 01:18:39', 'Ngono', 'Secrétaire Comité', 1, 'actif', 1),
(12, 'Brice', 'brice.mbarga@example.com', NULL, NULL, '$2y$12$HwkAYfavbKjwgD23gZVEo.E1YASSh3y6HWS9FERj1sDmqCRY1Jy4q', NULL, '2025-07-27 01:19:09', '2025-07-27 01:19:09', 'Mbarga', 'Coordonnateur Comité', 1, 'actif', 1),
(13, 'Cynthia', 'cynthia.ewodo@example.com', NULL, NULL, '$2y$12$QMSCY5mTxqNzvJl/5RAof.YWITFbsUx610IRBiGDa6s/cBUuUWaYG', NULL, '2025-07-27 01:19:26', '2025-07-27 01:19:26', 'Ewodo', 'Assistante Comité', 1, 'actif', 1),
(14, 'Dieudonné', 'dieudonne.essomba@example.com', NULL, NULL, '$2y$12$4FcSSmMH3bYY1IdByO.aeOXDcoTBghajXt/7Bs2YBvmrwRL6Immse', NULL, '2025-07-27 01:19:42', '2025-07-27 01:19:42', 'Essomba', 'Membre Comité', 1, 'actif', 1),
(15, 'Estelle', 'estelle.tchana@example.com', NULL, NULL, '$2y$12$F4TUPfm4TW0aqil8BAJunuKN3wQigrPdlu3BuFZi.lDXnO4rz50..', NULL, '2025-07-27 01:20:03', '2025-07-27 01:20:03', 'Tchana', 'Responsable Comité', 1, 'actif', 1);

--
-- Déclencheurs `users`
--
DELIMITER $$
CREATE TRIGGER `after_insert_user` AFTER INSERT ON `users` FOR EACH ROW BEGIN
                IF NEW.direction_id IS NOT NULL THEN
                    UPDATE directions
                    SET employee_count = employee_count + 1
                    WHERE id = NEW.direction_id;
                END IF;
            END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `appreciations`
--
ALTER TABLE `appreciations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appreciations_code_unique` (`code`),
  ADD KEY `appreciations_id_cycle_foreign` (`id_cycle`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `comites`
--
ALTER TABLE `comites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comites_cycle_id_foreign` (`cycle_id`);

--
-- Index pour la table `comites_agents`
--
ALTER TABLE `comites_agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comites_agents_comite_id_user_id_unique` (`comite_id`,`user_id`),
  ADD KEY `comites_agents_user_id_foreign` (`user_id`);

--
-- Index pour la table `comites_responsables`
--
ALTER TABLE `comites_responsables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comites_responsables_user_id_comite_id_unique` (`user_id`,`comite_id`),
  ADD KEY `comites_responsables_comite_id_foreign` (`comite_id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_evaluation_id_foreign` (`evaluation_id`),
  ADD KEY `commentaires_auteur_id_foreign` (`auteur_id`),
  ADD KEY `commentaires_destinataire_id_foreign` (`destinataire_id`);

--
-- Index pour la table `cycles_evaluation`
--
ALTER TABLE `cycles_evaluation`
  ADD PRIMARY KEY (`id_cycle`);

--
-- Index pour la table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directions_chef_foreign` (`chef`);

--
-- Index pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluations_objectif_id_foreign` (`objectif_id`),
  ADD KEY `evaluations_agent_id_foreign` (`agent_id`),
  ADD KEY `evaluations_manager_id_foreign` (`manager_id`),
  ADD KEY `evaluations_cycle_id_foreign` (`Cycle_id`),
  ADD KEY `evaluations_note_auto_id_foreign` (`note_auto_id`),
  ADD KEY `evaluations_note_manager_id_foreign` (`note_manager_id`),
  ADD KEY `evaluations_note_comite_id_foreign` (`note_comite_id`),
  ADD KEY `evaluations_comite_id_foreign` (`comite_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `gauss`
--
ALTER TABLE `gauss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gauss_comite_id_appreciation_id_unique` (`comite_id`,`appreciation_id`),
  ADD KEY `gauss_appreciation_id_foreign` (`appreciation_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `metrics`
--
ALTER TABLE `metrics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `objectifs_users`
--
ALTER TABLE `objectifs_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `objectifs_users_manager_id_foreign` (`manager_id`),
  ADD KEY `objectifs_users_agent_id_foreign` (`agent_id`),
  ADD KEY `objectifs_users_id_cycle_foreign` (`id_cycle`),
  ADD KEY `objectifs_users_metric_foreign` (`metric`),
  ADD KEY `objectifs_users_statut_objectif_foreign` (`statut_objectif`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `periodes_actions`
--
ALTER TABLE `periodes_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodes_actions_id_action_foreign` (`id_action`),
  ADD KEY `periodes_actions_cycle_id_foreign` (`cycle_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles_users`
--
ALTER TABLE `roles_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `roles_users_role_id_foreign` (`role_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `sous_directions`
--
ALTER TABLE `sous_directions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sous_directions_chef_id_foreign` (`chef_id`),
  ADD KEY `sous_directions_direction_id_foreign` (`direction_id`);

--
-- Index pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_manager_id_foreign` (`manager_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `appreciations`
--
ALTER TABLE `appreciations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `comites`
--
ALTER TABLE `comites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `comites_agents`
--
ALTER TABLE `comites_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `comites_responsables`
--
ALTER TABLE `comites_responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `cycles_evaluation`
--
ALTER TABLE `cycles_evaluation`
  MODIFY `id_cycle` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `directions`
--
ALTER TABLE `directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gauss`
--
ALTER TABLE `gauss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `objectifs_users`
--
ALTER TABLE `objectifs_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT pour la table `periodes_actions`
--
ALTER TABLE `periodes_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `sous_directions`
--
ALTER TABLE `sous_directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statuts`
--
ALTER TABLE `statuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appreciations`
--
ALTER TABLE `appreciations`
  ADD CONSTRAINT `appreciations_id_cycle_foreign` FOREIGN KEY (`id_cycle`) REFERENCES `cycles_evaluation` (`id_cycle`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comites`
--
ALTER TABLE `comites`
  ADD CONSTRAINT `comites_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `cycles_evaluation` (`id_cycle`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comites_agents`
--
ALTER TABLE `comites_agents`
  ADD CONSTRAINT `comites_agents_comite_id_foreign` FOREIGN KEY (`comite_id`) REFERENCES `comites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comites_agents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comites_responsables`
--
ALTER TABLE `comites_responsables`
  ADD CONSTRAINT `comites_responsables_comite_id_foreign` FOREIGN KEY (`comite_id`) REFERENCES `comites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comites_responsables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_auteur_id_foreign` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_destinataire_id_foreign` FOREIGN KEY (`destinataire_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `directions`
--
ALTER TABLE `directions`
  ADD CONSTRAINT `directions_chef_foreign` FOREIGN KEY (`chef`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_comite_id_foreign` FOREIGN KEY (`comite_id`) REFERENCES `comites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_cycle_id_foreign` FOREIGN KEY (`Cycle_id`) REFERENCES `cycles_evaluation` (`id_cycle`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `evaluations_note_auto_id_foreign` FOREIGN KEY (`note_auto_id`) REFERENCES `appreciations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_note_comite_id_foreign` FOREIGN KEY (`note_comite_id`) REFERENCES `appreciations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_note_manager_id_foreign` FOREIGN KEY (`note_manager_id`) REFERENCES `appreciations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_objectif_id_foreign` FOREIGN KEY (`objectif_id`) REFERENCES `objectifs_users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gauss`
--
ALTER TABLE `gauss`
  ADD CONSTRAINT `gauss_appreciation_id_foreign` FOREIGN KEY (`appreciation_id`) REFERENCES `appreciations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gauss_comite_id_foreign` FOREIGN KEY (`comite_id`) REFERENCES `comites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objectifs_users`
--
ALTER TABLE `objectifs_users`
  ADD CONSTRAINT `objectifs_users_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `objectifs_users_id_cycle_foreign` FOREIGN KEY (`id_cycle`) REFERENCES `cycles_evaluation` (`id_cycle`) ON DELETE CASCADE,
  ADD CONSTRAINT `objectifs_users_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `objectifs_users_metric_foreign` FOREIGN KEY (`metric`) REFERENCES `metrics` (`id`),
  ADD CONSTRAINT `objectifs_users_statut_objectif_foreign` FOREIGN KEY (`statut_objectif`) REFERENCES `statuts` (`id`);

--
-- Contraintes pour la table `periodes_actions`
--
ALTER TABLE `periodes_actions`
  ADD CONSTRAINT `periodes_actions_cycle_id_foreign` FOREIGN KEY (`cycle_id`) REFERENCES `cycles_evaluation` (`id_cycle`) ON DELETE CASCADE,
  ADD CONSTRAINT `periodes_actions_id_action_foreign` FOREIGN KEY (`id_action`) REFERENCES `actions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sous_directions`
--
ALTER TABLE `sous_directions`
  ADD CONSTRAINT `sous_directions_chef_id_foreign` FOREIGN KEY (`chef_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sous_directions_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
