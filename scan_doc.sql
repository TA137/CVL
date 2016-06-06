-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 05:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scan_doc`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions_doc`
--

CREATE TABLE IF NOT EXISTS `actions_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_Id` int(11) NOT NULL,
  `upl_doc_id` int(11) NOT NULL,
  `tim_done` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_doc` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `actions_doc`
--

INSERT INTO `actions_doc` (`id`, `session_Id`, `upl_doc_id`, `tim_done`, `action_doc`) VALUES
(1, 1, 15, '2016-06-06 12:33:19', 'print'),
(2, 1, 15, '2016-06-06 12:41:32', 'download'),
(3, 3, 15, '2016-06-06 14:28:07', 'view'),
(4, 3, 15, '2016-06-06 15:23:54', 'view'),
(5, 3, 15, '2016-06-06 15:24:38', 'view'),
(6, 4, 17, '2016-06-06 15:42:38', 'download'),
(7, 4, 15, '2016-06-06 15:42:52', 'view'),
(8, 4, 15, '2016-06-06 15:43:05', 'download');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`) VALUES
(1, 'Board of minister and Resolution'),
(2, 'Shareholder minutes and Resolution'),
(3, 'Company Contracts'),
(4, 'Company letters'),
(5, 'Financial Documents'),
(6, 'Reports');

-- --------------------------------------------------------

--
-- Table structure for table `doc_sessions`
--

CREATE TABLE IF NOT EXISTS `doc_sessions` (
  `sess_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(11) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_out` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `doc_sessions`
--

INSERT INTO `doc_sessions` (`sess_id`, `user_Id`, `time_in`, `time_out`) VALUES
(1, 6, '2016-06-06 10:22:03', NULL),
(2, 6, '2016-06-06 14:09:47', NULL),
(3, 12, '2016-06-06 14:25:14', NULL),
(4, 1, '2016-06-06 15:30:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `organization`) VALUES
(1, 'EUCL'),
(2, 'SONARWA'),
(3, 'MINAGRI'),
(4, 'UTEXIRWA');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `sub_directory` varchar(80) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_id`, `cat_id`, `sub_directory`) VALUES
(1, 3, 'Supply'),
(2, 3, 'Employer'),
(3, 5, 'A'),
(4, 5, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `upload_doc`
--

CREATE TABLE IF NOT EXISTS `upload_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `Doc_name` varchar(80) DEFAULT NULL,
  `Doc_type` varchar(20) NOT NULL,
  `upl_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(250) DEFAULT NULL,
  `user_Id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `upload_doc`
--

INSERT INTO `upload_doc` (`id`, `org_id`, `cat_id`, `Doc_name`, `Doc_type`, `upl_time`, `description`, `user_Id`) VALUES
(15, 1, 1, '1.jpg', 'jpg', '2016-06-02 09:22:12', 'ifoto yumukozi wa ewasa', 6),
(16, 3, 2, '1360415023pc_splitter_settings_in_win_ce6.0_os_for_windows7.pdf', 'pdf', '2016-06-02 10:24:06', 'wallah', 6),
(17, 2, 1, 'Full-PXE-Configuration-.pdf', 'pdf', '2016-06-02 10:24:48', 'wlaladd', 6),
(18, 1, 3, 'carnergie mellon.docx', 'docx', '2016-06-04 21:41:51', 'lsljohi joijoij', 6),
(19, 1, 3, 'benigne.docx', 'docx', '2016-06-04 21:42:58', 'hkjhjh', 6),
(20, 1, 1, 'images.jpg', 'jpg', '2016-06-04 22:28:25', 'hfghgf', 6),
(21, 2, 1, 'Fula Jalon in Guinea.docx', 'docx', '2016-06-04 22:30:38', 'knkhjh', 6),
(22, 2, 2, 'example.jpg', 'jpg', '2016-06-04 22:32:01', 'bjhjgjgj', 6),
(25, 4, 5, '2A4B2D0900000578-3152054-image-a-39_1436271197239.jpg', 'jpg', '2016-06-04 22:40:16', 'kjhkjhkhk', 6);

-- --------------------------------------------------------

--
-- Table structure for table `upload_subcategories`
--

CREATE TABLE IF NOT EXISTS `upload_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_cat_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `upload_subcategories`
--

INSERT INTO `upload_subcategories` (`id`, `sub_cat_id`, `upload_id`) VALUES
(1, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(120) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `Email` varchar(124) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Picture` varchar(124) DEFAULT 'profile/',
  `Type` tinyint(1) NOT NULL DEFAULT '0',
  `Print` tinyint(1) DEFAULT '0',
  `Download` tinyint(1) DEFAULT '0',
  `Upload` tinyint(1) DEFAULT '0',
  `Phone` varchar(20) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`user_Id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Phone` (`Phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_Id`, `Firstname`, `Lastname`, `username`, `Email`, `Gender`, `Picture`, `Type`, `Print`, `Download`, `Upload`, `Phone`, `state`, `password`) VALUES
(1, 'Benon', 'Bashayija', 'bashayija', 'bashayija@gmail.com', 'male', 'profile/', 0, 1, 1, 1, '+250787283492', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'janvier2', 'MUGISHA2', 'mugijanvier', 'mugijanvier@gmail.com', 'male', 'profile/', 0, 0, 0, 0, '+250787283491', 0, 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Mugwiza', 'Leon', 'olincuti', 'olincuti@yahoo.fr', 'male', 'profile/', 0, 0, 0, 0, '+250787283491', 1, 'c4dc57ef78b91f8df0bfdb8484fbc83c'),
(4, 'Munyampeta', 'Imena ', 'olincuti1', 'olincuti1@yahoo.fr', 'male', 'profile/', 0, 0, 0, 0, '+250782170558', 1, 'c3fe73845bfcfd91b86feb91aa658a08'),
(6, 'murenzi', 'orry', 'murenzi', 'murenzi@gmail.com', 'male', 'profile/', 1, 0, 0, 0, '0788886777', 1, '2c76643c2888ad8de523b629a370fe7d'),
(7, 'arnold', 'kamanzi', 'karnold', 'karnold@gmail.com', 'male', 'profile/', 0, 0, 1, 0, '+250788778603', 1, '34b6569a55e278ea15e0aa561e4977cd'),
(8, 'murenzi', 'callixte', 'callixte', NULL, 'male', 'profile/', 0, NULL, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'murenzi', 'callixte', 'semana', NULL, 'male', 'profile/', 0, NULL, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'tom', 'kaman', 'tomas', 'tomas@gmail.com', 'male', 'profile/', 0, NULL, 0, 0, '0788455689', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'uwineza', 'solei', 'uwineza', NULL, 'female', 'profile/', 1, 1, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'muhizi', 'Aristide', 'muhizia4', 'muhizia4@gmail.com', 'male', 'profile/12.jpg', 0, 0, 0, 0, '0788778602', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'muganza', 'adolphe', 'muganza1', NULL, 'male', 'profile/', 0, 0, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
