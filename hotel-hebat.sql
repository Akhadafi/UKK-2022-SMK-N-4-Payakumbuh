-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2022 pada 06.02
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

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
-- Struktur dari tabel `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `fasilitas_kamar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`fasilitas_kamar`) VALUES
('PC'),
('TV'),
('WC'),
('Wifi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `no_kamar` varchar(10) NOT NULL,
  `tipe_kamar` varchar(50) NOT NULL,
  `status_kamar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`no_kamar`, `tipe_kamar`, `status_kamar`) VALUES
('KMR 003', 'Superior', 'Tersedia'),
('KMR 004', 'Superior', 'Dihuni');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `kode_pesanan` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `no_kamar` varchar(10) NOT NULL,
  `status_pesanan` varchar(50) NOT NULL,
  `id_cekin` date NOT NULL,
  `id_cekout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_kamar`
--

CREATE TABLE `status_kamar` (
  `status_kamar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_kamar`
--

INSERT INTO `status_kamar` (`status_kamar`) VALUES
('Dihuni'),
('Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `status_pesanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_pesanan`
--

INSERT INTO `status_pesanan` (`status_pesanan`) VALUES
('Sedang Memesan'),
('Sudah Memesan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_fasilitas_kamar`
--

CREATE TABLE `tipe_fasilitas_kamar` (
  `tipe_kamar` varchar(50) NOT NULL,
  `fasilitas_kamar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_fasilitas_kamar`
--

INSERT INTO `tipe_fasilitas_kamar` (`tipe_kamar`, `fasilitas_kamar`) VALUES
('Dulex', 'WC'),
('Superior', 'Wifi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `tipe_kamar` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`tipe_kamar`, `harga`) VALUES
('Dulex', 'Rp. 100.000 / hari'),
('Superior', 'Rp. 150.000 / hari'),
('VIP', 'Rp. 300.000 / hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `gambar`, `role`, `nama`, `no_hp`, `alamat`) VALUES
('admin', '$2y$10$tC2dbfPxFaLoT3pPhli/x.WDNzbWbFdWb2CVysmKVqWYw5ay.0DEe', '62235f7cc3fef.jpg', 'Admin', 'A Khadafi', '08', 'aa'),
('deni@gmail.com', '$2y$10$lE1Qctfmpgr6y1hqtoZYMuYIjlPkt4Jt8AZwmQNr0i5vTe/FKi99O', '6224a039d354b.jpg', 'Resepsionis', 'deni irawan', '08', 'batu bolang'),
('ehey', '$2y$10$aWtyITIS5IlJ22J.q4ivHOm6jlCXZNJU/hj2g8cpwgZfSJvhs0eH6', '6224388dde1f5.jpg', 'Tamu', 'awokkowkok', '08', 'aaa'),
('lailatulhusna@gmail.com', '$2y$10$45cvJbZUO07.pGp240R1xeY.QCGlf7Oo6QwtNTZa7hsudveoFTYwW', '62245a59af492.jpg', 'Resepsionis', 'Nana', '08', 'koto panjang'),
('nana', '$2y$10$s5l4ihQypPmmcWgohvvKFu8WpkqRcnaW75V2.jNzr1TAY8DsI2D4y', '62235ceeefaca.jpg', 'Tamu', 'Nana', '08', 'bb');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`fasilitas_kamar`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no_kamar`),
  ADD KEY `tipe_kamar` (`tipe_kamar`),
  ADD KEY `id_status_kamar` (`status_kamar`),
  ADD KEY `status_kamar` (`status_kamar`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`kode_pesanan`),
  ADD KEY `username` (`username`,`no_kamar`,`status_pesanan`),
  ADD KEY `no_kamar` (`no_kamar`),
  ADD KEY `status_pesanan` (`status_pesanan`);

--
-- Indeks untuk tabel `status_kamar`
--
ALTER TABLE `status_kamar`
  ADD PRIMARY KEY (`status_kamar`);

--
-- Indeks untuk tabel `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`status_pesanan`);

--
-- Indeks untuk tabel `tipe_fasilitas_kamar`
--
ALTER TABLE `tipe_fasilitas_kamar`
  ADD PRIMARY KEY (`tipe_kamar`,`fasilitas_kamar`),
  ADD KEY `tipe_kamar` (`tipe_kamar`,`fasilitas_kamar`),
  ADD KEY `id_fasilitas_kamar` (`fasilitas_kamar`);

--
-- Indeks untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`tipe_kamar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`tipe_kamar`) REFERENCES `tipe_fasilitas_kamar` (`tipe_kamar`) ON DELETE CASCADE,
  ADD CONSTRAINT `kamar_ibfk_2` FOREIGN KEY (`status_kamar`) REFERENCES `status_kamar` (`status_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`no_kamar`) REFERENCES `kamar` (`no_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`status_pesanan`) REFERENCES `status_pesanan` (`status_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tipe_fasilitas_kamar`
--
ALTER TABLE `tipe_fasilitas_kamar`
  ADD CONSTRAINT `tipe_fasilitas_kamar_ibfk_1` FOREIGN KEY (`tipe_kamar`) REFERENCES `tipe_kamar` (`tipe_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipe_fasilitas_kamar_ibfk_2` FOREIGN KEY (`fasilitas_kamar`) REFERENCES `fasilitas_kamar` (`fasilitas_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
