-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2022 at 11:34 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thira`
--

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(45) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `kabupaten` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `deskripsi` text CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id`, `id_user`, `nama`, `kecamatan`, `kabupaten`, `provinsi`, `deskripsi`, `foto`) VALUES
(1, 1, 'Sukamiskin', 'Dinoloyo', 'Pacitan', 'Jawa Timur', 'Desa yang diapit tebing sehingga cocok untuk pariwisata bernuansa hutan rimbun yang sejuk', '1662887376_1a84b3c70d284b28dbc3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `info_desa`
--

CREATE TABLE `info_desa` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(45) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `kabupaten` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `deskripsi` text CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `info_desa`
--

INSERT INTO `info_desa` (`id`, `id_user`, `nama`, `kecamatan`, `kabupaten`, `provinsi`, `deskripsi`, `foto`) VALUES
(4, 1, 'Sukamiskin', 'Dinoloyo', 'Pacitan', 'Jawa Timur', 'Desa yang diapit tebing sehingga cocok untuk pariwisata bernuansa hutan rimbun yang sejuk', '1662887376_1a84b3c70d284b28dbc3.jpg'),
(5, 1, 'Karo atas', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '', '1662981484_06775edc1123e6017ac7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int NOT NULL,
  `id_lahan` int NOT NULL,
  `email` varchar(45) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `id_lahan`, `email`, `isi`) VALUES
(1, 2, 'xkunthil18@gmail.com', 'desa ini memang sebagus itu untuk dijadikan tempat healing');

-- --------------------------------------------------------

--
-- Table structure for table `lahan`
--

CREATE TABLE `lahan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `desa_id` int NOT NULL,
  `kategori` varchar(45) NOT NULL,
  `kepemilikan` varchar(45) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `dusun` varchar(45) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `kabupaten` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `lahan`
--

INSERT INTO `lahan` (`id`, `user_id`, `desa_id`, `kategori`, `kepemilikan`, `alamat_lengkap`, `dusun`, `kecamatan`, `kabupaten`, `provinsi`, `latitude`, `longitude`, `deskripsi`, `foto`) VALUES
(1, 1, 4, 'Kebun', 'PT Asri Welas Tbk', 'Jl Suronoto Jl Kaliwungu, Dinoloyo.', 'Sukamiskin', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '-0.875503323115', '119.92469787597', '', '1662981972_fac5597c15871ddb96b2.jpg'),
(2, 1, 5, 'Kebun', 'PT Suroboyo Indah', 'Jl Bulinatan tengah, Dinoloyo.', 'Karo atas', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '-0.832024179099', '119.91800308227', '', '1662981421_57cd02048dca82277f7c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE `petani` (
  `id` int NOT NULL,
  `id_lahan` int NOT NULL,
  `nama_lengkap` varchar(45) NOT NULL,
  `no_telepon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`id`, `id_lahan`, `nama_lengkap`, `no_telepon`) VALUES
(1, 1, 'Sukamtomoto', '089622222');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(45) NOT NULL,
  `role` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(1, '1234', '$2y$10$08pxm8ToqyvdpF68nN/V8evAKV/iDHtzJZjAAcB3zSuyJJYtJY0wa', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `desa_id` int NOT NULL,
  `nama_wisata` varchar(45) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `kategori` varchar(45) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `dusun` varchar(45) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `kabupaten` varchar(45) NOT NULL,
  `provinsi` varchar(45) NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id`, `user_id`, `desa_id`, `nama_wisata`, `kategori`, `alamat_lengkap`, `dusun`, `kecamatan`, `kabupaten`, `provinsi`, `latitude`, `longitude`, `deskripsi`, `foto`) VALUES
(2, 1, 4, 'Petapaan Naruto bin Minato Namikaze', 'pegunungan', 'Jl. Mawar Melati, Jl. Anggrek Basi, No. 234, Dinoloyo, Pacitan.', 'Sukamiskin', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '-0.830307745949', '119.91731643676', 'Tempat yang diyakini sebagai petapaan terahir naruto dan kurama yang bagus, sejuk, hening dan khidmad. Dekat dengan tuhan. Cocok untuk tidur dan berlatih biola.', '1662981929_13205c7823df64e7cc89.jpg'),
(4, 1, 4, 'Kebun Mangga', 'pegunungan', 'Jl Sidomulyo Selatan, Depan Masjid Agung, Dinoloyo. Pacitan', 'Sukamiskin', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '-0.866878336061', '119.92366790771', '', '1662981676_eac1480450eb973d6ca5.jpg'),
(5, 1, 5, 'Pantai Ulasan', 'pantai', 'Karoatas, Dinoloyo Pacitan', 'Karo atas', 'Dinoloyo', 'Pacitan', 'Jawa Timur', '-0.826536954259', '119.88195419311', '', '1662982406_5d47e86d6ede135b1812.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infodesa_user` (`id_user`);

--
-- Indexes for table `info_desa`
--
ALTER TABLE `info_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infodesa_user` (`id_user`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lahan_komentar` (`id_lahan`);

--
-- Indexes for table `lahan`
--
ALTER TABLE `lahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_lahan` (`user_id`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lahan_petani` (`id_lahan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_lahan` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `info_desa`
--
ALTER TABLE `info_desa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lahan`
--
ALTER TABLE `lahan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `petani`
--
ALTER TABLE `petani`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `info_desa`
--
ALTER TABLE `info_desa`
  ADD CONSTRAINT `infodesa_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `lahan_komentar` FOREIGN KEY (`id_lahan`) REFERENCES `lahan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lahan`
--
ALTER TABLE `lahan`
  ADD CONSTRAINT `user_lahan` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petani`
--
ALTER TABLE `petani`
  ADD CONSTRAINT `lahan_petani` FOREIGN KEY (`id_lahan`) REFERENCES `lahan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `user_wisata` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
