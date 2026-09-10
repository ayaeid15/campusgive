-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2026 at 01:32 PM
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
-- Database: `campusgive_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `college_name` varchar(150) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('pending','approved','reserved','completed','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `title`, `category`, `college_name`, `location`, `image`, `description`, `status`, `created_at`) VALUES
(1, 1, 'كتاب الحاسب الآلي والشبكات CCNA', 'كتب ومراجع', NULL, NULL, NULL, 'نسخة ممتازة بحالة جيدة جداً شاملة كل الفصول التدريبية.', 'approved', '2026-09-07 14:39:52'),
(2, 1, 'آلة حاسبة Casio FX-991EX', 'أدوات هندسية', NULL, NULL, NULL, 'آلة حاسبة علمية ممتازة للاختبارات والعمليات المتقدمة.', 'reserved', '2026-09-07 14:39:52'),
(3, 1, 'أدوات رسم هندسي متكاملة', 'أدوات هندسية', NULL, NULL, NULL, 'مسطرة T وفرجار مع باقي الأدوات بحالة ممتازة.', 'completed', '2026-09-07 14:39:52'),
(4, 7, 'كتاب برمجه لغه البايثون', 'كتب ومراجع', 'حاسبات و معلومات', 'جامعه القاهره', 'uploads/item_1788947819_6aa12d6b80846.png', 'كتاب برمجه لغه البايثون حاله ممتازه', 'pending', '2026-09-09 09:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'aya eid mousa', '2023209@kfs.edu.eg', '0102222222', '$2y$10$AoVwypUuosGG23fxZC2pOeD9.UZDwEHYPKnnWQEFlwmDzHxnhBviS', 'user', '2026-09-07 14:14:43'),
(2, 'نادين عبدالعليم الور', '2023209@euc.edu.eg', '0106666666', '$2y$10$W6DbaafkvkTnbwLhiKRlk.efulx8LD81FkREsFeeyoqkwJZqXY.XK', 'user', '2026-09-07 15:18:52'),
(3, 'رانيا عيد موسي', '2023210@euc.edu.eg', '014444', '$2y$10$KXJnL5vlVMv51f3J7UDeA.XCbIyLg8y5LXn6TKavxvpUhsn33/9Cy', 'user', '2026-09-07 15:28:04'),
(4, 'احمد محمد', '2023211@euc.edu.eg', '015555', '$2y$10$WMpvHqQbkMcPKPe6q19pxewRkjZ9LWJV1gABdQfk.tFYkLBRIq.FC', 'user', '2026-09-07 15:36:23'),
(5, 'فيروز', '2023220@euc.edu.eg', '010669999', '$2y$10$UA7TtJ/CJenF/oR/TGwHjOj0nTpW.qsz7IdZRGHcVHNPjR5c5WLI.', 'user', '2026-09-07 15:43:10'),
(6, 'صفاء', '2023222@euc.edu.eg', '0123444', '$2y$10$m/2390INYVbsUsr.CT.Lq.DgCURQGX98i/L4kyvZgE.GWRRxnl6Xu', 'user', '2026-09-07 15:46:05'),
(7, 'تسنيم اسامه عبدالفتاح', 'neemaelsamman2005@gmail.com', '01000000000', '$2y$10$YJ4qdmJ6lA7LRVwaft8uluk24RnYvFFQQKhiDNFmXe/vOSrvtIjDm', 'user', '2026-09-07 22:54:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_id` (`donation_id`),
  ADD KEY `requester_id` (`requester_id`);

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
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD CONSTRAINT `donation_requests_ibfk_1` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_requests_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
