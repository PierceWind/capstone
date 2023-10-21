-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 07:23 PM
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
(4, '12', 228),
(7, '13', 22),
(8, '5', 200),
(9, '3', 99),
(10, '10', 23),
(11, '2', 9),
(12, '4', 22);

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
  `orderStatus` enum('Queued','In Progress','Paid','Preparing','Completed') NOT NULL DEFAULT 'Queued',
  `queueNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDateTime`, `orderStatus`, `queueNumber`) VALUES
(1, '2023-10-12 11:28:51', 'Preparing', 1),
(2, '2023-10-12 14:11:32', 'In Progress', 2),
(3, '2023-10-12 15:35:38', 'In Progress', 3);

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
(4, 1, 7, 10, '1500.00');

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
  `code` int(11) NOT NULL,
  `sales` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `sales`, `date`) VALUES
(1, 1, 2, '2023-10-01 21:52:29'),
(2, 1, 5, '2023-10-01 04:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `transac`
--

CREATE TABLE `transac` (
  `transaction_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `customer_ID` varchar(255) DEFAULT NULL,
  `discount_type` varchar(50) DEFAULT NULL,
  `discount_percent` float DEFAULT NULL,
  `totalBill` decimal(10,2) DEFAULT NULL,
  `cashPaid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--
-- Error reading structure for table capstone.transactions: #1932 - Table 'capstone.transactions' doesn't exist in engine
-- Error reading data for table capstone.transactions: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `capstone`.`transactions`' at line 1

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transac`
--
ALTER TABLE `transac`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

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
