-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Sep 2026 pada 03.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mart`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerateDetailTransaksi` ()   BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE random_transaksi INT;
    DECLARE random_produk INT;
    DECLARE random_qty INT;
    DECLARE harga_produk DECIMAL(12,2);
    
    WHILE i <= 50000 DO
        
        SET random_transaksi = FLOOR(RAND() * 100000) + 1; 
        SET random_produk = FLOOR(RAND() * 5) + 1;         
        SET random_qty = FLOOR(RAND() * 5) + 1;            
        
        
        SELECT harga INTO harga_produk FROM tbl_produk WHERE id_produk = random_produk;
        
        
        INSERT INTO tbl_detail_transaksi (id_transaksi, id_produk, qty, subtotal)
        VALUES (random_transaksi, random_produk, random_qty, (random_qty * harga_produk));
        
        SET i = i + 1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerateTransaksiMasal` ()   BEGIN
    DECLARE i INT DEFAULT 1;
    
    
    WHILE i <= 100000 DO
        INSERT INTO tbl_transaksi (tanggal, id_pelanggan, total_belanja)
        VALUES (
            
            CURRENT_DATE() - INTERVAL FLOOR(RAND() * 365) DAY, 
            
            
            FLOOR(RAND() * 5) + 1,                         
            
            
            FLOOR(10000 + (RAND() * 990000))                           
        );
        
        
        SET i = i + 1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `HitungTotalPenjualanPelanggan` (IN `p_id_pelanggan` INT)   BEGIN
    SELECT
        id_pelanggan,
        SUM(total_belanja) AS Total_Keseluruhan
    FROM tbl_transaksi
    WHERE id_pelanggan = p_id_pelanggan
    GROUP BY id_pelanggan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LihatRiwayatBelanja` (IN `input_id` INT)   BEGIN
    SELECT 
        t.id_transaksi, 
        t.tanggal, 
        p.nama_pelanggan, 
        t.total_belanja
    FROM tbl_transaksi t
    JOIN tbl_pelanggan p ON t.id_pelanggan = p.id_pelanggan
    WHERE t.id_pelanggan = input_id
    ORDER BY t.tanggal DESC
    LIMIT 10; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `subtotal` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_09_10_005804_create_produks_table', 1),
(3, '2026_09_10_010918_create_pelanggan_table', 1),
(4, '2026_09_10_235959_create_transaksis_table', 1),
(5, '2026_09_11_000001_create_detail_transaksis_table', 1),
(6, '2026_09_10_010918_create_pelanggans_table', 2),
(7, '2026_09_10_013200_create_users_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `nama_pelanggan`, `no_telepon`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Bagas Prasetyo', '089745326718', NULL, 'Bandung', '2026-09-09 18:22:05', '2026-09-09 18:22:05'),
(2, 'Gita Octavia', '085815408992', NULL, 'Ponorogo', '2026-09-09 18:22:20', '2026-09-09 18:22:20'),
(3, 'Alex Fernando', '085815408992', NULL, 'Jenangan', '2026-09-09 18:22:31', '2026-09-09 18:22:31'),
(4, 'Aurora Ditria', '0986434556', NULL, 'Ngrayun', '2026-09-09 18:22:42', '2026-09-09 18:22:42'),
(5, 'Azzam Ulya', '9874278908', NULL, 'Carat', '2026-09-09 18:22:58', '2026-09-09 18:22:58'),
(6, 'Kevin Charles Alexander', '089732456758', NULL, 'Somoroto', '2026-09-09 18:23:23', '2026-09-09 18:23:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `nama_produk`, `kategori`, `harga`, `stok`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Es Teler', 'Minuman', 15000, 18, 'produk/9Xh18ZymaWun9g1wOTp4tAadNxCD45rA2HOHwLUj.jpg', '2026-09-09 18:26:05', '2026-09-09 18:33:52'),
(2, 'Iphone 16 Pro Max', 'Elektronik', 17000000, 9, 'produk/DV8xwAmHelMvy3v6PdkquOD3Q2P9ZHdbDdqDtTGH.jpg', '2026-09-09 18:26:18', '2026-09-09 18:29:47'),
(3, 'Laptop ASUS ROG', 'Elektronik', 23000000, 34, 'produk/D2qjyK4HQzU59FTWhuN4Ln2UGi8IacMjuzzeCwQF.jpg', '2026-09-09 18:26:42', '2026-09-09 18:26:42'),
(4, 'Bakso Keju', 'Makanan', 20000, 46, 'produk/UElxSTAJRHbThG2PRKTas2ccN2iXzrIbAfKA37D4.jpg', '2026-09-09 18:26:54', '2026-09-09 18:34:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_nota` varchar(255) DEFAULT NULL,
  `pelanggan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 1,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `total_bayar` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `nomor_nota`, `pelanggan_id`, `produk_id`, `nama_produk`, `harga`, `qty`, `jumlah`, `total_bayar`, `created_at`, `updated_at`) VALUES
(2, 'TRX-20260910012947-e26e', 1, NULL, 'Iphone 16 Pro Max', 17000000, 1, 1, 17000000, '2026-09-09 18:29:47', '2026-09-09 18:29:47'),
(3, 'TRX-20260910013352-de2e', 4, NULL, 'Es Teler', 15000, 2, 1, 30000, '2026-09-09 18:33:52', '2026-09-09 18:33:52'),
(4, 'TRX-20260910013408-8a6e', NULL, NULL, 'Bakso Keju', 20000, 4, 1, 80000, '2026-09-09 18:34:08', '2026-09-09 18:34:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'GITA OCTAVIA', 'octaviatata08@gmail.com', NULL, '$2y$10$uu96yG9TpiG4ADVwUbzXs.o1T53ORJZMRwveaWKZ91e.PtqHxpimG', NULL, '2026-09-09 18:33:41', '2026-09-09 18:33:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `detail_transaksis_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_produk_id_foreign` (`produk_id`),
  ADD KEY `transaksis_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
