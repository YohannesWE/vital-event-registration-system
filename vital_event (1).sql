-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `Payment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth_table`
--

INSERT INTO `birth_table` (`b_id`, `username`, `email`, `f_name`, `m_name`, `l_name`, `Mother_fname`, `Mother_mname`, `Mother_lname`, `father_fname`, `father_mname`, `father_lname`, `sex`, `Birthdate`, `Nationality`, `Registration_date`, `Birth_Region`, `Birth_Zone`, `Birth_kebele`, `Birth_Country`, `Birth_werda`, `Birth_paper`, `Birth_status`, `Payment`) VALUES
(2, 'kal', 'anatnael11@gmail.com', 'sss', 'sasa', 'sadass', 'dsafasf', 'safdsaf', 'asfsaf', 'afsdsf', 'fsafsafd', 'fasdsaf', 'sad', 'sadsa', 'Italy', 'asdas', '', '', 'dsasdsa', '', '', 'birth_paper/sala.pdf', 'approved', 'paid'),
(9, 'salamessi', 'selehadinhassen8@gmail.com', 'selehadin', 'hassen', 'kedir', 'misera', 'muziyen', 'shura', 'hassen', 'kedir', 'duno', 'Male', '1/20/12', 'Afghanistan', '2024-03-24', 'Oromia', 'North shewa', 'Ganda chefee', '', '', 'birth_paper/mengimite.pdf', 'pending', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `c_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `comment_date` varchar(25) NOT NULL,
  `comment_message` varchar(400) NOT NULL,
  `c_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`c_id`, `username`, `comment_date`, `comment_message`, `c_status`) VALUES
