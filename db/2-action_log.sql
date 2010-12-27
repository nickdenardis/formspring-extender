CREATE TABLE `action_log` (
  `action_id` int(5) unsigned NOT NULL auto_increment,
  `project_id` int(5) unsigned NOT NULL default '0',
  `user_id` int(5) unsigned NOT NULL default '0',
  `area_id` int(5) unsigned NOT NULL default '0',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `is_viewed` tinyint(1) unsigned NOT NULL default '0',
  `date_entered` datetime NOT NULL default '0000-00-00 00:00:00',
  `permalink` varchar(255) NOT NULL default '',
  `ip` varchar(16) NOT NULL default '',
  `user_agent` varchar(255) NOT NULL default '',
  `action` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`action_id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;