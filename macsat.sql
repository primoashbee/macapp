-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2016 at 01:33 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `subject_id`, `student_id`) VALUES
(1, '1', '1'),
(2, '2', '1'),
(3, '2', '2'),
(4, '2', '3'),
(5, '3', '2'),
(6, '3', '3'),
(7, '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `class_count`
--
CREATE TABLE `class_count` (
`total` bigint(21)
,`subject_id` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `class_list`
--
CREATE TABLE `class_list` (
`class_id` int(11)
,`subject_id` int(11)
,`code` varchar(255)
,`title` varchar(255)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`student_id` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `class_summary`
--
CREATE TABLE `class_summary` (
`id` int(11)
,`code` varchar(255)
,`title` varchar(255)
,`units` varchar(255)
,`year` varchar(255)
,`sem` varchar(255)
,`acad_year` varchar(255)
,`t_id` int(11)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`isdeleted` tinyint(1)
,`student_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `academic_year`, `description`, `isDeleted`) VALUES
(1, 'BSCS', NULL, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 0),
(2, 'BSIT', NULL, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `class_id` int(25) DEFAULT NULL,
  `p_quiz` varchar(255) DEFAULT NULL,
  `p_exam` varchar(255) DEFAULT NULL,
  `p_attendace` varchar(255) DEFAULT NULL,
  `p_recitation` varchar(255) DEFAULT NULL,
  `p_project` varchar(255) DEFAULT NULL,
  `p_total_grade` varchar(255) DEFAULT NULL,
  `m_quiz` varchar(255) DEFAULT NULL,
  `m_exam` varchar(255) DEFAULT NULL,
  `m_attendance` varchar(255) DEFAULT NULL,
  `m_recitation` varchar(255) DEFAULT NULL,
  `m_project` varchar(255) DEFAULT NULL,
  `m_total_grade` varchar(255) DEFAULT NULL,
  `pf_quiz` varchar(255) DEFAULT NULL,
  `pf_exam` varchar(255) DEFAULT NULL,
  `pf_attendance` varchar(255) DEFAULT NULL,
  `pf_recitation` varchar(255) DEFAULT NULL,
  `pf_project` varchar(255) DEFAULT NULL,
  `pf_total_grade` varchar(255) DEFAULT NULL,
  `f_quiz` varchar(255) DEFAULT NULL,
  `f_exam` varchar(255) DEFAULT NULL,
  `f_attendance` varchar(255) DEFAULT NULL,
  `f_recitation` varchar(255) DEFAULT NULL,
  `f_project` varchar(255) DEFAULT NULL,
  `f_total_grade` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `class_id`, `p_quiz`, `p_exam`, `p_attendace`, `p_recitation`, `p_project`, `p_total_grade`, `m_quiz`, `m_exam`, `m_attendance`, `m_recitation`, `m_project`, `m_total_grade`, `pf_quiz`, `pf_exam`, `pf_attendance`, `pf_recitation`, `pf_project`, `pf_total_grade`, `f_quiz`, `f_exam`, `f_attendance`, `f_recitation`, `f_project`, `f_total_grade`) VALUES
(1, 1, '20.0', '40.0', '10.0', NULL, '30.0', '100', '16.0', '32.0', '8.0', NULL, '24.0', '80', '17.8', '34.8', '10.0', NULL, '27.0', '89.6', '2.8', '40.0', '10.0', NULL, '30.0', '82.8'),
(2, 2, '19.8', '29.7', '24.8', NULL, '24.8', '99.10000000000001', '19.6', '29.7', '24.5', NULL, '24.3', '98.10000000000001', '17.0', '27.3', '20.0', NULL, '22.0', '86.3', '18.4', '28.2', '22.8', NULL, '23.3', '92.7'),
(3, 3, '17.0', '27.0', '21.3', NULL, '21.3', 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED'),
(4, 4, NULL, NULL, NULL, NULL, NULL, 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED', NULL, NULL, NULL, NULL, NULL, 'DROPPED'),
(5, 5, '17.0', '26.1', '20.0', NULL, '22.5', '85.6', '18.0', '27.0', '22.5', NULL, '21.3', '88.8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grade_summary`
--
CREATE TABLE `grade_summary` (
`student_id` varchar(255)
,`code` varchar(255)
,`title` varchar(255)
,`p_total_grade` varchar(255)
,`m_total_grade` varchar(255)
,`pf_total_grade` varchar(255)
,`f_total_grade` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `grading_criteria`
--

CREATE TABLE `grading_criteria` (
  `id` int(25) NOT NULL,
  `class_id` int(25) DEFAULT NULL,
  `e_total` varchar(255) DEFAULT NULL,
  `e_percentage` varchar(255) DEFAULT NULL,
  `a_total` varchar(255) DEFAULT NULL,
  `a_percentage` varchar(255) DEFAULT NULL,
  `p_total` varchar(255) DEFAULT NULL,
  `p_percentage` varchar(255) DEFAULT NULL,
  `q_total` varchar(255) DEFAULT NULL,
  `q_percentage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grading_criteria`
--

INSERT INTO `grading_criteria` (`id`, `class_id`, `e_total`, `e_percentage`, `a_total`, `a_percentage`, `p_total`, `p_percentage`, `q_total`, `q_percentage`) VALUES
(1, 1, '100', '40', '100', '10', '100', '30', '100', '20'),
(2, 2, '100', '30', '100', '25', '100', '25', '100', '20'),
(3, 3, '100', '30', '100', '25', '100', '25', '100', '20'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `qrystudentinformation`
--
CREATE TABLE `qrystudentinformation` (
`id` int(11)
,`username` varchar(255)
,`passkey` varchar(255)
,`role` varchar(255)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`age` varchar(255)
,`course` varchar(255)
,`sex` varchar(255)
,`email` varchar(255)
,`birthday` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `qryteacherinformation`
--
CREATE TABLE `qryteacherinformation` (
`id` int(11)
,`username` varchar(255)
,`passkey` varchar(255)
,`role` varchar(255)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`age` varchar(255)
,`birthday` varchar(255)
,`sex` varchar(255)
,`address` varchar(255)
,`email` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `students_information`
--

CREATE TABLE `students_information` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_information`
--

INSERT INTO `students_information` (`id`, `username`, `firstname`, `lastname`, `age`, `course`, `sex`, `email`, `birthday`) VALUES
(1, 'ashbee', 'Ashbee', 'Morgado', '21', '2', 'Male', 'ashbee.morgado@icloud.com', '1994-11-26'),
(2, 'student1', 'Stud', 'One', '21', '1', 'MALE', 'stud1@gmail.com', '1995-09-12'),
(3, 'Student2', 'Stud', 'Two', '23', '1', 'MALE', 'stud2@gmail.com', '1993-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `units` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `acad_year` varchar(255) NOT NULL,
  `t_id` int(11) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `title`, `units`, `year`, `sem`, `acad_year`, `t_id`, `isDeleted`) VALUES
(1, 'CCS101', 'PROGRAMMING 101', '3', '2nd', '1st', '', 1, 0),
(2, 'CSM101', 'COMPILER', '2', '4th', '1st', '', 2, 0),
(3, 'SOC102', 'Microeconomics', '3', '2nd', '2nd', '', 3, 0),
(4, 'SOC103', 'Microeconomics', '3', '3rd', '2nd', '', 2, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `subject_information`
--
CREATE TABLE `subject_information` (
`id` int(11)
,`code` varchar(255)
,`title` varchar(255)
,`units` varchar(255)
,`year` varchar(255)
,`sem` varchar(255)
,`acad_year` varchar(255)
,`t_id` int(11)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`isdeleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_information`
--

CREATE TABLE `teacher_information` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_information`
--

INSERT INTO `teacher_information` (`id`, `username`, `firstname`, `lastname`, `age`, `birthday`, `sex`, `address`, `email`) VALUES
(1, 'teacher', 'Peregrines', 'Hitler', '21', '1994-11-26', 'Female', '', 'peregrines@icloud.com'),
(2, 'Bruz', 'Bruz', 'Susa', '21', '1995-10-13', 'Male', '', 'bruzsusa@gmail.com'),
(3, '0694828', 'subok', 'lang', '21', '1995-10-14', 'MALE', '', 'aaa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passkey` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passkey`, `role`, `isDeleted`) VALUES
(1, 'macsatadmin2016', '9876543210', 'admin', 0),
(2, 'ashbee', '1234', 'student', 0),
(3, 'teacher', '1234', 'teacher', 0),
(4, 'Bruz', 'pogi1', 'teacher', 0),
(5, 'student1', 'student1', 'student', 0),
(6, 'Student2', 'student2', 'student', 0),
(7, '0694828', 'mama', 'teacher', 0);

-- --------------------------------------------------------

--
-- Structure for view `class_count`
--
DROP TABLE IF EXISTS `class_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_count`  AS  select count(`class`.`subject_id`) AS `total`,`class`.`subject_id` AS `subject_id` from `class` group by `class`.`subject_id` ;

-- --------------------------------------------------------

--
-- Structure for view `class_list`
--
DROP TABLE IF EXISTS `class_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_list`  AS  select `c`.`id` AS `class_id`,`si`.`id` AS `subject_id`,`si`.`code` AS `code`,`si`.`title` AS `title`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`c`.`student_id` AS `student_id` from ((`students_information` `s` left join `class` `c` on((`s`.`id` = `c`.`student_id`))) join `subject_information` `si` on((`si`.`id` = `c`.`subject_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `class_summary`
--
DROP TABLE IF EXISTS `class_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_summary`  AS  select `s`.`id` AS `id`,`s`.`code` AS `code`,`s`.`title` AS `title`,`s`.`units` AS `units`,`s`.`year` AS `year`,`s`.`sem` AS `sem`,`s`.`acad_year` AS `acad_year`,`s`.`t_id` AS `t_id`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`s`.`isdeleted` AS `isdeleted`,ifnull(`c`.`total`,0) AS `student_count` from (`subject_information` `s` left join `class_count` `c` on((`s`.`id` = `c`.`subject_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `grade_summary`
--
DROP TABLE IF EXISTS `grade_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grade_summary`  AS  select `cl`.`student_id` AS `student_id`,`cl`.`code` AS `code`,`cl`.`title` AS `title`,`g`.`p_total_grade` AS `p_total_grade`,`g`.`m_total_grade` AS `m_total_grade`,`g`.`pf_total_grade` AS `pf_total_grade`,`g`.`f_total_grade` AS `f_total_grade` from (`grades` `g` join `class_list` `cl` on((`g`.`class_id` = `cl`.`class_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `qrystudentinformation`
--
DROP TABLE IF EXISTS `qrystudentinformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qrystudentinformation`  AS  select `s`.`id` AS `id`,`u`.`username` AS `username`,`u`.`passkey` AS `passkey`,`u`.`role` AS `role`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`s`.`age` AS `age`,`c`.`name` AS `course`,`s`.`sex` AS `sex`,`s`.`email` AS `email`,`s`.`birthday` AS `birthday` from ((`users` `u` left join `students_information` `s` on((`u`.`username` = `s`.`username`))) left join `course` `c` on((`s`.`course` = `c`.`id`))) where (`u`.`role` = 'student') ;

-- --------------------------------------------------------

--
-- Structure for view `qryteacherinformation`
--
DROP TABLE IF EXISTS `qryteacherinformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qryteacherinformation`  AS  select `t`.`id` AS `id`,`u`.`username` AS `username`,`u`.`passkey` AS `passkey`,`u`.`role` AS `role`,`t`.`firstname` AS `firstname`,`t`.`lastname` AS `lastname`,`t`.`age` AS `age`,`t`.`birthday` AS `birthday`,`t`.`sex` AS `sex`,`t`.`address` AS `address`,`t`.`email` AS `email` from (`users` `u` left join `teacher_information` `t` on((`u`.`username` = `t`.`username`))) where (`u`.`role` = 'teacher') ;

-- --------------------------------------------------------

--
-- Structure for view `subject_information`
--
DROP TABLE IF EXISTS `subject_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subject_information`  AS  select `s`.`id` AS `id`,`s`.`code` AS `code`,`s`.`title` AS `title`,`s`.`units` AS `units`,`s`.`year` AS `year`,`s`.`sem` AS `sem`,`s`.`acad_year` AS `acad_year`,`s`.`t_id` AS `t_id`,`t`.`firstname` AS `firstname`,`t`.`lastname` AS `lastname`,`s`.`isDeleted` AS `isdeleted` from (`subjects` `s` join `teacher_information` `t` on((`s`.`t_id` = `t`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD KEY `id` (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD KEY `id` (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_criteria`
--
ALTER TABLE `grading_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_information`
--
ALTER TABLE `students_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_information`
--
ALTER TABLE `teacher_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `grading_criteria`
--
ALTER TABLE `grading_criteria`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students_information`
--
ALTER TABLE `students_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `teacher_information`
--
ALTER TABLE `teacher_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
