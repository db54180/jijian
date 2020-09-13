/*
Navicat MySQL Data Transfer

Source Server         : 140.249.23.118
Source Server Version : 50557
Source Host           : 140.249.23.118:3306
Source Database       : wg

Target Server Type    : MYSQL
Target Server Version : 50557
File Encoding         : 65001

Date: 2019-10-23 18:24:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `zhuce`
-- ----------------------------
DROP TABLE IF EXISTS `zhuce`;
CREATE TABLE `zhuce` (
  `pw` varchar(255) NOT NULL,
  `acc` varchar(64) NOT NULL,
  `dbip` varchar(255) NOT NULL,
  `dbname` varchar(128) NOT NULL,
  `dbpass` varchar(128) NOT NULL,
  PRIMARY KEY (`acc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of zhuce
-- ----------------------------
INSERT INTO `zhuce` VALUES ('123456', 'zzz', '140.249.299.118', 'root', '90000');
