-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 03:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `failed_jobs`
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
-- Table structure for table `harga_jual`
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
-- Dumping data for table `harga_jual`
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
(16, '2025-06-22', 4, 14000, '2025-06-23 03:34:15', '2025-06-23 03:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id` int(11) NOT NULL,
  `jenis_tanaman` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id`, `jenis_tanaman`) VALUES
(1, 'Buah'),
(2, 'Umbi-Umbian'),
(4, 'Biji-Bijian'),
(8, 'Sayur');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_07_075007_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21);

-- --------------------------------------------------------

--
-- Table structure for table `panen`
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
-- Dumping data for table `panen`
--

INSERT INTO `panen` (`id`, `nama_tanaman`, `tanggal`, `jumlah_panen`, `harga_jual`, `pembuat`, `id_harga_jual`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-06-23', 25, 14000, 1, 5, '2025-06-23 01:06:46', '2025-06-23 01:06:46'),
(2, 3, '2025-06-17', 15, 7000, 2, 1, '2025-06-23 01:37:11', '2025-06-23 01:54:15'),
(7, 4, '2025-06-17', 10, 15000, 1, 2, '2025-06-23 01:56:38', '2025-06-23 01:56:38'),
(8, 3, '2025-06-17', 13, 7000, 1, 1, '2025-06-23 02:46:53', '2025-06-23 02:47:11'),
(9, 3, '2025-06-18', 23, 9000, 1, 7, '2025-06-23 05:04:31', '2025-06-23 05:04:31'),
(10, 4, '2025-06-18', 18, 11000, 1, 8, '2025-06-23 05:04:38', '2025-06-23 05:04:48'),
(11, 3, '2025-06-19', 19, 8000, 1, 9, '2025-06-23 05:04:59', '2025-06-23 05:04:59'),
(12, 4, '2025-06-19', 22, 12000, 1, 10, '2025-06-23 05:05:11', '2025-06-23 05:05:11'),
(13, 4, '2025-06-20', 17, 17000, 1, 11, '2025-06-23 05:05:59', '2025-06-23 05:05:59'),
(14, 3, '2025-06-20', 24, 12000, 1, 12, '2025-06-23 05:06:08', '2025-06-23 05:06:08'),
(15, 3, '2025-06-21', 32, 14500, 1, 13, '2025-06-23 05:06:23', '2025-06-23 05:06:23'),
(16, 4, '2025-06-21', 17, 16000, 1, 14, '2025-06-23 05:06:33', '2025-06-23 05:06:33'),
(17, 3, '2025-06-22', 27, 17500, 1, 15, '2025-06-23 05:06:42', '2025-06-23 05:06:42'),
(18, 4, '2025-06-22', 25, 14000, 1, 16, '2025-06-23 05:06:52', '2025-06-23 05:06:52'),
(19, 4, '2025-06-23', 27, 13000, 1, 6, '2025-06-23 05:07:10', '2025-06-23 05:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
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
-- Dumping data for table `permissions`
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
(12, 'hapus-permissions', 'Menu Permissions', 'web', '2025-06-07 01:43:32', '2025-06-07 01:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-07 01:22:56', '2025-06-07 01:22:56'),
(2, 'Petani', 'web', '2025-06-07 01:23:04', '2025-06-07 01:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id` int(5) NOT NULL,
  `nama_tanaman` varchar(50) NOT NULL,
  `jenis_tanaman` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id`, `nama_tanaman`, `jenis_tanaman`) VALUES
(3, 'Jagung', 4),
(4, 'Sawi', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$xjqUk.eFEOlc1BZJRwz6ee8Oc7LC6k9RoeV7BfNGnVHSko3.euWv2', 1, NULL, '2025-05-22 10:00:42', '2025-06-14 23:55:47'),
(2, 'petani', 'petani@gmail.com', NULL, '$2y$10$jNFQ0/KJJ9JPrv5TwpAeZu9pSJt5MvAP0LzWX1ciY7gAMqwWFXmnq', 2, NULL, '2025-06-06 22:51:14', '2025-06-07 03:33:11'),
(21, 'petani1', 'a@gmail.com', NULL, '$2y$10$f.2I.ITf.vRlIUVdx8yXu.HRdHt9dHIc1g11ydtik.w6Xd1bQkssG', 2, NULL, '2025-06-15 01:52:05', '2025-06-15 01:52:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `harga_jual`
--
ALTER TABLE `harga_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `panen`
--
ALTER TABLE `panen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembuat` (`pembuat`),
  ADD KEY `fk_id_harga_jual` (`id_harga_jual`),
  ADD KEY `fk_nama_tanaman` (`nama_tanaman`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_tanaman` (`jenis_tanaman`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_jual`
--
ALTER TABLE `harga_jual`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panen`
--
ALTER TABLE `panen`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `panen`
--
ALTER TABLE `panen`
  ADD CONSTRAINT `fk_id_harga_jual` FOREIGN KEY (`id_harga_jual`) REFERENCES `harga_jual` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `panen_ibfk_1` FOREIGN KEY (`nama_tanaman`) REFERENCES `tanaman` (`id`),
  ADD CONSTRAINT `panen_ibfk_2` FOREIGN KEY (`pembuat`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD CONSTRAINT `tanaman_ibfk_1` FOREIGN KEY (`jenis_tanaman`) REFERENCES `jenis_tanaman` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
