-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgutestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admincredentials`
--

CREATE TABLE `admincredentials` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admincredentials`
--

INSERT INTO `admincredentials` (`username`, `firstname`, `lastname`, `barangay`, `password`, `admin_code`) VALUES
('Sid', 'ad', 'min', '1', '$2y$10$24e44tzZEdA839ITyB./o.UEAolMinv2Ydn336O8IAFCLM/jsJnJe', ''),
('Stag', 'Bing', 'Bong', 'Bang', '$2y$10$iQSg7cl8jADsThnWm8rrju6MAR2U54S11wTCIPIs00Hw2/o6fxiH6', ''),
('water', 'asd', 'asda', 'asd', '$2y$10$AN952tia4Ld4iyJKEiUZfe9QetfLlijXl4sByU7ltdx3BEd4SH2Qa', ''),
('zxc', 'asd', 'asd', 'asd', '$2y$10$UOkVAnl0Cjzr79zdVTYxiuiNsUi/zt0l.9m09ri8kSypiEd3oHhzq', ''),
('admintest', 'admin', 'admin', 'admin', '$2y$10$RSy/x/XgaslDXdWfA.s5EutZBJKy4wuYkxoPfZfiijGBfktfzZ2A6', ''),
('admintestz', 'adasd', 'asdasd', 'asdasd', '$2y$10$/VjQ9knk8aSuEn7W5fQwveyjj4WY4KV7jI7/UX9OPo2WHsbcf1Pva', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
