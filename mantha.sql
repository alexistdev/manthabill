-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2019 at 04:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mantha`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
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

CREATE TABLE IF NOT EXISTS `tbadmin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id_admin`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbberita`
--

CREATE TABLE IF NOT EXISTS `tbberita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tgl_berita` date NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbberita`
--

INSERT INTO `tbberita` (`id_berita`, `judul_berita`, `isi_berita`, `tgl_berita`) VALUES
(1, 'Pembelian hosting', 'Selamat Datang Di Adrihost\r\nHosting Murah untuk kebutuhan website bisnis anda.\r\n\r\nJika anda membutuhkan bantuan bisa kontak di:\r\n0856-0201-3002\r\n\r\nAtau ingin membuat website silahkan kontak:0856-0201-3002\r\n\r\nHormat kami\r\nAdriHost', '2019-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbcategory_config`
--

CREATE TABLE IF NOT EXISTS `tbcategory_config` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `tbconfig_option` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `id_vps` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name_config` varchar(50) NOT NULL,
  `detail_config` varchar(30) NOT NULL,
  `harga_config` int(11) NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `tbdetailuser` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_depan` varchar(20) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `nama_usaha` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `alamat2` varchar(200) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `negara` varchar(30) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `tbdetailuser`
--

INSERT INTO `tbdetailuser` (`id_detail`, `id_user`, `nama_depan`, `nama_belakang`, `nama_usaha`, `alamat`, `alamat2`, `kota`, `provinsi`, `negara`, `kodepos`, `phone`) VALUES
(1, 1, 'Alexsander', 'Hendra Wijaya', 'AdriHosts', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 'Indonesia', '55573', '085602013002'),
(2, 2, 'samantha', 'wijaya', '', 'Jl.Ki Ageng Gribig No 43', 'Klaten', 'Klaten', 'Jawa Tengah', 'Indonesia', '55745', '085702527815'),
(3, 3, 'cepi', 'cahyana', '', 'subang', 'subang', 'subang', 'jawabarat', 'Indonesia', '55570', ''),
(4, 4, '', '', '', '', '', '', '', '', '0', ''),
(8, 8, '', '', '', '', '', '', '', '', '0', ''),
(9, 9, '', '', '', '', '', '', '', '', '0', ''),
(10, 10, '', '', '', '', '', '', '', '', '0', ''),
(11, 11, '', '', '', '', '', '', '', '', '0', ''),
(12, 12, '', '', '', '', '', '', '', '', '0', ''),
(14, 14, '', '', '', '', '', '', '', '', '0', ''),
(15, 15, 'demouser', 'mr', '', '', '', '', '', '', '0', ''),
(16, 16, '', '', '', '', '', '', '', '', '0', ''),
(17, 17, '', '', '', '', '', '', '', '', '0', ''),
(18, 18, '', '', '', '', '', '', '', '', '0', ''),
(19, 19, '', '', '', '', '', '', '', '', '0', ''),
(20, 20, '', '', '', '', '', '', '', '', '0', ''),
(21, 21, '', '', '', '', '', '', '', '', '0', ''),
(22, 22, '', '', '', '', '', '', '', '', '0', ''),
(23, 23, '', '', '', '', '', '', '', '', '0', ''),
(24, 24, '', '', '', '', '', '', '', '', '0', ''),
(25, 25, '', '', '', '', '', '', '', '', '0', ''),
(26, 26, '', '', '', '', '', '', '', '', '0', ''),
(27, 27, '', '', '', '', '', '', '', '', '0', ''),
(28, 28, '', '', '', '', '', '', '', '', '0', ''),
(29, 29, '', '', '', '', '', '', '', '', '0', ''),
(30, 30, '', '', '', '', '', '', '', '', '0', ''),
(31, 31, '', '', '', '', '', '', '', '', '0', ''),
(32, 32, '', '', '', '', '', '', '', '', '0', ''),
(33, 33, '', '', '', '', '', '', '', '', '0', ''),
(34, 34, '', '', '', '', '', '', '', '', '0', ''),
(35, 35, '', '', '', '', '', '', '', '', '0', ''),
(36, 36, '', '', '', '', '', '', '', '', '0', ''),
(37, 37, '', '', '', '', '', '', '', '', '0', ''),
(38, 38, '', '', '', '', '', '', '', '', '0', ''),
(39, 39, '', '', '', '', '', '', '', '', '0', ''),
(40, 40, '', '', '', '', '', '', '', '', '0', ''),
(41, 41, '', '', '', '', '', '', '', '', '0', ''),
(42, 42, '', '', '', '', '', '', '', '', '0', ''),
(43, 43, '', '', '', '', '', '', '', '', '0', ''),
(44, 44, '', '', '', '', '', '', '', '', '0', ''),
(45, 45, '', '', '', '', '', '', '', '', '0', ''),
(46, 46, '', '', '', '', '', '', '', '', '0', ''),
(47, 47, '', '', '', '', '', '', '', '', '0', ''),
(48, 48, '', '', '', '', '', '', '', '', '0', ''),
(49, 49, '', '', '', '', '', '', '', '', '0', ''),
(50, 50, '', '', '', '', '', '', '', '', '0', ''),
(51, 51, '', '', '', '', '', '', '', '', '0', ''),
(52, 52, '', '', '', '', '', '', '', '', '0', ''),
(53, 53, '', '', '', '', '', '', '', '', '0', ''),
(54, 54, '', '', '', '', '', '', '', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbdomain`
--

CREATE TABLE IF NOT EXISTS `tbdomain` (
  `id_domain` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tld` int(11) NOT NULL,
  `nama_domain` varchar(50) NOT NULL,
  `nameserver1` varchar(30) NOT NULL,
  `nameserver2` varchar(30) NOT NULL,
  `nameserver3` varchar(30) NOT NULL,
  `nameserver4` varchar(30) NOT NULL,
  `date_register` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_domain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbdomain`
--

INSERT INTO `tbdomain` (`id_domain`, `id_user`, `id_tld`, `nama_domain`, `nameserver1`, `nameserver2`, `nameserver3`, `nameserver4`, `date_register`, `due_date`, `status`) VALUES
(2, 1, 3, 'samantha32.web.id', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '2019-03-01', '2020-03-01', 2),
(3, 1, 1, 'samantha32.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '2019-04-14', '2020-04-14', 2),
(4, 3, 1, 'kosnjoy.com', 'ns1.domain.com', 'ns2.domain.com', 'ns3.domain.com', 'ns4.domain.com', '2019-05-01', '2020-05-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbdomaintransit`
--

CREATE TABLE IF NOT EXISTS `tbdomaintransit` (
  `id_domtrans` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tld` int(11) NOT NULL,
  `nama_domain` varchar(50) NOT NULL,
  PRIMARY KEY (`id_domtrans`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbdomaintransit`
--

INSERT INTO `tbdomaintransit` (`id_domtrans`, `id_user`, `id_tld`, `nama_domain`) VALUES
(2, 1, 3, 'samantha32'),
(3, 55, 1, 'travelkita'),
(4, 1, 1, 'adrihostt'),
(5, 1, 1, 'ddd'),
(6, 3, 1, 'kosnjoy'),
(7, 3, 1, 'ismajaya'),
(8, 3, 1, 'ismajaya'),
(9, 3, 1, 'ismajaya'),
(10, 3, 1, 'ismajaya');

-- --------------------------------------------------------

--
-- Table structure for table `tbdomainwhois`
--

CREATE TABLE IF NOT EXISTS `tbdomainwhois` (
  `id_domainwhois` int(11) NOT NULL AUTO_INCREMENT,
  `id_domain` int(11) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `alamat1` varchar(100) NOT NULL,
  `alamat2` varchar(100) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `negara` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  PRIMARY KEY (`id_domainwhois`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbdomainwhois`
--

INSERT INTO `tbdomainwhois` (`id_domainwhois`, `id_domain`, `nama_depan`, `nama_belakang`, `alamat1`, `alamat2`, `kota`, `provinsi`, `kodepos`, `negara`, `no_telp`) VALUES
(2, 2, 'Alexsander', 'Hendra Wijaya', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia', '085602013002'),
(3, 3, 'Alexsander', 'Hendra Wijaya', 'Jl.Bendungan Wayngison', 'gang asem', 'Pringsewu', 'Bandarlampung', 55574, 'Indonesia', '085602013002'),
(4, 4, 'cepi', 'cahyana', 'adad', 'adad', 'adad', 'adada', 545454, 'sfsfs', '252525');

-- --------------------------------------------------------

--
-- Table structure for table `tbemail`
--

CREATE TABLE IF NOT EXISTS `tbemail` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `email_pengirim` varchar(50) NOT NULL,
  `email_tujuan` varchar(50) NOT NULL,
  `subyek` varchar(100) NOT NULL,
  `email_pesan` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbhosting`
--

CREATE TABLE IF NOT EXISTS `tbhosting` (
  `id_hosting` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_hosting` varchar(100) NOT NULL,
  `user_cpanel` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `start_hosting` date NOT NULL,
  `end_hosting` date NOT NULL,
  `domain` varchar(50) NOT NULL,
  `status_hosting` int(11) NOT NULL COMMENT '1=aktif , 2=pending,3=suspend,4=terminated',
  PRIMARY KEY (`id_hosting`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `tbhosting`
--

INSERT INTO `tbhosting` (`id_hosting`, `id_product`, `id_user`, `nama_hosting`, `user_cpanel`, `harga`, `start_hosting`, `end_hosting`, `domain`, `status_hosting`) VALUES
(1, 5, 1, 'PRO-1 SGP adrihost.com', '', 2400000, '2018-12-22', '2019-12-22', 'www.adrihost.com', 1),
(2, 6, 3, 'PRO-2 SGP grims.navy', '', 2400000, '2018-05-08', '2019-05-08', 'www.grims.navy', 1),
(3, 2, 4, 'Personal Senior pramukapeduli.or.id', '', 30000, '2018-10-31', '2019-01-31', 'www.pramukapeduli.or.id', 1),
(37, 5, 3, 'PRO-1 SGP dishubambon.com', '', 650000, '2019-01-13', '2020-01-13', 'www.dishubambon.com', 1),
(45, 1, 15, 'Personal Junior pw', '', 5000, '2019-01-24', '2019-02-24', 'anf.pw', 2),
(47, 1, 1, 'Personal Junior digitapromo.com', '', 60000, '2019-01-24', '2020-01-24', 'www.digitapromo.com', 1),
(48, 6, 35, 'PRO-2 SGP mybeyond.co.id', '', 1250000, '2018-06-06', '2019-06-06', 'www.mybeyond.co.id', 1),
(49, 5, 35, 'PRO-1 SGP studentvillage.co.id ', '', 650000, '2018-07-09', '2019-07-09', 'www.studentvillage.co.id ', 1),
(50, 1, 1, 'Personal Junior digitapromo.com', '', 60000, '2019-02-10', '2020-02-10', 'www.digitapromo.com', 1),
(52, 1, 49, 'Personal Junior hunis.com', '', 5000, '2019-03-02', '2019-04-02', 'Marthunis.com', 1),
(55, 2, 55, 'Personal Senior elkita', '', 120000, '2019-03-31', '2020-03-31', 'travelkita', 1),
(56, 5, 3, 'PRO-1 SGP sditmu.com', '', 650000, '2019-04-06', '2020-04-06', 'www.sditmu.com', 3),
(57, 5, 3, 'PRO-1 SGP sekolahcanggih.com', '', 650000, '2019-04-11', '2020-04-11', 'www.sekolahcanggih.com', 3),
(58, 5, 3, 'PRO-1 SGP www .smknkasomalang.com', '', 650000, '2019-04-19', '2020-04-19', 'www.smknkasomalang.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbinvoice`
--

CREATE TABLE IF NOT EXISTS `tbinvoice` (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
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
  `token_inv` varchar(100) NOT NULL,
  PRIMARY KEY (`id_invoice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

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
(39, 3, 57, 'VDymC', 'PRO-1 SGP sekolahcanggih.com  -  12 bulan', '2019-04-14', '2020-04-11', 0, 0, 0, 325000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbkonfirmasi`
--

CREATE TABLE IF NOT EXISTS `tbkonfirmasi` (
  `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `tanggal_konfirmasi` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(9, 37, 55, 'hapn6', '2019-04-11', 120000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblocked`
--

CREATE TABLE IF NOT EXISTS `tblocked` (
  `id_locked` int(11) NOT NULL AUTO_INCREMENT,
  `gagal_pertama` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `durasi_terkunci` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `failed_count` int(11) NOT NULL,
  PRIMARY KEY (`id_locked`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblogmail`
--

CREATE TABLE IF NOT EXISTS `tblogmail` (
  `id_logmail` int(11) NOT NULL AUTO_INCREMENT,
  `email_tujuan` varchar(50) NOT NULL,
  `waktukirim` varchar(50) NOT NULL,
  PRIMARY KEY (`id_logmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

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
(111, 'alexistdev@gmail.com', '1554508800');

-- --------------------------------------------------------

--
-- Table structure for table `tbproduct`
--

CREATE TABLE IF NOT EXISTS `tbproduct` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
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
  `pilihan_4` varchar(20) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbproduct`
--

INSERT INTO `tbproduct` (`id_product`, `nama_product`, `type_product`, `harga`, `kapasitas`, `bandwith`, `addon_domain`, `email_account`, `database_account`, `ftp_account`, `siklus`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`) VALUES
(1, 'Personal Junior', 1, 5000, '500 mb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, '', '', '', ''),
(2, 'Personal Senior', 1, 10000, '1 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, '', '', '', ''),
(3, 'Personal Corporate', 1, 25000, '2 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, '', '', '', ''),
(4, 'Personal Master', 1, 40000, '3 Gb', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 'unlimited', 12, '', '', '', ''),
(5, 'PRO-1 SGP', 2, 650000, '5 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', '', ''),
(6, 'PRO-2 SGP', 2, 1250000, '10 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', '', ''),
(7, 'PRO-3 SGP', 2, 2400000, '20 Gb', 'Unlimited', '', '', '', '', 12, 'Free Domain', 'Premium Support', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsetting`
--

CREATE TABLE IF NOT EXISTS `tbsetting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hosting` varchar(10) NOT NULL,
  `alamat_hosting` varchar(100) NOT NULL,
  `email_hosting` varchar(100) NOT NULL,
  `telp_hosting` varchar(30) NOT NULL,
  `tax` int(11) NOT NULL,
  `limit_email` int(11) NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbsetting`
--

INSERT INTO `tbsetting` (`id_setting`, `nama_hosting`, `alamat_hosting`, `email_hosting`, `telp_hosting`, `tax`, `limit_email`) VALUES
(1, 'AdriHost', 'Jl.Bendungan Wayngison No.237 Bandarlampung', 'support@adrihost.com', '0856-0201-3002', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbtld`
--

CREATE TABLE IF NOT EXISTS `tbtld` (
  `id_tld` int(11) NOT NULL AUTO_INCREMENT,
  `tld` varchar(6) NOT NULL,
  `harga_tld` int(11) NOT NULL,
  `status_tld` int(11) NOT NULL,
  `default` int(11) NOT NULL,
  PRIMARY KEY (`id_tld`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbtld`
--

INSERT INTO `tbtld` (`id_tld`, `tld`, `harga_tld`, `status_tld`, `default`) VALUES
(1, 'com', 145000, 1, 1),
(2, 'net', 145000, 1, 2),
(3, 'web.id', 55000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbtoken`
--

CREATE TABLE IF NOT EXISTS `tbtoken` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

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
(61, 1, '5d0ddc638c6d8f872f7310492c97833e23c81350', 1555224728),
(62, 0, '42130bb38adca4e576faa1de66a2ba05b5ffecdb', 1555224756),
(63, 1, '6f93480f287924e5e34280d83d921fe8a6eb9e6c', 1555224889),
(64, 1, 'a48bdb07089e4c3b4133ca228b33d7b44b1d32ae', 1555561366),
(65, 1, '2ed26ff9bb13fd276497941fb5076a7d129f9167', 1555839460),
(66, 1, '2cd166351428862856e1c12db2983a0bcaece9ca', 1555894658),
(67, 1, 'c6012a3972aa9c02ce11b297e5c08fd8f9bed057', 1555896263),
(68, 1, 'e369af009b0fdff2382f904dbdda9b50d140449f', 1555919509),
(69, 1, '7c97010b0e51e15a7ca0c3f82b734c892d55e0d5', 1556007928),
(70, 0, '5a6ba62c7cb59ad0dd508d4a948a912b3909d057', 1556008537),
(71, 1, 'da0c327ddbb48d096aef7c36141f2906d0ec7441', 1556014716),
(72, 1, '7c18275c77b599f4252c660bf1ac636c44fe2397', 1556427522),
(73, 1, '31ce041ae58a93fd7f84c2acd3f3fc02208188cb', 1556553302),
(74, 1, '905a3daba96ddad79b696d04a656dda95f7f2498', 1556554736),
(75, 1, '717c484538ff2259cfde52424acc712355177221', 1556606180),
(76, 1, '02d5103bae3a7006a81e82f9789238edf7a0d5bb', 1556632973),
(77, 3, 'f9eba3fc3311513871794cfbb7302af2eef4494e', 1556677165),
(78, 1, 'a73ac9b6c365521301e363ca05d3edacb46b6cb5', 1556705616),
(79, 1, 'fe022b3696e5682cc612369ce698e116f1552bdb', 1556710669),
(80, 1, '3ad40a4b3dd72f59ff2adc066b3a7a6af9b22990', 1556716534),
(81, 1, '85af12fc80ac534a6ab8ad79284bd6993b87b623', 1556721840),
(82, 1, '7b5d483aa5a2fcb3fa21837bd1c30f6912a4d839', 1556725669),
(83, 1, '0322fc77cb65ff1d8111047ddbf4df8938c3e806', 1556775564),
(84, 1, '1236231b14585909aff957d980020044fc9ae7ad', 1557548799),
(85, 1, '8f274b4644679d1cd6172d5929e0aaed19e18069', 1558580577),
(86, 1, '1a54bd385b2459265c9b9b7505853cf39a51c84f', 1558600374),
(87, 1, '55a85a9d199308313eef3868a62c4e8c8ca53bef', 1558609738),
(88, 1, 'ab04cf78f859dea5b7b7f9303a0669de98f788fc', 1558610025),
(89, 1, '5011be05a43a55434a483856f07c20254958c8de', 1559045905),
(90, 1, '171f9594030e5c9eb3ac1060e80d3a0baa4e5084', 1559101532),
(91, 1, 'bbfb534710df0d6382e3fbb18474d00da0704ea4', 1559182529),
(92, 1, '3e6e1ac299fc34319a285fae25d998b09e3ba2ae', 1559191111),
(93, 1, '6c6198955684b553f655decfccf9690038596744', 1559275926),
(94, 1, '7ca6b2d7e09ec3e6b21574073b6d6677f36a64df', 1559300033),
(95, 1, 'd072d5da59290ce2fd73f2cbf1d7002870db767c', 1559316291),
(96, 1, 'a7fdc76ba39fd9af8991a11362d3cebd54db0c60', 1559365985),
(97, 1, 'e06b517b3dcdcacbcd1db40ad397832377302c95', 1559383465),
(98, 1, 'b77a743ed7fa1527afcb481c1a96cf554a3dda93', 1559446759),
(99, 1, '48273e2b36041765211afe3aeee30940b3bd6c53', 1559450809),
(100, 1, '3aae7cd2632584a2337b4977a9265e796e240a71', 1559450832),
(101, 1, 'ae5ad58b46ca4d3af04beb251753bfe141f9ef5d', 1559450854),
(102, 1, '20c09032b2685d6f056eb7556cead59094ea9dba', 1559450865),
(103, 1, 'dfdbf4fc22a2dc2d176d64128b748befaa6b0916', 1559450925),
(104, 1, '5d3f9ba4bbc7a59a30b6b2369d56b622989977ed', 1559452005),
(105, 1, 'edcdef0d4627e92a5d9239bbdf65d356ef1a8890', 1559452036),
(106, 1, '493ed2d4f534a328b90af8d299258815d71ad609', 1559452551),
(107, 1, 'bf46d03cff0dd61dfe4228e3cb4423be7cb8e6ab', 1559487020),
(108, 1, '8c32f632b7a66ebd499fd89cfbca5fa1a21aa7e6', 1559531522),
(109, 3, '823c5d85bde45a6e5ba60b6fc62b2a36e4af5659', 1559537668),
(110, 1, '25927211f497ac5a6d88629206da0532a545918d', 1559537708),
(111, 1, '0f46170280725109bac74a74d8048bda46693ff1', 1559623581),
(112, 1, '88969ab0f1d6e8ac3163398822063888af522b06', 1559645889),
(113, 1, '4e3d01c2c1d711465b71f19d086c14a32a4cef67', 1559745125),
(114, 1, 'cd250ee1e387b4019be3a3c4550ab31d6f1327c6', 1559750982),
(115, 1, '087ea9182f80c2f7bfd754ecddd2009bfab5fb6c', 1559838331),
(116, 1, '23a3e8f001c62da2d24c08fe9cac8541f7302d35', 1559840930),
(117, 1, 'f650aef928833f9c8cb43b3ba504182ceee6afaf', 1559917018),
(118, 0, 'c8dfc36208f061e7e30f1a6e28731baeeb27a774', 1559917901),
(119, 0, '08d1f4c46773b78538d0783dcf62cc159914ba21', 1559928730),
(120, 0, 'c527bf1390cba6d3943268de2f384342fe219474', 1559928872),
(121, 1, '4575a3a552f31a5154210a6ac75020758beadd88', 1560075559),
(122, 0, '20467abae3b7f70c7340ca2a4f60788776ed453c', 1560076713),
(123, 1, '67e3970ec40afafcd2053cc8f682c5e6130a31f8', 1560086819),
(124, 0, '349ddf8f54748335bd31f80f92c324e40e0ccc9f', 1560088269),
(125, 0, 'afee52fb23092cf4346d31c0cc4fa38c612fdf48', 1560344522),
(126, 0, '9fd151522b6d7f6b9432d0ad6b95a7304698e9eb', 1560344838),
(127, 0, 'c4046840b55af0aabc771823f83755eddb310162', 1560424022),
(128, 0, '425786e38471d81422018e20a4fd5ac448e8ec5d', 1562827030),
(129, 0, 'd058cdf54e6d40cc4731c0faa0d834e016077004', 1562839192),
(130, 0, 'd4aa1be09a7679a546a8aa3d8864317483959a96', 1562849016),
(131, 0, 'b462704669c25ee4bf1eb4826e46ffbbbdd0bd05', 1562997186),
(132, 1, 'fca391280b04bb5ea864230ec73a26b9801464a0', 1562997942),
(133, 3, '90c88e4bb8f632eaf102772f94b85acfa6c8575f', 1563961767);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE IF NOT EXISTS `tbuser` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_create` date NOT NULL,
  `ip` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `time_req` int(11) NOT NULL,
  `token_req` varchar(100) NOT NULL,
  `timepin` int(11) NOT NULL,
  `sec_pin` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `username`, `password`, `email`, `date_create`, `ip`, `status`, `time_req`, `token_req`, `timepin`, `sec_pin`) VALUES
(1, 'alexistdev', '1bff10ca1e9743c39dc90a14fb165f6b6e9dcb4b', 'alexistdev@gmail.com', '2018-12-26', '', 2, 0, '', 1559403636, '8880eab199b0d3679c8c6df0197cd4e93ba0c1ae'),
(3, 'cepicahyana', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'cahyanacepi@gmail.com', '2018-12-29', '', 2, 0, '', 0, ''),
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
(54, 'azmias26', 'b0c617f6709b10e6986f5fa678f3339a19bdc97f', 'valkryiedua@gmail.com', '2019-03-27', '180.249.38.197', 2, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbvps`
--

CREATE TABLE IF NOT EXISTS `tbvps` (
  `id_vps` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_vps`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `tbvpsservice` (
  `id_vpsservice` int(11) NOT NULL AUTO_INCREMENT,
  `id_vps` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_vpsservice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbvpstransit`
--

CREATE TABLE IF NOT EXISTS `tbvpstransit` (
  `id_vpstransit` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  `nama_variabel` varchar(30) NOT NULL,
  `nilai_variabel` varchar(50) NOT NULL,
  PRIMARY KEY (`id_vpstransit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `subyek` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `timeticket` int(11) NOT NULL,
  `keyticket` varchar(50) NOT NULL,
  `balasan` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_user`, `subyek`, `pesan`, `timeticket`, `keyticket`, `balasan`, `status`) VALUES
(1, 1, 'saya mau bertanya kepada anda anda semua ya pakde.', 'This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 1559845731, '6a8c521897195533333d7103f37d85b5c2a4686c', 0, '1'),
(2, 1, '[Klien]Balasan support ticket.', 'sekarang waktunya makan ya pak bosss.....', 1559850967, '6a8c521897195533333d7103f37d85b5c2a4686c', 1, '1'),
(3, 1, 'mana dimana anak kambing saya', 'anak kambig saya ada di penggorengan...', 1559851034, '13976849a1ea18b7053c9c8689818fcffa8ada01', 0, '3'),
(4, 1, '[Klien]Balasan support ticket.', 'aaaaaaaaaaaaaaaaaa', 1559851926, '13976849a1ea18b7053c9c8689818fcffa8ada01', 1, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
