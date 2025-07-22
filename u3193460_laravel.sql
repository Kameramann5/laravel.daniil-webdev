-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 22 2025 г., 13:48
-- Версия сервера: 8.0.25-15
-- Версия PHP: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u3193460_laravel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Dashboard', 'fa-bar-chart', '/', NULL, NULL, NULL),
(2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL, NULL),
(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL, NULL),
(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, NULL),
(5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, NULL),
(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, NULL),
(7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2024-10-18 15:09:21', '2024-10-18 15:09:21');

-- --------------------------------------------------------

--
-- Структура таблицы `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$uQTm6EpN4KDC9JwEcD2ZQORxybvbeljubLQ/7Zr2KRtzyzXwKaj5m', 'Administrator', NULL, NULL, '2024-10-18 15:09:20', '2024-10-18 15:09:20');

-- --------------------------------------------------------

--
-- Структура таблицы `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Категория 1', 'kategoriya-1', '2024-09-20 13:49:55', '2024-09-20 13:49:55'),
(3, 'Категория 3', 'kategoriya-3', '2024-09-20 13:50:41', '2024-09-20 13:50:41'),
(4, 'Категория 4', 'kategoriya-4', '2024-09-22 12:22:39', '2024-09-22 12:22:39'),
(7, 'Категория 5', 'kategoriya-5', '2025-01-11 19:23:28', '2025-01-11 19:23:28'),
(8, 'Маркетинг', 'marketing', '2025-01-11 19:55:35', '2025-01-11 19:55:35'),
(9, 'Make Money', 'make-money', '2025-01-11 19:55:51', '2025-01-11 19:55:51'),
(10, 'Marketing', 'marketing-2', '2025-01-11 19:56:38', '2025-01-11 19:56:38'),
(11, 'test', 'test', '2025-07-10 19:38:15', '2025-07-10 19:38:15'),
(12, 'test', 'test-2', '2025-07-10 19:38:24', '2025-07-10 19:38:24'),
(13, 'кат', 'kat', '2025-07-10 19:39:11', '2025-07-10 19:39:11'),
(14, 'Заголовок', 'zagolovok', '2025-07-10 20:04:09', '2025-07-10 20:04:09'),
(15, 'qqqqqqq', 'qqqqqqq', '2025-07-21 10:34:55', '2025-07-21 10:34:55'),
(16, 'qqqqq', 'qqqqq', '2025-07-21 10:35:27', '2025-07-21 10:35:27'),
(17, '222', '222', '2025-07-21 10:52:06', '2025-07-21 10:52:06'),
(18, 'qq2', 'qq2', '2025-07-21 10:52:41', '2025-07-21 10:52:53');

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `emails_backup`
--

CREATE TABLE `emails_backup` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `logins`
--

CREATE TABLE `logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 12, '194.85.210.119', '2025-07-21 12:30:17', NULL),
(2, 12, '194.85.210.119', '2025-07-21 12:30:17', NULL),
(3, 12, '194.85.210.119', '2025-07-21 12:30:17', NULL),
(4, 12, '194.85.210.119', '2025-07-21 12:31:24', NULL),
(5, 12, '194.85.210.119', '2025-07-21 12:31:32', NULL),
(6, 12, '194.85.210.119', '2025-07-21 12:31:33', NULL),
(7, 13, '176.52.56.86', '2025-07-21 12:34:42', NULL),
(8, 13, '176.52.56.86', '2025-07-21 12:34:42', NULL),
(9, 13, '176.52.56.86', '2025-07-21 12:34:51', NULL),
(10, 13, '176.52.56.86', '2025-07-21 12:34:52', NULL),
(11, 13, '176.52.56.86', '2025-07-21 12:35:10', NULL),
(12, 12, '194.85.210.119', '2025-07-21 12:36:29', NULL),
(13, 12, '194.85.210.119', '2025-07-21 12:39:32', NULL),
(14, 12, '194.85.210.119', '2025-07-21 12:39:34', NULL),
(15, 12, '194.85.210.119', '2025-07-21 12:40:58', NULL),
(16, 12, '194.85.210.119', '2025-07-21 12:40:59', NULL),
(17, 12, '194.85.210.119', '2025-07-21 12:41:13', NULL),
(18, 12, '194.85.210.119', '2025-07-21 12:41:16', NULL),
(19, 12, '194.85.210.119', '2025-07-21 12:45:10', NULL),
(20, 12, '194.85.210.119', '2025-07-21 12:46:29', NULL),
(21, 12, '194.85.210.119', '2025-07-21 12:46:42', NULL),
(22, 12, '194.85.210.119', '2025-07-21 12:48:07', NULL),
(23, 12, '194.85.210.119', '2025-07-21 12:51:20', NULL),
(24, 12, '194.85.210.119', '2025-07-21 12:53:27', NULL),
(25, 12, '194.85.210.119', '2025-07-21 12:53:51', NULL),
(26, 12, '194.85.210.119', '2025-07-21 12:54:52', NULL),
(27, 12, '194.85.210.119', '2025-07-21 13:02:41', NULL),
(28, 12, '194.85.210.119', '2025-07-21 13:09:59', NULL),
(29, 12, '194.85.210.119', '2025-07-21 13:15:24', NULL),
(30, 12, '194.85.210.119', '2025-07-21 13:15:54', NULL),
(31, 12, '194.85.210.119', '2025-07-21 13:16:01', NULL),
(32, 12, '194.85.210.119', '2025-07-21 13:16:09', NULL),
(33, 12, '194.85.210.119', '2025-07-21 13:16:29', NULL),
(34, 12, '194.85.210.119', '2025-07-21 13:23:23', NULL),
(35, 12, '194.85.210.119', '2025-07-21 13:23:27', NULL),
(36, 12, '194.85.210.119', '2025-07-21 13:24:19', NULL),
(37, 12, '194.85.210.119', '2025-07-21 13:24:24', NULL),
(38, 12, '194.85.210.119', '2025-07-21 13:24:26', NULL),
(39, 12, '194.85.210.119', '2025-07-21 13:24:28', NULL),
(40, 12, '194.85.210.119', '2025-07-21 13:24:42', NULL),
(41, 12, '194.85.210.119', '2025-07-21 13:24:47', NULL),
(42, 12, '194.85.210.119', '2025-07-21 13:24:50', NULL),
(43, 12, '194.85.210.119', '2025-07-21 13:25:22', NULL),
(44, 12, '194.85.210.119', '2025-07-21 13:25:58', NULL),
(45, 12, '194.85.210.119', '2025-07-21 13:26:03', NULL),
(46, 12, '194.85.210.119', '2025-07-21 13:26:07', NULL),
(47, 12, '194.85.210.119', '2025-07-21 13:31:34', NULL),
(48, 13, '176.52.56.86', '2025-07-21 13:33:48', NULL),
(49, 13, '176.52.56.86', '2025-07-21 13:33:50', NULL),
(50, 13, '176.52.56.86', '2025-07-21 13:33:54', NULL),
(51, 13, '176.52.56.86', '2025-07-21 13:33:58', NULL),
(52, 13, '176.52.56.86', '2025-07-21 13:34:46', NULL),
(53, 13, '176.52.56.86', '2025-07-21 13:34:48', NULL),
(54, 13, '176.52.56.86', '2025-07-21 13:34:55', NULL),
(55, 13, '176.52.56.86', '2025-07-21 13:35:03', NULL),
(56, 13, '176.52.56.86', '2025-07-21 13:35:05', NULL),
(57, 13, '176.52.56.86', '2025-07-21 13:35:08', NULL),
(58, 13, '176.52.56.86', '2025-07-21 13:35:23', NULL),
(59, 13, '176.52.56.86', '2025-07-21 13:35:26', NULL),
(60, 13, '176.52.56.86', '2025-07-21 13:38:09', NULL),
(61, 13, '176.52.56.86', '2025-07-21 13:38:12', NULL),
(62, 13, '176.52.56.86', '2025-07-21 13:38:15', NULL),
(63, 13, '176.52.56.86', '2025-07-21 13:38:19', NULL),
(64, 12, '194.85.210.119', '2025-07-21 13:39:05', NULL),
(65, 12, '194.85.210.119', '2025-07-21 13:39:07', NULL),
(66, 12, '194.85.210.119', '2025-07-21 13:39:10', NULL),
(67, 12, '194.85.210.119', '2025-07-21 13:42:43', NULL),
(68, 12, '194.85.210.119', '2025-07-21 13:47:46', NULL),
(69, 12, '194.85.210.119', '2025-07-21 13:50:09', NULL),
(70, 12, '194.85.210.119', '2025-07-21 13:50:10', NULL),
(71, 12, '194.85.210.119', '2025-07-21 13:51:50', NULL),
(72, 12, '194.85.210.119', '2025-07-21 13:51:53', NULL),
(73, 12, '194.85.210.119', '2025-07-21 13:51:53', NULL),
(74, 12, '194.85.210.119', '2025-07-21 13:51:58', NULL),
(75, 12, '194.85.210.119', '2025-07-21 13:52:03', NULL),
(76, 12, '194.85.210.119', '2025-07-21 13:52:06', NULL),
(77, 12, '194.85.210.119', '2025-07-21 13:52:06', NULL),
(78, 12, '194.85.210.119', '2025-07-21 13:52:10', NULL),
(79, 12, '194.85.210.119', '2025-07-21 13:52:13', NULL),
(80, 12, '194.85.210.119', '2025-07-21 13:52:16', NULL),
(81, 12, '194.85.210.119', '2025-07-21 13:52:17', NULL),
(82, 13, '176.52.56.86', '2025-07-21 13:52:34', NULL),
(83, 13, '176.52.56.86', '2025-07-21 13:52:37', NULL),
(84, 12, '194.85.210.119', '2025-07-21 13:52:41', NULL),
(85, 13, '176.52.56.86', '2025-07-21 13:52:41', NULL),
(86, 13, '176.52.56.86', '2025-07-21 13:52:42', NULL),
(87, 13, '176.52.56.86', '2025-07-21 13:52:44', NULL),
(88, 13, '176.52.56.86', '2025-07-21 13:52:46', NULL),
(89, 13, '176.52.56.86', '2025-07-21 13:52:47', NULL),
(90, 13, '176.52.56.86', '2025-07-21 13:52:48', NULL),
(91, 13, '176.52.56.86', '2025-07-21 13:52:50', NULL),
(92, 13, '176.52.56.86', '2025-07-21 13:52:51', NULL),
(93, 13, '176.52.56.86', '2025-07-21 13:52:53', NULL),
(94, 13, '176.52.56.86', '2025-07-21 13:52:53', NULL),
(95, 13, '176.52.56.86', '2025-07-21 13:53:00', NULL),
(96, 13, '176.52.56.86', '2025-07-21 13:53:03', NULL),
(97, 13, '176.52.56.86', '2025-07-21 13:53:06', NULL),
(98, 13, '176.52.56.86', '2025-07-21 13:53:06', NULL),
(99, 13, '176.52.56.86', '2025-07-21 13:53:07', NULL),
(100, 13, '176.52.56.86', '2025-07-21 13:53:09', NULL),
(101, 13, '176.52.56.86', '2025-07-21 13:53:17', NULL),
(102, 13, '176.52.56.86', '2025-07-21 13:53:17', NULL),
(103, 13, '176.52.56.86', '2025-07-21 13:53:20', NULL),
(104, 13, '176.52.56.86', '2025-07-21 13:53:22', NULL),
(105, 13, '176.52.56.86', '2025-07-21 13:53:42', NULL),
(106, 13, '176.52.56.86', '2025-07-21 13:53:44', NULL),
(107, 13, '176.52.56.86', '2025-07-21 13:53:47', NULL),
(108, 13, '176.52.56.86', '2025-07-21 13:54:15', NULL),
(109, 13, '176.52.56.86', '2025-07-21 13:54:36', NULL),
(110, 13, '176.52.56.86', '2025-07-21 13:54:38', NULL),
(111, 13, '176.52.56.86', '2025-07-21 13:54:40', NULL),
(112, 14, '176.52.55.1', '2025-07-22 10:18:34', NULL),
(113, 14, '176.52.55.1', '2025-07-22 10:18:36', NULL),
(114, 14, '176.52.55.1', '2025-07-22 10:19:07', NULL),
(115, 14, '176.52.55.1', '2025-07-22 10:19:08', NULL),
(116, 14, '176.52.55.1', '2025-07-22 10:19:12', NULL),
(117, 14, '176.52.55.1', '2025-07-22 10:19:14', NULL),
(118, 14, '176.52.55.1', '2025-07-22 10:23:32', NULL),
(119, 14, '176.52.55.1', '2025-07-22 10:30:06', NULL),
(120, 14, '176.52.55.1', '2025-07-22 10:30:14', NULL),
(121, 14, '176.52.55.1', '2025-07-22 10:30:15', NULL),
(122, 14, '176.52.55.1', '2025-07-22 10:32:58', NULL),
(123, 14, '176.52.55.1', '2025-07-22 10:33:04', NULL),
(124, 14, '176.52.55.1', '2025-07-22 10:34:52', NULL),
(125, 14, '176.52.55.1', '2025-07-22 10:34:53', NULL),
(126, 14, '176.52.55.1', '2025-07-22 10:34:54', NULL),
(127, 14, '176.52.55.1', '2025-07-22 10:35:10', NULL),
(128, 14, '176.52.55.1', '2025-07-22 10:35:10', NULL),
(129, 14, '176.52.55.1', '2025-07-22 10:37:16', NULL),
(130, 14, '176.52.55.1', '2025-07-22 10:37:17', NULL),
(131, 14, '176.52.55.1', '2025-07-22 10:37:23', NULL),
(132, 14, '176.52.55.1', '2025-07-22 10:37:23', NULL),
(133, 14, '176.52.55.1', '2025-07-22 10:39:28', NULL),
(134, 14, '176.52.55.1', '2025-07-22 10:39:34', NULL),
(135, 14, '176.52.55.1', '2025-07-22 10:39:34', NULL),
(136, 14, '176.52.55.1', '2025-07-22 10:39:44', NULL),
(137, 14, '176.52.55.1', '2025-07-22 10:39:45', NULL),
(138, 14, '176.52.55.1', '2025-07-22 10:39:46', NULL),
(139, 14, '176.52.55.1', '2025-07-22 10:39:48', NULL),
(140, 14, '176.52.55.1', '2025-07-22 10:39:50', NULL),
(141, 14, '176.52.55.1', '2025-07-22 10:39:56', NULL),
(142, 14, '176.52.55.1', '2025-07-22 10:39:56', NULL),
(143, 14, '176.52.55.1', '2025-07-22 10:40:06', NULL),
(144, 14, '176.52.55.1', '2025-07-22 10:40:08', NULL),
(145, 14, '176.52.55.1', '2025-07-22 10:40:12', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2024_09_04_222402_create_categories_table', 1),
(14, '2024_09_04_222541_create_tags_table', 1),
(15, '2024_09_04_222606_create_posts_table', 1),
(16, '2024_09_04_222732_create_post_tag_table', 1),
(17, '2024_10_15_215708_alter_table_users_add_isadmin', 2),
(18, '2016_01_04_173148_create_admin_tables', 3),
(19, '2025_02_09_132158_alter_table_posts_add_title_index', 4),
(23, '2025_02_09_163010_create_emails_table', 5),
(26, '2025_07_19_065427_add_role_to_users_table', 6),
(27, '2025_07_20_011131_add_last_login_at_to_users_table', 7),
(28, '2025_07_20_021554_create_logins_table', 8),
(29, '2025_07_21_112616_fix_logins_table_timestamps', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `views` int UNSIGNED NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `content`, `category_id`, `views`, `thumbnail`, `created_at`, `updated_at`) VALUES
(3, 'статья 3 р вапр вап рвап р', 'statya-3', 'аываыав впарвапр', 'ыавыавыавыа вапрвапрвапрв', 1, 0, NULL, '2024-09-30 22:17:35', '2025-07-10 20:03:54'),
(4, 'Статья 4', 'statya-4', 'екуек', 'купкпкупкуп', 4, 0, 'images/2024-10-07/UX2h7M00cGrwPmUx5opge5mV72JPlTIjpwUNmuVv.jpg', '2024-10-07 15:11:55', '2024-10-07 15:11:55'),
(5, 'статья 5', 'statya-5', 'впапва', 'пвпваапвпв', 3, 3, 'images/2024-10-07/RKiaTkm25F1EJMhZpKVDLyDPPZVnZ71fzXBKDHNQ.jpg', '2024-10-07 15:43:30', '2025-07-10 20:12:18'),
(7, '2024', '2024', '15616551', '665161', 1, 0, 'images/2024-10-30/LydLdrGSmn7huRibu0K4VfNbpHqnWkrgi8cTCrx8.png', '2024-10-30 20:00:12', '2024-10-30 20:00:12'),
(8, 'рпарпа', 'rparpa', 'папаап', 'тпаат', 1, 0, NULL, '2024-10-30 20:06:38', '2024-10-30 20:06:38'),
(9, '2025', '2025', '2025', '2025', 1, 2, 'images/2024-10-30/3K3fjQuMKmFrVgAfGBOnHnF0vGAWjWYIbBY5uxsP.png', '2024-10-30 20:12:05', '2025-07-16 19:18:28'),
(10, '2026', '2026', '2026', '2026', 1, 2, 'images/2024-10-30/WttdU8nujsJ6wZ2o9qsNwTnNk0u4oe5IZCixH6Pn.png', '2024-10-30 20:15:05', '2025-07-16 19:18:20'),
(11, 'Статья10', '2026-2', 'In lobortis pharetra mattis. Morbi nec nibh iaculis,', 'Контент', 1, 15, 'images/2025-02-09/LXfdR237EKtgi2oeUKWVUF1y6Av8eGsyyhzsVz08.png', '2024-10-30 20:17:31', '2025-07-16 13:39:23'),
(12, 'The golden rules you need to know for a positive life', 'the-golden-rules-you-need-to-know-for-a-positive-life', 'Все окей!!!', 'Maecenas non convallis quam, eu sodales justo. Pellentesque quis lectus elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 10, 11, 'images/2025-01-11/irKEZKpkpx5jpT86cy5NNChHMj5kLOe5Tja0jjji.png', '2025-01-11 19:57:39', '2025-07-14 16:45:24'),
(13, 'test', 'test', 'test', 'test', 1, 0, NULL, '2025-07-10 19:55:39', '2025-07-10 19:55:39'),
(14, 'Название', 'nazvanie', 'Цитата', 'Контент', 1, 0, 'images/2025-07-10/jbsqI4lSNrddMfAEy2XPhyYBAxp98iZn5ZVirYjy.png', '2025-07-10 19:56:46', '2025-07-10 19:56:46'),
(15, 'Название', 'nazvanie-2', 'Цитата', 'Контент', 1, 0, 'images/2025-07-10/ZIy1BtamPyKBS1FLWCPQg3k2AGgoOogf4uQt2sm7.png', '2025-07-10 19:57:01', '2025-07-10 19:57:01'),
(16, 'Название', 'nazvanie-3', 'Цитата', 'Контент', 1, 0, NULL, '2025-07-10 19:57:09', '2025-07-10 19:57:09'),
(17, 'Название', 'nazvanie-4', 'Цитата', 'Контент', 1, 0, NULL, '2025-07-10 19:57:17', '2025-07-10 19:57:17'),
(18, 'Название услуги *', 'nazvanie-uslugi', 'Цитата', 'Контент', 3, 0, NULL, '2025-07-10 19:58:52', '2025-07-10 19:58:52'),
(19, 'Название услуги *', 'nazvanie-uslugi-2', 'Цитата', 'Контент', 3, 0, NULL, '2025-07-10 19:59:42', '2025-07-10 19:59:42'),
(20, 'Название услуги *', 'nazvanie-uslugi-3', 'Цитата', 'Контент', 3, 0, NULL, '2025-07-10 20:02:55', '2025-07-10 20:02:55'),
(21, 'Название', 'nazvanie-5', 'Цитата', 'Контент', 1, 0, 'images/2025-07-10/GikaclgbBV9kTrFrGKrFW2pfnaWBqCQiO3h5by34.png', '2025-07-10 20:04:04', '2025-07-10 20:04:04'),
(22, 'test', 'test-2', 'test', 'test', 1, 2, 'images/2025-07-10/jfem2hcCrgA0T9ndugtdgQl3Urm12ALobYg6fho1.png', '2025-07-10 20:08:25', '2025-07-11 16:53:44'),
(23, 'qqqqqqqqqqqq', 'qqqqqqqqqqqq', 'qqqqqqqqqqqq', 'qqqqqqqqqqqqq', 1, 8, 'images/2025-07-10/Ev8UooeOyAUhh11jqWyuVzbmmDSz55jexuLiAyF0.png', '2025-07-10 20:09:46', '2025-07-12 18:52:32'),
(24, '123', '123', 'Цитата', 'Контент', 1, 0, 'images/2025-07-15/XrXMXwJ2bGs2KgEbBPHa3L3lOV73ptKHicWHC3OA.png', '2025-07-15 12:44:51', '2025-07-15 12:44:51'),
(25, '123', '123-2', 'Цитата', 'Контент', 1, 1, 'images/2025-07-16/WWr9WIikgHwfKhKqFqavwu6B982tTKnvtVTlkzwQ.png', '2025-07-16 08:39:10', '2025-07-16 08:45:04'),
(26, 'bew', 'bew', 'Цитата', 'Контент', 1, 5, 'images/2025-07-16/XadMFoddXOoLPi3zgSien1bEI4QgveQImLWZme7K.png', '2025-07-16 12:27:15', '2025-07-22 06:27:15'),
(27, 'qq', 'qq', 'qq', 'Контент', 1, 0, 'images/2025-07-21/Y0gG6vjQDg2IBmxJh5VexGpvp2mVEoPtY2lzPtPV.png', '2025-07-21 10:53:17', '2025-07-21 10:53:17'),
(28, 'rrrrrr', 'rrrrrr', 'rrrrrr', 'rrrrrr', 1, 0, 'images/2025-07-22/ciGPTif4dF0qe6zRu1Ot7ijxiwv2N8Ck2guYN6vG.png', '2025-07-22 07:19:07', '2025-07-22 07:19:07'),
(29, 'ыфвыы', 'yfvyy', 'вфывыв', 'вывфывфы', 1, 0, 'images/2025-07-22/BoPfILeTvaaDkfVv3C17cZQeKaBCFrxMxbcbrkz1.jpg', '2025-07-22 07:30:14', '2025-07-22 07:30:14'),
(30, 'щшгщгщгшщ', 'shchshgshchgshchgshshch', 'щщгшщшг', 'гшщгшщгщг', 1, 0, 'images/2025-07-22/nnbYXr7YDEr8rmX9qVQJRdZQLNxUie6YwsJnMBn9.jpg', '2025-07-22 07:34:52', '2025-07-22 07:34:52'),
(31, 'шгнш', 'shgnsh', 'шннгшгншгнш', 'гншгншгнш', 1, 0, 'images/2025-07-22/s9p7heNs9bgKEznTzEQgBhz1pIrhGeShcrt1ndaI.jpg', '2025-07-22 07:35:10', '2025-07-22 07:35:10'),
(32, 'hyfth', 'hyfth', 'fhg', 'hfhfghfghfgh', 1, 0, 'images/2025-07-22/bXJANUjoW1S40j9Ub1aXJPf8NPNaYxLIHmsXpIvd.jpg', '2025-07-22 07:37:23', '2025-07-22 07:37:23'),
(33, 'hfgh', 'hfgh', 'fghfghfgh', 'fghgfh', 1, 0, 'images/2025-07-22/G9DozWzZdwZvxmBhYjC7ZNBUC3GKVGeqtfuJfOwI.jpg', '2025-07-22 07:39:34', '2025-07-22 07:39:56');

-- --------------------------------------------------------

--
-- Структура таблицы `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int NOT NULL,
  `tag_id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `post_tag`
--

INSERT INTO `post_tag` (`id`, `tag_id`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 5, 3, '2024-09-30 22:17:35', '2024-09-30 22:17:35'),
(3, 18, 3, '2024-09-30 22:17:35', '2024-09-30 22:17:35'),
(5, 5, 4, '2024-10-07 15:11:55', '2024-10-07 15:11:55'),
(6, 5, 5, '2024-10-07 15:43:30', '2024-10-07 15:43:30'),
(7, 5, 7, '2024-10-30 20:00:12', '2024-10-30 20:00:12'),
(8, 6, 7, '2024-10-30 20:00:12', '2024-10-30 20:00:12'),
(9, 6, 10, '2024-10-30 20:15:06', '2024-10-30 20:15:06'),
(10, 54, 12, '2025-01-11 19:57:40', '2025-01-11 19:57:40'),
(11, 55, 11, '2025-01-16 09:53:03', '2025-01-16 09:53:03'),
(12, 7, 20, '2025-07-10 20:02:55', '2025-07-10 20:02:55'),
(13, 40, 20, '2025-07-10 20:02:55', '2025-07-10 20:02:55'),
(14, 52, 21, '2025-07-10 20:04:04', '2025-07-10 20:04:04'),
(15, 7, 24, '2025-07-15 12:44:51', '2025-07-15 12:44:51'),
(16, 6, 25, '2025-07-16 08:39:10', '2025-07-16 08:39:10'),
(17, 7, 26, '2025-07-16 12:27:15', '2025-07-16 12:27:15'),
(18, 7, 27, '2025-07-21 10:53:17', '2025-07-21 10:53:17'),
(19, 6, 28, '2025-07-22 07:19:07', '2025-07-22 07:19:07'),
(20, 7, 29, '2025-07-22 07:30:14', '2025-07-22 07:30:14');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(5, 'привет', 'privet-5', '2024-09-20 10:33:05', '2024-09-20 10:33:05'),
(6, 'привет', 'privet-6', '2024-09-20 10:34:03', '2024-09-20 10:34:03'),
(7, 'привет', 'privet-7', '2024-09-20 10:34:05', '2024-09-20 10:34:05'),
(8, 'привет', 'privet-8', '2024-09-20 10:34:06', '2024-09-20 10:34:06'),
(9, 'привет', 'privet-9', '2024-09-20 10:34:09', '2024-09-20 10:34:09'),
(10, 'привет', 'privet-10', '2024-09-20 10:34:10', '2024-09-20 10:34:10'),
(11, 'привет', 'privet-11', '2024-09-20 10:34:11', '2024-09-20 10:34:11'),
(12, 'привет', 'privet-12', '2024-09-20 10:34:51', '2024-09-20 10:34:51'),
(13, 'привет', 'privet-13', '2024-09-20 10:35:17', '2024-09-20 10:35:17'),
(14, 'привет', 'privet-14', '2024-09-20 10:47:42', '2024-09-20 10:47:42'),
(16, 'tag', 'tag-2', '2024-09-22 11:31:43', '2024-09-22 11:31:43'),
(17, 'привет', 'privet', '2024-09-22 11:35:23', '2024-09-22 11:35:23'),
(18, 'ку', 'ku', '2024-09-22 11:46:00', '2024-09-22 11:46:00'),
(19, 'привет', 'privet-15', '2024-09-22 12:22:32', '2024-09-22 12:22:32'),
(20, 'привет', 'privet-16', '2024-09-22 12:55:11', '2024-09-22 12:55:11'),
(21, 'привет', 'privet-17', '2024-09-30 21:58:33', '2024-09-30 21:58:33'),
(22, 'привет', 'privet-18', '2024-10-15 20:43:46', '2024-10-15 20:43:46'),
(23, 'привет', 'privet-19', '2024-10-15 20:44:35', '2024-10-15 20:44:35'),
(25, 'привет', 'privet-21', '2024-10-15 20:47:09', '2024-10-15 20:47:09'),
(26, 'привет', 'privet-22', '2024-10-15 20:54:59', '2024-10-15 20:54:59'),
(27, 'привет', 'privet-23', '2024-10-17 18:24:09', '2024-10-17 18:24:09'),
(28, 'привет', 'privet-24', '2024-10-17 19:01:51', '2024-10-17 19:01:51'),
(29, 'привет', 'privet-25', '2024-10-17 19:01:55', '2024-10-17 19:01:55'),
(30, 'привет', 'privet-26', '2024-10-17 19:02:01', '2024-10-17 19:02:01'),
(31, 'привет', 'privet-27', '2024-10-17 19:02:37', '2024-10-17 19:02:37'),
(32, 'привет', 'privet-28', '2024-10-17 19:06:58', '2024-10-17 19:06:58'),
(33, 'привет', 'privet-29', '2024-10-17 20:58:09', '2024-10-17 20:58:09'),
(34, 'привет', 'privet-30', '2024-10-17 20:58:34', '2024-10-17 20:58:34'),
(35, 'привет', 'privet-31', '2024-10-17 20:58:43', '2024-10-17 20:58:43'),
(36, 'привет', 'privet-32', '2024-10-17 20:58:44', '2024-10-17 20:58:44'),
(37, 'привет', 'privet-33', '2024-10-17 20:58:44', '2024-10-17 20:58:44'),
(38, 'привет', 'privet-34', '2024-10-17 20:58:45', '2024-10-17 20:58:45'),
(39, 'привет', 'privet-35', '2024-10-17 20:58:45', '2024-10-17 20:58:45'),
(40, 'привет', 'privet-36', '2024-10-30 19:08:08', '2024-10-30 19:08:08'),
(41, 'привет', 'privet-37', '2024-10-30 19:14:41', '2024-10-30 19:14:41'),
(42, 'привет', 'privet-38', '2024-10-30 19:19:01', '2024-10-30 19:19:01'),
(43, 'привет', 'privet-39', '2024-10-30 19:19:03', '2024-10-30 19:19:03'),
(44, 'привет', 'privet-40', '2024-10-30 19:19:24', '2024-10-30 19:19:24'),
(45, 'привет', 'privet-41', '2024-10-30 19:20:31', '2024-10-30 19:20:31'),
(46, 'привет', 'privet-42', '2025-01-05 17:33:52', '2025-01-05 17:33:52'),
(47, 'привет', 'privet-43', '2025-01-05 17:33:56', '2025-01-05 17:33:56'),
(48, 'привет', 'privet-44', '2025-01-05 17:33:57', '2025-01-05 17:33:57'),
(51, 'Marketing', 'marketing', '2025-01-11 19:56:03', '2025-01-11 19:56:03'),
(52, 'SEO', 'seo', '2025-01-11 19:56:07', '2025-01-11 19:56:07'),
(53, 'Digital Agency', 'digital-agency', '2025-01-11 19:56:19', '2025-01-11 19:56:19'),
(54, 'Blogging', 'blogging', '2025-01-11 19:56:25', '2025-01-11 19:56:25'),
(55, 'Video Tuts', 'video-tuts', '2025-01-11 19:56:30', '2025-01-11 19:56:30'),
(56, 'привет', 'privet-45', '2025-01-12 10:16:50', '2025-01-12 10:16:50'),
(57, 'привет', 'privet-46', '2025-01-16 09:52:48', '2025-01-16 09:52:48'),
(58, 'привет', 'privet-47', '2025-02-08 10:40:39', '2025-02-08 10:40:39'),
(59, 'привет', 'privet-48', '2025-02-08 11:01:58', '2025-02-08 11:01:58'),
(60, 'привет', 'privet-49', '2025-02-11 19:59:06', '2025-02-11 19:59:06'),
(61, 'привет', 'privet-50', '2025-02-22 12:59:35', '2025-02-22 12:59:35'),
(62, 'привет', 'privet-51', '2025-02-24 16:35:49', '2025-02-24 16:35:49'),
(63, 'привет', 'privet-52', '2025-02-24 16:46:34', '2025-02-24 16:46:34'),
(64, 'привет', 'privet-53', '2025-07-10 19:30:50', '2025-07-10 19:30:50'),
(65, 'привет', 'privet-54', '2025-07-10 19:32:39', '2025-07-10 19:32:39'),
(66, 'тег', 'teg', '2025-07-10 19:34:21', '2025-07-10 19:34:21'),
(67, 'тег', 'teg-2', '2025-07-10 19:35:41', '2025-07-10 19:35:41'),
(68, 'Название', 'nazvanie', '2025-07-10 19:58:14', '2025-07-10 19:58:14'),
(69, 'привет', 'privet-55', '2025-07-10 20:03:58', '2025-07-10 20:03:58'),
(70, 'привет', 'privet-56', '2025-07-10 20:07:56', '2025-07-10 20:07:56'),
(71, 'привет', 'privet-57', '2025-07-11 13:49:14', '2025-07-11 13:49:14'),
(72, 'привет', 'privet-58', '2025-07-11 16:50:18', '2025-07-11 16:50:18'),
(73, 'привет', 'privet-59', '2025-07-13 02:11:13', '2025-07-13 02:11:13'),
(74, 'привет', 'privet-60', '2025-07-14 01:27:17', '2025-07-14 01:27:17'),
(75, 'привет', 'privet-61', '2025-07-15 02:13:39', '2025-07-15 02:13:39'),
(76, 'привет', 'privet-62', '2025-07-15 12:41:21', '2025-07-15 12:41:21'),
(77, 'привет', 'privet-63', '2025-07-15 15:07:28', '2025-07-15 15:07:28'),
(78, 'привет', 'privet-64', '2025-07-16 08:38:54', '2025-07-16 08:38:54'),
(79, 'привет', 'privet-65', '2025-07-16 19:27:22', '2025-07-16 19:27:22'),
(80, 'привет', 'privet-66', '2025-07-17 00:45:45', '2025-07-17 00:45:45'),
(81, 'привет', 'privet-67', '2025-07-17 11:20:41', '2025-07-17 11:20:41'),
(82, 'привет', 'privet-68', '2025-07-17 11:20:45', '2025-07-17 11:20:45'),
(83, 'привет', 'privet-69', '2025-07-18 01:00:11', '2025-07-18 01:00:11'),
(84, 'привет', 'privet-70', '2025-07-18 08:22:09', '2025-07-18 08:22:09'),
(85, 'привет', 'privet-71', '2025-07-18 08:22:12', '2025-07-18 08:22:12'),
(86, 'привет', 'privet-72', '2025-07-18 08:22:12', '2025-07-18 08:22:12'),
(87, 'привет', 'privet-73', '2025-07-18 08:22:13', '2025-07-18 08:22:13'),
(88, 'привет', 'privet-74', '2025-07-18 08:22:13', '2025-07-18 08:22:13'),
(89, 'привет', 'privet-75', '2025-07-18 08:22:13', '2025-07-18 08:22:13'),
(90, 'привет', 'privet-76', '2025-07-18 08:22:15', '2025-07-18 08:22:15'),
(91, 'привет', 'privet-77', '2025-07-18 08:22:15', '2025-07-18 08:22:15'),
(92, 'привет', 'privet-78', '2025-07-18 08:22:15', '2025-07-18 08:22:15'),
(93, 'привет', 'privet-79', '2025-07-18 08:23:29', '2025-07-18 08:23:29'),
(94, 'привет', 'privet-80', '2025-07-21 09:41:13', '2025-07-21 09:41:13'),
(95, 'привет', 'privet-81', '2025-07-21 09:41:16', '2025-07-21 09:41:16'),
(96, 'привет', 'privet-82', '2025-07-21 09:45:10', '2025-07-21 09:45:10'),
(97, 'привет', 'privet-83', '2025-07-21 09:46:29', '2025-07-21 09:46:29'),
(98, 'привет', 'privet-84', '2025-07-21 09:46:42', '2025-07-21 09:46:42'),
(99, 'привет', 'privet-85', '2025-07-21 09:48:07', '2025-07-21 09:48:07'),
(100, 'привет', 'privet-86', '2025-07-21 09:51:20', '2025-07-21 09:51:20'),
(101, 'привет', 'privet-87', '2025-07-21 09:53:27', '2025-07-21 09:53:27'),
(102, 'привет', 'privet-88', '2025-07-21 09:53:51', '2025-07-21 09:53:51'),
(103, 'привет', 'privet-89', '2025-07-21 10:15:54', '2025-07-21 10:15:54'),
(104, 'привет', 'privet-90', '2025-07-21 10:16:09', '2025-07-21 10:16:09'),
(105, 'привет', 'privet-91', '2025-07-21 10:16:29', '2025-07-21 10:16:29'),
(106, 'привет', 'privet-92', '2025-07-21 10:23:23', '2025-07-21 10:23:23'),
(107, 'привет', 'privet-93', '2025-07-21 10:24:26', '2025-07-21 10:24:26'),
(108, 'привет', 'privet-94', '2025-07-21 10:24:42', '2025-07-21 10:24:42'),
(109, 'привет', 'privet-95', '2025-07-21 10:25:22', '2025-07-21 10:25:22'),
(110, 'привет', 'privet-96', '2025-07-21 10:33:54', '2025-07-21 10:33:54'),
(111, 'qqqqq', 'qqqqq', '2025-07-21 10:35:05', '2025-07-21 10:35:05'),
(112, '111', '111', '2025-07-21 10:39:10', '2025-07-21 10:39:10'),
(113, '111', '111-2', '2025-07-21 10:42:43', '2025-07-21 10:42:43'),
(114, '111', '111-3', '2025-07-21 10:47:46', '2025-07-21 10:47:46'),
(115, '111', '111-4', '2025-07-21 10:50:09', '2025-07-21 10:50:09'),
(116, '1111111', '1111111', '2025-07-21 10:51:53', '2025-07-21 10:51:53'),
(117, 'привет', 'privet-97', '2025-07-21 10:52:41', '2025-07-21 10:52:41'),
(118, 'qqq', 'qqq', '2025-07-21 10:53:06', '2025-07-21 10:53:06'),
(119, 'привет', 'privet-98', '2025-07-22 07:18:34', '2025-07-22 07:18:34');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL COMMENT 'Время последнего входа пользователя',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `last_login_at`, `created_at`, `updated_at`, `is_admin`, `role`) VALUES
(1, 'uyuytu', 'd.liyrtryry013@yandex.ru', NULL, '$2y$12$JrDbVxik9JECsp0uliD6Oewaypehna2PqphmEwIjSPsPZlR/HchXi', NULL, NULL, '2024-10-15 20:16:42', '2024-10-15 20:16:42', 0, 'user'),
(2, 'uyuytu', 'd.liytertert3@yandex.ru', NULL, '$2y$12$QXQ471WqW5N3k4xf/UYYFuEOD9/DMuSUNhPQZT1XYDAYOIaEAkf2W', NULL, NULL, '2024-10-15 20:17:24', '2024-10-15 20:17:24', 0, 'user'),
(3, 'uyuytu', 'd.liyfsdfsdft3@yandex.ru', NULL, '$2y$12$rwBBlqeMzXI0luLzgbfp2OkA8Cmwb/J.d/SJrzU6asKNpdP0t6JGm', NULL, NULL, '2024-10-15 20:18:34', '2024-10-15 20:18:34', 0, 'user'),
(4, 'uyuytu', 'd.lifdsfdsfs3@yandex.ru', NULL, '$2y$12$OcEjkkgwpESLFUM/3YXgweJzFbMwLNY4KcqCYs0ISEzTIkAzlTG3q', NULL, NULL, '2024-10-15 20:25:50', '2024-10-15 20:25:50', 0, 'user'),
(5, 'admin', 'd.liffdsfsfss3@yandex.ru', NULL, '$2y$12$cpu1pCifqhX0sBkwCtN0bOqsRSu2uiR2TMbUE6no7vjoeqVznEgAC', NULL, NULL, '2024-10-15 20:26:05', '2024-10-15 20:26:05', 1, 'user'),
(6, 'User', 'd.test2013@yandex.ru', NULL, '$2y$12$gkcA1PUjli3w6enB0CAeLeQi0cS3GNSpGSpVbb2/u3nAG2q9hPyjS', NULL, NULL, '2024-10-15 20:27:27', '2024-10-15 20:27:27', 0, 'user'),
(7, 'test', 'd.testrttrtrr2013@yandex.ru', NULL, '$2y$12$1z6U9EOFlXUBkLokPEwZqOS3lhAsGr2CAuRL0vn63Pa5Vx3VNyUAi', NULL, NULL, '2025-02-09 13:41:48', '2025-02-09 13:41:48', 0, 'user'),
(8, 'test', 'd.test2010@yandex.ru', NULL, '$2y$12$98IakcztVaIhzOoxErbcVOa4TTkOA73ICdlfBOR/PJLPm8AyKGF16', NULL, NULL, '2025-02-22 13:04:17', '2025-02-22 13:04:17', 0, 'user'),
(10, 'Baseuser', 'user@example.com', NULL, '$2y$12$OHYBIv2MeQ4Th/DzKZi9g.u6Q/S.iKj8AI4rqtmFWxj1M8XqmIWUW', NULL, '2025-07-20 09:19:51', '2025-07-19 22:02:38', '2025-07-20 09:19:51', 0, 'user'),
(11, 'test', 'ZulAman@yandex.ru', NULL, '$2y$12$uJDbV8XgyGfvBoQ06txfZOvOplhBnVKhjqqxElbar11TQxYlOx3qq', NULL, NULL, '2025-07-21 08:55:30', '2025-07-21 08:55:30', 0, 'user'),
(12, 'test123123', 'ZulAman@yandex1.ru', NULL, '$2y$12$VCPuUlJ192PwaRBkS9nUqeKNM8Uaajb5uuQ6rDtfmLhAT8TpOuUwS', NULL, '2025-07-21 10:52:41', '2025-07-21 09:27:06', '2025-07-21 10:52:41', 0, 'admin'),
(13, 'test', 'd.tfdsfdsf@yandex.ru', NULL, '$2y$12$SP//6EnKw0cv8bxl7fsOj.HZEOr1aaULqt3y1RKy7PYb9V7cpx0wm', NULL, '2025-07-21 10:54:40', '2025-07-21 09:33:14', '2025-07-21 10:54:40', 0, 'admin'),
(14, 'test', 'feodosy.p@yandex.ru', NULL, '$2y$12$8Cz4.9dnjxnrs7kO/Nlb8.0N4L3EGNYASrfeNvxdsXj8VdMkj28a2', NULL, '2025-07-22 07:40:12', '2025-07-22 07:18:18', '2025-07-22 07:40:12', 0, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- Индексы таблицы `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`),
  ADD UNIQUE KEY `admin_permissions_slug_unique` (`slug`);

--
-- Индексы таблицы `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`),
  ADD UNIQUE KEY `admin_roles_slug_unique` (`slug`);

--
-- Индексы таблицы `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- Индексы таблицы `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Индексы таблицы `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- Индексы таблицы `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- Индексы таблицы `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `slug_2` (`slug`(191));

--
-- Индексы таблицы `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_email_unique` (`email`);

--
-- Индексы таблицы `emails_backup`
--
ALTER TABLE `emails_backup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_email_unique` (`email`);

--
-- Индексы таблицы `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logins_user_id_index` (`user_id`),
  ADD KEY `logins_created_at_index` (`created_at`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `emails_backup`
--
ALTER TABLE `emails_backup`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `logins`
--
ALTER TABLE `logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
