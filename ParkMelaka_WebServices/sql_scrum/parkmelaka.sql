-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 11:05 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkmelaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `trans_loc_id` int(11) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `loc_council` varchar(255) NOT NULL,
  `loc_state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`trans_loc_id`, `loc_name`, `loc_council`, `loc_state`) VALUES
(1, 'Bukit Beruang', 'MPHTJ', 'Melaka'),
(2, 'Batu Berendam', 'MPHTJ', 'Melaka'),
(3, 'Melaka Raya', 'MBMB', 'Melaka'),
(4, 'Kota Laksamana', 'MBMB', 'Melaka'),
(5, 'Bukit Baru', 'MPHTJ', 'Melaka');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_user_id` varchar(255) NOT NULL,
  `trans_active` varchar(255) NOT NULL,
  `trans_start` date NOT NULL,
  `trans_starttime` char(5) DEFAULT NULL,
  `trans_end` date DEFAULT NULL,
  `trans_endtime` char(5) DEFAULT NULL,
  `trans_loc_id` int(11) NOT NULL,
  `trans_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_user_id`, `trans_active`, `trans_start`, `trans_starttime`, `trans_end`, `trans_endtime`, `trans_loc_id`, `trans_amount`) VALUES
(2, '1', '0', '2018-09-19', '18:42', '2018-09-19', '22:14', 5, '2.40'),
(3, '3', '0', '2018-09-22', '21:40', '2018-09-22', '21:40', 5, '0.40'),
(4, '3', '0', '2018-09-22', '21:52', '2018-09-22', '21:52', 4, '0.40'),
(5, '3', '0', '2018-09-22', '22:22', '2018-09-22', '22:22', 3, '0.40'),
(6, '3', '0', '2018-09-22', '22:32', '2018-09-22', '23:10', 2, '0.60'),
(7, '2', '0', '2018-09-14', '10:15', '2018-09-14', '11:15', 2, '0.60'),
(8, '3', '0', '2018-09-14', '13:15', '2018-09-14', '14:15', 3, '0.60'),
(9, '4', '0', '2018-09-14', '04:15', '2018-09-14', '06:15', 5, '1.20'),
(10, '5', '0', '2018-09-15', '01:15', '2018-09-15', '02:15', 4, '0.60'),
(12, '7', '0', '2018-09-16', '03:15', '2018-09-16', '06:15', 3, '1.80'),
(14, '9', '0', '2018-09-18', '07:30', '2018-09-18', '17:30', 5, '6.00'),
(15, '10', '0', '2018-09-18', '07:30', '2018-09-18', '18:30', 4, '6.60'),
(16, '12', '0', '2018-09-20', '12:50', '2018-09-20', '18:50', 1, '3.60'),
(17, '13', '0', '2018-09-21', '11:50', '2018-09-21', '6:50', 1, '4.20'),
(18, '13', '0', '2018-09-21', '11:50', '2018-09-21', '18:50', 1, '4.20'),
(19, '3', '0', '2018-09-23', '17:03', '2018-09-23', '17:03', 3, '0.40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_balance` decimal(6,2) NOT NULL,
  `car_plate_number` varchar(10) DEFAULT NULL,
  `user_top_up` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_email`, `user_password`, `user_name`, `user_balance`, `car_plate_number`, `user_top_up`) VALUES
(1, 'zoro@gmail.com', '43fa69104a02c07a050d65a6b92eb32f', 'tt', '93.20', 'gg6650', NULL),
(2, 'jacksim@gmail.com', '43fa69104a02c07a050d65a6b92eb32f', 'Jack Sim', '0.00', 'MDB 5500', NULL),
(3, 'micheal@example.com', '43fa69104a02c07a050d65a6b92eb32f', 'Michael', '48.60', 'V 6683', '50.00'),
(4, 'invoker@dota2.com', '43fa69104a02c07a050d65a6b92eb32f', 'AkuMidBobo', '0.00', 'DD 520', NULL),
(5, 'mirana@dota2.com', '43fa69104a02c07a050d65a6b92eb32f', 'Mirana', '0.00', 'MMB 4492', NULL),
(6, 'meepo@dota2.com', '43fa69104a02c07a050d65a6b92eb32f', 'Meepo', '0.00', 'GG 8899', NULL),
(7, 'ironman@marvel.com', '43fa69104a02c07a050d65a6b92eb32f', 'Tony Stark', '100.00', 'TEX 2233', NULL),
(8, 'drstrange@marvel.com', '43fa69104a02c07a050d65a6b92eb32f', 'Dr Strange', '0.00', 'DS 6666', NULL),
(9, 'sherlockHolmes@sh.com', '43fa69104a02c07a050d65a6b92eb32f', 'Sherlock Holmes', '0.00', 'SH 8321', NULL),
(10, 'naruto@7th.com', '43fa69104a02c07a050d65a6b92eb32f', 'Naruto', '0.00', 'NAR 7878', NULL),
(11, 'yichigo@bleach.com', '43fa69104a02c07a050d65a6b92eb32f', 'Yichigo', '0.00', 'YIC 8787', NULL),
(12, 'deku@hero.com', '43fa69104a02c07a050d65a6b92eb32f', 'Deku', '0.00', 'AMT 4432', NULL),
(13, 'luffy@onepiece.com', '43fa69104a02c07a050d65a6b92eb32f', 'Monkey D Luffy', '0.00', 'ONE 0001', NULL),
(14, 'sanji@onepiece.com', '43fa69104a02c07a050d65a6b92eb32f', 'Sanji', '0.00', 'ONE 0002', NULL),
(15, 'james@007.com', '43fa69104a02c07a050d65a6b92eb32f', 'James Bond', '0.00', 'BON 007', NULL),
(16, 'amy@99.com', '43fa69104a02c07a050d65a6b92eb32f', 'Amy', '0.00', 'AMY 9478', NULL),
(17, 'jackma@alibaba.com', '43fa69104a02c07a050d65a6b92eb32f', 'Jack Ma', '0.00', 'JAC 1688', NULL),
(18, 'billgates@microsoft.com', '43fa69104a02c07a050d65a6b92eb32f', 'Bill Gates', '0.00', 'WIN 10', NULL),
(19, 'mark@fb.com', '43fa69104a02c07a050d65a6b92eb32f', 'Mark Zuckerberg', '0.00', 'FB 2018', NULL),
(20, 'lbj@nba.com', '43fa69104a02c07a050d65a6b92eb32f', 'Leborn James', '0.00', 'NBA 1029', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`trans_loc_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `trans_loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
