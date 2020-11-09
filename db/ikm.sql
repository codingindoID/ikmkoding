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

 Date: 09/11/2020 15:01:52
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
INSERT INTO `faq` VALUES (8, 'Apakah perijinan bisa dilakukan secara online?', 'Bisa ', '2020-11-07 16:21:26');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_responden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur` int(255) NULL DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Laki-laki',
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detil_responden
-- ----------------------------
INSERT INTO `tb_detil_responden` VALUES (5, '12345', 'Wawan', 29, 'Laki-laki', 'SMA', 'Wiraswasta', '2020-01-01 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (6, '45664', 'wahda', 65, 'Laki-laki', 'S2 Keatas', 'Wiraswasta', '2020-11-09 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (7, 'asdasdasd', 'asdasd', 76, 'Laki-laki', 'SMP', 'Wiraswasta', '2020-11-09 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (8, 'fsdsd', 'wawan', 33, 'Laki-laki', 'SMA', 'Wiraswasta', '2020-11-09 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (9, '89699', 'jamian', 34, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2020-11-09 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (36, 'ry', 'agus', 45, 'Laki-laki', 'SD Kebawah', 'PNS/TNI/POLRI', '2020-11-09 09:45:18');
INSERT INTO `tb_detil_responden` VALUES (37, 'ry', 'agus', 45, 'Laki-laki', 'SD Kebawah', 'PNS/TNI/POLRI', '2020-11-09 09:45:18');

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
INSERT INTO `tb_hasil` VALUES ('125fa407131', '12345', 'U1', 'b', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa407154', '12345', 'U2', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40717a', '12345', 'U3', 'b', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4071a2', '12345', 'U4', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4071c9', '12345', 'U5', 'b', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4071f2', '12345', 'U6', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa407214', '12345', 'U7', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40723e', '12345', 'U8', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40726e', '12345', 'U9', 'c', '2020-11-05 21:12:22', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bcce', '45664', 'U1', 'b', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bcf2', '45664', 'U2', 'c', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bd28', '45664', 'U3', 'a', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bd4f', '45664', 'U4', 'b', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bd76', '45664', 'U5', 'b', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bdb0', '45664', 'U6', 'd', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40bdde', '45664', 'U7', 'b', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40be5e', '45664', 'U8', 'a', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa40be92', '45664', 'U9', 'b', '2020-11-05 21:28:42', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4114a5', 'asdasdasd', 'U1', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4114f9', 'asdasdasd', 'U2', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa411520', 'asdasdasd', 'U3', 'c', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa41155e', 'asdasdasd', 'U4', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa411584', 'asdasdasd', 'U5', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4115a7', 'asdasdasd', 'U6', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4115cc', 'asdasdasd', 'U7', 'b', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa4115f2', 'asdasdasd', 'U8', 'c', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa41161c', 'asdasdasd', 'U9', 'd', '2020-11-05 21:51:29', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569b98', 'fsdsd', 'U1', 'b', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569bba', 'fsdsd', 'U2', 'd', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569bf5', 'fsdsd', 'U3', 'c', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569c17', 'fsdsd', 'U4', 'd', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569c46', 'fsdsd', 'U5', 'c', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569c65', 'fsdsd', 'U6', 'd', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569c8a', 'fsdsd', 'U7', 'b', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569caf', 'fsdsd', 'U8', 'd', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa569cd1', 'fsdsd', 'U9', 'd', '2020-11-06 22:27:15', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b89d', '89699', 'U1', 'c', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b8ec', '89699', 'U2', 'd', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b90e', '89699', 'U3', 'd', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b94a', '89699', 'U4', 'd', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b970', '89699', 'U5', 'c', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b990', '89699', 'U6', 'd', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b9b4', '89699', 'U7', 'b', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b9d2', '89699', 'U8', 'd', '2020-11-06 22:28:46', '2');
INSERT INTO `tb_hasil` VALUES ('125fa56b9f8', '89699', 'U9', 'd', '2020-11-06 22:28:46', '2');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_saran
-- ----------------------------
INSERT INTO `tb_saran` VALUES (8, '12345', 'tingkatkan', '2020-11-05 21:07:43', '1');
INSERT INTO `tb_saran` VALUES (9, '45664', 'terimakasih\n', '2020-11-05 21:28:02', '1');
INSERT INTO `tb_saran` VALUES (10, 'asdasdasd', 'ok', '2020-11-05 21:51:19', '1');
INSERT INTO `tb_saran` VALUES (11, 'fsdsd', 'tingkatkan pelayanan', '2020-11-06 22:20:54', '1');
INSERT INTO `tb_saran` VALUES (12, '89699', 'oke', '2020-11-06 22:28:37', '1');

SET FOREIGN_KEY_CHECKS = 1;
