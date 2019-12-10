-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 19, 2019 at 10:54 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tododb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Todo`
--

CREATE TABLE `Todo` (
  `todo_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Todo`
--

INSERT INTO `Todo` (`todo_id`, `title`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'First todo', 'Donec rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', '2019-09-09 22:27:40', '2019-09-09 23:20:30', 1),
(3, 'Another todo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Proin eget tortor risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.', '2019-09-09 23:31:41', '2019-09-09 23:31:41', 1),
(4, 'Yet another todo', 'Nulla porttitor accumsan tincidunt. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus.', '2019-09-09 23:32:04', '2019-09-09 23:32:04', 1),
(6, 'SQL Injection Test', 'Proin eget tortor risus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt.', '2019-09-09 23:44:19', '2019-09-09 23:44:19', 3),
(7, 'Daily backup', 'Cras ultricies ligula sed magna dictum porta. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit.', '2019-09-09 23:49:42', '2019-09-13 18:26:13', 5),
(9, 'Installing chart.js', 'Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Sed porttitor lectus nibh. Donec rutrum congue leo eget malesuada.', '2019-09-18 23:50:11', '2019-09-18 23:50:11', 2),
(10, 'Integrating chart.js in PHP', 'Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Donec rutrum congue leo eget malesuada.', '2019-09-18 23:50:51', '2019-09-18 23:50:51', 2),
(11, 'GDG Kotlin Group', 'Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.', '2019-09-18 23:53:00', '2019-09-18 23:53:00', 3),
(12, 'Tweet with Debbie Kurata', 'Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus.', '2019-09-18 23:53:30', '2019-09-18 23:53:30', 3),
(13, 'Cracking the Coding Interview', 'Nulla quis lorem ut libero malesuada feugiat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.', '2019-09-18 23:54:18', '2019-09-18 23:54:18', 3),
(14, 'Good Grief!', 'Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat.', '2019-09-18 23:54:36', '2019-09-18 23:54:36', 3);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `fullname`, `email`, `password`) VALUES
(1, 'John Doe', 'johndoe@todo.com', 'passcode'),
(2, 'Mary Jane', 'maryjane@todo.com', 'openness'),
(3, 'Seun Olowogoke', 'seunolowogoke@todo.com', 'fugazy'),
(5, 'Admin', 'admin@todo.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Todo`
--
ALTER TABLE `Todo`
  ADD PRIMARY KEY (`todo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Todo`
--
ALTER TABLE `Todo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Todo`
--
ALTER TABLE `Todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
