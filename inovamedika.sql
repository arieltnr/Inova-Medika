-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Jul 2022 pada 10.26
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inovamedika`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE IF NOT EXISTS `obat` (
  `id_obt` char(11) NOT NULL,
  `nama_obt` varchar(30) NOT NULL,
  `jenis_obt` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obt`, `nama_obt`, `jenis_obt`, `harga`) VALUES
('O01', 'Obeha Komix', 'Batuk & Flu', 6000),
('O02', 'Paracetamol', 'Demam', 7000),
('O03', 'Freshcare', 'Minyak Angin', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `id_psn` int(11) NOT NULL,
  `nik` int(16) NOT NULL,
  `nama_psn` varchar(50) NOT NULL,
  `gender_psn` enum('Pria','Wanita') NOT NULL,
  `alamat_psn` text NOT NULL,
  `usia` int(11) NOT NULL,
  `no_hp` char(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_psn`, `nik`, `nama_psn`, `gender_psn`, `alamat_psn`, `usia`, `no_hp`) VALUES
(1, 838840, 'Sasa', 'Wanita', 'Cibiru', 19, '083248487'),
(3, 24455665, 'Ijah', 'Wanita', 'Cicalengka', 44, '82345758'),
(4, 858758478, 'Hendra', 'Pria', 'Karawangn', 81, '221394848'),
(6, 3424823, 'Mintarsih', 'Wanita', 'Lebak Bulus', 31, '0873748954'),
(7, 63466382, 'Gunawan', 'Pria', 'Tanjung Sari', 24, '0213385856');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_krywn` int(11) NOT NULL,
  `nip` int(20) NOT NULL,
  `nama_krywn` varchar(50) NOT NULL,
  `gender_krywn` enum('Pria','Wanita') NOT NULL,
  `alamat_krywn` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_krywn`, `nip`, `nama_krywn`, `gender_krywn`, `alamat_krywn`) VALUES
(1, 11111, 'Bambang', 'Pria', 'Cikarang Selatan'),
(2, 22222, 'Susi', 'Wanita', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `id_pdf` char(10) NOT NULL,
  `nik` int(20) NOT NULL,
  `tgl_pdf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` int(11) NOT NULL,
  `ket` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pdf`, `nik`, `tgl_pdf`, `total`, `ket`) VALUES
('P01', 838840, '2022-07-15 02:40:33', 306000, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian_daftar`
--

CREATE TABLE IF NOT EXISTS `rincian_daftar` (
  `id_rc` int(11) NOT NULL,
  `id_pdf` char(10) NOT NULL,
  `id_tdk` char(10) NOT NULL,
  `id_obt` char(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rincian_daftar`
--

INSERT INTO `rincian_daftar` (`id_rc`, `id_pdf`, `id_tdk`, `id_obt`) VALUES
(11, 'P01', 'T07', 'O01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindakan`
--

CREATE TABLE IF NOT EXISTS `tindakan` (
  `id_tdk` char(10) NOT NULL,
  `nama_tdk` varchar(30) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tindakan`
--

INSERT INTO `tindakan` (`id_tdk`, `nama_tdk`, `biaya`) VALUES
('T01', 'Operasi', 400000),
('T02', 'Rawat Inap', 100000),
('T03', 'UGD', 200000),
('T05', 'Cek Darah', 20000),
('T06', 'Suntik Imun', 30000),
('T07', 'Persalinan', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nip` int(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('Admin','Operator') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nip`, `password`, `level`) VALUES
(1, 11111, 'admin123', 'Admin'),
(2, 22222, 'operator123', 'Operator'),
(4, 33333, 'iisdahlia', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obt`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_psn`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_krywn`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pdf`);

--
-- Indexes for table `rincian_daftar`
--
ALTER TABLE `rincian_daftar`
  ADD PRIMARY KEY (`id_rc`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tdk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_psn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_krywn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rincian_daftar`
--
ALTER TABLE `rincian_daftar`
  MODIFY `id_rc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
