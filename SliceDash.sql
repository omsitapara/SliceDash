-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2025 at 11:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SliceDash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `order_number`, `status`, `added_on`) VALUES
(12, 'Veg Pizza', 5, 1, '2024-07-28 10:51:52'),
(13, 'Non Veg Pizza', 4, 1, '2024-07-28 10:52:19'),
(14, 'Pizza Mania', 3, 1, '2024-07-28 10:52:30'),
(15, 'Sides', 2, 1, '2024-07-28 10:52:56'),
(16, 'Beverages', 1, 1, '2024-07-28 10:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `added_on`) VALUES
(6, 'MEET VADJA', 'ddmodok55148@jadsys.com', '9999999999', 'Bulk Order', 'We wanted to order 1000 pizzas. Please respond to 9988998899', '2024-08-10 01:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `coupon_type` enum('P','F') NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `expired_on` date NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `coupon_code`, `coupon_type`, `coupon_value`, `cart_min_value`, `expired_on`, `status`, `added_on`) VALUES
(3, 'FLAT30', 'P', 30, 500, '2027-07-01', 1, '2024-07-25 09:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `mobile`, `password`, `status`, `added_on`) VALUES
(3, 'Rahul', '9724998487', 'Test123', 1, '2024-07-25 09:12:33'),
(4, 'Rohit', '9731031834', 'tutogym', 1, '2024-07-28 05:40:32'),
(5, 'Om', '9723409227', 'Test123', 1, '2024-11-16 11:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dish` varchar(100) NOT NULL,
  `dish_detail` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` enum('veg','non-veg') NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `taste` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `dish`, `dish_detail`, `image`, `type`, `status`, `added_on`, `taste`) VALUES
(13, 12, 'Margherita Pizza', 'A hugely popular margherita, with a deliciously tangy single cheese topping', 'pizza1.jpg', 'veg', 1, '2024-07-28 10:54:25', 'salty'),
(14, 12, 'Double Cheese Margherita', 'The ever-popular Margherita - loaded with extra cheese... oodies of it!', 'pizza2.jpg', 'veg', 1, '2024-07-28 10:57:46', 'salty'),
(15, 12, 'Farmhouse', 'A pizza that goes ballistic on veggies! Check out this mouth watering overload of crunchy, crisp capsicum, succulent mushrooms and fresh tomatoes', 'pizza3.jpg', 'veg', 1, '2024-07-28 10:59:41', 'spicy'),
(16, 12, 'Peppy Paneer', 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!', 'pizza4.jpg', 'veg', 1, '2024-07-28 11:00:55', 'spicy'),
(17, 12, 'Mexican Green Wave', 'A pizza loaded with crunchy onions, crisp capsicum, juicy tomatoes and jalapeno with a liberal sprinkling of exotic Mexican herbs.', 'pizza5.jpg', 'veg', 1, '2024-07-28 11:02:31', 'sour'),
(18, 13, 'Chicken Golden Delight', 'Mmm! Barbeque chicken with a topping of golden corn loaded with extra cheese. Worth its weight in gold!', 'pizza6.png', 'non-veg', 1, '2024-07-28 11:05:38', 'savoury'),
(19, 13, 'Non Veg Supremer', 'Bite into supreme delight of Black Olives, Onions, Grilled Mushrooms, Pepper BBQ Chicken, Peri-Peri Chicken, Grilled Chicken Rashers', 'pizza7.png', 'non-veg', 1, '2024-07-28 11:06:43', 'savoury'),
(20, 13, 'PEPPER BARBECUE & ONION', 'Pepper Barbecue Chicken I Onion', 'pizza8.jpg', 'non-veg', 1, '2024-07-28 11:08:01', 'sour'),
(21, 14, 'Veg Loaded', 'Tomato | Grilled Mushroom |Jalapeno |Golden Corn | Beans in a fresh pan crust', 'pizza9.jpg', 'veg', 1, '2024-07-28 11:09:14', 'sweet'),
(22, 14, 'Cheesy', 'Orange Cheddar Cheese I Mozzarella', 'pizza10.jpg', 'veg', 1, '2024-07-28 11:10:11', 'salty'),
(23, 14, 'Paneer and Onion', 'Paneer and Onion', 'pizza11.jpg', 'veg', 1, '2024-07-28 11:11:10', 'bitter'),
(24, 14, 'Capsicum', 'Cheese and Capsicum', 'pizza12.jpg', 'veg', 1, '2024-07-28 11:11:57', 'bitter'),
(25, 15, 'Veg Loaded Tacos', 'Cheese and Tacos', 'sides1.jpg', 'veg', 1, '2024-07-28 11:13:53', 'savoury'),
(26, 15, 'Non Veggie Tacos', 'Non veg tacos', 'sides2.jpg', 'non-veg', 1, '2024-07-28 11:19:46', 'bitter'),
(27, 15, 'Meatballs', 'Meatball', 'sides3.png', 'non-veg', 1, '2024-07-28 11:20:42', 'bitter'),
(30, 16, 'Mirinda', 'FIzzzzzz', 'bev1.png', 'veg', 1, '2024-08-10 01:13:02', 'sweet'),
(34, 15, 'TEST1', 'Tasty', 'sample-7705346_640.jpg', 'veg', 1, '2024-11-11 11:15:38', 'savoury');

-- --------------------------------------------------------

--
-- Table structure for table `dish_cart`
--

CREATE TABLE `dish_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dish_cart`
--

INSERT INTO `dish_cart` (`id`, `user_id`, `dish_detail_id`, `qty`, `added_on`) VALUES
(78, 1, 31, 1, '2024-11-16 12:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `dish_details`
--

CREATE TABLE `dish_details` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dish_details`
--

INSERT INTO `dish_details` (`id`, `dish_id`, `attribute`, `price`, `status`, `added_on`) VALUES
(1, 9, 'Regular', 99, 1, '2024-07-26 01:37:08'),
(2, 9, 'Medium', 199, 1, '2024-07-26 01:37:08'),
(3, 9, 'Large', 399, 1, '2024-07-26 01:37:08'),
(4, 11, '10 pieces', 250, 1, '2024-07-27 06:06:46'),
(5, 12, 'Regular', 150, 1, '2024-07-27 10:01:02'),
(6, 12, 'Medium', 399, 1, '2024-07-27 10:01:29'),
(7, 13, 'Regular', 99, 1, '2024-07-28 10:54:25'),
(8, 13, 'Medium', 199, 1, '2024-07-28 10:54:25'),
(9, 13, 'Large', 399, 1, '2024-07-28 10:54:25'),
(10, 14, 'Regular', 199, 1, '2024-07-28 10:57:46'),
(11, 14, 'Medium', 299, 1, '2024-07-28 10:57:46'),
(12, 14, 'Large', 499, 1, '2024-07-28 10:57:46'),
(13, 15, 'Regular', 249, 1, '2024-07-28 10:59:41'),
(14, 15, 'Medium', 449, 1, '2024-07-28 10:59:41'),
(15, 15, 'Large', 699, 1, '2024-07-28 10:59:41'),
(16, 16, 'Regular', 259, 1, '2024-07-28 11:00:55'),
(17, 16, 'Medium', 459, 1, '2024-07-28 11:00:55'),
(18, 16, 'Large', 719, 1, '2024-07-28 11:00:55'),
(19, 17, 'Regular', 269, 1, '2024-07-28 11:02:31'),
(20, 17, 'Medium', 479, 1, '2024-07-28 11:02:31'),
(21, 17, 'Large', 719, 1, '2024-07-28 11:02:31'),
(22, 18, 'Regular', 249, 1, '2024-07-28 11:05:38'),
(23, 18, 'Medium', 499, 1, '2024-07-28 11:05:38'),
(24, 18, 'Large', 799, 1, '2024-07-28 11:05:38'),
(25, 19, 'Regular', 299, 1, '2024-07-28 11:06:43'),
(26, 19, 'Medium', 499, 1, '2024-07-28 11:06:43'),
(27, 19, 'Large', 799, 1, '2024-07-28 11:06:43'),
(28, 20, 'Regular', 299, 1, '2024-07-28 11:08:01'),
(29, 20, 'Medium', 499, 1, '2024-07-28 11:08:01'),
(30, 20, 'Large', 799, 1, '2024-07-28 11:08:01'),
(31, 21, 'Regular', 129, 1, '2024-07-28 11:09:14'),
(32, 22, 'Regular', 59, 1, '2024-07-28 11:10:11'),
(33, 23, 'Regular', 99, 1, '2024-07-28 11:11:10'),
(34, 24, 'Regular', 69, 1, '2024-07-28 11:11:57'),
(35, 25, '2 pieces', 129, 1, '2024-07-28 11:13:53'),
(36, 26, '2 pieces', 199, 1, '2024-07-28 11:19:46'),
(37, 27, '10 pieces', 299, 1, '2024-07-28 11:20:42'),
(38, 30, '250 ml', 20, 1, '2024-08-10 01:13:02'),
(39, 31, 'nskdn', 400, 1, '2024-08-10 01:15:27'),
(40, 32, '250 ml', 40, 1, '2024-09-06 09:18:51'),
(41, 33, 'Regu', 100, 1, '2024-09-06 12:18:16'),
(42, 34, '2 pieces', 100, 1, '2024-11-11 11:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_details_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `dish_details_id`, `price`, `qty`) VALUES
(1, 1, 35, 129, 6),
(2, 2, 35, 129, 2),
(3, 3, 35, 129, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `total_price` float NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `final_price` float NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `delivery_boy_id` int(11) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `order_status` int(11) NOT NULL,
  `delivered_on` datetime DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `user_id`, `name`, `email`, `mobile`, `address`, `total_price`, `coupon_code`, `final_price`, `zipcode`, `delivery_boy_id`, `payment_status`, `payment_type`, `payment_id`, `order_status`, `delivered_on`, `added_on`) VALUES
(1, 1, 'Test User', 'test@xyz.com', '1122334455', 'Tst', 774, '', 774, '370110', NULL, 'pending', 'online', NULL, 1, NULL, '2024-11-14 02:00:18'),
(2, 1, 'Test User', 'test@xyz.com', '1122334455', 'mcd', 258, '', 258, '370110', 5, 'success', 'cod', NULL, 4, NULL, '2024-11-16 11:08:05'),
(3, 1, 'Test User', 'test@xyz.com', '1122334455', 'ldrp', 129, '', 129, '223212', NULL, 'pending', 'online', NULL, 1, NULL, '2024-11-16 11:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`) VALUES
(1, 'Received by us'),
(2, 'Being Prepared'),
(3, 'Out for Delivery'),
(4, 'Delivered'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `taste`
--

CREATE TABLE `taste` (
  `id` int(1) NOT NULL,
  `taste` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taste`
--

INSERT INTO `taste` (`id`, `taste`) VALUES
(1, 'Sweet'),
(2, 'Sour'),
(3, 'Salty'),
(4, 'Bitter'),
(5, 'Savoury');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `mobile`, `password`, `status`, `added_on`) VALUES
(1, 'Test User', 'test@xyz.com', '1122334455', 'password', 1, '2024-07-25 09:13:07'),
(15, 'Om', 'omsitapara5@gmail.com', '9724998487', 'om@2003', 1, '2024-08-30 02:48:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_cart`
--
ALTER TABLE `dish_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_details`
--
ALTER TABLE `dish_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taste`
--
ALTER TABLE `taste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `dish_cart`
--
ALTER TABLE `dish_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `dish_details`
--
ALTER TABLE `dish_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
