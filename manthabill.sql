-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 11:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manthabill`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('n3v0hrtii08fhdpj5qe82l75p8m60o49', '::1', 1549537389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393533373334363b63617074636861776f72647c733a353a22323251525a223b757365726e616d657c733a31303a22616c6578697374646576223b69645f757365727c733a313a2231223b746f6b656e7c733a34303a2232616336336133343962653732373832343633396235383465623530656239623237333832316564223b7374617475737c733a353a226c6f67696e223b),
('pau81ekr4fo4abe9q6gvkanqnr2kgm43', '::1', 1549537458, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393533373433323b63617074636861776f72647c733a353a2249465a3652223b757365726e616d657c733a31303a22616c6578697374646576223b69645f757365727c733a313a2231223b746f6b656e7c733a34303a2264663635636563386666653363663037383563323064356461653264353861336237623939613765223b7374617475737c733a353a226c6f67696e223b),
('ahd30lf471gomkian6h8rgc13bqfrc0k', '::1', 1549537627, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393533373632373b63617074636861776f72647c733a353a22355755424c223b);

-- --------------------------------------------------------

--
-- Table structure for table `inboxbalas`
--

CREATE TABLE `inboxbalas` (
  `id_balas` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL COMMENT '1 = admin,\r\n2 = user',
  `key_token` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inboxbalas`
--

INSERT INTO `inboxbalas` (`id_balas`, `is_admin`, `key_token`, `pesan`, `time`) VALUES
(3, 2, 'kJ0mWgPZt2Orh98IXcuY', 'Having faith in ourselves and in the goodness of the universe allows us to see life in an optimistic wa', 1610757183),
(4, 1, 'V7RvLDuSrDKnVyQNII38', 'okay ada apa ya? saya bisa bantu apa pak?', 1610963325),
(5, 1, 'V7RvLDuSrDKnVyQNII38', 'gimana ada yang akan saya bantu atau tidak????', 1610963400),
(6, 1, 'V7RvLDuSrDKnVyQNII38', 'Lorem Ipsum is simply dummy text of the printing and types', 1611033384),
(7, 1, 'V7RvLDuSrDKnVyQNII38', 'imply dummy text of the printing and types', 1611077717),
(8, 1, 'QB6PD2MFeDSR7CEusWKA', 'ini balasan admin untuk user samantha ini balasan admin untuk user samantha ini balasan admin untuk user samantha', 1611078669),
(9, 1, 'u6NAD2JMMIqTSbQjxCD8', 'gimana mas', 1611226973);

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id_admin`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '$2y$10$6orcjjjTQnEAH0D2/xtEgOlR6m4NalD8daQaCWS7KKPjSiO2HvKgC', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbberita`
--

CREATE TABLE `tbberita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tgl_berita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbberita`
--

