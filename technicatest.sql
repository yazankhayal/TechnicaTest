-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 09:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technicatest`
--

-- --------------------------------------------------------

--
-- Table structure for table `call_stats`
--

CREATE TABLE `call_stats` (
  `id` int(10) UNSIGNED NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recording_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_stats`
--

INSERT INTO `call_stats` (`id`, `length`, `recording_url`, `created_at`, `updated_at`) VALUES
(1, '00:56:43', 'http://remote.system/recording/1213', '2021-02-25 19:52:38', '2021-02-25 19:52:38'),
(2, '00:56:43', 'http://remote.system/recording/1213', '2021-02-25 19:52:38', '2021-02-25 19:52:38'),
(3, '00:56:43', 'http://remote.system/recording/1213', '2021-02-25 19:52:38', '2021-02-25 19:52:38'),
(4, '00:56:43', 'http://remote.system/recording/1213', '2021-02-25 19:52:38', '2021-02-25 19:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Campaign B', 'A lovely campaign for Michael', '2021-02-25 20:06:01', '2021-02-25 20:32:52'),
(2, 'Campaign A', 'A lovely campaign for Michael', '2021-02-25 20:06:01', '2021-02-25 20:06:01');

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
(3, '2021_02_25_191958_create_query_type_table', 1),
(4, '2021_02_25_192021_create_call_stats_table', 1),
(5, '2021_02_25_192034_create_campaign_table', 1),
(7, '2021_02_25_192055_create_system_send_table', 2);

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
-- Table structure for table `query_type`
--

CREATE TABLE `query_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `query_type`
--

INSERT INTO `query_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'SALE MADE', '2021-02-25 20:12:46', '2021-02-25 20:12:46'),
(2, 'DECLINED OFFER', '2021-02-25 20:13:33', '2021-02-25 20:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `system_send`
--

CREATE TABLE `system_send` (
  `id` int(10) UNSIGNED NOT NULL,
  `query_type_id` int(10) UNSIGNED NOT NULL,
  `call_stats_id` int(10) UNSIGNED NOT NULL,
  `campaign_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_send`
--

INSERT INTO `system_send` (`id`, `query_type_id`, `call_stats_id`, `campaign_id`, `created_at`, `updated_at`) VALUES
(7, 2, 1, 1, '2021-02-25 20:42:24', '2021-02-25 20:42:24'),
(8, 1, 1, 2, '2021-02-25 20:42:31', '2021-02-25 20:42:31'),
(9, 2, 2, 1, '2021-02-25 20:42:36', '2021-02-25 20:42:36'),
(10, 1, 2, 1, '2021-02-25 20:42:43', '2021-02-25 20:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '123123', NULL, '$2y$10$8NvjNroARsp5KYupAm29fO6DTnZrnNcM81xNv9OIFVpX8eoAviaW2', 1, NULL, '2021-02-25 19:25:14', '2021-02-25 19:25:14'),
(2, 'Microservice A', 'm@g.com', '1', NULL, '$2y$10$TUI9po9OSyX6kwGyFpwu3udOlZWXI6y8.fi.SY6FsEEhaDgv.9dAm', 2, '3izSrdGg7zbwZumSe5AgyKBtlIaFXqejkP1znH5knR8O7FABNEgm5AwwFyjK', '2021-02-25 20:23:41', '2021-02-25 20:23:41'),
(3, 'Microservice C', 'c@g.com', '12', NULL, '$2y$10$4dUGkq7Rfch08pDM8d2gWO5HijlfEvop6LNCiFtAOWDAUKPoZ2bfi', 3, 'C21fgV2fH5NobzVLbw8QGjwk5d6sP6dKsWlzu1JUv9EAlJa0uHv5FXzVXXMi', '2021-02-25 20:25:59', '2021-02-25 20:25:59'),
(4, 'Microservice B', 'b@g.com', '123', NULL, '$2y$10$LRfJjUoAIy7LxRVLugS47.QtsuWMA4uzEblgMWpHPxx8s7.oedS7G', 5, 'cGrVECcFGMenOncs73pMPRESFm5VD7SfHIxHhFqrrVBHARkbZ4U2gm9CB7HR', '2021-02-25 20:26:16', '2021-02-25 20:26:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `call_stats`
--
ALTER TABLE `call_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `query_type`
--
ALTER TABLE `query_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_send`
--
ALTER TABLE `system_send`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_send_query_type_id_index` (`query_type_id`),
  ADD KEY `system_send_call_stats_id_index` (`call_stats_id`),
  ADD KEY `system_send_campaign_id_index` (`campaign_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `call_stats`
--
ALTER TABLE `call_stats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `query_type`
--
ALTER TABLE `query_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_send`
--
ALTER TABLE `system_send`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `system_send`
--
ALTER TABLE `system_send`
  ADD CONSTRAINT `system_send_call_stats_id_foreign` FOREIGN KEY (`call_stats_id`) REFERENCES `call_stats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `system_send_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `system_send_query_type_id_foreign` FOREIGN KEY (`query_type_id`) REFERENCES `query_type` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
