-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Sep 2020 pada 15.56
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemgudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id_barang` int(10) NOT NULL,
  `id_cabang` int(4) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_by` int(4) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `id_penyimpanan` int(10) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `qr` varchar(100) NOT NULL,
  `stok` int(100) DEFAULT NULL,
  `id_satuan` int(2) NOT NULL,
  `fungsi` varchar(100) NOT NULL,
  `pengambil` varchar(50) NOT NULL,
  `kirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_barang`
--

INSERT INTO `daftar_barang` (`id_barang`, `id_cabang`, `nama_barang`, `id_kategori`, `kode`, `create_date`, `create_by`, `tgl_masuk`, `pengirim`, `id_penyimpanan`, `barcode`, `qr`, `stok`, `id_satuan`, `fungsi`, `pengambil`, `kirim`) VALUES
(47, 1, 'Printer Epson L200i', 1, 'ICT2020PE', '2020-08-24 05:52:03', 3, '0000-00-00 00:00:00', '', 0, '', '', NULL, 3, '', '', ''),
(48, 1, 'CPU DELL Optiplex 7020', 1, 'ICT2020CD7020', '2020-08-24 05:53:55', 3, '0000-00-00 00:00:00', '', 0, '', '', NULL, 3, '', '', ''),
(49, 1, 'Tissue Toilet Livi', 4, 'CS2020TTLV01', '2020-08-24 05:54:48', 3, '0000-00-00 00:00:00', '', 0, '', '', NULL, 3, '', '', ''),
(50, 1, 'Cairan Desinfektan', 4, 'CS2020CD01', '2020-08-24 05:55:51', 3, '0000-00-00 00:00:00', '', 0, '', '', NULL, 2, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_cabang`
--

CREATE TABLE `daftar_cabang` (
  `id_cabang` int(4) NOT NULL,
  `nama_cabang` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_cabang`
--

INSERT INTO `daftar_cabang` (`id_cabang`, `nama_cabang`, `create_date`, `create_by`) VALUES
(1, 'Semarang', '2020-08-13 00:00:00', 1),
(2, 'Surabaya', '2020-08-13 00:00:00', 1),
(3, 'Solo', '2020-08-13 00:00:00', 1),
(4, 'Yogyakarta', '2020-08-13 00:00:00', 1),
(5, 'Denpasar', '2020-08-13 00:00:00', 1),
(6, 'Lombok', '2020-08-13 00:00:00', 1),
(7, 'Makassar', '2020-08-13 00:00:00', 1),
(8, 'Balikpapan', '2020-08-13 00:00:00', 1),
(9, 'Ambon', '2020-08-13 00:00:00', 1),
(10, 'Manado', '2020-08-13 00:00:00', 1),
(11, 'Banjarmasin', '2020-08-13 00:00:00', 1),
(12, 'Jakarta', '2020-08-13 00:00:00', 1),
(13, 'Kupang', '2020-08-13 11:03:26', 1),
(14, 'Biak', '2020-08-13 11:03:26', 1),
(15, 'Jayapura', '2020-08-13 11:03:44', 1),
(16, 'Head Office', '2020-08-13 11:03:44', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_gudang`
--

CREATE TABLE `daftar_gudang` (
  `id_gudang` int(8) NOT NULL,
  `id_cabang` int(4) NOT NULL,
  `nama_gudang` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_gudang`
--

INSERT INTO `daftar_gudang` (`id_gudang`, `id_cabang`, `nama_gudang`, `create_date`, `alamat`) VALUES
(1, 1, 'Gudang Branch APS', '2020-08-13 15:25:29', 'JL Puri Executive'),
(2, 1, 'CS Airport', '2020-08-13 15:25:29', 'Jl.Bandara Ahmad Yani'),
(7, 1, 'Bandara', '2020-09-07 05:01:07', 'kepo'),
(8, 1, 'Bandara2', '2020-09-07 08:02:39', 'yuhuuu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_penerimaan_barang`
--

CREATE TABLE `daftar_penerimaan_barang` (
  `id_penerimaan` int(11) NOT NULL,
  `id_cabang` int(4) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `nama_shipper` varchar(30) NOT NULL,
  `nama_forwarder` varchar(30) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` int(4) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_penerimaan_barang`
--

INSERT INTO `daftar_penerimaan_barang` (`id_penerimaan`, `id_cabang`, `nama_barang`, `nama_shipper`, `nama_forwarder`, `jumlah`, `nomor_po`, `create_date`, `create_by`, `edit_date`, `edit_by`) VALUES
(1, 1, 'Rapid Test Kid', 'APS Pusat Bisdev', 'APLogistik Semarang', 200, '15/445/APS/2020', '2020-08-13 11:06:15', 3, '0000-00-00 00:00:00', 0),
(2, 1, 'Tissue Livi Toilet', 'Livi Cabang Semarang', 'J &amp;amp; T Semarang', 3, '15/430/APS/2020', '2020-08-13 11:27:43', 3, '0000-00-00 00:00:00', 0),
(3, 1, 'Sepatu Olahraga', 'APS Pusat Bisdev', 'APLogistik Semarang', 1, '15/445/APS/2020', '2020-08-13 12:36:53', 3, '0000-00-00 00:00:00', 0),
(4, 1, 'PULPEN', 'pusat', 'jne', 2, 'aps/trrb', '2020-09-04 04:44:07', 3, '0000-00-00 00:00:00', 0),
(5, 1, 'PULPEN', 'pusat', 'jne', 5, 'aps/taaa', '2020-09-04 06:17:46', 3, '0000-00-00 00:00:00', 0),
(6, 1, 'majalah', 'pusat', 'jne', 5, 'aps/aaaa', '2020-09-04 06:35:45', 3, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_penyimpanan`
--

CREATE TABLE `daftar_penyimpanan` (
  `id_penyimpanan` int(4) NOT NULL,
  `id_gudang` int(4) NOT NULL,
  `nama_penyimpanan` varchar(20) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_penyimpanan`
--

INSERT INTO `daftar_penyimpanan` (`id_penyimpanan`, `id_gudang`, `nama_penyimpanan`, `kapasitas`, `sisa`, `last_update`, `edit_by`) VALUES
(1, 1, 'Rak Tisue A', 500, 500, '2020-08-13 08:26:58', 1),
(2, 1, 'Rak Tisue B', 400, 400, '2020-08-13 08:26:58', 1),
(3, 1, 'Rak LT 2', 200, 100, '2020-08-13 08:27:34', 1),
(4, 1, 'Rak LT 2 B', 1000, 1000, '2020-08-13 08:27:34', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `id_cabang` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `id_cabang`) VALUES
(1, 'ICT', 1),
(2, 'General Affair', 1),
(3, 'Fasility Support', 1),
(4, 'Cleaning Service', 1),
(5, 'Equipment', 1),
(6, 'OB', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(2) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'Administrator Sistem'),
(2, 'Staf Logistik'),
(3, 'Branch Manager'),
(4, 'VP PLGA'),
(5, 'Staf Non-Job');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resi`
--

CREATE TABLE `resi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `requester` int(4) NOT NULL,
  `user` int(4) NOT NULL,
  `product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resi`
--

INSERT INTO `resi` (`id`, `tanggal`, `requester`, `user`, `product`) VALUES
(1, '2020-09-07 13:13:30', 1, 3, ''),
(13, '2020-09-07 13:24:38', 1, 3, ''),
(14, '2020-09-07 13:24:39', 1, 3, ''),
(15, '2020-09-07 14:19:21', 1, 3, ''),
(16, '2020-09-07 14:19:21', 1, 3, ''),
(17, '2020-09-07 14:42:23', 1, 3, ''),
(18, '2020-09-07 14:42:24', 1, 3, ''),
(19, '2020-09-07 14:42:28', 1, 3, ''),
(20, '2020-09-07 14:42:28', 1, 3, ''),
(21, '2020-09-07 14:43:44', 1, 3, ''),
(22, '2020-09-07 14:43:44', 1, 3, ''),
(23, '2020-09-07 14:44:43', 1, 3, ''),
(24, '2020-09-07 14:45:25', 1, 3, ''),
(25, '2020-09-07 14:46:27', 1, 3, ''),
(26, '2020-09-07 14:46:27', 1, 3, ''),
(27, '2020-09-07 14:46:56', 1, 3, ''),
(28, '2020-09-07 14:46:56', 1, 3, ''),
(29, '2020-09-07 14:48:15', 1, 3, ''),
(30, '2020-09-07 14:48:16', 1, 3, ''),
(31, '2020-09-07 14:48:50', 1, 3, ''),
(32, '2020-09-07 14:48:50', 1, 3, ''),
(33, '2020-09-07 14:52:45', 1, 3, ''),
(34, '2020-09-07 14:52:45', 1, 3, ''),
(35, '2020-09-07 14:52:45', 1, 3, ''),
(36, '2020-09-07 14:52:47', 1, 3, ''),
(37, '2020-09-07 14:53:57', 1, 3, ''),
(38, '2020-09-07 14:56:29', 1, 3, ''),
(39, '2020-09-07 14:57:08', 1, 3, ''),
(40, '2020-09-07 15:01:03', 1, 3, ''),
(41, '2020-09-07 15:01:03', 1, 3, ''),
(42, '2020-09-07 15:01:03', 1, 3, ''),
(43, '2020-09-07 15:05:49', 1, 3, ''),
(44, '2020-09-07 15:07:05', 1, 3, ''),
(45, '2020-09-07 15:07:52', 1, 3, ''),
(46, '2020-09-07 15:08:03', 1, 3, ''),
(47, '2020-09-07 15:08:47', 1, 3, ''),
(48, '2020-09-07 15:09:01', 1, 3, ''),
(49, '2020-09-07 15:09:27', 1, 3, ''),
(50, '2020-09-07 15:09:28', 1, 3, ''),
(51, '2020-09-07 15:09:28', 1, 3, ''),
(52, '2020-09-07 15:09:30', 1, 3, ''),
(53, '2020-09-07 15:09:52', 1, 3, ''),
(54, '2020-09-07 15:10:09', 1, 3, ''),
(55, '2020-09-07 15:13:11', 1, 3, ''),
(56, '2020-09-07 15:13:30', 1, 3, ''),
(57, '2020-09-07 15:15:29', 1, 3, ''),
(58, '2020-09-07 15:16:54', 1, 3, ''),
(59, '2020-09-07 15:17:14', 1, 3, ''),
(60, '2020-09-07 15:17:38', 1, 3, ''),
(61, '2020-09-07 15:17:51', 1, 3, ''),
(62, '2020-09-07 15:18:02', 1, 3, ''),
(63, '2020-09-07 15:18:16', 1, 3, ''),
(64, '2020-09-07 15:18:26', 1, 3, ''),
(65, '2020-09-07 15:18:50', 1, 3, ''),
(66, '2020-09-07 15:19:33', 1, 3, ''),
(67, '2020-09-07 15:19:40', 1, 3, ''),
(68, '2020-09-07 15:20:14', 1, 3, ''),
(69, '2020-09-07 15:20:33', 1, 3, ''),
(70, '2020-09-07 15:20:50', 1, 3, ''),
(71, '2020-09-07 15:20:57', 1, 3, ''),
(72, '2020-09-07 15:21:10', 1, 3, ''),
(73, '2020-09-07 15:21:41', 1, 3, ''),
(74, '2020-09-07 15:21:55', 1, 3, ''),
(75, '2020-09-07 15:23:02', 1, 3, ''),
(76, '2020-09-07 15:23:04', 1, 3, ''),
(77, '2020-09-07 15:23:04', 1, 3, ''),
(78, '2020-09-07 15:23:18', 1, 3, ''),
(79, '2020-09-07 15:28:55', 1, 3, ''),
(80, '2020-09-07 15:29:47', 1, 3, ''),
(81, '2020-09-07 15:30:00', 1, 3, ''),
(82, '2020-09-07 15:30:23', 1, 3, ''),
(83, '2020-09-07 15:30:52', 1, 3, ''),
(84, '2020-09-07 15:31:41', 1, 3, ''),
(85, '2020-09-07 15:32:04', 1, 3, ''),
(86, '2020-09-07 15:36:26', 1, 3, ''),
(87, '2020-09-07 15:38:13', 1, 3, ''),
(88, '2020-09-07 15:38:14', 1, 3, ''),
(89, '2020-09-07 15:38:14', 1, 3, ''),
(90, '2020-09-07 15:40:41', 1, 3, ''),
(91, '2020-09-07 15:40:42', 1, 3, ''),
(92, '2020-09-07 15:40:42', 1, 3, ''),
(93, '2020-09-07 15:42:19', 1, 3, ''),
(94, '2020-09-07 15:46:24', 1, 3, ''),
(95, '2020-09-07 15:46:44', 1, 3, ''),
(96, '2020-09-07 15:47:17', 1, 3, ''),
(97, '2020-09-07 15:47:38', 1, 3, ''),
(98, '2020-09-07 15:48:17', 1, 3, ''),
(99, '2020-09-07 15:48:47', 1, 3, ''),
(100, '2020-09-07 15:49:31', 1, 3, ''),
(101, '2020-09-07 15:49:48', 1, 3, ''),
(102, '2020-09-07 15:50:15', 1, 3, ''),
(103, '2020-09-07 15:50:32', 1, 3, ''),
(104, '2020-09-07 15:51:15', 1, 3, ''),
(105, '2020-09-07 15:55:40', 1, 3, ''),
(106, '2020-09-07 15:56:33', 1, 3, ''),
(107, '2020-09-07 15:56:45', 1, 3, ''),
(108, '2020-09-07 15:57:47', 1, 3, ''),
(109, '2020-09-07 15:59:12', 1, 3, ''),
(110, '2020-09-07 15:59:22', 1, 3, ''),
(111, '2020-09-07 16:00:26', 1, 3, ''),
(112, '2020-09-07 16:01:11', 1, 3, ''),
(113, '2020-09-07 16:01:30', 1, 3, ''),
(114, '2020-09-07 16:02:22', 1, 3, ''),
(115, '2020-09-07 16:03:13', 1, 3, ''),
(116, '2020-09-07 16:08:02', 1, 3, ''),
(117, '2020-09-07 16:09:01', 1, 3, ''),
(118, '2020-09-07 16:12:12', 1, 3, ''),
(119, '2020-09-07 16:12:13', 1, 3, ''),
(120, '2020-09-07 16:12:13', 1, 3, ''),
(121, '2020-09-07 16:12:25', 1, 3, ''),
(122, '2020-09-07 16:12:26', 1, 3, ''),
(123, '2020-09-07 16:12:53', 1, 3, ''),
(124, '2020-09-07 16:12:54', 1, 3, ''),
(125, '2020-09-07 16:12:54', 1, 3, ''),
(126, '2020-09-07 16:12:55', 1, 3, ''),
(127, '2020-09-07 16:12:55', 1, 3, ''),
(128, '2020-09-07 16:13:14', 1, 3, ''),
(129, '2020-09-07 16:13:18', 1, 3, ''),
(130, '2020-09-07 16:13:18', 1, 3, ''),
(131, '2020-09-07 16:13:18', 1, 3, ''),
(132, '2020-09-07 16:13:19', 1, 3, ''),
(133, '2020-09-07 16:13:19', 1, 3, ''),
(134, '2020-09-07 16:13:19', 1, 3, ''),
(135, '2020-09-07 16:13:20', 1, 3, ''),
(136, '2020-09-07 16:13:20', 1, 3, ''),
(137, '2020-09-07 16:13:21', 1, 3, ''),
(138, '2020-09-07 16:13:21', 1, 3, ''),
(139, '2020-09-07 16:13:21', 1, 3, ''),
(140, '2020-09-07 16:14:55', 1, 3, ''),
(141, '2020-09-07 16:14:56', 1, 3, ''),
(142, '2020-09-07 16:18:15', 1, 3, ''),
(143, '2020-09-07 16:18:17', 1, 3, ''),
(144, '2020-09-07 16:18:55', 1, 3, ''),
(145, '2020-09-07 16:20:18', 1, 3, ''),
(146, '2020-09-07 16:20:43', 1, 3, ''),
(147, '2020-09-07 16:21:03', 1, 3, ''),
(148, '2020-09-07 16:21:23', 1, 3, ''),
(149, '2020-09-07 16:21:42', 1, 3, ''),
(150, '2020-09-07 16:22:23', 1, 3, ''),
(151, '2020-09-07 16:22:49', 1, 3, ''),
(152, '2020-09-07 16:23:14', 1, 3, ''),
(153, '2020-09-07 16:23:22', 1, 3, ''),
(154, '2020-09-07 16:24:04', 1, 3, ''),
(155, '2020-09-07 16:24:52', 1, 3, ''),
(156, '2020-09-07 16:25:18', 1, 3, ''),
(157, '2020-09-07 16:25:20', 1, 3, ''),
(158, '2020-09-07 16:25:30', 1, 3, ''),
(159, '2020-09-07 16:25:54', 1, 3, ''),
(160, '2020-09-07 21:31:50', 1, 3, ''),
(161, '2020-09-07 21:31:51', 1, 3, ''),
(162, '2020-09-07 21:31:51', 1, 3, ''),
(163, '2020-09-07 21:33:03', 1, 3, ''),
(164, '2020-09-07 21:33:04', 1, 3, ''),
(165, '2020-09-07 21:33:04', 1, 3, ''),
(166, '2020-09-07 21:35:09', 1, 3, ''),
(167, '2020-09-07 21:35:10', 1, 3, ''),
(168, '2020-09-07 21:35:10', 1, 3, ''),
(169, '2020-09-07 21:35:24', 1, 3, ''),
(170, '2020-09-07 21:35:25', 1, 3, ''),
(171, '2020-09-07 21:35:25', 1, 3, ''),
(172, '2020-09-07 21:35:26', 1, 3, ''),
(173, '2020-09-07 21:35:27', 1, 3, ''),
(174, '2020-09-07 21:35:27', 1, 3, ''),
(175, '2020-09-07 21:35:43', 1, 3, ''),
(176, '2020-09-07 21:35:44', 1, 3, ''),
(177, '2020-09-07 21:35:44', 1, 3, ''),
(178, '2020-09-07 21:35:52', 1, 3, ''),
(179, '2020-09-07 21:35:52', 1, 3, ''),
(180, '2020-09-07 21:35:52', 1, 3, ''),
(181, '2020-09-07 21:35:59', 1, 3, ''),
(182, '2020-09-07 21:35:59', 1, 3, ''),
(183, '2020-09-07 21:36:00', 1, 3, ''),
(184, '2020-09-07 21:36:11', 1, 3, ''),
(185, '2020-09-07 21:36:12', 1, 3, ''),
(186, '2020-09-07 21:36:12', 1, 3, ''),
(187, '2020-09-07 21:36:38', 1, 3, ''),
(188, '2020-09-07 21:36:38', 1, 3, ''),
(189, '2020-09-07 21:36:38', 1, 3, ''),
(190, '2020-09-07 21:38:00', 1, 3, ''),
(191, '2020-09-07 21:38:00', 1, 3, ''),
(192, '2020-09-07 21:38:00', 1, 3, ''),
(193, '2020-09-07 21:38:40', 1, 3, ''),
(194, '2020-09-07 21:38:40', 1, 3, ''),
(195, '2020-09-07 21:38:40', 1, 3, ''),
(196, '2020-09-07 21:39:06', 1, 3, ''),
(197, '2020-09-07 21:39:07', 1, 3, ''),
(198, '2020-09-07 21:39:07', 1, 3, ''),
(199, '2020-09-07 21:39:21', 1, 3, ''),
(200, '2020-09-07 21:39:22', 1, 3, ''),
(201, '2020-09-07 21:39:22', 1, 3, ''),
(202, '2020-09-07 21:39:37', 1, 3, ''),
(203, '2020-09-07 21:39:37', 1, 3, ''),
(204, '2020-09-07 21:39:37', 1, 3, ''),
(205, '2020-09-07 21:39:52', 1, 3, ''),
(206, '2020-09-07 21:39:52', 1, 3, ''),
(207, '2020-09-07 21:39:52', 1, 3, ''),
(208, '2020-09-07 21:40:42', 1, 3, ''),
(209, '2020-09-07 21:40:42', 1, 3, ''),
(210, '2020-09-07 21:40:42', 1, 3, ''),
(211, '2020-09-07 21:40:52', 1, 3, ''),
(212, '2020-09-07 21:40:52', 1, 3, ''),
(213, '2020-09-07 21:40:52', 1, 3, ''),
(214, '2020-09-07 21:41:55', 1, 3, ''),
(215, '2020-09-07 21:41:55', 1, 3, ''),
(216, '2020-09-07 21:41:55', 1, 3, ''),
(217, '2020-09-07 21:42:13', 1, 3, ''),
(218, '2020-09-07 21:42:13', 1, 3, ''),
(219, '2020-09-07 21:42:13', 1, 3, ''),
(220, '2020-09-07 21:42:28', 1, 3, ''),
(221, '2020-09-07 21:42:28', 1, 3, ''),
(222, '2020-09-07 21:42:29', 1, 3, ''),
(223, '2020-09-07 21:42:34', 1, 3, ''),
(224, '2020-09-07 21:42:35', 1, 3, ''),
(225, '2020-09-07 21:42:35', 1, 3, ''),
(226, '2020-09-07 21:43:15', 1, 3, ''),
(227, '2020-09-07 21:43:15', 1, 3, ''),
(228, '2020-09-07 21:43:15', 1, 3, ''),
(229, '2020-09-07 21:44:56', 1, 3, ''),
(230, '2020-09-07 21:44:57', 1, 3, ''),
(231, '2020-09-07 21:44:57', 1, 3, ''),
(232, '2020-09-07 21:45:06', 1, 3, ''),
(233, '2020-09-07 21:45:07', 1, 3, ''),
(234, '2020-09-07 21:45:07', 1, 3, ''),
(235, '2020-09-07 21:45:21', 1, 3, ''),
(236, '2020-09-07 21:45:21', 1, 3, ''),
(237, '2020-09-07 21:45:21', 1, 3, ''),
(238, '2020-09-07 21:45:23', 1, 3, ''),
(239, '2020-09-07 21:45:24', 1, 3, ''),
(240, '2020-09-07 21:45:24', 1, 3, ''),
(241, '2020-09-07 21:45:32', 1, 3, ''),
(242, '2020-09-07 21:45:33', 1, 3, ''),
(243, '2020-09-07 21:45:33', 1, 3, ''),
(244, '2020-09-07 21:45:40', 1, 3, ''),
(245, '2020-09-07 21:45:41', 1, 3, ''),
(246, '2020-09-07 21:45:41', 1, 3, ''),
(247, '2020-09-07 21:45:53', 1, 3, ''),
(248, '2020-09-07 21:45:53', 1, 3, ''),
(249, '2020-09-07 21:45:53', 1, 3, ''),
(250, '2020-09-07 21:46:28', 1, 3, ''),
(251, '2020-09-07 21:46:28', 1, 3, ''),
(252, '2020-09-07 21:46:28', 1, 3, ''),
(253, '2020-09-07 21:46:50', 1, 3, ''),
(254, '2020-09-07 21:48:08', 1, 3, ''),
(255, '2020-09-07 21:48:37', 1, 3, ''),
(256, '2020-09-07 21:49:45', 1, 3, ''),
(257, '2020-09-07 21:50:12', 1, 3, ''),
(258, '2020-09-07 21:50:23', 1, 3, ''),
(259, '2020-09-07 21:50:31', 1, 3, ''),
(260, '2020-09-07 21:50:37', 1, 3, ''),
(261, '2020-09-07 22:41:44', 1, 3, ''),
(262, '2020-09-07 22:41:44', 1, 3, ''),
(263, '2020-09-07 22:41:44', 1, 3, ''),
(264, '2020-09-07 22:42:27', 1, 3, ''),
(265, '2020-09-07 22:42:28', 1, 3, ''),
(266, '2020-09-07 22:42:28', 1, 3, ''),
(267, '2020-09-07 22:42:54', 1, 3, ''),
(268, '2020-09-07 22:42:55', 1, 3, ''),
(269, '2020-09-07 22:42:55', 1, 3, ''),
(270, '2020-09-07 22:42:58', 1, 3, ''),
(271, '2020-09-07 22:42:58', 1, 3, ''),
(272, '2020-09-07 22:42:59', 1, 3, ''),
(273, '2020-09-07 22:43:10', 1, 3, ''),
(274, '2020-09-07 22:43:36', 1, 3, ''),
(275, '2020-09-07 22:43:37', 1, 3, ''),
(276, '2020-09-07 22:43:38', 1, 3, ''),
(277, '2020-09-07 22:43:59', 1, 3, ''),
(278, '2020-09-07 22:44:00', 1, 3, ''),
(279, '2020-09-07 22:44:15', 1, 3, ''),
(280, '2020-09-07 22:44:16', 1, 3, ''),
(281, '2020-09-07 22:44:17', 1, 3, ''),
(282, '2020-09-07 22:44:17', 1, 3, ''),
(283, '2020-09-07 22:44:18', 1, 3, ''),
(284, '2020-09-07 22:44:18', 1, 3, ''),
(285, '2020-09-07 22:44:18', 1, 3, ''),
(286, '2020-09-07 22:44:19', 1, 3, ''),
(287, '2020-09-07 22:44:44', 1, 3, ''),
(288, '2020-09-07 22:45:08', 1, 3, ''),
(289, '2020-09-07 22:47:19', 1, 3, ''),
(290, '2020-09-07 22:47:20', 1, 3, ''),
(291, '2020-09-07 22:47:20', 1, 3, ''),
(292, '2020-09-08 11:03:05', 1, 3, ''),
(293, '2020-09-08 11:03:05', 1, 3, ''),
(294, '2020-09-08 11:03:05', 1, 3, ''),
(295, '2020-09-08 11:03:09', 1, 3, ''),
(296, '2020-09-08 11:05:48', 1, 3, ''),
(297, '2020-09-08 11:05:48', 1, 3, ''),
(298, '2020-09-08 11:05:48', 1, 3, ''),
(299, '2020-09-08 11:05:51', 1, 3, ''),
(300, '2020-09-08 11:35:49', 1, 3, ''),
(301, '2020-09-08 11:35:51', 1, 3, ''),
(302, '2020-09-08 11:36:00', 1, 3, ''),
(303, '2020-09-08 11:36:01', 1, 3, ''),
(304, '2020-09-08 11:36:02', 1, 3, ''),
(305, '2020-09-08 11:36:02', 1, 3, ''),
(306, '2020-09-08 11:36:03', 1, 3, ''),
(307, '2020-09-08 11:36:03', 1, 3, ''),
(308, '2020-09-08 11:36:03', 1, 3, ''),
(309, '2020-09-12 23:36:48', 1, 3, ''),
(310, '2020-09-12 23:36:48', 1, 3, ''),
(311, '2020-09-12 23:36:49', 1, 3, ''),
(312, '2020-09-12 23:36:54', 1, 3, ''),
(313, '2020-09-13 00:36:50', 1, 3, ''),
(314, '2020-09-13 00:37:17', 1, 3, ''),
(315, '2020-09-13 00:39:41', 1, 3, ''),
(316, '2020-09-13 00:39:57', 1, 3, ''),
(317, '2020-09-13 00:40:17', 1, 3, ''),
(318, '2020-09-13 00:40:32', 1, 3, ''),
(319, '2020-09-13 00:40:50', 1, 3, ''),
(320, '2020-09-13 00:41:45', 1, 3, ''),
(321, '2020-09-13 00:46:11', 1, 3, ''),
(322, '2020-09-13 00:46:23', 1, 3, ''),
(323, '2020-09-13 00:49:56', 1, 3, ''),
(324, '2020-09-13 00:50:54', 1, 3, ''),
(325, '2020-09-13 00:51:02', 1, 3, ''),
(326, '2020-09-13 00:51:21', 1, 3, ''),
(327, '2020-09-13 00:52:01', 1, 3, ''),
(328, '2020-09-13 00:55:54', 1, 3, ''),
(329, '2020-09-13 00:55:54', 1, 3, ''),
(330, '2020-09-13 00:55:54', 1, 3, ''),
(331, '2020-09-13 00:56:03', 1, 3, ''),
(332, '2020-09-13 00:56:04', 1, 3, ''),
(333, '2020-09-13 00:56:04', 1, 3, ''),
(334, '2020-09-13 00:57:05', 1, 3, ''),
(335, '2020-09-13 00:57:05', 1, 3, ''),
(336, '2020-09-13 00:57:05', 1, 3, ''),
(337, '2020-09-13 01:01:11', 1, 3, 'CPU DELL Optiplex 7020, Printer Epson L200i, Printer Epson L200i, CPU DELL Optiplex 7020'),
(338, '2020-09-13 01:02:16', 1, 3, '29, 26, 26, 24'),
(339, '2020-09-13 01:02:16', 1, 3, ''),
(340, '2020-09-13 01:02:16', 1, 3, '29, 26, 26, 24'),
(341, '2020-09-13 01:02:20', 1, 3, ''),
(342, '2020-09-13 01:03:41', 1, 3, '29, 26, 26, 24, 28'),
(343, '2020-09-13 01:03:42', 1, 3, ''),
(344, '2020-09-13 01:03:42', 1, 3, '29, 26, 26, 24, 28'),
(345, '2020-09-13 01:05:21', 1, 3, '29, 26, 26, 24, 28, 28'),
(346, '2020-09-13 01:05:22', 1, 3, ''),
(347, '2020-09-13 01:05:22', 1, 3, '29, 26, 26, 24, 28, 28'),
(348, '2020-09-13 01:06:27', 1, 3, '21'),
(349, '2020-09-13 01:06:28', 1, 3, ''),
(350, '2020-09-13 01:06:28', 1, 3, '21'),
(351, '2020-09-13 01:07:30', 1, 3, '21, 21, 23'),
(352, '2020-09-13 01:07:31', 1, 3, '21, 21, 23'),
(353, '2020-09-13 01:11:38', 1, 3, '21, 24, 23'),
(354, '2020-09-13 01:11:39', 1, 3, '21, 24, 23'),
(355, '2020-09-13 01:15:22', 1, 3, '21, 24, 23'),
(356, '2020-09-13 01:15:22', 1, 3, '21, 24, 23'),
(357, '2020-09-13 01:16:40', 1, 3, '21, 24, 23'),
(358, '2020-09-13 01:19:13', 1, 3, '21, 24, 23'),
(359, '2020-09-13 01:19:13', 1, 3, '21, 24, 23'),
(360, '2020-09-13 01:19:13', 1, 3, '21, 24, 23'),
(361, '2020-09-13 01:21:07', 1, 3, '21, 24, 23'),
(362, '2020-09-13 01:21:08', 1, 3, '21, 24, 23'),
(363, '2020-09-13 01:21:08', 1, 3, '21, 24, 23'),
(364, '2020-09-13 01:21:36', 1, 3, ''),
(365, '2020-09-13 01:21:37', 1, 3, ''),
(366, '2020-09-13 01:21:37', 1, 3, ''),
(367, '2020-09-13 01:25:49', 1, 3, '25'),
(368, '2020-09-13 01:25:49', 1, 3, '25'),
(369, '2020-09-13 01:25:49', 1, 3, '25'),
(370, '2020-09-13 01:26:54', 1, 3, '25, 25, 25'),
(371, '2020-09-13 01:28:16', 1, 3, '25, 25, 25, 25'),
(372, '2020-09-13 01:28:17', 1, 3, '25, 25, 25, 25'),
(373, '2020-09-13 01:28:17', 1, 3, '25, 25, 25, 25'),
(374, '2020-09-13 01:30:12', 1, 3, '25, 25, 25, 25, 25'),
(375, '2020-09-13 01:30:13', 1, 3, '25, 25, 25, 25, 25'),
(376, '2020-09-13 01:30:13', 1, 3, '25, 25, 25, 25, 25'),
(377, '2020-09-13 01:30:37', 1, 3, '25, 25, 25, 25, 25'),
(378, '2020-09-13 01:30:37', 1, 3, '25, 25, 25, 25, 25'),
(379, '2020-09-13 01:30:38', 1, 3, '25, 25, 25, 25, 25'),
(380, '2020-09-13 01:31:18', 1, 3, '25, 25, 25, 25, 25'),
(381, '2020-09-13 01:31:55', 1, 3, '25, 25, 25, 25, 25'),
(382, '2020-09-13 01:31:55', 1, 3, '25, 25, 25, 25, 25'),
(383, '2020-09-13 01:31:56', 1, 3, '25, 25, 25, 25, 25'),
(384, '2020-09-13 01:34:59', 1, 3, '25, 25, 25, 25, 25'),
(385, '2020-09-13 01:34:59', 1, 3, '25, 25, 25, 25, 25'),
(386, '2020-09-13 01:34:59', 1, 3, '25, 25, 25, 25, 25'),
(387, '2020-09-13 01:35:31', 1, 3, '25, 25, 25, 25, 25'),
(388, '2020-09-13 01:35:31', 1, 3, '25, 25, 25, 25, 25'),
(389, '2020-09-13 01:35:32', 1, 3, '25, 25, 25, 25, 25'),
(390, '2020-09-13 01:41:24', 1, 3, '25, 25, 25, 25, 25'),
(391, '2020-09-13 01:45:13', 1, 3, '25'),
(392, '2020-09-13 01:46:31', 1, 3, '25, 25'),
(393, '2020-09-13 01:47:33', 1, 3, '22'),
(394, '2020-09-13 01:47:57', 1, 3, '22'),
(395, '2020-09-13 01:49:28', 1, 3, '24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan` int(2) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Liter'),
(2, 'Galon'),
(3, 'Pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_barang`
--

CREATE TABLE `stock_barang` (
  `id_stock` int(10) NOT NULL,
  `id_barang` int(4) NOT NULL,
  `stock` bigint(10) NOT NULL DEFAULT '0',
  `id_penyimpanan` int(4) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(4) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock_barang`
--

INSERT INTO `stock_barang` (`id_stock`, `id_barang`, `stock`, `id_penyimpanan`, `qrcode`, `create_date`, `create_by`, `edit_date`, `edit_by`) VALUES
(21, 47, 10, 4, 'UxnUG9JXBWNwRzBdLzsCX9ewOa0riy9wdWj0ILE2bRM.png', '2020-08-25 10:46:33', 3, '2020-09-04 06:37:51', 3),
(22, 50, -5, 3, 'f8BAKfJ4wleA8lnUN9CdM9Wk695DlD8X3-3qDfmYnn0.png', '2020-08-26 10:24:39', 3, '2020-09-04 06:01:30', 3),
(23, 47, -2, 2, 'ETmdpMqYYs7OlfatYSlfN3pMXnvGvlUWPPJ82d2cMVQ.png', '2020-09-04 04:16:38', 3, '2020-09-07 05:15:45', 3),
(24, 48, 8, 1, 'zCll2YgWdL7jMUH1mmWhprkKZOZaOEfKev9gVee1ry0.png', '2020-09-04 04:45:41', 3, '2020-09-04 06:39:56', 3),
(25, 49, -3, 1, 'UpGkfxm9HNDL8efAzOxTPOjd3IggJVsw4bQI8ki3QZc.png', '2020-09-04 06:30:44', 3, '0000-00-00 00:00:00', 0),
(26, 47, 330, 1, 'OpOi6etmlJVe1BTiDWHEUuqDG3VeCVUqGToqW2hD1gU.png', '2020-09-04 06:31:14', 3, '2020-09-07 05:34:37', 3),
(27, 48, 2, 3, 'Etq_j_V362ttnSWn7XxhzteyOMiejhif9yz2IOxTB6M.png', '2020-09-04 06:32:44', 3, '0000-00-00 00:00:00', 0),
(28, 50, 9, 1, 'zGoRBZt-9jdrctoZwfWqEhcG3fgST9ZtV96TTb9z2pw.png', '2020-09-04 06:33:45', 3, '0000-00-00 00:00:00', 0),
(29, 48, 98, 4, 'HLFeQWpacT8uC7PUivLR8QRwCFL31PQfQqwebvQhW-o.png', '2020-09-04 06:39:08', 3, '0000-00-00 00:00:00', 0),
(30, 49, -3, 3, 'dNhrZx67GT5OMkd_jz4h5kXX8JaLAfJw1TPKUvun67s.png', '2020-09-04 06:39:38', 3, '0000-00-00 00:00:00', 0),
(31, 50, 1, 4, 'm5yU13MH-y9UvWa9WLdjPKbDY-iMmtTvWeL1XUPMkDc.png', '2020-09-04 06:41:35', 3, '2020-09-04 06:42:03', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `id_stock` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `id_penyimpanan` int(4) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_penerimaan`, `id_stock`, `id_barang`, `id_penyimpanan`, `jumlah`, `create_date`, `create_by`, `status`) VALUES
(23, 3, 21, 47, 4, 5, '2020-08-25 10:46:34', 3, 0),
(24, 3, 21, 47, 4, 5, '2020-08-26 10:20:35', 3, 0),
(25, 1, 22, 50, 3, 4, '2020-08-26 10:24:40', 3, 0),
(26, 3, 23, 47, 2, 2, '2020-09-04 04:16:39', 3, 0),
(27, 4, 24, 48, 1, 3, '2020-09-04 04:45:41', 3, 0),
(28, 4, 24, 48, 1, 2, '2020-09-04 05:58:05', 3, 0),
(29, 3, 21, 47, 4, 2, '2020-09-04 05:58:25', 3, 0),
(30, 2, 22, 50, 3, 3, '2020-09-04 06:01:30', 3, 0),
(31, 1, 24, 48, 1, 3, '2020-09-04 06:11:42', 3, 0),
(32, 5, 21, 47, 4, 2, '2020-09-04 06:18:22', 3, 0),
(33, 5, 21, 47, 4, 12, '2020-09-04 06:28:13', 3, 0),
(34, 3, 25, 49, 1, 2, '2020-09-04 06:30:44', 3, 0),
(35, 4, 23, 47, 2, 2, '2020-09-04 06:31:07', 3, 0),
(36, 4, 26, 47, 1, 2, '2020-09-04 06:31:14', 3, 0),
(37, 5, 24, 48, 1, 2, '2020-09-04 06:32:11', 3, 0),
(38, 4, 27, 48, 3, 2, '2020-09-04 06:32:44', 3, 0),
(39, 5, 28, 50, 1, 11, '2020-09-04 06:33:46', 3, 0),
(40, 3, 24, 48, 1, 1, '2020-09-04 06:34:07', 3, 0),
(41, 1, 23, 47, 2, 7, '2020-09-04 06:34:32', 3, 0),
(42, 6, 21, 47, 4, 1, '2020-09-04 06:37:51', 3, 0),
(43, 5, 26, 47, 1, 100, '2020-09-04 06:38:45', 3, 0),
(44, 6, 29, 48, 4, 100, '2020-09-04 06:39:08', 3, 0),
(45, 1, 30, 49, 3, -3, '2020-09-04 06:39:38', 3, 0),
(46, 3, 24, 48, 1, 1, '2020-09-04 06:39:56', 3, 0),
(47, 6, 26, 47, 1, 1, '2020-09-04 06:40:24', 3, 0),
(48, 6, 26, 47, 1, 111, '2020-09-04 06:40:40', 3, 0),
(49, 6, 26, 47, 1, 111, '2020-09-04 06:40:53', 3, 0),
(50, 1, 31, 50, 4, 0, '2020-09-04 06:41:35', 3, 0),
(51, 1, 31, 50, 4, 1, '2020-09-04 06:42:03', 3, 0),
(52, 5, 23, 47, 2, 2, '2020-09-07 05:15:45', 3, 0),
(53, 6, 26, 47, 1, 2, '2020-09-07 05:16:16', 3, 0),
(54, 4, 26, 47, 1, 2, '2020-09-07 05:22:53', 3, 0),
(55, 5, 26, 47, 1, 2, '2020-09-07 05:34:37', 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id_item` bigint(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_lokasi` int(4) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `create_by` int(4) NOT NULL,
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pengirim` varchar(50) NOT NULL,
  `fungsi` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id_item`, `id_barang`, `jumlah`, `id_lokasi`, `id_kategori`, `create_time`, `create_by`, `edit_time`, `pengirim`, `fungsi`, `gambar`) VALUES
(9, 42, 122, 1, 3, '2020-06-30 22:36:27', 0, '2020-07-01 03:36:27', 'w4tqw4t', 'egtwsrgt', ''),
(10, 38, 122, 2, 3, '2020-06-30 22:37:11', 0, '2020-07-01 03:37:11', 'w4tqw4trgrswg', 'egtwsrgt', ''),
(11, 37, 122, 1, 2, '2020-06-30 22:38:07', 0, '2020-07-01 03:38:07', 'w4tqw4trgrswg', 'egtwsrgtregwr', ''),
(12, 40, 122, 1, 2, '2020-06-30 22:40:44', 0, '2020-07-01 03:40:44', 'w4tqw4trgrswg', 'egtwsrgtregwr', ''),
(13, 40, 122, 1, 2, '2020-06-30 22:41:09', 0, '2020-07-01 03:41:09', 'w4tqw4trgrswg', 'egtwsrgtregwr', ''),
(14, 40, 122, 1, 2, '2020-06-30 22:41:36', 0, '2020-07-01 03:41:36', 'w4tqw4trgrswg', 'egtwsrgtregwr', ''),
(15, 40, 122, 1, 2, '2020-06-30 22:42:36', 0, '2020-07-01 03:42:36', 'w4tqw4trgrswg', 'egtwsrgtregwr', ''),
(26, 39, 115, 6, 3, '2020-06-30 11:01:31', 0, '2020-07-01 04:01:31', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(27, 39, 115, 6, 3, '2020-06-30 11:02:05', 0, '2020-07-01 04:02:05', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(28, 37, 115, 6, 3, '2020-06-30 11:04:42', 0, '2020-07-01 04:04:42', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(29, 37, 115, 6, 3, '2020-06-30 11:06:04', 0, '2020-07-01 04:06:04', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(30, 37, 118, 6, 3, '2020-06-30 11:06:22', 0, '2020-07-01 04:06:22', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(31, 37, 118, 6, 1, '2020-06-30 11:07:05', 0, '2020-07-01 04:07:05', 'swafwefeqsdfcsdfrqr', 'srgergwfrswdfqdwqwerf', ''),
(32, 38, 50, 5, 3, '0000-00-00 00:00:00', 0, '2020-07-01 11:48:57', 'kllk', 'nulis', ''),
(33, 38, 50, 5, 3, '0000-00-00 00:00:00', 0, '2020-07-01 12:04:43', 'kllk', 'nulis', ''),
(34, 42, 23, 5, 4, '0000-00-00 00:00:00', 0, '2020-07-01 12:05:59', 'jjkj', 'dimakan', ''),
(35, 37, 2, 1, 1, '0000-00-00 00:00:00', 0, '2020-07-01 12:06:54', 'as', 'dimakan', ''),
(36, 37, 2, 1, 1, '2020-07-01 16:04:42', 0, '2020-07-02 09:04:42', 'juli', 'nulis', ''),
(37, 37, 5, 1, 1, '2020-07-01 16:09:46', 0, '2020-07-02 09:09:46', 'juli', 'nulis', ''),
(38, 37, 5, 1, 1, '2020-07-01 16:11:54', 0, '2020-07-02 09:11:54', 'juli', 'nulis', ''),
(39, 37, 5, 1, 1, '2020-07-01 16:24:14', 0, '2020-07-02 09:24:14', 'juli', 'nulis', ''),
(40, 37, 5, 1, 1, '2020-07-01 16:28:13', 0, '2020-07-02 09:28:13', 'juli', 'nulis', ''),
(41, 38, 6, 5, 2, '2020-07-01 16:31:13', 0, '2020-07-02 09:31:13', 'julis', 'nuliss', ''),
(42, 40, 7, 6, 2, '2020-07-01 16:33:03', 0, '2020-07-02 09:33:03', 'juliss', 'nulisss', '41.40.6.2.7.juliss.nulisss.png'),
(43, 42, 3, 5, 4, '2020-07-02 18:10:19', 0, '2020-07-02 23:10:19', 'hantu', 'pengharum', '42.42.5.4.3.hantu.pengharum.png'),
(44, 40, 9, 5, 3, '2020-07-02 18:11:13', 0, '2020-07-02 23:11:13', 'jkjk', 'pengharum', '43.40.5.3.9.jkjk.pengharum.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `id_level` int(2) NOT NULL,
  `id_cabang` int(4) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_date` datetime DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `crete_by` int(4) NOT NULL,
  `edit_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nip`, `nama`, `username`, `password`, `no_telp`, `id_level`, `id_cabang`, `create_date`, `edit_date`, `user_status`, `crete_by`, `edit_by`) VALUES
(1, '1902565', 'Johan Denniswara', 'denniswara', 'a458922ae70b68e2227b9626538a3501', '08112899494', 1, 1, '2020-08-13 12:54:56', NULL, 0, 1, 1),
(2, '1741360', 'Pungky Wahyu Nugroho', 'pungkywahyu', '9e3301e1ba7f43b890b29ae134a81706', '085640800400', 2, 1, '2020-08-13 12:58:06', NULL, 0, 1, 1),
(3, '1900845', 'Dani Krisnaningtyas', 'danilogistik', 'e296379c13dd7ca3f0067da7f36fa45f', '082242845082', 2, 1, '2020-08-13 12:58:06', NULL, 0, 1, 1),
(3, '1637467', 'Dani Krisnaningtyas', 'danilogistik', '16c97636748660fdc1599f5838e64dc6', '082242845082', 3, 1, '2020-08-13 12:59:40', NULL, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `daftar_cabang`
--
ALTER TABLE `daftar_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `daftar_gudang`
--
ALTER TABLE `daftar_gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indexes for table `daftar_penerimaan_barang`
--
ALTER TABLE `daftar_penerimaan_barang`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indexes for table `daftar_penyimpanan`
--
ALTER TABLE `daftar_penyimpanan`
  ADD PRIMARY KEY (`id_penyimpanan`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_gudang_2` (`id_gudang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stock_barang`
--
ALTER TABLE `stock_barang`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_level_2` (`id_level`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `daftar_cabang`
--
ALTER TABLE `daftar_cabang`
  MODIFY `id_cabang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `daftar_gudang`
--
ALTER TABLE `daftar_gudang`
  MODIFY `id_gudang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `daftar_penerimaan_barang`
--
ALTER TABLE `daftar_penerimaan_barang`
  MODIFY `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `daftar_penyimpanan`
--
ALTER TABLE `daftar_penyimpanan`
  MODIFY `id_penyimpanan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;
--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stock_barang`
--
ALTER TABLE `stock_barang`
  MODIFY `id_stock` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id_item` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_gudang`
--
ALTER TABLE `daftar_gudang`
  ADD CONSTRAINT `daftar_gudang_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `daftar_cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `daftar_penyimpanan`
--
ALTER TABLE `daftar_penyimpanan`
  ADD CONSTRAINT `daftar_penyimpanan_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `daftar_gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `daftar_cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
