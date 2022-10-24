-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 04:04 AM
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
(7, 'asda', 'aad@gmail.com', 2022, 2019, 'D3 Elektronika', 'Bekerja'),
(8, 'asd', 'asdasd@email.com', 2022, 2019, 'D3 Elektronika', 'Bekerja');

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
(1, '190535646041', 11, '41-60', '50', 1612399026),
(2, '190535646041', 12, '41-60', '50', 1666499026),
(3, '190535646041', 13, '41-60', '50', 1666499026),
(4, '190535646041', 14, '41-60', '50', 1666499026),
(5, '190535646041', 15, '41-60', '50', 1666499026),
(6, '190535646041', 16, '41-60', '50', 1666499026),
(7, '190535646041', 17, '41-60', '50', 1666499026),
(8, '190535646041', 18, '41-60', '50', 1666499026),
(9, '190535646041', 19, '41-60', '50', 1666499026),
(10, '190535646041', 20, '41-60', '50', 1666499026),
(11, '190535646041', 21, '41-60', '50', 1666499026),
(12, '190535646041', 22, '41-60', '50', 1666499026),
(13, '190535646041', 23, '41-60', '50', 1666499026),
(14, '190535646041', 24, '41-60', '50', 1666499026),
(15, '190535646041', 25, '41-60', '50', 1666499026),
(16, '190535646041', 26, 'asd', '', 1666499026),
(17, '190535646041', 27, 'asd', '', 1666499026),
(18, '190535646041', 28, 'asd', '', 1666499026),
(19, '190535646041', 29, '41-60', '50', 1666499026),
(20, '190535646044', 11, '41-60', '50', 1666502536),
(21, '190535646044', 12, '41-60', '50', 1666502536),
(22, '190535646044', 13, '41-60', '50', 1666502536),
(23, '190535646044', 14, '41-60', '50', 1666502536),
(24, '190535646044', 15, '41-60', '50', 1666502536),
(25, '190535646044', 16, '41-60', '50', 1666502536),
(26, '190535646044', 17, '41-60', '50', 1666502536),
(27, '190535646044', 18, '41-60', '50', 1666502536),
(28, '190535646044', 19, '41-60', '50', 1666502536),
(29, '190535646044', 20, '41-60', '50', 1666502536),
(30, '190535646044', 21, '41-60', '50', 1666502536),
(31, '190535646044', 22, '41-60', '50', 1666502536),
(32, '190535646044', 23, '41-60', '50', 1666502536),
(33, '190535646044', 24, '41-60', '50', 1666502536),
(34, '190535646044', 25, '41-60', '50', 1666502536),
(35, '190535646044', 26, 'ads', '', 1666502536),
(36, '190535646044', 27, 'asd', '', 1666502536),
(37, '190535646044', 28, 'asd', '', 1666502536),
(38, '190535646044', 29, '41-60', '50', 1666502536),
(39, '100533402573', 11, '41-60', '50', 1666506527),
(40, '100533402573', 12, '21-40', '34', 1666506527),
(41, '100533402573', 13, '21-40', '23', 1666506527),
(42, '100533402573', 14, '41-60', '50', 1666506527),
(43, '100533402573', 15, '41-60', '50', 1666506527),
(44, '100533402573', 16, '41-60', '50', 1666506527),
(45, '100533402573', 17, '41-60', '50', 1666506527),
(46, '100533402573', 18, '41-60', '50', 1666506527),
(47, '100533402573', 19, '41-60', '50', 1666506527),
(48, '100533402573', 20, '41-60', '50', 1666506527),
(49, '100533402573', 21, '41-60', '50', 1666506527),
(50, '100533402573', 22, '41-60', '50', 1666506527),
(51, '100533402573', 23, '41-60', '50', 1666506527),
(52, '100533402573', 24, '41-60', '50', 1666506527),
(53, '100533402573', 25, '41-60', '50', 1666506527),
(54, '100533402573', 26, 'asd', '', 1666506527),
(55, '100533402573', 27, 'asd', '', 1666506527),
(56, '100533402573', 28, 'ads', '', 1666506527),
(57, '100533402573', 29, '41-60', '50', 1666506527),
(90, '8', 66, '41-60', '50', 1666576763),
(91, '1', 68, '41-60', '50', 1666576908);

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
(1, 'Monev Awal', 'mahasiswa'),
(2, 'Monev Tengah', 'mahasiswa'),
(3, 'Monev Akhir', 'mahasiswa');

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

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `position`, `agency`, `phone`, `scale`, `year_since`, `year_coop`) VALUES
(1, 'asdasd', 'asd', '123', 'Internasional', 2022, 2022);

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
(6, 'Tes Monev Awal', 1, 1665266400, 1666994400),
(7, 'Tes Monev Tengah', 2, 1666044000, 1666735200),
(8, 'sad', 4, 1665525600, 1667516400);

