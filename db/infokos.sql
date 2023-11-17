-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 04:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infokos`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `hitungan_sewa` int(11) NOT NULL,
  `durasi_sewa` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_kost` int(11) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `panjang_kamar` int(11) NOT NULL,
  `lebar_kamar` int(11) NOT NULL,
  `tipe_kamar` varchar(255) NOT NULL,
  `biaya_fasilitas` int(11) NOT NULL,
  `fasilitas_kamar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id_kost` int(11) NOT NULL,
  `nama_kost` varchar(255) NOT NULL,
  `tipe_kost` varchar(255) NOT NULL,
  `jenis_kost` varchar(255) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `tanggal_tagih` date NOT NULL,
  `nama_pemilik` text NOT NULL,
  `nama_bank` text NOT NULL,
  `no_rekening` int(11) NOT NULL,
  `foto_bangunan_utama` varchar(255) NOT NULL,
  `foto_kamar` varchar(255) NOT NULL,
  `foto_kamar_mandi` varchar(255) NOT NULL,
  `foto_interior` varchar(255) NOT NULL,
  `provinsi` varchar(25) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `kelurahan` varchar(25) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `fasilitas_kost` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_kost` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles_user`
--

CREATE TABLE `roles_user` (
  `id_roles` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `no_tagihan` int(11) NOT NULL,
  `no_booking` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `stats` int(11) NOT NULL,
  `tanggal_tagihan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `foto_profil` text NOT NULL,
  `roles` int(11) NOT NULL,
  `id_kost_saya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_kost` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_user` (`id_user`,`id_kamar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_kost` (`id_kost`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id_kost`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_kost` (`id_kost`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `roles_user`
--
ALTER TABLE `roles_user`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`no_tagihan`),
  ADD KEY `no_booking` (`no_booking`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles` (`roles`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_kost` (`id_kost`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id_kost` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles_user`
--
ALTER TABLE `roles_user`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `no_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_booking`) REFERENCES `tagihan` (`no_booking`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_kost`) REFERENCES `kost` (`id_kost`);

--
-- Constraints for table `kost`
--
ALTER TABLE `kost`
  ADD CONSTRAINT `kost_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `kost_ibfk_2` FOREIGN KEY (`id_kost`) REFERENCES `wishlist` (`id_kost`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_kost`) REFERENCES `kost` (`id_kost`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roles`) REFERENCES `roles_user` (`id_roles`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
