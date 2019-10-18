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
-- Table structure for table `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `id` bigint(20) NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accounttypeid` bigint(20) NOT NULL,
  `createdby` int(11) NOT NULL DEFAULT '0',
  `modifiedby` int(11) NOT NULL DEFAULT '0',
  `createdon` bigint(10) NOT NULL DEFAULT '0',
  `modifiedon` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_account`
--

INSERT INTO `chart_of_account` (`id`, `code`, `name`, `accounttypeid`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, '100000', 'Account Receivable', 1, 0, 0, 0, 0),
(2, '111100', 'Account Payable', 2, 0, 0, 0, 0),
(3, '200000', 'Expenses', 6, 0, 0, 0, 0),
(4, '212200', 'Purchase of Equipments', 6, 0, 0, 0, 0),
(5, '101501', 'Cash', 3, 0, 0, 0, 0),
(6, '101401', 'Bank', 3, 0, 0, 0, 0),
(7, '205100', 'Product Sales', 4, 0, 0, 0, 0),
(8, '103000', 'Prepayments', 8, 0, 0, 0, 0),
(9, '220001', 'Transportation', 6, 0, 0, 0, 0),
(10, '102220', 'Income', 4, 0, 0, 0, 0),
(11, '223500', 'Defer Income', 4, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
