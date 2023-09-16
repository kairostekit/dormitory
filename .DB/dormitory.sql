-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 08:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormitory`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ACC_ID` int(11) NOT NULL,
  `ACC_NAME` varchar(100) NOT NULL,
  `ACC_IMGE` varchar(100) NOT NULL DEFAULT 'user.png',
  `ACC_STATUS` varchar(2) DEFAULT NULL,
  `ACC_STAMP` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ACC_USERNAME` varchar(50) NOT NULL,
  `ACC_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACC_ID`, `ACC_NAME`, `ACC_IMGE`, `ACC_STATUS`, `ACC_STAMP`, `ACC_USERNAME`, `ACC_PASSWORD`) VALUES
(1, 'ADMIN ADMIN', 'user.png', NULL, '2023-09-15 00:14:57', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `issue_receipt`
--

CREATE TABLE `issue_receipt` (
  `IRC_ID` int(11) NOT NULL COMMENT 'รหัสใบเสร็จ',
  `RM_ID` int(11) NOT NULL COMMENT 'รหัสห้อง',
  `USER_ID` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `IRC_DATE` datetime NOT NULL COMMENT 'ออกวันที่ เดือน',
  `IRC_STATUS` varchar(10) NOT NULL,
  `IRC_TOTAL` decimal(10,2) NOT NULL COMMENT 'ยอดรวม',
  `IRC_ROOMRENT` decimal(10,2) NOT NULL COMMENT 'ค่าห้อง',
  `IRC_ELECTRICCTY` decimal(10,2) NOT NULL COMMENT '	ค่าไฟ',
  `IRC_WATER` decimal(10,2) NOT NULL COMMENT 'ค่าน้ำ 0-10 เหมาจ่าย ต่อไป 10/unit',
  `IRC_USEPAY` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'สถานะการจ่าย 1 จ่าย 0 ไม่จ่าย',
  `IRC_STATUS_CANCEL` tinyint(1) DEFAULT 0 COMMENT 'ยกเลิก 1  ไม่ยกเลิก 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_receipt_details`
--

