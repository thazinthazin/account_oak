-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:59 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thuyeindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `journal_entry`
--

CREATE TABLE `journal_entry` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` text COLLATE utf8mb4_unicode_ci,
  `code` text COLLATE utf8mb4_unicode_ci,
  `date` bigint(10) DEFAULT NULL,
  `journalid` bigint(10) NOT NULL,
  `journalcode` text COLLATE utf8mb4_unicode_ci,
  `state` text COLLATE utf8mb4_unicode_ci,
  `userid` bigint(10) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `createdon` bigint(20) DEFAULT NULL,
  `modifiedon` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_entry`
--

INSERT INTO `journal_entry` (`id`, `name`, `ref`, `code`, `date`, `journalid`, `journalcode`, `state`, `userid`, `totalamount`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, '7', NULL, NULL, 1571247000, 7, NULL, NULL, 2, 55000, NULL, NULL, NULL, NULL),
(2, '2', NULL, NULL, 1571247000, 7, NULL, NULL, 2, 55000, NULL, NULL, NULL, NULL),
(3, '4', NULL, NULL, 1571247000, 6, NULL, NULL, 2, 55000, NULL, NULL, NULL, NULL),
(4, '5', NULL, NULL, 1571247000, 6, NULL, NULL, 2, 55000, NULL, NULL, NULL, NULL),
(5, '8', NULL, NULL, 1571247000, 7, NULL, NULL, 2, 55000, NULL, NULL, NULL, NULL),
(6, '1201862', NULL, NULL, 1571307803, 9, NULL, NULL, 2, 9000, NULL, NULL, NULL, NULL),
(7, '12018115', NULL, NULL, 1571307803, 9, NULL, NULL, 2, 180000, NULL, NULL, NULL, NULL),
(8, '12018114', NULL, NULL, 1571307803, 9, NULL, NULL, 2, 135000, NULL, NULL, NULL, NULL),
(9, '1201890', NULL, NULL, 1571307803, 9, NULL, NULL, 2, 477000, NULL, NULL, NULL, NULL),
(10, '1201858', NULL, NULL, 1571307803, 9, NULL, NULL, 2, 135000, NULL, NULL, NULL, NULL),
(11, 'fdfd', NULL, NULL, 1571349600, 15, NULL, NULL, 2, 20000, NULL, NULL, NULL, NULL),
(12, 'asdcasc', NULL, NULL, 1571263200, 11, NULL, NULL, 2, 100000, NULL, NULL, NULL, NULL),
(13, '2201890', NULL, NULL, 1571386831, 9, NULL, NULL, 2, 477000, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journal_entry`
--
ALTER TABLE `journal_entry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journal_entry`
--
ALTER TABLE `journal_entry`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
