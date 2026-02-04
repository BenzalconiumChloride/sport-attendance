-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 03:45 AM
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
-- Database: `db_sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `bs_setting`
--

CREATE TABLE `bs_setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `directory` varchar(100) NOT NULL DEFAULT '',
  `admin_dir` varchar(70) NOT NULL,
  `system_title` varchar(100) NOT NULL DEFAULT '',
  `abrv` varchar(70) NOT NULL DEFAULT '',
  `year_developed` year(4) NOT NULL,
  `description` text NOT NULL,
  `developer` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_setting`
--

INSERT INTO `bs_setting` (`setting_id`, `directory`, `admin_dir`, `system_title`, `abrv`, `year_developed`, `description`, `developer`, `website`) VALUES
(1001, 'sports-attemndance', 'sports-attendance', 'sports-attendance', 'SA', '2026', '', 'Benz Lozada', 'https://benzalconiumchloride.github.io/benz-lozada/');

-- --------------------------------------------------------

--
-- Table structure for table `bs_user`
--

CREATE TABLE `bs_user` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `date_added` varchar(50) DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `date_modified` varchar(50) DEFAULT NULL,
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `date_deleted` varchar(50) DEFAULT NULL,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uid` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bs_user`
--

INSERT INTO `bs_user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `date_added`, `added_by`, `date_modified`, `modified_by`, `date_deleted`, `deleted_by`, `is_deleted`, `last_login`, `uid`) VALUES
(4, 'Ronald', 'Tangguan', 'ronald@gmail.com', '$2y$10$3L4FOlaoc6tLAtncIJnYgOJJfUMDQdBqSLO.MZIYlIPGa0msBfMWK', '2024-11-26 13:40:23', 1, NULL, 0, NULL, 0, 0, '2025-03-03 06:09:46', 'a87ff679a2f3e71d9181a67b7542122c'),
(5, 'Benz', 'Lozada', 'benz@gmail.com', '$2y$10$Ak9bkFuEtCGZPIZkF5A4rObu7yF8qh.C0LxTHaksnF5tnkkOHjdQq', '2024-11-26 13:41:04', 1, NULL, 0, NULL, 0, 0, '2026-02-04 02:27:21', 'e4da3b7fbbce2345d7772b0674a318d5'),
(6, 'Kevin', 'Cortez', 'kevin@gmail.com', '$2y$10$OrZmObNRQApwT4l6llgNZObwWTLSJOImTk4FxRKEDQaD7Gwgmtia.', '2024-11-26 13:43:41', 1, NULL, 0, NULL, 0, 0, '2024-11-26 07:39:16', '1679091c5a880faf6fb5e6087eb1b2dc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bs_setting`
--
ALTER TABLE `bs_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `bs_user`
--
ALTER TABLE `bs_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bs_setting`
--
ALTER TABLE `bs_setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `bs_user`
--
ALTER TABLE `bs_user`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
