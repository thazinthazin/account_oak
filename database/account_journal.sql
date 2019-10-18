-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:15 PM
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
-- Table structure for table `account_journal`
--

CREATE TABLE `account_journal` (
  `id` bigint(20) NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` bigint(10) NOT NULL,
  `defaultdebitaccountid` bigint(20) NOT NULL DEFAULT '0',
  `defaultcreditaccountid` bigint(20) NOT NULL DEFAULT '0',
  `nextnumber` decimal(10,0) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL DEFAULT '0',
  `modifiedby` int(11) NOT NULL DEFAULT '0',
  `createdon` bigint(10) NOT NULL DEFAULT '0',
  `modifiedon` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_journal`
--

INSERT INTO `account_journal` (`id`, `code`, `name`, `type`, `userid`, `defaultdebitaccountid`, `defaultcreditaccountid`, `nextnumber`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, 'INV', 'Sale Invoice', 'Sale', 0, 1, 2, '1', 0, 0, 0, 0),
(2, 'BILL', 'Purchase Bills', 'Purchase', 0, 1, 2, '2', 0, 0, 0, 0),
(3, 'BNK', 'Bank', 'Bank', 0, 1, 2, '3', 0, 0, 0, 0),
(4, 'CSH', 'Cash', 'Cash', 0, 1, 2, '4', 0, 0, 0, 0),
(5, 'EXCH', 'Exchange Difference', 'Miscellaneous', 0, 1, 2, '5', 0, 0, 0, 0),
(6, 'RF', 'Registration Fees', 'General', 0, 0, 0, '6', 0, 0, 0, 0),
(7, 'CF', 'Course Fees', 'General', 0, 0, 0, '7', 0, 0, 0, 0),
(8, 'ES', 'Expenses', 'General', 0, 0, 0, '8', 0, 0, 0, 0),
(9, 'PR', 'Payroll', 'General', 0, 0, 0, '9', 0, 0, 0, 0),
(10, 'COS', 'Cost of Sale', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(11, 'SL', 'Salaries', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(12, 'GE', 'General Expense', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(13, 'BE', 'Billing Expense', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(14, 'TS', 'Transportation', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(15, 'UF', 'Uniform', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(16, 'M&A', 'Marketing & Advertising', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(17, 'P&S', 'Printing & Stationery', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(18, 'R&M', 'Repair & Maintenance', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(19, 'TF', 'Training Fees', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0),
(20, 'OE', 'Other Expense', 'Expense', 0, 0, 0, '0', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_journal`
--
ALTER TABLE `account_journal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_journal`
--
ALTER TABLE `account_journal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
