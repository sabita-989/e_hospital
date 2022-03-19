-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 07:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `birsewa`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin_db`
--

CREATE TABLE `adminlogin_db` (
  `a_login_id` int(60) NOT NULL,
  `a_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `a_email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `a_password` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `adminlogin_db`
--

INSERT INTO `adminlogin_db` (`a_login_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_db`
--

CREATE TABLE `appointment_db` (
  `appointment_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `p_address` varchar(255) NOT NULL,
  `inputdate` varchar(255) NOT NULL,
  `appointment_time` time NOT NULL,
  `hit_miss` float DEFAULT NULL,
  `a_status` varchar(50) NOT NULL,
  `r_login_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_db`
--

INSERT INTO `appointment_db` (`appointment_id`, `p_name`, `gender`, `problem`, `shift`, `age`, `phone`, `p_address`, `inputdate`, `appointment_time`, `hit_miss`, `a_status`, `r_login_id`, `doctor_id`) VALUES
(74, 'Kuchiki San', 'Female', 'Sharingan', '12:00pm - 12:35pm', '30', '9803691167', 'Ramu', 'Fri_2022-03-18', '08:44:59', 0.5, '1', 74, 52),
(75, 'Ikkaku san', 'Male', 'Bankai', '12:00pm - 12:35pm', '74', '9803691167', 'Karakura', 'Fri_2022-03-18', '08:46:07', 0.5, '0', 74, 52),
(79, 'Liebe', 'Male', 'Rnaaa', '12:00pm - 12:35pm', '56', '980369167', 'Nlia', 'Mon_2022-03-14', '09:50:41', 0.333333, '0', 74, 52),
(80, 'Nfyig', 'Male', 'OOsa kno', '4:40pm - 5:15pm', '47', '902775', 'Paeir', 'Mon_2022-03-14', '09:52:36', 1, '1', 74, 52),
(81, 'DAichi', 'Male', 'leg cramp', '10:15am - 11:15am', '23', '9803691167', 'A pa haia', 'Mon_2022-03-14', '10:07:20', 0.5, '1', 74, 65),
(82, 'Hinata', 'Male', 'Poa', '10:15am - 11:15am', '36', '9803691167', 'Oalaa ual', 'Mon_2022-03-14', '10:09:27', 0.5, '0', 74, 65),
(91, 'HEh', 'Male', 'Tmlhua a k', '12:35pm - 1:10pm', '22', '2366352780', 'HaeaniaAah', 'Mon_2022-03-14', '11:19:19', 1, '1', 74, 52),
(92, 'Th', 'Female', 'Khagtaneh', '4:40pm - 5:15pm', '21', '9803691167', 'L ohnagg p', 'Sun_2022-03-20', '11:25:55', 0.5, '1', 74, 52),
(93, 'Werla i', 'Female', 'Ksi b', '12:00pm - 12:35pm', '27', '3559503245', 'H', 'Mon_2022-03-14', '12:09:42', 0.333333, '1', 74, 52);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_db`
--

CREATE TABLE `doctor_db` (
  `doctor_id` int(60) NOT NULL,
  `d_name` text COLLATE utf8mb4_bin NOT NULL,
  `d_email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `d_password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `d_shift` time NOT NULL,
  `d_eshift` time NOT NULL,
  `d_interval` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `d_phone` bigint(11) NOT NULL,
  `nmc_no` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `doctor_db`
--

INSERT INTO `doctor_db` (`doctor_id`, `d_name`, `d_email`, `d_password`, `d_shift`, `d_eshift`, `d_interval`, `d_phone`, `nmc_no`, `speciality_id`) VALUES
(52, 'Ravin KumarS', 'ravin@gmail.com', '12345', '12:00:00', '17:15:00', '35', 983474799, 123, 1),
(54, 'Manish Gupta', 'manish@gmail.com', '12345', '14:15:00', '17:15:00', '45', 9889878889, 7889, 1),
(55, 'Rabindra Mishra', 'rabindra@gmail.com', '12345', '00:00:00', '00:00:00', '', 9842493464, 234, 5),
(56, 'Keshab Dhakal', 'keshab@gmail.com', '12345', '00:00:00', '00:00:00', '', 9842493464, 4554, 8),
(57, 'Mahendra Mishra', 'mahendra@gmail.com', '12345', '00:00:00', '00:00:00', '', 9883728789, 5657, 1),
(58, 'Ritu Sapkota', 'ritu@gmail.com', '12345', '00:00:00', '00:00:00', '', 9877766868, 32435, 6),
(59, 'Ritu Sapkota', 'ritus@gmail.com', '12345', '00:00:00', '00:00:00', '', 9798783224, 87345, 2),
(60, 'Kailash', 'kailsash@gmail.com', '12345', '00:00:00', '00:00:00', '', 9378947380, 988987, 1),
(61, 'Sushila Thapa', 'sushil@gmail.com', '12345', '00:00:00', '00:00:00', '', 9878798989, 890, 2),
(62, 'Sonam', 'sonam@gmail.com', '12345', '10:15:00', '17:15:00', '40', 9803691167, 5565, 1),
(63, 'Sonam', 'sonam2@gmail.com', '12345', '10:15:00', '17:15:00', '40', 9803691167, 5565, 1),
(64, 'EnglishS', 'eng@gmail.com', '12345', '11:15:00', '17:15:00', '50', 9803691167, 5575456, 1),
(65, 'Aakriti Poudel', 'aakriti@gmail.com', '12345', '10:15:00', '17:15:00', '60', 9803664455, 564, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment_db`
--

