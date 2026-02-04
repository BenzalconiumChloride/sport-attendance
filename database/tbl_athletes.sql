-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 07:19 AM
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
-- Table structure for table `tbl_athletes`
--

CREATE TABLE `tbl_athletes` (
  `aid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `a_lrn` int(100) DEFAULT NULL,
  `a_event` varchar(100) DEFAULT NULL,
  `date_added` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0,
  `date_deleted` varchar(20) DEFAULT NULL,
  `deleted_by` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_athletes`
--

INSERT INTO `tbl_athletes` (`aid`, `cid`, `firstname`, `lastname`, `a_lrn`, `a_event`, `date_added`, `is_deleted`, `date_deleted`, `deleted_by`) VALUES
(1, 0, 'hot', 'dog', 1223345, 'training', '2026-02-04 14:16:33', 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_athletes`
--
ALTER TABLE `tbl_athletes`
  ADD PRIMARY KEY (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_athletes`
--
ALTER TABLE `tbl_athletes`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
