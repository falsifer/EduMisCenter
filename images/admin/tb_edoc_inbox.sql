-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 01:43 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_edoc_inbox`
--

CREATE TABLE `tb_edoc_inbox` (
  `id` int(11) NOT NULL,
  `inbox_date` date DEFAULT NULL,
  `inbox_recieve_no` varchar(45) DEFAULT NULL,
  `inbox_from` varchar(150) DEFAULT NULL,
  `inbox_no` varchar(45) DEFAULT NULL,
  `inbox_topic` varchar(255) DEFAULT NULL,
  `inbox_attach` varchar(150) DEFAULT NULL,
  `inbox_detail` varchar(255) DEFAULT NULL,
  `inbox_file` varchar(150) DEFAULT NULL,
  `inbox_owner` varchar(150) DEFAULT NULL,
  `inbox_department` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_edoc_inbox`
--
ALTER TABLE `tb_edoc_inbox`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_edoc_inbox`
--
ALTER TABLE `tb_edoc_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
