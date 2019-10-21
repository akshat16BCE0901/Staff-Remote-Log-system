-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2019 at 08:39 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prashant`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid` varchar(20) DEFAULT NULL,
  `access` varchar(50) DEFAULT NULL,
  `scan_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT NULL,
  `return_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `rfid`, `access`, `scan_time`, `status`, `return_time`) VALUES
(7, '60822192', 'Unauthorized', '2019-10-20 19:32:34', 0, '2019-10-20 19:32:41'),
(8, '5088254239', 'Authorized', '2019-10-20 19:32:36', 0, '2019-10-20 19:32:40'),
(9, '60822192', 'Unauthorized', '2019-10-20 19:32:43', 0, '2019-10-20 19:32:45'),
(10, '60822192', 'Unauthorized', '2019-10-20 20:01:39', 0, '2019-10-20 20:16:02'),
(11, '5088254239', 'Authorized', '2019-10-20 20:01:42', 0, '2019-10-20 20:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid` varchar(20) NOT NULL,
  `empid` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rfid` (`rfid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `rfid`, `empid`, `name`) VALUES
(1, '5088254239', '17BCE0865', 'Prashant Kumar'),
(2, '60822192', '16BCE0901', 'Akshat Singhal');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
