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
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `Id` bigint(20) NOT NULL,
  `accounttypename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL DEFAULT '0',
  `modifiedby` int(11) NOT NULL DEFAULT '0',
  `createdon` bigint(10) NOT NULL DEFAULT '0',
  `modifiedon` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`Id`, `accounttypename`, `type`, `code`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, 'Receivable', 'Receivable', 'AR01', 0, 0, 0, 0),
(2, 'Payable', 'Payable', 'P01', 0, 0, 0, 0),
(3, 'Bank & Cash', 'Liquidity', 'BC01', 0, 0, 0, 0),
(4, 'Income', 'Other', 'IN01', 0, 0, 0, 0),
(5, 'Current Liabilities', 'Other', 'CL01', 0, 0, 0, 0),
(6, 'Expenses', 'Other', 'E01', 0, 0, 0, 0),
(7, 'Credit Card', 'Liquidity', 'CC01', 0, 0, 0, 0),
(8, 'Prepayments', 'Other', 'PP01', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
