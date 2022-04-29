-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 04:31 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpit`
--

-- --------------------------------------------------------

--
-- Table structure for table `ab_admin`
--

CREATE TABLE `ab_admin` (
  `adminID` int(11) NOT NULL COMMENT 'Admin index ID',
  `name` varchar(50) DEFAULT NULL,
  `userName` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `otp` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `userRole` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 is recuriter \n2 is super admin',
  `createdDate` datetime NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `status` enum('active','inactive','delete') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Admin user table';

--
-- Dumping data for table `ab_admin`
--

INSERT INTO `ab_admin` (`adminID`, `name`, `userName`, `email`, `password`, `otp`, `roleID`, `userRole`, `createdDate`, `lastLogin`, `status`) VALUES
(1, 'kiran Malave', 'admin', 'kiran.malave@gmail.com', 'admin@123!', 0, 1, 1, '2021-04-04 00:00:00', '2021-09-03 19:57:38', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ab_adminsessions`
--

CREATE TABLE `ab_adminsessions` (
  `sessionID` int(11) NOT NULL,
  `sessionKey` varchar(100) DEFAULT NULL,
  `adminID` int(11) NOT NULL,
  `createdDate` timestamp NULL DEFAULT current_timestamp(),
  `accessDate` timestamp NULL DEFAULT NULL,
  `IP` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_adminsessions`
--

INSERT INTO `ab_adminsessions` (`sessionID`, `sessionKey`, `adminID`, `createdDate`, `accessDate`, `IP`) VALUES
(512, '5cipujhv4g1biluitss2hcvrbj5u2ogr', 1, '2021-09-03 14:27:38', '2021-09-03 14:29:38', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `ab_blogs`
--

CREATE TABLE `ab_blogs` (
  `blogID` int(11) NOT NULL,
  `blogTitle` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(55) NOT NULL,
  `blogImage` varchar(100) NOT NULL,
  `blogTemplate` varchar(50) NOT NULL,
  `pageCode` longtext NOT NULL,
  `pageCss` longtext NOT NULL,
  `pageContent` longtext NOT NULL,
  `createdDate` date NOT NULL,
  `createdBy` int(11) NOT NULL,
  `ModifiedDate` date NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `status` enum('active','inactive','delete') NOT NULL DEFAULT 'active',
  `blogLink` text NOT NULL,
  `blogSubTitle` varchar(100) NOT NULL,
  `metaKeywords` varchar(55) NOT NULL,
  `metaDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_blogs`
--

INSERT INTO `ab_blogs` (`blogID`, `blogTitle`, `description`, `category`, `blogImage`, `blogTemplate`, `pageCode`, `pageCss`, `pageContent`, `createdDate`, `createdBy`, `ModifiedDate`, `modifiedBy`, `status`, `blogLink`, `blogSubTitle`, `metaKeywords`, `metaDesc`) VALUES
(16, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '7,5', 'blogImage821.jpg', 'temp1', '&lt;div class=&quot;rowData ui-sortable-handle&quot; data-count=&quot;1&quot; data-type=&quot;row&quot;&gt;&lt;div class=&quot;rowHeaders&quot;&gt;&lt;ul class=&quot;act-headers&quot;&gt;&lt;li class=&quot;col-type move-row&quot;&gt;&lt;span class=&quot;material-icons&quot;&gt;open_with&lt;/span&gt;&lt;/li&gt;&lt;li class=&quot;col-type column-selected&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-1&quot; class=&quot;col-type moreoption col-type-1&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-2&quot; class=&quot;col-type moreoption col-type-2&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-3&quot; class=&quot;col-type moreoption col-type-3&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-4&quot; class=&quot;col-type moreoption col-type-4&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-5&quot; class=&quot;col-type moreoption col-type-5&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-6&quot; class=&quot;col-type moreoption col-type-6&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-7&quot; class=&quot;col-type moreoption col-type-7&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-8&quot; class=&quot;col-type moreoption col-type-8&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-9&quot; class=&quot;col-type moreoption col-type-9&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-10&quot; class=&quot;col-type moreoption col-type-10&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-11&quot; class=&quot;col-type moreoption col-type-11&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-12&quot; class=&quot;col-type moreoption col-type-12&quot;&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;row-action-header&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;row-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;span data-action=&quot;delete&quot; class=&quot;row-action material-icons&quot;&gt;close&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;ws-element-wrapper ws-dropable-items&quot;&gt;&lt;div id=&quot;ws-1623213655959_15&quot; class=&quot;ws-row-col ws-col-size-12 block ui-droppable ui-sortable&quot;&gt;&lt;div class=&quot;ws-col-header ui-sortable-handle&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;col-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;/div&gt;&lt;div id=&quot;ws_1623247156625&quot; class=&quot;paragraph-text ws-data-element ui-state-default ui-sortable-handle&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;&lt;/span&gt;&lt;span class=&quot;elm-action&quot;&gt;&lt;a class=&quot;wc_control-btn-move&quot; href=&quot;#&quot; title=&quot;Move Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;open_with&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-edit&quot; href=&quot;#&quot; title=&quot;Edit Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;edit&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-del&quot; href=&quot;#&quot; title=&quot;Remove Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;close&lt;/i&gt;&lt;/a&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '', '&lt;div class=&quot;rowData ui-sortable-handle container-fluid ws-row-data-1&quot; data-count=&quot;1&quot; data-type=&quot;row&quot;&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;row&quot;&gt;&lt;div id=&quot;ws-1623213655959_15&quot; class=&quot;col-lg-12 ws-1623213655959_15&quot;&gt;&lt;div id=&quot;ws_1623247156625&quot; class=&quot;ws_1623247156625&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '2021-06-07', 1, '2021-09-03', 1, 'active', 'blog', 'blog', 'blog', 'blog'),
(17, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '5', 'blogImage551.jpg', '', '&lt;div class=&quot;rowData ui-sortable-handle&quot; data-count=&quot;1&quot; data-type=&quot;row&quot; style=&quot;&quot;&gt;&lt;div class=&quot;rowHeaders&quot;&gt;&lt;ul class=&quot;act-headers&quot;&gt;&lt;li class=&quot;col-type move-row&quot;&gt;&lt;span class=&quot;material-icons&quot;&gt;open_with&lt;/span&gt;&lt;/li&gt;&lt;li class=&quot;col-type column-selected&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-1&quot; class=&quot;col-type moreoption col-type-1&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-2&quot; class=&quot;col-type moreoption col-type-2&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-3&quot; class=&quot;col-type moreoption col-type-3&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-4&quot; class=&quot;col-type moreoption col-type-4&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-5&quot; class=&quot;col-type moreoption col-type-5&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-6&quot; class=&quot;col-type moreoption col-type-6&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-7&quot; class=&quot;col-type moreoption col-type-7&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-8&quot; class=&quot;col-type moreoption col-type-8&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-9&quot; class=&quot;col-type moreoption col-type-9&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-10&quot; class=&quot;col-type moreoption col-type-10&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-11&quot; class=&quot;col-type moreoption col-type-11&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-12&quot; class=&quot;col-type moreoption col-type-12&quot;&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;row-action-header&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;row-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;span data-action=&quot;delete&quot; class=&quot;row-action material-icons&quot;&gt;close&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;ws-element-wrapper ws-dropable-items&quot;&gt;&lt;div id=&quot;ws-1623213255373_31&quot; class=&quot;ws-row-col ws-col-size-12 block ui-droppable ui-sortable&quot;&gt;&lt;div class=&quot;ws-col-header ui-sortable-handle&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;col-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;/div&gt;&lt;div id=&quot;ws_1623246597072&quot; class=&quot;paragraph-text ws-data-element ui-state-default ui-sortable-handle&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.&lt;/p&gt;&lt;/span&gt;&lt;span class=&quot;elm-action&quot;&gt;&lt;a class=&quot;wc_control-btn-move&quot; href=&quot;#&quot; title=&quot;Move Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;open_with&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-edit&quot; href=&quot;#&quot; title=&quot;Edit Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;edit&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-del&quot; href=&quot;#&quot; title=&quot;Remove Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;close&lt;/i&gt;&lt;/a&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '', '&lt;div class=&quot;rowData ui-sortable-handle container-fluid ws-row-data-1&quot; data-count=&quot;1&quot; data-type=&quot;row&quot; style=&quot;&quot;&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;row&quot;&gt;&lt;div id=&quot;ws-1623213255373_31&quot; class=&quot;col-lg-12 ws-1623213255373_31&quot;&gt;&lt;div id=&quot;ws_1623246597072&quot; class=&quot;ws_1623246597072&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.&lt;/p&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '2021-06-08', 1, '2021-09-03', 1, 'active', 'blog2', 'blog2', 'sdfsdf', 'sdfdsfs'),
(18, 'Why do we use it?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free fro', '6', 'blogImage68.jpg', '', '&lt;div class=&quot;rowData ui-sortable-handle&quot; data-count=&quot;1&quot; data-type=&quot;row&quot; style=&quot;&quot;&gt;&lt;div class=&quot;rowHeaders&quot;&gt;&lt;ul class=&quot;act-headers&quot;&gt;&lt;li class=&quot;col-type move-row&quot;&gt;&lt;span class=&quot;material-icons&quot;&gt;open_with&lt;/span&gt;&lt;/li&gt;&lt;li class=&quot;col-type column-selected&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-1&quot; class=&quot;col-type moreoption col-type-1&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-2&quot; class=&quot;col-type moreoption col-type-2&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-3&quot; class=&quot;col-type moreoption col-type-3&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-4&quot; class=&quot;col-type moreoption col-type-4&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-5&quot; class=&quot;col-type moreoption col-type-5&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-6&quot; class=&quot;col-type moreoption col-type-6&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-7&quot; class=&quot;col-type moreoption col-type-7&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-8&quot; class=&quot;col-type moreoption col-type-8&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-9&quot; class=&quot;col-type moreoption col-type-9&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-10&quot; class=&quot;col-type moreoption col-type-10&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-11&quot; class=&quot;col-type moreoption col-type-11&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-12&quot; class=&quot;col-type moreoption col-type-12&quot;&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;row-action-header&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;row-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;span data-action=&quot;delete&quot; class=&quot;row-action material-icons&quot;&gt;close&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;ws-element-wrapper ws-dropable-items&quot;&gt;&lt;div id=&quot;ws-1623213721030_92&quot; class=&quot;ws-row-col ws-col-size-12 block ui-droppable ui-sortable&quot;&gt;&lt;div class=&quot;ws-col-header ui-sortable-handle&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;col-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;/div&gt;&lt;div id=&quot;ws_1623246660709&quot; class=&quot;paragraph-text ws-data-element ui-state-default ui-sortable-handle&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot; style=&quot;position: relative; left: 0px; top: 0px;&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free fro&lt;/p&gt;&lt;/span&gt;&lt;span class=&quot;elm-action&quot;&gt;&lt;a class=&quot;wc_control-btn-move&quot; href=&quot;#&quot; title=&quot;Move Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;open_with&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-edit&quot; href=&quot;#&quot; title=&quot;Edit Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;edit&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-del&quot; href=&quot;#&quot; title=&quot;Remove Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;close&lt;/i&gt;&lt;/a&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '', '&lt;div class=&quot;rowData ui-sortable-handle container&quot; data-count=&quot;1&quot; data-type=&quot;row&quot; style=&quot;&quot;&gt;&lt;div id=&quot;ws-row-data-1&quot; class=&quot;ws-row-data-1 row&quot;&gt;&lt;div id=&quot;ws-1623213721030_92&quot; class=&quot;col-lg-12 ws-1623213721030_92&quot;&gt;&lt;div id=&quot;ws_1623246660709&quot; class=&quot;ws_1623246660709&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot; style=&quot;position: relative; left: 0px; top: 0px;&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;p&gt;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free fro&lt;/p&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '2021-06-08', 1, '2021-06-11', 1, 'active', 'blog3', 'blog3', '', ''),
(19, '', '', '', 'blogImage471.jpg', '', '', '', '', '2021-06-08', 1, '2021-06-08', 1, 'delete', '', '', '', ''),
(20, 'fdsdfsd', 'sdfsdfsdf', '7', 'blogImage371.jpg', '', '&lt;div class=&quot;rowData ui-sortable-handle&quot; data-count=&quot;8&quot; data-type=&quot;row&quot;&gt;&lt;div class=&quot;rowHeaders&quot;&gt;&lt;ul class=&quot;act-headers&quot;&gt;&lt;li class=&quot;col-type move-row&quot;&gt;&lt;span class=&quot;material-icons&quot;&gt;open_with&lt;/span&gt;&lt;/li&gt;&lt;li class=&quot;col-type column-selected&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-1&quot; class=&quot;col-type moreoption col-type-1&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-2&quot; class=&quot;col-type moreoption col-type-2&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-3&quot; class=&quot;col-type moreoption col-type-3&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-4&quot; class=&quot;col-type moreoption col-type-4&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-5&quot; class=&quot;col-type moreoption col-type-5&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-6&quot; class=&quot;col-type moreoption col-type-6&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-7&quot; class=&quot;col-type moreoption col-type-7&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-8&quot; class=&quot;col-type moreoption col-type-8&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-9&quot; class=&quot;col-type moreoption col-type-9&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-10&quot; class=&quot;col-type moreoption col-type-10&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-11&quot; class=&quot;col-type moreoption col-type-11&quot;&gt;&lt;/li&gt;&lt;li data-column=&quot;col-12&quot; class=&quot;col-type moreoption col-type-12&quot;&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;row-action-header&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;row-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;span data-action=&quot;delete&quot; class=&quot;row-action material-icons&quot;&gt;close&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;ws-row-data-8&quot; class=&quot;ws-element-wrapper ws-dropable-items&quot;&gt;&lt;div id=&quot;ws-1630653546518_68&quot; class=&quot;ws-row-col ws-col-size-12 block ui-droppable ui-sortable&quot;&gt;&lt;div class=&quot;ws-col-header&quot;&gt;&lt;span data-action=&quot;edit&quot; class=&quot;col-action material-icons&quot;&gt;edit&lt;/span&gt;&lt;/div&gt;&lt;div id=&quot;ws_1630653551302&quot; class=&quot;paragraph-text ws-data-element ui-state-default&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;strong&gt;What is Lorem Ipsum?&lt;/strong&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/span&gt;&lt;span class=&quot;elm-action&quot;&gt;&lt;a class=&quot;wc_control-btn-move&quot; href=&quot;#&quot; title=&quot;Move Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;open_with&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-edit&quot; href=&quot;#&quot; title=&quot;Edit Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;edit&lt;/i&gt;&lt;/a&gt;&lt;a class=&quot;wc_control-btn-del&quot; href=&quot;#&quot; title=&quot;Remove Block&quot;&gt;&lt;i class=&quot;material-icons&quot;&gt;close&lt;/i&gt;&lt;/a&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '', '&lt;div class=&quot;rowData ui-sortable-handle container-fluid ws-row-data-8&quot; data-count=&quot;8&quot; data-type=&quot;row&quot;&gt;&lt;div id=&quot;ws-row-data-8&quot; class=&quot;row&quot;&gt;&lt;div id=&quot;ws-1630653546518_68&quot; class=&quot;col-lg-12 ws-1630653546518_68&quot;&gt;&lt;div id=&quot;ws_1630653551302&quot; class=&quot;ws_1630653551302&quot; data-act=&quot;no-drag&quot; data-type=&quot;paragraph&quot;&gt;&lt;span class=&quot;p-txt&quot;&gt;&lt;strong&gt;What is Lorem Ipsum?&lt;/strong&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;', '2021-09-03', 1, '2021-09-03', 1, 'active', 'fdsdfs', 'sdfsdf', 'sdfsdf', 'sdfsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `ab_categorymaster`
--

CREATE TABLE `ab_categorymaster` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(55) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedDate` date NOT NULL,
  `status` enum('active','inactive','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_categorymaster`
--

INSERT INTO `ab_categorymaster` (`categoryID`, `categoryName`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `status`) VALUES
(5, 'web tech', 1, '2021-05-04', 1, '2021-05-04', 'active'),
(6, 'eletronics', 1, '2021-05-04', 0, '0000-00-00', 'active'),
(7, 'mobile', 1, '2021-05-04', 0, '0000-00-00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ab_contactus`
--

CREATE TABLE `ab_contactus` (
  `contactUsID` int(11) NOT NULL,
  `enquryType` varchar(20) NOT NULL,
  `fullName` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedDate` date NOT NULL,
  `status` enum('active','inactive','delete') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ab_contactus`
--

INSERT INTO `ab_contactus` (`contactUsID`, `enquryType`, `fullName`, `email`, `contactNo`, `message`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `status`) VALUES
(1, 'student', 'akshay', 'akshay@gmail.com', '7774956601', 'this is test message', 1, '2021-09-03', 1, '2021-09-03', 'active'),
(2, 'For Incubation', 'sdfdsf', 'sdfsdf@sdfsd.sdfsdf', '7774956601', 'sdfsdf', 0, '2021-09-03', 1, '2021-09-03', 'delete'),
(3, 'For Incubation', 'sdfdsf', 'sdfsdf@sdfsd.sdfsdf', '7774956601', 'sdfsdf', 0, '2021-09-03', 1, '2021-09-03', 'delete'),
(4, 'For Incubation', 'asdsad', 'asdas@asdas.asdsa', '7774956601', 'sadsadasd', 0, '2021-09-03', 1, '2021-09-03', 'delete'),
(5, 'For Incubation', 'asdsad', 'asdas@asdas.asdsa', '7774956601', 'sadsadasd', 0, '2021-09-03', 1, '2021-09-03', 'delete'),
(6, 'For Incubation', 'asdasd', 'asdas@asdas.asdsa', '7774956601', 'asdasd', 0, '2021-09-03', 1, '2021-09-03', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `ab_emailmaster`
--

CREATE TABLE `ab_emailmaster` (
  `tempID` int(11) NOT NULL,
  `tempUniqueID` varchar(20) NOT NULL,
  `tempName` varchar(255) NOT NULL,
  `subject` varchar(155) NOT NULL,
  `emailContent` text NOT NULL,
  `smsContent` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedDate` date NOT NULL,
  `status` enum('active','inactive','delete') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_emailmaster`
--

INSERT INTO `ab_emailmaster` (`tempID`, `tempUniqueID`, `tempName`, `subject`, `emailContent`, `smsContent`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `status`) VALUES
(1, 'temp_6971', 'FAQAnswerTemp', 'Answer Subject', '<p>{{question}} {{answer}} {{askedByName}}</p>', '{{question}} {{answer}} {{askedByName}}', 1, '2021-07-08', 1, '2021-07-26', 'delete'),
(2, 'temp_1850', 'forgotPasswordOTPSendTemp', 'Reset Your Password', '<p>Hello {{userName}},</p>\n\n<p>We have recevied request to reset password&nbsp;for the Ankur Pratishthan account associated with {{email}}. No Changes heve been made to your account yet, you can use bellow OTP to reset your account password.&nbsp;{{otp}}</p>', 'reset Password', 1, '2021-07-20', 1, '2021-07-21', 'active'),
(3, 'temp_6943', 'forgotPasswordLinkForUserTemp', 'Reset Password ForUser Temp', '<p>Hello {{userName}},</p>\n\n<p>We have recevied request to reset password&nbsp;for the Ankur Pratishthan account associated with {{email}}. No Changes heve been made to your account yet, you can use bellow OTP to reset your account password.&nbsp;{{resetPasswordLink}}</p>', 'user', 1, '2021-07-21', 1, '2021-07-26', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `ab_errorlogs`
--

CREATE TABLE `ab_errorlogs` (
  `errorID` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `heading` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `loginUser` varchar(50) NOT NULL,
  `lineNumber` varchar(50) NOT NULL,
  `function` varchar(250) NOT NULL,
  `deviceCall` varchar(250) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `errorTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ab_faqmaster`
--

CREATE TABLE `ab_faqmaster` (
  `faqID` int(11) NOT NULL,
  `faqQuestion` varchar(100) NOT NULL,
  `faqAnswer` text NOT NULL,
  `askedByName` varchar(100) NOT NULL,
  `askedByEmail` varchar(255) NOT NULL,
  `isPublish` tinyint(1) NOT NULL,
  `isEmailSend` tinyint(1) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedDate` date NOT NULL,
  `status` enum('active','inactive','delete') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_faqmaster`
--

INSERT INTO `ab_faqmaster` (`faqID`, `faqQuestion`, `faqAnswer`, `askedByName`, `askedByEmail`, `isPublish`, `isEmailSend`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`, `status`) VALUES
(1, 'Why Shoonyo?', '<p><strong>gfgdfdfdsdf</strong></p>', '', '', 0, 0, 1, '2021-05-11', 1, '2021-07-21', 'active'),
(6, 'what is shoonyo?', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', '', '', 1, 0, 1, '2021-05-11', 1, '2021-07-07', 'active'),
(23, 'what is shoonyo Forms?', '<p>43432</p>', 'akshay', 'rautakshay414@gmail.com', 1, 0, 0, '0000-00-00', 1, '2021-07-08', 'active'),
(24, 'what is shoonyo Forms', '', 'akshay', 'rautakshay414@gmail.com', 0, 0, 0, '0000-00-00', 0, '0000-00-00', 'active'),
(25, 'what is shoonyo Forms?', '', 'akshay', 'rautakshay414@gmail.com', 0, 0, 0, '0000-00-00', 0, '0000-00-00', 'active'),
(26, 'test', '<p>asdasd</p>', 'akshay', 'sdfsdf@sdfsd.sfsdf', 0, 0, 0, '2021-07-07', 1, '2021-09-03', 'delete'),
(27, 'sadasd1111111111111111111111', '<p>asdasdasdasdasdasdas</p>', '', '', 0, 0, 1, '2021-09-03', 0, '0000-00-00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ab_infosettings`
--

CREATE TABLE `ab_infosettings` (
  `infoID` int(11) NOT NULL,
  `companyName` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fromEmail` varchar(100) NOT NULL,
  `fromName` varchar(155) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_infosettings`
--

INSERT INTO `ab_infosettings` (`infoID`, `companyName`, `email`, `fromEmail`, `fromName`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
(1, 'bharat intelligent systems', 'rautakshay414@gmail.com', 'rautakshay414@gmail.com', 'bharat intelligent systems', 1, '2021-07-26 13:53:43', 1, '2021-07-26 08:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `ab_menumaster`
--

CREATE TABLE `ab_menumaster` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(45) NOT NULL,
  `menuLink` varchar(100) NOT NULL,
  `isParent` enum('yes','no') NOT NULL DEFAULT 'no',
  `isClick` enum('yes','no') NOT NULL DEFAULT 'no',
  `menuIndex` int(11) DEFAULT 999,
  `parentID` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive','delete') NOT NULL,
  `menuIcon` varchar(50) DEFAULT 'fa-bars'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_menumaster`
--

INSERT INTO `ab_menumaster` (`menuID`, `menuName`, `menuLink`, `isParent`, `isClick`, `menuIndex`, `parentID`, `createdBy`, `modifiedBy`, `createdDate`, `modifiedDate`, `status`, `menuIcon`) VALUES
(8, 'Master Data', 'master', 'yes', 'no', 5, 0, 2, 2, '2018-10-02 10:34:10', '2018-10-02 15:34:10', 'active', 'fa-bars'),
(20, 'User Master', 'usersList', 'no', 'yes', 8, 8, 2, 4, '2018-10-02 14:49:33', '2018-10-02 16:19:33', 'active', 'fa-bars'),
(21, 'User Role Master', 'roleList', 'no', 'yes', 9, 8, 2, 2, '2018-10-02 14:50:08', '2018-10-02 16:20:08', 'active', 'fa-bars'),
(28, 'Menu Master', 'menuList', 'no', 'yes', 10, 8, 2, 0, '2018-10-02 15:02:21', '2018-10-02 16:32:21', 'active', 'fa-bars'),
(29, 'Application Settings', 'infoDetails', 'yes', 'yes', 8, 0, 2, 2, '2018-10-03 08:18:10', '2018-10-03 13:18:10', 'active', 'fa-bars'),
(30, 'Access Control', 'access-control', 'yes', 'yes', 10, 0, 2, 0, '2018-10-03 14:28:36', '2018-10-03 19:28:36', 'active', 'fa-bars'),
(45, 'Email SMS Master', 'emailsmsmaster', 'no', 'yes', 999, 8, 1, 1, '2021-07-26 13:57:43', '2021-07-26 08:27:43', 'active', 'fa-bars'),
(46, 'Category Master', 'categoryMaster', 'no', 'yes', 999, 8, 1, 0, '2021-09-03 11:40:27', '2021-09-03 06:10:27', 'active', 'fa-bars'),
(47, 'Blogs', 'blogs', 'yes', 'yes', 999, 0, 1, 0, '2021-09-03 11:51:16', '2021-09-03 06:21:16', 'active', 'fa-bars'),
(48, 'FAQ Master', 'faqMaster', 'no', 'yes', 999, 8, 1, 0, '2021-09-03 13:29:02', '2021-09-03 07:59:02', 'active', 'fa-bars'),
(49, 'Contact Us', 'contactUs', 'yes', 'yes', 999, 0, 1, 0, '2021-09-03 16:03:59', '2021-09-03 10:33:59', 'active', 'fa-bars'),
(50, 'Media', 'readFiles', 'yes', 'yes', 999, 0, 1, 0, '2021-09-03 17:34:19', '2021-09-03 12:04:19', 'active', 'fa-bars');

-- --------------------------------------------------------

--
-- Table structure for table `ab_modelaccess`
--

CREATE TABLE `ab_modelaccess` (
  `accessID` int(11) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `accessList` text NOT NULL,
  `createdBy` varchar(45) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `modifiedDate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_modelaccess`
--

INSERT INTO `ab_modelaccess` (`accessID`, `roleID`, `accessList`, `createdBy`, `createdDate`, `modifiedBy`, `modifiedDate`) VALUES
(1, 1, '[{\"menuID\":\"30\",\"menuName\":\"Access Control\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"access-control\"},{\"menuID\":\"29\",\"menuName\":\"Application Settings\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"infoDetails\"},{\"menuID\":\"47\",\"menuName\":\"Blogs\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"blogs\"},{\"menuID\":\"46\",\"menuName\":\"Category Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"categoryMaster\"},{\"menuID\":\"49\",\"menuName\":\"Contact Us\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"contactUs\"},{\"menuID\":\"45\",\"menuName\":\"Email SMS Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"emailsmsmaster\"},{\"menuID\":\"48\",\"menuName\":\"FAQ Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"faqMaster\"},{\"menuID\":\"8\",\"menuName\":\"Master Data\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"master\"},{\"menuID\":\"50\",\"menuName\":\"Media\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"readFiles\"},{\"menuID\":\"28\",\"menuName\":\"Menu Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"menuList\"},{\"menuID\":\"20\",\"menuName\":\"User Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"usersList\"},{\"menuID\":\"21\",\"menuName\":\"User Role Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"roleList\"}]', '2', '2018-10-04 13:51:43', 1, 2021),
(2, 3, '[{\"menuID\":\"30\",\"menuName\":\"Access Control\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"access-control\"},{\"menuID\":\"29\",\"menuName\":\"Application Settings\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"infoDetails\"},{\"menuID\":\"8\",\"menuName\":\"Master Data\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"master\"},{\"menuID\":\"28\",\"menuName\":\"Menu Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"menuList\"},{\"menuID\":\"20\",\"menuName\":\"User Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"usersList\"},{\"menuID\":\"21\",\"menuName\":\"User Role Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"roleList\"}]', '6', '2018-10-12 17:04:22', 1, 2021),
(3, 6, '[{\"menuID\":\"1\",\"menuName\":\"Company Commercials\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"1\",\"menuLink\":\"commercialsList\"},{\"menuID\":\"2\",\"menuName\":\"Tax Invoice List\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"2\",\"menuLink\":\"taxInvoiceList\"},{\"menuID\":\"3\",\"menuName\":\"Credit Note List\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"3\",\"menuLink\":\"creditList\"},{\"menuID\":\"8\",\"menuName\":\"Master Data\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"master\"},{\"menuID\":\"9\",\"menuName\":\"Trainee Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"traineeList\"},{\"menuID\":\"10\",\"menuName\":\"Process Attendance\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"Process Attendance\"},{\"menuID\":\"11\",\"menuName\":\"Import Attendance Report\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"10\",\"menuLink\":\"import-employee\"},{\"menuID\":\"12\",\"menuName\":\"Pending Verification\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"10\",\"menuLink\":\"process-pending-data\"},{\"menuID\":\"13\",\"menuName\":\"Generate Company Bill\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"10\",\"menuLink\":\"create-bill\"},{\"menuID\":\"14\",\"menuName\":\"Company Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"companyList\"},{\"menuID\":\"15\",\"menuName\":\"Branch Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"branchList\"},{\"menuID\":\"16\",\"menuName\":\"State Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"stateList\"},{\"menuID\":\"17\",\"menuName\":\"Caste Category Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"casteCatList\"},{\"menuID\":\"18\",\"menuName\":\"Trainee Skill Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"traineeSkillList\"},{\"menuID\":\"19\",\"menuName\":\"Business Sector Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"businessList\"},{\"menuID\":\"20\",\"menuName\":\"Admin Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"usersList\"},{\"menuID\":\"21\",\"menuName\":\"User Role Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"roleList\"},{\"menuID\":\"22\",\"menuName\":\"Reports\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"reports\"},{\"menuID\":\"23\",\"menuName\":\"Payment Report\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"22\",\"menuLink\":\"paysheetReport\"},{\"menuID\":\"24\",\"menuName\":\"Payment Advice Report\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"22\",\"menuLink\":\"payAdviceReport\"},{\"menuID\":\"25\",\"menuName\":\"Account Masters\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"account masters\"},{\"menuID\":\"26\",\"menuName\":\"Account Group Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"25\",\"menuLink\":\"accGroupList\"},{\"menuID\":\"27\",\"menuName\":\"Ledger Name Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"25\",\"menuLink\":\"ledgerAccList\"},{\"menuID\":\"28\",\"menuName\":\"Menu Master\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"8\",\"menuLink\":\"menuList\"},{\"menuID\":\"29\",\"menuName\":\"Application Settings\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"infoDetails\"},{\"menuID\":\"30\",\"menuName\":\"Access Control\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"access-control\"},{\"menuID\":\"31\",\"menuName\":\"Processed Data\",\"add\":\"no\",\"edit\":\"no\",\"view\":\"no\",\"delete\":\"no\",\"parentID\":\"10\",\"menuLink\":\"summeryList\"},{\"menuID\":\"32\",\"menuName\":\"Training Schedule Details\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"33\",\"menuLink\":\"trainingSchList\"},{\"menuID\":\"33\",\"menuName\":\"Training Schedule\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"0\",\"menuLink\":\"trainingschedule\"},{\"menuID\":\"34\",\"menuName\":\"Training Calender Details\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"33\",\"menuLink\":\"calenderList\"},{\"menuID\":\"35\",\"menuName\":\"Training Record Details\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"33\",\"menuLink\":\"trainingRecList\"},{\"menuID\":\"36\",\"menuName\":\"Trainer Report Details\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"33\",\"menuLink\":\"trainerRptList\"},{\"menuID\":\"37\",\"menuName\":\"Assessment Details\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"33\",\"menuLink\":\"assessList\"},{\"menuID\":\"38\",\"menuName\":\"Training Records Report\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"22\",\"menuLink\":\"traningReport\"},{\"menuID\":\"39\",\"menuName\":\"Assessment Report\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"no\",\"parentID\":\"22\",\"menuLink\":\"assessmentReport\"}]', '2', '2019-01-10 14:22:46', 4, 2019),
(4, 2, '[{\"menuID\":\"30\",\"menuName\":\"Access Control\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"access-control\"},{\"menuID\":\"29\",\"menuName\":\"Application Settings\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"infoDetails\"},{\"menuID\":\"8\",\"menuName\":\"Master Data\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"0\",\"menuLink\":\"master\"},{\"menuID\":\"28\",\"menuName\":\"Menu Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"menuList\"},{\"menuID\":\"20\",\"menuName\":\"User Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"usersList\"},{\"menuID\":\"21\",\"menuName\":\"User Role Master\",\"add\":\"yes\",\"edit\":\"yes\",\"view\":\"yes\",\"delete\":\"yes\",\"parentID\":\"8\",\"menuLink\":\"roleList\"}]', '2', '2019-01-18 11:35:13', 1, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `ab_userrolemaster`
--

CREATE TABLE `ab_userrolemaster` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_userrolemaster`
--

INSERT INTO `ab_userrolemaster` (`roleID`, `roleName`, `createdBy`, `modifiedBy`, `createdDate`, `modifiedDate`, `status`) VALUES
(1, 'Super Admin', 2, 0, '2018-10-02 13:56:39', '2018-10-02 18:56:39', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ab_admin`
--
ALTER TABLE `ab_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `ab_adminsessions`
--
ALTER TABLE `ab_adminsessions`
  ADD PRIMARY KEY (`sessionID`);

--
-- Indexes for table `ab_blogs`
--
ALTER TABLE `ab_blogs`
  ADD PRIMARY KEY (`blogID`);

--
-- Indexes for table `ab_categorymaster`
--
ALTER TABLE `ab_categorymaster`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `ab_contactus`
--
ALTER TABLE `ab_contactus`
  ADD PRIMARY KEY (`contactUsID`);

--
-- Indexes for table `ab_emailmaster`
--
ALTER TABLE `ab_emailmaster`
  ADD PRIMARY KEY (`tempID`);

--
-- Indexes for table `ab_errorlogs`
--
ALTER TABLE `ab_errorlogs`
  ADD PRIMARY KEY (`errorID`);

--
-- Indexes for table `ab_faqmaster`
--
ALTER TABLE `ab_faqmaster`
  ADD PRIMARY KEY (`faqID`);

--
-- Indexes for table `ab_infosettings`
--
ALTER TABLE `ab_infosettings`
  ADD PRIMARY KEY (`infoID`);

--
-- Indexes for table `ab_menumaster`
--
ALTER TABLE `ab_menumaster`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `ab_modelaccess`
--
ALTER TABLE `ab_modelaccess`
  ADD PRIMARY KEY (`accessID`);

--
-- Indexes for table `ab_userrolemaster`
--
ALTER TABLE `ab_userrolemaster`
  ADD PRIMARY KEY (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ab_admin`
--
ALTER TABLE `ab_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Admin index ID', AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `ab_adminsessions`
--
ALTER TABLE `ab_adminsessions`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `ab_blogs`
--
ALTER TABLE `ab_blogs`
  MODIFY `blogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ab_categorymaster`
--
ALTER TABLE `ab_categorymaster`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ab_contactus`
--
ALTER TABLE `ab_contactus`
  MODIFY `contactUsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ab_emailmaster`
--
ALTER TABLE `ab_emailmaster`
  MODIFY `tempID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ab_errorlogs`
--
ALTER TABLE `ab_errorlogs`
  MODIFY `errorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ab_faqmaster`
--
ALTER TABLE `ab_faqmaster`
  MODIFY `faqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ab_infosettings`
--
ALTER TABLE `ab_infosettings`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ab_menumaster`
--
ALTER TABLE `ab_menumaster`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `ab_modelaccess`
--
ALTER TABLE `ab_modelaccess`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ab_userrolemaster`
--
ALTER TABLE `ab_userrolemaster`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
