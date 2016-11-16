-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2012 at 12:16 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database_erg2`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailed_grading`
--

CREATE TABLE IF NOT EXISTS `detailed_grading` (
  `Id_Student` int(10) NOT NULL,
  `Id_Lesson` int(10) NOT NULL,
  `grade` decimal(10,0) NOT NULL,
  `exam_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailed_grading`
--

INSERT INTO `detailed_grading` (`Id_Student`, `Id_Lesson`, `grade`, `exam_date`) VALUES
(24, 11, 5, '2012-06-14'),
(26, 11, 6, '2012-06-14'),
(24, 11, 5, '2012-06-14'),
(26, 11, 6, '2012-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `Id_Lesson` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Teacher` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `semister` int(5) NOT NULL,
  `ECTS_units` int(5) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `active` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Lesson`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`Id_Lesson`, `Id_Teacher`, `title`, `semister`, `ECTS_units`, `date_start`, `date_end`, `active`) VALUES
(5, 23, 'Web', 8, 5, '0000-00-00', '0000-00-00', 'disable'),
(7, 22, 'Katanemimena', 3, 12, '0000-00-00', '0000-00-00', 'enable'),
(9, 23, 'Sok', 1, 5, '0000-00-00', '0000-00-00', 'disable'),
(10, 20, 'Efarmosmena', 6, 5, '0000-00-00', '0000-00-00', 'disable'),
(11, 20, 'Diaforikes', 4, 5, '0000-00-00', '0000-00-00', 'enable'),
(12, 20, 'Fysiki_1', 1, 5, '0000-00-00', '0000-00-00', 'enable'),
(13, 22, 'Vaseis_Dedomenwn2', 7, 5, '2012-03-14', '2012-09-29', 'disable');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_exam`
--

CREATE TABLE IF NOT EXISTS `lesson_exam` (
  `Id_Lesson` int(10) NOT NULL,
  `exam_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `Id_Role` int(10) NOT NULL,
  `Name_Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `selection_lesson`
--

CREATE TABLE IF NOT EXISTS `selection_lesson` (
  `Id_Student` int(10) NOT NULL,
  `Id_Lesson` int(10) NOT NULL,
  `selection_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selection_lesson`
--

INSERT INTO `selection_lesson` (`Id_Student`, `Id_Lesson`, `selection_date`) VALUES
(24, 8, '2012-05-16'),
(24, 8, '2012-05-16'),
(24, 8, '2012-05-17'),
(24, 10, '2012-05-17'),
(24, 11, '2012-05-17'),
(24, 12, '2012-05-17'),
(26, 5, '2012-05-17'),
(26, 7, '2012-05-17'),
(26, 10, '2012-05-17'),
(26, 11, '2012-05-17'),
(26, 12, '2012-05-17'),
(24, 13, '2012-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `successfull_lesson`
--

CREATE TABLE IF NOT EXISTS `successfull_lesson` (
  `Id_Student` int(10) NOT NULL,
  `Id_Lesson` int(10) NOT NULL,
  `grade` decimal(10,0) NOT NULL,
  `success_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `successfull_lesson`
--

INSERT INTO `successfull_lesson` (`Id_Student`, `Id_Lesson`, `grade`, `success_date`) VALUES
(24, 11, 5, '2012-06-14'),
(26, 11, 6, '2012-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id_User` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(80) NOT NULL,
  `Id_Role` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `registration_date` date NOT NULL,
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `user_name`, `password`, `Id_Role`, `first_name`, `last_name`, `address`, `mail`, `registration_date`) VALUES
(20, 'tsok', 'e9510081ac30ffa83f10b68cde1cac07', 2, 'Antonis', 'Tsokaros', 'karlovsiHello', 'tsok@', '2007-12-05'),
(22, 'Marag', 'e9510081ac30ffa83f10b68cde1cac07', 2, 'Manolis', 'Maragoudakis', 'karl', 'marag@', '2007-12-05'),
(23, 'Kal', 'd79c8788088c2193f0244d8f1f36d2db', 2, 'Manolis', 'Kalligeros', 'karl2', 'kal@', '2007-12-05'),
(24, 'icsd08092', '1d72310edc006dadf2190caad5802983', 3, 'Andi', 'Beka', 'tsopotou', 'beka@', '2008-09-23'),
(25, 'leo', '860b37e28ec7ba614f00f9246949561d', 1, 'Theodoris', 'Leoutskos', 'karlovasi', 'leots@icsd', '2000-02-25'),
(26, 'icsd07029', 'c4ca4238a0b923820dcc509a6f75849b', 3, 'Manolaros', 'Zoumakis', 'Kriti', 'manos@kriti', '2007-12-05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
