-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2021 at 01:43 PM
-- Server version: 10.3.30-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtrx_dev_gms`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocate`
--

CREATE TABLE `allocate` (
  `recnum` int(10) UNSIGNED NOT NULL COMMENT 'record number',
  `portal` double(8,2) NOT NULL COMMENT 'portal %',
  `gp` double(8,2) NOT NULL COMMENT 'guardian  %',
  `tech` double(8,2) NOT NULL COMMENT 'tech %',
  `referral` double(8,2) NOT NULL COMMENT 'referral %',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allocate`
--

INSERT INTO `allocate` (`recnum`, `portal`, `gp`, `tech`, `referral`, `created_at`, `updated_at`) VALUES
(1, 0.20, 0.35, 0.35, 0.10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `apprvl_id` int(10) UNSIGNED NOT NULL COMMENT 'Approval record id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT 'Client''s cid',
  `preapprovalKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ack` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Acknowledgment code',
  `build` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'PayPal''s build number',
  `correlationId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Correlation identifier',
  `error` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Error info',
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sys / App / Req',
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Domain',
  `errorId` int(11) NOT NULL COMMENT 'Unique error id',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description of error',
  `parameter` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Error parameter',
  `severity` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Error severity',
  `timestamp` datetime NOT NULL COMMENT 'PayPal''s timestamp',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`apprvl_id`, `cid`, `preapprovalKey`, `ack`, `build`, `correlationId`, `error`, `category`, `domain`, `errorId`, `message`, `parameter`, `severity`, `timestamp`, `created_at`, `updated_at`, `rand`) VALUES
(1, 212, 'PA-30L27503WW7557245', 'Success', '42045853', 'aa7c9b36bbc62', ' no error', '', '', 0, '', '', '', '2018-01-03 23:57:53', '2018-01-04 13:57:53', '2018-01-04 13:57:53', '1870010971'),
(2, 212, 'AP-8L345507H6296783L', 'Success', '42045853', 'ede4b5ae83f6d', ' no error', '', '', 0, '', '', '', '2018-01-03 23:58:25', '2018-01-04 13:58:24', '2018-01-04 13:58:24', '1987760565'),
(3, 212, 'PA-5CX655215L328720H', 'Success', '42045853', '44f5c16239c76', ' no error', '', '', 0, '', '', '', '2018-01-04 00:00:54', '2018-01-04 14:00:54', '2018-01-04 14:00:54', '2099792179'),
(4, 212, 'AP-2GJ30954S5513391H', 'Success', '42045853', '65818e481506e', ' no error', '', '', 0, '', '', '', '2018-01-04 00:01:29', '2018-01-04 14:01:28', '2018-01-04 14:01:28', '459143988'),
(5, 212, 'AP-36B83162LR7617704', 'Success', '42045853', '2f07749e5d806', ' no error', '', '', 0, '', '', '', '2018-01-04 00:01:33', '2018-01-04 14:01:32', '2018-01-04 14:01:32', '530545810'),
(6, 212, 'PA-54S20832WD432133N', 'Success', '42045853', '44b26e9f2cb98', ' no error', '', '', 0, '', '', '', '2018-01-04 00:13:16', '2018-01-04 14:13:15', '2018-01-04 14:13:15', '1962912328'),
(7, 212, 'PA-86X91890H61202454', 'Success', '42045853', '26bbd98ba30e5', ' no error', '', '', 0, '', '', '', '2018-01-07 10:37:02', '2018-01-08 00:37:02', '2018-01-08 00:37:02', '1213397984'),
(8, 102, 'PA-29J88628X82061421', 'Success', '52109087', '8263f13fb15a8', ' no error', '', '', 0, '', '', '', '2019-04-08 12:51:17', '2019-04-09 00:51:17', '2019-04-09 00:51:17', '1533329493'),
(9, 212, 'PA-4TE46200UD020543W', 'Success', '52109087', 'fa2e45b8cdb32', ' no error', '', '', 0, '', '', '', '2019-04-10 05:19:52', '2019-04-10 17:19:51', '2019-04-10 17:19:51', '1782368770'),
(10, 212, 'AP-97D79848JT364211P', 'Success', '52109087', '339596674d6df', ' no error', '', '', 0, '', '', '', '2019-04-10 05:20:29', '2019-04-10 17:20:29', '2019-04-10 17:20:29', '161880051'),
(11, 212, 'AP-4NJ02616JY654640T', 'Success', '52109087', 'd2f2a129a3249', ' no error', '', '', 0, '', '', '', '2019-04-10 05:20:33', '2019-04-10 17:20:32', '2019-04-10 17:20:32', '761539374'),
(12, 212, 'PA-1YH121160H4013318', 'Success', '52109087', 'be135e04a36f1', ' no error', '', '', 0, '', '', '', '2019-04-10 05:21:22', '2019-04-10 17:21:21', '2019-04-10 17:21:21', '1120157864'),
(13, 212, 'AP-1AE34333245154713', 'Success', '52109087', '3ae946fbe5f2d', ' no error', '', '', 0, '', '', '', '2019-04-10 05:22:01', '2019-04-10 17:22:00', '2019-04-10 17:22:00', '406793455'),
(14, 212, 'PA-0T757891M4391422J', 'Success', '52109087', '7b6959b86ca0', ' no error', '', '', 0, '', '', '', '2019-04-10 05:23:15', '2019-04-10 17:23:15', '2019-04-10 17:23:15', '624697624'),
(15, 212, 'PA-9P856836JG494040B', 'Success', '52109087', 'ce50a3fe37da5', ' no error', '', '', 0, '', '', '', '2019-04-10 05:23:17', '2019-04-10 17:23:16', '2019-04-10 17:23:16', '932293179'),
(16, 212, 'PA-5L060543GF645023R', 'Success', '52109087', 'fbff26634b7a6', ' no error', '', '', 0, '', '', '', '2019-04-10 05:23:17', '2019-04-10 17:23:16', '2019-04-10 17:23:16', '1272854460'),
(17, 102, 'PA-2NE30371XF287862B', 'Success', '52109087', '3ef066a6e105d', ' no error', '', '', 0, '', '', '', '2019-04-15 02:54:36', '2019-04-15 14:54:35', '2019-04-15 14:54:35', '1124497753'),
(18, 212, 'PA-43E912899F619742V', 'Success', '52109087', '37736bad5ff8e', ' no error', '', '', 0, '', '', '', '2019-04-17 10:28:54', '2019-04-17 22:28:54', '2019-04-17 22:28:54', '1306329408'),
(19, 212, '', 'Failure', '52109087', 'feba19f5a8e9a', 'error', 'Application', 'PLATFORM', 580022, 'The system did not recognize this payment period QUARTERLY', 'param', 'Error', '2019-04-18 11:22:23', '2019-04-18 23:22:23', '2019-04-18 23:22:23', '1611859805'),
(20, 212, '', 'Failure', '52656287', 'a2c0054896420', 'error', 'Application', 'PLATFORM', 580022, 'The system did not recognize this payment period Month', 'param', 'Error', '2019-05-02 11:32:01', '2019-05-02 23:32:01', '2019-05-02 23:32:01', '1044717622'),
(21, 212, '', 'Failure', '52656287', 'e067336db26ca', 'error', 'Application', 'PLATFORM', 580022, 'The system did not recognize this payment period SemiMonth', 'param', 'Error', '2019-05-02 11:32:27', '2019-05-02 23:32:27', '2019-05-02 23:32:27', '1510022782'),
(22, 212, 'PA-1DV70140XE8047648', 'Success', '52656287', 'bf8d43db896f9', ' no error', '', '', 0, '', '', '', '2019-05-02 11:34:06', '2019-05-02 23:34:06', '2019-05-02 23:34:06', '777642982'),
(23, 212, 'PA-7G262712TM469091V', 'Success', '52656287', '148648eba5874', ' no error', '', '', 0, '', '', '', '2019-05-02 11:44:25', '2019-05-02 23:44:24', '2019-05-02 23:44:24', '1714722590'),
(24, 212, '', 'Failure', '52656287', 'eb1974eb3a356', 'error', 'Application', 'PLATFORM', 580022, 'The system did not recognize this payment period YEARLY', 'param', 'Error', '2019-05-02 11:45:52', '2019-05-02 23:45:51', '2019-05-02 23:45:51', '566592191'),
(25, 212, '', 'Failure', '52656287', '354476c442579', 'error', 'Application', 'PLATFORM', 580023, 'The maximum amount per payment cannot be greater than the maximum total amount of all payments', 'param', 'Error', '2019-05-02 11:49:39', '2019-05-02 23:49:38', '2019-05-02 23:49:38', '672970843'),
(26, 212, '', 'Failure', '52656287', '7973216433291', 'error', 'Application', 'PLATFORM', 580023, 'The maximum amount per payment cannot be greater than the maximum total amount of all payments', 'param', 'Error', '2019-05-02 11:59:48', '2019-05-02 23:59:47', '2019-05-02 23:59:47', '1121103880'),
(27, 212, '', 'Failure', '52656287', 'e6fa07171e97d', 'error', 'Application', 'PLATFORM', 580023, 'The maximum amount per payment cannot be greater than the maximum total amount of all payments', 'param', 'Error', '2019-05-02 12:05:21', '2019-05-03 00:05:20', '2019-05-03 00:05:20', '118713296');

