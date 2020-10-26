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

 Date: 26/10/2020 22:37:25
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
-- Table structure for tb_detil_responden
-- ----------------------------
DROP TABLE IF EXISTS `tb_detil_responden`;
CREATE TABLE `tb_detil_responden`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_responden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur` int(255) NULL DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Laki-laki',
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  `published` enum('1','2','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_hasil
-- ----------------------------
INSERT INTO `tb_hasil` VALUES ('125f96e8378', '1224234234', 'U1', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e839a', '1224234234', 'U2', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e83b8', '1224234234', 'U3', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e83d5', '1224234234', 'U4', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e83ee', '1224234234', 'U5', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e840f', '1224234234', 'U6', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e8434', '1224234234', 'U7', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e8452', '1224234234', 'U8', 'd', '2020-10-26 22:16:59', '2');
INSERT INTO `tb_hasil` VALUES ('125f96e846c', '1224234234', 'U9', 'd', '2020-10-26 22:16:59', '2');

-- ----------------------------
-- Table structure for tb_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pekerjaan`;
CREATE TABLE `tb_pekerjaan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pekerjaan
-- ----------------------------
INSERT INTO `tb_pekerjaan` VALUES (1, 'PNS/TNI/POLRI');
INSERT INTO `tb_pekerjaan` VALUES (2, 'Pegawai Swasta');
INSERT INTO `tb_pekerjaan` VALUES (3, 'Wiraswasta');
INSERT INTO `tb_pekerjaan` VALUES (4, 'Pelajar/Mahasiswa');
INSERT INTO `tb_pekerjaan` VALUES (5, 'Lainnya');

-- ----------------------------
-- Table structure for tb_pendidikan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pendidikan`;
CREATE TABLE `tb_pendidikan`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pendidikan
-- ----------------------------
INSERT INTO `tb_pendidikan` VALUES ('1', 'SD Kebawah');
INSERT INTO `tb_pendidikan` VALUES ('2', 'SMP');
INSERT INTO `tb_pendidikan` VALUES ('3', 'SMA');
INSERT INTO `tb_pendidikan` VALUES ('4', 'S1');
INSERT INTO `tb_pendidikan` VALUES ('5', 'S2 Keatas');

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
INSERT INTO `tb_pertanyaan` VALUES ('U1', 'Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai', 'persyaratan Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U2', 'Bagaimana pemahaman saudara tentang kemudahan prosedur pelayanan di unit ini', 'Tidak Mudah ', 'Kurang Mudah ', 'Mudah', 'Sangat Mudah', 'Prosedur Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U3', 'Bagaimana pendapat saudara tentang kecepatan pelayanan di unit ini', 'tidak tepat waktu', 'kadang tepat waktu', 'Banyak Tepat Waktu', 'Selalu Tepat Waktu', 'Waktu Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U4', 'Bagaimana pendapat saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan', 'Selalu Tidak Sesuai', 'Kadang Sesuai', 'Banyak Sesuainya', 'Selalu Sesuai', 'Biaya/tarif pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U5', 'Bagaimana pendapat saudara tentang kesesuaian hasil pelayanan yang diberikan dan diterima dengan waktu yang ditetapkan', 'Tidak Sesuai', 'Kadang Sesuai', 'Sesuai', 'Sangat Sesuai', 'Produk Spesifikasi Jenis Pelayanan ');
INSERT INTO `tb_pertanyaan` VALUES ('U6', 'Bagaimana pendapat saudara tentang kemampuan petugas dalam memberi pelayanan', 'Tidak Mampu', 'Kurang Mampu', 'Mampu', 'Sangat Mampu', 'Kompetensi Pelaksana Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U7', 'Bagaimana pendapat saudara tentang penanganan pengaduan,saran dan masukan pelayanan yang diberikan ', 'Tidak Baik', 'Kurang Baik', 'Baik', 'Sangat Baik', 'Perilaku Pelaksana Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U8', 'Bagaiman pendapat saudara tentang sarana dan prasarana yang digunakan dalam pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai ', 'Sangat Sesuai', 'Maklumat Pelayanan');
INSERT INTO `tb_pertanyaan` VALUES ('U9', 'Belum ada Soal', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai', 'Penanganan, Pengaduan , Saran dan Masukan');

-- ----------------------------
-- Table structure for tb_saran
-- ----------------------------
DROP TABLE IF EXISTS `tb_saran`;
CREATE TABLE `tb_saran`  (
  `id_saran` int(255) NOT NULL AUTO_INCREMENT,
  `id_responden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `saran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_saran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_saran
-- ----------------------------
INSERT INTO `tb_saran` VALUES (1, 'asdasdasd', 'bagus', '2020-10-26 14:57:00', '1');
INSERT INTO `tb_saran` VALUES (3, 'asdasdasdasdas', 'adas sadas saddasdasd', '2020-10-26 18:21:08', '1');
INSERT INTO `tb_saran` VALUES (5, 'asdas345345', 'asda sadaswr wfsfsf sfasfsd lorasas askhasf asfkhaslf asfkahsf asfklasf asfklahsf slfkhasf asflkasf as.knaslkas fas;lkfas askahfaihfs fsdjfgsf sfjksdgfs fsdfggsfsd fsdjfgdsf as;lkfasf ', '2020-10-26 18:23:04', '1');
INSERT INTO `tb_saran` VALUES (6, '1224234234', 'tingkatkan kecepatan pelayanannya', '2020-10-26 22:16:36', '1');

SET FOREIGN_KEY_CHECKS = 1;
