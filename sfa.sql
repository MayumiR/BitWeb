-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2020 at 01:19 PM
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

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `StartTime`, `EndTime`, `Vehicle`, `StartKM`, `EndKM`, `Distance`, `RepCode`, `Driver`, `Assist`, `Mac`, `Route`, `txndate`, `startLati`, `startLongi`, `endLati`, `endLongi`) VALUES
(1, '03:46 PM', '2020-01-10 03:46 PM', 'ert', 1235.0000000000, 45678.0000000000, 44443.0000000000, 'RS045', 'dfb', 'rfcb', '8455A5F1E60C', 'asd', '2020-01-10', 0.0000000000, 0.0000000000, 0.0000000000, 0.0000000000),
(3, '09:33 AM', '2020-01-11 09:34 AM', 'tesr', 12358.0000000000, 13456.0000000000, 1098.0000000000, 'RS045', 'hjj', 'fgh', '8455A5F1E60C', 'asd', '2020-01-11', 0.0000000000, 0.0000000000, 6.2633189812, 80.2527680354),
(4, '09:42 AM', '2020-01-11 09:43 AM', 'test', 2568.0000000000, 7568.0000000000, 5000.0000000000, 'RS045', 'dfghh', 'dgghh', '8455A5F1E60C', 'asd', '2020-01-11', 6.2634352809, 80.2525102612, 6.2634352809, 80.2525102612);

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
('C1909/0001', 'test', 'asd', 'test address', '714258694', 1, 'abcd@gmail.com'),
('C2001/0001', 'mayu', 'asd', 'galle', '714253258', 1, 'abcd@gmail.com'),
('C2001/0002', 'test4', 'asd', 'dfghj', '714758096', 1, 'Naomi1902@gmail.com'),
('C2001/0003', 'Dfghy', 'asd', 'miratuwa', '714788556', 1, 'abcd@gmail.com'),
('C2001/0004', 'testhgfd', 'asd', 'redft', '2147483647', 1, 'Naomi1902@gmail.com'),
('C2001/0005', 'tesrghjkk', 'asd', 'tesdfrtt', '2147483647', 1, 'abcd@gmail.com');

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
('E1909/0001', 'ex001', 567),
('E2001/0001', 'ex002', 456),
('E2001/0002', 'ex002', 300),
('E2001/0003', 'ex001', 100678);

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
('E1909/0001', '', 'RS045', '', 0.0000000000, 0.0000000000, 567.0000000000),
('E2001/0001', '', 'RS045', '', 0.0000000000, 0.0000000000, 456.0000000000),
('E2001/0002', '', 'RS045', '', 0.0000000000, 0.0000000000, 300.0000000000),
('E2001/0003', '', 'RS045', '', 80.2527904333, 6.2633017303, 100678.0000000000);

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
('N1912/0001', 'np002', 'stock available'),
('N2001/0001', 'np001', 'shop closed'),
('N2001/0002', 'np001', 'shop closed'),
('N2001/0002', 'np002', 'stock available'),
('N2001/0003', 'np001', 'shop closed'),
('N2001/0004', 'np002', 'stock available');

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
('N1912/0001', '2019-12-24', 'RS045', '', '2019-12-24', 'C01452333', 0.0000000000, 0.0000000000),
('N2001/0001', '2020-01-10', 'RS045', '', '2020-01-10', 'C01452333', 0.0000000000, 0.0000000000),
('N2001/0002', '2020-01-10', 'RS045', '', '2020-01-10', 'C2001/0001', 0.0000000000, 0.0000000000),
('N2001/0003', '2020-01-10', 'RS045', '', '2020-01-10', 'C01452333', 0.0000000000, 0.0000000000),
('N2001/0004', '2020-01-11', 'RS045', '', '2020-01-11', 'C01452333', 6.2633108923, 80.2527728998);

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
('IIce058', '12', '0', '2020-01-01'),
('IIce058', '14', '1', '2020-01-01'),
('IIIceF5', '5', '1', '2020-01-01'),
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
('O1912/0012', 'IIceF5', 68, '340', '5', ''),
('O2001/0001', 'IIceF5', 55, '275', '5', ''),
('O2001/0001', 'IYgh01', 62, '310', '5', ''),
('O2001/0023', 'IIceF5', 2, '130', '65', ''),
('O2001/0023', 'IYgh01', 3, '195', '65', ''),
('O2001/0024', 'Icaramelpdm', 5, '325', '65', ''),
('O2001/0024', 'IIceF5', 1, '65', '65', ''),
('O2001/0024', 'IYgh01', 3, '195', '65', ''),
('O2001/0025', 'IIceF5', 5, '325', '65', ''),
('O2001/0025', 'IYgh01', 6, '390', '65', ''),
('O2001/0026', 'Icaramelpdm', 4, '260', '65', ''),
('O2001/0026', 'IIceF5', 2, '130', '65', ''),
('O2001/0026', 'IYgh01', 3, '195', '65', ''),
('O2001/0027', 'Iitmnew', 5, '325', '65', ''),
('O2001/0027', 'Itest', 6, '390', '65', ''),
('O2001/0027', 'Iyghkh001', 2, '130', '65', ''),
('O2001/0028', 'Iyghkh001', 58, '3770', '65', ''),
('O2001/0032', 'Icaramelpdm', 4, '260', '65', ''),
('O2001/0032', 'IIceF5', 2, '130', '65', ''),
('O2001/0032', 'IYgh01', 3, '195', '65', ''),
('O2001/0033', 'Iitmnew', 4, '260', '65', ''),
('O2001/0033', 'IYgh01', 6, '390', '65', ''),
('O2001/0034', 'Icaramelpdm', 1, '65', '65', ''),
('O2001/0034', 'IYgh01', 6, '390', '65', ''),
('O2001/0035', 'Icaramelpdm', 7, '455', '65', ''),
('O2001/0035', 'Iitmnew', 2, '130', '65', ''),
('O2001/0035', 'IYgh01', 6, '390', '65', ''),
('O2001/0036', 'IIceF5', 2, '130', '65', ''),
('O2001/0036', 'Iyghkh001', 5, '325', '65', '');

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
('O1909/0001', '2019-09-01', 'C01452333', '14:05:18', '14:05:52', 0.0000000000, 0.0000000000, '', '', 'RS045', '35', '2019-09-01', '', 'b2 to b7'),
('O1910/0001', '2019-10-28', 'C01452333', '19:59:39', '20:00:21', 0.0000000000, 0.0000000000, '', '', 'RS045', '35', '2019-10-28', '', 'b2 to b7'),
('O1912/0001', '2019-12-23', 'C01452333', '10:56:14', '10:56:31', 0.0000000000, 0.0000000000, '', '', 'RS045', '20', '2019-12-23', '', 'b2 to b7'),
('O1912/0002', '2019-12-24', 'C1909/0001', '12:08:29', '12:09:26', 0.0000000000, 0.0000000000, '', '', 'RS045', '55', '2019-12-24', '', 'b2 to b7'),
('O1912/0010', '2019-12-24', 'C1909/0001', '15:22:44', '15:23:01', 0.0000000000, 0.0000000000, '', '', 'RS045', '100', '2019-12-24', '', 'b2 to b7'),
('O1912/0011', '2019-12-24', 'C3442323234', '15:25:58', '15:26:08', 0.0000000000, 0.0000000000, '', '', 'RS045', '35', '2019-12-24', '', 'b2 to b7'),
('O1912/0012', '2019-12-24', 'C1234567890', '15:58:24', '15:58:36', 0.0000000000, 0.0000000000, '', '', 'RS045', '340', '2019-12-24', '', 'b2 to b7'),
('O2001/0001', '2020-01-01', 'C01452333', '21:14:03', '21:14:42', 0.0000000000, 0.0000000000, '', '', 'RS045', '585', '2020-01-01', '', 'asd'),
('O2001/0023', '2020-01-10', 'C01452333', '22:42:08', '22:42:20', 0.0000000000, 0.0000000000, '', '', 'RS045', '325', '2020-01-10', '', 'asd'),
('O2001/0024', '2020-01-10', 'C1909/0001', '22:42:26', '22:42:39', 0.0000000000, 0.0000000000, '', '', 'RS045', '585', '2020-01-10', '', 'asd'),
('O2001/0025', '2020-01-11', 'C01452333', '08:06:01', '08:06:11', 0.0000000000, 0.0000000000, '', '', 'RS045', '715', '2020-01-11', '', 'asd'),
('O2001/0026', '2020-01-11', 'C01452333', '08:06:46', '08:07:01', 0.0000000000, 0.0000000000, '', '', 'RS045', '585', '2020-01-11', '', 'asd'),
('O2001/0027', '2020-01-11', 'C1909/0001', '08:07:32', '08:08:32', 0.0000000000, 0.0000000000, '', '', 'RS045', '845', '2020-01-11', '', 'asd'),
('O2001/0028', '2020-01-11', 'C1909/0001', '08:09:00', '08:09:20', 0.0000000000, 0.0000000000, '', '', 'RS045', '3770', '2020-01-11', '', 'asd'),
('O2001/0032', '2020-01-11', 'C1909/0001', '08:52:18', '08:52:36', 0.0000000000, 0.0000000000, '', '', 'RS045', '585', '2020-01-11', '', 'asd'),
('O2001/0033', '2020-01-11', 'C1909/0001', '08:59:20', '08:59:51', 0.0000000000, 0.0000000000, '', '', 'RS045', '650', '2020-01-11', '', 'asd'),
('O2001/0034', '2020-01-11', 'C01452333', '09:01:14', '09:01:27', 80.0000000000, 6.0000000000, '', '', 'RS045', '455', '2020-01-11', '', 'asd'),
('O2001/0035', '2020-01-11', 'C1909/0001', '09:07:33', '09:07:45', 80.0000000000, 6.0000000000, '', '', 'RS045', '975', '2020-01-11', '', 'asd'),
('O2001/0036', '2020-01-11', 'C2001/0001', '09:15:15', '09:15:27', 80.2527751234, 6.2633210233, '', '', 'RS045', '455', '2020-01-11', '', 'asd');

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
('rs045', 'SFAORDER', 37, 9, 2019, 1),
('rs045', 'EXPENCE', 4, 9, 2019, 2);

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
('admin', 'admin', '202cb962ac59075b964b07152d234b70', '', '0', '', 1, '', '0', ''),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
