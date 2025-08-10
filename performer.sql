-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 10 août 2025 à 22:40
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
  `description` varchar(255) NOT NULL,
  `nom_module` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `url_endpoints`, `description`, `nom_module`, `created_at`, `updated_at`) VALUES
(11, 'api/objectifs', 'lister tous les objectifs version trois', 'objectifs', '2025-08-04 13:53:04', '2025-08-04 13:53:04'),
(12, 'api/objectifs/{agentId}/objectifs/valider-tous', 'Valider tous les objectifs d’un agent', 'objectifs', '2025-08-04 19:18:06', '2025-08-04 19:18:06'),
(13, 'api/objectifs/{agentId}/rejeter/{userId}', 'Rejeter un objectif d’un agent', 'objectifs', '2025-08-04 19:18:47', '2025-08-04 19:18:47'),
(14, 'api/objectifs/statistique/{id}', 'Afficher les statistiques des objectifs d’un utilisateur', 'objectifs', '2025-08-04 19:19:14', '2025-08-04 19:19:14'),
(15, 'api/objectifs/{id}', 'Supprimer un objectif', 'objectifs', '2025-08-04 19:19:35', '2025-08-04 19:19:35');

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
(9, 'Comité RH', 1, '2025-08-10 12:42:40', '2025-08-10 12:42:40');

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
(14, 12, 9, NULL, NULL);

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
(66, '2025_08_08_104016_add_url_photo_to_users_table', 54);

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
(1, 11, 1, '2025-08-01', '2025-08-20', '2025-08-04 14:01:39', '2025-08-04 14:01:39'),
(2, 15, 1, '2025-08-07', '2025-08-20', '2025-08-08 14:17:48', '2025-08-08 14:17:48');

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
('0AcGRjQL1RC6ZxUvNiPwfWodqID6EeTyZBPXO85H', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMERhaG9PdXVaYTUxNWdRaTFBMkJRN3VLWmJHRDF6bmNzb01KcDRnMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('0APhsjyUTWXDWKUSmSqOMFNM2KzTzyQxFsIueIUf', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3Mybk9nOW1ZYlRZMzJ5TFBTdG1XQmRCUVZlajNwY1d2Vm55dldDbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('0xd8sPAX9H2RRxOrzhgxopd8qAe3F5y80Th2QMl8', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVW1DYTJ4WUNETzZKbkNQV1hIU2Z1cE9wTjJFa2lmR3l4aFREYnFVTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('1MY59YvV8U0ZMLE4ERB9KZ7QCv8K1aKQtlhDFbNl', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWtwQVFNczlWSFRxUFRUVHpBTzVHeW1kbUtZSDN1UjVWUnlGQ29HdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('2J2A3A7vvh6XZFVJW6CtOCKkyb99mlJYw2dGPv6G', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUNqSElSZFEzcTZ3ZkFyRGwyNnlDQlFQZlNsVGNIa2I2M2l1dUZXMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('31qn3jq1giEPXeMkeBkzBewBbQOCpl9Euuf3q6Lj', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1Y5UXptYUluVEhtUXhSNnRaVlpmR2ptNHJ6Nzd2blk4M0ZMZVBkMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('3BYFEsTeDCJMqg89NbyDzzqVCpkI6tLMM4WN41Bq', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHNZZlVka3NYcVNtNnRxT0VYeWtTRGxpVVU3bnB6ZWJPRElUVzR4NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('3cLMhBUo5He3m4G1TfyLKH9ZuAKl5EIrhN1n5IgQ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVFCVUFFNkR3bDNVaThmTlMxWFFhZHZ5N1lRZlhKeUludzNQWEFReCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944621),
('3JuIEaEyUkBIC4X4TPDaXgedwsbGOh0vcpAVqWoX', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDg0b0JmaXYzbnRvaDN2SURXSjFqV2FuVVlBdEw0RlFXdURDSVhZOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944628),
('3m9XSPHeYOnlHTNK7ptV4zkSIrqfQfKGnUIC1N3A', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamE1MkdXYTFIZ3NlUkxGemZnUVhIYWZDRXF1YTlZdWdUZGxwTXJVVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('7bYVL0amhHolvaiSmlPTzEY7oY9WWZvAUAzxqkik', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak9GbE82b0NFYWhvZXZETzJiemdlVWNqa29yc1dwSkljVnZsUGRhZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('7ojSkO3x5JCcoEgHb3rnneh3IXJyNppy0ZBOGSBZ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFBBQWloZk5YMFlBVzBQQXduNmVGTkpWRXVTaG9mRzBJUm5rTEJDayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('89KxVwWDuMqBKfVgC0qFQcE8DhGZIlKXbUk4WSvG', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicU9PZmlBU285UXdxcENxNVNNcUczbE1PRjJTTWQwMWdNUkxzSTRoTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('8bpiiDsDETxrXTuPaFTIGTVnDnT4Md3MRas0xwaJ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkVzbTl2ajJpTXNPWXVRQzVlZ1F2UmFER0Eyak1KZlNmMzRSbk02MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('8Rhc54v5DeFNh0gzqovZQapYZwgaB1las25NFj0e', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjVCSW1ObW5ncTVCbURrSkk5MGE0WUlqTktXcjBhZXdETm01SThLNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('98vzI8koTl8BCLFYAPnuM294RGOlxg5D2PCuQilY', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXdubXFzSGhFRm45NWtDTUhmcnRvdzdxRzVsbGxRa1ZOVzRaNEFWSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('9jhrk1RBD94NKpVym871GByymVGAA99Hf1DAjChl', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEdteXpydjhLdUhqMTJMVXp1ZTl1bWNBc0hyWlFiV2RWUDFtVEdFSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('aP2VL2NaR3seMuB36PK7xr3B0qMll0RQT7B4bYuz', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjJTWHhDM3ozWWNiZlhsTndNOHp0M2dPSk15d1VmMmxQYnFnYk5ORSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('aXLZvUDb9VXO5zPFdAzgo4ZLrNE2CTcvg2cALjXL', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjFSRm5HekVYcmdFZVViRW5McW5UZU40MlczS1Y4YlZjMUUzeTEyNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('b8tDifbwn8e4y9k5sZzN5endWgpgRWCottZ97nNm', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUZGcHZaNGNTaDZYTmx5eVpQU0U1eDg0SDh2cnNQMm1Wanc4NVpLdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('B9sqdR0lPDrLNEwVtvtaI31OTgXGUOoJ4wQaIGHD', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialdQV0FVbnJsNzY5UEJxNHpDN3VjQ2ZyRGJUR21EOUtUN1cwSG9wUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('BbIO01I4Jpu5sO1LejH3jORX9GnlTT4ZllUfa5v9', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFM1bnpwRW1EbXhqUzNQOTNBakNZUTRiTElIY2VlTTF4ekRicVpaYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('CuyykEiHvX3TDpYnpnPdHXvBS1JIn2TwVtDqSuGX', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV05vSTFFc2pQUGM0cVByb052NVZlQTJydkZwYmYwVUZJcExEVXdaQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('D8NJB6Ix7n3oS1cwS2slq65MCbioqjWbCKwk8RJT', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmVYNVdzV0YxQXp1TWpnclU1UGV0NGV4ZU1kV0dFMlpTTE52RjVEdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('DB40uBvJi0kmUySTqDdGtdhVH87FSFV9gXdbKTme', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiam9OVG1kNTd0TXc2Ukw5aWlpZERTeUxOODFqVTRZWndISGMyYnY5TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('dhQFuZcBc1O3XIZIhvXdPDKxkAbZWrV8YNlveA2h', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEdXQTR6Z0tQdzhQYXJKRVhvb3dOUFNvNlo1VFNqOHZGeWllRXR2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('dMUv4vKHVU4jko1LeoaoQErNb0xzR3wzvrfZ4Wfb', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnZucmEyM2k0WllNYXlPbXZidVY5MUNXdnZJYUxiSTZBeE9RRTRmeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('dPanjvWLvKNkXWopilIeS4DHkg5KsmcE3uwKx5Ws', NULL, '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IjhNQ3lpRHFZbHpoV1VkZFRWUWhSSzhTRXBNZjRmR3hKbnpHMzh4bjUiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY3JlYXRlLWFwcHJlY2lhdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aTo4O3M6OToidXNlcl9uYW1lIjtzOjQ6IllvYW4iO3M6MTU6InVzZXJfc2Vjb25kbmFtZSI7czo3OiJBWkVCQVpFIjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjE3OiJhemViYXplQGdtYWlsLmNvbSI7czoxMDoidXNlcl9yb2xlcyI7YToxOntpOjA7czo1OiJBZG1pbiI7fXM6MTQ6InVzZXJfZGlyZWN0aW9uIjtzOjQ6IkRJU0kiO3M6MTI6InVzZXJfbWFuYWdlciI7TjtzOjE0OiJ1c2VyX21hbmFnZXJpZCI7Tjt9', 1753951760),
('DqLsgD2pEMJeVhXwdN6LP7WH400g2zLugtWTE78x', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1lzQUU2dFprN1ZTTjAwZmhheGg0SFF6R1MxdnN1MWZUVTJXYTJEZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('DQXIt7OGbzd4nFnnZ7WMdIIna8IF56Y8crXSHo9H', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGNCYVp6d2NQTnhDdm5VSnNOZE9yZW5qd0FVQ2x2TlBVODRNeDRiUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('e4eY1tZ6C1xug6zQYLlSKfhx5LpalB03qDp0PEVa', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0owS0xCc1M5cmowZGxsaUVKNG5KRlhSYmtKZnZSUDdjODByeFpneCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('eREuVx1gnMFzu8zwSXnq4p6N564d1s29g7GUedHX', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHlYQUI0ZXNZRXRjckdYbmRHQVNueFJ1aXE2MXF6cWpMSlZyUXBuMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('FbR0ZKFd6k9l0wtNhIu9ntSMNnpcOyDNlSy6rkEp', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFBQMnFxbGRZbWlkb0xxd2RUQmpBRzR0VUZRRDlzajEzdGl5WnpXRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('fFElLa9BxhP7UdQ3iVdAG75tmtF6NtBEnvOByKYK', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3dCSklwRTcwaXVKb0p5T0hTOVpWM3JCcW03cGFMMjNueGRKSFF5RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('FH05YfLgaeha6q9SDhoOPrJG7F3qf06JSxlzYojQ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXlZYjVTNWFMY1NwdnBjbFdCVE84UkZYandTVXphdmhQbGlLU0dzMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944633),
('g2n9xprIzBMwIKWmRE5LXfgaingZhLTmMBoOhDuR', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTRSV0lzd0hRRGhRSDBDYzZWWTNOUkVRemNUYnhRNUNtTGhFSDBpViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('G380WZtRAT4lyIsyLHTERVGQenvQHNSRrY84aKxA', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGlNSlRaeVNZejI0RnhmbFdTN2p0REFIYWlVdjlNYkQ3NGd1cVFjRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944628),
('gCxUn1YGFi704V3fqKgfe3mBIkMVsWUliUKqfdV9', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGpNUUtJSUdsWkxMd3VKamNHTGd4TWRJVEhLVUpYRVlwNTRjZUhzViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944620),
('hhp7WN7KYkX3Rz4OrDTQ2BMPdScTmTrb6HDZk65s', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTngyVE1wRDhVWWJEc05ER09nb2M5aFUxeWpuSG9tZTFTVVdjZUNqZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('hjyY1TagfwQmcdYb6dUGo2UKgm6JMEjfgbR7EPFE', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTNsNVZiTDdsYkpCcjVVTmxxcE9rUmhqMXVTdlg0NFRJVmdNYmswYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('hkb4vmh9yuhx5ukSEx2Oui3GieDHd6FWellRWATs', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkgzc0VkT3pucGltWW53bUFISlFERnd6SFpiTUxncXJjdE9LYzNNUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('hSvlgcqodCQxPNvMdP9izELzQ4kBJtLjappuryIF', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibk9oN20xZEtVdVNNMUxROFV5QkFkQm40Q2IxempleW1rZzRwQWZxNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('Ii1jBNnRilI0hYcEfAHBnSxSfrxp2FtgnsjFpowe', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXFIY09RUkdYU2xyUk1VMmE0TDRISURoVDN4b055a01JVkRmUGZmNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944628),
('iKRLTifzBEw5EqDroQvnIYn4QHfo9UHFXefLz7Uu', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVdOWWl6dlJjd1ZwS3BSTG5KN09KcXJjb2d2OWw3V2hKM1hzSVNkcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('j5w5oofCdvAyP0c3sfXyH34YQnABne2x7TfKGKlO', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblllNEJCaGI1djRrWmJFZTcxMzQxempVQVBTVnpNYUt4VkxxZWZHOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('jTH2IPpewkQnfqaypfY8QtUe6SBtLOSg4QMqStoU', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWFSZmJZbU9tRDUzd3dJeEt1ZXhoaTZhTjAwTXJNTWZPTnRWa1ZJbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('jYh0ZcC5eml4AGdFGwBTrsMrdWFDlNlB0kUE039C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHJrVzMweVRMTUJycFB2dnE0a05YN2wxZWRneUlJNXZtNnlOeVM3SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1754049011),
('jZdEU2eCl1Yd91RYO5iQrviwKl82IsuqeRXTNia2', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS09saGc2NGRRajRSaG9QVTFGbTNnT3R6dWpBRkpyT2NPSmkwWUtUVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('K3F87gvEGlCWpl9q4zkruxcRov7dRziWZ3RPLvyd', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmF1RlVkY0Q1anBCckJmTGp3OXRqZkVxQjdKWHdCWFdsN2x6akVFTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('KmnKQ6QIPzfiyGLdT1qyFlMMcty2wfT6WzxdUVZK', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWpGMXBOa2lLWXdxSWlwdVVPQ1hEb3RzTEQwdVo0MjZ0MW9OWDFwNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('LbcVZDBFyOdYBX7F20F2uwyf2T2AWckpDHNHwIyd', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEQwdlB3anE5ZDBEblJvVFV3bjNKOVlrekVyclhFekdyRnZFR2QzZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944619),
('LQDPov7utbooVrwMm5h20hUlLgVtn0P580ovEreZ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzFTd0UwWlJtMlVRdGFuV2dZdEJ0elczV1BJU2F6eURKRUtNbXg5OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944620),
('MIwjRCVUMQtNDCzgJ5Wkfoixscld8re8waRPl3Px', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEtHYlNuVjdiRDJNcno2azBWZXNRaGViSGZ6WUZWeEVndzBTdWRmYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('N2xF92NrSail1CdYNtPFkqbBwspyF40Xx9UT10nE', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUJIUlljZlg3a01WbkhjRm51bXYwcFVsVGZiRTQ1ODljeEhYUklFNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('NQjQZq9KllaGvSaDVQRHJoKTIQ3yIX8gPOJQdt7D', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3dySTk0dGVWZ0lHd3lEcFVLWU1XZjE0aWJzY3FkczVHejVQRGYwdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('O5DXQQuea6dJdKlbs5oiA7s9u2Gg7rH4teUVA7OL', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUpTVzF4R1JUUGJYTDJaN3R0dEhmS25sb3lqWFhLT2hEVkc2aFlPbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('ofk9GsINjODXSF6F1aB9TtMexHg1gtHkw6x6ZDqD', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkxYeFI3Qk5JSEJaMUpFaEM3WkxueE5ZOGVwdEVoSUxRa2E4YXQyaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('OlNThn5jum1L9pQJdRnmW5gfBcnSzZeTGey5KQeh', NULL, '127.0.0.1', 'PostmanRuntime/7.44.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWd3N3Z2aEtVMVg2YTY3aGZmcDU3OWJsakd6NUlpRmxRbnozakd5biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1754056485),
('olXXW0LzKKkBMvoJV75Xm7imatl2AR5RPwNzy54D', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZW9WblVRMm1yN0FESzBHRWpTeERlWm9qMUlXbDVSUzV6dWNCQjhqWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('ooUOgVhErzKEcwQfqWCgQNsWwxdIuDjCE2EFNn4D', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmtZWncyVmhwT0I3ZEM1STdRNDNYN25rMUJXNEdDMnltM1o4OGVPaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('p2alnlnc1p2qVvLGckZeHj1FljoZ3VNAYUGdsqP5', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEtmclhIWjJXb3k2dzNEMzVRUGhSNkM0Rll3QlUyMUZiUUlvTkhqMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('pHvrHoSe3HEoohNLjUDyYzxGtdfPRfHm7QVKsXC4', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmFzbWp1M1VMVlc0VEdOVVNJVHJObUs2YnJxazN6RzN4bm81RXBPaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('pjgN8CbpTFbzdBOClhmOypQRxFpjV3bFcEBw352h', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0Uwc0cyblhlOWJ4V3FtRnBuZzFJTVJoNDZ4OHVoT1JHR3hFOTUxNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('pQPd24gynVvIIYfiba1TQHfWIJsSn15cGbEcnsRb', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXhZaGpVYU1WRjNRMnozdzRiQzhNVEZtd0RGSnc2VmFBT01ZbWUwcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('QeGVub04eC43aqo3Pwqxgz0c62iDprBGLraAMZi3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjdlRFFlNWJEZTNxUkhWamJOWU0xQ0d4WlZlR2JHbDllMm9IZW1zRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1754056443),
('QHgtAdwDEli44ZBArhUcA13XvyiUZyEk7DtQKqWa', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFY3Sk9wTnJJS3NyaWRwVEF5SldVcnNabUxBQ1ZYTk1ZWHBBcmFWTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('QOgb37vodJpA4g6u3iL5Fmt0sQvz2h5FIkXQeSS2', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2RTczBSbGJBbXJBWjYyOVo1RmpsQ2pPU1hGaWdvUlVPbDE1M2pybyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('QsO7dduyjMneRdTf2pz6cnbywhIghjcCX9K1R9ne', NULL, '172.19.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6InZrNU14OVVIV3k2eXdrTGx6ejVKVk0xQW84U1pvR0tSMXJ6bGF0blQiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY3JlYXRlLWFwcHJlY2lhdGlvbiI7fXM6NzoidXNlcl9pZCI7aTo4O3M6OToidXNlcl9uYW1lIjtzOjQ6IllvYW4iO3M6MTU6InVzZXJfc2Vjb25kbmFtZSI7czo3OiJBWkVCQVpFIjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjE3OiJhemViYXplQGdtYWlsLmNvbSI7czoxMDoidXNlcl9yb2xlcyI7YToxOntpOjA7czo1OiJBZG1pbiI7fXM6MTQ6InVzZXJfZGlyZWN0aW9uIjtzOjQ6IkRJU0kiO3M6MTI6InVzZXJfbWFuYWdlciI7TjtzOjE0OiJ1c2VyX21hbmFnZXJpZCI7Tjt9', 1753966830),
('RdLdELuzYMeDxGT8TTlw1dvJWN4rBjlI5aynKvXt', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1BJUk9CQmtPNFNaRkkyWGlSVE1UN2F0TUE4bmFIaTdNWEVUdm9pQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('rVEMzOIgczvMmQvChbWuEwzGKxbU0HBGehEXtWZC', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzZzM1lSMnJBZngybTNSdVpyOWhWcnpZVVZoMmtxTkxnQTU0ZVJDdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('RZiuPvFz50sdJxIMIUm1QuhvJXynOGRlmNrEq9s7', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTkzeE85VGROdlV3YXRoc0VCWVBWOG1HTjRJM09xOHRubXNUY1ZOdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('Sru16x8PRyEpgmLi4nlt3a26cJdQ0IvTh5uNoPeU', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY28wUXlLTzBOakd2ZkZEMU9JWkpTeWlNSzRtSTdrUTNBR3d4SWJJWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944619),
('TAdQrHMrMVtvmwzWCXGnToJatU8PSbnvyLwJM8Bh', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjQxYURZNGFtUXh4SDJsbTVMd3NFeHlWaUdMSW8xN2hPbmRQSHVzaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944619),
('tEfX5fzjkwFvUMFq08Fz8xX3uFC5VbSYziC9IVO7', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWFxMk0yQXhvSlVmVThiMUM4ZWFVa3JPTVc3RllWdWp4a0JEbFJRUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('u17GFCjpMABuzoGypaC8mbGC6wo1AxeUiipjgvrf', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2x5c0V5QTlXa3pUbGZpMzFzRE5udmxJcEd6S2w3WU01ZDZQV25vayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('UGhMkspyfz9CWtl7HAnXEQVKOG3uUmnT8kT4hwz9', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVFTdVFxOTFvNlRIQWxITmNpbnoydUNHbEQ2YVdMV1U2bTBiVjlmUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('UpbifyOVheZjjOmqppMdeir8r1XAK7j0gsCLI9ph', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVI1MnFEOUFtekRCamdFUG9yZTJ1OGdpVXJ5ZEsyR0dnNFNEaHNRTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('UPBt3BN1biACCxgzk6IpZpdpyAZ9VrfU2Ex1VfXh', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRkNnaTZiMFN1QTBqUTQ2UzJqM3doMTdiNU5GUloyQTgyQ29jYVlieCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944626),
('UyJzBVlrnBDStF0BneaophqXwc8KD4gIlbptdTI4', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjUwaUt6WDNoVHdXMmtnVDdjT29PcEp5VUpVMUI2dENpZkpPbXBwOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('uyoBoiIroF9AfFjnDWoNLhXRmtl0jOvmufyfDQ5g', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmk0MVR1bXBEYWEzY1dxSEZaMzFWNlNJVG1EdFgyTU9wQW1CbThTbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944619),
('Vz5WbSuuYBozFcAgR0RXptq1LF34HHKqUtuHVK0o', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejBISHZ3a3lRTHpWYndCcjdhY1ZuUUxUTDk2U3dUcTA5b3pIYnFmcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('waC7xioIEwSrEEnHKuCzvi1ENqwJAUKhDkjVNG5a', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak9DQjE2d2MydWJsaFZqak16RDgzZzFBVFlqR0l1R0NHVkNXRHVFUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632),
('WcLp8O2AakOGIETR2esfULsiSW72vn9LptywCIq5', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlNJenVSRHlvZUJ6RWthNGVtS3BSWHJuUnZWNXl6VkhtTXp6U2lYYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('WjcqFUa04b1TnRKTeK1KZYKqmG3p8tLhUqgxCGuQ', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak9BVlozbEh2RXVWUkQ5ZGd6SUhtRkxlRG9GTkRqQWp5T1JKZWhFNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('wl2d0pcYGWPkxs0D2Iw8F1hRzjfyI4wZws2XUEKE', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakFZdzU3SzZsZW93dmVrbnM3MVpvVDdmZ2ZEOWVpQk9kTk9tVWNRVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('WLcH1IsYTduWHwDyPRf92Tcq7LBmJL2qJxVAEBpd', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3NBOHZsSUpqSTRpZUhUMTRCOXQ2YXI4cTc5bUo5cXc4Yng5ekNwVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('woaAEI9Owd99ic9W2NA3tCKz6NE4HdexHAUiBMk9', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1JGVWJFdXlNVkNZTHBpSlpmTzFMSE44NjU1OHFWcHFzdjJYN1ZZVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944624),
('WpTD0RstheOHW1Sh5Jko6yTLsVjHSz8KaWMlqSCL', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWxnQVVPNk1VTktkR1lLM2d2MWZWQVdzR0VwQ3F1UFZHTFlFbjE0QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('XCYiitBl49D6N82ba83wsrJoVzDd5bCV7XvfvpR9', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM016bk1XcDBYbUxFOVpnaWVmWkFnY3cwU0d6aWhjWk5WanNueE5HOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('xG44MuzlPuAUAhmfjlz41y6xINjXCwnKfmYyFYTH', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHQxbEd6dnplR1RhZUY5N0pUTXlDMlVoRWl1Q0NSVWkyRHNrT1RXTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('xJEttbR6sKq0vOvOq6TMvMMArpnAkvk436bTT9yC', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjd0NTZMYmxlVlRVNlBWTElmMVBYUE9zOUh3ZlZNVlphQnptcmNNdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('XonbXsS71AlXwxgW2IijCiTzPvFYQ0QxXYzKb4J4', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnpGV2JJbHVSTTVJRUliWWxTdE5KNEZSeDdRZHlFQ3kzTFZFeXRXWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('xRxsYzdjyS0grTbOACzas1xVXGqIitbF2PoOgmqs', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1ZreGtIZWlBdmh6aE96ekpERlRacTRoSGZKUWdtOVNzbkxrbEtEayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('XUMrT58ClXJ29FohaptsHMhSGLDrTJC0DkOj3AxH', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmo0TEw5S05wMlpyTHNsT0ptQlppb2xYblpodzV2OGQxZ1FnNFZZWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944620),
('xy7SIqWkKfYxHV4bQg0Z8Zbyu0UQrsmR8O7q6hlW', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmtNOW1HbDNNOFBaZmlXMngzbEc1Zk1WalRXaFgzekFPWUdwRkNENSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('XYzDArnVc8f2ghgO4sMrIYIzL02REIJriUm8n6uj', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzVDRFQ0V1BsTUxCejc1OTNYa0xPUFZKc3lvajBrS0tCZUw0RzZISCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944629),
('Y0qbBEa4LAf3rXVll5CYpgmGoI5je3GwkaCSnosV', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlI0ekVrV2tkNXJFQjZkRnc0SmRrckpmUHZzVmpXTWlRM1BDRXpBaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('YDYJ8uXsHlEkCKDnxuyBhTKacpu6FqD7duMEm9kE', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHpUQTBkanBsamZLOFg1UjRtQ1hOVUh3R3RnWEdHeFBhcnZRQlNOeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944626),
('yZTxwQM1bWgcdLDZuhVUmtqHdXJxpdSKRygIAJU7', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnRReTZBYzVhZlVKUW4xcnl5c3pqRnV0N21jSEJtdzdvMDNZdlZ0RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('z9GcSJB1Obw2DxhmtilJrsDQUdn80OqLOZzbuYwD', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUtrRmNDd2U1MUppcjNRMWlXOVlJTnpsWVpINndMUmdrakZ5V0t6ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944630),
('ZBruVFjbjcomDbXLE4y9T1BjZKP7BPatUNurdIft', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXZJN0hrSW9tSFNSd3prTmIzWVVVc3JHdVBNam56T1JlU2F1dElXTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944620),
('zHc64Wi13N7fjTkbzMztgOIihocjDP1U6Y548Rsx', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzFycWFKUGQ3WWRKZVo0a0VEUUYyWGw5VjQ4MHR6d3NhZ3A3VlVGSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944625),
('ZMNbg5nlmzGbH62PtumfBeoicdeEKUXfQHLKtbNr', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEE4OWVuY1FENmRqTHdXVnFjNkR3bkRSYWZKZDhEaHFkR0l1YkdqSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944626),
('zRYJ1VSRvl8X3YJKMxnXLjK0wd2Kxz0mBI9dtHs5', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0t1aDVWM3lWaGJwUGc1a3ZKU2FOcXR4Y1RDODBJNkxlUjgzMVBUUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944622),
('ztTGOdVJttmCNVk1SEKxMFpr1oyfMiU8ib4zCn1V', NULL, '172.19.0.1', 'python-requests/2.32.4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0MzM3Z5U1Q2Y3h5azE0aUlNYVFZMDg3Zkg0WmtaUVMwbmtMb2lJaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9ob3N0LmRvY2tlci5pbnRlcm5hbDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753944632);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `appreciations`
--
ALTER TABLE `appreciations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `comites`
--
ALTER TABLE `comites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `comites_agents`
--
ALTER TABLE `comites_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `comites_responsables`
--
ALTER TABLE `comites_responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `cycles_evaluation`
--
ALTER TABLE `cycles_evaluation`
  MODIFY `id_cycle` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `objectifs_users`
--
ALTER TABLE `objectifs_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT pour la table `periodes_actions`
--
ALTER TABLE `periodes_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
