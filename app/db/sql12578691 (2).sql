-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql12.freesqldatabase.com
-- Generation Time: Nov 22, 2022 at 12:36 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12578691`
--
CREATE DATABASE IF NOT EXISTS `sql12578691` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sql12578691`;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(15) NOT NULL,
  `fakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `fakultas`) VALUES
(1, 'Bahasa dan Seni'),
(2, 'Biologi'),
(3, 'Ekonomi dan Bisnis'),
(4, 'Hukum'),
(5, 'Ilmu Sosial dan Komunikasi'),
(6, 'Interdisiplin'),
(7, 'Keguruan dan Ilmu Pendidikan'),
(8, 'Kedokteran dan Ilmu Kesehatan'),
(9, 'Pertanian dan Bisnis'),
(10, 'Psikologi'),
(11, 'Sains dan Matematika'),
(12, 'Teknik Elektro dan Komputer'),
(13, 'Teknologi Informasi'),
(14, 'Teologi');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(15) NOT NULL,
  `jawaban` varchar(2) NOT NULL,
  `id_respon` int(15) NOT NULL,
  `id_pertanyaan` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(15) NOT NULL,
  `pertanyaan` text NOT NULL,
  `id_survey` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_survey`) VALUES
(5, 'Bagaimana Acara keseluruhan FTI days', 4),
(6, 'Bagaimana respon kakak-kakak panitia terhadap peseta yang sakit', 4),
(7, 'Bagaimana perlakuan panitia terhadap peserta yang tidak membawa antribut dengan lengkap', 4);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id_privilege` int(15) NOT NULL,
  `privilege` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id_privilege`, `privilege`) VALUES
