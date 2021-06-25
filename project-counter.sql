/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80021
Source Host           : localhost:3306
Source Database       : project-counter

Target Server Type    : MYSQL
Target Server Version : 80021
File Encoding         : 65001

Date: 2021-06-23 21:17:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `barang`
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `imei` char(255) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` varchar(255) DEFAULT NULL,
  `harga_jual` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `status` enum('instock','terjual') DEFAULT NULL,
  PRIMARY KEY (`imei`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of barang
-- ----------------------------

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_telpn` bigint DEFAULT NULL,
  `tgl_daftar` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `kode_pembelian` int DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of customer
-- ----------------------------

-- ----------------------------
-- Table structure for `part`
-- ----------------------------
DROP TABLE IF EXISTS `part`;
CREATE TABLE `part` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama_part` varchar(255) DEFAULT NULL,
  `penjual` varchar(255) DEFAULT NULL,
  `harga` bigint DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` text,
  `id_teknisi` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of part
-- ----------------------------

-- ----------------------------
-- Table structure for `pemasukan`
-- ----------------------------
DROP TABLE IF EXISTS `pemasukan`;
CREATE TABLE `pemasukan` (
  `id_pemasukan` int NOT NULL AUTO_INCREMENT,
  `jenis_pemasukan` varchar(255) DEFAULT NULL,
  `nominal` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_pemasukan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of pemasukan
-- ----------------------------

-- ----------------------------
-- Table structure for `pembelian`
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imei` char(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` bigint DEFAULT NULL,
  `keterangan` text,
  `id_customer` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `metode_bayar` enum('cash','transfer','hutang') DEFAULT NULL,
  `tanggal_bayar` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `uang_muka` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of pembelian
-- ----------------------------

-- ----------------------------
-- Table structure for `pengeluaran`
-- ----------------------------
DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `jenis_pengeluaran` varchar(255) DEFAULT NULL,
  `nominal` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of pengeluaran
-- ----------------------------



-- ----------------------------
-- Table structure for `penjualan_tmp`
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_tmp`;
CREATE TABLE `penjualan_tmp` (
  `id_penjualan_tmp` int NOT NULL AUTO_INCREMENT,
  `imei` char(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `metode_bayar` enum('cash','transfer','hutang') DEFAULT NULL,
  `keterangan` text,
  `harga_beli` bigint DEFAULT NULL,
  `harga_jual` bigint DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kode_pembelian` bigint DEFAULT NULL,
  `uang_muka` bigint DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of penjualan_tmp
-- ----------------------------

-- ----------------------------
-- Table structure for `saldo_awal`
-- ----------------------------
DROP TABLE IF EXISTS `saldo_awal`;
CREATE TABLE `saldo_awal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `nominal` bigint DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of saldo_awal
-- ----------------------------

-- ----------------------------
-- Table structure for `service`
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id_service` int NOT NULL AUTO_INCREMENT,
  `id_customer` int DEFAULT NULL,
  `alamat` text,
  `no_telpn` varchar(255) DEFAULT NULL,
  `nama_barang` text,
  `tipe` varchar(255) DEFAULT NULL,
  `imei` char(255) DEFAULT NULL,
  `kelengkapan` text,
  `keluhan` text,
  `keterangan` text,
  `id_user` int NOT NULL,
  `status` enum('diterima','dikerjakan','selesai') NOT NULL DEFAULT 'diterima',
  `tanggal_masuk` datetime DEFAULT NULL,
  `tanggal_jadi` date DEFAULT NULL,
  `tanggal_diambil` date DEFAULT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of service
-- ----------------------------

-- ----------------------------
-- Table structure for `service_part`
-- ----------------------------
DROP TABLE IF EXISTS `service_part`;
CREATE TABLE `service_part` (
  `id_part` int NOT NULL AUTO_INCREMENT,
  `id_service` int DEFAULT NULL,
  `biaya` bigint DEFAULT NULL,
  `nama_part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_part`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of service_part
-- ----------------------------

-- ----------------------------
-- Table structure for `service_software`
-- ----------------------------
DROP TABLE IF EXISTS `service_software`;
CREATE TABLE `service_software` (
  `id_software` int NOT NULL AUTO_INCREMENT,
  `id_service` int DEFAULT NULL,
  `biaya` bigint DEFAULT NULL,
  `nama_software` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_software`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of service_software
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8 COLLATE utf8_0900_ai_ci DEFAULT NULL,
  `alamat` text,
  `level` enum('admin','teknisi','penjual') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'endra1@mail.com', '$2y$10$qD3lTQbquHaeoXthhiA97ONPikLe.cmthFYNVx3rX1HqNndi/oFbO', 'Endra1', '01234561', 'camiles1', 'penjual');
INSERT INTO `user` VALUES ('2', 'test@mail.com', '$2y$10$wyntgtauQyGOHE3shqWdtur4KWODHNvS8QFlBSPMlhFk0daZ3kLy.', 'test', '132', 'asd', 'admin');
