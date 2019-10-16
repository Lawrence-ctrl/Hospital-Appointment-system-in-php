-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2019 at 03:54 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'hello@gmail.com', '5d41402abc4b2a76b9719d911017c592');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appontment_id` int(10) UNSIGNED NOT NULL,
  `patientname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `date_id` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countt`
--

CREATE TABLE `countt` (
  `count_id` int(11) NOT NULL,
  `count_day_id` int(11) NOT NULL,
  `count_doctor_id` int(11) NOT NULL,
  `count_date` date NOT NULL,
  `count_hit` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `dates_id` int(10) UNSIGNED NOT NULL,
  `datename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`dates_id`, `datename`, `created_at`, `updated_at`) VALUES
(1, 'Monday', NULL, NULL),
(2, 'Tueday', NULL, NULL),
(3, 'Wednesday', NULL, NULL),
(4, 'Thursday', NULL, NULL),
(5, 'Friday', NULL, NULL),
(6, 'Saturday', NULL, NULL),
(7, 'Sunday', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departments_id` int(10) UNSIGNED NOT NULL,
  `depname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departments_id`, `depname`, `created_at`, `updated_at`) VALUES
(1, 'Neurology', '2019-07-07 23:00:47', '2019-07-07 23:00:47'),
(2, 'Ear Nose and Throat (ENT)', '2019-07-07 23:01:11', '2019-07-07 23:01:11'),
(3, 'Dental', '2019-07-07 23:01:37', '2019-07-07 23:01:37'),
(4, 'Surgery', '2019-07-07 23:01:55', '2019-07-07 23:01:55'),
(5, 'Ophthalmology', '2019-07-07 23:02:12', '2019-07-07 23:02:12'),
(6, 'Paediatric', '2019-07-07 23:02:26', '2019-07-07 23:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctors_id` int(10) UNSIGNED NOT NULL,
  `depid` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitting_time` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctors_id`, `depid`, `name`, `degree`, `sitting_time`, `day_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dr. Lance Smith', 'M.B.,B.S, M.Med.Sc (Neu) Dip. Med.Sc (Medical Education)', 'Monday (2:00PM to 4:00PM), Tuesday (3:00PM to 5:00PM)', '1,2', '2019-07-07 23:04:56', '2019-08-05 00:52:59'),
(2, 1, 'Dr. Aldin Powell', ' M.Med.Sc (Neu)', 'Wednesday (4:00PM to 6:00PM), Thursday (4:00PM to 6:00PM),', '3,4', '2019-07-07 23:07:29', '2019-08-05 00:42:14'),
(3, 2, 'Dr. Gennadi', 'M.B.,B.S,D.L.O,M.Med.Sc; (Ent)', 'Monday (9:00AM to 11:00AM), Tuesday (10:00AM to 12:00PM), Wednesday (9:00AM to 11:00AM)', '1,2,3', '2019-07-07 23:09:02', '2019-08-04 23:24:05'),
(4, 2, 'Dr. John F Robert', 'M.B.,B.S,M.Med.Sc (ENT) M.R.C.S (Edin)', 'Thursday (2:00PM to 4:00PM), Friday (2:00PM to 4:00PM), Saturday (2:00PM to 4:00PM)', '4,5,6', '2019-07-07 23:10:29', '2019-08-04 23:10:09'),
(5, 2, 'Dr. Melville', 'M.B.,B.S,M.Med.Sc (ORL)', 'Monday (1:00PM to 3:00PM), Friday (2:00PM to 4:00PM), Saturday (6:00PM to 8:00PM)', '1,5,6', '2019-07-07 23:11:21', '2019-08-04 22:59:12'),
(6, 3, 'Dr. Franklin John Paw', 'M.D.S (USA)', 'Tuesday (3:00PM to 5:00PM), Friday (4:00PM to 6:00PM)', '6,7', '2019-07-07 23:13:14', '2019-08-04 22:18:53'),
(7, 3, 'Saw Kel Blute Htoo', 'B.S.D (Ygn)', 'Monday (8:00AM to 10:00AM), Friday (12:00PM to 2:00PM)', '1,5', '2019-08-04 18:17:25', '2019-08-04 18:18:41'),
(9, 5, 'Dr. Barack', 'M.B.,B.S,M.Med.Sc (Opth)', 'Monday (1:00AM to 3:00AM), Tuesday (1:00AM to 3:00)AM', '1,2', '2019-09-03 06:53:35', '2019-09-03 06:53:35'),
(11, 6, 'Dr. Khloe', 'M.B.,B.S,D.L.O,M.Med.Sc (Paed)', 'Monday (9:00 AM to 11:00 AM)\r\nWednesday (5:00 PM to 7:00 PM)', '2', '2019-09-03 16:14:31', '2019-09-03 16:14:31'),
(12, 6, 'Dr. Linnett', 'M.B.,B.S,D.L.O,M.Med.Sc (Paed)', 'Tuesday (4:00 PM to 6:00 PM)\r\nFriday (4:00 PM to 6:00 PM)', '3', '2019-09-03 16:15:37', '2019-09-03 16:15:37'),
(15, 1, 'Dr. Albert', 'M.B.,B.S,M.Med.Sc (Neu)', 'Mon (4:00 PM to 6:00 PM)\r\nWednesday (4:00 PM to 6:00 PM)', '1,3', '2019-09-04 18:52:41', '2019-09-04 18:52:41'),
(16, 5, 'Dr. Johnson', 'M.B,,B.S,M.Med.Sc (Opth)', 'Wednesday (3:00 PM to 5:00 PM)\r\nFri (3:00 PM to 5:00 PM)', '3,5', '2019-09-04 18:54:06', '2019-09-04 18:54:06'),
(17, 5, 'Dr. Zooey', 'M.B.,B.S,M.Med.Sc (Opth)', 'Thursday (4:00 PM to 6:00 PM)\r\nSaturday (4:00 PM to 6:00 PM)', '4,6', '2019-09-04 18:55:14', '2019-09-04 18:55:14'),
(18, 4, 'Dr. Victor Nardayajan', 'M.B.,B.S,M.Med.Sc (Surgery)', 'Wednesday (3:00 PM)\r\nSaturday (8:00 AM)', '3,6', '2019-09-04 18:56:27', '2019-09-04 18:56:27'),
(19, 4, 'Dr. Saw Mar Do Thein', 'Sr. Consultant Surgeon M.B.,B.S, M.Med.Sc (Surgery)', 'Tuesday (7:00 PM)\r\nThursday (7:00 PM)\r\nSunday (3:00 PM)', '2,4,7', '2019-09-04 18:58:10', '2019-09-04 18:58:10'),
(20, 4, 'Lawrence', 'lawrecnce', 'hello wold', '2,3', '2019-09-28 07:39:03', '2019-09-28 07:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `history_appointments`
--

CREATE TABLE `history_appointments` (
  `history_id` int(11) NOT NULL,
  `history_patientname` varchar(255) NOT NULL,
  `history_email` varchar(255) NOT NULL,
  `history_phonenumber` varchar(255) NOT NULL,
  `history_age` int(11) NOT NULL,
  `history_department_id` int(11) NOT NULL,
  `history_doctor_id` int(11) NOT NULL,
  `history_day_id` int(11) NOT NULL,
  `history_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_appointments`
--

INSERT INTO `history_appointments` (`history_id`, `history_patientname`, `history_email`, `history_phonenumber`, `history_age`, `history_department_id`, `history_doctor_id`, `history_day_id`, `history_date`, `created_at`, `updated_at`) VALUES
(2, 'Jacklin Htoo', 'thutayarmoe97@gmail.com', '09972089188', 22, 2, 4, 4, '2019-09-26', '2019-09-28 14:08:37', '2019-09-28 14:08:37'),
(3, 'Thuta Yar Moe', 'staystronglikeasun1997@gmail.com', '09789456123', 22, 6, 11, 1, '2019-09-16', '2019-09-28 14:08:37', '2019-09-28 14:08:37'),
(4, 'Jacklin Htoo', 'hteemoo25@gmail.com', '09456123789', 22, 5, 16, 5, '2019-09-20', '2019-09-28 14:08:37', '2019-09-28 14:08:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appontment_id`);

--
-- Indexes for table `countt`
--
ALTER TABLE `countt`
  ADD PRIMARY KEY (`count_id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`dates_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departments_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctors_id`),
  ADD KEY `doctors_depid_foreign` (`depid`);

--
-- Indexes for table `history_appointments`
--
ALTER TABLE `history_appointments`
  ADD PRIMARY KEY (`history_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appontment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countt`
--
ALTER TABLE `countt`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `dates_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departments_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctors_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `history_appointments`
--
ALTER TABLE `history_appointments`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_depid_foreign` FOREIGN KEY (`depid`) REFERENCES `departments` (`departments_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
