-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Nov 2022 pada 14.01
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app survey`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(15) NOT NULL,
  `fakultas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_survey`
--

CREATE TABLE `hasil_survey` (
  `id_response` int(15) NOT NULL,
  `idUser` int(90) NOT NULL,
  `Pertanyaan1` varchar(30) NOT NULL,
  `Pertanyaan2` varchar(30) NOT NULL,
  `Pertanyaan3` varchar(30) NOT NULL,
  `Pertanyaan4` varchar(30) NOT NULL,
  `Pertanyaan5` int(30) NOT NULL,
  `Pertanyaan6` int(30) NOT NULL,
  `Pertanyaan7` int(30) NOT NULL,
  `Pertanyaan8` int(30) NOT NULL,
  `Pertanyaan9` int(30) NOT NULL,
  `Pertanyaan10` int(30) NOT NULL,
  `Pertanyaan11` int(30) NOT NULL,
  `Pertanyaan12` int(30) NOT NULL,
  `Pertanyaan13` int(30) NOT NULL,
  `Pertanyaan14` int(30) NOT NULL,
  `Pertanyaan15` int(30) NOT NULL,
  `id_Survey` varchar(30) NOT NULL,
  `namaSurvey` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(15) NOT NULL,
  `id_survey` int(15) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `progdi`
--

CREATE TABLE `progdi` (
  `id_progdi` int(15) NOT NULL,
  `progdi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey`
--

CREATE TABLE `survey` (
  `ID_Survey` varchar(30) NOT NULL,
  `Nama_Survey` varchar(70) NOT NULL,
  `pertanyaan_1` varchar(90) NOT NULL,
  `pertanyaan_2` varchar(90) NOT NULL,
  `pertanyaan_3` varchar(90) NOT NULL,
  `pertanyaan_4` varchar(90) NOT NULL,
  `pertanyaan_5` varchar(90) NOT NULL,
  `pertanyaan_6` varchar(90) NOT NULL,
  `pertanyaan_7` varchar(90) NOT NULL,
  `pertanyaan_8` varchar(90) NOT NULL,
  `pertanyaan_9` varchar(90) NOT NULL,
  `pertanyaan_10` varchar(90) NOT NULL,
  `pertanyaan_11` varchar(90) NOT NULL,
  `pertanyaan_12` varchar(90) NOT NULL,
  `pertanyaan_13` varchar(90) NOT NULL,
  `pertanyaan_14` varchar(90) NOT NULL,
  `pertanyaan_15` varchar(90) NOT NULL,
  `iD_INFOJWBN3` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_fakultas` int(15) NOT NULL,
  `id_progdi` int(15) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indeks untuk tabel `hasil_survey`
--
ALTER TABLE `hasil_survey`
  ADD PRIMARY KEY (`id_response`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indeks untuk tabel `progdi`
--
ALTER TABLE `progdi`
  ADD PRIMARY KEY (`id_progdi`);

--
-- Indeks untuk tabel `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`ID_Survey`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_survey`
--
ALTER TABLE `hasil_survey`
  MODIFY `id_response` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
