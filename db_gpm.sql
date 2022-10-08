-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 05:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `year_to` int(4) NOT NULL,
  `year_from` int(4) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `name`, `email`, `year_to`, `year_from`, `prodi`, `activity`) VALUES
(1, 'asda', 'Sd@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(2, 'asd', 'saad@gmail.com', 2020, 2016, 'S1 Pendidikan Teknik Informatika', 'Studi Lanjut'),
(3, 'qwdas', 'ad@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(4, 'Twa', 'asd@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(5, 'adsa', 'As@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(6, 'adsa', 'As@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(7, 'asda', 'aad@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_survei` int(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `id_user`, `id_survei`, `answer`, `detail`, `created_at`) VALUES
(1, '190535646041', 3, 'cool', '', 1663538401),
(2, '190535646042', 3, 'yes', '', 1663538402),
(3, '190535646043', 3, 'yo', '', 1663538403),
(4, '190535646052', 3, 'yes', '', 1663538405),
(5, '190535646021', 9, 'yo', '', 1663538406),
(6, '190535646000', 9, 'ma', '', 1663538407),
(7, '190535646090', 10, '81-100', '87', 1663538408),
(8, '190535646080', 10, '61-80', '66', 1663538408),
(9, '190535646070', 2, 'asdasd', '', 1663538409),
(10, '190535646055', 2, 'sadasd', '', 1663538409),
(11, '190535646066', 2, 'asdasd', '', 1663538410),
(12, '190535646053', 2, 'sadasd', '', 1663538411),
(13, '190535646041', 1, 'excellent', '', 2147483647),
(14, '190535646041', 2, '12', '', 2147483647),
(15, '190535646041', 3, 'yes', '', 2147483647),
(16, '190535646041', 4, '50', '', 2147483647),
(17, '190535646041', 5, '123', '', 2147483647),
(18, '190535646041', 6, '50', '', 2147483647),
(19, '190535646041', 7, '50', '', 2147483647),
(20, '190535646041', 8, '50', '', 2147483647),
(21, '190535646041', 9, 'yo', '', 2147483647),
(22, '190535646041', 10, '40-60', '50', 2147483647),
(23, '190535646041', 1, 'cool', '', 1664709820),
(24, '190535646041', 2, '123', '', 1664709820),
(25, '190535646041', 3, 'cool', '', 1664709820),
(26, '190535646041', 4, '50', '', 1664709820),
(27, '190535646041', 5, '123', '', 1664709820),
(28, '190535646041', 6, '50', '', 1664709820),
(29, '190535646041', 7, '50', '', 1664709820),
(30, '190535646041', 8, '50', '', 1664709820),
(31, '190535646041', 9, 'yo', '', 1664709820),
(32, '190535646041', 10, '40-60', '50', 1664709820),
(33, '1', 7, '41-60', '', 1664710126),
(34, '1', 8, '41-60', '', 1664710126),
(35, '2', 7, '41-60', '', 1664710215),
(36, '2', 8, '41-60', '', 1664710215),
(37, '3', 7, '41-60', '', 1664710288),
(38, '3', 8, '41-60', '', 1664710288),
(39, '4', 7, '61-80', '', 1664774690),
(40, '4', 8, '61-80', '', 1664774690),
(41, '6', 7, '61-80', '62', 1664774803),
(42, '6', 8, '41-60', '44', 1664774803),
(43, '7', 7, '21-40', '22', 1664774895),
(44, '7', 8, '61-80', '76', 1664774895);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `role`) VALUES
(1, 'Survei Kepuasan Mahasiswa', 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(10) NOT NULL,
  `position` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `scale` varchar(255) NOT NULL,
  `year_since` int(4) NOT NULL,
  `year_coop` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `year_since` int(4) NOT NULL,
  `scale` varchar(255) NOT NULL,
  `employee` int(10) NOT NULL,
  `total_graduates` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(10) NOT NULL,
  `period_from` int(11) NOT NULL,
  `period_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `name`, `category`, `period_from`, `period_to`) VALUES
(1, 'Gasal Awal', 1, 1663538400, 1663538500);

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id` int(10) NOT NULL,
  `level` varchar(3) NOT NULL,
  `role` varchar(100) NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `selections` varchar(255) NOT NULL DEFAULT 'NULL',
  `bar_from` varchar(255) NOT NULL DEFAULT 'NULL',
  `bar_to` varchar(255) NOT NULL DEFAULT 'NULL',
  `bar_length` varchar(255) NOT NULL DEFAULT 'NULL',
  `chart` varchar(100) NOT NULL DEFAULT 'bar',
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survei`
--

INSERT INTO `survei` (`id`, `level`, `role`, `question`, `type`, `selections`, `bar_from`, `bar_to`, `bar_length`, `chart`, `category`) VALUES
(1, 'd4', 'mahasiswa', '123', 'selection', 'cool,excellent,yoma', '', '', '', 'bar', 1),
(2, 'd4', 'mahasiswa', 'tes', 'description', 'cool,excellent,yoma', '', '', '', 'bar', 1),
(3, 's1', 'mahasiswa', 'tes1', 'selection', 'cool,yes,yo', '', '', '', 'pie', 1),
(4, '', 'dosen', 'dosen', 'bar', '', '', '', '', 'pie', 1),
(5, '', 'tendik', 'tendik', 'selection', '123', '', '', '', 'pie', 1),
(6, '0', 'tendik', '123', 'bar', '', '', '', '', 'pie', 1),
(7, '0', 'alumni', '123', 'bar', '', 'Sangat Jelek', 'Sangat Bagus', '100', 'bar', 1),
(8, '0', 'alumni', '5', 'bar', '', 'Sangat buruk', 'Sangat Baik', '100', 'bar', 1),
(9, 's1', 'mahasiswa', 'tes2', 'selection', 'yo,ma,men', '', '', '', 'bar', 1),
(10, 's1', 'mahasiswa', 'tes bar', 'bar', '', 'tidak puas', 'sangat puas', '100', 'bar', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