-- --------------------------------------------------------

--
-- Table structure for table `repository`
--

CREATE TABLE `repository` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `files` varchar(255) NOT NULL,
  `id_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repository`
--

INSERT INTO `repository` (`id`, `name`, `institution`, `date`, `category`, `files`, `id_user`) VALUES
(3, 'ASDASD', 'SADASD', 1664229600, 'Lokal', 'table.pdf', '13145241');

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
(11, '0', '1', 'Berapa persen kehadiran dosen dalam 3 minggu pertama?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(12, '0', 'mahasiswa', 'Berapa persen kehadiran mahasiswa dalam 3 minggu pertama?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(13, '0', 'mahasiswa', 'Berapa persen dosen yang membahas Rencana  Perkuliahan Semester (RPS) pada pertemuan pertama?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(14, '0', 'mahasiswa', 'Berapa persen dosen yang memberikan handout/modul materi kuliah (baik dalam bentuk hard copy atau soft copy)?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(15, '0', 'mahasiswa', 'Berapa persen dosen yang hanya memberikan  daftar buku referensi, tanpa memberikan handout/modul materi kuliah?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(16, '0', 'mahasiswa', 'Bagaimana rata-rata kemampuan dosen dalam menyampaikan materi di kelas Anda? (dikhususkan terhadap penguasaan materi/substansi perkuliahan)?', 'bar', '', 'Tidak Menguasai', 'Sangat Menguasai', '100', 'bar', 1),
(17, '0', 'mahasiswa', 'Berapa persen pengisian konten SIPEJAR oleh Dosen?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(18, '0', 'mahasiswa', 'Berapa persen variasi konten pembelajaran yang digunakan oleh dosen?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(19, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas layanan dosen dalam perkuliahan?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(20, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas layanan informasi dalam perkuliahan?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(21, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas layanan akademik yang telah diberikan oleh petugas administrasi dan perpustakaan di Departemen Teknik Elektro?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(22, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas layanan yang telah diberikan oleh Teknisi/Laboran ketika menggunakan fasilitas paktikum di Lab/Workshop?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(23, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas kebersihan dan kenyamanan fasilitas gedung dan ruang kuliah?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(24, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas kenyamanan akses internet di Gedung B11, B12, DAN GKB?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(25, '0', 'mahasiswa', 'Berapa persen tingkat kepuasan Anda atas kenyamanan sarana ruang kuliah di Gedung B11,B12, DAN GKB (LCD projector, kebersihan kelas, kelayakan papan tulis, sirkulasi udara, meja/kursi kuliah)?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(26, '0', 'mahasiswa', 'Menurut anda, apa saja yang menjadi kelebihan pembelajaran luring?', 'description', '', '0%', '100%', '100', 'bar', 1),
(27, '0', 'mahasiswa', 'Menurut anda, apa saja yang menjadi kelemahan pembelajaran luring?', 'description', '', '0%', '100%', '100', 'bar', 1),
(28, '0', 'mahasiswa', 'Menurut anda, apa saja yang menjadi ancaman pembelajaran luring?', 'description', '', '0%', '100%', '100', 'bar', 1),
(29, '0', 'mahasiswa', 'Menurut anda, apa saja yang menjadi ancaman pembelajaran luring?', 'bar', '', '0%', '100%', '100', 'bar', 1),
(32, '0', '2', 'Jumlah matakuliah yang Anda tempuh dalam semester berjalan dan sesuai dengan Jadwal Kuliah di Prodi/Offering Anda?', 'description', '', '0%', '100%', '100', 'bar', 2),
(33, '0', '2', 'Berapa persen (%) kehadiran dosen Anda dari pertemuan ke-8 hingga ke-10?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(34, '0', '2', 'Berapa persen (%) kehadiran mahasiswa dalam kelas Anda dari pertemuan ke-8 hingga ke-10?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(35, '0', '2', 'Berapa persen (%) matakuliah yang telah menyelenggarakan UTS?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(36, '0', '2', 'Berapa persen (%) matakuliah yang sudah membahas/mengembalikan UTS kepada mahasiswanya?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(37, '0', '2', 'Berapa persen (%) Capaian Pelaksanaan Pembelajaran dari pertemuan ke-1 hingga ke-10? (Sesuai dengan RPS yang disampaikan oleh Dosen di Awal Perkuliahan)?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(38, '0', '2', 'Berapa persen (%) penggunaan Bahan Ajar dari pertemuan ke-1 hingga ke-10? (Sesuai dengan RPS yang disampaikan oleh Dosen di Awal Perkuliahan)?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(39, '0', '2', 'Seberapa baik-kah dosen Anda dalam menyediakan referensi perkuliahan untuk dipelajari oleh mahasiswa?', 'bar', '', 'Tidak Baik', 'Sangat Baik', '100', 'bar', 2),
(40, '0', '2', 'Seberapa baik-kah dosen Anda dalam melakukan Inovasi Metode Pembelajaran pada Proses Pembelajaran?', 'bar', '', 'Tidak Baik ', 'Sangat Baik', '100', 'bar', 2),
(41, '0', '2', 'Seberapa baik-kah dosen Anda dalam menggunakan media pembelajaran yang interaktif dan menarik?', 'bar', '', 'Tidak Baik ', 'Sangat Baik', '100', 'bar', 2),
(42, '0', '2', 'Seberapa baik-kah dosen Anda dalam memberi kesempatan memperbaiki hasil evaluasi pembelajaran?', 'bar', '', 'Tidak Baik', 'Sangat Baik', '100', 'bar', 2),
(43, '0', '2', 'Seberapa baik-kah dosen Anda dalam memberi kesempatan bertanya dalam proses pembelajaran?', 'bar', '', 'Tidak Baik', 'Sangat Baik', '100', 'bar', 2),
(44, '0', '2', 'Seberapa baik-kah dosen Anda dalam menyampaikan kisi-kisi untuk Proses Evaluasi Pembelajaran (Kuis/UTS)?', 'bar', '', 'Tidak Baik', 'Sangat Baik', '100', 'bar', 2),
(45, '0', '2', 'Seberapa baik-kah dosen Anda dalam memberi contoh-contoh nyata kehidupan sehari-hari dalam proses pembelajaran?', 'bar', '', 'Tidak Baik', 'Sangat Baik', '100', 'bar', 2),
(46, '0', '2', 'Seberapa baik-kah dosen Anda dalam menguasai materi perkuliahan?', 'bar', '', 'Tidak Baik ', 'Sangat Baik', '100', 'bar', 2),
(48, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Karismatik?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(49, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Motivator?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(50, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Semangat?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(51, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Humoris?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(52, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Terbuka?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(53, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memiliki indikator Menghargai kemampuan mahasiswa (reward)?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(54, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang memberikan teguran/sanksi jika mahasiswa bersikap tidak baik?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(55, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang Merespon pertanyaan dengan baik?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(56, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang disiplin waktu?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(57, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang Selalu hadir dalam kelas?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(58, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang bersikap galak?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(59, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang bersikap tegas?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(60, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang melayani di luar jam kuliah?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(61, '0', '2', 'Berapa persen (%) dosen dalam perkuliahan yang bersikap lugas?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(62, '0', '2', 'Berapa persen (%) tingkat kepuasan Anda atas Layanan Akademik yang telah diberikan oleh Petugas Administrasi JTE?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(63, '0', '2', 'Berapa persen (%) tingkat kepuasan Anda atas Layanan Akademik yang telah diberikan oleh Petugas Perpustakaan JTE?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(64, '0', '2', 'Berapa persen (%) tingkat kepuasan Anda atas Layanan Informasi yang telah diberikan oleh Pengelola JTE?', 'bar', '', '0%', '100%', '100', 'bar', 2),
(65, '0', '4', 'asdasd', 'bar', '', '0%', '100%', '100', 'bar', 4),
(67, '', '4', 'sasdasd', 'bar', '', '0%', '100%', '100', 'bar', 4);

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
-- Indexes for table `repository`
--
ALTER TABLE `repository`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `repository`
--
ALTER TABLE `repository`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
