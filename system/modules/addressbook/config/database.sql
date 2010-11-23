-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

-- 
-- Table `tl_person`
-- 

CREATE TABLE `tl_person` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `sex` varchar(6) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `position` varchar(255) NOT NULL default '',
  `job` varchar(255) NOT NULL default '',
  `company` int(10) unsigned NOT NULL default '0',
  `photo` blob NULL,
  `description` blob NULL,
  `email` varchar(255) NOT NULL default '',
  `fon` varchar(255) NOT NULL default '',
  `mobile` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `homepage` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `country` varchar(255) NOT NULL default '',
  `icq` varchar(255) NOT NULL default '',
  `google` varchar(255) NOT NULL default '',
  `aim` varchar(255) NOT NULL default '',
  `yahoo` varchar(255) NOT NULL default '',
  `skype` varchar(255) NOT NULL default '',
  `jabber` varchar(255) NOT NULL default '',
  `xing` varchar(255) NOT NULL default '',
  `facebook` varchar(255) NOT NULL default '',
  `stayfriends` varchar(255) NOT NULL default '',
  `wkw` varchar(255) NOT NULL default '',
  `twitter` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_address_group`
-- 

CREATE TABLE `tl_address_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `description` blob NULL
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_company`
-- 

CREATE TABLE `tl_company` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` blob NULL,
  `photo` blob NULL,
  `logo` blob NULL,
  `email` varchar(255) NOT NULL default '',
  `fon` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `homepage` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `country` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `addressListSource` varchar(18) NOT NULL default '',
  `addressSource` int(10) unsigned NOT NULL default '0',
  `addressTemplate` varchar(64) NOT NULL default ''
  `addressListSort` varchar(20) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `addressListSource` varchar(18) NOT NULL default '',
  `addressSource` int(10) unsigned NOT NULL default '0',
  `addressTemplate` varchar(64) NOT NULL default ''
  `addressListSort` varchar(20) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