-- --------------------------------------------------------

--
-- Table structure for table `cmpny`
--

CREATE TABLE `cmpny` (
  `cid` int(10) UNSIGNED NOT NULL COMMENT 'Record id for company',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the business',
  `contact` int(11) NOT NULL COMMENT 'The users.id of the company''s primary contact',
  `type` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'p' COMMENT 'a-admin; c-customer; p-prospect; s-sales; t-tech',
  `tcid` int(10) UNSIGNED DEFAULT 120 COMMENT 'Links to tech.tcid to assign customers to tech',
  `tpid` int(11) DEFAULT 120 COMMENT 'The users.id of the technician assigned to the company',
  `rcid` int(11) NOT NULL COMMENT 'company.cid of referral company',
  `number_of_computers` int(11) NOT NULL COMMENT '# business computers',
  `cost` double(8,2) NOT NULL COMMENT 'Monthly cost of all subscriptions',
  `mod_by` int(11) NOT NULL COMMENT 'Modified by pid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `new_cost` double(8,2) DEFAULT NULL COMMENT 'Pending new cost of subscription',
  `expires` date DEFAULT NULL COMMENT 'Expiration Date',
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `renewal_diff` int(11) DEFAULT NULL,
  `new_expiry` date DEFAULT NULL,
  `removal_amt` double(8,2) NOT NULL DEFAULT 0.00,
  `sub_interval` int(11) NOT NULL DEFAULT 1,
  `sub_date` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cmpny`
--

INSERT INTO `cmpny` (`cid`, `name`, `contact`, `type`, `tcid`, `tpid`, `rcid`, `number_of_computers`, `cost`, `mod_by`, `created_at`, `updated_at`, `new_cost`, `expires`, `paypal_email`, `renewal_diff`, `new_expiry`, `removal_amt`, `sub_interval`, `sub_date`) VALUES
(101, 'Global Concepts, Inc.', 101, 'a', 102, 102, 0, 0, 0.00, 0, '2017-05-16 17:45:29', '2017-05-16 17:45:29', NULL, NULL, 'paypal_buyer@gmsmatrix.com', NULL, NULL, 0.00, 1, 1),
(102, 'Guardian Partners', 102, 't', 102, 102, 0, 0, 0.00, 0, '2017-07-07 18:40:46', '2019-04-15 14:54:34', 270.00, NULL, 'paypal_buyer2@gmsmatrix.com', 7, '2019-07-07', 0.00, 3, 7),
(212, 'testing', 223, 't', 102, 102, 0, 0, 872.03, 0, '2017-12-11 23:39:15', '2019-05-03 00:05:19', 5060.22, '2019-07-01', 'paypal_buyer3@gmsmatrix.com', 1, '2020-05-01', 0.00, 12, 1),
(153, 'ReferredClient', 163, 'p', 102, 102, 121, 5, 0.00, 0, '2017-10-04 02:13:46', '2017-10-04 02:22:20', NULL, NULL, NULL, 15, '2017-10-15', 0.00, 1, 1),
(154, 'High Tech Solutions', 164, 'x', 154, 164, 0, 1, 0.00, 0, '2017-10-04 20:02:10', '2017-10-04 20:02:10', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(155, 'NewTech', 165, 'x', 155, 165, 0, 2, 0.00, 0, '2017-10-04 01:33:00', '2017-10-04 01:33:00', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(156, 'NewClient', 166, 'c', 106, 170, 0, 3, 0.00, 0, '2017-10-04 01:52:04', '2017-10-04 01:52:04', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(157, 'Honest Dave', 167, 'x', 102, 102, 0, 1, 0.00, 0, '2017-10-04 20:31:25', '2017-10-04 20:31:25', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(158, 'BGS', 168, 'x', 158, 168, 0, 9, 0.00, 0, '2017-10-04 20:46:16', '2017-10-04 20:46:16', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(159, 'TechCM', 169, 'x', 159, 169, 0, 7, 0.00, 0, '2017-10-04 21:01:40', '2017-10-04 21:01:40', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(213, 'Empty', 224, 'p', 102, 102, 0, 0, 0.00, 0, '2017-12-13 22:25:58', '2017-12-13 22:25:58', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(201, 'Pterandon Technical Consulting', 211, 's', 201, 211, 0, 3, 0.00, 0, '2017-10-24 21:45:25', '2017-10-24 21:45:25', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1),
(204, 'Phil Dill Appraisals', 214, 'p', 102, 102, 0, 6, 0.00, 0, '2017-11-24 20:00:40', '2017-12-16 04:30:59', NULL, NULL, NULL, 19, '2018-12-19', 0.00, 1, 1),
(203, 'Cruz-Bruno PLLC', 213, 'p', 102, 102, 0, 1, 0.00, 0, '2017-11-15 04:09:31', '2017-11-15 05:05:38', NULL, NULL, NULL, 15, '2017-11-15', 0.00, 1, 1),
(205, 'P L Appraisals', 215, 'p', 102, 102, 0, 3, 0.00, 0, '2017-11-25 05:22:35', '2017-11-25 05:30:54', NULL, NULL, NULL, 25, '2017-11-25', 0.00, 1, 1),
(206, 'Russell Appraisal Service', 216, 'p', 102, 102, 0, 2, 0.00, 0, '2017-11-25 05:33:13', '2017-11-25 05:37:54', NULL, NULL, NULL, 24, '2017-12-24', 0.00, 1, 1),
(207, 'Arusha', 217, 'p', 102, 102, 0, 2, 0.00, 0, '2017-11-25 05:39:14', '2017-11-25 05:42:26', NULL, NULL, NULL, 24, '2017-12-24', 0.00, 1, 1),
(208, 'Robert F Kemp', 218, 'p', 102, 102, 0, 7, 0.00, 0, '2017-11-25 05:44:10', '2017-11-25 05:54:41', NULL, NULL, NULL, 24, '2017-12-24', 0.00, 1, 1),
(209, 'K Gary Roberts, CPA', 220, 'p', 102, 102, 0, 3, 0.00, 0, '2017-11-25 06:06:13', '2017-11-25 06:11:21', NULL, NULL, NULL, 25, '2017-12-25', 0.00, 1, 1),
(210, 'Marsha M Halpern', 221, 'p', 102, 102, 0, 2, 0.00, 0, '2017-11-25 06:14:22', '2017-11-25 06:18:07', NULL, NULL, NULL, 25, '2017-12-25', 0.00, 1, 1),
(214, 'tkxel', 225, 'p', 102, 102, 0, 5, 0.00, 0, '2021-02-25 10:53:16', '2021-02-25 10:53:16', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Record #',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Discount code',
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Valid for service',
  `amount` double(8,2) NOT NULL COMMENT 'Amount',
  `nbr_available` int(11) NOT NULL COMMENT '# available, 0=unlimited',
  `expires` date NOT NULL COMMENT 'Expires',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `code`, `service`, `amount`, `nbr_available`, `expires`, `created_at`, `updated_at`) VALUES
(1, 'tsu100FT', 'mts', 129.97, 0, '2017-12-31', NULL, NULL),
(2, 'tsu100NT', 'mts', 100.00, 0, '2017-12-31', NULL, NULL),
(3, 'dsu25NT', 'mds', 25.00, 0, '2017-12-31', NULL, NULL),
(4, 'tsu50FT', 'mts', 79.97, 0, '2017-12-31', NULL, NULL),
(5, 'tsu150NT', 'mts', 150.00, 0, '2017-12-31', NULL, NULL),
(6, 'tsu50NT', 'mts', 50.00, 0, '2017-12-31', NULL, NULL),
(7, 'xfr2gms', 'mts', 222.00, 0, '2017-12-31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `distance`
--

CREATE TABLE `distance` (
  `id` int(10) UNSIGNED NOT NULL,
  `miles` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `distance`
--

INSERT INTO `distance` (`id`, `miles`) VALUES
(1, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `e_addr` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email address',
  `pid` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'primary' COMMENT 'primary, home, work, other, alert, paypal',
  `mod_by` int(11) NOT NULL COMMENT 'Date modified',
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Modified by pid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`e_addr`, `pid`, `type`, `mod_by`, `mod_date`, `created_at`, `updated_at`) VALUES
('lou@guardianpartners.net', 101, 'primary', 101, '2017-05-11 11:21:35', '2017-05-09 18:19:07', '2017-05-09 18:19:07'),
('lou@guardiantm.com', 102, 'primary', 0, '2017-07-07 18:33:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('wpgoodwin@sbcglobal.net', 211, 'primary', 211, '2017-10-24 16:45:25', '2017-10-24 21:45:25', '2017-10-24 21:45:25'),
('jacobdarinjones@gmail.com', 224, 'primary', 224, '2017-12-13 16:25:58', '2017-12-13 22:25:58', '2017-12-13 22:25:58'),
('assist@guardiantm.com', 170, 'primary', 111, '2017-10-03 20:13:10', '2017-10-04 01:13:10', '2017-10-04 01:13:10'),
('new@guardiantm.com', 165, 'primary', 203, '2017-10-03 20:33:00', '2017-10-04 01:33:00', '2017-10-04 01:33:00'),
('newclient@guardiantm.com', 166, 'primary', 204, '2017-10-03 20:52:04', '2017-10-04 01:52:04', '2017-10-04 01:52:04'),
('referal@guardiantm.com', 163, 'primary', 205, '2017-10-03 21:13:46', '2017-10-04 02:13:46', '2017-10-04 02:13:46'),
('gms@judyblackwell.com', 103, 'primary', 102, '2017-10-03 21:39:43', '2017-10-04 02:39:43', '2017-10-04 02:39:43'),
('hiTech@guardiantm.com', 164, 'primary', 207, '2017-10-04 15:02:10', '2017-10-04 20:02:10', '2017-10-04 20:02:10'),
('hd@guardiantm.com', 167, 'primary', 208, '2017-10-04 15:31:25', '2017-10-04 20:31:25', '2017-10-04 20:31:25'),
('bg@guardiantm.com', 168, 'primary', 209, '2017-10-04 15:46:16', '2017-10-04 20:46:16', '2017-10-04 20:46:16'),
('amit@guardiantm.com', 169, 'primary', 210, '2017-10-04 16:01:40', '2017-10-04 21:01:40', '2017-10-04 21:01:40'),
('ntOct@guardiantm.com', 212, 'primary', 212, '2017-10-25 12:48:56', '2017-10-25 17:48:56', '2017-10-25 17:48:56'),
('dcbruno@cruzbrunolaw.com', 213, 'primary', 213, '2017-11-14 22:09:31', '2017-11-15 04:09:31', '2017-11-15 04:09:31'),
('phil@phildillappraisals.com', 214, 'primary', 214, '2017-11-24 14:04:27', '2017-11-24 20:04:27', '2017-11-24 20:04:27'),
('paul@plappraisals.com', 215, 'primary', 215, '2017-11-24 23:26:00', '2017-11-25 05:26:00', '2017-11-25 05:26:00'),
('eddie@russellappraisal.org', 216, 'primary', 216, '2017-11-24 23:35:40', '2017-11-25 05:35:40', '2017-11-25 05:35:40'),
('grant@guardiantm.com', 217, 'primary', 217, '2017-11-24 23:39:14', '2017-11-25 05:39:14', '2017-11-25 05:39:14'),
('lawyerkemp@cs.com', 218, 'primary', 218, '2017-11-24 23:48:59', '2017-11-25 05:48:59', '2017-11-25 05:48:59'),
('kathy@lawyerkemp.com', 219, 'primary', 218, '2017-11-24 23:47:12', '2017-11-25 05:47:12', '2017-11-25 05:47:12'),
('kgaryrobertscpa@gmail.com', 220, 'primary', 220, '2017-11-25 00:09:13', '2017-11-25 06:09:13', '2017-11-25 06:09:13'),
('marsha@guardiantm.com', 221, 'primary', 221, '2017-11-25 00:14:22', '2017-11-25 06:14:22', '2017-11-25 06:14:22'),
('mustabeen.iqbal3@gmail.com', 223, 'primary', 223, '2017-12-11 17:39:15', '2017-12-11 23:39:15', '2017-12-11 23:39:15'),
('mustabeen.iqbal@tkxel.com', 225, 'primary', 225, '2021-02-25 05:53:16', '2021-02-25 10:53:16', '2021-02-25 10:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lid` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '	Links to cmpny -> cid',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '	Location nick name',
  `addr1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addr2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `st` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cntry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Last modified date',
  `mod_by` int(10) UNSIGNED DEFAULT NULL COMMENT 'Modified by pid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lid`, `cid`, `name`, `addr1`, `addr2`, `city`, `st`, `postal`, `cntry`, `mod_date`, `mod_by`, `created_at`, `updated_at`, `longitude`, `latitude`) VALUES
