-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2017 at 11:35 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inter-africa`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `userID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `cellNumber` int(12) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userLevel` int(10) NOT NULL,
  `depot` varchar(20) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`userID`, `name`, `surname`, `username`, `cellNumber`, `email`, `userLevel`, `depot`, `password`, `timeStamp`) VALUES
(1, 'tanaka', 'dziruni', 'tana', 778787969, 'shingie@gmail.com', 1, NULL, '12345', '2017-06-20 11:05:53'),
(2, 'shingie', 'dziruni', 'cdziruni', 776786971, 'shingiedziruni@gmail.com', 3, NULL, '12345', '2017-06-20 11:10:21'),
(4, 'charles', 'Dziruni', 'dzudzu', 776786971, 'shingie@gmail.com', 3, 'Admin', '12345', '2017-06-20 12:47:54'),
(6, 'musarira', 'chibaa', 'musa', 44755789, 'musa@g.com', 1, 'Harare', '12345', '2017-06-20 14:04:36'),
(7, 'diego', 'dikaz', 'diego', 78787879, 'diego@gmail.com', 1, 'Admin', '12345', '2017-06-20 14:30:22'),
(8, 'tanaka', 'inter', 'tanaka', 11221122, 'sghfg@gmail.com', 1, 'Bulawayo', '12345', '2017-06-20 14:47:26'),
(10, 'shingi', 'dziruni', 'shingi', 776786971, 'shingie@gmail.com', 2, 'Bulawayo', '12345', '2017-06-24 23:42:51'),
(11, 'tanaka', 'chib', 'tanatana', 733589963, 'tyu@hotmail.com', 1, 'Harare', '12345', '2017-06-24 23:46:59'),
(12, 'codza', 'dziruni', 'colleen', 718956874, 'colleen@gmail.com', 3, 'Bulawayo', '12345', '2017-06-25 07:31:53'),
(13, 'panashe', 'kanengoni', 'panashe', 779807988, 'colleen@gmail.com', 2, 'Masvingo', '12345', '2017-06-25 07:35:22'),
(14, 'panashe', 'kanengoni', 'panashe1', 779807988, 'colleen@gmail.com', 2, 'Masvingo', '12345', '2017-06-25 07:37:41'),
(19, 'Shelton', 'Mukumba', 'shellaz', 779789641, 'shellaz@gmai.com', 3, 'Harare', '$2y$10$XP7CNl9OH27jSA6MqATfNuZSzM9Xkmr9A78ZGNANrhVav7/s5o/AG', '2017-06-26 10:54:07'),
(20, 'Kim', 'CCb', 'Hakak', 454448, 'hsosoa@gmail.com', 2, 'Masvingo', '12345', '2017-06-26 13:14:58'),
(22, 'diego', 'inter', 'diedoo', 78956932, 'shigo@hotmail.com', 3, 'Bulawayo', '12345', '2017-06-27 10:37:53'),
(25, 'masvingo', 'dail', 'masvingo', 1438882, 'masvingo@interafrica.co.zw', 1, 'Masvingo', '$2y$10$n4dulYcvFzibruG4q80gMuwQ/VJjYyweKENsQ8GAJO/ul.25bp4SC', '2017-06-28 13:51:33'),
(26, 'bulawayo', 'blues', 'bulawayo', 12345, 'bulaway0@interafrica.co.zw', 1, 'Bulawayo', '$2y$10$otm/AT8hazLTEq2Ehr2c5ea9L5E0GjLJyXnUshp/KNkSomm7szpUi', '2017-06-28 13:53:39'),
(28, 'Musaririri', 'ADAM', 'musariri', 775897633, 'musa@gmail.com', 1, 'Harare', '$2y$10$glhBqeYvOiPv4/ZXluy1Te5dRfTyC.iyrfSHsDfqwMl375dl.juRq', '2017-07-01 10:43:48'),
(29, 'Kokoko', 'Dzdz', 'dzdz', 1447856, 'koko@dgdd.com', 2, 'Masvingo', '$2y$10$Y.ECITvLqp3C.av8gdq1yOY9dT.NQ4oDU.cJvqDPfuw/yRvcPK0lm', '2017-07-02 22:31:08'),
(30, 'shingirai', 'dziruni', 'shingirai', 776786971, 'shingiedziruni@mrcdziruni.tech', 1, 'Harare', '$2y$10$sT7yzVt2Zm1YL3fPIo713eqU9Mdk5cKod1tL/thF.AcR/DbSPw6xO', '2017-07-05 16:24:28'),
(31, 'shs', 'texthshs', 'shs', 0, '', 0, NULL, '', '2017-07-05 17:29:52'),
(32, 'shingi', 'ingvhgahbjhakbhan', 'shingi', 0, '', 0, NULL, '', '2017-07-05 17:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `bulawayo`
--

CREATE TABLE `bulawayo` (
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RegNumber` varchar(200) NOT NULL,
  `DriverName` varchar(200) NOT NULL,
  `Route` varchar(200) NOT NULL,
  `Cash` int(200) NOT NULL,
  `Diesel` int(200) NOT NULL,
  `Expenses` int(200) NOT NULL,
  `NetCash` int(200) NOT NULL,
  `Auditor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulawayo`
