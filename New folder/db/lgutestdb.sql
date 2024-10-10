-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 08:51 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `Topic` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Images` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `email` varchar(200) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(250) NOT NULL,
  `images` varchar(255) NOT NULL,
  `reference_id` varchar(255) NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Submitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`email`, `topic`, `description`, `location`, `images`, `reference_id`, `submitted_date`, `last_updated`, `status`) VALUES
('sid@gmail.com', 'Technical Support', 'Final test', '33, Mapagsangguni Street, Sikatuna Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '', 'REF-EDCD9FA', '2024-10-04 01:58:06', '2024-10-04 01:58:06', 'Cancelled'),
('sid@gmail.com', 'Technical Support', 'x123asd', 'Saint Anne Street, Saint Joseph Village, Tañong, District I, Marikina, Eastern Manila District, Metro Manila, 1801, Philippines', 'lmfao.gif', 'REF-88C8809', '2024-10-04 01:58:42', '2024-10-04 01:58:42', 'Completed'),
('sid@gmail.com', 'Technical Support', 'x12asd', 'Mapagbigay Street, Pinyahan, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '11977144021448909699.gif', 'REF-00CE5D0', '2024-10-04 02:08:06', '2024-10-04 02:08:06', 'Completed'),
('sid@gmail.com', 'Technical Support', 'x123', 'McDonald\'s, EDSA, Pinyahan, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 7876, Philippines', '', 'REF-C564089', '2024-10-04 02:12:08', '2024-10-04 02:12:08', 'In-progress'),
('sid@gmail.com', 'General Inquiry', 'tesd', 'Tolentino Street, Del Monte, San Francisco del Monte, 1st District, Quezon City, Eastern Manila District, Metro Manila, 1105, Philippines', 'consequences.jpeg', 'REF-E6AE76F', '2024-10-04 02:16:37', '2024-10-04 02:16:37', 'Cancelled'),
('sid@gmail.com', 'General Inquiry', 'zxcasd', 'Sizzle Parc, 92, Malumanay Street, Teachers Village, Teachers Village West, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '11977144021448909699.gif', 'REF-C72DC47', '2024-10-04 03:16:31', '2024-10-04 03:16:31', 'Cancelled'),
('sid@gmail.com', 'Complaint', '\r\n\r\nLast test before sleeping', 'University of the Philippines Diliman, Magsaysay Avenue, UP Campus, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', 'ehehe.jpg', 'REF-98ECE57', '2024-10-04 03:36:11', '2024-10-04 03:36:11', 'Reviewed'),
('sid@gmail.com', 'General Inquiry', 'zxczxc', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', 'ehehe.jpg', 'REF-8D7CBD9', '2024-10-04 03:37:28', '2024-10-04 03:37:28', 'Completed'),
('sid@gmail.com', 'Technical Support', 'x123', 'Esteban Abada Street, Loyola Heights, 3rd District, Quezon City, Eastern Manila District, Metro Manila, 1108, Philippines', 'ehehe.jpg', 'REF-6727142', '2024-10-04 03:37:59', '2024-10-04 03:37:59', 'In-progress'),
('sid@gmail.com', 'General Inquiry', 'x123', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', 'ehehe.jpg', 'REF-643D11A', '2024-10-04 03:45:33', '2024-10-04 03:45:33', 'Completed'),
('sid@gmail.com', 'General Inquiry', 'x123', 'University Avenue, San Vicente, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', 'FB_IMG_1722937587921.jpg', 'REF-AC25989', '2024-10-04 03:46:53', '2024-10-04 03:46:53', 'Submitted'),
('sid@gmail.com', 'General Inquiry', 'x123', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '7eb620bf3392374e42056072a63111b9886c7057_1163_1163_99624.jpeg', 'REF-D213A7F', '2024-10-04 03:53:02', '2024-10-04 03:53:02', 'Reviewed'),
('sid@gmail.com', 'General Inquiry', 'x123', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '', 'REF-558E6C6', '2024-10-04 03:53:14', '2024-10-04 03:53:14', 'Submitted'),
('sid@gmail.com', 'General Inquiry', 'x123', '9, Mahusay Street, UP Village, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', 'consequences.jpeg', 'REF-9822E35', '2024-10-04 03:53:30', '2024-10-04 03:53:30', 'Submitted'),
('sid@gmail.com', 'Technical Support', 'x123', 'Department of Information and Communications Technology, Carlos P. Garcia Avenue, Village B, UP Campus, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1101, Philippines', '', 'REF-37BEE5B', '2024-10-04 03:56:16', '2024-10-04 03:56:16', 'In-progress'),
('sid@gmail.com', 'General Inquiry', 'test', 'University of the Philippines Diliman, Magsaysay Avenue, UP Campus, Diliman, 4th District, Quezon City, Eastern Manila District, Metro Manila, 1100, Philippines', '', 'REF-84EFCC2', '2024-10-05 14:05:44', '2024-10-05 14:05:44', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `username` varchar(25) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercredentials`
--

INSERT INTO `usercredentials` (`username`, `firstname`, `lastname`, `email`, `password`) VALUES
('Sid', 'stagnant', 'water', 'sid@gmail.com', '$2y$10$lZvgQr.yNFa7h/DPNavHXee8XnZpD578CSVrmESVfK4XdSzuV80Yu'),
('asd', 'asd', 'asd', 'water@gmail.com', '$2y$10$B74x1bK4ctFnFlIbWkx/2.St/.tMRAi6HOEhm4IfEgMn27LGyyJvS'),
('test', 'test', 'test', 'test@gmail.com', '$2y$10$fj/lDHxKL7Zmh40mPSk46eIusuQrjzbRCtePaoUQu0VfK1OWfivpG'),
('testad', 'test', 'test', 'testsd@gmail.com', '$2y$10$OWEgM5akde2mS/X5rjn5buo0RRWDqHdub9l6xxkTKxZe2.RNvLU5G'),
('zxc', 'zxc', 'zxcx', 'zxc@gmail.com', '$2y$10$ng88HpyKrzq2ibi30z.8lOIopBND3yU8nestt4u7COIUajQ57ZEvS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
