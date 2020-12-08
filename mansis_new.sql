-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 06:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mansis_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `absen_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `alasan` text DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time DEFAULT NULL,
  `lama_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bahasa`
--

CREATE TABLE `bahasa` (
  `bahasa_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahasa`
--

INSERT INTO `bahasa` (`bahasa_id`, `name`) VALUES
(1, 'Indonesia'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `name`, `created`, `updated`) VALUES
(1, 'BANK BNI', '2020-11-23 14:02:32', NULL),
(2, 'BANK BCA', '2020-11-23 14:02:39', NULL),
(3, 'BANK MANDIRI', '2020-11-23 14:02:47', NULL),
(4, 'BANK BJB', '2020-11-23 14:15:57', NULL),
(5, 'BANK BRI', '2020-11-23 14:50:52', NULL),
(7, 'BANK DANAMON', '2020-11-25 23:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `benefit`
--

CREATE TABLE `benefit` (
  `benefit_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `benefit`
--

INSERT INTO `benefit` (`benefit_id`, `name`) VALUES
(1, 'Jabatan'),
(2, 'Makanan'),
(3, 'Transport');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `cabang_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`cabang_id`, `name`, `created`, `updated`) VALUES
(1, 'PEKALONGAN', '2020-11-16 00:01:39', NULL),
(2, 'DEPOK', '2020-11-16 00:01:45', NULL),
(3, 'JAWA BARAT', '2020-11-16 00:01:54', NULL),
(4, 'KUNINGAN', '2020-11-16 00:02:04', NULL),
(5, 'LAMPUNG', '2020-11-16 00:02:15', NULL),
(6, 'SUKABUMI', '2020-11-16 00:02:22', NULL),
(7, 'PEMALANG', '2020-11-16 00:02:32', NULL),
(8, 'BOGOR', '2020-11-16 00:02:38', NULL),
(9, 'CIREBON', '2020-11-16 00:02:44', NULL),
(10, 'JAKARTA SELATAN', '2020-11-16 00:02:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categori`
--

