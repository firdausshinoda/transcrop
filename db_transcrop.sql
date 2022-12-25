-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 03:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_transcrop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(42) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` int(10) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `an_bank` varchar(20) DEFAULT NULL,
  `foto_bank` varchar(20) DEFAULT NULL,
  `norek_bank` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id_chat` int(10) NOT NULL,
  `kd_chat` varchar(20) DEFAULT NULL,
  `id_user_send` int(10) DEFAULT NULL,
  `id_user_receiver` int(10) DEFAULT NULL,
  `isi` mediumtext DEFAULT NULL,
  `nama_kendaraan` varchar(30) DEFAULT '0',
  `foto_kendaraan` text DEFAULT '0',
  `send_by_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cv`
--

CREATE TABLE `tb_cv` (
  `id_cv` int(10) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `kd_cv` varchar(100) DEFAULT NULL,
  `nama_cv` varchar(100) DEFAULT NULL,
  `deskripsi_cv` longtext DEFAULT NULL,
  `foto_cv` longtext DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `alamat_cv` longtext DEFAULT NULL,
  `skdp` longtext DEFAULT NULL,
  `siup` longtext DEFAULT NULL,
  `ratting_cv` varchar(10) DEFAULT '0',
  `lt_cv` longtext DEFAULT NULL,
  `lg_cv` longtext DEFAULT NULL,
  `nama_bank` varchar(20) DEFAULT NULL,
  `norek_bank` varchar(20) DEFAULT NULL,
  `an_bank` varchar(20) DEFAULT NULL,
  `stt_cv` enum('MENUNGGU','DITERIMA','DITOLAK') NOT NULL DEFAULT 'MENUNGGU',
  `stt_ulasan` mediumtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `del_flage` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cv_ulasan`
--

CREATE TABLE `tb_cv_ulasan` (
  `id_cv_ulasan` int(10) NOT NULL,
  `id_pemesanan` int(10) DEFAULT NULL,
  `id_cv` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `ratting_ulasan` int(1) DEFAULT NULL,
  `isi_ulasan` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_barang`
--

CREATE TABLE `tb_jenis_barang` (
  `id_jenis_barang` int(10) NOT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_kendaraan`
--

CREATE TABLE `tb_jenis_kendaraan` (
  `id_jenis_kendaraan` int(10) NOT NULL,
  `jenis_kendaraan` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(10) NOT NULL,
  `id_cv` int(10) DEFAULT NULL,
  `id_jenis_kendaraan` int(10) DEFAULT NULL,
  `nama_kendaraan` longtext DEFAULT NULL,
  `deskripsi_kendaraan` longtext DEFAULT NULL,
  `jenis_angkut` varchar(200) DEFAULT NULL,
  `harga_perkm` int(20) DEFAULT NULL,
  `foto_kendaraan` longtext DEFAULT NULL,
  `ratting_kendaraan` varchar(10) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan_ulasan`
--

CREATE TABLE `tb_kendaraan_ulasan` (
  `id_kendaraan_ulasan` int(10) NOT NULL,
  `id_kendaraan` int(10) DEFAULT NULL,
  `id_pemesanan` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `ratting_ulasan` int(1) DEFAULT NULL,
  `isi_ulasan` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kritiksaran`
--

CREATE TABLE `tb_kritiksaran` (
  `id_kritiksaran` int(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `isi` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(50) NOT NULL,
  `kd_pemesanan` varchar(200) DEFAULT NULL,
  `id_user` int(50) DEFAULT NULL,
  `id_cv` int(50) DEFAULT NULL,
  `id_kendaraan` int(50) DEFAULT NULL,
  `id_bank` int(50) DEFAULT NULL,
  `alamat_berangkat` longtext DEFAULT NULL,
  `alamat_tujuan` longtext DEFAULT NULL,
  `lt_berangkat` longtext DEFAULT NULL,
  `lt_tujuan` longtext DEFAULT NULL,
  `lg_berangkat` longtext DEFAULT NULL,
  `lg_tujuan` longtext DEFAULT NULL,
  `deskripsi_berangkat` longtext DEFAULT NULL,
  `deskripsi_tujuan` longtext DEFAULT NULL,
  `deskripsi_barang` mediumtext DEFAULT NULL,
  `total_kendaraan` int(50) DEFAULT NULL,
  `jarak` int(50) DEFAULT NULL,
  `berat_barang` varchar(50) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `harga_tol` int(255) DEFAULT 0,
  `harga_total` int(255) DEFAULT 0,
  `foto_pembayaran` longtext DEFAULT NULL,
  `avoid` varchar(20) DEFAULT NULL,
  `memo_df` int(1) DEFAULT NULL,
  `stt_pemesanan` enum('MENUNGGU','MENUNGGU KONFIRMASI PEMESAN','TERKONFIRMASI','MENUNGGU KONFIRMASI PEMBAYARAN','PEMBAYARAN TERKONFIRMASI','DIANTARKAN','SELESAI','DITOLAK','DIBATALKAN') NOT NULL DEFAULT 'MENUNGGU',
  `isi_ulasan` mediumtext DEFAULT NULL,
  `ratting_ulasan` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan_sopir`
--

CREATE TABLE `tb_pemesanan_sopir` (
  `id_pemesanan_sopir` int(10) NOT NULL,
  `id_pemesanan` int(10) DEFAULT NULL,
  `id_sopir` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` int(10) NOT NULL,
  `nama` mediumtext DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sim`
--

CREATE TABLE `tb_sim` (
  `id_sim` int(10) NOT NULL,
  `nama_sim` varchar(20) DEFAULT NULL,
  `keterangan` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sopir`
--

CREATE TABLE `tb_sopir` (
  `id_sopir` int(50) NOT NULL,
  `id_cv` int(50) DEFAULT NULL,
  `id_user` int(50) DEFAULT NULL,
  `id_sim` int(10) DEFAULT NULL,
  `kd_sopir` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pengalaman` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `id_google` longtext DEFAULT NULL,
  `id_fb` longtext DEFAULT NULL,
  `token_firebase` mediumtext DEFAULT NULL,
  `kd_user` varchar(10) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT 'Laki-Laki',
  `password` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `foto_user` longtext DEFAULT NULL,
  `alamat_user` longtext DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `lt_user` varchar(300) DEFAULT '-6.8705694',
  `lg_user` varchar(300) DEFAULT '109.0822199',
  `stt_verifikasi` enum('MENUNGGU','TERKONFIRMASI') DEFAULT 'TERKONFIRMASI',
  `stt_login` enum('FB','GOOGLE','TRANS-CROP') NOT NULL DEFAULT 'TRANS-CROP',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `del_flage` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `tb_cv`
--
ALTER TABLE `tb_cv`
  ADD PRIMARY KEY (`id_cv`);

--
-- Indexes for table `tb_cv_ulasan`
--
ALTER TABLE `tb_cv_ulasan`
  ADD PRIMARY KEY (`id_cv_ulasan`);

--
-- Indexes for table `tb_jenis_barang`
--
ALTER TABLE `tb_jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `tb_jenis_kendaraan`
--
ALTER TABLE `tb_jenis_kendaraan`
  ADD PRIMARY KEY (`id_jenis_kendaraan`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `tb_kendaraan_ulasan`
--
ALTER TABLE `tb_kendaraan_ulasan`
  ADD PRIMARY KEY (`id_kendaraan_ulasan`);

--
-- Indexes for table `tb_kritiksaran`
--
ALTER TABLE `tb_kritiksaran`
  ADD PRIMARY KEY (`id_kritiksaran`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tb_pemesanan_sopir`
--
ALTER TABLE `tb_pemesanan_sopir`
  ADD PRIMARY KEY (`id_pemesanan_sopir`);

--
-- Indexes for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `tb_sim`
--
ALTER TABLE `tb_sim`
  ADD PRIMARY KEY (`id_sim`);

--
-- Indexes for table `tb_sopir`
--
ALTER TABLE `tb_sopir`
  ADD PRIMARY KEY (`id_sopir`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id_bank` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id_chat` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cv`
--
ALTER TABLE `tb_cv`
  MODIFY `id_cv` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cv_ulasan`
--
ALTER TABLE `tb_cv_ulasan`
  MODIFY `id_cv_ulasan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jenis_barang`
--
ALTER TABLE `tb_jenis_barang`
  MODIFY `id_jenis_barang` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jenis_kendaraan`
--
ALTER TABLE `tb_jenis_kendaraan`
  MODIFY `id_jenis_kendaraan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kendaraan_ulasan`
--
ALTER TABLE `tb_kendaraan_ulasan`
  MODIFY `id_kendaraan_ulasan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kritiksaran`
--
ALTER TABLE `tb_kritiksaran`
  MODIFY `id_kritiksaran` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pemesanan_sopir`
--
ALTER TABLE `tb_pemesanan_sopir`
  MODIFY `id_pemesanan_sopir` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `id_pengaturan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sim`
--
ALTER TABLE `tb_sim`
  MODIFY `id_sim` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sopir`
--
ALTER TABLE `tb_sopir`
  MODIFY `id_sopir` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
