-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 12:45 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2023_01_26_060604_create_its_table', 1),
(17, '2014_10_12_000000_create_gas_table', 2),
(18, '2014_10_12_100000_create_password_resets_table', 2),
(19, '2019_08_19_000000_create_failed_jobs_table', 2),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 2);

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
  `cif` int(255) DEFAULT NULL,
  `fob` int(255) DEFAULT NULL,
  `freight` int(255) DEFAULT NULL,
  `shipschedule` date DEFAULT NULL,
  `tcd` varchar(255) DEFAULT NULL,
  `tglSurat` date DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `namaTtd` varchar(255) DEFAULT NULL,
  `kop` varchar(255) NOT NULL,
  `qr` varchar(255) DEFAULT NULL,
  `approve` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_s_s`
--

INSERT INTO `m_s_s` (`id`, `noSurat`, `prefix`, `idPerihal`, `perihal`, `perihalBA`, `pttujuan`, `ptkunjungan`, `commodity`, `source`, `alamat`, `keterangan`, `country`, `spec`, `vo`, `qty`, `lp`, `dp`, `cif`, `fob`, `freight`, `shipschedule`, `tcd`, `tglSurat`, `ttd`, `namaTtd`, `kop`, `qr`, `approve`, `created_at`, `updated_at`) VALUES
(2, '1', 'Ref. No:MSS/GEL/BA-001/IX/2024', 2, 'Surat Izin Masuk Tambang', '', 'GEL', 'GEL', NULL, NULL, '<div>EA</div>', '<div>EA</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-18', 'YOGI', 'YOGI', '', '', NULL, '2024-09-18 05:07:50', '2024-09-18 05:07:50'),
(3, '1', 'BA-001/INV-SALES/IX/2024', 4, 'Berita Acara Pembatalan PVR', '', NULL, NULL, NULL, NULL, NULL, '<table style=\"border-collapse:collapse;width: 100%;\"><tbody><tr>	<td style=\"width: 14.2857%;\">dawdaiowj</td>	<td style=\"width: 14.2857%;\">awdawdawdaw</td>	<td style=\"width: 14.2857%;\">adwas</td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td></tr><tr>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td></tr><tr>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td></tr><tr>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td>	<td style=\"width: 14.2857%;\"><br></td></tr></tbody></table>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20', 'SKawkkw', 'ygiuhiugy', '', NULL, NULL, '2024-09-19 20:13:46', '2024-09-19 20:13:46'),
(4, '2', 'BA-002/INV-SALES/IX/2024', 3, 'Berita Acara Surveyor', '', NULL, NULL, NULL, NULL, NULL, '<p>Xdcwtfvsegybhjkl</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20', 'sefsdsdfe', 'sefsdfse', '', NULL, NULL, '2024-09-19 20:16:24', '2024-09-19 20:16:24'),
(5, '1', 'Ref. No:MSS/GEL/FCO-001/IX/2024', 1, 'Full Corporate Offer', '', 'PT. INDOCEMENT', NULL, 'INDONESIAN STEAM COAL', 'ERA PERKASA MINING', '<div>ABCD</div>', '<table style=\"border-collapse:collapse;width: 100%;\"><tbody><tr>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td></tr><tr>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td></tr><tr>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td></tr><tr>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td></tr><tr>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td>	<td style=\"width: 25%;\"><br></td></tr></tbody></table>', 'INDONESIA', 'GCV 3300 - 3100', '2024-09-30', 55000, 'JETTY SIP', 'CHINA', 0, 3, -1, '2024-10-20', '50 50', '2024-09-20', 'Zyah', 'Ervina Wijaya', '', NULL, NULL, '2024-09-19 20:47:21', '2024-09-19 20:47:21'),
(6, '2', 'BA-002/INV-SALES/IX/2024', 3, 'Berita Acara Surveyor', '', NULL, NULL, NULL, NULL, NULL, '<p>awdasd</p><table style=\"border-collapse:collapse;width: 100%;\"><tbody><tr>	<td style=\"width: 20%;\">awdsadwa</td>	<td style=\"width: 20%;\">awdsad</td>	<td style=\"width: 20%;\">awdsad</td>	<td style=\"width: 20%;\">awdsawd</td>	<td style=\"width: 20%;\"><br></td></tr><tr>	<td style=\"width: 20%;\">awd</td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td></tr><tr>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td></tr><tr>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td>	<td style=\"width: 20%;\"><br></td></tr></tbody></table>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20', 'awdsd', 'wdasdawd', 'GEL', NULL, NULL, '2024-09-20 00:22:21', '2024-09-20 00:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'IT Support', 'itsupport', 'it@gel.co.id', NULL, '$2y$10$ngS3FsM352rfnOI3WTn7EO2qCzP6MbBxaObCIer7o9QjQ1jPzSX/G', NULL, '2024-09-09 21:40:26', '2024-09-09 21:40:26'),
(2, 'General Affair', 'generalaffair', 'GeneralAffair@gel.co.id', NULL, '$2y$10$cAqkMkiF8a8jZ4vV.PUfYOjoBfaFvyyC/W33UvLh3Q8kQVXOhbH.a', NULL, '2024-09-09 23:48:15', '2024-09-09 23:48:15'),
(3, 'Marketing Sales Shipping', 'mss', 'mss@gel.co.id', NULL, '$2y$10$upgXg18l9BtkqaIQj.QKIuwdAlUY6ERaZhh0os2ahErezKMWPKgE.', NULL, '2024-09-11 06:41:30', '2024-09-11 06:41:30'),
(4, 'Legal', 'legal', 'Legal@Legal.com', NULL, '$2y$10$oDh2U5u75Vxis306RE2KpeP/GaAv3cGB4og4s8iOqQWNxfKCIpewq', NULL, '2024-09-12 00:23:03', '2024-09-12 00:23:03'),
(5, 'Bank And Leasing', 'bnl', 'Bank@leasing.com', NULL, '$2y$10$W2p5L6q4JKGmw3bhN1Fe4uOOIIjyuXj7vcesiPC51GeXlFnR.R1Nq', NULL, '2024-09-12 00:23:29', '2024-09-12 00:23:29'),
(6, 'Tax', 'tax', 'tax@tax.com', NULL, '$2y$10$PWGy8AcvPCwh5KCHSXqQxe0acaPJu1HlJcQuZSRryY4FWIH4iCRzO', NULL, '2024-09-12 00:23:55', '2024-09-12 00:23:55'),
(7, 'Finance AR', 'far', 'far@Far.com', NULL, '$2y$10$NCnCsqXB.ECRqzwAKXY4fepNLqT6xVsOm0bUSci/UYgrnzz.x.P0S', NULL, '2024-09-12 00:24:40', '2024-09-12 00:24:40'),
(8, 'Global Sinergi Maritim', 'gsm', 'gsm@gsm.com', NULL, '$2y$10$stB5hB2g6U1BSsKEA0IF7.mcYsN5b5twLYX1YhcGnRFgns5p74RYK', NULL, '2024-09-12 00:25:09', '2024-09-12 00:25:09'),
(9, 'Talent and Culture', 'tnc', 'tnc@tnc.com', NULL, '$2y$10$X4emOgMmOF9Yczs6qNU4IewqsBhZtNu3hiqrF5B9w/JdP6/.VTn2O', NULL, '2024-09-12 00:26:33', '2024-09-12 00:26:33'),
(10, 'superadmin', 'sudosu', 'super@dmin.com', NULL, '$2y$10$J3an9.fYE1zJERmYU6k.zeo23l506aNPvDb5QgcQ0mTW/fiIx8SpK', NULL, '2024-09-12 01:16:02', '2024-09-12 01:16:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `g_a_s`
--
ALTER TABLE `g_a_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domisilis_nosurat_unique` (`noSurat`);

--
-- Indexes for table `i_t_s`
--
ALTER TABLE `i_t_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domisilis_nosurat_unique` (`noSurat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_s_s`
--
ALTER TABLE `m_s_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prefix` (`prefix`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIK` (`NIK`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `m_s_s`
--
ALTER TABLE `m_s_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
