-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 03:49 AM
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
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id_admin`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 1, 1);

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
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(24, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(25, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg'),
(26, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg');

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
(2, 'support@adrihost.com', 'alexistdev@gmail.com', 'Anda berhasil mendaftar akun di AdriHost', '\n							Selamat anda telah berhasil mendaftar akun di AdriHost , berikut informasi akun anda:<br><br>\n							Username: alexistdev@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di http://localhost/manthav2/<br><br>\n							Regards<br>\n							Admin\n						', 2),
(3, 'support@adrihost.com', 'alexistde2@gmail.com', 'Anda berhasil mendaftar akun di AdriHost', '\n							Selamat anda telah berhasil mendaftar akun di AdriHost , berikut informasi akun anda:<br><br>\n							Username: alexistde2@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di http://localhost/manthav2/<br><br>\n							Regards<br>\n							Admin\n						', 2),
(4, 'support@adrihost.com', 'samantha@gmail.com', 'Anda berhasil mendaftar akun di AdriHost', '\n							Selamat anda telah berhasil mendaftar akun di AdriHost , berikut informasi akun anda:<br><br>\n							Username: samantha@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di http://localhost/manthav2/<br><br>\n							Regards<br>\n							Admin\n						', 2),
(5, 'support@adrihost.com', 'halo4@gmail.com', 'Anda berhasil mendaftar akun di AdriHost', '\n							Selamat anda telah berhasil mendaftar akun di AdriHost , berikut informasi akun anda:<br><br>\n							Username: halo4@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di http://localhost/manthav2/<br><br>\n							Regards<br>\n							Admin\n						', 2),
(6, 'support@adrihost.com', 'amandha@gmail.com', 'Anda berhasil mendaftar akun di AdriHost', '\n							Selamat anda telah berhasil mendaftar akun di AdriHost , berikut informasi akun anda:<br><br>\n							Username: amandha@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di http://localhost/manthav2/<br><br>\n							Regards<br>\n							Admin\n						', 2),
(7, 'support@adrihost.com', 'alexistdev@gmail.com', 'Permintaan Reset Password', '\n				Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>\n				Reset Password: http://localhost/manthav2/reset_password/konfirm/56b82675c9fe4f3438151d557a436c957bd6a95c<br>\n\n				Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>\n				<br>\n				Regards<br>\n				Admin\n 			', 2),
(8, 'support@adrihost.com', 'alexistdev@gmail.com', 'Permintaan Reset Password', '\n				Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>\n				Reset Password: http://localhost/manthav2/reset_password/konfirm/28b4b22544451daf351a08f6293609a762740591<br>\n\n				Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>\n				<br>\n				Regards<br>\n				Admin\n 			', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbhosting`
--

