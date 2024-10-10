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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
