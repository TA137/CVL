-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2016 at 07:09 PM
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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`) VALUES
(1, 'Acounting'),
(2, 'Law'),
(3, 'Administration'),
(4, 'Audition');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `upload_doc`
--



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
(1, 'Benon', 'Bashayija', 'bashayija', 'bashayija@gmail.com', 'male', 'profile/', 0, 1, 1, 1, '+250787283492', 1, '718ed05c2cba9a8f4a4e92d342eae145'),
(2, 'janvier2', 'MUGISHA2', 'mugijanvier', 'mugijanvier@gmail.com', 'male', 'profile/', 0, 0, 0, 0, '+250787283491', 0, '76951ecb731b3d2f3b11b062bd538dc3'),
(3, 'Mugwiza', 'Leon', 'olincuti', 'olincuti@yahoo.fr', 'male', 'profile/', 0, 0, 0, 0, '+250787283491', 1, 'c4dc57ef78b91f8df0bfdb8484fbc83c'),
(4, 'Munyampeta', 'Imena ', 'olincuti1', 'olincuti1@yahoo.fr', 'male', 'profile/', 0, 0, 0, 0, '+250782170558', 1, 'c3fe73845bfcfd91b86feb91aa658a08'),
(6, 'murenzi', 'orry', 'murenzi', 'murenzi@gmail.com', 'male', 'profile/', 1, 0, 0, 0, '+250788886777', 1, '2c76643c2888ad8de523b629a370fe7d'),
(7, 'arnold', 'kamanzi', 'karnold', 'karnold@gmail.com', 'male', 'profile/', 0, 0, 1, 0, '+250788778603', 1, '34b6569a55e278ea15e0aa561e4977cd'),
(8, 'murenzi', 'callixte', 'callixte', NULL, 'male', 'profile/', 0, NULL, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'murenzi', 'callixte', 'semana', NULL, 'male', 'profile/', 0, NULL, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'tom', 'kaman', 'tomas', 'tomas@gmail.com', 'male', 'profile/', 0, NULL, 0, 0, '0788455689', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'uwineza', 'solei', 'uwineza', NULL, 'female', 'profile/', 1, 1, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'muhizi', 'Aristide', 'muhizia4', 'muhizia4@gmail.com', 'male', 'profile/12.jpg', 0, 0, 0, 0, '0788778602', 1, 'd59252a59a94146d2b8c8c803c2a4984'),
(13, 'muganza', 'adolphe', 'muganza1', NULL, 'male', 'profile/', 0, 0, 0, 0, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
