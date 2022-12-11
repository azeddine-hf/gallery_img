-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2022 at 04:43 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_img`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `desc_com` varchar(500) NOT NULL,
  `id_img` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_com`, `desc_com`, `id_img`, `full_name`, `email`, `date_created`) VALUES
(12, 'woow big shark ?', 58, 'azeddine hf', 'azeddine.ha15@gmail.com', '2022-12-07 17:14:16'),
(11, 'woow big shark ?', 58, 'azeddine hf', 'azeddine.ha15@gmail.com', '2022-12-07 17:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `isdeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `image`, `title`, `isdeleted`) VALUES
(58, 'tiger (7).png', './uploads/tiger (7).png', 'requin', 0),
(56, 'eagl.png', './uploads/eagl.png', 'Aigle', 0),
(57, 'shark.png', './uploads/shark.png', 'requin', 0),
(55, 'eagl (1).png', './uploads/eagl (1).png', 'Aigle', 0),
(53, 'eagl (3).png', './uploads/eagl (3).png', 'Aigle', 0),
(54, 'eagl (2).png', './uploads/eagl (2).png', 'Aigle', 0),
(51, 'chien (4).png', './uploads/chien (4).png', 'chiens', 0),
(52, 'chien (5).png', './uploads/chien (5).png', 'chiens', 0),
(50, 'chien (3).png', './uploads/chien (3).png', 'chiens', 0),
(49, 'chien (2).png', './uploads/chien (2).png', 'chiens', 0),
(47, 'chien (7).png', './uploads/chien (7).png', 'chiens', 0),
(48, 'chien (1).png', './uploads/chien (1).png', 'chiens', 0),
(46, 'chien (6).png', './uploads/chien (6).png', 'chiens', 0),
(45, 'chat petit (7).png', './uploads/chat petit (7).png', 'chats', 0),
(42, 'chat petit (4).png', './uploads/chat petit (4).png', 'chats', 0),
(43, 'chat petit (5).png', './uploads/chat petit (5).png', 'chats', 0),
(44, 'chat petit (6).png', './uploads/chat petit (6).png', 'chats', 0),
(40, 'chat petit (2).png', './uploads/chat petit (2).png', 'chats', 0),
(41, 'chat petit (3).png', './uploads/chat petit (3).png', 'chats', 0),
(39, 'chat petit (1).png', './uploads/chat petit (1).png', 'chats', 0),
(59, 'tiger (6).png', './uploads/tiger (6).png', 'requin', 0),
(60, 'tiger (5).png', './uploads/tiger (5).png', 'requin', 0),
(61, 'tiger (4).png', './uploads/tiger (4).png', 'tigre', 0),
(62, 'tiger (3).png', './uploads/tiger (3).png', 'tigre', 0),
(63, 'tiger (2).png', './uploads/tiger (2).png', 'tigre', 0),
(64, 'tiger (1).png', './uploads/tiger (1).png', 'tigre', 0),
(65, 'tiger.png', './uploads/tiger.png', 'tigre', 0),
(66, 'eagl (4).png', './uploads/eagl (4).png', 'tigre', 0),
(67, 'panda (2).png', './uploads/panda (2).png', 'panda', 0),
(68, 'panda (1).png', './uploads/panda (1).png', 'panda', 0),
(69, 'panda.png', './uploads/panda.png', 'panda', 0),
(70, 'shark (2).png', './uploads/shark (2).png', 'panda', 0),
(71, 'shark (1).png', './uploads/shark (1).png', 'panda', 0),
(72, 'lion (7).png', './uploads/lion (7).png', 'lion', 0),
(73, 'lion (6).png', './uploads/lion (6).png', 'lion', 0),
(74, 'lion (5).png', './uploads/lion (5).png', 'lion', 0),
(75, 'lion (4).png', './uploads/lion (4).png', 'lion', 0),
(76, 'lion (3).png', './uploads/lion (3).png', 'lion', 0),
(77, 'lion (2).png', './uploads/lion (2).png', 'lion', 0),
(78, 'lion (1).png', './uploads/lion (1).png', 'lion', 0),
(79, 'lion.png', './uploads/lion.png', 'lion', 0),
(80, 'panda (5).png', './uploads/panda (5).png', 'lion', 0),
(81, 'panda (4).png', './uploads/panda (4).png', 'lion', 0),
(82, 'panda (3).png', './uploads/panda (3).png', 'lion', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
