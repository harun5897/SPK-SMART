-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 08:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabelkriteria`
--

CREATE TABLE `tabelkriteria` (
  `idKriteria` int(9) NOT NULL,
  `namaKriteria` varchar(255) NOT NULL,
  `bobotKriteria` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelkriteria`
--

INSERT INTO `tabelkriteria` (`idKriteria`, `namaKriteria`, `bobotKriteria`) VALUES
(10, 'Komputer', 35),
(11, 'Pendidikan', 30),
(12, 'Pengalaman\r\n', 20),
(13, 'Kendaraan', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tabelpenilaian`
--

CREATE TABLE `tabelpenilaian` (
  `idPenilaian` int(9) NOT NULL,
  `idPeserta` int(9) NOT NULL,
  `idKriteria` int(9) NOT NULL,
  `nilaiKriteria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelpenilaian`
--

INSERT INTO `tabelpenilaian` (`idPenilaian`, `idPeserta`, `idKriteria`, `nilaiKriteria`) VALUES
(39, 4, 10, '100'),
(40, 4, 11, '100'),
(41, 4, 12, '100'),
(42, 4, 13, '100'),
(43, 6, 10, '80'),
(44, 6, 11, '90'),
(45, 6, 12, '90'),
(46, 6, 13, '90'),
(51, 7, 10, '80'),
(52, 7, 11, '100'),
(53, 7, 12, '80'),
(54, 7, 13, '100');

-- --------------------------------------------------------

--
-- Table structure for table `tabelpeserta`
--

CREATE TABLE `tabelpeserta` (
  `idPeserta` int(9) NOT NULL,
  `namaDepan` varchar(255) NOT NULL,
  `namaBelakang` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tanggalLahir` varchar(255) NOT NULL,
  `jenisKelamin` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelpeserta`
--

INSERT INTO `tabelpeserta` (`idPeserta`, `namaDepan`, `namaBelakang`, `nik`, `tanggalLahir`, `jenisKelamin`, `agama`, `alamat`, `email`, `kontak`) VALUES
(4, 'Andika', 'Pratama', '123456789', '1993-08-08', 'laki-laki', 'islam', 'Yogyakarta ', 'joko@gmail.com', '+62 081360271959'),
(6, 'Angelia', 'Purnama', '123456789', '1997-08-05', 'perempuan', 'Islam', ' Tanjung Pinang', 'rudi@gmail.com', '081660271959'),
(7, 'Bambang', 'Cahyo', '123456789', '1996-08-08', 'laki-laki', 'islam', 'tanjung pinang ', 'ari@gmail.com', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `tabeluser`
--

CREATE TABLE `tabeluser` (
  `idUser` int(9) NOT NULL,
  `namaUser` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kataSandi` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabeluser`
--

INSERT INTO `tabeluser` (`idUser`, `namaUser`, `email`, `kataSandi`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345', 'superAdmin'),
(8, 'adminKedua', 'adminkedua@gmail.com', '12345', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabelkriteria`
--
ALTER TABLE `tabelkriteria`
  ADD PRIMARY KEY (`idKriteria`);

--
-- Indexes for table `tabelpenilaian`
--
ALTER TABLE `tabelpenilaian`
  ADD PRIMARY KEY (`idPenilaian`);

--
-- Indexes for table `tabelpeserta`
--
ALTER TABLE `tabelpeserta`
  ADD PRIMARY KEY (`idPeserta`);

--
-- Indexes for table `tabeluser`
--
ALTER TABLE `tabeluser`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabelkriteria`
--
ALTER TABLE `tabelkriteria`
  MODIFY `idKriteria` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tabelpenilaian`
--
ALTER TABLE `tabelpenilaian`
  MODIFY `idPenilaian` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tabelpeserta`
--
ALTER TABLE `tabelpeserta`
  MODIFY `idPeserta` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tabeluser`
--
ALTER TABLE `tabeluser`
  MODIFY `idUser` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