INSERT INTO `tbberita` (`id_berita`, `judul_berita`, `isi_berita`, `tgl_berita`) VALUES
(1, 'Pembelian hosting', 'Selamat Datang Di Adrihost\r\nHosting Murah untuk kebutuhan website bisnis anda.\r\n\r\nJika anda membutuhkan bantuan bisa kontak di:\r\n0856-0201-3002\r\n\r\nAtau ingin membuat website silahkan kontak:0856-0201-3002\r\n\r\nHormat kami\r\nAdriHost', '2019-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbcategory_config`
--

CREATE TABLE `tbcategory_config` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcategory_config`
--

INSERT INTO `tbcategory_config` (`id_category`, `name`) VALUES
(1, 'Upgrade Ram'),
(2, 'Upgrade Core');

-- --------------------------------------------------------

--
-- Table structure for table `tbconfig_option`
--

CREATE TABLE `tbconfig_option` (
  `id_config` int(11) NOT NULL,
  `id_vps` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name_config` varchar(50) NOT NULL,
  `detail_config` varchar(30) NOT NULL,
  `harga_config` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbconfig_option`
--

INSERT INTO `tbconfig_option` (`id_config`, `id_vps`, `id_category`, `name_config`, `detail_config`, `harga_config`) VALUES
(1, 1, 1, 'Upgrade Ram', '+ 1 Gb', 50000),
(2, 1, 2, 'Upgrade Coree', '+1 Core', 50000),
(3, 1, 1, 'Upgrade Ram', '+ 2 Gb', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailuser`
--

CREATE TABLE `tbdetailuser` (
  `id_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_depan` varchar(20) DEFAULT NULL,
  `nama_belakang` varchar(30) DEFAULT NULL,
  `nama_usaha` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `alamat2` varchar(200) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `negara` varchar(30) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `time_req` int(11) DEFAULT NULL,
  `gambar` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdetailuser`
--

INSERT INTO `tbdetailuser` (`id_detail`, `id_user`, `nama_depan`, `nama_belakang`, `nama_usaha`, `alamat`, `alamat2`, `kota`, `provinsi`, `negara`, `kodepos`, `phone`, `time_req`, `gambar`) VALUES
(11, 37, 'Alexsander Hendra', 'Wijaya', 'Adrihost', 'Jl.Bendungan Wayngison No237', '', 'Sidodadi', 'Bandarlampung', 'Indonesia', '', '085602013002', NULL, 'default.jpg'),
(12, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(13, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbdomain`
--

CREATE TABLE `tbdomain` (
  `id_domain` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tld` int(11) NOT NULL,
  `nama_domain` varchar(50) NOT NULL,
  `nameserver1` varchar(30) NOT NULL,
  `nameserver2` varchar(30) NOT NULL,
  `nameserver3` varchar(30) NOT NULL,
  `nameserver4` varchar(30) NOT NULL,
  `nameserver5` varchar(30) NOT NULL,
  `date_register` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbdomaintransit`
--

CREATE TABLE `tbdomaintransit` (
  `id_domtrans` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tld` int(11) NOT NULL,
  `nama_domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdomaintransit`
--

INSERT INTO `tbdomaintransit` (`id_domtrans`, `id_user`, `id_tld`, `nama_domain`) VALUES
(1, 1, 1, 'danuwahyudi.com'),
(2, 1, 1, 'samantha323.com'),
(3, 1, 2, 'adrihost.net');

-- --------------------------------------------------------

--
-- Table structure for table `tbdomainwhois`
--

CREATE TABLE `tbdomainwhois` (
  `id_domainwhois` int(11) NOT NULL,
  `id_domain` int(11) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `nama_usaha` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat1` varchar(100) NOT NULL,
  `alamat2` varchar(100) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `negara` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdomainwhois`
--

INSERT INTO `tbdomainwhois` (`id_domainwhois`, `id_domain`, `nama_depan`, `nama_belakang`, `nama_usaha`, `no_telp`, `email`, `alamat1`, `alamat2`, `kota`, `provinsi`, `kodepos`, `negara`) VALUES
(2, 2, 'Alexsander', 'Hendra Wijaya', '', '085602013002', '0', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia'),
(3, 3, 'Alexsander', 'Hendra Wijaya', '', '085602013002', '0', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia'),
(4, 4, 'cepi', 'cahyana', '', '0552525', '0', 'adada', 'adada', 'adada', 'adada', 0, 'adada'),
(5, 5, 'cepi', 'cahyana', '', '085221288210', '0', 'subang', 'subang', 'subang', 'jawabarat', 55572, 'Indonesia'),
(6, 6, 'Alexsander', 'Hendra Wijaya', '', '085602013002', '0', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia'),
(7, 7, 'cepi', 'cahyana', '', '085221288210', '0', 'subang', 'subang', 'subang', 'jawabarat', 55572, 'Indonesia'),
(8, 8, 'cepi', 'cahyana', '', '123', '0', 'subang', 'subang', 'jawabarat', 'jawabarat', 55570, 'Indonesia'),
(9, 10, 'Alexsander', 'Hendra Wijaya', 'adrihost', '085602013002', 'alexistdev@gmail.com', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia'),
(10, 11, 'Alexsander', 'Hendra Wijaya', 'adrihost', '085602013002', 'alexistdev@gmail.com', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `tbemail`
--

CREATE TABLE `tbemail` (
  `id_email` int(11) NOT NULL,
  `email_pengirim` varchar(50) NOT NULL,
  `email_tujuan` varchar(50) NOT NULL,
  `subyek` varchar(100) NOT NULL,
  `email_pesan` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbemail`
--

INSERT INTO `tbemail` (`id_email`, `email_pengirim`, `email_tujuan`, `subyek`, `email_pesan`, `status`) VALUES
(3, 'support@adrihost.com', 'alexistdev@gmail.com', 'Layanan Hosting Personal Master adrihost.com telah dinonaktifkan!', '\n							Mohon maaf, layanan anda Personal Master adrihost.com telah dinonaktifkan<br>\n							Dikarenakan telah habis masa aktifnya atau telah melanggar ketentuan layanan kami<br><br>\n							Jika anda membutuhkan informasi lebih lanjut, silahkan hubungi costumer service kami.<br><br>\n							\n							Regards<br>\n							Admin\n						', 2),
(4, 'support@adrihost.com', 'alexistdev@gmail.com', 'Akun anda di AdriHosts telah disuspend', '\n							Yth . Wijaya<br><br>\n							Dengan sangat menyesal kami harus mensuspend akun anda, dikarenakan telah melanggar ketentuan layanan kami.<br>\n							Jika anda keberatan dengan kebijakan kami ini, silahkan menghubungi Customer Service kami.<br><br>\n							Regards<br>\n							Admin\n						', 2),
(5, 'support@adrihost.com', 'alexistdev@gmail.com', 'Akun anda di AdriHosts telah disuspend', '\n							Yth . Wijaya<br><br>\n							Dengan sangat menyesal kami harus mensuspend akun anda, dikarenakan telah melanggar ketentuan layanan kami.<br>\n							Jika anda keberatan dengan kebijakan kami ini, silahkan menghubungi Customer Service kami.<br><br>\n							Regards<br>\n							Admin\n						', 2),
(6, 'support@adrihost.com', 'alexistdev@gmail.com', 'Akun anda di AdriHosts telah disuspend', '\n							Yth . Wijaya<br><br>\n							Dengan sangat menyesal kami harus mensuspend akun anda, dikarenakan telah melanggar ketentuan layanan kami.<br>\n							Jika anda keberatan dengan kebijakan kami ini, silahkan menghubungi Customer Service kami.<br><br>\n							Regards<br>\n							Admin\n						', 2),
(7, 'support@adrihost.com', 'alexistdev@gmail.com', 'Layanan Hosting Personal Master adrihost.com telah diaktifkan!', '\n							Selamat layanan anda Personal Master adrihost.com telah berhasil diaktifkan<br>\n							Dan berikut detail informasi cpanel nya:<br><br>\n							Username: wakanda <br>\n							Password: 3256532 <br><br>\n							Anda bisa login di http://.adrihost.com/cpanel<br><br>\n\n							Jika anda membutuhkan bantuan kami, maka anda bisa membuka support tiket di halaman dashboard akun anda!<br>\n							Team kami akan membalas 1x24 jam Support tiket anda.\n\n							Regards<br>\n							Admin\n						', 2),
(8, 'support@adrihost.com', 'alexistdev@gmail.com', 'Layanan Hosting Personal Master adrihost.com telah dinonaktifkan!', '\n							Mohon maaf, layanan anda Personal Master adrihost.com telah dinonaktifkan<br>\n							Dikarenakan telah habis masa aktifnya atau telah melanggar ketentuan layanan kami<br><br>\n							Jika anda membutuhkan informasi lebih lanjut, silahkan hubungi costumer service kami.<br><br>\n							\n							Regards<br>\n							Admin\n						', 2),
(9, 'support@adrihost.com', 'alexistdev@gmail.com', 'Layanan Hosting Personal Master adrihost.com telah diaktifkan!', '\n							Selamat layanan anda Personal Master adrihost.com telah berhasil diaktifkan<br>\n							Dan berikut detail informasi cpanel nya:<br><br>\n							Username: siminti <br>\n							Password: wakakakaka <br><br>\n							Anda bisa login di http://.adrihost.com/cpanel<br><br>\n\n							Jika anda membutuhkan bantuan kami, maka anda bisa membuka support tiket di halaman dashboard akun anda!<br>\n							Team kami akan membalas 1x24 jam Support tiket anda.\n\n							Regards<br>\n							Admin\n						', 2),
(10, 'support@adrihost.com', 'alexistdev@gmail.com', 'Layanan Hosting Personal Master adrihost.com telah dinonaktifkan!', '\n							Mohon maaf, layanan anda Personal Master adrihost.com telah dinonaktifkan<br>\n							Dikarenakan telah habis masa aktifnya atau telah melanggar ketentuan layanan kami<br><br>\n							Jika anda membutuhkan informasi lebih lanjut, silahkan hubungi costumer service kami.<br><br>\n							\n							Regards<br>\n							Admin\n						', 2),
(11, 'support@adrihost.com', 'sumanto@gmail.com', 'Anda berhasil mendaftar akun di AdriHosts', '\n							Selamat anda telah berhasil mendaftar akun di AdriHosts , berikut informasi akun anda:<br><br>\n							Username: sumanto@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda harus mengklik Link Aktivasi berikut: http://localhost/manthav2/Daftar/validasi/6e2e1d66dbbb3d33c8ab1afa6e376fd8c521d51b<br><br>\n							\n							Regards<br>\n							Admin\n						', 2),
(12, 'support@adrihost.com', 'sumanto@gmail.com', 'Permintaan Reset Password', '\n				Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>\n				Reset Password: http://localhost/manthav2/reset_password/konfirm/69b53e5b1caac99f3d48a92d794bd6277c89e13b<br>\n\n				Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>\n				<br>\n				Regards<br>\n				Admin\n 			', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbhosting`
--

CREATE TABLE `tbhosting` (
  `id_hosting` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `nama_hosting` varchar(100) NOT NULL,
  `user_cpanel` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `start_hosting` date NOT NULL,
  `end_hosting` date NOT NULL,
  `domain` varchar(50) NOT NULL,
  `status_hosting` int(11) NOT NULL COMMENT '1=aktif , 2=pending,3=suspend,4=terminated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbhosting`
--

INSERT INTO `tbhosting` (`id_hosting`, `id_product`, `id_user`, `nama_hosting`, `user_cpanel`, `harga`, `start_hosting`, `end_hosting`, `domain`, `status_hosting`) VALUES
(35, 4, 37, 'Personal Master adrihost.com', '', 180000, '2021-01-21', '2021-04-21', 'adrihost.com', 4),
(36, 4, 37, 'Personal Master adrihost.com', '', 720000, '2021-01-21', '2022-01-21', 'adrihost.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbinbox`
--

CREATE TABLE `tbinbox` (
  `id_inbox` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_adm` int(11) NOT NULL COMMENT '1 = admin,\r\n2 = user',
  `judul` varchar(80) NOT NULL,
  `pesan` text NOT NULL,
  `key_token` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `status_inbox` int(11) NOT NULL COMMENT '1 = open\r\n2 = dibalas admin\r\n3 = closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbinvoice`
--

CREATE TABLE `tbinvoice` (
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hosting` int(11) DEFAULT NULL,
  `no_invoice` varchar(10) NOT NULL,
  `detail_produk` varchar(50) NOT NULL,
  `due` date NOT NULL,
  `inv_date` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `diskon_inv` int(11) NOT NULL,
  `pajak_inv` int(11) NOT NULL,
  `total_jumlah` int(11) NOT NULL,
  `status_inv` int(11) NOT NULL COMMENT '1= lunas\r\n2= pending\r\n3= sudah konfirmasi\r\n4= void',
  `token_inv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbinvoice`
--

INSERT INTO `tbinvoice` (`id_invoice`, `id_user`, `id_hosting`, `no_invoice`, `detail_produk`, `due`, `inv_date`, `sub_total`, `diskon_inv`, `pajak_inv`, `total_jumlah`, `status_inv`, `token_inv`) VALUES
(31, 37, 35, 'xlfr4', 'Personal Master adrihost.com  -  3 bulan', '2021-01-24', '2021-01-21', 180000, 164, 0, 179836, 1, ''),
(32, 37, 35, 'ZBJvZ', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 180000, 0, 0, 180000, 1, ''),
(33, 37, 35, 'rRuCh', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 180000, 18000, 0, 162000, 1, ''),
(34, 37, 35, 'jqBoR', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 180000, 9000, 0, 171000, 1, ''),
(35, 37, 35, 'f4lal', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 180000, 45000, 0, 135000, 1, ''),
(36, 37, 36, 'lsvjx', 'Personal Master adrihost.com  -  12 bulan', '2021-01-24', '2021-01-21', 720000, 243, 0, 719757, 1, ''),
(37, 37, 36, 'nnF2E', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 720000, 360000, 0, 360000, 1, ''),
(38, 37, 36, 'i5I24', 'Personal Master adrihost.com', '2021-01-24', '2021-01-21', 720000, 144000, 0, 576000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbkonfirmasi`
--

CREATE TABLE `tbkonfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `bank_pengirim` varchar(50) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `tanggal_konfirmasi` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = verified\r\n2= pending review'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkonfirmasi`
--

INSERT INTO `tbkonfirmasi` (`id_konfirmasi`, `id_invoice`, `id_user`, `nama_pengirim`, `bank_pengirim`, `no_invoice`, `tanggal_konfirmasi`, `total_bayar`, `status`) VALUES
(8, 31, 37, 'Alexsander Hendra', 'BCA', 'xlfr4', '2021-01-21', 179836, 2),
(9, 36, 37, 'Alexsander', 'BCA', 'lsvjx', '2021-01-21', 719757, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblocked`
--

CREATE TABLE `tblocked` (
  `id_locked` int(11) NOT NULL,
  `gagal_pertama` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `durasi_terkunci` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `failed_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblocked`
--

INSERT INTO `tblocked` (`id_locked`, `gagal_pertama`, `ip`, `durasi_terkunci`, `status`, `failed_count`) VALUES
(6, 1550920900, '127.0.0.1', 0, 0, 2),
(8, 1551347783, '172.68.142.48', 0, 0, 1),
(9, 1551348011, '172.69.22.189', 0, 0, 1),
(10, 1551348094, '172.68.143.163', 0, 0, 1),
(11, 1551348225, '172.68.141.227', 0, 0, 1),
(12, 1552753028, '36.84.227.239', 0, 0, 2),
(13, 1553008001, '36.68.50.194', 0, 0, 1),
(14, 1553395213, '182.1.62.6', 0, 0, 2),
(15, 1553405910, '112.215.175.153', 0, 0, 1),
(16, 1553504010, '141.0.9.163', 0, 0, 2),
(17, 1553673475, '182.0.164.68', 0, 0, 2),
(18, 1553751267, '36.90.44.207', 0, 0, 1),
(19, 1554094405, '116.206.42.75', 0, 0, 1),
(20, 1554205547, '182.1.18.68', 0, 0, 2),
(21, 1554294118, '180.244.201.160', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblogmail`
--

CREATE TABLE `tblogmail` (
  `id_logmail` int(11) NOT NULL,
  `email_tujuan` varchar(50) NOT NULL,
  `waktukirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblogmail`
--

INSERT INTO `tblogmail` (`id_logmail`, `email_tujuan`, `waktukirim`) VALUES
(5, 'alexistgame@yahoo.com', '1547938800'),
(6, 'alexistdev@gmail.com', '1547938800'),
(7, 'mantha18.php@gmail.com', '1547938800'),
(8, 'alexistgame@yahoo.com', '1548115200'),
(9, 'alexistgame@yahoo.com', '1548115200'),
(10, 'alexistgame@yahoo.com', '1548115200'),
(11, 'alexistgame@yahoo.com', '1548115200'),
(12, 'alexistgame@yahoo.com', '1548115200'),
(13, 'alexistgame@yahoo.com', '1548115200'),
(14, 'alexistgame@yahoo.com', '1548115200'),
(15, 'alexistgame@yahoo.com', '1548115200'),
(16, 'alexistgame@yahoo.com', '1548115200'),
(17, 'alexistgame@yahoo.com', '1548115200'),
(18, 'alexistgame@yahoo.com', '1548115200'),
(19, 'alexistgame@yahoo.com', '1548115200'),
(20, 'alexistgame@yahoo.com', '1548115200'),
(21, 'alexistgame@yahoo.com', '1548115200'),
(22, 'alexistgame@yahoo.com', '1548115200'),
(23, 'alexistgame@yahoo.com', '1548115200'),
(24, 'alexistgame@yahoo.com', '1548115200'),
(25, 'alexistgame@yahoo.com', '1548115200'),
(26, 'alexistgame@yahoo.com', '1548115200'),
(27, 'veronicamayasanti@gmail.com', '1548288000'),
(28, 'demouser@gmail.com', '1548288000'),
(29, 'alexistgame@yahoo.com', '1548288000'),
(30, 'alexistdev@gmail.com', '1548288000'),
(31, 'alexistdev@gmail.com', '1548547200'),
(32, 'alexistdev@gmail.com', '1548547200'),
(33, 'alexistdev@gmail.com', '1548547200'),
(34, 'alexistdev@gmail.com', '1548547200'),
(35, 'alexistdev@gmail.com', '1548547200'),
(36, 'alexistdev@gmail.com', '1548547200'),
(37, 'alexistdev@gmail.com', '1548547200'),
(38, 'dimar.tourtravel@gmail.com', '1548547200'),
(39, 'alexistdev@gmail.com', '1548547200'),
(40, 'lazycat.toys@gmail.com', '1548547200'),
(41, 'alexistdev@gmail.com', '1548547200'),
(42, 'terangcahayabulan@gmail.com', '1548547200'),
(43, 'alexistdev@gmail.com', '1548547200'),
(44, 'farhanponsel05@gmail.com', '1548547200'),
(45, 'alexistdev@gmail.com', '1548547200'),
(46, 'hendranatas@yahoo.com', '1548547200'),
(47, 'alexistdev@gmail.com', '1548547200'),
(48, 'dimasprtm50@gmail.com', '1548547200'),
(49, 'alexistdev@gmail.com', '1548547200'),
(50, 'jamiluddin99@gmail.com', '1548547200'),
(51, 'alexistdev@gmail.com', '1548547200'),
(52, 'adamrama001@gmail.com', '1548547200'),
(53, 'alexistdev@gmail.com', '1548547200'),
(54, 'celvinirianto10@gmail.com', '1548547200'),
(55, 'alexistdev@gmail.com', '1548547200'),
(56, 'ajiedharmawan22@gmail.com', '1548547200'),
(57, 'alexistdev@gmail.com', '1548547200'),
(58, 'muhammad.ajib@gmail.com', '1548547200'),
(59, 'alexistdev@gmail.com', '1548547200'),
(60, 'rey1006rhea@gmail.com', '1548547200'),
(61, 'alexistdev@gmail.com', '1548547200'),
(62, 'mybeyondcoid@gmail.com', '1548547200'),
(63, 'alexistdev@gmail.com', '1548547200'),
(64, 'wangkywijaya@gmail.com', '1548547200'),
(65, 'alexistdev@gmail.com', '1548547200'),
(66, 'cafekliker@gmail.com', '1548547200'),
(67, 'alexistdev@gmail.com', '1548547200'),
(68, 'mkemalarifin@gmail.com', '1548547200'),
(69, 'alexistdev@gmail.com', '1548547200'),
(70, 'avolksgeist@yahoo.com', '1548547200'),
(71, 'alexistdev@gmail.com', '1548547200'),
(72, 'bolangcloth3@gmail.com', '1548547200'),
(73, 'alexistdev@gmail.com', '1548547200'),
(74, 'martinfames@gmail.com', '1548547200'),
(75, 'alexistdev@gmail.com', '1548547200'),
(76, 'ca.mainweb@gmail.com', '1548547200'),
(77, 'alexistdev@gmail.com', '1548547200'),
(78, 'npetr768@gmail.com', '1548547200'),
(79, 'alexistdev@gmail.com', '1548547200'),
(80, 'cristianadinugroho@yahoo.co.id', '1548547200'),
(81, 'alexistdev@gmail.com', '1548547200'),
(82, 'alexistdev@gmail.com', '1548547200'),
(83, 'dikithewadiy@gmali.com', '1548547200'),
(84, 'alexistdev2@gmail.com', '1551571200'),
(85, 'alexistdev@gmail.com', '1551571200'),
(86, 'alexistdev@gmail.com', '1551571200'),
(87, 'alexistdev@gmail.com', '1551571200'),
(88, 'alexistdev@gmail.com', '1551657600'),
(89, 'alexistdev@gmail.com', '1551657600'),
(90, 'alexistdev2@gmail.com', '1551657600'),
(91, 'alexistdev@gmail.com', '1551657600'),
(92, 'alexistdev2@gmail.com', '1551657600'),
(93, 'alexistdev@gmail.com', '1551657600'),
(94, 'alexistdev2@gmail.com', '1551657600'),
(95, 'alexistdev@gmail.com', '1551657600'),
(96, 'alexistdev2@gmail.com', '1551657600'),
(97, 'alexistdev@gmail.com', '1551657600'),
(98, 'alexistdev2@gmail.com', '1551657600'),
(99, 'alexistdev@gmail.com', '1551657600'),
(100, 'alexistdev2@gmail.com', '1551657600'),
(101, 'alexistdev@gmail.com', '1551657600'),
(102, 'uzumakynagato01@gmail.com', '1551657600'),
(103, 'deaky_hikky@yahoo.com', '1552521600'),
(104, 'aconkroy@gmail.com', '1552694400'),
(105, 'amaninakun2@gmail.com', '1553385600'),
(106, 'anakjateng0765@gmail.com', '1553472000'),
(107, 'cahyanacepi@gmail.com', '1553644800'),
(108, 'valkryiedua@gmail.com', '1553731200'),
(109, 'ferrydwi299@gmail.com', '1553990400'),
(110, 'alexistdev@gmail.com', '1554508800'),
(111, 'alexistdev@gmail.com', '1554508800'),
(112, 'alexistdev@gmail.com', '1555718400'),
(113, 'zteroztero@gmail.com', '1556755200'),
(114, 'distytransmalang@gmail.com', '1557187200'),
(115, 'muhammadkoirudiak12081994@gmail.com', '1557705600'),
(116, 'rolanmardani5@gmail.com', '1557878400'),
(117, 'alexistdev@gmail.com', '1559260800'),
(118, 'alexistdev@gmail.com', '1559433600'),
(119, 'alexistdev@gmail.com', '1559779200'),
(120, 'alexistdev@gmail.com', '1559779200'),
(121, 'hugoscilacap@gmail.com', '1559952000'),
(122, 'alexistdev@gmail.com', '1560038400'),
(123, 'cahyanacepi@gmail.com', '1560384000'),
(124, 'alexistdev@gmail.com', '1560384000'),
(125, 'doniwijaya.15@gmail.com', '1561334400'),
(126, 'alexistdev@gmail.com', '1562778000'),
(127, 'akowuta@gmail.com', '1563123600'),
(128, 'snovalde@gmail.com', '1563555600'),
(129, 'mohamad.agung6@gmail.com', '1563814800'),
(130, 'dennyprastiawan94@gmail.com', '1563901200'),
(131, 'cahyanacepi@gmail.com', '1563987600'),
(132, 'cahyanacepi@gmail.com', '1563987600'),
(133, 'srikandiofficialstore@gmail.com', '1564938000'),
(134, 'gelaruber@gmail.com', '1565715600'),
(135, 'FDHGDHG@GKJHH.VKM', '1568998800'),
(136, 'fbmy77@ymail.com', '1570986000'),
(137, 'dhifo150301@gmail.com', '1571245200'),
(138, 'isepsetiayusup@gmail.com', '1572109200'),
(139, 'andykabangun@gmail.com', '1572282000'),
(140, 'globalmltmedia@gmail.com', '1573578000'),
(141, 'frwgea@gmail.com', '1575997200'),
(142, 'dimas@gmail.com', '1576256400'),
(143, 'radit01082000@gmail.com', '1577811600'),
(144, 'dropshipayid@gmail.com', '1577898000'),
(145, 'alexistdev@gmail.com', '1610838000'),
(146, 'alexistdev@gmail.com', '1610838000'),
(147, 'alexistdev@gmail.com', '1610838000'),
(148, 'alexistdev@gmail.com', '1611183600'),
(149, 'alexistdev@gmail.com', '1611183600'),
(150, 'alexistdev@gmail.com', '1611183600'),
(151, 'alexistdev@gmail.com', '1611183600'),
(152, 'support@gmail.com', '1611183600'),
(153, 'alexistdev@gmail.com', '1611183600'),
(154, 'alexistdev@gmail.com', '1611183600'),
(155, 'alexistdev@gmail.com', '1611183600'),
(156, 'samantha@gmail.com', '1611183600'),
(157, 'samantha@gmail.com', '1611183600'),
(158, 'samantha@gmail.com', '1611183600'),
(159, 'alexistdev@gmail.com', '1611183600'),
(160, 'alexistgame@yahoo.com', '1611183600'),
(161, 'alexistdev@gmail.com', '1611183600');

-- --------------------------------------------------------

--
-- Table structure for table `tbmodul`
--

CREATE TABLE `tbmodul` (
  `id_modul` int(11) NOT NULL,
  `nama_modul` varchar(50) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmodul`
--

INSERT INTO `tbmodul` (`id_modul`, `nama_modul`, `api_key`, `status`) VALUES
(1, 'smtp2go', 'api-E8EE6D545B8211EBA381F23C91C88F4E', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbproduct`
--

CREATE TABLE `tbproduct` (
  `id_product` int(11) NOT NULL,
  `nama_product` varchar(50) NOT NULL,
  `type_product` int(11) NOT NULL COMMENT '1=personal, 2=profesional',
  `harga` int(11) NOT NULL,
  `kapasitas` varchar(20) NOT NULL,
  `bandwith` varchar(20) DEFAULT NULL,
  `addon_domain` varchar(20) DEFAULT NULL,
  `email_account` varchar(20) DEFAULT NULL,
  `database_account` varchar(10) DEFAULT NULL,
  `ftp_account` varchar(20) DEFAULT NULL,
  `siklus` int(11) DEFAULT NULL,
  `pilihan_1` varchar(20) DEFAULT NULL,
  `pilihan_2` varchar(20) DEFAULT NULL,
  `pilihan_3` varchar(20) DEFAULT NULL,
  `pilihan_4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbproduct`
--

INSERT INTO `tbproduct` (`id_product`, `nama_product`, `type_product`, `harga`, `kapasitas`, `bandwith`, `addon_domain`, `email_account`, `database_account`, `ftp_account`, `siklus`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`) VALUES
(1, 'Personal Junior', 1, 15000, '1 Gb', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited2', 12, 'Cloudlinux', 'Datacenter Singapore', '24/7 Support', ''),
(2, 'Personal Senior', 1, 35000, '2 Gb', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 12, 'Cloudlinux', 'Datacenter Singapore', '24/7 Support', ''),
(3, 'Personal Corporate', 1, 50000, '3 Gb', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 12, 'Cloudlinux', 'Datacenter Singapore', '24/7 Support', ''),
(4, 'Personal Master', 1, 60000, '4 Gb', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 'Unlimited', 12, 'Cloudlinux', 'Datacenter Singapore', '24/7 Support', ''),
(5, 'PRO-1 SGP', 2, 750000, '5 Gb', NULL, NULL, NULL, NULL, NULL, 12, 'Premium Hosting', 'Premium Support', '', ''),
(6, 'PRO-2 SGP', 2, 1500000, '10 Gb', NULL, NULL, NULL, NULL, NULL, 12, 'Premium Hosting', 'Premium Support', '', ''),
(7, 'PRO-3 SGP', 2, 3000000, '20 Gb', NULL, NULL, NULL, NULL, NULL, 12, 'Premium Hosting', 'Premium Support', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsetting`
--

CREATE TABLE `tbsetting` (
  `id_setting` int(11) NOT NULL,
  `nama_hosting` varchar(20) NOT NULL,
  `judul_hosting` varchar(100) NOT NULL,
  `alamat_hosting` varchar(200) NOT NULL,
  `email_hosting` varchar(50) NOT NULL,
  `telp_hosting` varchar(30) NOT NULL,
  `tos` varchar(100) NOT NULL,
  `tax` int(11) NOT NULL,
  `limit_email` int(11) NOT NULL,
  `prefix` int(11) NOT NULL,
  `api_key` varchar(128) NOT NULL,
  `nama_bank` varchar(80) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama_pemilik` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbsetting`
--

INSERT INTO `tbsetting` (`id_setting`, `nama_hosting`, `judul_hosting`, `alamat_hosting`, `email_hosting`, `telp_hosting`, `tos`, `tax`, `limit_email`, `prefix`, `api_key`, `nama_bank`, `no_rekening`, `nama_pemilik`) VALUES
(1, 'AdriHosts', 'AdriHost - Layanan Hosting Berkualitas di Indonesiaaaa', 'Jl.Bendungan Wayngison No.237 Bandarlampungs', 'support@adrihost.com', '0856-0201-30021', 'https://adrihost.com/term-and-condition-of-services/', 10, 2, 1500, 'at_YJfP2jvzKqhB1chsVi5dhBCnclRS7', 'BCA KCU PRINGSEWU', '844-525-0712', 'VERONICA MAYA SANTI');

-- --------------------------------------------------------

--
-- Table structure for table `tbtld`
--

CREATE TABLE `tbtld` (
  `id_tld` int(11) NOT NULL,
  `tld` varchar(6) NOT NULL,
  `harga_tld` int(11) NOT NULL,
  `status_tld` int(11) NOT NULL,
  `default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbtld`
--

INSERT INTO `tbtld` (`id_tld`, `tld`, `harga_tld`, `status_tld`, `default`) VALUES
(1, 'com', 145000, 1, 1),
(2, 'net', 125000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbtoken`
--

CREATE TABLE `tbtoken` (
  `id_token` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbtoken`
--

INSERT INTO `tbtoken` (`id_token`, `id_user`, `token`, `time`) VALUES
(3, 20, '0e0015a96f4bf316b8abe091d4d1cad76266d3c1', 1610332598),
(5, 20, 'b7974f01bc957da135d7563acedbf679af0d9f9d', 1610332690),
(33, 27, 'e545a84472cd06fd2ded90a417347f862d2506c7', 1610667257),
(37, 28, '5ff738f72775089a87f351458e09ce3495d6ddaa', 1610749121),
(67, 32, 'd099778b268b93f521ce0d2df2ce9f2bbdb7be82', 1611035629),
(71, 33, '496f9deb6aad33b36aa6c882c6c4a63fc7f01cb5', 1611078522),
(81, 29, 'cf7f316a78d7d0a1a6d454544e9a6d3ae355308b', 1611225115),
(85, 36, 'bf1f260c605a70db1ae821006459b39652dca58f', 1611231279),
(96, 37, '6ac55c5fd71996bf00578299f0276f63b7615653', 1611307451),
(101, 38, '4547bf9bf2fdbeefba64817c43280b11b6a4f07b', 1611310613),
(105, 39, '58f71e1a885f5550696f144b14c1caca386bb6ad', 1611311028);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = aktif\r\n2 = tidak aktif\r\n3= suspend',
  `time_req` int(11) DEFAULT NULL,
  `token_req` varchar(100) DEFAULT NULL,
  `validasi_token` varchar(100) DEFAULT NULL,
  `timepin` int(11) DEFAULT NULL,
  `sec_pin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `client`, `password`, `email`, `date_create`, `ip`, `status`, `time_req`, `token_req`, `validasi_token`, `timepin`, `sec_pin`) VALUES
(37, 1500, '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev@gmail.com', '2021-01-21', '::1', 1, NULL, NULL, NULL, NULL, NULL),
(38, 1501, '$2y$10$6orcjjjTQnEAH0D2/xtEgOlR6m4NalD8daQaCWS7KKPjSiO2HvKgC', 'sumanto@gmail.com', '2021-01-22', '::1', 1, 0, '', NULL, NULL, NULL),
(39, 1502, '$2y$10$FCuEVEcu8AxESSeA4GFFguBcyy.kwZicXO3Vces1AkjZEZr96zu2y', 'silvia@gmail.com', '2021-01-22', NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbvps`
--

CREATE TABLE `tbvps` (
  `id_vps` int(11) NOT NULL,
  `nama_vps` varchar(30) NOT NULL,
  `harga_vps` int(11) NOT NULL,
  `kapasitas_vps` varchar(30) NOT NULL,
  `bandwith_vps` varchar(30) NOT NULL,
  `core_vps` varchar(10) NOT NULL,
  `ram_vps` varchar(30) NOT NULL,
  `pilihan_1` varchar(20) NOT NULL,
  `pilihan_2` varchar(20) NOT NULL,
  `pilihan_3` varchar(20) NOT NULL,
  `pilihan_4` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbvps`
--

INSERT INTO `tbvps` (`id_vps`, `nama_vps`, `harga_vps`, `kapasitas_vps`, `bandwith_vps`, `core_vps`, `ram_vps`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`, `status`) VALUES
(1, 'VPS 1 SGP', 150000, '20 GB SSD Disk Space', '1 TB Bandwidth / Month', '1 Core', '512 MB Physical RAM', '1 IP Address v4', 'Control Panel', 'DDOS Protection', 'Linux', 1),
(2, 'VPS 2 SGP', 250000, '30 GB SSD Disk Space', '2 TB Bandwidth / Month', '1 Core', '1 Gb Physical RAM', '1 IP Address v4', 'Control Panel', 'DDOS Protection', 'Linux', 1),
(3, 'VPS 3 SGP', 350000, '40 GB SSD Disk Space', '3 TB Bandwidth / Month', '2 Core', '3 Gb Physical RAM', '1 IP Address v4', 'Control Panel', 'DDOS Protection', 'Linux', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbvpsservice`
--

CREATE TABLE `tbvpsservice` (
  `id_vpsservice` int(11) NOT NULL,
  `id_vps` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbvpstransit`
--

CREATE TABLE `tbvpstransit` (
  `id_vpstransit` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `nama_variabel` varchar(30) NOT NULL,
  `nilai_variabel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbvpstransit`
--

INSERT INTO `tbvpstransit` (`id_vpstransit`, `user_id`, `timestamp`, `nama_variabel`, `nilai_variabel`) VALUES
(1, 1, '5f07731c55a3eb00ccbb4a65f1ee196d83b5a1e2', 'conf1', '+ 1 Gb'),
(2, 1, '5f07731c55a3eb00ccbb4a65f1ee196d83b5a1e2', 'conf2', '+1 Core');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `inboxbalas`
--
ALTER TABLE `inboxbalas`
  ADD PRIMARY KEY (`id_balas`);

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbberita`
--
ALTER TABLE `tbberita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tbcategory_config`
--
ALTER TABLE `tbcategory_config`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tbconfig_option`
--
ALTER TABLE `tbconfig_option`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `tbdetailuser`
--
ALTER TABLE `tbdetailuser`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbdomain`
--
ALTER TABLE `tbdomain`
  ADD PRIMARY KEY (`id_domain`),
  ADD KEY `tbdomain_ibfk_1` (`id_tld`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbdomaintransit`
--
ALTER TABLE `tbdomaintransit`
  ADD PRIMARY KEY (`id_domtrans`);

--
-- Indexes for table `tbdomainwhois`
--
ALTER TABLE `tbdomainwhois`
  ADD PRIMARY KEY (`id_domainwhois`);

--
-- Indexes for table `tbemail`
--
ALTER TABLE `tbemail`
  ADD PRIMARY KEY (`id_email`);

--
-- Indexes for table `tbhosting`
--
ALTER TABLE `tbhosting`
  ADD PRIMARY KEY (`id_hosting`),
  ADD KEY `tbhosting_ibfk_1` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `tbinbox`
--
ALTER TABLE `tbinbox`
  ADD PRIMARY KEY (`id_inbox`),
  ADD KEY `tbinbox_ibfk_1` (`id_user`);

--
-- Indexes for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_hosting` (`id_hosting`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbkonfirmasi`
--
ALTER TABLE `tbkonfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `id_invoice` (`id_invoice`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tblocked`
--
ALTER TABLE `tblocked`
  ADD PRIMARY KEY (`id_locked`);

--
-- Indexes for table `tblogmail`
--
ALTER TABLE `tblogmail`
  ADD PRIMARY KEY (`id_logmail`);

--
-- Indexes for table `tbmodul`
--
ALTER TABLE `tbmodul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `tbproduct`
--
ALTER TABLE `tbproduct`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tbsetting`
--
ALTER TABLE `tbsetting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbtld`
--
ALTER TABLE `tbtld`
  ADD PRIMARY KEY (`id_tld`);

--
-- Indexes for table `tbtoken`
--
ALTER TABLE `tbtoken`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbvps`
--
ALTER TABLE `tbvps`
  ADD PRIMARY KEY (`id_vps`);

--
-- Indexes for table `tbvpsservice`
--
ALTER TABLE `tbvpsservice`
  ADD PRIMARY KEY (`id_vpsservice`);

--
-- Indexes for table `tbvpstransit`
--
ALTER TABLE `tbvpstransit`
  ADD PRIMARY KEY (`id_vpstransit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inboxbalas`
--
ALTER TABLE `inboxbalas`
  MODIFY `id_balas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbberita`
--
ALTER TABLE `tbberita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbcategory_config`
--
ALTER TABLE `tbcategory_config`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbconfig_option`
--
ALTER TABLE `tbconfig_option`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbdetailuser`
--
ALTER TABLE `tbdetailuser`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbdomain`
--
ALTER TABLE `tbdomain`
  MODIFY `id_domain` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdomaintransit`
--
ALTER TABLE `tbdomaintransit`
  MODIFY `id_domtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbdomainwhois`
--
ALTER TABLE `tbdomainwhois`
  MODIFY `id_domainwhois` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbemail`
--
ALTER TABLE `tbemail`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbhosting`
--
ALTER TABLE `tbhosting`
  MODIFY `id_hosting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbinbox`
--
ALTER TABLE `tbinbox`
  MODIFY `id_inbox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbkonfirmasi`
--
ALTER TABLE `tbkonfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblocked`
--
ALTER TABLE `tblocked`
  MODIFY `id_locked` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblogmail`
--
ALTER TABLE `tblogmail`
  MODIFY `id_logmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `tbmodul`
--
ALTER TABLE `tbmodul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbproduct`
--
ALTER TABLE `tbproduct`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbsetting`
--
ALTER TABLE `tbsetting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtld`
--
ALTER TABLE `tbtld`
  MODIFY `id_tld` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbtoken`
--
ALTER TABLE `tbtoken`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbvps`
--
ALTER TABLE `tbvps`
  MODIFY `id_vps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbvpsservice`
--
ALTER TABLE `tbvpsservice`
  MODIFY `id_vpsservice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbvpstransit`
--
ALTER TABLE `tbvpstransit`
  MODIFY `id_vpstransit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbdetailuser`
--
ALTER TABLE `tbdetailuser`
  ADD CONSTRAINT `tbdetailuser_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tbdomain`
--
ALTER TABLE `tbdomain`
  ADD CONSTRAINT `tbdomain_ibfk_1` FOREIGN KEY (`id_tld`) REFERENCES `tbtld` (`id_tld`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbdomain_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbhosting`
--
ALTER TABLE `tbhosting`
  ADD CONSTRAINT `tbhosting_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbhosting_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `tbproduct` (`id_product`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `tbinbox`
--
ALTER TABLE `tbinbox`
  ADD CONSTRAINT `tbinbox_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  ADD CONSTRAINT `tbinvoice_ibfk_1` FOREIGN KEY (`id_hosting`) REFERENCES `tbhosting` (`id_hosting`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbinvoice_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbkonfirmasi`
--
ALTER TABLE `tbkonfirmasi`
  ADD CONSTRAINT `tbkonfirmasi_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `tbinvoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbkonfirmasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
