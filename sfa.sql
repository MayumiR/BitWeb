-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2020 at 05:25 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(6) NOT NULL,
  `StartTime` varchar(30) NOT NULL,
  `EndTime` varchar(30) NOT NULL,
  `Vehicle` varchar(50) DEFAULT NULL,
  `StartKM` double(20,10) NOT NULL,
  `EndKM` double(20,10) NOT NULL,
  `Distance` double(20,10) NOT NULL,
  `RepCode` varchar(50) DEFAULT NULL,
  `Driver` varchar(50) DEFAULT NULL,
  `Assist` varchar(30) DEFAULT NULL,
  `Mac` varchar(20) DEFAULT NULL,
  `Route` varchar(100) DEFAULT NULL,
  `txndate` varchar(20) DEFAULT NULL,
  `startLati` double(20,10) NOT NULL,
  `startLongi` double(20,10) NOT NULL,
  `endLati` double(20,10) NOT NULL,
  `endLongi` double(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cuscode` varchar(50) NOT NULL DEFAULT '',
  `cusname` varchar(100) NOT NULL DEFAULT '',
  `routecode` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `mobile` decimal(10,0) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cuscode`, `cusname`, `routecode`, `address`, `mobile`, `status`, `email`) VALUES
('C01452333', 'test1', 'asd', 'sadsdsdc', '1452333', 1, 'njnjn'),
('C0714477110', 'borella stores', 'b2 to b7', 'borella', '714477110', 1, 'abcd@gmail.com'),
('C1122334434', 'vvvvbbbb', 'r002', 'nnnnmmmm', '1122334434', 1, 'azxcsdf'),
('C1234564567', 'bnm', 'rt007', 'mmm', '123456789', 0, 'sdf@gmail.com'),
('C1452369870', 'Shashi', 'bb23', 'kirulapone', '1234567800', 1, 'abc@gmail.com'),
('C2001/0001', 'testcus3', 'b2 to b7', 'erÅ•r', '2356147856', 1, 'sd@gmail.com'),
('C2001/0002', 'testcys34', 'asd', 'morstuwa', '714523658', 1, 'cv@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dayexpdet`
--

CREATE TABLE `dayexpdet` (
  `RefNo` varchar(50) NOT NULL,
  `ExpCode` varchar(50) NOT NULL,
  `Amt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dayexpdet`
--

INSERT INTO `dayexpdet` (`RefNo`, `ExpCode`, `Amt`) VALUES
('E2001/0001', 'ex001', 345),
('E2001/0002', 'ex001', 4000),
('E2001/0003', 'ex002', 567),
('E2001/0004', 'ex001', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `dayexphed`
--

CREATE TABLE `dayexphed` (
  `RefNo` varchar(50) NOT NULL,
  `TxnDate` varchar(50) NOT NULL,
  `RepCode` varchar(50) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `Longitude` double(20,10) NOT NULL,
  `Latitude` double(20,10) NOT NULL,
  `TotalAmt` double(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dayexphed`
--

INSERT INTO `dayexphed` (`RefNo`, `TxnDate`, `RepCode`, `Remarks`, `Longitude`, `Latitude`, `TotalAmt`) VALUES
('E2001/0001', '', 'RS045', '', 79.9272665428, 6.8323868385, 345.0000000000),
('E2001/0002', '', 'RS045', 'testrmrk', 79.9272635399, 6.8323635708, 4000.0000000000),
('E2001/0003', '', 'RS045', 'ttttttt', 79.9272737399, 6.8323769133, 567.0000000000),
('E2001/0004', '2020-01-11', 'RS045', 'yyyy', 79.9272771321, 6.8323745382, 1500.0000000000);

-- --------------------------------------------------------

--
-- Table structure for table `daynprddet`
--

CREATE TABLE `daynprddet` (
  `RefNo` varchar(50) NOT NULL,
  `ReasonCode` varchar(50) NOT NULL,
  `Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daynprddet`
--

INSERT INTO `daynprddet` (`RefNo`, `ReasonCode`, `Reason`) VALUES
('N2001/0001', 'np002', 'stock available'),
('N2001/0002', 'np001', 'shop closed'),
('N2001/0003', 'np001', 'shop closed'),
('N2001/0003', 'np002', 'stock available');

-- --------------------------------------------------------

--
-- Table structure for table `daynprdhed`
--

CREATE TABLE `daynprdhed` (
  `RefNo` varchar(50) NOT NULL,
  `TxnDate` varchar(50) NOT NULL,
  `RepCode` varchar(50) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `AddDate` varchar(50) NOT NULL,
  `CusCode` varchar(50) NOT NULL,
  `Latitude` double(20,10) NOT NULL,
  `Longitude` double(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daynprdhed`
--

INSERT INTO `daynprdhed` (`RefNo`, `TxnDate`, `RepCode`, `Remarks`, `AddDate`, `CusCode`, `Latitude`, `Longitude`) VALUES
('N2001/0001', '2020-01-11', 'RS045', '', '2020-01-11', 'C1909/0001', 6.8323980340, 79.9273421640),
('N2001/0002', '2020-01-11', 'RS045', '', '2020-01-11', 'C01452333', 6.8323731099, 79.9272733568),
('N2001/0003', '2020-01-11', 'RS045', 'remwrh', '2020-01-11', 'C2001/0001', 6.8323447814, 79.9272587733);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemCode` varchar(50) NOT NULL DEFAULT '',
  `ItemName` varchar(100) NOT NULL DEFAULT '',
  `Status` int(1) NOT NULL DEFAULT '0',
  `UOM` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemCode`, `ItemName`, `Status`, `UOM`) VALUES
('Icaramelpdm', 'caramel pudim', 1, 'cup'),
('IIceF5', 'Faluda flavour small ice drink new', 1, 'packet'),
('Iitmnew', 'kiri peni ice cream cup ', 1, 'cup'),
('Itest', 'testremove', 0, 'cup'),
('IYgh01', 'Amashi Youghert', 1, 'cup'),
('Iyghkh001', 'youghert kithul hakuru', 1, 'cup');

-- --------------------------------------------------------

--
-- Table structure for table `itempri`
--

CREATE TABLE `itempri` (
  `ItemCode` varchar(50) NOT NULL DEFAULT '',
  `Price` decimal(50,0) NOT NULL DEFAULT '0',
  `ActiveStatus` varchar(50) NOT NULL DEFAULT '1',
  `allocatedDate` date NOT NULL DEFAULT '2020-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itempri`
--

INSERT INTO `itempri` (`ItemCode`, `Price`, `ActiveStatus`, `allocatedDate`) VALUES
('Icaramelpdm', '85', '1', '2020-01-07'),
('Iitmnew', '48', '1', '2020-01-07'),
('IYgh01', '34', '0', '2020-01-01'),
('IYgh01', '35', '0', '2020-01-02'),
('IYgh01', '36', '0', '2020-01-03'),
('IYgh01', '45', '1', '2020-01-07'),
('Iyghkh001', '65', '1', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `RefNo` varchar(50) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `Qty` int(10) NOT NULL,
  `Amount` decimal(20,0) NOT NULL,
  `Price` decimal(20,0) NOT NULL,
  `ItemName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`RefNo`, `ItemCode`, `Qty`, `Amount`, `Price`, `ItemName`) VALUES
('O2001/0001', 'IIceF5', 2, '130', '65', ''),
('O2001/0001', 'IYgh01', 3, '195', '65', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderheader`
--

CREATE TABLE `orderheader` (
  `RefNo` varchar(50) NOT NULL,
  `AddDate` varchar(50) NOT NULL,
  `CusCode` varchar(50) NOT NULL,
  `StartTime` varchar(50) NOT NULL,
  `EndTime` varchar(50) NOT NULL,
  `Longitude` double(20,10) NOT NULL DEFAULT '0.0000000000',
  `Latitude` double(20,10) NOT NULL DEFAULT '0.0000000000',
  `ManuRef` varchar(50) NOT NULL DEFAULT '',
  `Remark` varchar(100) NOT NULL DEFAULT '',
  `Repcode` varchar(50) NOT NULL,
  `TotAmt` decimal(20,0) NOT NULL,
  `TxnDate` varchar(50) NOT NULL,
  `DelDate` varchar(50) NOT NULL,
  `RouteCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderheader`
--

INSERT INTO `orderheader` (`RefNo`, `AddDate`, `CusCode`, `StartTime`, `EndTime`, `Longitude`, `Latitude`, `ManuRef`, `Remark`, `Repcode`, `TotAmt`, `TxnDate`, `DelDate`, `RouteCode`) VALUES
('O2001/0001', '2020-01-11', 'C01452333', '19:54:19', '19:54:38', 79.9272714262, 6.8324001922, '', '', 'RS045', '325', '2020-01-11', '', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `type` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`type`, `code`, `name`, `status`) VALUES
('ex', 'ex001', 'Fuel charges', 1),
('ex', 'ex002', 'lunch expense', 1),
('Exp', 'ex3456', 'test expense', 1),
('Exp', 'exhuiu', 'hgh h', 0),
('Exp', 'extest56', 'stationary', 1),
('np', 'np001', 'shop closed', 1),
('np', 'np002', 'stock available', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `repCode` varchar(50) NOT NULL DEFAULT '',
  `settingCode` varchar(50) NOT NULL DEFAULT '',
  `nNumVal` int(10) NOT NULL DEFAULT '0',
  `nMonth` int(10) NOT NULL DEFAULT '0',
  `nYear` int(10) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`repCode`, `settingCode`, `nNumVal`, `nMonth`, `nYear`, `id`) VALUES
('RS045', 'SFAORDER', 2, 1, 2020, 1),
('RS045', 'EXPENCE', 5, 1, 2020, 2),
('RS045', 'NEWCUS', 3, 1, 2020, 3),
('RS045', 'NONPRD', 2, 1, 2020, 4);

-- --------------------------------------------------------

--
-- Table structure for table `refsetting`
--

CREATE TABLE `refsetting` (
  `settingCode` varchar(50) NOT NULL DEFAULT '',
  `charVal` char(1) NOT NULL DEFAULT '',
  `remarks` varchar(100) NOT NULL DEFAULT '',
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refsetting`
--

INSERT INTO `refsetting` (`settingCode`, `charVal`, `remarks`, `id`) VALUES
('EXPENCE', 'E', 'expence entry', NULL),
('NEWCUS', 'C', 'new customer entry', NULL),
('NONPRD', 'N', 'nonproductive entry', NULL),
('SFAORDER', 'O', 'sales order', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `routecode` varchar(50) NOT NULL DEFAULT '',
  `routename` varchar(100) NOT NULL DEFAULT '',
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`routecode`, `routename`, `status`) VALUES
('asd', 'Rmoratuwa to katubedda', 1),
('b2 to b7', 'Rboralesgamuwa to borella', 1),
('bb23', 'galle to colombo', 1),
('r001', 'Maharagama - dehiwala', 1),
('r002', 'maharagama-kottawa', 0),
('rt007', 'maharagama to homagama', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_rep`
--

CREATE TABLE `route_rep` (
  `repcode` varchar(100) NOT NULL,
  `routecode` varchar(100) NOT NULL,
  `assignedDate` date NOT NULL DEFAULT '2020-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_rep`
--

INSERT INTO `route_rep` (`repcode`, `routecode`, `assignedDate`) VALUES
('cv1122334455', 'asd', '2020-01-01'),
('cv1122334455', 'bb23', '2020-01-01'),
('ed0712345456', 'asd', '2020-01-01'),
('fg1111111133', 'r001', '2020-01-01'),
('MA0778965452', 'rt007', '2020-01-01'),
('RS045', 'asd', '2020-01-01'),
('RS045', 'b2 to b7', '2020-01-01'),
('sm0112233654', 'r001', '2020-01-08'),
('sm0714455645', 'bb23', '2020-01-08'),
('vb0718456522', 'r002', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Name` varchar(50) NOT NULL DEFAULT '',
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL DEFAULT '',
  `MacId` varchar(50) NOT NULL DEFAULT '',
  `Mobile` decimal(10,0) NOT NULL DEFAULT '0',
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Status` int(1) NOT NULL DEFAULT '1',
  `Code` varchar(50) NOT NULL DEFAULT '',
  `Target` decimal(50,0) NOT NULL DEFAULT '0',
  `Prefix` char(2) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Name`, `UserName`, `Password`, `MacId`, `Mobile`, `Address`, `Status`, `Code`, `Target`, `Prefix`) VALUES
('admin', 'admin', '202cb962ac59075b964b07152d234b70', '', '114562852', '', 1, '', '0', ''),
('usertest', 'root', '81dc9bdb52d04dc20036dbd8313ed055', '', '714875456', 'galle', 1, 'al0714875456', '10000', 'al'),
('testuser', 'root', '81dc9bdb52d04dc20036dbd8313ed055', '', '1234565203', 'test address', 1, 'jh1234565203', '10000', 'jh'),
('llllkkk', 'mayumi', '202cb962ac59075b964b07152d234b70', '85:55:A5:F1:E6:0C', '2147483647', 'opopop', 1, 'MA0778965452', '10000', 'MA'),
('rashmi', 'Rash', '202cb962ac59075b964b07152d234b70', '8455A5F1E60C', '114455663', 'maharagama', 1, 'RS045', '0', 'MR'),
('shashi', 'mash', '81dc9bdb52d04dc20036dbd8313ed055', '8465A5F1E60C', '112233654', '1234,galle', 1, 'sm0112233654', '10000', 'sm'),
('shashi', 'mash', '81dc9bdb52d04dc20036dbd8313ed055', '', '712233445', 'galle', 1, 'sm0712233445', '10000', 'sm'),
('shashi', 'mash', 'fc4ddc15f9f4b4b06ef7844d6bb53abf', '', '714455645', 'galle', 0, 'sm0714455645', '10000', 'sm'),
('kaveesha', 'test', '202cb962ac59075b964b07152d234b70', '', '718456522', 'test1', 1, 'vb0718456522', '10000', 'vb'),
('testuser22', 'root', '81dc9bdb52d04dc20036dbd8313ed055', '', '2147483647', 'sdsdasasxc', 0, 'wd4578968547', '10000', 'wd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cuscode`);

--
-- Indexes for table `dayexpdet`
--
ALTER TABLE `dayexpdet`
  ADD PRIMARY KEY (`RefNo`,`ExpCode`);

--
-- Indexes for table `dayexphed`
--
ALTER TABLE `dayexphed`
  ADD PRIMARY KEY (`RefNo`);

--
-- Indexes for table `daynprddet`
--
ALTER TABLE `daynprddet`
  ADD PRIMARY KEY (`RefNo`,`ReasonCode`);

--
-- Indexes for table `daynprdhed`
--
ALTER TABLE `daynprdhed`
  ADD PRIMARY KEY (`RefNo`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemCode`);

--
-- Indexes for table `itempri`
--
ALTER TABLE `itempri`
  ADD PRIMARY KEY (`ItemCode`,`Price`,`ActiveStatus`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`RefNo`,`ItemCode`);

--
-- Indexes for table `orderheader`
--
ALTER TABLE `orderheader`
  ADD PRIMARY KEY (`RefNo`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refsetting`
--
ALTER TABLE `refsetting`
  ADD PRIMARY KEY (`settingCode`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`routecode`);

--
-- Indexes for table `route_rep`
--
ALTER TABLE `route_rep`
  ADD PRIMARY KEY (`repcode`,`routecode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
