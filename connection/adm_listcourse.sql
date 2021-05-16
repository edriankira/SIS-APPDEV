-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 01:41 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisappdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_listcourse`
--

CREATE TABLE `adm_listcourse` (
  `adm_lcID` int(11) NOT NULL,
  `adm_lcNum` varchar(100) NOT NULL,
  `adm_lcCourseT` text NOT NULL,
  `adm_lcCourseD` text NOT NULL,
  `adm_CourseTD` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adm_listcourse`
--

INSERT INTO `adm_listcourse` (`adm_lcID`, `adm_lcNum`, `adm_lcCourseT`, `adm_lcCourseD`, `adm_CourseTD`) VALUES
(2, '123123123', 'asdasdasd', 'asdasdasdas', '2021-05-13 10:14:41'),
(3, '0988362831', 'BSIT', 'marvin', '2021-05-13 10:21:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm_listcourse`
--
ALTER TABLE `adm_listcourse`
  ADD PRIMARY KEY (`adm_lcID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm_listcourse`
--
ALTER TABLE `adm_listcourse`
  MODIFY `adm_lcID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