CREATE TABLE `issue_receipt_details` (
  `IRD_ID` int(11) NOT NULL,
  `IRC_ID` int(11) NOT NULL,
  `IRD_LISTNAME` varchar(100) NOT NULL,
  `IRD_PERVIOUS` decimal(10,2) DEFAULT NULL COMMENT 'เลขครั้งก่อน',
  `IRD_THISNUM` decimal(10,2) DEFAULT NULL COMMENT 'เลขครั้งนี้',
  `IRD_UNITSUSED` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนหนวยที่ใช้',
  `IRD_PERUNITS` decimal(10,2) DEFAULT NULL COMMENT 'หน่วยละ',
  `IRD_UNITSUM` decimal(10,2) NOT NULL COMMENT 'ราคารวม',
  `IRD_DETAILS` text NOT NULL COMMENT 'เพิ่มเติม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `make_contract`
--

CREATE TABLE `make_contract` (
  `MCO_ID` int(11) NOT NULL,
  `RM_ID` int(11) NOT NULL,
  `MCO_DEPOSIT` decimal(10,2) NOT NULL COMMENT 'เงินประกัน	',
  `MCO_RESERVE` decimal(10,2) NOT NULL COMMENT 'ค่าสัญญาจอง',
  `USER_ID` int(11) NOT NULL,
  `MCO_RESERVE_PAY` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ค่าสัญญาจอง 1 จ่ายแล้ว  0 ยังไม่จ่าย',
  `MCO_MOVEIN` decimal(10,2) NOT NULL COMMENT 'ค่าสัญญาย้ายเข้า',
  `MCO_MOVEIN_PAY` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ค่าย้ายเข้า 1 จ่ายแล้ว  0 ยังไม่จ่าย',
  `MCO_CONDITIONS` text NOT NULL COMMENT 'เงือนไขการคืนเงิน',
  `MCO_DATE` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ทำสัญญาวันที่',
  `MCO_STATUS_CANCEL` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'C = 1 NC = 0',
  `MCO_STATUS` varchar(30) NOT NULL,
  `MCO_STATUS_SUCCESS` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'จบ 1  ยังไม่จบ 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RM_ID` int(11) NOT NULL,
  `RM_NUMBER` varchar(100) NOT NULL COMMENT 'เลขห้อง',
  `RM_DETAILS` text NOT NULL COMMENT 'รายละเอียด',
  `RM_STATUS` varchar(30) NOT NULL,
  `RM_USE` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 ว่าง  0 ไม่ว่าง',
  `RT_ID` int(11) NOT NULL COMMENT 'รหัส TYPE',
  `RM_NAME` varchar(255) NOT NULL COMMENT 'ชื่อห้อง',
  `USER_ID` int(11) NOT NULL COMMENT 'คนที่พัก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `RT_ID` int(11) NOT NULL,
  `RT_NAME` varchar(50) NOT NULL,
  `RT_STATUS` varchar(5) DEFAULT NULL,
  `RT_STAMP` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RT_DEPOSIT` decimal(10,2) DEFAULT NULL COMMENT 'เงินประกัน',
  `RT_RESERVE` decimal(10,2) DEFAULT NULL COMMENT 'ทำสัญญาจอง',
  `RT_MOVEIN` decimal(10,2) DEFAULT NULL COMMENT 'ทำสัญญาย้ายเข้า',
  `RT_WATER` decimal(10,2) DEFAULT 10.00 COMMENT 'ค่าน้ำ  0-10 เหมาจ่าย ต่อไป 10/unit',
  `RT_ELECTRICCTY` decimal(10,2) DEFAULT 8.00 COMMENT 'ค่าไฟ',
  `RT_DETAILS` text DEFAULT NULL COMMENT 'รายละเอียดห้อง',
  `RT_ROOMRENT` decimal(10,2) DEFAULT NULL COMMENT 'ค่าห้อง',
  `RT_ROOMSIZE` decimal(10,2) DEFAULT NULL COMMENT 'ตร.ม',
  `RT_ROOMSIZE_D` varchar(50) DEFAULT NULL COMMENT 'รายละเอียดขนาดห้อง',
  `RT_CONDITIONS` text NOT NULL COMMENT 'เงือนไขการคืนเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `USER_PHONE` varchar(50) NOT NULL COMMENT 'เบอร์',
  `USER_DETAILS` text NOT NULL COMMENT 'รายละเอียด',
  `USER_STAMP` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ACC_ID` int(11) DEFAULT NULL COMMENT 'รหัสแอดมัน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ACC_ID`);

--
-- Indexes for table `issue_receipt`
--
ALTER TABLE `issue_receipt`
  ADD PRIMARY KEY (`IRC_ID`),
  ADD KEY `c` (`RM_ID`),
  ADD KEY `d` (`USER_ID`);

--
-- Indexes for table `issue_receipt_details`
--
ALTER TABLE `issue_receipt_details`
  ADD PRIMARY KEY (`IRD_ID`),
  ADD KEY `ds` (`IRC_ID`);

--
-- Indexes for table `make_contract`
--
ALTER TABLE `make_contract`
  ADD PRIMARY KEY (`MCO_ID`),
  ADD KEY `dsccccc` (`RM_ID`),
  ADD KEY `fgergergerg` (`USER_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RM_ID`),
  ADD KEY `a` (`RT_ID`),
  ADD KEY `us` (`USER_ID`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`RT_ID`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `dddd` (`ACC_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ACC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issue_receipt`
--
ALTER TABLE `issue_receipt`
  MODIFY `IRC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสใบเสร็จ';

--
-- AUTO_INCREMENT for table `issue_receipt_details`
--
ALTER TABLE `issue_receipt_details`
  MODIFY `IRD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `make_contract`
--
ALTER TABLE `make_contract`
  MODIFY `MCO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RM_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `RT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issue_receipt`
--
ALTER TABLE `issue_receipt`
  ADD CONSTRAINT `c` FOREIGN KEY (`RM_ID`) REFERENCES `room` (`RM_ID`),
  ADD CONSTRAINT `d` FOREIGN KEY (`USER_ID`) REFERENCES `users_info` (`USER_ID`);

--
-- Constraints for table `issue_receipt_details`
--
ALTER TABLE `issue_receipt_details`
  ADD CONSTRAINT `ds` FOREIGN KEY (`IRC_ID`) REFERENCES `issue_receipt` (`IRC_ID`);

--
-- Constraints for table `make_contract`
--
ALTER TABLE `make_contract`
  ADD CONSTRAINT `dsccccc` FOREIGN KEY (`RM_ID`) REFERENCES `room` (`RM_ID`),
  ADD CONSTRAINT `fgergergerg` FOREIGN KEY (`USER_ID`) REFERENCES `users_info` (`USER_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `a` FOREIGN KEY (`RT_ID`) REFERENCES `room_type` (`RT_ID`),
  ADD CONSTRAINT `us` FOREIGN KEY (`USER_ID`) REFERENCES `users_info` (`USER_ID`);

--
-- Constraints for table `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `dddd` FOREIGN KEY (`ACC_ID`) REFERENCES `account` (`ACC_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
