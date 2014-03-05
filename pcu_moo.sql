/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : dhfonline

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2014-03-05 12:52:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pcu_moo`
-- ----------------------------
DROP TABLE IF EXISTS `pcu_moo`;
CREATE TABLE `pcu_moo` (
  `id` int(11) NOT NULL auto_increment,
  `pcucode` varchar(5) NOT NULL default '',
  `moo` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`,`pcucode`,`moo`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pcu_moo
-- ----------------------------
INSERT INTO `pcu_moo` VALUES ('11', '11251', '65030203');
INSERT INTO `pcu_moo` VALUES ('12', '11251', '65011301');
INSERT INTO `pcu_moo` VALUES ('13', '11251', '65010901');
