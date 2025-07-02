-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2025 pada 14.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_infotani_kk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `harga_jual`
--

CREATE TABLE `harga_jual` (
  `id` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_tanaman` int(5) NOT NULL,
  `harga_jual` int(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `harga_jual`
--

INSERT INTO `harga_jual` (`id`, `tanggal`, `nama_tanaman`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, '2025-06-17', 3, 7000, '2025-06-16 22:46:08', '2025-06-16 22:46:08'),
(2, '2025-06-17', 4, 15000, '2025-06-16 23:03:46', '2025-06-16 23:03:46'),
(5, '2025-06-23', 3, 14000, '2025-06-23 00:55:38', '2025-06-23 00:55:38'),
(6, '2025-06-23', 4, 13000, '2025-06-23 03:28:23', '2025-06-23 03:28:23'),
(7, '2025-06-18', 3, 9000, '2025-06-23 03:28:45', '2025-06-23 03:28:45'),
(8, '2025-06-18', 4, 11000, '2025-06-23 03:28:53', '2025-06-23 03:28:53'),
(9, '2025-06-19', 3, 8000, '2025-06-23 03:29:06', '2025-06-23 03:29:06'),
(10, '2025-06-19', 4, 12000, '2025-06-23 03:29:17', '2025-06-23 03:29:17'),
(11, '2025-06-20', 4, 17000, '2025-06-23 03:29:57', '2025-06-23 03:29:57'),
(12, '2025-06-20', 3, 12000, '2025-06-23 03:30:06', '2025-06-23 03:30:06'),
(13, '2025-06-21', 3, 14500, '2025-06-23 03:33:18', '2025-06-23 03:33:18'),
(14, '2025-06-21', 4, 16000, '2025-06-23 03:33:37', '2025-06-23 03:33:37'),
(15, '2025-06-22', 3, 17500, '2025-06-23 03:34:07', '2025-06-23 03:34:07'),
(16, '2025-06-22', 4, 14000, '2025-06-23 03:34:15', '2025-06-23 03:34:15'),
(17, '2025-06-26', 5, 8000, '2025-06-26 01:21:45', '2025-06-26 01:21:45'),
(18, '2025-06-25', 5, 9000, '2025-06-26 01:21:59', '2025-06-26 01:21:59'),
(19, '2025-06-24', 5, 8500, '2025-06-26 01:22:13', '2025-06-26 01:22:13'),
(20, '2025-06-26', 3, 15000, '2025-06-26 01:22:53', '2025-06-26 01:22:53'),
(21, '2025-06-26', 4, 16000, '2025-06-26 01:22:59', '2025-06-26 01:22:59'),
(22, '2025-06-25', 3, 14000, '2025-06-26 01:23:12', '2025-06-26 01:23:12'),
(23, '2025-06-25', 4, 11000, '2025-06-26 01:23:32', '2025-06-26 01:23:32'),
(24, '2025-06-27', 3, 24000, '2025-06-26 23:21:08', '2025-06-26 23:21:08'),
(25, '2025-06-27', 4, 28000, '2025-06-26 23:33:37', '2025-06-26 23:33:37'),
(26, '2025-06-27', 5, 9000, '2025-06-26 23:33:46', '2025-06-26 23:33:46'),
(27, '2025-06-30', 3, 15000, '2025-06-29 19:56:02', '2025-06-29 19:56:02'),
(28, '2025-06-30', 4, 12000, '2025-06-29 19:56:12', '2025-06-29 19:56:12'),
(29, '2025-06-30', 5, 17000, '2025-06-29 19:56:34', '2025-06-29 19:56:34'),
(30, '2025-06-24', 3, 13000, '2025-06-29 20:45:59', '2025-06-29 20:45:59'),
(31, '2025-06-24', 4, 13500, '2025-06-29 20:46:24', '2025-06-29 20:46:24'),
(32, '2025-06-28', 3, 12000, '2025-06-29 20:46:55', '2025-06-29 20:46:55'),
(33, '2025-06-28', 4, 15000, '2025-06-29 20:48:16', '2025-06-29 20:48:16'),
(34, '2025-06-28', 5, 16000, '2025-06-29 20:48:28', '2025-06-29 20:48:28'),
(35, '2025-06-29', 3, 12000, '2025-06-29 20:50:35', '2025-06-29 20:50:35'),
(36, '2025-06-29', 4, 11000, '2025-06-29 20:50:45', '2025-06-29 20:50:45'),
(37, '2025-06-29', 5, 14000, '2025-06-29 20:50:52', '2025-06-29 20:50:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id` int(11) NOT NULL,
  `jenis_tanaman` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id`, `jenis_tanaman`) VALUES
(1, 'Buah'),
(2, 'Umbi-Umbian'),
(4, 'Biji-Bijian'),
(8, 'Sayur'),
(10, 'test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_07_075007_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `panen`
--

CREATE TABLE `panen` (
  `id` int(5) NOT NULL,
  `nama_tanaman` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_panen` int(5) NOT NULL,
  `harga_jual` int(25) NOT NULL,
  `pembuat` bigint(20) UNSIGNED NOT NULL,
  `id_harga_jual` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `panen`
--

INSERT INTO `panen` (`id`, `nama_tanaman`, `tanggal`, `jumlah_panen`, `harga_jual`, `pembuat`, `id_harga_jual`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-06-23', 25, 14000, 2, 5, '2025-06-23 01:06:46', '2025-06-23 01:06:46'),
(2, 3, '2025-06-17', 15, 7000, 2, 1, '2025-06-23 01:37:11', '2025-06-23 01:54:15'),
(7, 4, '2025-06-17', 10, 15000, 21, 2, '2025-06-23 01:56:38', '2025-06-23 01:56:38'),
(8, 3, '2025-06-17', 13, 7000, 21, 1, '2025-06-23 02:46:53', '2025-06-23 02:47:11'),
(9, 3, '2025-06-18', 23, 9000, 2, 7, '2025-06-23 05:04:31', '2025-06-23 05:04:31'),
(10, 4, '2025-06-18', 18, 11000, 2, 8, '2025-06-23 05:04:38', '2025-06-23 05:04:48'),
(11, 3, '2025-06-19', 19, 8000, 22, 9, '2025-06-23 05:04:59', '2025-06-23 05:04:59'),
(12, 4, '2025-06-19', 22, 12000, 22, 10, '2025-06-23 05:05:11', '2025-06-23 05:05:11'),
(13, 4, '2025-06-20', 17, 17000, 2, 11, '2025-06-23 05:05:59', '2025-06-23 05:05:59'),
(14, 3, '2025-06-20', 24, 12000, 2, 12, '2025-06-23 05:06:08', '2025-06-23 05:06:08'),
(15, 3, '2025-06-21', 32, 14500, 21, 13, '2025-06-23 05:06:23', '2025-06-23 05:06:23'),
(16, 4, '2025-06-21', 17, 16000, 21, 14, '2025-06-23 05:06:33', '2025-06-23 05:06:33'),
(17, 3, '2025-06-22', 27, 17500, 21, 15, '2025-06-23 05:06:42', '2025-06-23 05:06:42'),
(18, 4, '2025-06-22', 25, 14000, 22, 16, '2025-06-23 05:06:52', '2025-06-23 05:06:52'),
(19, 4, '2025-06-23', 27, 13000, 22, 6, '2025-06-23 05:07:10', '2025-06-23 05:07:10'),
(20, 5, '2025-06-26', 11, 8000, 22, 17, '2025-06-26 01:24:42', '2025-06-26 01:24:42'),
(21, 5, '2025-06-25', 17, 9000, 2, 18, '2025-06-26 01:24:53', '2025-06-26 01:24:53'),
(22, 4, '2025-06-25', 34, 11000, 2, 23, '2025-06-26 01:25:09', '2025-06-26 01:25:09'),
(23, 3, '2025-06-26', 19, 15000, 2, 20, '2025-06-26 01:25:22', '2025-06-26 01:25:22'),
(24, 3, '2025-06-25', 13, 14000, 2, 22, '2025-06-26 01:26:07', '2025-06-26 01:26:07'),
(26, 3, '2025-06-27', 20, 24000, 21, 24, '2025-06-26 23:22:21', '2025-06-26 23:22:21'),
(27, 3, '2025-06-27', 15, 24000, 22, 24, '2025-06-26 23:22:31', '2025-06-26 23:22:31'),
(31, 3, '2025-06-23', 45, 14000, 23, 5, '2025-06-29 20:54:20', '2025-06-29 20:54:20'),
(32, 3, '2025-06-24', 17, 15000, 23, 27, '2025-06-29 20:56:11', '2025-06-29 21:00:30'),
(33, 3, '2025-06-25', 20, 14000, 23, 22, '2025-06-29 20:57:03', '2025-06-29 20:57:03'),
(34, 3, '2025-06-26', 25, 15000, 23, 20, '2025-06-29 20:57:35', '2025-06-29 20:57:35'),
(35, 3, '2025-06-27', 33, 24000, 23, 24, '2025-06-29 20:58:21', '2025-06-29 20:58:21'),
(36, 3, '2025-06-28', 55, 12000, 23, 32, '2025-06-29 20:58:59', '2025-06-29 20:58:59'),
(37, 3, '2025-06-29', 47, 12000, 23, 35, '2025-06-29 20:59:46', '2025-06-29 20:59:46'),
(38, 3, '2025-06-30', 62, 13000, 23, 30, '2025-06-29 21:00:05', '2025-06-29 21:00:50'),
(39, 4, '2025-06-24', 8, 13500, 24, 31, '2025-06-29 21:03:52', '2025-06-29 21:03:52'),
(40, 4, '2025-06-25', 10, 11000, 24, 23, '2025-06-29 21:04:57', '2025-06-29 21:04:57'),
(42, 4, '2025-06-26', 4, 16000, 24, 21, '2025-06-29 21:05:45', '2025-06-29 21:05:45'),
(43, 4, '2025-06-27', 7, 28000, 24, 25, '2025-06-29 21:06:02', '2025-06-29 21:06:02'),
(44, 4, '2025-06-28', 3, 15000, 24, 33, '2025-06-29 21:06:21', '2025-06-29 21:06:21'),
(45, 4, '2025-06-29', 5, 11000, 24, 36, '2025-06-29 21:06:48', '2025-06-29 21:06:48'),
(46, 4, '2025-06-30', 6, 12000, 24, 28, '2025-06-29 21:07:05', '2025-06-29 21:07:05'),
(47, 5, '2025-06-24', 3, 8500, 25, 19, '2025-06-29 21:09:29', '2025-06-29 21:09:29'),
(48, 5, '2025-06-25', 45, 9000, 25, 18, '2025-06-29 21:09:45', '2025-06-29 21:09:45'),
(49, 5, '2025-06-26', 23, 8000, 25, 17, '2025-06-29 21:10:05', '2025-06-29 21:10:05'),
(50, 5, '2025-06-27', 90, 9000, 25, 26, '2025-06-29 21:10:41', '2025-06-29 21:10:41'),
(51, 5, '2025-06-28', 4, 16000, 25, 34, '2025-06-29 21:11:41', '2025-06-29 21:11:41'),
(52, 5, '2025-06-29', 34, 14000, 25, 37, '2025-06-29 21:11:58', '2025-06-29 21:11:58'),
(53, 5, '2025-06-30', 32, 17000, 25, 29, '2025-06-29 21:12:16', '2025-06-29 21:12:16'),
(54, 4, '2025-06-30', 12, 12000, 25, 28, '2025-06-29 22:34:57', '2025-06-29 22:34:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions_grup` varchar(50) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permissions_grup`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list-users', 'Menu Users', 'web', '2025-06-07 01:34:26', '2025-06-07 01:34:26'),
(2, 'tambah-users', 'Menu Users', 'web', '2025-06-07 01:35:26', '2025-06-07 01:35:26'),
(3, 'edit-users', 'Menu Users', 'web', '2025-06-07 01:35:26', '2025-06-07 01:35:26'),
(4, 'hapus-users', 'Menu Users', 'web', '2025-06-07 01:39:36', '2025-06-07 01:39:36'),
(5, 'list-roles', 'Menu Roles', 'web', '2025-06-07 01:40:00', '2025-06-07 01:40:00'),
(6, 'tambah-roles', 'Menu Roles', 'web', '2025-06-07 01:40:10', '2025-06-07 01:40:10'),
(7, 'edit-roles', 'Menu Roles', 'web', '2025-06-07 01:40:53', '2025-06-07 01:40:53'),
(8, 'hapus-roles', 'Menu Roles', 'web', '2025-06-07 01:41:12', '2025-06-07 01:41:12'),
(9, 'list-permissions', 'Menu Permissions', 'web', '2025-06-07 01:42:16', '2025-06-07 01:42:16'),
(10, 'tambah-permissions', 'Menu Permissions', 'web', '2025-06-07 01:42:38', '2025-06-07 01:42:38'),
(11, 'edit-permissions', 'Menu Permissions', 'web', '2025-06-07 01:43:14', '2025-06-07 01:43:14'),
(12, 'hapus-permissions', 'Menu Permissions', 'web', '2025-06-07 01:43:32', '2025-06-07 01:43:32'),
(21, 'harga-jual', 'Menu Harga Jual', 'web', '2025-06-26 00:30:51', '2025-06-26 00:30:51'),
(22, 'tanaman', 'Menu Tanaman', 'web', '2025-06-26 00:31:00', '2025-06-26 00:31:00'),
(23, 'laporan', 'Menu Laporan', 'web', '2025-06-26 00:33:15', '2025-06-26 00:33:15'),
(24, 'panen', 'Menu Panen', 'web', '2025-06-26 00:33:25', '2025-06-26 00:33:25'),
(25, 'edit-tanaman', 'Menu Tanaman', 'web', '2025-06-26 00:46:24', '2025-06-26 00:46:24'),
(26, 'hapus-tanaman', 'Menu Tanaman', 'web', '2025-06-26 00:46:34', '2025-06-26 00:46:34'),
(27, 'edit-jenis-tanaman', 'Menu Jenis Tanaman', 'web', '2025-06-26 00:46:44', '2025-06-26 00:46:44'),
(28, 'hapus-jenis-tanaman', 'Menu Jenis Tanaman', 'web', '2025-06-26 00:46:55', '2025-06-26 00:46:55'),
(29, 'tambah-tanaman', 'Menu Tanaman', 'web', '2025-06-26 00:55:28', '2025-06-26 00:55:28'),
(30, 'tambah-jenis-tanaman', 'Menu Jenis Tanaman', 'web', '2025-06-26 00:55:37', '2025-06-26 00:55:37'),
(31, 'tambah-harga-jual', 'Menu Harga Jual', 'web', '2025-06-26 00:59:37', '2025-06-26 00:59:37'),
(32, 'edit-harga-jual', 'Menu Harga Jual', 'web', '2025-06-26 00:59:46', '2025-06-26 00:59:46'),
(33, 'hapus-harga-jual', 'Menu Harga Jual', 'web', '2025-06-26 00:59:55', '2025-06-26 00:59:55'),
(34, 'tambah-panen', 'Menu Panen', 'web', '2025-06-26 01:16:44', '2025-06-26 01:16:44'),
(35, 'edit-panen', 'Menu Panen', 'web', '2025-06-26 01:16:52', '2025-06-26 01:16:52'),
(36, 'hapus-panen', 'Menu Panen', 'web', '2025-06-26 01:17:02', '2025-06-26 01:17:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-07 01:22:56', '2025-06-07 01:22:56'),
(2, 'Petani', 'web', '2025-06-07 01:23:04', '2025-06-07 01:23:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanaman`
--

CREATE TABLE `tanaman` (
  `id` int(5) NOT NULL,
  `nama_tanaman` varchar(50) NOT NULL,
  `jenis_tanaman` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tanaman`
--

INSERT INTO `tanaman` (`id`, `nama_tanaman`, `jenis_tanaman`) VALUES
(3, 'Jagung', 4),
(4, 'Sawi', 8),
(5, 'Mangga', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$xjqUk.eFEOlc1BZJRwz6ee8Oc7LC6k9RoeV7BfNGnVHSko3.euWv2', 1, NULL, '2025-05-22 10:00:42', '2025-06-14 23:55:47'),
(2, 'petani', 'petani@gmail.com', NULL, '$2y$10$jNFQ0/KJJ9JPrv5TwpAeZu9pSJt5MvAP0LzWX1ciY7gAMqwWFXmnq', 2, NULL, '2025-06-06 22:51:14', '2025-06-07 03:33:11'),
(21, 'petani1', 'a@gmail.com', NULL, '$2y$10$f.2I.ITf.vRlIUVdx8yXu.HRdHt9dHIc1g11ydtik.w6Xd1bQkssG', 2, NULL, '2025-06-15 01:52:05', '2025-06-15 01:52:05'),
(22, 'petani2', 'petani2@gmail.com', NULL, '$2y$10$IUx8nxg1KDqqGbUr65OZQurIhwgPK.J0Db9Zt0jpCVRtDZswQ6RgW', 2, NULL, '2025-06-26 01:18:13', '2025-06-26 01:18:13'),
(23, 'yasa', 'yasa@gmail.com', NULL, '$2y$10$/V2ukEuqriDQjJFvJrIDBeiJCj1j/PGrkyw5IgXliTRBEsevWRWaO', 2, NULL, '2025-06-29 19:55:19', '2025-06-29 19:55:19'),
(24, 'washif', 'washif@gmail.com', NULL, '$2y$10$Y0NTug8cfg7sfh6HLrl1xOFx7b6UFXzWuEeuFDyF82dMU0AWoMWUm', 2, NULL, '2025-06-29 21:02:06', '2025-06-29 21:02:06'),
(25, 'sigit', 'sigit@gmail.com', NULL, '$2y$10$qfgel9tSegljdtyaM25sru0AOWK0MoAAi6u6xJiVB1X6aV5vq059u', 2, NULL, '2025-06-29 21:07:42', '2025-06-29 21:07:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `harga_jual`
--
ALTER TABLE `harga_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `panen`
--
ALTER TABLE `panen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembuat` (`pembuat`),
  ADD KEY `fk_id_harga_jual` (`id_harga_jual`),
  ADD KEY `fk_nama_tanaman` (`nama_tanaman`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_tanaman` (`jenis_tanaman`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `harga_jual`
--
ALTER TABLE `harga_jual`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `panen`
--
ALTER TABLE `panen`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `panen`
--
ALTER TABLE `panen`
  ADD CONSTRAINT `fk_id_harga_jual` FOREIGN KEY (`id_harga_jual`) REFERENCES `harga_jual` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `panen_ibfk_1` FOREIGN KEY (`nama_tanaman`) REFERENCES `tanaman` (`id`),
  ADD CONSTRAINT `panen_ibfk_2` FOREIGN KEY (`pembuat`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanaman`
--
ALTER TABLE `tanaman`
  ADD CONSTRAINT `tanaman_ibfk_1` FOREIGN KEY (`jenis_tanaman`) REFERENCES `jenis_tanaman` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
