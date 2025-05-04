-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 07:09 PM
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
-- Database: `leave_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(4) NOT NULL,
  `total_days` int(11) NOT NULL DEFAULT 0,
  `used_days` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `user_id`, `leave_type_id`, `year`, `total_days`, `used_days`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2025, 12, 1, '2025-05-04 10:53:44', '2025-05-04 10:55:40'),
(2, 1, 2, 2025, 30, 0, '2025-05-04 10:53:44', '2025-05-04 10:53:44'),
(3, 3, 1, 2025, 12, 1, '2025-05-04 11:15:40', '2025-05-04 11:16:37'),
(4, 3, 2, 2025, 30, 0, '2025-05-04 11:15:40', '2025-05-04 11:15:40'),
(5, 4, 1, 2025, 12, 0, '2025-05-04 12:02:31', '2025-05-04 12:02:31'),
(6, 4, 2, 2025, 30, 0, '2025-05-04 12:02:31', '2025-05-04 12:02:31'),
(7, 5, 1, 2025, 12, 0, '2025-05-04 12:10:40', '2025-05-04 12:10:40'),
(8, 5, 2, 2025, 30, 0, '2025-05-04 12:10:40', '2025-05-04 12:10:40'),
(9, 6, 1, 2025, 12, 1, '2025-05-04 12:19:16', '2025-05-04 13:26:47'),
(10, 6, 2, 2025, 30, 0, '2025-05-04 12:19:16', '2025-05-04 12:19:16'),
(13, 8, 1, 2025, 12, 0, '2025-05-04 12:52:19', '2025-05-04 12:52:19'),
(14, 8, 2, 2025, 30, 0, '2025-05-04 12:52:19', '2025-05-04 12:52:19'),
(15, 9, 1, 2025, 12, 0, '2025-05-04 12:53:15', '2025-05-04 12:53:15'),
(16, 9, 2, 2025, 30, 0, '2025-05-04 12:53:15', '2025-05-04 12:53:15'),
(19, 11, 1, 2025, 12, 0, '2025-05-04 12:56:49', '2025-05-04 12:56:49'),
(20, 11, 2, 2025, 30, 0, '2025-05-04 12:56:49', '2025-05-04 12:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `leave_type_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2025-05-05', '2025-05-05', 'fgdfgdsfgdfg', 'approved', '2025-05-04 10:55:38', '2025-05-04 10:55:40'),
(4, 3, 1, '2025-05-06', '2025-05-06', 'fgsdfgdsfgsdfgdsfgsdfg', 'approved', '2025-05-04 11:16:19', '2025-05-04 11:16:37'),
(5, 3, 2, '2025-05-12', '2025-05-12', 'just for the testing purpose only ', 'rejected', '2025-05-04 12:09:47', '2025-05-04 12:10:00'),
(6, 1, 1, '2025-05-29', '2025-05-29', 'sdfasdfsadfasdfasdf', 'pending', '2025-05-04 12:21:38', '2025-05-04 12:21:38'),
(7, 4, 1, '2025-05-23', '2025-05-23', 'sdfasdfasdfasdfasdf', 'pending', '2025-05-04 12:21:57', '2025-05-04 12:21:57'),
(8, 6, 1, '2025-05-06', '2025-05-06', 'dfgdfgdfgdfgdfg', 'approved', '2025-05-04 13:26:25', '2025-05-04 13:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `maximum_days_per_year` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `description`, `maximum_days_per_year`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Casual Leave', 'Regular paid time off for personal reasons', 12, '2025-05-04 10:53:44', '2025-05-04 10:53:44', 1),
(2, 'Earned Leave', 'Accumulated leave based on service period', 30, '2025-05-04 10:53:44', '2025-05-04 10:53:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(8, '2024_03_14_000000', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1746356016, 1),
(9, '2024_03_14_000001', 'App\\Database\\Migrations\\CreateLeaveTypesTable', 'default', 'App', 1746356016, 1),
(10, '2024_03_14_000002', 'App\\Database\\Migrations\\CreateLeaveRequestsTable', 'default', 'App', 1746356016, 1),
(11, '2024_03_14_000003', 'App\\Database\\Migrations\\CreateLeaveBalancesTable', 'default', 'App', 1746356016, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$rJg7pYWFQOyl9Tp0bRXHcevfUvulc6PfSSQk8Ugz1OX/EKT2OAjSC', 1, '2025-05-04 10:53:44', '2025-05-04 10:53:44', 1),
(3, 'test1', 'test1@gmail.com', '$2y$10$iMQFkLfv/WpPx8tF5yS5.eOhOUs.WmYRY3y.BwavW2v.l78yqx9p6', 0, '2025-05-04 11:15:39', '2025-05-04 11:15:39', 1),
(4, 'test', 'test@gmail.com', '$2y$10$AkGVzIt83BY75ghchgD.guX1hHoju9IsYfZ1B8tHG777eSnYMz1Zy', 0, '2025-05-04 12:02:31', '2025-05-04 12:02:31', 1),
(5, 'test2', 'test2@gmail.com', '$2y$10$ZJMQAw2KmzIdN3oA9C8tguoT0v9T1xzrduXaqWpeT5HOqLSv62fXO', 0, '2025-05-04 12:10:40', '2025-05-04 12:10:40', 1),
(6, 'test3', 'test3@gmail.com', '$2y$10$pGXzk6T50y29eVCAZQAQOOEAIG6ve7ruK7z.NeYHnhOuR.cluHq6C', 0, '2025-05-04 12:19:16', '2025-05-04 16:44:10', 1),
(8, 'test4', 'test4@gmail.com', '$2y$10$k3RUR5ef/yIZpQn5E3Q6g.xrtne771Y3VMLuBgS/2yWUuMCWZIOkK', 0, '2025-05-04 12:52:19', '2025-05-04 12:52:19', 0),
(9, 'test5', 'test5@gmail.com', '$2y$10$r/BB6vPtCQgWLzzLz2sk8.IZTzbxJwnV0ZipzQIxVFsPzMTMWnXN6', 0, '2025-05-04 12:53:15', '2025-05-04 12:53:15', 0),
(11, 'test6', 'test6@gmail.com', '$2y$10$l8bIkMzjfXpEDeqyRs5zvO//8fEvjKSLOmQKRVilOAlmK67V1ZM6O', 0, '2025-05-04 12:56:49', '2025-05-04 12:56:49', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_balances_user_id_foreign` (`user_id`),
  ADD KEY `leave_balances_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_requests_user_id_foreign` (`user_id`),
  ADD KEY `leave_requests_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD CONSTRAINT `leave_balances_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
