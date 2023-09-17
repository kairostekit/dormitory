-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2023 at 08:36 AM
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
  `ACC_STATUS` varchar(2) DEFAULT '1',
  `ACC_STAMP` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ACC_USERNAME` varchar(50) NOT NULL,
  `ACC_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACC_ID`, `ACC_NAME`, `ACC_IMGE`, `ACC_STATUS`, `ACC_STAMP`, `ACC_USERNAME`, `ACC_PASSWORD`) VALUES
(1, 'ROOT USER', 'user.png', '1', '2023-09-16 19:17:26', 'root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `issue_receipt`
--

CREATE TABLE `issue_receipt` (
  `IRC_ID` int(11) NOT NULL COMMENT 'รหัสใบเสร็จ',
  `RM_ID` int(11) NOT NULL COMMENT 'รหัสห้อง',
  `USER_ID` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `IRC_STAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'ออกวันที่ เดือน',
  `IRC_STATUS` varchar(10) DEFAULT '1',
  `IRC_TOTAL` decimal(10,2) NOT NULL COMMENT 'ยอดรวม',
  `IRC_ROOMRENT` decimal(10,2) NOT NULL COMMENT 'ค่าห้อง',
  `IRC_ELECTRICCTY` decimal(10,2) NOT NULL COMMENT '	ค่าไฟ',
  `IRC_WATER` decimal(10,2) NOT NULL COMMENT 'ค่าน้ำ 0-10 เหมาจ่าย ต่อไป 10/unit',
  `IRC_STATUS_CANCEL` tinyint(1) DEFAULT 0 COMMENT 'ยกเลิก 1  ไม่ยกเลิก 0',
  `IRC_PAYMENTFORMAT` varchar(5) DEFAULT NULL COMMENT '1 โอน 2 เงินสด',
  `IRC_PAYMENT_OK` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'จ่าย 1 ไม่จ่าย 0',
  `IRC_YEAR` year(4) NOT NULL COMMENT 'บินของปี',
  `IRC_MONTH_ID` int(11) NOT NULL COMMENT 'เดือนของบิล'
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
  `MCO_RESERVE_PAY` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'ค่าสัญญาจอง 1 จ่ายแล้ว  0 ยังไม่จ่าย',
  `MCO_MOVEIN` decimal(10,2) NOT NULL COMMENT 'ค่าสัญญาย้ายเข้า',
  `MCO_MOVEIN_PAY` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ค่าย้ายเข้า 1 จ่ายแล้ว  0 ยังไม่จ่าย',
  `MCO_CONDITIONS` text NOT NULL COMMENT 'เงือนไขการคืนเงิน',
  `MCO_DATE` date DEFAULT NULL COMMENT 'ทำสัญญาวันที่',
  `MCO_STATUS_CANCEL` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'C = 1 NC = 0',
  `MCO_STATUS` varchar(30) NOT NULL DEFAULT '1',
  `MCO_STATUS_SUCCESS` varchar(1) NOT NULL DEFAULT '0' COMMENT 'คืนห้อง 1  เช่าอยู่ 0',
  `MCO_USER_PHONE` varchar(100) NOT NULL,
  `MCO_USER_NAME` varchar(100) NOT NULL,
  `MCO_MOVEIN_DATE` date NOT NULL,
  `MCO_ROOM_TYPE_NAME` varchar(100) NOT NULL,
  `MCO_DETAILS` text NOT NULL,
  `MCO_ROOMRENT` decimal(10,2) NOT NULL,
  `MCO_RM_NAME` varchar(100) NOT NULL,
  `MCO_RM_NUMBER` varchar(100) NOT NULL,
  `MCO_STATUS_MOVE` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `month_tbl`
--

