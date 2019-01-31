-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db592196520.db.1and1.com
-- Generation Time: Jun 26, 2018 at 01:42 PM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db592196520`
--

-- --------------------------------------------------------

--
-- Table structure for table `Module_Guide`
--

CREATE TABLE IF NOT EXISTS `Module_Guide` (
  `School` varchar(10) DEFAULT NULL,
  `Module_Title` varchar(10) NOT NULL DEFAULT '',
  `Module_Code` varchar(10) NOT NULL DEFAULT '',
  `Level` varchar(10) DEFAULT NULL,
  `Period` varchar(10) DEFAULT NULL,
  `Academic_Year` varchar(10) DEFAULT NULL,
  `Module_Leader_Name` varchar(10) DEFAULT NULL,
  `Module_Leader_Email` varchar(10) DEFAULT NULL,
  `Module_Leader_Tel` varchar(10) DEFAULT NULL,
  `Module_Leader_Room` varchar(10) DEFAULT NULL,
  `Tutor1_Name` varchar(10) DEFAULT NULL,
  `Tutor1_Email` varchar(10) DEFAULT NULL,
  `Tutor1_Tel` varchar(10) DEFAULT NULL,
  `Tutor1_Room` varchar(10) DEFAULT NULL,
  `Tutor2_Name` varchar(10) DEFAULT NULL,
  `Tutor2_Email` varchar(10) DEFAULT NULL,
  `Tutor2_Tel` varchar(10) DEFAULT NULL,
  `Tutor2_Room` varchar(10) DEFAULT NULL,
  `Tutor3_Name` varchar(10) DEFAULT NULL,
  `Tutor3_Email` varchar(10) DEFAULT NULL,
  `Tutor3_Tel` varchar(10) DEFAULT NULL,
  `Tutor3_Room` varchar(10) DEFAULT NULL,
  `Lecture_Day_Time` varchar(10) DEFAULT NULL,
  `Workshop_Day_Time` varchar(10) DEFAULT NULL,
  `Assessment_Component_1` varchar(10) DEFAULT NULL,
  `Assessment_Component_2` varchar(10) DEFAULT NULL,
  `Assessment_Component_3` varchar(10) DEFAULT NULL,
  `What_is_covered` varchar(10) DEFAULT NULL,
  `Keep_up_to_date` varchar(10) DEFAULT NULL,
  `Expectations` varchar(10) DEFAULT NULL,
  `Moodle` varchar(10) DEFAULT NULL,
  `Attendance` varchar(10) DEFAULT NULL,
  `Requirements` varchar(10) DEFAULT NULL,
  `Factors` varchar(10) DEFAULT NULL,
  `Aims` varchar(10) DEFAULT NULL,
  `Module_LOs` varchar(10) DEFAULT NULL,
  `Dissertation` varchar(10) DEFAULT NULL,
  `Reading_and_Resources` varchar(10) DEFAULT NULL,
  `Schedule` varchar(10) DEFAULT NULL,
  `Health_and_Safety` varchar(10) DEFAULT NULL,
  `Task1_Details` varchar(10) DEFAULT NULL,
  `Task1_Weighting` varchar(10) DEFAULT NULL,
  `Task1_LOs` varchar(10) DEFAULT NULL,
  `Task1_Deadline` varchar(10) DEFAULT NULL,
  `Task1_Assessment_Criteria` varchar(10) DEFAULT NULL,
  `Task2_Details` varchar(10) DEFAULT NULL,
  `Task2_Weighting` varchar(10) DEFAULT NULL,
  `Task2_LOs` varchar(10) DEFAULT NULL,
  `Task2_Deadline` varchar(10) DEFAULT NULL,
  `Task2_Assessment_Criteria` varchar(10) DEFAULT NULL,
  `Task3_Details` varchar(10) DEFAULT NULL,
  `Task3_Weighting` varchar(10) DEFAULT NULL,
  `Task3_LOs` varchar(10) DEFAULT NULL,
  `Task3_Deadline` varchar(10) DEFAULT NULL,
  `Task3_Assessment_Criteria` varchar(10) DEFAULT NULL,
  `Referencing` varchar(10) DEFAULT NULL,
  `Submission` varchar(10) DEFAULT NULL,
  `Feedback` varchar(10) DEFAULT NULL,
  `Module_Spec` varchar(10) DEFAULT NULL,
  `Key_Forms` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Module_Code`),
  UNIQUE KEY `Module Code` (`Module_Code`),
  UNIQUE KEY `Module Title` (`Module_Title`),
  UNIQUE KEY `Module Code_3` (`Module_Code`),
  UNIQUE KEY `Module Leader Name` (`Module_Leader_Name`),
  KEY `Module Code_2` (`Module_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
