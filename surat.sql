-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2022 at 07:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'navigasi', '2021-12-17 22:52:49', '2021-12-17 22:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_items`
--

INSERT INTO `admin_menu_items` (`id`, `label`, `link`, `parent`, `sort`, `class`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'Beranda', 'home', 0, 0, NULL, 1, 0, '2021-12-17 22:55:24', '2021-12-18 01:22:32'),
(2, 'Profil', '#', 0, 1, 'dropdown', 1, 0, '2021-12-17 22:55:52', '2021-12-18 01:15:56'),
(3, 'Berita', 'berita/main', 0, 3, NULL, 1, 0, '2021-12-17 22:56:05', '2021-12-18 01:15:56'),
(4, 'Galeri', '#', 0, 4, 'dropdown', 1, 0, '2021-12-17 22:56:24', '2021-12-24 02:59:23'),
(5, 'Kontak', 'kontak', 0, 7, NULL, 1, 0, '2021-12-17 22:56:35', '2021-12-24 02:58:45'),
(6, 'TUPOKSI', 'profil/tupoksi', 2, 2, NULL, 1, 1, '2021-12-17 22:56:57', '2021-12-18 01:08:40'),
(7, 'Video', 'galeri/video', 4, 5, NULL, 1, 1, '2021-12-24 02:58:24', '2021-12-24 02:58:45'),
(8, 'Foto', 'galeri/foto', 4, 6, NULL, 1, 1, '2021-12-24 02:58:34', '2021-12-24 02:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `title`, `slug`, `foto`, `body`, `author`, `created_at`, `updated_at`) VALUES
(30, '45h54rt', '45h54rt', 'berita/5ca2ae072ef104abc2307db0e375599f.PNG', '<p>it934 34t893894cj 348hb49tb945 9h459 49b 5g45949u4589 4594vy 4g45g34g ewrguihiwegeruig uierguierhguiheruig erigerhgiehrgi erigherihgier gerignerig erig erigeruig uierbguier gierbgi sb</p>', 'rthrthrth', '2021-12-19 01:39:35', '2021-12-19 03:38:48'),
(31, 'Indoensia Butuh Negara Maju', 'Indoensia_Butuh_Negara_Maju', 'berita/be396dfd832c2a772d18aaa6e4886cd0.PNG', '<p><strong style=\"color: rgb(0, 0, 0);\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Author', '2021-12-19 01:41:17', '2021-12-19 01:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `berita_category`
--

CREATE TABLE `berita_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `berita_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita_category`
--

INSERT INTO `berita_category` (`id`, `berita_id`, `category_id`) VALUES
(6, 31, 10),
(10, 30, 11);

-- --------------------------------------------------------

--
-- Table structure for table `berita_tag`
--

CREATE TABLE `berita_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `berita_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita_tag`
--

INSERT INTO `berita_tag` (`id`, `berita_id`, `tag_id`) VALUES
(3, 30, 10),
(4, 31, 10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(10, 'vcmg'),
(11, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `category_galeri`
--

CREATE TABLE `category_galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galeri_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisis`
--

CREATE TABLE `divisis` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisis`
--

INSERT INTO `divisis` (`id`, `kode`, `divisi`, `created_at`, `updated_at`) VALUES
('5c4b32de-c947-4e91-b3a9-7c82666b881c', 'Kepala UPTD', 'Kepala UPTD', '2021-11-14 10:37:01', '2021-12-18 02:00:48'),
('94fb267c-528c-4a59-a20b-91cf15c4a807', 'TU', 'Sub Bagian Tata Usaha', '2021-11-14 09:52:19', '2021-12-04 17:26:15'),
('b7c54b1e-2b59-489b-9b5b-d95cc633f0df', 'Perencanaan', 'Seksi Perencanaan dan Pemanfaatan Hutan', '2021-11-14 09:52:43', '2021-12-04 17:26:24'),
('ba5c192c-82b8-494b-b299-8b0fc36b68d3', 'Perlindungan', 'Seksi Perlindungan, KSDAE dan Pemberdayaan Masyarakat', '2021-12-04 17:27:14', '2021-12-04 17:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `eselons`
--

CREATE TABLE `eselons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pangkat` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang` char(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eselons`
--

INSERT INTO `eselons` (`id`, `pangkat`, `ruang`) VALUES
(1, 'I', 'A'),
(2, 'I', 'B'),
(3, 'II', 'A'),
(4, 'II', 'B'),
(5, 'III', 'A'),
(6, 'III', 'B'),
(7, 'IV', 'A'),
(8, 'IV', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_galeris`
--

CREATE TABLE `file_galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galeri_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_galeris`
--

INSERT INTO `file_galeris` (`id`, `galeri_id`, `url`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://www.youtube.com/embed/KxfnOK2QErU', NULL, '2021-12-24 01:19:55', '2021-12-24 01:19:55'),
(2, 2, 'https://www.youtube.com/embed/LV3gF-zpzFg', NULL, '2021-12-24 03:10:57', '2021-12-24 03:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `nama`, `tipe`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Tahura Bukit Soeharto', '2', NULL, '2021-12-24 01:19:44', '2021-12-24 01:19:48'),
(2, 'Patroli Rutin | UPTD Tahura Bukit Soeharto', '2', NULL, '2021-12-24 03:03:02', '2022-01-02 20:01:44'),
(3, 'Koordinasi dan Kunjungan Kerja', '1', NULL, '2021-12-24 08:37:24', '2022-01-02 20:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_tag`
--

CREATE TABLE `galeri_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `galeri_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri_tag`
--

INSERT INTO `galeri_tag` (`id`, `galeri_id`, `tag_id`) VALUES
(1, 3, 9),
(2, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `informasis`
--

CREATE TABLE `informasis` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasis`
--

INSERT INTO `informasis` (`id`, `nama`, `deskripsi`) VALUES
('07bf02bc-0e1a-4c0d-954e-ecb401a11ea1', 'instagram', '0'),
('1d5383dd-dc22-41c2-bb5b-b7eeda6c644c', 'divisi', '0'),
('20996c81-54dd-4d2e-bad5-3457ff5ddd0e', 'pegawai', '0'),
('332a1257-3f32-4ce1-8d5d-40db2381b50c', 'twitter', '0'),
('50bc5108-35ab-45f1-b4dd-ea47860345bf', 'nomor', '(0541) 738843'),
('554a7224-0309-45af-98ea-da4c992221a0', 'youtube', '0'),
('6e3a7061-fcf9-4c16-97fb-1448906c8656', 'email', 'tahura.bukit.soeharto@gmail.com'),
('7726f2dd-8917-40b2-80c8-290d54ed151a', 'tanah', '61850'),
('7e485674-7c62-42a4-8181-971211bbc809', 'alamat', 'Jln. Biola No.2 Samarinda 75123'),
('8e8a72b4-3293-4fea-886e-7dff0252d9d8', 'whatsapp', '(0541) 738843'),
('b013353e-0482-45f5-aad1-14ec7951d1c0', 'facebook', '0'),
('c0b27198-60f7-44d3-9fb2-467474d82890', 'google', '0'),
('e193f838-fd15-4cba-8449-724c493b96ad', 'Tenaga Ahli', '0'),
('f93941d8-75b2-48e8-b244-d57cbefc70ef', 'maps', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `jabatan`) VALUES
(1, 'Kepala UPTD'),
(2, 'Kasub Bagian Tata Usaha'),
(3, 'Kasi Perlindungan KSDAE & Pemberdayaan Masyarakat'),
(4, 'Pengelola Kepegawaian'),
(5, 'Penata Keuangan'),
(6, 'Analisis Jabatan'),
(7, 'Pengelola Surat'),
(8, 'Pengadministrasi Umum'),
(9, 'Pengadministrasi Perencanaan dan Program'),
(10, 'Pengemudi'),
(11, 'Analis Rehabitilasi dan Konservasi'),
(12, 'Analis Informasi Sumber Daya Hutan'),
(13, 'Analis Pengembangan Hutan'),
(14, 'Pengelola Pelestarian Sumber Daya Alam'),
(15, 'Pengadministrasi Program dan Kerjasama'),
(16, 'Analis Permasalahan Hukum'),
(17, 'Analis Layanan Umum'),
(18, 'Analis Kebakaran'),
(19, 'Pengolah Data'),
(20, 'Pengelola Perhutanan Sosial dan Aneka Usaha'),
(21, 'Pengadministrasi Pelatihan'),
(22, 'Pengadministrasi Persuratan'),
(23, 'Penyuluh Kehutanan'),
(24, 'Polisi Kehutanan');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_11_13_153128_create_divisis_table', 1),
(5, '2021_11_14_152052_create_surat_masuks_table', 1),
(6, '2021_11_14_152114_create_surat_keluars_table', 1),
(7, '2021_11_14_152129_create_roles_table', 1),
(8, '2021_11_14_160000_create_users_table', 1),
(9, '2021_11_16_170321_month', 2),
(10, '2021_11_16_171158_create_months_table', 3),
(11, '2021_11_19_184151_create_beritas_table', 4),
(12, '2021_11_19_184557_create_galeris_table', 4),
(13, '2021_11_19_185617_create_profils_table', 4),
(14, '2021_11_19_185640_create_informasis_table', 4),
(15, '2017_08_11_073824_create_menus_wp_table', 5),
(16, '2017_08_11_074006_create_menu_items_wp_table', 5),
(17, '2021_12_18_151921_create_categories_table', 6),
(18, '2021_12_18_151950_create_tags_table', 6),
(19, '2021_12_18_152022_create_beritas_table', 6),
(20, '2021_12_18_152038_create_tags_beritas_table', 7),
(21, '2021_12_18_152055_create_categories_beritas_table', 7),
(22, '2021_12_18_201918_create_berita_category_table', 8),
(23, '2021_12_18_201942_create_berita_tag_table', 8),
(24, '2021_12_19_184557_create_galeris_table', 9),
(25, '2021_12_22_213430_create_pangkats_table', 10),
(26, '2021_12_22_213454_create_jabatans_table', 10),
(27, '2021_12_22_213540_create_eselons_table', 10),
(28, '2021_12_22_215553_create_pegawais_table', 10),
(29, '2021_12_22_215554_create_pegawais_table', 11),
(30, '2021_12_24_081557_create_galeris_table', 12),
(31, '2021_12_24_082519_create_galeri_file_table', 12),
(32, '2021_12_24_082519_create_file_galeri_table', 13),
(33, '2021_12_24_082936_create_category_galeri_table', 13),
(34, '2021_12_24_082955_create_galeri_tag_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `pangkats`
--

CREATE TABLE `pangkats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pangkat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang` char(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pangkats`
--

INSERT INTO `pangkats` (`id`, `pangkat`, `golongan`, `ruang`) VALUES
(1, 'Juru Muda', 'I', 'A'),
(2, 'Juru Muda Tingkat I', 'I', 'B'),
(3, 'Juru', 'I', 'C'),
(4, 'Juru Tingkat I', 'I', 'D'),
(5, 'Pengatur Muda', 'II', 'A'),
(6, 'Pengatur Muda Tingkat I', 'II', 'B'),
(7, 'Pengatur', 'II', 'C'),
(8, 'Pengatur Tingkat I', 'II', 'D'),
(9, 'Penata Muda', 'III', 'A'),
(10, 'Penata Muda Tingkat I', 'III', 'B'),
(11, 'Penata', 'III', 'C'),
(12, 'Penata Tingkat I', 'III', 'D'),
(13, 'Pembina Muda', 'IV', 'A'),
(14, 'Pembina Muda Tingkat I', 'IV', 'B'),
(15, 'Pembina', 'IV', 'C'),
(16, 'Pembina Tingkat I', 'IV', 'D'),
(17, 'Pembina Utama', 'IV', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar_depan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_depan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_belakang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `eselon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `divisi_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `gelar_depan`, `nama_depan`, `nama_belakang`, `gelar_belakang`, `status`, `nip`, `pangkat_id`, `jabatan_id`, `eselon_id`, `divisi_id`, `email`, `picture`, `keterangan`) VALUES
('60beb1db-47b4-440d-85dc-44a1ac1f7233', NULL, 'Erni', 'Kusumawati', 'S.Hut, M.Si.', '1', '197706062007012024', 12, 3, 7, 'ba5c192c-82b8-494b-b299-8b0fc36b68d3', NULL, 'pegawai/43e64d9ce4017c2d8c731bb1173d0400.jpg', NULL),
('74eb6057-0951-49d6-8b18-7424ae5f816b', 'H.', 'Nuzul', 'Rakhman', 'S.H.', '1', '196911271992031008', 12, 2, 7, '94fb267c-528c-4a59-a20b-91cf15c4a807', NULL, 'pegawai/50a6a0a61f090d07b58d2eb270490bd5.jpg', NULL),
('83eb74eb-8474-4729-8120-a05929404598', NULL, 'Suhartono', NULL, 'S.Sos.', '1', '196404151984031005', 12, 14, NULL, 'ba5c192c-82b8-494b-b299-8b0fc36b68d3', NULL, 'pegawai/dc66a87ad913ab58a55e73b9a6aca9f8.jpg', NULL),
('9cd06be7-c83f-4b37-b24d-1b77d5975ea9', NULL, 'Warsono', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, 'pegawai/971e3e7f0553850e50183fe2a3cae43e.jpg', NULL),
('f1710fb5-275b-4b1b-af8e-2dd477e39b75', 'H.', 'Rusmadi', NULL, 'S. Hut. M.Si,', '1', '196811061990101001', 13, 1, 6, '5c4b32de-c947-4e91-b3a9-7c82666b881c', NULL, 'pegawai/679993aa5b5bb1b2175c346c832f9f28.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profils`
--

CREATE TABLE `profils` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profils`
--

INSERT INTO `profils` (`id`, `nama`, `slug`, `body`, `created_at`, `updated_at`) VALUES
('10d575f6-278e-4634-a237-fce4e6aebd0d', 'Ketugasan', 'ketugasan', '<p>34t423tv34 t34 t34</p>', NULL, '2021-11-21 11:41:04'),
('55694491-1395-4ca7-9a0a-ce05ebe59213', 'Visi dan Misi', 'visi-dan-misi', '', NULL, NULL),
('6c64237b-bacc-48d4-a8bb-c84c5bdc3cde', 'Struktur Organisasi', 'struktur-organisasi', '', NULL, NULL),
('742932f2-1f52-4c82-9c1f-b29d54c1e2bc', 'Tentang', 'tentang', 'Hutan Kalimantan yang memiliki keanekaragaman hayati yang kompleks, memerlukan tenaga profesional rimbawan dalam  pengoptimalan dalam mengelola Sumber Daya Alam (SDA) tersebut. Sebagai penyetak generasi muda yang memiliki ketrampilan manajemen dan mengelola hasil hutan Fakultas yang tergolong tertua ini pun didirikan berdasarkan Surat Keputusan (SK) Mendikbud No. 130 tanggal 25 September 1962. Hingga pada decade tahun 1980-an, kemajuan dalam pemercepatan Fakultas  Kehutanan Universitas Mulawarman dengan mendapatkan dukungan oleh kehadiran 2 proyek bantuan luar negeri yaitu GTZ (Jerman) dan JICA (Jepang). Dengan adanya proyek ini sangat terasa, diantaranya mendorong pendidikan lanjutan yang diperuntukkan bagi dosen pengajar, selain itu digunakan dalam pengembangan alat-alat praktikum di laboratorium.     Tak hanya jenjang pendidikan Strata-1 (S1), namun hingga kini didalam Fakultas Kehutanan terbesar ke-2 setelah Institut Pertanian Bogor (IPB) ini telah terdapat jenjang pendidikan S2 dan S3. Selain untuk mendukung kegiatan perkuliahan dan penerapan ilmu kehutanan yang didapatkan dalam kelas terdapat Hutan Pendidikan sebagai wadah penelitian atau pendidikan.  Hutan Pendidikan & Pelatihan Bukit Soeharto (HPPBS)  Bagi anda yang baru pertama kali ke Samarinda yang melewati kota Balikpapan menuju kota Tepian, jangan salah jika dalam perjalanan menemui sebuah hutan disebelah kanan-kiri terpampang tulisan “Hutan Penelitian Universitas Mulawarman” hal tersebut bukan berarti disitu kampus yang kerap dipanggil Unmul itu berada. Hutan Bukit Soeharto, begitulah kiranya area hutan penelitian dan pendidikan dengan seluas 20.271 Ha itu berada di kabupaten Kutai Kartanegara yang merupakan sebagian dari beberapa fasilitas yang dimiliki oleh Fakultas Kehutanan.   Kawasan Taman Hutan Raya Bukit Soeharto memiliki beberapa tipe ekosistem antara lain, hutan campuran Dipterocarpaceae dataran rendah, hutan kerangas, hutan pantai, semak belukar dan alang-alang.Potensi flora, fauna, wisata alam dan pendidikan lingkungan sebagai berikut :   1. Potensi Flora Taman Hutan Raya Bukit Soeharto merupakan tempat sebaran beberapa jenis fauna antara lain : Meranti (Shorea spp.), Keruing (Dipterocarpus sp.), Mahang (Macaranga sp.), Mengkungan (Macaranga gigantea), Ara (Ficus sp.), Medang, Kapur (Dryobalanops spp.), Kayu tahan (Anisoptera costata), Nyatoh (Palaquium spp.), Keranji (Dialium spp.), Perupuk (Lophopetalum solenospermum) dan lain-lain.   2. Potensi Fauna Taman Hutan Raya Bukit Soeharto merupakan tempat sebaran beberapa jenis fauna antara lain : Orang utan (Pongo pygmaeus), terdapat di fasilitas rehabilitasi orang utan di Pusat reintroduksi Orang Utan Wanariset Samboja, Beruang madu (Helarctos malayanus), Macan Dahan (Neofelis nebulosa), Landak (Hystrix brachyura) dan lain-lain   3. Potensi Wisata Alam dan Pendidikan Lingkungan Di dalam kawasan Taman Hutan Raya Bukit Soeharto terdapat objek wisata pantai Tanah Merah Samboja,hutan pendidikan Universitas Mulawarman dan Pusat Reintroduksi Orangutan Wanariset Samboja.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role`, `created_at`, `updated_at`) VALUES
('219dd050-96b9-47bb-9727-b6cf6a84fac8', 'Kepala', 'Kepala UPTD', '2021-12-02 02:49:42', '2021-12-18 01:59:27'),
('6539054c-6aa5-48ec-bc3b-a235f135c923', 'Super Admin', 'Administrator', '2021-11-14 11:12:07', '2021-11-14 11:12:07'),
('71e61563-591c-4800-8485-ae51f509bdf9', 'Admin', 'Staf TU', '2021-11-29 00:45:19', '2021-11-29 00:45:19'),
('73e819e5-0a2f-4493-9b4f-61bb02c5c03c', 'Kepala TU', 'Kepala TU', '2021-12-02 02:48:17', '2021-12-18 01:59:16'),
('f7e9d614-e732-4669-9a8f-4c719f29a6af', 'User', 'Ketua Divisi', '2021-11-14 11:12:17', '2021-11-14 11:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluars`
--

CREATE TABLE `surat_keluars` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_validasi` timestamp NULL DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuks`
--

CREATE TABLE `surat_masuks` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noted` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanda_tangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_agenda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isValid` tinyint(1) NOT NULL DEFAULT 0,
  `isDisposisi` tinyint(1) DEFAULT 0,
  `isDistribusi` tinyint(1) DEFAULT 0,
  `isDibaca` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_validasi` timestamp NULL DEFAULT NULL,
  `tanggal_disposisi` timestamp NULL DEFAULT NULL,
  `tanggal_dibaca` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(9, 'cgn'),
(10, 'fjrjtr5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `divisi_id`, `nama`, `email`, `email_verified_at`, `password`, `picture`, `remember_token`, `created_at`, `updated_at`) VALUES
('0797f5f9-7312-4d6d-ac1a-803af987af32', '71e61563-591c-4800-8485-ae51f509bdf9', '94fb267c-528c-4a59-a20b-91cf15c4a807', 'Admin', 'admin@admin.com', NULL, '$2y$10$/tTOYnp0s6/WBuvj86c1suy/H1xe/ndz4hr.PepW1pOO24ZAUuBUm', 'picture/c71baf139c7c4221c18f46214a9736d7.jpg', NULL, '2021-11-14 08:18:23', '2021-12-04 17:36:21'),
('36fb1c25-6d10-475e-9ef8-18cdedcc9023', 'f7e9d614-e732-4669-9a8f-4c719f29a6af', 'ba5c192c-82b8-494b-b299-8b0fc36b68d3', 'Divisi Perlindungan, KSDAE dan Pemberdayaan Masyarakat', 'divisi2@gmail.com', NULL, '$2y$10$jVq8m3ijNykKUm4FYYm95eK5Oc9BvIf/Hl78MOJxcfncG2DUCd6TS', 'picture/efe83823cac0b66cc04f70c1c3d8975e.jpg', NULL, '2021-12-04 17:31:05', '2021-12-04 17:31:05'),
('4bbe7ad3-03f7-4a46-8bf4-da1a54349d50', '219dd050-96b9-47bb-9727-b6cf6a84fac8', '5c4b32de-c947-4e91-b3a9-7c82666b881c', 'Kepala UPTD', 'uptd@gmail.com', NULL, '$2y$10$/tTOYnp0s6/WBuvj86c1suy/H1xe/ndz4hr.PepW1pOO24ZAUuBUm', 'picture/f7cb38335c82d63230072edb79fb61b5.png', NULL, '2021-12-02 20:52:26', '2021-12-18 02:00:19'),
('53e5335e-1422-4c76-8517-a15fb26efe80', '73e819e5-0a2f-4493-9b4f-61bb02c5c03c', '94fb267c-528c-4a59-a20b-91cf15c4a807', 'Kepala TU', 'kepalaTU@gmail.com', NULL, '$2y$10$/tTOYnp0s6/WBuvj86c1suy/H1xe/ndz4hr.PepW1pOO24ZAUuBUm', 'picture/027670596d1e373d531f24e13abc7205.jpg', NULL, NULL, '2021-12-18 01:59:55'),
('84b7c6e1-fb66-4270-998a-6df8c695e96e', 'f7e9d614-e732-4669-9a8f-4c719f29a6af', 'b7c54b1e-2b59-489b-9b5b-d95cc633f0df', 'Divisi Perencanaan dan Pemanfaatan Hutan', 'divisi1@gmail.com', NULL, '$2y$10$MyaQQcDHN.2gMMGuXxKKuuqcU05BpBFHLajK1j9FQR2XxrVFtZGWW', 'picture/c828e27fbdd332d8d3123449fda5dbd4.jpg', NULL, '2021-12-04 17:30:31', '2021-12-04 17:30:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita_category`
--
ALTER TABLE `berita_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_category_berita_id_foreign` (`berita_id`),
  ADD KEY `berita_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_tag_berita_id_foreign` (`berita_id`),
  ADD KEY `berita_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_galeri`
--
ALTER TABLE `category_galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_galeri_galeri_id_foreign` (`galeri_id`),
  ADD KEY `category_galeri_category_id_foreign` (`category_id`);

--
-- Indexes for table `divisis`
--
ALTER TABLE `divisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eselons`
--
ALTER TABLE `eselons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_galeris`
--
ALTER TABLE `file_galeris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_galeri_galeri_id_foreign` (`galeri_id`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri_tag`
--
ALTER TABLE `galeri_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_tag_galeri_id_foreign` (`galeri_id`),
  ADD KEY `galeri_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `informasis`
--
ALTER TABLE `informasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkats`
--
ALTER TABLE `pangkats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`),
  ADD UNIQUE KEY `pegawais_email_unique` (`email`),
  ADD KEY `pegawais_pangkat_id_foreign` (`pangkat_id`),
  ADD KEY `pegawais_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `pegawais_eselon_id_foreign` (`eselon_id`),
  ADD KEY `pegawais_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suratkeluars_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `surat_masuks`
--
ALTER TABLE `surat_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_masuks_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_divisi_id_foreign` (`divisi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `berita_category`
--
ALTER TABLE `berita_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `berita_tag`
--
ALTER TABLE `berita_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category_galeri`
--
ALTER TABLE `category_galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eselons`
--
ALTER TABLE `eselons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_galeris`
--
ALTER TABLE `file_galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `galeri_tag`
--
ALTER TABLE `galeri_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pangkats`
--
ALTER TABLE `pangkats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `berita_category`
--
ALTER TABLE `berita_category`
  ADD CONSTRAINT `berita_category_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `berita_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD CONSTRAINT `berita_tag_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `beritas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `berita_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_galeri`
--
ALTER TABLE `category_galeri`
  ADD CONSTRAINT `category_galeri_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_galeri_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file_galeris`
--
ALTER TABLE `file_galeris`
  ADD CONSTRAINT `file_galeri_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galeri_tag`
--
ALTER TABLE `galeri_tag`
  ADD CONSTRAINT `galeri_tag_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galeri_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawais_eselon_id_foreign` FOREIGN KEY (`eselon_id`) REFERENCES `eselons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawais_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawais_pangkat_id_foreign` FOREIGN KEY (`pangkat_id`) REFERENCES `pangkats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD CONSTRAINT `suratkeluars_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuks`
--
ALTER TABLE `surat_masuks`
  ADD CONSTRAINT `surat_masuks_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