CREATE TABLE `month_tbl` (
  `MONTH_ID` int(11) NOT NULL,
  `MONTH_NAME` varchar(100) NOT NULL,
  `MONTH_STATUS` varchar(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `month_tbl`
--

INSERT INTO `month_tbl` (`MONTH_ID`, `MONTH_NAME`, `MONTH_STATUS`) VALUES
(1, 'มกราคม', '1'),
(2, 'กุมภาพันธ์', '1'),
(3, 'มีนาคม', '1'),
(4, 'เมษายน', '1'),
(5, 'พฤษภาคม', '1'),
(6, 'มิถุนายน', '1'),
(7, 'กรกฎาคม ', '1'),
(8, 'สิงหาคม', '1'),
(9, 'กันยายน', '1'),
(10, 'ตุลาคม', '1'),
(11, 'พฤศจิกายน', '1'),
(12, 'ธันวาคม', '1');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RM_ID` int(11) NOT NULL,
  `RM_NUMBER` varchar(100) NOT NULL COMMENT 'เลขห้อง',
  `RM_STATUS` varchar(30) NOT NULL DEFAULT '1',
  `RM_USE` varchar(13) NOT NULL DEFAULT '1' COMMENT '1 ว่าง  S ถูกจอง 0 ไม่ว่าง',
  `RT_ID` int(11) NOT NULL COMMENT 'รหัส TYPE',
  `RM_NAME` varchar(255) NOT NULL COMMENT 'ชื่อห้อง',
  `USER_ID` int(11) DEFAULT NULL COMMENT 'คนที่พัก',
  `RM_MOVEINDATE` date DEFAULT NULL COMMENT 'วันที่เริ่มเข้าอยู่',
  `RM_DETAILS` text DEFAULT NULL,
  `RM_MCO_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RM_ID`, `RM_NUMBER`, `RM_STATUS`, `RM_USE`, `RT_ID`, `RM_NAME`, `USER_ID`, `RM_MOVEINDATE`, `RM_DETAILS`, `RM_MCO_ID`) VALUES
(1, '101', '1', '1', 1, 'Manor', NULL, NULL, 'เตียงเดี่ยว 6 ฟุต, เครื่องฟอกอากาศ, พัดลม, Wifi Router ส่วนตัว,แอร์, ทีวี, ตู้เย็น, กล่องจาน, เครื่องทำน้ำอุ่น, เฟอร์นิเจอร์ครบ)', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `RT_ID` int(11) NOT NULL,
  `RT_NAME` varchar(50) NOT NULL,
  `RT_STATUS` varchar(5) DEFAULT '1',
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
  `RT_CONDITIONS` text NOT NULL DEFAULT 'คืนตอนหมดสัญญา โอนเงินคืนหลังจากคืน ห้อง 2 สัปดาห์' COMMENT 'เงือนไขการคืนเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`RT_ID`, `RT_NAME`, `RT_STATUS`, `RT_STAMP`, `RT_DEPOSIT`, `RT_RESERVE`, `RT_MOVEIN`, `RT_WATER`, `RT_ELECTRICCTY`, `RT_DETAILS`, `RT_ROOMRENT`, `RT_ROOMSIZE`, `RT_ROOMSIZE_D`, `RT_CONDITIONS`) VALUES
(1, 'Manor', '1', '2023-09-16 19:26:45', '8000.00', '3000.00', '5000.00', '10.00', '8.00', 'แอร์, ทีวี, ตู้เย็น, กล่องจาน, เครื่องทำน้ำอุ่น, เฟอร์นิเจอร์, เตียงคู่', '4000.00', '29.00', '4x5', 'คืนตอนหมดสัญญา โอนเงินคืนหลังจากคืน ห้อง 2 สัปดาห์'),
(2, 'แมเนอร์มอล (Manormal) เช่า 5,500', '1', '2023-09-16 19:30:28', '10000.00', '5000.00', '5000.00', '10.00', '8.00', 'เตียงเดี่ยว 5 ฟุต, เครื่องฟอกอากาศ, พัดลม, Wifi Router ส่วนตัว,แอร์, ทีวี, ตู้เย็น, กล่องจาน, เครื่องทำน้ำอุ่น, เฟอร์นิเจอร์ครบ)', '5500.00', '39.00', '5X8', 'คืนตอนหมดสัญญา โอนเงินคืนหลังจากคืน ห้อง 2 สัปดาห์'),
(3, 'แมเนอร์มอล (Manormal) เช่า 5,800', '1', '2023-09-16 19:30:28', '10000.00', '5000.00', '5000.00', '10.00', '8.00', 'เตียงเดี่ยว 6 ฟุต, เครื่องฟอกอากาศ, พัดลม, Wifi Router ส่วนตัว,แอร์, ทีวี, ตู้เย็น, กล่องจาน, เครื่องทำน้ำอุ่น, เฟอร์นิเจอร์ครบ)', '5800.00', '48.00', '5X8', 'คืนตอนหมดสัญญา โอนเงินคืนหลังจากคืน ห้อง 2 สัปดาห์'),
(4, 'ร้านค้ารอบหอพัก', '1', '2023-09-16 19:34:14', '10000.00', '5000.00', '5000.00', '10.00', '8.00', '-', '4500.00', '56.00', '4X8', 'คืนตอนหมดสัญญา โอนเงินคืนหลังจากคืน ห้อง 2 สัปดาห์');

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
  `ACC_ID` int(11) DEFAULT NULL COMMENT 'รหัสแอดมัน',
  `USER_RM_ID` int(11) DEFAULT NULL,
  `USER_STATUS` varchar(11) NOT NULL DEFAULT '1',
  `USER_CITIZEN` varchar(20) DEFAULT NULL COMMENT '13 ปปช',
  `USER_MCO_ID` int(11) DEFAULT NULL
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
  ADD KEY `d` (`USER_ID`),
  ADD KEY `x` (`IRC_MONTH_ID`);

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
-- Indexes for table `month_tbl`
--
ALTER TABLE `month_tbl`
  ADD PRIMARY KEY (`MONTH_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RM_ID`),
  ADD KEY `us` (`USER_ID`),
  ADD KEY `sdf` (`RT_ID`),
  ADD KEY `rt` (`RM_MCO_ID`);

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
  ADD KEY `dddd` (`ACC_ID`),
  ADD KEY `ccc` (`USER_RM_ID`);

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
-- AUTO_INCREMENT for table `month_tbl`
--
ALTER TABLE `month_tbl`
  MODIFY `MONTH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `RT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `d` FOREIGN KEY (`USER_ID`) REFERENCES `users_info` (`USER_ID`),
  ADD CONSTRAINT `x` FOREIGN KEY (`IRC_MONTH_ID`) REFERENCES `month_tbl` (`MONTH_ID`);

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
  ADD CONSTRAINT `rt` FOREIGN KEY (`RM_MCO_ID`) REFERENCES `make_contract` (`MCO_ID`),
  ADD CONSTRAINT `sdf` FOREIGN KEY (`RT_ID`) REFERENCES `room_type` (`RT_ID`),
  ADD CONSTRAINT `us` FOREIGN KEY (`USER_ID`) REFERENCES `users_info` (`USER_ID`);

--
-- Constraints for table `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `ccc` FOREIGN KEY (`USER_RM_ID`) REFERENCES `room` (`RM_ID`),
  ADD CONSTRAINT `dddd` FOREIGN KEY (`ACC_ID`) REFERENCES `account` (`ACC_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
