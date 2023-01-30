-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 09:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12578691`
--

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

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `jawaban`, `id_respon`, `id_pertanyaan`) VALUES
(1, '4', 1, 5),
(2, '5', 1, 7),
(3, '5', 1, 6),
(4, '5', 2, 5),
(5, '5', 2, 7),
(6, '4', 2, 6),
(7, '4', 3, 5),
(8, '4', 3, 7),
(9, '3', 3, 6),
(10, '2', 4, 12),
(11, '3', 4, 13),
(12, '3', 4, 14),
(13, '4', 4, 15),
(14, '4', 4, 16),
(15, '5', 4, 17),
(16, '2', 4, 18),
(17, '3', 5, 12),
(18, '3', 5, 13),
(19, '3', 5, 14),
(20, '4', 5, 15),
(21, '2', 5, 16),
(22, '3', 5, 17),
(23, '5', 5, 18),
(24, '4', 6, 12),
(25, '4', 6, 13),
(26, '3', 6, 14),
(27, '5', 6, 15),
(28, '3', 6, 16),
(29, '5', 6, 17),
(30, '5', 6, 18),
(31, '3', 7, 12),
(32, '4', 7, 13),
(33, '5', 7, 14),
(34, '3', 7, 15),
(35, '5', 7, 16),
(36, '5', 7, 17),
(37, '4', 7, 18),
(38, '4', 8, 5),
(39, '5', 8, 6),
(40, '3', 8, 7),
(41, '4', 9, 19),
(42, '4', 9, 20),
(43, '3', 9, 21),
(44, '5', 9, 22),
(45, '5', 9, 23),
(46, '5', 9, 24),
(47, '2', 9, 25),
(48, '5', 10, 19),
(49, '5', 10, 20),
(50, '5', 10, 21),
(51, '3', 10, 22),
(52, '4', 10, 23),
(53, '2', 10, 24),
(54, '1', 10, 25),
(55, '3', 11, 19),
(56, '3', 11, 20),
(57, '3', 11, 21),
(58, '4', 11, 22),
(59, '5', 11, 23),
(60, '1', 11, 24),
(61, '5', 11, 25),
(62, '5', 12, 26),
(63, '4', 12, 27),
(64, '5', 12, 28),
(65, '5', 12, 29),
(66, '4', 12, 30),
(67, '3', 12, 31),
(68, '4', 12, 32),
(69, '5', 12, 33),
(70, '4', 12, 34),
(71, '5', 12, 35),
(72, '4', 13, 26),
(73, '3', 13, 28),
(74, '3', 13, 29),
(75, '3', 13, 30),
(76, '4', 13, 31),
(77, '5', 13, 32),
(78, '5', 13, 33),
(79, '4', 13, 34),
(80, '5', 13, 35),
(81, '5', 14, 26),
(82, '5', 14, 27),
(83, '5', 14, 28),
(84, '4', 14, 29),
(85, '4', 14, 30),
(86, '4', 14, 31),
(87, '2', 14, 32),
(88, '3', 14, 33),
(89, '3', 14, 34),
(90, '4', 14, 35),
(91, '5', 15, 36),
(92, '4', 15, 37),
(93, '2', 15, 38),
(94, '5', 16, 36),
(95, '3', 16, 37),
(96, '5', 16, 38),
(97, '3', 17, 51),
(98, '4', 17, 52),
(99, '2', 17, 53),
(100, '5', 17, 54);

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
(7, 'Bagaimana perlakuan panitia terhadap peserta yang tidak membawa antribut dengan lengkap', 4),
(12, 'Apakah jaringan internet di kampus stabil', 5),
(13, 'apakah ', 5),
(14, 'jkashkda\r\n', 5),
(15, 'kjkslakkjd', 5),
(16, 'jhdksjshdka', 5),
(17, 'ojsmnkjndc', 5),
(18, 'ljasjdkajsdnn', 5),
(19, 'Bagaimana kualitas materi yang diajarkan', 6),
(20, 'Bagaimana kejelasan materi yang diberikan', 6),
(21, 'Bagaimana problem solving dilakukan', 6),
(22, 'Apakah dosen memberikan kejelasan jenjang karir', 6),
(23, 'Bagaimana kesan anda selama mengenal dosen ', 6),
(24, 'Bagaimana dosen menghibur mahasiswa yang mengantuk', 6),
(25, 'Sulitkah materi yang dibawakan', 6),
(26, 'Kemudahan aksesbilitas untuk mencapai bandara dari tempat anda menggunakan angkutan umum (contoh : Taksi, Trans Jogja, Kereta Api, Bus,dll ) di pagi hari, sore atau malam hari ?', 7),
(27, 'Kemudahan aksesbilitas untuk keluar bandara ke tempat anda menggunakan angkutan umum (contoh : Taksi, Trans Jogja, Kereta Api, Bus,dll ) di pagi hari, sore atau malam hari ?', 7),
(28, 'Pengelolaan area parkir untuk kendaraan pribadi (Mobil atau Motor), termasuk sistem pembayaran, ketersediaan area parkir, kondisi jalan , marka /rambu parkir dan jam layanan parkir yang berlaku?', 7),
(29, 'Antrian ketika akan melakukan registrasi check – in untuk melakukan perjalanan ?', 7),
(30, 'Jaminan Keamanan (perasaan aman) ketika berada di bandara (menunggu penerbangan, menunggu teman/ keluarga yang datang dan pada saat meninggalkan bandara) (contoh : adanya petugas yang sering berjalan-jalan, staff terkait yang memantau keadaan bandara, dsb)?', 7),
(31, 'Ketersediaan tempat duduk ketika ingin beristirahat pada saat menunggu penerbangan, menunggu teman/ keluarga dan pada saat meninggalkan bandara ?', 7),
(32, 'Kenyamanan ketika berada di bandara (seperti temperatur udara (AC), Toilet, Tempat Duduk, ketika berada di ruang tunggu didalam bandara, ruang antar jemput penumpang, area food court) ?', 7),
(33, 'Kebersihan di airport (seperti ruang tunggu didalam bandara, toilet, ruang antar jemput penumpang, area food court, area parkir, dll)?', 7),
(34, 'Keramahtamahan dan sikap yang baik dari Staff Bandara untuk menolong dan menerima komplain dari penumpang di bandara?', 7),
(35, 'Kemudahan untuk mendapatkan (mencari) staff bandara / mencapai kantor customer office (informasi) ketika akan menanyakan hal berkaitan tentang penerbangan, komplain, dan masalah-masalah yang lainnya ?', 7),
(36, 'Bermanfaatkah', 9),
(37, 'Apa iya sih', 9),
(38, 'beneran', 9),
(39, 'laksjdlkajsd\r\n', 9),
(40, 'aslisjdla\r\n', 9),
(41, 'apa ya', 9),
(42, 'iieuejdj', 9),
(51, 'Apakah lapangan UKSW layak digunakan sebagai lapangan bola?', 12),
(52, 'Bagaimana keadaan lapangan saat musim panas?', 12),
(53, 'Bagaimana keadaan lapangan saat musim hujan?', 12),
(54, 'Bagaimana alur yang digunakan untuk peminjaman lapangan?', 12),
(55, 'Bagaimana kebersihan di lingkunan UKSW?', 13),
(56, 'Bagaimana kesan anda terhadap kebersihan cafe?', 13),
(57, 'Bagaimana kebersihan toilet dilingkungan UKSW?\r\n', 13);

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

--
-- Dumping data for table `respon`
--

INSERT INTO `respon` (`id_respon`, `id_user`, `id_survey`) VALUES
(1, 1, 4),
(8, 1, 4),
(4, 1, 5),
(9, 1, 6),
(12, 1, 7),
(15, 1, 9),
(17, 1, 12),
(3, 12, 4),
(6, 12, 5),
(2, 13, 4),
(5, 13, 5),
(10, 13, 6),
(14, 13, 7),
(7, 15, 5),
(16, 15, 9),
(11, 16, 6),
(13, 16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(15) NOT NULL,
  `judul_survey` varchar(100) NOT NULL,
  `publish` varchar(15) NOT NULL,
  `id_user` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `judul_survey`, `publish`, `id_user`) VALUES
(4, 'Survey Kegiatan FTI days', 'semua', 3),
(5, 'Survey kepuasan mahasiswa terhadap penggunaan internet di kampus', 'semua', 3),
(6, 'Survey dosen pengajar FTI 666', 'semua', 3),
(7, 'SURVEY KEPUASAN PELANGGAN PADA PELAYANAN  PT. ANGKASA PURA I di BANDARA ADI SUCIPTO - YOGYAKARTA', 'semua', 3),
(9, 'Analisa kebutuhan penyediaan hand sanitizer di lingkungan kampus', 'semua', 3),
(12, 'Manfaat penggunaan lapangan uksw Salatiga', 'mahasiswa', 3),
(13, 'Analisis dampak lingkungan UKSW', 'dosen', 3);

-- --------------------------------------------------------

--
-- Table structure for table `temp_pertanyaan`
--

CREATE TABLE `temp_pertanyaan` (
  `id_pertanyaan` int(15) NOT NULL,
  `pertanyaan` text NOT NULL,
  `id_survey` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_survey`
