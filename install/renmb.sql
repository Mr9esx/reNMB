SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `nmb_config`;
CREATE TABLE `nmb_config` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `WEBNAME` varchar(255) DEFAULT NULL,
  `WEBTITLENAME` varchar(255) DEFAULT NULL,
  `COOKIEOPEN` varchar(255) NOT NULL,
  `MINTENANCEMODE` varchar(255) NOT NULL,
  `DEBUGMODE` varchar(255) NOT NULL,
  `ISINSTASLL` varchar(255) NOT NULL,
  `WEBROOTSRC` varchar(255) NOT NULL,
  `WEBROOTURL` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='/**是否开启关站维护模式？*/\r\nMINTENANCEMODE\r\n\r\n/**是否开启检查维护模式？*/\r\nDEBUGMODE\r\n\r\n/**网站名称*/\r\nWEBNAME\r\n\r\n/**网页Title名称*/\r\nWEBTITLENAME\r\n\r\n/**是否发放cookie*/\r\nCOOKIEOPEN';
DROP TABLE IF EXISTS `nmb_menu`;
CREATE TABLE `nmb_menu` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `menu_father_zh_name` varchar(255) NOT NULL,
  `menu_son_zh_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `nmb_page`;
CREATE TABLE `nmb_page` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_email` varchar(255) DEFAULT NULL,
  `page_send_time` datetime NOT NULL,
  `page_change_time` datetime DEFAULT NULL,
  `page_send_cookie` varchar(255) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `is_sega` tinyint(255) NOT NULL,
  `page_text` text NOT NULL,
  `reply_conut` varchar(255) DEFAULT NULL,
  `block` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `nmb_reply`;
CREATE TABLE `nmb_reply` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `reply_title` varchar(255) DEFAULT NULL,
  `reply_name` varchar(255) DEFAULT NULL,
  `reply_email` varchar(255) DEFAULT NULL,
  `reply_send_time` datetime NOT NULL,
  `reply_send_cookie` varchar(255) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `reply_text` text NOT NULL,
  `reply_for` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `nmb_user`;
CREATE TABLE `nmb_user` (
  `id` int(11) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `warning` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;