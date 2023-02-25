-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 03:18 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fisheries`
--
CREATE DATABASE IF NOT EXISTS `fisheries` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fisheries`;

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
  `ApprovalDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ApprovalBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `ApprovalDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ApprovalBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `TransactionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interest_rates`
--

CREATE TABLE `interest_rates` (
  `ID` int(11) NOT NULL,
  `Loan_Type` varchar(30) NOT NULL,
  `Months` int(11) NOT NULL,
  `Interest_Rate` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `loan_memguarantor`
--

CREATE TABLE `loan_memguarantor` (
  `ID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `GuarantorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `TransactionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(150) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `FullName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `TransactionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(300) NOT NULL,
  `FullName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `RejectedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RejectedBy` int(11) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, 3, '3', 'Banking');

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
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval_loans`
--
ALTER TABLE `approval_loans`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donationtobod`
--
ALTER TABLE `donationtobod`
  MODIFY `BODID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `account_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interest_rates`
--
ALTER TABLE `interest_rates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loantobod`
--
ALTER TABLE `loantobod`
  MODIFY `BODID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_memguarantor`
--
ALTER TABLE `loan_memguarantor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_settlement`
--
ALTER TABLE `loan_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_account`
--
ALTER TABLE `member_account`
  MODIFY `account_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_dependant`
--
ALTER TABLE `member_dependant`
  MODIFY `dep_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_donation`
--
ALTER TABLE `member_donation`
  MODIFY `DonationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_loan`
--
ALTER TABLE `member_loan`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_loan_temp`
--
ALTER TABLE `member_loan_temp`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_transactions`
--
ALTER TABLE `member_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mem_pass_pawnings`
--
ALTER TABLE `mem_pass_pawnings`
  MODIFY `pawningID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nonmem_pawning_settlement`
--
ALTER TABLE `nonmem_pawning_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_member_account`
--
ALTER TABLE `non_member_account`
  MODIFY `account_No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_member_transactions`
--
ALTER TABLE `non_member_transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `non_mem_pass_pawnings`
--
ALTER TABLE `non_mem_pass_pawnings`
  MODIFY `pawningID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pass_donations`
--
ALTER TABLE `pass_donations`
  MODIFY `PassID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pass_loans`
--
ALTER TABLE `pass_loans`
  MODIFY `PassID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pawning_settlement`
--
ALTER TABLE `pawning_settlement`
  MODIFY `Settle_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reject_loans`
--
ALTER TABLE `reject_loans`
  MODIFY `ApprovalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
