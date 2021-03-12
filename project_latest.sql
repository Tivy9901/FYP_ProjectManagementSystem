-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 03:11 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatmember`
--

CREATE TABLE `chatmember` (
  `chatmember_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chatroom_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatmember`
--

INSERT INTO `chatmember` (`chatmember_id`, `user_id`, `chatroom_id`) VALUES
(1, 1, 1),
(3, 3, 1),
(4, 4, 1),
(5, 17, 2),
(6, 1, 2),
(7, 4, 2),
(8, 13, 2),
(9, 16, 2),
(10, 1, 3),
(11, 4, 3),
(12, 13, 3),
(13, 17, 4),
(14, 18, 4),
(15, 13, 4),
(16, 10, 4),
(17, 20, 4),
(18, 17, 5),
(19, 13, 5),
(20, 18, 5),
(21, 10, 5),
(22, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `chatmessage`
--

CREATE TABLE `chatmessage` (
  `chatmessage_id` int(11) NOT NULL,
  `chatmessage` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chatroom_id` int(11) DEFAULT NULL,
  `chatmessage_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatmessage`
--

INSERT INTO `chatmessage` (`chatmessage_id`, `chatmessage`, `user_id`, `chatroom_id`, `chatmessage_date_created`) VALUES
(1, 'hello', 4, 1, '2021-01-13 16:20:08'),
(2, 'IronMan', 4, 1, '2021-01-13 16:20:16'),
(3, 'Hi Everyone!', 17, 2, '2021-01-13 20:23:19'),
(4, 'My name is Jeffrey', 17, 2, '2021-01-13 20:23:33'),
(5, 'Hi', 1, 2, '2021-01-13 20:56:36'),
(6, 'Im John', 1, 2, '2021-01-13 20:56:48'),
(7, 'Im from Diploma in Chinese Studies', 1, 2, '2021-01-13 20:57:11'),
(8, 'testing testing', 1, 2, '2021-01-13 21:00:55'),
(9, 'Hello Everyone', 17, 4, '2021-01-13 21:07:04'),
(10, 'Welcome!', 17, 4, '2021-01-13 21:07:10'),
(11, 'Feel Free to Chat', 17, 4, '2021-01-13 21:07:18'),
(12, 'Hi', 20, 4, '2021-01-13 21:09:49'),
(13, 'Carmen Here!', 20, 4, '2021-01-13 21:09:58'),
(14, 'How Are You?', 20, 4, '2021-01-13 21:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `chatroom_id` int(11) NOT NULL,
  `chatroom_name` varchar(255) NOT NULL,
  `chatroom_password` varchar(100) DEFAULT NULL,
  `chatroom_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`chatroom_id`, `chatroom_name`, `chatroom_password`, `chatroom_date_created`, `user_id`, `team_id`) VALUES
(1, 'Marvel 2021', '888', '2021-01-13 16:19:33', 1, 1),
(2, 'Ice Breaking', '000', '2021-01-13 20:22:33', 17, 9),
(3, 'Tutorial Question 1 Discussion', '', '2021-01-13 20:58:02', 1, 9),
(4, 'Ice Breaking', '', '2021-01-13 21:06:41', 17, 14),
(5, 'Emergency Discussion Room', '', '2021-01-13 21:07:33', 17, 14);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `start_event`, `end_event`, `project_id`) VALUES
(2, 'Tutorial Question 1a Submission', '2021-01-14 00:00:00', '2021-01-15 00:00:00', 7),
(3, 'Tutorial Question 1b Submission', '2021-01-15 00:00:00', '2021-01-16 00:00:00', 7),
(4, 'Final Test of Introduction of Mass Communication', '2021-01-23 00:00:00', '2021-01-24 00:00:00', 7),
(5, 'COA', '2021-01-25 00:00:00', '2021-01-26 00:00:00', 7),
(6, 'Networking', '2021-01-25 00:00:00', '2021-01-26 00:00:00', 7),
(8, 'OOP', '2021-01-28 00:00:00', '2021-01-29 00:00:00', 7),
(9, 'small test', '2021-01-15 00:00:00', '2021-01-16 00:00:00', 11),
(10, 'midterm', '2021-01-27 00:00:00', '2021-01-28 00:00:00', 11),
(11, 'project submission', '2021-02-06 00:00:00', '2021-02-07 00:00:00', 11),
(12, 'test', '2020-12-29 00:00:00', '2020-12-30 00:00:00', 12),
(13, 'assignment discussion', '2021-01-13 00:00:00', '2021-01-14 00:00:00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `folder_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `file_upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `file_name`, `file_type`, `file_path`, `folder_id`, `user_id`, `project_id`, `file_upload_date`) VALUES
(1, '6', 'jpg', '1610528220_6.jpg', 0, 1, 1, '2021-01-13 08:57:02'),
(2, '02', 'pdf', '1610528220_02.pdf', 0, 1, 1, '2021-01-13 08:57:25'),
(3, 'FiveLayer', 'png', '1610528340_FiveLayer.png', 2, 1, 1, '2021-01-13 08:59:29'),
(4, 'Revison2021', 'pdf', '1610542200_Revison2021.pdf', 0, 17, 7, '2021-01-13 12:50:37'),
(5, 'Assignment_Question1_D190040A_IvyTeeYeeWei', 'docx', '1610542260_Assignment_Question1_D190040A_IvyTeeYeeWei.docx', 4, 17, 7, '2021-01-13 12:51:15'),
(6, 'oop_individual', 'png', '1610543040_oop_individual.png', 0, 17, 7, '2021-01-13 13:04:11'),
(7, '01', 'pdf', '1610543700_01.pdf', 7, 20, 11, '2021-01-13 13:15:50'),
(8, '02', 'pdf', '1610543760_02.pdf', 8, 20, 11, '2021-01-13 13:16:07'),
(9, '03', 'pdf', '1610543760_03.pdf', 9, 20, 11, '2021-01-13 13:16:19'),
(10, 'Tutorial', 'pdf', '1610544300_Tutorial.pdf', 0, 17, 12, '2021-01-13 13:25:29'),
(11, 'fragmentation_csis2033', 'png', '1610544300_fragmentation_csis2033.png', 0, 17, 12, '2021-01-13 13:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `folder_id` int(11) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`folder_id`, `folder_name`, `user_id`, `project_id`, `parent_id`) VALUES
(1, 'MPU 2223', 1, 1, 0),
(2, 'CSIS 2033', 1, 1, 0),
(3, 'Marvel', 1, 1, 2),
(4, 'Tutorial Question 1', 17, 7, 0),
(5, 'Tutorial Question 2', 17, 7, 0),
(6, 'Test 1', 17, 7, 0),
(7, 'Chapter 1', 20, 11, 0),
(8, 'Chapter 2', 20, 11, 0),
(9, 'Chapter 3', 20, 11, 0),
(10, 'Chapter 1', 17, 12, 0),
(11, 'Chapter 2', 17, 12, 0),
(12, 'Assignment 1', 17, 12, 0),
(13, 'Assignment 2', 17, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg_board`
--

CREATE TABLE `msg_board` (
  `msg_id` int(11) NOT NULL,
  `msg_title` varchar(255) NOT NULL,
  `msg_description` varchar(255) NOT NULL,
  `msg_createdTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msg_board`
--

INSERT INTO `msg_board` (`msg_id`, `msg_title`, `msg_description`, `msg_createdTime`, `user_id`, `project_id`) VALUES
(1, 'Life 20', 'Capture Video 20 minutes', '2021-01-13 01:01:16.000000', 1, 1),
(3, 'Tutorial Question 1', 'Registration Subject Programme', '2021-01-13 05:01:44.000000', 17, 7),
(4, 'Maths Problem ', 'Someone Help Me Pls.', '2021-01-13 06:01:33.000000', 17, 11),
(5, 'Lets go for a picnic!', 'Hope that no rain again T_T', '2021-01-13 06:01:02.000000', 20, 11),
(6, 'What is HCI?', 'All about HCI here!', '2021-01-13 06:01:00.000000', 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `msg_comment`
--

CREATE TABLE `msg_comment` (
  `comment_id` int(11) NOT NULL,
  `comment_description` varchar(255) NOT NULL,
  `comment_createdTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `msg_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msg_comment`
--

INSERT INTO `msg_comment` (`comment_id`, `comment_description`, `comment_createdTime`, `user_id`, `msg_id`) VALUES
(1, 'Topic?', '2021-01-13 01:01:40', 1, 1),
(2, 'Share your solution here!', '2021-01-13 05:01:16', 17, 3),
(3, 'Ask any question if you face problem.', '2021-01-13 05:01:30', 17, 3),
(4, 'How can I imporve my Maths?', '2021-01-13 06:01:47', 17, 4),
(5, 'Do more math exercise', '2021-01-13 06:01:21', 20, 4),
(6, 'Feel Free to ask question when you need help', '2021-01-13 06:01:39', 20, 4),
(7, 'Human Computer Interaction', '2021-01-13 06:01:27', 17, 6),
(8, 'Prototype', '2021-01-13 06:01:42', 17, 6),
(9, 'User Manual', '2021-01-13 06:01:51', 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_description` varchar(255) DEFAULT NULL,
  `project_disable` int(2) NOT NULL DEFAULT 0,
  `user_id` int(10) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `project_description`, `project_disable`, `user_id`, `team_id`) VALUES
(1, 'MPU 2223', 'Introduction To Mass Communication', 0, 3, 1),
(2, 'CSIS 2083', '(COA) Computer Organization Architecture', 0, 1, 2),
(3, 'Freshman Webiniar', 'Life 20', 0, 3, 4),
(4, 'MPU 2003', 'Pengajian Malaysia', 0, 3, 5),
(5, 'CSIS 2033', 'Networking', 0, 3, 6),
(6, 'CSIS 3003', 'Project I', 0, 11, 7),
(7, 'PROG 2013', 'Object-Oriented Programming', 0, 17, 9),
(8, 'CSIS 2063', 'Project Management ', 0, 11, 12),
(9, 'CSIS 2073', 'Web Based System', 0, 17, 16),
(10, 'CSIS 3013 ', 'System Security and Control ', 0, 9, 13),
(11, 'PROG 2103', 'Data Structure and Algorithm', 0, 18, 14),
(12, 'PROG 2203', 'Human Computer Interaction', 0, 18, 10);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `task_description` varchar(255) DEFAULT '-',
  `tasklist_id` int(11) DEFAULT NULL,
  `task_priority` varchar(10) DEFAULT 'Low',
  `task_deadline` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_completed` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_description`, `tasklist_id`, `task_priority`, `task_deadline`, `user_id`, `task_completed`) VALUES
(1, 'Find a celebrity', 'Famous Celebrity - Lee Chong Wei', 1, 'High', '2021-01-14', 1, 1),
(3, 'Student Class', 'Check the question and write the code', 4, 'High', '2021-01-14', 17, 1),
(4, 'Subject Class', 'Check question file and answer the question as soon as possible', 4, 'High', '2021-01-15', 17, 1),
(5, 'Create Cats and Dogs Class', 'Based on the question given', 5, 'High', '2021-01-31', 17, 1),
(6, 'Use petlist object to create an arrayList to provide solution', 'ask if you facing any problem', 5, 'Medium', '2021-02-07', 17, 1),
(7, 'Problem Facing in Daily Life', 'Brainstorm to get more answaer!', 6, 'High', '2021-01-15', 17, 1),
(8, 'List Out all of the way to solve your problem', 'discuss', 7, 'Medium', '2021-01-17', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_assign`
--

CREATE TABLE `task_assign` (
  `taskassign_id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_assign`
--

INSERT INTO `task_assign` (`taskassign_id`, `task_id`, `user_id`) VALUES
(1, 1, 4),
(4, 1, 3),
(5, 1, 1),
(6, 3, 1),
(7, 4, 4),
(8, 4, 16),
(9, 5, 16),
(10, 7, 1),
(11, 7, 3),
(12, 7, 12),
(13, 7, 10),
(14, 7, 17);

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `tasklist_id` int(11) NOT NULL,
  `tasklist_name` varchar(100) NOT NULL,
  `tasklist_description` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`tasklist_id`, `tasklist_name`, `tasklist_description`, `user_id`, `project_id`) VALUES
(1, 'Small Group Project', '5 persons each group', 1, 1),
(2, 'Big Group Project', '50 %, 10 person each group', 1, 1),
(4, 'Tutorial Question 1', 'Student Registration Programme', 17, 7),
(5, 'Tutorial Question 2', 'Pets, Cats and Dogs', 17, 7),
(6, 'Assignment 1', 'Identify Problem', 17, 12),
(7, 'Assignment 2', 'Ways to Solve Problem', 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_description` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_notice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_description`, `user_id`, `team_notice`) VALUES
(1, 'Team Ace', 'Talent wins games', 3, NULL),
(5, 'Champions', 'None of us is as smart as all of us.', 4, NULL),
(6, 'Amigos', 'Alone we can do so little, together we can do so much', 12, NULL),
(7, 'Dominators', 'It takes two flints to make a fire', 20, NULL),
(8, 'Elite', 'The best teamwork comes from men who are working independently toward one goal in unison', 16, NULL),
(9, 'Heatwave', 'Bad attitudes will ruin your team', 17, NULL),
(10, 'Ninjas', 'None of us, including me, ever do great things. But we can all do small things, with great love, and together we can do something wonderful', 3, NULL),
(11, 'Shakedown', 'If you want to lift yourself up, lift up someone else', 10, NULL),
(12, 'Power', 'No one can whistle a symphony. It takes a whole orchestra to play it', 4, NULL),
(13, 'Titans', 'Effectively, change is almost impossible without industry-wide collaboration, cooperation, and consensus.', 18, NULL),
(14, 'Empire', 'Teamwork makes the dream work', 13, NULL),
(15, 'Kingsmen', 'A leader must inspire or his team will expire', 1, NULL),
(16, 'Riot', 'Together, ordinary people can achieve extraordinary results.', 19, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_list`
--

CREATE TABLE `team_list` (
  `teamlist_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_list`
--

INSERT INTO `team_list` (`teamlist_id`, `team_id`, `user_id`) VALUES
(5, 1, 4),
(7, 1, 3),
(15, 6, 12),
(16, 7, 20),
(17, 8, 16),
(18, 9, 17),
(19, 10, 3),
(20, 11, 10),
(21, 12, 4),
(22, 13, 18),
(23, 14, 13),
(24, 15, 1),
(25, 16, 19),
(26, 6, 14),
(27, 6, 10),
(28, 5, 4),
(29, 5, 11),
(30, 5, 9),
(31, 5, 3),
(32, 7, 13),
(33, 7, 14),
(34, 7, 16),
(35, 8, 9),
(36, 8, 12),
(37, 14, 18),
(38, 14, 10),
(39, 14, 20),
(40, 9, 1),
(41, 9, 4),
(42, 9, 13),
(43, 9, 16),
(44, 15, 9),
(45, 10, 1),
(46, 10, 12),
(47, 10, 10),
(48, 12, 14),
(49, 16, 10),
(51, 11, 1),
(52, 11, 3),
(53, 11, 4),
(56, 13, 9),
(57, 14, 17),
(58, 10, 17),
(59, 11, 17),
(60, 15, 12),
(61, 15, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phoneNumber` int(15) NOT NULL,
  `user_profileImage` varchar(255) NOT NULL DEFAULT '1.png',
  `user_type` int(2) NOT NULL,
  `user_disable` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_username`, `user_password`, `user_email`, `user_phoneNumber`, `user_profileImage`, `user_type`, `user_disable`) VALUES
(1, 'John', 'John01', '24b0247f1b9fa421e48035d3a96e1f1e', 'John@gmail.com', 127028772, '1610542620_8.jpg', 1, 0),
(2, 'Admin', 'Admin001', '55772918a13bc70691fca45668c4e353', 'Admin001@gmail.com', 73547612, '1.png', 2, 0),
(3, 'Mary', 'Mary02', '401907d68da0e9a305a0a4eadc55b692', 'Mary@hotmail.com', 1178945201, '1.png', 1, 0),
(4, 'KelvinTan', 'Kelvin03', '0577c2282896e9b5dc5e29171ef4a6d5', 'KelvinTan03@hotmail.com', 1356249852, '1610526060_10.jpeg', 1, 0),
(5, 'AdminMay', 'Admin002', '09068795b03102a1688425253514f63f', 'AdminMay@gmail.com', 135641789, '1.png', 2, 0),
(6, 'AdminJohnny', 'Admin003', '491a7ae532f8c8e4b8811e77a80bb6ee', 'AdminJohnny@gmail.com', 197896543, '1.png', 2, 0),
(7, 'AdminKathy', 'Admin004', 'd25ec4342bf8c02c3220c1fbee64d36a', 'Kathy69@gmail.com', 1129874563, '1.png', 2, 0),
(8, 'AdminJin', 'Admin005', '81d22c8a70772bffd71680996d3f64e3', 'Jinn96@gmail.com', 198764563, '1.png', 2, 0),
(9, 'Catherine', 'Catherine05', '9573e229dbef2a6b58452df04f4b13c9', 'Catherine99@gmail.com', 112233596, '1.png', 1, 0),
(10, 'Benny', 'Benny07', '5bee606b7f51ae06cbe9c3c8d6b305b9', 'Benny67@gmail.com', 111314520, '1.png', 1, 0),
(11, 'Ken', 'Ken09', 'ac7c80f71e173f664d7738bae1400592', 'Ken9901@gmail.com', 112345789, '1.png', 1, 0),
(12, 'Ben', 'Ben010', '3dff41c5af53f6e24909a5fdb109a2ff', 'Ben010@gmail.com', 1152349876, '1.png', 1, 0),
(13, 'Charles', 'Charles011', 'a200dfec48dafc91f567a0994a03370c', 'Charles011@gmail.com', 1123457896, '1.png', 1, 0),
(14, 'Berry', 'Berry012', 'e113120498e2e41167f0d4999c86515d', 'Berry012@gmail.com', 124567891, '1.png', 1, 0),
(15, 'AdminKenny', 'Admin006', '5f1f5b57155472be38f3ca8f47137ff7', 'AdminKenny897@gmail.com', 124563789, '1.png', 2, 0),
(16, 'Charlie', 'Charlie013', '7fa24facd4bbd109e4a496f45658c5a5', 'Charlie909@gmail.com', 112345698, '1.png', 1, 0),
(17, 'Jeffrey', 'Jeffrey014', '8be7b1404f7d595f86b2157fb1edb6e9', 'JeffreyGoh@gmail.com', 1123457896, '1610540580_5.jpg', 1, 0),
(18, 'Jenny', 'Jenny015', 'b207c87843b84868b28ae44cbc02625c', 'JennyWong@gmail.com', 1123456987, '1.png', 1, 0),
(19, 'Sharon', 'Sharon016', '2b4d98ca0c0ba2ccdb2e95ab37ae13b8', 'SharonWong@gmail.com', 114567891, '1.png', 1, 0),
(20, 'Carmen', 'Carmen017', '2206c4f16a1fe5d1053472276b62eb3b', 'CarmenTey@gmail.com', 1124567893, '1610543400_7.jpg', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatmember`
--
ALTER TABLE `chatmember`
  ADD PRIMARY KEY (`chatmember_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chatroom_id` (`chatroom_id`);

--
-- Indexes for table `chatmessage`
--
ALTER TABLE `chatmessage`
  ADD PRIMARY KEY (`chatmessage_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chatroom_id` (`chatroom_id`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`chatroom_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`folder_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `msg_board`
--
ALTER TABLE `msg_board`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `msg_comment`
--
ALTER TABLE `msg_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `msg_id` (`msg_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `project_creator_id` (`user_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tasklist_id` (`tasklist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task_assign`
--
ALTER TABLE `task_assign`
  ADD PRIMARY KEY (`taskassign_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`tasklist_id`),
  ADD KEY `tasklist_creator` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `team_creator_id` (`user_id`);

--
-- Indexes for table `team_list`
--
ALTER TABLE `team_list`
  ADD PRIMARY KEY (`teamlist_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatmember`
--
ALTER TABLE `chatmember`
  MODIFY `chatmember_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chatmessage`
--
ALTER TABLE `chatmessage`
  MODIFY `chatmessage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `chatroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `msg_board`
--
ALTER TABLE `msg_board`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `msg_comment`
--
ALTER TABLE `msg_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task_assign`
--
ALTER TABLE `task_assign`
  MODIFY `taskassign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `tasklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `teamlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatmessage`
--
ALTER TABLE `chatmessage`
  ADD CONSTRAINT `chatmessage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `chatmessage_ibfk_2` FOREIGN KEY (`chatroom_id`) REFERENCES `chatroom` (`chatroom_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
