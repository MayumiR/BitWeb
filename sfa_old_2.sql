-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2019 at 04:38 AM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cuscode` varchar(50) NOT NULL DEFAULT '',
  `cusname` varchar(100) NOT NULL DEFAULT '',
  `routecode` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `mobile` int(10) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cuscode`, `cusname`, `routecode`, `address`, `mobile`, `status`, `email`) VALUES
('C01452333', 'test1', 'asd', 'sadsdsdc', 1452333, 1, 'njnjn'),
('C1122334434', 'vvvvbbbb', 'r002', 'nnnnmmmm', 1122334434, 1, 'azxcsdf'),
('C1234564567', 'cccc', 'rt007', 'ccccc', 1234564567, 1, 'sdf@gmail.com'),
('C1234567890', 'vv', 'b2 to b7', 'vvv', 1234567890, 1, 'ddfvvv'),
('C1909/0001', 'test', 'asd', 'fgb', 71425869, 1, 'abcd@gmail.com'),
('C1909/0002', 'vg', 'asd', 'vv', 714253685, 1, 'abcd@gmail.com'),
('C3442323234', 'ddd', 'b2 to b7', 'dddd', 2147483647, 1, 'dff');

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
('E1909/0001', 'ex001', 567);

-- --------------------------------------------------------

--
-- Table structure for table `dayexphed`
--

