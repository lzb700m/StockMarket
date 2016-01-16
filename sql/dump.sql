-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 09, 2015 at 04:19 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cs6314_stock_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `t_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `stock_symbol` varchar(20) NOT NULL,
  `shares` int(11) NOT NULL,
  `t_price` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `t_time`, `user_id`, `stock_symbol`, `shares`, `t_price`, `balance`) VALUES
(1, '2015-12-08 19:38:47', 1, 'registration', 10000, '1.00', '10000.00'),
(2, '2015-12-08 19:40:07', 2, 'registration', 10000, '1.00', '10000.00'),
(3, '2015-12-08 19:40:33', 3, 'registration', 10000, '1.00', '10000.00'),
(4, '2015-12-08 19:41:38', 2, 'GOOG', -5, '761.25', '6193.75'),
(5, '2015-12-08 19:41:55', 2, 'AAPL', -10, '117.87', '5015.05'),
(6, '2015-12-08 19:42:15', 2, 'AAPL', 10, '117.82', '6193.25'),
(7, '2015-12-08 19:45:05', 2, 'GOOG', 5, '761.44', '10000.45'),
(8, '2015-12-09 02:56:02', 4, 'registration', 10000, '1.00', '10000.00'),
(9, '2015-12-09 02:57:33', 2, 'TSLA', -20, '226.72', '5466.05'),
(10, '2015-12-09 02:57:38', 2, 'YHOO', -100, '34.85', '1981.05'),
(11, '2015-12-09 02:57:46', 2, 'NFLX', -10, '126.98', '711.25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(64) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `isAdmin`, `firstName`, `lastName`) VALUES
(1, 'admin@stockmarket.cs6314', 'de8acc7bc30d43313839cb721111f091', 1, 'Admin', 'User'),
(2, 'pxl141030@utdallas.edu', 'dcecb46620ca64ccdeb772657e787ce0', 0, 'Peng', 'Li'),
(3, 'cxw132230@utdallas.edu', '088a935d946f0300b09e4f11e524628e', 0, 'Chen', 'Wang'),
(4, 'smith.john@gmail.com', '441a7010018ed354addc33ab18b4dea4', 0, 'John', 'Smith');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stock_symbol` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`id`, `user_id`, `stock_symbol`) VALUES
(1, 2, 'GOOG'),
(2, 2, 'AAPL'),
(3, 2, 'NFLX'),
(4, 2, 'YHOO'),
(5, 2, 'TSLA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
