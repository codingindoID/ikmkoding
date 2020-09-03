/*
 Navicat Premium Data Transfer

 Source Server         : lokal
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : ikm

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 03/09/2020 13:53:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_hasil
-- ----------------------------
DROP TABLE IF EXISTS `tb_hasil`;
CREATE TABLE `tb_hasil`  (
  `id_kuis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_responden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_soal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jawaban` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_hasil
-- ----------------------------
INSERT INTO `tb_hasil` VALUES ('125f508859706e7', '125f508859702ff', '122', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50885970acf', '125f508859702ff', '123124', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50885970eb8', '125f508859702ff', 'asdas', 'b');
INSERT INTO `tb_hasil` VALUES ('125f50896b8f1d7', 'wrwer', '122', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50896b8f5bf', 'wrwer', '123124', 'b');
INSERT INTO `tb_hasil` VALUES ('125f50896b8f9a7', 'wrwer', 'asdas', 'd');
INSERT INTO `tb_hasil` VALUES ('125f508e0ee9ab8', '123456', '122', 'a');
INSERT INTO `tb_hasil` VALUES ('125f508e0ee9ea0', '123456', '123124', 'b');
INSERT INTO `tb_hasil` VALUES ('125f508e0eea288', '123456', 'asdas', 'b');
INSERT INTO `tb_hasil` VALUES ('125f508eae45641', 'sdfsdfssdfs', '122', 'b');
INSERT INTO `tb_hasil` VALUES ('125f508eae45a29', 'sdfsdfssdfs', '123124', 'c');
INSERT INTO `tb_hasil` VALUES ('125f508eae45e11', 'sdfsdfssdfs', 'asdas', 'd');
INSERT INTO `tb_hasil` VALUES ('125f5091508251e', '123123123', '122', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50915082906', '123123123', '123124', 'b');
INSERT INTO `tb_hasil` VALUES ('125f50915082cee', '123123123', 'asdas', 'd');
INSERT INTO `tb_hasil` VALUES ('125f5091a02b8aa', '123456fdsfs', '122', 'd');
INSERT INTO `tb_hasil` VALUES ('125f5091a02bc92', '123456fdsfs', '123124', 'd');
INSERT INTO `tb_hasil` VALUES ('125f5091a02c07a', '123456fdsfs', 'asdas', 'd');
INSERT INTO `tb_hasil` VALUES ('125f5091ef0de19', 'sdxcbfddf', '122', 'b');
INSERT INTO `tb_hasil` VALUES ('125f5091ef0e201', 'sdxcbfddf', '123124', 'b');
INSERT INTO `tb_hasil` VALUES ('125f5091ef0e5e9', 'sdxcbfddf', 'asdas', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50923ae9ef6', 'jkgkjgkjgh', '122', 'a');
INSERT INTO `tb_hasil` VALUES ('125f50923aea2de', 'jkgkjgkjgh', '123124', 'c');
INSERT INTO `tb_hasil` VALUES ('125f50923aea6c7', 'jkgkjgkjgh', 'asdas', 'a');

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
  PRIMARY KEY (`id_soal`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pertanyaan
-- ----------------------------
INSERT INTO `tb_pertanyaan` VALUES ('122', 'Apakah buku yang tersedia didalam perpustakaan cukup untuk memenuhi kebutuhan belajar Anda ?', 'bagus', 'sdfsdfsd', 'biasa saja', 'buruk');
INSERT INTO `tb_pertanyaan` VALUES ('123124', 'Apakah metode pembelajaran visual baik untuk para pelajar ?', 'bagus', 'sdfsvfe', 'biasa saja', 'buruk');
INSERT INTO `tb_pertanyaan` VALUES ('asdas', 'Bagaimana dengan kecepatan pelayanan', 'bagus', 'sdfsdfxv', 'biasa saja ', 'buruk');

SET FOREIGN_KEY_CHECKS = 1;