CREATE TABLE `dayexphed` (
  `RefNo` varchar(50) NOT NULL,
  `TxnDate` varchar(50) NOT NULL,
  `RepCode` varchar(50) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `Longitude` double NOT NULL,
  `Latitude` double NOT NULL,
  `TotalAmt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dayexphed`
--

INSERT INTO `dayexphed` (`RefNo`, `TxnDate`, `RepCode`, `Remarks`, `Longitude`, `Latitude`, `TotalAmt`) VALUES
('E1909/0001', '', 'RS045', '', 0, 0, 567);

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
('N1909/0001', 'np001', 'shop closed'),
('N1912/0001', 'np002', 'stock available');

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
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daynprdhed`
--

INSERT INTO `daynprdhed` (`RefNo`, `TxnDate`, `RepCode`, `Remarks`, `AddDate`, `CusCode`, `Latitude`, `Longitude`) VALUES
('N1908/0001', '', 'RS045', '', '2019-08-31', 'C01452333', 0, 0),
('N1909/0001', '2019-09-01', 'RS045', '', '2019-09-01', 'C01452333', 0, 0),
('N1912/0001', '2019-12-24', 'RS045', '', '2019-12-24', 'C01452333', 0, 0);

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
('IIceF5', 'Faluda flavour small ice drink', 1, 'packet'),
('IYgh01', 'Amashi Youghert', 1, 'cup');

-- --------------------------------------------------------

--
-- Table structure for table `itempri`
--

CREATE TABLE `itempri` (
  `ItemCode` varchar(50) NOT NULL DEFAULT '',
  `Price` decimal(50,0) NOT NULL DEFAULT '0',
  `ActiveStatus` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itempri`
--

INSERT INTO `itempri` (`ItemCode`, `Price`, `ActiveStatus`) VALUES
('IIIceF5', '5', '1');

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
('O1909/0001', 'IIceF5', 5, '25', '5', ''),
('O1909/0001', 'IYgh01', 2, '10', '5', ''),
('O1910/0001', 'IIceF5', 5, '25', '5', ''),
('O1910/0001', 'IYgh01', 2, '10', '5', ''),
('O1912/0001', 'IIceF5', 2, '10', '5', ''),
('O1912/0001', 'IYgh01', 2, '10', '5', ''),
('O1912/0002', 'IIceF5', 5, '25', '5', ''),
('O1912/0002', 'IYgh01', 6, '30', '5', ''),
('O1912/0010', 'IIceF5', 17, '85', '5', ''),
('O1912/0010', 'IYgh01', 3, '15', '5', ''),
('O1912/0011', 'IIceF5', 3, '15', '5', ''),
('O1912/0011', 'IYgh01', 4, '20', '5', ''),
('O1912/0012', 'IIceF5', 68, '340', '5', '');

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
  `Longitude` decimal(20,0) NOT NULL DEFAULT '0',
  `Latitude` decimal(20,0) NOT NULL DEFAULT '0',
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
('O1909/0001', '2019-09-01', 'C01452333', '14:05:18', '14:05:52', '0', '0', '', '', 'RS045', '35', '2019-09-01', '', ''),
('O1910/0001', '2019-10-28', 'C01452333', '19:59:39', '20:00:21', '0', '0', '', '', 'RS045', '35', '2019-10-28', '', ''),
('O1912/0001', '2019-12-23', 'C01452333', '10:56:14', '10:56:31', '0', '0', '', '', 'RS045', '20', '2019-12-23', '', ''),
('O1912/0002', '2019-12-24', 'C1909/0001', '12:08:29', '12:09:26', '0', '0', '', '', 'RS045', '55', '2019-12-24', '', ''),
('O1912/0010', '2019-12-24', 'C1909/0001', '15:22:44', '15:23:01', '0', '0', '', '', 'RS045', '100', '2019-12-24', '', 'abcd@gmail.com'),
('O1912/0011', '2019-12-24', 'C3442323234', '15:25:58', '15:26:08', '0', '0', '', '', 'RS045', '35', '2019-12-24', '', 'dff'),
('O1912/0012', '2019-12-24', 'C1234567890', '15:58:24', '15:58:36', '0', '0', '', '', 'RS045', '340', '2019-12-24', '', 'b2 to b7');

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
('Exp', 'ex3456', 'dcvfgb', 1),
('Exp', 'exhuiu', 'hgh h', 1),
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
('rs045', 'SFAORDER', 12, 9, 2019, 1),
('rs045', 'EXPENCE', 0, 9, 2019, 2);

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
('asd', 'a1 to a2', 1),
('b2 to b7', 'Rboralesgamuwa to borella', 1),
('bb23', 'galle to colombo', 1),
('r001', 'Maharagama - dehiwala', 1),
('r002', 'maharagama-kottawa', 1),
('rt007', 'maharagama to homagama', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_rep`
--

CREATE TABLE `route_rep` (
  `repcode` varchar(100) NOT NULL,
  `routecode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_rep`
--

INSERT INTO `route_rep` (`repcode`, `routecode`) VALUES
('cv1122334455', 'asd'),
('ed0712345456', 'asd'),
('RS045', 'asd'),
('RS045', 'b2 to b7');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Name` varchar(50) NOT NULL DEFAULT '',
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL DEFAULT '',
  `MacId` varchar(50) NOT NULL DEFAULT '',
  `Mobile` int(10) NOT NULL DEFAULT '0',
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
('admin', 'admin', '202cb962ac59075b964b07152d234b70', '', 0, '', 1, '', '0', ''),
('aaaa', 'aa', '74b87337454200d4d33f80c4663dc5e5', '', 1122334455, 'aaaa', 1, 'cv1122334455', '10000', 'cv'),
('ss', 'ss', '9f6e6800cfae7749eb6c486619254b9c', '', 712345456, 'sss', 1, 'ed0712345456', '10000', 'ed'),
('sssssssss', 'root', '81dc9bdb52d04dc20036dbd8313ed055', '', 1111111133, 'aaa', 1, 'fg1111111133', '10000', 'fg'),
('Mayumi', 'mayumi', '202cb962ac59075b964b07152d234b70', '', 778965452, 'test', 1, 'MA0778965452', '10000', 'MA'),
('Rashmi W.G.M', 'Rash', '202cb962ac59075b964b07152d234b70', '8455A5F1E60C', 0, '', 1, 'RS045', '0', 'MR'),
('kaveesha', 'test', '202cb962ac59075b964b07152d234b70', '', 718456522, 'test1', 1, 'vb0718456522', '10000', 'vb');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
