-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 05:02 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `id` varchar(15) NOT NULL,
  `fname` varchar(14) NOT NULL,
  `lname` varchar(14) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `fname`, `lname`, `sex`, `birthdate`, `address`, `email`, `tel`) VALUES
('ce837620e456168', 'name', 'surname', 'ชาย', '2021-08-02', 'Test Addess', 'test@email.com', '123456789'),
('ebd55c764e7907f', 'ชื่อ', 'นามสกุล', 'หญิง', '2021-08-01', 'ที่อยู่ ทดสอบ', 'test@email.com', '9876543210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
