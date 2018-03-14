/*
SQLyog Professional v12.08 (64 bit)
MySQL - 5.6.27-log : Database - localhost82
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cms_auth_group` */

DROP TABLE IF EXISTS `cms_auth_group`;

CREATE TABLE `cms_auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(10) NOT NULL COMMENT '名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0:禁用，1:启用',
  `rules` text COMMENT '授权菜单',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `pid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '上级角色ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台角色表';

/*Data for the table `cms_auth_group` */

insert  into `cms_auth_group`(`id`,`title`,`status`,`rules`,`sort`,`pid`) values (1,'超级管理员',1,NULL,1,0),(2,'普通管理员',1,'1,2,3,4,5,6,7,10,20,21,34,35,36,44,45,58,77,78',1,1),(3,'信息发布员',1,'1,2,3,10,58,77,78',2,2);

/*Table structure for table `cms_auth_group_access` */

DROP TABLE IF EXISTS `cms_auth_group_access`;

CREATE TABLE `cms_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户UID',
  `group_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台用户角色关系表';

/*Data for the table `cms_auth_group_access` */

insert  into `cms_auth_group_access`(`uid`,`group_id`) values (1,1);

/*Table structure for table `cms_auth_rule` */

DROP TABLE IF EXISTS `cms_auth_rule`;

CREATE TABLE `cms_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(250) NOT NULL COMMENT '规则',
  `title` varchar(30) NOT NULL COMMENT '名称',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1:URL，2:主菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0:禁用，1:启用',
  `condition` varchar(100) DEFAULT NULL COMMENT '条件',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `iconcls` varchar(20) DEFAULT NULL COMMENT '图标样式',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `open_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '打开类型 0:ajax，1:iframe, 2:dialog',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='菜单表';

/*Data for the table `cms_auth_rule` */

