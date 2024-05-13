-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 13, 2024 at 07:07 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cposystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `rpos_admin`
--

CREATE TABLE `rpos_admin` (
  `admin_id` varchar(200) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_admin`
--

INSERT INTO `rpos_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
('10e0b6dc958adfb5b094d8935a13aeadbe783c25', 'Admin1', 'admin@mail.com', '903b21879b4a60fc9103c3334e4f6f62cf6c3a2d');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_customers`
--

CREATE TABLE `rpos_customers` (
  `customer_id` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_phoneno` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_password` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_customers`
--

INSERT INTO `rpos_customers` (`customer_id`, `customer_name`, `customer_phoneno`, `customer_email`, `customer_password`, `created_at`) VALUES
('06549ea58afd', 'Aliyah', '0956756679', 'aliyahjandee@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:30:44.129168'),
('1fc1f694985d', 'Benjamin', '0899976524', 'Benjasaton@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '2024-05-12 09:32:35.909666'),
('27e4a5bc74c2', 'Jariya', '0923114567', 'Jariyasuchao@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:36:05.559618'),
('29c759d624f9', 'Natthapong', '0821334538', 'NatthapongFangthong@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:37:50.240770'),
('35135b319ce3', 'Thitipan', '09877689972', 'thitizaa@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:38:54.806329'),
('3859d26cd9a5', 'Prapon', '0957967702', 'praponRuji8@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:40:14.411881'),
('57b7541814ed', 'sarun', '0897213456', 'saranya@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:40:47.006407'),
('7c8f2100d552', 'Areeya', '0986754367', 'Chongsatientam@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '2024-05-12 09:41:59.439433'),
('9c7fcc067bda', 'Urai', '0870023452', 'UraiBunyiem@mail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:42:48.118718'),
('9f6378b79283', 'Arnon', '0823345647', 'Arnonhomjung@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:43:32.527848'),
('d0ba61555aee', 'Jamebrone', '0865657860', 'jameesang@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:44:40.986251'),
('d7c2db8f6cbf', 'Sirirat', '0856123245', 'sirirattt1@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 09:45:55.373604'),
('e711dcc579d9', 'maroot', '0946782317', 'kamhom123@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', '2024-05-12 10:00:43.577208'),
('fe6bb69bdd29', 'kunnaphat', '0987898891', 'seethong@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '2024-05-12 10:00:51.941955');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_orders`
--

CREATE TABLE `rpos_orders` (
  `order_id` varchar(200) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `prod_id` varchar(200) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_price` varchar(200) NOT NULL,
  `prod_qty` varchar(200) NOT NULL,
  `order_status` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_orders`
--

INSERT INTO `rpos_orders` (`order_id`, `order_code`, `customer_id`, `customer_name`, `prod_id`, `prod_name`, `prod_price`, `prod_qty`, `order_status`, `created_at`) VALUES
('6466fd5ee5', 'COXP-6018', '7c8f2100d552', 'Melody E. Hance', '31dfcc94cf', 'Buffalo Wings', '11', '2', 'Paid', '2022-09-03 12:17:44.680896'),
('77785bb547', 'BUGV-6351', '29c759d624f9', 'Natthapong', '06dc36c1be', 'Philly Cheesesteak', '8', '1', 'Paid', '2024-05-13 14:48:42.043732'),
('80ab270866', 'JFMB-0731', '35135b319ce3', 'Christine Moore', '97972e8d63', 'Irish Coffee', '11', '1', 'Paid', '2022-09-04 16:37:03.716697'),
('8815e7edfc', 'QOEH-8613', '29c759d624f9', 'Trina L. Crowder', '2b976e49a0', 'Cheeseburger', '3', '3', 'Paid', '2022-09-03 12:02:32.985451'),
('af52d0022d', 'FNAB-9142', '35135b319ce3', 'Christine Moore', '2fdec9bdfb', 'Jambalaya', '9', '2', 'Paid', '2022-09-04 16:32:14.949302'),
('e71ae85c0d', 'KDNW-2684', '1fc1f694985d', 'Benjamin', '06dc36c1be', 'Philly Cheesesteak', '8', '8', 'Paid', '2024-05-13 15:20:32.925846'),
('f38043c691', 'BGKY-3421', '1fc1f694985d', 'Benjamin', '06dc36c1be', 'Philly Cheesesteak', '8', '1', 'Paid', '2024-05-13 15:03:15.539130');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_pass_resets`
--

CREATE TABLE `rpos_pass_resets` (
  `reset_id` int(20) NOT NULL,
  `reset_code` varchar(200) NOT NULL,
  `reset_token` varchar(200) NOT NULL,
  `reset_email` varchar(200) NOT NULL,
  `reset_status` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_pass_resets`
--

INSERT INTO `rpos_pass_resets` (`reset_id`, `reset_code`, `reset_token`, `reset_email`, `reset_status`, `created_at`) VALUES
(1, '63KU9QDGSO', '4ac4cee0a94e82a2aedc311617aa437e218bdf68', 'sysadmin@icofee.org', 'Pending', '2020-08-17 15:20:14.318643');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_payments`
--

CREATE TABLE `rpos_payments` (
  `pay_id` varchar(200) NOT NULL,
  `pay_code` varchar(200) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `pay_amt` varchar(200) NOT NULL,
  `pay_method` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_payments`
--

INSERT INTO `rpos_payments` (`pay_id`, `pay_code`, `order_code`, `customer_id`, `pay_amt`, `pay_method`, `created_at`) VALUES
('07fcca', 'FK73NQR9TC', 'BGKY-3421', '1fc1f694985d', '8', 'Paypal', '2024-05-13 15:03:15.536374'),
('0bf592', '9UMWLG4BF8', 'EJKA-4501', '35135b319ce3', '8', 'Cash', '2022-09-04 16:31:54.525284'),
('4423d7', 'QWERT0YUZ1', 'JFMB-0731', '35135b319ce3', '11', 'Cash', '2022-09-04 16:37:03.655834'),
('442865', '146XLFSC9V', 'INHG-0875', '9c7fcc067bda', '10', 'Paypal', '2022-09-04 16:35:22.470600'),
('65891b', 'MF2TVJA1PY', 'ZPXD-6951', 'e711dcc579d9', '16', 'Cash', '2022-09-03 13:12:46.959558'),
('75ae21', '1QIKVO69SA', 'IUSP-9453', 'fe6bb69bdd29', '10', 'Cash', '2022-09-03 11:50:40.496625'),
('7e1989', 'KLTF3YZHJP', 'QOEH-8613', '29c759d624f9', '9', 'Cash', '2022-09-03 12:02:32.926529'),
('968488', '5E31DQ2NCG', 'COXP-6018', '7c8f2100d552', '22', 'Cash', '2022-09-03 12:17:44.639979'),
('980009', 'W63SKTE78M', 'KDNW-2684', '1fc1f694985d', '64', 'Paypal', '2024-05-13 15:20:32.923515'),
('984539', 'LSBNK1WRFU', 'FNAB-9142', '35135b319ce3', '18', 'Paypal', '2022-09-04 16:32:14.852482'),
('9fcee7', 'AZSUNOKEI7', 'OTEV-8532', '3859d26cd9a5', '15', 'Cash', '2022-09-03 13:13:38.855058'),
('c81d2e', 'WERGFCXZSR', 'AEHM-0653', '06549ea58afd', '8', 'Cash', '2022-09-03 13:26:00.331494'),
('dead95', '1D47ISX2C6', 'BUGV-6351', '29c759d624f9', '8', 'Cash', '2024-05-13 14:48:42.037450'),
('e46e29', 'QMCGSNER3T', 'ONSY-2465', '57b7541814ed', '12', 'Cash', '2022-09-03 08:35:50.172062');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_products`
--

CREATE TABLE `rpos_products` (
  `prod_id` varchar(200) NOT NULL,
  `prod_code` varchar(200) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_img` varchar(200) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_price` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_products`
--

INSERT INTO `rpos_products` (`prod_id`, `prod_code`, `prod_name`, `prod_img`, `prod_desc`, `prod_price`, `created_at`) VALUES
('06dc36c1be', 'FCWU-5762', 'Iced Cappuccino ', 'Iced Cappuccino 1080.png', '.', '120', '2024-05-13 18:42:20.562113'),
('14c7b6370e', 'QZHM-0391', 'Iced Latte Reserve', 'Iced Latte Reserve.png', '.', '120', '2024-05-13 18:42:51.021666'),
('1e0fa41eee', 'ICFU-1406', 'Shakerato Bianco Over Ice', 'Shakerato Bianco Over Ice.png', '.', '120', '2024-05-13 18:43:34.000628'),
('2b976e49a0', 'CEWV-9438', 'Starbucks Reserve Undertow', 'Starbucks Reserve Undertow.png', '.', '100', '2024-05-13 18:44:10.941591'),
('2fdec9bdfb', 'UJAK-9614', 'Salted Caramel Espresso', 'Salted Caramel Espresso.png', '.', '100', '2024-05-13 18:50:22.131349'),
('31dfcc94cf', 'SYQP-3710', 'Starbucks Reserve Iced Americano', 'Starbucks Reserve Iced Americano.png', '.', '100', '2024-05-13 18:52:42.787590'),
('4e68e0dd49', 'QLKW-0914', 'Starbucks Piccolo Latte', 'Starbucks Piccolo Latte.png', '.', '100', '2024-05-13 18:53:50.273270'),
('97972e8d63', 'CVWJ-6492', 'Starbucks Reserve Latte', 'Starbucks Reserve Latte.png', '.', '120', '2024-05-13 18:55:45.665099'),
('af429f8ad7', 'XLPK-7618', 'Java Chip Frappuccino', 'Java Chip Frappuccino.jpeg', '-', '140', '2024-05-13 18:58:25.834004'),
('d0e96cc3d0', 'TSFV-5172', 'Espresso ', 'Espresso 1080.png', '-', '80', '2024-05-13 18:57:56.750657'),
('f7fd166d0f', 'WKLV-6320', 'Green Tea Latte', 'Green Tea Latte.png', '-', '90', '2024-05-13 18:57:24.126627');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_staff`
--

CREATE TABLE `rpos_staff` (
  `staff_id` int(20) NOT NULL,
  `staff_name` varchar(200) NOT NULL,
  `staff_number` varchar(200) NOT NULL,
  `staff_email` varchar(200) NOT NULL,
  `staff_password` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpos_staff`
--

INSERT INTO `rpos_staff` (`staff_id`, `staff_name`, `staff_number`, `staff_email`, `staff_password`, `created_at`) VALUES
(2, 'Cashier Taoz', 'QEUY-9042', 'cashier@mail.com', 'codeastro.com', '2024-05-13 18:28:51.884809');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rpos_admin`
--
ALTER TABLE `rpos_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `rpos_customers`
--
ALTER TABLE `rpos_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `rpos_orders`
--
ALTER TABLE `rpos_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `CustomerOrder` (`customer_id`),
  ADD KEY `ProductOrder` (`prod_id`);

--
-- Indexes for table `rpos_pass_resets`
--
ALTER TABLE `rpos_pass_resets`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `rpos_payments`
--
ALTER TABLE `rpos_payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `order` (`order_code`);

--
-- Indexes for table `rpos_products`
--
ALTER TABLE `rpos_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `rpos_staff`
--
ALTER TABLE `rpos_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rpos_pass_resets`
--
ALTER TABLE `rpos_pass_resets`
  MODIFY `reset_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rpos_staff`
--
ALTER TABLE `rpos_staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rpos_orders`
--
ALTER TABLE `rpos_orders`
  ADD CONSTRAINT `CustomerOrder` FOREIGN KEY (`customer_id`) REFERENCES `rpos_customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProductOrder` FOREIGN KEY (`prod_id`) REFERENCES `rpos_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
