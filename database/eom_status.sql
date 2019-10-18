-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:16 PM
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
-- Table structure for table `eom_status`
--

CREATE TABLE `eom_status` (
  `id` bigint(10) NOT NULL,
  `payment_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_amount` decimal(10,0) NOT NULL,
  `eom_date` bigint(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL DEFAULT '0',
  `modifiedby` int(11) NOT NULL DEFAULT '0',
  `createdon` bigint(10) NOT NULL DEFAULT '0',
  `modifiedon` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eom_status`
--

INSERT INTO `eom_status` (`id`, `payment_no`, `monthly_amount`, `eom_date`, `status`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, '7', '50000', 1568712450, 0, 0, 0, 0, 0),
(2, '2', '10000', 1568713704, 0, 0, 0, 0, 0),
(3, '4', '20000', 1568712450, 1, 0, 0, 0, 0),
(5, '5', '30000', 1568712450, 1, 0, 0, 0, 0),
(6, '8', '20000', 1568712450, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eom_status`
--
ALTER TABLE `eom_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eom_status`
--
ALTER TABLE `eom_status`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
