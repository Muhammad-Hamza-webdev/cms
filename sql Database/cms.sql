-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 07:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_us_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `department_id` smallint(3) NOT NULL,
  `user_type` smallint(3) NOT NULL COMMENT '1=user 2=admin 3=manageer',
  `status` smallint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `person_id`, `password`, `department_id`, `user_type`, `status`) VALUES
(1, 1, 'admin123', 1, 2, 1),
(2, 2, '91d428aa', 1, 1, 1),
(3, 3, 'qwerty123', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `department_id` smallint(3) NOT NULL,
  `category_id` mediumint(6) NOT NULL,
  `description` varchar(50000) NOT NULL,
  `date` date DEFAULT NULL,
  `com_status` smallint(3) NOT NULL DEFAULT 1 COMMENT '1=pending 2=Inprocess 3=completed',
  `feedback_status` tinyint(1) DEFAULT 0 COMMENT '1=given 0=panding'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complain_category`
--

CREATE TABLE `complain_category` (
  `category_id` mediumint(6) NOT NULL,
  `category` varchar(70) NOT NULL,
  `compl_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complain_category`
--

INSERT INTO `complain_category` (`category_id`, `category`, `compl_status`) VALUES
(1, 'Fee Complain', 1),
(2, 'Teacher Complain', 1),
(3, 'Student Disputss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complain_response`
--

CREATE TABLE `complain_response` (
  `response_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `description` varchar(1999) NOT NULL,
  `file` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_us_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `message` varchar(50000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` smallint(3) NOT NULL,
  `department` varchar(50) NOT NULL,
  `dept_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department`, `dept_status`) VALUES
(1, 'Computer Scrience', 1),
(2, 'Chemistry', 1),
(3, 'Physics', 1),
(4, 'Phycology', 1),
(5, 'Maths', 1);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `person_email` varchar(80) NOT NULL,
  `address` varchar(150) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `person_name`, `last_name`, `father_name`, `person_email`, `address`, `gender`, `phone`) VALUES
(1, 'M', 'Hamza', 'Iftikhar', 'admin@admin.com', 'Chack 86/6r', '1', '03000000000'),
(2, 'M Hamza', 'Ifitkhar', 'Iftikhar Ali', 'hamza@gmail.com', 'chack86/6r', '1', '03000000000'),
(3, 'Tahir', 'iqbal', 'Muhammad Iqbal', 'tahir@gmail.com', 'Shadman town 86/6r', '1', '03000000000');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review_user_complaint_link`
--

CREATE TABLE `review_user_complaint_link` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` smallint(3) NOT NULL,
  `service_tittle` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pict` varchar(1500) NOT NULL,
  `ser_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_complaint_link`
--

CREATE TABLE `user_complaint_link` (
  `link_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_us_id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `complain_category`
--
ALTER TABLE `complain_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `complain_response`
--
ALTER TABLE `complain_response`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `review_user_complaint_link`
--
ALTER TABLE `review_user_complaint_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`,`complaint_id`,`review_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user_complaint_link`
--
ALTER TABLE `user_complaint_link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `person_id` (`person_id`,`complaint_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_us_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complain_category`
--
ALTER TABLE `complain_category`
  MODIFY `category_id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complain_response`
--
ALTER TABLE `complain_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_user_complaint_link`
--
ALTER TABLE `review_user_complaint_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_complaint_link`
--
ALTER TABLE `user_complaint_link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