(30, 102, 'Dallas', 'Main Office', '', 'Dallas', 'TX', '75220', 'US', '2017-07-07 18:42:46', 103, '2017-05-09 18:14:55', '2017-12-08 07:27:17', '-96.8726295', '32.8621631'),
(103, 155, 'Home Office', 'street', '', 'Amery', 'wi', '54001', 'US', '2017-10-04 09:56:33', 203, '2017-10-04 14:56:33', '2017-10-05 16:20:03', '-92.3910954', '45.330785'),
(104, 155, 'Downtown', 'main', '11', 'Dallas', 'tx', '75201', 'US', '2017-07-07 18:42:46', 40, '2017-05-09 18:14:55', '2017-10-05 16:20:14', '-96.7962528', '32.7863301'),
(105, 154, 'Home Office', 'So Yale', '', 'Tulsa', 'OK', '74136', 'US', '2017-10-04 15:03:44', 207, '2017-10-04 20:03:44', '2017-10-05 16:20:04', '-95.9515399', '36.0613546'),
(106, 157, 'Home Office', 'main', '', 'San Francisco', 'CA', '94110', 'US', '2017-10-04 15:32:37', 208, '2017-10-04 20:32:37', '2017-10-05 16:20:15', '-122.4184108', '37.7485824'),
(107, 158, 'Home Office', 'Piedmont Rd', '', 'Atlanta', 'GA', '30305', 'US', '2017-10-04 15:47:31', 209, '2017-10-04 20:47:31', '2017-10-05 16:20:05', '-84.3857442', '33.8363126'),
(108, 159, 'Home Office', 'Thomas', '', 'Hollywood', 'FL', '33021', 'US', '2017-10-04 16:03:15', 210, '2017-10-04 21:03:15', '2017-10-05 16:20:16', '-80.1819268', '26.0197012'),
(205, 203, 'Las Colinas', '545 East John Carpenter', '  Ste 300', ' Irving', 'Texas', '75062', 'US', '2017-11-14 23:16:09', 213, '2017-11-15 05:16:09', '2017-11-15 05:16:09', '-96.9799755', '32.8449965'),
(216, 212, 'Home Office', '316 Jagoe', '', 'Denton', 'TX', '76201', 'US', '2017-11-24 14:02:41', 214, '2017-11-24 20:02:41', '2017-11-24 20:02:41', '-97.1413222', '33.2167226'),
(207, 205, 'Home Office', '5653 Tyler St', '', 'The Colony', 'TX', '75056', 'US', '2017-11-24 23:23:47', 215, '2017-11-25 05:23:47', '2017-11-25 05:23:47', '-96.9101806', '33.0787106'),
(208, 206, 'Home Office', '2913 Painted Pony Ln', '', 'Rockwall', 'TX', '75087', 'US', '2017-11-24 23:34:51', 216, '2017-11-25 05:34:51', '2017-11-25 05:34:51', '-96.4609998', '32.9682679'),
(209, 207, 'Home Office', '709 Cimarron Tr', '', 'Southlake', 'TX', '76092', 'US', '2017-11-24 23:40:31', 217, '2017-11-25 05:40:31', '2017-11-25 05:40:31', '-97.1467072', '32.9533477'),
(210, 208, 'Forest Lane', '3530 Forest LN', '255', 'Dallas', 'TX', '75234', 'US', '2017-11-24 23:45:54', 218, '2017-11-25 05:45:54', '2017-11-25 05:45:54', '-96.8672668', '32.9241691'),
(211, 209, 'Home Office', 'Riverside', '300', 'Irving', 'TX', '75014', 'US', '2017-11-25 00:07:20', 220, '2017-11-25 06:07:20', '2017-11-25 06:07:20', '-96.97', '32.84'),
(219, 204, 'Home Office', '123 Jagoe', '', 'Denton', 'tx', '75065', 'US', '2017-12-14 19:47:20', 214, '2017-12-15 01:47:20', '2017-12-15 01:47:20', '-97.0175879', '33.1174921');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_04_24_181151_create_user_activations_table', 1),
('2017_04_27_090042_create_tech_table', 1),
('2017_04_29_114011_create_company_table', 1),
('2017_05_29_113849_create_allocate_table', 1),
('2017_05_29_113959_create_approval_table', 1),
('2017_05_29_114018_create_discount_table', 1),
('2017_05_29_114019_create_email_table', 1),
('2017_05_29_114032_create_location_table', 1),
('2017_06_06_104114_create_phone_table', 1),
('2017_06_09_052231_create_srv_table', 1),
('2017_06_12_075408_create_sub_table', 1),
('2017_06_29_090042_create_transaction_table', 1),
('2017_07_19_063215_add_expires_to_cmpny_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_04_24_181151_create_user_activations_table', 1),
('2017_04_27_090042_create_tech_table', 1),
('2017_04_29_114011_create_company_table', 1),
('2017_05_29_113849_create_allocate_table', 1),
('2017_05_29_113959_create_approval_table', 1),
('2017_05_29_114018_create_discount_table', 1),
('2017_05_29_114019_create_email_table', 1),
('2017_05_29_114032_create_location_table', 1),
('2017_06_06_104114_create_phone_table', 1),
('2017_06_09_052231_create_srv_table', 1),
('2017_06_12_075406_create_sub_table', 1),
('2017_06_29_090042_create_transaction_table', 1),
('2017_07_19_063214_add_expires_to_cmpny_table', 2),
('2017_07_19_063215_add_expires_to_cmpny_table', 3),
('2017_06_12_075409_create_sub_table', 4),
('2017_07_25_142213_add_discount_to_sub_table', 4),
('2017_07_25_142214_add_discount_to_sub_table', 5),
('2017_07_26_072327_add_paypal_email_to_cmpny_table', 5),
('2017_08_01_090602_add_longandlat_to_location_table', 5),
('2017_08_08_072022_add_renewal_changes_to_cmpny_table', 5),
('2017_08_10_135322_create_distance_table', 5),
('2017_08_23_115429_add_rand_to_approval_table', 6),
('2017_08_24_061331_add_cmpny_to_removal_amt_table', 6),
('2017_09_19_184655_add_paypal_data_to_transaction_table', 6),
('2017_09_25_051654_add_amount_to_transaction_table', 6),
('2017_06_09_052230_create_srv_table', 7),
('2017_09_25_051654_add_new_to_srv_table', 7),
('2017_12_14_052230_create_site_vars_table', 7),
('2017_09_25_051654_add_notes_to_srv_table', 8),
('2017_09_25_051654_add_recnum_to_password_resets_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `recnum` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `nbr` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phone number',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'primary' COMMENT 'Type: primary, home, work etc',
  `pid` int(10) UNSIGNED NOT NULL COMMENT 'Links to people -> pid',
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date last modified',
  `mod_by` int(10) UNSIGNED DEFAULT NULL COMMENT 'Modified by pid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`nbr`, `type`, `pid`, `mod_date`, `mod_by`, `created_at`, `updated_at`) VALUES
('(214) 526-9601', 'primary', 218, '2017-11-24 23:48:29', 218, '2017-11-25 05:48:29', '2017-11-25 05:48:29'),
('(972) 505-6369', 'mobile', 215, '2017-11-24 23:25:36', 215, '2017-11-25 05:25:36', '2017-11-25 05:25:36'),
('(214) 454-8481', 'primary', 216, '2017-11-24 23:35:19', 216, '2017-11-25 05:35:19', '2017-11-25 05:35:19'),
('(214) 536-0624', 'home', 218, '2017-11-24 23:48:29', 218, '2017-11-25 05:48:29', '2017-11-25 05:48:29'),
('(051) 456-3189', 'mobile', 111, '2017-10-03 17:54:28', 111, '2017-10-03 22:54:28', '2017-10-03 22:54:28'),
('(972) 624-8924', 'primary', 215, '2017-11-24 23:25:36', 215, '2017-11-25 05:25:36', '2017-11-25 05:25:36'),
('(214) 702-4152', 'primary', 102, '2017-10-25 12:36:36', 102, '2017-10-25 17:36:36', '2017-10-25 17:36:36'),
('(214) 738-7777', 'mobile', 102, '2017-10-25 12:36:36', 102, '2017-10-25 17:36:36', '2017-10-25 17:36:36'),
('(972) 719-9012', 'primary', 213, '2017-11-14 23:17:20', 213, '2017-11-15 05:17:20', '2017-11-15 05:17:20'),
('(940) 243-4900', 'primary', 214, '2017-11-24 14:03:56', 214, '2017-11-24 20:03:56', '2017-11-24 20:03:56'),
('(042) 512-3456', 'primary', 111, '2017-10-03 17:54:28', 111, '2017-10-03 22:54:28', '2017-10-03 22:54:28'),
('(214) 526-9601', 'primary', 219, '2017-11-24 23:50:34', 218, '2017-11-25 05:50:34', '2017-11-25 05:50:34'),
('(214) 673-3753', 'mobile', 219, '2017-11-24 23:50:34', 218, '2017-11-25 05:50:34', '2017-11-25 05:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `site_vars`
--

CREATE TABLE `site_vars` (
  `recnum` int(10) UNSIGNED NOT NULL,
  `TX_Tax` double(8,4) NOT NULL DEFAULT 0.0825 COMMENT 'TX Sales Tax Rate',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_vars`
--

INSERT INTO `site_vars` (`recnum`, `TX_Tax`, `created_at`, `updated_at`) VALUES
(1, 0.0825, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `srv`
--

CREATE TABLE `srv` (
  `srv_id` int(10) UNSIGNED NOT NULL COMMENT 'Service ID',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of service',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Type of service',
  `price` double(8,2) NOT NULL COMMENT 'Cost per month',
  `setup` double(8,2) NOT NULL COMMENT 'Setup fee',
  `date_mod` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date modified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pay_p` double(8,2) NOT NULL DEFAULT 0.20,
  `pay_g` double(8,2) NOT NULL DEFAULT 0.35,
  `pay_t` double(8,2) NOT NULL DEFAULT 0.35,
  `pay_r` double(8,2) NOT NULL DEFAULT 0.10,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'y',
  `setup_p` double(8,2) DEFAULT NULL,
  `setup_t` double(8,2) DEFAULT NULL,
  `setup_r` double(8,2) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `srv`
--

INSERT INTO `srv` (`srv_id`, `name`, `type`, `price`, `setup`, `date_mod`, `created_at`, `updated_at`, `pay_p`, `pay_g`, `pay_t`, `pay_r`, `tax`, `setup_p`, `setup_t`, `setup_r`, `note`) VALUES
(101, 'mts', 'Level 1', 30.00, 0.00, '2017-05-12 20:30:44', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 47.00, 0.00, 150.00, NULL),
(201, 'mds', 'std:    5GB', 9.97, 25.00, '2017-05-11 22:01:41', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 27.00, 0.00, 0.00, NULL),
(202, 'mds', 'std:  25GB', 14.97, 25.00, '2017-05-11 22:01:47', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 27.00, 0.00, 0.00, NULL),
(203, 'mds', 'std:  50GB', 19.97, 0.00, '2017-05-11 22:01:52', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 27.00, 0.00, 0.00, NULL),
(204, 'mds', 'std: 100GB', 29.97, 0.00, '2017-05-11 22:01:34', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 27.00, 0.00, 0.00, NULL),
(301, 'mds', 'sql:  20GB', 24.97, 25.00, '2017-05-11 22:03:31', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 47.00, 0.00, 0.00, NULL),
(302, 'mds', 'sql:  50GB', 39.97, 25.00, '2017-05-11 22:03:38', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 47.00, 0.00, 0.00, NULL),
(303, 'mds', 'sql: 100GB', 49.97, 25.00, '2017-05-11 22:03:49', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 47.00, 0.00, 0.00, NULL),
(501, 'Phone', 'Premium', 29.97, 0.00, '2017-11-14 22:58:47', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 0.00, 0.00, 0.00, NULL),
(401, 'Hosting', 'Basic', 9.97, 0.00, '2017-11-14 22:38:03', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 0.00, 0.00, 0.00, NULL),
(410, 'Hosting', 'Business', 14.97, 0.00, '2017-11-14 22:38:03', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 0.00, 0.00, 0.00, NULL),
(450, 'email', 'business', 14.97, 0.00, '2017-11-24 14:09:00', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 0.00, 0.00, 0.00, NULL),
(901, 'tax', '2.88', 2.88, 0.00, '2017-11-24 14:56:58', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Phil'),
(902, 'tax', '6.18', 6.18, 0.00, '2017-11-24 15:44:28', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Ted'),
(903, 'tax', '3.30', 3.30, 0.00, '2017-11-24 15:51:28', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Eddie'),
(904, 'tax', '19.29', 19.29, 0.00, '2017-11-24 17:19:55', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Kemp Law'),
(319, 'mds', 'sql: 25GB', 31.94, 0.00, '2017-11-24 17:33:01', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'y', 0.00, 0.00, 0.00, 'Grant\'s price'),
(905, 'tax', '2.64', 2.64, 0.00, '2017-11-24 17:34:41', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Grant\'s Tax'),
(906, 'tax', '13.60', 13.60, 0.00, '2017-11-24 18:58:02', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, 'Gary\'s Tax'),
(907, 'tax', '1.24', 1.24, 0.00, '2017-11-25 00:17:10', NULL, NULL, 0.20, 0.35, 0.35, 0.10, 'n', 0.00, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

CREATE TABLE `sub` (
  `sid` int(10) UNSIGNED NOT NULL COMMENT 'Subscription ID',
  `srv_id` int(10) UNSIGNED NOT NULL COMMENT 'Service ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT 'Company ID',
  `guid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Unique Computer ID',
  `device` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Device name',
  `lid` int(10) UNSIGNED DEFAULT NULL COMMENT 'Links to location -> lid',
  `mod_by` int(10) UNSIGNED DEFAULT NULL COMMENT 'Modified by user id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub`
--

INSERT INTO `sub` (`sid`, `srv_id`, `cid`, `guid`, `device`, `lid`, `mod_by`, `created_at`, `updated_at`, `token`) VALUES
(1, 101, 212, NULL, 'unassigned', 216, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(2, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2018-01-11 00:01:01', ''),
(3, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(4, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(5, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(6, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(7, 202, 212, NULL, 'unassigned', 216, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(8, 202, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(9, 202, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2018-01-11 00:01:01', ''),
(10, 101, 212, NULL, 'unassigned', NULL, 223, '2018-01-11 00:01:01', '2018-01-11 00:01:01', ''),
(11, 101, 212, NULL, 'unassigned', 216, 223, '2018-01-11 00:01:01', '2019-04-10 17:22:51', ''),
(16, 101, 102, NULL, 'pending', NULL, 102, '2019-04-09 00:45:49', '2019-04-09 00:45:49', ''),
(14, 101, 102, NULL, 'pending', NULL, 102, '2019-03-23 19:36:42', '2019-03-23 19:36:42', ''),
(17, 101, 102, NULL, 'pending', NULL, 102, '2019-04-09 00:45:49', '2019-04-09 00:45:49', ''),
(18, 202, 212, NULL, 'pending', NULL, 223, '2019-04-17 22:28:42', '2019-04-17 22:28:42', ''),
(19, 202, 212, NULL, 'pending', NULL, 223, '2019-04-17 22:28:42', '2019-04-17 22:28:42', ''),
(20, 202, 212, NULL, 'pending', NULL, 223, '2019-04-17 22:28:42', '2019-04-17 22:28:42', ''),
(21, 202, 212, NULL, 'pending', NULL, 223, '2019-04-17 22:28:42', '2019-04-17 22:28:42', ''),
(22, 101, 212, NULL, 'pending', NULL, 223, '2019-04-18 23:27:23', '2019-04-18 23:27:23', ''),
(23, 101, 212, NULL, 'pending', NULL, 223, '2019-04-18 23:27:23', '2019-04-18 23:27:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `tech`
--

CREATE TABLE `tech` (
  `tcid` int(10) UNSIGNED NOT NULL COMMENT '	Tech company record id',
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Logo image or url',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Website',
  `since` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Started Business Year',
  `store` char(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Repair Center',
  `remote` char(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Remote assistance',
  `on_site` char(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'On Site Service',
  `usp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Unique selling proposition (240 max char)',
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Detailed business info',
  `tax_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Sales tax id',
  `tax_id_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Image of sales tax permit',
  `mod_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Date last modified',
  `mod_by` int(10) UNSIGNED DEFAULT NULL COMMENT 'Modified by pid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tech`
--

INSERT INTO `tech` (`tcid`, `logo`, `url`, `since`, `store`, `remote`, `on_site`, `usp`, `description`, `tax_id`, `tax_id_image`, `mod_date`, `mod_by`, `created_at`, `updated_at`) VALUES
(102, 'c102-gpLogo174x35.png', 'https://gmsmatrix.com', '35', '1', '1', '1', '<p><em>...helping small business owners manage technology since 1984</em></p>\r\n', '<h1>Welcome -</h1>\r\n\r\n<p>I&#39;m Judy, Lou&#39;s daughter and faithful cheerleader. I help with non-technical stuff, like understanding the trials and tribulations of living in a highly technological world while not wanting to know anything about how technology works. I&#39;m the poster child for the ideal Guardian Managed Services client, so he picks my brain regularly to discover the best ways to serve you, the business owner who only wants to focus on their business instead of worrying about the electronics that keep it running. Below you&#39;ll find a few words from Dad, and he&#39;ll explain why he&#39;s great at what he does, so please read it. It&#39;ll give you the &quot;why&quot;&nbsp;you need to get your very own taylored protection package designed and running.</p>\r\n\r\n<p>Let me know if you need help, and thanks for stopping by!</p>\r\n\r\n<p>Judy</p>\r\n\r\n<p>~~~~~~~~~~~~~~~~~~~~~~~~~</p>\r\n\r\n<p>Please take just a minute to allow me to show why Guardian Partners would be your best choice. We take great pride in everything we do and can help you with all of the technology support needs including:</p>\r\n\r\n<ul>\r\n	<li>Maintenance</li>\r\n	<li>Repairs</li>\r\n	<li>Networking</li>\r\n	<li>Training on both hardware and software</li>\r\n</ul>\r\n\r\n<p>Since we do almost everything remotely, there is rarely the need for the added cost of on-site visits.</p>\r\n\r\n<p>Let us help you focus 100% on your business instead of wasting valuable time waiting on slow computers or, worse yet, being unable to work at all because of technology hassles.</p>\r\n\r\n<p>Click the button in the top right corner of this page to create a free account and choose Guardian Partners for tech support.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lou Smith, President</p>\r\n\r\n<p><em>Supporting smaill business owners since 1984.</em></p>\r\n', '', 'c102-tax_doc.pdf', '2017-06-08 00:58:20', NULL, '2017-05-09 17:23:08', '2019-02-06 02:40:38'),
(155, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-03 20:33:00', NULL, '2017-10-04 01:33:00', '2017-10-04 01:33:00'),
(154, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 15:02:10', NULL, '2017-10-04 20:02:10', '2017-10-04 20:02:10'),
(157, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 15:36:21', NULL, NULL, NULL),
(159, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 16:01:40', NULL, '2017-10-04 21:01:40', '2017-10-04 21:01:40'),
(158, '', '', 'noumantayyab', '0', '0', '0', '', '', 'Xoho@123', NULL, '2017-10-06 10:44:47', NULL, '2017-10-06 15:44:47', '2017-10-06 16:33:05'),
(201, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-25 12:43:42', NULL, NULL, NULL),
(212, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-18 06:17:41', NULL, '2018-01-18 12:17:41', '2018-01-18 12:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trns_#` int(10) UNSIGNED NOT NULL COMMENT 'Transaction record #',
  `cid` int(10) UNSIGNED NOT NULL COMMENT 'Links to cmpny -> cid',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Transaction Type',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paypal_data` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trns_#`, `cid`, `date`, `txn_type`, `created_at`, `updated_at`, `paypal_data`, `amount`) VALUES
(1, 212, '2018-01-04 13:58:24', 'adaptive', '2018-01-04 13:58:24', '2018-01-04 13:58:24', '{\"responseEnvelope\":{\"timestamp\":\"2018-01-03T23:58:25.388-08:00\",\"ack\":\"Success\",\"correlationId\":\"ede4b5ae83f6d\",\"build\":\"42045853\"},\"payKey\":\"AP-8L345507H6296783L\",\"paymentExecStatus\":\"CREATED\"}', 222.86),
(2, 212, '2018-01-04 14:01:28', 'adaptive', '2018-01-04 14:01:28', '2018-01-04 14:01:28', '{\"responseEnvelope\":{\"timestamp\":\"2018-01-04T00:01:29.078-08:00\",\"ack\":\"Success\",\"correlationId\":\"65818e481506e\",\"build\":\"42045853\"},\"payKey\":\"AP-2GJ30954S5513391H\",\"paymentExecStatus\":\"CREATED\"}', 222.86),
(3, 212, '2018-01-04 14:01:32', 'adaptive', '2018-01-04 14:01:32', '2018-01-04 14:01:32', '{\"responseEnvelope\":{\"timestamp\":\"2018-01-04T00:01:33.370-08:00\",\"ack\":\"Success\",\"correlationId\":\"2f07749e5d806\",\"build\":\"42045853\"},\"payKey\":\"AP-36B83162LR7617704\",\"paymentExecStatus\":\"CREATED\"}', 222.86),
(4, 212, '2019-04-10 17:20:29', 'adaptive', '2019-04-10 17:20:29', '2019-04-10 17:20:29', '{\"responseEnvelope\":{\"timestamp\":\"2019-04-10T05:20:29.715-07:00\",\"ack\":\"Success\",\"correlationId\":\"339596674d6df\",\"build\":\"52109087\"},\"payKey\":\"AP-97D79848JT364211P\",\"paymentExecStatus\":\"CREATED\"}', 819.52),
(5, 212, '2019-04-10 17:20:32', 'adaptive', '2019-04-10 17:20:32', '2019-04-10 17:20:32', '{\"responseEnvelope\":{\"timestamp\":\"2019-04-10T05:20:33.534-07:00\",\"ack\":\"Success\",\"correlationId\":\"d2f2a129a3249\",\"build\":\"52109087\"},\"payKey\":\"AP-4NJ02616JY654640T\",\"paymentExecStatus\":\"CREATED\"}', 819.52),
(6, 212, '2019-04-10 17:22:00', 'adaptive', '2019-04-10 17:22:00', '2019-04-10 17:22:00', '{\"responseEnvelope\":{\"timestamp\":\"2019-04-10T05:22:01.185-07:00\",\"ack\":\"Success\",\"correlationId\":\"3ae946fbe5f2d\",\"build\":\"52109087\"},\"payKey\":\"AP-1AE34333245154713\",\"paymentExecStatus\":\"CREATED\"}', 819.52);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `last_name`, `pic`, `cid`, `username`, `is_admin`, `activated`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(101, 'Lou', 'lou@guardianpartners.net', 'Smith', '', 101, 'global', 1, 1, '$2y$10$dLS/PC1SaA4K.VGHDRibNuGRXYEyzcNKqQaZUfdd6TQxuvd0yhNwW', 'mRsWMlXGnfpXr517qtVXIYQPb7XxR0zee93SBM4pvd9efWe1IlrA8YncF2Pg', NULL, '2017-12-14 03:00:48'),
(102, 'Lou', 'lou@guardiantm.com', 'Smith', 'c102-lou.png', 102, 'lou', 0, 1, '$2y$10$SrrBRX/fNtLq7PSej3uZf..EThXWIPQ/iogUP0q/LvY5zFQ18iaOK', 'mHe1PxuWBuLI6TydbgZ0JWO8keYA3CdLmuopjG7JoeWKZHokcLNFlSm9vDvw', '2017-05-09 17:22:12', '2019-02-06 02:37:25'),
(223, 'Mustabeen', 'mustabeen.iqbal3@gmail.com', 'Iqbal', '', 212, 'mustabeen', 0, 1, '$2y$10$E5baFtvQb9wu42I/ncyl6OGAXkP3UqbwtYese6eZ376.i8v3ruuSi', 'gXjdMygFwYwpXBJw9khXq5w1DivHYMYUXzwcyXIDH6ZwZ5Semjx3YBYxvctI', '2017-12-11 23:39:15', '2021-02-25 10:47:05'),
(224, 'Jacob', 'jacobdarinjones@gmail.com', 'Jones', '', 213, 'jacobj108', 0, 0, '$2y$10$H760O7lCp6L4M0ICAbsBpubtOESupf2pvxTb69Ia.idvooU.8jajK', NULL, '2017-12-13 22:25:58', '2017-12-13 22:25:58'),
(165, 'New', 'new@guardiantm.com', 'Tech', '', 155, 'newtech', 0, 1, '$2y$10$UQqhd/PPI5omgy3aL2/pP.d6QJfrJGTXBVVU/wkV5DaWgq6MNOsgu', 'm546xRum4FA5Cx8L7mG5diWmYSZQWpvXOCxXbiJelRd8hke8SbMgBvsApYzO', '2017-10-04 01:33:00', '2017-10-04 18:06:06'),
(166, 'New', 'newclient@guardiantm.com', 'Client', '', 156, 'newclient', 0, 1, '$2y$10$CxMCi3LSyDAccgGsjsDOQuJw8F.ljsenJN.IZP7IGZdcSnmtpWDL2', '2xHVnq7L9E1p1lATAl86bEk0xGczxvT5J0OCBm48oi8IlS5JxZFeqN5X7P8B', '2017-10-04 01:52:04', '2017-10-04 01:55:11'),
(163, 'Referred', 'referal@guardiantm.com', 'Client', '', 153, 'referred', 0, 1, '$2y$10$bhmTi.LMDS.TyCCvkjqYd.0BzyAmc3oqff5T.0BWO97e/Be6nIEWC', 'OuaRWwx94YmdqHt457GlCTSPHUgf2sJSMej9uS7h2dsJhjMAdQdncv1kmcKF', '2017-10-04 02:13:46', '2017-10-04 02:33:17'),
(103, 'Judy', 'gms@judyblackwell.com', 'Black', 'c102-judy.png', 102, 'judy', 1, 1, '$2y$10$a50/ELVFZlhs3/KW/eRiGeEUfoCVA0dHfCX4dB3wp0jqoCzui/DpG', '9RrXhtSCiTit9p5AlMLgs64roOClrLtFX9cfvk6qu64KWWCUJxkKVEcWpRo0', '2017-10-04 02:39:43', '2017-12-08 07:20:32'),
(164, 'Tom', 'hiTech@guardiantm.com', 'Grier', '', 154, 'hiTech', 0, 1, '$2y$10$yIA8hieVXTL7uJL9bYwD.O5gqVQJrgdHGi/.XzkQu4weAgvPSO9hS', 'hWi6erHDqVTJvcH1Ap00tw67TVk7nYLNXDzlQTfYGdTotAWL1y3XnQveV4VZ', '2017-10-04 20:02:10', '2017-10-04 20:04:30'),
(167, 'Dave', 'hd@guardiantm.com', 'Dave', '', 157, 'honest', 0, 1, '$2y$10$/zBt7gP1lDcUAozRDI.hwOWjU233emsbaFncSExxQhCuzcHxGGm2G', 'gJGvucDRkhsoSvWHRgaCf6BOhvhjbmK56iTApFlcQdNpqiefJnWnyizCucwa', '2017-10-04 20:31:25', '2017-10-04 20:42:18'),
(168, 'J W', 'bg@guardiantm.com', 'Li', '', 158, 'bgs', 0, 1, '$2y$10$xEYkCvsgtPrddKj8r7rtXeo1VYyvG6yjfrE63w7q8b8aFM/o0Q5Z2', 'V9694Y3TZ61KhLa44tNfPM7MyrHAUyuFmBrVm12nqnPJnElbsoJE0VEhphY3', '2017-10-04 20:46:16', '2017-10-04 20:51:34'),
(169, 'Amit', 'amit@guardiantm.com', 'Waisserberg', '', 159, 'amit', 0, 1, '$2y$10$NdMQ9FNdUB2mW31ZNtxdruDBOdyLPXptcgx4waNALTSjkeLIOsLF6', NULL, '2017-10-04 21:01:40', '2017-10-04 21:01:55'),
(211, 'Wende', 'wpgoodwin@sbcglobal.net', 'Goodwin', '', 201, 'Wende G', 0, 1, '$2y$10$foV71N5eccp.tnAJfdiBrOBTir3vbRnJKMNk1p8amNFDMnkFbTIZe', NULL, '2017-10-24 21:45:25', '2017-10-29 13:32:25'),
(213, 'Delia', 'dcbruno@cruzbrunolaw.com', 'Cruz-Bruno', '', 203, 'delia', 0, 1, '$2y$10$6gYpMTtuTK5yToF1EEIV.OFcik8rEnEqvHHx7aEKoQ6o6FRfZOxEW', 'knNZrIUubNUlCVy0sv1Br9I7HyLL2xVaOD7wV9sEvrOOyjdJmDtBCUZsTQk3', '2017-11-15 04:09:31', '2017-11-25 06:04:44'),
(214, 'Phil', 'phil@phildillappraisals.com', 'Dill', '', 204, 'phil', 0, 1, '$2y$10$Zb1cgMvw9Nno2OXLB9gyee6JMqGN3847XS23Pj3IjC3eAvf5fHNaa', 'TetifGq8ks9SPAH2VgiU9sWeOxAykzHKNuE7mrVPvhoOLx1PapcVW9yYzOzC', '2017-11-24 20:00:40', '2017-12-16 03:15:39'),
(215, 'Ted', 'paul@plappraisals.com', 'Love', '', 205, 'ted', 0, 1, '$2y$10$haYPeU/1Ese.q10jVj13C.ul0jLggNR7KG3OL1NUsLX05N7o.Y2XO', 'cdd1WFDMxgzKX6vqZIMfUr8B52dGt5sxDP1F3GCjvoLyseUr4tgVYZZXpdZW', '2017-11-25 05:22:35', '2017-11-25 05:31:26'),
(216, 'Eddie', 'eddie@russellappraisal.org', 'Russell', '', 206, 'Eddie', 0, 1, '$2y$10$vJKPrEBqohc0cXFQfRhrGuxtbs.IiZ6ZRG1gzcklw55VN/Y6sOdsq', '28eft21rGThXaOpAkUDah4qqWy6DbkF0ShZL4I8jtGNaWSnicxFmlb6YGQq3', '2017-11-25 05:33:13', '2017-11-25 05:38:12'),
(217, 'Grant', 'grant@guardiantm.com', 'Hill', '', 207, 'Grant', 0, 1, '$2y$10$jS1/5KI9fd8Lzlf5sJUjn.XsCbEhds5EqVySQWjh3E8v064ZFxNiy', '2muvukKFtyjFqd9TqnWRCLxKrFp9XH6qeOqYhoRrijYafALeaBXLc1PF2E9z', '2017-11-25 05:39:14', '2017-11-25 05:42:40'),
(218, 'Robert', 'lawyerkemp@cs.com', 'Kemp', '', 208, 'KempLaw', 0, 1, '$2y$10$x806lPVLFx0uGRL4LjWXLeebPUNJUOVXZV0ejQR5iQ6zKcocu4k5u', 'IsXziut5M7dxHfpe4YPJlzBkM7Guiag4M4BGZE6vghF2KnX6XGGOvs0x1CVM', '2017-11-25 05:44:10', '2017-11-25 05:55:23'),
(219, 'Kathy', 'kathy@lawyerkemp.com', 'Givens', '', 208, 'Kathy', 0, 1, '$2y$10$81kMi5hzlHVJvG6OtRo67u3FCTAZ2Vo9YV652U3n1gsK/SsT4CHG.', NULL, '2017-11-25 05:47:12', '2017-11-25 05:47:12'),
(220, 'Gary', 'kgaryrobertscpa@gmail.com', 'Roberts', '', 209, 'gary', 0, 1, '$2y$10$j70AuFDmX5F6NfJsEFDjpuLAyR.VP9x/Or/h68tv1sTvB6o/BFDMm', 'Ry9aFWaM5m1nqHbRgwJFpBgHLsjyieljHJBASnmhZBZt0YvyTe4oWe55yj5G', '2017-11-25 06:06:13', '2017-11-25 06:12:18'),
(221, 'Marsha', 'marsha@guardiantm.com', 'Halpern', '', 210, 'marsha', 0, 1, '$2y$10$YJJlSzGm7tdyM5Zi1jw2keynm8xq.CxX.1JeXTHg10L38drChUgDG', '9Z33UeGnu8Dhyo86nKPh5eTAgSjpahSZaMjvM7YzidNHU8btjYwtqHvnbLbQ', '2017-11-25 06:14:22', '2017-11-25 06:18:33'),
(225, 'Mustabeen', 'mustabeen.iqbal@tkxel.com', 'Iqbal', '', 214, 'tkxelmustabeen', 0, 0, '$2y$10$CJFovBVQogqn/cw2osaO5Od1qeiui6j87Rg3Yu2MFf./89nGDnEqe', NULL, '2021-02-25 10:53:16', '2021-02-25 10:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`user_id`, `token`, `created_at`) VALUES
(2, 'a970b5278d996f9c2fbc1f5ec9fdbe03769247051f2cccf39fe205b80a4c5cb1', '2017-04-27 03:45:55'),
(6, '2b93fa3c22bcdcf8614926d0da431ccba511b3676d30d79fa7d49d8a9c33ccd3', '2017-05-01 00:58:21'),
(11, 'd64c4b2f370db30f1c886804f8ac8cff7be7c0278a3db3348d11d45096702239', '2017-05-03 05:32:38'),
(12, 'da3d86d1f322fb46032c5daf3c7daa17749e2db133cea37e009e5dfb0dfad6e2', '2017-05-03 05:34:02'),
(13, '74267434c80d3a89955bb4e152e84bdcb0215ca477d17485ca000373a60898a7', '2017-05-03 17:08:50'),
(14, '05ef192a7766d056475444eae3272c7252051caa574b1b747d4badf6ea5b2724', '2017-05-05 13:48:58'),
(15, 'fc3a3211392c60b45dd50551bd8d31b653262e76f39a574596ea0d26760ce999', '2017-05-05 13:52:24'),
(16, 'b82644b83ef27114c38a6bd2a7fc4cfa5cf9504ec9321a2e75a9e8c41dda8796', '2017-05-05 13:57:25'),
(23, '5c8caf76ca271df4a7a85791264d2f5b4f134d4d360267e3a50057f7e3247a94', '2017-05-05 17:11:37'),
(34, '3f38daf135db888a8431f86e83a7aba61b0fddeec4e52b942b29e1f23cecaf9d', '2017-05-09 12:13:31'),
(35, '71114e9b177baac319f123ba3eec1363232400f2935eac1bee728c1df0377b70', '2017-05-09 12:18:34'),
(36, 'e7ed6eb45b6433f04e529bbfdef0a4c184c333871a21c381eae67d6d8f357041', '2017-05-09 12:19:48'),
(37, '97ab3dd53641b865ab4b0c64c41aa0fbaa9d20f1975de8c309aead199627248e', '2017-05-09 12:21:35'),
(43, '941182fff44006cac35170f0ae141c8a5a651db172c9b197de5cfe05ae1e4baa', '2017-05-13 17:01:08'),
(44, '8a8607302ce67b648c10037cc57003cb2ddc774d74680eb16dcf4d1424dc1573', '2017-05-16 22:06:52'),
(49, '9e6ba2f00db3e8b6709c8ab1b63817955734e4eac5ab1308cb78c4b1801ab247', '2017-05-22 15:16:24'),
(50, 'bd3a1d43ce8c4587d984e1359ab109a78038aae0b58403bbc8280631d26b7a08', '2017-05-26 14:27:58'),
(70, '3723b98671e5b06ba866851e630f9d722d047732fe64afe20b178ceb8edd380c', '2017-06-03 14:39:04'),
(71, '2d8537b54e2e1918e9bc87fe0db713d0bd4ca13883f98afbbe9f376e84eec9d6', '2017-06-03 14:44:28'),
(72, '6d53b0a66ad4eb8419437b04e9122413bc7895e92917284cfe79964ce59b8260', '2017-06-03 14:50:28'),
(76, '173b435dca4b4a3836935785dc9c05bb4b7fbfb4c51178932a9fce2c9270a716', '2017-06-06 11:29:44'),
(77, '0e9ba89e570051ac68a0770af401b6d286ad674014abdcb9c669b1fe96bf5323', '2017-06-06 11:32:13'),
(78, '2e36d3dda31f08545ec081814cba10774629e1a4ff037b7d7dde1cd5c0fa6c29', '2017-06-06 11:34:00'),
(81, '432dcf074d457ae77878154463f5dd3f43098a84f6e242a43d37b2ce58b9479d', '2017-06-06 11:44:52'),
(86, 'eff278709bd564095be6221f9294e4a17dae35d99f99eaf8e71795de7b1d9fdc', '2017-06-07 16:42:51'),
(87, '32334d4c9348419efe2a48f63efa248aaac5df6bb3d02c7b4d0cb8cce7761208', '2017-06-07 16:46:06'),
(88, 'c1c83e92b18105c6a59a59440a3718d3098564c6a41a3efc4495cae1114015f9', '2017-06-07 16:49:03'),
(91, '4d2de2c50cc82e509bee57eb5cf5b767a71f4fd4ef4aadeea9ef511222d50f40', '2017-06-07 17:08:06'),
(98, '1c8229e4f2ec360386e224cd4fe41263e91b6e7c652ea7fbfc9904b02d8ec74d', '2017-06-14 15:44:50'),
(99, '94cb20d2b1a432b84c4f1e14c7781de9c62ee43538dea9455e1c572bc1910e8d', '2017-06-14 15:44:58'),
(101, '173a9ad31f41e7c99a58200a6bdd373b883f2beab460781aaf6bb434bdaeecbe', '2017-06-14 15:49:57'),
(102, '01e36783ae7776821b6e82a3708d42b3343c9d9c248729b7ec9a8c0509fae75b', '2017-06-14 15:50:09'),
(104, 'c00b47c70e53d02fc4fb3b521cef39d1e6f7779995e1a1268d5bd90ff1691e25', '2017-06-14 15:57:26'),
(105, '19bbd676e155ee3dd03cbc15661c2501a9820bf284ee94bfdacf51d9d0573411', '2017-06-14 16:06:01'),
(108, '7bee990b5b250d764637f70855d90cc6247d430a2725d80d7f9240c41a1a8fff', '2017-06-14 21:13:12'),
(109, '00c7176d4e3226be4a9ff2e7d89b7e36cbff99456603eae0cfb18f0b3b443511', '2017-06-30 07:18:01'),
(110, 'c8ea684da338f5b77c0b1478ab65dd8cf66c46c4b43ae1ee824aef227f944039', '2017-06-30 07:19:58'),
(111, 'ca695893ee1baadfdab337e8f0da1bd57fb507a618bf360c0d3681c8e0e9c05d', '2017-07-17 16:56:44'),
(113, '90c5927a3c74961524070daa9ae49b9d576cb76397ddb479571595e3d59532c2', '2017-07-19 10:03:48'),
(114, '177f85c3c284d86d078c1cd8f44c0f378e32ee5111db4a492a51edfe8358d5a0', '2017-07-19 10:09:39'),
(115, '652818cc5a127f02e88e03e8ffb3c61c3adbc5bc2319e2d4f3745d9d14eac359', '2017-07-19 10:29:01'),
(116, 'aa9e7f64fcb0302d059227e75063f173b41772baf9e872d84309ae5cdb9d84ce', '2017-07-19 17:17:04'),
(118, 'eb2e99d96bb6790179b7ca2f8c71d53ef1e06e7708a55acbac9fd821ecd63671', '2017-07-19 17:28:51'),
(119, '61e4998f94a246a77cc1f4203aa2f1bdb2c24bb4d747a2f13a4acc9691e9d123', '2017-07-19 17:31:07'),
(120, '596099f61b4af9bc7fe4617984c5f1d5a93dcf888c6472d067bf54a8b8461ee3', '2017-07-19 17:33:02'),
(121, '60d71a6c28e8270c8aa327bdc469a427e4fd20ce7b59847f41044a8f4139854f', '2017-07-20 10:59:25'),
(123, '6cbc1352a4bfb1eebbd0eb7fc9d3a7a045e2ae707c9efca5fec7605afd20f6a2', '2017-07-20 17:25:56'),
(213, '85313e3907f943b55a888ccde7c3316a18b5916ea55bb671658063fd0605dbe0', '2017-11-15 04:09:31'),
(224, '25bed0d0380ea45fa25c225d66e37dc4679801936ea6c4d018cdf75ad227a708', '2017-12-13 22:25:58'),
(225, '347bf1ceddacf987d6e182675674a0950aa8b790666965c65976152db043728b', '2021-02-25 10:53:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocate`
--
ALTER TABLE `allocate`
  ADD PRIMARY KEY (`recnum`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`apprvl_id`),
  ADD KEY `approval_cid_foreign` (`cid`);

--
-- Indexes for table `cmpny`
--
ALTER TABLE `cmpny`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cmpny_tcid_foreign` (`tcid`),
  ADD KEY `date` (`expires`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`e_addr`),
  ADD KEY `email_pid_foreign` (`pid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `location_cid_foreign` (`cid`),
  ADD KEY `location_mod_by_foreign` (`mod_by`),
  ADD KEY `Postal Code Lookup` (`postal`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`recnum`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`nbr`,`pid`),
  ADD KEY `phone_pid_foreign` (`pid`),
  ADD KEY `phone_mod_by_foreign` (`mod_by`);

--
-- Indexes for table `site_vars`
--
ALTER TABLE `site_vars`
  ADD PRIMARY KEY (`recnum`);

--
-- Indexes for table `srv`
--
ALTER TABLE `srv`
  ADD PRIMARY KEY (`srv_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `sub_srv_id_foreign` (`srv_id`),
  ADD KEY `sub_lid_foreign` (`lid`),
  ADD KEY `sub_cid_foreign` (`cid`),
  ADD KEY `sub_mod_by_foreign` (`mod_by`),
  ADD KEY `GUID` (`guid`);

--
-- Indexes for table `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`tcid`),
  ADD KEY `tech_mod_by_foreign` (`mod_by`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trns_#`),
  ADD KEY `transaction_cid_foreign` (`cid`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD KEY `user_activations_user_id_foreign` (`user_id`),
  ADD KEY `user_activations_token_index` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate`
--
ALTER TABLE `allocate`
  MODIFY `recnum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'record number', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `apprvl_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Approval record id', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cmpny`
--
ALTER TABLE `cmpny`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Record id for company', AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Record #', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `distance`
--
ALTER TABLE `distance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `recnum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_vars`
--
ALTER TABLE `site_vars`
  MODIFY `recnum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `srv`
--
ALTER TABLE `srv`
  MODIFY `srv_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Service ID', AUTO_INCREMENT=908;

--
-- AUTO_INCREMENT for table `sub`
--
ALTER TABLE `sub`
  MODIFY `sid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscription ID', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tech`
--
ALTER TABLE `tech`
  MODIFY `tcid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '	Tech company record id', AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trns_#` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Transaction record #', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
