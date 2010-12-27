-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2010 at 02:17 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `formspring`
--

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `ses_id` varchar(32) NOT NULL default '',
  `last_access` int(12) unsigned NOT NULL default '0',
  `ses_start` int(12) unsigned NOT NULL default '0',
  `ses_value` text NOT NULL,
  PRIMARY KEY  (`ses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Used to store the sessions data';