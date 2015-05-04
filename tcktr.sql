-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 11:44 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tcktr`
--

-- --------------------------------------------------------

--
-- Table structure for table `perform`
--

CREATE TABLE IF NOT EXISTS `perform` (
`ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `numTickets` int(11) NOT NULL,
  `reserved` int(11) NOT NULL,
  `showID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perform`
--

INSERT INTO `perform` (`ID`, `date`, `numTickets`, `reserved`, `showID`) VALUES
(1, '2015-05-28 11:00:00', 50, 90, 1),
(2, '2015-05-29 14:00:00', 50, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
`ID` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numTicket` int(11) NOT NULL,
  `list` varchar(3) NOT NULL,
  `performID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ID`, `fname`, `lname`, `email`, `numTicket`, `list`, `performID`) VALUES
(1, 'Daniel', 'Ben-Chitrit', 'dibol13@gmail.com', 9, 'No', 1),
(2, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(3, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(4, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(5, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(6, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(7, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(8, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1),
(9, 'Daniel', 'Ben-Chitrit', '4', 9, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `show`
--

CREATE TABLE IF NOT EXISTS `show` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perform`
--
ALTER TABLE `perform`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
