-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:17 PM
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
-- Table structure for table `journal_item`
--

CREATE TABLE `journal_item` (
  `id` bigint(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci,
  `quantity` decimal(10,0) DEFAULT NULL,
  `productid` bigint(10) NOT NULL,
  `uomid` bigint(10) DEFAULT NULL,
  `debit` decimal(10,0) NOT NULL DEFAULT '0',
  `credit` decimal(10,0) DEFAULT '0',
  `balance` decimal(10,0) DEFAULT NULL,
  `debitcashbasic` decimal(10,0) DEFAULT NULL,
  `creditcashbasic` decimal(10,0) DEFAULT NULL,
  `balancecashbasic` decimal(10,0) DEFAULT NULL,
  `accountid` bigint(10) NOT NULL,
  `journalentryid` bigint(10) NOT NULL,
  `ref` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `coacode` text COLLATE utf8mb4_unicode_ci,
  `currencycode` text COLLATE utf8mb4_unicode_ci,
  `entrytype` text COLLATE utf8mb4_unicode_ci,
  `journalid` bigint(10) NOT NULL,
  `paymentid` bigint(20) NOT NULL,
  `invoiceid` bigint(20) NOT NULL,
  `startdate` bigint(10) DEFAULT NULL,
  `enddate` bigint(10) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `createdon` bigint(10) DEFAULT NULL,
  `modifiedon` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_item`
--

INSERT INTO `journal_item` (`id`, `name`, `code`, `quantity`, `productid`, `uomid`, `debit`, `credit`, `balance`, `debitcashbasic`, `creditcashbasic`, `balancecashbasic`, `accountid`, `journalentryid`, `ref`, `description`, `coacode`, `currencycode`, `entrytype`, `journalid`, `paymentid`, `invoiceid`, `startdate`, `enddate`, `createdby`, `modifiedby`, `createdon`, `modifiedon`) VALUES
(1, '7', NULL, NULL, 19, NULL, '55000', '0', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 65, NULL, NULL, NULL, NULL, 1571247000, NULL),
(2, '7', NULL, NULL, 19, NULL, '0', '55000', NULL, NULL, NULL, NULL, 11, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 65, NULL, NULL, NULL, NULL, 1571247000, NULL),
(3, '7', NULL, NULL, 19, NULL, '0', '0', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 65, NULL, NULL, NULL, NULL, 1571247000, NULL),
(4, '7', NULL, NULL, 19, NULL, '0', '0', NULL, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 65, NULL, NULL, NULL, NULL, 1571247000, NULL),
(5, '7', NULL, NULL, 19, NULL, '0', '50000', NULL, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, NULL, NULL, 6, 24, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(6, '7', NULL, NULL, 19, NULL, '50000', '0', NULL, NULL, NULL, NULL, 11, 1, NULL, NULL, NULL, NULL, NULL, 6, 24, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(9, '7', NULL, NULL, 19, NULL, '0', '50000', NULL, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, NULL, NULL, 6, 24, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(10, '7', NULL, NULL, 19, NULL, '50000', '0', NULL, NULL, NULL, NULL, 11, 1, NULL, NULL, NULL, NULL, NULL, 6, 24, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(11, '7', NULL, NULL, 19, NULL, '0', '10000', NULL, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 0, NULL, NULL, NULL, NULL, 1568713704, NULL),
(12, '7', NULL, NULL, 19, NULL, '10000', '0', NULL, NULL, NULL, NULL, 11, 1, NULL, NULL, NULL, NULL, NULL, 7, 24, 0, NULL, NULL, NULL, NULL, 1568713704, NULL),
(13, '4', NULL, NULL, 19, NULL, '0', '20000', NULL, NULL, NULL, NULL, 10, 3, NULL, NULL, NULL, NULL, NULL, 7, 4, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(14, '4', NULL, NULL, 19, NULL, '20000', '0', NULL, NULL, NULL, NULL, 11, 3, NULL, NULL, NULL, NULL, NULL, 7, 4, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(15, '5', NULL, NULL, 18, NULL, '0', '30000', NULL, NULL, NULL, NULL, 10, 4, NULL, NULL, NULL, NULL, NULL, 7, 5, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(16, '5', NULL, NULL, 18, NULL, '30000', '0', NULL, NULL, NULL, NULL, 11, 4, NULL, NULL, NULL, NULL, NULL, 7, 5, 0, NULL, NULL, NULL, NULL, 1568712450, NULL),
(17, '1201862', NULL, NULL, 4, NULL, '9000', '0', NULL, NULL, NULL, NULL, 3, 6, NULL, NULL, NULL, NULL, NULL, 9, 40, 40, NULL, NULL, NULL, NULL, 1571307803, NULL),
(18, '1201862', NULL, NULL, 4, NULL, '0', '9000', NULL, NULL, NULL, NULL, 5, 6, NULL, NULL, NULL, NULL, NULL, 9, 40, 40, NULL, NULL, NULL, NULL, 1571307803, NULL),
(19, '12018115', NULL, NULL, 4, NULL, '180000', '0', NULL, NULL, NULL, NULL, 3, 7, NULL, NULL, NULL, NULL, NULL, 9, 41, 41, NULL, NULL, NULL, NULL, 1571307803, NULL),
(20, '12018115', NULL, NULL, 4, NULL, '0', '180000', NULL, NULL, NULL, NULL, 5, 7, NULL, NULL, NULL, NULL, NULL, 9, 41, 41, NULL, NULL, NULL, NULL, 1571307803, NULL),
(21, '12018114', NULL, NULL, 4, NULL, '135000', '0', NULL, NULL, NULL, NULL, 3, 8, NULL, NULL, NULL, NULL, NULL, 9, 42, 42, NULL, NULL, NULL, NULL, 1571307803, NULL),
(22, '12018114', NULL, NULL, 4, NULL, '0', '135000', NULL, NULL, NULL, NULL, 5, 8, NULL, NULL, NULL, NULL, NULL, 9, 42, 42, NULL, NULL, NULL, NULL, 1571307803, NULL),
(23, '1201890', NULL, NULL, 3, NULL, '477000', '0', NULL, NULL, NULL, NULL, 3, 9, NULL, NULL, NULL, NULL, NULL, 9, 43, 43, NULL, NULL, NULL, NULL, 1571307803, NULL),
(24, '1201890', NULL, NULL, 3, NULL, '0', '477000', NULL, NULL, NULL, NULL, 5, 9, NULL, NULL, NULL, NULL, NULL, 9, 43, 43, NULL, NULL, NULL, NULL, 1571307803, NULL),
(25, '1201858', NULL, NULL, 4, NULL, '135000', '0', NULL, NULL, NULL, NULL, 3, 10, NULL, NULL, NULL, NULL, NULL, 9, 44, 44, NULL, NULL, NULL, NULL, 1571307803, NULL),
(26, '1201858', NULL, NULL, 4, NULL, '0', '135000', NULL, NULL, NULL, NULL, 5, 10, NULL, NULL, NULL, NULL, NULL, 9, 44, 44, NULL, NULL, NULL, NULL, 1571307803, NULL),
(27, 'fdfd', NULL, NULL, 1, NULL, '20000', '0', NULL, NULL, NULL, NULL, 3, 11, NULL, NULL, NULL, NULL, NULL, 15, 1, 1, NULL, NULL, NULL, NULL, 1571349600, NULL),
(28, 'fdfd', NULL, NULL, 1, NULL, '0', '20000', NULL, NULL, NULL, NULL, 5, 11, NULL, NULL, NULL, NULL, NULL, 15, 1, 1, NULL, NULL, NULL, NULL, 1571349600, NULL),
(29, 'asdcasc', NULL, NULL, 1, NULL, '100000', '0', NULL, NULL, NULL, NULL, 3, 12, NULL, NULL, NULL, NULL, NULL, 11, 1, 1, NULL, NULL, NULL, NULL, 1571263200, NULL),
(30, 'asdcasc', NULL, NULL, 1, NULL, '0', '100000', NULL, NULL, NULL, NULL, 5, 12, NULL, NULL, NULL, NULL, NULL, 11, 1, 1, NULL, NULL, NULL, NULL, 1571263200, NULL),
(31, '2201890', NULL, NULL, 3, NULL, '477000', '0', NULL, NULL, NULL, NULL, 3, 13, NULL, NULL, NULL, NULL, NULL, 9, 45, 45, NULL, NULL, NULL, NULL, 1571386831, NULL),
(32, '2201890', NULL, NULL, 3, NULL, '0', '477000', NULL, NULL, NULL, NULL, 5, 13, NULL, NULL, NULL, NULL, NULL, 9, 45, 45, NULL, NULL, NULL, NULL, 1571386831, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journal_item`
--
ALTER TABLE `journal_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journalentryid` (`journalentryid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journal_item`
--
ALTER TABLE `journal_item`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `journal_item`
--
ALTER TABLE `journal_item`
  ADD CONSTRAINT `journal_item_ibfk_1` FOREIGN KEY (`journalentryid`) REFERENCES `journal_entry` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
