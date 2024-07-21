-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 01:12 PM
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
-- Database: `gymdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `product_id`, `total`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(8, '11720010513', 1, 100, 0, '2024-07-03 08:56:53', NULL, 0),
(9, '11721215755', 1, 100, 0, '2024-07-17 07:44:15', NULL, 0),
(10, '11721523806', 1, 100, 0, '2024-07-20 21:18:26', NULL, 0),
(11, '11721524000', 1, 100, 0, '2024-07-20 21:21:40', NULL, 0),
(12, '31721524209', 3, 200, 0, '2024-07-20 21:25:09', NULL, 0),
(13, '11721532089', 1, 100, 0, '2024-07-20 23:36:29', NULL, 0),
(14, '21721532680', 2, 150, 0, '2024-07-20 23:46:20', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `amount`) VALUES
(1, 'Student', 'With an Everyone Active student gym membership, you get to use our gyms just about whenever you want.', 'p1.jpeg', 100),
(2, 'Regular', 'Standard gym equipment includes dumbbells, weight machines, kettlebells, squat racks, and cardio equipment', 'p2.jpeg', 150),
(3, 'Pro', 'Exercise involves engaging in physical activity and increasing the heart rate levels. It is an important part of\r\nphysical and mental health.', 'p3.jpeg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `mobile`, `password`, `create_date`) VALUES
(1, 'admin', 'admin@gmail.com', '9863993128', '0192023a7bbd73250516f069df18b500', '2024-06-10 11:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(1, 'Cardio & Zumba', ' Great cardio workout that melts fat, strengthens your core, and improves flexibility.', 'cycl.jpeg', '2024-07-20 11:58:34'),
(2, 'Body Building', 'Bodybuilding is the practice of progressive resistance exercise to build, control, and develop one\'s muscles ', 'strength.jpg', '2024-07-20 12:18:29'),
(3, 'Yoga', 'Yoga is a practice that combines physical postures, breathing exercises, and meditation to enhance flexibility.', 'cyoga.jpg', '2024-07-20 13:31:48'),
(4, 'Kickboxing', 'Kickboxing combines martial arts techniques with cardiovascular exercise , kicking and punching. ', '906fcacef29da764a04af3e79eca0b3b.jpg', '2024-07-20 13:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `state`, `city`, `address`, `create_date`) VALUES
(7, 'Subarna', 'Khatiwada', 'subarna.khatiwada13@gmail.com', '9863993128', '72305fc6aa5dabcb5994bdd5ac28f151', 'Bagmati ', 'Kathmandu', 'Maitidevi', '2024-06-18 17:05:14'),
(8, 'Bikash', 'Sunar', 'b.kas@gmail.com', '9818268002', '21609643c89e73e4a4fd0ab6cfe0e61f', 'Bagmati', 'Kathmandu', NULL, '2024-06-20 07:37:22'),
(9, 'Unesh', 'Khatiwada', 'aa@gmail.com', '9843769772', '283f42764da6dba2522412916b031080', 'maitidevi', 'ktm', NULL, '2024-06-20 12:11:56'),
(10, 'Aaaa', 'Bbbb', 'abc@gmail.com', '9876546732', '00b7691d86d96aebd21dd9e138f90840', 'state 4', 'pokhara', NULL, '2024-06-20 12:22:43'),
(11, 'nabin', 'pulami', 'na@gmail.com', '9848989897', '202cb962ac59075b964b07152d234b70', 'state2', 'kathmandu', '', '2024-06-24 04:37:21'),
(12, 'ram', 'bahadur', 'ram@gmail.com', '9811112222', '00b7691d86d96aebd21dd9e138f90840', 'State 4', 'Pokhara', NULL, '2024-06-27 10:12:03'),
(13, 'dileep', 'kushwaha', 'dileepkushwaha2222@gmail.com', '9861174461', '81dc9bdb52d04dc20036dbd8313ed055', 'bagmati', 'kathmandu', NULL, '2024-07-21 01:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `specialization`, `image`) VALUES
(3, 'Bishal', 'Zumba & Cardio', '97d21acf2f5d7ebaaaf84cad4386e134.png'),
(4, 'Nikhil', 'Strength Coach', 'dda160441bac1dadc5a9b929744ed337.png'),
(5, 'Ajay', ' Kickboxing Expert', 'b1a2b320c3b34119b0af28bbc885932c.png'),
(6, 'Nabin', 'Recovery Specialist', '5851d0df73d5cc0739be0c3057d1fe59.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fk` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