CREATE TABLE `payment_db` (
  `payment_id` int(11) NOT NULL,
  `patient_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ammount` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `appointment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment_db`
--

INSERT INTO `payment_db` (`payment_id`, `patient_name`, `ammount`, `payment_status`, `appointment_id`) VALUES
(29, 'Haruno Sakura', '20', 'Cancelled After Lock', 76),
(30, 'Sasuke', '10', 'Cancelled Before Lock', 78),
(31, 'DAichi', '100', 'Full', 81),
(32, 'WaypeyekCRgal', '10', 'Cancelled Before Lock', 83),
(43, 'Up', '10', 'Cancelled Before Lock', 90),
(44, 'HEh', '100', 'Full', 91);

-- --------------------------------------------------------

--
-- Table structure for table `requesterlogin_db`
--

CREATE TABLE `requesterlogin_db` (
  `r_login_id` int(60) NOT NULL,
  `r_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `r_email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `r_password` varchar(70) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `requesterlogin_db`
--

INSERT INTO `requesterlogin_db` (`r_login_id`, `r_name`, `r_email`, `r_password`) VALUES
(47, 'Sabita Guragain', 'ritu@gmail.com', '$2y$10$olEC7Ug2iJLXsrOuSleIXepRZFB5BRvvBImBgiXVb4UX9ufj8nQ0S'),
(48, 'nabita guragain', 'nabita@gmail.com', '$2y$10$k14fxIie9gbIx0ZCROGGHu.mDmhLVqt4n3IOBQxEccXNvyYc4luZS'),
(50, 'Surya Guragain', 'surya@gmail.com', '$2y$10$KsR5wxHw3Yidka578EHfUeO2uZPe3otQSDkYysLdfumBSF6G0zvxS'),
(54, 'Sabita Guragain', 'sabita@gmail.com', '$2y$10$tFw5JqChTXxbLdJL3ZYeneC0OzwQ9fVL7rYeBmYVDPwe12bxUvp0y'),
(55, 'Sabita Guragain', 'sabita7@gmail.com', '$2y$10$bgKA/GveZllPZQyKqqJmbOLy5xs7QwFeRVvKF3TVn/bwxq1Rw3aA2'),
(59, 'Jharana Ghimire', 'jharana8@gmail.com', '$2y$10$6D2UTGzlcMuE9r.QiRWuMOCflJzZJrccaW8yRZe0Lj6b/QTZEAlzG'),
(60, 'Sabita Guragain', 'sabita8@gmail.com', '$2y$10$BHMQDy60DEnSxHqh58IHP.yXj3yNwGRoeaowq9XzYJe3JHYWHTkk6'),
(61, 'da', 'da@gmail.com', '$2y$10$Vhbl4gZi9OtyCwMzo5gGPe84a3LFjw/uYdjRVdyHazoZL8/m7gLy.'),
(62, 'fks', 'sfs@gmail.com', '$2y$10$SjD08lb3kbe7FFYm9I.p0.e24Q1Exo8S.NJ7W6KfcnQB1LMh4NKoO'),
(63, 'Sanskriti Shrestha', 'sanskriti@gmail.com', '$2y$10$klmEHyFE5EHc.7KUl8BaduGU2vU6nB2HNj8ADgveoiLltIyTNTibW'),
(64, 'sushila thapa', 'sushila3@gmail.com', '$2y$10$PT0FM7SLOKuWx0e4A6CZbe0aFACuF4uvlWtlNjMHrxvrpqy6RJBHK'),
(65, 'Jharana Ghimire', 'jharan12@gmail.com', '$2y$10$5SN.o3V8dCuIWhp5MJ.mS.fE9lZdsd1DAABeJosHJoOUsd67sZEsq'),
(66, 'Sam ', 'sam@gmail.com', '$2y$10$Ng.imazhiO2MnyzP3g1nee68CDMW8ho0SX1v/KEA89j160HXa5aDK'),
(67, 'Mahesh Kumar', 'mahesh@gmail.com', '$2y$10$18Sh1.JaSN1DAmtyAZpmDOtO1hU75QGQsNm0ZBEFKIASK2f9kze1i'),
(68, 'Sabita Guragain', 'sab09@gmail.com', '$2y$10$h0nK2wAwYWb6loOUKD9aZOHSdWjUZ7INWG/x8vsheXKA.DmuXEM52'),
(69, 'Ram Maya', 'ram12@gmail.com', '$2y$10$MOauIGCbA91neBSIzFJ.EuN/8HGWByh0hemzyK2CM3WuCxvhQXO/q'),
(70, 'sonam', 'sanson@gm.com', '$2y$10$YFRhbcR6Sq5wg/r/RDrXEOCkyg95Do6Upe.VSFd7VIDfveWWiBBrK'),
(72, 'sonam', 'son@san.com', '$2y$10$OgOaSaA0Z9v3ypnEmNBm4ORFPHLJU9UCswf6lQvkJZEKNrJtFj1dq'),
(73, 'Sonam', 'sonam@gmail.com', '$2y$10$sUFyhU3dLbNZnRrk8dYNPuHzpupKC3Gl9OnFnjOcpmD1YdYYD2mFi'),
(74, 'sans', 'sans@gmail.com', '$2y$10$FdKuLxsMfC2lx.heopznBeDVCOKpK1mFyamn5730wi5uL4kYHjQv2'),
(75, 'sansu', 'sansu@gmail.com', '$2y$10$/bu8SXQnzUume3JatdJon.jyKbfRG2SX.gw5u.oD5lN/C2yQN1F0C'),
(76, 'suman', 'suman@gmail.com', '$2y$10$..5h/YfKGG0NZJftbW2OqeHtbHSpxFDxsVAlUMI4VWMc8HtQGjs0.');

-- --------------------------------------------------------

--
-- Table structure for table `speciality_db`
--

CREATE TABLE `speciality_db` (
  `speciality_id` int(11) NOT NULL,
  `speciality_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `speciality_db`
--

INSERT INTO `speciality_db` (`speciality_id`, `speciality_name`) VALUES
(1, 'physician'),
(2, 'Gyaenocology'),
(5, 'ENT'),
(6, 'Gastraentrology'),
(7, 'Oncology'),
(8, 'Dermatology'),
(9, 'Cardiology');

-- --------------------------------------------------------

--
-- Table structure for table `submitrequest_db`
--

CREATE TABLE `submitrequest_db` (
  `r_id` int(60) NOT NULL,
  `r_illness` text COLLATE utf8mb4_bin NOT NULL,
  `r_speciality` int(11) NOT NULL,
  `r_shift` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `r_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `r_gender` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `r_age` int(3) NOT NULL,
  `r_phone` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `r_add` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `r_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending,1=accept,2=close,3=checked',
  `r_date` date NOT NULL,
  `r_doctor` int(11) DEFAULT NULL,
  `r_report` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `submitrequest_db`
--

INSERT INTO `submitrequest_db` (`r_id`, `r_illness`, `r_speciality`, `r_shift`, `r_name`, `r_gender`, `r_age`, `r_phone`, `r_add`, `r_status`, `r_date`, `r_doctor`, `r_report`) VALUES
(38, 'headache', 1, '10am-1pm', 'Jharna Ghimire', 'Female', 22, '9863721758', ' Jhapa', 3, '2021-03-26', 52, NULL),
(39, 'kala aazar', 2, '10am-1pm', 'sabita', 'Female', 23, '7890965432', ' Kathmandu', 3, '2021-03-25', 59, NULL),
(40, 'corona', 6, '10am-1pm', 'rojin', 'Male', 16, '8723813111', ' ahfshf', 2, '2021-03-16', NULL, NULL),
(41, 'kala aazar', 2, '3pm-5pm', 'Rajesh', 'Male', 2, '9842493464', ' Kathmandu', 2, '2021-03-25', NULL, NULL),
(42, 'I cant read', 8, '10am-1pm', 'Tulasa', 'Female', 2, '9842493464', ' Lamjung', 0, '2021-03-25', NULL, NULL),
(43, 'Malaria', 1, '10am-1pm', 'Ram Maya', 'Male', 78, '9827304749', ' biratngar', 0, '2021-09-08', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin_db`
--
ALTER TABLE `adminlogin_db`
  ADD PRIMARY KEY (`a_login_id`);

--
-- Indexes for table `appointment_db`
--
ALTER TABLE `appointment_db`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `r_login_id` (`r_login_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_db`
--
ALTER TABLE `doctor_db`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `speciality` (`speciality_id`);

--
-- Indexes for table `payment_db`
--
ALTER TABLE `payment_db`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `requesterlogin_db`
--
ALTER TABLE `requesterlogin_db`
  ADD PRIMARY KEY (`r_login_id`);

--
-- Indexes for table `speciality_db`
--
ALTER TABLE `speciality_db`
  ADD PRIMARY KEY (`speciality_id`);

--
-- Indexes for table `submitrequest_db`
--
ALTER TABLE `submitrequest_db`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin_db`
--
ALTER TABLE `adminlogin_db`
  MODIFY `a_login_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_db`
--
ALTER TABLE `appointment_db`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `doctor_db`
--
ALTER TABLE `doctor_db`
  MODIFY `doctor_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `payment_db`
--
ALTER TABLE `payment_db`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `requesterlogin_db`
--
ALTER TABLE `requesterlogin_db`
  MODIFY `r_login_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `speciality_db`
--
ALTER TABLE `speciality_db`
  MODIFY `speciality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `submitrequest_db`
--
ALTER TABLE `submitrequest_db`
  MODIFY `r_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_db`
--
ALTER TABLE `doctor_db`
  ADD CONSTRAINT `speciality` FOREIGN KEY (`speciality_id`) REFERENCES `speciality_db` (`speciality_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
