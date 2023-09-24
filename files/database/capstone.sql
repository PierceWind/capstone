-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 01:18 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `accinfo`
--

CREATE TABLE `accinfo` (
  `acc_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accinfo`
--

INSERT INTO `accinfo` (`acc_id`, `fname`, `mname`, `lname`, `email`, `DOB`, `date_created`, `date_modified`) VALUES
(1, 'Victoria', 'Salavaria', 'Bolado', 'vickybolado959@gmail.com', '1975-09-30', '2023-06-24 21:28:24', '2023-06-24 15:25:08'),
(2, 'Lorna ', 'Bolado', 'Britania', 'abalos.jerusamae@dfcamclp.edu.ph', '1970-01-01', '2023-07-11 21:57:51', '0000-00-00 00:00:00'),
(3, 'Jerusa Mae', 'Penarubia', 'Abalos', 'abalos.jerusamae@dfcamclp.edu.ph', '2023-07-06', '2023-07-11 23:42:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_pass` varchar(255) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_name`, `acc_pass`, `acc_type`, `date_created`, `date_modified`) VALUES
(1, 'admin', '34819d7beeabb9260a5c854bc85b3e44', 'admin', '2023-06-13 00:00:00', '0000-00-00 00:00:00'),
(2, 'lbm', '827ccb0eea8a706c4c34a16891f84e7b', 'cashier', '2023-07-11 21:57:51', '0000-00-00 00:00:00'),
(3, 'jmpa', '827ccb0eea8a706c4c34a16891f84e7b', 'kitchen', '2023-07-11 23:42:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `id` int(11) NOT NULL,
  `IpAddress` varbinary(16) NOT NULL,
  `TryTime` bigint(20) NOT NULL,
  `datelog` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prodimage`
--

CREATE TABLE `prodimage` (
  `productId` varchar(20) NOT NULL,
  `productImg` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodId` varchar(20) NOT NULL,
  `prodImg` varchar(255) NOT NULL,
  `prodDescription` varchar(255) NOT NULL,
  `prodName` varchar(50) NOT NULL,
  `netWeight` int(20) NOT NULL,
  `prodPrice` int(10) NOT NULL,
  `prodCategory` varchar(20) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accinfo`
--
ALTER TABLE `accinfo`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `prodimage`
--
ALTER TABLE `prodimage`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodId`(11));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accinfo`
--
ALTER TABLE `accinfo`
  ADD CONSTRAINT `accinfo_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
