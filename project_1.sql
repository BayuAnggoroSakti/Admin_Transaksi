

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



CREATE TABLE IF NOT EXISTS `acl` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `acl` (`key`, `value`) VALUES
('resources', '["administrator","user","role","resource"]'),
('resource_role_permissions::administrator::administrator', '["read"]'),
('resource_role_permissions::resource::administrator', '["create","read","update","delete"]'),
('resource_role_permissions::role::administrator', '["create","read","update","delete"]'),
('resource_role_permissions::user::administrator', '["create","read","update","delete"]'),
('roles', '["administrator"]'),
('user_roles::1', '["administrator"]');



CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status` set('active','not_active','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `nama`, `tanggal_lahir`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'bayu.anggoro.s@mail.ugm.ac.id', 'bayu anggoro sakti', '1995-09-02', 'active');


CREATE TABLE IF NOT EXISTS `captcha` (
`captcha_id` bigint(13) NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=748 DEFAULT CHARSET=latin1;

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(723, 1471487243, '::1', '9083'),


CREATE TABLE IF NOT EXISTS `detail_transaksi` (
`id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `qty`) VALUES
(1, 1, 2, 2),
(2, 1, 1, 1),
---------------------------------------


CREATE TABLE IF NOT EXISTS `produk` (
`id_produk` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;



INSERT INTO `produk` (`id_produk`, `nama`, `deskripsi`, `harga`) VALUES
(1, 'Pizza', 'Ini Deskripsi', 25000),
(2, 'Kentang', 'jlkkl', 50000),
(6, 'dsfsdfsdfsdfs', 'dfsdfsd', 0),
(7, 'asdasd', 'asdasd', 222),



CREATE TABLE IF NOT EXISTS `transaksi` (
`id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total`, `lokasi`, `alamat`, `tanggal`) VALUES
(1, 1, 100000, 'Pati', 'Desa Dengkek', '2016-08-17'),

-
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


INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama`, `tanggal_lahir`, `alamat`, `ip_address`, `updatetimestamp`, `status`) VALUES
(1, 'Bayu.anggoro.s', '40205e15e436cac598108ddedd5a9f3b', 'bayu.anggoro.s@mail.ugm.ac.id', 'Bayu Anggoro Saktii', '1995-09-02', 'Pati', '::1', '2016-08-18 02:56:28', 'active'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'bayu@bayu.com', 'aku', '2016-08-13', 'djjdj', '::1', '2016-08-18 03:23:26', 'active');

ALTER TABLE `acl`
 ADD PRIMARY KEY (`key`);

ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `captcha`
 ADD PRIMARY KEY (`captcha_id`);
exes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
 ADD PRIMARY KEY (`id_detail`);

ALTER TABLE `produk`
 ADD PRIMARY KEY (`id_produk`);

ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

ALTER TABLE `admin`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `captcha`
MODIFY `captcha_id` bigint(13) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=748;

ALTER TABLE `detail_transaksi`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;

ALTER TABLE `produk`
MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;

ALTER TABLE `transaksi`
MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

