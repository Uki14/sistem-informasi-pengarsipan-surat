-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 08:39 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `pengisi` varchar(50) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `instruksi` varchar(300) NOT NULL,
  `catatan` varchar(200) NOT NULL,
  `id_suratmasuk` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `pengisi`, `tujuan`, `instruksi`, `catatan`, `id_suratmasuk`) VALUES
(9, 'Kepsek', 'Keuangan', '', 'Penting', 2),
(10, 'Kepsek', 'Uuu', '', 'sdfd', 2),
(11, 'Kepala Sekolah', 'Keuangan', '', '', 4),
(12, 'Kepala Sekolah', 'Keamanan', '', '', 2),
(16, 'Wakil Kurikulum', 'Keuangan', '', 'Mohon ditindak lanjuti', 26),
(19, 'Kepala Sekolah', 'Keuangan', 'Segera tindak lanjuti gaji pegawai', '', 28),
(20, 'Kepala Sekolah', 'Keuangan', 'Segera tindak lanjuti gaji pegawai', '', 35);

-- --------------------------------------------------------

--
-- Table structure for table `indeks`
--

CREATE TABLE `indeks` (
  `id_indeks` int(3) NOT NULL,
  `kode_indeks` varchar(5) NOT NULL,
  `judul_indeks` varchar(50) NOT NULL,
  `detail` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indeks`
--

INSERT INTO `indeks` (`id_indeks`, `kode_indeks`, `judul_indeks`, `detail`) VALUES
(1, 'RNCN', 'Perencanaan', 'Pengumpulan data/pengelolaan data, Perumusan Informasi, Rencana pembangunan, Laporan bulanan/CAWU/tahunan/insidental, Statistik, Penambahan sekolah baru/jurusan baru, Kerjasama dengan sekolah lain/instansi lain, dll.'),
(2, 'UANG', 'Keuangan', 'Edit detail doang'),
(6, 'TTUSH', 'Ketata Usahaan', ''),
(10, 'SRN', 'Sarana dan Prasarana', ''),
(11, 'SENI', 'Kesenian', ''),
(19, 'PGW', 'Kepegawaian', ''),
(20, 'LNGKP', 'Perlengkapan', 'Ini detail perlengkapan'),
(21, 'ORG', 'Organisasi', 'Ini detail, hehe'),
(22, 'PNDDK', 'Pendidikan', ''),
(23, 'KRKLM', 'Kurikulum/Pengawasan', 'Ini detail kurikulum dan pengawasan dan'),
(24, 'OLRG', 'Olahraga', 'Mana detailnya gan coba tambah ya');

-- --------------------------------------------------------

--
-- Table structure for table `suratkeluar`
--

CREATE TABLE `suratkeluar` (
  `id_suratkeluar` int(5) NOT NULL,
  `no_suratkeluar` varchar(60) NOT NULL,
  `judul_suratkeluar` varchar(100) NOT NULL,
  `id_indeks` int(3) NOT NULL,
  `tujuan` varchar(60) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `keterangan` mediumtext NOT NULL,
  `berkas_suratkeluar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suratkeluar`
--

INSERT INTO `suratkeluar` (`id_suratkeluar`, `no_suratkeluar`, `judul_suratkeluar`, `id_indeks`, `tujuan`, `tanggal_keluar`, `keterangan`, `berkas_suratkeluar`) VALUES
(2, 'SK/H-09/2020/1', 'Contoh Surat Keluar', 1, 'UIN Sunan Kalijaga', '2020-09-30', '', 'suratkeluar_5f7479b72391c.docx');

-- --------------------------------------------------------

--
-- Table structure for table `suratmasuk`
--

CREATE TABLE `suratmasuk` (
  `id_suratmasuk` int(3) NOT NULL,
  `no_suratmasuk` varchar(60) NOT NULL,
  `judul_suratmasuk` varchar(100) NOT NULL,
  `asal_surat` varchar(60) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `id_indeks` int(3) NOT NULL,
  `keterangan` mediumtext NOT NULL,
  `berkas_suratmasuk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suratmasuk`
--

INSERT INTO `suratmasuk` (`id_suratmasuk`, `no_suratmasuk`, `judul_suratmasuk`, `asal_surat`, `tanggal_masuk`, `tanggal_diterima`, `id_indeks`, `keterangan`, `berkas_suratmasuk`) VALUES
(2, 'SM/2020/09/5f74530545766', 'Testing Surat Masuk', 'UIN SUSKA RIAU', '2020-09-30', '2020-09-30', 1, '', ''),
(3, 'SM/2020/09/5f74536c2b081', 'Testing Surat Masuk', 'UIN SUSKA RIAU', '2020-09-30', '2020-09-30', 1, '', ''),
(4, 'SM/2020/09/5f745372ce8f6', 'Testing Surat Masuk', 'UIN SUSKA RIAU', '2020-09-30', '2020-09-30', 1, '', ''),
(6, 'SM/2020/09/5f7478b223c0c', 'Testing Surat Masuk', 'UIN SUSKA RIAU', '2020-09-30', '2020-09-30', 6, '', 'suratmasuk_5f7478be698f8.docx');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `bio` varchar(512) NOT NULL,
  `facebook` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `image`, `bio`, `facebook`, `email`, `level`) VALUES
(10, 'uki', '$2y$10$W/PNaKC4ViySP.gapBbK1OxsS4wG3ROhZJ0vS/dEjyphuHeOTp0wW', 'Marzuki', 'profile_5f74b9b057952.png', 'Saya seorang programmer', '', 'marzukiberg@gmail.com', 1),
(11, 'rio', '$2y$10$l9bq8qfwIQY9R6/iVNLY6OZMkwH/EDegYuGKaxnHNztXBwGaBfF7W', 'Rio Ramadhan', '', 'Rio Ganteng', '', 'rio@gmail.com', 2),
(12, 'admin', '$2y$10$V.cZSj8F8/7963pufEdE1OKFoSR0yDM2LjQ.1N1R7vOKlBrG1Tcha', 'Admin', '', '', '', '', 2),
(13, 'superadmin', '$2y$10$xxW4f07m96SVaSjHguZBn./runnsS5XXIEXJCxHDrQnIb.60ryoOO', 'Superadmin', '', '', '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_suratmasuk` (`id_suratmasuk`);

--
-- Indexes for table `indeks`
--
ALTER TABLE `indeks`
  ADD PRIMARY KEY (`id_indeks`);

--
-- Indexes for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD PRIMARY KEY (`id_suratkeluar`),
  ADD KEY `id_subindeks` (`id_indeks`);

--
-- Indexes for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD PRIMARY KEY (`id_suratmasuk`),
  ADD KEY `id_subindeks` (`id_indeks`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `indeks`
--
ALTER TABLE `indeks`
  MODIFY `id_indeks` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `id_suratkeluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  MODIFY `id_suratmasuk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
