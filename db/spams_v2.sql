-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 21, 2020 at 06:11 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `spams_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `aset_code` varchar(20) NOT NULL,
  `aset_name` varchar(100) NOT NULL,
  `aset_unit` varchar(100) NOT NULL,
  `subhead_code` char(3) NOT NULL,
  `account_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`aset_code`, `aset_name`, `aset_unit`, `subhead_code`, `account_no`) VALUES
('A-20001', 'Sumur Bor', 'Unit', 'A-2', '1-20001'),
('A-20002', 'Pompa', 'Unit', 'A-2', '1-20003'),
('A-20003', 'Intake', 'Unit', 'A-2', '1-20005'),
('A-20004', 'Reservoir', 'Unit', 'A-2', '1-20007'),
('A-20005', 'Kran Umum', 'Unit', 'A-2', '1-20009'),
('C-10001', 'Bangunan Sekretariat', 'Unit', 'C-1', '1-20011');

-- --------------------------------------------------------

--
-- Table structure for table `aset_head`
--

CREATE TABLE `aset_head` (
  `head_code` char(1) NOT NULL,
  `head_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset_head`
--

INSERT INTO `aset_head` (`head_code`, `head_name`) VALUES
('A', 'Sarana Air Minum'),
('B', 'Sarana Sanitasi'),
('C', 'Aset Sekretariat');

-- --------------------------------------------------------

--
-- Table structure for table `aset_subhead`
--

CREATE TABLE `aset_subhead` (
  `subhead_code` char(3) NOT NULL,
  `subhead_name` varchar(200) NOT NULL,
  `head_code` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset_subhead`
--

INSERT INTO `aset_subhead` (`subhead_code`, `subhead_name`, `head_code`) VALUES
('A-1', 'Aset Perpipaan', 'A'),
('A-2', 'Aset Non Perpipaan', 'A'),
('B-1', 'Aset Sanitasi', 'B'),
('C-1', 'Aset Sekretariat', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `account_no` varchar(20) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `normal_balance` varchar(2) NOT NULL,
  `post` varchar(50) NOT NULL,
  `sub_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_of_account`
--

INSERT INTO `chart_of_account` (`account_no`, `account_name`, `normal_balance`, `post`, `sub_code`) VALUES
('1-10001', 'Kas', 'd', 'kas', '1-1'),
('1-10002', 'Piutang Usaha', 'd', 'kas', '1-1'),
('1-10003', 'Bank Mandiri', 'd', 'bank', '1-1'),
('1-10004', 'Bank BRI', 'd', 'bank', '1-1'),
('1-10005', 'Bank BNI', 'd', 'bank', '1-1'),
('1-20001', 'Sumur Bor', 'd', 'kas', '1-2'),
('1-20002', 'Akumulasi Penyusutan Sumur Bor', 'k', 'kas', '1-2'),
('1-20003', 'Pompa', 'd', 'kas', '1-2'),
('1-20004', 'Akumulasi Penyusutan Pompa', 'k', 'kas', '1-2'),
('1-20005', 'Intake', 'd', 'kas', '1-2'),
('1-20006', 'Akumulasi Penyusuran Intake', 'k', 'kas', '1-2'),
('1-20007', 'Reservoir', 'd', 'kas', '1-2'),
('1-20008', 'Akumulasi Penyusuran Reservoir', 'k', 'kas', '1-2'),
('1-20009', 'Kran Umum', 'd', 'kas', '1-2'),
('1-20010', 'Akumulasi Penyusutan Kran Umum', 'k', 'kas', '1-2'),
('1-20011', 'Bangunan Sekretariat', 'd', 'kas', '1-2'),
('1-20012', 'Akumulasi Penyusutan Sekretariat', 'k', 'kas', '1-2'),
('1-30001', 'Obligasi', 'd', 'bank', '1-3'),
('2-10001', 'Utang Usaha', 'k', 'kas', '2-1'),
('2-20001', 'Pinjaman Bank Mandiri', 'k', 'kas', '2-2'),
('3-10001', 'Modal Usaha', 'k', 'kas', '3-1'),
('3-10002', 'Ekuitas Awal Usaha', 'k', 'kas', '3-1'),
('4-10001', 'Pendapatan Abunemen', 'k', 'kas', '4-1'),
('4-10002', 'Pendapatan Pemakaian Air', 'k', 'kas', '4-1'),
('4-10003', 'Pendapatan denda keterlambatan', 'k', 'kas', '4-1'),
('4-10004', 'Pendapatan atas pembayaran tunggakan', 'k', 'kas', '4-1'),
('4-20001', 'Pendapatan atas pembayaran pemasangan SR', 'k', 'kas', '4-2'),
('4-20002', 'Pendapatan Bunga Deposito dan Jasa Giro', 'k', 'bank', '4-2'),
('4-20003', 'Pendapatan Hasil Sewa', 'k', 'kas', '4-2'),
('4-20004', 'Pendapatan Usaha Lainnya', 'k', 'kas', '4-2'),
('4-30001', 'Bantuan Pemerintah Desa / Daerah', 'k', 'kas', '4-3'),
('4-30002', 'Bantuan Masyarakat Langsung', 'k', 'kas', '4-3'),
('4-30003', 'Bantuan Dari Pihak Swasta', 'k', 'kas', '4-3'),
('5-10001', 'Beban Pembangkit Pompa', 'd', 'kas', '5-1'),
('5-10002', 'Beban Honor Petugas', 'd', 'kas', '5-1'),
('5-10003', 'Beban Administrasi dan Umum', 'd', 'kas', '5-1'),
('5-10004', 'Beban peningkatan pengawasan kualitas air', 'd', 'kas', '5-1'),
('5-10005', 'Beban Pemeliharaan Sumber Air', 'd', 'kas', '5-1'),
('5-10006', 'Beban Pemeliharaan Instalasi Pompa', 'd', 'kas', '5-1'),
('5-10007', 'Beban Pemeliharaan Reservoir', 'd', 'kas', '5-1'),
('5-10008', 'Beban Pemeliharaan Bangunan Penangkap Air', 'd', 'kas', '5-1'),
('5-10009', 'Beban Pemliharaan Meter Air', 'd', 'kas', '5-1'),
('5-10010', 'Beban Pemeliharaan Lainnya', 'd', 'kas', '5-1'),
('5-20001', 'Beban Pemasangan SR Baru', 'd', 'kas', '5-2'),
('5-20002', 'Beban Pengembalian Pokok Pinjaman', 'd', 'kas', '5-2'),
('5-20003', 'Beban Pajak atas Bunga Bank', 'd', 'bank', '5-2'),
('5-20004', 'Beban Administrasi Bank', 'd', 'bank', '5-2'),
('5-20005', 'Beban Depresiasi/penyusutan Aset', 'd', 'kas', '5-2');

-- --------------------------------------------------------

--
-- Table structure for table `coa_head`
--

CREATE TABLE `coa_head` (
  `head_code` varchar(20) NOT NULL,
  `head_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa_head`
--

INSERT INTO `coa_head` (`head_code`, `head_name`) VALUES
('1', 'Aktiva'),
('2', 'Pasiva'),
('3', 'Modal'),
('4', 'Pendapatan'),
('5', 'Beban Usaha');

-- --------------------------------------------------------

--
-- Table structure for table `coa_subhead`
--

CREATE TABLE `coa_subhead` (
  `sub_code` varchar(20) NOT NULL,
  `sub_name` varchar(150) NOT NULL,
  `head_code` varchar(20) NOT NULL,
  `activity` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa_subhead`
--

INSERT INTO `coa_subhead` (`sub_code`, `sub_name`, `head_code`, `activity`) VALUES
('1-1', 'Aktiva Lancar', '1', NULL),
('1-2', 'Aktiva Tetap', '1', NULL),
('1-3', 'Aktiva Tidak Berwujud', '1', NULL),
('2-1', 'Kewajiban Jangka Pendek', '2', NULL),
('2-2', 'Kewajiban Jangka Panjang', '2', NULL),
('3-1', 'Modal', '3', NULL),
('4-1', 'Pendapatan Air', '4', 'penerimaan'),
('4-2', 'Pendapatan Non Air', '4', 'penerimaan'),
('4-3', 'Pendapatan Kerja Sama', '4', 'penerimaan'),
('5-1', 'Beban Operasional dan Pemeliharaan', '5', 'pengeluaran'),
('5-2', 'Beban Non Operasional', '5', 'pengeluaran');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id_jurnal` bigint(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_transaksi` varchar(50) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `posisi` varchar(1) NOT NULL,
  `nominal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id_jurnal`, `tanggal`, `id_transaksi`, `account_no`, `posisi`, `nominal`) VALUES
(1, '2020-12-14 20:51:08', 'TRX-PNA-000000001', '1-10001', 'd', 50000),
(2, '2020-12-14 20:51:08', 'TRX-PNA-000000001', '4-20001', 'k', 50000),
(3, '2020-12-14 20:59:18', 'TRX-PNA-000000002', '1-10001', 'd', 200000),
(4, '2020-12-14 20:59:18', 'TRX-PNA-000000002', '4-20001', 'k', 200000),
(5, '2020-12-14 21:01:53', 'TRX-PNA-000000003', '1-10001', 'd', 50000),
(6, '2020-12-14 21:01:53', 'TRX-PNA-000000003', '4-20001', 'k', 50000),
(7, '2020-12-14 21:10:39', 'TRX-PNA-000000004', '1-10001', 'd', 50000),
(8, '2020-12-14 21:10:39', 'TRX-PNA-000000004', '4-20001', 'k', 50000),
(11, '2020-12-14 21:36:54', 'TRX-PNA-000000005', '1-10001', 'd', 50000),
(12, '2020-12-14 21:36:54', 'TRX-PNA-000000005', '4-20001', 'k', 50000),
(13, '2020-12-14 21:39:55', 'TRX-PNA-000000006', '1-10001', 'd', 50000),
(14, '2020-12-14 21:39:55', 'TRX-PNA-000000006', '4-20001', 'k', 50000),
(15, '2020-12-14 21:41:41', 'TRX-PNA-000000007', '1-10001', 'd', 200000),
(16, '2020-12-14 21:41:41', 'TRX-PNA-000000007', '4-20001', 'k', 200000),
(17, '2020-12-14 21:42:44', 'TRX-PNA-000000008', '1-10001', 'd', 50000),
(18, '2020-12-14 21:42:44', 'TRX-PNA-000000008', '4-20001', 'k', 50000),
(19, '2020-12-14 22:52:03', 'TRX-PNA-000000009', '1-10001', 'd', 100000),
(20, '2020-12-14 22:52:03', 'TRX-PNA-000000009', '4-20001', 'k', 100000),
(21, '2020-12-16 19:37:49', 'TRX-PNA-000000010', '1-10001', 'd', 50000),
(22, '2020-12-16 19:37:49', 'TRX-PNA-000000010', '4-20001', 'k', 50000),
(23, '2020-12-18 01:52:23', 'TRX-TGH-000000001', '1-10001', 'd', 1037000),
(24, '2020-12-18 01:52:23', 'TRX-TGH-000000001', '4-10001', 'k', 147000),
(25, '2020-12-18 01:52:23', 'TRX-TGH-000000001', '4-10002', 'k', 823000),
(26, '2020-12-18 01:52:23', 'TRX-TGH-000000001', '4-10004', 'k', 67000),
(27, '2020-11-30 17:00:00', 'TRX-PNY-000000001', '1-10001', 'd', 30000000),
(28, '2020-11-30 17:00:00', 'TRX-PNY-000000001', '3-10002', 'k', 30000000),
(29, '2020-12-03 17:00:00', 'TRX-PK-000000001', '1-10001', 'd', 2000000),
(30, '2020-12-03 17:00:00', 'TRX-PK-000000001', '4-30002', 'k', 2000000),
(31, '2020-12-01 17:00:00', 'TRX-BOP-000000001', '5-10001', 'd', 1000000),
(32, '2020-12-01 17:00:00', 'TRX-BOP-000000001', '1-10001', 'k', 1000000),
(37, '2020-12-05 17:00:00', 'TRX-BNO-000000001', '1-10003', 'd', 15000000),
(38, '2020-12-05 17:00:00', 'TRX-BNO-000000001', '1-10001', 'k', 15000000),
(41, '2020-12-14 17:00:00', 'TRX-BNO-000000002', '1-10003', 'd', 5000000),
(42, '2020-12-14 17:00:00', 'TRX-BNO-000000002', '1-10001', 'k', 5000000),
(43, '2020-12-14 17:00:00', 'TRX-BKK-000000001', '5-20004', 'd', 25000),
(44, '2020-12-14 17:00:00', 'TRX-BKK-000000001', '1-10003', 'k', 25000),
(45, '2020-12-19 17:00:00', 'TRX-BOP-000000002', '5-10002', 'd', 1000000),
(46, '2020-12-19 17:00:00', 'TRX-BOP-000000002', '1-10001', 'k', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `menu_head`
--

CREATE TABLE `menu_head` (
  `head_id` bigint(20) NOT NULL,
  `head_name` varchar(100) NOT NULL,
  `head_icon` varchar(100) NOT NULL,
  `head_uri` varchar(100) DEFAULT NULL,
  `head_level` int(1) NOT NULL,
  `head_urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_head`
--

INSERT INTO `menu_head` (`head_id`, `head_name`, `head_icon`, `head_uri`, `head_level`, `head_urut`) VALUES
(1, 'Dashboard', 'mdi mdi-view-dashboard', 'dashboard', 0, 1),
(2, 'Data Master', 'mdi mdi-database', NULL, 1, 2),
(3, 'Penagihan', 'mdi mdi-apple-safari', NULL, 1, 3),
(4, 'Manajemen Aset', 'mdi mdi-truck', NULL, 1, 4),
(5, 'Buku Pembantu', 'mdi mdi-book', NULL, 1, 6),
(6, 'Akuntansi', 'mdi mdi-desktop-mac', NULL, 1, 7),
(7, 'Pengaturan App', 'mdi mdi-cog', NULL, 1, 8),
(8, 'Keuangan', 'mdi mdi-cash-multiple', NULL, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu_management`
--

CREATE TABLE `menu_management` (
  `mm_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `sub_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_management`
--

INSERT INTO `menu_management` (`mm_id`, `role_id`, `sub_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(26, 1, 25),
(27, 1, 26),
(28, 1, 27),
(29, 1, 28),
(30, 1, 29),
(31, 1, 30),
(32, 1, 31),
(33, 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub`
--

CREATE TABLE `menu_sub` (
  `sub_id` bigint(20) NOT NULL,
  `sub_name` varchar(150) NOT NULL,
  `sub_uri` varchar(150) NOT NULL,
  `head_id` bigint(20) NOT NULL,
  `sub_urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_sub`
--

INSERT INTO `menu_sub` (`sub_id`, `sub_name`, `sub_uri`, `head_id`, `sub_urut`) VALUES
(1, 'Pelanggan', 'master/pelanggan', 2, 1),
(2, 'Pengurus', 'master/pengurus', 2, 2),
(3, 'Wilayah', 'master/wilayah', 2, 3),
(4, 'Aset', 'master/aset', 2, 4),
(5, 'Sumber Pemasukan', 'master/sumber_pemasukan', 2, 5),
(6, 'Sumber Pengeluaran', 'master/sumber_pengeluaran', 2, 6),
(7, 'Golongan Tarif', 'master/golongan', 2, 7),
(8, 'Chart of Account (CoA)', 'master/coa', 2, 8),
(9, 'Periode Penagihan', 'transaksi/periode_tagihan', 3, 1),
(10, 'Pencatatan Meteran', 'transaksi/pencatatan_tagihan', 3, 2),
(11, 'Perolehan Aset', 'transaksi/perolehan_aset', 4, 1),
(12, 'Penyusutan Aset', 'transaksi/penyusutan_aset', 4, 2),
(13, 'Pemeliharaan Aset', 'transaksi/pemeliharaan_aset', 4, 3),
(14, 'Penghapusan Aset', 'transaksi/penghapusan_aset', 4, 4),
(15, 'Buku Aset', 'transaksi/buku_aset', 4, 5),
(16, 'Buku Iuran', 'laporan/buku_iuran', 5, 1),
(17, 'Buku Penerimaan', 'laporan/penerimaan', 5, 2),
(18, 'Buku Pengeluaran', 'laporan/pengeluaran', 5, 3),
(19, 'Buku Bank', 'laporan/bank', 5, 4),
(20, 'Buku Kas Harian', 'laporan/kas', 5, 5),
(21, 'Jurnal Umum', 'akuntansi/jurnal_umum', 6, 1),
(22, 'Buku Besar', 'akuntansi/buku_besar', 6, 2),
(23, 'Trial Balance', 'akuntansi/trial_balance', 6, 3),
(24, 'Laba Rugi', 'akuntansi/laba_rugi', 6, 4),
(25, 'Arus Kas', 'akuntansi/arus_kas', 6, 5),
(26, 'Neraca', 'akuntansi/neraca', 6, 6),
(27, 'Pengguna', 'setting/pengguna', 7, 1),
(28, 'KP-SPAMS', 'setting/company_profile', 7, 2),
(29, 'Tagihan', 'setting/tagihan', 7, 3),
(30, 'Saldo Awal', 'setting/saldo_awal', 7, 4),
(31, 'Penerimaan', 'keuangan/kas_masuk', 8, 1),
(32, 'Pengeluaran', 'keuangan/kas_keluar', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_golongan`
--

CREATE TABLE `m_golongan` (
  `id_golongan` varchar(20) NOT NULL,
  `nama_golongan` varchar(150) NOT NULL,
  `biaya_admin` double NOT NULL,
  `biaya_beban` double NOT NULL,
  `interval_atas` int(11) NOT NULL,
  `max_tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_golongan`
--

INSERT INTO `m_golongan` (`id_golongan`, `nama_golongan`, `biaya_admin`, `biaya_beban`, `interval_atas`, `max_tarif`) VALUES
('MD-GOL-0001', 'Rumah Tangga', 3000, 10000, 50, 6000),
('MD-GOL-0002', 'Bisnis atau Industri', 5000, 10000, 70, 8000),
('MD-GOL-0003', 'Mesjid atau Rumah Ibadah', 1000, 10000, 50, 4000),
('MD-GOL-0004', 'Sekolah, TPA, atau TK', 3000, 10000, 50, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `m_golongan_detail`
--

CREATE TABLE `m_golongan_detail` (
  `id_golongan_detail` bigint(20) NOT NULL,
  `id_golongan` varchar(20) NOT NULL,
  `min_pemakaian` int(11) NOT NULL,
  `max_pemakaian` int(11) NOT NULL,
  `tarif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_golongan_detail`
--

INSERT INTO `m_golongan_detail` (`id_golongan_detail`, `id_golongan`, `min_pemakaian`, `max_pemakaian`, `tarif`) VALUES
(7, 'MD-GOL-0001', 1, 10, 3000),
(8, 'MD-GOL-0001', 11, 20, 3500),
(9, 'MD-GOL-0001', 21, 30, 4000),
(10, 'MD-GOL-0001', 31, 40, 4500),
(11, 'MD-GOL-0001', 41, 50, 5000),
(12, 'MD-GOL-0002', 1, 10, 4000),
(13, 'MD-GOL-0002', 11, 20, 4500),
(14, 'MD-GOL-0002', 21, 30, 5000),
(15, 'MD-GOL-0002', 31, 40, 5500),
(16, 'MD-GOL-0002', 41, 50, 6000),
(17, 'MD-GOL-0002', 51, 60, 6500),
(18, 'MD-GOL-0002', 61, 70, 7000),
(19, 'MD-GOL-0003', 1, 10, 0),
(20, 'MD-GOL-0003', 11, 20, 0),
(21, 'MD-GOL-0003', 21, 30, 2000),
(22, 'MD-GOL-0003', 31, 40, 2500),
(23, 'MD-GOL-0003', 41, 50, 3000),
(24, 'MD-GOL-0004', 1, 10, 0),
(25, 'MD-GOL-0004', 11, 20, 2500),
(26, 'MD-GOL-0004', 21, 30, 3000),
(27, 'MD-GOL-0004', 31, 40, 3500),
(28, 'MD-GOL-0004', 41, 50, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `id_jabatan` bigint(20) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Pembina'),
(2, 'Pengawas'),
(3, 'Ketua'),
(4, 'Sekretaris'),
(5, 'Bendahara'),
(6, 'Bagian Teknik Air Minum'),
(7, 'Bagian Sanitasi/Kesehatan'),
(8, 'Petugas Pencatat');

-- --------------------------------------------------------

--
-- Table structure for table `m_pelanggan`
--

CREATE TABLE `m_pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `meteran_awal` int(11) DEFAULT NULL,
  `tunggakan` double NOT NULL DEFAULT '0',
  `denda` double NOT NULL DEFAULT '0',
  `id_golongan` varchar(20) NOT NULL,
  `id_wilayah` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_pelanggan`
--

INSERT INTO `m_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`, `meteran_awal`, `tunggakan`, `denda`, `id_golongan`, `id_wilayah`) VALUES
('MD-PL-000000001', 'Ibrahim Adjie', 'Akhtara Residence Blok A1', '08923838356', 25, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000002', 'Soekarno Hatta', 'Akhtara Residence Blok A2', '085123456789', 100, 0, 0, 'MD-GOL-0002', 'MD-WLY-0001'),
('MD-PL-000000003', 'Muh Toha', 'Akhtara Residence Blok A3', '085741258852', 22, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000004', 'Pangeran Dipenogoro', 'Akhtara Residence Blok A4', '087546789987', 15, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000005', 'Sultan Hasanuddin', 'Akhtara Residence Blok A5', '082654789987', 10, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000006', 'Dato Tiro', 'Akhtara Residence Blok A6', '089789987456', 15, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000007', 'Usaha Keripik Malang', 'Akhtara Residence Blok A7', '089789654789', 127, 0, 0, 'MD-GOL-0002', 'MD-WLY-0001'),
('MD-PL-000000008', 'Mesji Nurul Husada', 'Akhtara Residence', '081147741147', 20, 0, 0, 'MD-GOL-0003', 'MD-WLY-0002'),
('MD-PL-000000009', 'R.E. Martadinata', 'Akhtara Resdidence Blok A8', '087854145753', 5, 0, 0, 'MD-GOL-0001', 'MD-WLY-0001'),
('MD-PL-000000010', 'Ir.H. Juanda', 'Akhtara Residence Blok A9', '021456789', 30, 0, 0, 'MD-GOL-0002', 'MD-WLY-0001'),
('MD-PL-000000011', 'Lukman Muslim', 'Akhtara Residence Blok B1', '085254456789', 25, 0, 0, 'MD-GOL-0001', 'MD-WLY-0002');

-- --------------------------------------------------------

--
-- Table structure for table `m_pengurus`
--

CREATE TABLE `m_pengurus` (
  `id_pengurus` varchar(20) NOT NULL,
  `nama_pengurus` varchar(150) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `id_jabatan` bigint(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `foto` varchar(256) NOT NULL DEFAULT 'default_foto.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_pengurus`
--

INSERT INTO `m_pengurus` (`id_pengurus`, `nama_pengurus`, `no_hp`, `alamat`, `id_jabatan`, `status`, `foto`) VALUES
('MD-PG-000000001', 'Asrul Cahyadi Putra', '081280055856', 'Indah Village Permai Batu, Kota Batu', 1, 1, 'default_foto.png'),
('MD-PG-000000002', 'Muhammad Amrijal Indzaky', '085456789987', 'Akhtara Residence Kota Malang', 2, 1, 'default_foto.png'),
('MD-PG-000000003', 'Akhmad Alfaris Eljoel', '085456654789', 'Akhtara Residence Kota Malang', 3, 1, 'default_foto.png'),
('MD-PG-000000004', 'Neng Wulan Kasmitasari', '082456123321', 'Akhtara Residence Kota Malang', 4, 1, 'default_foto.png'),
('MD-PG-000000005', 'Neng Lilis Sulistiawati', '085756789987', 'Akhtara Residence Kota Malang', 5, 1, 'default_foto.png'),
('MD-PG-000000006', 'Ujang Maman Suherman', '085741147753', 'Bukit Baruga Permai Kota Malang', 6, 1, 'default_foto.png'),
('MD-PG-000000007', 'Ridwan Kamil', '085123456123', 'Bukit Baruga, Kota Malang', 7, 1, 'default_foto.png'),
('MD-PG-000000008', 'Anis Baswedan', '082123789987', 'Akhtara Residence, Kota Malang', 8, 1, 'default_foto.png'),
('MD-PG-000000009', 'Sandiaga Uno', '081250123321', 'Akhtara Residence, Kota Malang', 8, 1, 'default_foto.png');

-- --------------------------------------------------------

--
-- Table structure for table `m_sumber_pemasukan`
--

CREATE TABLE `m_sumber_pemasukan` (
  `id_sumber_pemasukan` varchar(20) NOT NULL,
  `nama_sumber_pemasukan` varchar(100) NOT NULL,
  `id_ref` bigint(20) NOT NULL,
  `manual_entry` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_sumber_pemasukan`
--

INSERT INTO `m_sumber_pemasukan` (`id_sumber_pemasukan`, `nama_sumber_pemasukan`, `id_ref`, `manual_entry`) VALUES
('MD-SPM-0001', 'Pendapatan Iuran Wajib', 1, 0),
('MD-SPM-0002', 'Pendapatan atas Pemakaian Air', 2, 0),
('MD-SPM-0003', 'Pendapatan denda keterlambatan pembayaran', 3, 0),
('MD-SPM-0004', 'Pembayaran Tunggakan Pembayaran Pemakaian Air', 4, 0),
('MD-SPM-0005', 'Pendapatan atas pembayaran pemasangan SR', 5, 0),
('MD-SPM-0006', 'Penyesuaian Saldo Kas atas penggunaan pertama kali E-SPAMS', 6, 1),
('MD-SPM-0007', 'Bantuan Langsung dari Masyarakat/Anggota KP-SPAMS', 7, 1),
('MD-SPM-0008', 'Bantuan/Dana Hibah pemerintah Desa/Daerah', 8, 1),
('MD-SPM-0009', 'Penerimaan Bantuan dari Pihak Swasta', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_sumber_pengeluaran`
--

CREATE TABLE `m_sumber_pengeluaran` (
  `id_sumber_pengeluaran` varchar(20) NOT NULL,
  `nama_sumber_pengeluaran` varchar(100) NOT NULL,
  `id_ref` bigint(20) NOT NULL,
  `manual_entry` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_sumber_pengeluaran`
--

INSERT INTO `m_sumber_pengeluaran` (`id_sumber_pengeluaran`, `nama_sumber_pengeluaran`, `id_ref`, `manual_entry`) VALUES
('MD-SPK-0001', 'Biaya Pembangkit Pompa', 1, 1),
('MD-SPK-0002', 'Honor Ketua', 2, 1),
('MD-SPK-0003', 'Honor Sekretaris', 2, 1),
('MD-SPK-0004', 'Honor Bendahara', 2, 1),
('MD-SPK-0005', 'Honor Unit Teknis', 2, 1),
('MD-SPK-0006', 'Honor Petugas Pencatatan dan Penagihan ', 2, 1),
('MD-SPK-0007', 'Penyetoran Tunai ke Bank Mandiri', 13, 1),
('MD-SPK-0008', 'Potongan Biaya Administrasi Bank Mandiri', 14, 1),
('MD-SPK-0009', 'Potongan Biaya Administrasi Bank BRI', 15, 1),
('MD-SPK-0010', 'Potongan Biaya Administrasi Bank BNI', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_wilayah`
--

CREATE TABLE `m_wilayah` (
  `id_wilayah` varchar(20) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_wilayah`
--

INSERT INTO `m_wilayah` (`id_wilayah`, `nama_wilayah`) VALUES
('MD-WLY-0001', 'Blok A'),
('MD-WLY-0002', 'Blok B');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pemasukan`
--

CREATE TABLE `ref_pemasukan` (
  `id_ref` bigint(20) NOT NULL,
  `nama_ref` varchar(100) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `debet` varchar(20) NOT NULL,
  `kredit` varchar(20) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `manual_entry` int(1) NOT NULL DEFAULT '0',
  `record` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_pemasukan`
--

INSERT INTO `ref_pemasukan` (`id_ref`, `nama_ref`, `kode_transaksi`, `debet`, `kredit`, `tipe`, `manual_entry`, `record`) VALUES
(1, 'Pendapatan Abunemen', 'TRX-PA-', '1-10001', '4-10001', 'pa', 0, 'gl'),
(2, 'Pendaptan Pemakaian Air', 'TRX-PA-', '1-10001', '4-10002', 'pa', 0, 'gl'),
(3, 'Pendapatan denda keterlambatan', 'TRX-PA-', '1-10001', '4-10003', 'pa', 0, 'gl'),
(4, 'Pendapatan atas pembayaran tunggakan', 'TRX-PA-', '1-10001', '4-10004', 'pa', 0, 'gl'),
(5, 'Pendapatan atas pembayaran pemasangan SR', 'TRX-PNA-', '1-10001', '4-20001', 'pna', 1, 'gl'),
(6, 'Penyesuaian Modal Awal', 'TRX-PNY-', '1-10001', '3-10002', 'penyesuaian', 1, 'gl'),
(7, 'Bantuan Masyarakat Langsung', 'TRX-PK-', '1-10001', '4-30002', 'pk', 1, 'gl'),
(8, 'Bantuan Pemerintah Desa / Daerah', 'TRX-PK-', '1-10001', '4-30001', 'pk', 1, 'gl'),
(9, 'Bantuan Pihak Swasta', 'TRX-PK-', '1-10001', '4-30003', 'pk', 1, 'gl');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pengeluaran`
--

CREATE TABLE `ref_pengeluaran` (
  `id_ref` bigint(20) NOT NULL,
  `nama_ref` varchar(100) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `debet` varchar(20) NOT NULL,
  `kredit` varchar(20) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `manual_entry` int(1) NOT NULL DEFAULT '1',
  `record` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_pengeluaran`
--

INSERT INTO `ref_pengeluaran` (`id_ref`, `nama_ref`, `kode_transaksi`, `debet`, `kredit`, `tipe`, `manual_entry`, `record`) VALUES
(1, 'Biaya Pembangkit Pompa', 'TRX-BOP-', '5-10001', '1-10001', 'bop', 1, 'gl'),
(2, 'Honor Petugas', 'TRX-BOP-', '5-10002', '1-10001', 'bop', 1, 'gl'),
(3, 'Biaya Administrasi dan Umum', 'TRX-BOP-', '5-10003', '1-10001', 'bop', 1, 'gl'),
(4, 'Biaya Peningkatan Pengawasan Kualitas Air', 'TRX-BOP-', '5-10004', '1-10001', 'bop', 1, 'gl'),
(5, 'Biaya Pemeliharaan Sumber Air', 'TRX-BOP-', '5-10005', '1-10001', 'bop', 1, 'gl'),
(6, 'Biaya pemeliharaan instalasi Pompa', 'TRX-BOP-', '5-10006', '1-10001', 'bop', 1, 'gl'),
(7, 'Biaya Reservoir', 'TRX-BOP-', '5-10007', '1-10001', 'bop', 1, 'gl'),
(8, 'Biaya Pemeliharran bangunan penangkap air', 'TRX-BOP-', '5-10008', '1-10001', 'bop', 1, 'gl'),
(9, 'Biaya Pemeliharaan meter air', 'TRX-BOP-', '5-10009', '1-10001', 'bop', 1, 'gl'),
(10, 'Rupa-rupa pemeliharaan', 'TRX-BOP-', '5-10010', '1-10001', 'bop', 1, 'gl'),
(11, 'Biaya Pemasangan SR baru', 'TRX-BNO-', '5-20001', '1-10001', 'bno', 1, 'gl'),
(12, 'Biaya Pengembalian Pokok Pinjaman', 'TRX-BNO-', '5-20002', '1-10001', 'bno', 1, 'gl'),
(13, 'Setor Bank Mandiri', 'TRX-BNO-', '1-10003', '1-10001', 'bno', 1, 'gk'),
(14, 'Biaya Adm Bank Mandiri', 'TRX-BKK-', '5-20004', '1-10003', 'bank_out', 1, 'rk'),
(15, 'Biaya Adm Bank BRI', 'TRX-BKK-', '5-20004', '1-10004', 'bank_out', 1, 'rk'),
(16, 'Biaya Adm Bank BNI', 'TRX-BKK-', '5-20004', '1-10005', 'bank_out', 1, 'rk');

-- --------------------------------------------------------

--
-- Table structure for table `rekening_koran`
--

CREATE TABLE `rekening_koran` (
  `id_rekening_koran` bigint(20) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `debet` double DEFAULT NULL,
  `kredit` double DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekening_koran`
--

INSERT INTO `rekening_koran` (`id_rekening_koran`, `id_transaksi`, `account_no`, `tanggal`, `debet`, `kredit`, `note`) VALUES
(1, 'TRX-BNO-000000001', '1-10003', '2020-12-15 17:00:00', NULL, 15000000, 'Penyetoran Tunai Ke Bank Mandiri'),
(3, 'TRX-BNO-000000002', '1-10003', '2020-12-14 17:00:00', NULL, 5000000, 'Setor Tunai Ke Bank Mandiri'),
(4, 'TRX-BKK-000000001', '5-20004', '2020-12-14 17:00:00', 25000, NULL, 'Potongan Biaya Administrasi Rekening Bank Mandiri ');

-- --------------------------------------------------------

--
-- Table structure for table `role_group`
--

CREATE TABLE `role_group` (
  `role_id` bigint(20) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_group`
--

INSERT INTO `role_group` (`role_id`, `role_name`, `role_desc`) VALUES
(1, 'Super Admin', 'Pengguna Dapat Mengakses Semua Menu'),
(2, 'Admin', 'Pengguna Dapat Mengakses Semua Menu Kecuali menu Keuangan dan Akuntansi'),
(3, 'Sekretaris', 'Pengguna dapat mengakses beberapa menu master data dan dapat mengakses menu manajamen aset dan pengaturan KP-SPAMS'),
(4, 'Akuntan / Bendahara', 'Pengguna dapat mengakses beberapa master data, menu penagihan, keuangan, akuntansi, buku pembantu dan pengaturan tagihan'),
(5, 'Pembaca Laporan', 'Pengguna dapat mengakses menu akuntansi dan menu buku pembantu'),
(6, 'Cater', 'Pengguna dapat mengakses menu pencatatan meteran');

-- --------------------------------------------------------

--
-- Table structure for table `setting_company`
--

CREATE TABLE `setting_company` (
  `company_id` varchar(20) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` text,
  `company_telp` varchar(13) DEFAULT NULL,
  `company_email` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `regency` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `company_logo` varchar(255) NOT NULL DEFAULT 'default_foto.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_company`
--

INSERT INTO `setting_company` (`company_id`, `company_name`, `company_address`, `company_telp`, `company_email`, `province`, `regency`, `district`, `village`, `company_logo`) VALUES
('SPAMS01', 'KP-SPAMS JAYA SELALU', 'Akhtara Residence Jl Bulutangkis Lowokwaru', '081280055856', 'jayaselalu@espams.com', 'Jawa Timur', 'Kota Malang', 'Lowokwaru', 'Lowokwaru', 'default_foto.png');

-- --------------------------------------------------------

--
-- Table structure for table `setting_tagihan`
--

CREATE TABLE `setting_tagihan` (
  `id_setting` int(11) NOT NULL,
  `denda_flat` double NOT NULL,
  `status_denda_flat` int(1) NOT NULL DEFAULT '0',
  `tarif_tunggal` double NOT NULL,
  `jenis_tarif` int(1) NOT NULL DEFAULT '1',
  `batas_pembayaran` int(2) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_tagihan`
--

INSERT INTO `setting_tagihan` (`id_setting`, `denda_flat`, `status_denda_flat`, `tarif_tunggal`, `jenis_tarif`, `batas_pembayaran`, `catatan`) VALUES
(1, 10000, 1, 4000, 1, 20, 'Harap Lakukan pembayaran sebelum batas pembayaran. Jika melakukan pembayaran melewati batas pembayaran maka akan dikenakan denda keterlambatan pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(20) DEFAULT NULL,
  `id_sumber_pemasukan` varchar(20) DEFAULT NULL,
  `id_sumber_pengeluaran` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `jenis_tarif` int(1) DEFAULT NULL,
  `tarif_tunggal` double DEFAULT NULL,
  `batas_pembayaran` date DEFAULT NULL,
  `status_denda` int(1) DEFAULT NULL,
  `denda_flat` double DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `pemakaian` double DEFAULT NULL,
  `iuran_wajib` double DEFAULT NULL,
  `denda` double DEFAULT NULL,
  `tunggakan` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `tipe` varchar(100) NOT NULL,
  `trans_type` varchar(100) DEFAULT NULL,
  `catatan` text,
  `inv_note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_sumber_pemasukan`, `id_sumber_pengeluaran`, `tanggal`, `bulan`, `tahun`, `jenis_tarif`, `tarif_tunggal`, `batas_pembayaran`, `status_denda`, `denda_flat`, `total`, `pemakaian`, `iuran_wajib`, `denda`, `tunggakan`, `status`, `tipe`, `trans_type`, `catatan`, `inv_note`) VALUES
('TRX-BKK-000000001', NULL, NULL, 'MD-SPK-0008', '2020-12-14 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, NULL, NULL, NULL, NULL, 0, 'bank_out', 'bank_out', 'Potongan Biaya Administrasi Rekening Bank Mandiri ', NULL),
('TRX-BNO-000000001', NULL, NULL, 'MD-SPK-0007', '2020-12-05 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15000000, NULL, NULL, NULL, NULL, 0, 'bno', 'cash_out', 'Penyetoran Tunai Ke Bank Mandiri', NULL),
('TRX-BNO-000000002', NULL, NULL, 'MD-SPK-0007', '2020-12-14 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000000, NULL, NULL, NULL, NULL, 0, 'bno', 'cash_out', 'Setor Tunai Ke Bank Mandiri', NULL),
('TRX-BOP-000000001', NULL, NULL, 'MD-SPK-0001', '2020-12-01 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000000, NULL, NULL, NULL, NULL, 0, 'bop', 'cash_out', 'Beli Token Listrik untuk pembangkit pompa', NULL),
('TRX-BOP-000000002', NULL, NULL, 'MD-SPK-0002', '2020-12-19 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000000, NULL, NULL, NULL, NULL, 0, 'bop', 'cash_out', 'Penyerahan Honor Ketua', NULL),
('TRX-PK-000000001', NULL, 'MD-SPM-0007', NULL, '2020-12-03 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000000, NULL, NULL, NULL, NULL, 0, 'pk', 'cash_in', 'Bantuan dari Bapak Yusuf, S.H.', NULL),
('TRX-PNA-000000001', 'MD-PL-000000001', NULL, NULL, '2020-12-14 20:51:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000002', 'MD-PL-000000002', NULL, NULL, '2020-12-14 20:59:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000003', 'MD-PL-000000003', NULL, NULL, '2020-12-14 21:01:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000004', 'MD-PL-000000004', NULL, NULL, '2020-12-14 21:10:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000005', 'MD-PL-000000006', NULL, NULL, '2020-12-14 21:36:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000006', 'MD-PL-000000005', NULL, NULL, '2020-12-14 21:39:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000007', 'MD-PL-000000007', NULL, NULL, '2020-12-14 21:41:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000008', 'MD-PL-000000008', NULL, NULL, '2020-12-14 21:42:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000009', 'MD-PL-000000010', NULL, NULL, '2020-12-14 22:52:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, NULL, NULL, NULL, NULL, 1, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNA-000000010', 'MD-PL-000000011', NULL, NULL, '2020-12-16 19:37:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 0, 'pna', 'cash_in', 'Pendapatan Atas Pembayaran Biaya Pemsangan SR', NULL),
('TRX-PNY-000000001', NULL, 'MD-SPM-0006', NULL, '2020-11-30 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30000000, NULL, NULL, NULL, NULL, 0, 'penyesuaian', 'cash_in', 'Penyesuaian Saldo Awal Kas atas Penggunaan Pertama Kali Aplikasi', NULL),
('TRX-TGH-000000001', NULL, NULL, NULL, '2020-12-18 01:52:23', 12, 2020, 1, NULL, '2020-12-20', 1, 10000, 1037000, 823000, 147000, 0, 67000, 1, 'pa', 'tagihan', 'Pendapatan dari Tagihan Pelanggan/Anggota KPSPAMS Periode Bulan Desember 2020', 'Harap Lakukan pembayaran sebelum batas pembayaran. Jika melakukan pembayaran melewati batas pembayaran maka akan dikenakan denda keterlambatan pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `trx_pembayaran_tagihan`
--

CREATE TABLE `trx_pembayaran_tagihan` (
  `id_pembayaran` bigint(20) NOT NULL,
  `id_tagihan` bigint(20) NOT NULL,
  `tanggal_bayar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wajib` double NOT NULL,
  `pemakaian` double NOT NULL,
  `denda` double NOT NULL,
  `tunggakan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trx_pembayaran_tagihan`
--

INSERT INTO `trx_pembayaran_tagihan` (`id_pembayaran`, `id_tagihan`, `tanggal_bayar`, `wajib`, `pemakaian`, `denda`, `tunggakan`) VALUES
(22, 119, '2020-12-18 15:29:52', 13000, 15000, 0, 0),
(23, 120, '2020-12-18 15:29:52', 15000, 250000, 0, 0),
(24, 121, '2020-12-18 15:29:52', 13000, 3000, 0, 0),
(25, 122, '2020-12-18 15:29:52', 13000, 9000, 0, 37000),
(26, 123, '2020-12-18 15:29:52', 13000, 15000, 0, 15000),
(27, 124, '2020-12-18 15:29:52', 13000, 30000, 0, 15000),
(28, 125, '2020-12-18 15:29:52', 15000, 401000, 0, 0),
(29, 126, '2020-12-18 15:29:52', 11000, 0, 0, 0),
(30, 127, '2020-12-18 15:29:52', 13000, 0, 0, 0),
(31, 128, '2020-12-18 15:29:52', 15000, 85000, 0, 0),
(32, 129, '2020-12-18 15:29:52', 13000, 15000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trx_tagihan`
--

CREATE TABLE `trx_tagihan` (
  `id_tagihan` bigint(20) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `id_golongan` varchar(20) NOT NULL,
  `kode_tagihan` varchar(100) DEFAULT NULL,
  `meteran_awal` int(11) NOT NULL,
  `meteran_akhir` int(11) DEFAULT NULL,
  `biaya_admin` double NOT NULL,
  `biaya_beban` double NOT NULL,
  `pemakaian` double NOT NULL,
  `denda` double NOT NULL,
  `tunggakan` double NOT NULL,
  `total` double NOT NULL,
  `bayar` double NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trx_tagihan`
--

INSERT INTO `trx_tagihan` (`id_tagihan`, `id_transaksi`, `id_pelanggan`, `id_golongan`, `kode_tagihan`, `meteran_awal`, `meteran_akhir`, `biaya_admin`, `biaya_beban`, `pemakaian`, `denda`, `tunggakan`, `total`, `bayar`, `status`) VALUES
(119, 'TRX-TGH-000000001', 'MD-PL-000000001', 'MD-GOL-0001', '000001/PA/', 20, 25, 3000, 10000, 15000, 0, 0, 28000, 28000, 3),
(120, 'TRX-TGH-000000001', 'MD-PL-000000002', 'MD-GOL-0002', '000002/PA/', 50, 100, 5000, 10000, 250000, 0, 0, 265000, 265000, 3),
(121, 'TRX-TGH-000000001', 'MD-PL-000000003', 'MD-GOL-0001', '000003/PA/', 21, 22, 3000, 10000, 3000, 0, 0, 16000, 16000, 3),
(122, 'TRX-TGH-000000001', 'MD-PL-000000004', 'MD-GOL-0001', '000004/PA/', 12, 15, 3000, 10000, 9000, 0, 37000, 59000, 59000, 3),
(123, 'TRX-TGH-000000001', 'MD-PL-000000005', 'MD-GOL-0001', '000005/PA/', 5, 10, 3000, 10000, 15000, 0, 15000, 43000, 43000, 3),
(124, 'TRX-TGH-000000001', 'MD-PL-000000006', 'MD-GOL-0001', '000007/PA/', 5, 15, 3000, 10000, 30000, 0, 15000, 58000, 58000, 3),
(125, 'TRX-TGH-000000001', 'MD-PL-000000007', 'MD-GOL-0002', '000011/PA/', 55, 127, 5000, 10000, 401000, 0, 0, 416000, 416000, 3),
(126, 'TRX-TGH-000000001', 'MD-PL-000000008', 'MD-GOL-0003', '000010/PA/', 5, 20, 1000, 10000, 0, 0, 0, 11000, 11000, 3),
(127, 'TRX-TGH-000000001', 'MD-PL-000000009', 'MD-GOL-0001', '000009/PA/', 5, 5, 3000, 10000, 0, 0, 0, 13000, 13000, 3),
(128, 'TRX-TGH-000000001', 'MD-PL-000000010', 'MD-GOL-0002', '000008/PA/', 10, 30, 5000, 10000, 85000, 0, 0, 100000, 100000, 3),
(129, 'TRX-TGH-000000001', 'MD-PL-000000011', 'MD-GOL-0001', '000006/PA/', 20, 25, 3000, 10000, 15000, 0, 0, 28000, 28000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(20) NOT NULL,
  `id_pengurus` varchar(20) DEFAULT NULL,
  `id_pelanggan` varchar(50) DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `role_id` bigint(20) NOT NULL,
  `id_wilayah` varchar(20) DEFAULT NULL,
  `pass_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_pengurus`, `id_pelanggan`, `username`, `password`, `status`, `role_id`, `id_wilayah`, `pass_status`) VALUES
('STT-US-0001', 'MD-PG-000000001', NULL, 'admin', '$2y$10$x2TjJbEM3VMcIqRpIfsgFuZ8e8uiuHZJn5ZoPryUGjJ5e1EN7Ynpa', 1, 1, '', 0),
('STT-US-0002', 'MD-PG-000000008', NULL, 'cater1', '$2y$10$NBqYtupnBxxFcCjGpiS.9ej.PJCJPnWO4.gmHQQ2a6bErqQXGPz/S', 1, 6, 'MD-WLY-0001', 0),
('STT-US-0003', 'MD-PG-000000009', NULL, 'cater2', '$2y$10$njKFmnOExEd3vUYM33sJFudvZvuYbcci57xCA6p2UTZCyz7CygM6u', 1, 6, 'MD-WLY-0002', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`aset_code`),
  ADD KEY `subhead_code` (`subhead_code`),
  ADD KEY `account_no` (`account_no`);

--
-- Indexes for table `aset_head`
--
ALTER TABLE `aset_head`
  ADD PRIMARY KEY (`head_code`);

--
-- Indexes for table `aset_subhead`
--
ALTER TABLE `aset_subhead`
  ADD PRIMARY KEY (`subhead_code`),
  ADD KEY `head_code` (`head_code`);

--
-- Indexes for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`account_no`),
  ADD KEY `sub_code` (`sub_code`);

--
-- Indexes for table `coa_head`
--
ALTER TABLE `coa_head`
  ADD PRIMARY KEY (`head_code`);

--
-- Indexes for table `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD PRIMARY KEY (`sub_code`),
  ADD KEY `head_code` (`head_code`);

--
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `account_no` (`account_no`),
  ADD KEY `jurnal_umum_ibfk_2` (`id_transaksi`);

--
-- Indexes for table `menu_head`
--
ALTER TABLE `menu_head`
  ADD PRIMARY KEY (`head_id`);

--
-- Indexes for table `menu_management`
--
ALTER TABLE `menu_management`
  ADD PRIMARY KEY (`mm_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `head_id` (`head_id`);

--
-- Indexes for table `m_golongan`
--
ALTER TABLE `m_golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `m_golongan_detail`
--
ALTER TABLE `m_golongan_detail`
  ADD PRIMARY KEY (`id_golongan_detail`),
  ADD KEY `id_golongan` (`id_golongan`);

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_golongan` (`id_golongan`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `m_pengurus`
--
ALTER TABLE `m_pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `m_sumber_pemasukan`
--
ALTER TABLE `m_sumber_pemasukan`
  ADD PRIMARY KEY (`id_sumber_pemasukan`),
  ADD KEY `id_ref` (`id_ref`);

--
-- Indexes for table `m_sumber_pengeluaran`
--
ALTER TABLE `m_sumber_pengeluaran`
  ADD PRIMARY KEY (`id_sumber_pengeluaran`),
  ADD KEY `id_ref` (`id_ref`);

--
-- Indexes for table `m_wilayah`
--
ALTER TABLE `m_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- Indexes for table `ref_pemasukan`
--
ALTER TABLE `ref_pemasukan`
  ADD PRIMARY KEY (`id_ref`),
  ADD KEY `debet` (`debet`),
  ADD KEY `kredit` (`kredit`);

--
-- Indexes for table `ref_pengeluaran`
--
ALTER TABLE `ref_pengeluaran`
  ADD PRIMARY KEY (`id_ref`),
  ADD KEY `debet` (`debet`),
  ADD KEY `kredit` (`kredit`);

--
-- Indexes for table `rekening_koran`
--
ALTER TABLE `rekening_koran`
  ADD PRIMARY KEY (`id_rekening_koran`),
  ADD KEY `rekening_koran_ibfk_1` (`id_transaksi`),
  ADD KEY `rekening_koran_ibfk_2` (`account_no`);

--
-- Indexes for table `role_group`
--
ALTER TABLE `role_group`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `setting_company`
--
ALTER TABLE `setting_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `setting_tagihan`
--
ALTER TABLE `setting_tagihan`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `trx_pembayaran_tagihan`
--
ALTER TABLE `trx_pembayaran_tagihan`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indexes for table `trx_tagihan`
--
ALTER TABLE `trx_tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD UNIQUE KEY `kode_tagihan` (`kode_tagihan`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_golongan` (`id_golongan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pengurus` (`id_pengurus`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id_jurnal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `menu_head`
--
ALTER TABLE `menu_head`
  MODIFY `head_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_management`
--
ALTER TABLE `menu_management`
  MODIFY `mm_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `sub_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `m_golongan_detail`
--
ALTER TABLE `m_golongan_detail`
  MODIFY `id_golongan_detail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ref_pemasukan`
--
ALTER TABLE `ref_pemasukan`
  MODIFY `id_ref` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ref_pengeluaran`
--
ALTER TABLE `ref_pengeluaran`
  MODIFY `id_ref` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rekening_koran`
--
ALTER TABLE `rekening_koran`
  MODIFY `id_rekening_koran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_group`
--
ALTER TABLE `role_group`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting_tagihan`
--
ALTER TABLE `setting_tagihan`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trx_pembayaran_tagihan`
--
ALTER TABLE `trx_pembayaran_tagihan`
  MODIFY `id_pembayaran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `trx_tagihan`
--
ALTER TABLE `trx_tagihan`
  MODIFY `id_tagihan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`subhead_code`) REFERENCES `aset_subhead` (`subhead_code`),
  ADD CONSTRAINT `aset_ibfk_2` FOREIGN KEY (`account_no`) REFERENCES `chart_of_account` (`account_no`);

--
-- Constraints for table `aset_subhead`
--
ALTER TABLE `aset_subhead`
  ADD CONSTRAINT `aset_subhead_ibfk_1` FOREIGN KEY (`head_code`) REFERENCES `aset_head` (`head_code`);

--
-- Constraints for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD CONSTRAINT `chart_of_account_ibfk_1` FOREIGN KEY (`sub_code`) REFERENCES `coa_subhead` (`sub_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coa_subhead`
--
ALTER TABLE `coa_subhead`
  ADD CONSTRAINT `coa_subhead_ibfk_1` FOREIGN KEY (`head_code`) REFERENCES `coa_head` (`head_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`account_no`) REFERENCES `chart_of_account` (`account_no`),
  ADD CONSTRAINT `jurnal_umum_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_management`
--
ALTER TABLE `menu_management`
  ADD CONSTRAINT `menu_management_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role_group` (`role_id`),
  ADD CONSTRAINT `menu_management_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `menu_sub` (`sub_id`);

--
-- Constraints for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD CONSTRAINT `menu_sub_ibfk_1` FOREIGN KEY (`head_id`) REFERENCES `menu_head` (`head_id`);

--
-- Constraints for table `m_golongan_detail`
--
ALTER TABLE `m_golongan_detail`
  ADD CONSTRAINT `m_golongan_detail_ibfk_1` FOREIGN KEY (`id_golongan`) REFERENCES `m_golongan` (`id_golongan`);

--
-- Constraints for table `m_pelanggan`
--
ALTER TABLE `m_pelanggan`
  ADD CONSTRAINT `m_pelanggan_ibfk_1` FOREIGN KEY (`id_golongan`) REFERENCES `m_golongan` (`id_golongan`),
  ADD CONSTRAINT `m_pelanggan_ibfk_2` FOREIGN KEY (`id_wilayah`) REFERENCES `m_wilayah` (`id_wilayah`);

--
-- Constraints for table `m_pengurus`
--
ALTER TABLE `m_pengurus`
  ADD CONSTRAINT `m_pengurus_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `m_jabatan` (`id_jabatan`);

--
-- Constraints for table `m_sumber_pemasukan`
--
ALTER TABLE `m_sumber_pemasukan`
  ADD CONSTRAINT `m_sumber_pemasukan_ibfk_1` FOREIGN KEY (`id_ref`) REFERENCES `ref_pemasukan` (`id_ref`);

--
-- Constraints for table `m_sumber_pengeluaran`
--
ALTER TABLE `m_sumber_pengeluaran`
  ADD CONSTRAINT `m_sumber_pengeluaran_ibfk_1` FOREIGN KEY (`id_ref`) REFERENCES `ref_pengeluaran` (`id_ref`);

--
-- Constraints for table `ref_pemasukan`
--
ALTER TABLE `ref_pemasukan`
  ADD CONSTRAINT `ref_pemasukan_ibfk_1` FOREIGN KEY (`debet`) REFERENCES `chart_of_account` (`account_no`),
  ADD CONSTRAINT `ref_pemasukan_ibfk_2` FOREIGN KEY (`kredit`) REFERENCES `chart_of_account` (`account_no`);

--
-- Constraints for table `ref_pengeluaran`
--
ALTER TABLE `ref_pengeluaran`
  ADD CONSTRAINT `ref_pengeluaran_ibfk_1` FOREIGN KEY (`debet`) REFERENCES `chart_of_account` (`account_no`),
  ADD CONSTRAINT `ref_pengeluaran_ibfk_2` FOREIGN KEY (`kredit`) REFERENCES `chart_of_account` (`account_no`);

--
-- Constraints for table `rekening_koran`
--
ALTER TABLE `rekening_koran`
  ADD CONSTRAINT `rekening_koran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekening_koran_ibfk_2` FOREIGN KEY (`account_no`) REFERENCES `chart_of_account` (`account_no`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `m_pelanggan` (`id_pelanggan`);

--
-- Constraints for table `trx_pembayaran_tagihan`
--
ALTER TABLE `trx_pembayaran_tagihan`
  ADD CONSTRAINT `trx_pembayaran_tagihan_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `trx_tagihan` (`id_tagihan`) ON DELETE CASCADE;

--
-- Constraints for table `trx_tagihan`
--
ALTER TABLE `trx_tagihan`
  ADD CONSTRAINT `trx_tagihan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `trx_tagihan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `m_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `trx_tagihan_ibfk_3` FOREIGN KEY (`id_golongan`) REFERENCES `m_golongan` (`id_golongan`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_pengurus`) REFERENCES `m_pengurus` (`id_pengurus`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_group` (`role_id`);
