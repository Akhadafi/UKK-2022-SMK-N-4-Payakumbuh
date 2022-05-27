-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 06:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel-hebat`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id`, `id_kamar`, `fasilitas`, `gambar`) VALUES
(31, 34, 'AC Pendingin Ruang', '627bdc8b5842c.jpg'),
(32, 34, 'Wifi', '627bdc9d060f8.jpg'),
(33, 34, 'TV', '627bdcb641aa7.jpg'),
(34, 34, 'Sofa', '627bdcca6386b.jpg'),
(35, 1, 'AC Pendingin Ruang', '627bdd8a6b2c4.jpg'),
(36, 1, 'TV', '627bdda72a737.jpg'),
(37, 1, 'Sofa', '627bddbcf2857.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_umum`
--

CREATE TABLE `fasilitas_umum` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_umum`
--

INSERT INTO `fasilitas_umum` (`id`, `nama_fasilitas`, `keterangan`, `gambar`) VALUES
(13, '3 Kolam renang', 'Kolam renang anak-anak dan dewasa', '627be042ccbd8.jpg'),
(14, 'LapanganBadminton', 'Bermain bersama', '627be079ddd38.jpeg'),
(15, 'TempatSantai', 'Menikmati suasana hotel', '627be0b2eb73e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `total_kamar` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `total_kamar`) VALUES
(1, 'Superior', 8),
(34, 'Deluxe', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `jml_kamar` int(2) NOT NULL,
  `status` enum('Sedang Diproses','Telah Diproses') NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pemesan`, `email`, `hp`, `nama_tamu`, `tgl_pesan`, `checkin`, `checkout`, `jml_kamar`, `status`, `id_kamar`) VALUES
(24, 'dd', 'budi@gmail.com', '00000', 'vc', '0000-00-00 00:00:00', '2022-05-17', '2022-05-26', 1, 'Telah Diproses', 34),
(25, 'asu', 'budi@gmail.com', '0800', 'nana', '0000-00-00 00:00:00', '2022-05-18', '2022-05-19', 1, 'Sedang Diproses', 1),
(26, 'aaddd', 'budi@gmail.com', '0800', 'ww', '0000-00-00 00:00:00', '2022-05-18', '2022-05-20', 2, 'Sedang Diproses', 1),
(27, 'Si Anu', 'aa@gmail.com', '0800', 'ww', '2022-05-17 02:34:54', '2022-05-18', '2022-05-20', 1, 'Sedang Diproses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `role` enum('Admin','Resepsionis','Tamu','') NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `gambar`, `role`, `nama`, `no_hp`, `alamat`) VALUES
('admin', '$2y$10$HWFmRbo9r/vbGEZ3lav50eW6ZGcDkiGLy34qdkr7L5Y1rZEttTtPu', '6263ef68bf766.jpg', 'Admin', 'A Khadafi', '082200000000', 'padang sikabu'),
('resepsionis', '$2y$10$3UvvXTt1xWt3cZYOpA8jVOqaQ/KdFJlH8KOG3C3G7x7Bf6jyOfyVe', '626624a565842.jpg', 'Resepsionis', 'Khadafi', '08', 'sikabu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD CONSTRAINT `fasilitas_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
