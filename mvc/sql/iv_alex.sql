-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2021 at 08:52 AM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iv_alex`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(258) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `text`) VALUES
(1, 'user', 'test@test.ru', 'sadfad asdf asdfas asdfsdf asdf asfd s dfasdfasdf asdf asdf asd fasd fasdf'),
(2, 'Mikhail', 'test1@test.ru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.\r\n        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,\r\n        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!\r\n        FOOBAR'),
(3, 'Mikhail', 'test@test.ru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.\r\n        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,\r\n        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!\r\n        FOOBAR'),
(6, 'Mikhail', 'Mikhail@test.ru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.\r\n        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,\r\n        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!\r\n        FOOBAR');

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `status` enum('complete','edited') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `task_id`, `status`) VALUES
(1, 1, 'complete'),
(2, 3, 'complete'),
(3, 3, 'edited');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `auth_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pwd_hash`, `role`, `auth_token`) VALUES
(2, 'user', 'temp1@logycon.ru', '123', 'user', ''),
(3, 'liga', 'tempaa@logycon.ru', '$2y$10$XLxsI7Au9..o8GADDEV7yeIRnPRH9sLqikmdXV4cew7J4/g9N4jiu', 'user', 'fdb2e488a772acd0f6262d804472840ac8261092906af9d3490c10c1f55ebdd1ea3ef3f2b5597149'),
(4, 'admin', 'temp@logycon.ru', '$2y$10$2pGmHdVkL8chssD5P/fJxutusuxgMO4oNxXiLhB.o0dHjt24E2Jt2', 'user', 'aff107ec9c472607834abb1e0ed4a0635b538d549341f10e3bdaf66583b112280bfeeb416b465afc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_id` (`task_id`,`status`);

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task_status`
--
ALTER TABLE `task_status`
  ADD CONSTRAINT `fk_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
