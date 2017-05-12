-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 12, 2017 at 03:15 AM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cofa`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`) VALUES
(1, 'ABC'),
(2, 'xyz'),
(3, 'abc'),
(4, 'xyz'),
(5, 'abc'),
(6, 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_uuid` varchar(100) NOT NULL,
  `order_uuid` varchar(100) NOT NULL,
  `product_range` varchar(100) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_remarks` varchar(100) NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `completion_date` varchar(100) NOT NULL,
  `shoot_date` date NOT NULL,
  `edit_employee_id_1` int(11) NOT NULL,
  `edit_employee1_status` varchar(150) NOT NULL,
  `edit_employee_id_2` int(11) NOT NULL,
  `edit_employee2_status` varchar(150) NOT NULL,
  `design_employee_id_1` int(11) NOT NULL,
  `design_employee1_status` varchar(150) NOT NULL,
  `design_employee_id_2` int(11) NOT NULL,
  `design_employee2_status` varchar(150) NOT NULL,
  `remarks_shoot` varchar(500) NOT NULL,
  `remarks_edit` varchar(500) NOT NULL,
  `remarks_design` varchar(500) NOT NULL,
  `remarks_catalog` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_uuid`, `order_uuid`, `product_range`, `product_count`, `product_remarks`, `job_status`, `created_date`, `completion_date`, `shoot_date`, `edit_employee_id_1`, `edit_employee1_status`, `edit_employee_id_2`, `edit_employee2_status`, `design_employee_id_1`, `design_employee1_status`, `design_employee_id_2`, `design_employee2_status`, `remarks_shoot`, `remarks_edit`, `remarks_design`, `remarks_catalog`) VALUES
(1, 'JOB_FZ14652ST88703_1', 'cofa_FZ14652ST88703', 'men', 20, 'High', 'designcompleted', '2016-06-08 11:54:15', '0000-00-00 00:00:00', '2016-06-28', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(2, 'JOB_FZ14652ST88703_2', 'cofa_FZ14652ST88703', 'kids', 30, 'Low', 'editstarted', '2016-06-08 11:54:15', '0000-00-00 00:00:00', '2016-06-22', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(3, 'JOB_FZ14652ST88703_3', 'cofa_FZ14652ST88703', 'others', 20, 'Medium', 'designcompleted', '2016-06-08 11:54:15', '0000-00-00 00:00:00', '2016-06-23', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(4, 'cofa_rD14652XX88556_1', 'cofa_rD14652XX88556', 'men', 20, 'High', 'catalogcompleted', '2016-06-16 19:49:03', '0000-00-00 00:00:00', '2016-07-05', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(5, 'cofa_rD14652XX88556_2', 'cofa_rD14652XX88556', 'kids', 30, 'Low', 'movedtoshoot', '2016-06-16 19:49:03', '0000-00-00 00:00:00', '2016-06-24', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(6, 'cofa_rD14652XX88556_3', 'cofa_rD14652XX88556', 'others', 20, 'Medium', 'catalogstarted', '2016-06-16 19:49:03', '0000-00-00 00:00:00', '2016-06-22', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(7, 'cofa_hm14652bn88136_1', 'cofa_hm14652bn88136', 'men', 10, 'High', 'catalogcompleted', '2016-06-21 23:28:22', '0000-00-00 00:00:00', '2016-06-23', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(8, 'cofa_hm14652bn88136_2', 'cofa_hm14652bn88136', 'tabletop', 20, 'Medium', 'catalogcompleted', '2016-06-21 23:28:22', '0000-00-00 00:00:00', '2016-06-22', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(9, 'cofa_Ql14652JX88422_1', 'cofa_Ql14652JX88422', 'men', 20, 'High', 'editstarted', '2016-06-26 11:46:10', '0000-00-00 00:00:00', '2016-06-27', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(10, 'cofa_Ql14652JX88422_2', 'cofa_Ql14652JX88422', 'kids', 30, 'Low', 'shootstarted', '2016-06-26 11:46:11', '0000-00-00 00:00:00', '2016-06-27', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(11, 'cofa_Ql14652JX88422_3', 'cofa_Ql14652JX88422', 'others', 20, 'Medium', 'created', '2016-06-26 11:46:11', '0000-00-00 00:00:00', '0000-00-00', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(12, 'JOB_JB14669gf22131_1', 'ORD_JB14669gf22131', 'men', 0, '', 'designcompleted', '2016-06-26 17:19:14', '0000-00-00 00:00:00', '2016-06-27', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(13, 'JOB_JB14669gf22131_2', 'ORD_JB14669gf22131', 'women', 0, '', 'designcompleted', '2016-06-26 17:19:14', '0000-00-00 00:00:00', '2016-06-27', 1, '12345', 2, '678910', 1, 'abcd', 5, 'efgh', '', '', '', ''),
(14, 'JOB_gp14669ao54471_1', 'ORD_gp14669ao54471', 'men', 0, '', 'shootcompleted', '2016-06-26 20:51:59', '0000-00-00 00:00:00', '2016-06-27', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(15, 'JOB_eE14669Yo60805_1', 'ORD_eE14669Yo60805', 'men', 0, '', 'shootstarted', '2016-06-26 22:38:25', '0000-00-00 00:00:00', '2016-06-27', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(16, 'JOB_eE14669Yo60805_2', 'ORD_eE14669Yo60805', 'women', 0, '', 'designstarted', '2016-06-26 22:38:25', '0000-00-00 00:00:00', '2016-06-28', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(17, 'JOB_Wc14670SE10587_1', 'ORD_Wc14670SE10587', 'men', 0, '', 'catalogcompleted', '2016-06-27 12:27:33', '0000-00-00 00:00:00', '2016-06-28', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(18, 'JOB_Wc14670SE10587_2', 'ORD_Wc14670SE10587', 'kids', 0, '', 'catalogcompleted', '2016-06-27 12:27:33', '0000-00-00 00:00:00', '2016-06-28', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(19, 'JOB_rH14671oo47799_1', 'ORD_rH14671oo47799', 'men', 0, '', 'catalogcompleted', '2016-06-29 02:34:16', '0000-00-00 00:00:00', '2016-06-30', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(20, 'JOB_rH14671oo47799_2', 'ORD_rH14671oo47799', 'women', 0, '', 'catalogcompleted', '2016-06-29 02:34:16', '0000-00-00 00:00:00', '2016-06-30', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(21, 'JOB_Vt14671Lw49767_1', 'ORD_Vt14671Lw49767', 'men', 0, '', 'shootcompleted', '2016-06-29 03:06:55', '0000-00-00 00:00:00', '2016-06-30', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(22, 'JOB_Vt14671Lw49767_2', 'ORD_Vt14671Lw49767', 'women', 0, '', 'shootcompleted', '2016-06-29 03:06:55', '0000-00-00 00:00:00', '2016-06-30', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(23, 'JOB_LD14671sd50087_1', 'ORD_LD14671sd50087', 'men', 0, '', 'catalogcompleted', '2016-06-29 03:12:16', '0000-00-00 00:00:00', '2016-06-30', 0, '0', 0, '0', 0, '', 0, '', '', '', '', ''),
(24, 'JOB_gC14671PE72724_1', 'ORD_gC14671PE72724', 'men', 0, '', 'shootstarted', '2016-06-29 18:27:32', '0000-00-00 00:00:00', '2016-06-30', 0, '', 0, '', 0, '', 0, '', '', '', '', ''),
(25, 'JOB_gC14671PE72724_2', 'ORD_gC14671PE72724', 'women', 0, '', 'shootcompleted', '2016-06-29 18:27:33', '0000-00-00 00:00:00', '2016-07-03', 0, '', 0, '', 0, '', 0, '', '', '', '', ''),
(26, 'JOB_062016_10_1', 'ORD_062016_10', 'men', 0, '', 'shootcompleted', '2016-07-03 07:14:35', '0000-00-00 00:00:00', '2016-07-04', 0, '', 0, '', 0, '', 0, '', '', '', '', ''),
(27, 'JOB_072016_1_1', 'ORD_072016_1', 'men', 0, 'HIgh', 'catalogcompleted', '2016-07-03 07:17:02', '0000-00-00 00:00:00', '2016-07-19', 0, '', 0, '', 0, '', 0, '', '', '', '', ''),
(28, 'JOB_072016_1_2', 'ORD_072016_1', 'women', 0, '', 'catalogcompleted', '2016-07-03 07:17:02', '0000-00-00 00:00:00', '2016-07-21', 0, '', 0, '', 0, '', 0, '', 'cmpltd', 'Edit cmpltd', 'Design Completed', 'completed'),
(29, 'JOB_072016_1_3', 'ORD_072016_1', 'kids', 0, '', 'shootcompleted', '2016-07-03 07:17:02', '0000-00-00 00:00:00', '2016-07-22', 0, '', 0, '', 0, '', 0, '', 'cmp', '', '', ''),
(30, 'JOB_072016_1_4', 'ORD_072016_1', 'tabletop', 0, '', 'shootcompleted', '2016-07-03 07:17:02', '0000-00-00 00:00:00', '2016-07-22', 0, '', 0, '', 0, '', 0, '', 'cmpp', '', '', ''),
(31, 'JOB_072016_1_5', 'ORD_072016_1', 'others', 0, '', 'shootcompleted', '2016-07-03 07:17:02', '0000-00-00 00:00:00', '2016-07-22', 0, '', 0, '', 0, '', 0, '', 'cmppp', '', '', ''),
(32, 'JOB_072016_4_1', 'ORD_072016_4', 'men', 0, '', 'shootcompleted', '2016-07-21 07:11:27', '0000-00-00 00:00:00', '2016-07-22', 0, '', 0, '', 0, '', 0, '', 'cpmltd', '', '', ''),
(33, 'JOB_042017_2_1', 'ORD_042017_2', 'men', 0, '', 'shootcompleted', '2017-04-29 21:43:22', '', '2017-05-01', 0, '', 0, '', 0, '', 0, '', '', '', '', ''),
(34, 'JOB_042017_2_2', 'ORD_042017_2', 'women', 0, '', 'shootcompleted', '2017-04-29 21:43:22', '', '2017-05-01', 0, '', 0, '', 0, '', 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_log`
--

CREATE TABLE `job_log` (
  `job_log_id` int(11) NOT NULL,
  `job_uuid` varchar(100) NOT NULL,
  `log_type` varchar(100) NOT NULL,
  `status_from` varchar(100) NOT NULL,
  `status_to` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `log_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_log`
--

INSERT INTO `job_log` (`job_log_id`, `job_uuid`, `log_type`, `status_from`, `status_to`, `remarks`, `log_date`) VALUES
(1, 'JOB_FZ14652ST88703_1', 'warehouse', '', 'Not Informed', '', '2016-06-16 18:00:21'),
(2, 'JOB_FZ14652ST88703_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-16 18:00:21'),
(3, 'JOB_FZ14652ST88703_1', 'warehouse', 'reached', 'notinformed', '', '2016-06-16 19:21:21'),
(4, 'JOB_FZ14652ST88703_1', 'warehouse', 'notinformed', 'informed', '', '2016-06-16 19:21:48'),
(5, 'cofa_rD14652XX88556_1', 'warehouse', '', 'notinformed', '', '2016-06-16 19:49:49'),
(6, 'cofa_rD14652XX88556_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-16 19:49:49'),
(7, 'cofa_rD14652XX88556_1', 'warehouse', 'notinformed', 'informed', '', '2016-06-16 19:50:01'),
(8, 'JOB_FZ14652ST88703_2', 'warehouse', '', 'notinformed', '', '2016-06-21 18:47:52'),
(9, 'JOB_FZ14652ST88703_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-21 18:47:52'),
(10, 'JOB_FZ14652ST88703_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-21 20:39:14'),
(11, 'JOB_FZ14652ST88703_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-21 20:39:39'),
(12, 'cofa_rD14652XX88556_3', 'warehouse', '', 'notinformed', '', '2016-06-21 20:41:19'),
(13, 'cofa_rD14652XX88556_3', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-21 20:41:19'),
(14, 'cofa_rD14652XX88556_3', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-21 20:42:01'),
(15, 'cofa_rD14652XX88556_3', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-21 20:42:27'),
(16, 'JOB_FZ14652ST88703_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-21 22:30:52'),
(17, 'cofa_rD14652XX88556_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-21 22:31:02'),
(18, 'JOB_FZ14652ST88703_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-21 22:31:30'),
(19, 'cofa_rD14652XX88556_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-21 22:31:35'),
(20, 'cofa_hm14652bn88136_2', 'warehouse', '', 'notinformed', '', '2016-06-21 23:29:27'),
(21, 'cofa_hm14652bn88136_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-21 23:29:27'),
(22, 'cofa_hm14652bn88136_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-21 23:30:22'),
(23, 'cofa_hm14652bn88136_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-21 23:59:42'),
(24, 'cofa_hm14652bn88136_1', 'warehouse', '', 'notinformed', '', '2016-06-22 00:01:02'),
(25, 'cofa_hm14652bn88136_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-22 00:01:02'),
(26, 'cofa_rD14652XX88556_3', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-22 00:37:10'),
(27, 'cofa_rD14652XX88556_3', 'edit', 'editstarted', 'editcompleted', '', '2016-06-22 00:37:19'),
(28, 'cofa_hm14652bn88136_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-22 00:45:33'),
(29, 'cofa_hm14652bn88136_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-22 00:45:42'),
(30, 'cofa_hm14652bn88136_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-22 00:46:00'),
(31, 'cofa_hm14652bn88136_1', 'edit', 'editstarted', 'editcompleted', '', '2016-06-22 00:46:07'),
(32, 'cofa_hm14652bn88136_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-22 00:46:15'),
(33, 'cofa_hm14652bn88136_2', 'edit', 'editstarted', 'editcompleted', '', '2016-06-22 00:46:21'),
(34, 'cofa_hm14652bn88136_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-22 00:51:01'),
(35, 'cofa_hm14652bn88136_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-22 00:51:09'),
(36, 'cofa_rD14652XX88556_3', 'design', 'editcompleted', 'designstarted', '', '2016-06-22 00:51:19'),
(37, 'cofa_rD14652XX88556_3', 'design', 'designstarted', 'designcompleted', '', '2016-06-22 00:51:24'),
(38, 'cofa_hm14652bn88136_1', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-22 00:59:05'),
(39, 'cofa_hm14652bn88136_1', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-22 00:59:10'),
(40, 'JOB_FZ14652ST88703_3', 'warehouse', '', 'notinformed', '', '2016-06-22 08:11:12'),
(41, 'JOB_FZ14652ST88703_3', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-22 08:11:12'),
(42, 'cofa_rD14652XX88556_2', 'warehouse', '', 'notinformed', '', '2016-06-23 07:50:24'),
(43, 'cofa_rD14652XX88556_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-23 07:50:24'),
(44, 'JOB_FZ14652ST88703_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-23 07:56:16'),
(45, 'JOB_FZ14652ST88703_1', 'edit', 'editstarted', 'editcompleted', '', '2016-06-23 07:56:23'),
(46, 'JOB_FZ14652ST88703_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-23 07:56:39'),
(47, 'JOB_FZ14652ST88703_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-23 07:56:44'),
(48, 'JOB_FZ14652ST88703_2', 'warehouse', 'notinformed', 'informed', '', '2016-06-26 11:33:21'),
(49, 'JOB_FZ14652ST88703_2', 'warehouse', 'informed', 'reached', '', '2016-06-26 11:33:47'),
(50, 'cofa_hm14652bn88136_2', 'design', 'editcompleted', 'designstarted', '', '2016-06-26 14:24:55'),
(51, 'cofa_hm14652bn88136_2', 'design', 'designstarted', 'designcompleted', '', '2016-06-26 14:25:00'),
(52, 'cofa_hm14652bn88136_2', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-26 14:25:19'),
(53, 'cofa_hm14652bn88136_2', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-26 14:25:25'),
(54, 'cofa_rD14652XX88556_3', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-26 16:40:26'),
(55, 'cofa_Ql14652JX88422_1', 'warehouse', '', 'notinformed', '', '2016-06-26 16:56:15'),
(56, 'cofa_Ql14652JX88422_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 16:56:15'),
(57, 'cofa_Ql14652JX88422_2', 'warehouse', '', 'notinformed', '', '2016-06-26 16:56:23'),
(58, 'cofa_Ql14652JX88422_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 16:56:23'),
(59, 'cofa_Ql14652JX88422_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 16:56:37'),
(60, 'cofa_Ql14652JX88422_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 17:00:56'),
(61, 'cofa_Ql14652JX88422_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 17:01:13'),
(62, 'cofa_Ql14652JX88422_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 17:01:27'),
(63, 'JOB_FZ14652ST88703_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 17:18:29'),
(64, 'JOB_JB14669gf22131_1', 'warehouse', '', 'notinformed', '', '2016-06-26 17:31:06'),
(65, 'JOB_JB14669gf22131_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 17:31:06'),
(66, 'JOB_JB14669gf22131_2', 'warehouse', '', 'notinformed', '', '2016-06-26 17:31:39'),
(67, 'JOB_JB14669gf22131_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 17:31:39'),
(68, 'JOB_JB14669gf22131_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 17:32:22'),
(69, 'JOB_JB14669gf22131_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 17:33:05'),
(70, 'JOB_JB14669gf22131_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 17:33:13'),
(71, 'JOB_JB14669gf22131_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 17:33:38'),
(72, 'JOB_gp14669ao54471_1', 'warehouse', '', 'notinformed', '', '2016-06-26 20:52:45'),
(73, 'JOB_gp14669ao54471_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 20:52:46'),
(74, 'JOB_gp14669ao54471_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 20:53:27'),
(75, 'cofa_rD14652XX88556_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 21:28:58'),
(76, 'cofa_rD14652XX88556_1', 'edit', 'editstarted', 'editcompleted', '', '2016-06-26 21:29:09'),
(77, 'cofa_rD14652XX88556_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-26 21:29:21'),
(78, 'cofa_rD14652XX88556_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-26 21:29:29'),
(79, 'cofa_rD14652XX88556_1', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-26 21:29:41'),
(80, 'cofa_rD14652XX88556_1', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-26 21:29:57'),
(81, 'JOB_JB14669gf22131_1', 'edit', 'editstarted', 'editcompleted', '', '2016-06-26 21:31:06'),
(82, 'JOB_JB14669gf22131_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-26 21:31:20'),
(83, 'JOB_JB14669gf22131_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-26 21:31:29'),
(84, 'JOB_FZ14652ST88703_3', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 22:24:23'),
(85, 'JOB_FZ14652ST88703_3', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 22:24:47'),
(86, 'JOB_FZ14652ST88703_3', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 22:25:13'),
(87, 'JOB_FZ14652ST88703_3', 'edit', 'editstarted', 'editcompleted', '', '2016-06-26 22:26:20'),
(88, 'JOB_FZ14652ST88703_3', 'design', 'editcompleted', 'designstarted', '', '2016-06-26 22:26:33'),
(89, 'JOB_FZ14652ST88703_3', 'design', 'designstarted', 'designcompleted', '', '2016-06-26 22:26:49'),
(90, 'JOB_gp14669ao54471_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 22:36:31'),
(91, 'JOB_eE14669Yo60805_1', 'warehouse', '', 'notinformed', '', '2016-06-26 22:39:54'),
(92, 'JOB_eE14669Yo60805_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 22:39:54'),
(93, 'JOB_eE14669Yo60805_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 22:41:24'),
(94, 'JOB_eE14669Yo60805_2', 'warehouse', '', 'notinformed', '', '2016-06-26 22:42:07'),
(95, 'JOB_eE14669Yo60805_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-26 22:42:07'),
(96, 'JOB_eE14669Yo60805_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-26 22:42:21'),
(97, 'JOB_eE14669Yo60805_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 22:42:46'),
(98, 'JOB_JB14669gf22131_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-26 22:52:03'),
(99, 'JOB_JB14669gf22131_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 22:52:17'),
(100, 'JOB_eE14669Yo60805_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-26 22:53:52'),
(101, 'JOB_eE14669Yo60805_2', 'edit', 'editstarted', 'editcompleted', '', '2016-06-26 22:54:22'),
(102, 'JOB_eE14669Yo60805_2', 'design', 'editcompleted', 'designstarted', '', '2016-06-26 22:54:43'),
(103, 'JOB_Wc14670SE10587_1', 'warehouse', '', 'notinformed', '', '2016-06-27 12:28:20'),
(104, 'JOB_Wc14670SE10587_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-27 12:28:20'),
(105, 'JOB_Wc14670SE10587_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-27 12:28:46'),
(106, 'JOB_Wc14670SE10587_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-27 12:29:05'),
(107, 'JOB_Wc14670SE10587_1', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-27 12:40:23'),
(108, 'JOB_Wc14670SE10587_1', 'edit', 'editstarted', 'editcompleted', '', '2016-06-27 12:43:16'),
(109, 'JOB_Wc14670SE10587_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-27 12:43:26'),
(110, 'JOB_Wc14670SE10587_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-27 12:43:31'),
(111, 'JOB_Wc14670SE10587_2', 'warehouse', '', 'notinformed', '', '2016-06-27 12:43:46'),
(112, 'JOB_Wc14670SE10587_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-27 12:43:46'),
(113, 'JOB_Wc14670SE10587_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-27 12:43:56'),
(114, 'JOB_Wc14670SE10587_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-27 12:44:00'),
(115, 'JOB_Wc14670SE10587_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-06-27 12:44:13'),
(116, 'JOB_Wc14670SE10587_2', 'edit', 'editstarted', 'editcompleted', '', '2016-06-27 12:44:18'),
(117, 'JOB_Wc14670SE10587_2', 'design', 'editcompleted', 'designstarted', '', '2016-06-27 12:44:36'),
(118, 'JOB_Wc14670SE10587_2', 'design', 'designstarted', 'designcompleted', '', '2016-06-27 12:44:41'),
(119, 'JOB_Wc14670SE10587_2', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-27 12:45:22'),
(120, 'JOB_Wc14670SE10587_2', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-27 12:45:30'),
(121, 'JOB_Wc14670SE10587_1', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-06-27 12:45:42'),
(122, 'JOB_Wc14670SE10587_1', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-27 12:45:52'),
(123, 'JOB_eE14669Yo60805_1', 'warehouse', 'notinformed', 'informed', '', '2016-06-29 01:35:28'),
(124, 'JOB_eE14669Yo60805_1', 'warehouse', 'informed', 'reached', '', '2016-06-29 01:35:39'),
(125, 'JOB_eE14669Yo60805_2', 'warehouse', 'notinformed', 'informed', '', '2016-06-29 01:35:47'),
(126, 'JOB_eE14669Yo60805_2', 'warehouse', 'informed', 'reached', '', '2016-06-29 01:36:06'),
(127, 'JOB_gp14669ao54471_1', 'warehouse', 'notinformed', 'reached', '', '2016-06-29 02:04:47'),
(128, 'JOB_gp14669ao54471_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:06:31'),
(129, 'JOB_gp14669ao54471_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:07:57'),
(130, 'JOB_gp14669ao54471_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:21:53'),
(131, 'JOB_gp14669ao54471_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:24:25'),
(132, 'JOB_rH14671oo47799_1', 'warehouse', '', 'notinformed', '', '2016-06-29 02:34:35'),
(133, 'JOB_rH14671oo47799_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 02:34:35'),
(134, 'JOB_rH14671oo47799_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-29 02:35:14'),
(135, 'JOB_rH14671oo47799_1', 'warehouse', 'notinformed', 'informed', '', '2016-06-29 02:35:33'),
(136, 'JOB_rH14671oo47799_1', 'warehouse', 'informed', 'reached', '', '2016-06-29 02:35:39'),
(137, 'JOB_rH14671oo47799_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:35:52'),
(138, 'JOB_rH14671oo47799_2', 'warehouse', '', 'notinformed', '', '2016-06-29 02:36:17'),
(139, 'JOB_rH14671oo47799_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 02:36:17'),
(140, 'JOB_rH14671oo47799_2', 'warehouse', 'notinformed', 'reached', '', '2016-06-29 02:36:29'),
(141, 'JOB_rH14671oo47799_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-06-29 02:36:46'),
(142, 'JOB_rH14671oo47799_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-06-29 02:36:55'),
(143, 'JOB_rH14671oo47799_1', 'edit', 'shootcompleted', 'editcompleted', '', '2016-06-29 02:38:36'),
(144, 'JOB_rH14671oo47799_2', 'edit', 'shootcompleted', 'editcompleted', '', '2016-06-29 02:38:43'),
(145, 'JOB_rH14671oo47799_1', 'design', 'editcompleted', 'designstarted', '', '2016-06-29 02:39:59'),
(146, 'JOB_rH14671oo47799_1', 'design', 'designstarted', 'designcompleted', '', '2016-06-29 02:52:04'),
(147, 'JOB_rH14671oo47799_2', 'design', 'editcompleted', 'designcompleted', '', '2016-06-29 02:52:22'),
(148, 'JOB_rH14671oo47799_2', 'catalog', 'designcompleted', 'catalogcompleted', '', '2016-06-29 02:56:27'),
(149, 'JOB_rH14671oo47799_1', 'catalog', 'designcompleted', 'catalogcompleted', '', '2016-06-29 02:56:45'),
(150, 'JOB_Wc14670SE10587_1', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-29 02:59:25'),
(151, 'JOB_Wc14670SE10587_2', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-06-29 02:59:48'),
(152, 'JOB_Vt14671Lw49767_1', 'warehouse', '', 'notinformed', '', '2016-06-29 03:07:08'),
(153, 'JOB_Vt14671Lw49767_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 03:07:08'),
(154, 'JOB_Vt14671Lw49767_1', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-06-29 03:10:16'),
(155, 'JOB_Vt14671Lw49767_2', 'warehouse', '', 'notinformed', '', '2016-06-29 03:10:40'),
(156, 'JOB_Vt14671Lw49767_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 03:10:40'),
(157, 'JOB_Vt14671Lw49767_2', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-06-29 03:10:53'),
(158, 'JOB_LD14671sd50087_1', 'warehouse', '', 'notinformed', '', '2016-06-29 03:12:38'),
(159, 'JOB_LD14671sd50087_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 03:12:38'),
(160, 'JOB_LD14671sd50087_1', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-06-29 03:12:54'),
(161, 'JOB_LD14671sd50087_1', 'edit', 'shootcompleted', 'editcompleted', '', '2016-06-29 03:13:34'),
(162, 'JOB_LD14671sd50087_1', 'design', 'editcompleted', 'designcompleted', '', '2016-06-29 03:14:01'),
(163, 'JOB_LD14671sd50087_1', 'catalog', 'designcompleted', 'catalogcompleted', '', '2016-06-29 03:14:14'),
(164, 'JOB_LD14671sd50087_1', 'design', 'editcompleted', 'designcompleted', '', '2016-06-29 03:15:20'),
(165, 'JOB_LD14671sd50087_1', 'catalog', 'designcompleted', 'catalogcompleted', '', '2016-06-29 03:17:32'),
(166, 'JOB_JB14669gf22131_2', 'edit', 'editstarted', 'editcompleted', '', '2016-06-29 17:20:02'),
(167, 'JOB_JB14669gf22131_2', 'design', 'editcompleted', 'designstarted', '', '2016-06-29 17:34:07'),
(168, 'JOB_JB14669gf22131_2', 'edit', 'editstarted', 'editcompleted', '', '2016-06-29 17:55:02'),
(169, 'JOB_JB14669gf22131_2', 'design', 'editcompleted', 'designstarted', '', '2016-06-29 17:57:21'),
(170, 'JOB_gC14671PE72724_1', 'warehouse', '', 'notinformed', '', '2016-06-29 18:27:43'),
(171, 'JOB_gC14671PE72724_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-06-29 18:27:43'),
(172, 'JOB_gC14671PE72724_1', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-06-29 18:31:50'),
(173, 'JOB_JB14669gf22131_2', 'design', 'designstarted', 'designcompleted', '', '2016-06-29 18:36:26'),
(174, 'JOB_gC14671PE72724_2', 'warehouse', '', 'notinformed', '', '2016-07-02 18:20:33'),
(175, 'JOB_gC14671PE72724_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-02 18:20:33'),
(176, 'JOB_gC14671PE72724_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-07-02 18:21:31'),
(177, 'JOB_gC14671PE72724_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-02 18:22:42'),
(178, 'JOB_062016_10_1', 'warehouse', '', 'notinformed', '', '2016-07-03 17:51:17'),
(179, 'JOB_062016_10_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-03 17:51:17'),
(180, 'JOB_062016_10_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-07-03 17:51:32'),
(181, 'JOB_062016_10_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-03 17:51:48'),
(182, 'JOB_072016_1_1', 'warehouse', '', 'notinformed', '', '2016-07-07 23:32:11'),
(183, 'JOB_072016_1_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-07 23:32:11'),
(184, 'JOB_072016_1_1', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-07-07 23:42:14'),
(185, 'JOB_072016_1_1', 'edit', 'shootcompleted', 'editcompleted', '', '2016-07-07 23:43:24'),
(186, 'JOB_072016_1_1', 'design', 'designstarted', 'designcompleted', '', '2016-07-07 23:46:18'),
(187, 'JOB_072016_1_1', 'catalog', 'designcompleted', 'catalogcompleted', '', '2016-07-07 23:49:23'),
(188, 'JOB_072016_1_2', 'warehouse', '', 'notinformed', '', '2016-07-20 21:27:41'),
(189, 'JOB_072016_1_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-20 21:27:41'),
(190, 'JOB_072016_1_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2016-07-20 22:28:50'),
(191, 'JOB_072016_1_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-20 22:33:22'),
(192, 'JOB_072016_1_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-07-20 22:34:32'),
(193, 'JOB_072016_1_2', 'edit', 'shootcompleted', 'editstarted', '', '2016-07-20 22:34:38'),
(194, 'JOB_072016_1_2', 'edit', 'editstarted', 'editcompleted', '', '2016-07-20 22:36:32'),
(195, 'JOB_072016_1_2', 'design', 'editcompleted', 'designstarted', '', '2016-07-20 22:41:04'),
(196, 'JOB_072016_1_2', 'design', 'designstarted', 'designcompleted', '', '2016-07-20 22:41:26'),
(197, 'JOB_072016_1_2', 'catalog', 'designcompleted', 'catalogstarted', '', '2016-07-20 22:45:54'),
(198, 'JOB_072016_1_2', 'catalog', 'catalogstarted', 'catalogcompleted', '', '2016-07-21 06:59:24'),
(199, 'JOB_072016_1_3', 'warehouse', '', 'notinformed', '', '2016-07-21 07:03:55'),
(200, 'JOB_072016_1_3', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-21 07:03:56'),
(201, 'JOB_072016_1_4', 'warehouse', '', 'notinformed', '', '2016-07-21 07:04:05'),
(202, 'JOB_072016_1_4', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-21 07:04:05'),
(203, 'JOB_072016_1_5', 'warehouse', '', 'notinformed', '', '2016-07-21 07:04:16'),
(204, 'JOB_072016_1_5', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-21 07:04:16'),
(205, 'JOB_072016_1_3', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-07-21 07:04:45'),
(206, 'JOB_072016_1_4', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-07-21 07:04:56'),
(207, 'JOB_072016_1_5', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-07-21 07:05:07'),
(208, 'JOB_072016_4_1', 'warehouse', '', 'notinformed', '', '2016-07-21 07:12:20'),
(209, 'JOB_072016_4_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2016-07-21 07:12:20'),
(210, 'JOB_072016_4_1', 'shoot', 'movedtoshoot', 'shootcompleted', '', '2016-07-21 07:12:34'),
(211, 'JOB_072016_1_3', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-21 23:32:51'),
(212, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-21 23:40:40'),
(213, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:36:02'),
(214, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:38:33'),
(215, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:41:38'),
(216, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:43:33'),
(217, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:48:08'),
(218, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 06:53:11'),
(219, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 07:02:21'),
(220, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 07:05:21'),
(221, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 07:15:18'),
(222, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 07:18:44'),
(223, 'JOB_072016_4_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2016-07-22 07:20:11'),
(224, 'JOB_042017_2_1', 'warehouse', '', 'notinformed', '', '2017-04-29 21:43:51'),
(225, 'JOB_042017_2_1', 'jobtoshoot', 'created', 'movedtoshoot', '', '2017-04-29 21:43:51'),
(226, 'JOB_042017_2_1', 'shoot', 'movedtoshoot', 'shootstarted', '', '2017-04-29 21:44:22'),
(227, 'JOB_042017_2_1', 'shoot', 'shootstarted', 'shootcompleted', '', '2017-04-29 21:44:57'),
(228, 'JOB_042017_2_2', 'warehouse', '', 'notinformed', '', '2017-04-29 22:52:19'),
(229, 'JOB_042017_2_2', 'jobtoshoot', 'created', 'movedtoshoot', '', '2017-04-29 22:52:19'),
(230, 'JOB_042017_2_2', 'shoot', 'movedtoshoot', 'shootstarted', '', '2017-04-29 22:56:28'),
(231, 'JOB_042017_2_2', 'shoot', 'shootstarted', 'shootcompleted', '', '2017-04-29 22:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_enquiry`
--

CREATE TABLE `marketing_enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `enquiry_uuid` varchar(250) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `contact_name` varchar(150) DEFAULT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `contact_phone` varchar(150) DEFAULT NULL,
  `contact_address` longtext,
  `pickup_address` longtext,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tin_number` varchar(150) DEFAULT NULL,
  `trademark` varchar(150) DEFAULT NULL,
  `cst_number` varchar(150) DEFAULT NULL,
  `pan_number` varchar(150) DEFAULT NULL,
  `cheque_numbers` varchar(150) DEFAULT NULL,
  `logo_url` varchar(150) DEFAULT NULL,
  `product_range` varchar(1000) NOT NULL,
  `marketplace_list` varchar(2000) NOT NULL,
  `project_type` varchar(100) NOT NULL,
  `enquiry_created_by` varchar(100) NOT NULL,
  `enquiry_date` date NOT NULL,
  `enquiry_status` varchar(50) NOT NULL DEFAULT 'created',
  `tin_fname` varchar(200) NOT NULL,
  `trademark_fname` varchar(200) NOT NULL,
  `cst_fname` varchar(200) NOT NULL,
  `pan_fname` varchar(200) NOT NULL,
  `cheque_fname` varchar(200) NOT NULL,
  `logo_fname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketing_enquiry`
--

INSERT INTO `marketing_enquiry` (`enquiry_id`, `enquiry_uuid`, `company_name`, `contact_name`, `contact_email`, `contact_phone`, `contact_address`, `pickup_address`, `created_date`, `tin_number`, `trademark`, `cst_number`, `pan_number`, `cheque_numbers`, `logo_url`, `product_range`, `marketplace_list`, `project_type`, `enquiry_created_by`, `enquiry_date`, `enquiry_status`, `tin_fname`, `trademark_fname`, `cst_fname`, `pan_fname`, `cheque_fname`, `logo_fname`) VALUES
(70, 'ENQ_072016_2', 'Temp', 'temp', 'rram.ramasamy@gmail.com', '9894130821', 'Vadavalli', 'Vadavalli', '2016-07-07 17:55:32', '', '', '', '', '', '', '[]', '[]', 'shoot', '2', '2016-07-07', 'converted', '', '', '', '', '', ''),
(71, 'ENQ_072016_3', 'Temp', 'temp', 'rram.ramasamy@gmail.com', '9894130821', 'Vadavalli', 'Vadavalli', '2016-07-07 17:55:46', '', '', '', '', '', '', '[]', '[]', 'shoot', '2', '2016-07-07', 'converted', 'tin_Temp_1467914146_buddha-motivational-831980-1280x800.jpg', 'trademark_Temp_1467914146_buddha-motivational-831980-1280x800.jpg', 'cst_Temp_1467914146_buddha-motivational-831980-1280x800.jpg', 'pan_Temp_1467914146_buddha-motivational-831980-1280x800.jpg', 'cheque_Temp_1467914146_buddha-motivational-831980-1280x800.jpg', 'logo_Temp_1467914146_buddha-motivational-831980-1280x800.jpg'),
(72, 'ENQ_072016_4', 'one', 'one', 'rram@gmail.com', '9894130821', 'v', 'v', '2016-07-21 01:40:15', '', '', '', '', '', '', '{"men":{"pr":"Yes","count":"","remarks":""}}', '{"flipkart":"Yes","snapdeal":"Yes"}', 'shoot', '1', '2016-07-21', 'converted', 'tin_one_1469065215_buddha-motivational-831980-1280x800.jpg', 'trademark_one_1469065215_buddha-motivational-831980-1280x800.jpg', 'cst_one_1469065215_buddha-motivational-831980-1280x800.jpg', 'pan_one_1469065215_buddha-motivational-831980-1280x800.jpg', 'cheque_one_1469065215_buddha-motivational-831980-1280x800.jpg', 'logo_one_1469065215_buddha-motivational-831980-1280x800.jpg'),
(73, 'ENQ_042017_1', 'ABC', 'Ramu', 'rram.ramasamy@gmail.com', '9894130821', 'xyz', 'yxz', '2017-04-29 16:07:05', '123', '', '', '', '', '', '[]', '{"flipkart":"Yes"}', 'edit_design', '4', '2017-04-29', 'converted', '', '', '', '', '', ''),
(74, 'ENQ_042017_2', '123', '123', '1@y.com', '98', '123', '123', '2017-04-29 16:13:10', '', '', '', '', '', '', '{"men":{"pr":"Yes","count":"","remarks":""},"women":{"pr":"Yes","count":"","remarks":""}}', '{"flipkart":"Yes"}', 'shoot', '2', '2017-04-29', 'converted', '', '', '', '', '', ''),
(75, 'ENQ_042017_3', 'r', 'ram', '1@y.com', '989', '12', '12', '2017-04-29 17:19:28', '', '', '', '', '', '', '[]', '{"flipkart":"Yes"}', 'edit_design', '1', '2017-04-29', 'converted', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_list`
--

CREATE TABLE `marketplace_list` (
  `mpl_id` int(11) NOT NULL,
  `mp_name` varchar(200) NOT NULL,
  `mp_displayname` varchar(200) NOT NULL,
  `page_number` int(11) NOT NULL,
  `column_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketplace_list`
--

INSERT INTO `marketplace_list` (`mpl_id`, `mp_name`, `mp_displayname`, `page_number`, `column_number`) VALUES
(1, 'flipkart', 'Flipkart', 0, 0),
(2, 'snapdeal', 'Snapdeal', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_uuid` varchar(100) NOT NULL,
  `enquiry_uuid` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_uuid`, `enquiry_uuid`, `created_date`, `order_status`) VALUES
(1, 'cofa_FZ14652ST88703', 'cofa_FZ14652ST88703', '2016-06-08 11:54:15', 'created'),
(2, 'cofa_rD14652XX88556', 'cofa_rD14652XX88556', '2016-06-16 19:49:03', 'created'),
(3, 'cofa_hm14652bn88136', 'cofa_hm14652bn88136', '2016-06-21 23:28:21', 'created'),
(4, 'cofa_Ql14652JX88422', 'cofa_Ql14652JX88422', '2016-06-26 11:46:10', 'created'),
(5, 'ORD_JB14669gf22131', 'ENQ_JB14669gf22131', '2016-06-26 17:19:14', 'completed'),
(6, 'ORD_gp14669ao54471', 'ENQ_gp14669ao54471', '2016-06-26 20:51:58', 'completed'),
(7, 'ORD_eE14669Yo60805', 'ENQ_eE14669Yo60805', '2016-06-26 22:38:25', 'created'),
(8, 'ORD_Wc14670SE10587', 'ENQ_Wc14670SE10587', '2016-06-27 12:27:33', 'completed'),
(9, 'ORD_rH14671oo47799', 'ENQ_rH14671oo47799', '2016-06-29 02:34:16', 'completed'),
(10, 'ORD_Vt14671Lw49767', 'ENQ_Vt14671Lw49767', '2016-06-29 03:06:55', 'completed'),
(11, 'ORD_LD14671sd50087', 'ENQ_LD14671sd50087', '2016-06-29 03:12:16', 'completed'),
(12, 'ORD_gC14671PE72724', 'ENQ_gC14671PE72724', '2016-06-29 18:27:32', 'created'),
(13, 'ORD_062016_10', 'ENQ_062016_10', '2016-07-03 07:14:04', 'completed'),
(16, 'ORD_072016_1', 'ENQ_072016_3', '2016-07-07 23:28:56', 'created'),
(17, 'ORD_072016_4', 'ENQ_072016_4', '2016-07-21 07:11:27', 'completed'),
(18, 'ORD_042017_1', 'ENQ_042017_1', '2017-04-29 21:37:34', 'created'),
(19, 'ORD_042017_2', 'ENQ_042017_2', '2017-04-29 21:43:22', 'completed'),
(20, 'ORD_042017_3', 'ENQ_042017_3', '2017-04-29 22:50:49', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(11) NOT NULL,
  `userrole` varchar(100) NOT NULL,
  `enquiry` varchar(50) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `warehouse` varchar(50) NOT NULL,
  `shoot` varchar(50) NOT NULL,
  `edit` varchar(50) NOT NULL,
  `design` varchar(50) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `user_homepage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `userrole`, `enquiry`, `admin`, `warehouse`, `shoot`, `edit`, `design`, `catalog`, `user_homepage`) VALUES
(3, 'enquiry', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'enquiry/addenquiry.php'),
(4, 'admin', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'dashboard.php'),
(5, 'warehouse', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'warehouse/warehouse.php'),
(6, 'shoot', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'shoot/shoot-progress.php'),
(7, 'edit', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'edit/edit-status.php'),
(8, 'design', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'design/design-status.php'),
(9, 'catalog', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'catalog/catalog-status.php');

-- --------------------------------------------------------

--
-- Table structure for table `shoot_details`
--

CREATE TABLE `shoot_details` (
  `shoot_id` int(11) NOT NULL,
  `shoot_room` varchar(100) NOT NULL,
  `shoot_date` date NOT NULL,
  `shoot_model` varchar(100) NOT NULL,
  `shoot_status` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoot_details`
--

INSERT INTO `shoot_details` (`shoot_id`, `shoot_room`, `shoot_date`, `shoot_model`, `shoot_status`, `created_date`) VALUES
(1, 'Room1', '2016-06-23', 'Tarun', '', '0000-00-00 00:00:00'),
(2, 'Room1', '2016-06-23', 'Mega', '', '2016-06-16 21:35:06'),
(3, 'Room1', '2016-06-30', 'Kumar', '', '2016-06-16 21:35:38'),
(4, 'Room2', '2016-06-25', 'Mega', '', '2016-06-21 16:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login_id` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `userrole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login_id`, `password`, `username`, `userrole`) VALUES
(6, 'ram', 'c4ca4238a0b923820dcc509a6f75849b', 'ramu', 'admin'),
(7, 'enuser', 'c4ca4238a0b923820dcc509a6f75849b', 'enquiry user', 'enquiry'),
(8, 'whuser', 'c4ca4238a0b923820dcc509a6f75849b', 'warehouse user', 'warehouse'),
(9, 'shuser', 'c4ca4238a0b923820dcc509a6f75849b', 'shoot user', 'shoot'),
(10, 'eduser', 'c4ca4238a0b923820dcc509a6f75849b', 'edit user', 'edit'),
(11, 'dsuser', 'c4ca4238a0b923820dcc509a6f75849b', 'design user', 'design'),
(12, 'cluser', 'c4ca4238a0b923820dcc509a6f75849b', 'catalog user', 'catalog');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `job_uuid` varchar(100) NOT NULL,
  `warehouse_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `job_uuid`, `warehouse_status`) VALUES
(1, 'JOB_FZ14652ST88703_1', 'informed'),
(2, 'cofa_rD14652XX88556_1', 'informed'),
(3, 'JOB_FZ14652ST88703_2', 'reached'),
(4, 'cofa_rD14652XX88556_3', 'notinformed'),
(5, 'cofa_hm14652bn88136_2', 'notinformed'),
(6, 'cofa_hm14652bn88136_1', 'notinformed'),
(7, 'JOB_FZ14652ST88703_3', 'notinformed'),
(8, 'cofa_rD14652XX88556_2', 'notinformed'),
(9, 'cofa_Ql14652JX88422_1', 'notinformed'),
(10, 'cofa_Ql14652JX88422_2', 'notinformed'),
(11, 'JOB_JB14669gf22131_1', 'notinformed'),
(12, 'JOB_JB14669gf22131_2', 'notinformed'),
(13, 'JOB_gp14669ao54471_1', 'reached'),
(14, 'JOB_eE14669Yo60805_1', 'reached'),
(15, 'JOB_eE14669Yo60805_2', 'reached'),
(16, 'JOB_Wc14670SE10587_1', 'notinformed'),
(17, 'JOB_Wc14670SE10587_2', 'notinformed'),
(18, 'JOB_rH14671oo47799_1', 'reached'),
(19, 'JOB_rH14671oo47799_2', 'reached'),
(20, 'JOB_Vt14671Lw49767_1', 'notinformed'),
(21, 'JOB_Vt14671Lw49767_2', 'notinformed'),
(22, 'JOB_LD14671sd50087_1', 'notinformed'),
(23, 'JOB_gC14671PE72724_1', 'notinformed'),
(24, 'JOB_gC14671PE72724_2', 'notinformed'),
(25, 'JOB_062016_10_1', 'notinformed'),
(26, 'JOB_072016_1_1', 'notinformed'),
(27, 'JOB_072016_1_2', 'notinformed'),
(28, 'JOB_072016_1_3', 'notinformed'),
(29, 'JOB_072016_1_4', 'notinformed'),
(30, 'JOB_072016_1_5', 'notinformed'),
(31, 'JOB_072016_4_1', 'notinformed'),
(32, 'JOB_042017_2_1', 'notinformed'),
(33, 'JOB_042017_2_2', 'notinformed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_id` (`job_id`);

--
-- Indexes for table `job_log`
--
ALTER TABLE `job_log`
  ADD UNIQUE KEY `job_log_id` (`job_log_id`);

--
-- Indexes for table `marketing_enquiry`
--
ALTER TABLE `marketing_enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `marketplace_list`
--
ALTER TABLE `marketplace_list`
  ADD PRIMARY KEY (`mpl_id`),
  ADD UNIQUE KEY `mpl_id` (`mpl_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `shoot_details`
--
ALTER TABLE `shoot_details`
  ADD PRIMARY KEY (`shoot_id`),
  ADD UNIQUE KEY `shoot_id` (`shoot_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`),
  ADD UNIQUE KEY `warehouse_id` (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `job_log`
--
ALTER TABLE `job_log`
  MODIFY `job_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `marketing_enquiry`
--
ALTER TABLE `marketing_enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `marketplace_list`
--
ALTER TABLE `marketplace_list`
  MODIFY `mpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shoot_details`
--
ALTER TABLE `shoot_details`
  MODIFY `shoot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
