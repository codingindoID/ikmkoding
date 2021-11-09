<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_import extends CI_Model {

	function detil_responden()
	{
		$query = "
		INSERT INTO `tb_detil_responden` 
		VALUES ('125ff3e3324e', '33200302890004', 'arif', 40, 'Laki-laki', 'SMA', 'Lainnya', '2021-01-05 03:55:30', '1', '');
		('125ff3e8345d', '3320060302890004', 'arif ahmad ', 31, 'Laki-laki', 'S2 Keatas', 'Lainnya', '2021-01-05 04:16:52', '1', '');
		('125ff3e864c3', '3320060302890004', 'arif ahmad ', 31, 'Laki-laki', 'S2 Keatas', 'Lainnya', '2021-01-05 04:17:40', '1', '');
		('125ff3e9ef35', '3320061301930006', 'Thariq H.A', 27, 'Laki-laki', 'S1', 'Lainnya', '2021-01-05 04:24:15', '1', '');
		('126007aa89a7', '3320141306930003', 'ABDUL ROCHIM', 27, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-01-20 03:59:05', '1', '');
		('126008d22c96', '67', 'sentot', 38, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2021-01-21 01:00:28', '1', '');
		('126009f8e0c1', '081390603989', 'nur CAHYANTO', 23, 'Laki-laki', 'S1', 'Wiraswasta', '2021-01-21 21:57:52', '1', '');
		('12600a29d32b', '081325883290', 'TRI J', 40, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-01-22 01:26:43', '1', '');
		('12600a2d361c', '082246028919', 'PUTRI AGUSTINA', 25, 'Perempuan', 'S1', 'Lainnya', '2021-01-22 01:41:10', '1', '');
		('12600a2e1821', '082325167073', 'ZUMROTUN', 46, 'Perempuan', 'SMP', 'Wiraswasta', '2021-01-22 01:44:56', '1', '');
		('12600a31f1dc', '082328599880', 'nOVIA SULISTIYO PUTRIYANTI', 27, 'Perempuan', 'S1', 'Pegawai Swasta', '2021-01-22 02:01:21', '1', '');
		('12600a336b9d', '085230816281', 'Alis murdiyanti', 35, 'Perempuan', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-22 02:07:39', '1', '');
		('12600a33e4e2', '085725457794', 'b.isti', 17, 'Perempuan', 'SMP', 'Pelajar/Mahasiswa', '2021-01-22 02:09:40', '1', '');
		('12600a349687', '085866197968', 'rizal hanafi', 23, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-01-22 02:12:38', '1', '');
		('12600a34ff61', '085385577240', 'ulis sa\'adah', 29, 'Perempuan', 'S1', 'Lainnya', '2021-01-22 02:14:23', '1', '');
		('12600a35f6e7', '198202232010012001', 'astutik', 39, 'Perempuan', 'SMA', 'PNS/TNI/POLRI', '2021-01-22 02:18:30', '1', '');
		('12600a3681a5', '082223271991', 'dwi ihsan ', 21, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2021-01-22 02:20:49', '1', '');
		('12600a37b01c', '3320010601780004', 'muadz', 43, 'Laki-laki', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-22 02:25:52', '1', '');
		('12600a39574d', '085326418453', 'eka', 53, 'Perempuan', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-22 02:32:55', '1', '');
		('12600a5470b7', '3320020101880008', 'erman', 33, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-01-22 04:28:32', '1', '');
		('12600e11be84', '082137211575', 'siti nahlin', 55, 'Perempuan', 'SMA', 'Lainnya', '2021-01-25 00:33:02', '1', '');
		('12600e1f13db', '3320061011710004', 'dwie rachmanto', 50, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-01-25 01:29:55', '1', '');
		('12600e205070', '081228145555', 'nailufar', 32, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-01-25 01:35:12', '1', '');
		('12600e217a45', '08122896989', 'aji', 47, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-01-25 01:40:10', '1', '');
		('12600e24003d', '085641456740', 'nesya', 31, 'Perempuan', 'S1', 'Wiraswasta', '2021-01-25 01:50:56', '1', '');
		('12600e29b041', '08132654028', 'ahmad sobari', 43, 'Laki-laki', 'SD Kebawah', 'Wiraswasta', '2021-01-25 02:15:12', '1', '');
		('12600e2aca49', '082135475693', 'sri mulyati', 45, 'Perempuan', 'SMA', 'PNS/TNI/POLRI', '2021-01-25 02:19:54', '1', '');
		('12600e401160', '085875165561', 'siska ', 37, 'Perempuan', 'SMA', 'Lainnya', '2021-01-25 03:50:41', '1', '');
		('12600e40d41d', '0895391586667', 'zayyana', 22, 'Perempuan', 'S1', 'Pegawai Swasta', '2021-01-25 03:53:56', '1', '');
		('12600e4134d1', '081316660217', 'linda ayu', 22, 'Perempuan', 'S1', 'Pegawai Swasta', '2021-01-25 03:55:32', '1', '');
		('12600e4233d6', '089690126222', 'nonik', 22, 'Perempuan', 'SMA', 'Pelajar/Mahasiswa', '2021-01-25 03:59:47', '1', '');
		('12600e430e2a', '082220119275', 'indra ', 33, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-01-25 04:03:26', '1', '');
		('12600f84296d', '085201424449', 'yanto', 45, 'Laki-laki', 'SMA', 'Wiraswasta', '2021-01-26 02:53:29', '1', '');
		('12600f84581f', '081398888352', 'riyanto', 26, 'Laki-laki', 'S1', 'Wiraswasta', '2021-01-26 02:54:16', '1', '');
		('12600f874b8b', '085756954162', 'roni ardianto', 34, 'Laki-laki', 'S1', 'Wiraswasta', '2021-01-26 03:06:51', '1', '');
		('126010b7af06', '081329112468', 'ari s', 32, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-01-27 00:45:35', '1', '');
		('126010b7e171', '085867662231', 'ardhani', 26, 'Laki-laki', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-27 00:46:25', '1', '');
		('126010cb0880', '085290531080', 'dedi', 32, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-01-27 02:08:08', '1', '');
		('126010cbda10', '085870820739', 'junnatun nadifah', 25, 'Perempuan', 'S1', 'Pelajar/Mahasiswa', '2021-01-27 02:11:38', '1', '');
		('126010ce31b6', '085700844076', 'choirul r', 30, 'Laki-laki', 'S1', 'Wiraswasta', '2021-01-27 02:21:37', '1', '');
		('126010d0d566', '082226411338', 'wulan', 30, 'Perempuan', 'SMA', 'PNS/TNI/POLRI', '2021-01-27 02:32:53', '1', '');
		('126010d6a395', '085229354789', 'muadzim', 39, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-01-27 02:57:39', '1', '');
		('126010d7fd8f', '3320041907930005', 'SELAMET', 27, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-01-27 03:03:25', '1', '');
		('126010dbdd39', '085227844468', 'sumiyati', 40, 'Perempuan', 'SMA', 'Wiraswasta', '2021-01-27 03:19:57', '1', '');
		('1260123194ad', '08122823891', 'Andi Noor Kusuma', 56, 'Laki-laki', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-28 03:37:56', '1', '');
		('12601349da0e', '08122507552', 'nikmah', 44, 'Perempuan', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-01-28 23:33:46', '1', '');
		('1260137b1b27', '081228989033', 'ibnu', 17, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2021-01-29 03:03:55', '1', '');
		('1260137c4bf1', '089674962571', 'Muhammad Rizzal Agung Saputro', 24, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-01-29 03:08:59', '1', '');
		('1260175cb6b1', '085329427574', 'hermawan oktavianto', 46, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-02-01 01:43:18', '1', '');
		('12601777b2a0', '3320132705870004', 'arif', 33, 'Laki-laki', 'SMA', 'Wiraswasta', '2021-02-01 03:38:26', '1', '');
		('12601b53b96c', '085225117335', 'naris', 28, 'Perempuan', 'S1', 'Wiraswasta', '2021-02-04 01:54:01', '1', '');
		('12601b545974', '085217262540', 'tri rusmini ningsih', 48, 'Perempuan', 'S1', 'Wiraswasta', '2021-02-04 01:56:41', '1', '');
		('12601b555690', '081228768379', 'puji lestari', 57, 'Perempuan', 'S1', 'PNS/TNI/POLRI', '2021-02-04 02:00:54', '1', '');
		('12601b56ab35', '082223544243', 'Nahari Khomsatun', 23, 'Perempuan', 'SMA', 'Lainnya', '2021-02-04 02:06:35', '1', '');
		('12601b573d6e', '085290575867', 'ahmad rofiq', 42, 'Laki-laki', 'SMA', 'Wiraswasta', '2021-02-04 02:09:01', '1', '');
		('12601b5b3dce', '085726945701', 'maksun', 45, 'Laki-laki', 'SD Kebawah', 'Lainnya', '2021-02-04 02:26:05', '1', '');
		('12601b5be5cb', '085726945701', 'maksun', 45, 'Laki-laki', 'SD Kebawah', 'Pegawai Swasta', '2021-02-04 02:28:53', '1', '');
		('12601b5c25f1', '082222217280', 'bukhori', 28, 'Laki-laki', 'S1', 'Wiraswasta', '2021-02-04 02:29:57', '1', '');
		('12601b5ccba6', '085328855536', 'amin taufik', 38, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-02-04 02:32:43', '1', '');
		('12601b5e1bdc', '3320086307900001', 'sofiyah', 30, 'Perempuan', 'SMA', 'Wiraswasta', '2021-02-04 02:38:19', '1', '');
		('12601b5fcb38', '082136208122', 'aris ariyani', 37, 'Perempuan', 'S1', 'PNS/TNI/POLRI', '2021-02-04 02:45:31', '1', '');
		('12601b6152f3', '082328280225', 'khasan', 31, 'Laki-laki', 'SMA', 'Wiraswasta', '2021-02-04 02:52:02', '1', '');
		('12601b6216d4', '3320024107970085', 'sabila', 24, 'Perempuan', 'S1', 'Pegawai Swasta', '2021-02-04 02:55:18', '1', '');
		('12601b631f26', '08122559636', 'marfuah', 62, 'Perempuan', 'SMA', 'PNS/TNI/POLRI', '2021-02-04 02:59:43', '1', '');
		('12601b649be0', '081390031123', 'fino', 17, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2021-02-04 03:06:03', '1', '');
		('12601b6d121d', '085602772053', 'AREDITA PUTRI FAJARINI', 19, 'Perempuan', 'SMA', 'Pelajar/Mahasiswa', '2021-02-04 03:42:10', '1', '');
		('12601b6ed48d', '0895634512389', 'INDAH', 23, 'Perempuan', 'S1', 'Pelajar/Mahasiswa', '2021-02-04 03:49:40', '1', '');
		('12601b70ae44', '3320116312980002', 'NANING RUNFAIDAH', 23, 'Perempuan', 'SMA', 'Wiraswasta', '2021-02-04 03:57:34', '1', '');
		('12601b718fc9', '085287278851', 'TIKA', 28, 'Perempuan', 'SMA', 'Lainnya', '2021-02-04 04:01:19', '1', '');
		('12601b726d0e', '085641721832', 'DWI ANDAYANI', 28, 'Perempuan', 'S1', 'Lainnya', '2021-02-04 04:05:01', '1', '');
		('12601b751426', '081282895880', 'NURUL HAFLAH', 27, 'Perempuan', 'S1', 'Lainnya', '2021-02-04 04:16:20', '1', '');
		('12601b776ac3', '087779547108', 'HARMANTO', 43, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-02-04 04:26:18', '1', '');
		('12601cac79d7', '08112705651', 'BUDHI', 41, 'Laki-laki', 'S2 Keatas', 'Lainnya', '2021-02-05 02:24:57', '1', '');
		('12601cb1c539', '085259238173', 'ARYA SIDIQ', 16, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2021-02-05 02:47:33', '1', '');
		('126020974725', '081325728454', 'MZ. ARIFIN', 51, 'Laki-laki', 'S2 Keatas', 'PNS/TNI/POLRI', '2021-02-08 01:43:35', '1', '');
		('1260209848a5', '0', 'ERI', 35, 'Laki-laki', 'S1', 'Pegawai Swasta', '2021-02-08 01:47:52', '1', '');
		('1260233f4a45', '081231827753', 'hery', 40, 'Laki-laki', 'SMA', 'PNS/TNI/POLRI', '2021-02-10 02:04:58', '1', '');
		('1260233f9db6', '089633409414', 'riana', 24, 'Perempuan', 'S1', 'Lainnya', '2021-02-10 02:06:21', '1', '');
		('12602340bcd7', '08122508782', 'mei handayani', 42, 'Perempuan', 'S1', 'PNS/TNI/POLRI', '2021-02-10 02:11:08', '1', '');
		('12602342d8db', '085225525004', 'hery priyasa', 53, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-02-10 02:20:08', '1', '');
		('1260234a4088', '3320066801910004', 'dyah ayu jesika ratnasari', 30, 'Perempuan', 'SMA', 'Wiraswasta', '2021-02-10 02:51:44', '1', '');
		('126024995396', '082133636751', 'Dina', 25, 'Perempuan', 'S1', 'Pegawai Swasta', '2021-02-11 02:41:23', '1', '');
		('12603437097c', '086541712535', 'yoedhi', 43, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2021-02-22 22:58:17', '1', '');
		('126034373961', '08122571917', 'cukup', 64, 'Laki-laki', 'SD Kebawah', 'Wiraswasta', '2021-02-22 22:59:05', '1', '');
		('126034376c0d', '08139888417', 'yanto', 32, 'Laki-laki', 'S1', 'Wiraswasta', '2021-02-22 22:59:56', '1', '');
		('126034379991', '085641721422', 'jumadi', 41, 'Laki-laki', 'SMP', 'Wiraswasta', '2021-02-22 23:00:41', '1', '');
		('12603437c7d4', '081390041156', 'aryani', 34, 'Perempuan', 'SMA', 'Wiraswasta', '2021-02-22 23:01:27', '1', '');
		('12603437f9ab', '08213629122', 'astutik', 36, 'Perempuan', 'SMA', 'Wiraswasta', '2021-02-22 23:02:17', '1', '');
		('12603456c642', '085726965001', 'suryadi', 54, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-02-23 01:13:42', '1', '');
		('12603c1c07aa', '082342957689', 'nurhadi', 25, 'Laki-laki', 'SMA', 'Pegawai Swasta', '2021-02-28 22:41:11', '1', '');
		('12603c1c3d74', '08213676332', 'saiful', 45, 'Laki-laki', 'SMP', 'Wiraswasta', '2021-02-28 22:42:05', '1', '');
		('12603c1c7406', '081325776889', 'ibrahim', 42, 'Laki-laki', 'SMP', 'Wiraswasta', '2021-02-28 22:43:00', '1', '');

		";
	}	

}

/* End of file M_import.php */
/* Location: ./application/modules/import_db/models/M_import.php */