--

INSERT INTO `bulawayo` (`Time`, `RegNumber`, `DriverName`, `Route`, `Cash`, `Diesel`, `Expenses`, `NetCash`, `Auditor`) VALUES
('2017-07-02 20:14:40', 'AEA 3434', 'Majaji', 'Bulawa-Harare', 897, 500, 123, 375, 'Shingi'),
('2017-07-02 20:14:53', 'AEA 3434', 'Majaji', 'Bulawa-Harare', 897, 500, 123, 375, 'Shingi');

-- --------------------------------------------------------

--
-- Table structure for table `bulawayo_diesel`
--

CREATE TABLE `bulawayo_diesel` (
  `receiptID` int(11) NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Diesel` int(20) NOT NULL,
  `Supplier` varchar(200) NOT NULL,
  `Vehicle` varchar(200) NOT NULL,
  `Trailer` varchar(200) NOT NULL,
  `DeliverNote` int(200) NOT NULL,
  `MeterStart` int(200) NOT NULL,
  `MeterEnd` int(200) NOT NULL,
  `AvailableDiesel` int(200) NOT NULL,
  `ReceivedBy` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `harare`
--

CREATE TABLE `harare` (
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `RegNumber` varchar(7) NOT NULL,
  `DriverName` varchar(20) NOT NULL,
  `Route` varchar(200) NOT NULL,
  `Cash` int(200) NOT NULL,
  `Diesel` int(200) NOT NULL,
  `Expenses` int(200) NOT NULL,
  `NetCash` int(11) NOT NULL,
  `auditor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harare`
--

INSERT INTO `harare` (`Time`, `RegNumber`, `DriverName`, `Route`, `Cash`, `Diesel`, `Expenses`, `NetCash`, `auditor`) VALUES
('2017-06-14 18:38:13', 'adc 232', 'Lucky', 'radio', 200, 100, 18, 0, ''),
('2017-06-14 18:39:03', 'ADC 232', 'Chibaba', 'radio', 700, 300, 450, 0, ''),
('2017-06-14 18:40:11', 'ADM 400', 'Shingi', 'radio', 1200, 400, 20, 0, ''),
('2017-06-14 18:40:59', 'ACZ 454', 'Mudhara', 'radio', 4990, 400, 7, 0, ''),
('2017-06-14 18:50:56', 'ADC 707', 'Majaji', 'radio', 870, 320, 25, 0, ''),
('2017-06-14 18:52:55', 'ADV 234', 'Tinashe', 'radio', 1005, 420, 51, 0, ''),
('2017-06-14 18:55:05', 'ADZ 907', 'Tafadzwa', 'radio', 800, 300, 71, 0, ''),
('2017-06-14 18:56:53', 'ADZ 907', 'The General', 'radio', 710, 312, 50, 0, ''),
('2017-06-14 18:57:29', 'ADZ 907', 'Rasta', 'radio', 410, 200, 23, 0, ''),
('2017-06-14 19:02:15', 'ACZ 787', 'Major', 'radio', 1600, 400, 28, 0, ''),
('2017-06-14 19:05:45', 'ADZ 907', 'Webstar', 'radio', 1200, 400, 33, 0, ''),
('2017-06-14 19:09:18', 'ADZ 907', 'Rasta', 'Y', 1222, 321, 12, 0, ''),
('2017-06-14 19:11:00', 'ADZ 907', 'Chibaba', 'radio', 1222, 222, 22, 0, ''),
('2017-06-14 20:52:33', 'ADZ 324', 'aaa', 'radio', 1500, 200, 20, 0, ''),
('2017-06-15 10:08:42', 'adz 909', 'lucky', 'Harare-Nyanga', 2000, 114, 23, 0, ''),
('2017-06-15 10:10:58', 'AAA 454', 'Shing', 'Harare-Chipinge', 1200, 500, 45, 0, ''),
('2017-06-15 10:31:48', 'ABZ 009', 'Dzudzu', 'Harare-Chiredzi', 400, 150, 20, 0, ''),
('2017-06-15 10:34:24', 'ADZ 121', 'Dziruni', 'Harare-Mutare', 2000, 500, 78, 0, ''),
('2017-06-15 11:22:16', 'ADC 546', 'Higer', 'Harare-Kariba', 200, 300, 27, 0, ''),
('2017-06-15 11:50:52', 'ADZ 565', 'DZFDXX', 'Harare-Bulawayo', 679, 100, 22, 0, ''),
('2017-06-20 06:42:10', 'adz 123', 'adad', 'Harare-Bulawayo', 12, 12, 455, 0, ''),
('2017-06-20 09:45:05', 'jj', 'ggv', 'Harare-Mutare', 1115, 24, 45, 0, ''),
('2017-06-21 20:12:29', 'dd', 'se', 'Harare-Bulawayo', 21, 344, 12, 0, ''),
('2017-06-21 20:28:09', 'aab 234', 'Chibaba', 'Harare-Bulawayo', 23, 12, 1, 11, ''),
('2017-06-21 20:36:28', 'ADC 233', 'Lucky', 'Harare-Mutare', 400, 50, 50, 300, ''),
('2017-06-21 20:51:05', 'ADQ 232', 'Shingi', 'Harare-Mutare', 800, 220, 50, 530, ''),
('2017-06-21 20:52:17', 'ADG 878', 'Shingi', 'Harare-Kariba', 900, 400, 20, 480, ''),
('2017-06-21 20:53:54', 'aqr 454', 'Tafadzwa', 'Harare-Mutare', 3433, 123, 21, 3289, ''),
('2017-06-22 21:10:13', 'ABC 107', 'Kodza Kodza ', 'Harare-Mutare', 700, 350, 97, 0, 'Shingi'),
('2017-06-22 21:20:21', 'ABQ 454', 'Dziruni', 'Masvingo-Chiredzi', 851, 370, 121, 360, 'Tanaka'),
('2017-06-22 21:24:36', 'ACZ 676', 'The General', 'Harare-Chiredzi', 930, 440, 120, 370, 'Musa'),
('2017-06-24 15:36:58', 'hhh', 'ght', 'Harare-Chiredzi', 2000, 500, 400, 1100, 'musa');

-- --------------------------------------------------------

--
-- Table structure for table `harare_diesel`
--

CREATE TABLE `harare_diesel` (
  `receiptID` int(11) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DieselReceived` int(200) NOT NULL,
  `Supplier` varchar(200) NOT NULL,
  `Vehicle` varchar(200) NOT NULL,
  `Trailer` varchar(200) NOT NULL,
  `DeliverNote` int(200) NOT NULL,
  `MeterReadingInitial` int(11) NOT NULL,
  `MeterdingAfter` int(11) NOT NULL,
  `AvailableDiesel` int(11) NOT NULL,
  `ReceivedBy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harare_diesel`
--

INSERT INTO `harare_diesel` (`receiptID`, `TimeStamp`, `DieselReceived`, `Supplier`, `Vehicle`, `Trailer`, `DeliverNote`, `MeterReadingInitial`, `MeterdingAfter`, `AvailableDiesel`, `ReceivedBy`) VALUES
(1, '2017-07-06 07:59:38', 20000, 'Glow Petroleum', 'ADZ 4563', 'ABC 5426', 458888, 2245120, 3230, 0, 'Shingie'),
(2, '2017-07-06 08:15:13', 36000, 'NOCZIM', 'AAD 7575', 'ADE 2321', 5522, 9852222, 5121, 0, 'Shingi'),
(3, '2017-07-06 09:02:00', 25000, 'Zuva Petroleum', 'ADZ 6767', 'ADE 2321', 343234, 2321, 555555555, 25000, 'Shingi'),
(4, '2017-07-06 09:06:07', 23000, 'BJ Petroleum', 'ADZ 6767', 'ADE 2321', 4552, 4252222, 2147483647, 23000, 'Diego'),
(5, '2017-07-06 09:07:47', 23000, 'BJ Petroleum', 'AAD 7575', 'ADE 2321', 452566, 2552, 4235, 23000, 'Shingi'),
(6, '2017-07-07 11:34:13', 234445, 'Glow Petroleum', 'ADZ 6767', 'ADE 2321', 35000, 234444, 1222222, 234445, 'Tich');

-- --------------------------------------------------------

--
-- Table structure for table `masvingo`
--

CREATE TABLE `masvingo` (
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RegNumber` varchar(200) NOT NULL,
  `DriverName` varchar(200) NOT NULL,
  `Route` varchar(200) NOT NULL,
  `Cash` int(200) NOT NULL,
  `Diesel` int(200) NOT NULL,
  `Expenses` int(200) NOT NULL,
  `NetCash` int(200) NOT NULL,
  `Auditor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masvingo`
--

INSERT INTO `masvingo` (`Time`, `RegNumber`, `DriverName`, `Route`, `Cash`, `Diesel`, `Expenses`, `NetCash`, `Auditor`) VALUES
('2017-06-24 15:21:36', 'ADR 4343', 'Musa', 'Masvingo Harare', 1200, 500, 120, 0, 'Kimaldo'),
('2017-06-24 15:41:08', 'ADZ 6726', 'Musa', 'Masvingo-Chiredzi', 800, 500, 100, 0, ''),
('2017-06-25 05:50:47', 'ADQ 6543', 'Lucky', 'Masvingo-Chiredzi', 897, 200, 100, 0, 'Kim Chong Li'),
('2017-06-25 05:56:12', 'JJBJB', 'GTGH', 'Masvingo-Mutare', 800, 450, 100, 0, 'Diego'),
('2017-06-28 12:11:30', 'ADZ589', 'Majaji', 'Masvingo-Chiredzi', 897, 51, 600, 200, 'kim'),
('2017-07-07 10:52:08', 'ADZ 9087', 'Lucky', 'Masvingo-Chiredzi', 700, 400, 300, 0, 'Shingie'),
('2017-07-07 19:48:16', 'ADC 8123', 'Diva', 'Masvingo-Bulawayo', 1200, 500, 2333, 700, 'Shingi');

-- --------------------------------------------------------

--
-- Table structure for table `masvingo_diesel`
--

CREATE TABLE `masvingo_diesel` (
  `receiptID` int(11) NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Diesel` int(20) NOT NULL,
  `Supplier` varchar(200) NOT NULL,
  `Vehicle` varchar(200) NOT NULL,
  `Trailer` varchar(200) NOT NULL,
  `DeliverNote` int(200) NOT NULL,
  `MeterStart` int(200) NOT NULL,
  `MeterEnd` int(200) NOT NULL,
  `AvailableDiesel` int(200) NOT NULL,
  `ReceivedBy` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mutare`
--

CREATE TABLE `mutare` (
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RegNumber` varchar(200) NOT NULL,
  `DriverName` varchar(200) NOT NULL,
  `Route` varchar(200) NOT NULL,
  `Cash` int(200) NOT NULL,
  `Diesel` int(200) NOT NULL,
  `Expenses` int(200) NOT NULL,
  `NetCash` int(200) NOT NULL,
  `auditor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutare`
--

INSERT INTO `mutare` (`Time`, `RegNumber`, `DriverName`, `Route`, `Cash`, `Diesel`, `Expenses`, `NetCash`, `auditor`) VALUES
('2017-06-28 04:23:58', 'awq 7676', 'Lukcy', 'Mutare-Harare', 1200, 200, 500, 500, ''),
('2017-06-28 11:23:53', 'ADZ 4566', 'Shiri', 'Mutare-Harare', 890, 100, 411, 400, 'Shingi'),
('2017-07-07 19:59:45', 'ADZ 4543', 'Nyoni', 'Mutare-Chimoio', 788, 150, 233, 231, 'Kim');

-- --------------------------------------------------------

--
-- Table structure for table `mutare_diesel`
--

CREATE TABLE `mutare_diesel` (
  `receiptID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DieselReceived` int(200) NOT NULL,
  `Supplier` varchar(200) NOT NULL,
  `Vehicle` varchar(200) NOT NULL,
  `Trailer` varchar(200) NOT NULL,
  `MeterBefore` int(200) NOT NULL,
  `MeterAfter` int(200) NOT NULL,
  `AvailableDiesel` int(200) NOT NULL,
  `ReceivedBy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `bulawayo_diesel`
--
ALTER TABLE `bulawayo_diesel`
  ADD PRIMARY KEY (`receiptID`);

--
-- Indexes for table `harare_diesel`
--
ALTER TABLE `harare_diesel`
  ADD PRIMARY KEY (`receiptID`);

--
-- Indexes for table `masvingo_diesel`
--
ALTER TABLE `masvingo_diesel`
  ADD PRIMARY KEY (`receiptID`);

--
-- Indexes for table `mutare_diesel`
--
ALTER TABLE `mutare_diesel`
  ADD PRIMARY KEY (`receiptID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `bulawayo_diesel`
--
ALTER TABLE `bulawayo_diesel`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `harare_diesel`
--
ALTER TABLE `harare_diesel`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `masvingo_diesel`
--
ALTER TABLE `masvingo_diesel`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mutare_diesel`
--
ALTER TABLE `mutare_diesel`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
