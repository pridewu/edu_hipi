/*
Navicat MySQL Data Transfer

Source Server         : .5
Source Server Version : 50166
Source Host           : 192.168.0.5:3306
Source Database       : edu_hipi

Target Server Type    : MYSQL
Target Server Version : 50166
File Encoding         : 65001

Date: 2014-11-27 17:50:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_ad
-- ----------------------------
DROP TABLE IF EXISTS `t_ad`;
CREATE TABLE `t_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asId` int(11) NOT NULL COMMENT '广告位ID',
  `adClass` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0为内部banner，1为广告',
  `apId` int(11) DEFAULT NULL COMMENT '广告商Id',
  `adId` int(11) DEFAULT NULL COMMENT '广告ID',
  `adType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '广告类型，0为图片，1为视频',
  `title` varchar(60) NOT NULL COMMENT '广告标题',
  `content` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `linkUrl` varchar(200) DEFAULT NULL COMMENT '访问地址',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '广告排序',
  `time` float(3,1) DEFAULT NULL COMMENT '跳转时间(单位秒)',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adSpaceId` (`asId`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_ad
-- ----------------------------
INSERT INTO `t_ad` VALUES ('1', '3', '0', '0', '0', '0', 'sdfd', '', '', '0', '0.0', '1', '2014-11-26 11:03:27');
INSERT INTO `t_ad` VALUES ('2', '3', '1', '1001', '23424', '0', 'dsfdsf', '', '', '0', '0.0', '1', '2014-11-26 11:35:58');

-- ----------------------------
-- Table structure for t_ad_space
-- ----------------------------
DROP TABLE IF EXISTS `t_ad_space`;
CREATE TABLE `t_ad_space` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asKey` varchar(20) NOT NULL COMMENT '广告位EKY',
  `title` varchar(20) NOT NULL COMMENT '广告位名称',
  `asType` tinyint(1) NOT NULL DEFAULT '0' COMMENT '广告位类型(0-单图片,1-轮播图,2-视频)',
  `showNum` tinyint(1) NOT NULL DEFAULT '1' COMMENT '广告位广告显示数量',
  `addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_ad_space
-- ----------------------------
INSERT INTO `t_ad_space` VALUES ('3', 'sdfds', 'sss', '0', '1', '2014-11-26 10:55:53');

-- ----------------------------
-- Table structure for t_channel
-- ----------------------------
DROP TABLE IF EXISTS `t_channel`;
CREATE TABLE `t_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(20) NOT NULL COMMENT '栏目名称',
  `chKey` varchar(20) NOT NULL COMMENT '栏目关键字',
  `imgUrl` varchar(200) DEFAULT NULL COMMENT '栏目导航图片',
  `linkUrl` varchar(100) NOT NULL COMMENT '栏目链接地址',
  `isShow` tinyint(1) DEFAULT '0' COMMENT '是否在首页导航中显示',
  `description` varchar(50) DEFAULT NULL COMMENT '栏目描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '栏目排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pId` (`pId`),
  KEY `chKey` (`chKey`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='栏目';

-- ----------------------------
-- Records of t_channel
-- ----------------------------
INSERT INTO `t_channel` VALUES ('1', '0', '精彩推荐', 'recommend', '', '', '1', '', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `t_channel` VALUES ('12', '0', '全部课程', 'allcourse', '', '', '1', '', '0', '1', '2014-11-19 14:00:11');
INSERT INTO `t_channel` VALUES ('13', '0', '我的课程', 'mycourse', '', '', '1', '', '0', '1', '2014-11-19 14:00:43');
INSERT INTO `t_channel` VALUES ('17', '0', '用户中心', 'usercenter', '', '', '0', '', '0', '1', '2014-11-19 18:16:23');
INSERT INTO `t_channel` VALUES ('18', '12', '早教', 'early', '', '', '0', '', '0', '1', '2014-11-22 09:36:57');
INSERT INTO `t_channel` VALUES ('19', '12', '幼教', 'preschool', '', '', '0', '', '0', '1', '2014-11-22 09:37:40');
INSERT INTO `t_channel` VALUES ('20', '12', '小学', 'primaryschool', '', '', '0', '', '0', '1', '2014-11-22 09:38:54');
INSERT INTO `t_channel` VALUES ('21', '12', '中学', 'middleschool', '', '', '0', '', '0', '1', '2014-11-22 09:39:08');

-- ----------------------------
-- Table structure for t_course
-- ----------------------------
DROP TABLE IF EXISTS `t_course`;
CREATE TABLE `t_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chId` int(11) NOT NULL COMMENT '栏目ID',
  `stageId` int(11) DEFAULT NULL COMMENT '龄段ID',
  `pressId` int(11) DEFAULT NULL COMMENT '出版社ID',
  `name` varchar(20) NOT NULL COMMENT '课程名称',
  `volume` tinyint(1) DEFAULT NULL COMMENT '0-上册，1-下册',
  `typeId` int(11) DEFAULT NULL COMMENT '类型(基础/拓展)ID',
  `price` float(3,2) NOT NULL DEFAULT '0.00',
  `midLibId` int(11) DEFAULT NULL COMMENT '期中考试题库ID',
  `finalLibId` int(11) DEFAULT NULL COMMENT '期末考试题库ID',
  `topicIds` varchar(50) NOT NULL COMMENT '知识点id(多个用逗号分隔)',
  `keys` varchar(50) DEFAULT NULL COMMENT '关键字(多个关键字用逗号分隔)',
  `imgUrl` varchar(200) DEFAULT NULL COMMENT '课程导航图片',
  `linkUrl` varchar(100) DEFAULT NULL COMMENT '课程链接地址',
  `description` varchar(50) DEFAULT NULL COMMENT '课程描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '课程排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chId` (`chId`),
  KEY `pressId` (`pressId`),
  KEY `typeId` (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='课程';

-- ----------------------------
-- Records of t_course
-- ----------------------------

-- ----------------------------
-- Table structure for t_library
-- ----------------------------
DROP TABLE IF EXISTS `t_library`;
CREATE TABLE `t_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '题库标题',
  `courseId` int(11) DEFAULT NULL COMMENT '课程ID',
  `sectionId` int(11) DEFAULT NULL COMMENT '课时ID',
  `rpId` int(11) DEFAULT NULL COMMENT '所属于资源商ID',
  `price` int(11) DEFAULT NULL COMMENT '价格',
  `auth` tinyint(1) DEFAULT NULL COMMENT '题库权限',
  `libUrl` varchar(50) NOT NULL COMMENT '题库路径',
  `imgUrl` varchar(50) DEFAULT NULL COMMENT '题库导航图片',
  `description` varchar(50) DEFAULT NULL COMMENT '题库描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '题库排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courseId` (`courseId`),
  KEY `sectionId` (`sectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='题库';

-- ----------------------------
-- Records of t_library
-- ----------------------------

-- ----------------------------
-- Table structure for t_pro_config
-- ----------------------------
DROP TABLE IF EXISTS `t_pro_config`;
CREATE TABLE `t_pro_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `cKey` varchar(20) NOT NULL COMMENT '配置关键字',
  `templete` varchar(50) NOT NULL,
  `content` text NOT NULL COMMENT '配置文本内容',
  `addTime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `cKey` (`cKey`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_pro_config
-- ----------------------------
INSERT INTO `t_pro_config` VALUES ('16', '产品配置', 'p*config', 'p_config.php', 'a:6:{s:12:\"channelThumb\";s:19:\"s=100*200,m=200*300\";s:10:\"courseType\";a:2:{i:1;s:6:\"基础\";i:2;s:6:\"拓展\";}s:4:\"keys\";a:3:{i:1;s:6:\"热门\";i:2;s:6:\"推荐\";i:3;s:6:\"置顶\";}s:2:\"rp\";a:1:{i:1001;s:9:\"掌世界\";}s:2:\"ap\";a:1:{i:1001;s:9:\"掌世界\";}s:5:\"press\";a:1:{i:2001;s:15:\"某某出版社\";}}', '2014-11-20 15:40:58');

-- ----------------------------
-- Table structure for t_resource
-- ----------------------------
DROP TABLE IF EXISTS `t_resource`;
CREATE TABLE `t_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '视频标题',
  `sectionId` int(11) DEFAULT NULL COMMENT '课时ID',
  `content` varchar(50) NOT NULL COMMENT '视频流code',
  `rpId` int(11) NOT NULL COMMENT '所属于资源商ID',
  `outId` int(11) NOT NULL COMMENT '外部统一编号',
  `playAuth` tinyint(1) DEFAULT NULL COMMENT '播放权限',
  `keyList` varchar(50) DEFAULT NULL COMMENT '关键字列表',
  `price` int(11) DEFAULT NULL COMMENT '单播价格',
  `libUrl` varchar(50) NOT NULL COMMENT '资源路径',
  `imgUrl` varchar(50) DEFAULT NULL COMMENT '资源导航图片',
  `playCount` int(11) DEFAULT NULL COMMENT '播放次数',
  `praiseCount` int(11) DEFAULT NULL COMMENT '点赞次数',
  `favorCount` int(11) DEFAULT NULL COMMENT '收藏次数',
  `description` varchar(100) DEFAULT NULL COMMENT '资源描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '资源排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sectionId` (`sectionId`),
  KEY `content` (`content`),
  KEY `keyList` (`keyList`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源';

-- ----------------------------
-- Records of t_resource
-- ----------------------------

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户id',
  `sex` tinyint(1) DEFAULT NULL COMMENT '用户性别',
  `stageId` int(11) DEFAULT NULL COMMENT '龄段ID',
  `nickName` varchar(20) DEFAULT NULL COMMENT '角色昵称',
  `interests` varchar(50) DEFAULT NULL COMMENT '兴趣爱好',
  `advantage` varchar(50) DEFAULT NULL COMMENT '强项',
  `disAdvantage` varchar(50) DEFAULT NULL COMMENT '弱项',
  `level` int(11) DEFAULT '0' COMMENT '荣誉等级',
  `point` int(11) DEFAULT '0' COMMENT '积分',
  `face` tinyint(2) DEFAULT '0' COMMENT '头像',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `stageId` (`stageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色表';

-- ----------------------------
-- Records of t_role
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_browse
-- ----------------------------
DROP TABLE IF EXISTS `t_role_browse`;
CREATE TABLE `t_role_browse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL COMMENT '角色id',
  `title` varchar(50) NOT NULL COMMENT '浏览内容标题',
  `url` varchar(100) NOT NULL COMMENT '收藏地址',
  `imgUrl` varchar(50) DEFAULT NULL COMMENT '图片地址',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色收藏记录表';

-- ----------------------------
-- Records of t_role_browse
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_favor
-- ----------------------------
DROP TABLE IF EXISTS `t_role_favor`;
CREATE TABLE `t_role_favor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL COMMENT '角色id',
  `title` varchar(50) DEFAULT NULL COMMENT '收藏标题',
  `url` varchar(100) NOT NULL COMMENT '收藏地址',
  `imgUrl` varchar(50) DEFAULT NULL COMMENT '图片地址',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色收藏记录表';

-- ----------------------------
-- Records of t_role_favor
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_library
-- ----------------------------
DROP TABLE IF EXISTS `t_role_library`;
CREATE TABLE `t_role_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL COMMENT '角色id',
  `libId` int(11) NOT NULL COMMENT '题库id',
  `libName` varchar(50) DEFAULT NULL COMMENT '题库id',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  KEY `libId` (`libId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色做题库记录表';

-- ----------------------------
-- Records of t_role_library
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_resource
-- ----------------------------
DROP TABLE IF EXISTS `t_role_resource`;
CREATE TABLE `t_role_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL COMMENT '角色id',
  `videoId` int(11) NOT NULL COMMENT '视频id',
  `videoName` varchar(50) DEFAULT NULL COMMENT '视频名称',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  KEY `videoId` (`videoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色观看视频记录表';

-- ----------------------------
-- Records of t_role_resource
-- ----------------------------

-- ----------------------------
-- Table structure for t_section
-- ----------------------------
DROP TABLE IF EXISTS `t_section`;
CREATE TABLE `t_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topicId` int(11) NOT NULL COMMENT '知识点ID',
  `name` varchar(20) NOT NULL COMMENT '课时名称',
  `libId` int(11) DEFAULT NULL COMMENT '题库ID',
  `previewList` varchar(20) DEFAULT NULL COMMENT '预习视频id(多个用逗号分隔)',
  `lessonList` varchar(20) DEFAULT NULL COMMENT '正文视频id(多个用逗号分隔)',
  `imgUrl` varchar(50) DEFAULT NULL COMMENT '课时导航图片',
  `description` varchar(50) DEFAULT NULL COMMENT '课时描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '课时排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topicId` (`topicId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='知识点';

-- ----------------------------
-- Records of t_section
-- ----------------------------

-- ----------------------------
-- Table structure for t_stage
-- ----------------------------
DROP TABLE IF EXISTS `t_stage`;
CREATE TABLE `t_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `sKey` varchar(20) NOT NULL COMMENT '龄段key',
  `chId` int(11) NOT NULL COMMENT '所属一级分类ID（全部课程下的子栏目）',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sKey` (`sKey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色龄段表';

-- ----------------------------
-- Records of t_stage
-- ----------------------------
INSERT INTO `t_stage` VALUES ('2', '一年级', 'gradeOne', '20', '0', '1', '2014-11-23 11:35:10');

-- ----------------------------
-- Table structure for t_sys_log
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_log`;
CREATE TABLE `t_sys_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员',
  `controller` varchar(25) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(25) NOT NULL DEFAULT '' COMMENT '操作',
  `data` text COMMENT '操作数据',
  `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`addTime`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sys_log
-- ----------------------------
INSERT INTO `t_sys_log` VALUES ('258', '', 'Public', 'login', 'a:2:{s:3:\"get\";a:1:{s:4:\"ajax\";s:4:\"true\";}s:4:\"post\";a:1:{s:8:\"userName\";s:5:\"admin\";}}', '1417081669');
INSERT INTO `t_sys_log` VALUES ('259', 'admin', 'ProConfig', 'edit', 'a:2:{s:3:\"get\";a:1:{s:2:\"id\";s:2:\"16\";}s:4:\"post\";a:4:{s:2:\"id\";s:2:\"16\";s:4:\"name\";s:12:\"产品配置\";s:4:\"cKey\";s:8:\"p*config\";s:8:\"templete\";s:12:\"p_config.php\";}}', '1417081673');
INSERT INTO `t_sys_log` VALUES ('260', 'admin', 'ProConfig', 'reloadConf', 'a:2:{s:3:\"get\";a:0:{}s:4:\"post\";a:1:{s:2:\"id\";s:2:\"16\";}}', '1417081676');

-- ----------------------------
-- Table structure for t_sys_role
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_role`;
CREATE TABLE `t_sys_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `name` varchar(24) NOT NULL DEFAULT '',
  `auth` text COMMENT '权限列表',
  `isSuper` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超级管理组',
  `addTime` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sys_role
-- ----------------------------
INSERT INTO `t_sys_role` VALUES ('1', '超级管理组', 'N;', '1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_sys_user
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_user`;
CREATE TABLE `t_sys_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `name` varchar(24) NOT NULL COMMENT '管理员用户名',
  `realName` varchar(24) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `roleId` int(11) NOT NULL DEFAULT '0' COMMENT '所属角色',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：0-禁用,1-启用',
  `lastTime` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '最后登录时间',
  `lastIp` varchar(23) NOT NULL DEFAULT '' COMMENT '最后登录ＩＰ',
  `addTime` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sys_user
-- ----------------------------
INSERT INTO `t_sys_user` VALUES ('1', 'admin', '系统管理员', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '2014-11-27 17:47:49', '192.168.0.152', '1970-01-01 00:00:00');

-- ----------------------------
-- Table structure for t_topic
-- ----------------------------
DROP TABLE IF EXISTS `t_topic`;
CREATE TABLE `t_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseId` int(11) NOT NULL COMMENT '课程ID',
  `name` varchar(20) NOT NULL COMMENT '知识点名称',
  `sectionIds` varchar(50) NOT NULL COMMENT '课时id(多个用逗号分隔)',
  `imgUrl` varchar(200) DEFAULT NULL COMMENT '知识点导航图片',
  `description` varchar(50) DEFAULT NULL COMMENT '知识点描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '知识点排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courseId` (`courseId`),
  KEY `sectionIds` (`sectionIds`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='知识点';

-- ----------------------------
-- Records of t_topic
-- ----------------------------

-- ----------------------------
-- Table structure for t_upfile
-- ----------------------------
DROP TABLE IF EXISTS `t_upfile`;
CREATE TABLE `t_upfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileType` tinyint(4) NOT NULL DEFAULT '0' COMMENT '文件类型',
  `url` varchar(50) DEFAULT '' COMMENT 'URL地址',
  `thumb` varchar(50) DEFAULT NULL COMMENT '缩略图',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '大小',
  `memo` varchar(100) DEFAULT NULL COMMENT '备注',
  `addTime` datetime DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2590 DEFAULT CHARSET=utf8 COMMENT='上传文件';

-- ----------------------------
-- Records of t_upfile
-- ----------------------------
INSERT INTO `t_upfile` VALUES ('2588', '1', 'c/546b1b6e7a5d7.png', 's=100*200,m=200*300', '361', '栏目导航图片：testss', '2014-11-18 18:11:58');
INSERT INTO `t_upfile` VALUES ('2589', '1', '0/546b1bac6f261.png', '', '361', '栏目导航图片：ds', '2014-11-18 18:13:00');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opUserId` varchar(30) NOT NULL COMMENT '运营商提供的UserID',
  `opUserToken` varchar(50) DEFAULT NULL COMMENT '运营商提供的UserToken',
  `opUserName` varchar(30) DEFAULT NULL COMMENT '运营商提供的用户Name',
  `nickName` varchar(20) NOT NULL COMMENT '用户昵称',
  `point` int(11) DEFAULT '0' COMMENT '用户积分',
  `amount` int(11) DEFAULT '0' COMMENT '用户元宝',
  `face` tinyint(2) DEFAULT '0' COMMENT '用户头像',
  `phone` int(11) DEFAULT '0' COMMENT '联系电话',
  `qq` int(11) DEFAULT '0' COMMENT 'QQ',
  `email` varchar(50) DEFAULT NULL COMMENT 'E-mail',
  `address` varchar(100) DEFAULT NULL COMMENT '住址',
  `addTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `opUserId` (`opUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t_user
-- ----------------------------
