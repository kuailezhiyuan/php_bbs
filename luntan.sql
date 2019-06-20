/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `db_luntan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_luntan`;

CREATE TABLE IF NOT EXISTS `tbl_board` (
  `bId` int(11) NOT NULL AUTO_INCREMENT,
  `boardName` varchar(50) DEFAULT NULL,
  `parentId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM `tbl_board`;
/*!40000 ALTER TABLE `tbl_board` DISABLE KEYS */;
INSERT INTO `tbl_board` (`bId`, `boardName`, `parentId`) VALUES
	(1, '网络', 0),
	(2, '软件', 0),
	(3, '布线', 1),
	(4, '网络', 1),
	(5, 'c#', 2),
	(6, 'java', 2);
/*!40000 ALTER TABLE `tbl_board` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tbl_reply` (
  `rId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Content` mediumtext NOT NULL,
  `publishTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifyTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uId` int(11) NOT NULL,
  `tId` int(11) NOT NULL,
  PRIMARY KEY (`rId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM `tbl_reply`;
/*!40000 ALTER TABLE `tbl_reply` DISABLE KEYS */;
INSERT INTO `tbl_reply` (`rId`, `Title`, `Content`, `publishTime`, `modifyTime`, `uId`, `tId`) VALUES
	(1, 'test', '11111', '2019-05-23 15:31:00', '2019-05-23 15:31:01', 1, 1),
	(2, 'test', '11111', '2019-05-23 15:31:00', '2019-05-23 15:31:01', 1, 4),
	(3, 'test2', '22222222', '2019-05-24 15:31:00', '2019-05-23 15:31:01', 1, 4),
	(4, 'test2', '22222222', '2019-05-24 15:31:00', '2019-05-23 15:31:01', 1, 16),
	(5, '1212', '1212', '2019-06-18 08:58:53', '2019-06-18 08:58:53', 1, 16),
	(6, '笔记本', '13213123123', '2019-06-20 09:01:28', '2019-06-20 09:01:28', 3, 16);
/*!40000 ALTER TABLE `tbl_reply` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tbl_topic` (
  `tId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Content` mediumtext NOT NULL,
  `publishTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uId` int(11) NOT NULL,
  `bId` int(11) NOT NULL,
  PRIMARY KEY (`tId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM `tbl_topic`;
/*!40000 ALTER TABLE `tbl_topic` DISABLE KEYS */;
INSERT INTO `tbl_topic` (`tId`, `Title`, `Content`, `publishTime`, `modifyTime`, `uId`, `bId`) VALUES
	(1, 'hello', '11111', '2019-05-23 10:22:51', '2019-05-23 10:22:33', 1, 1),
	(2, '邢西峰', '2222222', '2019-05-24 10:28:49', '2019-05-23 10:28:56', 1, 2),
	(3, '测试1', 'by ', '2019-05-25 10:28:49', '2019-05-23 10:28:56', 1, 3),
	(4, '啊啊啊', '今天是个好日子', '2019-05-26 10:28:49', '2019-05-23 10:28:56', 1, 4),
	(5, '邢西峰', '55555555', '2019-05-27 10:28:49', '2019-05-23 10:28:56', 1, 5),
	(6, '测试2', 'by ', '2019-05-25 10:28:49', '2019-05-23 10:28:56', 1, 3),
	(7, '测试3', 'by ', '2019-05-25 10:28:49', '2019-05-23 10:28:56', 1, 3),
	(8, '测试6', 'by ', '2019-05-25 11:28:49', '2019-05-23 10:28:56', 1, 3),
	(9, '测试4', 'by ', '2019-05-25 10:28:49', '2019-05-23 10:28:56', 1, 3),
	(10, '测试5', 'by ', '2019-05-25 10:28:49', '2019-05-23 10:28:56', 1, 3),
	(11, '1231', '21212', '2019-06-13 12:42:05', '2019-06-13 12:42:05', 1, 3),
	(12, '1231', '21212', '2019-06-13 12:42:34', '2019-06-13 12:42:34', 1, 3),
	(13, '1231', '21212', '2019-06-13 12:42:52', '2019-06-13 12:42:52', 1, 3),
	(14, '1231', '21212', '2019-06-13 12:43:05', '2019-06-13 12:43:05', 1, 3),
	(15, '1231', '21212', '2019-06-13 12:43:29', '2019-06-13 12:43:29', 1, 3),
	(16, '笔记本', '单方事故讽德诵功', '2019-06-13 12:49:22', '2019-06-13 12:49:22', 1, 3);
/*!40000 ALTER TABLE `tbl_topic` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uName` varchar(20) NOT NULL,
  `uPass` varchar(20) NOT NULL,
  `head` varchar(50) NOT NULL,
  `gender` smallint(6) NOT NULL,
  `regTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM `tbl_user`;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`uid`, `uName`, `uPass`, `head`, `gender`, `regTime`) VALUES
	(1, '111', '111', '6.gif', 1, '2019-05-16 02:20:01'),
	(2, '222', '222', '9.gif', 1, '2019-05-23 03:27:40'),
	(3, '333', '333', '5.gif', 2, '2019-06-20 01:00:47');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
