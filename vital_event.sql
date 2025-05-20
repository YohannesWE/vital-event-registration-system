-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 07:23 PM
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
-- Database: `vital_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `A_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `k_id_no` varchar(25) NOT NULL,
  `appointment_date` varchar(15) NOT NULL,
  `event_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birth_table`
--

CREATE TABLE `birth_table` (
  `b_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(400) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `Mother_fname` varchar(50) NOT NULL,
  `Mother_mname` varchar(20) NOT NULL,
  `Mother_lname` varchar(25) NOT NULL,
  `father_fname` varchar(25) NOT NULL,
  `father_mname` varchar(50) NOT NULL,
  `father_lname` varchar(15) NOT NULL,
  `mother_natinality` varchar(25) NOT NULL,
  `father_natinality` varchar(25) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `Birthdate` varchar(50) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `Registration_date` varchar(50) NOT NULL,
  `Birth_Region` varchar(50) NOT NULL,
  `Birth_Zone` varchar(50) NOT NULL,
  `Birth_kebele` varchar(50) NOT NULL,
  `Birth_Country` varchar(50) NOT NULL,
  `Birth_werda` varchar(50) NOT NULL,
  `Birth_paper` varchar(100) NOT NULL,
  `Birth_status` varchar(20) NOT NULL,
  `Payment` varchar(20) NOT NULL,
  `civil_registarar_fname` varchar(50) NOT NULL,
  `civil_registarar_mname` varchar(25) NOT NULL,
  `civil_registarar_lname` varchar(20) NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `c_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `comment_date` varchar(25) NOT NULL,
  `comment_message` varchar(400) NOT NULL,
  `c_status` varchar(15) NOT NULL,
  `replay` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `death_table`
--

CREATE TABLE `death_table` (
  `d_id` int(11) NOT NULL,
  `k_id_no` varchar(50) NOT NULL,
  `view_code` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(40) NOT NULL,
  `Sex` varchar(40) NOT NULL,
  `Nationality` varchar(40) NOT NULL,
  `Death_date` varchar(40) NOT NULL,
  `registration_date` varchar(200) NOT NULL,
  `Birth_date` varchar(20) NOT NULL,
  `death_country` varchar(50) NOT NULL,
  `death_woreda` varchar(50) NOT NULL,
  `death_Region` varchar(110) NOT NULL,
  `death_Zone` varchar(110) NOT NULL,
  `Death_kebele` varchar(40) NOT NULL,
  `Marriage_status` varchar(40) NOT NULL,
  `child_number` int(11) NOT NULL,
  `r_fname` varchar(50) NOT NULL,
  `r_mname` varchar(50) NOT NULL,
  `Relationship_type` varchar(50) NOT NULL,
  `Death_place` varchar(40) NOT NULL,
  `Death_paper` varchar(80) NOT NULL,
  `Death_states` varchar(50) NOT NULL,
  `Payemnt` varchar(50) NOT NULL,
  `civil_registarar_fname` varchar(50) NOT NULL,
  `civil_registarar_mname` varchar(50) NOT NULL,
  `civil_registarar_lname` varchar(50) NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divorce_table`
--

CREATE TABLE `divorce_table` (
  `di_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Registration_date` varchar(15) NOT NULL,
  `Hasband_fname` varchar(25) NOT NULL,
  `Hasband_mname` varchar(25) NOT NULL,
  `Hasband_lname` varchar(50) NOT NULL,
  `wife_fname` varchar(15) NOT NULL,
  `wife_mname` varchar(25) NOT NULL,
  `wife_lname` varchar(50) NOT NULL,
  `Husband_Natinality` varchar(50) NOT NULL,
  `wife_Natinality` varchar(50) NOT NULL,
  `wife_birth_place` varchar(50) NOT NULL,
  `hasband_birth_date` varchar(50) NOT NULL,
  `wife_birth_date` varchar(50) NOT NULL,
  `husband_birth_place` varchar(50) NOT NULL,
  `Divorce_date` varchar(50) NOT NULL,
  `Divorce_Region` varchar(50) NOT NULL,
  `Divorce_country` varchar(50) NOT NULL,
  `Divorce_woreda` varchar(50) NOT NULL,
  `Divorce_Zone` varchar(50) NOT NULL,
  `Divorce_kebele` varchar(80) NOT NULL,
  `Number_of_child` varchar(50) NOT NULL,
  `Divorce_paper` varchar(50) NOT NULL,
  `Divorce_states` varchar(50) NOT NULL,
  `Payment` varchar(50) NOT NULL,
  `civil_registarar_fname` varchar(50) NOT NULL,
  `civil_registarar_mname` varchar(50) NOT NULL,
  `civil_registarar_lname` varchar(50) NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `f_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `feedback_date` varchar(25) NOT NULL,
  `feedback_message` varchar(400) NOT NULL,
  `f_status` varchar(15) NOT NULL,
  `replay` varchar(500) NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marriage_table`
--

CREATE TABLE `marriage_table` (
  `m_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Registration_date` varchar(15) NOT NULL,
  `Hasband_fname` varchar(25) NOT NULL,
  `Hasband_mname` varchar(25) NOT NULL,
  `Hasband_lname` varchar(50) NOT NULL,
  `Wife_fname` varchar(15) NOT NULL,
  `Wife_mname` varchar(25) NOT NULL,
  `Wife_lname` varchar(60) NOT NULL,
  `Hasband_natinality` varchar(25) NOT NULL,
  `wife_natinality` varchar(25) NOT NULL,
  `husband_birth_place` varchar(15) NOT NULL,
  `wife_birth_place` varchar(15) NOT NULL,
  `hasband_birth_date` varchar(15) NOT NULL,
  `wife_birth_date` varchar(15) NOT NULL,
  `marriage_Region` varchar(25) NOT NULL,
  `marriage_Zone` varchar(25) NOT NULL,
  `marriage_kebele` varchar(60) NOT NULL,
  `Marrage_date` varchar(60) NOT NULL,
  `Marrage_condition` varchar(60) NOT NULL,
  `Marriage_country` varchar(60) NOT NULL,
  `Marriage_woreda` varchar(60) NOT NULL,
  `Marriage_paper` varchar(60) NOT NULL,
  `Marriage_status` varchar(60) NOT NULL,
  `Payemnt` varchar(60) NOT NULL,
  `divorced_status` varchar(20) NOT NULL,
  `civil_registarar_fname` varchar(50) NOT NULL,
  `civil_registarar_mname` varchar(50) NOT NULL,
  `civil_registarar_lname` varchar(50) NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payemnt`
--

CREATE TABLE `payemnt` (
  `p_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `k_id_no` varchar(250) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `payemnt_date` varchar(15) NOT NULL,
  `Payemnt_link` varchar(500) NOT NULL,
  `status` text NOT NULL,
  `c_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `pi_id` int(11) NOT NULL,
  `event_type` varchar(15) NOT NULL,
  `amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT 'none',
  `usertype` varchar(15) NOT NULL,
  `phone` varchar(25) NOT NULL DEFAULT 'none',
  `religion` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `k_id_no` varchar(50) DEFAULT 'none',
  `k_id` varchar(80) DEFAULT NULL,
  `states` varchar(50) NOT NULL DEFAULT 'pending',
  `death_status` varchar(50) NOT NULL DEFAULT 'undeath',
  `upgrade_status` varchar(20) NOT NULL,
  `c_status` varchar(50) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `middle_name`, `last_name`, `username`, `email`, `usertype`, `phone`, `religion`, `sex`, `password`, `k_id_no`, `k_id`, `states`, `death_status`, `upgrade_status`, `c_status`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(75, 'Abebe Kebede', 'Abe', 'lema', 'user', 'abebekebede1@gmail.com', 'Civil_registrar', '+251902460062', 'none', 'male', '123', 'none', '-', 'approved', 'undeath', 'upgrade', '', NULL, NULL),
(78, 'Meheretu Dejene', 'Dejene', 'Moti', 'admin', 'meheretudej33@gmail.com ', 'admin', '+251902460062', 'religion', 'male', '456', 'image/outline.pdf', 'child/Introduction GIS.docx (1).pdf', 'approved', 'undeath', 'upgrade', '', NULL, NULL),
(82, 'Taye Girma', 'Girma', 'Girmachew', 'taye', 'tayegirma23@gmail.com', 'manager', '', '', '', '321', 'none', NULL, 'approved', 'undeath', 'upgrade', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `birth_table`
--
ALTER TABLE `birth_table`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `death_table`
--
ALTER TABLE `death_table`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `divorce_table`
--
ALTER TABLE `divorce_table`
  ADD PRIMARY KEY (`di_id`),
  ADD UNIQUE KEY `di_id` (`di_id`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `marriage_table`
--
ALTER TABLE `marriage_table`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `payemnt`
--
ALTER TABLE `payemnt`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `birth_table`
--
ALTER TABLE `birth_table`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `death_table`
--
ALTER TABLE `death_table`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `divorce_table`
--
ALTER TABLE `divorce_table`
  MODIFY `di_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `marriage_table`
--
ALTER TABLE `marriage_table`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payemnt`
--
ALTER TABLE `payemnt`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
