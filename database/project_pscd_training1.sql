-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2017 at 09:14 PM
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
-- Database: `project_pscd_training1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avata` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avata`, `firstname`, `lastname`, `phone`, `address`, `role`, `status`, `created`, `updated`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin-160x160.jpg', 'modi', 'admin', '0987654321', '171 Tran Quy Khoach - Da Nang', 1, 2, '2017-09-16 11:34:12', '2017-09-16 11:34:12'),
(2, 'user1', 'user1@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user1-128x128.jpg', 'modi1', 'user', '0987654322', '172 Tran Quy Khoach - Da Nang', 2, 2, '2017-09-16 11:36:19', '2017-09-16 11:37:11'),
(3, 'JrTinh', 'pvtinh1996@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:33:32', '2017-09-19 15:33:32'),
(4, 'JrTinh0', 'pvtinh19960@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh0', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(5, 'JrTinh2', 'pvtinh19962@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh2', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(6, 'JrTinh3', 'pvtinh19963@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh3', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(7, 'JrTinh1', 'pvtinh19961@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh1', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(8, 'JrTinh5', 'pvtinh19965@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh5', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(9, 'JrTinh4', 'pvtinh19964@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh4', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(10, 'JrTinh6', 'pvtinh19966@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh6', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(11, 'JrTinh7', 'pvtinh19967@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh7', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(12, 'JrTinh8', 'pvtinh19968@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh8', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(13, 'JrTinh9', 'pvtinh19969@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh9', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(14, 'JrTinh10', 'pvtinh199610@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh10', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(15, 'JrTinh11', 'pvtinh199611@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh11', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(16, 'JrTinh12', 'pvtinh199612@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh12', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(17, 'JrTinh13', 'pvtinh199613@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh13', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(18, 'JrTinh14', 'pvtinh199614@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh14', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(19, 'JrTinh15', 'pvtinh199615@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh15', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(20, 'JrTinh16', 'pvtinh199616@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh16', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(21, 'JrTinh17', 'pvtinh199617@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh17', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(22, 'JrTinh18', 'pvtinh199618@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh18', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(23, 'JrTinh19', 'pvtinh199619@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh19', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(24, 'JrTinh20', 'pvtinh199620@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh20', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(26, 'JrTinh22', 'pvtinh199622@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh22', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(27, 'JrTinh23', 'pvtinh199623@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh23', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(28, 'JrTinh24', 'pvtinh199624@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh24', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(29, 'JrTinh25', 'pvtinh199625@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh25', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(30, 'JrTinh26', 'pvtinh199626@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh26', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(31, 'JrTinh27', 'pvtinh199627@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh27', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(32, 'JrTinh28', 'pvtinh199628@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh28', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(33, 'JrTinh29', 'pvtinh199629@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh29', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(34, 'JrTinh30', 'pvtinh199630@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh30', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(35, 'JrTinh31', 'pvtinh199631@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh31', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(36, 'JrTinh32', 'pvtinh199632@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh32', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(37, 'JrTinh33', 'pvtinh199633@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh33', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(38, 'JrTinh34', 'pvtinh199634@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh34', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(39, 'JrTinh35', 'pvtinh199635@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh35', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(40, 'JrTinh36', 'pvtinh199636@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh36', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(41, 'JrTinh37', 'pvtinh199637@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh37', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(42, 'JrTinh38', 'pvtinh199638@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh38', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(43, 'JrTinh39', 'pvtinh199639@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh39', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 15:35:45', '2017-09-19 15:35:45'),
(62, 'ja', 'dsfn', 'sadjfn', 'sdjfn', 'sjdn', 'asdjn', 'asdnj', 'sdf', 2, 2, '2017-09-20 00:00:00', '2017-09-20 00:00:00'),
(64, 'jaa', 'dsfnasdfasf', 'sadjfn', 'sdjfn', 'sjdn', 'asdjn', 'asdnj', 'sdf', 2, 2, '2017-09-20 00:00:00', '2017-09-20 00:00:00'),
(66, 'jjna', 'dsfn65522', 'sadjfn', 'sdjfn', 'sjdn', 'asdjn', 'asdnj', 'sdf', 2, 2, '2017-09-20 00:00:00', '2017-09-20 00:00:00'),
(67, 'jjnasdf', 'dsfn65522sd', 'sadjfn', 'sdjfn', 'sjdn', 'asdjn', 'asdnj', 'sdf', 2, 2, '2017-09-19 16:27:29', '2017-09-19 16:27:29'),
(70, 'JrTinh40', 'pvtinh199640@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default.jpg', 'Tinh40', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 16:48:45', '2017-09-19 16:48:45'),
(71, 'JrTinh41', 'pvtinh199641@gmail.com', 'c3284d0f94606de1fd2af172aba15bf3', 'default.jpg', 'Tinh41', 'Phan', '01223330996', 'DN City', 2, 2, '2017-09-19 16:49:53', '2017-09-19 16:49:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
