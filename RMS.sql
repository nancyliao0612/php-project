-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2022 at 09:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `admId` int(11) NOT NULL,
  `admName` varchar(100) NOT NULL,
  `admSurname` varchar(100) NOT NULL,
  `admPassword` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Administrator`
--

INSERT INTO `Administrator` (`admId`, `admName`, `admSurname`, `admPassword`) VALUES
(1, 'Nancy', 'Liao', 'eedd'),
(2, 'Samuel', 'Kuo', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `Consent`
--

CREATE TABLE `Consent` (
  `consentId` int(11) NOT NULL,
  `stuName` varchar(100) NOT NULL,
  `courseId` int(11) NOT NULL,
  `result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseIntro` varchar(300) NOT NULL,
  `courseQuota` int(11) NOT NULL,
  `courseCredit` int(11) NOT NULL,
  `courseConsent` tinyint(1) NOT NULL,
  `courseProfessor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`courseId`, `courseName`, `courseIntro`, `courseQuota`, `courseCredit`, `courseConsent`, `courseProfessor`) VALUES
(1, 'Algorithms and Programming', 'This course introduces basic principles of algorithms and programming; input/output, decision making, iterations, methods, arrays, and string with the aid of the programming language Java.', 100, 6, 1, 'Nazım'),
(2, 'Web Based Application Programming', 'Basic concepts of visual and event-oriented programming. Topics in client-site programming with a scripting language. DOM, and Ajax. Server-site programming techniques. Implementation of applications using current languages.', 100, 6, 1, 'Mustafa'),
(4, 'Project Management', 'Project management is the application of processes, methods, skills, knowledge and experience to achieve specific project objectives according to the project acceptance criteria within agreed parameters.', 40, 4, -1, 'Molecule'),
(7, 'Information Technology Infrastructures', 'Representation of data in computing. Study of computer hardware, including the organization of CPU and memory, peripheral devices. Study of system software, including operating system functions such as memory management, file management and scheduling.', 60, 4, 1, 'Molecule');

-- --------------------------------------------------------

--
-- Table structure for table `Professor`
--

CREATE TABLE `Professor` (
  `proId` int(11) NOT NULL,
  `proName` varchar(100) NOT NULL,
  `proSurname` varchar(100) NOT NULL,
  `proPassword` varchar(10) NOT NULL,
  `activeStatus` varchar(100) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Professor`
--

INSERT INTO `Professor` (`proId`, `proName`, `proSurname`, `proPassword`, `activeStatus`) VALUES
(20, 'Mustafa', 'Coskun', 'wsxedc', 'Active'),
(21, 'Anil', 'Cool', '6666d', 'Active'),
(22, 'Molecule', 'Kuo', '7788', 'Active'),
(23, 'Nazım', 'Tasin', '999999', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `storeCourse`
--

CREATE TABLE `storeCourse` (
  `id` int(11) NOT NULL,
  `stuName` varchar(100) NOT NULL,
  `courseId0` int(11) NOT NULL DEFAULT 0,
  `courseId1` int(11) NOT NULL DEFAULT 0,
  `courseId2` int(11) NOT NULL DEFAULT 0,
  `courseId3` int(11) NOT NULL DEFAULT 0,
  `courseId4` int(11) NOT NULL DEFAULT 0,
  `courseId5` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storeCourse`
--

INSERT INTO `storeCourse` (`id`, `stuName`, `courseId0`, `courseId1`, `courseId2`, `courseId3`, `courseId4`, `courseId5`) VALUES
(284, 'WenTzu', 1, 2, 4, 0, 0, 0),
(285, 'Echo', 1, 4, 7, 2, 0, 0),
(286, 'Fen', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `stuId` int(11) NOT NULL,
  `stuName` varchar(100) NOT NULL,
  `stuSurname` varchar(100) NOT NULL,
  `stuPassword` varchar(10) NOT NULL,
  `activeStatus` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`stuId`, `stuName`, `stuSurname`, `stuPassword`, `activeStatus`) VALUES
(40, 'WenTzu', 'Liao', '5555', 'Active'),
(41, 'Echo', 'Lee', 'ddeee', 'Active'),
(42, 'Fen', 'Lee', '3wwww', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `SystemManage`
--

CREATE TABLE `SystemManage` (
  `parametersId` int(11) NOT NULL,
  `minPwd` int(11) NOT NULL,
  `maxPwd` int(11) NOT NULL,
  `MaxStuCourse` int(11) NOT NULL,
  `MaxProfCourse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SystemManage`
--

INSERT INTO `SystemManage` (`parametersId`, `minPwd`, `maxPwd`, `MaxStuCourse`, `MaxProfCourse`) VALUES
(9, 4, 10, 5, 4),
(10, 4, 11, 4, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`admId`);

--
-- Indexes for table `Consent`
--
ALTER TABLE `Consent`
  ADD PRIMARY KEY (`consentId`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`proId`);

--
-- Indexes for table `storeCourse`
--
ALTER TABLE `storeCourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`stuId`);

--
-- Indexes for table `SystemManage`
--
ALTER TABLE `SystemManage`
  ADD PRIMARY KEY (`parametersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `admId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Consent`
--
ALTER TABLE `Consent`
  MODIFY `consentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Professor`
--
ALTER TABLE `Professor`
  MODIFY `proId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `storeCourse`
--
ALTER TABLE `storeCourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `stuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `SystemManage`
--
ALTER TABLE `SystemManage`
  MODIFY `parametersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
