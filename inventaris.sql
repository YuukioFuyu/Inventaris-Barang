-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 02:40 PM
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
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Akun Tidak Memiliki Semua Akses Menu'),
(2, 'Staff', 'Akun Memiliki Akses Menu Terbatas'),
(3, 'Guest', 'Akun Tidak Memiliki Akses Menu');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(39) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(1, 'menu_dashboard', NULL),
(2, 'menu_crud_builder', NULL),
(3, 'menu_api_builder', NULL),
(4, 'menu_page_builder', NULL),
(5, 'menu_form_builder', NULL),
(6, 'menu_menu', NULL),
(7, 'menu_auth', NULL),
(8, 'menu_user', NULL),
(9, 'menu_group', NULL),
(10, 'menu_akses', NULL),
(11, 'menu_permission', NULL),
(12, 'menu_api_documentation', NULL),
(13, 'menu_web_documentation', NULL),
(14, 'menu_settings', NULL),
(15, 'user_list', NULL),
(16, 'user_update_status', NULL),
(17, 'user_export', NULL),
(18, 'user_add', NULL),
(19, 'user_update', NULL),
(20, 'user_update_profile', NULL),
(21, 'user_update_password', NULL),
(22, 'user_profile', NULL),
(23, 'user_view', NULL),
(24, 'user_delete', NULL),
(25, 'blog_list', NULL),
(26, 'blog_export', NULL),
(27, 'blog_add', NULL),
(28, 'blog_update', NULL),
(29, 'blog_view', NULL),
(30, 'blog_delete', NULL),
(31, 'form_list', NULL),
(32, 'form_export', NULL),
(33, 'form_add', NULL),
(34, 'form_update', NULL),
(35, 'form_view', NULL),
(36, 'form_manage', NULL),
(37, 'form_delete', NULL),
(38, 'crud_list', NULL),
(39, 'crud_export', NULL),
(40, 'crud_add', NULL),
(41, 'crud_update', NULL),
(42, 'crud_view', NULL),
(43, 'crud_delete', NULL),
(44, 'rest_list', NULL),
(45, 'rest_export', NULL),
(46, 'rest_add', NULL),
(47, 'rest_update', NULL),
(48, 'rest_view', NULL),
(49, 'rest_delete', NULL),
(50, 'group_list', NULL),
(51, 'group_export', NULL),
(52, 'group_add', NULL),
(53, 'group_update', NULL),
(54, 'group_view', NULL),
(55, 'group_delete', NULL),
(56, 'permission_list', NULL),
(57, 'permission_export', NULL),
(58, 'permission_add', NULL),
(59, 'permission_update', NULL),
(60, 'permission_view', NULL),
(61, 'permission_delete', NULL),
(62, 'akses_list', NULL),
(63, 'akses_add', NULL),
(64, 'akses_update', NULL),
(65, 'menu_list', NULL),
(66, 'menu_add', NULL),
(67, 'menu_update', NULL),
(68, 'menu_delete', NULL),
(69, 'menu_save_ordering', NULL),
(70, 'menu_type_add', NULL),
(71, 'page_list', NULL),
(72, 'page_export', NULL),
(73, 'page_add', NULL),
(74, 'page_update', NULL),
(75, 'page_view', NULL),
(76, 'page_delete', NULL),
(77, 'setting', NULL),
(78, 'setting_update', NULL),
(79, 'menu_builder', ''),
(80, 'menu_akun', ''),
(81, 'menu_other', ''),
(82, 'menu_kofigurasi', ''),
(88, 'jabatan_add', ''),
(89, 'jabatan_update', ''),
(90, 'jabatan_view', ''),
(91, 'jabatan_delete', ''),
(92, 'jabatan_list', ''),
(113, 'menu_data_utama', ''),
(114, 'menu_karyawan', ''),
(115, 'menu_agama', ''),
(116, 'menu_barang', ''),
(117, 'menu_jabatan', ''),
(118, 'menu_ruangan', ''),
(124, 'blog_category_add', ''),
(125, 'blog_category_update', ''),
(126, 'blog_category_view', ''),
(127, 'blog_category_delete', ''),
(128, 'blog_category_list', ''),
(129, 'menu_blog', ''),
(130, 'menu_creat_blog', ''),
(131, 'menu_category', ''),
(132, 'form_pengajuan_pinjam_barang_add', ''),
(133, 'form_pengajuan_pinjam_barang_update', ''),
(134, 'form_pengajuan_pinjam_barang_view', ''),
(135, 'form_pengajuan_pinjam_barang_delete', ''),
(136, 'menu_home', ''),
(137, 'menu_pengajuan', ''),
(138, 'menu_input_pengajuan', ''),
(139, 'menu_view', ''),
(150, 'menu_pengembalian', ''),
(151, 'menu_input_barang_kembali', ''),
(152, 'menu_data_peminjam', ''),
(182, 'disposal_add', ''),
(183, 'disposal_update', ''),
(184, 'disposal_view', ''),
(185, 'disposal_delete', ''),
(186, 'disposal_list', ''),
(187, 'menu_disposal', ''),
(188, 'menu_input_disposal', ''),
(189, 'retur_add', ''),
(190, 'retur_update', ''),
(191, 'retur_view', ''),
(192, 'retur_delete', ''),
(193, 'retur_list', ''),
(194, 'menu_retur', ''),
(195, 'menu_input_retur', ''),
(196, 'karyawan_add', ''),
(197, 'karyawan_update', ''),
(198, 'karyawan_view', ''),
(199, 'karyawan_delete', ''),
(200, 'karyawan_list', ''),
(206, 'menu_peminjaman', ''),
(207, 'menu_input_peminjaman', ''),
(208, 'menu_crud', ''),
(209, 'departemen_add', ''),
(210, 'departemen_update', ''),
(211, 'departemen_view', ''),
(212, 'departemen_delete', ''),
(213, 'departemen_list', ''),
(214, 'menu_departemen', ''),
(215, 'supplier_add', ''),
(216, 'supplier_update', ''),
(217, 'supplier_view', ''),
(218, 'supplier_delete', ''),
(219, 'supplier_list', ''),
(220, 'lokasi_add', ''),
(221, 'lokasi_update', ''),
(222, 'lokasi_view', ''),
(223, 'lokasi_delete', ''),
(224, 'lokasi_list', ''),
(225, 'menu_supplier', ''),
(226, 'menu_lokasi', ''),
(227, 'jenis_pengadaan_add', ''),
(228, 'jenis_pengadaan_update', ''),
(229, 'jenis_pengadaan_view', ''),
(230, 'jenis_pengadaan_delete', ''),
(231, 'jenis_pengadaan_list', ''),
(232, 'menu_jenis_pengadaan', ''),
(233, 'menu_kategori', ''),
(234, 'kategori_add', ''),
(235, 'kategori_update', ''),
(236, 'kategori_view', ''),
(237, 'kategori_delete', ''),
(238, 'kategori_list', ''),
(239, 'menu_pengadaan', ''),
(240, 'menu_input_pengadaan', ''),
(246, 'menu_data_barang', ''),
(247, 'penempatan_add', ''),
(248, 'penempatan_update', ''),
(249, 'penempatan_view', ''),
(250, 'penempatan_delete', ''),
(251, 'penempatan_list', ''),
(252, 'menu_penempatan', ''),
(253, 'menu_input_penempatan', ''),
(254, 'barang_add', ''),
(255, 'barang_update', ''),
(256, 'barang_view', ''),
(257, 'barang_delete', ''),
(258, 'barang_list', ''),
(259, 'pengajuan_add', ''),
(260, 'pengajuan_update', ''),
(261, 'pengajuan_view', ''),
(262, 'pengajuan_delete', ''),
(263, 'pengajuan_list', ''),
(264, 'pengembalian_add', ''),
(265, 'pengembalian_update', ''),
(266, 'pengembalian_view', ''),
(267, 'pengembalian_delete', ''),
(268, 'pengembalian_list', ''),
(274, 'menu_mutasi', ''),
(275, 'menu_input_mutasi', ''),
(276, 'pengadaan_add', ''),
(277, 'pengadaan_update', ''),
(278, 'pengadaan_view', ''),
(279, 'pengadaan_delete', ''),
(280, 'pengadaan_list', ''),
(286, 'mutasi_add', ''),
(287, 'mutasi_update', ''),
(288, 'mutasi_view', ''),
(289, 'mutasi_delete', ''),
(290, 'mutasi_list', ''),
(291, 'menu_informasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_perm_to_group`
--

INSERT INTO `aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(116, 0),
(117, 0),
(1, 5),
(139, 5),
(150, 5),
(151, 5),
(194, 5),
(195, 5),
(206, 5),
(207, 5),
(246, 5),
(20, 5),
(21, 5),
(22, 5),
(189, 5),
(191, 5),
(193, 5),
(256, 5),
(258, 5),
(259, 5),
(261, 5),
(263, 5),
(264, 5),
(266, 5),
(268, 5),
(1, 6),
(139, 6),
(239, 6),
(278, 6),
(280, 6),
(1, 3),
(1, 2),
(131, 2),
(136, 2),
(137, 2),
(138, 2),
(139, 2),
(150, 2),
(151, 2),
(152, 2),
(194, 2),
(195, 2),
(206, 2),
(207, 2),
(208, 2),
(214, 2),
(225, 2),
(226, 2),
(232, 2),
(233, 2),
(239, 2),
(240, 2),
(246, 2),
(252, 2),
(253, 2),
(274, 2),
(275, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(132, 2),
(133, 2),
(134, 2),
(135, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(189, 2),
(190, 2),
(191, 2),
(192, 2),
(193, 2),
(247, 2),
(248, 2),
(249, 2),
(250, 2),
(251, 2),
(254, 2),
(255, 2),
(256, 2),
(257, 2),
(258, 2),
(259, 2),
(260, 2),
(261, 2),
(262, 2),
(263, 2),
(264, 2),
(265, 2),
(266, 2),
(267, 2),
(268, 2),
(276, 2),
(277, 2),
(278, 2),
(279, 2),
(280, 2),
(286, 2),
(287, 2),
(288, 2),
(289, 2),
(290, 2),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(129, 1),
(130, 1),
(131, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(150, 1),
(151, 1),
(152, 1),
(187, 1),
(188, 1),
(194, 1),
(195, 1),
(206, 1),
(207, 1),
(208, 1),
(214, 1),
(225, 1),
(226, 1),
(232, 1),
(233, 1),
(239, 1),
(240, 1),
(246, 1),
(252, 1),
(253, 1),
(274, 1),
(275, 1),
(291, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(215, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(276, 1),
(277, 1),
(278, 1),
(279, 1),
(280, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(225) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user`
--

CREATE TABLE `aauth_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `avatar` text NOT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `top_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `full_name`, `avatar`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `top_secret`, `ip_address`) VALUES
(1, '', '3783a5063e48003fd64eb62d2f06125430b4d63e62aeda455564932654079c80', 'admin', 'Administrator', '', 0, NULL, NULL, '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '6egq9NoGxYKnb21w', NULL, NULL, NULL),
(2, '', '966184da7770dec434b72a7e46f70fea2a226edbd8a6f4e843bcfe1fd366f804', 'staff', 'Staff', '', 0, NULL, NULL, '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '', NULL, NULL, NULL),
(3, '', '80122e8b1bf742d2f44cd20e3e4b1e71e43984b87c74bec68ec227c9103d41e5', 'guest', 'Guest', '', 0, NULL, NULL, '2022-09-08 00:00:00', NULL, '2022-09-08 00:00:00', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen'),
(3, 'Hindu'),
(4, 'Budha'),
(5, 'Katholik'),
(6, 'Protestan');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` int(11) UNSIGNED NOT NULL,
  `captcha_time` int(10) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(47, 1687389895, '::1', 'J4FO'),
(48, 1687389909, '::1', 'H54R'),
(49, 1687390628, '::1', '2G3Z');

-- --------------------------------------------------------

--
-- Table structure for table `cc_options`
--

CREATE TABLE `cc_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cc_options`
--

INSERT INTO `cc_options` (`id`, `option_name`, `option_value`) VALUES
(1, 'active_theme', 'cicool'),
(2, 'favicon', 'yuuki0.webp'),
(3, 'site_name', 'Sistem Inventaris'),
(4, 'site_logo', NULL),
(5, 'email', 'email@yuuki0.net'),
(6, 'author', 'Yuukio Fuyu'),
(7, 'site_organization', NULL),
(8, 'site_description', 'Sistem Pengelola Data Inventaris Barang'),
(9, 'keywords', 'Aplikasi Inventaris Barang\r\nManajemen Inventaris Barang\r\nSistem Inventaris Barang\r\nSoftware Inventaris Barang\r\nAplikasi Pengelolaan Stok Barang\r\nSistem Manajemen Inventaris\r\nAplikasi Tracking Barang\r\nInventarisasi Barang Digital\r\nAplikasi Pencatatan Inventaris\r\nAlat Inventaris Barang Online'),
(10, 'landing_page_id', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `cc_session`
--

CREATE TABLE `cc_session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `title`, `subject`, `table_name`, `primary_key`, `page_read`, `page_create`, `page_update`) VALUES
(2, 'Jabatan', 'Jabatan', 'jabatan', 'id_jabatan', 'yes', 'yes', 'yes'),
(8, 'Blog', 'Blog', 'blog', 'id', 'yes', 'yes', 'yes'),
(9, 'Blog Category', 'Blog Category', 'blog_category', 'category_id', 'yes', 'yes', 'yes'),
(18, 'Disposal', 'Disposal', 'disposal', 'id_disposal', 'yes', 'yes', 'yes'),
(19, 'Retur', 'Retur', 'retur', 'id_retur', 'yes', 'yes', 'yes'),
(20, 'Data Peminjam', 'Data Peminjam', 'karyawan', 'id_karyawan', 'yes', 'yes', 'yes'),
(22, 'Departemen', 'Departemen', 'departemen', 'id_dep', 'yes', 'yes', 'yes'),
(23, 'Supplier', 'Supplier', 'supplier', 'id_sup', 'yes', 'yes', 'yes'),
(24, 'Lokasi', 'Lokasi', 'lokasi', 'id_lok', 'yes', 'yes', 'yes'),
(25, 'Jenis Pengadaan', 'Jenis Pengadaan', 'jenis_pengadaan', 'id_jenis_pendagaan', 'yes', 'yes', 'yes'),
(26, 'Kategori', 'Kategori', 'kategori', 'id_kategori', 'yes', 'yes', 'yes'),
(28, 'Penempatan', 'Penempatan', 'penempatan', 'id_penempatan', 'yes', 'yes', 'yes'),
(29, 'Barang', 'Barang', 'barang', 'id_barang', 'yes', 'yes', 'yes'),
(30, 'Peminjaman', 'Peminjaman', 'pengajuan', 'id_pengajuan', 'yes', 'yes', 'yes'),
(31, 'Pengembalian', 'Pengembalian', 'pengembalian', 'id_kembali', 'yes', 'yes', 'yes'),
(33, 'Pengadaan', 'Pengadaan', 'pengadaan', 'id_pengadaan', 'yes', 'yes', 'yes'),
(35, 'Mutasi', 'Mutasi', 'mutasi', 'id_mutasi', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `crud_custom_option`
--

CREATE TABLE `crud_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud_custom_option`
--

INSERT INTO `crud_custom_option` (`id`, `crud_field_id`, `crud_id`, `option_value`, `option_label`) VALUES
(11, 175, 4, 'Laki-laki', 'Laki-laki'),
(12, 175, 4, 'Perempuan', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field`
--

CREATE TABLE `crud_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_form` varchar(10) DEFAULT NULL,
  `show_update_form` varchar(10) DEFAULT NULL,
  `show_detail_page` varchar(10) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud_field`
--

INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
(1, 1, 'id_agama', 'number', '', '', '', 'yes', 1, '', '', ''),
(2, 1, 'agama', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3, 2, 'id_jabatan', 'number', '', '', '', 'yes', 1, '', '', ''),
(4, 2, 'jabatan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(15, 5, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(16, 5, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(17, 5, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(27, 6, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(28, 6, 'nama_pemohon', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap'),
(29, 6, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang'),
(30, 6, 'jumlah_barang', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(31, 6, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(32, 6, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'ruangan', 'ruangan', 'ruangan'),
(33, 6, 'tanggal_pinjam', 'date', '', 'yes', 'yes', 'yes', 7, '', '', ''),
(34, 6, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(35, 6, 'tanggal_input', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(36, 7, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(37, 7, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(38, 7, 'stok', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(39, 7, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(40, 3, 'id_ruangan', 'number', '', '', '', 'yes', 1, '', '', ''),
(41, 3, 'ruangan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(42, 3, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(63, 9, 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(64, 9, 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(65, 9, 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(66, 8, 'id', 'number', '', '', '', 'yes', 1, '', '', ''),
(67, 8, 'title', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(68, 8, 'content', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(69, 8, 'image', 'file', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(70, 8, 'category', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'blog_category', 'category_name', 'category_name'),
(71, 8, 'created_at', 'datetime', 'yes', '', '', 'yes', 6, '', '', ''),
(72, 10, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(73, 10, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(74, 10, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(75, 10, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(111, 12, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(112, 12, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik'),
(113, 12, 'nama_pemohon', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'karyawan', 'nama_lengkap', 'nama_lengkap'),
(114, 12, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(115, 12, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang'),
(116, 12, 'jumlah_barang', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(117, 12, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan'),
(118, 12, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(119, 12, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(120, 12, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(121, 13, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(122, 13, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik'),
(123, 13, 'nama_pemohon', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(124, 13, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(125, 13, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang'),
(126, 13, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(127, 13, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan'),
(128, 13, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(129, 13, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(130, 13, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(131, 14, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(132, 14, 'nik', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nik', 'nik'),
(133, 14, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(134, 14, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(135, 14, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'barang', 'nama_barang', 'nama_barang'),
(136, 14, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(137, 14, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'ruangan', 'ruangan', 'ruangan'),
(138, 14, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(139, 14, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(140, 14, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(148, 15, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(149, 15, 'nama_lengkap', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap'),
(150, 15, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(151, 15, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'barang', 'nama_barang', 'nama_barang'),
(152, 15, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(153, 15, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'ruangan', 'ruangan', 'ruangan'),
(154, 15, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(155, 15, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(156, 15, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(157, 11, 'id_kembali', 'number', '', '', '', 'yes', 1, '', '', ''),
(158, 11, 'tanggal_entry', 'timestamp', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(159, 11, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'pengajuan', 'nama_barang', 'nama_barang'),
(160, 11, 'nama_peminjam', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'pengajuan', 'nama_lengkap', 'nama_lengkap'),
(161, 11, 'jumlah', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'pengajuan', 'jumlah', 'jumlah'),
(162, 11, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(163, 11, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(164, 16, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(165, 16, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(166, 16, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(167, 16, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(168, 16, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(169, 4, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', ''),
(170, 4, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(171, 4, 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(172, 4, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jabatan', 'jabatan', 'jabatan'),
(173, 4, 'alamat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(174, 4, 'agama', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(175, 4, 'jenis_kelamin', 'custom_option', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(180, 17, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', ''),
(181, 17, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(182, 17, 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(183, 17, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jabatan', 'jabatan', 'jabatan'),
(184, 18, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(185, 18, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(186, 18, 'tipe_barang', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(187, 18, 'serial_number', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(188, 18, 'nomor_barang', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(189, 18, 'tahun', 'year', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(190, 18, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(191, 18, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(192, 18, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(200, 20, 'id_karyawan', 'number', '', '', '', 'yes', 1, '', '', ''),
(201, 20, 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(202, 20, 'telp', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(203, 20, 'nik', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(204, 20, 'jabatan', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'jabatan', 'jabatan', 'jabatan'),
(205, 21, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(206, 21, 'nama_lengkap', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawan', 'nama_lengkap', 'nama_lengkap'),
(207, 21, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang'),
(208, 21, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(209, 21, 'ruangan', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'ruangan', 'ruangan', 'ruangan'),
(210, 21, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(211, 21, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(212, 22, 'id_dep', 'number', '', '', '', 'yes', 1, '', '', ''),
(213, 22, 'nama_departemen', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(214, 22, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(215, 23, 'id_sup', 'number', '', '', '', 'yes', 1, '', '', ''),
(216, 23, 'nama_supplier', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(217, 23, 'alamat_lengkap', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(218, 23, 'no_telp', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(219, 24, 'id_lok', 'number', '', '', '', 'yes', 1, '', '', ''),
(220, 24, 'nama_lokasi', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(221, 24, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'departemen', 'nama_departemen', 'nama_departemen'),
(222, 25, 'id_jenis_pendagaan', 'number', '', '', '', 'yes', 1, '', '', ''),
(223, 25, 'jenis_pengadaan', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(224, 25, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(225, 26, 'id_kategori', 'number', '', '', '', 'yes', 1, '', '', ''),
(226, 26, 'katerogi', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(227, 26, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(237, 27, 'id_pengadaan', 'number', '', '', '', 'yes', 1, '', '', ''),
(238, 27, 'tanggal_pengadaan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(239, 27, 'supplier', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'supplier', 'nama_supplier', 'nama_supplier'),
(240, 27, 'jenis_pengadaan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jenis_pengadaan', 'jenis_pengadaan', 'jenis_pengadaan'),
(241, 27, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 5, '', '', ''),
(242, 27, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang'),
(243, 27, 'deskripsi_barang', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 7, '', '', ''),
(244, 27, 'harga', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(245, 27, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(261, 29, 'id_barang', 'number', '', '', '', 'yes', 1, '', '', ''),
(262, 29, 'nama_barang', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(263, 29, 'merek', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(264, 29, 'kategori', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'kategori', 'katerogi', 'katerogi'),
(265, 29, 'jumlah', 'number', 'yes', '', '', 'yes', 5, '', '', ''),
(266, 29, 'satuan', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(267, 29, 'gambar', 'file', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(268, 29, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 8, '', '', ''),
(275, 19, 'id_disposal', 'number', '', '', '', 'yes', 1, '', '', ''),
(276, 19, 'id_retur', 'number', '', '', '', 'yes', 1, '', '', ''),
(277, 19, 'nomor_surat', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(278, 19, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang'),
(279, 19, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(280, 19, 'penerima_barang', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen'),
(281, 19, 'berkas', 'file', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(282, 19, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(290, 31, 'id_kembali', 'number', '', '', '', 'yes', 1, '', '', ''),
(291, 31, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'barang', 'nama_barang', 'nama_barang'),
(292, 31, 'tanggal_entry', 'timestamp', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(293, 31, 'departemen_peminjam', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'departemen', 'nama_departemen', 'nama_departemen'),
(294, 31, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(295, 31, 'tanggal_kembali', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(296, 31, 'deskripsi', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(297, 30, 'id_pengajuan', 'number', '', '', '', 'yes', 1, '', '', ''),
(298, 30, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'departemen', 'nama_departemen', 'nama_departemen'),
(299, 30, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'barang', 'nama_barang', 'nama_barang'),
(300, 30, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(301, 30, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'lokasi', 'nama_lokasi', 'nama_lokasi'),
(302, 30, 'keperluan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(303, 30, 'tgl_pinjam', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(304, 32, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', ''),
(305, 32, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(306, 32, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(307, 32, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'departemen', 'nama_departemen', 'nama_departemen'),
(308, 32, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'lokasi', 'nama_lokasi', 'nama_lokasi'),
(309, 32, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang'),
(350, 33, 'id_pengadaan', 'number', '', '', '', 'yes', 1, '', '', ''),
(351, 33, 'tanggal_pengadaan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(352, 33, 'supplier', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'supplier', 'nama_supplier', 'nama_supplier'),
(353, 33, 'jenis_pengadaan', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'jenis_pengadaan', 'jenis_pengadaan', 'jenis_pengadaan'),
(354, 33, 'keterangan', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 5, '', '', ''),
(355, 33, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang'),
(356, 33, 'deskripsi_barang', 'editor_wysiwyg', '', 'yes', 'yes', 'yes', 7, '', '', ''),
(357, 33, 'harga', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(358, 33, 'total', 'number', 'yes', '', '', 'yes', 9, '', '', ''),
(359, 33, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(374, 34, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', ''),
(375, 34, 'cari_id_penempatan', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'penempatan', 'lokasi', 'id_penempatan'),
(376, 34, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(377, 34, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(378, 34, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen'),
(379, 34, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'lokasi', 'nama_lokasi', 'nama_lokasi'),
(380, 34, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'barang', 'nama_barang', 'nama_barang'),
(381, 35, 'id_mutasi', 'number', '', '', '', 'yes', 1, '', '', ''),
(382, 35, 'id_penempatan', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'penempatan', 'lokasi', 'id_penempatan'),
(383, 35, 'tanggal_mutasi', 'date', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(384, 35, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(385, 35, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'departemen', 'nama_departemen', 'nama_departemen'),
(386, 35, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'lokasi', 'nama_lokasi', 'nama_lokasi'),
(387, 35, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'barang', 'nama_barang', 'nama_barang'),
(388, 28, 'id_penempatan', 'number', 'yes', '', '', 'yes', 1, '', '', ''),
(389, 28, 'tanggal_penempatan', 'date', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(390, 28, 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'departemen', 'nama_departemen', 'nama_departemen'),
(391, 28, 'lokasi', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'lokasi', 'nama_lokasi', 'nama_lokasi'),
(392, 28, 'keterangan', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(393, 28, 'nama_barang', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'barang', 'nama_barang', 'nama_barang'),
(394, 28, 'jumlah', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field_validation`
--

CREATE TABLE `crud_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud_field_validation`
--

INSERT INTO `crud_field_validation` (`id`, `crud_field_id`, `crud_id`, `validation_name`, `validation_value`) VALUES
(1, 2, 1, 'required', ''),
(2, 2, 1, 'max_length', '10'),
(3, 4, 2, 'required', ''),
(4, 4, 2, 'max_length', '50'),
(19, 16, 5, 'required', ''),
(20, 16, 5, 'max_length', '50'),
(21, 17, 5, 'required', ''),
(34, 28, 6, 'required', ''),
(35, 28, 6, 'max_length', '50'),
(36, 29, 6, 'required', ''),
(37, 29, 6, 'max_length', '50'),
(38, 30, 6, 'required', ''),
(39, 30, 6, 'max_length', '11'),
(40, 31, 6, 'required', ''),
(41, 32, 6, 'required', ''),
(42, 32, 6, 'max_length', '50'),
(43, 33, 6, 'required', ''),
(44, 34, 6, 'required', ''),
(45, 37, 7, 'required', ''),
(46, 37, 7, 'max_length', '50'),
(47, 38, 7, 'required', ''),
(48, 38, 7, 'max_length', '11'),
(49, 39, 7, 'required', ''),
(50, 41, 3, 'required', ''),
(51, 41, 3, 'max_length', '50'),
(80, 64, 9, 'required', ''),
(81, 64, 9, 'max_length', '200'),
(82, 67, 8, 'required', ''),
(83, 67, 8, 'max_length', '200'),
(84, 68, 8, 'required', ''),
(85, 69, 8, 'allowed_extension', 'jpg,jpeg,png'),
(86, 69, 8, 'max_size', '2000'),
(87, 70, 8, 'required', ''),
(88, 70, 8, 'max_length', '200'),
(89, 71, 8, 'required', ''),
(90, 73, 10, 'required', ''),
(91, 74, 10, 'required', ''),
(92, 74, 10, 'valid_number', ''),
(128, 112, 12, 'required', ''),
(129, 113, 12, 'required', ''),
(130, 114, 12, 'required', ''),
(131, 114, 12, 'valid_number', ''),
(132, 115, 12, 'required', ''),
(133, 116, 12, 'required', ''),
(134, 116, 12, 'valid_number', ''),
(135, 117, 12, 'required', ''),
(136, 118, 12, 'required', ''),
(137, 119, 12, 'required', ''),
(138, 122, 13, 'required', ''),
(139, 123, 13, 'required', ''),
(140, 124, 13, 'required', ''),
(141, 124, 13, 'valid_number', ''),
(142, 125, 13, 'required', ''),
(143, 126, 13, 'required', ''),
(144, 126, 13, 'valid_number', ''),
(145, 127, 13, 'required', ''),
(146, 129, 13, 'required', ''),
(147, 130, 13, 'required', ''),
(148, 132, 14, 'required', ''),
(149, 133, 14, 'required', ''),
(150, 134, 14, 'required', ''),
(151, 134, 14, 'valid_number', ''),
(152, 135, 14, 'required', ''),
(153, 136, 14, 'required', ''),
(154, 136, 14, 'valid_number', ''),
(155, 137, 14, 'required', ''),
(156, 139, 14, 'required', ''),
(157, 140, 14, 'required', ''),
(163, 149, 15, 'required', ''),
(164, 150, 15, 'required', ''),
(165, 150, 15, 'valid_number', ''),
(166, 151, 15, 'required', ''),
(167, 152, 15, 'required', ''),
(168, 152, 15, 'valid_number', ''),
(169, 153, 15, 'required', ''),
(170, 155, 15, 'required', ''),
(171, 156, 15, 'required', ''),
(172, 159, 11, 'required', ''),
(173, 160, 11, 'required', ''),
(174, 161, 11, 'required', ''),
(175, 162, 11, 'required', ''),
(176, 165, 16, 'required', ''),
(177, 166, 16, 'required', ''),
(178, 166, 16, 'valid_number', ''),
(179, 167, 16, 'allowed_extension', 'jpg,jpeg,png'),
(180, 170, 4, 'required', ''),
(181, 170, 4, 'max_length', '50'),
(182, 171, 4, 'required', ''),
(183, 171, 4, 'max_length', '50'),
(184, 172, 4, 'required', ''),
(185, 172, 4, 'max_length', '50'),
(186, 173, 4, 'required', ''),
(187, 174, 4, 'max_length', '15'),
(188, 175, 4, 'required', ''),
(193, 181, 17, 'required', ''),
(194, 181, 17, 'max_length', '50'),
(195, 182, 17, 'required', ''),
(196, 183, 17, 'required', ''),
(197, 185, 18, 'required', ''),
(198, 186, 18, 'required', ''),
(199, 187, 18, 'required', ''),
(200, 188, 18, 'required', ''),
(201, 189, 18, 'required', ''),
(202, 190, 18, 'required', ''),
(203, 191, 18, 'required', ''),
(204, 192, 18, 'required', ''),
(210, 201, 20, 'required', ''),
(211, 202, 20, 'required', ''),
(212, 203, 20, 'required', ''),
(213, 204, 20, 'required', ''),
(214, 206, 21, 'required', ''),
(215, 207, 21, 'required', ''),
(216, 208, 21, 'required', ''),
(217, 209, 21, 'required', ''),
(218, 210, 21, 'required', ''),
(219, 211, 21, 'required', ''),
(220, 213, 22, 'required', ''),
(221, 216, 23, 'required', ''),
(222, 220, 24, 'required', ''),
(223, 221, 24, 'required', ''),
(224, 223, 25, 'required', ''),
(225, 226, 26, 'required', ''),
(231, 238, 27, 'required', ''),
(232, 239, 27, 'required', ''),
(233, 242, 27, 'required', ''),
(234, 244, 27, 'required', ''),
(235, 245, 27, 'required', ''),
(245, 262, 29, 'required', ''),
(246, 263, 29, 'required', ''),
(247, 264, 29, 'required', ''),
(248, 267, 29, 'allowed_extension', 'jpg,png,JPG,PNG,JPEG,jpeg'),
(254, 277, 19, 'required', ''),
(255, 278, 19, 'required', ''),
(256, 279, 19, 'required', ''),
(257, 280, 19, 'required', ''),
(264, 291, 31, 'required', ''),
(265, 292, 31, 'required', ''),
(266, 293, 31, 'required', ''),
(267, 294, 31, 'required', ''),
(268, 295, 31, 'required', ''),
(269, 298, 30, 'required', ''),
(270, 299, 30, 'required', ''),
(271, 300, 30, 'required', ''),
(272, 301, 30, 'required', ''),
(273, 302, 30, 'required', ''),
(274, 305, 32, 'required', ''),
(275, 307, 32, 'required', ''),
(276, 308, 32, 'required', ''),
(277, 309, 32, 'required', ''),
(305, 351, 33, 'required', ''),
(306, 352, 33, 'required', ''),
(307, 353, 33, 'required', ''),
(308, 355, 33, 'required', ''),
(309, 357, 33, 'required', ''),
(310, 359, 33, 'required', ''),
(321, 375, 34, 'required', ''),
(322, 376, 34, 'required', ''),
(323, 378, 34, 'required', ''),
(324, 379, 34, 'required', ''),
(325, 380, 34, 'required', ''),
(326, 382, 35, 'required', ''),
(327, 383, 35, 'required', ''),
(328, 385, 35, 'required', ''),
(329, 386, 35, 'required', ''),
(330, 387, 35, 'required', ''),
(331, 389, 28, 'required', ''),
(332, 390, 28, 'required', ''),
(333, 391, 28, 'required', ''),
(334, 393, 28, 'required', ''),
(335, 394, 28, 'required', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_type`
--

CREATE TABLE `crud_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud_input_type`
--

INSERT INTO `crud_input_type` (`id`, `type`, `relation`, `custom_value`, `validation_group`) VALUES
(1, 'input', '0', 0, 'input'),
(2, 'textarea', '0', 0, 'text'),
(3, 'select', '1', 0, 'select'),
(4, 'editor_wysiwyg', '0', 0, 'editor'),
(5, 'password', '0', 0, 'password'),
(6, 'email', '0', 0, 'email'),
(7, 'address_map', '0', 0, 'address_map'),
(8, 'file', '0', 0, 'file'),
(9, 'file_multiple', '0', 0, 'file_multiple'),
(10, 'datetime', '0', 0, 'datetime'),
(11, 'date', '0', 0, 'date'),
(12, 'timestamp', '0', 0, 'timestamp'),
(13, 'number', '0', 0, 'number'),
(14, 'yes_no', '0', 0, 'yes_no'),
(15, 'time', '0', 0, 'time'),
(16, 'year', '0', 0, 'year'),
(17, 'select_multiple', '1', 0, 'select_multiple'),
(18, 'checkboxes', '1', 0, 'checkboxes'),
(19, 'options', '1', 0, 'options'),
(20, 'true_false', '0', 0, 'true_false'),
(21, 'current_user_username', '0', 0, 'user_username'),
(22, 'current_user_id', '0', 0, 'current_user_id'),
(23, 'custom_option', '0', 1, 'custom_option'),
(24, 'custom_checkbox', '0', 1, 'custom_checkbox'),
(25, 'custom_select_multiple', '0', 1, 'custom_select_multiple'),
(26, 'custom_select', '0', 1, 'custom_select');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_validation`
--

CREATE TABLE `crud_input_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `crud_input_validation`
--

INSERT INTO `crud_input_validation` (`id`, `validation`, `input_able`, `group_input`, `input_placeholder`, `call_back`, `input_validation`) VALUES
(1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple', '', '', ''),
(2, 'max_length', 'yes', 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map', '', '', 'numeric'),
(3, 'min_length', 'yes', 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map', '', '', 'numeric'),
(4, 'valid_email', 'no', 'input, email', '', '', ''),
(5, 'valid_emails', 'no', 'input, email', '', '', ''),
(6, 'regex', 'yes', 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes', '', 'yes', 'callback_valid_regex'),
(7, 'decimal', 'no', 'input, number, text, select', '', '', ''),
(8, 'allowed_extension', 'yes', 'file, file_multiple', 'ex : jpg,png,..', '', 'callback_valid_extension_list'),
(9, 'max_width', 'yes', 'file, file_multiple', '', '', 'numeric'),
(10, 'max_height', 'yes', 'file, file_multiple', '', '', 'numeric'),
(11, 'max_size', 'yes', 'file, file_multiple', '... kb', '', 'numeric'),
(12, 'max_item', 'yes', 'file_multiple', '', '', 'numeric'),
(13, 'valid_url', 'no', 'input, text', '', '', ''),
(14, 'alpha', 'no', 'input, text, select, password, editor, yes_no', '', '', ''),
(15, 'alpha_numeric', 'no', 'input, number, text, select, password, editor', '', '', ''),
(16, 'alpha_numeric_spaces', 'no', 'input, number, text,select, password, editor', '', '', ''),
(17, 'valid_number', 'no', 'input, number, text, password, editor, true_false', '', 'yes', ''),
(18, 'valid_datetime', 'no', 'input, datetime, text', '', 'yes', ''),
(19, 'valid_date', 'no', 'input, datetime, date, text', '', 'yes', ''),
(20, 'valid_max_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(21, 'valid_min_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(22, 'valid_alpha_numeric_spaces_underscores', 'no', 'input, text,select, password, editor', '', 'yes', ''),
(23, 'matches', 'yes', 'input, number, text, password, email', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(24, 'valid_json', 'no', 'input, text, editor', '', 'yes', ' '),
(25, 'valid_url', 'no', 'input, text, editor', '', 'no', ' '),
(26, 'exact_length', 'yes', 'input, text, number', '0 - 99999*', 'no', 'numeric'),
(27, 'alpha_dash', 'no', 'input, text', '', 'no', ''),
(28, 'integer', 'no', 'input, text, number', '', 'no', ''),
(29, 'differs', 'yes', 'input, text, number, email, password, editor, options, select', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(30, 'is_natural', 'no', 'input, text, number', '', 'no', ''),
(31, 'is_natural_no_zero', 'no', 'input, text, number', '', 'no', ''),
(32, 'less_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(33, 'less_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(34, 'greater_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(35, 'greater_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(36, 'in_list', 'yes', 'input, text, number, select, options', '', 'no', 'callback_valid_multiple_value'),
(37, 'valid_ip', 'no', 'input, text', '', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_dep` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disposal`
--

CREATE TABLE `disposal` (
  `id_disposal` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `berkas` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `disposal`
--
DELIMITER $$
CREATE TRIGGER `disposal barang` AFTER INSERT ON `disposal` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah-NEW.jumlah
    WHERE nama_barang = NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `title`, `subject`, `table_name`) VALUES
(1, 'Pengajuan Pinjam Barang', 'Pengajuan Pinjam Barang', 'form_pengajuan_pinjam_barang');

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_attribute`
--

CREATE TABLE `form_custom_attribute` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_option`
--

CREATE TABLE `form_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_field`
--

CREATE TABLE `form_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `placeholder` text DEFAULT NULL,
  `auto_generate_help_block` varchar(10) DEFAULT NULL,
  `help_block` text DEFAULT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form_field`
--

INSERT INTO `form_field` (`id`, `form_id`, `sort`, `field_name`, `input_type`, `field_label`, `placeholder`, `auto_generate_help_block`, `help_block`, `relation_table`, `relation_value`, `relation_label`) VALUES
(58, 1, 1, 'nik_nidn_nim', 'select', 'NIK/NIDN/NIM', '', 'yes', '', 'karyawan', 'nik', 'nik'),
(59, 1, 2, 'nama_peminjam', 'select', 'Nama Peminjam', '', 'yes', '', 'karyawan', 'nama_lengkap', 'nama_lengkap'),
(60, 1, 3, 'no_telp_hp', 'input', 'No Telp / Hp', '', 'yes', '', '', '', ''),
(61, 1, 4, 'nama_barang', 'select', 'Nama Barang', '', 'yes', '', 'barang', 'nama_barang', 'nama_barang'),
(62, 1, 5, 'dipakai_di', 'select', 'Dipakai di', '', 'yes', '', 'ruangan', 'ruangan', 'ruangan'),
(63, 1, 6, 'digunakan_untuk', 'editor_wysiwyg', 'Digunakan Untuk', '', 'yes', '', '', '', ''),
(64, 1, 7, 'jumlah', 'input', 'Jumlah', '', 'yes', '', '', '', ''),
(65, 1, 8, 'tanggal_pinjam', 'timestamp', 'Tanggal Pinjam', '', 'yes', '', '', '', ''),
(66, 1, 9, 'tanggal_kembali', 'date', 'Tanggal Kembali', '', 'yes', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `form_field_validation`
--

CREATE TABLE `form_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `form_field_validation`
--

INSERT INTO `form_field_validation` (`id`, `form_field_id`, `form_id`, `validation_name`, `validation_value`) VALUES
(50, 58, 1, 'required', ''),
(51, 59, 1, 'required', ''),
(52, 60, 1, 'required', ''),
(53, 61, 1, 'required', ''),
(54, 62, 1, 'required', ''),
(55, 63, 1, 'required', ''),
(56, 64, 1, 'required', ''),
(57, 66, 1, 'required', '');

-- --------------------------------------------------------

--
-- Table structure for table `form_pengajuan_pinjam_barang`
--

CREATE TABLE `form_pengajuan_pinjam_barang` (
  `id` int(11) UNSIGNED NOT NULL,
  `nik_nidn_nim` varchar(225) NOT NULL,
  `nama_peminjam` varchar(225) NOT NULL,
  `no_telp_hp` varchar(225) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `dipakai_di` varchar(225) NOT NULL,
  `digunakan_untuk` text NOT NULL,
  `jumlah` varchar(225) NOT NULL,
  `tanggal_pinjam` text DEFAULT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengadaan`
--

CREATE TABLE `jenis_pengadaan` (
  `id_jenis_pendagaan` int(11) NOT NULL,
  `jenis_pengadaan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `katerogi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '7DCB64B2EC9B51D0460B856BA533D3FD', 0, 0, 0, NULL, '2018-07-18 06:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lok` int(11) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `type`, `icon_color`, `link`, `sort`, `parent`, `icon`, `menu_type_id`) VALUES
(1, 'Daftar Menu', 'label', '', 'dashboard', 1, 0, '', 1),
(2, 'Dashboard', 'menu', '', 'dashboard', 2, 0, 'fa-dashboard', 1),
(3, 'Informasi', 'menu', '', 'informasi', 100, 0, 'fa-info', 1),
(8, 'Akun', 'menu', 'default', '#', 31, 0, 'fa-user', 1),
(9, 'Pengguna', 'menu', '', 'user', 32, 8, '', 1),
(10, 'Grup', 'menu', '', 'group', 33, 8, '', 1),
(11, 'Akses', 'menu', '', 'akses', 34, 8, '', 1),
(14, 'Kofigurasi', 'menu', 'default', '#', 35, 0, 'fa-cogs', 1),
(15, 'Pengaturan', 'menu', 'text-red', 'setting', 36, 14, 'fa-circle-o', 1),
(18, 'Home', 'menu', 'default', '/', 1, 0, '', 2),
(21, 'Dashboard', 'menu', '', 'dashboard', 4, 0, '', 2),
(23, 'Data Utama', 'menu', 'default', '#', 3, 0, 'fa-database', 1),
(32, 'Peminjaman', 'menu', 'default', '#', 19, 0, 'fa-edit', 1),
(33, 'Input Peminjaman', 'menu', 'default', 'pengajuan/add', 20, 32, '', 1),
(34, 'View', 'menu', 'default', 'pengajuan', 21, 32, '', 1),
(35, 'Pengembalian', 'menu', 'default', '#', 22, 0, 'fa-undo', 1),
(36, 'Input Barang Kembali', 'menu', 'default', 'pengembalian/add', 23, 35, '', 1),
(37, 'View', 'menu', 'default', 'pengembalian', 24, 35, '', 1),
(38, 'Disposal', 'menu', 'default', 'disposal', 28, 0, 'fa-trash', 1),
(39, 'Input Disposal', 'menu', 'default', 'disposal/add', 29, 38, '', 1),
(40, 'View', 'menu', 'default', 'disposal', 30, 38, '', 1),
(41, 'Retur', 'menu', 'default', 'retur', 25, 0, 'fa-mail-reply', 1),
(42, 'Input Retur', 'menu', 'default', 'retur/add', 26, 41, '', 1),
(43, 'View', 'menu', 'default', 'retur', 27, 41, '', 1),
(47, 'Departemen', 'menu', 'default', 'departemen', 4, 23, '', 1),
(48, 'Supplier', 'menu', 'default', 'supplier', 5, 23, '', 1),
(49, 'Lokasi', 'menu', 'default', 'lokasi', 6, 23, '', 1),
(50, 'Jenis Pengadaan', 'menu', 'default', 'jenis_pengadaan', 7, 23, '', 1),
(51, 'Kategori', 'menu', 'default', 'kategori', 8, 23, '', 1),
(52, 'Pengadaan', 'menu', 'default', '#', 10, 0, 'fa-money', 1),
(53, 'View', 'menu', 'default', 'pengadaan', 12, 52, '', 1),
(54, 'Input Pengadaan', 'menu', 'default', 'pengadaan/add', 11, 52, '', 1),
(55, 'Data Barang', 'menu', 'default', 'barang', 9, 0, 'fa-briefcase', 1),
(56, 'Penempatan', 'menu', 'default', '#', 13, 0, 'fa-map-marker', 1),
(57, 'Input Penempatan', 'menu', 'default', 'penempatan/add', 14, 56, '', 1),
(58, 'View', 'menu', 'default', 'penempatan', 15, 56, '', 1),
(59, 'Mutasi', 'menu', 'default', '#', 16, 0, 'fa-cut', 1),
(60, 'Input Mutasi', 'menu', 'default', 'mutasi/add', 17, 59, '', 1),
(61, 'View', 'menu', 'default', 'mutasi', 18, 59, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_icon`
--

CREATE TABLE `menu_icon` (
  `class_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu_icon`
--

INSERT INTO `menu_icon` (`class_name`) VALUES
('fa-500px'),
('fa-adjust'),
('fa-adn'),
('fa-align'),
('fa-align'),
('fa-align'),
('fa-align'),
('fa-amazon'),
('fa-ambulance'),
('fa-american'),
('fa-anchor'),
('fa-android'),
('fa-angellist'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-apple'),
('fa-archive'),
('fa-area'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrows'),
('fa-arrows'),
('fa-arrows'),
('fa-arrows'),
('fa-asl'),
('fa-assistive'),
('fa-asterisk'),
('fa-at'),
('fa-audio'),
('fa-automobile'),
('fa-backward'),
('fa-balance'),
('fa-ban'),
('fa-bank'),
('fa-bar'),
('fa-bar'),
('fa-barcode'),
('fa-bars'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-bed'),
('fa-beer'),
('fa-behance'),
('fa-behance'),
('fa-bell'),
('fa-bell'),
('fa-bell'),
('fa-bell'),
('fa-bicycle'),
('fa-binoculars'),
('fa-birthday'),
('fa-bitbucket'),
('fa-bitbucket'),
('fa-bitcoin'),
('fa-black'),
('fa-blind'),
('fa-bluetooth'),
('fa-bluetooth'),
('fa-bold'),
('fa-bolt'),
('fa-bomb'),
('fa-book'),
('fa-bookmark'),
('fa-bookmark'),
('fa-braille'),
('fa-briefcase'),
('fa-btc'),
('fa-bug'),
('fa-building'),
('fa-building'),
('fa-bullhorn'),
('fa-bullseye'),
('fa-bus'),
('fa-buysellads'),
('fa-cab'),
('fa-calculator'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-camera'),
('fa-camera'),
('fa-car'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-cart'),
('fa-cart'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-certificate'),
('fa-chain'),
('fa-chain'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-child'),
('fa-chrome'),
('fa-circle'),
('fa-circle'),
('fa-circle'),
('fa-circle'),
('fa-clipboard'),
('fa-clock'),
('fa-clone'),
('fa-close'),
('fa-cloud'),
('fa-cloud'),
('fa-cloud'),
('fa-cny'),
('fa-code'),
('fa-code'),
('fa-codepen'),
('fa-codiepie'),
('fa-coffee'),
('fa-cog'),
('fa-cogs'),
('fa-columns'),
('fa-comment'),
('fa-comment'),
('fa-commenting'),
('fa-commenting'),
('fa-comments'),
('fa-comments'),
('fa-compass'),
('fa-compress'),
('fa-connectdevelop'),
('fa-contao'),
('fa-copy'),
('fa-copyright'),
('fa-creative'),
('fa-credit'),
('fa-credit'),
('fa-crop'),
('fa-crosshairs'),
('fa-css3'),
('fa-cube'),
('fa-cubes'),
('fa-cut'),
('fa-cutlery'),
('fa-dashboard'),
('fa-dashcube'),
('fa-database'),
('fa-deaf'),
('fa-deafness'),
('fa-dedent'),
('fa-delicious'),
('fa-desktop'),
('fa-deviantart'),
('fa-diamond'),
('fa-digg'),
('fa-dollar'),
('fa-dot'),
('fa-download'),
('fa-dribbble'),
('fa-dropbox'),
('fa-drupal'),
('fa-edge'),
('fa-edit'),
('fa-eject'),
('fa-ellipsis'),
('fa-ellipsis'),
('fa-empire'),
('fa-envelope'),
('fa-envelope'),
('fa-envelope'),
('fa-envira'),
('fa-eraser'),
('fa-eur'),
('fa-euro'),
('fa-exchange'),
('fa-exclamation'),
('fa-exclamation'),
('fa-exclamation'),
('fa-expand'),
('fa-expeditedssl'),
('fa-external'),
('fa-external'),
('fa-eye'),
('fa-eye'),
('fa-eyedropper'),
('fa-fa'),
('fa-facebook'),
('fa-facebook'),
('fa-facebook'),
('fa-facebook'),
('fa-fast'),
('fa-fast'),
('fa-fax'),
('fa-feed'),
('fa-female'),
('fa-fighter'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-files'),
('fa-film'),
('fa-filter'),
('fa-fire'),
('fa-fire'),
('fa-firefox'),
('fa-first'),
('fa-flag'),
('fa-flag'),
('fa-flag'),
('fa-flash'),
('fa-flask'),
('fa-flickr'),
('fa-floppy'),
('fa-folder'),
('fa-folder'),
('fa-folder'),
('fa-folder'),
('fa-font'),
('fa-font'),
('fa-fonticons'),
('fa-fort'),
('fa-forumbee'),
('fa-forward'),
('fa-foursquare'),
('fa-frown'),
('fa-futbol'),
('fa-gamepad'),
('fa-gavel'),
('fa-gbp'),
('fa-ge'),
('fa-gear'),
('fa-gears'),
('fa-genderless'),
('fa-get'),
('fa-gg'),
('fa-gg'),
('fa-gift'),
('fa-git'),
('fa-git'),
('fa-github'),
('fa-github'),
('fa-github'),
('fa-gitlab'),
('fa-gittip'),
('fa-glass'),
('fa-glide'),
('fa-glide'),
('fa-globe'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-graduation'),
('fa-gratipay'),
('fa-group'),
('fa-h'),
('fa-hacker'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hard'),
('fa-hashtag'),
('fa-hdd'),
('fa-header'),
('fa-headphones'),
('fa-heart'),
('fa-heart'),
('fa-heartbeat'),
('fa-history'),
('fa-home'),
('fa-hospital'),
('fa-hotel'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-houzz'),
('fa-html5'),
('fa-i'),
('fa-ils'),
('fa-image'),
('fa-inbox'),
('fa-indent'),
('fa-industry'),
('fa-info'),
('fa-info'),
('fa-inr'),
('fa-instagram'),
('fa-institution'),
('fa-internet'),
('fa-intersex'),
('fa-ioxhost'),
('fa-italic'),
('fa-joomla'),
('fa-jpy'),
('fa-jsfiddle'),
('fa-key'),
('fa-keyboard'),
('fa-krw'),
('fa-language'),
('fa-laptop'),
('fa-lastfm'),
('fa-lastfm'),
('fa-leaf'),
('fa-leanpub'),
('fa-legal'),
('fa-lemon'),
('fa-level'),
('fa-level'),
('fa-life'),
('fa-life'),
('fa-life'),
('fa-life'),
('fa-lightbulb'),
('fa-line'),
('fa-link'),
('fa-linkedin'),
('fa-linkedin'),
('fa-linux'),
('fa-list'),
('fa-list'),
('fa-list'),
('fa-list'),
('fa-location'),
('fa-lock'),
('fa-long'),
('fa-long'),
('fa-long'),
('fa-long'),
('fa-low'),
('fa-magic'),
('fa-magnet'),
('fa-mail'),
('fa-mail'),
('fa-mail'),
('fa-male'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-maxcdn'),
('fa-meanpath'),
('fa-medium'),
('fa-medkit'),
('fa-meh'),
('fa-mercury'),
('fa-microphone'),
('fa-microphone'),
('fa-minus'),
('fa-minus'),
('fa-minus'),
('fa-minus'),
('fa-mixcloud'),
('fa-mobile'),
('fa-mobile'),
('fa-modx'),
('fa-money'),
('fa-moon'),
('fa-mortar'),
('fa-motorcycle'),
('fa-mouse'),
('fa-music'),
('fa-navicon'),
('fa-neuter'),
('fa-newspaper'),
('fa-object'),
('fa-object'),
('fa-odnoklassniki'),
('fa-odnoklassniki'),
('fa-opencart'),
('fa-openid'),
('fa-opera'),
('fa-optin'),
('fa-outdent'),
('fa-pagelines'),
('fa-paint'),
('fa-paper'),
('fa-paper'),
('fa-paperclip'),
('fa-paragraph'),
('fa-paste'),
('fa-pause'),
('fa-pause'),
('fa-pause'),
('fa-paw'),
('fa-paypal'),
('fa-pencil'),
('fa-pencil'),
('fa-pencil'),
('fa-percent'),
('fa-phone'),
('fa-phone'),
('fa-photo'),
('fa-picture'),
('fa-pie'),
('fa-pied'),
('fa-pied'),
('fa-pied'),
('fa-pinterest'),
('fa-pinterest'),
('fa-pinterest'),
('fa-plane'),
('fa-play'),
('fa-play'),
('fa-play'),
('fa-plug'),
('fa-plus'),
('fa-plus'),
('fa-plus'),
('fa-plus'),
('fa-power'),
('fa-print'),
('fa-product'),
('fa-puzzle'),
('fa-qq'),
('fa-qrcode'),
('fa-question'),
('fa-question'),
('fa-question'),
('fa-quote'),
('fa-quote'),
('fa-ra'),
('fa-random'),
('fa-rebel'),
('fa-recycle'),
('fa-reddit'),
('fa-reddit'),
('fa-reddit'),
('fa-refresh'),
('fa-registered'),
('fa-remove'),
('fa-renren'),
('fa-reorder'),
('fa-repeat'),
('fa-reply'),
('fa-reply'),
('fa-resistance'),
('fa-retweet'),
('fa-rmb'),
('fa-road'),
('fa-rocket'),
('fa-rotate'),
('fa-rotate'),
('fa-rouble'),
('fa-rss'),
('fa-rss'),
('fa-rub'),
('fa-ruble'),
('fa-rupee'),
('fa-safari'),
('fa-save'),
('fa-scissors'),
('fa-scribd'),
('fa-search'),
('fa-search'),
('fa-search'),
('fa-sellsy'),
('fa-send'),
('fa-send'),
('fa-server'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-shekel'),
('fa-sheqel'),
('fa-shield'),
('fa-ship'),
('fa-shirtsinbulk'),
('fa-shopping'),
('fa-shopping'),
('fa-shopping'),
('fa-sign'),
('fa-sign'),
('fa-sign'),
('fa-signal'),
('fa-signing'),
('fa-simplybuilt'),
('fa-sitemap'),
('fa-skyatlas'),
('fa-skype'),
('fa-slack'),
('fa-sliders'),
('fa-slideshare'),
('fa-smile'),
('fa-snapchat'),
('fa-snapchat'),
('fa-snapchat'),
('fa-soccer'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-soundcloud'),
('fa-space'),
('fa-spinner'),
('fa-spoon'),
('fa-spotify'),
('fa-square'),
('fa-square'),
('fa-stack'),
('fa-stack'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-steam'),
('fa-steam'),
('fa-step'),
('fa-step'),
('fa-stethoscope'),
('fa-sticky'),
('fa-sticky'),
('fa-stop'),
('fa-stop'),
('fa-stop'),
('fa-street'),
('fa-strikethrough'),
('fa-stumbleupon'),
('fa-stumbleupon'),
('fa-subscript'),
('fa-subway'),
('fa-suitcase'),
('fa-sun'),
('fa-superscript'),
('fa-support'),
('fa-table'),
('fa-tablet'),
('fa-tachometer'),
('fa-tag'),
('fa-tags'),
('fa-tasks'),
('fa-taxi'),
('fa-television'),
('fa-tencent'),
('fa-terminal'),
('fa-text'),
('fa-text'),
('fa-th'),
('fa-th'),
('fa-th'),
('fa-themeisle'),
('fa-thumb'),
('fa-thumbs'),
('fa-thumbs'),
('fa-thumbs'),
('fa-thumbs'),
('fa-ticket'),
('fa-times'),
('fa-times'),
('fa-times'),
('fa-tint'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-trademark'),
('fa-train'),
('fa-transgender'),
('fa-transgender'),
('fa-trash'),
('fa-trash'),
('fa-tree'),
('fa-trello'),
('fa-tripadvisor'),
('fa-trophy'),
('fa-truck'),
('fa-try'),
('fa-tty'),
('fa-tumblr'),
('fa-tumblr'),
('fa-turkish'),
('fa-tv'),
('fa-twitch'),
('fa-twitter'),
('fa-twitter'),
('fa-umbrella'),
('fa-underline'),
('fa-undo'),
('fa-universal'),
('fa-university'),
('fa-unlink'),
('fa-unlock'),
('fa-unlock'),
('fa-unsorted'),
('fa-upload'),
('fa-usb'),
('fa-usd'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-users'),
('fa-venus'),
('fa-venus'),
('fa-venus'),
('fa-viacoin'),
('fa-viadeo'),
('fa-viadeo'),
('fa-video'),
('fa-vimeo'),
('fa-vimeo'),
('fa-vine'),
('fa-vk'),
('fa-volume'),
('fa-volume'),
('fa-volume'),
('fa-volume'),
('fa-warning'),
('fa-wechat'),
('fa-weibo'),
('fa-weixin'),
('fa-whatsapp'),
('fa-wheelchair'),
('fa-wheelchair'),
('fa-wifi'),
('fa-wikipedia'),
('fa-windows'),
('fa-won'),
('fa-wordpress'),
('fa-wpbeginner'),
('fa-wpforms'),
('fa-wrench'),
('fa-xing'),
('fa-xing'),
('fa-y'),
('fa-y'),
('fa-yahoo'),
('fa-yc'),
('fa-yc'),
('fa-yelp'),
('fa-yen'),
('fa-yoast'),
('fa-youtube'),
('fa-youtube'),
('fa-youtube'),
('fa-500px'),
('fa-adjust'),
('fa-adn'),
('fa-align'),
('fa-align'),
('fa-align'),
('fa-align'),
('fa-amazon'),
('fa-ambulance'),
('fa-american'),
('fa-anchor'),
('fa-android'),
('fa-angellist'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-angle'),
('fa-apple'),
('fa-archive'),
('fa-area'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrow'),
('fa-arrows'),
('fa-arrows'),
('fa-arrows'),
('fa-arrows'),
('fa-asl'),
('fa-assistive'),
('fa-asterisk'),
('fa-at'),
('fa-audio'),
('fa-automobile'),
('fa-backward'),
('fa-balance'),
('fa-ban'),
('fa-bank'),
('fa-bar'),
('fa-bar'),
('fa-barcode'),
('fa-bars'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-battery'),
('fa-bed'),
('fa-beer'),
('fa-behance'),
('fa-behance'),
('fa-bell'),
('fa-bell'),
('fa-bell'),
('fa-bell'),
('fa-bicycle'),
('fa-binoculars'),
('fa-birthday'),
('fa-bitbucket'),
('fa-bitbucket'),
('fa-bitcoin'),
('fa-black'),
('fa-blind'),
('fa-bluetooth'),
('fa-bluetooth'),
('fa-bold'),
('fa-bolt'),
('fa-bomb'),
('fa-book'),
('fa-bookmark'),
('fa-bookmark'),
('fa-braille'),
('fa-briefcase'),
('fa-btc'),
('fa-bug'),
('fa-building'),
('fa-building'),
('fa-bullhorn'),
('fa-bullseye'),
('fa-bus'),
('fa-buysellads'),
('fa-cab'),
('fa-calculator'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-calendar'),
('fa-camera'),
('fa-camera'),
('fa-car'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-caret'),
('fa-cart'),
('fa-cart'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-cc'),
('fa-certificate'),
('fa-chain'),
('fa-chain'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-check'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-chevron'),
('fa-child'),
('fa-chrome'),
('fa-circle'),
('fa-circle'),
('fa-circle'),
('fa-circle'),
('fa-clipboard'),
('fa-clock'),
('fa-clone'),
('fa-close'),
('fa-cloud'),
('fa-cloud'),
('fa-cloud'),
('fa-cny'),
('fa-code'),
('fa-code'),
('fa-codepen'),
('fa-codiepie'),
('fa-coffee'),
('fa-cog'),
('fa-cogs'),
('fa-columns'),
('fa-comment'),
('fa-comment'),
('fa-commenting'),
('fa-commenting'),
('fa-comments'),
('fa-comments'),
('fa-compass'),
('fa-compress'),
('fa-connectdevelop'),
('fa-contao'),
('fa-copy'),
('fa-copyright'),
('fa-creative'),
('fa-credit'),
('fa-credit'),
('fa-crop'),
('fa-crosshairs'),
('fa-css3'),
('fa-cube'),
('fa-cubes'),
('fa-cut'),
('fa-cutlery'),
('fa-dashboard'),
('fa-dashcube'),
('fa-database'),
('fa-deaf'),
('fa-deafness'),
('fa-dedent'),
('fa-delicious'),
('fa-desktop'),
('fa-deviantart'),
('fa-diamond'),
('fa-digg'),
('fa-dollar'),
('fa-dot'),
('fa-download'),
('fa-dribbble'),
('fa-dropbox'),
('fa-drupal'),
('fa-edge'),
('fa-edit'),
('fa-eject'),
('fa-ellipsis'),
('fa-ellipsis'),
('fa-empire'),
('fa-envelope'),
('fa-envelope'),
('fa-envelope'),
('fa-envira'),
('fa-eraser'),
('fa-eur'),
('fa-euro'),
('fa-exchange'),
('fa-exclamation'),
('fa-exclamation'),
('fa-exclamation'),
('fa-expand'),
('fa-expeditedssl'),
('fa-external'),
('fa-external'),
('fa-eye'),
('fa-eye'),
('fa-eyedropper'),
('fa-fa'),
('fa-facebook'),
('fa-facebook'),
('fa-facebook'),
('fa-facebook'),
('fa-fast'),
('fa-fast'),
('fa-fax'),
('fa-feed'),
('fa-female'),
('fa-fighter'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-file'),
('fa-files'),
('fa-film'),
('fa-filter'),
('fa-fire'),
('fa-fire'),
('fa-firefox'),
('fa-first'),
('fa-flag'),
('fa-flag'),
('fa-flag'),
('fa-flash'),
('fa-flask'),
('fa-flickr'),
('fa-floppy'),
('fa-folder'),
('fa-folder'),
('fa-folder'),
('fa-folder'),
('fa-font'),
('fa-font'),
('fa-fonticons'),
('fa-fort'),
('fa-forumbee'),
('fa-forward'),
('fa-foursquare'),
('fa-frown'),
('fa-futbol'),
('fa-gamepad'),
('fa-gavel'),
('fa-gbp'),
('fa-ge'),
('fa-gear'),
('fa-gears'),
('fa-genderless'),
('fa-get'),
('fa-gg'),
('fa-gg'),
('fa-gift'),
('fa-git'),
('fa-git'),
('fa-github'),
('fa-github'),
('fa-github'),
('fa-gitlab'),
('fa-gittip'),
('fa-glass'),
('fa-glide'),
('fa-glide'),
('fa-globe'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-google'),
('fa-graduation'),
('fa-gratipay'),
('fa-group'),
('fa-h'),
('fa-hacker'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hand'),
('fa-hard'),
('fa-hashtag'),
('fa-hdd'),
('fa-header'),
('fa-headphones'),
('fa-heart'),
('fa-heart'),
('fa-heartbeat'),
('fa-history'),
('fa-home'),
('fa-hospital'),
('fa-hotel'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-hourglass'),
('fa-houzz'),
('fa-html5'),
('fa-i'),
('fa-ils'),
('fa-image'),
('fa-inbox'),
('fa-indent'),
('fa-industry'),
('fa-info'),
('fa-info'),
('fa-inr'),
('fa-instagram'),
('fa-institution'),
('fa-internet'),
('fa-intersex'),
('fa-ioxhost'),
('fa-italic'),
('fa-joomla'),
('fa-jpy'),
('fa-jsfiddle'),
('fa-key'),
('fa-keyboard'),
('fa-krw'),
('fa-language'),
('fa-laptop'),
('fa-lastfm'),
('fa-lastfm'),
('fa-leaf'),
('fa-leanpub'),
('fa-legal'),
('fa-lemon'),
('fa-level'),
('fa-level'),
('fa-life'),
('fa-life'),
('fa-life'),
('fa-life'),
('fa-lightbulb'),
('fa-line'),
('fa-link'),
('fa-linkedin'),
('fa-linkedin'),
('fa-linux'),
('fa-list'),
('fa-list'),
('fa-list'),
('fa-list'),
('fa-location'),
('fa-lock'),
('fa-long'),
('fa-long'),
('fa-long'),
('fa-long'),
('fa-low'),
('fa-magic'),
('fa-magnet'),
('fa-mail'),
('fa-mail'),
('fa-mail'),
('fa-male'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-map'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-mars'),
('fa-maxcdn'),
('fa-meanpath'),
('fa-medium'),
('fa-medkit'),
('fa-meh'),
('fa-mercury'),
('fa-microphone'),
('fa-microphone'),
('fa-minus'),
('fa-minus'),
('fa-minus'),
('fa-minus'),
('fa-mixcloud'),
('fa-mobile'),
('fa-mobile'),
('fa-modx'),
('fa-money'),
('fa-moon'),
('fa-mortar'),
('fa-motorcycle'),
('fa-mouse'),
('fa-music'),
('fa-navicon'),
('fa-neuter'),
('fa-newspaper'),
('fa-object'),
('fa-object'),
('fa-odnoklassniki'),
('fa-odnoklassniki'),
('fa-opencart'),
('fa-openid'),
('fa-opera'),
('fa-optin'),
('fa-outdent'),
('fa-pagelines'),
('fa-paint'),
('fa-paper'),
('fa-paper'),
('fa-paperclip'),
('fa-paragraph'),
('fa-paste'),
('fa-pause'),
('fa-pause'),
('fa-pause'),
('fa-paw'),
('fa-paypal'),
('fa-pencil'),
('fa-pencil'),
('fa-pencil'),
('fa-percent'),
('fa-phone'),
('fa-phone'),
('fa-photo'),
('fa-picture'),
('fa-pie'),
('fa-pied'),
('fa-pied'),
('fa-pied'),
('fa-pinterest'),
('fa-pinterest'),
('fa-pinterest'),
('fa-plane'),
('fa-play'),
('fa-play'),
('fa-play'),
('fa-plug'),
('fa-plus'),
('fa-plus'),
('fa-plus'),
('fa-plus'),
('fa-power'),
('fa-print'),
('fa-product'),
('fa-puzzle'),
('fa-qq'),
('fa-qrcode'),
('fa-question'),
('fa-question'),
('fa-question'),
('fa-quote'),
('fa-quote'),
('fa-ra'),
('fa-random'),
('fa-rebel'),
('fa-recycle'),
('fa-reddit'),
('fa-reddit'),
('fa-reddit'),
('fa-refresh'),
('fa-registered'),
('fa-remove'),
('fa-renren'),
('fa-reorder'),
('fa-repeat'),
('fa-reply'),
('fa-reply'),
('fa-resistance'),
('fa-retweet'),
('fa-rmb'),
('fa-road'),
('fa-rocket'),
('fa-rotate'),
('fa-rotate'),
('fa-rouble'),
('fa-rss'),
('fa-rss'),
('fa-rub'),
('fa-ruble'),
('fa-rupee'),
('fa-safari'),
('fa-save'),
('fa-scissors'),
('fa-scribd'),
('fa-search'),
('fa-search'),
('fa-search'),
('fa-sellsy'),
('fa-send'),
('fa-send'),
('fa-server'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-share'),
('fa-shekel'),
('fa-sheqel'),
('fa-shield'),
('fa-ship'),
('fa-shirtsinbulk'),
('fa-shopping'),
('fa-shopping'),
('fa-shopping'),
('fa-sign'),
('fa-sign'),
('fa-sign'),
('fa-signal'),
('fa-signing'),
('fa-simplybuilt'),
('fa-sitemap'),
('fa-skyatlas'),
('fa-skype'),
('fa-slack'),
('fa-sliders'),
('fa-slideshare'),
('fa-smile'),
('fa-snapchat'),
('fa-snapchat'),
('fa-snapchat'),
('fa-soccer'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-sort'),
('fa-soundcloud'),
('fa-space'),
('fa-spinner'),
('fa-spoon'),
('fa-spotify'),
('fa-square'),
('fa-square'),
('fa-stack'),
('fa-stack'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-star'),
('fa-steam'),
('fa-steam'),
('fa-step'),
('fa-step'),
('fa-stethoscope'),
('fa-sticky'),
('fa-sticky'),
('fa-stop'),
('fa-stop'),
('fa-stop'),
('fa-street'),
('fa-strikethrough'),
('fa-stumbleupon'),
('fa-stumbleupon'),
('fa-subscript'),
('fa-subway'),
('fa-suitcase'),
('fa-sun'),
('fa-superscript'),
('fa-support'),
('fa-table'),
('fa-tablet'),
('fa-tachometer'),
('fa-tag'),
('fa-tags'),
('fa-tasks'),
('fa-taxi'),
('fa-television'),
('fa-tencent'),
('fa-terminal'),
('fa-text'),
('fa-text'),
('fa-th'),
('fa-th'),
('fa-th'),
('fa-themeisle'),
('fa-thumb'),
('fa-thumbs'),
('fa-thumbs'),
('fa-thumbs'),
('fa-thumbs'),
('fa-ticket'),
('fa-times'),
('fa-times'),
('fa-times'),
('fa-tint'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-toggle'),
('fa-trademark'),
('fa-train'),
('fa-transgender'),
('fa-transgender'),
('fa-trash'),
('fa-trash'),
('fa-tree'),
('fa-trello'),
('fa-tripadvisor'),
('fa-trophy'),
('fa-truck'),
('fa-try'),
('fa-tty'),
('fa-tumblr'),
('fa-tumblr'),
('fa-turkish'),
('fa-tv'),
('fa-twitch'),
('fa-twitter'),
('fa-twitter'),
('fa-umbrella'),
('fa-underline'),
('fa-undo'),
('fa-universal'),
('fa-university'),
('fa-unlink'),
('fa-unlock'),
('fa-unlock'),
('fa-unsorted'),
('fa-upload'),
('fa-usb'),
('fa-usd'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-user'),
('fa-users'),
('fa-venus'),
('fa-venus'),
('fa-venus'),
('fa-viacoin'),
('fa-viadeo'),
('fa-viadeo'),
('fa-video'),
('fa-vimeo'),
('fa-vimeo'),
('fa-vine'),
('fa-vk'),
('fa-volume'),
('fa-volume'),
('fa-volume'),
('fa-volume'),
('fa-warning'),
('fa-wechat'),
('fa-weibo'),
('fa-weixin'),
('fa-whatsapp'),
('fa-wheelchair'),
('fa-wheelchair'),
('fa-wifi'),
('fa-wikipedia'),
('fa-windows'),
('fa-won'),
('fa-wordpress'),
('fa-wpbeginner'),
('fa-wpforms'),
('fa-wrench'),
('fa-xing'),
('fa-xing'),
('fa-y'),
('fa-y'),
('fa-yahoo'),
('fa-yc'),
('fa-yc'),
('fa-yelp'),
('fa-yen'),
('fa-yoast'),
('fa-youtube'),
('fa-youtube'),
('fa-youtube'),
('fa-balance-scale'),
('fa-battery-0'),
('fa-battery-1'),
('fa-battery-2'),
('fa-battery-3'),
('fa-battery-4'),
('fa-battery-empty'),
('fa-battery-full'),
('fa-battery-half'),
('fa-battery-quarter'),
('fa-battery-three'),
('fa-black-tie'),
('fa-calendar-check'),
('fa-calendar-minus'),
('fa-calendar-plus'),
('fa-calendar-times'),
('fa-cc-diners'),
('fa-cc-jcb'),
('fa-commenting-o'),
('fa-creative-commons'),
('fa-get-pocket'),
('fa-gg-circle'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-hourglass-1'),
('fa-hourglass-2'),
('fa-hourglass-3'),
('fa-hourglass-end'),
('fa-hourglass-half'),
('fa-hourglass-o'),
('fa-hourglass-start'),
('fa-i-cursor'),
('fa-internet-explorer'),
('fa-map-o'),
('fa-map-pin'),
('fa-map-signs'),
('fa-mouse-pointer'),
('fa-object-group'),
('fa-object-ungroup'),
('fa-odnoklassniki-square'),
('fa-optin-monster'),
('fa-sticky-note'),
('fa-sticky-note'),
('fa-wikipedia-w'),
('fa-y-combinator'),
('fa-area-chart'),
('fa-arrows-h'),
('fa-arrows-v'),
('fa-balance-scale'),
('fa-bar-chart'),
('fa-bar-chart'),
('fa-battery-0'),
('fa-battery-1'),
('fa-battery-2'),
('fa-battery-3'),
('fa-battery-4'),
('fa-battery-empty'),
('fa-battery-full'),
('fa-battery-half'),
('fa-battery-quarter'),
('fa-battery-three'),
('fa-bell-o'),
('fa-bell-slash'),
('fa-bell-slash'),
('fa-birthday-cake'),
('fa-bookmark-o'),
('fa-building-o'),
('fa-calendar-check'),
('fa-calendar-minus'),
('fa-calendar-o'),
('fa-calendar-plus'),
('fa-calendar-times'),
('fa-camera-retro'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-cart-arrow'),
('fa-cart-plus'),
('fa-check-circle'),
('fa-check-circle'),
('fa-check-square'),
('fa-check-square'),
('fa-circle-o'),
('fa-circle-o'),
('fa-circle-thin'),
('fa-clock-o'),
('fa-cloud-download'),
('fa-cloud-upload'),
('fa-code-fork'),
('fa-comment-o'),
('fa-commenting-o'),
('fa-comments-o'),
('fa-creative-commons'),
('fa-credit-card'),
('fa-dot-circle'),
('fa-ellipsis-h'),
('fa-ellipsis-v'),
('fa-envelope-o'),
('fa-envelope-square'),
('fa-exclamation-circle'),
('fa-exclamation-triangle'),
('fa-external-link'),
('fa-external-link'),
('fa-eye-slash'),
('fa-fighter-jet'),
('fa-file-archive'),
('fa-file-audio'),
('fa-file-code'),
('fa-file-excel'),
('fa-file-image'),
('fa-file-movie'),
('fa-file-pdf'),
('fa-file-photo'),
('fa-file-picture'),
('fa-file-powerpoint'),
('fa-file-sound'),
('fa-file-video'),
('fa-file-word'),
('fa-file-zip'),
('fa-fire-extinguisher'),
('fa-flag-checkered'),
('fa-flag-o'),
('fa-folder-o'),
('fa-folder-open'),
('fa-folder-open'),
('fa-frown-o'),
('fa-futbol-o'),
('fa-graduation-cap'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-hdd-o'),
('fa-heart-o'),
('fa-hourglass-1'),
('fa-hourglass-2'),
('fa-hourglass-3'),
('fa-hourglass-end'),
('fa-hourglass-half'),
('fa-hourglass-o'),
('fa-hourglass-start'),
('fa-i-cursor'),
('fa-info-circle'),
('fa-keyboard-o'),
('fa-lemon-o'),
('fa-level-down'),
('fa-level-up'),
('fa-life-bouy'),
('fa-life-buoy'),
('fa-life-ring'),
('fa-life-saver'),
('fa-lightbulb-o'),
('fa-line-chart'),
('fa-location-arrow'),
('fa-mail-forward'),
('fa-mail-reply'),
('fa-mail-reply'),
('fa-map-marker'),
('fa-map-o'),
('fa-map-pin'),
('fa-map-signs'),
('fa-meh-o'),
('fa-microphone-slash'),
('fa-minus-circle'),
('fa-minus-square'),
('fa-minus-square'),
('fa-mobile-phone'),
('fa-moon-o'),
('fa-mortar-board'),
('fa-mouse-pointer'),
('fa-newspaper-o'),
('fa-object-group'),
('fa-object-ungroup'),
('fa-paint-brush'),
('fa-paper-plane'),
('fa-paper-plane'),
('fa-pencil-square'),
('fa-pencil-square'),
('fa-phone-square'),
('fa-picture-o'),
('fa-pie-chart'),
('fa-plus-circle'),
('fa-plus-square'),
('fa-plus-square'),
('fa-power-off'),
('fa-puzzle-piece'),
('fa-question-circle'),
('fa-quote-left'),
('fa-quote-right'),
('fa-reply-all'),
('fa-rss-square'),
('fa-search-minus'),
('fa-search-plus'),
('fa-send-o'),
('fa-share-alt'),
('fa-share-alt'),
('fa-share-square'),
('fa-share-square'),
('fa-shopping-cart'),
('fa-sign-in'),
('fa-sign-out'),
('fa-smile-o'),
('fa-soccer-ball'),
('fa-sort-alpha'),
('fa-sort-alpha'),
('fa-sort-amount'),
('fa-sort-amount'),
('fa-sort-asc'),
('fa-sort-desc'),
('fa-sort-down'),
('fa-sort-numeric'),
('fa-sort-numeric'),
('fa-sort-up'),
('fa-space-shuttle'),
('fa-square-o'),
('fa-star-half'),
('fa-star-half'),
('fa-star-half'),
('fa-star-half'),
('fa-star-o'),
('fa-sticky-note'),
('fa-sticky-note'),
('fa-street-view'),
('fa-sun-o'),
('fa-thumb-tack'),
('fa-thumbs-down'),
('fa-thumbs-o'),
('fa-thumbs-o'),
('fa-thumbs-up'),
('fa-times-circle'),
('fa-times-circle'),
('fa-toggle-down'),
('fa-toggle-left'),
('fa-toggle-off'),
('fa-toggle-on'),
('fa-toggle-right'),
('fa-toggle-up'),
('fa-trash-o'),
('fa-unlock-alt'),
('fa-user-plus'),
('fa-user-secret'),
('fa-user-times'),
('fa-video-camera'),
('fa-volume-down'),
('fa-volume-off'),
('fa-volume-up'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-thumbs-down'),
('fa-thumbs-o'),
('fa-thumbs-o'),
('fa-thumbs-up'),
('fa-fighter-jet'),
('fa-space-shuttle'),
('fa-mars-double'),
('fa-mars-stroke'),
('fa-mars-stroke'),
('fa-mars-stroke'),
('fa-transgender-alt'),
('fa-venus-double'),
('fa-venus-mars'),
('fa-file-archive'),
('fa-file-audio'),
('fa-file-code'),
('fa-file-excel'),
('fa-file-image'),
('fa-file-movie'),
('fa-file-o'),
('fa-file-pdf'),
('fa-file-photo'),
('fa-file-picture'),
('fa-file-powerpoint'),
('fa-file-sound'),
('fa-file-text'),
('fa-file-text'),
('fa-file-video'),
('fa-file-word'),
('fa-file-zip'),
('fa-circle-o'),
('fa-check-square'),
('fa-check-square'),
('fa-circle-o'),
('fa-dot-circle'),
('fa-minus-square'),
('fa-minus-square'),
('fa-plus-square'),
('fa-plus-square'),
('fa-square-o'),
('fa-cc-amex'),
('fa-cc-diners'),
('fa-cc-discover'),
('fa-cc-jcb'),
('fa-cc-mastercard'),
('fa-cc-paypal'),
('fa-cc-stripe'),
('fa-cc-visa'),
('fa-credit-card'),
('fa-google-wallet'),
('fa-area-chart'),
('fa-bar-chart'),
('fa-bar-chart'),
('fa-line-chart'),
('fa-pie-chart'),
('fa-gg-circle'),
('fa-turkish-lira'),
('fa-align-center'),
('fa-align-justify'),
('fa-align-left'),
('fa-align-right'),
('fa-chain-broken'),
('fa-file-o'),
('fa-file-text'),
('fa-file-text'),
('fa-files-o'),
('fa-floppy-o'),
('fa-list-alt'),
('fa-list-ol'),
('fa-list-ul'),
('fa-rotate-left'),
('fa-rotate-right'),
('fa-text-height'),
('fa-text-width'),
('fa-th-large'),
('fa-th-list'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-down'),
('fa-angle-left'),
('fa-angle-right'),
('fa-angle-up'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-down'),
('fa-arrow-left'),
('fa-arrow-right'),
('fa-arrow-up'),
('fa-arrows-alt'),
('fa-arrows-h'),
('fa-arrows-v'),
('fa-caret-down'),
('fa-caret-left'),
('fa-caret-right'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-up'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-down'),
('fa-chevron-left'),
('fa-chevron-right'),
('fa-chevron-up'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-toggle-down'),
('fa-toggle-left'),
('fa-toggle-right'),
('fa-toggle-up'),
('fa-arrows-alt'),
('fa-fast-backward'),
('fa-fast-forward'),
('fa-play-circle'),
('fa-play-circle'),
('fa-step-backward'),
('fa-step-forward'),
('fa-youtube-play'),
('fa-behance-square'),
('fa-bitbucket-square'),
('fa-black-tie'),
('fa-cc-amex'),
('fa-cc-diners'),
('fa-cc-discover'),
('fa-cc-jcb'),
('fa-cc-mastercard'),
('fa-cc-paypal'),
('fa-cc-stripe'),
('fa-cc-visa'),
('fa-facebook-f'),
('fa-facebook-official'),
('fa-facebook-square'),
('fa-get-pocket'),
('fa-gg-circle'),
('fa-git-square'),
('fa-github-alt'),
('fa-github-square'),
('fa-google-plus'),
('fa-google-plus'),
('fa-google-wallet'),
('fa-hacker-news'),
('fa-internet-explorer'),
('fa-lastfm-square'),
('fa-linkedin-square'),
('fa-odnoklassniki-square'),
('fa-optin-monster'),
('fa-pied-piper'),
('fa-pied-piper'),
('fa-pinterest-p'),
('fa-pinterest-square'),
('fa-reddit-square'),
('fa-share-alt'),
('fa-share-alt'),
('fa-stack-exchange'),
('fa-stack-overflow'),
('fa-steam-square'),
('fa-stumbleupon-circle'),
('fa-tencent-weibo'),
('fa-tumblr-square'),
('fa-twitter-square'),
('fa-vimeo-square'),
('fa-wikipedia-w'),
('fa-xing-square'),
('fa-y-combinator'),
('fa-y-combinator'),
('fa-yc-square'),
('fa-youtube-play'),
('fa-youtube-square'),
('fa-h-square'),
('fa-heart-o'),
('fa-hospital-o'),
('fa-plus-square'),
('fa-user-md'),
('fa-balance-scale'),
('fa-battery-0'),
('fa-battery-1'),
('fa-battery-2'),
('fa-battery-3'),
('fa-battery-4'),
('fa-battery-empty'),
('fa-battery-full'),
('fa-battery-half'),
('fa-battery-quarter'),
('fa-battery-three'),
('fa-black-tie'),
('fa-calendar-check'),
('fa-calendar-minus'),
('fa-calendar-plus'),
('fa-calendar-times'),
('fa-cc-diners'),
('fa-cc-jcb'),
('fa-commenting-o'),
('fa-creative-commons'),
('fa-get-pocket'),
('fa-gg-circle'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-hourglass-1'),
('fa-hourglass-2'),
('fa-hourglass-3'),
('fa-hourglass-end'),
('fa-hourglass-half'),
('fa-hourglass-o'),
('fa-hourglass-start'),
('fa-i-cursor'),
('fa-internet-explorer'),
('fa-map-o'),
('fa-map-pin'),
('fa-map-signs'),
('fa-mouse-pointer'),
('fa-object-group'),
('fa-object-ungroup'),
('fa-odnoklassniki-square'),
('fa-optin-monster'),
('fa-sticky-note'),
('fa-sticky-note'),
('fa-wikipedia-w'),
('fa-y-combinator'),
('fa-area-chart'),
('fa-arrows-h'),
('fa-arrows-v'),
('fa-balance-scale'),
('fa-bar-chart'),
('fa-bar-chart'),
('fa-battery-0'),
('fa-battery-1'),
('fa-battery-2'),
('fa-battery-3'),
('fa-battery-4'),
('fa-battery-empty'),
('fa-battery-full'),
('fa-battery-half'),
('fa-battery-quarter'),
('fa-battery-three'),
('fa-bell-o'),
('fa-bell-slash'),
('fa-bell-slash'),
('fa-birthday-cake'),
('fa-bookmark-o'),
('fa-building-o'),
('fa-calendar-check'),
('fa-calendar-minus'),
('fa-calendar-o'),
('fa-calendar-plus'),
('fa-calendar-times'),
('fa-camera-retro'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-cart-arrow'),
('fa-cart-plus'),
('fa-check-circle'),
('fa-check-circle'),
('fa-check-square'),
('fa-check-square'),
('fa-circle-o'),
('fa-circle-o'),
('fa-circle-thin'),
('fa-clock-o'),
('fa-cloud-download'),
('fa-cloud-upload'),
('fa-code-fork'),
('fa-comment-o'),
('fa-commenting-o'),
('fa-comments-o'),
('fa-creative-commons'),
('fa-credit-card'),
('fa-dot-circle'),
('fa-ellipsis-h'),
('fa-ellipsis-v'),
('fa-envelope-o'),
('fa-envelope-square'),
('fa-exclamation-circle'),
('fa-exclamation-triangle'),
('fa-external-link'),
('fa-external-link'),
('fa-eye-slash'),
('fa-fighter-jet'),
('fa-file-archive'),
('fa-file-audio'),
('fa-file-code'),
('fa-file-excel'),
('fa-file-image'),
('fa-file-movie'),
('fa-file-pdf'),
('fa-file-photo'),
('fa-file-picture'),
('fa-file-powerpoint'),
('fa-file-sound'),
('fa-file-video'),
('fa-file-word'),
('fa-file-zip'),
('fa-fire-extinguisher'),
('fa-flag-checkered'),
('fa-flag-o'),
('fa-folder-o'),
('fa-folder-open'),
('fa-folder-open'),
('fa-frown-o'),
('fa-futbol-o'),
('fa-graduation-cap'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-hdd-o'),
('fa-heart-o'),
('fa-hourglass-1'),
('fa-hourglass-2'),
('fa-hourglass-3'),
('fa-hourglass-end'),
('fa-hourglass-half'),
('fa-hourglass-o'),
('fa-hourglass-start'),
('fa-i-cursor'),
('fa-info-circle'),
('fa-keyboard-o'),
('fa-lemon-o'),
('fa-level-down'),
('fa-level-up'),
('fa-life-bouy'),
('fa-life-buoy'),
('fa-life-ring'),
('fa-life-saver'),
('fa-lightbulb-o'),
('fa-line-chart'),
('fa-location-arrow'),
('fa-mail-forward'),
('fa-mail-reply'),
('fa-mail-reply'),
('fa-map-marker'),
('fa-map-o'),
('fa-map-pin'),
('fa-map-signs'),
('fa-meh-o'),
('fa-microphone-slash'),
('fa-minus-circle'),
('fa-minus-square'),
('fa-minus-square'),
('fa-mobile-phone'),
('fa-moon-o'),
('fa-mortar-board'),
('fa-mouse-pointer'),
('fa-newspaper-o'),
('fa-object-group'),
('fa-object-ungroup'),
('fa-paint-brush'),
('fa-paper-plane'),
('fa-paper-plane'),
('fa-pencil-square'),
('fa-pencil-square'),
('fa-phone-square'),
('fa-picture-o'),
('fa-pie-chart'),
('fa-plus-circle'),
('fa-plus-square'),
('fa-plus-square'),
('fa-power-off'),
('fa-puzzle-piece'),
('fa-question-circle'),
('fa-quote-left'),
('fa-quote-right'),
('fa-reply-all'),
('fa-rss-square'),
('fa-search-minus'),
('fa-search-plus'),
('fa-send-o'),
('fa-share-alt'),
('fa-share-alt'),
('fa-share-square'),
('fa-share-square'),
('fa-shopping-cart'),
('fa-sign-in'),
('fa-sign-out'),
('fa-smile-o'),
('fa-soccer-ball'),
('fa-sort-alpha'),
('fa-sort-alpha'),
('fa-sort-amount'),
('fa-sort-amount'),
('fa-sort-asc'),
('fa-sort-desc'),
('fa-sort-down'),
('fa-sort-numeric'),
('fa-sort-numeric'),
('fa-sort-up'),
('fa-space-shuttle'),
('fa-square-o'),
('fa-star-half'),
('fa-star-half'),
('fa-star-half'),
('fa-star-half'),
('fa-star-o'),
('fa-sticky-note'),
('fa-sticky-note'),
('fa-street-view'),
('fa-sun-o'),
('fa-thumb-tack'),
('fa-thumbs-down'),
('fa-thumbs-o'),
('fa-thumbs-o'),
('fa-thumbs-up'),
('fa-times-circle'),
('fa-times-circle'),
('fa-toggle-down'),
('fa-toggle-left'),
('fa-toggle-off'),
('fa-toggle-on'),
('fa-toggle-right'),
('fa-toggle-up'),
('fa-trash-o'),
('fa-unlock-alt'),
('fa-user-plus'),
('fa-user-secret'),
('fa-user-times'),
('fa-video-camera'),
('fa-volume-down'),
('fa-volume-off'),
('fa-volume-up'),
('fa-hand-grab'),
('fa-hand-lizard'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-paper'),
('fa-hand-peace'),
('fa-hand-pointer'),
('fa-hand-rock'),
('fa-hand-scissors'),
('fa-hand-spock'),
('fa-hand-stop'),
('fa-thumbs-down'),
('fa-thumbs-o'),
('fa-thumbs-o'),
('fa-thumbs-up'),
('fa-fighter-jet'),
('fa-space-shuttle'),
('fa-mars-double'),
('fa-mars-stroke'),
('fa-mars-stroke'),
('fa-mars-stroke'),
('fa-transgender-alt'),
('fa-venus-double'),
('fa-venus-mars'),
('fa-file-archive'),
('fa-file-audio'),
('fa-file-code'),
('fa-file-excel'),
('fa-file-image'),
('fa-file-movie'),
('fa-file-o'),
('fa-file-pdf'),
('fa-file-photo'),
('fa-file-picture'),
('fa-file-powerpoint'),
('fa-file-sound'),
('fa-file-text'),
('fa-file-text'),
('fa-file-video'),
('fa-file-word'),
('fa-file-zip'),
('fa-circle-o'),
('fa-check-square'),
('fa-check-square'),
('fa-circle-o'),
('fa-dot-circle'),
('fa-minus-square'),
('fa-minus-square'),
('fa-plus-square'),
('fa-plus-square'),
('fa-square-o'),
('fa-cc-amex'),
('fa-cc-diners'),
('fa-cc-discover'),
('fa-cc-jcb'),
('fa-cc-mastercard'),
('fa-cc-paypal'),
('fa-cc-stripe'),
('fa-cc-visa'),
('fa-credit-card'),
('fa-google-wallet'),
('fa-area-chart'),
('fa-bar-chart'),
('fa-bar-chart'),
('fa-line-chart'),
('fa-pie-chart'),
('fa-gg-circle'),
('fa-turkish-lira'),
('fa-align-center'),
('fa-align-justify'),
('fa-align-left'),
('fa-align-right'),
('fa-chain-broken'),
('fa-file-o'),
('fa-file-text'),
('fa-file-text'),
('fa-files-o'),
('fa-floppy-o'),
('fa-list-alt'),
('fa-list-ol'),
('fa-list-ul'),
('fa-rotate-left'),
('fa-rotate-right'),
('fa-text-height'),
('fa-text-width'),
('fa-th-large'),
('fa-th-list'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-double'),
('fa-angle-down'),
('fa-angle-left'),
('fa-angle-right'),
('fa-angle-up'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-circle'),
('fa-arrow-down'),
('fa-arrow-left'),
('fa-arrow-right'),
('fa-arrow-up'),
('fa-arrows-alt'),
('fa-arrows-h'),
('fa-arrows-v'),
('fa-caret-down'),
('fa-caret-left'),
('fa-caret-right'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-square'),
('fa-caret-up'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-circle'),
('fa-chevron-down'),
('fa-chevron-left'),
('fa-chevron-right'),
('fa-chevron-up'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-hand-o'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-long-arrow'),
('fa-toggle-down'),
('fa-toggle-left'),
('fa-toggle-right'),
('fa-toggle-up'),
('fa-arrows-alt'),
('fa-fast-backward'),
('fa-fast-forward'),
('fa-play-circle'),
('fa-play-circle'),
('fa-step-backward'),
('fa-step-forward'),
('fa-youtube-play'),
('fa-behance-square'),
('fa-bitbucket-square'),
('fa-black-tie'),
('fa-cc-amex'),
('fa-cc-diners'),
('fa-cc-discover'),
('fa-cc-jcb'),
('fa-cc-mastercard'),
('fa-cc-paypal'),
('fa-cc-stripe'),
('fa-cc-visa'),
('fa-facebook-f'),
('fa-facebook-official'),
('fa-facebook-square'),
('fa-get-pocket'),
('fa-gg-circle'),
('fa-git-square'),
('fa-github-alt'),
('fa-github-square'),
('fa-google-plus'),
('fa-google-plus'),
('fa-google-wallet'),
('fa-hacker-news'),
('fa-internet-explorer'),
('fa-lastfm-square'),
('fa-linkedin-square'),
('fa-odnoklassniki-square'),
('fa-optin-monster'),
('fa-pied-piper'),
('fa-pied-piper'),
('fa-pinterest-p'),
('fa-pinterest-square'),
('fa-reddit-square'),
('fa-share-alt'),
('fa-share-alt'),
('fa-stack-exchange'),
('fa-stack-overflow'),
('fa-steam-square'),
('fa-stumbleupon-circle'),
('fa-tencent-weibo'),
('fa-tumblr-square'),
('fa-twitter-square'),
('fa-vimeo-square'),
('fa-wikipedia-w'),
('fa-xing-square'),
('fa-y-combinator'),
('fa-y-combinator'),
('fa-yc-square'),
('fa-youtube-play'),
('fa-youtube-square'),
('fa-h-square'),
('fa-heart-o'),
('fa-hospital-o'),
('fa-plus-square'),
('fa-user-md');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `definition`) VALUES
(1, 'side menu', NULL),
(2, 'top menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `id_penempatan` varchar(100) NOT NULL,
  `tanggal_mutasi` date NOT NULL,
  `keterangan` text NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `mutasi`
--
DELIMITER $$
CREATE TRIGGER `keterangan_mutasi` AFTER INSERT ON `mutasi` FOR EACH ROW BEGIN
	UPDATE penempatan SET keterangan = keterangan = NEW.keterangan
	WHERE id_penempatan = NEW.id_penempatan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `fresh_content` text NOT NULL,
  `keyword` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `type`, `content`, `fresh_content`, `keyword`, `description`, `link`, `template`, `created_at`) VALUES
(1, 'home', 'frontend', '<cc-element cc-id=\"style\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-freelancer\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/css/freelancer.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-font-awesome\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">\n</cc-element>\n\n<cc-element cc-id=\"content\">\n    <header class=\"free-header\" style=\"\">\n        </header></cc-element>', '\n                                    \n                                    \n                                    \n                                    \n                                    \n                                    \n                                    \n                                                                                                                                                      <li class=\"block-item ui-draggable ui-draggable-handle block-item-loaded\" data-src=\"portofolio\\/header.php\" data-block-name=\"portofolio\\\" style=\"width: 200px; right: auto; height: 107px; bottom: auto; display: list-item;\">\n				                <div class=\"nav-content-wrapper noselect ui-sortable\">\n				                  <i class=\"fa fa-gear\"></i>\n				                  <div class=\"tool-nav delete ui-sortable\">\n				                    <i class=\"fa fa-trash\"></i> <span class=\"info-nav\">Delete</span>\n				                  </div>\n				                  <div class=\"tool-nav source ui-sortable\">\n				                    <i class=\"fa fa-code\"></i> <span class=\"info-nav\">Source</span>\n				                  </div>\n				                  <div class=\"tool-nav copy ui-sortable\">\n				                    <i class=\"fa fa-copy\"></i> <span class=\"info-nav\">Copy</span>\n				                  </div>\n				                  <div class=\"tool-nav handle ui-sortable ui-sortable-handle\">\n				                    <i class=\"fa fa-arrows\"></i> <span class=\"info-nav\">Move</span>\n				                  </div>\n				                </div>\n				              \n				              <div class=\"block-content editable ui-sortable\"><cc-element cc-id=\"style\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-freelancer\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/css/freelancer.min.css\" rel=\"stylesheet\">\n    <link data-src=\"stylesheet-font-awesome\" href=\"http://localhost:80/pinjam/cc-content/page-element/portofolio\\/package/vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700\" rel=\"stylesheet\" type=\"text/css\">\n    <link data-src=\"stylesheet-bootstrap\" href=\"https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic\" rel=\"stylesheet\" type=\"text/css\">\n</cc-element>\n\n<cc-element cc-id=\"content\">\n    <header class=\"free-header\" style=\"\">\n        </header></cc-element></div></li>                                                                                                                                                 ', '', '', 'home', 'default', '2019-01-05 01:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `page_block_element`
--

CREATE TABLE `page_block_element` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image_preview` varchar(200) NOT NULL,
  `block_name` varchar(200) NOT NULL,
  `content_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_penempatan` int(11) NOT NULL,
  `tanggal_penempatan` date NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `penempatan`
--
DELIMITER $$
CREATE TRIGGER `penempatan_barang` AFTER INSERT ON `penempatan` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah-NEW.jumlah
    WHERE nama_barang=NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `jenis_pengadaan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `pengadaan`
--
DELIMITER $$
CREATE TRIGGER `pengadaan_barang` AFTER INSERT ON `pengadaan` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah+NEW.jumlah
    WHERE nama_barang = NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `keperluan` text NOT NULL,
  `tgl_pinjam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `pengajuan`
--
DELIMITER $$
CREATE TRIGGER `pengajuan_pinjam` AFTER INSERT ON `pengajuan` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah=jumlah-NEW.jumlah
    WHERE nama_barang=NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggal_entry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `departemen_peminjam` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `pengembalian`
--
DELIMITER $$
CREATE TRIGGER `pengembalian_barang` AFTER INSERT ON `pengembalian` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah+NEW.jumlah
    WHERE nama_barang = NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rest`
--

CREATE TABLE `rest` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `x_api_key` varchar(20) DEFAULT NULL,
  `x_token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rest_field`
--

CREATE TABLE `rest_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `rest_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_api` varchar(10) DEFAULT NULL,
  `show_update_api` varchar(10) DEFAULT NULL,
  `show_detail_api` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rest_field_validation`
--

CREATE TABLE `rest_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `rest_field_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rest_input_type`
--

CREATE TABLE `rest_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rest_input_type`
--

INSERT INTO `rest_input_type` (`id`, `type`, `relation`, `validation_group`) VALUES
(1, 'input', '0', 'input'),
(2, 'timestamp', '0', 'timestamp'),
(3, 'file', '0', 'file');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `id_retur` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerima_barang` varchar(50) NOT NULL,
  `berkas` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `retur`
--
DELIMITER $$
CREATE TRIGGER `retur barang` AFTER INSERT ON `retur` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah-NEW.jumlah
    WHERE nama_barang = NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_sup` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`user_id`,`perm_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user`
--
ALTER TABLE `aauth_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `cc_options`
--
ALTER TABLE `cc_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field`
--
ALTER TABLE `crud_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `disposal`
--
ALTER TABLE `disposal`
  ADD PRIMARY KEY (`id_disposal`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_field`
--
ALTER TABLE `form_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_pengajuan_pinjam_barang`
--
ALTER TABLE `form_pengajuan_pinjam_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_pengadaan`
--
ALTER TABLE `jenis_pengadaan`
  ADD PRIMARY KEY (`id_jenis_pendagaan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lok`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_block_element`
--
ALTER TABLE `page_block_element`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`id_penempatan`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `rest`
--
ALTER TABLE `rest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_field`
--
ALTER TABLE `rest_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_sup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_user`
--
ALTER TABLE `aauth_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cc_options`
--
ALTER TABLE `cc_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `crud_field`
--
ALTER TABLE `crud_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposal`
--
ALTER TABLE `disposal`
  MODIFY `id_disposal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_field`
--
ALTER TABLE `form_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `form_pengajuan_pinjam_barang`
--
ALTER TABLE `form_pengajuan_pinjam_barang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pengadaan`
--
ALTER TABLE `jenis_pengadaan`
  MODIFY `id_jenis_pendagaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_block_element`
--
ALTER TABLE `page_block_element`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penempatan`
--
ALTER TABLE `penempatan`
  MODIFY `id_penempatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest`
--
ALTER TABLE `rest`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_field`
--
ALTER TABLE `rest_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_sup` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
