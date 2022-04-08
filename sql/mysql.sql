# SQL Dump for wglinks module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Sun Mar 20, 2016 to 15:20
# Server version: 5.6.16
# PHP Version: 5.5.11

#
# Structure table for `wglinks_categories`
#

CREATE TABLE `wglinks_categories` (
  `cat_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(100) NOT NULL DEFAULT '',
  `cat_desc` TEXT NULL,
  `cat_weight` INT(8) NOT NULL DEFAULT '0',
  `cat_submitter` INT(10) NOT NULL DEFAULT '0',
  `cat_date_created` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB;

#
# Structure table for `wglinks_links` 8
#
CREATE TABLE `wglinks_links` (
  `link_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_catid` INT(10) NOT NULL DEFAULT '0',
  `link_name` VARCHAR(100) NOT NULL DEFAULT '',
  `link_url` VARCHAR(200) NOT NULL DEFAULT '',
  `link_tooltip` VARCHAR(200) NULL DEFAULT '',
  `link_contact` VARCHAR(200) NULL DEFAULT '',
  `link_email` VARCHAR(200) NULL DEFAULT '',
  `link_phone` VARCHAR(100) NULL DEFAULT '',
  `link_address` VARCHAR(200) NULL DEFAULT '',
  `link_detail` TEXT NULL,
  `link_weight` INT(8) NOT NULL DEFAULT '0',
  `link_logo` VARCHAR(100) NULL DEFAULT '',
  `link_state` INT(10) NOT NULL DEFAULT '0',
  `link_type` INT(10) NOT NULL DEFAULT '0',
  `link_target` VARCHAR(20) NOT NULL DEFAULT '',
  `link_submitter` INT(10) NOT NULL DEFAULT '0',
  `link_date_created` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB;
