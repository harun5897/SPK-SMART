-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2022 at 06:07 AM
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
(1, 'komputer', 35),
(2, 'pendidikan', 30),
(3, 'pengalaman', 20),
(4, 'kendaraan', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tabelpenilaian`
--

CREATE TABLE `tabelpenilaian` (
  `idPenilaian` int(9) NOT NULL,
  `idPeserta` int(9) NOT NULL,
  `kriteriaKomputer` int(9) NOT NULL,
  `kriteriaPendidikan` int(9) NOT NULL,
  `kriteriaPengalaman` int(9) NOT NULL,
  `kriteraKendaraan` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabelpenilaian`
--

INSERT INTO `tabelpenilaian` (`idPenilaian`, `idPeserta`, `kriteriaKomputer`, `kriteriaPendidikan`, `kriteriaPengalaman`, `kriteraKendaraan`) VALUES
(21, 4, 100, 80, 80, 80),
(22, 6, 100, 80, 80, 100),
(23, 7, 100, 60, 100, 100),
(24, 8, 100, 60, 100, 100);

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
(7, 'Bambang', 'Cahyo', '123456789', '1996-08-08', 'laki-laki', 'islam', 'tanjung pinang ', 'ari@gmail.com', '0987654321'),
(8, 'Clara', 'Prisilia', '098765432', '1997-08-05', 'perempuan', 'Islam', 'Tanjung Pinang ', 'clara@gmail.com', '081246781959');

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
  MODIFY `idKriteria` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tabelpenilaian`
--
ALTER TABLE `tabelpenilaian`
  MODIFY `idPenilaian` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
