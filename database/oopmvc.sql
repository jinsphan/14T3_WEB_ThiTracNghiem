/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : oopmvc

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-01-07 03:25:08
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `classname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('14', 'Modi Bixa 1', '61 Le Van Si - Hoa Minh -Lien Chieu', '+84123456789', '142057575862770.jpg', '04T2');
INSERT INTO `students` VALUES ('15', 'Modi bixa 2', '61 Le Van Si - Hoa Minh -Lien Chieu', '+84123456789', '142057577628814.jpg', '04T1');
INSERT INTO `students` VALUES ('16', 'Modi bixa 3', '61 Le Van Si - Hoa Minh -Lien Chieu', '+84123456789', '142057579643359.jpg', '04T2');
INSERT INTO `students` VALUES ('17', 'Modi Bixa 4', '61 Le Van Si - Hoa Minh -Lien Chieu', '+84123456789', '142057582214441.jpg', '04T2');
