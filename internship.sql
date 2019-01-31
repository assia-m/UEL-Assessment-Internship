-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2018 at 05:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment_criteria`
--

CREATE TABLE `assessment_criteria` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `programme` varchar(250) NOT NULL,
  `module` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coursework`
--

CREATE TABLE `coursework` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `programme` varchar(250) NOT NULL,
  `module` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `weights` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursework`
--

INSERT INTO `coursework` (`id`, `name`, `programme`, `module`, `description`, `weights`) VALUES
(8, 'CW1', '1', 'CN5120', 'jljjkljlkjk', 50);

-- --------------------------------------------------------

--
-- Table structure for table `induction`
--

CREATE TABLE `induction` (
  `id` int(50) NOT NULL,
  `programme` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `student` varchar(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LO`
--

CREATE TABLE `LO` (
  `id` int(50) NOT NULL,
  `content` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `assessment_criteria` varchar(250) NOT NULL,
  `coursework` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LO`
--

INSERT INTO `LO` (`id`, `content`, `type`, `assessment_criteria`, `coursework`) VALUES
(23, 'Test', 'Subject Based Practical Skills', ' ', 8),
(24, 'Test1', 'Knowledge', ' ', 8),
(25, 'TestAgain', 'Subject Based Practical Skills', ' ', 8);

-- --------------------------------------------------------

--
-- Table structure for table `LO_bands`
--

CREATE TABLE `LO_bands` (
  `id` int(50) NOT NULL,
  `LO_ID` varchar(250) NOT NULL,
  `band` varchar(250) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LO_bands`
--

INSERT INTO `LO_bands` (`id`, `LO_ID`, `band`, `comment`) VALUES
(9, '23', 'Very Poor (below 20%)', 'V Poorish'),
(10, '23', 'Poor (20%-30%)', 'Poorish'),
(11, '23', 'Some Engagement (31%-39%)', 'Engagedish'),
(12, '23', 'Satisfactory (40%-50%)', 'Satish'),
(13, '23', 'Good (50%-60%)', 'Goodish'),
(14, '23', 'Very Good (60%-70%)', 'V Goodish'),
(15, '23', 'Excellent (70%-80%)', 'Excellish'),
(16, '23', 'Outstanding (80%+)', 'Outish'),
(33, '24', 'Very Poor (below 20%)', '1'),
(34, '24', 'Poor (20%-30%)', '2'),
(35, '24', 'Some Engagement (31%-39%)', '3'),
(36, '24', 'Satisfactory (40%-50%)', '4'),
(37, '24', 'Good (50%-60%)', '5'),
(38, '24', 'Very Good (60%-70%)', '6'),
(39, '24', 'Excellent (70%-80%)', '7'),
(40, '24', 'Outstanding (80%+)', '8'),
(41, '25', 'Very Poor (below 20%)', '1a'),
(42, '25', 'Poor (20%-30%)', '2a'),
(43, '25', 'Some Engagement (31%-39%)', '3a'),
(44, '25', 'Satisfactory (40%-50%)', '4a'),
(45, '25', 'Good (50%-60%)', '5a'),
(46, '25', 'Very Good (60%-70%)', '6a'),
(47, '25', 'Excellent (70%-80%)', '7a'),
(48, '25', 'Outstanding (80%+)', '8a');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(50) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `coursework` varchar(250) NOT NULL,
  `marker` varchar(250) NOT NULL,
  `LO` varchar(250) NOT NULL,
  `band` varchar(250) NOT NULL,
  `feedback` varchar(250) NOT NULL,
  `improve` varchar(250) NOT NULL,
  `overall_mark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_id`, `coursework`, `marker`, `LO`, `band`, `feedback`, `improve`, `overall_mark`) VALUES
