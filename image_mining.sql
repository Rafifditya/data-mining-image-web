-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 06:33 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_mining`
--

-- --------------------------------------------------------

--
-- Table structure for table `meta_image`
--

CREATE TABLE `meta_image` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `hue` int(11) NOT NULL,
  `sat` int(11) NOT NULL,
  `val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meta_image`
--

INSERT INTO `meta_image` (`id`, `filename`, `hue`, `sat`, `val`) VALUES
(5, '1528127833.jpg', 43, 100, 100),
(6, '1528127838.jpg', 43, 100, 100),
(7, '1528128142.jpg', 345, 100, 100),
(8, '1528129980.jpg', 345, 100, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meta_image`
--
ALTER TABLE `meta_image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meta_image`
--
ALTER TABLE `meta_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
