-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2020 at 03:54 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nit_health_supportive`
--

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `fullName` varchar(400) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `time_registered` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(2, 'KEEY515897', '', '', '', '', '', '', '', '', '', 'edec78c4672bb22868f299812290b7e5', '', 'eeb1a1d29cb9a2e048889f6a24cf9bc5', 'not added', 'pharmacist', '', '', 'Online'),
(3, 'yulit', 'Yulitha', 'Limbu', 'Mayunga', 'Yulitha Limbu Mayunga', 'Female', 'Tanzania', '1996-11-23', 'punguster@gmail.com', '+255 755609080', '7f78006fe7839ef6d9e1e99d68b92206', '', 'eeb1a1d29cb9a2e048889f6a24cf9bc5', 'added', 'pharmacist', 'Aug 2020', '12:58 am', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
