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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `email` varchar(200) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(250) NOT NULL,
  `images` varchar(255) NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`email`, `topic`, `description`, `location`, `images`, `submitted_date`) VALUES
('sid@gmail.com', 'Feedback', 'x123', 'xocolat, B. Gonzales Street, Loyola Heights, 3rd District, Quezon City, Eastern Manila District, Metro Manila, 1108, Philippines', '', '2024-10-04 02:13:09'),
('sid@gmail.com', 'Feedback', 'asdx213', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', 'ehehe.jpg', '2024-10-04 02:16:47'),
('sid@gmail.com', 'Feedback', 'xxxx', 'General Lim Street, Heroes Hill, Santa Cruz, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1104, Philippines', '', '2024-10-04 02:21:11'),
('sid@gmail.com', 'Feedback', 'x123', 'Mabalacat Street, Barangay 111, Zone 10, Grace Park East, District 2, Caloocan, Northern Manila District, Metro Manila, 1400, Philippines', '', '2024-10-04 02:21:46'),
('sid@gmail.com', 'Feedback', 'asd123x', '7, Baler Street, San Antonio, San Francisco del Monte, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1105, Philippines', '', '2024-10-04 02:22:14'),
('sid@gmail.com', 'Feedback', '\r\nfeedback\r\nLast test before sleeping', 'University of the Philippines Diliman, Magsaysay Avenue, UP Campus, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', 'ehehe.jpg', '2024-10-04 03:35:53'),
('sid@gmail.com', 'Feedback', 'x1', 'Veterans Memorial Medical Center Golf Course, Road 8, Project 6, Diliman, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '', '2024-10-04 03:38:26'),
('sid@gmail.com', 'Feedback', 'x1', 'Veterans Memorial Medical Center Golf Course, Road 8, Project 6, Diliman, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '', '2024-10-04 03:39:20'),
('sid@gmail.com', 'Feedback', 'x1', 'Veterans Memorial Medical Center Golf Course, Road 8, Project 6, Diliman, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '', '2024-10-04 03:40:58'),
('sid@gmail.com', 'Feedback', 'x123', 'Senator Miriam P. Defensor-Santiago Avenue, Pinyahan, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '', '2024-10-04 03:43:25'),
('sid@gmail.com', 'Feedback', 'x123asd', 'Department of Information and Communications Technology, Carlos P. Garcia Avenue, Village B, UP Campus, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '', '2024-10-04 03:47:06'),
('sid@gmail.com', 'Feedback', 'x2', 'Titan Cement Corporation, Rizal, Calabarzon, 1980, Philippines', '', '2024-10-04 03:53:47'),
('sid@gmail.com', 'Feedback', 'x123asd', 'Venezuela Street, Pansol, 3rd District, Quezon City, Eastern Manila District, Metro Manila, 1806, Philippines', '', '2024-10-04 03:56:22'),
('sid@gmail.com', 'Feedback', 'x123asd', 'Bangko Sentral ng Pilipinas (Printing Machinery), Senator Miriam P. Defensor-Santiago Avenue, Central, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 7876, Philippines', '', '2024-10-04 03:56:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
