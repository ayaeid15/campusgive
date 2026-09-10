-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 05:21 PM
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
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `college_name` varchar(150) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','approved','reserved','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `title`, `category`, `college_name`, `location`, `image`, `description`, `status`, `created_at`) VALUES
(1, 1, 'كتاب أساسيات الشبكات والاتصالات (Computer Networks)', 'كتب ومراجع', 'كلية الهندسة', 'المكتبة المركزية', 'networks_book.jpg', 'نسخة ممتازة بحالة جيدة جداً شاملة كل الفصول التدريبية.', 'approved', '2026-09-10 13:25:24'),
(2, 1, 'آلة حاسبة Casio fx-991', 'أدوات هندسية', 'كلية الهندسة', 'مبنى حاسبات', 'casio_calc.jpg', 'آلة حاسبة ممتازة للطلبة بحالة الجدة شغال فيها كل الزراير.', 'approved', '2026-09-10 13:25:24'),
(3, 1, 'أدوات رسم هندسي وتصميم', 'أدوات هندسية', 'كلية الهندسة', 'ورشة إعدادي', 'engineering_tools.jpg', 'طقم أدوات رسم هندسي كامل بحالة ممتازة.', 'approved', '2026-09-10 13:25:24'),
(4, 3, 'كتاب رياضيات هندسيه', 'كتب ومراجع', 'كليه الهندسه', 'قاعه5', 'uploads/item_1789051507_6aa2c2737f47b.jpg', 'بحاله جيده', 'pending', '2026-09-10 14:45:07'),
(5, 1, 'كتاب رياضايات', 'كتب ومراجع', 'كليه الهندسه', 'قاعه 8', 'uploads/item_1789053506_6aa2ca4254bd7.jpg', 'حاله جيده', 'pending', '2026-09-10 15:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_requests`
--

INSERT INTO `donation_requests` (`id`, `donation_id`, `requester_id`, `status`, `created_at`) VALUES
(1, 2, 3, 'pending', '2026-09-10 15:13:05'),
(2, 2, 4, 'pending', '2026-09-10 15:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'آية عيد موسى', 'aya@example.com', '01012345678', '123456', 'user', '2026-09-10 13:25:24'),
(2, 'ayaa', 'aya@gmail.com', '01233', '$2y$10$G8UVdtnw5ghuG1uMp.P7fO6xsWWl.G6inUX6FwPAhLDhLSUy0nvEK', 'user', '2026-09-10 14:41:18'),
(3, 'nada', 'nada@gmail.com', '01233', '$2y$10$6NWW./B6XknNrRjpL7yA6eGzV3qugbJbwfWkOY.wH9qhMJOMxh076', 'user', '2026-09-10 14:43:05'),
(4, 'ayaaa', '2023209@kfs.edu.eg', '0111', '$2y$10$mzLC24BkJflZlzdRzvx2ueK2X3zLG4WJZTmhU1cZIAviJ0ua5WWl.', 'user', '2026-09-10 15:15:55');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
