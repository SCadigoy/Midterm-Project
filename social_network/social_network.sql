-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 09:45 AM
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
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(6) UNSIGNED NOT NULL,
  `post_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(18, 37, 12, 'hello', '2024-04-15 02:45:32'),
(19, 38, 12, 'fghjkllkjh', '2024-04-15 02:49:20'),
(20, 37, 12, 'hehehe', '2024-04-15 02:49:30'),
(21, 39, 13, 'Kaayo', '2024-04-15 08:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`) VALUES
(37, 12, 'hi', '2024-04-15 02:45:27'),
(38, 12, 'sdfghjklknb ', '2024-04-15 02:49:14'),
(39, 13, 'GWapa', '2024-04-15 08:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, ' ger', ' ger@gmail.com', '1234', '2024-04-12 09:33:26'),
(2, ' ger', ' ger@gmail.com', '1234', '2024-04-12 09:42:14'),
(3, ' ger', ' ger@gmail.com', '1234', '2024-04-12 10:23:54'),
(4, ' ger', ' ger@gmail.com', '1234', '2024-04-12 13:11:56'),
(5, ' ger', ' ger@gmail.com', '1234', '2024-04-12 14:48:38'),
(6, ' ger', ' ger@gmail.com', '1234', '2024-04-13 02:42:01'),
(7, 'Sheena', 'sheena@gmail.com', '$2y$10$hmaEg97wElv6OvV1lavNneNp7xzRZiOg5TzEmEB7JC1g2qN/r.uk2', '2024-04-13 08:23:53'),
(8, ' Fer', ' fer@gmail.com', '$2y$10$6/KaXbvoXjFBsnJfobrg8e61O1bIkrpcIHBgT.BjX19/e0Ev6E6Bu', '2024-04-13 08:32:32'),
(9, 'Jet', 'jet@gmail.com', '$2y$10$dj6mHz04iYJFN/YHKgvCPuCeP6MEWtFaGFda6u77fHHZmZZitFu/y', '2024-04-13 08:43:22'),
(10, 'Kev', 'kev@gmail.com', '$2y$10$P90aAZHezNNlpuZ0EIlPdOhMkdn.gPSBT8JPZakoGdnJrCZAP2PHa', '2024-04-14 13:18:16'),
(11, 'anna', 'anna@gmail.com', '$2y$10$t7tukf2/wlD4CKyq/bFd/.dtP0Nj2lgdcbdpJL0N54xgzHnV468Xy', '2024-04-15 01:18:43'),
(12, 'her', 'her@gmail.com', '$2y$10$ie6n2eRg60RqBlffAsVZeujSBW8.p0vrV8OLwMT3J6r3hd/ia3efC', '2024-04-15 02:45:07'),
(13, 'Jex', 'jex@gmail.com', '$2y$10$CIgG2gj1Ucz8TDdM1Iyc7Ou/DVg46r5dscPHXdHDE1A2HDGmKUHXS', '2024-04-15 08:45:58'),
(14, 'dev', 'dev@gmail.com', '$2y$10$6jcDdU/cjH6yLKApNOsKWeJsEO.ex4ed2bFdB9xINkp84FdnlzkcK', '2024-05-03 01:48:37'),
(15, 'kim', 'kim@gmail.com', '$2y$10$4FFZm9MOKcXwEXUhPX80NeWvUBkpKPSZSSCHkFdETnTOhfMLfdGaW', '2024-05-19 05:09:05'),
(16, 'hi', 'hi@gmail.com', '$2y$10$64t.p4Ktw.9EJSwgHG6o3eoVGghdvCfj8oZpjVxOSnbEEQdCzBWM2', '2024-05-23 01:27:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
