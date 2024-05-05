-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 11:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `mess_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`sender_id`, `receiver_id`, `message`, `mess_time`) VALUES
(1, 2, 'MM', '2023-05-20 12:47:40'),
(1, 3, 'menna 11', '2023-05-20 08:02:50'),
(2, 1, 'cc', '2023-05-19 22:53:59'),
(2, 1, 'hi8', '2023-05-19 22:48:59'),
(2, 1, 'no2', '2023-05-19 22:53:14'),
(2, 1, 'no333', '2023-05-19 22:53:34'),
(2, 1, 'xx', '2023-05-19 22:54:12'),
(2, 1, 'yes', '2023-05-19 22:50:54'),
(3, 1, 'hello1', '2023-05-19 18:54:09'),
(3, 2, 'hello world', '2023-05-19 18:53:28'),
(3, 2, 'hi', '2023-05-19 18:53:01'),
(3, 2, 'no', '2023-05-19 18:53:39'),
(9, 1, 'hello mariem', '2023-05-20 08:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `friendship_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user_id`, `follower_id`, `friendship_date`) VALUES
(1, 2, '2023-05-19 23:15:43'),
(1, 3, '2023-05-19 09:19:47'),
(1, 10, '2023-05-20 12:21:30'),
(2, 1, '2023-05-18 17:28:50'),
(2, 9, '2023-05-20 08:09:32'),
(3, 2, '2023-05-19 19:07:27'),
(3, 9, '2023-05-20 08:11:24'),
(9, 10, '2023-05-20 12:22:33'),
(10, 3, '2023-05-20 13:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `token` char(64) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `token`, `user_id`) VALUES
(38, 'b3eaa4768f7c54f02d7fdf0b42841b8b81830ae7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_follow`
--

CREATE TABLE `page_follow` (
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(140) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `created_by`, `creation_date`, `likes`) VALUES
(1, 'hi', 1, '2023-05-20 01:09:25', 0),
(2, 'menna', 1, '2023-05-20 01:09:30', 1),
(5, 'post', 1, '2023-05-20 01:14:40', 2),
(6, 'mohamed', 2, '2023-05-19 23:35:37', 1),
(7, 'hi hi', 3, '2023-05-20 09:11:00', 3),
(8, 'hi3', 2, '2023-05-20 01:05:40', 2),
(9, 'hi', 2, '2023-05-20 01:05:43', 1),
(10, 'no', 2, '2023-05-20 09:00:35', 2),
(11, 'nancy !', 9, '2023-05-20 13:22:52', 2),
(12, 'DataBase', 10, '2023-05-20 13:19:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`post_id`, `user_id`) VALUES
(2, 3),
(5, 2),
(5, 3),
(6, 2),
(7, 2),
(7, 3),
(7, 9),
(8, 1),
(8, 2),
(9, 2),
(10, 1),
(10, 3),
(11, 9),
(11, 10),
(12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FName` varchar(35) NOT NULL,
  `LName` varchar(35) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `phone` char(11) NOT NULL,
  `pass` varchar(75) NOT NULL,
  `DOB` date NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FName`, `LName`, `Email`, `phone`, `pass`, `DOB`, `gender`) VALUES
(1, 'mariem', 'ali', 'mariem@gmail.com', '01278138616', '$2y$10$QN9IcoWl8la/yEj9XUCPtOzGIj7XAUGildCwl57XgSf/ip2c02Kcq', '2023-05-13', 'F'),
(2, 'mohamed', 'ahmed', 'mohamed@gmail.com', '01228138116', '$2y$10$TppbVOTfe54ZV0Jr9DonBOgiR2DTUfJOmpWGa9/rODQoXZ2mQh1uu', '2023-05-13', 'M'),
(3, 'menna', 'saed', 'menna@gmail.com', '01278138916', '$2y$10$i46DhQwH/niwLF0rd8AtPe.YmMNudelYnxu94NTc91O7bxAg4fMa.', '2002-09-03', 'F'),
(9, 'nancy', 'reda', 'nancy@gmail.com', '01278138915', '$2y$10$l3rsZNky5uhhMlAMUMB4f.K9os9yeVHTAWmr0XOUsiJvaTq3TqjDW', '2001-07-17', 'F'),
(10, 'Fady', 'Maged', 'f@gmail.com', '0123456789', '$2y$10$ua72rQ86eV/StGC4VkLkpOvjj8s/BKalIeU2P/mm/yW4OCl8qEY9O', '2023-05-09', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `time_shared_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`sender_id`,`receiver_id`,`message`,`mess_time`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user_id`,`follower_id`),
  ADD KEY `follwer_id` (`follower_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tocken` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `page_follow`
--
ALTER TABLE `page_follow`
  ADD PRIMARY KEY (`user_id`,`page_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`post_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`user_id`,`post_id`,`time_shared_created`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `page_follow`
--
ALTER TABLE `page_follow`
  ADD CONSTRAINT `page_follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `page_follow_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