(6, '13', '8', '2', 'Test1', '33', 'Ok', 'Colour', '50'),
(7, '13', '8', '2', 'Test', '14', 'Ok', 'Colour', '50'),
(8, '13', '8', '2', 'TestAgain', '48', 'Ok', 'Colour', '50');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(50) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  `programme` varchar(250) NOT NULL,
  `leader` varchar(50) NOT NULL,
  `other_tutor` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(50) NOT NULL,
  `weight` int(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `peer_marking` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_code`, `programme`, `leader`, `other_tutor`, `name`, `type`, `weight`, `description`, `peer_marking`) VALUES
(1, 'CN5120', '1', '2', '12', 'Advanced Programming', 'Core', 15, 'Students will learn Java further', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `module_guide`
--

CREATE TABLE `module_guide` (
  `id` int(50) NOT NULL,
  `module_code` varchar(250) NOT NULL,
  `leader` varchar(250) NOT NULL,
  `other_tutor` varchar(250) NOT NULL,
  `term` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_guide`
--

INSERT INTO `module_guide` (`id`, `module_code`, `leader`, `other_tutor`, `term`) VALUES
(2, 'CN5120', '2', '12', 'Term 1');

-- --------------------------------------------------------

--
-- Table structure for table `module_guide_table`
--

CREATE TABLE `module_guide_table` (
  `id` int(50) NOT NULL,
  `module_guide_id` varchar(50) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  `table_date` varchar(250) NOT NULL,
  `table_activity` varchar(250) NOT NULL,
  `table_time` varchar(250) NOT NULL,
  `table_room` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_guide_table`
--

INSERT INTO `module_guide_table` (`id`, `module_guide_id`, `module_code`, `table_date`, `table_activity`, `table_time`, `table_room`) VALUES
(2, '2', 'CN5120', '20-08-2018', 'Exam', '09:00', 'EB.3.10'),
(3, '2', 'CN5120', '31-08-2018', 'Coursework Presentation', '12:00', 'WB.G.10');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `leader` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`id`, `name`, `category`, `leader`) VALUES
(1, 'Computer Science', 'Bachelor', '11');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `id` int(50) NOT NULL,
  `enquiry` varchar(250) NOT NULL,
  `researcher` varchar(250) NOT NULL,
  `search_parameters` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_portfolio`
--

CREATE TABLE `student_portfolio` (
  `id` int(50) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `website` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_portfolio`
--

INSERT INTO `student_portfolio` (`id`, `student_id`, `website`) VALUES
(2, '14', 'https://thelight1994.wordpress.com/pa4304-sound-design-1/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `rank` varchar(250) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `student_hours` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `rank`, `student_id`, `phone`, `room`, `student_hours`) VALUES
(2, 'Assia (ML)', 'amoujdi@gmail.com', 'pass', 'Module Leader', '', '02088475618', 'EB.3.10', 'Monday: 10 - 11. Tuesday: 3 - 5'),
(12, 'Assia (Admin)', 'assiamoujdi@gmail.com', 'pass', 'Programme Leader', '', '02097182638', 'WB.2.08', 'Friday: 12 - 1'),
(13, 'Assia (Student)', 'assiam@gmail.com', 'pass', 'Student', 'u1407170', '', '', ''),
(14, 'Meryam (Student)', 'assiam1@gmail.com', 'pass', 'Student', 'u14072848', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment_criteria`
--
ALTER TABLE `assessment_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursework`
--
ALTER TABLE `coursework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `induction`
--
ALTER TABLE `induction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LO`
--
ALTER TABLE `LO`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LO_bands`
--
ALTER TABLE `LO_bands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_guide`
--
ALTER TABLE `module_guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_guide_table`
--
ALTER TABLE `module_guide_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_portfolio`
--
ALTER TABLE `student_portfolio`
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
-- AUTO_INCREMENT for table `assessment_criteria`
--
ALTER TABLE `assessment_criteria`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursework`
--
ALTER TABLE `coursework`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `induction`
--
ALTER TABLE `induction`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LO`
--
ALTER TABLE `LO`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `LO_bands`
--
ALTER TABLE `LO_bands`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_guide`
--
ALTER TABLE `module_guide`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module_guide_table`
--
ALTER TABLE `module_guide_table`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_portfolio`
--
ALTER TABLE `student_portfolio`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
