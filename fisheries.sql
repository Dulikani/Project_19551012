-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2023 at 03:17 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fisheries`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_donations`
--

CREATE TABLE `approval_donations` (
  `ApprovalID` int(11) NOT NULL,
  `DonationID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `DonationType` varchar(30) NOT NULL,
  `Amount` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ApprovalDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ApprovalBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_donations`
--

INSERT INTO `approval_donations` (`ApprovalID`, `DonationID`, `MemberID`, `AccNo`, `DonationType`, `Amount`, `CreatedDate`, `ApprovalDate`, `ApprovalBy`, `Status`) VALUES
(1, 1, 1, 1, '', 0, '', '2022-11-24 23:20:56', 2, 'Passed'),
(2, 2, 3, 3, '', 0, '', '2022-11-24 23:20:59', 2, 'Passed'),
(3, 3, 5, 5, '', 0, '', '2022-11-25 07:59:24', 1, 'BOD Rejected'),
(4, 4, 4, 4, '', 0, '', '2022-11-25 08:07:23', 2, 'Passed'),
(5, 5, 8, 8, '', 0, '', '2022-11-25 14:53:42', 2, 'Passed'),
(6, 6, 6, 6, '', 0, '', '2022-11-25 16:03:34', 2, 'Passed'),
(7, 7, 7, 7, '', 0, '', '2022-11-25 16:03:44', 2, 'Passed'),
(8, 8, 11, 12, '', 0, '', '2022-11-25 17:10:09', 2, 'Passed'),
(9, 9, 9, 10, '', 0, '', '2022-11-26 11:02:36', 2, 'Passed'),
(10, 10, 10, 11, '', 0, '', '2022-11-26 11:02:41', 1, 'BOD Rejected'),
(11, 11, 14, 15, ' Medical Donation', 10000, ' 2022-11-26 04:10:17', '2022-12-27 19:57:07', 3, 'Passed'),
(12, 12, 15, 16, ' Medical Donation', 10000, ' 2022-11-26 04:10:31', '2022-12-27 19:57:11', 3, 'Passed'),
(13, 13, 17, 14, ' Medical Donation', 15000, ' 2022-11-26 11:00:09', '2022-12-28 19:37:18', 3, 'Passed'),
(14, 14, 11, 12, ' Medical Donation', 15000, ' 2022-12-28 19:35:44', '2022-12-28 19:37:23', 3, 'Passed'),
(15, 17, 16, 13, ' Medical Donation', 12000, ' 2023-01-05 11:31:01', '2023-01-05 12:14:03', 3, 'BOD Approved'),
(16, 15, 12, 17, ' Medical Donation', 18000, ' 2022-12-28 19:36:14', '2023-01-06 18:31:19', 2, 'BOD Approved'),
(17, 16, 13, 18, ' Medical Donation', 20000, ' 2022-12-28 19:36:37', '2023-01-07 08:56:03', 2, 'BOD Approved');

-- --------------------------------------------------------

--
-- Table structure for table `approval_loans`
--

CREATE TABLE `approval_loans` (
  `ApprovalID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `LoanType` varchar(30) NOT NULL,
  `Amount` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ApprovalDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ApprovalBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_loans`
--

INSERT INTO `approval_loans` (`ApprovalID`, `LoanID`, `MemberID`, `AccNo`, `LoanType`, `Amount`, `CreatedDate`, `ApprovalDate`, `ApprovalBy`, `Status`) VALUES
(1, 1, 1, 1, ' Personal Loan', 10000, ' 2022-11-24 22:09:26', '2022-11-24 23:02:34', 2, 'Passed'),
(2, 3, 3, 3, ' Personal Loan', 15000, ' 2022-11-24 22:53:55', '2022-11-24 23:05:43', 2, 'Passed'),
(3, 4, 5, 5, ' Vehicle Loan', 50000, ' 2022-11-24 22:54:16', '2022-11-24 23:06:30', 2, 'Passed'),
(4, 5, 8, 8, ' Personal Loan', 15000, ' 2022-11-24 23:12:34', '2022-11-24 23:13:28', 2, 'Passed'),
(5, 6, 4, 4, ' Personal Loan', 10000, ' 2022-11-25 08:00:56', '2022-11-25 08:07:29', 2, 'Passed'),
(6, 7, 9, 10, ' Personal Loan', 25000, ' 2022-11-25 14:49:45', '2022-11-25 14:53:50', 2, 'Passed'),
(7, 8, 8, 8, ' Personal Loan', 15000, ' 2022-11-25 15:39:49', '2022-11-25 16:02:37', 2, 'Passed'),
(8, 9, 9, 10, ' Personal Loan', 10000, ' 2022-11-25 16:00:15', '2022-11-25 16:03:15', 2, 'Passed'),
(9, 10, 10, 11, ' Personal Loan', 15000, ' 2022-11-25 17:06:50', '2022-11-25 17:09:52', 2, 'Passed'),
(10, 11, 11, 12, ' Personal Loan', 10000, ' 2022-11-25 20:00:08', '2022-11-26 11:01:54', 2, 'Passed'),
(11, 13, 15, 16, ' Personal Loan', 10000, ' 2022-11-26 04:09:31', '2022-11-26 11:02:21', 2, 'Passed'),
(12, 12, 14, 15, ' Personal Loan', 10000, ' 2022-11-26 04:09:11', '2022-12-27 23:12:41', 3, 'Passed'),
(13, 14, 17, 14, ' Personal Loan', 15000, ' 2022-11-26 10:59:19', '2022-12-27 23:13:18', 3, 'Passed'),
(14, 15, 16, 13, ' Personal Loan', 15000, ' 2022-11-26 11:28:16', '2022-12-27 23:13:34', 3, 'Passed'),
(15, 16, 16, 13, ' Personal Loan', 15000, ' 2022-12-27 23:12:22', '2022-12-28 11:55:20', 3, 'Passed'),
(16, 17, 7, 7, ' Personal Loan', 15000, ' 2022-12-31 23:52:42', '2023-01-05 08:33:43', 3, 'Passed'),
(17, 18, 6, 6, ' Vehicle Loan', 21000, ' 2022-12-31 23:53:51', '2023-01-05 16:03:28', 3, 'Passed'),
(18, 19, 12, 17, ' Personal Loan', 20000, ' 2023-01-05 07:13:08', '2023-01-05 16:22:58', 3, 'BOD Approved'),
(19, 20, 18, 20, ' Personal Loan', 15000, ' 2023-01-05 15:46:42', '2023-01-05 16:23:09', 3, 'BOD Approved'),
(20, 21, 19, 21, ' Personal Loan', 15000, ' 2023-01-05 16:23:41', '2023-01-07 08:55:48', 2, 'BOD Approved');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `TransactionID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `TransType` varchar(30) NOT NULL,
  `Amount` int(11) NOT NULL,
  `RunningBal` int(11) NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`TransactionID`, `AccNo`, `TransType`, `Amount`, `RunningBal`, `TransactionDate`, `Description`) VALUES
(1, 0, 'Credit', 300000, 300000, '2022-11-24 22:50:54', 'NGO Donations'),
(2, 0, 'Credit', 125000, 425000, '2022-11-24 22:51:10', 'Petrol shed income'),
(3, 0, 'Credit', 50000, 475000, '2022-11-24 22:51:39', 'Photocopy center income'),
(4, 0, 'Credit', 180000, 655000, '2022-11-24 22:51:53', 'Canteen income'),
(5, 0, 'Debit', 10700, 644300, '2022-11-24 22:52:20', 'Monthly bill payments'),
(6, 1, 'Debit', 10000, 634300, '2022-11-24 23:07:38', 'Personal Loan'),
(7, 3, 'Debit', 15000, 619300, '2022-11-24 23:07:59', 'Personal Loan'),
(8, 5, 'Debit', 17500, 601800, '2022-11-24 23:10:28', 'Member Pawning'),
(9, 0, 'Credit', 150000, 751800, '2022-11-25 07:30:36', 'Petrol shed income'),
(10, 5, 'Debit', 50000, 701800, '2022-11-25 08:38:43', 'Vehicle Loan'),
(11, 8, 'Debit', 15000, 686800, '2022-11-25 08:45:50', 'Personal Loan'),
(12, 4, 'Debit', 20000, 666800, '2022-11-25 10:14:29', 'Medical Donation'),
(13, 1, 'Debit', 10000, 656800, '2022-11-25 10:15:36', 'Medical Donation'),
(14, 3, 'Debit', 5000, 651800, '2022-11-25 10:20:40', 'Medical Donation'),
(15, 3, 'Debit', 26250, 625550, '2022-11-25 10:53:25', 'Member Pawning'),
(16, 10, 'Debit', 25000, 600550, '2022-11-25 14:56:54', 'Personal Loan'),
(17, 5, 'Debit', 17500, 583050, '2022-11-25 15:08:00', 'Non Member Pawning'),
(18, 4, 'Debit', 26250, 556800, '2022-11-25 15:13:35', 'Member Pawning'),
(19, 5, 'Debit', 17500, 539300, '2022-11-25 15:14:25', 'Member Pawning'),
(20, 6, 'Debit', 26250, 513050, '2022-11-25 15:14:53', 'Member Pawning'),
(21, 1, 'Debit', 8750, 504300, '2022-11-25 15:15:42', 'Member Pawning'),
(22, 0, 'Credit', 100000, 604300, '2022-11-25 16:01:41', 'Canteen income'),
(23, 4, 'Debit', 10000, 594300, '2022-11-25 16:05:13', 'Personal Loan'),
(24, 7, 'Debit', 17500, 576800, '2022-11-25 16:10:51', 'Member Pawning'),
(25, 0, 'Credit', 100000, 676800, '2022-11-25 17:08:27', 'Petrol shed income'),
(26, 8, 'Debit', 15000, 661800, '2022-11-25 17:11:10', 'Personal Loan'),
(27, 12, 'Debit', 15000, 646800, '2022-11-25 17:11:59', 'Medical Donation'),
(28, 0, 'Credit', 125000, 771800, '2022-11-25 20:03:20', 'Canteen income'),
(29, 0, 'Credit', 150000, 921800, '2022-11-25 20:03:32', 'Photocopy center income'),
(30, 0, 'Debit', 6500, 915300, '2022-11-25 20:03:54', 'bill payments'),
(31, 7, 'Debit', 15000, 900300, '2022-11-25 20:19:17', 'Medical Donation'),
(32, 0, 'Credit', 120000, 1020300, '2022-11-26 11:00:51', 'Petrol shed income'),
(33, 10, 'Debit', 10000, 1010300, '2022-11-26 11:04:06', 'Personal Loan'),
(34, 11, 'Debit', 15000, 995300, '2022-11-26 11:04:43', 'Personal Loan'),
(35, 8, 'Debit', 15000, 980300, '2022-11-26 11:05:14', 'Medical Donation'),
(36, 6, 'Debit', 15000, 965300, '2022-11-26 11:05:22', 'Medical Donation'),
(37, 14, 'Debit', 17500, 947800, '2022-11-26 11:07:39', 'Member Pawning'),
(38, 0, 'Credit', 100000, 1047800, '2022-11-26 11:13:23', 'Canteen income'),
(39, 0, 'Debit', 1500, 1046300, '2022-12-11 06:29:39', 'Electricity bill'),
(40, 0, 'Credit', 165000, 1211300, '2022-12-11 06:34:34', 'Canteen income'),
(41, 6, 'Debit', 17500, 1193800, '2022-12-25 12:24:26', 'Member Pawning'),
(42, 6, 'Debit', 17500, 1176300, '2022-12-25 20:13:02', 'Member Pawning'),
(43, 10, 'Debit', 15000, 1161300, '2022-12-27 19:55:13', 'Medical Donation'),
(44, 12, 'Debit', 10000, 1151300, '2022-12-27 23:14:00', 'Personal Loan'),
(45, 16, 'Debit', 10000, 1141300, '2022-12-27 23:14:10', 'Personal Loan'),
(46, 15, 'Debit', 10000, 1131300, '2022-12-28 19:37:45', 'Medical Donation'),
(47, 16, 'Debit', 10000, 1121300, '2022-12-28 19:37:54', 'Medical Donation'),
(48, 7, 'Debit', 17500, 1103800, '2022-12-28 21:00:59', 'Non Member Pawning'),
(49, 17, 'Debit', 17500, 1086300, '2023-01-02 20:01:19', 'Member Pawning'),
(50, 15, 'Debit', 10000, 1076300, '2023-01-05 09:44:41', 'Personal Loan'),
(51, 14, 'Debit', 15000, 1061300, '2023-01-05 09:44:51', 'Personal Loan'),
(52, 14, 'Debit', 15000, 1046300, '2023-01-05 12:38:59', 'Medical Donation'),
(53, 13, 'Debit', 15000, 1031300, '2023-01-05 16:19:04', 'Personal Loan'),
(54, 13, 'Debit', 15000, 1016300, '2023-01-05 16:19:16', 'Personal Loan'),
(55, 0, 'Debit', 12000, 1004300, '2023-01-05 18:35:00', 'Electricity bill'),
(56, 0, 'Credit', 100000, 1104300, '2023-01-05 18:35:25', 'Petrol shed income'),
(57, 0, 'Credit', 150000, 1254300, '2023-01-05 18:35:49', 'Photocopy center income'),
(58, 0, 'Debit', 10000, 1244300, '2023-01-05 18:36:13', 'Telephone bill'),
(59, 7, 'Debit', 17500, 1226800, '2023-01-06 02:46:56', 'Member Pawning'),
(60, 0, 'Credit', 120000, 1346800, '2023-01-06 18:30:19', 'Canteen income'),
(61, 7, 'Debit', 15000, 1331800, '2023-01-06 18:32:50', 'Personal Loan'),
(62, 8, 'Debit', 8750, 1323050, '2023-01-06 18:41:10', 'Member Pawning'),
(63, 12, 'Debit', 15000, 1308050, '2023-01-06 18:46:07', 'Medical Donation'),
(64, 0, 'Credit', 50000, 1358050, '2023-01-06 19:01:19', 'Petrol shed income'),
(65, 20, 'Debit', 26250, 1331800, '2023-01-06 19:56:57', 'Member Pawning'),
(66, 23, 'Debit', 17500, 1314300, '2023-01-07 02:39:27', 'Member Pawning'),
(67, 0, 'Credit', 100000, 1414300, '2023-01-07 08:55:00', 'Petrol shed income'),
(68, 6, 'Debit', 21000, 1393300, '2023-01-07 08:57:28', 'Vehicle Loan'),
(69, 27, 'Debit', 17500, 1375800, '2023-01-07 08:59:19', 'Member Pawning');

-- --------------------------------------------------------

--
-- Table structure for table `donationtobod`
--

CREATE TABLE `donationtobod` (
  `BODID` int(11) NOT NULL,
  `DonationID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccountNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationtobod`
--

INSERT INTO `donationtobod` (`BODID`, `DonationID`, `MemberID`, `AccountNo`) VALUES
(1, 1, 1, 1),
(2, 2, 3, 3),
(3, 3, 5, 5),
(4, 4, 4, 4),
(5, 5, 8, 8),
(6, 7, 7, 7),
(7, 6, 6, 6),
(8, 8, 11, 12),
(9, 9, 9, 10),
(10, 10, 10, 11),
(11, 13, 17, 14),
(12, 12, 15, 16),
(13, 11, 14, 15),
(14, 14, 11, 12),
(15, 15, 12, 17),
(16, 16, 13, 18),
(17, 17, 16, 13),
(18, 18, 18, 20),
(19, 19, 19, 21),
(20, 20, 21, 23),
(21, 21, 22, 24);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_ID` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `addres` varchar(100) NOT NULL,
  `salary` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_ID`, `nic`, `first_name`, `last_name`, `gender`, `birthdate`, `age`, `contact_no`, `addres`, `salary`) VALUES
(1, '200214512365', 'Sahan', 'Perera', 'Male', '2015-09-08', 7, 775632410, 'Seeduwa', '40000'),
(2, '200215638940', 'Ashen', 'Jayawardena', 'Male', '2000-02-04', 22, 714456328, 'Kalutara', '45000'),
(3, '196325987451', 'Saman', 'Alwis', 'Male', '1963-10-25', 59, 714445986, 'Kandana', '45000'),
(4, '196852326551', 'Kumari', 'De Silva', 'Female', '1968-08-05', 54, 773551011, 'Kadawatha', '25000'),
(5, '198236524789', 'Kasuni', 'Pathirana', 'Female', '1982-10-02', 40, 715426358, 'Seeduwa', '35000'),
(7, '199752365236', 'Nirosha', 'Bandara', 'Male', '1997-01-25', 25, 742563125, 'Kaduwela', '34000'),
(8, '198999999999', 'Natasha', 'Perera', 'Female', '1989-12-05', 32, 715236412, 'Seeduwa', '36000'),
(9, '200520052005', 'Sashen', 'De Silva', 'Male', '2005-12-01', 17, 752145632, 'Chilaw', '35000'),
(10, '200420042004', 'Kamesh', 'Kuruwita', 'Male', '2004-04-20', 18, 713658970, 'Colombo 1', '38000'),
(11, '200620062006', 'Kasun', 'Nanayakkara', 'Male', '2006-10-03', 16, 715248561, 'Chilaw', '32000'),
(12, '199719971997', 'Kanishka', 'De Silva', 'Male', '1997-12-01', 25, 715241263, 'Colombo 2', '32500'),
(13, '199619961996', 'Sahel', 'Perera', 'Male', '1994-12-30', 28, 772563412, 'Chilaw', '32000'),
(14, '198619861986', 'Charith', 'Alwis', 'Male', '1986-02-12', 36, 715263245, 'Ambalangoda', '31000'),
(15, '198419841984', 'Dimuka', 'Karunarathna', 'Male', '1984-02-03', 38, 714524856, 'Wennappuwa', '30000'),
(16, '197019701970', 'Karuna', 'Amarasinghe', 'Male', '1970-12-12', 52, 778542152, 'Wennappuwa', '35000');

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `account_no` int(11) NOT NULL,
  `emp_ID` int(11) NOT NULL,
  `NIC` varchar(30) NOT NULL,
  `AccType` varchar(30) NOT NULL,
  `TransType` varchar(30) NOT NULL,
  `OpeningBal` int(11) NOT NULL,
  `TransAmount` varchar(30) NOT NULL,
  `TransDate` date NOT NULL,
  `CreatedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_account`
--

INSERT INTO `employee_account` (`account_no`, `emp_ID`, `NIC`, `AccType`, `TransType`, `OpeningBal`, `TransAmount`, `TransDate`, `CreatedBy`, `CreatedDate`) VALUES
(1, 1, '200214512365', 'Savings Account', 'Deposit', 2500, '2500', '2022-11-24', '3', '2022-11-24 22:47:27'),
(2, 2, '200215638940', 'Savings Account', 'Deposit', 500, '500', '2022-11-24', '3', '2022-11-24 22:47:39'),
(3, 3, '196325987451', 'Savings Account', 'Deposit', 1800, '1800', '2022-11-24', '3', '2022-11-24 22:47:54'),
(4, 4, '196852326551', 'Savings Account', 'Deposit', 3400, '3400', '2022-11-24', '3', '2022-11-24 22:48:06'),
(5, 5, '198236524789', 'Savings Account', 'Deposit', 5600, '5600', '2022-11-25', '3', '2022-11-25 20:17:21'),
(6, 7, '199752365236', 'Savings Account', 'Deposit', 6500, '6500', '2022-11-25', '3', '2022-11-25 20:17:39'),
(7, 8, '198999999999', 'Savings Account', 'Deposit', 2400, '2400', '2022-12-28', '3', '2022-12-28 13:10:34'),
(8, 9, '200520052005', 'Savings Account', 'Deposit', 2400, '2400', '2023-01-05', '3', '2023-01-05 15:59:58'),
(9, 10, '200420042004', 'Savings Account', 'Deposit', 1500, '1500', '2023-01-05', '3', '2023-01-05 16:00:09'),
(10, 11, '200620062006', 'Savings Account', 'Deposit', 1850, '1850', '2023-01-05', '3', '2023-01-05 16:00:22'),
(11, 12, '199719971997', 'Savings Account', 'Deposit', 2000, '2000', '2023-01-07', '3', '2023-01-07 02:46:11'),
(12, 13, '199619961996', 'Savings Account', 'Deposit', 1500, '1500', '2023-01-07', '3', '2023-01-07 02:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `interest_rates`
--

CREATE TABLE `interest_rates` (
  `ID` int(11) NOT NULL,
  `Loan_Type` varchar(30) NOT NULL,
  `Months` int(11) NOT NULL,
  `Interest_Rate` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interest_rates`
--

INSERT INTO `interest_rates` (`ID`, `Loan_Type`, `Months`, `Interest_Rate`, `CreatedDate`, `UpdatedDate`) VALUES
(1, 'Personal Loan', 6, 19, '2022-11-25 08:44:34', '2022-11-25 08:44:34'),
(2, 'Personal Loan', 12, 20, '2022-11-25 08:44:42', '2022-11-25 08:47:07'),
(3, 'Personal Loan', 24, 21, '2022-11-25 08:47:42', '2022-12-24 08:18:17'),
(4, 'Vehicle Loan', 6, 19, '2022-11-25 08:48:45', '2022-11-25 08:48:45'),
(5, 'Vehicle Loan', 12, 20, '2022-11-25 08:49:03', '2022-11-25 08:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `loantobod`
--

CREATE TABLE `loantobod` (
  `BODID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccountNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loantobod`
--

INSERT INTO `loantobod` (`BODID`, `LoanID`, `MemberID`, `AccountNo`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 3, 3),
(4, 4, 5, 5),
(5, 5, 8, 8),
(6, 6, 4, 4),
(7, 7, 9, 10),
(8, 8, 8, 8),
(9, 9, 9, 10),
(10, 10, 10, 11),
(11, 11, 11, 12),
(12, 14, 17, 14),
(13, 13, 15, 16),
(14, 12, 14, 15),
(15, 15, 16, 13),
(16, 16, 16, 13),
(17, 17, 7, 7),
(18, 18, 6, 6),
(19, 19, 12, 17),
(20, 20, 18, 20),
(21, 21, 19, 21),
(22, 22, 20, 22),
(23, 23, 12, 17),
(24, 24, 21, 23),
(25, 25, 22, 24);

-- --------------------------------------------------------

--
-- Table structure for table `loan_memguarantor`
--

CREATE TABLE `loan_memguarantor` (
  `ID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `GuarantorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_memguarantor`
--

INSERT INTO `loan_memguarantor` (`ID`, `LoanID`, `GuarantorID`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 4),
(7, 4, 6),
(8, 4, 7),
(9, 5, 7),
(10, 5, 6),
(11, 6, 5),
(12, 6, 6),
(13, 7, 8),
(14, 7, 3),
(15, 8, 7),
(16, 8, 9),
(17, 9, 10),
(18, 9, 8),
(19, 10, 11),
(20, 10, 12),
(21, 11, 10),
(22, 11, 8),
(23, 12, 13),
(24, 12, 12),
(25, 13, 12),
(26, 13, 13),
(27, 14, 16),
(28, 14, 15),
(29, 15, 17),
(30, 15, 15),
(31, 16, 15),
(32, 16, 14),
(33, 17, 17),
(34, 17, 14),
(35, 18, 14),
(36, 18, 9),
(37, 19, 16),
(38, 19, 13),
(39, 20, 16),
(40, 20, 17),
(41, 21, 18),
(42, 21, 20),
(43, 22, 19),
(44, 22, 18),
(45, 23, 10),
(46, 23, 11),
(47, 24, 20),
(48, 24, 19),
(49, 25, 21),
(50, 25, 20),
(51, 26, 26),
(52, 26, 27);

-- --------------------------------------------------------

--
-- Table structure for table `loan_settlement`
--

CREATE TABLE `loan_settlement` (
  `Settle_ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `RemainAmount` int(11) NOT NULL,
  `RemainMonths` int(11) NOT NULL,
  `LastPaymentDate` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_settlement`
--

INSERT INTO `loan_settlement` (`Settle_ID`, `member_ID`, `AccNo`, `LoanID`, `Amount`, `RemainAmount`, `RemainMonths`, `LastPaymentDate`, `CreatedDate`, `Status`) VALUES
(1, 1, 1, 1, 2500, 9398, 6, '1', '2022-11-25 09:01:43', 'Settled'),
(2, 4, 4, 6, 2750, 9148, 6, '1', '2022-11-25 16:06:31', 'Settled'),
(3, 4, 4, 6, 10000, 0, 6, '1', '2022-11-25 16:07:19', 'Settled'),
(4, 3, 3, 3, 2000, 15856, 12, '1', '2022-11-25 17:12:52', 'Pending'),
(5, 3, 3, 3, 2500, 13356, 12, '1', '2022-11-26 11:06:18', 'Pending'),
(6, 3, 3, 3, 3000, 10356, 12, '1', '2022-11-26 11:29:24', 'Pending'),
(7, 1, 1, 1, 2500, 6898, 6, '', '2023-01-05 10:25:31', 'Settled'),
(8, 1, 1, 1, 2000, 4898, 6, '2023-01-05 10:25:31', '2023-01-05 10:32:36', 'Settled'),
(9, 1, 1, 1, 4898, 0, 6, '2023-01-05 10:32:36', '2023-01-05 10:50:14', 'Settled'),
(10, 8, 8, 8, 1750, 16100, 6, '', '2023-01-06 18:36:36', 'Pending'),
(11, 5, 5, 4, 2500, 57002, 6, '', '2023-01-06 19:06:01', 'Pending'),
(12, 8, 8, 8, 2500, 13600, 6, '2023-01-06 18:36:36', '2023-01-07 08:58:26', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `addres` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `nic`, `first_name`, `last_name`, `gender`, `birthdate`, `age`, `contact_no`, `addres`) VALUES
(1, '200075246358', 'Hansala', 'Dissanayake', 'Female', '2000-10-11', 22, 778563241, 'Seeduwa'),
(3, '199056482012', 'Saheli', 'Bandaranayake', 'Female', '1990-12-01', 31, 714563217, 'Wennappuwa'),
(4, '821563894V', 'Sayuri', 'Dissanayake', 'Male', '1982-12-07', 39, 714441256, 'Nawala'),
(5, '199625364178', 'Sanduni', 'Rajapakse', 'Female', '1996-10-25', 26, 789654444, 'Kadawatha'),
(6, '199365489231', 'Aditha', 'Abenayake', 'Male', '1993-11-04', 29, 725631462, 'Katana'),
(7, '195632476532', 'Sarath', 'Silva', 'Male', '1956-02-05', 66, 778963254, 'Wennappuwa'),
(8, '198253659874', 'Kawshini', 'Herath', 'Female', '1982-04-16', 40, 775698123, 'Chillaw'),
(9, '200014523651', 'Senuri', 'Silva', 'Female', '2000-11-01', 22, 715236412, 'Kaduwela'),
(10, '200000000001', 'Sashi', 'Perera', 'Male', '2000-11-23', 22, 712365412, 'Chillaw'),
(11, '200011111111', 'Saranga', 'Perera', 'Male', '2001-11-27', 20, 775236413, 'Wennappuwa'),
(12, '199966666666', 'Chathuri', 'Silva', 'Female', '1999-12-08', 23, 775236421, 'Seeduwa'),
(13, '200222222222', 'Sithumini', 'Jayamanna', 'Female', '2002-10-30', 20, 725362140, 'Wennappuwa'),
(14, '199666666666', 'Sandani', 'De Silva', 'Female', '1996-12-05', 25, 712563241, 'Chillaw'),
(15, '197752555556', 'Krishani', 'Ferdinando', 'Female', '1977-07-16', 45, 775869542, 'Kadawatha'),
(16, '200000000000', 'Sandaru', 'Jayaweera', 'Male', '2000-04-03', 22, 778526321, 'Kandana'),
(17, '199555555555', 'Keerthi', 'Siriwardena', 'Male', '1995-06-30', 27, 782356142, 'Wennappuwa'),
(18, '199652312451', 'Seetha', 'Wijesinghe', 'Female', '1996-12-05', 25, 712543652, 'Wennappuwa'),
(19, '200120012001', 'Santhush', 'Karunarathna', 'Male', '2001-05-05', 21, 714586985, 'IDH'),
(20, '200220022002', 'Sayumi', 'Godakumbura', 'Female', '2002-01-02', 21, 741258460, 'IDH'),
(21, '200320032003', 'Liviny', 'Samaranayake', 'Female', '2003-08-27', 19, 772541256, 'IDH'),
(22, '200520052006', 'Samantha', 'Gunathilake', 'Male', '2005-01-02', 18, 712542356, 'Colombo 1'),
(23, '199719971999', 'Sashen', 'Kuruppu', 'Male', '1997-02-06', 25, 714425631, 'Colombo 2'),
(24, '198819881988', 'Sashini', 'Jayasuriya', 'Female', '1988-03-04', 34, 715442563, 'Moratuwa'),
(25, '198719871987', 'Saranika', 'Kumarasiri', 'Female', '1987-12-31', 35, 775241256, 'Kalutara'),
(26, '198219821982', 'Dayantha', 'Silva', 'Female', '1982-04-12', 40, 778524126, 'Negombo'),
(27, '198019811980', 'Thanuja', 'Dissanayake', 'Female', '1980-04-05', 42, 714521832, 'Nawala'),
(28, '198019801980', 'Thamara', 'Perera', 'Female', '1980-02-12', 42, 714452152, 'Wennappuwa');

-- --------------------------------------------------------

--
-- Table structure for table `member_account`
--

CREATE TABLE `member_account` (
  `account_no` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `NIC` varchar(30) NOT NULL,
  `AccType` varchar(50) NOT NULL,
  `TransType` varchar(50) NOT NULL,
  `OpeningBal` int(11) NOT NULL,
  `TransAmount` varchar(10) NOT NULL,
  `TransDate` date NOT NULL,
  `CreatedBy` varchar(10) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_account`
--

INSERT INTO `member_account` (`account_no`, `memberID`, `NIC`, `AccType`, `TransType`, `OpeningBal`, `TransAmount`, `TransDate`, `CreatedBy`, `CreatedDate`) VALUES
(1, 1, '200075246358', 'Savings Account', 'Deposit', 1000, '1000', '2022-11-24', '3', '2022-11-24 22:08:07'),
(2, 1, '200075246358', '18+ Account', 'Deposit', 2000, '2000', '2022-11-01', '3', '2022-11-24 22:37:54'),
(3, 3, '200075246358', 'Savings Account', 'Deposit', 500, '500', '2022-11-01', '3', '2022-11-24 22:38:51'),
(4, 4, '199056482012', 'Savings Account', 'Deposit', 2500, '2500', '2022-10-10', '3', '2022-11-24 22:39:21'),
(5, 5, '821563894V', 'Savings Account', 'Deposit', 2600, '2600', '2022-11-24', '3', '2022-11-24 22:39:46'),
(6, 6, '199365489231', 'Savings Account', 'Deposit', 2600, '2600', '2022-11-24', '3', '2022-11-24 22:46:31'),
(7, 7, '195632476532', 'Savings Account', 'Deposit', 3000, '3000', '2022-11-24', '3', '2022-11-24 22:46:43'),
(8, 8, '198253659874', 'Savings Account', 'Deposit', 1500, '1500', '2022-11-23', '3', '2022-11-24 22:46:55'),
(9, 7, '195632476532', '18+ Account', 'Deposit', 3850, '3850', '2022-11-25', '3', '2022-11-25 08:22:06'),
(10, 9, '200014523651', 'Savings Account', 'Deposit', 2500, '2500', '2022-11-25', '3', '2022-11-25 14:47:58'),
(11, 10, '200000000001', 'Savings Account', 'Deposit', 20000, '20000', '2022-11-25', '3', '2022-11-25 15:47:31'),
(12, 11, '200011111111', 'Savings Account', 'Deposit', 2500, '2500', '2022-11-25', '3', '2022-11-25 16:25:04'),
(13, 16, '200000000000', 'Savings Account', 'Deposit', 5000, '5000', '2022-11-25', '3', '2022-11-26 04:04:05'),
(14, 17, '199555555555', 'Savings Account', 'Deposit', 3500, '3500', '2022-11-26', '3', '2022-11-26 04:04:36'),
(15, 14, '199666666666', 'Savings Account', 'Deposit', 2850, '2850', '2022-11-26', '3', '2022-11-26 04:08:10'),
(16, 15, '197752555556', 'Woman Account', 'Deposit', 3500, '3500', '2022-11-26', '3', '2022-11-26 04:08:28'),
(17, 12, '199966666666', 'Savings Account', 'Deposit', 2500, '2500', '2022-12-28', '3', '2022-12-28 13:08:27'),
(18, 13, '200222222222', 'Savings Account', 'Deposit', 2400, '2400', '2022-12-28', '3', '2022-12-28 13:08:41'),
(19, 12, '199966666666', '18+ Account', 'Deposit', 2450, '2450', '2023-01-01', '3', '2023-01-01 08:25:24'),
(20, 18, '199652312451', 'Woman Account', 'Deposit', 2500, '2500', '2023-01-05', '3', '2023-01-05 15:03:34'),
(21, 19, '200120012001', 'Savings Account', 'Deposit', 2800, '2800', '2023-01-05', '3', '2023-01-05 15:47:33'),
(22, 20, '200220022002', 'Savings Account', 'Deposit', 3000, '3000', '2023-01-05', '3', '2023-01-05 15:47:44'),
(23, 21, '200320032003', 'Savings Account', 'Deposit', 3500, '3500', '2023-01-05', '3', '2023-01-05 15:59:22'),
(24, 22, '200520052006', 'Savings Account', 'Deposit', 2500, '2500', '2023-01-06', '3', '2023-01-06 18:32:07'),
(25, 23, '199719971999', 'Savings Account', 'Deposit', 10000, '10000', '2023-01-06', '3', '2023-01-06 19:03:27'),
(26, 24, '198819881988', 'Savings Account', 'Deposit', 2600, '2600', '2023-01-06', '3', '2023-01-06 19:56:10'),
(27, 25, '198719871987', 'Savings Account', 'Deposit', 3500, '3500', '2023-01-06', '3', '2023-01-06 19:56:23'),
(28, 26, '198219821982', 'Woman Account', 'Deposit', 3200, '3200', '2023-01-07', '3', '2023-01-07 02:35:40'),
(29, 27, '198019811980', 'Savings Account', 'Deposit', 2300, '2300', '2023-01-07', '3', '2023-01-07 02:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `member_dependant`
--

CREATE TABLE `member_dependant` (
  `dep_ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `disease` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_dependant`
--

INSERT INTO `member_dependant` (`dep_ID`, `member_ID`, `first_name`, `last_name`, `gender`, `birthdate`, `age`, `relationship`, `disease`) VALUES
(1, 1, 'Lihini  ', 'Dissanayake', 'Female', '2022-03-03', 0, 'Daughter', 'Eye Surgery'),
(2, 3, 'Kumashi', 'Bandaranayake', 'Female', '2017-12-05', 4, 'Daughter', 'Dengue'),
(3, 4, 'Kirulu', 'Dissanayake', 'Male', '2015-04-07', 7, 'Mother', 'Dengue'),
(4, 4, 'Seetha', 'Dissanayake', 'Female', '1956-09-15', 66, 'Mother', 'Cancer'),
(5, 3, 'Samadhi', 'Bandaranayake', 'Male', '2019-08-07', 3, 'Daughter', 'Dengue'),
(6, 5, 'Hansi', 'Rajapakse', 'Female', '2018-09-12', 4, 'Daughter', 'Surgery'),
(7, 9, 'Sujatha', 'Silva', 'Female', '1967-12-02', 54, 'Mother-In-Low', 'Cancer'),
(8, 8, 'Saumya', 'Herath', 'Female', '1950-12-05', 71, 'Mother', 'Surgery'),
(9, 10, 'Sithumi', 'Perera', 'Male', '2022-11-04', 0, 'Daughter', 'Surgery'),
(10, 11, 'Samantha', 'Perera', 'Male', '1959-11-02', 63, 'Father-In-Low', 'Cancer'),
(11, 6, 'Padmasri', 'Abenayake', 'Male', '1967-12-06', 54, 'Father', 'Eye Surgery'),
(12, 7, 'Kushan', 'Silva', 'Male', '2014-11-26', 7, 'Son', 'Dengue'),
(13, 11, 'Kamala', 'De Silva', 'Female', '1972-02-22', 50, 'Mother-In-Low', 'Cancer'),
(14, 12, 'Sehan', 'De Silva', 'Male', '2018-01-05', 4, 'Son', 'Eye Surgery'),
(15, 13, 'Padmasri', 'Jayamanna', 'Male', '1956-12-25', 65, 'Father', 'Surgery'),
(16, 13, 'Santhush', 'Jayamanna', 'Male', '2006-12-25', 15, 'Son', 'Child health issue'),
(17, 14, 'Kushanka', 'De Silva', 'Male', '2015-12-08', 6, 'Son', 'Surgery'),
(18, 15, 'Jayani', 'Ferdinando', 'Male', '1989-11-11', 33, 'Daughter', 'Child health issue'),
(19, 9, 'Prashani', 'Silva', 'Female', '2021-08-05', 1, 'Daughter', 'Child health issue'),
(20, 16, 'Kusum', 'Jayaweera', 'Female', '1964-07-01', 58, 'Mother', 'Cancer'),
(21, 17, 'Padma', 'Siriwardena', 'Female', '1968-05-02', 54, 'Mother', 'Cancer'),
(22, 18, 'Kushani', 'Wijesinghe', 'Female', '2022-11-03', 0, 'Daughter', 'Surgery'),
(23, 19, 'Sampath', 'Samaranayaka', 'Male', '1970-02-04', 52, 'Father', 'Cancer'),
(24, 20, 'Sarath', 'Godakumbura', 'Male', '1977-12-12', 45, 'Father', 'Surgery'),
(25, 21, 'Kamala', 'Samaranayaka', 'Female', '1971-01-06', 51, 'Mother', 'Cancer'),
(26, 22, 'Kasun', 'Gunathilake', 'Male', '2023-01-06', 0, 'Son', 'Surgery'),
(27, 23, 'Dileepa', 'Madushan', 'Male', '2015-02-11', 7, 'Son', 'Surgery'),
(28, 24, 'Kanika', 'Jayasuriya', 'Male', '2017-12-03', 5, 'Son', 'Child health issue'),
(29, 25, 'Ashen', 'Kumarasiri', 'Male', '2014-02-25', 8, 'Son', 'Surgery'),
(30, 26, 'Sayuri', 'Kumarasiri', 'Female', '1996-02-02', 26, 'Daughter', 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `member_donation`
--

CREATE TABLE `member_donation` (
  `DonationID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `DonationType` varchar(30) NOT NULL,
  `DonationAmount` int(11) NOT NULL,
  `Description` varchar(150) NOT NULL,
  `DepName` varchar(30) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_donation`
--

INSERT INTO `member_donation` (`DonationID`, `MemberID`, `AccNo`, `DonationType`, `DonationAmount`, `Description`, `DepName`, `CreatedBy`, `CreatedDate`, `Status`) VALUES
(1, 1, 1, 'Medical Donation', 10000, 'Surgery', 'Lihini   Dissanayake', 1, '2022-11-24 22:54:52', 'Passed'),
(2, 3, 3, 'Medical Donation', 5000, 'Surgery', 'Kumashi Bandaranayake', 1, '2022-11-24 23:00:32', 'Passed'),
(3, 5, 5, 'Medical Donation', 15000, 'Daughter treatments', 'Hansi Rajapakse', 1, '2022-11-25 07:06:38', 'BOD Rejected'),
(4, 4, 4, 'Medical Donation', 20000, 'Adult health issue', 'Seetha Dissanayake', 1, '2022-11-25 08:01:53', 'Passed'),
(5, 8, 8, 'Medical Donation', 15000, 'Adult health issue', 'Saumya Herath', 1, '2022-11-25 14:52:59', 'Passed'),
(6, 6, 6, 'Medical Donation', 15000, 'Father treatment', 'Padmasri Abenayake', 1, '2022-11-25 15:45:04', 'Passed'),
(7, 7, 7, 'Medical Donation', 15000, 'Child health issue', 'Kushan Silva', 1, '2022-11-25 16:00:57', 'Passed'),
(8, 11, 12, 'Medical Donation', 15000, 'Adult health issue', 'Kamala De Silva', 1, '2022-11-25 17:07:46', 'Passed'),
(9, 9, 10, 'Medical Donation', 15000, 'Adult health issue', 'Sujatha Silva', 1, '2022-11-25 20:01:59', 'Passed'),
(10, 10, 11, 'Medical Donation', 15000, 'Child scholarship', 'Sithumi Perera', 1, '2022-11-25 20:02:33', 'BOD Rejected'),
(11, 14, 15, 'Medical Donation', 10000, 'Mother treatments', 'Kushanka De Silva', 1, '2022-11-26 04:10:17', 'Passed'),
(12, 15, 16, 'Medical Donation', 10000, 'Child health issue', 'Jayani Ferdinando', 1, '2022-11-26 04:10:31', 'Passed'),
(13, 17, 14, 'Medical Donation', 15000, 'Adult health issue', 'Padma Siriwardena', 1, '2022-11-26 11:00:09', 'Passed'),
(14, 11, 12, 'Medical Donation', 15000, 'Medical surgery', 'Kamala De Silva', 3, '2022-12-28 19:35:44', 'Passed'),
(15, 12, 17, 'Medical Donation', 18000, 'Child surgery', 'Sehan De Silva', 3, '2022-12-28 19:36:14', 'BOD Approved'),
(16, 13, 18, 'Medical Donation', 20000, 'Cancer', 'Padmasri Jayamanna', 3, '2022-12-28 19:36:37', 'BOD Approved'),
(17, 16, 13, 'Medical Donation', 12000, 'Medical surgery', 'Kusum Jayaweera', 3, '2023-01-05 11:31:01', 'BOD Approved'),
(18, 18, 20, 'Medical Donation', 15000, 'Child health issue', 'Kushani Wijesinghe', 3, '2023-01-05 16:32:54', 'Sent BOD'),
(19, 19, 21, 'Medical Donation', 20000, 'Cancer', 'Sampath Samaranayaka', 3, '2023-01-05 16:33:08', 'Sent BOD'),
(20, 21, 23, 'Medical Donation', 10000, 'Cancer', 'Kamala Samaranayaka', 1, '2023-01-06 18:29:27', 'Sent BOD'),
(21, 22, 24, 'Medical Donation', 15000, 'Child health issue', 'Kasun Gunathilake', 1, '2023-01-06 19:00:09', 'Sent BOD'),
(22, 25, 27, 'Medical Donation', 15000, 'Medical surgery', 'Ashen Kumarasiri', 1, '2023-01-07 08:53:53', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `member_loan`
--

CREATE TABLE `member_loan` (
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccountNo` int(11) NOT NULL,
  `Guarantor1` int(11) NOT NULL,
  `Guarantor2` int(11) NOT NULL,
  `LoanType` varchar(30) NOT NULL,
  `LoanAmount` varchar(30) NOT NULL,
  `Approval` varchar(30) NOT NULL,
  `CreatedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_loan`
--

INSERT INTO `member_loan` (`LoanID`, `MemberID`, `AccountNo`, `Guarantor1`, `Guarantor2`, `LoanType`, `LoanAmount`, `Approval`, `CreatedBy`, `CreatedDate`) VALUES
(1, 1, 1, 2, 3, 'Personal Loan', '10000', 'Passed', '1', '2022-11-24 22:09:26'),
(2, 1, 1, 3, 4, 'Personal Loan', '10000', 'BOD Reject', '1', '2022-11-24 22:53:12'),
(3, 3, 3, 1, 4, 'Personal Loan', '15000', 'Passed', '1', '2022-11-24 22:53:55'),
(4, 5, 5, 6, 7, 'Vehicle Loan', '50000', 'Passed', '1', '2022-11-24 22:54:16'),
(5, 8, 8, 7, 6, 'Personal Loan', '15000', 'Passed', '1', '2022-11-24 23:12:34'),
(6, 4, 4, 5, 6, 'Personal Loan', '10000', 'Passed', '1', '2022-11-25 08:00:56'),
(7, 9, 10, 8, 3, 'Personal Loan', '25000', 'Passed', '1', '2022-11-25 14:49:45'),
(8, 8, 8, 7, 9, 'Personal Loan', '15000', 'Passed', '1', '2022-11-25 15:39:49'),
(9, 9, 10, 10, 8, 'Personal Loan', '10000', 'Passed', '1', '2022-11-25 16:00:15'),
(10, 10, 11, 11, 12, 'Personal Loan', '15000', 'Passed', '1', '2022-11-25 17:06:50'),
(11, 11, 12, 10, 8, 'Personal Loan', '10000', 'Passed', '1', '2022-11-25 20:00:08'),
(12, 14, 15, 13, 12, 'Personal Loan', '10000', 'Passed', '1', '2022-11-26 04:09:11'),
(13, 15, 16, 12, 13, 'Personal Loan', '10000', 'Passed', '1', '2022-11-26 04:09:31'),
(14, 17, 14, 16, 15, 'Personal Loan', '15000', 'Passed', '1', '2022-11-26 10:59:19'),
(15, 16, 13, 17, 15, 'Personal Loan', '15000', 'Passed', '1', '2022-11-26 11:28:16'),
(16, 16, 13, 15, 14, 'Personal Loan', '15000', 'Passed', '3', '2022-12-27 23:12:22'),
(17, 7, 7, 17, 14, 'Personal Loan', '15000', 'Passed', '3', '2022-12-31 23:52:42'),
(18, 6, 6, 14, 9, 'Vehicle Loan', '21000', 'Passed', '3', '2022-12-31 23:53:51'),
(19, 12, 17, 16, 13, 'Personal Loan', '20000', 'BOD Approved', '3', '2023-01-05 07:13:08'),
(20, 18, 20, 16, 17, 'Personal Loan', '15000', 'BOD Approved', '3', '2023-01-05 15:46:42'),
(21, 19, 21, 18, 20, 'Personal Loan', '15000', 'BOD Approved', '3', '2023-01-05 16:23:41'),
(22, 20, 22, 19, 18, 'Personal Loan', '20000', 'Sent BOD', '3', '2023-01-05 16:24:03'),
(23, 12, 17, 10, 11, 'Vehicle Loan', '15000', 'Sent BOD', '3', '2023-01-06 12:28:46'),
(24, 21, 23, 20, 19, 'Personal Loan', '15000', 'Sent BOD', '1', '2023-01-06 18:28:28'),
(25, 22, 24, 21, 20, 'Personal Loan', '15000', 'Sent BOD', '1', '2023-01-06 18:59:28'),
(26, 25, 27, 26, 27, 'Personal Loan', '20000', 'Pending', '1', '2023-01-07 08:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `member_loan_temp`
--

CREATE TABLE `member_loan_temp` (
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccountNo` int(11) NOT NULL,
  `Guarantor1` int(11) NOT NULL,
  `Guarantor2` int(11) NOT NULL,
  `LoanType` varchar(30) NOT NULL,
  `LoanAmount` varchar(30) NOT NULL,
  `Approval` varchar(30) NOT NULL,
  `CreatedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_transactions`
--

CREATE TABLE `member_transactions` (
  `TransactionID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `TransType` varchar(30) NOT NULL,
  `Amount` int(11) NOT NULL,
  `RunningBal` int(11) NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Description` varchar(150) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `FullName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_transactions`
--

INSERT INTO `member_transactions` (`TransactionID`, `MemberID`, `AccNo`, `TransType`, `Amount`, `RunningBal`, `TransactionDate`, `Description`, `NIC`, `FullName`) VALUES
(1, 1, 1, 'Credit', 1000, 1000, '2022-11-24 22:08:07', 'Acc Creation Deposit', '200075246358', 'Hansala'),
(2, 1, 2, 'Credit', 2000, 2000, '2022-11-24 22:37:54', 'Acc Creation Deposit', '200075246358', 'Hansala'),
(3, 3, 3, 'Credit', 500, 500, '2022-11-24 22:38:51', 'Acc Creation Deposit', '200075246358', 'Saheli'),
(4, 4, 4, 'Credit', 2500, 2500, '2022-11-24 22:39:21', 'Acc Creation Deposit', '199056482012', 'Sayuri'),
(5, 5, 5, 'Credit', 2600, 2600, '2022-11-24 22:39:46', 'Acc Creation Deposit', '821563894V', 'Sanduni'),
(6, 6, 6, 'Credit', 2600, 2600, '2022-11-24 22:46:31', 'Acc Creation Deposit', '199365489231', 'Aditha'),
(7, 7, 7, 'Credit', 3000, 3000, '2022-11-24 22:46:43', 'Acc Creation Deposit', '195632476532', 'Sarath'),
(8, 8, 8, 'Credit', 1500, 1500, '2022-11-24 22:46:55', 'Acc Creation Deposit', '198253659874', 'Kawshini'),
(9, 1, 1, 'Credit', 10000, 11000, '2022-11-24 23:07:38', 'Personal Loan', ' ', 'Fisheries Loan'),
(10, 3, 3, 'Credit', 15000, 15500, '2022-11-24 23:07:59', 'Personal Loan', ' ', 'Fisheries Loan'),
(11, 1, 1, 'Credit', 2500, 13500, '2022-11-24 23:08:53', 'Class fee', '199625364178', 'Darshi Karunarathne'),
(12, 1, 2, 'Credit', 2850, 4850, '2022-11-24 23:09:37', 'Extra benefit', '195632476532', 'Dasun Perera'),
(13, 5, 5, 'Credit', 17500, 20100, '2022-11-24 23:10:28', 'Member Pawning', ' ', 'Fisheries Pawning'),
(14, 7, 9, 'Credit', 3850, 3850, '2022-11-25 08:22:06', 'Acc Creation Deposit', '195632476532', 'Sarath'),
(15, 5, 5, 'Credit', 50000, 70100, '2022-11-25 08:38:43', 'Vehicle Loan', ' ', 'Fisheries Loan'),
(16, 8, 8, 'Credit', 15000, 16500, '2022-11-25 08:45:50', 'Personal Loan', ' ', 'Fisheries Loan'),
(17, 4, 4, 'Credit', 20000, 22500, '2022-11-25 10:14:29', 'Medical Donation', ' ', 'Fisheries Donation'),
(18, 1, 1, 'Credit', 10000, 23500, '2022-11-25 10:15:36', 'Medical Donation', ' ', 'Fisheries Donation'),
(19, 3, 3, 'Credit', 5000, 20500, '2022-11-25 10:20:40', 'Medical Donation', ' ', 'Fisheries Donation'),
(20, 3, 3, 'Credit', 26250, 46750, '2022-11-25 10:53:25', 'Member Pawning', ' ', 'Fisheries Pawning'),
(21, 6, 6, 'Credit', 2500, 5100, '2022-11-25 11:10:48', 'Tuition fee', '199365489231', 'Aditha Abenayake'),
(22, 7, 7, 'Credit', 50000, 53000, '2022-11-25 11:12:25', 'Donation', '195632476532', 'Sarath Silva'),
(23, 7, 9, 'Credit', 50000, 53850, '2022-11-25 11:13:32', 'Salary', '195632476532', 'Sarath Silva'),
(24, 1, 2, 'Credit', 35000, 39850, '2022-11-25 11:14:46', 'Salary', '200215638940', 'Ashen Jayawardena'),
(25, 9, 10, 'Credit', 2500, 2500, '2022-11-25 14:47:58', 'Acc Creation Deposit', '200014523651', 'Senuri'),
(26, 9, 10, 'Credit', 25000, 27500, '2022-11-25 14:56:54', 'Personal Loan', ' ', 'Fisheries Loan'),
(27, 4, 4, 'Credit', 26250, 48750, '2022-11-25 15:13:35', 'Member Pawning', ' ', 'Fisheries Pawning'),
(28, 5, 5, 'Credit', 17500, 87600, '2022-11-25 15:14:25', 'Member Pawning', ' ', 'Fisheries Pawning'),
(29, 6, 6, 'Credit', 26250, 31350, '2022-11-25 15:14:53', 'Member Pawning', ' ', 'Fisheries Pawning'),
(30, 1, 1, 'Credit', 8750, 32250, '2022-11-25 15:15:42', 'Member Pawning', ' ', 'Fisheries Pawning'),
(31, 9, 10, 'Credit', 2500, 30000, '2022-11-25 15:18:25', 'Monthly bill payments', '199056482012', 'Shamali Weerakoon'),
(32, 10, 11, 'Credit', 20000, 20000, '2022-11-25 15:47:31', 'Acc Creation Deposit', '200000000001', 'Sashi'),
(33, 4, 4, 'Credit', 10000, 58750, '2022-11-25 16:05:13', 'Personal Loan', ' ', 'Fisheries Loan'),
(34, 4, 4, 'Credit', 852, 59602, '2022-11-25 16:07:19', 'Loan ID 6 Settle Amount', '', ''),
(35, 7, 7, 'Credit', 17500, 70500, '2022-11-25 16:10:51', 'Member Pawning', ' ', 'Fisheries Pawning'),
(36, 11, 12, 'Credit', 2500, 2500, '2022-11-25 16:25:04', 'Acc Creation Deposit', '200011111111', 'Saranga'),
(37, 6, 6, 'Credit', 2500, 33850, '2022-11-25 16:26:49', 'Tuition fee', '200215638940', 'Samanthi Perera'),
(38, 8, 8, 'Credit', 15000, 31500, '2022-11-25 17:11:10', 'Personal Loan', ' ', 'Fisheries Loan'),
(39, 11, 12, 'Credit', 15000, 17500, '2022-11-25 17:11:59', 'Medical Donation', ' ', 'Fisheries Donation'),
(40, 7, 7, 'Credit', 15000, 85500, '2022-11-25 20:19:17', 'Medical Donation', ' ', 'Fisheries Donation'),
(41, 16, 13, 'Credit', 5000, 5000, '2022-11-26 04:04:05', 'Acc Creation Deposit', '200000000000', 'Sandaru'),
(42, 17, 14, 'Credit', 3500, 3500, '2022-11-26 04:04:36', 'Acc Creation Deposit', '199555555555', 'Keerthi'),
(43, 14, 15, 'Credit', 2850, 2850, '2022-11-26 04:08:10', 'Acc Creation Deposit', '199666666666', 'Sandani'),
(44, 15, 16, 'Credit', 3500, 3500, '2022-11-26 04:08:28', 'Acc Creation Deposit', '197752555556', 'Krishani'),
(45, 9, 10, 'Credit', 10000, 40000, '2022-11-26 11:04:06', 'Personal Loan', ' ', 'Fisheries Loan'),
(46, 10, 11, 'Credit', 15000, 35000, '2022-11-26 11:04:43', 'Personal Loan', ' ', 'Fisheries Loan'),
(47, 8, 8, 'Credit', 15000, 46500, '2022-11-26 11:05:14', 'Medical Donation', ' ', 'Fisheries Donation'),
(48, 6, 6, 'Credit', 15000, 48850, '2022-11-26 11:05:22', 'Medical Donation', ' ', 'Fisheries Donation'),
(49, 17, 14, 'Credit', 17500, 21000, '2022-11-26 11:07:39', 'Member Pawning', ' ', 'Fisheries Pawning'),
(50, 3, 3, 'Credit', 3750, 50500, '2022-11-26 11:09:49', 'Pawning ID 2 Settle Amount', '', ''),
(51, 5, 5, 'Credit', 2850, 90450, '2022-12-25 08:15:14', 'Extra payment', '199625364178', 'Sanduni Rajapakse'),
(52, 5, 5, 'Credit', 3200, 93650, '2022-12-25 08:17:54', 'Extra Benefit', '199625364178', 'Sanduni Rajapakse'),
(53, 5, 5, 'Credit', 3200, 96850, '2022-12-25 09:49:23', 'Extra Benefit', '199625364178', 'Sanduni Rajapakse'),
(54, 9, 10, 'Credit', 3500, 43500, '2022-12-25 10:15:27', 'Class fee', '200014523651 	', 'Senuri Silva'),
(55, 6, 6, 'Credit', 17500, 66350, '2022-12-25 12:24:26', 'Member Pawning', ' ', 'Fisheries Pawning'),
(56, 6, 6, 'Credit', 17500, 83850, '2022-12-25 20:13:02', 'Member Pawning', ' ', 'Fisheries Pawning'),
(57, 9, 10, 'Credit', 15000, 58500, '2022-12-27 19:55:13', 'Medical Donation', ' ', 'Fisheries Donation'),
(58, 11, 12, 'Credit', 10000, 27500, '2022-12-27 23:14:00', 'Personal Loan', ' ', 'Fisheries Loan'),
(59, 15, 16, 'Credit', 10000, 13500, '2022-12-27 23:14:10', 'Personal Loan', ' ', 'Fisheries Loan'),
(60, 12, 17, 'Credit', 2500, 2500, '2022-12-28 13:08:27', 'Acc Creation Deposit', '199966666666', 'Chathuri'),
(61, 13, 18, 'Credit', 2400, 2400, '2022-12-28 13:08:41', 'Acc Creation Deposit', '200222222222', 'Sithumini'),
(62, 14, 15, 'Credit', 10000, 12850, '2022-12-28 19:37:45', 'Medical Donation', ' ', 'Fisheries Donation'),
(63, 15, 16, 'Credit', 10000, 23500, '2022-12-28 19:37:54', 'Medical Donation', ' ', 'Fisheries Donation'),
(64, 7, 9, 'Credit', 2500, 56350, '2022-12-28 19:53:21', 'Extra income', '195632476532', 'Sarath Silva'),
(65, 12, 19, 'Credit', 2450, 2450, '2023-01-01 08:25:24', 'Acc Creation Deposit', '199966666666', 'Chathuri'),
(66, 9, 10, 'Debit', 2500, 56000, '2023-01-01 10:56:18', 'Class fee', '200014523651', 'Senuri Silva'),
(67, 9, 10, 'Debit', 2500, 53500, '2023-01-01 10:58:55', 'Class fee', '200014523651', 'Senuri Silva'),
(68, 12, 17, 'Credit', 17500, 20000, '2023-01-02 20:01:19', 'Member Pawning', ' ', 'Fisheries Pawning'),
(69, 14, 15, 'Credit', 10000, 22850, '2023-01-05 09:44:41', 'Personal Loan', ' ', 'Fisheries Loan'),
(70, 17, 14, 'Credit', 15000, 36000, '2023-01-05 09:44:51', 'Personal Loan', ' ', 'Fisheries Loan'),
(71, 17, 14, 'Credit', 15000, 51000, '2023-01-05 12:38:59', 'Medical Donation', ' ', 'Fisheries Donation'),
(72, 7, 9, 'Credit', 2000, 58350, '2023-01-05 13:02:42', 'Tuition fee', '195632476532', ''),
(73, 7, 7, 'Credit', 2000, 87500, '2023-01-05 13:06:45', 'Tuition fee', '195632476532', ''),
(74, 12, 19, 'Credit', 2500, 4950, '2023-01-05 13:08:46', 'Extra benefit', '199966666666', ''),
(75, 18, 20, 'Credit', 2500, 2500, '2023-01-05 15:03:34', 'Acc Creation Deposit', '199652312451', 'Seetha'),
(76, 19, 21, 'Credit', 2800, 2800, '2023-01-05 15:47:33', 'Acc Creation Deposit', '200120012001', 'Santhush'),
(77, 20, 22, 'Credit', 3000, 3000, '2023-01-05 15:47:44', 'Acc Creation Deposit', '200220022002', 'Sayumi'),
(78, 21, 23, 'Credit', 3500, 3500, '2023-01-05 15:59:22', 'Acc Creation Deposit', '200320032003', 'Livinya'),
(79, 16, 13, 'Credit', 15000, 20000, '2023-01-05 16:19:04', 'Personal Loan', ' ', 'Fisheries Loan'),
(80, 16, 13, 'Credit', 15000, 35000, '2023-01-05 16:19:16', 'Personal Loan', ' ', 'Fisheries Loan'),
(81, 7, 7, 'Credit', 10000, 97500, '2023-01-05 16:29:15', 'Extra benefit', '195632476532 	', 'Sarath Silva'),
(82, 7, 7, 'Credit', 12000, 109500, '2023-01-05 16:29:51', 'Tuition fee received', '195632476532 	', 'Sarath Silva'),
(83, 7, 7, 'Credit', 17500, 127000, '2023-01-06 02:46:56', 'Member Pawning', ' ', 'Fisheries Pawning'),
(84, 22, 24, 'Credit', 2500, 2500, '2023-01-06 18:32:07', 'Acc Creation Deposit', '200520052006', 'Saman'),
(85, 7, 7, 'Credit', 15000, 142000, '2023-01-06 18:32:50', 'Personal Loan', ' ', 'Fisheries Loan'),
(86, 20, 22, 'Credit', 15000, 18000, '2023-01-06 18:39:47', 'Extra benefit', '200220022002', 'Sayumi Godakumbura'),
(87, 8, 8, 'Credit', 8750, 55250, '2023-01-06 18:41:10', 'Member Pawning', ' ', 'Fisheries Pawning'),
(88, 11, 12, 'Credit', 15000, 42500, '2023-01-06 18:46:07', 'Medical Donation', ' ', 'Fisheries Donation'),
(89, 23, 25, 'Credit', 10000, 10000, '2023-01-06 19:03:27', 'Acc Creation Deposit', '199719971999', 'Sashen'),
(90, 20, 22, 'Credit', 1200, 19200, '2023-01-06 19:04:06', 'Tuition fee received', '200220022002', 'Sayumi Godakumbura'),
(91, 24, 26, 'Credit', 2600, 2600, '2023-01-06 19:56:10', 'Acc Creation Deposit', '198819881988', 'Sashini'),
(92, 25, 27, 'Credit', 3500, 3500, '2023-01-06 19:56:23', 'Acc Creation Deposit', '198719871987', 'Saranika'),
(93, 18, 20, 'Credit', 26250, 28750, '2023-01-06 19:56:57', 'Member Pawning', ' ', 'Fisheries Pawning'),
(94, 26, 28, 'Credit', 3200, 3200, '2023-01-07 02:35:40', 'Acc Creation Deposit', '198219821982', 'Dayantha'),
(95, 27, 29, 'Credit', 2300, 2300, '2023-01-07 02:35:58', 'Acc Creation Deposit', '198019811980', 'Thanuja'),
(96, 26, 23, 'Credit', 17500, 21000, '2023-01-07 02:39:27', 'Member Pawning', ' ', 'Fisheries Pawning'),
(97, 6, 6, 'Credit', 21000, 104850, '2023-01-07 08:57:28', 'Vehicle Loan', ' ', 'Fisheries Loan'),
(98, 25, 27, 'Credit', 17500, 21000, '2023-01-07 08:59:19', 'Member Pawning', ' ', 'Fisheries Pawning'),
(99, 6, 6, 'Credit', 500, 105350, '2023-01-07 09:02:07', 'Pawning ID 9 Settle Amount', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mem_pass_pawnings`
--

CREATE TABLE `mem_pass_pawnings` (
  `pawningID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `AccountNo` varchar(30) NOT NULL,
  `Interest` varchar(30) NOT NULL,
  `PawningCreatedDate` varchar(10) NOT NULL,
  `settlementDate` varchar(30) NOT NULL,
  `totalWeight` varchar(30) NOT NULL,
  `pawningamount` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `ApprovedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mem_pass_pawnings`
--

INSERT INTO `mem_pass_pawnings` (`pawningID`, `memberID`, `AccountNo`, `Interest`, `PawningCreatedDate`, `settlementDate`, `totalWeight`, `pawningamount`, `amount`, `ApprovedBy`, `CreatedDate`) VALUES
(1, 5, '5', '19%', '2022-11-24', '2023-11-24', '2', '17500', '20825', '3', '2022-11-24 23:10:28'),
(2, 3, '3', '19%', '2022-11-25', '2023-11-25', '3', '26250', '31237.5', '3', '2022-11-25 10:53:25'),
(3, 4, '4', '19%', '2022-11-25', '2023-11-25', '3', '26250', '31237.5', '3', '2022-11-25 15:13:35'),
(4, 5, '5', '19%', '2022-11-25', '2023-11-25', '2.5', '17500', '20825', '3', '2022-11-25 15:14:25'),
(5, 6, '6', '19%', '2022-11-25', '2023-11-25', '3.5', '26250', '31237.5', '3', '2022-11-25 15:14:53'),
(6, 1, '1', '19%', '2022-11-25', '2023-11-25', '1', '8750', '10412.5', '3', '2022-11-25 15:15:42'),
(7, 7, '7', '19%', '2022-11-25', '2023-11-25', '2', '17500', '20825', '3', '2022-11-25 16:10:51'),
(8, 17, '14', '19%', '2022-11-26', '2023-11-26', '2', '17500', '20825', '3', '2022-11-26 11:07:39'),
(9, 6, '6', '19%', '2022-12-25', '2023-12-25', '2.5', '17500', '20825', '3', '2022-12-25 12:24:26'),
(10, 6, '6', '19%', '2022-12-25', '2023-12-25', '2.5', '17500', '20825', '3', '2022-12-25 20:13:02'),
(11, 12, '17', '19%', '2023-01-02', '2024-01-02', '2.75', '17500', '20825', '3', '2023-01-02 20:01:19'),
(12, 7, '7', '19%', '2023-01-05', '2024-01-05', '2.5', '17500', '20825', '3', '2023-01-06 02:46:56'),
(13, 8, '8', '19%', '2023-01-06', '2024-01-06', '1.5', '8750', '10412.5', '3', '2023-01-06 18:41:10'),
(14, 18, '20', '19%', '2023-01-06', '2024-01-06', '3', '26250', '31237.5', '3', '2023-01-06 19:56:57'),
(15, 26, '23', '19%', '2023-01-06', '2024-01-06', '2.3', '17500', '20825', '3', '2023-01-07 02:39:27'),
(16, 25, '27', '19%', '2023-01-07', '2024-01-07', '2.5', '17500', '20825', '3', '2023-01-07 08:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `nonmem_pawning_settlement`
--

CREATE TABLE `nonmem_pawning_settlement` (
  `Settle_ID` int(11) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `AccountNo` int(11) NOT NULL,
  `pawningID` int(11) NOT NULL,
  `PayAmount` int(11) NOT NULL,
  `InterestAmount` int(11) NOT NULL,
  `TotalPay` int(11) NOT NULL,
  `RemainAmount` int(11) NOT NULL,
  `PayDate` varchar(30) NOT NULL,
  `LastPaymentDate` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nonmem_pawning_settlement`
--

INSERT INTO `nonmem_pawning_settlement` (`Settle_ID`, `NIC`, `AccountNo`, `pawningID`, `PayAmount`, `InterestAmount`, `TotalPay`, `RemainAmount`, `PayDate`, `LastPaymentDate`, `CreatedDate`, `Status`) VALUES
(1, '199999995555', 5, 1, 17500, 326, 2826, 15000, '2022-12-28', '', '2022-12-28 21:03:21', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `non_member_account`
--

CREATE TABLE `non_member_account` (
  `account_No` int(11) NOT NULL,
  `NIC` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `AccType` varchar(30) NOT NULL,
  `TransType` varchar(30) NOT NULL,
  `TransAmount` int(11) NOT NULL,
  `TransDate` date NOT NULL,
  `CreatedBy` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_member_account`
--

INSERT INTO `non_member_account` (`account_No`, `NIC`, `FirstName`, `LastName`, `AccType`, `TransType`, `TransAmount`, `TransDate`, `CreatedBy`, `CreatedDate`) VALUES
(1, '198736524785', 'Saman', 'Fonseka', 'Personal Account', 'Deposit', 1800, '2022-11-24', '3', '2022-11-24 22:49:14'),
(2, '199012542365', 'Tharindu', 'Weerasekara', 'Personal Account', 'Deposit', 2200, '2022-11-24', '3', '2022-11-24 22:49:42'),
(3, '199014785263', 'Samantha', 'Silva', 'Personal Account', 'Deposit', 6000, '2022-11-24', '3', '2022-11-24 22:50:08'),
(4, '199956321452', 'Jagath ', 'Perera', 'Personal Account', 'Deposit', 2500, '2022-11-25', '3', '2022-11-25 15:05:56'),
(5, '199999995555', 'Heshan', 'Silva', 'Personal Account', 'Deposit', 3500, '2022-11-25', '3', '2022-11-25 15:06:22'),
(6, '199888885555', 'Sudhara', 'De Silva', 'Personal Account', 'Deposit', 2000, '2022-11-25', '3', '2022-11-25 15:07:14'),
(7, '200000000000', 'Thushari', 'Perera', 'Personal Account', 'Deposit', 1500, '2022-12-28', '3', '2022-12-28 13:10:04'),
(8, '199919991999', 'Sarath ', 'Wijesinghe', 'Personal Account', 'Deposit', 2100, '2023-01-05', '3', '2023-01-05 16:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `non_member_transactions`
--

CREATE TABLE `non_member_transactions` (
  `TransactionID` int(11) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `TransType` varchar(10) NOT NULL,
  `Amount` int(11) NOT NULL,
  `RunningBal` int(11) NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Description` varchar(300) NOT NULL,
  `FullName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_member_transactions`
--

INSERT INTO `non_member_transactions` (`TransactionID`, `NIC`, `AccNo`, `TransType`, `Amount`, `RunningBal`, `TransactionDate`, `Description`, `FullName`) VALUES
(1, '198736524785', 1, 'Credit', 1800, 1800, '2022-11-24 22:49:14', 'Non Mem Acc Creation Deposit', 'Saman'),
(2, '199012542365', 2, 'Credit', 2200, 2200, '2022-11-24 22:49:42', 'Non Mem Acc Creation Deposit', 'Tharindu'),
(3, '199014785263', 3, 'Credit', 6000, 6000, '2022-11-24 22:50:08', 'Non Mem Acc Creation Deposit', 'Samantha'),
(4, '199956321452', 4, 'Credit', 2500, 2500, '2022-11-25 15:05:56', 'Non Mem Acc Creation Deposit', 'Jagath '),
(5, '199999995555', 5, 'Credit', 3500, 3500, '2022-11-25 15:06:22', 'Non Mem Acc Creation Deposit', 'Heshan'),
(6, '199888885555', 6, 'Credit', 2000, 2000, '2022-11-25 15:07:14', 'Non Mem Acc Creation Deposit', 'Sudhara'),
(7, '199999995555', 5, 'Credit', 17500, 21000, '2022-11-25 15:08:00', 'Non Member Pawning', 'Fisheries Non Mem Pawning'),
(8, '200000000000', 7, 'Credit', 1500, 1500, '2022-12-28 13:10:04', 'Non Mem Acc Creation Deposit', 'Thushari'),
(9, '200000000000', 7, 'Credit', 17500, 19000, '2022-12-28 21:00:59', 'Non Member Pawning', 'Fisheries Non Mem Pawning'),
(10, '199919991999', 8, 'Credit', 2100, 2100, '2023-01-05 16:01:15', 'Non Mem Acc Creation Deposit', 'Sarath ');

-- --------------------------------------------------------

--
-- Table structure for table `non_mem_pass_pawnings`
--

CREATE TABLE `non_mem_pass_pawnings` (
  `pawningID` int(11) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `AccountNo` int(11) NOT NULL,
  `Interest` varchar(10) NOT NULL,
  `PawningCreatedDate` varchar(10) NOT NULL,
  `settlementDate` varchar(10) NOT NULL,
  `totalWeight` int(11) NOT NULL,
  `pawningamount` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `non_mem_pass_pawnings`
--

INSERT INTO `non_mem_pass_pawnings` (`pawningID`, `NIC`, `AccountNo`, `Interest`, `PawningCreatedDate`, `settlementDate`, `totalWeight`, `pawningamount`, `amount`, `ApprovedBy`, `CreatedDate`) VALUES
(1, '199999995555', 5, '19%', '2022-11-25', '2023-11-25', 2, 17500, 21000, 3, '2022-11-25 15:08:00'),
(2, '200000000000', 7, '19%', '2022-12-28', '2023-12-28', 2, 17500, 21000, 3, '2022-12-28 21:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `pass_donations`
--

CREATE TABLE `pass_donations` (
  `PassID` int(11) NOT NULL,
  `DonationID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `DonationAmount` int(11) NOT NULL,
  `DonationDate` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pass_donations`
--

INSERT INTO `pass_donations` (`PassID`, `DonationID`, `MemberID`, `AccNo`, `Description`, `DonationAmount`, `DonationDate`, `CreatedDate`, `CreatedBy`) VALUES
(1, 4, 4, 4, 'Medical Donation', 20000, '', '2022-11-25 10:14:29', 3),
(2, 1, 1, 1, 'Medical Donation', 10000, '', '2022-11-25 10:15:36', 3),
(3, 2, 3, 3, 'Medical Donation', 5000, '2022-11-25', '2022-11-25 10:20:40', 3),
(4, 8, 11, 12, 'Medical Donation', 15000, '2022-11-25', '2022-11-25 17:11:59', 3),
(5, 7, 7, 7, 'Medical Donation', 15000, '2022-11-25', '2022-11-25 20:19:17', 3),
(6, 5, 8, 8, 'Medical Donation', 15000, '2022-11-26', '2022-11-26 11:05:14', 3),
(7, 6, 6, 6, 'Medical Donation', 15000, '2022-11-26', '2022-11-26 11:05:22', 3),
(8, 9, 9, 10, 'Medical Donation', 15000, '2022-12-27', '2022-12-27 19:55:13', 3),
(9, 11, 14, 15, 'Medical Donation', 10000, '2022-12-28', '2022-12-28 19:37:45', 3),
(10, 12, 15, 16, 'Medical Donation', 10000, '2022-12-28', '2022-12-28 19:37:54', 3),
(11, 13, 17, 14, 'Medical Donation', 15000, '2023-01-05', '2023-01-05 12:38:59', 3),
(12, 14, 11, 12, 'Medical Donation', 15000, '2023-01-06', '2023-01-06 18:46:07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pass_loans`
--

CREATE TABLE `pass_loans` (
  `PassID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `LoanAmount` int(11) NOT NULL,
  `LoanDate` date NOT NULL,
  `NoOfMonths` int(11) NOT NULL,
  `Interest` varchar(100) NOT NULL,
  `MonthlyInstallment` varchar(100) NOT NULL,
  `TotalWithInterest` varchar(100) NOT NULL,
  `PaidStatus` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pass_loans`
--

INSERT INTO `pass_loans` (`PassID`, `LoanID`, `MemberID`, `AccNo`, `Description`, `LoanAmount`, `LoanDate`, `NoOfMonths`, `Interest`, `MonthlyInstallment`, `TotalWithInterest`, `PaidStatus`, `CreatedDate`, `CreatedBy`) VALUES
(1, 1, 1, 1, 'Personal Loan', 10000, '2022-11-07', 6, '19%', '1983', '11898', 'Settled', '2022-11-24 23:07:38', 3),
(2, 3, 3, 3, 'Personal Loan', 15000, '2022-11-16', 12, '19%', '1488', '17856', 'Pending', '2022-11-24 23:07:59', 3),
(3, 4, 5, 5, 'Vehicle Loan', 50000, '2022-11-25', 6, '19%', '9917', '59502', 'Pending', '2022-11-25 08:38:43', 3),
(4, 5, 8, 8, 'Personal Loan', 15000, '2022-11-25', 12, '19%', '1488', '17856', 'Pending', '2022-11-25 08:45:50', 3),
(5, 7, 9, 10, 'Personal Loan', 25000, '2022-11-25', 12, '19%', '2479', '29748', 'Pending', '2022-11-25 14:56:54', 3),
(6, 6, 4, 4, 'Personal Loan', 10000, '2022-11-25', 6, '19%', '1983', '11898', 'Settled', '2022-11-25 16:05:13', 3),
(7, 8, 8, 8, 'Personal Loan', 15000, '2022-11-25', 6, '19%', '2975', '17850', 'Pending', '2022-11-25 17:11:10', 3),
(8, 9, 9, 10, 'Personal Loan', 10000, '2022-11-26', 6, '19%', '1983', '11898', 'Pending', '2022-11-26 11:04:06', 3),
(9, 10, 10, 11, 'Personal Loan', 15000, '2022-11-26', 12, '19%', '1488', '17856', 'Pending', '2022-11-26 11:04:43', 3),
(10, 11, 11, 12, 'Personal Loan', 10000, '2022-12-27', 12, '19%', '992', '11904', 'Pending', '2022-12-27 23:14:00', 3),
(11, 13, 15, 16, 'Personal Loan', 10000, '2022-12-27', 6, '19%', '1983', '11898', 'Pending', '2022-12-27 23:14:10', 3),
(12, 12, 14, 15, 'Personal Loan', 10000, '2023-01-05', 12, '19%', '992', '11904', 'Pending', '2023-01-05 09:44:41', 3),
(13, 14, 17, 14, 'Personal Loan', 15000, '2023-01-05', 24, '19%', '744', '17856', 'Pending', '2023-01-05 09:44:51', 3),
(14, 15, 16, 13, 'Personal Loan', 15000, '2023-01-05', 6, '19%', '2975', '17850', 'Pending', '2023-01-05 16:19:04', 3),
(15, 16, 16, 13, 'Personal Loan', 15000, '2023-01-05', 24, '19%', '744', '17856', 'Pending', '2023-01-05 16:19:16', 3),
(16, 17, 7, 7, 'Personal Loan', 15000, '2023-01-06', 12, '19%', '1488', '17856', 'Pending', '2023-01-06 18:32:50', 3),
(17, 18, 6, 6, 'Vehicle Loan', 21000, '2023-01-07', 12, '19%', '2083', '24996', 'Pending', '2023-01-07 08:57:28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pawning_settlement`
--

CREATE TABLE `pawning_settlement` (
  `Settle_ID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `AccountNo` int(11) NOT NULL,
  `pawningID` int(11) NOT NULL,
  `PayAmount` int(11) NOT NULL,
  `InterestAmount` int(11) NOT NULL,
  `TotalPay` int(11) NOT NULL,
  `RemainAmount` int(11) NOT NULL,
  `PayDate` varchar(30) NOT NULL,
  `LastPaymentDate` varchar(30) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pawning_settlement`
--

INSERT INTO `pawning_settlement` (`Settle_ID`, `memberID`, `AccountNo`, `pawningID`, `PayAmount`, `InterestAmount`, `TotalPay`, `RemainAmount`, `PayDate`, `LastPaymentDate`, `CreatedDate`, `Status`) VALUES
(1, 3, 3, 2, 26250, 416, 2916, 23750, '2022-11-25', '', '2022-11-25 11:09:12', 'Settled'),
(2, 3, 3, 2, 26250, 12, 2512, 21250, '2022-11-26', '2022-11-25', '2022-11-26 11:08:54', 'Settled'),
(3, 3, 3, 2, 26250, 0, 21250, 0, '2022-11-26', '2022-11-26', '2022-11-26 11:09:49', 'Settled'),
(4, 6, 6, 10, 17500, 277, 2277, 15500, '2023-01-02', '', '2023-01-02 20:22:44', 'Pending'),
(5, 17, 14, 8, 17500, 346, 3346, 14500, '2023-01-02', '', '2023-01-02 20:23:36', 'Pending'),
(6, 6, 6, 10, 17500, 32, 1032, 14500, '2023-01-05', '2023-01-02', '2023-01-06 03:27:48', 'Pending'),
(7, 17, 14, 8, 17500, 30, 2030, 12500, '2023-01-05', '2023-01-02', '2023-01-06 03:36:42', 'Pending'),
(8, 6, 6, 9, 17500, 277, 1777, 16000, '2023-01-06', '', '2023-01-06 18:42:20', 'Settled'),
(9, 6, 6, 10, 17500, 15, 2515, 12000, '2023-01-06', '2023-01-05', '2023-01-06 19:14:00', 'Pending'),
(10, 6, 6, 9, 17500, 8, 2508, 13500, '2023-01-07', '2023-01-06', '2023-01-07 09:00:43', 'Settled');

-- --------------------------------------------------------

--
-- Table structure for table `reject_loans`
--

CREATE TABLE `reject_loans` (
  `ApprovalID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AccNo` int(11) NOT NULL,
  `LoanType` varchar(30) NOT NULL,
  `Amount` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `RejectedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `RejectedBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reject_loans`
--

INSERT INTO `reject_loans` (`ApprovalID`, `LoanID`, `MemberID`, `AccNo`, `LoanType`, `Amount`, `CreatedDate`, `RejectedDate`, `RejectedBy`, `Status`) VALUES
(1, 2, 1, 1, ' Personal Loan', 10000, ' 2022-11-24 22:53:12', '2022-11-24 23:05:14', 1, 'BOD Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `previladge` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `password`, `previladge`) VALUES
(1, 1, '1', 'Admin'),
(2, 2, '2', 'BOD'),
(5, 3, '3', 'Banking'),
(6, 5, 'Kithupa123', 'Admin'),
(7, 8, 'Dulitha123', 'BOD'),
(8, 10, 'hello', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_donations`
--
ALTER TABLE `approval_donations`
  ADD PRIMARY KEY (`ApprovalID`);

--
-- Indexes for table `approval_loans`
--
ALTER TABLE `approval_loans`
  ADD PRIMARY KEY (`ApprovalID`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `donationtobod`
--
ALTER TABLE `donationtobod`
  ADD PRIMARY KEY (`BODID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_ID`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`account_no`);

--
-- Indexes for table `interest_rates`
--
ALTER TABLE `interest_rates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loantobod`
--
ALTER TABLE `loantobod`
  ADD PRIMARY KEY (`BODID`);

--
-- Indexes for table `loan_memguarantor`
--
ALTER TABLE `loan_memguarantor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loan_settlement`
--
ALTER TABLE `loan_settlement`
  ADD PRIMARY KEY (`Settle_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `member_account`
--
ALTER TABLE `member_account`
  ADD PRIMARY KEY (`account_no`);

--
-- Indexes for table `member_dependant`
--
ALTER TABLE `member_dependant`
  ADD PRIMARY KEY (`dep_ID`);

--
-- Indexes for table `member_donation`
--
ALTER TABLE `member_donation`
  ADD PRIMARY KEY (`DonationID`);

--
-- Indexes for table `member_loan`
--
ALTER TABLE `member_loan`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `member_loan_temp`
--
ALTER TABLE `member_loan_temp`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `member_transactions`
--
ALTER TABLE `member_transactions`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `mem_pass_pawnings`
--
ALTER TABLE `mem_pass_pawnings`
  ADD PRIMARY KEY (`pawningID`);

--
-- Indexes for table `nonmem_pawning_settlement`
--
ALTER TABLE `nonmem_pawning_settlement`
  ADD PRIMARY KEY (`Settle_ID`);

--
-- Indexes for table `non_member_account`
--
ALTER TABLE `non_member_account`
  ADD PRIMARY KEY (`account_No`);

--
-- Indexes for table `non_member_transactions`
--
ALTER TABLE `non_member_transactions`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `non_mem_pass_pawnings`
--
ALTER TABLE `non_mem_pass_pawnings`
  ADD PRIMARY KEY (`pawningID`);

--
-- Indexes for table `pass_donations`
--
ALTER TABLE `pass_donations`
  ADD PRIMARY KEY (`PassID`);

--
-- Indexes for table `pass_loans`
--
ALTER TABLE `pass_loans`
  ADD PRIMARY KEY (`PassID`);

--
-- Indexes for table `pawning_settlement`
--
ALTER TABLE `pawning_settlement`
  ADD PRIMARY KEY (`Settle_ID`);

--
-- Indexes for table `reject_loans`
--
ALTER TABLE `reject_loans`
  ADD PRIMARY KEY (`ApprovalID`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_donations`
--
ALTER TABLE `approval_donations`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `approval_loans`
--
ALTER TABLE `approval_loans`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `donationtobod`
--
ALTER TABLE `donationtobod`
  MODIFY `BODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `account_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `interest_rates`
--
ALTER TABLE `interest_rates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loantobod`
--
ALTER TABLE `loantobod`
  MODIFY `BODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `loan_memguarantor`
--
ALTER TABLE `loan_memguarantor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `loan_settlement`
--
ALTER TABLE `loan_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `member_account`
--
ALTER TABLE `member_account`
  MODIFY `account_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `member_dependant`
--
ALTER TABLE `member_dependant`
  MODIFY `dep_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `member_donation`
--
ALTER TABLE `member_donation`
  MODIFY `DonationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `member_loan`
--
ALTER TABLE `member_loan`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `member_loan_temp`
--
ALTER TABLE `member_loan_temp`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `member_transactions`
--
ALTER TABLE `member_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `mem_pass_pawnings`
--
ALTER TABLE `mem_pass_pawnings`
  MODIFY `pawningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nonmem_pawning_settlement`
--
ALTER TABLE `nonmem_pawning_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `non_member_account`
--
ALTER TABLE `non_member_account`
  MODIFY `account_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `non_member_transactions`
--
ALTER TABLE `non_member_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `non_mem_pass_pawnings`
--
ALTER TABLE `non_mem_pass_pawnings`
  MODIFY `pawningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pass_donations`
--
ALTER TABLE `pass_donations`
  MODIFY `PassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pass_loans`
--
ALTER TABLE `pass_loans`
  MODIFY `PassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pawning_settlement`
--
ALTER TABLE `pawning_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reject_loans`
--
ALTER TABLE `reject_loans`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
