-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 04:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(6, 'John Lloyd', 'Pedilo', 'Lloyd@gmail.com', '$2y$10$OrZmObNRQApwT4l6llgNZObwWTLSJOImTk4FxRKEDQaD7Gwgmtia.', '2024-11-26 13:43:41', 1, NULL, 0, NULL, 0, 0, '2026-02-04 02:55:55', '1679091c5a880faf6fb5e6087eb1b2dc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_athlletes`
--

CREATE TABLE `tbl_athlletes` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `a_lrn` int(100) NOT NULL,
  `a_event` varchar(100) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `date_deleted` varchar(20) NOT NULL,
  `deleted_by` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `check_in_time` datetime NOT NULL,
  `is_login` int(2) NOT NULL DEFAULT 0,
  `check_out_time` datetime DEFAULT NULL,
  `date_recorded` date NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coaches`
--

CREATE TABLE `tbl_coaches` (
  `cid` int(11) NOT NULL,
  `c_fullname` varchar(100) NOT NULL,
  `c_empid` int(100) NOT NULL,
  `c_event` varchar(100) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `date_deleted` varchar(20) NOT NULL,
  `deleted_by` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `tbl_athlletes`
--
ALTER TABLE `tbl_athlletes`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `aid` (`aid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `tbl_coaches`
--
ALTER TABLE `tbl_coaches`
  ADD PRIMARY KEY (`cid`);

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

--
-- AUTO_INCREMENT for table `tbl_athlletes`
--
ALTER TABLE `tbl_athlletes`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_coaches`
--
ALTER TABLE `tbl_coaches`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
