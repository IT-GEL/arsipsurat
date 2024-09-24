-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 06:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letter_making_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_qr`
--

CREATE TABLE `detail_qr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nosurat` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `qr` text DEFAULT NULL,
  `approve_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `detail_qr`
--

INSERT INTO `detail_qr` (`id`, `nosurat`, `nama`, `NIK`, `jabatan`, `qr`, `approve_at`, `created_at`, `updated_at`) VALUES
(4, 'BA-002/INV-SALES/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS6.png', '2024-09-23 00:55:51', '2024-09-23 00:55:51', '2024-09-23 00:55:51'),
(5, 'Ref. No:MSS/GEL/FCO-001/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS5.png', '2024-09-23 01:04:06', '2024-09-23 01:04:06', '2024-09-23 01:04:06'),
(6, 'BA-001/INV-SALES/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS3.png', '2024-09-23 01:11:02', '2024-09-23 01:11:02', '2024-09-23 01:11:02'),
(7, 'BA-002/INV-SALES/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS4.png', '2024-09-23 01:15:30', '2024-09-23 01:15:30', '2024-09-23 01:15:30'),
(8, 'BA-002/INV-SALES/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS4.png', '2024-09-23 07:16:23', '2024-09-23 07:16:23', '2024-09-23 07:16:23'),
(9, 'Ref. No:MSS/GEL/FCO-001/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS5.png', '2024-09-23 09:32:42', '2024-09-23 09:32:42', '2024-09-23 09:32:42'),
(10, 'BA-003/INV-SALES/IX/2024', 'Ervina Wijaya', NULL, 'Head Departement Shipping and Sales', 'QRMSS7.png', '2024-09-23 11:14:04', '2024-09-23 11:14:04', '2024-09-23 11:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `g_a_s`
--

CREATE TABLE `g_a_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noSurat` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pt` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `tempatTglLahir` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tglSurat` date NOT NULL,
  `ttd` varchar(255) NOT NULL,
  `namaTtd` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `g_a_s`
--

INSERT INTO `g_a_s` (`id`, `noSurat`, `nama`, `pt`, `vendor`, `tempatTglLahir`, `keterangan`, `tglSurat`, `ttd`, `namaTtd`, `created_at`, `updated_at`) VALUES
(1, '82', 'Bettie Kozey', '', '', 'doloribus', 'Et nisi harum corrupti voluptas eos rerum ullam. Molestias natus dolor qui dolor. Ad sed voluptas aut omnis architecto.', '2019-05-29', 'voluptas', 'velit', '2024-09-08 20:35:13', '2024-09-08 20:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `i_t_s`
--

CREATE TABLE `i_t_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `noSurat` varchar(255) NOT NULL,
  `nama` text NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tglSurat` date NOT NULL,
  `ttd` varchar(255) NOT NULL,
  `namaTtd` varchar(255) NOT NULL,
  `ettd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `i_t_s`
--

INSERT INTO `i_t_s` (`id`, `perihal`, `noSurat`, `nama`, `jabatan`, `divisi`, `keterangan`, `tglSurat`, `ttd`, `namaTtd`, `ettd`, `created_at`, `updated_at`) VALUES
(3, 'Pembuatan Akun Shared Folder JKT-DS', '0000001', 'Hanna', 'SPV', 'TC', '<div>isi surat&nbsp;</div>', '2024-09-10', 'Habib', 'Habib Herbianto', 'Habib.png', '2024-09-10 02:23:29', '2024-09-12 09:59:48'),
(4, 'Pembuatan Akun Gelsys', '001', 'Adhe Hera', 'Talent and Culture', 'Talent and Culture', '<div>PT.ALL</div><ul><li>New Candidate , View Candidate</li><li>View Attendance (Full Attendance)</li><li>View Employee terminate , View Employee ( No. Payroll)</li></ul><div>test</div><div><br></div>', '2024-09-02', 'Adhe Herawati', 'Adhe Herawati', NULL, '2024-09-10 21:24:40', '2024-09-12 19:51:53'),
(5, 'Pembuatan Akun Shared Folder JKT-DS', '23', 'Williem', 'IT', 'IT', '<div>BLAKPOJKEDJIOW</div>', '2024-09-12', 'Habib', 'Habib Herbianto', NULL, '2024-09-12 03:49:24', '2024-09-12 03:49:24'),
(6, 'Pembuatan Akun Shared Folder JKT-DS', '111', 'Satria', 'IT', 'IT', '<div>test</div>', '2024-09-13', 'hhhh', 'sdgf', NULL, '2024-09-12 20:22:00', '2024-09-13 02:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2023_01_26_060604_create_its_table', 1),
(17, '2014_10_12_000000_create_gas_table', 2),
(18, '2014_10_12_100000_create_password_resets_table', 2),
(19, '2019_08_19_000000_create_failed_jobs_table', 2),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(21, '2024_09_22_143912_create_detail_qr_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `m_s_s`
--

CREATE TABLE `m_s_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noSurat` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) NOT NULL,
  `idPerihal` int(3) NOT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `perihalBA` varchar(255) DEFAULT NULL,
  `pttujuan` varchar(255) DEFAULT NULL,
  `ptkunjungan` varchar(255) DEFAULT NULL,
  `commodity` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `spec` varchar(255) DEFAULT NULL,
  `vo` date DEFAULT NULL,
  `qty` int(255) DEFAULT NULL,
  `lp` varchar(255) DEFAULT NULL,
  `dp` varchar(255) DEFAULT NULL,
  `matauang` varchar(255) DEFAULT NULL,
  `cif` int(255) DEFAULT NULL,
  `fob` int(255) DEFAULT NULL,
  `freight` int(255) DEFAULT NULL,
  `shipschedule` date DEFAULT NULL,
  `tcd` varchar(255) DEFAULT NULL,
  `surveyor` varchar(255) DEFAULT NULL,
  `qas` text DEFAULT NULL,
  `top` varchar(255) DEFAULT NULL,
  `tglSurat` date DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `namaTtd` varchar(255) DEFAULT NULL,
  `kop` varchar(255) NOT NULL,
  `qr` varchar(255) DEFAULT NULL,
  `approve` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `m_s_s`
--

INSERT INTO `m_s_s` (`id`, `noSurat`, `prefix`, `idPerihal`, `perihal`, `perihalBA`, `pttujuan`, `ptkunjungan`, `commodity`, `source`, `alamat`, `keterangan`, `country`, `spec`, `vo`, `qty`, `lp`, `dp`, `matauang`, `cif`, `fob`, `freight`, `shipschedule`, `tcd`, `surveyor`, `qas`, `top`, `tglSurat`, `ttd`, `namaTtd`, `kop`, `qr`, `approve`, `created_at`, `updated_at`) VALUES
(3, '1', 'Ref. No:MSS/GEL/FCO-001/IX/2024', 1, 'Full Corporate Offer', NULL, 'PT Borneo', NULL, 'awd', 'awd', NULL, NULL, 'aw', 'GCV 500 (ARB)', '2024-09-25', 6, 'Jetty Kalsel', 'Jetty PT.BAP', NULL, NULL, NULL, NULL, '2024-09-25', 'CIF', 'ATQ', '<table style=\"border-collapse:collapse;width: 100%;\"><tbody>\r\n<tr>\r\n	<td style=\"width: 16.6667%;\">q2eq2e213</td>\r\n	<td style=\"width: 16.6667%;\">awedawd</td>\r\n	<td style=\"width: 16.6667%;\">adsa</td>\r\n	<td style=\"width: 16.6667%;\">awdawdawd</td>\r\n	<td style=\"width: 16.6667%;\">awdad</td>\r\n	<td style=\"width: 16.6667%;\">dawdawd</td></tr>\r\n<tr>\r\n	<td style=\"width: 16.6667%;\">2qeq2e</td>\r\n	<td style=\"width: 16.6667%;\">awdawd</td>\r\n	<td style=\"width: 16.6667%;\">awdawd</td>\r\n	<td style=\"width: 16.6667%;\">dwaadwawd</td>\r\n	<td style=\"width: 16.6667%;\">dawdaw</td>\r\n	<td style=\"width: 16.6667%;\">awdawd</td></tr>\r\n<tr>\r\n	<td style=\"width: 16.6667%;\">awdawdawd</td>\r\n	<td style=\"width: 16.6667%;\">awdawd</td>\r\n	<td style=\"width: 16.6667%;\">adwawdawd</td>\r\n	<td style=\"width: 16.6667%;\">adwawd</td>\r\n	<td style=\"width: 16.6667%;\">dadwd</td>\r\n	<td style=\"width: 16.6667%;\">dawdwa</td></tr>\r\n<tr>\r\n	<td style=\"width: 16.6667%;\">awdawdwdwadawd</td>\r\n	<td style=\"width: 16.6667%;\">awddawa</td>\r\n	<td style=\"width: 16.6667%;\">dawd</td>\r\n	<td style=\"width: 16.6667%;\">aadwaw</td>\r\n	<td style=\"width: 16.6667%;\">dawdaw</td>\r\n	<td style=\"width: 16.6667%;\">awdawdaw</td></tr></tbody></table>', 'yaaa', '2024-09-24', 'Habib', 'BOBI', 'QIN', NULL, '0', '2024-09-23 21:20:47', '2024-09-23 21:20:47'),
(4, '2', 'Ref. No:MSS/GEL/FCO-002/IX/2024', 1, 'Full Corporate Offer', NULL, 'PT Borneo', NULL, 'adcsfvacfvcad', 'acdscdc', '<div>&nbsp;oytiruesgerxhdtcyjukilho;jpolivkucjyrxtehzxthcyjuvkbil</div>', NULL, 'acwdsawcdas', 'awcddaw', '2024-09-24', 234, 'Jetty Kalsel', 'Jetty PT.BAP', 'DOLLAR', 23212342, 12343123, NULL, '2024-09-24', 'CIF', 'ATQ', '<p>awdqadawdaw</p><p>awdasdwad</p><p><br></p>', 'yaaa', '2024-09-24', 'asdawd', 'asdaw', 'QIN', NULL, '0', '2024-09-23 23:23:30', '2024-09-23 23:23:30'),
(5, '3', 'Ref. No:MSS/GEL/FCO-003/IX/2024', 1, 'Full Corporate Offer', NULL, 'PT Borneo', NULL, 'wdsadaw', 'dasdawd', '<div>wdfsfeeeeeeee</div>', NULL, 'awdasdaw', 'awdsad', '2024-09-24', 234, 'asdaw', 'asdwa', 'IDR', NULL, 100000, 1000000, '2024-09-24', 'CIF', 'ATQ', '<p>awdasdwa</p>', 'awdsad', '2024-09-24', 'awdsa', 'awds', 'ERA', NULL, '0', '2024-09-24 09:30:16', '2024-09-24 09:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `NIK` varchar(100) NOT NULL,
  `Jabatan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `NIK`, `Jabatan`, `created_at`) VALUES
(1, 'test', 'test01', 'jabatantest', '2024-09-19 02:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `Jabatan` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `NIK`, `name`, `Jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'itsupport', NULL, 'IT Support', NULL, 'it@gel.co.id', NULL, '$2y$10$ngS3FsM352rfnOI3WTn7EO2qCzP6MbBxaObCIer7o9QjQ1jPzSX/G', NULL, '2024-09-09 21:40:26', '2024-09-09 21:40:26'),
(2, 'generalaffair', NULL, 'General Affair', NULL, 'GeneralAffair@gel.co.id', NULL, '$2y$10$cAqkMkiF8a8jZ4vV.PUfYOjoBfaFvyyC/W33UvLh3Q8kQVXOhbH.a', NULL, '2024-09-09 23:48:15', '2024-09-09 23:48:15'),
(3, 'mss', 'NIK001', 'Marketing Sales Shipping', 'MSS', 'mss@gel.co.id', NULL, '$2y$10$upgXg18l9BtkqaIQj.QKIuwdAlUY6ERaZhh0os2ahErezKMWPKgE.', NULL, '2024-09-11 06:41:30', '2024-09-11 06:41:30'),
(4, 'legal', NULL, 'Legal', NULL, 'Legal@Legal.com', NULL, '$2y$10$oDh2U5u75Vxis306RE2KpeP/GaAv3cGB4og4s8iOqQWNxfKCIpewq', NULL, '2024-09-12 00:23:03', '2024-09-12 00:23:03'),
(5, 'bnl', NULL, 'Bank And Leasing', NULL, 'Bank@leasing.com', NULL, '$2y$10$W2p5L6q4JKGmw3bhN1Fe4uOOIIjyuXj7vcesiPC51GeXlFnR.R1Nq', NULL, '2024-09-12 00:23:29', '2024-09-12 00:23:29'),
(6, 'tax', NULL, 'Tax', NULL, 'tax@tax.com', NULL, '$2y$10$PWGy8AcvPCwh5KCHSXqQxe0acaPJu1HlJcQuZSRryY4FWIH4iCRzO', NULL, '2024-09-12 00:23:55', '2024-09-12 00:23:55'),
(7, 'far', NULL, 'Finance AR', NULL, 'far@Far.com', NULL, '$2y$10$NCnCsqXB.ECRqzwAKXY4fepNLqT6xVsOm0bUSci/UYgrnzz.x.P0S', NULL, '2024-09-12 00:24:40', '2024-09-12 00:24:40'),
(8, 'gsm', NULL, 'Global Sinergi Maritim', NULL, 'gsm@gsm.com', NULL, '$2y$10$stB5hB2g6U1BSsKEA0IF7.mcYsN5b5twLYX1YhcGnRFgns5p74RYK', NULL, '2024-09-12 00:25:09', '2024-09-12 00:25:09'),
(9, 'tnc', NULL, 'Talent and Culture', NULL, 'tnc@tnc.com', NULL, '$2y$10$X4emOgMmOF9Yczs6qNU4IewqsBhZtNu3hiqrF5B9w/JdP6/.VTn2O', NULL, '2024-09-12 00:26:33', '2024-09-12 00:26:33'),
(10, 'sudosu', NULL, 'superadmin', NULL, 'super@dmin.com', NULL, '$2y$10$J3an9.fYE1zJERmYU6k.zeo23l506aNPvDb5QgcQ0mTW/fiIx8SpK', NULL, '2024-09-12 01:16:02', '2024-09-12 01:16:02'),
(11, 'hmss', NULL, 'Ervina Wijaya', 'Head Departement Shipping and Sales', 'hmss@gmail.com', NULL, '$2y$10$yO1VY8BVNIGsMl934vQrleVmXteQQF/5lnY6vmwnhvXdbzCtmSgvW', NULL, '2024-09-23 00:20:16', '2024-09-23 00:20:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_qr`
--
ALTER TABLE `detail_qr`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `g_a_s`
--
ALTER TABLE `g_a_s`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `domisilis_nosurat_unique` (`noSurat`) USING BTREE;

--
-- Indexes for table `i_t_s`
--
ALTER TABLE `i_t_s`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `domisilis_nosurat_unique` (`noSurat`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `m_s_s`
--
ALTER TABLE `m_s_s`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `prefix` (`prefix`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE,
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`) USING BTREE;

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `NIK` (`NIK`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_qr`
--
ALTER TABLE `detail_qr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_a_s`
--
ALTER TABLE `g_a_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `i_t_s`
--
ALTER TABLE `i_t_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `m_s_s`
--
ALTER TABLE `m_s_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
