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

 Date: 22/10/2020 23:12:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for jawaban_sementara
-- ----------------------------
DROP TABLE IF EXISTS `jawaban_sementara`;
CREATE TABLE `jawaban_sementara`  (
  `id_kuis` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_soal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_responden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_hasil
-- ----------------------------
DROP TABLE IF EXISTS `tb_hasil`;
CREATE TABLE `tb_hasil`  (
  `id_kuis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_responden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_soal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jawaban` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pertanyaan`;
CREATE TABLE `tb_pertanyaan`  (
  `id_soal` int(12) NOT NULL AUTO_INCREMENT,
  `soal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `a` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `b` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `c` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `d` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_soal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pertanyaan
-- ----------------------------
INSERT INTO `tb_pertanyaan` VALUES (1, 'Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai', 'persyaratan');
INSERT INTO `tb_pertanyaan` VALUES (2, 'Bagaimana pemahaman saudara tentang kemudahan prosedur pelayanan di unit ini', 'Tidak Mudah ', 'Kurang Mudah ', 'Mudah', 'Sangat Mudah', 'kemudahan');
INSERT INTO `tb_pertanyaan` VALUES (3, 'Bagaimana pendapat saudara tentang kecepatan pelayanan di unit ini', 'tidak tepat waktu', 'kadang tepat waktu', 'Banyak Tepat Waktu', 'Selalu Tepat Waktu', 'kecepatan');
INSERT INTO `tb_pertanyaan` VALUES (4, 'Bagaimana pendapat saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan', 'Selalu Tidak Sesuai', 'Kadang Sesuai', 'Banyak Sesuainya', 'Selalu Sesuai', 'biaya');
INSERT INTO `tb_pertanyaan` VALUES (5, 'Bagaimana pendapat saudara tentang kesesuaian hasil pelayanan yang diberikan dan diterima dengan waktu yang ditetapkan', 'Tidak Sesuai', 'Kadang Sesuai', 'Sesuai', 'Sangat Sesuai', 'hasil pelayanan');
INSERT INTO `tb_pertanyaan` VALUES (6, 'Bagaimana pendapat saudara tentang kemampuan petugas dalam memberi pelayanan', 'Tidak Mampu', 'Kurang Mampu', 'Mampu', 'Sangat Mampu', 'sdm petugas');
INSERT INTO `tb_pertanyaan` VALUES (7, 'Bagaimana pendapat saudara tentang penanganan pengaduan,saran dan masukan pelayanan yang diberikan ', 'Tidak Baik', 'Kurang Baik', 'Baik', 'Sangat Baik', 'penangan pengaduan');
INSERT INTO `tb_pertanyaan` VALUES (8, 'Bagaiman pendapat saudara tentang sarana dan prasarana yang digunakan dalam pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai ', 'Sangat Sesuai', 'sarprass');

SET FOREIGN_KEY_CHECKS = 1;
