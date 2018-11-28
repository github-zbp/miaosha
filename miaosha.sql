-- MySQL dump 10.13  Distrib 5.7.21, for Win32 (AMD64)
--
-- Host: localhost    Database: miaosha
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ms_active`
--

DROP TABLE IF EXISTS `ms_active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_active` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `time_begin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `time_end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `sys_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sys_lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sys_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 待上线; 1 已上线; 2 已下线',
  `sys_ip` varchar(50) NOT NULL COMMENT '创建人ip',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_active`
--

LOCK TABLES `ms_active` WRITE;
/*!40000 ALTER TABLE `ms_active` DISABLE KEYS */;
INSERT INTO `ms_active` VALUES (1,'测试活动',1500000000,1590000000,0,0,1,'127.0.0.1'),(2,'苹果抢购节',1500000000,1590000000,0,0,2,'127.0.0.1');
/*!40000 ALTER TABLE `ms_active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_goods`
--

DROP TABLE IF EXISTS `ms_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动id 某个商品对应某个活动',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL COMMENT '支持HTML',
  `img` varchar(255) NOT NULL COMMENT '小图标 列表中显示',
  `price_normal` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '原价',
  `price_discount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '秒杀价',
  `num_total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品总数',
  `num_user` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '每个用户可以买多少该商品',
  `num_left` int(11) NOT NULL DEFAULT '0' COMMENT '剩余商品量 即库存',
  `sys_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sys_lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sys_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 待上线; 1 已上线; 2 已下线',
  `sys_ip` varchar(50) NOT NULL COMMENT '创建人ip',
  PRIMARY KEY (`id`),
  KEY `active_id` (`active_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_goods`
--

LOCK TABLES `ms_goods` WRITE;
/*!40000 ALTER TABLE `ms_goods` DISABLE KEYS */;
INSERT INTO `ms_goods` VALUES (1,1,'OPPO A7 新品','Hyper Boost加速引擎超长续航AI智慧美颜','1.png',1799,1599,10000,2,10000,0,0,1,'127.0.0.1'),(2,1,'小米 小米手机8','超清四曲面AI超感光双摄红外人脸识别','2.png',1599,1499,10000,2,10000,0,0,1,'127.0.0.1'),(3,2,'苹果 iPhone 8 Plus ','双镜头光学变焦 原彩显示技术 全新感光元件','3.png',5288,5088,10000,2,10000,0,0,1,'127.0.0.1');
/*!40000 ALTER TABLE `ms_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_log`
--

DROP TABLE IF EXISTS `ms_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动id 某个商品对应某个活动',
  `uid` int(10) unsigned NOT NULL,
  `action` varchar(50) NOT NULL COMMENT '操作名称',
  `result` varchar(50) NOT NULL COMMENT '返回信息',
  `info` text NOT NULL COMMENT '操作详情 json',
  `sys_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sys_lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sys_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 正常; 1 异常; 2 已处理的异常',
  `sys_ip` varchar(50) NOT NULL COMMENT '用户ip',
  PRIMARY KEY (`id`),
  KEY `active_id` (`active_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_log`
--

LOCK TABLES `ms_log` WRITE;
/*!40000 ALTER TABLE `ms_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_order`
--

DROP TABLE IF EXISTS `ms_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(32) NOT NULL,
  `active_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `num_total` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '购买的商品总数',
  `num_goods` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '购买的商品种类数',
  `price_total` decimal(10,0) unsigned NOT NULL DEFAULT '0' COMMENT '订单总金额',
  `price_discount` decimal(10,0) unsigned NOT NULL DEFAULT '0' COMMENT '优惠后的金额',
  `time_confirm` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  `time_pay` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `time_over` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `time_cancel` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '取消时间',
  `goods_info` text NOT NULL COMMENT '订单详情 json',
  `uid` int(10) unsigned NOT NULL,
  `sys_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sys_lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sys_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 初始状态; 1 待支付; 2 已支付; 3 已过期; 4 已确认; 5 已取消; 6 已删除; 7 已发货; 8 已收货; 9 已完成',
  `sys_ip` varchar(50) NOT NULL COMMENT '用户ip',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `active_id` (`active_id`),
  KEY `goods_id` (`goods_id`),
  KEY `order_no` (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_order`
--

LOCK TABLES `ms_order` WRITE;
/*!40000 ALTER TABLE `ms_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_question`
--

DROP TABLE IF EXISTS `ms_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '问答ID',
  `active_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属活动ID',
  `title` varchar(255) NOT NULL COMMENT '问题描述',
  `ask1` varchar(255) NOT NULL COMMENT '问题1',
  `answer1` varchar(255) NOT NULL COMMENT '答案1',
  `ask2` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `ask3` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL,
  `ask4` varchar(255) NOT NULL,
  `answer4` varchar(255) NOT NULL,
  `ask5` varchar(255) NOT NULL,
  `answer5` varchar(255) NOT NULL,
  `ask6` varchar(255) NOT NULL,
  `answer6` varchar(255) NOT NULL,
  `ask7` varchar(255) NOT NULL,
  `answer7` varchar(255) NOT NULL,
  `ask8` varchar(255) NOT NULL,
  `answer8` varchar(255) NOT NULL,
  `ask9` varchar(255) NOT NULL,
  `answer9` varchar(255) NOT NULL,
  `ask10` varchar(255) NOT NULL,
  `answer10` varchar(255) NOT NULL,
  `sys_dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sys_lastmodify` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `sys_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态，0 正常，1 删除',
  `sys_ip` varchar(50) NOT NULL COMMENT '发布人的IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='问答信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_question`
--

LOCK TABLES `ms_question` WRITE;
/*!40000 ALTER TABLE `ms_question` DISABLE KEYS */;
INSERT INTO `ms_question` VALUES (1,1,'下面的哪个是正确的翻译?','春天','spring','夏天','summer','冬天','winter','秋天','autumn','红色','red','蓝色','blue','黄色','yellow','白色','white','黑色','black','橙色','orange',1500198704,1500199367,0,'127.0.0.1'),(2,2,'下面哪个是正确的省会城市','河北','石家庄','河南','郑州','山西','太原','陕西','西安','甘肃','兰州','江西','南昌','浙江','杭州','广东','广州','江苏','南京','安徽','合肥',1500561787,1542768528,0,'127.0.0.1');
/*!40000 ALTER TABLE `ms_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_user`
--

DROP TABLE IF EXISTS `ms_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` char(32) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_user`
--

LOCK TABLES `ms_user` WRITE;
/*!40000 ALTER TABLE `ms_user` DISABLE KEYS */;
INSERT INTO `ms_user` VALUES (1,'zbp','573234044','13308433655');
/*!40000 ALTER TABLE `ms_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-28 12:55:05
