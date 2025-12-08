-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2025 at 06:46 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waqf_data_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `trusts`
--

DROP TABLE IF EXISTS `trusts`;
CREATE TABLE IF NOT EXISTS `trusts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trust_no` varchar(20) DEFAULT NULL,
  `trust_name` varchar(200) NOT NULL,
  `registered_mobile` varchar(20) NOT NULL,
  `area_type` varchar(20) DEFAULT NULL,
  `village` varchar(120) DEFAULT NULL,
  `municipal` varchar(120) DEFAULT NULL,
  `ward_no` varchar(20) DEFAULT NULL,
  `status_checked` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trusts`
--

INSERT INTO `trusts` (`id`, `trust_no`, `trust_name`, `registered_mobile`, `area_type`, `village`, `municipal`, `ward_no`, `status_checked`) VALUES
(1, '1029', 'Millat Nagar Masjid Madresa Trust', '9824792844', NULL, NULL, NULL, NULL, 0),
(2, '0091', 'Amena Park Ibadatgah and Madresa Welfare Waqf', '9824726498', NULL, NULL, NULL, NULL, 0),
(3, '0052', 'Mahini Undai Masjid', '9904541094', NULL, NULL, NULL, NULL, 0),
(4, '-', 'Bilal Masjid Madresa Trust', '9904535621', NULL, NULL, NULL, NULL, 0),
(5, '0316', 'Mulatani Bava Kabrastan Trust Committee', '9998147240', NULL, NULL, NULL, NULL, 0),
(6, '0315', 'Zadeshwari Pardeshi Kabrastan Trust Committee', '9998147240', NULL, NULL, NULL, NULL, 0),
(7, '0314', 'Al Waqf Khayri Kabrastan Waqf Committee', '9998147240', NULL, NULL, NULL, NULL, 0),
(8, '0015', 'VADAV TRRUST', '9574795147', 'Rural', 'Vadva', 'Bharuch Nagar Palika', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
