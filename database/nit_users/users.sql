-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 07:29 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `email_verification_code` varchar(100) NOT NULL,
  `about_email` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `time_registered` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `email_verification_code`, `about_email`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(6, 'lameck', 'Lameck', 'Samo', 'Augustino', 'Lameck Samo Augustino', 'Male', 'Tanzania', '1992-06-29', 'augustinolameck69@gmail.com', '+255 719485679', 'eea05fa755e629d607bd978ef08cb956', '', '131bf0e12f449235c6e3e550c2b282c1', '2724-5385', 'Verified', 'added', 'user', '25/08/2020', '12:07 am', 'Online'),
(7, 'james', 'James', 'Mlay', 'Watson', 'James Mlay Watson', 'Male', 'Tanzania', '1998-01-10', 'augustinolameck69@gmail.com', '+255 652347890', '5721c634b6c516e6b87417f1ca775be5', '', '131bf0e12f449235c6e3e550c2b282c1', '4704-1440', 'Verified', 'added', 'user', '25/08/2020', '12:18 am', 'Online'),
(8, 'fanuel', 'Mwango', 'Peter', 'Fanuel', 'Mwango Peter Fanuel', 'Male', 'Tanzania', '1994-06-10', 'augustinolameck69@gmail.com', '+255 754607080', '614c4fc15a2e963602d1e27e27e73e6b', '', '131bf0e12f449235c6e3e550c2b282c1', '6504-4567', 'Verified', 'added', 'user', 'Sep 2020', '08:21 am', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
