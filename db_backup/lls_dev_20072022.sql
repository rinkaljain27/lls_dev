-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 06:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lls_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE `api_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `command_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2022_07_07_065218_create_api_logs_table', 1),
(10, '2022_07_07_065242_create_commands_table', 1),
(11, '2022_07_07_065258_create_product_table', 1),
(12, '2022_07_07_065315_create_product_type_table', 1),
(13, '2022_07_07_065332_create_roles_table', 1),
(14, '2022_07_07_065349_create_role_command_table', 1),
(15, '2022_07_07_065404_create_system_logs_table', 1),
(16, '2022_07_07_065427_create_user_roles_table', 1),
(17, '2022_07_07_091415_add_name_to_system_logs_table', 2),
(19, '2022_07_07_093004_remove_name_to_system_logs_table', 3),
(21, '2022_07_07_100216_change_sometable_in_system_logs_table', 4),
(22, '2022_07_08_055355_remove_show_case_to_system_logs_table', 5),
(23, '2022_07_15_102832_change_sometable_in_product_table', 6),
(24, '2022_07_18_064124_remove_role_id_to_users_table', 7),
(25, '2022_07_18_064705_add_role_id_to_users_table', 8),
(29, '2022_07_18_071155_add_role_id_to_users_table', 9),
(30, '2022_07_18_092905_change_sometable_in_users_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_type_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'hhhhh', 2, 1, '2022-07-15 07:05:08', '2022-07-15 07:15:47', NULL),
(3, 'uuuu', 3, 1, '2022-07-15 07:07:12', '2022-07-15 07:36:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'llll', 1, '2022-07-15 04:22:00', '2022-07-15 04:22:00', NULL),
(3, 'oooo', 1, '2022-07-15 04:22:06', '2022-07-15 04:22:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 1, '2022-07-18 09:46:39', NULL, NULL),
(2, 'bgffgfg', 1, '2022-07-18 11:33:33', NULL, NULL),
(3, 'hyjhjh', 1, '2022-07-18 11:33:46', NULL, NULL),
(4, 'jjhmjhmjh', 1, '2022-07-18 11:33:46', NULL, NULL),
(5, 'hmkhgmkhgm', 1, '2022-07-18 11:34:04', NULL, NULL),
(6, 'jgmkjhgmkjg', 1, '2022-07-18 11:34:04', NULL, NULL),
(7, 'hgmhgmkgh', 1, '2022-07-18 11:34:18', NULL, NULL),
(8, 'ghbgfhgf', 1, '2022-07-18 11:34:18', NULL, NULL),
(9, 'gjngfnjgfnf', 1, '2022-07-18 11:34:35', NULL, NULL),
(10, 'hgmhmhjmjh', 1, '2022-07-18 11:34:35', NULL, NULL),
(11, 'hnjmhgmnhghg', 1, '2022-07-18 11:34:50', NULL, NULL),
(12, 'hhjjjjjjjjfjf', 1, '2022-07-18 11:35:07', NULL, NULL),
(13, 'hjmnhmkhmh', 1, '2022-07-18 11:35:16', NULL, NULL),
(14, 'dsfsdfsef', 1, '2022-07-18 11:35:16', NULL, NULL),
(15, 'gfjngfngfnf', 1, '2022-07-18 11:35:36', NULL, NULL),
(16, 'jngfjnhgjmnhg', 1, '2022-07-18 11:35:36', NULL, NULL),
(17, 'dfsfsdsd', 1, '2022-07-18 11:35:51', NULL, NULL),
(18, 'ffgbhfdhbg', 1, '2022-07-18 11:35:51', NULL, NULL),
(19, 'fgfgfvc', 1, '2022-07-18 11:36:04', NULL, NULL),
(20, 'dvfsAdaDczs', 1, '2022-07-18 11:36:04', NULL, NULL),
(21, ' vc bgvb gvfb ', 1, '2022-07-18 11:36:24', NULL, NULL),
(22, ' nbbnbnbbnb', 1, '2022-07-18 11:36:24', NULL, NULL),
(23, 'aa', 1, '2022-07-19 03:22:45', '2022-07-19 03:22:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_command`
--

CREATE TABLE `role_command` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(10) UNSIGNED NOT NULL,
  `cojmmand_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `json_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `user_id`, `type`, `comment`, `json_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Insert Role From Web by ', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 06:09:13', '2022-07-14 06:09:13', NULL),
(2, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 06:38:08', '2022-07-14 06:38:08', NULL),
(3, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 06:38:15', '2022-07-14 06:38:15', NULL),
(4, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:10:23', '2022-07-14 07:10:23', NULL),
(5, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:10:34', '2022-07-14 07:10:34', NULL),
(6, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:10:55', '2022-07-14 07:10:55', NULL),
(7, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:11:00', '2022-07-14 07:11:00', NULL),
(8, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:11:04', '2022-07-14 07:11:04', NULL),
(9, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:11:10', '2022-07-14 07:11:10', NULL),
(10, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 07:11:18', '2022-07-14 07:11:18', NULL),
(11, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:06:12', '2022-07-14 23:06:12', NULL),
(12, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:14:43', '2022-07-14 23:14:43', NULL),
(13, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:15:12', '2022-07-14 23:15:12', NULL),
(14, 1, 'Delete Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:32:34', '2022-07-14 23:32:34', NULL),
(15, 1, 'Delete Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:33:41', '2022-07-14 23:33:41', NULL),
(16, 1, 'Delete Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:34:06', '2022-07-14 23:34:06', NULL),
(17, 1, 'Delete Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:34:54', '2022-07-14 23:34:54', NULL),
(18, 1, 'Delete Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 23:35:00', '2022-07-14 23:35:00', NULL),
(19, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 00:40:58', '2022-07-15 00:40:58', NULL),
(20, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 00:47:28', '2022-07-15 00:47:28', NULL),
(21, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 00:58:05', '2022-07-15 00:58:05', NULL),
(22, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 00:59:54', '2022-07-15 00:59:54', NULL),
(23, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:00:05', '2022-07-15 01:00:05', NULL),
(24, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:04:01', '2022-07-15 01:04:01', NULL),
(25, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:07:09', '2022-07-15 01:07:09', NULL),
(26, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:10:42', '2022-07-15 01:10:42', NULL),
(27, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:11:13', '2022-07-15 01:11:13', NULL),
(28, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:25:06', '2022-07-15 01:25:06', NULL),
(29, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:30:27', '2022-07-15 01:30:27', NULL),
(30, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 01:50:02', '2022-07-15 01:50:02', NULL),
(31, 1, 'Insert Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:18:27', '2022-07-15 04:18:27', NULL),
(32, 1, 'Insert Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:20:33', '2022-07-15 04:20:33', NULL),
(33, 1, 'Update Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:20:57', '2022-07-15 04:20:57', NULL),
(34, 1, 'Delete Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:21:10', '2022-07-15 04:21:10', NULL),
(35, 1, 'Insert Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:22:00', '2022-07-15 04:22:00', NULL),
(36, 1, 'Insert Product Type From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 04:22:06', '2022-07-15 04:22:06', NULL),
(37, 1, 'Insert Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 06:25:20', '2022-07-15 06:25:20', NULL),
(38, 1, 'Update Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 06:43:04', '2022-07-15 06:43:04', NULL),
(39, 1, 'Update Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 06:43:29', '2022-07-15 06:43:29', NULL),
(40, 1, 'Update Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 06:43:51', '2022-07-15 06:43:51', NULL),
(41, 1, 'Delete Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 06:44:00', '2022-07-15 06:44:00', NULL),
(42, 1, 'Insert Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 07:05:08', '2022-07-15 07:05:08', NULL),
(43, 1, 'Insert Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 07:07:12', '2022-07-15 07:07:12', NULL),
(44, 1, 'Update Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 07:15:47', '2022-07-15 07:15:47', NULL),
(45, 1, 'Update Product From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-15 07:36:50', '2022-07-15 07:36:50', NULL),
(46, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-17 23:27:10', '2022-07-17 23:27:10', NULL),
(47, 4, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 04:18:18', '2022-07-18 04:18:18', NULL),
(48, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:04:13', '2022-07-18 05:04:13', NULL),
(49, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:12:35', '2022-07-18 05:12:35', NULL),
(50, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:31:05', '2022-07-18 05:31:05', NULL),
(51, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:35:54', '2022-07-18 05:35:54', NULL),
(52, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:36:57', '2022-07-18 05:36:57', NULL),
(53, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:37:17', '2022-07-18 05:37:17', NULL),
(54, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:37:32', '2022-07-18 05:37:32', NULL),
(55, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:39:06', '2022-07-18 05:39:06', NULL),
(56, 1, 'Insert User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:41:02', '2022-07-18 05:41:02', NULL),
(57, 1, 'Update User From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 05:43:23', '2022-07-18 05:43:23', NULL),
(58, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 06:14:57', '2022-07-18 06:14:57', NULL),
(59, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 06:15:00', '2022-07-18 06:15:00', NULL),
(60, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 07:39:23', '2022-07-18 07:39:23', NULL),
(61, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 07:41:31', '2022-07-18 07:41:31', NULL),
(62, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 23:27:02', '2022-07-18 23:27:02', NULL),
(63, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 23:46:38', '2022-07-18 23:46:38', NULL),
(64, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 23:49:34', '2022-07-18 23:49:34', NULL),
(65, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 01:19:25', '2022-07-19 01:19:25', NULL),
(66, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 01:19:35', '2022-07-19 01:19:35', NULL),
(67, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 01:28:02', '2022-07-19 01:28:02', NULL),
(68, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 01:28:16', '2022-07-19 01:28:16', NULL),
(69, 1, 'Insert Role From Web', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 03:22:45', '2022-07-19 03:22:45', NULL),
(70, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 07:14:13', '2022-07-19 07:14:13', NULL),
(71, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 07:14:21', '2022-07-19 07:14:21', NULL),
(72, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 23:02:50', '2022-07-19 23:02:50', NULL),
(73, 1, 'Web Logout', 'admin logged Out From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 23:16:01', '2022-07-19 23:16:01', NULL),
(74, 1, 'Web Login', 'admin logged In From Web App', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-19 23:16:18', '2022-07-19 23:16:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `full_name`, `mobile`, `address`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin hello', 8777788888, 'kkkkkk', 1, NULL, '$2y$10$dFk9jwGRdaq6uc8JJdV0TOPRmDDChCqczohHhCKXiAMvCGboQaBpG', NULL, '2022-07-18 09:47:06', NULL, NULL, 1),
(5, 'admindemoo', 'admin1234@gmail.com', 'adminfbfj', 444448888899, 'fgvfdbhfb', 1, NULL, '$2y$10$dFk9jwGRdaq6uc8JJdV0TOPRmDDChCqczohHhCKXiAMvCGboQaBpG', NULL, '2022-07-18 05:41:02', '2022-07-18 05:43:23', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_product_type_id_foreign` (`product_type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_command`
--
ALTER TABLE `role_command`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `role_command`
--
ALTER TABLE `role_command`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
