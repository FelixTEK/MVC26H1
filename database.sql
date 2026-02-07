-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2026 at 10:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `district` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `year`, `district`) VALUES
(1, 2566, 'กรุงเทพมหานคร เขต 4'),
(2, 2566, 'ขอนแก่น เขต 1'),
(3, 2569, 'นครสวรรค์ เขต 1'),
(4, 2562, 'ปทุมธานี เขต 2'),
(5, 2562, 'เชียงใหม่ เขต 1'),
(6, 2569, 'ตรัง เขต 4');

-- --------------------------------------------------------

--
-- Table structure for table `politicians`
--

CREATE TABLE `politicians` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `party` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `politicians`
--

INSERT INTO `politicians` (`id`, `name`, `party`) VALUES
(40044144, 'พลเอกเข้มแข็ง แรงดี', 'พรรคนั้น'),
(41424224, 'นายสมชาย ขายเก่ง', 'พรรคนี้'),
(41514221, 'ดร.วิชาการ สมัยใหม่', 'พรรคนู้น'),
(42185214, 'นายใจดี มีตังค์', 'พรรคผ่อน'),
(42275216, 'นางสาวจริงใจ รักชาติ', 'พรรคก่อน');

-- --------------------------------------------------------

--
-- Table structure for table `promises`
--

CREATE TABLE `promises` (
  `id` int(11) NOT NULL,
  `politician_id` int(8) NOT NULL,
  `details` text NOT NULL,
  `date_announced` date NOT NULL,
  `status` enum('pending','in_progress','silent') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `promises`
--

INSERT INTO `promises` (`id`, `politician_id`, `details`, `date_announced`, `status`) VALUES
(1, 42185214, 'ลดเวลางานเหลือ 4 วัน/สัปดาห์', '2023-05-01', 'in_progress'),
(2, 42185214, 'แจกหมอนยางพาราฟรีทุกบ้าน', '2023-05-01', 'pending'),
(3, 42275216, 'ปฏิรูปรถไฟเพื่อความทันสมัยและยั่งยืน', '2023-04-15', 'in_progress'),
(4, 42275216, 'ทางเท้าเดินสะดวกล้อไม่สะดุ้ง', '2023-04-15', 'in_progress'),
(5, 41424224, 'สินค้าเกษตรในประเทศต้องแข่งขันได้', '2023-03-20', 'pending'),
(6, 41424224, 'ส่งเสริมธุรกิจขายอะไหล่ยานยนต์และเซียงกง', '2023-03-20', 'silent'),
(7, 41514221, 'เรียน Coding ฟรีตั้งแต่อนุบาล', '2023-02-10', 'in_progress'),
(8, 41514221, 'ส่งเสริมการผลิตเซมิคอนดักเตอร์โดยธุรกิจในประเทศ', '2023-02-10', 'pending'),
(9, 40044144, 'โรงยิมประชารัฐ', '2023-01-05', 'in_progress'),
(10, 40044144, 'ฟิตช่วยชาติ', '2023-01-05', 'silent');

-- --------------------------------------------------------

--
-- Table structure for table `promise_updates`
--

CREATE TABLE `promise_updates` (
  `id` int(11) NOT NULL,
  `promise_id` int(11) NOT NULL,
  `update_date` datetime DEFAULT current_timestamp(),
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `promise_updates`
--

INSERT INTO `promise_updates` (`id`, `promise_id`, `update_date`, `details`) VALUES
(1, 1, '2023-06-01 09:00:00', 'กระทรวงแรงงานกำลังศึกษาผลกระทบและร่างกฎหมาย'),
(2, 3, '2023-06-15 14:30:00', 'รฟท. อนุมัติจัดซื้อหัวรถจักรใหม่แล้ว'),
(3, 4, '2023-06-20 10:00:00', 'กทม. เริ่มปรับปรุงทางเท้าเส้นสุขุมวิท'),
(4, 7, '2023-07-01 10:00:00', 'กระทรวงศึกษาธิการบรรจุวิชา Coding เข้าหลักสูตรแล้ว'),
(5, 9, '2023-08-20 11:00:00', 'เริ่มสำรวจพื้นที่ก่อสร้างโรงยิมใน 10 จังหวัดนำร่อง'),
(6, 5, '2026-02-07 16:07:46', 'กำลังศึกษาความเป็นไปได้ในการแข่งขันและการพัฒนามาตรการช่วยเหลือและส่งเสริมเกษตรกร');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `politicians`
--
ALTER TABLE `politicians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promises`
--
ALTER TABLE `promises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `politician_id` (`politician_id`);

--
-- Indexes for table `promise_updates`
--
ALTER TABLE `promise_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promise_id` (`promise_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promises`
--
ALTER TABLE `promises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promise_updates`
--
ALTER TABLE `promise_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `promises`
--
ALTER TABLE `promises`
  ADD CONSTRAINT `promises_ibfk_1` FOREIGN KEY (`politician_id`) REFERENCES `politicians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promise_updates`
--
ALTER TABLE `promise_updates`
  ADD CONSTRAINT `promise_updates_ibfk_1` FOREIGN KEY (`promise_id`) REFERENCES `promises` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