CREATE TABLE `tbhosting` (
  `id_hosting` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_hosting` varchar(100) NOT NULL,
  `user_cpanel` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `start_hosting` date NOT NULL,
  `end_hosting` date NOT NULL,
  `domain` varchar(50) NOT NULL,
  `status_hosting` int(11) NOT NULL COMMENT '1=aktif , 2=pending,3=suspend,4=terminated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbinvoice`
--

CREATE TABLE `tbinvoice` (
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hosting` int(11) NOT NULL,
  `no_invoice` varchar(10) NOT NULL,
  `detail_produk` varchar(50) NOT NULL,
  `due` date NOT NULL,
  `inv_date` date NOT NULL,
  `sub_total` int(11) NOT NULL,
  `diskon_inv` int(11) NOT NULL,
  `pajak_inv` int(11) NOT NULL,
  `total_jumlah` int(11) NOT NULL,
  `status_inv` int(11) NOT NULL COMMENT '1=sudah diemail,2= belum diemail',
  `token_inv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbkonfirmasi`
--

CREATE TABLE `tbkonfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `tanggal_konfirmasi` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkonfirmasi`
--

INSERT INTO `tbkonfirmasi` (`id_konfirmasi`, `id_invoice`, `id_user`, `no_invoice`, `tanggal_konfirmasi`, `total_bayar`, `status`) VALUES
(2, 29, 1, '9rcne', '2019-02-28', 145000, 2),
(3, 29, 1, '9rcne', '2019-02-28', 145000, 2),
(4, 29, 1, '9rcne', '2019-02-28', 145000, 2),
(5, 29, 1, '9rcne', '2019-02-28', 145000, 2),
(6, 30, 1, 'v9wPr', '2019-02-28', 55000, 2),
(7, 31, 1, '0wlGu', '2019-02-28', 55000, 2),
(8, 33, 1, 'gZ99k', '2019-03-01', 55000, 2),
(9, 37, 55, 'hapn6', '2019-04-11', 120000, 2),
(10, 41, 3, 'yuV2x', '2019-04-22', 650000, 2),
(11, 40, 1, 'DYu5R', '2019-04-23', 145000, 2),
(12, 46, 1, 'ZQjFY', '2019-07-11', 145000, 2),
(13, 50, 65, 'ubTWJ', '2019-07-24', 120000, 2),
(14, 48, 3, 'mJ3E8', '2019-07-24', 145000, 2),
(15, 54, 74, 'TTlAc', '2019-12-11', 5000, 2);

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
(144, 'dropshipayid@gmail.com', '1577898000');

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
(1, 'Personal Junior', 1, 5000, '500 mb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(2, 'Personal Senior', 1, 10000, '1 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(3, 'Personal Corporate', 1, 25000, '2 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(4, 'Personal Master', 1, 40000, '3 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(5, 'PRO-1 SGP', 2, 650000, '5 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', ''),
(6, 'PRO-2 SGP', 2, 1250000, '10 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', ''),
(7, 'PRO-3 SGP', 2, 2400000, '20 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', ''),
(9, 'HEMAT', 1, 2500, '100 mb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', NULL, 'CageFS', 'Support 24 jam', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsetting`
--

CREATE TABLE `tbsetting` (
  `id_setting` int(11) NOT NULL,
  `nama_hosting` varchar(20) NOT NULL,
  `judul_hosting` varchar(100) NOT NULL,
  `alamat_hosting` varchar(100) NOT NULL,
  `email_hosting` varchar(100) NOT NULL,
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
(1, 'AdriHost', 'AdriHost - Layanan Hosting Berkualitas di Indonesia', 'Jl.Bendungan Wayngison No.237 Bandarlampung', 'support@adrihost.com', '0856-0201-3002', 'https://adrihost.com/term-and-condition-of-services/', 10, 1, 0, 'at_YJfP2jvzKqhB1chsVi5dhBCnclRS7', 'BCA KCU PRINGSEWU', '844-525-0712', 'VERONICA MAYA SANTI');

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
(1, 'com', 145000, 1, 1);

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
(13, 22, 'e263e6515b5f558dbc837a7a003ec37f5e8289e2', 1610419590);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `time_req` int(11) DEFAULT NULL,
  `token_req` varchar(100) DEFAULT NULL,
  `timepin` int(11) DEFAULT NULL,
  `sec_pin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `client`, `password`, `email`, `date_create`, `ip`, `status`, `time_req`, `token_req`, `timepin`, `sec_pin`) VALUES
(22, 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'alexistdev@gmail.com', '2021-01-11', NULL, 1, 2147483647, '28b4b22544451daf351a08f6293609a762740591', NULL, NULL),
(23, 0, '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistde2@gmail.com', '2021-01-11', '::1', 2, NULL, NULL, NULL, NULL),
(24, 2, '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'samantha@gmail.com', '2021-01-11', '::1', 2, NULL, NULL, NULL, NULL),
(25, 3, '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'halo4@gmail.com', '2021-01-11', '::1', 2, NULL, NULL, NULL, NULL),
(26, 4, '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'amandha@gmail.com', '2021-01-11', '::1', 2, NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `subyek` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `timeticket` int(11) NOT NULL,
  `keyticket` varchar(50) NOT NULL,
  `balasan` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_user`, `subyek`, `pesan`, `timeticket`, `keyticket`, `balasan`, `status`) VALUES
(1, 1, 'semakin jaya kedepan', 'oke deh dikepenak wae', 1559845335, '0742fff3f8421ac59bef11542ccc3a352be99dfd', 0, '1'),
(2, 1, '[Klien]Balasan support ticket.', 'yo taw wakakakakakka', 1559845348, '0742fff3f8421ac59bef11542ccc3a352be99dfd', 1, '1'),
(3, 1, 'peesan ini disampaikan oleh', 'ertanyaan atau meminta dukungan layanan kami', 1559851171, '607e0a5a9ce8097f6f116afb31fb92bf280a5fd5', 0, '1'),
(4, 1, '[Klien]Balasan support ticket.', 'serem tenan', 1559918478, '0742fff3f8421ac59bef11542ccc3a352be99dfd', 1, '1'),
(5, 1, '[Klien]Balasan support ticket.', 'walaupun tau itu', 1560442793, '607e0a5a9ce8097f6f116afb31fb92bf280a5fd5', 1, '1'),
(6, 1, 'saya mau bertanya pakde', 'bagaimana ceritanya itu bisa terjadi?', 1560442899, 'a29f5479c1aae1369fbe85b960b29e872bce5e48', 0, '1'),
(7, 1, '[Klien]Balasan support ticket.', 'ya begitulah adanya, mengapa', 1560442920, 'a29f5479c1aae1369fbe85b960b29e872bce5e48', 1, '1'),
(9, 3, 'testing', 'adadadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1564053724, '09d9935278bbd9a1b0bdcd3ebf4c0c7ee418ce9f', 0, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

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
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `tbkonfirmasi`
--
ALTER TABLE `tbkonfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

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
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbhosting`
--
ALTER TABLE `tbhosting`
  MODIFY `id_hosting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkonfirmasi`
--
ALTER TABLE `tbkonfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblocked`
--
ALTER TABLE `tblocked`
  MODIFY `id_locked` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblogmail`
--
ALTER TABLE `tblogmail`
  MODIFY `id_logmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbproduct`
--
ALTER TABLE `tbproduct`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbsetting`
--
ALTER TABLE `tbsetting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtld`
--
ALTER TABLE `tbtld`
  MODIFY `id_tld` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtoken`
--
ALTER TABLE `tbtoken`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `tbhosting_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