(1, 'salamessiii', '2024-02-12', 'gedfrygtert', 'Pending');

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
  `Death_age` int(11) NOT NULL,
  `death_Region` varchar(110) NOT NULL,
  `death_Zone` varchar(110) NOT NULL,
  `Death_kebele` varchar(40) NOT NULL,
  `Marriage_status` varchar(40) NOT NULL,
  `child_number` int(11) NOT NULL,
  `Death_reason` varchar(40) NOT NULL,
  `Death_paper` varchar(80) NOT NULL,
  `Death_states` varchar(50) NOT NULL,
  `Payemnt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `death_table`
--

INSERT INTO `death_table` (`d_id`, `k_id_no`, `view_code`, `email`, `f_name`, `m_name`, `l_name`, `Sex`, `Nationality`, `Death_date`, `Death_age`, `death_Region`, `death_Zone`, `Death_kebele`, `Marriage_status`, `child_number`, `Death_reason`, `Death_paper`, `Death_states`, `Payemnt`) VALUES
(1, '12', '', '', 'sss', 'sasa', 'sadass', 'Female', 'saDFdsf', '2024-02-06', 34, '0', '0', 'fdgfdg', 'Married', 23, 'dsfsafsa', 'death_paper/l.pdf', 'pending', 'paid'),
(7, 'kal', '', '', 'rfdg', 'gtrfds', 'rgfdsv', 'Male', 'trsd', '2024-02-05', 5, '0', '0', 'dsf', 'Single', 54, 'fdgdftr', 'death_paper/l.pdf', 'approved', 'paid'),
(8, '1', '43', 'selehadinhassen8@gmail.com', 'SELEHADIN', 'hassen', 'kedir', 'Male', 'ethiopia', '2024-02-10', 0, '0', '0', '', 'fdssdf', 0, '', 'death_paper/', 'approved', 'unpaid'),
(9, '54', '11', '', 'sads', 'gfdgfd', 'dfs', 'Female', 'saDFdsf', '2024-02-10', 0, '0', '0', '', '', 0, 'ewqrwear', 'death_paper/', 'pending', 'unpaid'),
(10, '56', '56', 'anatnael11@gmail.com', 'abel', 'kebede', 'mamo', 'Male', 'Ethiopia', '2024-03-15', 34, '0', '0', 'ganda chefee', 'unmarraige', 2, 'accident', 'death_paper/ajol-file-journals_482_articles_202834_submission_proof_202834-5689-', 'approved', 'unpaid'),
(11, '22', '22', '', 'sala', 'sala', 'sala', 'Female', 'kenya', '2024-03-19', 22, '0', '0', 'rr', 'merride', 22, '22', 'death_paper/final  doc research word123new commmm edited.pdf', 'pending', 'unpaid'),
(15, '433', '343', 'tarikutakkudubbee@gmail.com', 'sala', 'sala', 'sala', 'Female', 'kenya', '2024-03-14', 22, '0', '0', 'rr', 'merride', 22, 'dhasuidhfwd', 'death_paper/final  doc research word123new comm123.pdf', 'pending', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `divorce_table`
--

CREATE TABLE `divorce_table` (
  `di_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Hasband_fname` varchar(25) NOT NULL,
  `Hasband_mname` varchar(25) NOT NULL,
  `Hasband_lname` varchar(50) NOT NULL,
  `wife_fname` varchar(15) NOT NULL,
  `wife_mname` varchar(25) NOT NULL,
  `wife_lname` varchar(50) NOT NULL,
  `Husband_Natinality` varchar(50) NOT NULL,
  `wife_Natinality` varchar(50) NOT NULL,
  `Divorce_date` varchar(50) NOT NULL,
  `Divorce_Region` varchar(50) NOT NULL,
  `Divorce_country` varchar(50) NOT NULL,
  `Divorce_woreda` varchar(50) NOT NULL,
  `Divorce_Zone` varchar(50) NOT NULL,
  `Divorce_kebele` varchar(80) NOT NULL,
  `Number_of_child` varchar(50) NOT NULL,
  `Divorce_reason` varchar(400) NOT NULL,
  `Divorce_paper` varchar(50) NOT NULL,
  `Divorce_states` varchar(50) NOT NULL,
  `Payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divorce_table`
--

INSERT INTO `divorce_table` (`di_id`, `username`, `email`, `Hasband_fname`, `Hasband_mname`, `Hasband_lname`, `wife_fname`, `wife_mname`, `wife_lname`, `Husband_Natinality`, `wife_Natinality`, `Divorce_date`, `Divorce_Region`, `Divorce_country`, `Divorce_woreda`, `Divorce_Zone`, `Divorce_kebele`, `Number_of_child`, `Divorce_reason`, `Divorce_paper`, `Divorce_states`, `Payment`) VALUES
(3, 'kal', 'tadegetube@gmail.com', 'dsfdsf', 'gsfdgfsaf', 'sdzfaqe', 'dsfsf', 'fsadfsa', 'fsfdwqa', '', '', '', '', '', '', '', 'wafdrawe', '32', 'dsfsgesag', 'divorce_paper/Birth-Certificate (2).pdf', 'approved', 'paid'),
(7, 'salamessi', 'selehadinhassen8@gmail.com', 'selehadin', 'hassen', 'kedir', 'abebch', 'kebde', 'mamo', 'ethipia', 'ethipia', '1/12/14', 'Oromia', '', '', 'North shewa', 'Ganda chefee', '12', 'ghygfty', 'divorce_paper/8. OPERATING SYSTEMS.pdf', 'approved', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `f_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `feedback_date` varchar(25) NOT NULL,
  `feedback_message` varchar(400) NOT NULL,
  `f_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`f_id`, `username`, `feedback_date`, `feedback_message`, `f_status`) VALUES
(17, 'salamessi', '2024-02-12', 'dsgfdhgdh', 'Viewed'),
(18, 'salamessi', '2024-02-12', 'dsgfdhgdh', 'Viewed'),
(19, 'salamessi', '2024-02-12', 'gstewrt', 'Viewed'),
(20, 'salamessi', '2024-02-12', 'ghjfygjfy', 'Viewed'),
(21, 'salamessi', '2024-02-12', 'frdygtreghfdrh', 'Viewed'),
(22, 'salamessi', '2024-02-12', 'mesrat alebt', 'Viewed'),
(23, 'kal', '2024-02-12', 'twetewrt', 'Viewed'),
(24, 'kal', '2024-02-13', 'fgdsf', 'Viewed'),
(25, 'salamessi', '2024-03-19', 'dsjkadbsajkdbqska', 'Viewed'),
(26, 'kal', '2024-03-23', 'gfsgr', 'Viewed'),
(27, 'kal', '2024-03-23', 'wefew', 'Viewed'),
(28, 'salamessi', '2024-03-24', 'sdfs', 'Viewed');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_table`
--

