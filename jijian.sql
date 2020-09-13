/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50529
Source Host           : localhost:3306
Source Database       : jijian

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2020-09-13 11:37:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_switch` tinyint(4) NOT NULL,
  `c_is_loginTime` tinyint(4) NOT NULL,
  `c_logTime` varchar(30) COLLATE utf8_bin NOT NULL,
  `c_is_loginWarning` tinyint(4) NOT NULL,
  `c_warningNum` tinyint(4) NOT NULL,
  `c_is_log` tinyint(4) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '1', '0', '22:00-8:00', '0', '3', '1');

-- ----------------------------
-- Table structure for `employees`
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_password` char(32) COLLATE utf8_bin NOT NULL,
  `u_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `u_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_email_in` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_sex` tinyint(4) NOT NULL,
  `u_age` tinyint(4) NOT NULL,
  `u_position` int(11) NOT NULL,
  `u_department` int(11) NOT NULL,
  `u_enable` tinyint(4) NOT NULL,
  `u_lasttime` int(11) NOT NULL,
  `u_status` tinyint(4) NOT NULL,
  `u_resume_url` varchar(50) COLLATE utf8_bin NOT NULL,
  `u_window` tinyint(4) NOT NULL,
  `u_head` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '总经理', '15193884510', '1124470898@qq.com', 'admin@oa.com', '1', '26', '1', '1', '1', '1375343939', '0', '', '0', '');
INSERT INTO `employees` VALUES ('2', 'dongbo', '21232f297a57a5a743894a0e4a801fc3', '董波', '', '', '', '0', '0', '0', '2', '1', '0', '0', '', '0', '');
INSERT INTO `employees` VALUES ('3', 'gengqingyuan', '21232f297a57a5a743894a0e4a801fc3', '耿庆圆', '', '', '', '0', '0', '0', '2', '1', '0', '0', '', '0', '');

-- ----------------------------
-- Table structure for `flowpath`
-- ----------------------------
DROP TABLE IF EXISTS `flowpath`;
CREATE TABLE `flowpath` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `p_id` int(30) NOT NULL,
  `employer` varchar(20) DEFAULT NULL,
  `orders` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of flowpath
-- ----------------------------

-- ----------------------------
-- Table structure for `projection`
-- ----------------------------
DROP TABLE IF EXISTS `projection`;
CREATE TABLE `projection` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_starttime` int(11) NOT NULL,
  `p_endtime` int(11) NOT NULL,
  `p_employees` varchar(255) COLLATE utf8_bin NOT NULL,
  `p_manage` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_audit` varchar(30) COLLATE utf8_bin NOT NULL,
  `p_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `p_progress` tinyint(4) NOT NULL,
  `p_document` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_is_over` tinyint(4) NOT NULL,
  `p_status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of projection
-- ----------------------------
INSERT INTO `projection` VALUES ('1', '完成学习上报111', '1582473600', '1582560000', '3', '2|董波', '2|董波', 'AAAA', '0', '', '0', '1');
INSERT INTO `projection` VALUES ('2', '测试', '1582646400', '1582732800', '2|3|1', '1|总经理', '1|总经理', '啊啊啊啊啊', '0', '', '0', '1|1|1');
INSERT INTO `projection` VALUES ('3', '关于申请零食的通知', '1583856000', '1585497600', '2|3', '1|总经理', '2|董波', '啊啊啊啊啊啊啊啊啊啊啊啊高', '0', '', '0', null);
INSERT INTO `projection` VALUES ('4', '请完成古诗背诵', '1583856000', '1585756800', '2|3', '2|董波', '3|耿庆圆', '啊啊啊啊啊爱过啊', '0', '', '0', null);
INSERT INTO `projection` VALUES ('6', '4月10日测试', '1586448000', '1586707200', '耿庆圆', '2|董波', '2|董波', '11111111111111', '0', '', '0', null);
INSERT INTO `projection` VALUES ('7', '请完成古诗背诵ADfd', '1586534400', '1586880000', '董波', '1|总经理', '2|董波', 'pppppp', '0', '', '0', null);
INSERT INTO `projection` VALUES ('8', '相见时难别亦难', '1586620800', '1586793600', '总经理', '2|董波', '2|董波', '东风无力百花残', '0', '', '0', null);
INSERT INTO `projection` VALUES ('9', '请完成古诗背诵412', '1586620800', '1586620800', '董波', '3|耿庆圆', '3|耿庆圆', '；language', '0', '', '0', null);
INSERT INTO `projection` VALUES ('10', '完成学习上报111234', '0', '0', '1', '2|董波', '3|耿庆圆', 'ppppppppppppp', '0', '', '0', null);
INSERT INTO `projection` VALUES ('11', '完成学习上报11143', '1586620800', '1586707200', '董波', '2|董波', '3|耿庆圆', '；垃圾【来那个', '0', '', '0', null);
INSERT INTO `projection` VALUES ('12', '', '0', '0', '总经理|董波|耿庆圆', '3|耿庆圆', '3|耿庆圆', '', '0', '', '0', null);
INSERT INTO `projection` VALUES ('13', '关于sss的通知aa', '1586620800', '1588089600', '总经理|董波|耿庆圆', '2|董波', '3|耿庆圆', '哈哈终于陈宫了', '0', '', '0', null);
