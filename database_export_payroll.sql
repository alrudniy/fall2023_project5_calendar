-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 05:40 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll1`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `USER_ID` varchar(255) NOT NULL,
  `EMP_ID` int(255) NOT NULL,
  `PWD_HASH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`USER_ID`, `EMP_ID`, `PWD_HASH`) VALUES
('ahector43', 3216894, 'password6'),
('egglestona4736', 2930124, 'password9'),
('jjohnson43', 3593817, 'password2'),
('jjones21', 2875020, 'password8'),
('jomerolla', 1617385, 'password'),
('jsmith21', 2498763, 'password1'),
('lpeters44', 4286012, 'password4'),
('moblonsky98', 6294422, 'password7'),
('mreynolds1', 5774896, 'password3'),
('wpasternak', 4077358, 'password5');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMP_ID` int(255) NOT NULL,
  `F_Name` varchar(255) NOT NULL,
  `L_Name` varchar(255) NOT NULL,
  `EMP_ADDR` varchar(255) NOT NULL,
  `EMP_EMAIL` varchar(255) NOT NULL,
  `EMP_DOB` date NOT NULL,
  `EMP_SSN` int(255) NOT NULL,
  `EMP_ROLE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMP_ID`, `F_Name`, `L_Name`, `EMP_ADDR`, `EMP_EMAIL`, `EMP_DOB`, `EMP_SSN`, `EMP_ROLE`) VALUES
(1617385, 'Joe', 'Merolla', '349 West Main Street', 'jomerolla@aol.com', '1997-05-19', 598868466, 'Manager'),
(2498763, 'John', 'Smith', '105 Dragon Road', 'john.smith@gmail.com', '1966-11-12', 521047896, 'Employee'),
(2875020, 'Jim', 'Jones', '1010 Red Road', 'jim.jones@yahoo.com', '1978-09-14', 105657563, 'Employee'),
(2930124, 'Arnold', 'Eggleston', '896 Royal Way', 'arnold.egglestion@aol.com', '1969-07-04', 874947581, 'Employee'),
(3216894, 'Hector', 'Alvarez', '455 Sickler Street', 'hector.alvarez@yahoo.com', '1990-05-10', 534763130, 'Employee'),
(3593817, 'Jack', 'Johnson', '1658 Northern Pine Drive', 'jack.johnson2@gmail.com', '1955-05-05', 380403965, 'Employee'),
(4077358, 'Waldo', 'Pasternak', '87 Rose Petal Court', 'waldo.pasternak@gmail.com', '1987-10-11', 980164911, 'Employee'),
(4286012, 'Lindsey', 'Peters', '556 Carnation Drive', 'lindsey.peters@yahoo.com', '1980-11-10', 782832407, 'Employee'),
(5774896, 'Martha', 'Reynolds', '976 Hillcrest Drive', 'martha.reynolds56@hotmail.com', '1970-04-13', 331101115, 'Manager'),
(6294422, 'Marina', 'Oblonsky', '857 Mountain View Road', 'marina.oblonsky@gmail.com', '1991-06-26', 808780160, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `store info`
--

CREATE TABLE `store info` (
  `STORE_ID` int(255) NOT NULL,
  `STORE_ADDR` varchar(255) NOT NULL,
  `STORE_NUMBER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store info`
--

INSERT INTO `store info` (`STORE_ID`, `STORE_ADDR`, `STORE_NUMBER`) VALUES
(7878, '1050 Northern Blvd', '570-489-7845'),
(18456, '224 Coastal HWY', '455-896-7852'),
(62843, '108 Shady Tree Grove', '430-198-5478'),
(70252, '111 Binary Tree Lane', '212-373-5648'),
(85132, '81 Crystal Clear Grove', '877-456-1458');

-- --------------------------------------------------------

--
-- Table structure for table `stub info`
--

CREATE TABLE `stub info` (
  `STUB_ID` int(255) NOT NULL,
  `EMP_ID` int(255) NOT NULL,
  `STORE_ID` int(255) NOT NULL,
  `HRS_WORKED` int(11) NOT NULL,
  `PAY_RATE` decimal(10,4) NOT NULL,
  `TAX_RATE` decimal(10,4) NOT NULL,
  `TOTAL_EARNINGS` decimal(10,4) NOT NULL,
  `NET_PAY` decimal(10,4) NOT NULL,
  `PAY_FREQUENCY` varchar(255) NOT NULL,
  `PAY_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stub info`
--

INSERT INTO `stub info` (`STUB_ID`, `EMP_ID`, `STORE_ID`, `HRS_WORKED`, `PAY_RATE`, `TAX_RATE`, `TOTAL_EARNINGS`, `NET_PAY`, `PAY_FREQUENCY`, `PAY_DATE`) VALUES
(117713708, 4286012, 85132, 80, '15.5000', '0.0600', '1240.0000', '1165.6000', 'Bi-Weekly', '2018-11-09'),
(164531952, 2498763, 18456, 51, '35.3000', '0.0600', '1800.3000', '1692.2800', 'Bi-Weekly', '2018-08-16'),
(204881355, 2875020, 62843, 65, '45.7500', '0.0600', '2745.0000', '2580.3000', 'Bi-Weekly', '2019-01-24'),
(245467442, 3593817, 85132, 60, '15.5000', '0.0600', '930.0000', '874.2000', 'Bi-Weekly', '2018-08-22'),
(536378782, 2930124, 85132, 55, '50.4500', '0.0600', '2774.7500', '2608.2700', 'Bi-Weekly', '2019-03-07'),
(551895187, 6294422, 18456, 80, '50.0000', '0.0600', '4000.0000', '3760.0000', 'Bi-Weekly', '2019-02-14'),
(693037429, 3216894, 70252, 80, '25.0000', '0.0600', '2000.0000', '1880.0000', 'Bi-Weekly', '2019-02-07'),
(745896215, 1617385, 7878, 40, '10.5000', '0.0600', '420.0000', '394.8000', 'Bi-Weekly', '2018-08-01'),
(747366628, 5774896, 62843, 80, '50.0000', '0.0600', '4000.0000', '3760.0000', 'Bi-Weekly', '2018-10-10'),
(981219713, 4077358, 7878, 75, '40.0000', '0.0600', '3000.0000', '2820.0000', 'Bi-Weekly', '2019-01-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `EMP_ID` (`EMP_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Indexes for table `store info`
--
ALTER TABLE `store info`
  ADD PRIMARY KEY (`STORE_ID`);

--
-- Indexes for table `stub info`
--
ALTER TABLE `stub info`
  ADD PRIMARY KEY (`STUB_ID`),
  ADD KEY `EMP_ID` (`EMP_ID`),
  ADD KEY `STORE_ID` (`STORE_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`EMP_ID`) REFERENCES `employee` (`EMP_ID`);

--
-- Constraints for table `stub info`
--
ALTER TABLE `stub info`
  ADD CONSTRAINT `stub info_ibfk_1` FOREIGN KEY (`EMP_ID`) REFERENCES `employee` (`EMP_ID`),
  ADD CONSTRAINT `stub info_ibfk_2` FOREIGN KEY (`STORE_ID`) REFERENCES `store info` (`STORE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
