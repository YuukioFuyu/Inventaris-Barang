-- Memasukkan data baru ke dalam tabel cc_options
INSERT IGNORE INTO `cc_options` (`id`, `option_name`, `option_value`) VALUES
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

-- Hapus tabel menu lama
DROP TABLE IF EXISTS `menu`;

-- Membuat tabel menu baru
CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Memasukkan data baru ke dalam tabel menu
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
