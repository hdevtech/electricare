-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3310
-- Generation Time: Oct 08, 2022 at 09:41 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hdev_yego`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `a_name` text NOT NULL,
  `a_nid` text NOT NULL,
  `a_tell` text NOT NULL,
  `a_email` text NOT NULL,
  `a_role` varchar(10) NOT NULL DEFAULT 'main_admin',
  `a_password` text NOT NULL,
  `a_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `a_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `loc_id`, `a_name`, `a_nid`, `a_tell`, `a_email`, `a_role`, `a_password`, `a_reg_date`, `a_status`) VALUES
(6, 0, 'IZERE HIRWA Roger', '1234567890123456', '0788788291', 'admin@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', '2022-09-14 12:34:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appoitments`
--

CREATE TABLE `appoitments` (
  `ap_id` int(11) NOT NULL,
  `ap_problem` text NOT NULL,
  `ap_tell` text NOT NULL,
  `ap_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ap_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `auth_engine`
-- (See below for the actual view)
--
CREATE TABLE `auth_engine` (
`a_id` int(11)
,`a_username` text
,`a_email` text
,`a_password` text
,`a_role` varchar(10)
,`a_status` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `d_id` int(11) NOT NULL,
  `d_vehicle` text NOT NULL,
  `d_name` text NOT NULL,
  `d_nid` text NOT NULL,
  `d_tell` text NOT NULL,
  `d_permit` text NOT NULL,
  `d_plate` text NOT NULL,
  `d_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `d_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `o_id` int(11) NOT NULL,
  `o_name` text NOT NULL,
  `o_tin` text NOT NULL,
  `o_tell` text NOT NULL,
  `o_auth` text NOT NULL,
  `o_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `o_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `auth_engine`
--
DROP TABLE IF EXISTS `auth_engine`;

CREATE VIEW `auth_engine`  AS SELECT `admin`.`a_id` AS `a_id`, `admin`.`a_email` AS `a_username`, `admin`.`a_email` AS `a_email`, `admin`.`a_password` AS `a_password`, `admin`.`a_role` AS `a_role`, `admin`.`a_status` AS `a_status` FROM `admin`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `appoitments`
--
ALTER TABLE `appoitments`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appoitments`
--
ALTER TABLE `appoitments`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
