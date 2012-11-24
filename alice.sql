-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2012 at 04:00 AM
-- Server version: 5.1.66
-- PHP Version: 5.3.6-13ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alice`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_images`
--

CREATE TABLE IF NOT EXISTS `a_images` (
  `name` text NOT NULL,
  `mime` text NOT NULL,
  `image` longblob NOT NULL,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a_modules`
--

CREATE TABLE IF NOT EXISTS `a_modules` (
  `name` text NOT NULL,
  `value` text NOT NULL,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_modules`
--

INSERT INTO `a_modules` (`name`, `value`, `lastchanged`) VALUES
('update_time', 'never', '2012-11-24 10:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `a_recipes`
--

CREATE TABLE IF NOT EXISTS `a_recipes` (
  `name` text NOT NULL,
  `value` text NOT NULL,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a_x10`
--

CREATE TABLE IF NOT EXISTS `a_x10` (
  `name` text NOT NULL,
  `code` text NOT NULL,
  `type` text NOT NULL,
  `curState` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_x10`
--

INSERT INTO `a_x10` (`name`, `code`, `type`, `curState`) VALUES
('livingroom_TV Lamp', 'j2', 'lamp', 0),
('livingroom_Speaker', 'j1', 'appliance', 0),
('bedroom_Bedroom Lamp', 'j3', 'lamp', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
