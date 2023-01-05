-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 02:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ojt_rms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_date` text NOT NULL,
  `attendance_time_in` text NOT NULL,
  `attendance_time_out` text DEFAULT NULL,
  `attendance_log` text NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `attendance_date`, `attendance_time_in`, `attendance_time_out`, `attendance_log`, `coordinator_id`, `organization_id`) VALUES
(102, 417, 'Thursday, January 05, 2023', '02:46 AM', '02:46 AM', 'Morning', 268, 24),
(103, 417, 'Thursday, January 05, 2023', '02:46 AM', '02:46 AM', 'Afternoon', 268, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_email` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `sender_name`, `sender_email`, `date_sent`, `message`) VALUES
(3, 'Aynjel', 'aynjel76@gmail.com', '2022-11-14 00:55:23', 'hello admin'),
(6, 'Wael', 'wael2@mailc.com', '2022-11-14 01:03:14', 'lohe'),
(7, 'hola', 'hola@gmail.com', '2022-11-17 15:55:47', 'holasdf21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coordinator`
--

CREATE TABLE `tbl_coordinator` (
  `coordinator_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `organization_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coordinator`
--

INSERT INTO `tbl_coordinator` (`coordinator_id`, `first_name`, `last_name`, `contact_number`, `organization_id`) VALUES
(268, 'Roy', 'Gonzaga', '0912340342', 24),
(269, 'Daniel', 'Uy', '0912312421', 33);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `course_status` text NOT NULL DEFAULT 'Active',
  `created_at` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_code`, `course_name`, `course_status`, `created_at`) VALUES
(72, 'BSIT', 'Bachelor of Science in Information Technology', 'Active', '2022-12-08 14:00:51'),
(74, 'BSHM', 'Bachelor of Science in Hospitality Management', 'Active', '2022-12-08 22:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE `tbl_enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `school_year` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_enrolled` text DEFAULT current_timestamp(),
  `organization_id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text DEFAULT NULL,
  `total_training_hours` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enrollment`
--

INSERT INTO `tbl_enrollment` (`enrollment_id`, `school_year`, `student_id`, `date_enrolled`, `organization_id`, `start_date`, `end_date`, `total_training_hours`) VALUES
(263, '2022-2023', 413, 'January 03, 2023', 76, 'January 29, 2023', 'February 18, 2023', '500'),
(266, '2018-2019', 417, 'January 04, 2023', 24, '2018-06-01', 'July 12, 2018', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `receiver_user` text DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` text NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message_reply`
--

CREATE TABLE `tbl_message_reply` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` text NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notif_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `state` text NOT NULL DEFAULT 'unread',
  `date` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notif_id`, `receiver_user_id`, `message`, `state`, `date`) VALUES
(86, 0, 'New Coordinator created named Steve Rogers', 'unread', '2022-11-25 20:54:41'),
(87, 0, 'New Coordinator created named John Walko', 'unread', '2022-11-25 20:56:21'),
(90, 0, 'New Coordinator created named Daniel Bert Uy', 'unread', '2022-11-30 14:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization`
--

CREATE TABLE `tbl_organization` (
  `organization_id` int(11) NOT NULL,
  `organization_name` varchar(200) NOT NULL,
  `organization_description` text NOT NULL,
  `organization_contact_number` varchar(15) NOT NULL,
  `organization_address` text NOT NULL,
  `organization_email` varchar(50) NOT NULL,
  `organization_status` text NOT NULL DEFAULT 'Active',
  `created_at` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`organization_id`, `organization_name`, `organization_description`, `organization_contact_number`, `organization_address`, `organization_email`, `organization_status`, `created_at`) VALUES
(24, 'Consolatrix College of Toledo City', 't is a long established fact that a reader will be ', '0912335432', 'Magsaysay Hills, Poblacion, Toledo City', 'cctc@gmail.com', 'Active', '2022-11-06 21:33:56'),
(33, 'Cebeco Electric Cooperative III', '1231231231\r\n', '0912315646', 'Sangi, Toledo City', 'cebeco@gmail.com', 'Active', '2022-12-07 18:24:11'),
(70, 'Larson and Underwood Co', 'Qui obcaecati volupt', 'Ratliff and Koc', 'Jones and Soto Trading', 'qynylabe@mailinator.com', 'Active', '2022-12-27 22:04:34'),
(76, 'Hinulawan Lab', 'Hinulawan', 'Nolan Allen Inc', 'Schneider and Stanton Associates', 'fuxukukadi@mailinator.com', 'Active', '2023-01-02 13:25:02'),
(77, 'Maddox and Talley Associates', 'Sint expedita perfe', 'Campbell Moore ', 'Bradford and Potts Associates', 'tity@mailinator.com', 'Active', '2023-01-02 14:03:23'),
(78, 'Leon Acosta Co', 'Quam aut soluta eaqu', 'Conner Nielsen ', 'Blankenship and Bender Plc', 'nipa@mailinator.com', 'Active', '2023-01-02 14:03:32'),
(79, 'Cannon and Atkinson Associates', 'Rerum id ex quas est', 'Yang Cameron LL', 'Nieves and Pickett Co', 'doty@mailinator.com', 'Active', '2023-01-02 15:43:52'),
(80, 'Clements and Ayers Co', 'Dolor voluptas conse', 'Combs Meyers Tr', 'Mccormick Mercado Co', 'ropo@mailinator.com', 'Active', '2023-01-02 20:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `user_id` int(11) NOT NULL,
  `otp_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_id_number` text NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_id_number`, `first_name`, `last_name`, `course_id`, `contact_number`, `address`) VALUES
(413, '123456', 'Angel Niño', 'Ortega', 72, '09120403634', 'Bato'),
(417, '2018-0001', 'Kobe', 'Bryant', 72, '09123456789', 'Brgy. 1, City of San Fernando, La Union');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `task_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_description` text NOT NULL,
  `task_deadline` text NOT NULL DEFAULT 'No Deadline',
  `user_id` int(11) NOT NULL,
  `task_status` text NOT NULL DEFAULT 'Undecided',
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`task_id`, `task_name`, `task_description`, `task_deadline`, `user_id`, `task_status`, `organization_id`) VALUES
(98, 'Ciara Nguyen', 'Nostrud numquam reru', 'August 03, 2003', 268, 'Approved', 24),
(99, 'Gary Guzman', 'Eum exercitationem d', 'April 09, 2004', 268, 'Approved', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_status`
--

CREATE TABLE `tbl_task_status` (
  `submitted_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `uploaded_file` text DEFAULT NULL,
  `date_of_submission` text NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `score` int(3) NOT NULL,
  `submitted_status` text NOT NULL DEFAULT 'Not Submitted',
  `date_graded` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nickname` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_role` text NOT NULL DEFAULT 'Student',
  `user_status` text NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nickname`, `user_email`, `user_password`, `user_role`, `user_status`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'Admin', 'Verified', '2022-12-12 15:19:50'),
(268, 'roy', 'roy@gmail.com', 'roy', 'Coordinator', 'Verified', '2022-12-15 07:23:23'),
(269, 'dan', 'dan@gmail.com', 'dan', 'Coordinator', 'Verified', '2022-12-15 07:25:39'),
(413, NULL, 'ortegacanillo76@gmail.com', '$2y$10$NQUB2DIQcfEqUR.XW.MbLOWXvZQRno7dEHW.99yd6mDSdU7MZcOUe', 'Student', 'Verified', '2023-01-03 17:39:28'),
(417, NULL, 'kobeortega76@gmail.com', '$2y$10$6sv96gHp6kcdT/6ZKp8JqOIKlV.60Bvua.lzKL0xcdQuzo4oPO882', 'Student', 'Verified', '2023-01-04 12:51:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  ADD PRIMARY KEY (`coordinator_id`),
  ADD KEY `coodinator_fk_to_organization` (`organization_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `enrollment_fk_to_student` (`student_id`),
  ADD KEY `enrollment_fk_to_organization` (`organization_id`),
  ADD KEY `enrollment_fk_to_school_year` (`school_year`(3072));

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_fk_to_user` (`sender_user_id`);

--
-- Indexes for table `tbl_message_reply`
--
ALTER TABLE `tbl_message_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_reply_fk_to_message` (`message_id`),
  ADD KEY `message_reply_fk_to_user` (`sender_user_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_fk_to_course` (`course_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_fk_to_user` (`user_id`);

--
-- Indexes for table `tbl_task_status`
--
ALTER TABLE `tbl_task_status`
  ADD PRIMARY KEY (`submitted_id`),
  ADD KEY `submit_fk_student` (`student_id`),
  ADD KEY `submit_fk_task` (`task_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  MODIFY `coordinator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_message_reply`
--
ALTER TABLE `tbl_message_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_task_status`
--
ALTER TABLE `tbl_task_status`
  MODIFY `submitted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  ADD CONSTRAINT `coodinator_fk_to_organization` FOREIGN KEY (`organization_id`) REFERENCES `tbl_organization` (`organization_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `coordinator_fk_to_user` FOREIGN KEY (`coordinator_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD CONSTRAINT `enrollment_fk_to_organization` FOREIGN KEY (`organization_id`) REFERENCES `tbl_organization` (`organization_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollment_fk_to_student` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD CONSTRAINT `message_fk_to_user` FOREIGN KEY (`sender_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_message_reply`
--
ALTER TABLE `tbl_message_reply`
  ADD CONSTRAINT `message_reply_fk_to_message` FOREIGN KEY (`message_id`) REFERENCES `tbl_message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_reply_fk_to_user` FOREIGN KEY (`sender_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD CONSTRAINT `otp_fk_to_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `student_fk_to_user` FOREIGN KEY (`student_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD CONSTRAINT `task_fk_to_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_task_status`
--
ALTER TABLE `tbl_task_status`
  ADD CONSTRAINT `submit_fk_student` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submit_fk_task` FOREIGN KEY (`task_id`) REFERENCES `tbl_task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
