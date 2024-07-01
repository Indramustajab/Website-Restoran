-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 03:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trwebresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'Indra ', 'e24f6e3ce19ee0728ff1c443e4ff488d', 'Indra M');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_likes` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_likes`, `id_pelanggan`, `id_produk`) VALUES
(23, 4, 5),
(38, 4, 3),
(41, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) DEFAULT NULL,
  `password_pelanggan` varchar(50) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `telepon_pelanggan` varchar(15) DEFAULT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`, `foto_profil`) VALUES
(4, 'mus@gmail.com', 'd62ec24d065e424dd816ce7828f62584', 'Mus', '082344567', 'Kebon jeruk, Salatiga', '4.png'),
(7, 'tajab@gmail.com', '9deda61d12d2ddb3bce8c5e0f89d58b3', 'tajab', '089746373632', 'Bangarum, Salatiga', ''),
(8, 'diksa@gmail.comd', 'e6ad70497ac1980da784ea7f6685bb9f', 'diksa', '08967657667', 'Damatex fc', ''),
(12, 'a@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mbudi', '0888123321', 'jalan-jalan', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total_pembelian` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal_pembelian`, `jumlah_pembelian`, `ongkir`, `total_pembelian`, `id_pelanggan`) VALUES
(28, '2023-03-27', 15000, 1000, 16000, 4),
(29, '2023-03-28', 4000, 1000, 5000, 4),
(30, '2023-03-28', 20000, 1000, 21000, 4),
(31, '2023-03-28', 7000, 1000, 8000, 4),
(32, '2023-03-31', 15000, 1000, 16000, 4),
(33, '2023-03-31', 10000, 1000, 11000, 4),
(34, '2023-03-31', 4000, 1000, 5000, 4),
(35, '2023-03-31', 20000, 1000, 21000, 4),
(36, '2023-03-31', 20000, 1000, 21000, 4),
(37, '2023-03-31', 20000, 1000, 21000, 4),
(38, '2023-03-31', 15000, 1000, 16000, 4),
(39, '2023-03-31', 15000, 1000, 16000, 4),
(40, '2023-03-31', 20000, 1000, 21000, 4),
(41, '2023-03-31', 10000, 1000, 11000, 4),
(42, '2023-03-31', 15000, 1000, 16000, 4),
(43, '2023-03-31', 15000, 1000, 16000, 4),
(44, '2023-03-31', 15000, 1000, 16000, 4),
(45, '2023-03-31', 15000, 1000, 16000, 4),
(46, '2023-03-31', 4000, 1000, 5000, 4),
(47, '2023-03-31', 15000, 1000, 16000, 4),
(48, '2023-03-31', 20000, 1000, 21000, 4),
(49, '2023-03-31', 15000, 1000, 16000, 7),
(50, '2023-03-31', 10000, 1000, 11000, 8),
(51, '2023-03-31', 20000, 1000, 21000, 4),
(52, '2023-03-31', 15000, 1000, 16000, 4),
(53, '2023-03-31', 10000, 1000, 11000, 4),
(54, '2023-04-07', 19000, 2000, 21000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `jumlah`, `id_pembelian`, `id_produk`) VALUES
(33, 1, 28, 1),
(34, 1, 29, 6),
(35, 1, 30, 3),
(36, 1, 31, 12),
(37, 1, 32, 1),
(38, 1, 33, 2),
(39, 1, 34, 6),
(40, 1, 35, 3),
(41, 1, 36, 3),
(42, 1, 37, 3),
(43, 1, 38, 1),
(44, 1, 39, 1),
(45, 1, 40, 3),
(46, 1, 41, 2),
(47, 1, 42, 8),
(48, 1, 43, 1),
(49, 1, 44, 1),
(50, 1, 45, 1),
(51, 1, 46, 6),
(52, 1, 47, 1),
(53, 1, 48, 3),
(54, 1, 49, 1),
(55, 1, 50, 2),
(56, 1, 51, 3),
(57, 1, 52, 1),
(58, 1, 53, 2),
(59, 1, 54, 8),
(60, 1, 54, 6);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `foto_produk` varchar(100) DEFAULT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `id_warung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok`, `foto_produk`, `deskripsi_produk`, `likes`, `id_warung`) VALUES
(1, 'Nasi Goreng', 15000, 11, '7.jpg', '																																	Nasi Goreng enak dengan campuran telor, sosis, baso	dan ayam																					', 2, 1),
(2, 'Bakso', 10000, 8, '9.jpg', '			Bakso yang terbuat dari daging sapi berkualitas dan halal, dijamin sehat		', 2, 2),
(3, 'Ayam Kecap', 20000, 3, '6.jpg', '			Menggunakan daging segar yang sehat dan lezzat		', 2, 3),
(4, 'Es Teh', 5000, 10, '11.jpg', '			Teh segar pengobat dahaga		', 2, 3),
(5, 'Soto Ayam', 12000, 16, '5.jpg', 'Soto kuah bening dengan isian daging ayam', 4, 1),
(6, 'Es Jeruk', 4000, 12, '12.jpg', 'Terbuat dari jeruk alami yang sehat dan manis', 2, 1),
(7, 'Kopi Jos', 6000, 10, '16.jpg', '			Terbuat dari kopi pilihan yaitu kopi kapal api		', 1, 2),
(8, 'Martabak', 15000, 12, '10.jpg', 'Martabak telor dengan campuran daging dan kornet', 0, 2),
(9, 'Sup Buah', 15000, 16, '13.jpg', '			Es buah dengan campuran beraneka buah-buahan dan kuah sirup		', 0, 3),
(10, 'Sate Ayam', 11000, 16, '1.jpg', 'Sate ayam lezat dengan bumbu kacang', 0, 1),
(11, 'Gado gado', 14000, 16, '2.jpg', 'Gado gado lengkap sayuran dan telor', 0, 2),
(12, 'Kopi Susu', 7000, 10, '15.jpg', '						Kopi nikmat penambah stamina				', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `warung`
--

CREATE TABLE `warung` (
  `id_warung` int(11) NOT NULL,
  `nama_warung` varchar(50) DEFAULT NULL,
  `alamat_warung` varchar(100) NOT NULL,
  `telepon_warung` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warung`
--

INSERT INTO `warung` (`id_warung`, `nama_warung`, `alamat_warung`, `telepon_warung`) VALUES
(1, 'FastFood.net Tegal', 'Tegal, Salatiga', '0823456744'),
(2, 'FastFood.net Kemiri', 'Kemiri, Salatiga', '0823445675458'),
(3, 'FastFood.net Kauman', 'Kauman, Salatiga', '08234567885');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_likes`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_warung` (`id_warung`);

--
-- Indexes for table `warung`
--
ALTER TABLE `warung`
  ADD PRIMARY KEY (`id_warung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_likes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `warung`
--
ALTER TABLE `warung`
  MODIFY `id_warung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `pembelian_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_warung`) REFERENCES `warung` (`id_warung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