CREATE TABLE `marriage_table` (
  `m_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Hasband_fname` varchar(25) NOT NULL,
  `Hasband_mname` varchar(25) NOT NULL,
  `Hasband_lname` varchar(50) NOT NULL,
  `Wife_fname` varchar(15) NOT NULL,
  `Wife_mname` varchar(25) NOT NULL,
  `Wife_lname` varchar(60) NOT NULL,
  `Hasband_age` varchar(80) NOT NULL,
  `wife_age` varchar(50) NOT NULL,
  `Hasband_natinality` varchar(25) NOT NULL,
  `wife_natinality` varchar(25) NOT NULL,
  `marriage_Region` varchar(25) NOT NULL,
  `marriage_Zone` varchar(25) NOT NULL,
  `marriage_kebele` varchar(60) NOT NULL,
  `Marrage_date` varchar(60) NOT NULL,
  `Marrage_condition` varchar(60) NOT NULL,
  `Marriage_country` varchar(60) NOT NULL,
  `Marriage_woreda` varchar(60) NOT NULL,
  `F_w_witness_name` varchar(60) NOT NULL,
  `S_w_witness_name` varchar(60) NOT NULL,
  `Marriage_paper` varchar(60) NOT NULL,
  `Marriage_status` varchar(60) NOT NULL,
  `Payemnt` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_table`
--

INSERT INTO `marriage_table` (`m_id`, `username`, `email`, `Hasband_fname`, `Hasband_mname`, `Hasband_lname`, `Wife_fname`, `Wife_mname`, `Wife_lname`, `Hasband_age`, `wife_age`, `Hasband_natinality`, `wife_natinality`, `marriage_Region`, `marriage_Zone`, `marriage_kebele`, `Marrage_date`, `Marrage_condition`, `Marriage_country`, `Marriage_woreda`, `F_w_witness_name`, `S_w_witness_name`, `Marriage_paper`, `Marriage_status`, `Payemnt`) VALUES
(4, 'salamessi', 'selehadinhassen8@gmail.com', 'dsfds', 'drfsters', 'trewtew', 'trewt', 'trewtwe', 'trtew', 'trewt', 'trewt', '0', '0', '0', '0', 'rewt', 'gert', 'rewty', 'ywreyt', 'trewt', 'retw', 'trewtw', 'marriage_paper/', 'approved', 'paid'),
(6, 'kal', 'ghdjfd@gmail', 'kalab', 'haile', 'tesafye', 'abebch', 'kebde', 'mamo', '25', '25', 'ethipia', 'ethipia', ' Oromia', 'North shewa', 'Ganda chefee', '2/5/2024', 'Afghanistan', 'hus1', 'wif1', 'has2', 'wif2', 'marriage_paper/', 'approved', 'paid');

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
  `Payemnt_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payemnt`
--

INSERT INTO `payemnt` (`p_id`, `username`, `k_id_no`, `event_type`, `payemnt_date`, `Payemnt_link`) VALUES
(5, 'salamessi', '', 'merrage', '2024-02-27', 'gdsds'),
(6, 'ertewt', '', 'divorce', '2024-02-29', 'fewt'),
(14, 'salamessi', '', 'merrage', '2024-03-24', 'http://localhost/php-password-reset-main/send_payemnt_birth.php'),
(15, 'salamessi', '', 'birth', '2024-03-24', 'http://localhost/php-password-reset-main/send_payemnt_birth.php'),
(16, 'unknown', '1', 'death', '2024-03-26', 'http://localhost/php-password-reset-main/send_payemnt_death.php');

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
  `password` varchar(20) NOT NULL,
  `k_id_no` varchar(50) DEFAULT 'none',
  `k_id` varchar(80) DEFAULT NULL,
  `states` varchar(50) NOT NULL DEFAULT 'pending',
  `death_status` varchar(50) NOT NULL,
  `upgrade_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `middle_name`, `last_name`, `username`, `email`, `usertype`, `phone`, `religion`, `password`, `k_id_no`, `k_id`, `states`, `death_status`, `upgrade_status`) VALUES
