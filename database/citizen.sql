-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 12:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citizen`
--

-- --------------------------------------------------------

--
-- Table structure for table `case_issue`
--

CREATE TABLE `case_issue` (
  `caseid` varchar(35) NOT NULL,
  `offences` text NOT NULL,
  `result` varchar(20) NOT NULL,
  `penalty` text NOT NULL,
  `citizen` varchar(35) NOT NULL,
  `case_date` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `case_issue`
--

INSERT INTO `case_issue` (`caseid`, `offences`, `result`, `penalty`, `citizen`, `case_date`) VALUES
('case20210828155511', 'Theft', 'guilty', '1 year in prison', '111', '28 Aug 2021');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `nin` varchar(15) NOT NULL,
  `fullname` varchar(35) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `marital_status` varchar(15) NOT NULL,
  `children` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `lga` varchar(10) NOT NULL,
  `home_address` text NOT NULL,
  `current_address` text NOT NULL,
  `citizen_status` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`nin`, `fullname`, `gender`, `dob`, `marital_status`, `children`, `state`, `lga`, `home_address`, `current_address`, `citizen_status`, `email`, `mobile`) VALUES
('111', 'Joy Mike', 'female', '2021-08-16T05:37', 'married', '2', 'anambra', 'idemili-no', 'permanent home address', 'current address', 'alife', 'joy@gmail.com', '090767');

-- --------------------------------------------------------

--
-- Table structure for table `health`
--

CREATE TABLE `health` (
  `healthid` varchar(35) NOT NULL,
  `citizen` varchar(30) NOT NULL,
  `allergies` text NOT NULL,
  `genotype` varchar(10) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `virus` text NOT NULL,
  `handicap` text NOT NULL,
  `last_update` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health`
--

INSERT INTO `health` (`healthid`, `citizen`, `allergies`, `genotype`, `blood_group`, `virus`, `handicap`, `last_update`) VALUES
('health20210828165353', '111', 'smoke', 'aa', 'a+', 'none', 'none', '28 Aug 2021');

-- --------------------------------------------------------

--
-- Table structure for table `health_issue`
--

CREATE TABLE `health_issue` (
  `issueid` varchar(35) NOT NULL,
  `illness` text NOT NULL,
  `all_tests` text NOT NULL,
  `test_result` text NOT NULL,
  `issue_date` varchar(35) NOT NULL,
  `citizen` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_issue`
--

INSERT INTO `health_issue` (`issueid`, `illness`, `all_tests`, `test_result`, `issue_date`, `citizen`) VALUES
('health20210828162024', 'Malaria', 'malaria and typhoid', 'positivw', '28 Aug 2021', '111');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginid` varchar(30) NOT NULL,
  `role` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginid`, `role`, `password`) VALUES
('admin', 'admin', 'a'),
('clinic@gmail.com', 'medical', 'clinic@gmail.com'),
('security@gmail.com', 'security', 'security@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `email` varchar(30) NOT NULL,
  `sector_name` varchar(60) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`email`, `sector_name`, `mobile`, `address`) VALUES
('clinic@gmail.com', 'IClinic Medical Care', '090767', 'number 44 marketin groad abba'),
('security@gmail.com', 'ISecurity Secured Interpol', '090767', 'The exams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `case_issue`
--
ALTER TABLE `case_issue`
  ADD PRIMARY KEY (`caseid`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`nin`);

--
-- Indexes for table `health`
--
ALTER TABLE `health`
  ADD PRIMARY KEY (`healthid`);

--
-- Indexes for table `health_issue`
--
ALTER TABLE `health_issue`
  ADD PRIMARY KEY (`issueid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
