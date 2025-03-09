-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 08:21 AM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_name`, `admin_pass`) VALUES
('Nathan', 12345),
('Oran', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historia`
--

CREATE TABLE `historia` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `historia`
--

INSERT INTO `historia` (`id`, `site_name`, `location`, `image`, `created_at`) VALUES
(1, 'Taj Mahal', 'Delhi', 'uploads/loginpic.jpg', '2025-02-26 18:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `historia_detail`
--

CREATE TABLE `historia_detail` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `historia_detail`
--

INSERT INTO `historia_detail` (`id`, `site_name`, `description`, `images`, `created_at`, `latitude`, `longitude`) VALUES
(6, 'Taj Mahal', 'Taj Mahal', 'uploads/2018021713-olw9efdfpeagesu3jvdbw9qk702e6v4w5gu8c83z6c.jpg,uploads/2018021766-olw9egb9w8bqqesqedrygri0sdxrek8mhlhpti2l04.jpg', '2025-03-06 08:02:56', 27.1751, 78.0421);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_carousel`
--

CREATE TABLE `homepage_carousel` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `homepage_carousel`
--

INSERT INTO `homepage_carousel` (`id`, `image_path`) VALUES
(14, 'uploads/taj-mahal-tourists-enjoying-grounds-260nw-2505398301.webp'),
(15, 'uploads/gate-india-hawa-mahal-taj-260nw-2157691873.webp'),
(16, 'uploads/1000_F_142045027_zo4MOsmC4aoc5dAYoP6Q8c36Tz2kTXiI.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_name`, `email`, `rating`, `review_text`, `created_at`) VALUES
(1, 'Guest', 'test1@gmail.com', 5, 'Amazing Hotel', '2025-02-28 13:26:54'),
(2, 'Guest', 'oran512815@gmail.com', 1, 'Bekaar website', '2025-02-28 13:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `features` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `available_from` date NOT NULL,
  `available_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `features`, `price`, `image`, `location`, `available_from`, `available_to`) VALUES
(12, 'Medium Room 1', 'WiFi', 400, 'rooms\\Guest Room.avif', 'Maharastra', '2025-03-01', '2025-03-08'),
(13, 'Medium Room 2', 'WiFi', 400, 'rooms\\Guest Room.avif', 'Maharastra', '2025-03-01', '2025-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `room_descriptions`
--

CREATE TABLE `room_descriptions` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_descriptions`
--

INSERT INTO `room_descriptions` (`id`, `room_name`, `description`) VALUES
(1, 'Medium Room', 'hello'),
(3, 'Guest Room', 'this is a guest room'),
(4, 'Medium Room 2', 'This is room 2'),
(5, 'Medium Room 1', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `profile_pic`) VALUES
(1, 'Nathan', 'Smith', 'nat512815@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(4, 'Nathan', 'Smith', 'abc@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(5, 'test', '1', 'test1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'uploads/IMG_20171216_145359.jpg'),
(6, 'Oran', 'DSouza', 'oran512815@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/0ven7-1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_name` (`site_name`);

--
-- Indexes for table `historia_detail`
--
ALTER TABLE `historia_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_site` (`site_name`);

--
-- Indexes for table `homepage_carousel`
--
ALTER TABLE `homepage_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_room_name` (`room_name`);

--
-- Indexes for table `room_descriptions`
--
ALTER TABLE `room_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_name` (`room_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `historia`
--
ALTER TABLE `historia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `historia_detail`
--
ALTER TABLE `historia_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homepage_carousel`
--
ALTER TABLE `homepage_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room_descriptions`
--
ALTER TABLE `room_descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historia_detail`
--
ALTER TABLE `historia_detail`
  ADD CONSTRAINT `fk_site` FOREIGN KEY (`site_name`) REFERENCES `historia` (`site_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
