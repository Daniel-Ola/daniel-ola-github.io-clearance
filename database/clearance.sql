-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 11:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance_status`
--

CREATE TABLE `clearance_status` (
  `clearance_status_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `addinfo` text NOT NULL,
  `status` int(11) NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  `approve` varchar(500) DEFAULT NULL,
  `reason` text,
  `approved_by` varchar(500) DEFAULT NULL,
  `approved_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clearance_status`
--

INSERT INTO `clearance_status` (`clearance_status_id`, `member_id`, `department_id`, `priority_id`, `addinfo`, `status`, `createdon`, `updatedon`, `approve`, `reason`, `approved_by`, `approved_on`) VALUES
(1, 11, 3, 4, '', 3, '2018-01-11 22:59:39', '2018-01-12 15:47:01', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(2, 11, 2, 5, 'sfsfs', 3, '2018-01-12 15:47:01', '2018-01-13 12:48:27', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(3, 12, 3, 4, '', 0, '2018-01-12 15:53:11', '2018-01-12 15:53:43', 'Yes', 'Thsjdsds', '4', '2018-06-08 11:03:10'),
(4, 12, 2, 5, '', 3, '2018-01-12 15:53:43', '2018-01-12 15:54:10', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(5, 12, 3, 4, '', 5, '2018-01-12 15:54:10', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(6, 13, 3, 4, 'hdfhfs', 3, '2018-01-13 09:40:30', '2018-01-13 09:55:01', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(7, 13, 2, 5, 'dfhdhfhfd', 3, '2018-01-13 09:55:01', '2018-01-13 10:07:14', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(8, 13, 3, 4, '', 5, '2018-01-13 10:07:14', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(9, 14, 3, 4, 'jjjj', 3, '2018-01-13 10:29:32', '2018-01-13 10:37:24', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(10, 14, 2, 5, 'sdsds', 3, '2018-01-13 10:37:24', '2018-01-13 10:37:40', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(11, 14, 4, 6, 'shdgshdgshdsd', 3, '2018-01-13 10:37:40', '2018-01-13 11:03:44', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(12, 11, 4, 6, '', 5, '2018-01-13 12:48:27', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(13, 15, 3, 4, 'shdshds', 3, '2018-01-08 12:34:27', '2018-01-08 12:35:17', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(14, 15, 2, 5, 'ffsds', 3, '2018-01-08 12:35:17', '2018-01-08 12:35:36', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(15, 15, 4, 6, 'hjbh', 3, '2018-01-08 12:35:36', '2018-01-08 12:35:57', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(16, 16, 3, 4, '', 5, '2018-02-05 11:16:06', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(17, 17, 3, 4, '', 5, '2018-02-10 04:41:52', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(18, 18, 3, 4, '', 5, '2018-05-14 16:11:59', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(19, 19, 3, 4, '', 5, '2018-06-07 16:38:08', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(20, 20, 3, 4, '', 5, '2018-06-07 16:56:25', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(21, 21, 3, 4, 'This is the clearance', 3, '2018-06-07 16:58:13', '2018-06-07 17:26:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(22, 21, 2, 5, '', 5, '2018-06-07 17:26:00', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(23, 22, 3, 4, 'this is the new clearacne', 5, '2018-06-07 17:52:57', '2018-06-07 17:54:10', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(24, 22, 2, 5, '', 5, '2018-06-07 17:54:10', '2018-06-07 18:16:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(25, 22, 4, 6, '', 5, '2018-06-07 18:16:00', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(26, 23, 3, 4, 'This', 0, '2018-06-07 18:20:17', '2018-06-07 18:20:52', 'Yes', 'Yes, successfully confirm your clearance.', '1', '2018-06-08 09:15:37'),
(27, 23, 2, 5, '', 0, '2018-06-07 18:20:52', '2018-06-07 18:21:40', 'Yes', 'Successfully', '1', '2018-06-08 09:16:11'),
(28, 23, 4, 6, 'This sisds', 3, '2018-06-07 18:21:40', '2018-06-08 10:05:37', 'No', 'please upload the necessary documents', '1', '2018-06-08 10:05:13'),
(29, 23, 5, 7, '', 3, '2018-06-07 18:23:17', '2018-06-07 18:30:04', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(30, 23, 5, 7, '', 5, '2018-06-08 09:55:58', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `member_id` int(11) NOT NULL,
  `description` text,
  `createdon` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `member_id`, `description`, `createdon`, `status`) VALUES
(2, 'Bursary', 1, 'This is the bursary department. ', '2016-12-10 15:27:43', 5),
(3, 'Library', 1, 'This is the library departments', '2016-12-10 15:28:25', 5),
(4, 'Hostel', 2, 'Department for hsotel', '2018-01-12 15:51:50', 5),
(5, 'Student Affairs', 6, 'this is the student affairs', '2018-01-08 12:38:01', 5);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` text NOT NULL,
  `bio` text NOT NULL,
  `status` int(11) NOT NULL,
  `createdon` datetime NOT NULL,
  `updatedon` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `username`, `firstname`, `lastname`, `email`, `password`, `bio`, `status`, `createdon`, `updatedon`, `type`, `department_id`) VALUES
(1, 'Admin', 'test', 'Admin', 'test@admin.com', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'This is a test admin', 5, '2016-12-10 00:00:00', '2016-12-10 00:00:00', 3, 0),
(2, 'adetunji@gmail.com', 'Adetunji', 'Aderimobi', 'adetunji@gmail.com', 'adetunji@gmail.com', 'This is me', 5, '2018-01-10 19:19:20', '2018-01-10 23:44:25', 3, 3),
(3, 'adetunjsi@gmail.com', 'Adetunji', 'Aderimobi', 'adetunjsi@gmail.com', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'This is the real man', 5, '2018-01-10 19:19:51', '0000-00-00 00:00:00', 3, 2),
(4, 'adegbenga@gmail.com', 'Adegbenga', 'Ademola', 'adegbenga@gmail.com', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'This is mr adegbenga', 5, '2018-01-10 19:21:59', '0000-00-00 00:00:00', 3, 3),
(8, '110344', 'Sola', 'Toba', '110344', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'This is a new interne', 5, '2018-01-11 10:31:55', '0000-00-00 00:00:00', 0, 0),
(12, '111111', 'hjdhhs', 'jsdbsh', '111111', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'dbshd', 5, '2018-01-12 15:53:11', '0000-00-00 00:00:00', 0, 0),
(19, '110516', 'Damilare', 'Shobowale', '110516', '27bfaa8f76fe30db4d3d2fec408d0b29a772bdd3bf5ee330951233473d94d0e9', 'He\'s a corper', 5, '2018-06-07 16:38:08', '0000-00-00 00:00:00', 0, 0),
(20, '1105161', 'damilare', 'adenuga', '1105161', 'd110516amilare', 'A corper', 5, '2018-06-07 16:56:25', '0000-00-00 00:00:00', 0, 0),
(23, 'MATRI/SS', 'Damilare', 'Shobowale', 'MATRI/SS', '49dc52e6bf2abe5ef6e2bb5b0f1ee2d765b922ae6cc8b95d39dc06c21c848f8c', 'This is the data for the user', 5, '2018-06-07 18:20:17', '2018-06-08 09:30:43', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `priority_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `instruction` text NOT NULL,
  `deadline` datetime NOT NULL,
  `createdon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`priority_id`, `department_id`, `instruction`, `deadline`, `createdon`) VALUES
(4, 3, 'For all final year students, inorder to pass the library clearance. Endeavour you scan your department identification cards, school ID card, Department ID card, school result (100L - 500L) and school tuition receipt (100L - 500L). Regards.', '2018-01-25 23:00:00', '2018-01-11 03:13:27'),
(5, 2, 'Submit all credential relating to the bursary department', '2018-01-13 12:00:00', '2018-01-11 13:08:21'),
(6, 4, 'This is the department for hostel', '2018-01-18 12:00:00', '2018-01-12 15:52:28'),
(7, 5, 'Submit all your student clearance', '2018-01-19 12:00:00', '2018-01-08 12:38:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance_status`
--
ALTER TABLE `clearance_status`
  ADD PRIMARY KEY (`clearance_status_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance_status`
--
ALTER TABLE `clearance_status`
  MODIFY `clearance_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
