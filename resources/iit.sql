-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2016 at 05:08 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iit`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_condition` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `full_name` varchar(30) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `item_name`, `item_condition`, `description`, `price`, `category`, `contact_info`, `full_name`, `username`, `date_added`) VALUES
(11, 'Space Jam', 'Brand New', 'Come on and slam, and welcome to the jam\r\nCome on and slam, if you wanna jam', 30, 'Other', 'gb me', 'Igy F', 'grossi2', '2016-12-05 12:30:39'),
(14, 'TI-84+', 'Very Good', 'Fresh from the thrift shop, down the road', 239.45, 'Electronics', 'instatweet-a-tumbler-gram me at iggyG', 'Meaty', 'grossi2', '2016-12-06 00:10:52'),
(18, 'Information Systems: A Manager''s Guide to Harnessing Technology, v. 1.4', 'Very Good', 'Used in Managing IT Resources for Fall 2016. Hard Cover Version', 65.45, 'Textbook', 'Phone Number: XXX-XXX-XXXX', 'Ian Gross', 'grossi2', '2016-12-06 00:34:12'),
(19, 'Fundamentals of Physics, 9th Edition', 'Like New', 'Barely Used, bought a semester ago', 75, 'Textbook', 'Tweet at me @rpi_yamato', 'Meatwad', 'senior', '2016-12-07 15:59:06'),
(20, 'Principles of Modern Operating Systems, 2nd ed.', 'Acceptable', 'Used in Operating Systems. Passed down from two other people so it has a bit of wear and tear.', 25, 'Textbook', 'Message me on Facebook. Username: Mad Dog', 'Luchadoor', 'senior', '2016-12-07 20:02:20'),
(21, 'Nachos', 'Brand New', 'I just bought them and I do not want them anymore', 2.4, 'Other', 'I am in Mcneil right now', 'Ian', 'seniorsenior', '2016-12-07 23:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('GeorgeLopez@rpi.edu', 'taco'),
('grossi2', 'student'),
('laptophi', 'hello'),
('robotguy', '123'),
('senior', 'taco'),
('seniorsenior', 'senior'),
('ss', 'ss'),
('user', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`,`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
