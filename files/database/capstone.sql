-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 04:13 PM
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
(1, 'Victoria', 'Salavaria', 'Bolado', 'vickybolado959@gmail.com', '2023-10-09', '2023-06-24 21:28:24', '2023-10-05 03:23:50'),
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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2023-06-13 00:00:00', '2023-10-05 03:23:50'),
(2, 'lbm', '827ccb0eea8a706c4c34a16891f84e7b', 'cashier', '2023-07-11 21:57:51', '0000-00-00 00:00:00'),
(3, 'jerusa', '827ccb0eea8a706c4c34a16891f84e7b', 'kitchen', '2023-07-11 23:42:34', '2023-09-24 20:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `drNum` int(11) NOT NULL,
  `drName` varchar(255) NOT NULL,
  `drDate` date NOT NULL,
  `drRName` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`drNum`, `drName`, `drDate`, `drRName`, `dateCreated`, `dateModified`) VALUES
(1, 'MM', '2023-10-01', 'ssdc', '2023-10-03 09:41:37', '0000-00-00 00:00:00'),
(22, 'fdev', '2023-10-02', 'FF', '2023-10-03 10:02:09', '0000-00-00 00:00:00'),
(35, 'dsd', '2023-10-02', 'ssdc', '2023-10-03 09:36:44', '0000-00-00 00:00:00'),
(234, 'MM', '2023-10-05', 'ssdc', '2023-10-03 09:17:26', '0000-00-00 00:00:00'),
(242, 'ds', '2023-10-01', 'vf ', '2023-10-03 09:31:44', '0000-00-00 00:00:00'),
(342, 'fdev', '2023-10-02', 'vfs', '2023-10-03 09:27:34', '0000-00-00 00:00:00'),
(888, 'fdev', '2023-10-01', 'vfs', '2023-10-03 10:25:05', '0000-00-00 00:00:00'),
(2525, 'fdev', '2023-10-01', '645363', '2023-10-03 09:12:38', '0000-00-00 00:00:00'),
(6666, 'fdev', '2023-10-02', 'vdfvf', '2023-10-03 10:06:58', '0000-00-00 00:00:00'),
(7777, 'fdev', '2023-10-02', 'ssdc', '2023-10-03 10:17:15', '0000-00-00 00:00:00'),
(8798, 'ffthv', '2023-10-03', 'jbjh', '2023-10-04 10:06:06', '2023-10-04 02:06:06'),
(8888, 'gfs', '2023-10-11', '645363', '2023-10-03 10:25:57', '0000-00-00 00:00:00'),
(29999, '2fvf', '2023-10-09', '434', '2023-10-03 10:30:02', '0000-00-00 00:00:00'),
(34253, 'fdev', '2023-10-01', 'dfs', '2023-10-03 09:44:33', '0000-00-00 00:00:00'),
(55555, 'dsd', '2023-10-03', 'gdfdf', '2023-10-03 10:04:24', '0000-00-00 00:00:00'),
(121212, 'JJ', '2023-10-12', 'MM', '2023-10-12 09:37:14', '2023-10-12 01:37:14'),
(222222, 'ff', '2023-10-03', 'ssc', '2023-10-04 23:52:07', '2023-10-04 15:52:07'),
(433333, 'ssda', '2023-10-03', 'dsacads', '2023-10-05 00:17:37', '2023-10-04 16:17:37'),
(1111111, 'MM', '2023-10-01', 'FF', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111111112, 'JJ', '2023-10-03', 'dsa', '2023-10-04 10:02:09', '0000-00-00 00:00:00'),
(123456789, 'xcXcsa', '2023-10-10', 'xsxasd ', '2023-10-05 00:29:02', '2023-10-04 16:29:02'),
(2147483647, 'ssad', '2023-10-02', 'sddas', '2023-10-05 00:24:25', '2023-10-04 16:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_products`
--

CREATE TABLE `delivery_products` (
  `id` int(11) NOT NULL,
  `deliveryId` int(11) NOT NULL,
  `productId` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_products`
--

INSERT INTO `delivery_products` (`id`, `deliveryId`, `productId`, `quantity`, `dateCreated`, `dateModified`) VALUES
(30, 6666, '12', 6, '2023-10-03 10:09:12', '2023-10-03 02:09:12'),
(32, 6666, '12', 6, '2023-10-03 10:14:57', '2023-10-03 02:14:57'),
(33, 7777, '1', 75, '2023-10-03 10:17:15', '2023-10-03 02:17:15'),
(34, 7777, '12', 75, '2023-10-03 10:17:15', '2023-10-03 02:17:15'),
(48, 123456789, '5', 50, '2023-10-05 00:29:02', '2023-10-04 16:29:02'),
(49, 121212, '12', 10, '2023-10-12 09:37:14', '2023-10-12 01:37:14'),
(50, 121212, '4', 12, '2023-10-12 09:37:14', '2023-10-12 01:37:14'),
(51, 121212, '5', 50, '2023-10-12 09:37:14', '2023-10-12 01:37:14'),
(52, 121212, '11', 10, '2023-10-12 09:41:34', '2023-10-12 01:41:34'),
(53, 121212, '12', 20, '2023-10-12 09:41:34', '2023-10-12 01:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `prodCode` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `prodCode`, `stock`) VALUES
(2, '11', 14),
(3, '1', 176),
(4, '6', -102),
(7, '7', -308),
(8, '5', -1800),
(9, '3', 99),
(10, '10', 23),
(11, '2', 9),
(12, '4', 0);

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDateTime` timestamp NULL DEFAULT current_timestamp(),
  `orderStatus` enum('Queued','In Progress','Paid','Preparing','Serving','Completed','Canceled') NOT NULL DEFAULT 'Queued',
  `queueNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDateTime`, `orderStatus`, `queueNumber`) VALUES
(1, '2023-10-12 11:28:51', 'Preparing', 1),
(2, '2023-10-12 14:11:32', 'In Progress', 2),
(3, '2023-10-12 15:35:38', 'Serving', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Subtotal`) VALUES
(3, 1, 6, 10, '1000.00'),
(4, 1, 7, 10, '1500.00'),
(5, 2, 5, 50, '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `PaymentAmount` decimal(10,2) NOT NULL,
  `PaymentStatus` enum('Pending','Paid','Failed') NOT NULL,
  `PaymentDateTime` timestamp NOT NULL DEFAULT current_timestamp()
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
('11', 'includes/uploads/1695572556.jpg', '2023-09-25 00:22:36', '2023-09-25 00:22:36'),
('12', 'includes/uploads/1695572602.jpg', '2023-09-25 00:23:22', '2023-09-25 00:23:22'),
('13', 'includes/uploads/1695572718.jpg', '2023-09-25 00:25:18', '2023-09-25 00:25:18'),
('14', 'includes/uploads/1696959496.jpg', '2023-09-28 23:19:48', '2023-10-11 01:38:17'),
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
  `prodPrice` decimal(10,2) NOT NULL,
  `minReq` int(255) NOT NULL,
  `prodCategory` varchar(20) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodId`, `prodDescription`, `prodName`, `netWeight`, `prodPrice`, `minReq`, `prodCategory`, `dateCreated`, `dateModified`) VALUES
('1', 'olive oil and tomato ', 'Puttanesca', 300, '300.00', 5, 'Heritage', '2023-09-25 00:08:07', '2023-09-25 00:08:07'),
('11', '..', 'Bopis', 220, '250.00', 5, 'Specialties', '2023-09-25 00:22:36', '2023-09-25 00:22:36'),
('12', 'Tomato', 'Bolognese', 400, '300.00', 5, 'Pasta', '2023-09-25 00:23:22', '2023-09-25 00:23:22'),
('13', 'Fish Egg', 'Bottarga', 400, '200.00', 2, 'Heritage', '2023-09-25 00:25:18', '2023-09-25 00:25:18'),
('14', 'goat ', 'Goat Caldereta', 400, '401.00', 10, 'Heritage', '2023-10-11 01:38:17', '2023-09-28 23:19:48'),
('2', 'Orange', 'Marmalade', 300, '120.00', 10, 'Sweets', '2023-09-25 00:09:20', '2023-09-25 00:09:20'),
('3', 'sample here', 'Baby Back Ribs', 100, '90.00', 5, 'Heritage', '2023-09-25 00:02:51', '2023-09-24 20:57:13'),
('4', 'Bread, Celery, and Spice', 'Roast Turkey', 1000, '1000.00', 0, 'Specialties', '2023-09-25 00:11:49', '2023-09-25 00:11:49'),
('5', 'Coconut Milk ', 'Suman Sa Lihiya', 100, '30.00', 10, 'Sweets', '2023-09-25 00:12:59', '2023-09-25 00:12:59'),
('6', 'Papaya, Onion, Carrots', 'Atsarang Papaya', 350, '100.00', 10, 'Specialties', '2023-09-25 00:13:56', '2023-09-25 00:13:56'),
('7', 'Onion, Garlic, Vinegar', 'Shallot', 400, '150.00', 10, 'Specialties', '2023-09-25 00:18:05', '2023-09-25 00:17:45'),
('8', 'Radish', 'Pinoy Salad', 100, '100.00', 0, 'Salad', '2023-09-25 00:19:10', '2023-09-25 00:19:10'),
('9', 'Ubod ', 'Atsarang Ubod', 350, '100.00', 10, 'Specialties', '2023-09-25 00:20:03', '2023-09-25 00:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `queueID` int(11) NOT NULL,
  `queueNumber` int(11) NOT NULL,
  `queueStatus` enum('Preparing','Waiting','Served') NOT NULL,
  `queueDateTime` datetime NOT NULL,
  `servedDateTime` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `prodCode` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `orderID`, `prodCode`, `sales`, `date`) VALUES
(1, 0, 1, 2, '2023-10-01 21:52:29'),
(2, 0, 1, 5, '2023-10-01 04:00:47'),
(3, 1, 6, 10, '2023-10-29 03:20:55'),
(4, 1, 7, 10, '2023-10-29 03:20:55'),
(5, 1, 6, 10, '2023-10-29 04:51:02'),
(6, 1, 7, 10, '2023-10-29 04:51:02'),
(7, 2, 5, 50, '2023-10-29 04:56:50'),
(8, 1, 6, 10, '2023-10-29 05:33:25'),
(9, 1, 7, 10, '2023-10-29 05:33:25'),
(10, 1, 6, 10, '2023-10-29 05:48:52'),
(11, 1, 7, 10, '2023-10-29 05:48:52'),
(12, 1, 6, 10, '2023-10-29 06:44:13'),
(13, 1, 7, 10, '2023-10-29 06:44:13'),
(14, 2, 5, 50, '2023-10-29 06:46:18'),
(15, 1, 6, 10, '2023-10-29 11:35:49'),
(16, 1, 7, 10, '2023-10-29 11:35:49'),
(17, 2, 5, 50, '2023-10-29 11:36:48'),
(18, 1, 6, 10, '2023-10-29 11:40:13'),
(19, 1, 7, 10, '2023-10-29 11:40:13'),
(20, 1, 6, 10, '2023-10-29 11:40:13'),
(21, 1, 7, 10, '2023-10-29 11:40:13'),
(22, 1, 6, 10, '2023-10-29 11:40:14'),
(23, 1, 7, 10, '2023-10-29 11:40:14'),
(24, 1, 6, 10, '2023-10-29 11:40:14'),
(25, 1, 7, 10, '2023-10-29 11:40:14'),
(26, 1, 6, 10, '2023-10-29 11:40:15'),
(27, 1, 7, 10, '2023-10-29 11:40:15'),
(28, 1, 6, 10, '2023-10-29 11:40:15'),
(29, 1, 7, 10, '2023-10-29 11:40:15'),
(30, 1, 6, 10, '2023-10-29 11:40:15'),
(31, 1, 7, 10, '2023-10-29 11:40:15'),
(32, 1, 6, 10, '2023-10-29 11:40:15'),
(33, 1, 7, 10, '2023-10-29 11:40:15'),
(34, 1, 6, 10, '2023-10-29 11:40:15'),
(35, 1, 7, 10, '2023-10-29 11:40:15'),
(36, 1, 6, 10, '2023-10-31 15:00:12'),
(37, 1, 7, 10, '2023-10-31 15:00:12'),
(38, 2, 5, 50, '2023-10-31 15:02:44'),
(39, 1, 6, 10, '2023-10-31 15:59:19'),
(40, 1, 7, 10, '2023-10-31 15:59:19'),
(41, 1, 6, 10, '2023-10-31 15:59:19'),
(42, 1, 7, 10, '2023-10-31 15:59:19'),
(43, 1, 6, 10, '2023-10-31 15:59:20'),
(44, 1, 7, 10, '2023-10-31 15:59:20'),
(45, 1, 6, 10, '2023-10-31 15:59:20'),
(46, 1, 7, 10, '2023-10-31 15:59:20'),
(47, 1, 6, 10, '2023-10-31 15:59:20'),
(48, 1, 7, 10, '2023-10-31 15:59:20'),
(49, 1, 6, 10, '2023-10-31 15:59:20'),
(50, 1, 7, 10, '2023-10-31 15:59:20'),
(51, 1, 6, 10, '2023-10-31 15:59:20'),
(52, 1, 7, 10, '2023-10-31 15:59:20'),
(53, 1, 6, 10, '2023-10-31 15:59:20'),
(54, 1, 7, 10, '2023-10-31 15:59:20'),
(55, 1, 6, 10, '2023-10-31 15:59:20'),
(56, 1, 7, 10, '2023-10-31 15:59:20'),
(57, 1, 6, 10, '2023-10-31 15:59:21'),
(58, 1, 7, 10, '2023-10-31 15:59:21'),
(59, 1, 6, 10, '2023-10-31 15:59:21'),
(60, 1, 7, 10, '2023-10-31 15:59:21'),
(61, 2, 5, 50, '2023-10-31 16:00:13'),
(62, 2, 5, 50, '2023-10-31 16:00:17'),
(63, 1, 6, 10, '2023-10-31 16:21:34'),
(64, 1, 7, 10, '2023-10-31 16:21:34'),
(65, 1, 6, 10, '2023-10-31 17:40:55'),
(66, 1, 7, 10, '2023-10-31 17:40:55'),
(67, 1, 6, 10, '2023-10-31 17:46:46'),
(68, 1, 7, 10, '2023-10-31 17:46:46'),
(69, 1, 6, 10, '2023-10-31 17:52:06'),
(70, 1, 7, 10, '2023-10-31 17:52:06'),
(71, 1, 6, 10, '2023-10-31 18:36:16'),
(72, 1, 7, 10, '2023-10-31 18:36:16'),
(73, 1, 6, 10, '2023-10-31 18:36:22'),
(74, 1, 7, 10, '2023-10-31 18:36:22'),
(75, 1, 6, 10, '2023-10-31 21:36:26'),
(76, 1, 7, 10, '2023-10-31 21:36:26'),
(77, 0, 5, 50, '2023-10-31 22:16:52'),
(78, 0, 5, 50, '2023-10-31 22:16:52'),
(79, 0, 5, 50, '2023-10-31 22:16:57'),
(80, 0, 5, 50, '2023-10-31 22:16:57'),
(81, 0, 5, 50, '2023-10-31 22:16:57'),
(82, 0, 5, 50, '2023-10-31 22:16:58'),
(83, 0, 5, 50, '2023-10-31 22:16:58'),
(84, 0, 5, 50, '2023-10-31 22:16:58'),
(85, 0, 5, 50, '2023-10-31 22:16:58'),
(86, 0, 5, 50, '2023-10-31 22:16:58'),
(87, 0, 5, 50, '2023-10-31 22:20:11'),
(88, 0, 5, 50, '2023-10-31 22:20:12'),
(89, 0, 5, 50, '2023-10-31 22:20:19'),
(90, 0, 5, 50, '2023-10-31 22:20:21'),
(91, 0, 5, 50, '2023-10-31 22:20:21'),
(92, 0, 5, 50, '2023-10-31 22:20:21'),
(93, 0, 5, 50, '2023-10-31 22:20:21'),
(94, 0, 5, 50, '2023-10-31 22:20:21'),
(95, 0, 5, 50, '2023-10-31 22:20:21'),
(96, 0, 5, 50, '2023-10-31 22:20:22'),
(97, 0, 5, 50, '2023-10-31 22:20:22'),
(98, 0, 5, 50, '2023-10-31 22:20:22'),
(99, 0, 5, 50, '2023-10-31 22:20:22'),
(100, 0, 5, 50, '2023-10-31 22:20:22'),
(101, 0, 5, 50, '2023-10-31 22:22:08'),
(102, 0, 5, 50, '2023-10-31 22:22:08'),
(103, 0, 5, 50, '2023-10-31 22:22:09'),
(104, 0, 5, 50, '2023-10-31 22:23:15'),
(105, 0, 5, 50, '2023-10-31 22:23:15'),
(106, 0, 5, 50, '2023-10-31 22:53:04'),
(107, 0, 5, 50, '2023-10-31 22:53:06'),
(108, 0, 5, 50, '2023-10-31 22:53:06'),
(109, 0, 5, 50, '2023-10-31 22:53:06'),
(110, 0, 5, 50, '2023-10-31 22:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `transac`
--

CREATE TABLE `transac` (
  `transaction_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `customer_ID` varchar(255) DEFAULT NULL,
  `discount_type` enum('regular','frequent','pwd','senior') DEFAULT 'regular',
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `netAmt` decimal(10,2) DEFAULT NULL,
  `cashPaid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transac`
--

INSERT INTO `transac` (`transaction_id`, `date`, `orderID`, `customer_ID`, `discount_type`, `discount_amount`, `netAmt`, `cashPaid`) VALUES
(4, '2023-10-23 00:00:00', 1, '', 'pwd', '0.00', '120.00', '120.00'),
(5, '2023-10-23 00:00:00', 2, '', 'frequent', '0.00', '500.00', '200.00'),
(6, '2023-10-23 00:00:00', 1, '', 'regular', '0.00', '1000.00', '50000.00'),
(7, '2023-10-23 00:00:00', 1, '', 'frequent', '0.00', '5000.00', '6000.00'),
(8, '2023-10-23 00:00:00', 1, '', 'regular', '0.00', '100000.00', '50000.00'),
(9, '2023-10-24 12:38:21', 1, '', 'frequent', '0.00', '0.00', '0.00'),
(10, '2023-10-24 15:42:54', 2, '', 'frequent', '0.00', '0.00', '0.00'),
(11, '2023-10-24 15:45:36', 1, '', 'pwd', '0.00', '0.00', '0.00'),
(12, '2023-10-24 15:46:39', 2, '', 'senior', '0.00', '0.00', '0.00'),
(13, '2023-10-27 13:24:40', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(14, '2023-10-27 13:28:05', 1, '1312412341', 'pwd', '0.00', '2500.00', '1700.00'),
(15, '2023-10-27 13:36:06', 1, '1312412341', 'pwd', '0.00', '2500.00', '1700.00'),
(16, '2023-10-27 13:40:13', 1, '1312412341', 'pwd', '0.00', '2500.00', '1700.00'),
(17, '2023-10-27 13:41:40', 1, '1312412341', 'pwd', '0.00', '2500.00', '1700.00'),
(18, '2023-10-27 13:43:23', 1, '1312412341', 'pwd', '800.00', '2500.00', '1700.00'),
(19, '2023-10-27 16:58:32', 1, '1', 'frequent', '500.00', '2500.00', '2000.00'),
(20, '2023-10-29 02:56:05', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(21, '2023-10-29 03:02:17', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(22, '2023-10-29 03:02:41', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(23, '2023-10-29 03:03:40', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(24, '2023-10-29 03:15:20', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(25, '2023-10-29 03:20:55', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(26, '2023-10-29 04:51:02', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(27, '2023-10-29 04:56:50', 2, '1212312', 'senior', '480.00', '1500.00', '1020.00'),
(28, '2023-10-29 05:33:25', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(29, '2023-10-29 05:48:52', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(30, '2023-10-29 06:44:13', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(31, '2023-10-29 06:46:18', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(32, '2023-10-29 11:35:49', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(33, '2023-10-29 11:36:48', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(34, '2023-10-29 11:40:13', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(35, '2023-10-29 11:40:13', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(36, '2023-10-29 11:40:14', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(37, '2023-10-29 11:40:14', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(38, '2023-10-29 11:40:15', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(39, '2023-10-29 11:40:15', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(40, '2023-10-29 11:40:15', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(41, '2023-10-29 11:40:15', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(42, '2023-10-29 11:40:15', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(43, '2023-10-31 15:00:12', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(44, '2023-10-31 15:02:44', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(45, '2023-10-31 15:59:19', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(46, '2023-10-31 15:59:19', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(47, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(48, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(49, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(50, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(51, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(52, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(53, '2023-10-31 15:59:20', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(54, '2023-10-31 15:59:21', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(55, '2023-10-31 15:59:21', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(56, '2023-10-31 16:00:13', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(57, '2023-10-31 16:00:17', 2, '0', 'regular', '0.00', '1500.00', '1500.00'),
(58, '2023-10-31 16:21:34', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(59, '2023-10-31 17:40:55', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(60, '2023-10-31 17:46:46', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(61, '2023-10-31 17:52:06', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(62, '2023-10-31 18:36:16', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(63, '2023-10-31 18:36:22', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(64, '2023-10-31 21:36:26', 1, '0', 'regular', '0.00', '2500.00', '2500.00'),
(65, '2023-10-31 22:16:52', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(66, '2023-10-31 22:16:52', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(67, '2023-10-31 22:16:57', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(68, '2023-10-31 22:16:57', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(69, '2023-10-31 22:16:57', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(70, '2023-10-31 22:16:58', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(71, '2023-10-31 22:16:58', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(72, '2023-10-31 22:16:58', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(73, '2023-10-31 22:16:58', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(74, '2023-10-31 22:16:58', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(75, '2023-10-31 22:20:11', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(76, '2023-10-31 22:20:12', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(77, '2023-10-31 22:20:19', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(78, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(79, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(80, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(81, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(82, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(83, '2023-10-31 22:20:21', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(84, '2023-10-31 22:20:22', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(85, '2023-10-31 22:20:22', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(86, '2023-10-31 22:20:22', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(87, '2023-10-31 22:20:22', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(88, '2023-10-31 22:20:22', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(89, '2023-10-31 22:22:08', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(90, '2023-10-31 22:22:08', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(91, '2023-10-31 22:22:09', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(92, '2023-10-31 22:23:15', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(93, '2023-10-31 22:23:15', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(94, '2023-10-31 22:53:04', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(95, '2023-10-31 22:53:06', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(96, '2023-10-31 22:53:06', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(97, '2023-10-31 22:53:06', 0, 'undefined', '', '0.00', '0.00', '1500.00'),
(98, '2023-10-31 22:54:43', 0, 'undefined', '', '0.00', '0.00', '1500.00');

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
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `acc_name` (`acc_name`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`drNum`);

--
-- Indexes for table `delivery_products`
--
ALTER TABLE `delivery_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`);

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
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`queueID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transac`
--
ALTER TABLE `transac`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_products`
--
ALTER TABLE `delivery_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `queueID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `transac`
--
ALTER TABLE `transac`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
