-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 14, 2010 at 04:49 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `heppaa`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_banners`
-- 

CREATE TABLE `tbl_banners` (
  `ban_id` int(11) NOT NULL auto_increment,
  `ban_name` varchar(100) character set latin1 collate latin1_general_ci default NULL,
  `ban_location` int(11) NOT NULL default '0',
  `ban_image` varchar(200) character set latin1 collate latin1_general_ci default NULL,
  `ban_url` varchar(255) character set latin1 collate latin1_general_ci default NULL,
  `ban_active` enum('0','1') character set latin1 collate latin1_general_ci default '0',
  `ban_date_added` datetime default NULL,
  PRIMARY KEY  (`ban_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `tbl_banners`
-- 

INSERT INTO `tbl_banners` VALUES (2, 'Join Us And Win Banner', 1, 'Banner-JoinUs-BG.jpg', 'http://proshore.eu/customers/heppaa/home', '1', '2009-04-19 01:08:39');
INSERT INTO `tbl_banners` VALUES (1, 'Free Bid Every Day Banner', 1, 'advertise.jpg', 'http://proshore.eu/customers/heppaa/home', '1', '2009-05-18 10:03:14');
INSERT INTO `tbl_banners` VALUES (3, 'Refer Friend Banner', 1, 'Banner-Refer.jpg', 'http://sunil', '0', '2009-04-19 12:00:46');
INSERT INTO `tbl_banners` VALUES (6, 'Footer logo', 1, 'logo_footer.jpg', 'http://proshore.eu/customers/heppaa/home', '1', '2009-05-04 12:17:38');
INSERT INTO `tbl_banners` VALUES (5, 'Site Logo', 1, 'logo_TOP.gif', 'http://proshore.eu/customers/heppaa/home', '1', '2009-05-04 12:03:00');
