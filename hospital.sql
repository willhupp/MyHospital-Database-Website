-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2017 at 02:32 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `nurseroom`
--

CREATE TABLE `nurseroom` (
  `HID` int(11) NOT NULL,
  `Roomnum` int(11) NOT NULL,
  `Bed1` int(11) NOT NULL,
  `Bed2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurseroom`
--

INSERT INTO `nurseroom` (`HID`, `Roomnum`, `Bed1`, `Bed2`) VALUES
(3, 230, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `HID` int(11) NOT NULL,
  `Checkin` varchar(26) NOT NULL,
  `Checkout` varchar(26) NOT NULL,
  `Diagnosis` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`HID`, `Checkin`, `Checkout`, `Diagnosis`) VALUES
(1, '04/29/1995', '05/01/1996', 'Brain tumor'),
(2, '04/29/1998', '04/30/1998', 'Heart Ache');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `HID` int(11) NOT NULL,
  `Lname` varchar(26) NOT NULL,
  `Fname` varchar(26) NOT NULL,
  `DOB` varchar(26) NOT NULL,
  `E-mail` varchar(26) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Username` varchar(26) NOT NULL,
  `Password` varchar(26) NOT NULL,
  `Role` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`HID`, `Lname`, `Fname`, `DOB`, `E-mail`, `Phone`, `Username`, `Password`, `Role`) VALUES
(1, 'Hupp', 'Will', '05/29/1997', 'whupp@att.net', 8153076092, 'willanater70', 'password', 'doctor'),
(2, 'que', 'chris', '01/01/2000', 'ron@gmail.com', 666666666, 'asdf', 'asdf', 'patient'),
(3, 'Nursy', 'Nurse', '05/01/1856', 'patty@gmail.com', 78945612307, 'nurse1', 'nursepassword', 'Nurse'),
(4, 'gaitros', 'david', '02/19/1997', 'david@david.com', 8153218965, 'david', 'gaitros2', 'doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nurseroom`
--
ALTER TABLE `nurseroom`
  ADD PRIMARY KEY (`HID`),
  ADD KEY `Bed1` (`Bed1`),
  ADD KEY `Bed2` (`Bed2`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`HID`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`HID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `HID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `nurseroom`
--
ALTER TABLE `nurseroom`
  ADD CONSTRAINT `nurseroom_ibfk_1` FOREIGN KEY (`Bed1`) REFERENCES `patient` (`HID`),
  ADD CONSTRAINT `nurseroom_ibfk_2` FOREIGN KEY (`Bed2`) REFERENCES `patient` (`HID`),
  ADD CONSTRAINT `nurseroom_ibfk_3` FOREIGN KEY (`HID`) REFERENCES `people` (`HID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`HID`) REFERENCES `people` (`HID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
