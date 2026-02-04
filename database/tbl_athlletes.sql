-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 06:59 AM
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
-- Table structure for table `tbl_athlletes`
--

CREATE TABLE `tbl_athlletes` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `a_lrn` int(100) DEFAULT NULL,
  `a_event` varchar(100) DEFAULT NULL,
  `date_added` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `date_deleted` varchar(20) DEFAULT NULL,
  `deleted_by` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_athlletes`
--
ALTER TABLE `tbl_athlletes`
  ADD PRIMARY KEY (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_athlletes`
--
ALTER TABLE `tbl_athlletes`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
