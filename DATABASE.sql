-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 02:25 AM
-- Server version: 10.4.14-MariaDB-log
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_absensi`
--
CREATE DATABASE IF NOT EXISTS `ta_absensi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ta_absensi`;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_jadwal` int(10) UNSIGNED NOT NULL,
  `waktu` time NOT NULL COMMENT 'Waktu absensi siswa (Jam)',
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Lokasi koordinat google maps contoh: 3.900736,23.56036',
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Keterangan jika siswa melakukan izin',
  `status` enum('s','i','a') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_of` int(10) UNSIGNED NOT NULL,
  `NIP` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Untuk guru yang tidak memiliki NIP maka NIP diganti dengan kode. contoh : G-392315124',
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `data_of`, `NIP`, `nama`, `jk`, `whatsapp`, `alamat`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
(1, 3, '111112222233333444', 'Sulastri', 'p', '+6285755799604', 'Malang', '1996-04-30', '2021-04-30 09:56:54', '2021-04-30 09:56:54'),
(2, 4, 'G-124124155', 'Safitri', 'p', '+628815392482', 'Janti', '2003-04-30', '2021-04-30 09:56:54', '2021-04-30 09:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_guru` int(10) UNSIGNED NOT NULL,
  `id_mapel` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(10) UNSIGNED NOT NULL,
  `hari` enum('0','1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hari dimulai dari 0: Minggu sampai 6: Sabtu',
  `tanggal` time NOT NULL COMMENT 'Waktu jadwal pelajaran (Jam)',
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `id_guru_mapel` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'XII RPL 1', '2021-04-30 09:56:55', '2021-04-30 09:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', '2021-04-30 09:56:54', '2021-04-30 09:56:54'),
(2, 'Bahasa Inggris', '2021-04-30 09:56:54', '2021-04-30 09:56:54');

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
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(17, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(18, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(19, '2016_06_01_000004_create_oauth_clients_table', 1),
(20, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2021_04_12_045501_create_mapel_table', 1),
(23, '2021_04_12_045618_create_guru_table', 1),
(24, '2021_04_12_050455_create_kelas_table', 1),
(25, '2021_04_12_050530_create_guru_mapel_table', 1),
(26, '2021_04_12_050539_create_jadwal_table', 1),
(27, '2021_04_12_051036_create_siswa_table', 1),
(28, '2021_04_12_051352_create_absensi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('07d108e914663bdea25db8ddfc4e5bac9eb73d73fb774a49770b2db06dd09aefb9486712e47d3544', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:42:20', '2021-05-06 09:42:20', '2022-05-06 16:42:20'),
('0f065880016e0de7c76defa4b7b00277dd999f960bb1eb316ab5e58bdaade0352e3342e3d5a43c49', 3, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsGuru', '[]', 0, '2021-05-18 08:59:20', '2021-05-18 08:59:20', '2022-05-18 15:59:20'),
('1a60d005e8c1ba5704803355905c766c19f66ed0716fa2ee302cf3e59e71e74e410990333cf23051', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:48:25', '2021-05-06 09:48:25', '2022-05-06 16:48:25'),
('20b6283899fffdb7a55ef54acfe5e2760faf4a0e29af44d83b41c627de2a11c2307dbeeb23ee344f', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:14:32', '2021-05-06 10:14:32', '2022-05-06 17:14:32'),
('2d5f7ae51bf2a8ea98e3c2b443dcd319f771d04abdf26a8ef133a3ea23dff4735ea154de36570c98', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:51:40', '2021-05-06 09:51:40', '2022-05-06 16:51:40'),
('36a0b898c567ee9cd57e910c3bde0a7db3a514e34f2d7f261c3891f59918d1cfc23fe7bac5964410', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-07 01:20:59', '2021-05-07 01:20:59', '2022-05-07 08:20:59'),
('3927b3f5f18e902a101f40dfef3373389167f6c6886bfcade72179dd4775c0733a541aa85be06548', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-07 01:20:01', '2021-05-07 01:20:01', '2022-05-07 08:20:01'),
('3a68458b41ccbad8f7b6276fcb92af128003b11c641f4d30bc26449362bc297d1e197249ea8befa0', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:34:05', '2021-05-06 10:34:05', '2022-05-06 17:34:05'),
('4a9d0256731fa3a59bbb9c29d39676466e5975314ac6b79ee2c632f4ec497335d4aed9ca482426eb', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 09:59:25', '2021-05-05 09:59:25', '2022-05-05 16:59:25'),
('4c2de719a911029d3070e6a758a0392614a51e03285a30f2d06d537c2bc324d736a86e0acaf25da0', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:52:19', '2021-05-06 09:52:19', '2022-05-06 16:52:19'),
('51acd3a19cdce84a9efb77b23c55ab442d85d9199534251a2907692dcd3a469177ade59c80bd11cd', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 10:17:50', '2021-05-05 10:17:50', '2022-05-05 17:17:50'),
('537df163e4c85598cec9c3299c1709608b3d93159b84b6299eb5b32b8ac6976322d32bf5ac126e64', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-07 01:18:15', '2021-05-07 01:18:15', '2022-05-07 08:18:15'),
('540135c570566822bb764695b3d23b89272b4d1d7e219c27cb2f584b37bd597167dd4574f846a62f', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 10:12:28', '2021-05-05 10:12:28', '2022-05-05 17:12:28'),
('606b513657a0154dabc6d4657423ce864505a3682c8df2a1b4a5a929fab3a95e4817724f817f1431', 1, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsAdmin', '[]', 0, '2021-05-18 08:57:13', '2021-05-18 08:57:13', '2022-05-18 15:57:13'),
('7c251199c12b6cb53a84919814e4ec2956d33a5a9aedc474a46db10de9e8af650737f2106b6b674f', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 10:10:15', '2021-05-05 10:10:15', '2022-05-05 17:10:15'),
('7da7fc38c561f45c7e6d9cd51dcccc3971f5188b84a206f36456ceaae574a49b34ca459796730189', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:51:00', '2021-05-06 09:51:00', '2022-05-06 16:51:00'),
('7f9c8b97fae7ff50d2e58cbc0ce0e97e1744e0306c82c241fde36959d7de7c65022309fd863ffe01', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:40:04', '2021-05-06 09:40:04', '2022-05-06 16:40:04'),
('844294e3ba7718abb97a8dd2b9f9d545ed7127fe4a13d3225aeffadddd4ec4ed594355f053b54d59', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 10:10:46', '2021-05-05 10:10:46', '2022-05-05 17:10:46'),
('877135bb573e6dd9b126a15d15010bcb6e9a29ade9143c351b51c648ddf32bea81d6dbf3373d9565', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-18 09:02:24', '2021-05-18 09:02:24', '2022-05-18 16:02:24'),
('9b8d4d86ee35b0aa3f368fe6678d2f4a2d3325934ba780802380961fca3c7fe6b2ede1c7796d5cb8', 4, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsGuru', '[]', 0, '2021-05-18 09:01:34', '2021-05-18 09:01:34', '2022-05-18 16:01:34'),
('9c44b9e03e63c1c9b6622774aac3c78f5deb0c928837b103a2b72f34566c9b1764e13c7231b0bb3a', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-06 09:35:44', '2021-05-06 09:35:44', '2022-05-06 16:35:44'),
('9e832ed94e191788b2ad9ee61df175722307d0830bf018b1020e9d41fef0b6c38cbf42871a015802', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 10:16:59', '2021-05-05 10:16:59', '2022-05-05 17:16:59'),
('a04afacd9bbea774b47a2f6190b50ad7f362c8c97f3b1a90b752c025b05d4fc752bce2ba66996b61', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-06 09:30:38', '2021-05-06 09:30:38', '2022-05-06 16:30:38'),
('a86c86d9dba6577ec4775cd6203856488b10264e224604e0a0007f184b97b3d583c8b8af893be6d6', 3, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsGuru', '[]', 0, '2021-05-18 09:01:42', '2021-05-18 09:01:42', '2022-05-18 16:01:42'),
('ace3a207c8ac128c7ec9e2f38f095dc6d337d74b3c8704319a59b99883898ab7ce4d4260130d227d', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-07 01:13:07', '2021-05-07 01:13:07', '2022-05-07 08:13:07'),
('aff9b29b290b6677add727de1a2b6b0a6e6854af9a53357bbb65fa3342b6417e8e80d9f783d2cc19', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:32:55', '2021-05-06 10:32:55', '2022-05-06 17:32:55'),
('b62cfbdd40e59cb192db2738ac09e06449b2671280c5c550e184820b088679637e81bb3381a8dde6', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:34:53', '2021-05-06 10:34:53', '2022-05-06 17:34:53'),
('badee4a45667a573f9bc6cf9c88e2b79e54f783145102a74e6b62747b10588fd3c9c42948df3694f', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 0, '2021-05-05 09:58:26', '2021-05-05 09:58:26', '2022-05-05 16:58:26'),
('c04f4e07136cb3abcd4cfcfe21170096727de957197368ea73031427d3abb9c81ab87da57c9489d4', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:36:09', '2021-05-06 10:36:09', '2022-05-06 17:36:09'),
('c0f06c519dfefba8b69241f894bdd770be52638d0774237b809f5ba26cf890cde5bd14970072ef8e', 1, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsAdmin', '[]', 0, '2021-05-18 09:12:36', '2021-05-18 09:12:36', '2022-05-18 16:12:36'),
('ca445be2811285278fa134e9384d2886f82b647501a4ae866060091c5575e7185730f1f750d7878f', 1, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsAdmin', '[]', 0, '2021-05-18 09:08:57', '2021-05-18 09:08:57', '2022-05-18 16:08:57'),
('cada345043ad15f28cd07a012adecb4f4c4ba3f78d937ba9e30d3d1932b66d9bc82e387a9759a0b0', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:55:09', '2021-05-06 09:55:09', '2022-05-06 16:55:09'),
('e5f7a7a259da771ad83e40229a42a079009091d7aebf73c668d5cbe7123820362a1c55c21576c068', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:31:03', '2021-05-06 10:31:03', '2022-05-06 17:31:03'),
('fcefae3ba08cc1b0de6fd3797a19ba0ee236aeded58e4528ea94fc292a6432e8f302642d6f7bde9c', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 10:12:56', '2021-05-06 10:12:56', '2022-05-06 17:12:56'),
('fe7cdc2bf72e6b1c232bc5bbb4f8bb5952d481a7ea40b6234a12124c41f3f2cd3d434d9f17941118', 5, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', 'AsSiswa', '[]', 1, '2021-05-06 09:33:45', '2021-05-06 09:33:45', '2022-05-06 16:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('935bea10-5bbc-45d9-ac6b-1f5502578e6c', NULL, 'Absensi Siswa Personal Access Client', 'WqAqefSVf6pnaE4bbLyf3PUcQoO2XKohV5zA8lZs', NULL, 'http://localhost', 1, 0, 0, '2021-05-05 08:49:43', '2021-05-05 08:49:43'),
('935bea11-7a45-4a8f-bee0-6cc6dbc36daa', NULL, 'Absensi Siswa Password Grant Client', 'dRhoEkMehWRJgoMMXWZdMSS19SXijgiIHfthegq2', 'users', 'http://localhost', 0, 1, 0, '2021-05-05 08:49:43', '2021-05-05 08:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(2, '935bea10-5bbc-45d9-ac6b-1f5502578e6c', '2021-05-05 08:49:43', '2021-05-05 08:49:43');

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
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_of` int(10) UNSIGNED NOT NULL,
  `NISN` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto_siswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'siswa-default.jpg',
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `data_of`, `NISN`, `nama`, `jk`, `whatsapp`, `alamat`, `tanggal_lahir`, `foto_siswa`, `id_kelas`, `created_at`, `updated_at`) VALUES
(1, 5, '0011223344', 'Burhan Udin Samson', 'l', '+6267988277683', 'singosari', '2011-04-30', 'siswa-default.jpg', 1, '2021-04-30 09:56:55', '2021-04-30 09:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username untuk Guru menggunakan NIP/Kode guru, untuk Siswa menggunakan NISN',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `role` enum('admin','operator','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto_profil`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$rk0dQ1z70njCcNBC5xpF4uYFUy6ww2dvzHIo7fvCMBPREvsjOHrFW', 'default.jpg', 'admin', NULL, '2021-04-30 09:56:53', '2021-04-30 09:56:53'),
(2, 'operator', '$2y$10$6oE.tpYB2jONzl96Jcmb9ehUGGpkFw/82Cd1UjN2mJJwciUiNxUcG', 'default.jpg', 'operator', NULL, '2021-04-30 09:56:53', '2021-04-30 09:56:53'),
(3, '111112222233333444', '$2y$10$MaEu67OZ7NjezoDqqDfZmu3RsAh4isOIjjgOKCO9xpqgy8bwYI7n.', 'default.jpg', 'guru', NULL, '2021-04-30 09:56:54', '2021-04-30 09:56:54'),
(4, 'G-124124155', '$2y$10$PHEYRt1eESWKqoFRHcVSZ.DSTCq/9WqyuB7M5vTSZF8HKq/HHaETG', 'default.jpg', 'guru', NULL, '2021-04-30 09:56:54', '2021-04-30 09:56:54'),
(5, '0011223344', '$2y$10$CMHu/axewTb4gbuFwn65Yuhtei9/z2T9NslXu.AjxdQOSYY7YNa6u', 'default.jpg', 'siswa', NULL, '2021-04-30 09:56:55', '2021-04-30 09:56:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_id_siswa_foreign` (`id_siswa`),
  ADD KEY `absensi_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_nip_unique` (`NIP`),
  ADD UNIQUE KEY `guru_whatsapp_unique` (`whatsapp`),
  ADD KEY `guru_data_of_foreign` (`data_of`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_mapel_id_guru_foreign` (`id_guru`),
  ADD KEY `guru_mapel_id_mapel_foreign` (`id_mapel`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_id_kelas_foreign` (`id_kelas`),
  ADD KEY `jadwal_id_guru_mapel_foreign` (`id_guru_mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_nama_unique` (`nama`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mapel_nama_unique` (`nama`);

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
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`NISN`),
  ADD UNIQUE KEY `siswa_whatsapp_unique` (`whatsapp`),
  ADD KEY `siswa_data_of_foreign` (`data_of`),
  ADD KEY `siswa_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_data_of_foreign` FOREIGN KEY (`data_of`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD CONSTRAINT `guru_mapel_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mapel_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_id_guru_mapel_foreign` FOREIGN KEY (`id_guru_mapel`) REFERENCES `guru_mapel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_data_of_foreign` FOREIGN KEY (`data_of`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
