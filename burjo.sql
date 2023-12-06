-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2023 at 11:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burjo`
--

-- --------------------------------------------------------

--
-- Table structure for table `berlangganan`
--

CREATE TABLE `berlangganan` (
  `id_berlangganan` int NOT NULL,
  `id_pemilik` int DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berlangganan`
--

INSERT INTO `berlangganan` (`id_berlangganan`, `id_pemilik`, `tanggal_mulai`, `tanggal_berakhir`) VALUES
(1, 4, '2023-12-06', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int NOT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `id_pemilik` int DEFAULT NULL,
  `jumlah_hutang` decimal(10,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `id_pelanggan`, `id_pemilik`, `jumlah_hutang`, `tanggal`, `status_pembayaran`) VALUES
(1, 7, 2, '100000.00', '2023-11-01', NULL),
(2, 7, 2, '500000.00', '2023-11-10', NULL),
(3, 7, 2, '150000.00', '2023-11-02', NULL),
(4, 7, 2, '250000.00', '2023-11-10', NULL),
(5, 7, 2, '190000.00', '2023-11-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `id_pemilik` int DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `catatan_tambahan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_pemilik`, `nama_pelanggan`, `nomor_telepon`, `alamat`, `catatan_tambahan`) VALUES
(2, 1, 'Pak Embul', '4223335', 'Embun Senja Jakarta', 'Sudah Lunas kemarin'),
(7, 2, 'Budi Santoso', '21312321453', 'Jalan Merpati', '1 Tahun');

-- --------------------------------------------------------

--
-- Table structure for table `pemilikwarmindo`
--

CREATE TABLE `pemilikwarmindo` (
  `id_pemilik` int NOT NULL,
  `nama_warung` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT NULL,
  `level` enum('User','Admin') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemilikwarmindo`
--

INSERT INTO `pemilikwarmindo` (`id_pemilik`, `nama_warung`, `email`, `password`, `tanggal_daftar`, `level`) VALUES
(1, 'Warmindo Suka Bapak', 'sukabapak@test.com', 'sukabapak', NULL, ''),
(2, 'test', 'test@test.com', 'test', NULL, ''),
(3, 'Masbro', 'Masbro@test.com', 'Masbro', NULL, 'Admin'),
(4, 'MasBre', 'MasBre@test.com', 'MasBre', NULL, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionpayments`
--

CREATE TABLE `subscriptionpayments` (
  `ID` int NOT NULL,
  `User_ID` int DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Date` datetime DEFAULT NULL,
  `Payment_Method` varchar(50) DEFAULT NULL,
  `Payment_Status` enum('Pending','Accepted') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pending',
  `Payment_Proof` varchar(255) DEFAULT NULL,
  `Created_At` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscriptionpayments`
--

INSERT INTO `subscriptionpayments` (`ID`, `User_ID`, `Amount`, `Payment_Date`, `Payment_Method`, `Payment_Status`, `Payment_Proof`, `Created_At`, `Updated_At`) VALUES
(1, 2, '150000.00', '2023-12-06 16:34:00', 'DANA', 'Accepted', 'assets/payment_confirm/3331.jpg', '2023-12-06 09:34:11', '2023-12-06 11:18:44'),
(2, 4, '150000.00', '2023-12-06 18:27:00', 'DANA', 'Accepted', 'assets/payment_confirm/3332.jpg', '2023-12-06 11:27:33', '2023-12-06 11:28:29');

--
-- Triggers `subscriptionpayments`
--
DELIMITER $$
CREATE TRIGGER `payment_accepted_trigger` AFTER UPDATE ON `subscriptionpayments` FOR EACH ROW BEGIN
    IF NEW.Payment_Status = 'Accepted' THEN
        INSERT INTO berlangganan (id_pemilik, tanggal_mulai, tanggal_berakhir)
        VALUES (NEW.User_ID, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 YEAR));
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berlangganan`
--
ALTER TABLE `berlangganan`
  ADD PRIMARY KEY (`id_berlangganan`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `pemilikwarmindo`
--
ALTER TABLE `pemilikwarmindo`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berlangganan`
--
ALTER TABLE `berlangganan`
  MODIFY `id_berlangganan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemilikwarmindo`
--
ALTER TABLE `pemilikwarmindo`
  MODIFY `id_pemilik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berlangganan`
--
ALTER TABLE `berlangganan`
  ADD CONSTRAINT `berlangganan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilikwarmindo` (`id_pemilik`);

--
-- Constraints for table `hutang`
--
ALTER TABLE `hutang`
  ADD CONSTRAINT `hutang_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `hutang_ibfk_2` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilikwarmindo` (`id_pemilik`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilikwarmindo` (`id_pemilik`);

--
-- Constraints for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  ADD CONSTRAINT `subscriptionpayments_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `pemilikwarmindo` (`id_pemilik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
