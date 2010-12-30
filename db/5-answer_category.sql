-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2010 at 02:08 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `formspring`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_category`
--

DROP TABLE IF EXISTS `answer_category`;
CREATE TABLE `answer_category` (
  `answer_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`answer_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;