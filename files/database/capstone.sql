-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 07:13 PM
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
(2, '11', 4),
(3, '1', 10),
(4, '6', 30),
(7, '7', 10),
(8, '5', -34),
(9, '3', 27),
(10, '10', 23),
(11, '2', 81),
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
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `orderDateTime` timestamp NULL DEFAULT current_timestamp(),
  `orderStatus` enum('Queued','In Progress','Paid','Preparing','Serving','Completed','Canceled') NOT NULL DEFAULT 'Queued',
  `queueNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderID`, `orderDateTime`, `orderStatus`, `queueNumber`) VALUES
(1, 1, '2023-10-12 11:28:51', 'Canceled', 1),
(2, 2, '2023-10-12 14:11:32', 'Preparing', 2),
(3, 3, '2023-10-12 15:35:38', 'Preparing', 3),
(16, 1, '2023-11-11 16:55:26', 'Canceled', 1),
(17, 1, '2023-11-11 17:13:19', 'Canceled', 1),
(20, 1, '2023-11-11 17:18:31', 'Canceled', 2),
(21, 4, '2023-11-11 17:20:30', 'Canceled', 3),
(22, 4, '2023-11-11 17:20:30', 'Canceled', 3),
(23, 5, '2023-11-11 17:21:58', 'In Progress', 4),
(24, 6, '2023-11-11 17:24:00', 'Queued', 5),
(25, 7, '2023-11-11 17:26:06', 'Queued', 6),
(26, 8, '2023-11-11 17:26:22', 'Queued', 7),
(27, 9, '2023-11-11 17:26:34', 'Queued', 8),
(28, 10, '2023-11-11 17:26:49', 'Queued', 9),
(29, 11, '2023-11-11 17:38:30', 'Queued', 10),
(30, 12, '2023-11-11 17:42:47', 'Queued', 11),
(31, 13, '2023-11-11 18:04:26', 'Queued', 12);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `QueueNumber` int(11) NOT NULL,
  `OrderDateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `QueueNumber`, `OrderDateTime`, `ProductID`, `Quantity`, `Subtotal`) VALUES
(5, 2, 1, '2023-11-11 17:09:51', 5, 50, '1500.00'),
(22, 1, 2, '2023-11-11 17:09:51', 12, 1, '300.00'),
(27, 1, 1, '2023-11-11 17:09:51', 2, 1, '120.00'),
(32, 1, 2, '2023-11-11 17:22:56', 7, 10, '1500.00'),
(33, 1, 3, '2023-11-11 17:23:02', 12, 1, '300.00'),
(34, 4, 3, '2023-11-11 17:23:05', 12, 1, '300.00'),
(35, 5, 4, '2023-11-11 17:23:11', 11, 10, '2500.00'),
(36, 6, 5, '2023-11-11 17:25:43', 14, 15, '6015.00'),
(37, 10, 9, '2023-11-11 17:26:49', 3, 3, '270.00'),
(38, 11, 10, '2023-11-11 17:38:30', 3, 3, '270.00'),
(39, 12, 11, '2023-11-11 17:42:47', 12, 1, '300.00'),
(40, 13, 12, '2023-11-11 18:04:26', 12, 1, '300.00');

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
  `prodCategory` enum('Heritage','Specialties','Pasta','Salad','Sweets','Drinks') NOT NULL,
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
(1, 1, 1, 10, '2023-10-18 00:00:00'),
(2, 1, 2, 2, '2023-10-18 00:00:00'),
(3, 2, 5, 50, '2023-10-18 00:00:00'),
(4, 2, 11, 2, '2023-10-18 00:00:00'),
(5, 3, 3, 3, '2023-10-18 00:00:00'),
(6, 1, 1, 10, '2023-11-07 22:44:48'),
(7, 1, 2, 2, '2023-11-07 22:44:48'),
(8, 2, 5, 50, '2023-11-07 22:46:17'),
(9, 2, 11, 2, '2023-11-07 22:46:17'),
(10, 3, 3, 3, '2023-11-07 22:47:20'),
(11, 1, 1, 10, '2023-11-07 23:09:44'),
(12, 1, 2, 2, '2023-11-07 23:09:44'),
(13, 1, 1, 10, '2023-11-08 02:37:18'),
(14, 1, 2, 2, '2023-11-08 02:37:19'),
(15, 2, 5, 50, '2023-11-08 14:10:30'),
(16, 2, 11, 2, '2023-11-08 14:10:30'),
(17, 3, 3, 3, '2023-11-08 14:24:32'),
(18, 2, 5, 50, '2023-11-10 00:31:30'),
(19, 2, 11, 2, '2023-11-10 00:31:30'),
(20, 3, 3, 3, '2023-11-10 00:31:55'),
(21, 1, 1, 10, '2023-11-10 16:42:44'),
(22, 1, 2, 2, '2023-11-10 16:42:44'),
(23, 1, 1, 10, '2023-11-10 16:49:43'),
(24, 1, 2, 2, '2023-11-10 16:49:43'),
(25, 1, 1, 10, '2023-11-10 16:51:49'),
(26, 1, 2, 2, '2023-11-10 16:51:49'),
(27, 1, 1, 10, '2023-11-10 16:55:49'),
(28, 1, 2, 2, '2023-11-10 16:55:49'),
(29, 2, 5, 50, '2023-11-10 17:45:45'),
(30, 2, 11, 2, '2023-11-10 17:45:45'),
(31, 3, 3, 3, '2023-11-10 18:28:39'),
(32, 1, 3, 3, '2023-11-12 00:00:31'),
(33, 1, 1, 1, '2023-11-12 00:11:08'),
(34, 1, 1, 1, '2023-11-12 00:12:32'),
(35, 1, 1, 1, '2023-11-12 00:13:13'),
(36, 1, 1, 1, '2023-11-12 00:14:09'),
(37, 1, 1, 1, '2023-11-12 00:15:27'),
(38, 1, 1, 1, '2023-11-12 00:39:27'),
(39, 1, 1, 1, '2023-11-12 00:42:39'),
(40, 1, 13, 4, '2023-11-12 00:48:51'),
(41, 1, 2, 1, '2023-11-12 00:54:26'),
(42, 1, 1, 1, '2023-11-12 00:55:26'),
(43, 1, 12, 3, '2023-11-12 00:55:26'),
(44, 1, 12, 1, '2023-11-12 01:13:08'),
(45, 1, 2, 1, '2023-11-12 01:13:08'),
(46, 1, 12, 2, '2023-11-12 01:13:19'),
(47, 1, 1, 5, '2023-11-12 01:13:56'),
(48, 1, 7, 10, '2023-11-12 01:18:11'),
(49, 1, 12, 1, '2023-11-12 01:18:31'),
(50, 4, 12, 1, '2023-11-12 01:20:30'),
(51, 5, 11, 10, '2023-11-12 01:21:58'),
(52, 6, 14, 15, '2023-11-12 01:24:00'),
(53, 10, 3, 3, '2023-11-12 01:26:49'),
(54, 11, 3, 3, '2023-11-12 01:38:30'),
(55, 12, 12, 1, '2023-11-12 01:42:47'),
(56, 13, 12, 1, '2023-11-12 02:04:26');

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
(1, '2023-11-07 21:09:00', 1, '1231231231231111', 'senior', '1036.80', '3240.00', '2203.20'),
(2, '2023-11-07 21:38:39', 2, '1', 'frequent', '400.00', '2000.00', '1600.00'),
(3, '2023-11-07 22:40:29', 3, '0', 'regular', '0.00', '270.00', '270.00'),
(4, '2023-11-07 22:44:48', 1, '0', 'regular', '0.00', '3240.00', '3240.00'),
(5, '2023-11-07 22:46:17', 2, '1231231312', 'pwd', '640.00', '2000.00', '1360.00'),
(6, '2023-11-07 22:47:20', 3, '1231231312', 'pwd', '86.40', '270.00', '183.60'),
(7, '2023-11-07 23:09:44', 1, '0', 'regular', '0.00', '3240.00', '3240.00'),
(8, '2023-11-08 02:37:18', 1, '0', 'regular', '0.00', '3240.00', '3240.00'),
(9, '2023-11-08 14:10:30', 2, '0', 'regular', '0.00', '2000.00', '2000.00'),
(10, '2023-11-08 14:24:32', 3, '121231231', 'pwd', '86.40', '270.00', '183.60'),
(11, '2023-11-10 00:31:30', 2, '0', 'regular', '0.00', '2000.00', '2000.00'),
(12, '2023-11-10 00:31:55', 3, '0', 'regular', '0.00', '270.00', '270.00'),
(13, '2023-11-10 16:42:44', 1, '12312341234123', 'pwd', '1036.80', '3240.00', '2203.20'),
(14, '2023-11-10 16:49:43', 1, '656757', 'pwd', '1036.80', '3240.00', '2203.20'),
(15, '2023-11-10 16:51:49', 1, '656757', 'pwd', '1036.80', '3240.00', '2203.20'),
(16, '2023-11-10 16:55:49', 1, '656757', 'pwd', '1036.80', '3240.00', '2203.20'),
(17, '2023-11-10 17:45:45', 2, '0', 'regular', '0.00', '2000.00', '2000.00'),
(18, '2023-11-10 18:28:39', 3, '0', 'regular', '0.00', '270.00', '270.00'),
(19, '2023-11-12 01:13:08', 1, '0', 'regular', '0.00', '420.00', '420.00');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveryID` (`deliveryId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodCode` (`prodCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`prodId`(11)),
  ADD UNIQUE KEY `prodName` (`prodName`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `transac`
--
ALTER TABLE `transac`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accinfo`
--
ALTER TABLE `accinfo`
  ADD CONSTRAINT `accinfo_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `delivery_products`
--
ALTER TABLE `delivery_products`
  ADD CONSTRAINT `deliveryID` FOREIGN KEY (`deliveryId`) REFERENCES `delivery` (`drNum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
