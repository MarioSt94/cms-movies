-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2019 at 06:36 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `authorID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`authorID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `newsID` int(11) NOT NULL AUTO_INCREMENT,
  `newsTitle` varchar(45) DEFAULT NULL,
  `newsContent` text,
  `added` datetime DEFAULT CURRENT_TIMESTAMP,
  `authorID` int(11) NOT NULL,
  PRIMARY KEY (`newsID`),
  KEY `fk_news_authors_idx` (`authorID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `pageTitle` varchar(45) DEFAULT NULL,
  `isRoot` tinyint(1) DEFAULT '1',
  `pageContent` text,
  PRIMARY KEY (`pageID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageID`, `pageTitle`, `isRoot`, `pageContent`) VALUES
(1, 'Home', 0, '<p>Sample Sample content</p>'),
(4, 'News', 1, '<p>Sample Sample content</p>'),
(12, 'Authors', 1, 'sgverhje4tjhnerthbn\r\nsbdbsdknbsd\r\nbsdkbmnsd;b\r\nsdbkdnbsd\r\nbskdbnsdb\r\nsbnkdbsndbsd\r\nfd bsfd nnsd bsd\r\nsnbdvb\r\nsdb\r\nfsdn\r\nv\r\n cv nytj')
;


-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_authors` FOREIGN KEY (`authorID`) REFERENCES `authors` (`authorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
