-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 08:03 PM
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
(3, 'Jerusa Mae', 'Penarubia', 'Abalos', 'abalos.jerusamae@dfcamclp.edu.ph', '2023-07-06', '2023-07-11 23:42:34', '2023-09-24 20:29:08');

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
(3, 'jerusa', '958cb5c8879a9b1610b0f97abf760124', 'kitchen', '2023-07-11 23:42:34', '2023-09-24 20:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `code` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `sales` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`code`, `stock`, `sales`) VALUES
('1', 2, 0);

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

--
-- Dumping data for table `prodimage`
--

INSERT INTO `prodimage` (`productId`, `productImg`, `dateCreated`, `dateModified`) VALUES
('1', 'includes/uploads/1695571687.jpg', '2023-09-25 00:08:07', '2023-09-25 00:08:07'),
('10', 'includes/uploads/1695572510.jpg', '2023-09-25 00:21:50', '2023-09-25 00:21:50'),
('11', 'includes/uploads/1695572556.jpg', '2023-09-25 00:22:36', '2023-09-25 00:22:36'),
('12', 'includes/uploads/1695572602.jpg', '2023-09-25 00:23:22', '2023-09-25 00:23:22'),
('13', 'includes/uploads/1695572718.jpg', '2023-09-25 00:25:18', '2023-09-25 00:25:18'),
('14', 'includes/uploads/1695916373.jpg', '2023-09-28 23:19:48', '2023-09-28 23:52:53'),
('2', 'includes/uploads/1695571760.jpg', '2023-09-25 00:09:20', '2023-09-25 00:09:20'),
('3', 'includes/uploads/1695571371.jpg', '2023-09-24 20:57:13', '2023-09-25 00:02:51'),
('4', 'includes/uploads/1695571909.jpg', '2023-09-25 00:11:49', '2023-09-25 00:11:49'),
('5', 'includes/uploads/1695571979.jpg', '2023-09-25 00:12:59', '2023-09-25 00:12:59'),
('6', 'includes/uploads/1695572036.jpg', '2023-09-25 00:13:56', '2023-09-25 00:13:56'),
('7', 'includes/uploads/1695572285.jpg', '2023-09-25 00:17:45', '2023-09-25 00:18:05'),
('8', 'includes/uploads/1695572349.jpg', '2023-09-25 00:19:10', '2023-09-25 00:19:10'),
('9', 'includes/uploads/1695572403.jpg', '2023-09-25 00:20:03', '2023-09-25 00:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodId` varchar(20) NOT NULL,
  `prodDescription` varchar(255) NOT NULL,
  `prodName` varchar(50) NOT NULL,
  `netWeight` int(20) NOT NULL,
  `prodPrice` int(10) NOT NULL,
  `minReq` int(255) NOT NULL,
  `prodCategory` varchar(20) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodId`, `prodDescription`, `prodName`, `netWeight`, `prodPrice`, `minReq`, `prodCategory`, `dateCreated`, `dateModified`) VALUES
('1', 'olive oil and tomato ', 'Puttanesca', 300, 300, 5, 'Heritage', '2023-09-25 00:08:07', '2023-09-25 00:08:07'),
('10', 'Olive Oil ', 'Beef Mechado', 400, 400, 5, 'Heritage', '2023-09-25 00:21:50', '2023-09-25 00:21:50'),
('11', '..', 'Bopis', 220, 250, 5, 'Specialties', '2023-09-25 00:22:36', '2023-09-25 00:22:36'),
('12', 'Tomato', 'Bolognese', 400, 300, 5, 'Pasta', '2023-09-25 00:23:22', '2023-09-25 00:23:22'),
('13', 'Fish Egg', 'Bottarga', 400, 200, 2, 'Heritage', '2023-09-25 00:25:18', '2023-09-25 00:25:18'),
('14', 'goat ', 'Goat Caldereta', 400, 400, 10, 'Heritage', '2023-09-28 23:52:53', '2023-09-28 23:19:48'),
('2', 'Orange', 'Marmalade', 300, 120, 10, 'Sweets', '2023-09-25 00:09:20', '2023-09-25 00:09:20'),
('3', 'sample here', 'Baby Back Ribs', 100, 90, 5, 'Heritage', '2023-09-25 00:02:51', '2023-09-24 20:57:13'),
('4', 'Bread, Celery, and Spice', 'Roast Turkey', 1000, 1000, 0, 'Specialties', '2023-09-25 00:11:49', '2023-09-25 00:11:49'),
('5', 'Coconut Milk ', 'Suman Sa Lihiya', 100, 30, 10, 'Sweets', '2023-09-25 00:12:59', '2023-09-25 00:12:59'),
('6', 'Papaya, Onion, Carrots', 'Atsarang Papaya', 350, 100, 10, 'Specialties', '2023-09-25 00:13:56', '2023-09-25 00:13:56'),
('7', 'Onion, Garlic, Vinegar', 'Shallot', 400, 150, 10, 'Specialties', '2023-09-25 00:18:05', '2023-09-25 00:17:45'),
('8', 'Radish', 'Pinoy Salad', 100, 100, 0, 'Salad', '2023-09-25 00:19:10', '2023-09-25 00:19:10'),
('9', 'Ubod ', 'Atsarang Ubod', 350, 100, 10, 'Specialties', '2023-09-25 00:20:03', '2023-09-25 00:20:03');

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`code`);

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
