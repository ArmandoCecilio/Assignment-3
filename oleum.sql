-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 03:16 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oleum`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientprofile`
--

CREATE TABLE `clientprofile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientprofile`
--

INSERT INTO `clientprofile` (`id`, `userid`, `fullname`, `address1`, `address2`, `city`, `state`, `zip`) VALUES
(2, 1, 'Fausto', '123 Main St', NULL, 'Houston', 'TX', '77002');

-- --------------------------------------------------------

--
-- Table structure for table `fuelquote`
--

CREATE TABLE `fuelquote` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gallons_requested` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `suggested_price` decimal(10,2) NOT NULL,
  `total_amount_due` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuelquote`
--

INSERT INTO `fuelquote` (`id`, `userid`, `gallons_requested`, `delivery_address`, `delivery_date`, `suggested_price`, `total_amount_due`) VALUES
(1, 1, 10, '123, Main St', '2023-04-04', '3.52', '35.20');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'Majorf', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientprofile`
--
ALTER TABLE `clientprofile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `fuelquote`
--
ALTER TABLE `fuelquote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FuelQuoteFK_userid` (`userid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientprofile`
--
ALTER TABLE `clientprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fuelquote`
--
ALTER TABLE `fuelquote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientprofile`
--
ALTER TABLE `clientprofile`
  ADD CONSTRAINT `ClientProfileFKUser_id` FOREIGN KEY (`userid`) REFERENCES `login` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuelquote`
--
ALTER TABLE `fuelquote`
  ADD CONSTRAINT `FuelQuoteFK_userid` FOREIGN KEY (`userid`) REFERENCES `login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