CREATE TABLE `categori` (
  `categori_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categori`
--

INSERT INTO `categori` (`categori_id`, `name`, `created`, `updated`) VALUES
(23, 'Alat Berat', '2020-11-15 21:22:41', NULL),
(24, 'Elektronik', '2020-11-15 21:23:51', NULL),
(25, 'Mobil', '2020-11-15 21:23:59', NULL),
(26, 'Motor', '2020-11-15 21:24:08', NULL),
(27, 'Properti', '2020-11-15 21:24:17', NULL),
(28, 'Scalfolding', '2020-11-15 21:24:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoripotongan`
--

CREATE TABLE `categoripotongan` (
  `categoripotongan_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoripotongan`
--

INSERT INTO `categoripotongan` (`categoripotongan_id`, `name`) VALUES
(1, 'BPJS Ketenaga Kerja'),
(2, 'BPJS Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `pasar_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_karyawan`
--

CREATE TABLE `history_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_karyawan`
--

INSERT INTO `history_karyawan` (`id`, `nama`, `info`, `tanggal`, `user_agent`) VALUES
(888, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 14:55:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(889, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 14:57:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(890, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '04/12/2020 19:16:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(891, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 09:14:36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(892, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:10:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(893, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:14:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(894, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '05/12/2020 10:21:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(895, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '06/12/2020 16:46:04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(896, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '07/12/2020 10:06:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(897, 'Admin Aplikasi', 'Admin Aplikasi Telah melakukan login', '08/12/2020 00:24:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36'),
(898, 'adminwad', 'adminwad Telah melakukan login', '08/12/2020 00:40:19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `categori_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `barcode`, `name`, `categori_id`, `unit_id`, `perusahaan_id`, `price`, `stock`, `created`, `updated`) VALUES
(48, '123456789', 'Laptop', 24, 19, 21, 1000, 0, '2020-12-03 20:19:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `name`, `perusahaan_id`, `created`, `updated`) VALUES
(1, 'ADMIN', 0, '2020-11-15 23:50:58', NULL),
(12, 'ADMIN UMUM', 0, '2020-11-16 15:28:21', NULL),
(14, 'DIREKTUR', 0, '2020-11-16 15:29:14', NULL),
(19, 'ENGINNER', 0, '2020-11-16 15:30:08', NULL),
(23, 'ADMIN KEUANGAN', 0, '2020-11-30 17:50:41', NULL),
(24, 'DESAIN GRAFIS', 0, '2020-11-30 17:50:58', NULL),
(25, 'AUDIT', 0, '2020-11-30 17:51:08', NULL),
(26, 'KETUA KOPERASI', 0, '2020-11-30 17:52:56', NULL),
(27, 'MARKETING', 0, '2020-11-30 17:53:07', NULL),
(28, 'KOLEKTOR', 0, '2020-11-30 17:53:12', NULL),
(29, 'DRIVER', 0, '2020-11-30 17:53:27', NULL),
(30, 'KEPALA CABANG', 0, '2020-11-30 17:53:46', NULL),
(31, 'MANAGER AREA', 0, '2020-11-30 17:53:59', NULL),
(32, 'DRAFTER', 0, '2020-11-30 17:54:31', NULL),
(33, 'ANALIS KREDIT', 0, '2020-11-30 17:55:04', NULL),
(34, 'STAF IT', 0, '2020-11-30 17:55:18', NULL),
(36, 'ACCOUNTING', 0, '2020-11-30 22:35:12', NULL),
(37, 'MANAGER PENGEMBANGAN', 0, '2020-11-30 22:37:12', NULL),
(38, 'LEADER SALES OPERASIONAL', 0, '2020-11-30 22:51:41', NULL),
(39, 'SALES RETAIL MSI MART', 0, '2020-11-30 22:53:49', NULL),
(40, 'MAINTENANCE', 0, '2020-11-30 22:58:16', NULL),
(41, 'SCAFOLDING', 0, '2020-11-30 22:59:12', NULL),
(42, 'FRONTLINER MSI MART', 0, '2020-11-30 22:59:55', NULL),
(43, 'MANAGER', 0, '2020-11-30 23:03:33', NULL),
(44, 'ANALIS BISNIS', 0, '2020-11-30 23:04:39', NULL),
(45, 'OFFICE BOY', 0, '2020-11-30 23:55:56', NULL),
(46, 'IT PROGRAMMER', 0, '2020-12-01 00:02:17', NULL),
(47, 'MEKANIK ELEKTRIK', 0, '2020-12-01 00:07:19', NULL),
(48, 'PROPERTY', 0, '2020-12-01 00:12:53', NULL),
(49, 'UMUM', 0, '2020-12-01 00:16:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jns_akun`
--

CREATE TABLE `jns_akun` (
  `id` bigint(20) NOT NULL,
  `kd_aktiva` varchar(5) DEFAULT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `jns_trans` varchar(50) DEFAULT NULL,
  `akun` enum('Aktiva','Pasiva') DEFAULT NULL,
  `laba_rugi` enum('','PENDAPATAN','BIAYA') DEFAULT NULL,
  `pemasukan` enum('Y','N') DEFAULT NULL,
  `pengeluaran` enum('Y','N') DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jns_akun`
--

INSERT INTO `jns_akun` (`id`, `kd_aktiva`, `perusahaan_id`, `jns_trans`, `akun`, `laba_rugi`, `pemasukan`, `pengeluaran`, `aktif`) VALUES
(1, 'A4', 0, 'Piutang Usaha PT.Mas Scafolding', 'Aktiva', '', 'Y', 'Y', 'Y'),
(2, 'A5', 0, 'Piutang Usaha PT.Mas minimarket', 'Aktiva', '', 'Y', 'Y', 'Y'),
(3, 'A6', 0, 'Putang Usaha PT.Mas Property', 'Aktiva', '', 'Y', 'Y', 'Y'),
(4, 'A7', 0, 'Piutang KSP Bulanan', 'Aktiva', '', 'Y', 'Y', 'Y'),
(5, 'A8', 0, 'Piutang KSP Mingguan', 'Aktiva', '', 'Y', 'Y', 'Y'),
(6, 'A9', 21, 'Putang Usaha PT.wad', 'Aktiva', '', 'Y', 'Y', 'Y'),
(7, 'A10', 0, 'Perlengkapan Usaha PT.Mas Scafolding', 'Aktiva', '', 'N', 'Y', 'Y'),
(8, 'C', 0, 'Aktiva Tetap Berwujud', 'Aktiva', '', NULL, NULL, 'Y'),
(9, 'C1', 0, 'Inventaris Kendaraan Ksp Bulanan', 'Aktiva', '', 'Y', 'Y', 'Y'),
(10, 'C2', 0, 'Inventaris Kendaraan Ksp Mingguan', 'Aktiva', '', 'N', 'Y', 'Y'),
(11, 'C3', 0, 'Inventaris Kendaraan Pt.WAD', 'Aktiva', '', 'N', 'Y', 'Y'),
(12, 'C4', 0, 'Inventaris KendaraanPT.Mas property', 'Aktiva', '', 'N', 'Y', 'Y'),
(13, 'E', 0, 'Modal Pribadi Arta Group', 'Aktiva', '', 'N', 'N', 'N'),
(14, 'E1', 0, 'Prive', 'Aktiva', '', 'Y', 'Y', 'N'),
(15, 'F', 0, 'Utang', 'Pasiva', '', NULL, NULL, 'Y'),
(16, 'F1', 0, 'Utang Usaha supplier PT.Mas Scafolding', 'Pasiva', '', 'Y', 'Y', 'Y'),
(17, 'K3', 0, 'Gaji Karyawan PT.MAS Minimarket', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(18, 'F4', 0, 'Utang Pajak PT.MAS', 'Pasiva', '', 'Y', 'Y', 'Y'),
(19, 'F5', 0, 'Utang Pajak PT.WAD', 'Pasiva', '', 'Y', 'Y', 'Y'),
(20, 'H', 0, 'Utang Jangka Panjang', 'Pasiva', '', NULL, NULL, 'Y'),
(21, 'H1', 0, 'Utang BFI Finance', 'Pasiva', '', 'Y', 'Y', 'Y'),
(22, 'H2', 0, 'Utang Adira Finance', 'Pasiva', '', 'Y', 'Y', 'N'),
(23, 'I', 0, 'Modal', 'Pasiva', '', NULL, NULL, 'Y'),
(24, 'I1', 0, 'Modal awal PT.WAM', 'Pasiva', '', 'Y', 'Y', 'Y'),
(25, 'I2', 0, 'Modal Awal Ksp Mingguan', 'Pasiva', '', 'Y', 'Y', 'Y'),
(26, 'I3', 0, 'Modal Awal PT.WAD', 'Pasiva', '', 'Y', 'Y', 'Y'),
(27, 'I4', 0, 'Modal Awal PT.MAS Scafolding', 'Pasiva', '', 'Y', 'Y', 'Y'),
(28, 'I5', 0, 'Modal Awal PT.Mas Minimarket', 'Pasiva', '', 'Y', 'Y', 'Y'),
(29, 'I6', 0, 'Modal Awal KSP Bulanan', 'Pasiva', '', 'Y', 'Y', 'Y'),
(30, 'J', 0, 'Pendapatan', 'Pasiva', 'PENDAPATAN', NULL, NULL, 'Y'),
(31, 'J1', 0, 'Pendapatan Anguran Kasbon', 'Pasiva', 'PENDAPATAN', 'Y', 'Y', 'Y'),
(32, 'J2', 0, 'Pendapatan PT.Mas Rental Scafolding', 'Pasiva', 'PENDAPATAN', 'Y', 'Y', 'Y'),
(33, 'K', 0, 'Beban', 'Aktiva', '', NULL, NULL, 'Y'),
(34, 'K1', 0, 'Gaji Karyawan PT.WAD', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(35, 'K5', 0, 'Gaji Karyawan KSP Mingguan', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(36, 'K4', 0, 'Gaji Karyawan KSP.Bulanan', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(37, 'K10', 0, 'Biaya Listrik KSP', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(38, 'TRF', 0, 'Transfer Antar Kas', NULL, '', NULL, NULL, 'N'),
(39, 'A11', 0, 'Permisalan', 'Aktiva', '', 'Y', 'Y', 'Y'),
(40, 'J3', 0, 'Pendapatan PT.Mas Mini Market', 'Pasiva', 'PENDAPATAN', 'Y', 'Y', 'Y'),
(41, 'J4', 0, 'Pendapatan PT.WAD', 'Pasiva', 'PENDAPATAN', 'Y', 'Y', 'Y'),
(42, 'J5', 0, 'Pendapatan Texnoss design', 'Pasiva', 'PENDAPATAN', 'Y', 'Y', 'Y'),
(43, 'K2', 0, 'Gaji Karyawan PT.MAS Scafolding', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(44, 'K6', 0, 'Gaji Karyawan Texnoss design', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(45, 'K7', 0, 'Gaji Karyawan PT.WAM', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(46, 'F2', 0, 'Utang Supplier PT.Mas mini market', 'Pasiva', '', 'Y', 'Y', 'Y'),
(47, 'F3', 0, 'Utang PT.Mas Property', 'Pasiva', '', 'Y', 'Y', 'Y'),
(48, 'F6', 0, 'Utang Pajak KSP Bulanan', 'Pasiva', '', 'Y', 'Y', 'Y'),
(49, 'F7', 0, 'Utang pajak PT.WAM', 'Pasiva', '', 'Y', 'Y', 'Y'),
(50, 'H3', 0, 'Utang Bank Mandiri ', 'Pasiva', '', 'Y', 'Y', 'Y'),
(51, 'K8', 0, 'Sewa Kantor PT.WAD', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(52, 'K9', 0, 'Sewa Kantor PT.Mas', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(53, 'k11', 0, 'Sewa Kantor KSP ', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(54, 'k12', 0, 'Biaya Internet PT.Wad', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(55, 'K13', 0, 'Biaya internet KSP', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(56, 'k14', 0, 'Biaya internet PT.Mas Scafolding', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(57, 'K15', 0, 'Biaya Internet PT.Mas Minimarket', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(58, 'k16', 0, 'Bayar listrik  PT.WAD', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(59, 'k17', 0, 'Biaya listrik Pt.Mas', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(60, 'I7', 0, 'Modal Awal PT.Mas Property', 'Pasiva', '', 'Y', 'Y', 'Y'),
(61, 'c5', 0, 'Inventaris Kendaraan PT.Mas Minimarket', 'Aktiva', '', 'N', 'Y', 'Y'),
(62, 'c6', 0, 'Inventaris Kendaraan Pt mas rental scafolding', 'Aktiva', '', 'N', 'Y', 'Y'),
(63, 'c7', 0, 'Aktiva lainnya', 'Aktiva', '', 'Y', 'N', 'Y'),
(64, 'c8', 0, 'Inventaris Mesin Ksp Mingguan', 'Aktiva', '', 'N', 'Y', 'Y'),
(65, 'c9', 0, 'Inventaris Mesin Ksp Bulanan', 'Aktiva', '', 'N', 'Y', 'Y'),
(66, 'c10', 0, 'Inventaris Mesin PT.WAD', 'Aktiva', '', 'N', 'Y', 'Y'),
(67, 'c11', 0, 'Inventaris Mesin PT.Mas Property', 'Aktiva', '', 'N', 'Y', 'Y'),
(68, 'c12', 0, 'Inventaris Mesin PT.Mas minimarket', 'Aktiva', '', 'N', 'Y', 'Y'),
(69, 'c13', 0, 'Inventaris Mesin Pt mas rental scafolding', 'Aktiva', '', 'N', 'Y', 'Y'),
(70, 'c14', 0, 'Inventaris mesin PT.WAM', 'Aktiva', '', 'N', 'Y', 'Y'),
(71, 'a12', 0, 'Biaya Dibayar Dimuka', 'Aktiva', '', 'N', 'Y', 'Y'),
(72, 'I8', 0, 'Modal Arta Art', 'Pasiva', '', 'Y', 'Y', 'Y'),
(73, 'k18', 0, 'Gaji Karyawan Arta Art', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(74, 'k19', 0, 'Kasbon Pekerjaan IT PT.WAD', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(75, 'k20', 0, 'Gaji Karyawan PT.MAS Property', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y'),
(76, 'k21', 0, 'Gaji Karyawan Arta Group', 'Aktiva', 'BIAYA', 'N', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `jns_angsuran`
--

CREATE TABLE `jns_angsuran` (
  `id` bigint(20) NOT NULL,
  `ket` int(11) DEFAULT NULL,
  `aktif` enum('Y','T','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jns_angsuran`
--

INSERT INTO `jns_angsuran` (`id`, `ket`, `aktif`) VALUES
(24, 1, 'Y'),
(25, 2, 'Y'),
(26, 3, 'Y'),
(27, 4, 'Y'),
(28, 5, 'Y'),
(29, 6, 'Y'),
(30, 7, 'Y'),
(31, 8, NULL),
(32, 9, NULL),
(33, 10, NULL),
(34, 11, NULL),
(35, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jns_kas`
--

CREATE TABLE `jns_kas` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `aktif` enum('Y','T') DEFAULT NULL,
  `tmpl_simpan` enum('Y','T') DEFAULT NULL,
  `tmpl_penarikan` enum('Y','T') DEFAULT NULL,
  `tmpl_pinjaman` enum('Y','T') DEFAULT NULL,
  `tmpl_bayar` enum('Y','T') DEFAULT NULL,
  `tmpl_pemasukan` enum('Y','T') DEFAULT NULL,
  `tmpl_pengeluaran` enum('Y','T') DEFAULT NULL,
  `tmpl_transfer` enum('Y','T') DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jns_simpanan`
--

CREATE TABLE `jns_simpanan` (
  `id` int(5) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `tampil` enum('Y','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jns_simpanan`
--

INSERT INTO `jns_simpanan` (`id`, `ket`, `perusahaan_id`, `jumlah`, `tampil`) VALUES
(56, 'Arisan Karyawan PT WAHYU ARTA DIGITAL (WAD)', 21, 45000, 'Y'),
(57, 'Arisan Karyawan KSP WAHYU ARTA SEJAHTERA', 8, 10000, 'Y'),
(58, 'Arisan Karyawan PT MUTIARA WAHYUARTA SEJAHTERA', 7, 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `kamus`
--

CREATE TABLE `kamus` (
  `kamus_id` int(5) NOT NULL,
  `bahasa_id` int(3) DEFAULT NULL,
  `kode_kamus` int(3) DEFAULT NULL,
  `teks` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamus`
--

INSERT INTO `kamus` (`kamus_id`, `bahasa_id`, `kode_kamus`, `teks`) VALUES
(90, 1, 1, 'Selamat Datang'),
(91, 2, 1, 'Welcome'),
(92, 1, 2, 'Daftar Pekerjaan'),
(93, 2, 2, 'Job List'),
(94, 1, 3, 'Absen'),
(95, 2, 3, 'Absent'),
(96, 1, 4, 'Pengumuman'),
(97, 2, 4, 'Announcement'),
(98, 1, 5, 'Laporan'),
(99, 2, 5, 'Report'),
(100, 1, 6, 'Tambah Kata'),
(101, 2, 6, 'Add Word');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `kd_karyawan` varchar(100) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `jk_kelamin` varchar(50) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `status_id` int(5) DEFAULT NULL,
  `phone_saudara` varchar(15) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `gaji_pokok` int(11) DEFAULT NULL,
  `jam_kerja` int(11) DEFAULT NULL,
  `rate_gaji` int(11) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `kd_karyawan`, `name`, `ktp`, `alamat`, `phone`, `pendidikan`, `jk_kelamin`, `jabatan_id`, `perusahaan_id`, `tgl_masuk`, `status_id`, `phone_saudara`, `photo`, `gaji_pokok`, `jam_kerja`, `rate_gaji`, `password`, `bank_id`, `no_rek`, `created`, `updated`) VALUES
(45, '19020006', 'PUTRI ANISA', '', '', '', 'S1', 'Perempuan', 23, 7, '2020-11-30', 1, '', 'item-201130-30380f916b.png', 0, 0, 0, NULL, 1, '123456789', '2020-11-30 18:44:19', '2020-11-30'),
(51, '18120004', 'RIA HARYATI', '', '', '', 'SMA/SMK', 'Perempuan', 30, 8, '0000-00-00', 1, '', 'item-201130-0af98bde86.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:00:13', '2020-11-30'),
(52, '19020005', 'IIS MUHAROH', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201130-2072474d2a.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:04:06', NULL),
(53, '18010010', 'SUTIKNO', '', '', '', '', '', 25, 8, '0000-00-00', 0, '', 'item-201130-a31f1965be.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:18:13', NULL),
(54, '18010011', 'DWI NINGSIH', '', '', '', '', '', 26, 8, '0000-00-00', 0, '', 'item-201130-49b94d3857.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:18:58', '2020-11-30'),
(55, '19070012', 'MURTIONO', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201130-4aaf13ba15.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:21:10', NULL),
(56, '19040015', 'ENDAH ROMMAEDAH FIRDAUS', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-89e4489341.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:22:58', NULL),
(57, '19090021', 'ALBERT POSMA SIMANUNGKALIT', '', '', '', '', '', 33, 8, '0000-00-00', 0, '', 'item-201130-0446c13e8c.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:23:34', NULL),
(58, '19070027', 'MOH NURHADI', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-2ab372db97.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:34:38', NULL),
(59, '19090028', 'LINDA DEWI MARTIANTI', '', '', '', '', '', 36, 8, '0000-00-00', 0, '', 'item-201130-c69fb16d09.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:35:47', NULL),
(60, '19090031', 'HARTATI', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-cecb365252.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:36:38', NULL),
(61, '20060049', 'MILTON WILLY HARLAN', '', '', '', '', '', 37, 7, '0000-00-00', 0, '', 'item-201130-bfd7118090.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:37:47', NULL),
(62, '20060050', 'AGUNG CATUR PRASETIO', '', '', '', '', '', 24, 7, '0000-00-00', 0, '', 'item-201130-7f59b6d3f0.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:38:16', NULL),
(63, '20070053', 'SUSI RAMADANTI', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201130-b48c8d9497.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:39:44', NULL),
(64, '20070054', 'HARI SOPIAN', '', '', '', '', '', 29, 7, '0000-00-00', 0, '', 'item-201130-eddc9ae103.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:50:25', NULL),
(65, '20070056', 'GUMARA ANGGA FIRNANDO', '', '', '', '', '', 38, 7, '0000-00-00', 0, '', 'item-201130-2564994554.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:51:14', '2020-11-30'),
(66, '20070057', 'AZIMAH ULFI YUDIANI', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201130-ce72e044ac.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:52:37', NULL),
(67, '20070058', 'MUHAMMAD FADLAN AL HABIB', '', '', '', '', '', 1, 7, '0000-00-00', 0, '', 'item-201130-c6d3473540.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:53:30', NULL),
(68, '20070059', 'UNTORO', '', '', '', '', '', 39, 7, '0000-00-00', 0, '', 'item-201130-347a8b70d9.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:57:33', NULL),
(69, '20070061', 'SUYONO', '', '', '', '', '', 40, 7, '0000-00-00', 0, '', 'item-201130-7db6e4f7aa.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:58:05', '2020-11-30'),
(70, '20070062', 'FAJAR BUDIARSO', '', '', '', '', '', 41, 7, '0000-00-00', 0, '', 'item-201130-1ae7e52ed6.png', 0, 0, 0, NULL, 0, '', '2020-11-30 22:59:37', NULL),
(71, '20080063', 'LEGIMAN', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-f3481fbaf6.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:01:37', NULL),
(72, '20080064', 'HESTI FITRIANI', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-9d97c1682c.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:02:06', NULL),
(73, '20080065', 'ARDIAN JOKO PURNOMO', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-2cc92ef7b9.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:02:28', NULL),
(74, '20080066', 'LILIS FADILLAH', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-0a83708c01.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:02:55', NULL),
(75, '20080067', 'ANDRIYANA SUGENG RIYADI', '', '', '', '', '', 43, 8, '0000-00-00', 0, '', 'item-201130-d4a0a7547a.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:04:02', NULL),
(76, '20080068', 'IMAM PUJIANTORO', '', '', '', '', '', 44, 8, '0000-00-00', 0, '', 'item-201130-49e6526b6f.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:04:29', '2020-11-30'),
(77, '20080069', 'NIA ANGGRAINI', '', '', '', '', '', 23, 7, '0000-00-00', 0, '', 'item-201130-9b0bcc6202.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:05:41', NULL),
(78, '20080070', 'ABDUL RIZAL', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201130-919a04d8d2.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:32:39', NULL),
(79, '20080071', 'ADIE RINALDIE', '', '', '', '', '', 32, 7, '0000-00-00', 0, '', 'item-201130-bc67d98d9f.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:33:54', NULL),
(80, '20080072', 'MEGA TIARA PUTRI', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-0197952eb2.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:34:34', NULL),
(81, '20080073', 'AHMAD KAHFI', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-91087c27aa.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:36:08', NULL),
(82, '20080074', 'HENGKI AFIYANTO', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-4b6bf919eb.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:47:38', NULL),
(84, '20080075', 'SUKAMTO', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201130-ee3ecc0d8d.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:50:08', '2020-11-30'),
(87, '20080076', 'WAHYU TRISTO SUJITO', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201130-c4a3de77a0.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:55:21', NULL),
(88, '20080077', 'KUSAIRI', '', '', '', '', '', 45, 8, '0000-00-00', 0, '', 'item-201130-79f72e162f.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:57:07', NULL),
(89, '20080080', 'SOFIYAN HADI PRIMANTO', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201130-4d1072ece0.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:57:30', NULL),
(90, '20080081', 'IRNAWATI', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201130-8224803133.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:57:58', NULL),
(91, '20080082', 'SURADI', '', '', '', '', '', 42, 7, '0000-00-00', 0, '', 'item-201130-d02489f532.png', 0, 0, 0, NULL, 0, '', '2020-11-30 23:58:27', NULL),
(92, '20080083', 'ALDI IRSAN MAJID', '', '', '', '', '', 34, 21, '0000-00-00', 0, '', 'item-201201-0c19c70a87.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:00:31', NULL),
(93, '20080084', 'MEYDA KURNIA EMYLIA PUTRI', '', '', '', '', '', 34, 21, '0000-00-00', 0, '', 'item-201201-e5179e50a4.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:00:54', NULL),
(94, '20120098', 'MUHAMMAD SAEFUL RAMDAN', '', 'Bogor Tajur Halang', '083874731480', 'S1', 'Laki Laki', 46, 21, '2020-11-13', 2, '083874731480', 'item-201201-2e6d1de0b1.jpg', 0, 0, 0, NULL, 3, '1560015443551', '2020-12-01 00:02:02', '2020-12-01'),
(95, '20090085', 'HADI SUINDRO', '', '', '', '', '', 30, 8, '0000-00-00', 0, '', 'item-201201-5645147c8a.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:03:17', NULL),
(96, '20090086', 'JUPAENDI', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-07b5f33894.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:04:07', '2020-12-01'),
(97, '20090087', 'REZA AZHARY', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-0ca006d619.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:04:30', NULL),
(98, '20090088', 'DANI SEPTIYANTO', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-3a39d17391.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:06:46', NULL),
(99, '20090089', 'MARADONA', '', '', '', '', '', 47, 7, '0000-00-00', 0, '', 'item-201201-9d8edc64b8.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:08:22', NULL),
(100, '20090090', 'RIMA WIJAYANTI', '', '', '', '', '', 1, 7, '0000-00-00', 0, '', 'item-201201-ab0b50f64b.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:08:48', NULL),
(101, '20090091', 'DIAN LESTARI', '', '', '', '', '', 1, 8, '0000-00-00', 0, '', 'item-201201-bf3c6fbd9b.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:10:35', NULL),
(102, '20090092', 'MUH KHANIF', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-4fb5f0fc4c.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:11:01', NULL),
(103, '20090093', 'VEBY MUHAMAD IQBAL', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-ef75230732.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:11:31', NULL),
(104, '20090094', 'AGUNG PRASETYO', '', '', '', '', '', 28, 8, '0000-00-00', 0, '', 'item-201201-bce80cf9e8.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:12:15', NULL),
(105, '20080095', 'RONIPAN', '', '', '', '', '', 48, 7, '0000-00-00', 0, '', 'item-201201-e7d6960243.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:13:21', NULL),
(106, '20080096', 'IRNA WIRIYANTI', '', '', '', '', 'Perempuan', 36, 8, '0000-00-00', 0, '', 'item-201201-ed9a532d83.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:14:04', '2020-12-01'),
(107, '20080097', 'DAVID MEGYA TYAS', '', '', '', '', 'Laki Laki', 36, 8, '0000-00-00', 0, '', 'item-201201-491c4acef9.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:15:37', '2020-12-01'),
(108, '20080098', 'WIWIT WIBI SUSANTO', '', '', '', '', '', 49, 7, '0000-00-00', 0, '', 'item-201201-71b9934df9.png', 0, 0, 0, NULL, 0, '', '2020-12-01 00:17:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kasbon`
--

CREATE TABLE `kasbon` (
  `kasbon_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `besar_uang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `desk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pasar`
--

CREATE TABLE `pasar` (
  `pasar_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `perusahaan_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`perusahaan_id`, `name`, `created`, `updated`) VALUES
(7, 'PT MUTIARA WAHYUARTA SEJAHTERA', '2020-11-15 20:29:52', NULL),
(8, 'KSP WAHYU ARTA SEJAHTERA', '2020-11-15 20:30:04', NULL),
(21, 'PT WAHYU ARTA DIGITAL (WAD)', '2020-12-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

CREATE TABLE `potongan` (
  `potongan_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `categoripotongan_id` int(11) NOT NULL,
  `besar_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `raker`
--

CREATE TABLE `raker` (
  `raker_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `desk` text NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` varchar(150) NOT NULL,
  `note` text NOT NULL,
  `solusi` text NOT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`, `created`, `updated`) VALUES
(1, 'KARYAWAN KONTRAK', '2020-11-17 12:18:31', NULL),
(2, 'FREELAN/BULAN', '2020-11-17 12:18:42', NULL),
(3, 'HARIAN', '2020-11-17 12:18:52', NULL),
(4, 'MAGANG', '2020-11-17 12:19:02', NULL),
(5, 'KARYAWAN MARKETING/BULAN', '2020-11-17 12:19:12', NULL),
(6, 'KARYAWAN TETAP', '2020-11-17 12:19:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `phone`, `address`, `description`, `created`, `updated`, `perusahaan_id`) VALUES
(24, 'PT ABC', '123456789', 'Bekasi', 'ABC', '2020-12-02 18:31:15', NULL, 7),
(25, 'PT ramdan', '123456789', 'bekasi', 'bekasi\r\n', '2020-12-03 05:53:10', NULL, 21),
(26, 'PT RSD', '123456789', 'jakarta', 'SUpllier buku', '2020-12-03 20:17:59', NULL, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tambahan`
--

CREATE TABLE `tambahan` (
  `tambahan_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `benefit_id` int(11) NOT NULL,
  `besar_tambahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_angsuran_supplier`
--

CREATE TABLE `t_angsuran_supplier` (
  `angsuran_id` bigint(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `denda` float(10,2) DEFAULT NULL,
  `status_angsuran` enum('Diterima','Ditolak','Menunggu Konfirmasi') DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dk` enum('D','K') DEFAULT NULL,
  `angsuran_ke` bigint(20) DEFAULT NULL,
  `photo_bukti` varchar(255) DEFAULT NULL,
  `pinjaman_id` bigint(20) NOT NULL,
  `akun_id` bigint(20) DEFAULT NULL,
  `kas_id` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_cart`
--

CREATE TABLE `t_cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount_item` int(11) DEFAULT 0,
  `total` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_kas`
--

CREATE TABLE `t_kas` (
  `kas_id` bigint(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah` double NOT NULL,
  `tipe` enum('Pemasukan','Pengeluaran','Transfer') DEFAULT NULL,
  `dari_kas_id` bigint(20) DEFAULT NULL,
  `untuk_kas_id` bigint(20) DEFAULT NULL,
  `akun_id` bigint(20) DEFAULT NULL,
  `dk` enum('D','K') DEFAULT NULL,
  `update_data` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengajuan_supplier`
--

CREATE TABLE `t_pengajuan_supplier` (
  `pengajuan_id` bigint(20) NOT NULL,
  `no_ajuan` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `status` enum('Setuju','Tolak','Laksanakan','Menunggu','Tunda','Hapus','Lunas') DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `kas_id` bigint(20) DEFAULT NULL,
  `tgl_input` date NOT NULL,
  `tgl_cair` date DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pinjaman_supplier`
--

CREATE TABLE `t_pinjaman_supplier` (
  `pinjaman_id` bigint(20) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `bunga` float(10,2) DEFAULT NULL,
  `biaya_adm` int(11) DEFAULT NULL,
  `status_lunas` enum('Belum','Lunas','Tidak Aktif') DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `dk` enum('D','K') DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `akun_id` bigint(20) DEFAULT NULL,
  `kas_id` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `pengajuan_id` bigint(20) DEFAULT NULL,
  `tgl_update` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_sale`
--

CREATE TABLE `t_sale` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `t_sale`
--
DELIMITER $$
CREATE TRIGGER `del_sale_detail` AFTER DELETE ON `t_sale` FOR EACH ROW BEGIN
    DELETE FROM t_sale_detail
    WHERE sale_id = OLD.sale_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_sale_detail`
--

CREATE TABLE `t_sale_detail` (
  `detail_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `t_sale_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `t_sale_detail` FOR EACH ROW BEGIN
	UPDATE item SET stock = stock - NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER DELETE ON `t_sale_detail` FOR EACH ROW BEGIN
	UPDATE item SET stock = stock + OLD.qty
    WHERE item_id = OLD.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpanan`
--

CREATE TABLE `t_simpanan` (
  `simpanan_id` bigint(20) NOT NULL,
  `tipe` enum('Setoran','Penarikan') DEFAULT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `jenis_id` int(5) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dk` enum('D','K') DEFAULT NULL,
  `nama_kuasa` varchar(255) DEFAULT NULL,
  `identitas_kuasa` varchar(255) DEFAULT NULL,
  `alamat_kuasa` varchar(255) DEFAULT NULL,
  `kas_id` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `update_data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_stock`
--

CREATE TABLE `t_stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` text NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `name`, `created`, `updated`) VALUES
(16, 'Kotak', '2020-08-26 00:26:55', NULL),
(17, 'Kaleng', '2020-08-26 00:27:02', NULL),
(18, 'BOX', '2020-08-26 00:27:09', NULL),
(19, 'PCS', '2020-08-26 00:27:14', NULL),
(20, 'Litter', '2020-08-26 00:27:21', NULL),
(21, 'Bal', '2020-08-27 14:19:25', NULL),
(22, 'Dus', '2020-08-27 14:19:35', NULL),
(23, 'Karung', '2020-10-21 12:16:10', NULL),
(24, 'KG', '2020-10-21 12:16:21', NULL),
(25, 'TON', '2020-10-21 12:16:44', NULL),
(26, 'Meter', '2020-10-21 13:16:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `level` int(1) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `perusahaan_id`, `name`, `address`, `level`, `email`) VALUES
(1, 'admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', NULL, 'Admin Aplikasi', 'Perumahan Sai Residance', 1, 'saepulramdan244@gmail.com'),
(13, 'adminksp', '1cad6287e8530c635cccc7bbae41111cf0fa75a4', 8, 'adminksp', 'Jakarta', 2, ''),
(14, 'adminmws', 'f37f2056058f5765aad23f0113af83ecb15ed4e9', 7, 'adminmws', 'jakarta', 2, ''),
(15, 'adminwad', 'cc18210c7a78b3b5257b2553aa4a2ada18b28cb1', 21, 'adminwad', 'jakarta', 2, 'ramdan_genz@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_sub_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `user_sub_menu`) VALUES
(154, 1, 19),
(155, 1, 18),
(156, 1, 1),
(157, 1, 4),
(158, 1, 5),
(159, 1, 6),
(160, 1, 12),
(161, 1, 14),
(162, 1, 13),
(163, 1, 15),
(164, 1, 16),
(165, 1, 17),
(166, 1, 21),
(167, 1, 22),
(168, 1, 23),
(169, 1, 24),
(170, 1, 25),
(171, 1, 26),
(172, 1, 27),
(173, 1, 28),
(174, 1, 29),
(175, 1, 30),
(176, 1, 20),
(177, 1, 7),
(179, 1, 9),
(181, 2, 4),
(182, 2, 5),
(183, 2, 6),
(185, 2, 13),
(186, 2, 14),
(187, 2, 15),
(188, 2, 16),
(189, 2, 17),
(190, 2, 12),
(191, 2, 21),
(192, 2, 22),
(193, 2, 23),
(194, 2, 24),
(195, 2, 25),
(196, 2, 26),
(197, 2, 28),
(198, 2, 27),
(199, 2, 29),
(200, 2, 30),
(201, 2, 20),
(204, 1, 40),
(205, 1, 41),
(206, 1, 42),
(208, 1, 44),
(209, 1, 45),
(210, 1, 46),
(211, 1, 47),
(212, 1, 48),
(213, 1, 49),
(214, 1, 50),
(215, 1, 51),
(216, 1, 52),
(217, 1, 53),
(218, 1, 54),
(219, 1, 55),
(220, 1, 56),
(221, 1, 57),
(222, 1, 58),
(223, 1, 59),
(224, 1, 60),
(225, 1, 61),
(226, 2, 40),
(227, 2, 41),
(228, 2, 42),
(229, 2, 43),
(230, 2, 44),
(231, 2, 45),
(232, 2, 46),
(233, 2, 47),
(234, 2, 48),
(235, 2, 49),
(236, 2, 50),
(237, 2, 51),
(238, 2, 52),
(239, 2, 53),
(240, 2, 54),
(241, 2, 55),
(242, 2, 56),
(243, 2, 57),
(244, 2, 58),
(245, 2, 59),
(246, 2, 60),
(247, 2, 61),
(248, 1, 8),
(249, 1, 62),
(250, 1, 43),
(252, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`, `urutan`) VALUES
(1, 'Master Data', 'fa fa-list', 2),
(2, 'Inventory', 'fa fa-cube', 3),
(3, 'Human Resource', 'fa fa-users', 4),
(4, 'Pengaturan', 'fa fa-gears', 12),
(6, 'Akuntansi', 'fa fa-book', 5),
(7, 'Raker', 'fa fa-file', 7),
(8, 'Payroll', 'fa fa-paypal', 6),
(20, 'Simpanan', 'fa fa-circle-o', 8),
(21, 'Transaksi Kas', 'fa fa-circle-o', 9),
(22, 'Pinjaman Supplier', 'fa fa-circle-o', 10),
(23, 'Laporan', 'fa fa-circle-o', 11);

--
-- Triggers `user_menu`
--
DELIMITER $$
CREATE TRIGGER `des_sub_menu` AFTER DELETE ON `user_menu` FOR EACH ROW BEGIN
    DELETE FROM user_sub_menu
    WHERE menu_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin Aplikasi'),
(2, 'Admin PT'),
(3, 'HRGA'),
(4, 'Akuntansi'),
(5, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Data Perusahaan', 'perusahaan', 'fa fa-circle-o', 1),
(4, 1, 'Data Cabang', 'cabang', 'fa fa-circle-o', 1),
(5, 1, 'Data Supplier', 'supplier', 'fa fa-circle-o', 1),
(6, 1, 'Data Bank', 'bank', 'fa fa-circle-o', 1),
(7, 4, 'Pengaturan User', 'user', 'fa fa-circle-o', 1),
(8, 4, 'History Login', 'history', 'fa fa-circle-o', 1),
(9, 4, 'Backup', 'backup', 'fa fa-circle-o', 1),
(10, 5, 'Manu Parent', 'backup', 'fa fa-circle-o', 1),
(11, 5, 'Sub Menu', 'backup', 'fa fa-circle-o', 1),
(12, 2, 'Data Inventaris', 'item', 'fa fa-circle-o', 1),
(13, 2, 'Item', 'item/item', 'fa fa-circle-o', 1),
(14, 2, 'Categori', 'categori', 'fa fa-circle-o', 1),
(15, 2, 'Unit', 'unit', 'fa fa-circle-o', 1),
(16, 2, 'Stock In', 'stock/stock_in_data', 'fa fa-circle-o', 1),
(17, 2, 'Stock Out', 'stock/stock_out_data', 'fa fa-circle-o', 1),
(18, 4, 'Pengaturan Level', 'level', 'fa fa-circle-o', 1),
(19, 4, 'Pengaturan Menu', 'user_menu', 'fa fa-circle-o', 1),
(20, 7, 'List Raker', 'raker', 'fa fa-circle-o', 1),
(21, 3, 'Status Karyawan', 'status', 'fa fa-circle-o', 1),
(22, 3, 'Jabatan', 'jabatan', 'fa fa-circle-o', 1),
(23, 3, 'Karyawan', 'karyawan', 'fa fa-circle-o', 1),
(24, 3, 'Kehadiran', 'absen', 'fa fa-circle-o', 1),
(25, 8, 'Salary', 'salary', 'fa fa-circle-o', 1),
(26, 8, 'Pinjaman/Kasbon', 'kasbon', 'fa fa-circle-o', 1),
(27, 8, 'Benefit', 'tambahan', 'fa fa-circle-o', 1),
(28, 8, 'Potongan', 'potongan', 'fa fa-circle-o', 1),
(29, 8, 'Categori Benefit', 'benefit', 'fa fa-circle-o', 1),
(30, 8, 'Categori Potongan', 'categoripotongan', 'fa fa-circle-o', 1),
(40, 1, 'Data Kas', 'jeniskas', 'fa fa-circle-o', 1),
(41, 1, 'Data COA', 'jenisakun', 'fa fa-circle-o', 1),
(42, 1, 'Data Lama Angsuran', 'jenisangsuran', 'fa fa-circle-o', 1),
(43, 1, 'Data Jenis Simpanan', 'jenissimpanan', 'fa fa-circle-o', 1),
(44, 20, 'Setoran Tunai', 'simpanan/setoran', 'fa fa-circle-o', 1),
(45, 20, 'Penarikan Tunai', 'simpanan/penarikan', 'fa fa-circle-o', 1),
(46, 21, 'Pemasukan', 'kas/pemasukan', 'fa fa-circle-o', 1),
(47, 21, 'Pengeluaran', 'kas/pengeluaran', 'fa fa-circle-o', 1),
(49, 22, 'Pengajuan', 'pinjaman_supplier/pengajuan', 'fa fa-circle-o', 1),
(50, 22, 'Pinjaman', 'pinjaman_supplier/pinjaman', 'fa fa-circle-o', 1),
(51, 22, 'Angsuran', 'pinjaman_supplier/angsuran', 'fa fa-circle-o', 1),
(52, 22, 'konfirmasi', 'pinjaman_supplier/konfirmasi', 'fa fa-circle-o', 1),
(53, 22, 'Pinjaman Lunas', 'pinjaman_supplier/lunas', 'fa fa-circle-o', 1),
(54, 23, 'Laporan Data Karyawan', 'laporan/lap_karyawan', 'fa fa-circle-o', 0),
(55, 23, 'Laporan Pinjaman Supplier', 'laporan/lap_pinjaman_supplier', 'fa fa-circle-o', 1),
(56, 23, 'Laporan Simpanan', 'laporan/lap_simpanan', 'fa fa-circle-o', 1),
(57, 23, 'Laporan Transaksi Kas', 'laporan/lap_kas', 'fa fa-circle-o', 1),
(58, 23, 'Laporan Saldo Kas', 'laporan/lap_saldo_kas', 'fa fa-circle-o', 1),
(59, 23, 'Laporan Neraca Kas', 'laporan/lap_neraca_saldo', 'fa fa-circle-o', 1),
(60, 23, 'Laporan Buku Besar', 'laporan/lap_buku_besar', 'fa fa-circle-o', 1),
(61, 23, 'Laporan Laba Rugi', 'laporan/lap_laba_rugi', 'fa fa-circle-o', 1),
(62, 4, 'Pengaturan Bahasa', 'bahasa', 'fa fa-circle-o', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_user_token` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `bahasa`
--
ALTER TABLE `bahasa`
  ADD PRIMARY KEY (`bahasa_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `benefit`
--
ALTER TABLE `benefit`
  ADD PRIMARY KEY (`benefit_id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`cabang_id`);

--
-- Indexes for table `categori`
--
ALTER TABLE `categori`
  ADD PRIMARY KEY (`categori_id`);

--
-- Indexes for table `categoripotongan`
--
ALTER TABLE `categoripotongan`
  ADD PRIMARY KEY (`categoripotongan_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `pasar_id` (`pasar_id`);

--
-- Indexes for table `history_karyawan`
--
ALTER TABLE `history_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `categori_id` (`categori_id`),
  ADD KEY `item_ibfk_2` (`unit_id`),
  ADD KEY `perusahaan_id` (`perusahaan_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `jns_akun`
--
ALTER TABLE `jns_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jns_angsuran`
--
ALTER TABLE `jns_angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jns_kas`
--
ALTER TABLE `jns_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jns_simpanan`
--
ALTER TABLE `jns_simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamus`
--
ALTER TABLE `kamus`
  ADD PRIMARY KEY (`kamus_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `perusahaan_id` (`perusahaan_id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `kasbon`
--
ALTER TABLE `kasbon`
  ADD PRIMARY KEY (`kasbon_id`);

--
-- Indexes for table `pasar`
--
ALTER TABLE `pasar`
  ADD PRIMARY KEY (`pasar_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`perusahaan_id`);

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`potongan_id`),
  ADD KEY `categoripotongan_id` (`categoripotongan_id`);

--
-- Indexes for table `raker`
--
ALTER TABLE `raker`
  ADD PRIMARY KEY (`raker_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tambahan`
--
ALTER TABLE `tambahan`
  ADD PRIMARY KEY (`tambahan_id`),
  ADD KEY `benefit_id` (`benefit_id`);

--
-- Indexes for table `t_angsuran_supplier`
--
ALTER TABLE `t_angsuran_supplier`
  ADD PRIMARY KEY (`angsuran_id`),
  ADD KEY `t_pinjaman_supplier_FK` (`akun_id`) USING BTREE,
  ADD KEY `t_pinjaman_supplier_FK_1` (`kas_id`) USING BTREE,
  ADD KEY `t_pinjaman_supplier_FK_2` (`user_id`) USING BTREE,
  ADD KEY `t_pinjaman_supplier_FK_5` (`perusahaan_id`) USING BTREE,
  ADD KEY `t_angsuran_supplier_FK` (`pinjaman_id`);

--
-- Indexes for table `t_cart`
--
ALTER TABLE `t_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_kas`
--
ALTER TABLE `t_kas`
  ADD PRIMARY KEY (`kas_id`),
  ADD KEY `t_kas_FK` (`akun_id`),
  ADD KEY `t_kas_FK_1` (`dari_kas_id`),
  ADD KEY `t_kas_FK_2` (`untuk_kas_id`),
  ADD KEY `t_kas_FK_3` (`user_id`),
  ADD KEY `t_kas_FK_4` (`perusahaan_id`);

--
-- Indexes for table `t_pengajuan_supplier`
--
ALTER TABLE `t_pengajuan_supplier`
  ADD PRIMARY KEY (`pengajuan_id`),
  ADD KEY `t_pengajuan_supplier_FK` (`user_id`),
  ADD KEY `t_pengajuan_supplier_FK_1` (`supplier_id`),
  ADD KEY `t_pengajuan_supplier_FK_2` (`perusahaan_id`),
  ADD KEY `t_pengajuan_supplier_FK_4` (`item_id`),
  ADD KEY `t_pengajuan_supplier_FK_3` (`kas_id`);

--
-- Indexes for table `t_pinjaman_supplier`
--
ALTER TABLE `t_pinjaman_supplier`
  ADD PRIMARY KEY (`pinjaman_id`),
  ADD KEY `t_pinjaman_supplier_FK` (`akun_id`),
  ADD KEY `t_pinjaman_supplier_FK_1` (`kas_id`),
  ADD KEY `t_pinjaman_supplier_FK_2` (`user_id`),
  ADD KEY `t_pinjaman_supplier_FK_3` (`item_id`),
  ADD KEY `t_pinjaman_supplier_FK_4` (`pengajuan_id`),
  ADD KEY `t_pinjaman_supplier_FK_5` (`perusahaan_id`),
  ADD KEY `t_pinjaman_supplier_FK_6` (`supplier_id`);

--
-- Indexes for table `t_sale`
--
ALTER TABLE `t_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `t_simpanan`
--
ALTER TABLE `t_simpanan`
  ADD PRIMARY KEY (`simpanan_id`),
  ADD KEY `t_simpanan_FK` (`user_id`),
  ADD KEY `t_simpanan_FK_1` (`perusahaan_id`),
  ADD KEY `t_simpanan_FK_2` (`jenis_id`),
  ADD KEY `t_simpanan_FK_3` (`kas_id`);

--
-- Indexes for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kapal_id` (`perusahaan_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `level` (`level`),
  ADD KEY `perusahaan_id` (`perusahaan_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_user_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `bahasa`
--
ALTER TABLE `bahasa`
  MODIFY `bahasa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `benefit`
--
ALTER TABLE `benefit`
  MODIFY `benefit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `cabang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categori`
--
ALTER TABLE `categori`
  MODIFY `categori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categoripotongan`
--
ALTER TABLE `categoripotongan`
  MODIFY `categoripotongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `history_karyawan`
--
ALTER TABLE `history_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `jns_akun`
--
ALTER TABLE `jns_akun`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `jns_angsuran`
--
ALTER TABLE `jns_angsuran`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jns_kas`
--
ALTER TABLE `jns_kas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jns_simpanan`
--
ALTER TABLE `jns_simpanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `kamus`
--
ALTER TABLE `kamus`
  MODIFY `kamus_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `kasbon`
--
ALTER TABLE `kasbon`
  MODIFY `kasbon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasar`
--
ALTER TABLE `pasar`
  MODIFY `pasar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `perusahaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `potongan`
--
ALTER TABLE `potongan`
  MODIFY `potongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `raker`
--
ALTER TABLE `raker`
  MODIFY `raker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tambahan`
--
ALTER TABLE `tambahan`
  MODIFY `tambahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_angsuran_supplier`
--
ALTER TABLE `t_angsuran_supplier`
  MODIFY `angsuran_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `t_kas`
--
ALTER TABLE `t_kas`
  MODIFY `kas_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_pengajuan_supplier`
--
ALTER TABLE `t_pengajuan_supplier`
  MODIFY `pengajuan_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_pinjaman_supplier`
--
ALTER TABLE `t_pinjaman_supplier`
  MODIFY `pinjaman_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_sale`
--
ALTER TABLE `t_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `t_simpanan`
--
ALTER TABLE `t_simpanan`
  MODIFY `simpanan_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_stock`
--
ALTER TABLE `t_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_user_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pasar_id`) REFERENCES `pasar` (`pasar_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`categori_id`) REFERENCES `categori` (`categori_id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`),
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`jabatan_id`);

--
-- Constraints for table `potongan`
--
ALTER TABLE `potongan`
  ADD CONSTRAINT `potongan_ibfk_1` FOREIGN KEY (`categoripotongan_id`) REFERENCES `categoripotongan` (`categoripotongan_id`);

--
-- Constraints for table `tambahan`
--
ALTER TABLE `tambahan`
  ADD CONSTRAINT `tambahan_ibfk_1` FOREIGN KEY (`benefit_id`) REFERENCES `benefit` (`benefit_id`);

--
-- Constraints for table `t_angsuran_supplier`
--
ALTER TABLE `t_angsuran_supplier`
  ADD CONSTRAINT `t_angsuran_supplier_FK` FOREIGN KEY (`pinjaman_id`) REFERENCES `t_pinjaman_supplier` (`pinjaman_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_1_copy` FOREIGN KEY (`kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_2_copy` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_5_copy` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_copy` FOREIGN KEY (`akun_id`) REFERENCES `jns_akun` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_cart`
--
ALTER TABLE `t_cart`
  ADD CONSTRAINT `t_cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_kas`
--
ALTER TABLE `t_kas`
  ADD CONSTRAINT `t_kas_FK` FOREIGN KEY (`akun_id`) REFERENCES `jns_akun` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kas_FK_1` FOREIGN KEY (`dari_kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kas_FK_2` FOREIGN KEY (`untuk_kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kas_FK_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kas_FK_4` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_pengajuan_supplier`
--
ALTER TABLE `t_pengajuan_supplier`
  ADD CONSTRAINT `t_pengajuan_supplier_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pengajuan_supplier_FK_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pengajuan_supplier_FK_2` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pengajuan_supplier_FK_3` FOREIGN KEY (`kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pengajuan_supplier_FK_4` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_pinjaman_supplier`
--
ALTER TABLE `t_pinjaman_supplier`
  ADD CONSTRAINT `t_pinjaman_supplier_FK` FOREIGN KEY (`akun_id`) REFERENCES `jns_akun` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_1` FOREIGN KEY (`kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_4` FOREIGN KEY (`pengajuan_id`) REFERENCES `t_pengajuan_supplier` (`pengajuan_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_5` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pinjaman_supplier_FK_6` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  ADD CONSTRAINT `t_sale_detail_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `t_simpanan`
--
ALTER TABLE `t_simpanan`
  ADD CONSTRAINT `t_simpanan_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_simpanan_FK_1` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_simpanan_FK_2` FOREIGN KEY (`jenis_id`) REFERENCES `jns_simpanan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_simpanan_FK_3` FOREIGN KEY (`kas_id`) REFERENCES `jns_kas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD CONSTRAINT `t_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stock_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `t_stock_ibfk_4` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`perusahaan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
