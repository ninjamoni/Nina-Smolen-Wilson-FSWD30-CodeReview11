-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 12:05 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_nina_smolen_wilson_php_car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `details` varchar(500) DEFAULT NULL,
  `fk_offices_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cars_status`
--

CREATE TABLE `cars_status` (
  `cars_status_id` int(11) NOT NULL,
  `fk_current_location_id` int(11) NOT NULL,
  `fk_car_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `current_location`
--

CREATE TABLE `current_location` (
  `current_location_id` int(11) NOT NULL,
  `gps_tracking` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `offices_id` int(11) NOT NULL,
  `location_1` varchar(100) DEFAULT NULL,
  `location_2` varchar(100) DEFAULT NULL,
  `location_3` varchar(100) DEFAULT NULL,
  `location_4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_offices_id` (`fk_offices_id`);

--
-- Indexes for table `cars_status`
--
ALTER TABLE `cars_status`
  ADD PRIMARY KEY (`cars_status_id`),
  ADD KEY `fk_current_location_id` (`fk_current_location_id`),
  ADD KEY `fk_car_id` (`fk_car_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `current_location`
--
ALTER TABLE `current_location`
  ADD PRIMARY KEY (`current_location_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`offices_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `offices_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`fk_offices_id`) REFERENCES `offices` (`offices_id`);

--
-- Constraints for table `cars_status`
--
ALTER TABLE `cars_status`
  ADD CONSTRAINT `cars_status_ibfk_1` FOREIGN KEY (`fk_current_location_id`) REFERENCES `current_location` (`current_location_id`),
  ADD CONSTRAINT `cars_status_ibfk_2` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `cars_status_ibfk_3` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
