-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 06:58 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue`
--

-- --------------------------------------------------------

--
-- Table structure for table `centerpoint`
--

CREATE TABLE `centerpoint` (
  `id` int(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cgroup`
--

CREATE TABLE `cgroup` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `gname` varchar(10) NOT NULL,
  `cname` varchar(10) NOT NULL,
  `cnumber` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cgroup`
--

INSERT INTO `cgroup` (`id`, `uid`, `gname`, `cname`, `cnumber`) VALUES
(47, 9, 'college', 'Thiru', '98405 12532'),
(46, 9, 'college', 'Ramkee', '93611 00931'),
(45, 9, 'college', 'Maran', '99528 82510'),
(44, 9, 'friends', 'Wasim', '6369 817 166'),
(43, 9, 'friends', 'Mani', '96008 36579'),
(42, 9, 'friends', 'Thiru', '98405 12532'),
(41, 9, 'friends', 'Maran', '99528 82510'),
(40, 9, 'friends', 'Ramkee', '93611 00931'),
(39, 9, 'office', 'Maran', '99528 82510'),
(38, 9, 'office', 'Ramkee', '93611 00931'),
(37, 9, 'home', 'Mani', '96008 36579'),
(36, 9, 'home', 'Maran', '99528 82510'),
(35, 4, 'office', 'Thiru', '9840512532'),
(34, 4, 'office', 'Wasim', '6369 817 166'),
(33, 4, 'office', 'Mani', '96008 36579'),
(32, 4, 'office', 'Ramkee', '93611 00931'),
(31, 4, 'office', 'Maran', '99528 82510');

-- --------------------------------------------------------

--
-- Table structure for table `latlon`
--

CREATE TABLE `latlon` (
  `id` int(20) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lon` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `uphone` varchar(20) NOT NULL,
  `area` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latlon`
--

INSERT INTO `latlon` (`id`, `lat`, `lon`, `phone`, `uphone`, `area`) VALUES
(1, '13.0373', '80.2123', '9840512532', '1322123432', 'dfsdfsf');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `lng` varchar(15) NOT NULL,
  `eventname` varchar(15) NOT NULL,
  `hostname` varchar(15) NOT NULL,
  `sdate` varchar(15) NOT NULL,
  `stime` varchar(15) NOT NULL,
  `etime` varchar(15) NOT NULL,
  `offer` varchar(15) NOT NULL,
  `category` varchar(15) NOT NULL,
  `placetype` varchar(50) NOT NULL,
  `fees` varchar(15) NOT NULL,
  `eventimage` varchar(15) NOT NULL,
  `description` varchar(15) NOT NULL,
  `environment` varchar(50) NOT NULL,
  `suitablefor` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `lat`, `lng`, `eventname`, `hostname`, `sdate`, `stime`, `etime`, `offer`, `category`, `placetype`, `fees`, `eventimage`, `description`, `environment`, `suitablefor`, `session`) VALUES
(14, 'Hotel Pasi.Com', '13.0263076', '80.206379800000', 'hzhzhzhzhsh', 'hshdhdhdhdhdhdh', '20/September/20', '4:16', '4:16', 'bshshshshhs', 'Business Dinner', 'shopping_mall', '69', 'sasda', 'dfsdfs', 'asdsdgs', 'dasdasd', 'ssdasds'),
(15, 'Tibbs Frankie', '13.0353442', '80.2106033', 'vsvsv', 'vsvsgs', '20/September/20', '12:20', '12:20', 'vsvsvs', 'Meetings', 'android.widget.', '9686', 'vsvsv', '96', 'sdasd', 'sdasd', 'sadasd'),
(16, 'Paprikas Restau', '13.030321', '80.208297', 'svvsvs', 'svvsvs', '20/September/20', '8:54', '8:54', 'gsgsgsgs', 'Meetings', 'restaurant', '9686', 'svvsvs', '36', 'asdsd', 'sdasd', 'sdadasdaddasda'),
(17, 'Aasife Biriyani', '13.0339305', '80.211989', 'gsgssg', 'sbgsgd', '20/September/20', '12:56', '12:56', 'vsvdvs', 'Meetings', 'restaurant', '96', 'gsgssg', '69', 'Noisy', 'Activity Group', 'After Noon'),
(18, 'Mattas', '13.0372442', '80.213263', 'vzvzbzbz', 'bxnxdn', '20/September/20', '16:13', '16:13', '20', 'Birthdays', 'restaurant', '90', 'vzvzbzbz', '90', 'Noisy', 'Activity Group', 'After Noon'),
(19, 'zvvsvs', '13.102020931614', '80.284032784402', 'svvsvs', 'vzbsbsbs', '23/September/20', '17:7', '17:7', 'vzvzvzhs', 'Business Dinner', 'restaurant', '89', 'svvsvs', 'svvsvssvsvsvsvs', 'Musical', 'Activity Group', 'After Noon'),
(20, 'vwwggw', '13.084652526144', '80.282162614166', 'vwgwgw', 'vwvwvwvw', '23/September/20', '5:16', '5:16', 'vdvdvdvd', 'Business Dinner', 'night_club', '888556', 'vwgwgw', 'bBBbBbbzbzbzhzh', 'Pleasant', 'Activity Group', 'Evening'),
(21, 'gegs', '13.034522670653', '80.209937095642', 'gsgsg', 'gegsgd', '23/September/20', '6:25', '14:13', 'gegege', 'Team Building E', 'shopping_mall', '69', 'gsgsg', 'gsvdvdvdvdvdbbd', 'Noisy', 'Activity Group', 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `phone`, `image`) VALUES
(4, 'sp', 'sp@gmail.com', '1952a01898073d1e561b9b4f2e42cbd7', 'Male', '9840512532', 'thug@gmail.com'),
(3, 'thiru', 'thiru@gmail.com', '6206be0a5bf1cdcf07821bb35090505c', 'Male', '9840512532', ''),
(5, 'ts', 'ts@gmail.com', '4d682ec4eed27c53849758bc13b6e179', 'Male', '9689698569', 'ts@gmail.com'),
(6, 'ta', 'ta@gmail.com', 'fec8f2a3f2e808ccb17c4d278b4fa469', 'Male', '9689698569', 'ta@gmail.com'),
(7, 'vijay', 'vijay@gmail.com', '4f9fecabbd77fba02d2497f880f44e6f', 'Male', '9856985632', 'vijay@gmail.com'),
(8, 'gat', 'gat@gmail.com', 'ba3549d034e186e45d4ce000487741df', 'Male', '6936963656', 'gat@gmail.com'),
(9, 'thug', 'thug@gmail.com', '80e40b9397aeffd8154f9842bbce89a3', 'Male', '9840512532', 'thug@gmail.com'),
(10, 'maran', 'maran@gmail.com', '8771b6ec07a7fcf14036cfe1b11e97c7', 'Male', '9689689689', 'maran@gmail.com'),
(11, 'android', 'android@gmail.com', '6402a3f715f6410a3a0edbb2301c4315', 'Male', '9696989869', 'android@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centerpoint`
--
ALTER TABLE `centerpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cgroup`
--
ALTER TABLE `cgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latlon`
--
ALTER TABLE `latlon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centerpoint`
--
ALTER TABLE `centerpoint`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cgroup`
--
ALTER TABLE `cgroup`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `latlon`
--
ALTER TABLE `latlon`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
