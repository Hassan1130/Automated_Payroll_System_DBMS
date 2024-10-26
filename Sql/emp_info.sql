-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 07:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automated_payroll_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE `emp_info` (
  `emp_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `joining_date` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_id`, `email`, `password`, `name`, `designation`, `joining_date`, `address`, `mobile`) VALUES
(1, 'hassanmehedi347@gmail.com', '1234', 'Mehedi Hassan', 'CEO', '2002-01-17', 'Talukder Bhaban, Tiger Road, Baluchora,Bayzid Bostami, Chattogram. Mobile:01714311104', '01714311104'),
(2, 'hameem29@gmail.com', '1234', 'Hameem Hossain', 'CEO', '2002-10-24', 'Khathal Bagan, Baluchora,Bayzid Bostami, Chattogram. ', '01714311154'),
(3, 'mahitun37@gmail.com', '1234', 'Mahitun Nesa Mahi', 'MD', '2002-01-11', 'Nalapara, Kotowali, Chattogram. ', '01714311145'),
(4, 'issue31@gmail.com', '1234', 'Ishrat Jahan Estie', 'MD', '2002-01-18', 'Jaille para, Patenga, Chattogram.', '01714311204'),
(5, 'sohi36@gmail.com', '1234', 'Sumaiya Newaz', 'Chief Designer', '2002-10-23', 'Rahamat Ganj, Andorkilla, Chattogram.', '01714312204');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
