-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-12-10 09:16:54
-- 服务器版本： 10.1.37-MariaDB
-- PHP 版本： 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `rh`
--

-- --------------------------------------------------------

--
-- 表的结构 `rh_admin`
--

CREATE TABLE `rh_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL COMMENT '用户名',
  `password` varchar(60) NOT NULL,
  `group_id` tinyint(4) NOT NULL COMMENT '管理组ID',
  `ip` varchar(30) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `login_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- --------------------------------------------------------

--
-- 表的结构 `rh_group`
--

CREATE TABLE `rh_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `oauth` varchar(2000) NOT NULL,
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `rh_image`
--

CREATE TABLE `rh_image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL COMMENT '图片路径',
  `from` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 来自本地，2 来自公网',
  `use_name` varchar(80) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT '图片分类',
  `is_visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否能显示1能0不能',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图片总表';

-- --------------------------------------------------------

--
-- 表的结构 `rh_image_category`
--

CREATE TABLE `rh_image_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `is_visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `rh_sys_backup`
--

CREATE TABLE `rh_sys_backup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `size` varchar(20) NOT NULL COMMENT '大小',
  `url` varchar(255) NOT NULL COMMENT '路径',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `rh_sys_config`
--

CREATE TABLE `rh_sys_config` (
  `id` int(11) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `switch` int(11) NOT NULL DEFAULT '0' COMMENT '是否是开关0不是1是',
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- --------------------------------------------------------

--
-- 表的结构 `rh_template`
--

CREATE TABLE `rh_template` (
  `id` int(11) NOT NULL,
  `temp_key` varchar(50) NOT NULL COMMENT '模板编号',
  `temp_name` varchar(50) NOT NULL COMMENT '名称',
  `content` text NOT NULL COMMENT '回复内容',
  `temp_id` varchar(255) NOT NULL COMMENT '模板编号',
  `state` int(11) NOT NULL COMMENT '状态是否开启'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模板表';

-- --------------------------------------------------------

--
-- 表的结构 `rh_user`
--

CREATE TABLE `rh_user` (
  `id` int(11) NOT NULL,
  `openid` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '小程序openid',
  `openid_gzh` varchar(70) NOT NULL COMMENT '公众号openid',
  `unionid` varchar(70) NOT NULL,
  `nickname` varchar(60) NOT NULL,
  `headpic` varchar(500) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `start` int(11) DEFAULT NULL,
  `points` int(11) NOT NULL COMMENT '积分',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `web_auth_id` int(11) NOT NULL COMMENT '前端管理权限',
  `update_time` int(11) DEFAULT NULL,
  `is_visible` int(1) NOT NULL DEFAULT '1' COMMENT '1显示0隐藏'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转储表的索引
--

--
-- 表的索引 `rh_admin`
--
ALTER TABLE `rh_admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_group`
--
ALTER TABLE `rh_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_image`
--
ALTER TABLE `rh_image`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_image_category`
--
ALTER TABLE `rh_image_category`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_sys_backup`
--
ALTER TABLE `rh_sys_backup`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_sys_config`
--
ALTER TABLE `rh_sys_config`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_template`
--
ALTER TABLE `rh_template`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rh_user`
--
ALTER TABLE `rh_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `rh_admin`
--
ALTER TABLE `rh_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_group`
--
ALTER TABLE `rh_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_image`
--
ALTER TABLE `rh_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_image_category`
--
ALTER TABLE `rh_image_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_sys_backup`
--
ALTER TABLE `rh_sys_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_sys_config`
--
ALTER TABLE `rh_sys_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_template`
--
ALTER TABLE `rh_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `rh_user`
--
ALTER TABLE `rh_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
