/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : ikm

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 08/03/2021 21:15:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pertanyaan`;
CREATE TABLE `tb_pertanyaan`  (
  `id_soal` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `soal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `a` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `c` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `d` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_soal`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pertanyaan
-- ----------------------------
INSERT INTO `tb_pertanyaan` VALUES ('U10', 'Apakah anda pernah melakukan transaksi pelayanan\r\npublik selain di MPP ? Misalnya mengurus KIA di\r\nDukcapil, mengurus perpanjangan SKCK di Polres, dsb.\r', '-', '-', 'Ya', 'Tidak', 'Persyaratan Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U11', 'Menurut Saudara, bagaimana pelayanan di MPP jika\r\ndibandingkan dengan pelayanan pada Unit Pelayanan Publik yang pernah anda datangi ?\r', 'Lebih buruk', 'Sama Saja', 'Lebih Baik', 'Diatas ekspektasi\r', 'Prosedur Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U12', 'Sudah berapa kali anda bertransaksi pelayanan publik di MPP sejak MPP ini berdiri ?\r', 'Baru 1x', '2x', '3x', 'Lebih dari 3x', 'Waktu Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U13', 'Bagaimana kemudahan persyaratan pelayanan di MPP?', 'Tidak mudah\r', 'Kurang Mudah', 'Mudah', 'Sangat Mudah', 'Biaya/tarif pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U14', 'Bagaimana kemudahan prosedur pelayanan di MPP?', 'Tidak mudah\r', 'Kurang Mudah', 'Mudah', 'Sangat Mudah', 'Produk Spesifikasi Jenis Pelayanan ');
INSERT INTO `tb_pertanyaan` VALUES ('U15', 'Bagaimana kesigapan petugas pelayanan di MPP?', 'Tidak sigap', 'Kurang sigap', 'Sigap', 'Sangat Sigap', 'Kompetensi Pelaksana Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U16', 'Bagaimana kerapihan dan keramahan petugas\r\npelayanan?', 'Tidak rapih dan ramah\r', 'Cukup rapih dan ramah\r', 'Rapih dan ramah', 'Sangat rapih dan ramah\r', 'Perilaku Pelaksana Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U17', 'Bagaimana kenyamanan tempat parkiran di MPP?', 'Tidak Nyaman', 'Kurang Nyaman', 'Nyaman', 'Sangat Nyaman', 'Maklumat Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U18', 'Bagaimana kenyamanan ruang tunggu di MPP?', 'Tidak Nyaman', 'Kurang Nyaman', 'Nyaman', 'Sangat Nyaman', 'Penanganan, Pengaduan , Saran dan Masukan');
INSERT INTO `tb_pertanyaan` VALUES ('U19', 'Bagaimana kenyamanan loket pelayanan di MPP?', 'Tidak Nyaman', 'Kurang Nyaman', 'Nyaman', 'Sangat Nyaman', 'Penanganan, Pengaduan , Saran dan Masukan');
INSERT INTO `tb_pertanyaan` VALUES ('U20', 'Bagaimana kenyaman toilet bagi pengguna layanan?', 'Tidak Nyaman', 'Kurang Nyaman', 'Nyaman', 'Sangat Nyaman', 'Penanganan, Pengaduan , Saran dan Masukan');
INSERT INTO `tb_pertanyaan` VALUES ('U21', 'Bagaimana kelengkapan dan kenyaman sarpras\r\npenunjang (ruang laktasi, tempat bermain anak, tempat\r\nfotocopy, kantin, ruang pengaduan, atm dll) yang ada di\r\nMPP?', 'Tidak Ada', 'Ada tetapi tidak berfungsi atau belum lengkap', 'Lengkap namun berfungsi kurang maksimal', 'Lengkap dan dikelola dengan baik', 'Penanganan, Pengaduan , Saran dan Masukan');
INSERT INTO `tb_pertanyaan` VALUES ('U22', 'Bagaimana kelengkapan sarpras bagi pengguna\r\nlayanan berkebutuhan khusus (jalur landai,\r\nloket/antrian prioritas, toilet khusus, kursi roda,\r\npetugas khusus, dll)?\r', 'Tidak Ada', 'Ada tetapi tidak berfungsi atau belum lengkap', 'Lengkap namun berfungsi kurang maksimal', 'Lengkap dan dikelola dengan baik', 'Penanganan, Pengaduan , Saran dan Masukan');
INSERT INTO `tb_pertanyaan` VALUES ('U23', 'Apakah anda akan merekomendasikan saudara,\r\nteman, kenalan, atau orang terdekat anda untuk\r\nbertransaksi pelayanan publik di MPP ?\r', '-', 'Tidak', 'Mungkin', 'Ya', 'Penanganan, Pengaduan , Saran dan Masukan');

SET FOREIGN_KEY_CHECKS = 1;
