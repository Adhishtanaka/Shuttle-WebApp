-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 10:33 AM
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
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `shuttle`
--

CREATE TABLE `shuttle` (
  `id` int(255) NOT NULL,
  `onic` varchar(100) NOT NULL,
  `ocontact` varchar(100) NOT NULL,
  `onicimage` varchar(250) NOT NULL,
  `dcontact` varchar(100) NOT NULL,
  `demail` varchar(100) NOT NULL,
  `dpass` varchar(100) NOT NULL,
  `dnicimage` varchar(255) NOT NULL,
  `rnumber` varchar(100) NOT NULL,
  `dest` varchar(100) NOT NULL,
  `access` int(11) NOT NULL,
  `blpnumber` varchar(250) NOT NULL,
  `bimage` varchar(250) NOT NULL,
  `uid` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shuttle`
--

INSERT INTO `shuttle` (`id`, `onic`, `ocontact`, `onicimage`, `dcontact`, `demail`, `dpass`, `dnicimage`, `rnumber`, `dest`, `access`, `blpnumber`, `bimage`, `uid`) VALUES
(10, 'Thiramithu Kulasooriya', '0785866652', '../upload/6585546bbd921_page_1.webp', '0785866651', 'hx@gmail.com', '123456', '../upload/6585546bbdd38_download (2).jpeg', '21', 'kegalle', 1, 'bby 2291', '../upload/6585546bbe201_download.jpeg', 'OHuMtt68Gvb87KptcXtZlkXrWln2'),
(15, 'THIRA', '0761072203', '../upload/65bad16279eff_download (2).jpeg', '0761072203', 'thira@gmail.com', '123456', '../upload/65bad1627a662_download (1).jpeg', '255', 'KOTTAWA', 1, 'KL-8547', '../upload/65bad1627a813_download.jpeg', 'Zi5wo7UHC1OmsvJnDj9V6m53dzH3'),
(16, 'Dulshan ', '0719453677', '../upload/65bb114111f78_download (2).jpeg', '0715760142', 'dilinamewan07@gmail.com', '123456', '../upload/65bb1141126bd_download (1).jpeg', '255', 'Kottawa', 1, 'KD-28775', '../upload/65bb114112b46_download.jpeg', '6tleUlz4InRfCYhqV6jobr24JUL2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'thira@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shuttle`
--
ALTER TABLE `shuttle`
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
-- AUTO_INCREMENT for table `shuttle`
--
ALTER TABLE `shuttle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
