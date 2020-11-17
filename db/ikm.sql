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

 Date: 17/11/2020 11:57:03
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
-- Table structure for faq
-- ----------------------------
DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of faq
-- ----------------------------
INSERT INTO `faq` VALUES (1, 'pukul Berapa pelayanan di MPP dibuka?', 'Pelayanan Buka mulai jam : 08.00 - 13.00 WIB', '2020-11-06 20:29:26');
INSERT INTO `faq` VALUES (6, 'Ada Berapakah Counter Pelayanan Di MPP Jepara', 'Ada 18 Counter Yang Siap Melayani Anda', '2020-11-06 22:32:08');
INSERT INTO `faq` VALUES (7, 'Bagaimana Dengan Protokol kesehatan di MPP Selama Pandemi?', 'Kami Menerapkan Protokol Kesehatan dengan Baik, Setiap Pengunjung Wajib Memakai Masker Dan Cek Suhu Badan Sebelum Memasuki MPP,.', '2020-11-06 22:33:27');

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
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 'Mal Pelayanan Publik Kabupaten Jepara', 'Mal Pelayanan Publik (MPP) Kabupaten Jepara yang berada di Lantai I Kantor Organisasi Perangkat Daerah (OPD) bersama resmi dibuka, Kamis (1/10/2020). Sekretaris Daerah Kabupaten Jepara Edy Sujatmiko berharap, dengan dibukanya MPP ini, dapat meningkatkan daya saing global dalam memberikan kemudahan berusaha di daerah. Iklim berusaha akan lebih mudah terutama terkait perizinan yang lebih cepat, terpadu, efektif, dan efisien. Disampaikan, sebanyak 222 pelayanan, baik perizinan atau nonperizinan tersedia di MPP Jepara. Sehingga, semakin memudahkan masyarakat dalam mengakses berbagai jenis layanan yang ada di instansi pemerintah di satu tempat, baik mulai perizinan, administrasi kependudukan, pajak, retribusi, hingga aduan, dan konsultasi. “Semua itu, dilakukan untuk memberikan pelayanan cepat, dan terbaik untuk masyarakat,” kata Edy saat membuka MPP secara resmi. Sebenarnya, lanjutnya, MPP sudah mulai dibuka sejak 1 Juli 2020, namun baru sebatas uji coba. Pembukaan uji coba secara bertahap telah ditinjau dan mendapat apresiasi postif dari Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi (PAN RB) RI yang diwakili Deputi Bidang Pelayanan Publik. “MPP ini dinilai telah mampu memudahkan publik dalam mengakses pelayanan yang terintegrasi dalam satu tempat. Namun, ada pula saran dan masukan yang sudah kami laksanakan,” kata dia. Ditambahkan, saat ini, MPP sudah dilengkapi berbagai fasilitas penunjang mulai dari pusat informasi, ruang laktasi, musala, ruang rapat, kursi roda, pojok baca, dan ruang bermain anak. “Kebaradaannya sangat strategis, karena memiliiki area parkir yang luas dan berada di jantung kota,” imbuhnya.', '1.jpeg', '2020-11-07 10:18:52');
INSERT INTO `news` VALUES (2, 'Mal Pelayanan Publik Dibuka dengan Pembatasan Kunjungan', ' Untuk memberikan pelayanan kepada masyarakat, Pemerintah Kabupaten (Pemkab) Jepara mulai membuka Mal Pelayanan Publik yang berada di Lantai I Gedung Organisasi Perangkat Daerah (OPD) bersama, Jalan Kartini Nomor 1 Jepara.\r\n\r\n              Sekretaris Daerah (Sekda) Jepara Edy Sujatmiko, didampingi Asisten Administrasi Umum Sekda Jepara Sujarot, dan Kepala Dinas Penanaman Modal, Perijinan Terpadu Satu Pintu (DPMPTSP) Kabupaten Jepara Hery Yulianto, Kamis (2/7/2020) pagi melihat secara langsung kesiapan layanan yang sudah berjalan.\r\n\r\n              “Mal Pelayanan Publik sebenarnya dibuka kemarin pada bulan April bertepatan dengan hari jadi kota Jepara. Namun karena pandemi Covid-19 akhirnya ditunda,” kata dia.\r\n\r\n              Disampaikan Edy, kondisi Jepara saat ini masih tinggi kasus positif Covid-19. Namun di sisi lain masyarakat butuh pelayanan yang cepat dan maksimal. Sehingga Mal Pelayanan Publik ini dibuka secara bertahap. “Sudah kita buka sejak 1 Juli 2020, Namun dengan pembatasan kunjungan,” kata dia.\r\n\r\n              Beberapa layanan yang sudah difungsikan yaitu gerai Kantor Samsat, Bank Jateng, dan PDAM Jepara. Sedangkan untuk gerai instansi yaitu Dinas Lingkungan Hidup (DLH), Dinas Pekerjaan Umum dan Perumahan Rakyat (DPUPR), Dinas Kesehatan Kabupaten (Dinkes), Dinas Kependudukan dan Catatan Sipil (Disdukcapil), DPMPTSP, Diskominfo, dan Diskop UKM Nakertrans Jepara. Sedangkan sejumlah gerai belum ada layanan.\r\n\r\n              Edy mencontohkan untuk pelayanan Disdukcapil sudah bisa dilaksanakan. Meskipun ke depan, pelayanan ini akan dilakukan di semua kecamatan. “Kami ingin memberikan pelayanan terbaik di tengah pandemi Covid-19,” katanya.\r\n\r\n              Kepala DPMPTSP Jepara Hery Yulianto mengatakan, Untuk memberikan kenyamanan dan keamanan bagi setiap pengunjung yang mengurus ijin, sudah disiapkan berbagai fasilitas sesuai dengan protokol kesehatan. Seperti tempat cuci tangan, dan pendeteksi suhu tubuh. Selain itu jarak antrean dan pelayanan juga diatur.\r\n\r\n              “Tentunya ini berbeda dengan kondisi sebelumnya. Ada penyesuaian-penyesuaian dari pelayanan yang kita lakukan,” kata dia.\r\n\r\n              Teller di Bank Jateng Cabang Jepara Henny mengatakan, sebelumnya sudah diinformasikan kepada para nasabah, sehingga mereka tidak merasa bingung. ', '2.jpeg', '2020-11-06 20:28:54');

-- ----------------------------
-- Table structure for tb_detil_responden
-- ----------------------------
DROP TABLE IF EXISTS `tb_detil_responden`;
CREATE TABLE `tb_detil_responden`  (
  `id` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_responden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur` int(255) NULL DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Laki-laki',
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  `status` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `loket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
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
  `published` enum('1','2','') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_loket
-- ----------------------------
DROP TABLE IF EXISTS `tb_loket`;
CREATE TABLE `tb_loket`  (
  `id_loket` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_loket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id_loket`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_loket
-- ----------------------------
INSERT INTO `tb_loket` VALUES ('asdascas', 'DPMPTSP', '2020-11-17 10:25:11');
INSERT INTO `tb_loket` VALUES ('jsfsdk', 'BPJS KESEHATAN', '2020-11-17 11:12:54');

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
