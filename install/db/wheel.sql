-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 03:16 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wheel`
--

-- --------------------------------------------------------

--
-- Table structure for table `autonumber`
--

CREATE TABLE `autonumber` (
  `item_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `finance_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `quotation_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `invoice_number` int(4) UNSIGNED ZEROFILL NOT NULL,
  `year` int(4) UNSIGNED ZEROFILL NOT NULL,
  `month` int(2) UNSIGNED ZEROFILL NOT NULL,
  `day` int(2) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `autonumber`
--

INSERT INTO `autonumber` (`item_number`, `finance_number`, `quotation_number`, `invoice_number`, `year`, `month`, `day`) VALUES
(0001, 0001, 0001, 0001, 2016, 05, 04);

-- --------------------------------------------------------

--
-- Table structure for table `backup_logs`
--

CREATE TABLE `backup_logs` (
  `backup_key` varchar(32) NOT NULL,
  `backup_file` varchar(256) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_key` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` varchar(5) NOT NULL,
  `BrandName` varchar(30) NOT NULL,
  `TypeID` varchar(5) NOT NULL,
  `BrandStatus` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `TypeID`, `BrandStatus`) VALUES
('B0001', 'ยี่ห้อสินค้าtest', 'T0001', '1'),
('B0002', 'Michelin2', 'T0002', '1'),
('B0003', 'ยี่ห้อสินค้าtest', 'T0001', '1'),
('B0004', 'Bridgestone', 'T0002', '1'),
('B0005', 'ยี่ห้อสินค้าtest', 'T0001', '1'),
('B0006', 'Max02', 'T0004', '1'),
('B0007', 'ยี่ห้อสินค้าtest', 'T0001', '1'),
('B0008', 'Dunlop', 'T0002', '1'),
('B0009', 'max01', 'T0003', '1'),
('B0010', 'ยี่ห้อสินค้าtest', 'T0001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `dealer_id` int(10) NOT NULL,
  `dealer_code` varchar(5) NOT NULL,
  `dealer_name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `idline` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealer_id`, `dealer_code`, `dealer_name`, `mobile`, `address`, `idline`, `email`, `status`) VALUES
(1, 'D0001', 'intel thailand', '026546000', '87 อาคารเอ็มไทยทาวเวอร์ ชั้น 9 ออลซีซันส์เพลส, ถนนวิทยุ', '', 'applee@gmail.com', 1),
(2, 'D0002', 'บริษัท เอเอ็มดี ฟาร์อีส', '024655234', '467', 'noina56', 'noina56@gmail.com', 1),
(3, 'D0003', 'Samsung', ' 026959000', '3 Empire Tower 1 South Sathorn rd.', 'aotaotrm33', 'aotaot33@gmail.com', 1),
(4, 'D0004', 'บริษัท ซิลิคอนดาต้า จำกัด', '022192010', '18/1-2 พระราม6 ตัดใหม่ ซอย 4', 'nickyyo', 'nickyyo@gmail.com', 1),
(5, 'D0005', 'GIGABYTE Technology Co.,Ltd.', '029708485', '505/8 ซอย พหลโยธิน 48,', 'nonniiaa', 'teweesak@gmail.com', 1),
(6, 'D0006', 'Scanner Co.,Ltd. (Service)', '022506072', '555 เดอะพาลาเดียมเวิลด์ ชั้น 5 ห้อง IT25\r\nถนนราชปรารถ', 'jamemee654', 'jamemee@gmail.com', 1),
(32, 'D0007', 'Gosoft', '0941319671', 'สาทรซอย 5', 'filmmmm', 'jitrawan.ch@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_code` varchar(16) NOT NULL,
  `language_name` varchar(32) NOT NULL,
  `language_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_code`, `language_name`, `language_status`) VALUES
