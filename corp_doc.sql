-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 03:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corp_doc`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc_file`
--

CREATE TABLE `doc_file` (
  `df_id` int(11) NOT NULL,
  `df_file_name` varchar(100) DEFAULT NULL,
  `df_exp_date` date DEFAULT NULL,
  `df_month` varchar(20) DEFAULT NULL,
  `df_year` year(4) DEFAULT NULL,
  `di_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_file`
--

INSERT INTO `doc_file` (`df_id`, `df_file_name`, `df_exp_date`, `df_month`, `df_year`, `di_id`) VALUES
(5, 'doc_files/2/2019/February/2_February_2019.pdf', '2020-02-01', 'February', 2019, 2),
(8, 'doc_files/2/2018/February/2_February_2018.pdf', '2019-02-01', 'February', 2018, 2),
(9, 'doc_files/3/2018/April/3_April_2018.pdf', '2019-04-28', 'April', 2018, 3),
(10, 'doc_files/4/2017/April/4_April_2017.pdf', '2018-08-23', 'April', 2017, 4),
(11, 'doc_files/5/2017/October/5_October_2017.pdf', '2018-10-26', 'October', 2017, 5),
(12, 'doc_files/6/2017/May/6_May_2017.pdf', '2018-08-24', 'May', 2017, 6);

-- --------------------------------------------------------

--
-- Table structure for table `doc_info`
--

CREATE TABLE `doc_info` (
  `di_id` int(11) NOT NULL,
  `di_name` varchar(200) DEFAULT NULL,
  `di_dept` varchar(100) DEFAULT NULL,
  `di_exp_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_info`
--

INSERT INTO `doc_info` (`di_id`, `di_name`, `di_dept`, `di_exp_date`) VALUES
(2, 'KTA KADIN', 'CBD', '2020-02-01'),
(3, 'KTA APTEK', 'CBD', '2019-04-28'),
(4, 'kadaluarsa', 'CBD', '2018-08-23'),
(5, 'kungkingg', 'CBD', '2018-10-26'),
(6, 'dmaldms', 'CBD', '2018-08-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_file`
--
ALTER TABLE `doc_file`
  ADD PRIMARY KEY (`df_id`);

--
-- Indexes for table `doc_info`
--
ALTER TABLE `doc_info`
  ADD PRIMARY KEY (`di_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_file`
--
ALTER TABLE `doc_file`
  MODIFY `df_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doc_info`
--
ALTER TABLE `doc_info`
  MODIFY `di_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
