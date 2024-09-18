-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 08:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_foto`
--

CREATE TABLE `mst_foto` (
  `id_foto` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_jurusan`
--

CREATE TABLE `mst_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `ketua_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_jurusan`
--

INSERT INTO `mst_jurusan` (`id_jurusan`, `nama_jurusan`, `ketua_jurusan`) VALUES
(9, 'Teknik Informatika', 'Tasrif Hasanuddin, S.T., M.Cs.'),
(10, 'Sistem Informasi', 'Herman, S.Kom., M.Cs.,MTA'),
(15, 'Teknik Kimia', 'Bapak Rizal');

-- --------------------------------------------------------

--
-- Table structure for table `mst_role`
--

CREATE TABLE `mst_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL,
  `level` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_role`
--

INSERT INTO `mst_role` (`id_role`, `nama_role`, `level`) VALUES
(1, 'Admin', '3'),
(2, 'Kepala Lab', '2'),
(3, 'Koordinator Lab', '1'),
(4, 'User', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mst_ruangan`
--

CREATE TABLE `mst_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `lokasi` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_ruangan` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_ruangan`
--

INSERT INTO `mst_ruangan` (`id_ruangan`, `id_user`, `nama_ruangan`, `kapasitas`, `thumbnail`, `lokasi`, `deskripsi`, `status_ruangan`) VALUES
(36, 106, 'IoT', 25, '66daf6938a3bb.jpg', 'Lantai 2', '', 'Tersedia'),
(37, 106, 'Startup', 65, '66daf9604092f.jpg', '', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id_user`, `id_role`, `id_jurusan`, `nama_lengkap`, `nim`, `email`, `password`, `no_telp`, `alamat`, `image`) VALUES
(101, 1, NULL, 'Fikom_iclabs', NULL, 'iclabs123@umi.ac.id', 'admin123', NULL, NULL, NULL),
(103, 1, 9, 'admin1', '2342342', 'iclabs123@gmail.com', '$2y$10$37wcIbYIXICzc30e/TsMBu06F4uztvFIttjak/My7Z99WqMz1H7KK', '081341305746', NULL, 'pp.jpg'),
(104, 1, 9, 'diba', '', 'diba123@gmail.com', '$2y$10$mJ/8rKX..unv9SNDzmJrbuek5iLxjbwzitMlL7fGzuM526O4UGcum', '', '', '66daf7acde595.jpg'),
(105, 4, 9, 'zaldi', '', 'zaldi123@gmail.com', '$2y$10$s62rWFXm7fD5pExwW8EVgOx7jgIrO4thNaA8CYi4K7AUMrkGbOAsa', '', NULL, 'pp.jpg'),
(106, 3, 9, 'Wahyu', '', 'wahyu123@gmail.com', '$2y$10$CZTfCp3KlJIqdFJ3yADBCOscCJ1H6ugDZTORMqfGIW9/bXP8B/RiG', '', NULL, 'pp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trx_peminjaman`
--

CREATE TABLE `trx_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `keperluan` varchar(50) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `status_peminjaman` enum('Disetujui','Pending','Ditolak','Dibatalkan') NOT NULL,
  `status_pengembalian` enum('belum','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trx_peminjaman`
--

INSERT INTO `trx_peminjaman` (`id_peminjaman`, `id_user`, `id_ruangan`, `tanggal_pinjam`, `waktu_mulai`, `waktu_selesai`, `jumlah_peserta`, `keperluan`, `file`, `status_peminjaman`, `status_pengembalian`) VALUES
(72, 104, 36, '2024-09-06', '19:36:00', '19:40:00', 25, 'GDSC', '66daf714247c7.pdf', 'Pending', 'belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_foto`
--
ALTER TABLE `mst_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `mst_jurusan`
--
ALTER TABLE `mst_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `mst_role`
--
ALTER TABLE `mst_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `mst_ruangan`
--
ALTER TABLE `mst_ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `trx_peminjaman`
--
ALTER TABLE `trx_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_profile` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_foto`
--
ALTER TABLE `mst_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_jurusan`
--
ALTER TABLE `mst_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mst_role`
--
ALTER TABLE `mst_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_ruangan`
--
ALTER TABLE `mst_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `trx_peminjaman`
--
ALTER TABLE `trx_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mst_foto`
--
ALTER TABLE `mst_foto`
  ADD CONSTRAINT `mst_foto_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `mst_ruangan` (`id_ruangan`);

--
-- Constraints for table `mst_ruangan`
--
ALTER TABLE `mst_ruangan`
  ADD CONSTRAINT `mst_ruangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `mst_user` (`id_user`);

--
-- Constraints for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD CONSTRAINT `mst_user_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `mst_jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `mst_user_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `mst_role` (`id_role`);

--
-- Constraints for table `trx_peminjaman`
--
ALTER TABLE `trx_peminjaman`
  ADD CONSTRAINT `trx_peminjaman_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `mst_ruangan` (`id_ruangan`),
  ADD CONSTRAINT `trx_peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mst_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
