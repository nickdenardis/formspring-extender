-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2010 at 10:05 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `formspring`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_access`
--

CREATE TABLE `account_access` (
  `access_id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(5) unsigned NOT NULL,
  `delegate_id` int(5) unsigned NOT NULL,
  `type` enum('full','moderated') NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY  (`access_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account_access`
--


-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `bio_id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(5) unsigned NOT NULL,
  `date_entered` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `name` varchar(32) NOT NULL,
  `website` varchar(32) NOT NULL,
  `location` varchar(32) NOT NULL,
  `bio` varchar(254) NOT NULL,
  `accept_anonymous` int(1) NOT NULL,
  `protected` varchar(24) NOT NULL,
  `photo_url` varchar(128) NOT NULL,
  `answered_count` int(5) NOT NULL,
  `taking_questions` int(1) NOT NULL,
  `inbox_count` int(5) NOT NULL,
  `follow_count` int(5) NOT NULL,
  PRIMARY KEY  (`bio_id`),
  UNIQUE KEY `oauth_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `alert_id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `date_entered` datetime NOT NULL,
  `prompt` enum('question','answer') NOT NULL,
  `action` enum('nothing','email') NOT NULL,
  PRIMARY KEY  (`alert_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alerts`
--


-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `question` varchar(254) NOT NULL,
  `answer` varchar(254) NOT NULL,
  `date_asked` datetime NOT NULL,
  `asked_by` varchar(32) NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY  (`answer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `answers`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('public','private') NOT NULL,
  `category` varchar(254) NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `question` varchar(254) NOT NULL,
  `asked_by` varchar(32) NOT NULL,
  `date_asked` datetime NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY  (`inbox_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `pending_answers`
--

CREATE TABLE `pending_answers` (
  `pending_id` int(10) unsigned NOT NULL auto_increment,
  `question_id` int(10) unsigned NOT NULL,
  `date_entered` datetime NOT NULL,
  `status` enum('new','pending','edited','accepted','denied') NOT NULL,
  `answer` varchar(254) NOT NULL,
  PRIMARY KEY  (`pending_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pending_answers`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) unsigned NOT NULL auto_increment,
  `date_entered` datetime NOT NULL,
  `username` varchar(32) NOT NULL,
  `oauth_token` varchar(128) NOT NULL,
  `oauth_token_secret` varchar(128) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

