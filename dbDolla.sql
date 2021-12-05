/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - dbdolla
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbdolla` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbdolla`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(200) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id_customer` varchar(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `wa` varchar(50) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL,
  `ig` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`id_customer`,`nama`,`status`,`alamat`,`wa`,`fb`,`ig`) values ('21001','Rini','Reseller','Jakarta','08571234','rini','rini'),('21002','Susi','Ecer','Jakarta','08796544','Susi','Susi'),('21003','Rizal',NULL,'Jakarta','343','ssd','sds'),('21004','Anggun','Reseller','Jakarta','7787','nkjjk','ui');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(5) NOT NULL,
  `id_user` varchar(5) DEFAULT NULL,
  `tgl_pembelian` datetime DEFAULT NULL,
  `id_supplier` varchar(5) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`id_pembelian`,`id_user`,`tgl_pembelian`,`id_supplier`,`keterangan`) values ('21002','21000','2021-11-03 20:25:48','21002','ket');

/*Table structure for table `pembelian_detail` */

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` varchar(5) DEFAULT NULL,
  `id_barang` varchar(5) DEFAULT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `nama_barang` varchar(200) DEFAULT NULL,
  `qty_masuk` int(11) DEFAULT NULL,
  `qty_klr` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual_ecer` int(11) DEFAULT NULL,
  `harga_jual_reseller` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pembelian_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_detail` */

insert  into `pembelian_detail`(`id_pembelian_detail`,`id_pembelian`,`id_barang`,`barcode`,`nama_barang`,`qty_masuk`,`qty_klr`,`harga_beli`,`harga_jual_ecer`,`harga_jual_reseller`) values (3,'21002','21003','345','CROCO KAYO',5,2,34000,68000,59500),(4,'21002','21004','456','CROCO KAZUMI',10,2,37000,74000,64750);

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(5) NOT NULL,
  `id_user` varchar(5) DEFAULT NULL,
  `tgl_penjualan` datetime DEFAULT NULL,
  `id_customer` varchar(5) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `total_penjualan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

insert  into `penjualan`(`id_penjualan`,`id_user`,`tgl_penjualan`,`id_customer`,`keterangan`,`total_penjualan`) values ('21001','21000','2021-11-02 17:16:27','21001','',NULL);

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id_penjualan` varchar(5) DEFAULT NULL,
  `id_pembelian_detail` int(11) DEFAULT NULL,
  `id_barang` varchar(5) DEFAULT NULL,
  `qty_keluar` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_detail` */

insert  into `penjualan_detail`(`id_penjualan`,`id_pembelian_detail`,`id_barang`,`qty_keluar`,`harga_jual`,`diskon`) values ('21001',4,'21004',2,64750,0),('21001',3,'21003',2,59500,0);

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`id`,`appname`) values (1,'Dolla Stock Apps');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` varchar(5) NOT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id_supplier`,`nama_supplier`,`telp`,`alamat`,`pic`) values ('21001','Dolla Factory','021777666555','Jakarta','Budi'),('21002','Croco Factory','02177774444','Bandung','Doni');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=21003 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`realname`,`password`,`level`,`lastlogin`) values (21000,'rizal','Rizal Purnomo','c6318323cc5693ce1f8d220cc9a5030e','Super Administrator','2021-12-06 04:53:47'),(21001,'Rully','Rully','827ccb0eea8a706c4c34a16891f84e7b','Administrator',NULL),(21002,'staff','Staff','827ccb0eea8a706c4c34a16891f84e7b','Staff','2021-11-28 16:19:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
