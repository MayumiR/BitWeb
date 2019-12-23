-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 05:56 PM
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
('C0778965845', 'Mayumi', 'ex45', 'Mapalagama', 778965845, 1, 'hmdaa@hh.ll'),
('C33333', 'eee', 'bb23', 'ddd', 33333, 1, ''),
('C3456', 'ddd', '234', 'werffdd', 3456, 1, 'test@gmail.com'),
('C4567', 'ee', 'bb23', 'fff', 4567, 1, ''),
('C55555', 'aaaa', 'kl123', 'sssssss', 55555, 1, 'asd@gmail.com'),
('cus001', 'mayumi', 'r001', 'wattahena', 711111111, 0, 'mayu@gmail.com'),
('cus002', 'shashika', 'r002', 'horangalle', 714444444, 0, 'shashi@gmail.com'),
('cus098', 'test', 'r001', 'gh', 0, 0, 'bh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemCode` varchar(50) NOT NULL DEFAULT '',
  `ItemName` varchar(100) NOT NULL DEFAULT '',
  `Status` int(1) NOT NULL DEFAULT '0',
  `PriceLvlCode` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemCode`, `ItemName`, `Status`, `PriceLvlCode`, `id`) VALUES
('Ygh01', 'Amashi Youghert', 0, 'pri001', 1),
('IceF5', 'Faluda flavour small ice drink', 0, 'pri002', 2),
('IceC5', 'Chocalate flavour small ice drink', 0, 'pri003', 3),
('PdmBG', 'Broken Glass Pudim', 0, 'pri004', 4),
('IceC10', 'Chocalate flavour medium ice drink', 0, 'pri005', 5);

-- --------------------------------------------------------

--
-- Table structure for table `itempri`
--

CREATE TABLE `itempri` (
  `ItemCode` varchar(50) NOT NULL DEFAULT '',
  `Price` decimal(50,0) NOT NULL DEFAULT '0',
  `PriceLvlCode` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itempri`
--

INSERT INTO `itempri` (`ItemCode`, `Price`, `PriceLvlCode`, `id`) VALUES
('Ygh01', '30', 'pri001', NULL),
('Ygh01', '25', 'pri001OLD', NULL),
('IceF5', '5', 'pri002', NULL),
('IceC5', '5', 'pri003', NULL),
('PdmBG', '50', 'pri004', NULL),
('IceC10', '10', 'pri005', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `RefNo` varchar(50) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `Qty` int(10) NOT NULL,
  `Amount` decimal(20,0) NOT NULL,
  `Price` decimal(20,0) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `PrilCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `RefNo`, `ItemCode`, `Qty`, `Amount`, `Price`, `ItemName`, `PrilCode`) VALUES
(1, 's1903/0001', 'IceC10', 25, '625', '25', '', '25'),
(2, 's1904/0001', 'IceC10', 3, '9', '3', '', '3'),
(3, 's1904/0002', 'IceC10', 6, '36', '6', '', '6'),
(4, 's1904/0003', 'IceC10', 2, '4', '2', '', '2'),
(5, 's1904/0004', 'IceC10', 2, '4', '2', '', '2'),
(6, 's1904/0004', 'IceC5', 2, '4', '2', '', '2'),
(7, 's1904/0005', 'IceC10', 3, '9', '3', '', '3'),
(8, 's1904/0006', 'IceF5', 1, '1', '1', '', '1'),
(9, 's1904/0006', 'PdmBG', 2, '4', '2', '', '2'),
(10, 's1904/0007', 'IceF5', 5, '25', '5', '', '5'),
(11, 's1904/0008', 'IceF5', 3, '9', '3', '', '3'),
(12, 's1904/0009', 'IceC10', 2, '4', '2', '', '2'),
(13, 's1904/0009', 'IceC5', 2, '4', '2', '', '2'),
(14, 's1904/0010', 'IceC10', 3, '9', '3', '', '3'),
(15, 's1904/0010', 'IceC5', 1, '1', '1', '', '1'),
(16, 's1904/0011', 'IceC10', 2, '4', '2', '', '2'),
(17, 's1904/0011', 'IceC5', 1, '1', '1', '', '1'),
(18, 's1904/0012', 'IceF5', 4, '16', '4', '', '4'),
(19, 's1904/0014', 'IceC10', 7, '49', '7', '', '7'),
(20, 's1905/0002', 'IceC10', 2, '4', '2', '', '2'),
(21, 's1905/0002', 'IceC5', 3, '9', '3', '', '3'),
(22, 's1906/0001', 'IceC10', 2, '4', '2', '', '2'),
(23, 's1906/0001', 'IceC5', 2, '4', '2', '', '2'),
(24, 's1906/0002', 'IceC10', 3, '9', '3', '', '3'),
(25, 's1906/0002', 'IceC5', 4, '16', '4', '', '4'),
(26, 's1906/0002', 'IceF5', 3, '9', '3', '', '3'),
(27, 's1908/0003', 'Iwatalappan', 4, '300', '75', '', ''),
(28, 's1908/0003', 'PdmBG', 5, '375', '75', '', ''),
(29, 's1908/0003', 'Ygh01', 6, '450', '75', '', ''),
(30, 's1908/0004', 'IceC5', 11, '825', '75', '', ''),
(31, 's1908/0005', 'PdmBG', 14, '1050', '75', '', ''),
(32, 's1908/0005', 'Ygh01', 55, '4125', '75', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderheader`
--

CREATE TABLE `orderheader` (
  `id` int(11) NOT NULL,
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

INSERT INTO `orderheader` (`id`, `RefNo`, `AddDate`, `CusCode`, `StartTime`, `EndTime`, `Longitude`, `Latitude`, `ManuRef`, `Remark`, `Repcode`, `TotAmt`, `TxnDate`, `DelDate`, `RouteCode`) VALUES
(1, 's1903/0001', '2019-03-24', 'cus001', '2', '', '0', '0', '', '', 'RS045', '5000', '2019-03-24 09:33:57', '', 'R001'),
(2, 's1904/0001', '2019-04-07', 'cus001', '2', '', '0', '0', '', '', 'RS045', '5000', '2019-04-07 18:38:01', '', 'R001'),
(3, 's1904/0002', '2019-04-09', 'cus001', '2', '', '0', '0', '', '', 'RS045', '5000', '2019-04-09 22:35:26', '', 'R001'),
(4, 's1904/0003', '2019-04-09', 'cus001', '2', '', '0', '0', '', '', 'RS045', '5000', '2019-04-09 23:10:33', '', 'R001'),
(5, 's1904/0004', '2019-04-09', 'cus001', '23:17:20', '', '0', '0', '', '', 'RS045', '5000', '2019-04-09', '', 'R001'),
(6, 's1904/0005', '2019-04-09', 'cus001', '23:27:06', '', '0', '0', '', '', 'RS045', '5000', '', '', 'R001'),
(7, 's1904/0006', '2019-04-09', 'cus001', '23:31:39', '', '0', '0', '', '', 'RS045', '5000', '2019-04-09', '', 'R001'),
(8, 's1904/0007', '2019-04-09', 'cus001', '23:48:19', '23:48:51', '0', '0', '', '', 'RS045', '5000', '2019-04-09', '', 'R001'),
(9, 's1904/0008', '2019-04-15', 'cus001', '09:30:44', '09:34:27', '0', '0', '', '', 'RS045', '5000', '2019-04-15', '', 'R001'),
(10, 's1904/0009', '2019-04-15', 'cus098', '09:45:31', '09:46:20', '0', '0', '', '', 'RS045', '5000', '2019-04-15', '', 'R001'),
(11, 's1904/0010', '2019-04-15', 'cus001', '16:21:36', '16:21:59', '0', '0', '', '', 'RS045', '5000', '2019-04-15', '', 'R001'),
(12, 's1904/0011', '2019-04-15', 'cus001', '16:22:38', '16:23:00', '0', '0', '', '', 'RS045', '5000', '2019-04-15', '', 'R001'),
(13, 's1904/0012', '2019-04-15', 'cus001', '16:45:47', '16:48:37', '0', '0', '', '', 'RS045', '5000', '2019-04-15', '', 'R001'),
(14, 's1904/0014', '2019-04-15', 'cus098', '17:30:51', '17:36:16', '0', '0', 'asdfgh', 'vbnmkhhg', 'RS045', '5000', '2019-04-15', '', 'R001'),
(15, 's1905/0002', '2019-05-22', 'cus001', '20:25:16', '20:25:43', '0', '0', '', '', 'RS045', '5000', '2019-05-22', '', 'R001'),
(16, 's1906/0001', '2019-06-16', 'cus001', '08:50:26', '08:50:37', '0', '0', '', '', 'RS045', '5000', '2019-06-16', '', ''),
(17, 's1906/0002', '2019-06-16', 'cus098', '08:51:14', '08:51:45', '0', '0', '', '', 'RS045', '5000', '2019-06-16', '', ''),
(18, 's1908/0003', '2019-08-25', 'cus001', '14:13:27', '14:13:45', '0', '0', '', '', 'RS045', '1125', '2019-08-25', '', ''),
(19, 's1908/0004', '2019-08-25', 'cus001', '14:17:35', '14:17:49', '0', '0', '', '', 'RS045', '825', '2019-08-25', '', ''),
(20, 's1908/0005', '2019-08-25', 'cus098', '14:19:46', '20:54:01', '0', '0', '', '', 'RS045', '5175', '2019-08-25', '', '');

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
('rs045', 'SFAORDER', 5, 3, 2019, 1),
('rs001', 'SFAORDER', 1, 3, 2019, 2),
('rs045', 'EXPENCE', 1, 3, 2019, 3),
('rs001', 'EXPENCE', 1, 3, 2019, 4);

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
('SFAORDER', 's', 'sales order', NULL),
('EXPENCE', 'E', 'expence entry', NULL),
('NEWCUS', 'C', 'new customer entry', NULL),
('NONPRD', 'N', 'nonproductive entry', NULL);

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
('234', 'd1 to x2', 1),
('asd', 'a1 to a2', 1),
('bb23', 'galle to colombo', 1),
('bnh', 'bbbb', 1),
('ex001', 'Fuel expense', 0),
('ex45', 'test', 0),
('exp34', 'stationary', 0),
('jjjj', 'bj12', 1),
('kl123', 'o1 to o2', 1),
('lk456', 'mmmmmmm', 1),
('mm12', 'bbbb', 1),
('np005', 'closed', 0),
('r001', 'Maharagama - dehiwala', 1),
('r002', 'maharagama-kottawa', 1),
('rt007', 'maharagama to homagama', 1),
('test0', 'test456', 0);

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
('AB0712345678', ''),
('AB0712345678', 'asd'),
('RS045', '');

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
('xx', 'zx', '202cb962ac59075b964b07152d234b70', '', 3456, 'sdf', 1, 'cc3456', '10000', 'cc'),
('testUser', 'md5', 'd41d8cd98f00b204e9800998ecf8427e', '', 3456, 'asdfg', 1, 'fg3456', '10000', 'fg'),
('zxc', 'qq', 'd41d8cd98f00b204e9800998ecf8427e', '', 234, 'xcvb', 1, 'fr234', '10000', 'fr'),
('Mayumi', 'mayumi', '202cb962ac59075b964b07152d234b70', '', 778965452, 'test', 1, 'MA0778965452', '10000', 'MA'),
('Rashmi W.G.M', 'Rash', '202cb962ac59075b964b07152d234b70', '8455A5F1E60C', 0, '', 1, 'RS045', '0', 'MR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cuscode`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderheader`
--
ALTER TABLE `orderheader`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `orderheader`
--
ALTER TABLE `orderheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