insert  into `cms_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`sort`,`iconcls`,`pid`,`open_type`) values (1,'Person','个人中心',1,1,'',50,'fa fa-user',0,0),(2,'Person/Panel','用户面板',1,1,'',50,'fa fa-user',1,0),(3,'Person/Profile','用户资料',1,1,'',50,'fa fa-user',2,0),(4,'Person/EditPassword','修改密码',1,1,NULL,50,'fa fa-user',2,0),(5,'Person/EditProfile','修改资料',1,1,NULL,50,'fa fa-user',2,0),(6,'Person/Log','行为日志',1,1,NULL,50,'fa fa-user',2,0),(7,'Person/ViewLog','查看日志',1,1,NULL,50,'fa fa-user',6,0),(8,'Person/DelLog','删除日志',1,1,NULL,50,'fa fa-user',6,0),(9,'Person/ClearLog','清空日志',1,1,NULL,50,'fa fa-user',6,0),(10,'System','系统中心',1,1,NULL,50,'fa fa-user',0,0),(11,'System/Setting','系统设置',1,1,NULL,50,'fa fa-user',10,0),(12,'Config/WebConfig','网站配置',1,1,NULL,50,'fa fa-user',11,0),(13,'Config/Manage','配置管理',1,1,NULL,50,'fa fa-user',11,0),(14,'Config/ViewConfig','查看配置',1,1,NULL,50,'fa fa-user',13,0),(15,'Config/AddConfig','新增配置',1,1,NULL,50,'fa fa-user',13,0),(16,'Config/EditConfig','编辑配置',1,1,NULL,50,'fa fa-user',13,0),(17,'Config/SaveConfig','保存配置',1,1,NULL,50,'fa fa-user',13,0),(18,'Config/CreateConfig','生成配置',1,1,'',50,'fa fa-user',13,0),(19,'Config/LoadConfig','加载配置',1,1,NULL,50,'fa fa-user',13,0),(20,'Menu/Manage','菜单管理',1,1,NULL,50,'fa fa-user',11,0),(21,'Menu/ViewMenu','查看菜单',1,1,NULL,50,'fa fa-user',20,0),(22,'Menu/AddMenu','新增菜单',1,1,NULL,50,'fa fa-user',20,0),(23,'Menu/EditMenu','编辑菜单',1,1,NULL,50,'fa fa-user',20,0),(24,'Menu/DelMenu','删除菜单',1,1,NULL,50,'fa fa-user',20,0),(25,'Menu/SortMenu','排序菜单',1,1,NULL,50,'fa fa-user',20,0),(26,'Database/Index','数据备份',1,1,NULL,50,'fa fa-user',10,0),(27,'Database/ExportDatabase','备份数据',1,1,NULL,50,'fa fa-user',26,0),(28,'Database/Export','备份',1,1,NULL,50,'fa fa-user',27,0),(29,'Database/OptimizeDatabase','优化',1,1,NULL,50,'fa fa-user',27,0),(30,'Database/RepairDatabase','修复',1,1,NULL,50,'fa fa-user',27,0),(31,'Database/ImportDatabase','还原数据',1,1,NULL,50,'fa fa-user',26,0),(32,'Database/Import','还原',1,1,NULL,50,'fa fa-user',31,0),(33,'Database/Del','删除',1,1,NULL,50,'fa fa-user',31,0),(34,'User/Setting','用户设置',1,1,NULL,50,'fa fa-user',10,0),(35,'User/Manage','用户管理',1,1,NULL,50,'fa fa-user',34,0),(36,'User/ViewUser','查看用户',1,1,NULL,50,'fa fa-user',35,0),(37,'User/AddUser','新增用户',1,1,NULL,50,'fa fa-user',35,0),(38,'User/EditUser','编辑用户',1,1,NULL,50,'fa fa-user',35,0),(39,'User/DelUser','删除用户',1,1,NULL,50,'fa fa-user',35,0),(40,'User/ResetPassword','重置密码',1,1,NULL,50,'fa fa-user',35,0),(41,'User/CategroyAccess','分类授权',1,1,'',50,'fa fa-user',35,0),(42,'User/GroupAccess','角色授权',1,1,'',50,'fa fa-user',35,0),(43,'User/BranchAccess','部门授权',1,1,'',50,'fa fa-user',35,0),(44,'Group/Manage','角色管理',1,1,NULL,50,'fa fa-user',34,0),(45,'Group/ViewGroup','查看角色',1,1,NULL,50,'fa fa-user',44,0),(46,'Group/AddGroup','新增角色',1,1,NULL,50,'fa fa-user',44,0),(47,'Group/EditGroup','编辑角色',1,1,NULL,50,'fa fa-user',44,0),(48,'Group/DelGroup','删除角色',1,1,NULL,50,'fa fa-user',44,0),(49,'Group/Access','菜单授权',1,1,NULL,50,'fa fa-user',44,0),(50,'Group/User','用户授权',1,1,NULL,50,'fa fa-user',44,0),(51,'Branch/Manage','部门管理',1,1,NULL,50,'fa fa-user',34,0),(52,'Branch/ViewBranch','查看部门',1,1,NULL,50,'fa fa-user',51,0),(53,'Branch/AddBranch','新增部门',1,1,NULL,50,'fa fa-user',51,0),(54,'Branch/EditBranch','编辑部门',1,1,NULL,50,'fa fa-user',51,0),(55,'Branch/DelBranch','删除部门',1,1,NULL,50,'fa fa-user',51,0),(56,'Branch/SortBranch','排序部门',1,1,NULL,50,'fa fa-user',51,0),(57,'Branch/UserAccess','用户授权',1,1,'',50,'fa fa-user',51,0),(58,'Member','会员中心',1,1,NULL,50,'fa fa-user',0,0),(59,'Member/Setting','会员设置',1,1,NULL,50,'fa fa-user',58,0),(60,'Member/Manage','会员管理',1,1,'',50,'fa fa-user',59,0),(61,'Member/ViewMember','查看会员',1,1,NULL,50,'fa fa-user',60,0),(62,'Member/AddMember','新增会员',1,1,NULL,50,'fa fa-user',60,0),(63,'Member/EditMember','编辑会员',1,1,NULL,50,'fa fa-user',60,0),(64,'Member/DelMember','删除会员',1,1,NULL,50,'fa fa-user',60,0),(65,'Member/ResetPassword','重置密码',1,1,NULL,50,'fa fa-user',60,0),(66,'Behavior/Manage','行为管理',1,1,NULL,50,'fa fa-user',58,0),(67,'Behavior/List','行为列表',1,1,NULL,50,'fa fa-user',66,0),(68,'Behavior/ViewBehavior','查看行为',1,1,NULL,50,'fa fa-user',67,0),(69,'Behavior/AddBehavior','新增行为',1,1,NULL,50,'fa fa-user',67,0),(70,'Behavior/EditBehavior','编辑行为',1,1,NULL,50,'fa fa-user',67,0),(71,'Behavior/DelBehavior','删除行为',1,1,NULL,50,'fa fa-user',67,0),(72,'Log/List','日志列表',1,1,NULL,50,'fa fa-user',66,0),(73,'Log/ViewLog','查看日志',1,1,NULL,50,'fa fa-user',72,0),(74,'Log/AddLog','新增日志',1,1,NULL,50,'fa fa-user',72,0),(75,'Log/DelLog','删除日志',1,1,NULL,50,'fa fa-user',72,0),(76,'Log/ClearLog','清空日志',1,1,NULL,50,'fa fa-user',72,0),(77,'Content','内容中心',1,0,'',50,'fa fa-user',0,0),(78,'Extends','扩展中心',1,1,'',50,'fa fa-home',0,0),(79,'Config/DelConfig','删除配置',1,1,'',50,'fa fa-home',13,0);

/*Table structure for table `cms_branch` */

DROP TABLE IF EXISTS `cms_branch`;

CREATE TABLE `cms_branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(10) NOT NULL COMMENT '名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0:禁用，1:启用',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `pid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '上级部门ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台部门表';

/*Data for the table `cms_branch` */

insert  into `cms_branch`(`id`,`title`,`status`,`sort`,`pid`) values (1,'超级部门',1,1,0);

/*Table structure for table `cms_branch_access` */

DROP TABLE IF EXISTS `cms_branch_access`;

CREATE TABLE `cms_branch_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户UID',
  `branch_id` int(10) unsigned NOT NULL COMMENT '部门ID',
  UNIQUE KEY `uid_group_id` (`uid`,`branch_id`),
  KEY `uid` (`uid`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台用户部门关系表';

/*Data for the table `cms_branch_access` */

insert  into `cms_branch_access`(`uid`,`branch_id`) values (1,1);

/*Table structure for table `cms_config` */

DROP TABLE IF EXISTS `cms_config`;

CREATE TABLE `cms_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) DEFAULT NULL COMMENT '配置值',
  `remark` varchar(100) DEFAULT '' COMMENT '配置说明',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `value` text COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cms_config` */

insert  into `cms_config`(`id`,`name`,`type`,`title`,`group`,`extra`,`remark`,`status`,`value`,`sort`) values (1,'WEB_TITLE',0,'系统名称',0,NULL,'用于显示系统的名称',1,'超级后台管理系统',50);

/*Table structure for table `cms_member` */

DROP TABLE IF EXISTS `cms_member`;

CREATE TABLE `cms_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` char(16) NOT NULL COMMENT '昵称',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别 0:保密，1:男，2:女',
  `birthday` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `email` char(32) NOT NULL DEFAULT '0' COMMENT '邮箱',
  `qq` bigint(15) unsigned NOT NULL DEFAULT '0' COMMENT 'QQ',
  `mobile` char(15) NOT NULL COMMENT '手机号',
  `score` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `gold` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '金币',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 0:禁用，1:启用，2：未验证',
  `face` varchar(250) DEFAULT NULL COMMENT '头像',
  `user_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型 0:会员，1:管理',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `qq` (`qq`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `cms_member` */

insert  into `cms_member`(`uid`,`username`,`password`,`nickname`,`sex`,`birthday`,`email`,`qq`,`mobile`,`score`,`gold`,`status`,`face`,`user_type`,`reg_ip`,`reg_time`,`last_login_ip`,`last_login_time`) values (1,'admin','67c0f828a0e813f57fa552132516e7e3','超级管理员',1,812563200,'624508914@qq.com',624508914,'18179612275',0,21,1,NULL,1,0,0,0,1461123325);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
