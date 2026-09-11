-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.8.8-MariaDB - MariaDB Server
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos_hanifa
CREATE DATABASE IF NOT EXISTS `pos_hanifa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `pos_hanifa`;

-- Dumping structure for table pos_hanifa.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.cache: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.item_penjualan: ~140 rows (approximately)

-- Dumping structure for table pos_hanifa.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.jobs: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_01_19_014814_create_produk_table', 1),
	(6, '2026_01_19_015701_create_penjualan_table', 1),
	(7, '2026_01_19_020509_create_item_penjualan_table', 1);

-- Dumping structure for table pos_hanifa.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `status` enum('OPEN','COMPLETED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.penjualan: ~0 rows (approximately)

-- Dumping structure for table pos_hanifa.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.produk: ~0 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 3, 'products/crMc9Us2wmvbMoBddF4PSlrurSwEIhYbFqK5VI6E.png', 'Lovely Thoughts Bouquet', 430000, 440000, 10, '2026-09-10 22:43:08', '2026-09-10 22:43:08'),
	(2, 3, 'products/booHsda8Qb3jVT7J4cuuXnNRgeQ3zTCybEf8F9oY.png', 'Key To My Heart Bouquet', 620000, 630000, 10, '2026-09-10 22:44:33', '2026-09-10 22:44:33'),
	(3, 3, 'products/fBUJuI29jz0jhY1FxGquDk43PqhYY1OjgIUm0hrC.png', 'Gorgeous Gerberas Bouquet', 420000, 430000, 10, '2026-09-10 22:45:38', '2026-09-10 22:45:38'),
	(4, 3, 'products/UAhV0kn1UHjkapBwq6U3fIejgyysrpyYFVJDXx1c.png', 'Stay With Me Bouquet', 890000, 900000, 10, '2026-09-10 22:46:49', '2026-09-10 22:46:49');

-- Dumping structure for table pos_hanifa.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.roles: ~0 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-09-10 20:38:31', '2026-09-10 20:38:31'),
	(2, 'kasir', '2026-09-10 20:38:31', '2026-09-10 20:38:31');

-- Dumping structure for table pos_hanifa.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.sessions: ~0 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('jzx93vQdeCmYYj14mocREcflDlDvEDx6cRx0dB2D', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaGl2QmxWTnp3a2NqUVc0czJ1M3JKZTc0NnJmMlc4NTBuMkk4WFpYWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4udXNlcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1789105642);

-- Dumping structure for table pos_hanifa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_hanifa.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 1, 'Kraig Green', 'keeley16@example.com', '2026-09-10 20:38:32', '$2y$12$YiTusvmm3URVU6RaYAwEWOAwPajaN/ZzzD6rGtB0f/rgvPrbW1lRO', 'RrcOyvqx8HALF6hjTvcuXnA9X5BFyeWPfJIYw4LOH863Di5CUDHlxzCgxUaL', '2026-09-10 20:38:32', '2026-09-10 20:38:32'),
	(4, 2, 'London Reilly', 'deichmann@example.org', '2026-09-10 20:38:32', '$2y$12$YiTusvmm3URVU6RaYAwEWOAwPajaN/ZzzD6rGtB0f/rgvPrbW1lRO', 'IM8Cqt2y5V', '2026-09-10 20:38:32', '2026-09-10 20:38:32'),
	(5, 1, 'Novella Casper', 'kroob@example.org', '2026-09-10 20:38:32', '$2y$12$YiTusvmm3URVU6RaYAwEWOAwPajaN/ZzzD6rGtB0f/rgvPrbW1lRO', 'lIWTfhTGX3', '2026-09-10 20:38:32', '2026-09-10 20:38:32'),
	(6, 2, 'Test User', 'test@example.com', '2026-09-10 20:38:33', '$2y$12$YiTusvmm3URVU6RaYAwEWOAwPajaN/ZzzD6rGtB0f/rgvPrbW1lRO', '7whEEsxIo4', '2026-09-10 20:38:33', '2026-09-10 20:38:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
