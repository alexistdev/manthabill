-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 11:09 AM
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
(1, 1, 'alexskeren', 'Hendra Wijayas', 'adrihosts', 'Jl.Bendungan Wayngisona', 'gang asemi', 'Pringsewus', 'Bandarlampungs', 'Indonesia', '555745', '0856020130021', 1581951478, 'default.jpg'),
(2, 2, 'samantha', 'wijaya', '', 'Jl.Ki Ageng Gribig No 43', 'Klaten', 'Klaten', 'Jawa Tengah', 'Indonesia', '55745', '085702527815', 0, 'default.jpg'),
(3, 3, 'cepi', 'cahyana', '', 'subang', 'subang', 'jawabarat', 'jawabarat', 'Indonesia', '55570', '123', 0, 'default.jpg'),
(4, 4, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(8, 8, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(9, 9, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(10, 10, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(11, 11, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(12, 12, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(14, 14, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(15, 15, 'demouser', 'mr', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(16, 16, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(17, 17, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(18, 18, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(19, 19, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(20, 20, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(21, 21, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(22, 22, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(23, 23, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(24, 24, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(25, 25, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(26, 26, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(27, 27, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(28, 28, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(29, 29, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(30, 30, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(31, 31, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(32, 32, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(33, 33, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(34, 34, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(35, 35, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(36, 36, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(37, 37, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(38, 38, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(39, 39, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(40, 40, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(41, 41, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(42, 42, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(43, 43, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(44, 44, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(45, 45, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(46, 46, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(47, 47, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(48, 48, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(49, 49, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(50, 50, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(51, 51, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(52, 52, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(53, 53, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(54, 54, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(55, 55, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(56, 56, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(57, 57, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(58, 58, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(59, 59, '', '', '', '', '', '', '', '', '0', '', 0, 'default.jpg'),
(60, 60, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(61, 61, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(62, 62, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(63, 63, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(64, 64, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(65, 65, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(66, 66, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(67, 67, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(68, 68, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(69, 69, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(70, 70, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(71, 71, 'isep', 'setia yusup', 'neriscell', 'ciloa', '', 'sukabumi', 'sukabumi', 'Indonesia', '43364', '085659519951', 0, 'default.jpg'),
(72, 72, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(73, 73, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(74, 74, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(75, 75, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(76, 76, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(77, 77, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(78, 78, 'Hendra', 'Wijaya', 'Wijaya', 'Lampung', '', 'Pringsewu', 'Lampung', 'Indonesia', '', '085602013002', 1581951528, 'default.jpg'),
(79, 79, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(80, 80, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(81, 81, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(82, 82, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg'),
(83, 83, '', '', '', '', '', '', '', '', '', '', 0, 'default.jpg');

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

--
-- Dumping data for table `tbdomain`
--

INSERT INTO `tbdomain` (`id_domain`, `id_user`, `id_tld`, `nama_domain`, `nameserver1`, `nameserver2`, `nameserver3`, `nameserver4`, `nameserver5`, `date_register`, `due_date`, `status`) VALUES
(2, 1, 3, 'samantha32.web.id', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-03-01', '2020-03-01', 2),
(3, 1, 1, 'samantha32.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-04-14', '2020-04-14', 2),
(5, 3, 1, 'kosnjoy.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-05-01', '2020-05-01', 1),
(6, 1, 1, 'samantha332.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-06-13', '2020-06-13', 2),
(7, 3, 1, 'smkpgri-subang.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-07-05', '2020-07-05', 1),
(8, 3, 1, 'ismijaya23.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '', '2019-07-25', '2020-07-25', 2),
(9, 1, 1, 'alexistdev3.com', '', '', '', '', '', '2020-02-16', '2021-02-16', 2),
(10, 1, 1, 'alexistdev3.com', 'ns1.hosting.com', 'ns2.hosting.com', 'ns3.hosting.com', 'ns4.hosting.com', 'ns5.hosting.com', '2020-02-16', '2021-02-16', 2),
(11, 1, 1, 'samantha32.com', 'ns1.hosting.com', 'ns2.hosting.com', 'ns3.hosting.com', 'ns4.hosting.com', 'ns5.hosting.com', '2020-02-16', '2021-02-16', 2);

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
(1, 'support@adrihost.com', 'alexistdev8@gmail.com', 'Akun Anda Berhasil Dibuat', '\n							Selamat anda telah berhasil mendaftar akun di adrihost.com , berikut informasi akun anda:<br><br>\n							Username: alexistdev8@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di AdriHost<br><br>\n							Regards<br>\n							Admin\n						', 2),
(2, 'support@adrihost.com', 'alexistdev8@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Junior adrahost.com <br>\n					Harga: 29275 <br>\n					Durasi: 6 Bulan<br>\n					Invoice: MQxl6<br>\n					Register: 25-12-2020<br>\n					Expired:  25-06-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(3, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Akun Anda Berhasil Dibuat', '\n							Selamat anda telah berhasil mendaftar akun di adrihost.com , berikut informasi akun anda:<br><br>\n							Username: alexistdev9@gmail.com <br>\n							Password: 325339 <br><br>\n							Anda bisa login di AdriHost<br><br>\n							Regards<br>\n							Admin\n						', 2),
(4, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Junior adrihost.com <br>\n					Harga: 4492 <br>\n					Durasi: 1 Bulan<br>\n					Invoice: vu3ge<br>\n					Register: 25-12-2020<br>\n					Expired:  25-01-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(5, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Junior sumantho.co.id <br>\n					Harga: 14629 <br>\n					Durasi: 3 Bulan<br>\n					Invoice: P7MIi<br>\n					Register: 25-12-2020<br>\n					Expired:  25-03-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(6, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Senior sokaramae.web.id <br>\n					Harga: 119835 <br>\n					Durasi: 12 Bulan<br>\n					Invoice: 6vBab<br>\n					Register: 25-12-2020<br>\n					Expired:  25-12-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(7, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Junior sokarame.com <br>\n					Harga: 59205 <br>\n					Durasi: 12 Bulan<br>\n					Invoice: BrEVY<br>\n					Register: 25-12-2020<br>\n					Expired:  25-12-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(8, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Corporate penjahat.top <br>\n					Harga: 299197 <br>\n					Durasi: 12 Bulan<br>\n					Invoice: 2a6DM<br>\n					Register: 25-12-2020<br>\n					Expired:  25-12-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2),
(9, 'support@adrihost.com', 'alexistdev9@gmail.com', 'Layanan Anda telah dibuat', '\n					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>\n\n					Nama Produk:Personal Master siliminti.com <br>\n					Harga: 119158 <br>\n					Durasi: 3 Bulan<br>\n					Invoice: 5Qz5N<br>\n					Register: 25-12-2020<br>\n					Expired:  25-03-2021<br>\n					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.\n					<br><br>\n					Regards<br>\n					Admin<br>\n				', 2);

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

--
-- Dumping data for table `tbhosting`
--

INSERT INTO `tbhosting` (`id_hosting`, `id_product`, `id_user`, `nama_hosting`, `user_cpanel`, `harga`, `start_hosting`, `end_hosting`, `domain`, `status_hosting`) VALUES
(1, 5, 1, 'PRO-1 SGP adrihost.com', '', 2400000, '2018-12-22', '2019-12-22', 'www.adrihost.com', 1),
(2, 6, 3, 'PRO-2 SGP grims.navy', '', 2400000, '2018-05-08', '2019-05-08', 'www.grims.navy', 1),
(3, 2, 4, 'Personal Senior pramukapeduli.or.id', '', 30000, '2018-10-31', '2019-01-31', 'www.pramukapeduli.or.id', 1),
(37, 5, 3, 'PRO-1 SGP dishubambon.com', '', 650000, '2019-01-13', '2020-01-13', 'www.dishubambon.com', 1),
(45, 1, 15, 'Personal Junior pw', '', 5000, '2019-01-24', '2019-02-24', 'anf.pw', 2),
(47, 1, 1, 'Personal Junior digitapromo.com', '', 60000, '2019-01-24', '2020-01-24', 'www.digitapromo.com', 2),
(48, 6, 35, 'PRO-2 SGP mybeyond.co.id', '', 1250000, '2018-06-06', '2019-06-06', 'www.mybeyond.co.id', 1),
(49, 5, 35, 'PRO-1 SGP studentvillage.co.id ', '', 650000, '2018-07-09', '2019-07-09', 'www.studentvillage.co.id ', 1),
(50, 1, 1, 'Personal Junior digitapromo.com', '', 60000, '2019-02-10', '2020-02-10', 'www.digitapromo.com', 2),
(52, 1, 49, 'Personal Junior hunis.com', '', 5000, '2019-03-02', '2019-04-02', 'Marthunis.com', 2),
(55, 2, 55, 'Personal Senior elkita', '', 120000, '2019-03-31', '2020-03-31', 'travelkita', 2),
(56, 5, 3, 'PRO-1 SGP sditmu.com', '', 650000, '2019-04-06', '2020-04-06', 'www.sditmu.com', 1),
(57, 5, 3, 'PRO-1 SGP sekolahcanggih.com', '', 650000, '2019-04-11', '2020-04-11', 'www.sekolahcanggih.com', 1),
(58, 5, 3, 'PRO-1 SGP www .smknkasomalang.com', '', 650000, '2019-04-19', '2019-05-19', 'www .smknkasomalang.com', 1),
(59, 5, 3, 'PRO-1 SGP www.smkn1cikaum.com', '', 650000, '2019-06-13', '2019-07-13', 'www.smkn1cikaum.com', 1),
(60, 1, 1, 'Personal Junior www.kampreto.com', '', 5000, '2019-06-13', '2019-07-13', 'www.kampreto.com', 2),
(61, 5, 3, 'PRO-1 SGP www.smkn2subang-admin.com', '', 650000, '2019-06-14', '2019-07-14', 'www.smkn2subang-admin.com', 1),
(62, 1, 63, 'Personal Junior Arbuset.com', '', 15000, '2019-07-20', '2019-10-20', 'Arbuset.com', 2),
(63, 2, 65, 'Personal Senior www.dfbeshop.com', '', 120000, '2019-07-24', '2020-07-24', 'www.dfbeshop.com', 1),
(64, 1, 68, 'Personal Junior VHVHVJ.XJ', '', 15000, '2019-09-21', '2019-12-21', 'VHVHVJ.XJ', 2),
(65, 1, 70, 'Personal Junior mybio.dev', '', 5000, '2019-10-17', '2019-11-17', 'mybio.dev', 2),
(66, 1, 74, 'Personal Junior bitcoin-hunter.com', '', 5000, '2019-12-11', '2020-01-11', 'bitcoin-hunter.com', 2),
(93, 1, 1, 'Personal Junior adrihost.com', '', 5000, '2020-05-11', '2020-06-11', 'adrihost.com', 2),
(94, 1, 1, 'Personal Junior testingajah.com', '', 30000, '2020-06-26', '2020-12-26', 'testingajah.com', 2),
(95, 1, 1, 'Personal Junior adrihost.com', '', 30000, '2020-07-04', '2021-01-04', 'adrihost.com', 2),
(96, 1, 1, 'Personal Junior adrihost.com', '', 5000, '2020-07-04', '2020-08-04', 'adrihost.com', 2),
(97, 1, 82, 'Personal Junior adrahost.com', '', 30000, '2020-12-25', '2021-06-25', 'adrahost.com', 2),
(98, 1, 83, 'Personal Junior adrihost.com', '', 5000, '2020-12-25', '2021-01-25', 'adrihost.com', 2),
(99, 1, 83, 'Personal Junior sumantho.co.id', '', 15000, '2020-12-25', '2021-03-25', 'sumantho.co.id', 2),
(100, 2, 83, 'Personal Senior sokaramae.web.id', '', 120000, '2020-12-25', '2021-12-25', 'sokaramae.web.id', 2),
(101, 1, 83, 'Personal Junior sokarame.com', '', 60000, '2020-12-25', '2021-12-25', 'sokarame.com', 2),
(102, 3, 83, 'Personal Corporate penjahat.top', '', 300000, '2020-12-25', '2021-12-25', 'penjahat.top', 1),
(103, 4, 83, 'Personal Master siliminti.com', '', 120000, '2020-12-25', '2021-03-25', 'siliminti.com', 4);

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

--
-- Dumping data for table `tbinvoice`
--

INSERT INTO `tbinvoice` (`id_invoice`, `id_user`, `id_hosting`, `no_invoice`, `detail_produk`, `due`, `inv_date`, `sub_total`, `diskon_inv`, `pajak_inv`, `total_jumlah`, `status_inv`, `token_inv`) VALUES
(15, 14, 42, 'HPcjN', 'Personal Junior digitapromo.com  -  12 bulan', '2019-01-27', '2019-01-24', 0, 0, 0, 60000, 2, ''),
(18, 15, 45, 'AfQ0n', 'Personal Junior pw  -  1 bulan', '2019-01-27', '2019-01-24', 0, 0, 0, 5000, 2, ''),
(21, 35, 48, 'Rpmem', 'PRO-2 SGP mybeyond.co.id  -  1 tahun', '2018-06-02', '2018-06-01', 0, 0, 0, 1250000, 1, ''),
(22, 35, 49, '6pfRc', 'PRO-1 SGP studentvillage.co.id   -  1 tahun', '2018-07-06', '2018-07-05', 0, 0, 0, 650000, 1, ''),
(34, 49, 52, 'BylIu', 'Personal Junior hunis.com  -  1 bulan', '2019-03-05', '2019-03-02', 0, 0, 0, 5000, 2, ''),
(35, 50, 53, 'w0234', 'Personal Junior ghgsafdsgfhjh.com  -  1 bulan', '2019-03-17', '2019-03-14', 0, 0, 0, 5000, 2, ''),
(37, 55, 55, 'hapn6', 'Personal Senior elkita  -  12 bulan', '2019-04-03', '2019-03-31', 0, 0, 0, 120000, 3, ''),
(38, 3, 56, 'TGg18', 'PRO-1 SGP sditmu.com  -  12 bulan', '2019-04-06', '2020-04-06', 0, 0, 0, 325000, 1, ''),
(39, 3, 57, 'VDymC', 'PRO-1 SGP sekolahcanggih.com  -  12 bulan', '2019-04-14', '2020-04-11', 0, 0, 0, 325000, 1, ''),
(40, 1, 0, 'DYu5R', 'Registrasi domain samantha32.com  1 tahun', '2019-04-17', '2019-04-14', 0, 0, 0, 145000, 1, ''),
(41, 3, 58, 'yuV2x', 'PRO-1 SGP www .smknkasomalang.com  -  1 bulan', '2019-04-22', '2019-04-19', 0, 0, 0, 650000, 1, ''),
(43, 3, 0, 'X08U6', 'Registrasi domain kosnjoy.com  1 tahun', '2019-05-04', '2019-05-01', 0, 0, 0, 145000, 1, ''),
(44, 3, 59, 'aulF8', 'PRO-1 SGP www.smkn1cikaum.com  -  1 bulan', '2019-06-16', '2019-06-13', 0, 0, 0, 650000, 1, ''),
(47, 3, 61, 'GhZWs', 'PRO-1 SGP www.smkn2subang-admin.com  -  1 bulan', '2019-06-17', '2019-06-14', 0, 0, 0, 650000, 1, ''),
(48, 3, 0, 'mJ3E8', 'Registrasi domain smkpgri-subang.com  1 tahun', '2019-07-08', '2019-07-05', 0, 0, 0, 145000, 1, ''),
(49, 63, 62, 'ogQ1z', 'Personal Junior Arbuset.com  -  3 bulan', '2019-07-23', '2019-07-20', 0, 0, 0, 15000, 2, ''),
(50, 65, 63, 'ubTWJ', 'Personal Senior www.dfbeshop.com  -  12 bulan', '2019-07-27', '2019-07-24', 0, 0, 0, 120000, 1, ''),
(51, 3, 0, '3fvcH', 'Registrasi domain ismijaya23.com  1 tahun', '2019-07-28', '2019-07-25', 0, 0, 0, 145000, 2, ''),
(52, 68, 64, '0CgJP', 'Personal Junior VHVHVJ.XJ  -  3 bulan', '2019-09-24', '2019-09-21', 0, 0, 0, 15000, 2, ''),
(53, 70, 65, 'gLbjj', 'Personal Junior mybio.dev  -  1 bulan', '2019-10-20', '2019-10-17', 0, 0, 0, 5000, 2, ''),
(54, 74, 66, 'TTlAc', 'Personal Junior bitcoin-hunter.com  -  1 bulan', '2019-12-14', '2019-12-11', 0, 0, 0, 5000, 3, ''),
(82, 78, 92, 'xu4j6', 'Personal Senior kalem.com  -  12 bulan', '2020-02-19', '2020-02-16', 120000, 189, 0, 119811, 2, ''),
(83, 1, 93, 'kPRJ6', 'Personal Junior adrihost.com  -  1 bulan', '2020-05-14', '2020-05-11', 5000, 184, 0, 4816, 1, ''),
(86, 1, 96, 'QhbEG', 'Personal Junior adrihost.com  -  1 bulan', '2020-07-07', '2020-07-04', 5000, 704, 0, 4296, 2, ''),
(87, 82, 97, 'MQxl6', 'Personal Junior adrahost.com  -  6 bulan', '2020-12-28', '2020-12-25', 30000, 725, 0, 29275, 2, ''),
(88, 83, 98, 'vu3ge', 'Personal Junior adrihost.com  -  1 bulan', '2020-12-28', '2020-12-25', 5000, 508, 0, 4492, 1, ''),
(89, 83, 99, 'P7MIi', 'Personal Junior sumantho.co.id  -  3 bulan', '2020-12-28', '2020-12-25', 15000, 371, 0, 14629, 1, ''),
(90, 83, 100, 'hZxNS', 'Personal Senior sokaramae.web.id  -  12 bulan', '2020-12-28', '2020-12-25', 120000, 165, 0, 119835, 1, ''),
(91, 83, 101, 'zLtbY', 'Personal Junior sokarame.com  -  12 bulan', '2020-12-28', '2020-12-25', 60000, 795, 0, 59205, 1, ''),
(92, 83, 102, 'ZH8tW', 'Personal Corporate penjahat.top  -  12 bulan', '2020-12-28', '2020-12-25', 300000, 803, 0, 299197, 1, ''),
(93, 83, 103, 'n8AGV', 'Personal Master siliminti.com  -  3 bulan', '2020-12-28', '2020-12-25', 120000, 842, 0, 119158, 2, '');

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
  `bandwith` varchar(20) NOT NULL,
  `addon_domain` varchar(20) NOT NULL,
  `email_account` varchar(20) NOT NULL,
  `database_account` varchar(10) NOT NULL,
  `ftp_account` varchar(20) NOT NULL,
  `siklus` int(11) NOT NULL,
  `pilihan_1` varchar(20) NOT NULL,
  `pilihan_2` varchar(20) NOT NULL,
  `pilihan_3` varchar(20) NOT NULL,
  `pilihan_4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbproduct`
--

INSERT INTO `tbproduct` (`id_product`, `nama_product`, `type_product`, `harga`, `kapasitas`, `bandwith`, `addon_domain`, `email_account`, `database_account`, `ftp_account`, `siklus`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`) VALUES
(1, 'Personal Junior', 1, 5000, '500 mb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(2, 'Personal Senior', 1, 10000, '1 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(3, 'Personal Corporate', 1, 25000, '2 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, 'CageFS', 'Support 24 Jam', '', ''),
(4, 'Personal Master', 1, 40000, '3 Gb', 'unlimited', '5', 'unlimited', 'unlimited', '5', 12, 'CageFS', 'Support 24 Jam', '', ''),
(5, 'PRO-1 SGP', 2, 650000, '5 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', ''),
(6, 'PRO-2 SGP', 2, 1250000, '10 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', ''),
(7, 'PRO-3 SGP', 2, 2400000, '20 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', 'CageFS', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsetting`
--

CREATE TABLE `tbsetting` (
  `id_setting` int(11) NOT NULL,
  `nama_hosting` varchar(10) NOT NULL,
  `alamat_hosting` varchar(100) NOT NULL,
  `email_hosting` varchar(100) NOT NULL,
  `telp_hosting` varchar(30) NOT NULL,
  `tax` int(11) NOT NULL,
  `limit_email` int(11) NOT NULL,
  `api_key` varchar(128) NOT NULL,
  `nama_bank` varchar(80) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama_pemilik` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbsetting`
--

INSERT INTO `tbsetting` (`id_setting`, `nama_hosting`, `alamat_hosting`, `email_hosting`, `telp_hosting`, `tax`, `limit_email`, `api_key`, `nama_bank`, `no_rekening`, `nama_pemilik`) VALUES
(1, 'AdriHost', 'Jl.Bendungan Wayngison No.237 Bandarlampung', 'support@adrihost.com', '0856-0201-3002', 10, 1, 'at_YJfP2jvzKqhB1chsVi5dhBCnclRS7', 'BCA KCU PRINGSEWU', '844-525-0712', 'VERONICA MAYA SANTI');

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
(2, 'net', 145000, 1, 2),
(3, 'web.id', 55000, 1, 2),
(4, 'xyz', 35000, 1, 2),
(5, 'top', 35000, 1, 2),
(6, 'net', 155000, 1, 2),
(7, 'co.id', 260000, 1, 2);

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
(1, 0, '36871ea3e4518004acb378fbd5990ea4870f7d21', 1550535401),
(2, 0, 'e1f683ace04e6c288051db1d5a38b9431595ab6a', 1550605652),
(3, 0, '9c71bb8981869bf7098018d896959e3504d8efae', 1550618828),
(4, 1, 'abfc1a107b80e0ac980668c4b09b30dbaa941630', 1550622594),
(5, 1, 'ba8618ade3999b6b1c6a77e5608453857ef08ece', 1550622677),
(6, 0, 'e737e23045ddf14efde54f8af6ccd8672dc77dbc', 1550622787),
(7, 1, '27264705658db0f0e4e970488f23ea42b8ea087d', 1550919226),
(8, 1, '8e3acb9b54aa52504f38ee72d0c78f618fa12b19', 1550919240),
(9, 1, '34b06f249ab59e634c64be575005d36364578212', 1551134109),
(10, 1, '84e28910f3fc0f1470f4466609910cfabc5c7dca', 1551144578),
(11, 1, '64641e2499cb87d7bf3d27d10e6d67611cc7ea20', 1551146782),
(12, 1, 'a36d36467c20cf60512c6f0da4c25688d1b1e94f', 1551150068),
(13, 1, 'a699e8574ad632320fe10c61b1cb83e5ef31780a', 1551207171),
(14, 1, '708880f89f0f8bbc6c059788450920140d54766d', 1551312676),
(15, 36, 'd17a1c23d859d608a4d68e5cd4035a204f7c60bd', 1551313561),
(16, 1, '9799c89640b5bc2efad6ca6fa3721d20de9bf45e', 1551313579),
(17, 1, '498735965fd5adf7ea7dc537d3051dbcca2b6140', 1551317331),
(18, 0, '787f9a72e60824202c606df149006bb466fd4b3b', 1551320343),
(19, 1, 'd9afdd421172b4ed2d1f8b84a15d3f3e770bdfdc', 1551320360),
(20, 1, '206a318fa46213af0c793d5f90ce765eb532eec1', 1551331301),
(21, 1, 'f5456df7f10a686b42427b8a6ef9934fff8cb811', 1551334682),
(22, 1, '267846d1159330f66420dac555e138cd514fcefd', 1551338718),
(23, 1, 'c4d1d1707d69abf16558edb2c19af7208e0bb076', 1551343617),
(24, 1, 'e3387e16773e0ed5f94edff4c0729cd82cfcf77d', 1551347796),
(25, 1, '34d032da14d8c5a4251f4a9549e87a5e58261945', 1551348030),
(26, 1, 'c226386b2ff393b5daba05da0b80c7144e02aac7', 1551348107),
(27, 1, '77893e16de2dba9a1b3cd9e05156026e67376c20', 1551348197),
(28, 1, '6c965f65e5eda2716d7b243dfc01195a29a78b87', 1551348250),
(29, 1, 'c8ff9daa24a00c29692d996bc3d6b57c0e1f25d6', 1551348322),
(30, 1, '8b81716255ce8c6fef82e975a7beaaf4fd7fb984', 1551426349),
(31, 49, '923a32f78468f7994e5e6e258639c6f0e1e6cb67', 1551536393),
(32, 49, '5dcaa53216fef43cf1d425d06acbf8a15be57870', 1551536424),
(33, 0, '0d2d847c7dd76d0788f81ea73035e29fc34d70f3', 1551654082),
(34, 1, 'b08a399ae04a1f577d593bd19f617448408e1265', 1551654490),
(35, 0, '32013379eb8ffcf553a389dacd1da4bc8ecd5fd4', 1552297730),
(36, 50, 'f24b7b7e5b029bf42bd542532438f2dfc7284a22', 1552545762),
(37, 52, '8d34bbe5cf4001c2b3f3de51acc563d173dbb68a', 1553405000),
(38, 0, '286e1842bb6a5f3c15f215d113061a9b5f390c53', 1553406469),
(39, 52, '48cdc23806279d7f01a21480e55820adbd959237', 1553406551),
(40, 54, 'b0d93be09c8f921055454e0e924161961f54697c', 1553730130),
(41, 55, '5e348d3ff270c9bb9a78789109e0db49a5b88616', 1554027617),
(42, 3, 'f95a9dd45bc2235d5c7299bf5da92d6ba07b3abf', 1554094559),
(43, 3, 'e106ed1cd82e79c20aa19690b8bd9cc2e631b9ce', 1554181008),
(44, 3, 'e106ed1cd82e79c20aa19690b8bd9cc2e631b9ce', 1554181008),
(45, 52, 'f94f0e10ca881e6c6b6c632ff7a8d1db07fb6ffd', 1554254984),
(46, 1, '6b7a0210315066569aaf58074a64813ad74850de', 1554255015),
(47, 1, '615c9970a5aefc4e673809ce08ec7961c2ef1b29', 1554553369),
(48, 1, '48ea25eb8c98b74ab9f7884d059ab8f9f4cd83a3', 1554553607),
(49, 1, '03d90521a53e8cf8912f3f58aff45bf0226a59b9', 1554560991),
(50, 1, '5bd709cd59c7849ecf2262eabf3224ccdb4a7345', 1554561007),
(51, 1, '15e42fd0cc19c5789e7e5d3536d5a289ca5694d6', 1554566590),
(52, 1, '6d831857bfdd80d565a0ad8193e412451791ff93', 1554566614),
(53, 1, 'e81c796a3a7b8ff6d2c542e5e9bf7294193974c5', 1554636200),
(54, 0, '960ec02f13aa78775f177a4e7d279a1adf3934af', 1554640318),
(55, 1, 'd2fc8c368c2a97494212a903939de6d903e4828e', 1554799974),
(56, 55, 'fc665cbb0b2963a1ea643d158436de2b68922dd5', 1554978719),
(57, 3, '17670b87302f1b06ebae13471f0c2d22e86b4a74', 1554978804),
(58, 0, '1fcf7185b0afdf250e392d8ab08b45bb1be59943', 1555168583),
(59, 52, '794cebd8169afcf2c56e9571434112fe5a11b15f', 1555172404),
(60, 52, '8d53fc93879d58e17f396b2083a29c6320f75ccc', 1555219365),
(61, 0, 'f91dd7fc6c71fc08aba050ed92473b2534cab578', 1555224778),
(62, 1, '10bfb1f13f6b548439a5d1b6d38639635e207716', 1555226159),
(63, 55, 'b85d5cdfd5d3b62f8ad959ab798ad48a5dcfa02f', 1555415789),
(64, 3, '065d1601fb07d378ae975fd515db69a8901615ff', 1555671792),
(65, 1, '1b8cf20bf13d3de63ade8c24c9992b052a705ec0', 1555758435),
(66, 1, 'a4dd0f5b86b1ad34a62feb9dd83d33493451d418', 1555767188),
(67, 1, '5e2c97e2fdd9e899ef40272602cbf486953404c2', 1555775689),
(68, 1, '8c03f1a3819d32cee4e76079286162c06971a868', 1555894443),
(69, 0, '53b83162758d42c48203ef1edd3c9eee91b2a94c', 1555905044),
(70, 3, '3c3b5ee5fb8795d776a7203a6997b1121369d24c', 1555905086),
(71, 1, '80eaa4de1a24993d2227d6ad3d103c93035ccec3', 1556019722),
(72, 3, '09c4695d7e5a535c91613d0a9b1e1321588b65b2', 1556676909),
(73, 56, '138ed306fa901c358a99071d2162476cdc383f2e', 1556789865),
(74, 58, '9240213b298642d2ac06cb956d2fc43bd63c76f1', 1557776455),
(75, 58, 'b3fdc1b90aa6ce32a3dd54e8b91fe631f7c5b434', 1557776461),
(76, 59, '91b518f838cbfa449f1f03608979abb34dbd8be2', 1557917999),
(77, 1, '81c8c965524612e31514c2c4e2a7c8fa5c8e05e7', 1558614712),
(78, 1, 'dc535b0259ade27eac0f0864c05e0dfe03945ce7', 1559315655),
(79, 1, '3654821c6056f5348c58d1d30ea98f80f9de9c0e', 1559316136),
(80, 1, '7a162ebc854d776e93e94513c2c60102f99f0617', 1559316855),
(81, 1, '72c1b2c49ef35d1f8ff97c6784b7dea73d7bf04d', 1559452364),
(82, 1, '3e0c5de65f00e89c2f7947f5873ed0bb2dfc70bc', 1559452432),
(83, 1, '25b661433584ed7c4a1ca10a6e96d03f409c631f', 1559452476),
(84, 3, '65366eae37238591f2196abe304beba7ca795194', 1559452644),
(85, 1, '01e57a2895a06f76845a9102d87deead94a25636', 1559845317),
(86, 1, '46aaa718f83ea759d6c93426cc589a02c46f0ec5', 1559851153),
(87, 1, 'f1f93fa96ce6ac5119e523b3fb57552375dda58a', 1559918256),
(88, 0, '4e058cd84f52fe208bf3b8c42c3c7b4ff9c9ae89', 1559928992),
(89, 60, 'd068431a8603793c17cb945af3502ddf3cd30e63', 1559997686),
(90, 0, 'a9284ac93bd6b91b669dbfc61be1aad272a21a57', 1560075655),
(91, 0, 'f682367b85bbad5d6ac10922bc20e6fbff60b4c3', 1560076678),
(92, 0, '7c1227c8aafdd29416e1d419e97e6bd232bc8738', 1560085546),
(93, 1, '6e6ff7fb9b0ff8d7660cf56647b745865d9bb9a9', 1560098208),
(94, 1, '88f9d85b5c6a62b02931fd8e797081b67096859f', 1560098473),
(95, 1, '9f375c1eb2b3e65ed75a1cd943239d5d82283eb4', 1560098517),
(96, 0, '1da49e5373762ba257f99d629dda5469bbdfbead', 1560343713),
(97, 3, 'f33257b3bf88c7a169c276205be81c09bb58ef7f', 1560439727),
(98, 0, 'c79eae632006ffd4be4b411db0207e52077f66ef', 1560440775),
(99, 3, 'abff0e623e18ba0815520b2825af7fdb1c243d4d', 1560442107),
(100, 1, 'e438c879f255ac973f5326e7f8e2382638f759a6', 1560442764),
(101, 3, 'bc1929e1a81f27bf1a9cc75882e725ae7d4ef919', 1560508902),
(102, 0, '1f641c7013be798ad7d29e87452081b6f062b31e', 1560510656),
(103, 61, '3f58e3f0a01ac8ff18ab5d758d16e20273b527f2', 1561358172),
(104, 1, '84adb30b51a2091ba0041734351e81e734e3e7f6', 1562206505),
(105, 3, '5a82c0e37a3d69ff98fe65924b70cc64626ac360', 1562295359),
(106, 3, '6876227f714fc2ee9c61bfa592d85ad6afdce8f7', 1562295618),
(107, 1, 'd183257f210ccfc56663e3374ccff48f36303830', 1562311568),
(108, 0, '632edfae0c6532d2564e72b5b7d04c63b5a9a08f', 1562827062),
(109, 1, '2843385ce97e9e1e7c466717f038ad001e2220c7', 1562827142),
(110, 0, '8ca3c65da05c14933c03222d09f135fe05a0edde', 1562827625),
(111, 0, 'ab5ddf710827b3ca8894fd4bf271065952cc4b98', 1562835313),
(112, 62, '075144b33308008b7a3cf2f3875bb88e31cc5306', 1563180446),
(113, 63, 'c5982adfe78afbb7fbd944b977f7595615997d64', 1563599761),
(114, 65, 'f4b177311c345f70be183bb45e8ac97b1d37cfc5', 1563925917),
(115, 3, '7d6b54a476eb8b51d91857bd837f473133118ac2', 1563961252),
(116, 3, '3106fb5a0c815635ef952f062f46325c644223ae', 1564053662),
(117, 3, 'd5e9e6c4b00e2a0de1a53ba1f9d6524dab4528d4', 1564054295),
(118, 55, '37f8b7b563171c335463bae6ebee4fa9cb6cb908', 1564231029),
(119, 66, '6357cb38d9264a4a91ec777e327ffbd3cadf23c1', 1565022122),
(120, 67, 'a8f5937edd808741e99859f7bb2c8560f1377802', 1565754732),
(121, 0, '0ee659c6a8ce34439e657958815dc52cf5bd9abd', 1566503205),
(122, 67, '12adb27ece61ce45241dbfdee1420575b518e905', 1566795145),
(123, 67, '4b4a84c00c7174f7190a2f4a5f4578afd691f1f7', 1566800123),
(124, 67, '6ef4c38869d872d9b7721aff558c567afd9fe18d', 1566833485),
(125, 0, 'a04fdd713c8b866267270a45695f20e161f540f4', 1567847065),
(126, 68, '18a22b104699be82ba9e1dd97648e6d1b391d666', 1569036926),
(127, 69, '135a4b6e14753685add9c5645848b4344858fb00', 1571060340),
(128, 70, '335f7c64c96922b79a0b743406dfef362e7d771a', 1571315004),
(129, 71, 'd2e9a9903a90c607d451f38d3d1e8734e333f780', 1572183903),
(130, 72, '470863429a83b49cee222bd23194753cf643495c', 1572320936),
(131, 73, '050b752f93b23ae286e795e5ad5dda4710bd45f0', 1573649133),
(132, 74, '38bcce3fe19226cb519ae44f21378bf3524a0a9a', 1576001041),
(133, 75, 'c6b9f11c24787edd21a9f006b9de812bbdf0d8fe', 1576333091),
(134, 75, '397f62fb457f80aaf405bb20fc2e3f5de09c9e5a', 1576333183),
(135, 76, 'a5f353d02020668051042f776d5a1d59ba9ab3d9', 1577856824),
(136, 77, '2e3d907f3d3435fd209897f927f79b1d58d80248', 1577975614),
(137, 0, 'f6679b156242dcec6e4b6162e66c3089ed3c06fb', 1580746938),
(138, 1, '975dec5cc88a21f7ffa97d5471f2d2dc262ef62c', 1581152200),
(139, 0, 'ff524e43207461e4f53f389ffcdeacd6b5009ddf', 1581152265),
(140, 0, '09e2e0ffc399231e40e5483b2d5dffc3b4454132', 1581152293),
(141, 1, 'b2441ec016bc8221f03b8a9b617acf028e211944', 1581152503),
(142, 1, '86ee63d38dc551e418034c854acca809ec83f820', 1581152846),
(143, 1, '8677f743149a352f475943141c39af1392ef809a', 1581152904),
(144, 1, '35872ba3ea262006388f24e5a49e740d11970c59', 1581153082),
(145, 1, '899049e265457b05edba40844c41e80aabbaa1ea', 1581155311),
(146, 1, 'b8d0580d10851f56414ec9c4afeb8f2519d96162', 1581157827),
(147, 1, 'df1b0660216686fc38c8955e73df9c5446c8555f', 1581158370),
(148, 1, '367fdbc4d7a0303289ec6dbb13a7eb86dbe94ab4', 1581158417),
(149, 1, 'a0cdb095ba4a3a610a222afc2adb2d13b3b0289e', 1581158429),
(150, 1, 'af8b20e7b979630894d8ed5d9e95ac2d4212c06e', 1581159507),
(151, 1, 'bcb1fee6f952e17067b5549db97028d26fc430be', 1581168248),
(152, 1, '9e45f33c1ee64cbc637d9d5b4abde32e36310899', 1581169722),
(153, 1, 'cdfb09cf031f3441211587bce1eca9e8e9a3249a', 1581170382),
(154, 1, '784ab59ebaa9dd6d1188d4e0dd03e64b6b15a2ab', 1581170486),
(155, 1, 'd29716f78862ed93354b561804e7fe2ac1431c3e', 1581170838),
(156, 78, '839a7259000a914b344fa745e163d97c9a2e16da', 1581430458),
(157, 78, '5fe78041a0b2f22365b840962cd4aa896f368a62', 1581431408),
(158, 78, 'cabdae939e5d6f36e0ec90efa38fd7af030fe449', 1581431845),
(159, 78, '6271704577bfe0f38197f3783f158002de52c9a8', 1581432355),
(160, 78, '745c5d176aa48346974af1a631d73ad70f6ba25a', 1581432376),
(161, 78, '9b4641a072d9027e315518b9f658dd2ff8749604', 1581433000),
(162, 81, '83ef8b79b1efc89f6666db25e98268901bffaf18', 1581435777),
(163, 78, '2f918bccaaaa5472e7f488d7536fc2386a03dd79', 1581437387),
(164, 1, '6fad872a24289d65f459071ebba077812fccf275', 1581454213),
(165, 1, 'fbd04fe2bbc8065839e3b8b0c582c2f0ed242e34', 1581454476),
(166, 1, '8d84feeb234851ed50ec418d43d22a4204aad479', 1581460028),
(167, 1, 'ea27b2e969788de0a78fac815752cb8318ea49e0', 1581461007),
(168, 1, '306b16caebf0b357f5e21d7ecdadf7f4403d691c', 1581461417),
(169, 1, '678c2f1789ff5ce461f926d0f81813584a50aac7', 1581462507),
(170, 78, '98fd77420126845d393de8bd18b0c5c0b04c0001', 1581488802),
(171, 78, '49989171211d778ec13969933748c70ff16c9761', 1581489161),
(172, 78, '0f5d7ac1682e40063e029199f0a031ce1fe0bb74', 1581524898),
(173, 1, '75ec5e1f63e6f7896a85644b25f4b51926a22efe', 1581524967),
(174, 78, '404404fd5cd66bdb9a2dd7ad17d16fbfbb6da318', 1581525363),
(175, 78, 'b69b64c83a07d4fedac6c39b4f8322c07a8eba9d', 1581526445),
(176, 1, 'a6f68e40c7419e6afda3ecdc3c1934129dbeeeb6', 1581526469),
(177, 78, '400ea6d35bad43acd2c73b004b67d2256502e341', 1581526807),
(178, 1, '8b8e088ac470fc784999b722365574221ddb9336', 1581542271),
(179, 78, '7595a874ba32b3b3bd60198924a236840641e5d6', 1581543070),
(180, 78, '5607f65ec186cb95383aeeb5f66dab85c48e1112', 1581543314),
(181, 1, 'e648c4ea3c868e3866296bc0ddced5e2bee593b3', 1581543382),
(182, 1, 'ea6439d69bdb383fc8113a95d6296adb11ac62fa', 1581543425),
(183, 78, '8147ad278fccde72ef3b350da1cdf6ed017baabe', 1581546222),
(184, 78, '9d9c23e1e4468a4121a515405060016424610583', 1581550395),
(185, 78, '26b03fd2bef1ba191c14942536966743dfb5256a', 1581550432),
(186, 78, 'ed910c578db13b60bb38f3d86b0cf179724604e5', 1581597821),
(187, 78, 'e9987b93b9a45fe5b85d7f98230357c2cdfe07a7', 1581608992),
(188, 78, '59cdfd776b2c92dc2d2a6cbbb8a6053107718896', 1581631867),
(189, 78, '571b5f9e3d8ba710cabdf2d01ebd36f0437efb06', 1581632297),
(190, 78, '22c481efc56c6a1f534c89ab2334be348215b9b7', 1581681562),
(191, 78, '457d05a76ca3dbc276f2fba02b5b866dad701be5', 1581683443),
(192, 78, '2bf37028d5230b2b3c33a52101cd62cebfb18668', 1581683462),
(193, 78, 'a4a1810ac4f918be009445b4ba2d864a2433afa8', 1581703878),
(194, 78, '60a3dc9ea40e9e7b3dad3c740f1229f66a171df3', 1581704114),
(195, 78, '95b10a77de250494ab73da3f31ca2855110ea492', 1581713846),
(196, 78, '4f93632a67b448264cece76372effb7d46a7dead', 1581716444),
(197, 78, 'e1d981fa56f23399da63b2d5115674d31db544c0', 1581757165),
(198, 78, '59fd2eb9c435f046bf4aa6a26ff772ee831a2259', 1581762171),
(199, 78, '0e6217aa3c234c3135ca05c03e82574325b9d7af', 1581793579),
(200, 1, 'cea5dd822f8c3af4343bf67edd7ee98d9c740f19', 1581795334),
(201, 78, '73ac330ecbdc9378450c8e0a00bb33674e9d2325', 1581795583),
(202, 78, '853c7141bd3c416b5c44f0c3ac9010b0f0b79ec0', 1581797718),
(203, 78, '1db0244db4e234010d59ad5f189287514f5d0402', 1581805348),
(204, 78, '12507dde8065f59a618e3f1ae7445caa6fe57b98', 1581805950),
(205, 78, 'bd0de96ef02e7428b7d6e856ace5b5dbb8bd82b0', 1581806127),
(206, 1, 'cd2821f22c649fdea9e2163ce399340f97679597', 1581806372),
(207, 1, '75b8cfc2b63be95b6b3b5b0ac1518a5d13e63ecf', 1581806401),
(208, 1, '1eb1de50c8f3b84501642f72571436cbe502ae31', 1581806720),
(209, 1, 'cbbd063f2f9fc896f425771480089c975b80f336', 1581807131),
(210, 1, '8ef59b01faa18527de30cf15405129e1fc1d4b63', 1581807417),
(211, 1, '563671257a725579dc95f5a66d337f426cf34fb4', 1581807934),
(212, 78, '764bb65a7c30a2597a93b5c19422549d6fd96d3f', 1581841810),
(213, 1, '3b5fcc1d03da49f85779349c4dcb99a401c161c8', 1581842488),
(214, 78, '83ee473b91645ecb5e792e065768748609a71ad0', 1581880437),
(215, 78, '129c85190c0ec0d9c61ae2d3802b9627de92c18f', 1581881224),
(216, 1, '4ff5b3cc890221639753723a988a6a20b4491102', 1581881255),
(217, 78, '552c7442da8e8bcbb9ec56ebc0f396b31db75076', 1581881390),
(218, 1, '5b1eb890b9d99cfda893421479f38abc84bba009', 1581885960),
(219, 1, '3ffb792528f6e4456eef2a3bfcd052afe0e1aca9', 1581888177),
(220, 78, '8b41d844fa9f95ce31f25c6343aeb8ba4202ff5d', 1581889097),
(221, 1, '3f6c364c3c886623cdbdf857cc6d395c46f55f67', 1581891656),
(222, 1, '8b1e617c375e56cbfb79c4426998f67f1a4f6a38', 1581895191),
(223, 1, '88ac5ce98d84a12d6001aa8db86484cdd90e4f87', 1581897282),
(224, 1, '90397124468f4bb2af706c77457db158c9d3492b', 1581897409),
(225, 78, 'ff4b032d3bc8838a05adca01c64a01fb912eefe3', 1581903347),
(226, 1, '8a900406525d95c0c34f573a659a0568d883ef0a', 1581910597),
(227, 1, 'd9317439810a592293e146a6dec7c97617f49e85', 1581911205),
(228, 1, '4075197797f3dc9245a090a58869bb2cb89fdda5', 1581912054),
(229, 78, '29922a221069a126b3420619d8274f0b3f11e4cd', 1581933114),
(230, 78, 'd5bcf343ed2865e1336c6152bdae4dc4d4e1e0a3', 1581933420),
(231, 78, 'f389281f1490738f9fd7b207ce0f4cf5872f30ea', 1581933589),
(232, 78, '9b131f464af25dc5633257ec383e3e603b3f3a50', 1581935523),
(233, 1, 'fbfc7008792d7f4abcb96c1b2cf07edfe399dd26', 1581935575),
(234, 1, 'cd993c32f6bc4c11abaee604ff59863efd81f1bb', 1581947403),
(235, 78, '3b86d205e9d2b2e3c00238c24982abf5baf72bd6', 1581951193),
(236, 1, 'fb698106195180d1eefc28421a5f5bc989d219b9', 1581951620),
(237, 1, '13283891dfccc3dec80c488c14929200f52bbf4e', 1584257588),
(238, 1, 'ebb7425276421d2d02b54e95dc7321563560479f', 1584275038),
(239, 1, '52d3f6940bbf18191279087ba7bd9fb3ff6eb9ad', 1589175180),
(240, 1, '92009ecf65b6fd18b505b70ccd66cca8110085e2', 1589176060),
(241, 1, '540d973c8027401f4929eb91ae4f27673a6c6a5f', 1592324323),
(242, 1, '0b537d202b71066544b3bf9563ec7630b405cfae', 1593208219),
(243, 1, '0b5b68a5df79270cb91442a2b1a9844bd86cc032', 1593839348),
(244, 1, '74f08dc32d86839afa3ebd4a28926ee8ecf8c245', 1608804052),
(245, 82, 'c1a066537c59e71e2320529280be9816b615c6d3', 1608857951),
(246, 82, '4c5ce3e658b83cfa140df3dce8f5745a01c4f262', 1608859127),
(247, 83, '45fe743701b16cba36bcb866bcac13e41845002b', 1608860132),
(248, 83, '8edb30b0018105181a0a098dd14afc1407c40845', 1608860216),
(249, 82, '6f014bdca5b55cc27626a33cd17a7a85963c6b1d', 1608882679),
(250, 83, 'c5497771b0927db3652958e4698a6020ea91b164', 1608893297),
(251, 83, '937f6f11406023f0b44de606dea8edb764e4e003', 1608941701),
(252, 0, '0aa161dd45671b8e301df5e1888a1d5c9da8f7f6', 1608948504),
(253, 0, '3264aac05312af8e729bfd34170e954eee10179a', 1608948822),
(254, 0, '085a5d52242fee425f2410e4536a3593fb487970', 1609031585),
(255, 0, '37d2743b44972e834941845a6a8dd4ee26bc2875', 1609049599),
(256, 0, 'cda92fbf2b08d9d2b65a1c20c22b977231a721c5', 1609120059),
(257, 0, '0fde46be5354dcca861b256ae601f020d91ab331', 1609124522),
(258, 0, 'e23926ddc7342683de8449152c6e69a61650617f', 1609480497),
(259, 0, '8bc43e9b5a0f61090c99f9ee41c801dfc995e034', 1609480793),
(260, 0, '742eddf594639a5e84cf130f81d1fe5092a36b40', 1609480880),
(261, 0, '4a933355c39be469d8a0defd8c7fcb187d137740', 1609481335),
(262, 0, '3ad84410110aa0b9734fc4d37f7c02b29183d772', 1609481819),
(263, 0, 'c118ab14265c51937bebc82cfed12728ddfcd675', 1609657441),
(264, 0, '671d5d2341f7103c101c233d108c5d0a7ecce5da', 1609707115),
(265, 0, '2fb45266527b43ebafcf49388cf31eafdab1e1ef', 1609707563),
(266, 83, 'f34d87c738b4c6c45077b6486cd0bbe80e703875', 1609707767),
(267, 0, 'f17e104ef1ca7e641b59250e66bbe6a9fc1e3d8b', 1609707794),
(268, 0, '6c2fea744d0e5cd5f372fd694aba375d323cb162', 1609832790);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `ip` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `time_req` int(11) NOT NULL,
  `token_req` varchar(100) NOT NULL,
  `timepin` int(11) NOT NULL,
  `sec_pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `password`, `email`, `date_create`, `ip`, `status`, `time_req`, `token_req`, `timepin`, `sec_pin`) VALUES
(1, 'alexistdev', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'alexistdev@gmail.com', '2018-12-26', '', 2, 0, '', 1560100016, '8e09198a654ea5a8d936e6db6bc02aa307f76ad6'),
(3, 'cepicahyana', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cahyanacepi@gmail.com', '2018-12-29', '', 2, 0, '', 1564055500, '275ca1c1b6f73abb5e67f61c11ef17c5620acd07'),
(4, 'apudsuharjo', '86ced6c47f257ca15bbed2a2be48e8c6e18325c4', 'apudsuharjo@gmail.com', '2018-12-30', '', 2, 0, '', 0, ''),
(14, 'veronicamayasanti', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'veronicamayasanti@gmail.com', '2019-01-24', '114.125.248.193', 2, 0, '', 0, ''),
(15, 'demouser', '39babc332b412604066644a894d9f47b8fe2ad42', 'demouser@gmail.com', '2019-01-24', '114.125.247.21', 2, 0, '', 0, ''),
(16, 'alexistgame', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistgame@yahoo.com', '2019-01-24', '182.1.63.29', 2, 0, '', 0, ''),
(17, 'rafaandra92', '3bdf975b73dece32fe3a8800f2ffd588c56a2fd8', 'rafaandra92@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(18, 'tyrsrd', 'd4fffd34a6844511c999a991784ddf1890ddcdd1', 'tyrsrd@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(19, 'cetakkantongkertas', '4a0f8ae0dbc736cb50dc4d1210af24380dba1fb9', 'cetakkantongkertas@yahoo.co.id', '2019-01-27', '', 2, 0, '', 0, ''),
(20, 'dicky', '4a0f8ae0dbc736cb50dc4d1210af24380dba1fb9', 'dickyefrihidayat@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(21, 'yuliakamila57', 'e8c2df648e2633ea53adbfc9384e76032aca2929', 'yuliakamila57@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(22, 'yeniakhirani', 'f7385c2c174346217b5b6c23d15d1bdf152c2b28', 'yeniakhirani@ymail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(23, 'dimar.tourtravel', 'c5a3b476f32d56a2ca6ec09e8a2c6728566573ad', 'dimar.tourtravel@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(24, 'lazycat', '755c17db5068ea627ca2ae158d8ac3c9315c4cbd', 'lazycat.toys@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(25, 'terangcahayabulan', '345172d88bcc9349d5660bb1fdc8a50740e219be', 'terangcahayabulan@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(26, 'farhanponsel05', 'b2ab3815d163f2de2e302c0c469550c8785e6195', 'farhanponsel05@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(27, 'hendranatas', 'f7e3df5fceea94eff5676ceffbd1dd3bcebd8867', 'hendranatas@yahoo.com', '2019-01-27', '', 2, 0, '', 0, ''),
(28, 'dimasprtm50', '51cc8163854e3fed30f764c5c64bc10ab9d36582', 'dimasprtm50@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(29, 'jamiluddin99', '66622277195e751f3976f55a2f4f27599f9cb8b4', 'jamiluddin99@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(30, 'adamrama001', '48a4c3e0194679858eb0f645721e6605f2095df5', 'adamrama001@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(31, 'celvinirianto10', 'b86a822f5bac55f756a4a8e8581e6d3cad79ad79', 'celvinirianto10@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(32, 'ajiedharmawan22', 'ae5b70b1b3288552a6f63ccc90f9ccdd458510bf', 'ajiedharmawan22@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(33, 'ajib19', '327c949f52199a717b7427f063b9c4e93f8118e1', 'muhammad.ajib@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(34, 'rey1006rhea', 'aa8b9727cde3f2b52925620f6182ed9c35991e96', 'rey1006rhea@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(35, 'mybeyondcoid', '5f73e182430e4e927f564dd8f67c2941cc69bdf1', 'mybeyondcoid@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(36, 'wangkywijaya', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'wangkywijaya@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(37, 'cafekliker', '9e4e6578a6faf1c8d602bd94cbd33686137e9de0', 'cafekliker@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(38, 'mkemalarifin', '22057f9873725126e5ffc4a8f89a28724f38d727', 'mkemalarifin@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(39, 'avolksgeist', 'cdf73355207e19a06b3a731bd10cb7b7e56e8f77', 'avolksgeist@yahoo.com', '2019-01-27', '', 2, 0, '', 0, ''),
(40, 'bolangcloth3', '4d1fcca38425e2f046f9b19da2f565cf24a792d0', 'bolangcloth3@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(41, 'martinfames', 'd11c05e299d2139f90e10c645093839c148e2c85', 'martinfames@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(42, 'mainweb', 'd2fa1bf8152e3c893c5a61f796472f096e61ce2e', 'ca.mainweb@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(43, 'npetr768', 'd2fa1bf8152e3c893c5a61f796472f096e61ce2e', 'npetr768@gmail.com', '2019-01-27', '', 2, 0, '', 0, ''),
(44, 'cristianadinugroho', 'd2fa1bf8152e3c893c5a61f796472f096e61ce2e', 'cristianadinugroho@yahoo.co.id', '2019-01-27', '', 2, 0, '', 0, ''),
(45, 'Dieky Mahindra', 'c22f6cdbc464f04ea368e6cce942f885f2a26a0d', 'dikithewadiy@gmali.com', '2019-01-27', '116.206.42.81', 2, 0, '', 0, ''),
(46, 'mckaizu', '8fafede6bb97723ef920914c1ca73b2d6e982d1c', 'mckaizu@gmail.com', '2019-02-10', '175.143.206.156', 2, 0, '', 0, ''),
(47, 'ramli071074', '1d2299c10f802d7111d40f8622426c0a5bf5df04', 'ramli443425@gmail.com', '2019-02-10', '103.44.37.156', 2, 0, '', 0, ''),
(48, 'muktidirtama', 'c8d02650fbb272b2f8a662db41ec1481cadfd728', 'mdganteng1993@gmail.com', '2019-02-12', '116.206.32.47', 2, 0, '', 0, ''),
(49, 'marthunis', '7d874b32d6d47de8af395a23788a3ee2c4e4d598', 'uzumakynagato01@gmail.com', '2019-03-02', '182.1.44.1', 2, 0, '', 0, ''),
(50, 'deaky', '60fdf3c6c1c3eb18c2aec9cf401ff4cad606b9da', 'deaky_hikky@yahoo.com', '2019-03-14', '202.154.57.12', 2, 0, '', 0, ''),
(51, 'aconkroy', 'e710db9040fa4b891876098dd0c1a0db008eb57c', 'aconkroy@gmail.com', '2019-03-16', '36.84.227.239', 2, 0, '', 0, ''),
(52, 'yosepricardo', '89a4b902527ddc0425d0576554316b4943a1807e', 'amaninakun2@gmail.com', '2019-03-24', '36.90.46.211', 2, 0, '', 0, ''),
(53, 'pangestu0765', '01ccf063ca64a922aed189291b902e448546824d', 'anakjateng0765@gmail.com', '2019-03-25', '141.0.9.163', 2, 0, '', 0, ''),
(54, 'azmias26', 'b0c617f6709b10e6986f5fa678f3339a19bdc97f', 'valkryiedua@gmail.com', '2019-03-27', '180.249.38.197', 2, 0, '', 0, ''),
(55, 'ferrydwi', 'd325cc6804f653c2a94793c7412a82df356e0f8d', 'ferrydwi299@gmail.com', '2019-03-31', '36.78.190.238', 2, 0, '', 0, ''),
(56, 'ztero', 'def4fd6c640fa90f4910392538eb4997f64890b6', 'zteroztero@gmail.com', '2019-05-02', '180.241.47.120', 2, 0, '', 0, ''),
(57, 'distytrans', '9b28e509da89e423da78ab65f1aa1b562919209a', 'distytransmalang@gmail.com', '2019-05-07', '172.104.48.28', 2, 0, '', 0, ''),
(58, 'Koirudiak', '797eb2563ea504d8a048539b58be2039b2fdb09c', 'muhammadkoirudiak12081994@gmail.com', '2019-05-13', '110.137.178.44', 2, 0, '', 0, ''),
(59, 'R_Mardani', 'f82b968b2c9be39e02f81e650f52a93469d02fdf', 'rolanmardani5@gmail.com', '2019-05-15', '36.84.226.79', 2, 0, '', 0, ''),
(60, 'rahmat', '9633d91e8dd0a8e1d8ec7997c494aded65a26003', 'hugoscilacap@gmail.com', '2019-06-08', '103.124.137.150', 2, 0, '', 0, ''),
(61, 'Doni1509', '1c1b9e266b93bdc5113891f54269d2d966e5d81b', 'doniwijaya.15@gmail.com', '2019-06-24', '8.37.232.26', 2, 0, '', 0, ''),
(62, 'muhalfzzzz', '65740c94e9f155b7982716678d14d3b454d98e28', 'akowuta@gmail.com', '2019-07-15', '202.152.55.101', 2, 0, '', 0, ''),
(63, 'snovalde', '20d75fe135fc3abc15aee2f6e4657c3107899d6a', 'snovalde@gmail.com', '2019-07-20', '202.67.46.1', 2, 0, '', 0, ''),
(64, 'gunk992', '739b58185d85af08c65f2ac1c78af837017d6c47', 'mohamad.agung6@gmail.com', '2019-07-23', '36.77.157.184', 2, 0, '', 0, ''),
(65, 'dennyprastiawan94', '7c222fb2927d828af22f592134e8932480637c0d', 'dennyprastiawan94@gmail.com', '2019-07-24', '116.206.42.116', 2, 0, '', 0, ''),
(66, 'oemahbadjoe', '372aaf874a7a2b3c5ae8131ffbb5c6c29a6b7ead', 'srikandiofficialstore@gmail.com', '2019-08-05', '103.10.67.149', 2, 0, '', 0, ''),
(67, 'wijaya25', 'a0f18036ab4e2dfa06736b57fb88a5b3e91d24ce', 'gelaruber@gmail.com', '2019-08-14', '36.84.240.87', 2, 0, '', 0, ''),
(68, 'coba', '70e1bfc519ec1fe1f44603a90b60d626fe590172', 'FDHGDHG@GKJHH.VKM', '2019-09-21', '202.67.46.26', 2, 0, '', 0, ''),
(69, 'fbmy77', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'fbmy77@ymail.com', '2019-10-14', '202.62.9.45', 2, 0, '', 0, ''),
(70, 'dhifoaksa', '94b6ed26d1d32a959b8ccb1b1cc07e18a1e49d03', 'dhifo150301@gmail.com', '2019-10-17', '36.69.136.246', 2, 0, '', 0, ''),
(71, 'isepsetiayusup', '91ad5fc82fd0fa0a9776ce75dd8b7ecd6a0a78de', 'isepsetiayusup@gmail.com', '2019-10-27', '36.72.125.61', 2, 0, '', 0, ''),
(72, 'andyka', 'a4ef29eba2705db15b171aeebc39029360f510a8', 'andykabangun@gmail.com', '2019-10-29', '103.242.125.244', 2, 0, '', 0, ''),
(73, 'sicoco', '2251c47f86d54e4293a115b97f08609a22ea15f0', 'globalmltmedia@gmail.com', '2019-11-13', '36.82.98.235', 2, 0, '', 0, ''),
(74, 'frenkigea', '37f0037c3e97af371a64ce2aa3b8a1750b4c42d1', 'frwgea@gmail.com', '2019-12-11', '180.241.44.209', 2, 0, '', 0, ''),
(75, 'pndw', 'b1dd14ec31afb67ed6aa645b168d09b80d37c006', 'dimas@gmail.com', '2019-12-14', '112.215.243.167', 2, 0, '', 0, ''),
(76, 'Indihome1234', 'fcff49aa5b166c61a16f6c657808f8fd03fc20fb', 'radit01082000@gmail.com', '2020-01-01', '140.213.57.20', 2, 0, '', 0, ''),
(77, 'Hafidz', '9d0b75acf788d762295854144b8f92b488876219', 'dropshipayid@gmail.com', '2020-01-02', '114.79.55.47', 2, 0, '', 0, ''),
(78, 'alexistdev3', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev3@gmail.com', '2020-02-11', '127.0.0.1', 2, 0, '24f396eccaf92c988a7c0166453a80d8592cafec', 0, ''),
(79, 'alexistdev4', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev4@gmail.com', '2020-02-11', '127.0.0.1', 2, 0, '', 0, ''),
(80, 'alexistdev5', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'alexistdev5@gmail.com', '2020-02-11', '127.0.0.1', 2, 0, '', 0, ''),
(81, '', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev6@gmail.com', '2020-02-11', '127.0.0.1', 2, 0, '', 0, ''),
(82, '', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev8@gmail.com', '2020-12-25', '::1', 2, 0, '', 0, ''),
(83, '', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev9@gmail.com', '2020-12-25', '::1', 2, 0, '', 0, '');

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
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tbdomain`
--
ALTER TABLE `tbdomain`
  ADD PRIMARY KEY (`id_domain`);

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
  ADD PRIMARY KEY (`id_hosting`);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbdomain`
--
ALTER TABLE `tbdomain`
  MODIFY `id_domain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbhosting`
--
ALTER TABLE `tbhosting`
  MODIFY `id_hosting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbinvoice`
--
ALTER TABLE `tbinvoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbsetting`
--
ALTER TABLE `tbsetting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbtld`
--
ALTER TABLE `tbtld`
  MODIFY `id_tld` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbtoken`
--
ALTER TABLE `tbtoken`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
