-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 11:44 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`key`, `value`) VALUES
('resources', '["administrator","user","role","resource"]'),
('resource_role_permissions::administrator::administrator', '["read"]'),
('resource_role_permissions::resource::administrator', '["create","read","update","delete"]'),
('resource_role_permissions::role::administrator', '["create","read","update","delete"]'),
('resource_role_permissions::user::administrator', '["create","read","update","delete"]'),
('roles', '["administrator"]'),
('user_roles::1', '["administrator"]');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status` set('active','not_active','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `nama`, `tanggal_lahir`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'bayu.anggoro.s@mail.ugm.ac.id', 'bayu anggoro sakti', '1995-09-02', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
`captcha_id` bigint(13) NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=748 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(723, 1471487243, '::1', '9083'),
(724, 1471487378, '::1', '2989'),
(725, 1471487412, '::1', '4343'),
(726, 1471487416, '::1', '5686'),
(727, 1471487428, '::1', '125'),
(728, 1471487433, '::1', '5450'),
(729, 1471487455, '::1', '5072'),
(730, 1471487477, '::1', '2240'),
(731, 1471487514, '::1', '8297'),
(732, 1471487515, '::1', '7282'),
(733, 1471487518, '::1', '2706'),
(734, 1471487532, '::1', '2178'),
(735, 1471487535, '::1', '8394'),
(736, 1471487541, '::1', '4742'),
(737, 1471487578, '::1', '8128'),
(738, 1471487599, '::1', '9043'),
(739, 1471487601, '::1', '1705'),
(740, 1471487612, '::1', '8038'),
(741, 1471487663, '::1', '3193'),
(742, 1471487669, '::1', '9545'),
(743, 1471487671, '::1', '6770'),
(744, 1471487681, '::1', '5395'),
(745, 1471487800, '::1', '1576'),
(746, 1471487803, '::1', '5922'),
(747, 1471487811, '::1', '731');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
`id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `qty`) VALUES
(1, 1, 2, 2),
(2, 1, 1, 1),
(3, 2, 24, 2),
(4, 2, 25, 1),
(5, 3, 24, 2),
(6, 3, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
`id_produk` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `deskripsi`, `harga`) VALUES
(1, 'Pizza', 'Ini Deskripsi', 25000),
(2, 'Kentang', 'jlkkl', 50000),
(6, 'dsfsdfsdfsdfs', 'dfsdfsd', 0),
(7, 'asdasd', 'asdasd', 222),
(8, 'sadasd', 'sadasd111', 1),
(9, 'dssfsd', 'fsdfsdf', 222222),
(10, 'dsfsdf', 'dsfsdf', 333),
(11, 'sdfsdf', 'dsfdsf', 111),
(12, 'sadsad', 'adsfadf', 111),
(13, 'bayu', 'hhh', 20002),
(14, 'asdasd', 'sadasd', 22);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total`, `lokasi`, `alamat`, `tanggal`) VALUES
(1, 1, 100000, 'Pati', 'Desa Dengkek', '2016-08-17'),
(2, 1, 540000, '-7.7498852000000005,110.41173040000001', 'Jl. Nusa Indah No.205, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281, Indonesia', '2016-08-18'),
(3, 1, 540000, '-7.7498852000000005,110.41173040000001', 'Jl. Nusa Indah No.205, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281, Indonesia', '2016-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `updatetimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` set('active','pending','not_active','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama`, `tanggal_lahir`, `alamat`, `ip_address`, `updatetimestamp`, `status`) VALUES
(1, 'Bayu.anggoro.s', '40205e15e436cac598108ddedd5a9f3b', 'bayu.anggoro.s@mail.ugm.ac.id', 'Bayu Anggoro Saktii', '1995-09-02', 'Pati', '::1', '2016-08-18 02:56:28', 'active'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'bayu@bayu.com', 'aku', '2016-08-13', 'djjdj', '::1', '2016-08-18 03:23:26', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
 ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
 ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
MODIFY `captcha_id` bigint(13) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=748;
--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
