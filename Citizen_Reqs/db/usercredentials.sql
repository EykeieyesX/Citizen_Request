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