(1, 'selehadin hassen', '', '', 'salamessi', 'selehadinhassen8@gmail.com', 'applicant', '0902460062', '', '1234', 'none', 'ahrfjdkghslkvniufdshgdlsakfjnjghvf', 'approved', '', '0'),
(2, 'selehadin hassen', '', '', 'salamessii', 'selehadinhassen8@gmail.com', 'manager', '0902460062', '', 'sala', 'none', 'ahrfjdkghslkvniufdshgdlsakfjnjghvf', 'approved', '', '0'),
(3, 'selehadin hassen', '', '', 'salamessiii', 'selehadinhassen8@gmail.com', 'Civil_registrar', '0902460062', '', 'sala123', 'none', 'ahrfjdkghslkvniufdshgdlsakfjnjghvf', 'approved', '', '0'),
(4, 'selehadin hassen', '', '', 'salamessiiii', 'selehadinhassen8@gmail.com', 'admin', '0902460062', '', 'sala123', 'none', 'ahrfjdkghslkvniufdshgdlsakfjnjghvf', 'approved', '', '0'),
(33, 'eyob', '', '', 'eyob', 'selehadinhassen8@gmail.com', 'applicant', '43543532543', 'christianity', '1234', '04231862', 'image/ajol-file-journals_482_articles_202834_submission_proof_202834-5689-507622', 'approved', 'undeath', '0'),
(37, 'ewtwt', '', '', 'ertewt', 'gezeamanuel32@gmail.com', 'applicant', '35325543345', 'christianity', '4354', '4354', 'image/Birth-Certificate (1).pdf', 'approved', 'undeath', '0'),
(38, 'kal', '', '', 'kal', 'ghdjfd@gmail', 'applicant', '543243', 'islam', '1234', '6546', 'image/death_certificate_ (4).pdf', 'approved', 'undeath', '0'),
(47, 'kebde', 'mola', 'maru', 'm123', 'selehadinhassen8@gmail.com', 'applicant', '45235345435', 'hinduism', '12345', '123', 'image/Drinking-water-quality-ethiopia-ESS-2016.pdf', 'pending', 'undeath', '0'),
(51, 'sala', '', '', 'ss', 'none', 'child', 'none', 'muslim', '1234', 'none', 'child/tcolledge,+Journal+manager,+Water_Purification.pdf', 'approved', 'undeath', 'not_upgrade'),
(52, 'sala', 'hassen', 'kedir', 'salaa', 'sala@gmail.com', 'Civil_registrar', '2324324', '', '1234', 'none', '', 'approved', 'undeath', '');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`di_id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birth_table`
--
ALTER TABLE `birth_table`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `death_table`
--
ALTER TABLE `death_table`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `divorce_table`
--
ALTER TABLE `divorce_table`
  MODIFY `di_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `marriage_table`
--
ALTER TABLE `marriage_table`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payemnt`
--
ALTER TABLE `payemnt`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