('en', 'English', 0),
('th', 'ภาษาไทย', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `cases` varchar(64) NOT NULL,
  `menu` varchar(64) NOT NULL,
  `pages` varchar(128) NOT NULL,
  `case_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`cases`, `menu`, `pages`, `case_status`) VALUES
('setting', 'setting', 'settings/setting.php', 1),
('member', 'member', 'members/member.php', 1),
('cashier', 'cashier', 'cashier/cashier.php', 1),
('report', 'report', 'report/report.php', 1),
('report_export', 'report', 'report/report_export.php', 1),
('report_movement', 'report', 'report/report_movement.php', 1),
('report_income', 'report', 'report/report_income.php', 1),
('report_income_detail', 'report', 'report/report_income_detail.php', 1),
('report_booking', 'report', 'report/report_booking.php', 1),
('report_logs', 'report', 'report/report_logs.php', 1),
('report_delivery', 'report', 'report/report_delivery.php', 1),
('report_delivery_detail', 'report', 'report/report_delivery_detail.php', 1),
('setting_users', 'setting', 'settings/setting_users.php', 1),
('setting_backup', 'setting', 'settings/setting_backup.php', 1),
('setting_unit', 'setting', 'settings/setting_unit.php', 0),
('setting_categories', 'setting', 'settings/setting_categories.php', 1),
('setting_member_group', 'setting', 'settings/setting_member_group.php', 1),
('setting_promotions', 'setting', 'settings/setting_promotions.php', 1),
('report_debt', 'report', 'report/report_debt.php', 1),
('report_creditor', 'report', 'report/report_creditor.php', 1),
('setting_info', 'setting', 'settings/setting_info.php', 1),
('setting_system', 'setting', 'settings/setting_system.php', 1),
('setting_user_access', 'setting', 'settings/setting_user_access.php', 1),
('administrator_access_list', 'setting', 'administrator/administrator_access_list.php', 1),
('administrator_cases', 'setting', 'administrator/administrator_cases.php', 1),
('administrator_menus', 'setting', 'administrator/administrator_menus.php', 1),
('administrator_modules', 'setting', 'administrator/administrator_modules.php', 1),
('administrator_helper', 'seting', 'administrator/administrator_helper.php', 1),
('cashier_member', 'cashier', 'cashier/cashier_member.php', 1),
('cashier_booking', 'cashier', 'cashier/cashier_booking.php', 1),
('product_detail', 'product', 'products/product_detail.php', 1),
('member_detail', 'member', 'members/member_detail.php', 1),
('new_member', 'member', 'members/new_member.php', 1),
('member_history', 'member', 'members/member_history.php', 1),
('setting_promotion_member', 'setting', 'settings/setting_promotion_member.php', 1),
('report_cancel', 'report', 'report/report_cancel.php', 1),
('card_all_status', 'card', 'card/card_all_status.php', 1),
('search', '', 'main/search.php', 1),
('card', 'card', 'card/card.php', 1),
('setting_card_status', 'setting', 'settings/setting_card_status.php', 1),
('card_create_detail', 'card_create', 'card/card_create_detail.php', 1),
('search_code', '', 'main/search.php', 1),
('card_create', 'card_create', 'card/main.php', 1),
('setting_products', 'setting', 'settings/setting_products_N.php', 1),
('setting_type', 'setting', 'settings/setting_type.php', 1),
('setting_brand', 'setting', 'settings/setting_brand.php', 1),
('setting_model', 'setting', 'settings/setting_model.php', 1),
('setting_shelf', 'setting', 'settings/setting_shelf.php', 1),
('productInshelf', 'card', 'card/productInshelf_N.php', 1),
('claim_info', 'card', 'card/claim_info.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_key` varchar(16) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_ipaddress` varchar(32) NOT NULL,
  `log_text` varchar(256) NOT NULL,
  `log_user` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_key`, `log_date`, `log_ipaddress`, `log_text`, `log_user`) VALUES
