-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 10:10 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_majujaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telepon`, `created_at`) VALUES
(1, 'CV Sumber Abadi', 'JL Sekitaran sini no 11 Tangerang', '08179465164', '2025-06-08 17:15:03'),
(2, 'PT.Pria Punya Selera', 'Jl Pahlawan Seribu BSD', '088112334485', '2025-06-09 12:25:35'),
(3, 'PT.Mitra Abadi Utama', 'Jl.TerusanTigaraksa Tenjo', '081234323444', '2025-06-11 13:11:45'),
(4, 'Anthony Salim', 'Jl BSD Raya Pagedangan Kab Tangerang', '0213345432', '2025-06-11 13:52:41'),
(5, 'PT Alam Sutera Reality', 'Jl Boulevard Raya Alam Sutera Tangerang', '08143256743', '2025-06-14 11:57:23'),
(6, 'Jhon Lie', 'Jl Samiaji No 24 Kavling Agraria Karawaci Tangerang', '089654372345', '2025-06-14 11:58:26'),
(7, 'Toko Terang Dunia', 'Jl Raya Cibodas Pasar Malabar Tangerang', '081266743214', '2025-06-14 11:59:52'),
(8, 'Toko Shin Elektronik', 'Jl Cemara Raya Cibodas Tangerang', '087144326782', '2025-06-14 12:01:25'),
(9, 'I Gede Suryanala', 'Jl Untung Suropati 2 Karawaci Tangerang', '089542334518', '2025-06-14 12:02:29'),
(10, 'Toko Raja Elektronik', 'Jl Tangerang Merak No 23B Kota Tangerang', '081278553421', '2025-06-14 12:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`, `created_at`) VALUES
(1, 'AA100', 'Kulkas Satu Pintu Polytron', '1450000.00', 4, '2025-06-08 11:17:28'),
(2, 'AB200', 'Kulkas Dua Pintu Panasonic', '5500000.00', 4, '2025-06-09 11:56:08'),
(3, 'AC01', 'AC Split Daikin 1PK Inventer', '7500000.00', 4, '2025-06-09 11:59:21'),
(4, 'AD123', 'Mesin Cuci Dua Tabung Sharp', '2600000.00', 4, '2025-06-11 13:10:50'),
(5, 'AE300', 'TV LED Toshiba 42 Inchi', '2700000.00', 5, '2025-06-11 13:51:47'),
(6, 'AF400', 'TCL TV Android LED 32 Inchi', '2250000.00', 7, '2025-06-14 10:48:28'),
(7, 'AC200', 'AC Split Aqua 1/2PK ', '2100000.00', 6, '2025-06-14 10:49:54'),
(8, 'DD500', 'Mesin Cuci Top Loading LG 8 Liter Stainless Steal', '3200000.00', 3, '2025-06-14 10:51:28'),
(9, 'DD501', 'Mesin Cuci Front Loading LG 7 Liter', '4700000.00', 3, '2025-06-14 10:52:19'),
(10, 'AE301', 'TV LED Toshiba 32 Inchi', '1650000.00', 7, '2025-06-14 10:53:51'),
(11, 'AB201', 'Kulkas Satu Pintu Panasonic', '2100000.00', 4, '2025-06-14 10:55:14'),
(12, 'AF402', 'TCL TV Android LED 42 Inchi UHD', '4650000.00', 8, '2025-06-14 10:56:25'),
(13, 'AE302', 'Mesin Cuci Dua Tabung Toshiba 8 Liter', '2600000.00', 4, '2025-06-14 11:47:15'),
(14, 'AA101', 'Kulkas Dua Pintu Polytron', '3750000.00', 3, '2025-06-14 11:48:46'),
(15, 'AA102', 'Mesin Cuci Dua Tabung Polytron 7 Liter', '1640000.00', 5, '2025-06-14 11:50:19'),
(16, 'AA103', 'Mesin Cuci Dua Tabung Polytron 9 Liter', '2830000.00', 1, '2025-06-14 11:51:09'),
(17, 'AB202', 'TV LED Panasonic 42 Inchi UHD', '2950000.00', 3, '2025-06-14 11:52:36'),
(18, 'DD400', 'TV LED LG 42 Inchi Amoled', '3500000.00', 6, '2025-06-14 11:54:07'),
(19, 'DD401', 'TV LED LG 32 Inchi Amoled', '2870000.00', 4, '2025-06-14 11:54:36'),
(20, 'AC02', 'AC Split Daikin 1/2 PK', '3100000.00', 7, '2025-06-14 11:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `sales_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `pelanggan_id`, `sales_id`, `status`, `created_at`) VALUES
(3, 1, 9, 'selesai', '2025-06-10 06:15:10'),
(4, 2, 9, 'selesai', '2025-06-10 09:25:27'),
(5, 3, 9, 'dibatalkan', '2025-06-11 13:23:13'),
(6, 2, 9, 'dibatalkan', '2025-06-11 13:30:40'),
(7, 4, 9, 'dibatalkan', '2025-06-11 13:53:31'),
(8, 1, 9, 'dibatalkan', '2025-06-11 14:08:47'),
(9, 4, 9, 'dibatalkan', '2025-06-12 05:02:32'),
(10, 2, 9, 'dibatalkan', '2025-06-12 05:25:04'),
(11, 1, 9, 'dibatalkan', '2025-06-12 05:33:58'),
(12, 4, 9, 'dibatalkan', '2025-06-12 10:59:16'),
(13, 4, 9, 'dibatalkan', '2025-06-12 11:11:31'),
(14, 2, 9, 'dibatalkan', '2025-06-12 11:24:25'),
(15, 3, 9, 'dibatalkan', '2025-06-12 11:33:09'),
(16, 2, 9, 'dibatalkan', '2025-06-12 11:57:06'),
(17, 4, 9, 'dibatalkan', '2025-06-12 12:00:31'),
(18, 3, 9, 'dibatalkan', '2025-06-13 22:24:30'),
(19, 4, 9, 'dibatalkan', '2025-06-13 23:16:00'),
(20, 2, 9, 'dibatalkan', '2025-06-14 02:39:14'),
(21, 6, 9, 'selesai', '2025-06-14 12:26:02'),
(22, 5, 9, 'selesai', '2025-06-14 12:27:12'),
(23, 8, 11, 'dikirim', '2025-06-14 13:46:04'),
(24, 9, 11, 'dikirim', '2025-06-14 13:46:41'),
(25, 10, 11, 'dikirim', '2025-06-14 13:48:25'),
(26, 7, 11, 'dibatalkan', '2025-06-14 13:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE `sales_order_details` (
  `id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`id`, `sales_order_id`, `product_id`, `jumlah`, `harga_satuan`, `total_harga`, `created_at`) VALUES
(1, 3, 1, 1, '1450000.00', '1450000.00', '2025-06-10 06:15:10'),
(2, 3, 2, 1, '5500000.00', '5500000.00', '2025-06-10 06:15:10'),
(3, 4, 3, 1, '7500000.00', '7500000.00', '2025-06-10 09:25:27'),
(4, 5, 4, 1, '2600000.00', '2600000.00', '2025-06-11 13:23:13'),
(5, 6, 4, 1, '2600000.00', '2600000.00', '2025-06-11 13:30:40'),
(6, 7, 5, 2, '2700000.00', '5400000.00', '2025-06-11 13:53:31'),
(7, 8, 5, 1, '2700000.00', '2700000.00', '2025-06-11 14:08:47'),
(8, 9, 3, 1, '7500000.00', '7500000.00', '2025-06-12 05:02:32'),
(9, 10, 3, 1, '7500000.00', '7500000.00', '2025-06-12 05:25:04'),
(10, 11, 3, 1, '7500000.00', '7500000.00', '2025-06-12 05:33:58'),
(11, 12, 1, 1, '1450000.00', '1450000.00', '2025-06-12 10:59:16'),
(12, 13, 2, 1, '5500000.00', '5500000.00', '2025-06-12 11:11:31'),
(13, 14, 3, 1, '7500000.00', '7500000.00', '2025-06-12 11:24:25'),
(14, 15, 2, 1, '5500000.00', '5500000.00', '2025-06-12 11:33:09'),
(15, 16, 3, 1, '7500000.00', '7500000.00', '2025-06-12 11:57:06'),
(16, 17, 5, 1, '2700000.00', '2700000.00', '2025-06-12 12:00:31'),
(17, 18, 5, 1, '2700000.00', '2700000.00', '2025-06-13 22:24:30'),
(18, 19, 3, 1, '7500000.00', '7500000.00', '2025-06-13 23:16:00'),
(19, 20, 5, 1, '2700000.00', '2700000.00', '2025-06-14 02:39:14'),
(20, 21, 12, 1, '4650000.00', '4650000.00', '2025-06-14 12:26:02'),
(21, 22, 17, 1, '2950000.00', '2950000.00', '2025-06-14 12:27:12'),
(22, 22, 7, 2, '2100000.00', '4200000.00', '2025-06-14 12:27:12'),
(23, 23, 16, 1, '2830000.00', '2830000.00', '2025-06-14 13:46:04'),
(24, 23, 19, 3, '2870000.00', '8610000.00', '2025-06-14 13:46:04'),
(25, 24, 8, 1, '3200000.00', '3200000.00', '2025-06-14 13:46:41'),
(26, 25, 6, 3, '2250000.00', '6750000.00', '2025-06-14 13:48:25'),
(27, 26, 9, 1, '4700000.00', '4700000.00', '2025-06-14 13:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(4, 'arifrahmanto667@gmail.com', '$2y$10$rlzr.vTnL8mriTQeECSAnOseRLpRvH8y/1SsrW9FXs9yV10n/M/ZG', 'admin', '2025-05-06 14:33:58'),
(8, 'manager', '$2y$10$rGdpPpT1WGgQU601GAH9nuv15eC6Se9bKRvSkgZ3WDrbEHF2qRtrS', 'manager', '2025-06-08 15:05:43'),
(9, 'inisales', '$2y$10$jS6FCg1.98gyBwM.vTOXnOXum5HuhMyOkVXwY3f0Thobsy/NC1MNa', 'sales', '2025-06-08 16:31:18'),
(10, 'admin', '$2y$10$wG9RNVhwH.ZAFMVfkW3zC.Qy31RYt3x8Y1Da8t2JQc4nZZLJBQ8Hm', 'admin', '2025-06-14 18:42:20'),
(11, 'sales', '$2y$10$tLPN0kBNx1Ly3mXF5V/F6.6pgaPjHQYXAq6qG/n7lo7c.dyRSkCE6', 'sales', '2025-06-14 18:45:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `fk_sales_orders_pelanggan` (`pelanggan_id`);

--
-- Indexes for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_order_id` (`sales_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `fk_sales_orders_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_orders_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD CONSTRAINT `sales_order_details_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
