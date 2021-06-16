-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2021 at 02:47 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_studentuser`
--

CREATE TABLE `adm_studentuser` (
  `adm_stdId` int(11) NOT NULL,
  `adm_stdUserNum` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdfname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdlname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdmname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adm_stdbday` date NOT NULL,
  `adm_stdCourse` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdYear` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdSection` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdgender` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdemail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdmobile` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdusername` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdpassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_stdadmitCT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `adm_stdstatus` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adm_studentuser`
--

INSERT INTO `adm_studentuser` (`adm_stdId`, `adm_stdUserNum`, `adm_stdfname`, `adm_stdlname`, `adm_stdmname`, `adm_stdbday`, `adm_stdCourse`, `adm_stdYear`, `adm_stdSection`, `adm_stdgender`, `adm_stdemail`, `adm_stdmobile`, `adm_stdaddress`, `adm_stdusername`, `adm_stdpassword`, `adm_stdadmitCT`, `adm_stdstatus`) VALUES
(2, '75674763', 'venti', 'barbatos', '', '2021-05-26', 'BSES', '1st Year', 'BSES-1001', 'Male', 'ehw@gmail.com', '+639556172389', 'valenzuela', 'venti', '$2y$10$FGM3OwDffWbrMxKD0WdbEemSpWF5HDCrjF.GQWkiX/fDpn/Xrj5AG', '2021-05-27 21:45:23', 'Active'),
(3, '38499401', 'JAN ERICK', 'FRANCISCO', 'RODRIGUEZ', '2000-01-03', 'BSIT', '3rd Year', 'BSIT-3201', 'Male', 'jrickisco13@gmail.com', '+635556566656', 'Ugong Valcity', 'KIKO', '$2y$10$t.l2ShB0xZA9tsb7ulU80.KwoU.fkQfgUYDKhjstlPme0V5oFBdSm', '2021-05-29 06:13:57', 'Active'),
(4, '46642020', 'Marvin', 'Marilao', 'Luna', '1999-10-09', 'BSIT', '3rd Year', 'BSIT-3201', 'Male', 'marvinmarvin92@gmail.com', '+639202966614', 'Bagong Silang Caloocan City', 'marvin9310', '$2y$10$Ctjyb4VqYDK65CZdjJfH3OD4M8w5L9uQkm9F2Rz8piM7SpLFH4HOm', '2021-05-27 04:15:17', 'Active'),
(5, '11777055', 'Hahaha', 'Hahaha', 'Hahaha', '2021-05-27', 'BSIT', '4th Year', '1003', 'Male', 'hahaha@gmail.com', '+636566262655', 'Valenzuela', 'hahahahaha', '$2y$10$1HK4un50MSfeWgtrvGbSQutuez/cAjKArUbtoekaT6FyFwSAYaa4u', '2021-05-30 07:32:58', 'Active'),
(6, '41004956', 'Kenneth', 'Vv', 'Aa', '2021-05-07', 'BSIT', '3rd Year', 'BSIT-3201', 'Male', 'leedskenneth12@gmail.com', '+639984144515', 'Caloocan', 'kledde1', '$2y$10$AMWd0Y1BztYz0YvIerAIl.vmMU34nk0bL621uAGaBgIGOFaDrzXZi', '2021-05-30 09:15:27', 'Active'),
(7, '58873935', 'final', 'test', '', '2021-05-31', 'BSIT', '1st Year', 'BSIT-1', 'Male', 'hahhahaha@gmail.com', '+636426497664', 'haha sugie', 'tresh', '$2y$10$Y5Rzg.EVWadN37Q/.xrQxOhRUkO3i6u4SYzURNuGg0Yxo7T/XKzEG', '2021-05-30 20:32:14', 'Active'),
(8, '23272435', 'Asd', 'Asd', 'Asd', '2021-06-26', 'BSIT', '3rd Year', 'BSIT-3201', 'Male', 'asd@gmail.com', '+632732732732', 'Asdasd', 'asd123', '$2y$10$vwX7mANdiCyNNerklIeOL.rJbwhntmYzAdnob8ukmXl3uDL3u.z8S', '2021-06-03 01:26:56', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fct_final`
--

CREATE TABLE `fct_final` (
  `id` int(10) NOT NULL,
  `userid` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `d1` varchar(100) NOT NULL,
  `d2` varchar(100) NOT NULL,
  `d3` varchar(100) NOT NULL,
  `d4` varchar(100) NOT NULL,
  `d5` varchar(100) NOT NULL,
  `pa` varchar(100) NOT NULL,
  `gen` varchar(100) NOT NULL,
  `aae` varchar(100) NOT NULL,
  `eval` varchar(100) NOT NULL,
  `ass` varchar(100) NOT NULL,
  `exam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fct_midterm`
--

CREATE TABLE `fct_midterm` (
  `id` int(10) NOT NULL,
  `userid` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `d1` varchar(100) NOT NULL,
  `d2` varchar(100) NOT NULL,
  `d3` varchar(100) NOT NULL,
  `d4` varchar(100) NOT NULL,
  `d5` varchar(100) NOT NULL,
  `pa` varchar(100) NOT NULL,
  `gen` varchar(100) NOT NULL,
  `aae` varchar(100) NOT NULL,
  `eval` varchar(100) NOT NULL,
  `ass` varchar(100) NOT NULL,
  `exam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fct_prelim`
--

CREATE TABLE `fct_prelim` (
  `id` int(10) NOT NULL,
  `userid` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `d1` varchar(100) NOT NULL,
  `d2` varchar(100) NOT NULL,
  `d3` varchar(100) NOT NULL,
  `d4` varchar(100) NOT NULL,
  `d5` varchar(100) NOT NULL,
  `pa` varchar(100) NOT NULL,
  `gen` varchar(100) NOT NULL,
  `aae` varchar(100) NOT NULL,
  `eval` varchar(100) NOT NULL,
  `ass` varchar(100) NOT NULL,
  `exam` varchar(100) NOT NULL,
  `coextra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Section_ID` int(11) NOT NULL,
  `Section_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Section_year` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Section_course` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Section_ID`, `Section_name`, `Section_year`, `Section_course`) VALUES
(6, 'BSES-1001', '1st Year', 'BSES'),
(8, 'BSIT-3201', '3rd Year', 'BSIT'),
(13, 'BSIT-4101', '4thyear', 'BSIT'),
(14, 'BSIT-2101', '2nd Year', 'BSIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fct_final`
--
ALTER TABLE `fct_final`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fct_midterm`
--
ALTER TABLE `fct_midterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fct_prelim`
--
ALTER TABLE `fct_prelim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fct_final`
--
ALTER TABLE `fct_final`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fct_midterm`
--
ALTER TABLE `fct_midterm`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `fct_prelim`
--
ALTER TABLE `fct_prelim`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
