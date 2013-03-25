-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2013 at 03:25 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todo_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `priority` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `description`, `priority`, `create_date`, `due_date`, `status`) VALUES
(1, 'cut the grass', 2, '2013-03-25 15:03:32', '2013-03-30 03:00:00', 0),
(2, 'first test', 4, '2013-03-25 14:49:34', '2013-03-25 03:00:00', 1),
(3, 'test 2', 3, '2013-03-24 02:08:41', '2013-03-24 03:00:00', 1),
(5, 'car wash', 2, '2013-03-24 02:13:55', '2013-03-24 03:00:00', 1),
(7, 'buy food', 5, '2013-03-24 02:42:04', '2013-03-23 03:00:00', 1),
(9, 'feed the dog', 3, '2013-03-25 12:25:33', '2013-03-25 03:00:00', 0),
(15, 'make git repo for this project, test', 1, '2013-03-25 13:56:19', '0000-00-00 00:00:00', 0),
(16, 'order business cards', 3, '2013-03-25 13:56:40', '0000-00-00 00:00:00', 1),
(18, 'aaaaaaaaaaa', 3, '2013-03-25 14:52:38', '2013-03-26 03:00:00', 0),
(19, 'Added from iPhone ', 3, '2013-03-25 17:32:49', '0000-00-00 00:00:00', 0),
(20, 'test5', 3, '2013-03-25 17:33:17', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
