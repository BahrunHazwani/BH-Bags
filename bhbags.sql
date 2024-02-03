-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 04:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhbags`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `email`, `subject`, `message`, `date_time`) VALUES
(3, 'BAHRUN HAZWANI BINTI ASGAR ALI', 'bahrunhazwani@gmail.com', 'Bags Collection', 'I love your bags', '2021-08-04 18:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc_n` varchar(150) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `class` char(1) NOT NULL,
  `image_url` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `desc_n`, `price`, `class`, `image_url`) VALUES
(18, 'GG Marmont Matelassé Shoulder Bag Gucci', 'A softly structured shape and an oversized flap closure with Double G hardware. \r\nColor: Dusky Pink', '1200.30', '0', 'menu_1627924600.png'),
(19, 'Gucci Broadway leather Clutch with Double G', 'Gucci Crafted from textured black leather, the Broadway evening bag has a refined shape with an envelope flap closure. \r\nColor: Black', '1000.50', '0', 'menu_1627925189.png'),
(20, 'Gucci Off The Grid Belt Bag', 'Supporting the House\'s commitment to sustainability, this belt bag is part of a line of accessories and ready-to-wear made from recycled materials and', '414.35', '0', 'menu_1627925489.png'),
(21, 'On My Side MM Louis', 'The On My Side MM tote bag is fashioned from an elegant combination of small-grained calf leather and emblematic Monogram canvas. \r\nColor: Black', '1500.00', '0', 'menu_1627925732.png'),
(22, 'Danube PPM Louis', 'The Danube PPM is made from cowhide leather with a Vintage Monogram print.\r\nColor: Blue Cowhide', '330.20', '0', 'menu_1627926231.png'),
(23, 'HORIZON SOFT DUFFLE 2R 55 Louis', 'the Horizon Soft Duffel 55 is a rolling duffel bag, made from Damier Graphite coated canvas\r\nColor: Black', '2033.00', '0', 'menu_1627926605.png'),
(24, 'Hudson Logo Stripe Backpack', 'A front zip pocket provides quick access to your phone and card case, while the generous interior is equipped with a laptop compartment Michael Kors\r\n', '2969.00', '0', 'menu_1627926977.jpg'),
(25, 'SoHo Large Studded Quilted Leather ', 'A push-lock fastening opens to a sizable interior to stow your wallet, keys and lipstick, while an exterior back pocket will keep your phone within ar', '2599.00', '1', 'menu_1627927290.jpg'),
(26, 'Carmen Large Striped Jacquard and Leather Tote Bag', 'A gleaming chain-link strap and striped jacquard panels lend maximum polish to our Carmen Tote bag,', '1269.00', '0', 'menu_1627927587.jpg'),
(27, 'RFID Blocking Long Wallet Polo', '-This wallet has checked print textured long leather wallet, Leather/Textile, One bill slot, Two receipt slots, One ID window, 11 card slots & Dimensi', '100.00', '0', 'menu_1627928210.png'),
(28, 'THE MONACO WEEKENDER - NAVY AND TAN', 'Lightweight, weatherproof, and perfectly sized for a weekend away – the Monaco is the classic overnight bag reinvented for today\'s traveler. \r\nColor: ', '1668.78', '1', 'menu_1627928759.jpg'),
(29, 'British Polo Amy Handbag', 'British Polo Amy Handbag, Sling bag and Mini Bag Bundle Set.\r\nColor: Brown Peach', '259.00', '1', 'menu_1627929231.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(80) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `billing_details` varchar(300) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `fname`, `email`, `billing_details`, `amount`, `date`) VALUES
(22, 6, 'BAHRUN HAZWANI BINTI ASGAR ALI', 'bahrunhazwani@gmail.com', 'No.26, Jalan Cempaka 32, Taman Cempaka, Senawang., Seremban, Negeri Sembilan, 70450', '1260.32', '2021-08-04 12:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`) VALUES
(35, 20, 21, 1),
(36, 21, 24, 1),
(37, 22, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `active`) VALUES
(6, 'bahrunhazwani@gmail.com', '$2y$10$ViVmdSf0ZTEMIzLsUfUY8O8DSpA3DGHlO5qaLFjFQRr4YK1Kx1Op.', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