('a436695f8397759e', '2018-11-19 09:48:55', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('a725b5fecd99e202', '2018-11-19 09:52:57', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('114ee9d3d9d31437', '2018-11-19 09:54:16', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('159b263da3f1eb5b', '2018-11-19 09:54:19', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('d9b349b6b5e20712', '2018-11-19 10:09:49', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('e03891189208e5d9', '2018-11-19 12:16:26', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('eb70d193f1d85fc1', '2018-11-19 12:56:12', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('afc7a9f638e7faa7', '2018-11-19 16:04:55', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('cbf407d1aaae0bb7', '2018-11-19 16:37:06', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('204f07308630111d', '2018-11-19 16:38:57', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('cab748d63879ad77', '2018-11-20 12:53:09', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('83d858ec089fa212', '2018-11-20 15:58:49', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('f172f80add5dc5dc', '2018-11-20 16:20:16', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('fc45f86e2d1df46f', '2018-11-20 16:20:18', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('d925ce8da0969583', '2018-11-20 16:23:33', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('1abf8493a0d248dc', '2018-11-20 16:23:40', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('24b2d17826cbe1d8', '2018-11-20 16:23:44', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('3c2c0ff76f873c1d', '2018-11-20 16:28:05', '::1', 'pat ออกจากระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('eb0d6a15bcc97c19', '2018-11-20 16:28:06', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('3cb66c99df17fa2a', '2018-11-21 16:15:42', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('2a10a29c40efff37', '2018-11-22 09:01:37', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('3b8d61b323acae5d', '2018-11-22 09:22:56', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('6e4c8cc4d7430109', '2018-11-23 07:33:30', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('2616559d7d0dadde', '2018-11-24 08:21:16', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('32e675b29ef95743', '2018-11-24 08:21:28', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('ce110a8cdcce7f6b', '2018-11-25 05:51:43', '::1', 'pat ออกจากระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('9cbc4249d847f936', '2018-11-25 05:51:57', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('68a633db8a0d39df', '2018-11-25 05:52:08', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('1d8137f1b2b12451', '2018-11-25 05:52:29', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('cf541ef915cc9726', '2018-11-25 05:53:19', '::1', 'pat ออกจากระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('3f3e8024120d9ed2', '2018-11-25 05:53:25', '::1', 'jitrawan.ch@gmail.com เข้าสู่ระบบ.', '1'),
('ff001fb2bc40736b', '2018-11-25 06:12:05', '::1', 'jitrawan.ch@gmail.com ออกจากระบบ.', '1'),
('7d2afeb0565ec69a', '2018-11-25 06:12:09', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('e6adafb20ce0da37', '2018-11-26 14:16:23', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('9ebaa6f6df160e51', '2018-11-27 10:19:35', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('342e98fca292e7dd', '2018-11-28 03:55:47', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('8b2360b61da2b828', '2018-11-28 10:23:00', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('b88631a0f1360037', '2018-11-29 14:04:51', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('82eb53007887d0f1', '2018-11-30 08:51:51', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('ac6820437757fe98', '2018-11-30 12:12:14', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('ae1c6a7f19fc9c6b', '2018-11-30 17:46:25', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('c306238e8eac3d67', '2018-12-01 03:34:12', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('ee568ccf2a89d1e4', '2018-12-01 16:10:39', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('50344d27e04db018', '2018-12-01 17:16:38', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('0734a1af6385324c', '2018-12-01 18:11:41', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('a84666238fd5719d', '2018-12-03 08:29:51', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('bcb6128456d241c6', '2018-12-04 02:00:08', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('234d13c0d1088f7f', '2018-12-06 03:06:05', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('7cf700a5faa7bce6', '2018-12-06 04:23:59', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15'),
('8931b5753da6731d', '2018-12-09 07:55:46', '::1', 'pat เข้าสู่ระบบ.', 'd97530f6437e7ffa3a74afe46a953a15');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_key` char(32) NOT NULL,
  `menu_upkey` char(32) NOT NULL,
  `menu_icon` varchar(256) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `menu_case` varchar(128) NOT NULL,
  `menu_link` varchar(256) NOT NULL,
  `menu_status` tinyint(1) NOT NULL,
  `menu_sorting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_key`, `menu_upkey`, `menu_icon`, `menu_name`, `menu_case`, `menu_link`, `menu_status`, `menu_sorting`) VALUES
('0a3c8aabc6cdbce67a157ba1701b3fa9', '0a3c8aabc6cdbce67a157ba1701b3fa9', '<i class=\"fa fa-pie-chart fa-fw\"></i>', 'LA_MN_REPORT', 'report', '?p=report', 0, 8),
('2309e0cdb2c541bf7cb8ef0dee7b7eba', '2309e0cdb2c541bf7cb8ef0dee7b7eba', '<i class=\"fa fa-gear  fa-fw\"></i>', 'LA_MN_SETTING', 'setting', '?p=setting', 1, 9),
('26f7e62109e2566eaec8b01fe8e3598d', '26f7e62109e2566eaec8b01fe8e3598d', '<i class=\"fa fa-edit fa-fw\"></i>', 'ส่งซ่อมสินค้า/เคลม', 'card_create', '?p=card_create', 0, 3),
('295744c466c17b46170f88b5c1b9104d', '295744c466c17b46170f88b5c1b9104d', '<i class=\"fa fa-list fa-fw\"></i>', 'รายการส่งซ่อม/เคลม<span class=\"pull-right\"><span class=\"badge\" id=\"card_count\"></span></span>', 'card', '?p=card', 0, 3),
('439c4113b058975e22f776669bb36bf0', 'ff7d5a554f4300b09f2de2e06d523be9', '<i class=\"fa flaticon-stack4 fa-fw\"></i>', 'LA_MN_PRODUCTS_DATA', 'product', '?p=product', 1, 31),
('8a5a77cae7237efcb89683f2ffc4d07b', '8a5a77cae7237efcb89683f2ffc4d07b', '<i class=\"fa fa-search fa-fw\"></i>', 'ค้นหาสินค้า', 'productInshelf', '?p=productInshelf', 1, 2),
('a16043256ea5ca0ea86995e2b69ec238', 'a16043256ea5ca0ea86995e2b69ec238', '<i class=\"fa fa-home fa-fw\"></i>', 'LA_MN_HOME', '', 'index.php', 1, 1),
('c6c8729b45d1fec563f8453c16ff03b8', 'c6c8729b45d1fec563f8453c16ff03b8', '<i class=\"fa fa-lock fa-fw\"></i>', 'LA_MN_LOGOUT', 'logout', '../core/logout.core.php', 1, 10),
('e8b47864ee985a54d7be6b4907ff7e57', 'e8b47864ee985a54d7be6b4907ff7e57', '<i class=\"fa fa-desktop fa-fw\"></i>', 'การเคลม', 'claim_info', '?p=claim_info', 1, 3),
('f1344bc0fb9c5594fa0e3d3f37a56957', 'f1344bc0fb9c5594fa0e3d3f37a56957', '<i class=\"fa fa-users fa-fw\"></i>', 'LA_MN_MEMBERS', 'member', '?p=member', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `ModelID` varchar(6) NOT NULL,
  `BrandID` varchar(5) NOT NULL,
  `ModelName` varchar(30) NOT NULL,
  `ModelStatus` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`ModelID`, `BrandID`, `ModelName`, `ModelStatus`) VALUES
('M0001', 'B0001', 'Michelin City Girb111', '1'),
('M0002', 'B0002', 'dunlop XX2', '1'),
('M0003', 'B0009', 'test', '1'),
('M0004', 'B0002', 'รุ่นtest', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(5) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `shelf_id` int(11) NOT NULL,
  `BrandID` varchar(5) NOT NULL,
  `ModelID` varchar(6) NOT NULL,
  `dealer_code` varchar(5) NOT NULL,
  `ProductDetail` varchar(4000) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceSale` double NOT NULL,
  `PriceBuy` double NOT NULL,
  `IsNew` char(1) NOT NULL,
  `IsRecommend` char(1) NOT NULL,
  `TypeID` varchar(5) NOT NULL,
  `ProductStatus` char(1) NOT NULL,
  `Warranty` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `shelf_id`, `BrandID`, `ModelID`, `dealer_code`, `ProductDetail`, `Quantity`, `PriceSale`, `PriceBuy`, `IsNew`, `IsRecommend`, `TypeID`, `ProductStatus`, `Warranty`) VALUES
('P0001', 'ยาง Michelin City Girb', 2, 'B0001', 'M0001', 'D0001', 'ขนาว XXX', 85, 3000, 2500, '1', '1', 'T0001', '0', '1'),
('P0002', 'ยาง Bridgestone XXXX', 1, 'B0005', 'M0005', 'D0001', 'ยางขนาดดด XXX', 5, 2200, 2000, '1', '0', 'T0001', '1', '-'),
('P0003', 'แม็ก1', 2, 'B0004', '<br />', 'D0003', 'test insert product', 20, 7000, 5000, '', '', 'T0002', '1', '1'),
('P0004', 'ยาง18\"', 2, 'B0001', 'M0001', 'D0002', 'test', 50, 6500, 6000, '', '', 'T0001', '1', '1'),
('P0005', 'test', 3, 'B0001', 'M0001', 'D0001', 'test', 5, 4000, 600, '', '', 'T0001', '1', '1'),
('P0006', 'test2', 4, 'B0001', 'M0001', '', 'test2', 5, 4000, 6000, '', '', 'T0001', '1', '1'),
('P0007', 'แม็ก1', 2, 'B0003', '', '', 'test', 60, 9000, 5000, '', '', 'T0001', '1', '1'),
('P0008', 'แม็ก1', 0, 'B0003', '', '', 'test', 90, 1000, 500, '', '', 'T0001', '1', '1'),
('P0009', 'test', 2, 'B0004', '', '', 'test', 30, 750, 700, '', '', 'T0002', '1', '1'),
('P0010', 'แม็ก1', 3, 'B0008', '', '', 'test', 50, 6000, 4600, '', '', 'T0002', '1', '1'),
('P0011', 'test', 3, 'B0006', '', '', 'test', 50, 9000, 4000, '', '', 'T0004', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `productDetailRubber`
--

CREATE TABLE `productDetailRubber` (
  `id` int(11) NOT NULL,
  `ProductID` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `diameter` int(11) NOT NULL,
  `brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productDetailRubber`
--

INSERT INTO `productDetailRubber` (`id`, `ProductID`, `width`, `series`, `diameter`, `brand`) VALUES
(4, 'P0002', 185, 45, 19, 4),
(28, 'P0003', 215, 40, 15, 5),
(29, 'P0004', 195, 50, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productDetailWheel`
--

CREATE TABLE `productDetailWheel` (
  `id` int(11) NOT NULL,
  `ProductID` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `diameter` int(11) NOT NULL,
  `rim` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `holeSize` int(11) NOT NULL,
  `typeFormat` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productDetailWheel`
--

INSERT INTO `productDetailWheel` (`id`, `ProductID`, `diameter`, `rim`, `holeSize`, `typeFormat`) VALUES
(6, 'P0001', 15, '7.5', 5, 'ก้านใหญ่');

-- --------------------------------------------------------

--
-- Table structure for table `product_N`
--

CREATE TABLE `product_N` (
  `ProductID` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shelf_id` int(11) NOT NULL,
  `dealer_code` varchar(5) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceSale` double NOT NULL,
  `PriceBuy` double NOT NULL,
  `ProductStatus` char(1) NOT NULL,
  `Warranty` varchar(200) NOT NULL,
  `hand` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_N`
--

INSERT INTO `product_N` (`ProductID`, `shelf_id`, `dealer_code`, `Quantity`, `PriceSale`, `PriceBuy`, `ProductStatus`, `Warranty`, `hand`, `TypeID`) VALUES
('P0001', 1, 'D0007', 20, 35000, 20000, '1', '30', 2, 1),
('P0002', 1, 'D0001', 40, 12000, 10000, '1', '30', 2, 2),
('P0003', 2, 'D0001', 150, 10000, 10000, '1', '30', 2, 2),
('P0004', 2, 'D0002', 7, 20000, 15000, '1', '30', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `reserveId` int(11) NOT NULL,
  `ProductID` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `reserveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`reserveId`, `ProductID`, `reserveDate`) VALUES
(1, 'P0001', '2018-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `shelf_id` int(11) NOT NULL,
  `shelf_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shelf_color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `shelf_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`shelf_id`, `shelf_detail`, `shelf_color`, `shelf_status`) VALUES
(1, 'shelf A ชั้น 2', '#ebb2e8', '1'),
(2, 'shelf A ชั้น 1', '#fc9f49', '1');

-- --------------------------------------------------------

--
-- Table structure for table `system_font_size`
--

CREATE TABLE `system_font_size` (
  `font_key` char(32) NOT NULL,
  `font_name` varchar(128) NOT NULL,
  `font_size_text` text NOT NULL,
  `font_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_font_size`
--

INSERT INTO `system_font_size` (`font_key`, `font_name`, `font_size_text`, `font_status`) VALUES
('6c3ca25445248c1dff79d51ad9fa4082', '14px', 'font-size:14px;', 1),
('74af75636b4e933684d63b617c97f398', '24px', 'font-size:24px;', 1),
('bffeb9ae0d04ffc7affc3701f9858932', '22px', 'font-size:22px;', 1),
('dd7e28065e654467be0f9c16f3bd987d', '16px', 'font-size:16px;', 1),
('e215155479796a0bdcad2326ffca09c7', '18px', 'font-size:18px;', 1),
('ff9ec5b758824e67edcf5ecc7e635f6f', '20px', 'font-size:20px;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `site_key` char(32) NOT NULL,
  `site_logo` varchar(256) NOT NULL,
  `site_favicon` varchar(256) NOT NULL,
  `time_zone` varchar(128) NOT NULL,
  `year_type` varchar(16) NOT NULL,
  `year_format` varchar(32) NOT NULL,
  `booking_logo_en` varchar(128) NOT NULL,
  `booking_title_en` varchar(128) NOT NULL,
  `booking_note1_en` text NOT NULL,
  `booking_note2_en` text NOT NULL,
  `booking_logo_th` varchar(128) NOT NULL,
  `booking_title_th` varchar(128) NOT NULL,
  `booking_note1_th` text NOT NULL,
  `booking_note2_th` text NOT NULL,
  `reciept_logo_en` varchar(128) NOT NULL,
  `reciept_title_en` varchar(128) NOT NULL,
  `reciept_note1_en` text NOT NULL,
  `reciept_note2_en` text NOT NULL,
  `reciept_logo_th` varchar(128) NOT NULL,
  `reciept_title_th` varchar(128) NOT NULL,
  `reciept_note1_th` text NOT NULL,
  `reciept_note2_th` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`site_key`, `site_logo`, `site_favicon`, `time_zone`, `year_type`, `year_format`, `booking_logo_en`, `booking_title_en`, `booking_note1_en`, `booking_note2_en`, `booking_logo_th`, `booking_title_th`, `booking_note1_th`, `booking_note2_th`, `reciept_logo_en`, `reciept_title_en`, `reciept_note1_en`, `reciept_note2_en`, `reciept_logo_th`, `reciept_title_th`, `reciept_note1_th`, `reciept_note2_th`) VALUES
('8f411b77c389d5de467af8f2c0e91cda', 'logo.png', 'icon.png', 'Asia/Bangkok', 'BE', '3', 'logo.png', 'Booking Slip', 'Name..............................................<br/>Address..............................................................................<br/>Tel................................................................', '', 'logo.png', 'ใบจองห้องพัก', 'ชื่อ..............................................<br/>ที่อยู่..............................................................................<br/>โทร................................................................', '', 'logo.png', 'Reciept', 'Name..............................................<br/>Address..............................................................................<br/>Tel................................................................', '', 'logo.png', 'ใบเสร็จรับเงิน', 'ชื่อ..............................................<br/>ที่อยู่..............................................................................<br/>โทร................................................................', '');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TypeID` varchar(5) NOT NULL,
  `TypeName` varchar(30) NOT NULL,
  `TypeStatus` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeID`, `TypeName`, `TypeStatus`) VALUES
('T0001', 'ยางมือ1', '1'),
('T0002', 'ยางมือ2', '1'),
('T0003', 'ล้อแม็กมือ1', '1'),
('T0004', 'ล้อแม็กมือ2', '1'),
('T0005', 'ล้อเปลี่ยนtest', '1'),
('T0006', 'ล้อแม็กเปลี่ยน', '1'),
('T0007', 'ประเภทสินค้า', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_key` char(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_photo` varchar(128) NOT NULL DEFAULT 'noimg.jpg',
  `user_class` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=user,2=admin,3=super admin',
  `bed_view` varchar(64) NOT NULL DEFAULT 'box_view',
  `user_language` varchar(8) NOT NULL DEFAULT 'th',
  `system_font_size` varchar(32) NOT NULL DEFAULT 'dd7e28065e654467be0f9c16f3bd987d',
  `email` varchar(128) NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_key`, `name`, `lastname`, `username`, `password`, `user_photo`, `user_class`, `bed_view`, `user_language`, `system_font_size`, `email`, `user_status`) VALUES
('1', 'jitrawan', 'chumpai', 'jitrawan.ch@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 2, 'box_view', 'th', 'dd7e28065e654467be0f9c16f3bd987d', 'jitrawan.ch@gmail.com', 1),
('d97530f6437e7ffa3a74afe46a953a15', 'พัชรวี', 'สีดอก', 'pat', '8e3a8d3e644e608d25ec40162988a137', 'noimg.jpg', 3, 'box_view', 'th', '74af75636b4e933684d63b617c97f398', 'applee@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autonumber`
--
ALTER TABLE `autonumber`
  ADD PRIMARY KEY (`finance_number`);

--
-- Indexes for table `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD PRIMARY KEY (`backup_key`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_code`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`cases`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_key`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`ModelID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `clothes_ibfk_1` (`BrandID`),
  ADD KEY `clothes_ibfk_2` (`TypeID`);

--
-- Indexes for table `productDetailRubber`
--
ALTER TABLE `productDetailRubber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productDetailWheel`
--
ALTER TABLE `productDetailWheel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_N`
--
ALTER TABLE `product_N`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserveId`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelf_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `dealer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `productDetailRubber`
--
ALTER TABLE `productDetailRubber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `productDetailWheel`
--
ALTER TABLE `productDetailWheel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `shelf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
