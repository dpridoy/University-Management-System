-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 12:37 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amarproshnoo_universitysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocate_classroom`
--

CREATE TABLE `allocate_classroom` (
  `id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `course` varchar(100) NOT NULL,
  `roomno` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(150) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `t_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `cname`, `credit`, `dept_name`, `semester`, `t_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'CSE-101', 'Programming Language', 4, 'CSE', '1st', 0, '2017-07-17 12:24:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `day` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `dname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'CSE', 'Computer science and engineering', '2017-04-28 08:44:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'EEE', 'Electrics and electronics engineering', '2017-04-28 09:15:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`) VALUES
(1, 'Professor'),
(2, 'Department Head'),
(3, 'Asst. Professor'),
(4, 'Lecturer'),
(5, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `enrollinacourse`
--

CREATE TABLE `enrollinacourse` (
  `id` int(11) NOT NULL,
  `stuRegNo` int(11) NOT NULL,
  `dept_name` varchar(150) NOT NULL,
  `course` int(11) NOT NULL,
  `enrolldate` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`) VALUES
(1, 'A+'),
(2, 'A'),
(3, 'A-'),
(4, 'B+'),
(5, 'B'),
(6, 'B-'),
(7, 'C+'),
(8, 'C'),
(9, 'C-'),
(10, 'D+'),
(11, 'D'),
(12, 'D-'),
(13, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `register_student`
--

CREATE TABLE `register_student` (
  `id` int(11) NOT NULL,
  `stu_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno` varchar(50) NOT NULL,
  `registerDate` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `stuRegNo` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roomno`
--

CREATE TABLE `roomno` (
  `id` int(11) NOT NULL,
  `roomno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomno`
--

INSERT INTO `roomno` (`id`, `roomno`) VALUES
(1, '101'),
(2, '102');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `dept_name`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CSE', '1st', '2017-04-28 10:10:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'CSE', '2nd', '2017-04-28 10:10:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'CSE', '3rd', '2017-04-28 10:10:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'EEE', '1st', '2017-04-28 10:13:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'EEE', '2nd', '2017-04-28 10:15:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'EEE', '3rd', '2017-04-28 10:57:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'EEE', '4th', '2017-04-28 10:58:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'EEE', '5th', '2017-04-29 01:13:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'CSE', '4th', '2017-04-30 09:21:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `credit_to_be_taken` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '0',
  `remaining_credit` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `address`, `email`, `contact`, `designation`, `dept_name`, `credit_to_be_taken`, `photo`, `remaining_credit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 'Nasirul Haque', 'Dhaka', 'dpridoy@gmail.com', '0155000000', 'Asst. Professor', 'CSE', 15, '../../image/teachers/31742596c92556690f.jpg', 15, '2017-07-17 12:32:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `designation` varchar(150) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `address`, `designation`, `salary`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dpridoy@gmail.com', '123456', 'Nasirul Haque', '294 West Shewrapara, Mirpur- Dhaka', 'Administrative Officer', '40,000', '../../image/D.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocate_classroom`
--
ALTER TABLE `allocate_classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`,`course_code`),
  ADD UNIQUE KEY `cname` (`cname`) USING BTREE,
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`,`code`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `name` (`dname`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollinacourse`
--
ALTER TABLE `enrollinacourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_student`
--
ALTER TABLE `register_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_ibfk_1` (`stuRegNo`),
  ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `roomno`
--
ALTER TABLE `roomno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_ibfk_1` (`dept_name`) USING BTREE;

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate_classroom`
--
ALTER TABLE `allocate_classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `enrollinacourse`
--
ALTER TABLE `enrollinacourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `register_student`
--
ALTER TABLE `register_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roomno`
--
ALTER TABLE `roomno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `register_student`
--
ALTER TABLE `register_student`
  ADD CONSTRAINT `register_student_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`stuRegNo`) REFERENCES `register_student` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`code`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
