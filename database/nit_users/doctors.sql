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
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `fullName` varchar(200) NOT NULL,
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
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(3, 'olivery', 'Olivery', 'Tino', 'Matata', 'Olivery Tino Matata', 'Male', 'Tanzania', '1996-05-12', 'augustinolameck69@gmail.com', '+255 713456789', '41a1f6bc53d2c2160b03b3e6b85e70e9', '', 'a5c0e5c5b17d1a0e69e8ee8bd4d02190', 'added', 'doctor', 'Aug 2020', '12:43 am', 'Online'),
(4, 'BAKA270108', 'Baraka', 'Philimon', 'Onduru', 'Baraka Philimon Onduru', 'Male', 'Tanzania', '1996-02-12', 'baraka23@gmail.com', '+255 745227799', '5f308af44335e27e7ff35177f345cb3d', '', 'a5c0e5c5b17d1a0e69e8ee8bd4d02190', 'added', 'doctor', 'Aug 2020', '12:49 am', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