--

CREATE TABLE `temp_survey` (
  `id_survey` int(15) NOT NULL,
  `judul_survey` varchar(100) NOT NULL,
  `id_user` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `privilege` int(15) NOT NULL,
  `reset_link_token` varchar(250) DEFAULT NULL,
  `exp_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nomor_induk`, `nama`, `email`, `password`, `id_progdi`, `privilege`, `reset_link_token`, `exp_token`) VALUES
(1, '672018178', 'Paulus Andry Leksono', '672018178@student.uksw.edu', '$2y$10$iOk4.7yeoJxps3oYOqgW5eYUdNk8iQ5eCMwO9g54fRJ6BXFvwfgpq', 67, 4, 'cae45bc2ed28b22e4e44bea126b1b01a708', '2023-01-04 14:58:29'),
(3, '101', 'Admin', 'admin.lpm@uksw.edu', '$2y$10$YsjKRx6ehqOWvQteEf4d8O20TdBDMuwAfe40mPfW6825k6WcrTZKC', 98, 1, '', ''),
(12, '123', 'www', 'www@mail.com', '$2y$10$/CZeYWNDq17d8J.qdUDMjelslVSIOfn4YzHd0EcZLy6SIoR3TejLG', 85, 4, '', ''),
(13, '682018175', 'Karlos Saha', '682018175@student.uksw.edu', '$2y$10$m5MmFSkGJxW0OgFwjzH7U.mLBjCVXG4aQXVBXtc9ITBgbLBLYvSbS', 68, 4, '2242a7ccf356c8be59e4d66eaec1df2d495', '2022-12-15 14:23:39'),
(14, '001', 'Yeremia alfa', 'kaprogdi.s1.ti@uksw.edu', '$2y$10$S5WqC55gtem4B5KUgDfvE.b1Vm/83HV3wKuENJKfHuOzsA5Lx2C5i', 67, 2, '', ''),
(15, '672018109', 'Sakarias', 'phili@mail.com', '$2y$10$wclI4pI5ysDu9CqK6llvsOIbeYOKq30HJ5C3JOxRvS6bIH8or/eEW', 67, 4, '', ''),
(16, '301', 'Aron Ramsey', 'Aron.r@yahoo.com', '$2y$10$yTHQDbW2OmLv9Er4qJ0CbuMYEUaB4xU.xWXkPFICCd24ihlbv/KS2', 39, 3, '', ''),
(18, '002', 'Kunto Aji', 'kunto.aji@gmail.com', '$2y$10$mm2FSC2StQEn/6VeodFA3OJKGLQ4meYBE9WHwShw9EUx3pM299SQe', 51, 2, NULL, NULL);

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
  ADD KEY `id_user` (`id_user`,`id_survey`),
  ADD KEY `id_survey` (`id_survey`);

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
  ADD UNIQUE KEY `email` (`email`),
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
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id_privilege` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `respon`
--
ALTER TABLE `respon`
  MODIFY `id_respon` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_pertanyaan`
--
ALTER TABLE `temp_pertanyaan`
  MODIFY `id_pertanyaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `temp_survey`
--
ALTER TABLE `temp_survey`
  MODIFY `id_survey` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_respon`) REFERENCES `respon` (`id_respon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `respon_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `respon_ibfk_2` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`);

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
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`privilege`) REFERENCES `privilege` (`id_privilege`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_progdi`) REFERENCES `progdi` (`id_progdi`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