(1, 'admin'),
(2, 'kaprogdi'),
(3, 'pegawai'),
(4, 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `progdi`
--

CREATE TABLE `progdi` (
  `id_progdi` int(15) NOT NULL,
  `progdi` varchar(50) NOT NULL,
  `id_fakultas` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progdi`
--

INSERT INTO `progdi` (`id_progdi`, `progdi`, `id_fakultas`) VALUES
(9, 'S2 Magister Studi Pembangunan', 6),
(11, 'S1 Pendidikan Bahasa Inggris', 1),
(13, 'S1 Bimbingan Konseling', 7),
(15, 'S1 Pendidikan Sejarah', 7),
(16, 'S1 Pendidikan Ekonomi', 7),
(17, 'S1 Pendidikan Pancasila dan Kewarganegaraan', 7),
(19, 'Pendidikan Fisika', 11),
(20, 'S1 Pendidikan Matematika', 7),
(21, 'S1 Manajemen', 3),
(22, 'S1 Ilmu Ekonomi', 3),
(23, 'S1 Akuntansi', 3),
(27, 'S1 Pendidikan Guru Pendidikan Anak Usia Dini', 7),
(29, 'S1 Pendidikan Guru Sekolah Dasar', 7),
(31, 'S1 Ilmu Hukum', 4),
(32, 'S2 Magister Ilmu Hukum', 4),
(35, 'S1 Sosiologi', 5),
(36, 'S1 Komunikasi', 5),
(37, 'S1 Hubungan Internasional', 5),
(39, 'S1 Sastra Inggris', 1),
(41, 'S1 Biologi', 1),
(42, 'S2 Magister Biologi', 2),
(43, 'S1 Pendidikan Biologi', 2),
(46, 'S1 Keperawatan', 8),
(47, 'S1 Gizi', 8),
(48, 'S1 Pendidikan Jasmani Kesehatan dan Rekreasi', 8),
(49, 'S1 Teknologi Pangan', 8),
(50, 'Program Profesi Ners', 8),
(51, 'S1 Agroekoteknologi', 9),
(52, 'S1 Agribisnis', 9),
(53, 'S2 magister Ilmu Pertanian', 9),
(55, 'D3 Sistem Informasi Akuntansi', 13),
(56, 'D3 Teknik Informatika', 13),
(60, 'S1 Hubungan Masyarakat', 13),
(61, 'S1 Teknik Elektro', 12),
(62, 'S1 Sistem Komputer', 12),
(63, 'S2 Data Science', 11),
(64, 'S1 Fisika', 11),
(65, 'S1 Kimia', 11),
(66, 'S1 Matematika', 11),
(67, 'S1 Teknik Informatika', 13),
(68, 'S1 Sistem Informasi', 13),
(69, 'S1 Desain Komunikasi Visual', 13),
(70, 'S1 Pendidikan Teknik Informatika dan Komputer', 13),
(71, 'S1 Teologi', 14),
(73, 'D4 Destinasi Pariwisata', 6),
(74, 'S1 Perpustakaan dan Sains Informasi', 13),
(75, 'S2 Magister Sosiologi Agama', 14),
(76, 'S3 Doktor Sosiologi Agama', 14),
(80, 'S1 Psikologi', 10),
(83, 'S2 Sains Psikologi', 10),
(84, 'Bisnis Digital', 13),
(85, 'S1 Seni Musik', 1),
(90, 'S3 Magister Studi Pembangunan', 6),
(91, 'S2 Manajemen', 3),
(92, 'S3 Doktor Ilmu Manajemen', 3),
(93, 'S2 Akuntansi', 3),
(94, 'S2 Magister Manajemen Pendidikan', 7),
(95, 'PPG', 7),
(96, 'S2 Magister Pendidikan Bahasa Inggris', 1),
(97, 'S2 Sistem Informasi', 13),
(98, 'S3 Doktor Ilmu Komputer', 13);

-- --------------------------------------------------------

--
-- Table structure for table `respon`
--

CREATE TABLE `respon` (
  `id_respon` int(15) NOT NULL,
  `id_user` int(15) NOT NULL,
  `id_survey` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(15) NOT NULL,
  `judul_survey` varchar(100) NOT NULL,
  `id_user` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `judul_survey`, `id_user`) VALUES
(4, 'Survey Kegiatan FTI days', 3);

-- --------------------------------------------------------

--
-- Table structure for table `temp_pertanyaan`
--

CREATE TABLE `temp_pertanyaan` (
  `id_pertanyaan` int(15) NOT NULL,
  `pertanyaan` text NOT NULL,
  `id_survey` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_pertanyaan`
--

INSERT INTO `temp_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_survey`) VALUES
(3, 'Apakah anda puas terhadap layanan internet yang diterapkan saat ini', 5);

-- --------------------------------------------------------

--
-- Table structure for table `temp_survey`
--

CREATE TABLE `temp_survey` (
  `id_survey` int(15) NOT NULL,
  `judul_survey` varchar(100) NOT NULL,
  `id_user` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_survey`
--

INSERT INTO `temp_survey` (`id_survey`, `judul_survey`, `id_user`) VALUES
(5, 'Survey kepuasan mahasiswa terhadap penggunaan internet di kampus', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(30) NOT NULL,
  `nomor_induk` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_progdi` int(15) NOT NULL,
  `privilege` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nomor_induk`, `nama`, `email`, `password`, `id_progdi`, `privilege`) VALUES
(1, '672018178', 'Paulus Andry Leksono', '672018178@student.uksw.edu', '$2y$10$YoQoB6vof4pwYNH1sptxlOR.7ISnoH.esZY3AkXZh4S4ih.ktvWCS', 67, 4),
(3, '101', 'Admin', 'admin.lpm@uksw.edu', '$2y$10$YsjKRx6ehqOWvQteEf4d8O20TdBDMuwAfe40mPfW6825k6WcrTZKC', 98, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_respon` (`id_respon`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_survey` (`id_survey`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id_privilege`);

--
-- Indexes for table `progdi`
--
ALTER TABLE `progdi`
  ADD PRIMARY KEY (`id_progdi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `respon`
--
ALTER TABLE `respon`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `id_user` (`id_user`,`id_survey`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `temp_pertanyaan`
--
ALTER TABLE `temp_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_survey` (`id_survey`);

--
-- Indexes for table `temp_survey`
--
ALTER TABLE `temp_survey`
  ADD PRIMARY KEY (`id_survey`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `privilege` (`privilege`),
  ADD KEY `id_progdi` (`id_progdi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id_privilege` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `respon`
--
ALTER TABLE `respon`
  MODIFY `id_respon` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `temp_pertanyaan`
--
ALTER TABLE `temp_pertanyaan`
  MODIFY `id_pertanyaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `temp_survey`
--
ALTER TABLE `temp_survey`
  MODIFY `id_survey` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_respon`) REFERENCES `respon` (`id_respon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `progdi`
--
ALTER TABLE `progdi`
  ADD CONSTRAINT `progdi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`);

--
-- Constraints for table `respon`
--
ALTER TABLE `respon`
  ADD CONSTRAINT `respon_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `temp_pertanyaan`
--
ALTER TABLE `temp_pertanyaan`
  ADD CONSTRAINT `temp_pertanyaan_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `temp_survey` (`id_survey`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_progdi`) REFERENCES `progdi` (`id_progdi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`privilege`) REFERENCES `privilege` (`id_privilege`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
