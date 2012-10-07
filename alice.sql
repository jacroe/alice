-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2012 at 10:48 PM
-- Server version: 5.1.63
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
('update_time', '9:40 pm', '2012-01-01 06:00:00'),
('location_tz_short', 'America/Chicago', '2012-01-01 06:00:00'),
('location_tz', 'CDT', '2012-01-01 06:00:00'),
('location_long', '-89.329869', '2012-01-01 06:00:00'),
('location_lat', '31.331585', '2012-01-01 06:00:00'),
('location_zip', '39406', '2012-01-01 06:00:00'),
('location_state', 'MS', '2012-01-01 06:00:00'),
('weather_currCond', 'Clear', '2012-01-01 06:00:00'),
('weather_currTemp', '60', '2012-01-01 06:00:00'),
('weather_currHumidity', '60', '2012-01-01 06:00:00'),
('weather_currWind', 'Calm', '2012-01-01 06:00:00'),
('weather_hiTemp', '100', '2012-01-01 06:00:00'),
('weather_loTemp', '0', '2012-01-01 06:00:00'),
('weather_fcastToday', 'Clear', '2012-01-01 06:00:00'),
('weather_fcastTonight', 'Clear', '2012-01-01 06:00:00'),
('weather_fcastTomorrow', 'Clear', '2012-01-01 06:00:00'),
('weather_fcastTomorrowNight', 'Clear', '2012-01-01 06:00:00'),
('weather_fcastNextday', 'Clear', '2012-01-01 06:00:00'),
('weather_fcastNextdayNight', 'Clear', '2012-01-01 06:00:00'),
('weather_icon', 'sunny', '2012-01-01 06:00:00'),
('email_count', '0', '2012-01-01 06:00:00'),
('location_city', 'Hattiesburg', '2012-01-01 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `a_recipes`
--

CREATE TABLE IF NOT EXISTS `a_recipes` (
  `name` text NOT NULL,
  `value` text NOT NULL,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
