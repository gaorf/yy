/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : yy

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2017-04-19 07:34:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yy_brand
-- ----------------------------
DROP TABLE IF EXISTS `yy_brand`;
CREATE TABLE `yy_brand` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` smallint(6) unsigned NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_desc` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_brand
-- ----------------------------
INSERT INTO `yy_brand` VALUES ('1', '6', '东药', '东药东药东药', '1');
INSERT INTO `yy_brand` VALUES ('2', '7', 'a', 'aaa', '1');

-- ----------------------------
-- Table structure for yy_category
-- ----------------------------
DROP TABLE IF EXISTS `yy_category`;
CREATE TABLE `yy_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pid` tinyint(3) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `is_nav` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否在导航显示',
  `sort_order` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_category
-- ----------------------------
INSERT INTO `yy_category` VALUES ('1', '0', '心脑血管类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('2', '0', '抗肿瘤药', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('3', '0', '解热镇痛类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('4', '0', '肝胆胰用药', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('5', '0', '呼吸系统类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('6', '0', '清热解毒', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('7', '0', '神经系统', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('8', '0', '泌尿系统', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('9', '0', '抗菌消炎类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('10', '0', '胃肠疾病类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('11', '0', '内分泌及代谢类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('12', '0', '其他', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('13', '1', '心力衰竭', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('14', '1', '心功能不全', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('15', '1', '心律失常', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('16', '13', '盐酸多巴酚丁胺注射液', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('17', '1', '动脉硬化', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('18', '1', '心绞痛', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('19', '1', '高血压', '-1', '0', '1');
INSERT INTO `yy_category` VALUES ('20', '1', '胸闷胸痛', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('21', '1', '肺动脉高压', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('22', '1', '中风偏瘫', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('23', '1', '心慌心悸', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('24', '1', '高血脂', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('25', '1', '冠心病', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('26', '1', '心肌病', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('27', '2', '抗生素类', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('28', '2', '天然抗肿瘤药', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('29', '2', '抗肿瘤辅助药', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('30', '2', '抗代谢', '1', '0', '1');
INSERT INTO `yy_category` VALUES ('31', '14', '去乙酰毛花苷注射液', '1', '0', '1');

-- ----------------------------
-- Table structure for yy_company
-- ----------------------------
DROP TABLE IF EXISTS `yy_company`;
CREATE TABLE `yy_company` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'logo',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `district` varchar(50) NOT NULL COMMENT '县',
  `company_desc` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_company
-- ----------------------------
INSERT INTO `yy_company` VALUES ('6', '山东方明药业集团股份有限公司', '', '山东省', '菏泽市', '东明县', '山东方明药业集团股份有限公司', '1');
INSERT INTO `yy_company` VALUES ('7', '广东南国药业有限公司', '', '广东省', '湛江市', '霞山区', '广东南国药业有限公司', '1');
INSERT INTO `yy_company` VALUES ('8', '长治市三宝生化药业有限公司', '', '山西省', '长治市', '屯留县', '长治市三宝生化药业有限公司', '1');

-- ----------------------------
-- Table structure for yy_goods
-- ----------------------------
DROP TABLE IF EXISTS `yy_goods`;
CREATE TABLE `yy_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) unsigned NOT NULL,
  `category_id_1` smallint(6) NOT NULL,
  `category_id_2` smallint(6) NOT NULL,
  `category_id_3` smallint(6) NOT NULL,
  `company_id` smallint(6) unsigned NOT NULL,
  `brand_id` smallint(6) NOT NULL,
  `goods_sn` varchar(50) NOT NULL COMMENT '唯一货号',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `goods_number` int(10) NOT NULL COMMENT '-1 为不限量',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL COMMENT '本店价',
  `goods_thumb` varchar(255) NOT NULL COMMENT '主图',
  `goods_desc` varchar(255) NOT NULL COMMENT '商品描述',
  `add_time` int(10) NOT NULL,
  `last_update` int(10) NOT NULL,
  `goods_spec` varchar(255) NOT NULL COMMENT '商品规格',
  `goods_pre` varchar(50) NOT NULL COMMENT '剂型',
  `big_number` smallint(6) NOT NULL COMMENT '件装',
  `middle_number` smallint(6) NOT NULL COMMENT '中装',
  `goods_approval` varchar(100) NOT NULL COMMENT '批准文号',
  `goods_batch` varchar(100) NOT NULL COMMENT '批次',
  `goods_detail` text NOT NULL COMMENT '商品详情',
  `goods_specification` text NOT NULL COMMENT '说明书',
  `is_best` tinyint(1) NOT NULL DEFAULT '-1',
  `is_hot` tinyint(1) NOT NULL DEFAULT '-1',
  `is_new` tinyint(1) NOT NULL DEFAULT '-1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_goods
-- ----------------------------

-- ----------------------------
-- Table structure for yy_manager
-- ----------------------------
DROP TABLE IF EXISTS `yy_manager`;
CREATE TABLE `yy_manager` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `uid` tinyint(3) unsigned NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `real_name` varchar(20) NOT NULL,
  `last_login_time` int(10) NOT NULL,
  `last_login_ip` bigint(20) NOT NULL,
  `login` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 表示正常',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_manager
-- ----------------------------
INSERT INTO `yy_manager` VALUES ('1', '1', 'admin', '', '1491774413', '0', '0', '1');

-- ----------------------------
-- Table structure for yy_session
-- ----------------------------
DROP TABLE IF EXISTS `yy_session`;
CREATE TABLE `yy_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_session
-- ----------------------------
INSERT INTO `yy_session` VALUES ('3752hro9853d73p11sp4govrk0', '1492529861', 0x757365725F617574687C613A343A7B733A333A22756964223B733A313A2231223B733A383A22757365726E616D65223B733A353A2261646D696E223B733A393A227265616C5F6E616D65223B733A303A22223B733A31353A226C6173745F6C6F67696E5F74696D65223B733A31303A2231343931373734343133223B7D);

-- ----------------------------
-- Table structure for yy_ucenter_member
-- ----------------------------
DROP TABLE IF EXISTS `yy_ucenter_member`;
CREATE TABLE `yy_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1 表示正常',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of yy_ucenter_member
-- ----------------------------
INSERT INTO `yy_ucenter_member` VALUES ('1', 'admin', 'eb4059334fc010c659d69ea8d3f6eb220265b663', '', '', '0', '0', '1492524243', '0', '0', '1');
