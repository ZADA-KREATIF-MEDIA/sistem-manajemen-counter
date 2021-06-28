/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : project-counter

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 28/06/2021 23:27:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga_beli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `status` enum('instock','tmp','terjual') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT 'instock',
  PRIMARY KEY (`imei`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES ('haperedminote9pr', 'redmi note 9', '3000000', NULL, 'test', 'instock');
INSERT INTO `barang` VALUES ('redmi098887645', 'Xiaomi Redmi 9', '2900000', NULL, 'test', 'instock');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `id_customer` int(0) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `no_telpn` bigint(0) NULL DEFAULT NULL,
  `tgl_daftar` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_customer`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 'Endra', 'camiles', 89, '2021-06-27 00:00:00', 'ipx10');
INSERT INTO `customer` VALUES (2, 'Endra', 'camiles', 89, '2021-06-27 00:00:00', 'ipxpro10');
INSERT INTO `customer` VALUES (3, 'Sammy', 'wonosobo', 789, NULL, 'haperedminote9pr');
INSERT INTO `customer` VALUES (4, 'test', 'test', 8123, '2021-06-28 00:00:00', 'test');

-- ----------------------------
-- Table structure for part
-- ----------------------------
DROP TABLE IF EXISTS `part`;
CREATE TABLE `part`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT,
  `nama_part` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `penjual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga` bigint(0) NULL DEFAULT NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `id_teknisi` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pemasukan
-- ----------------------------
DROP TABLE IF EXISTS `pemasukan`;
CREATE TABLE `pemasukan`  (
  `id_pemasukan` int(0) NOT NULL AUTO_INCREMENT,
  `jenis_pemasukan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nominal` bigint(0) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id_pemasukan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga_beli` bigint(0) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `id_customer` int(0) NULL DEFAULT NULL,
  `id_user` int(0) NULL DEFAULT NULL,
  `metode_bayar` enum('cash','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES (1, 'haperedminote9pr', 'redmi note 9', 3000000, NULL, NULL, 3, 'cash', '2021-06-27');

-- ----------------------------
-- Table structure for pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran`  (
  `id_pengeluaran` int(0) NOT NULL AUTO_INCREMENT,
  `jenis_pengeluaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nominal` bigint(0) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id_pengeluaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id_penjualan` int(0) NOT NULL AUTO_INCREMENT,
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `harga_beli` bigint(0) NULL DEFAULT NULL,
  `harga_jual` bigint(0) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `nama_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_user` int(0) NOT NULL,
  `metode_bayar` enum('cash','hutang','transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `kode_pembelian` bigint(0) NULL DEFAULT NULL,
  `uang_muka` bigint(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES (1, 'rm-09', 'Redmi 9', 2500000, 2500000, '', 'test', 3, 'cash', '2021-06-26', NULL, NULL);
INSERT INTO `penjualan` VALUES (2, 'ipx10', 'Iphone x', 12000000, 12000000, 'test', 'Endra', 3, 'cash', '2021-06-27', NULL, NULL);
INSERT INTO `penjualan` VALUES (3, 'ipxpro10', 'Iphone Pro Max', 15000000, 15000000, 'test', 'Endra', 3, 'transfer', '2021-06-27', NULL, NULL);

-- ----------------------------
-- Table structure for penjualan_tmp
-- ----------------------------
DROP TABLE IF EXISTS `penjualan_tmp`;
CREATE TABLE `penjualan_tmp`  (
  `id_penjualan_tmp` int(0) NOT NULL AUTO_INCREMENT,
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_user` int(0) NULL DEFAULT NULL,
  `metode_bayar` enum('cash','transfer','hutang') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `harga_beli` bigint(0) NULL DEFAULT NULL,
  `harga_jual` bigint(0) NULL DEFAULT NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  `no_telpn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan_tmp`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for saldo_awal
-- ----------------------------
DROP TABLE IF EXISTS `saldo_awal`;
CREATE TABLE `saldo_awal`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `tanggal` date NULL DEFAULT NULL,
  `nominal` bigint(0) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service`  (
  `id_service` int(0) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `no_telpn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_barang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `tipe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `imei` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `kelengkapan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `id_teknisi` int(0) NOT NULL,
  `status` enum('diterima','dikerjakan','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'diterima',
  `tanggal_masuk` datetime(0) NULL DEFAULT NULL,
  `tanggal_jadi` date NULL DEFAULT NULL,
  `tanggal_diambil` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_service`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of service
-- ----------------------------
INSERT INTO `service` VALUES (3, 'test', 'test', '08123', 'test', 'test', 'test', 'test', 'test', 'test', 3, 'diterima', '2021-06-28 18:14:54', '2021-06-29', NULL);

-- ----------------------------
-- Table structure for service_part
-- ----------------------------
DROP TABLE IF EXISTS `service_part`;
CREATE TABLE `service_part`  (
  `id_part` int(0) NOT NULL AUTO_INCREMENT,
  `id_service` int(0) NULL DEFAULT NULL,
  `biaya` bigint(0) NULL DEFAULT NULL,
  `nama_part` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_part`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of service_part
-- ----------------------------
INSERT INTO `service_part` VALUES (3, 3, 158000, 'test');

-- ----------------------------
-- Table structure for service_software
-- ----------------------------
DROP TABLE IF EXISTS `service_software`;
CREATE TABLE `service_software`  (
  `id_software` int(0) NOT NULL AUTO_INCREMENT,
  `id_service` int(0) NULL DEFAULT NULL,
  `biaya` bigint(0) NULL DEFAULT NULL,
  `nama_software` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_software`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of service_software
-- ----------------------------
INSERT INTO `service_software` VALUES (3, 3, 0, '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(0) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `level` enum('admin','teknisi','penjual') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (3, 'admin@mail.com', '$2y$10$PCKSJhKnjmkhE/JMvuREP.800eYczbczB874/G.8n/phR23TDkziO', 'admin', '098', 'bantul', 'admin');
INSERT INTO `user` VALUES (4, 'penjual@mail.com', '$2y$10$tvt6qKjcCd.3WqjxY7cu0uOQzEKdGGugB/xFC1aKQQf3OV7EFIe1i', 'penjual', '087', 'bantul', 'penjual');

SET FOREIGN_KEY_CHECKS = 1;
