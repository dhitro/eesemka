/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL LOCAL
 Source Server Type    : MySQL
 Source Server Version : 80032 (8.0.32)
 Source Host           : localhost:3306
 Source Schema         : eesemka

 Target Server Type    : MySQL
 Target Server Version : 80032 (8.0.32)
 File Encoding         : 65001

 Date: 20/07/2023 08:36:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eesemka_bidang
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_bidang`;
CREATE TABLE `eesemka_bidang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_bidang
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_bidang` (`id`, `nama`) VALUES (1, 'Textile');
INSERT INTO `eesemka_bidang` (`id`, `nama`) VALUES (2, 'Electronics');
INSERT INTO `eesemka_bidang` (`id`, `nama`) VALUES (3, 'Network');
INSERT INTO `eesemka_bidang` (`id`, `nama`) VALUES (4, 'Productions');
COMMIT;

-- ----------------------------
-- Table structure for eesemka_bidang_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_bidang_perusahaan`;
CREATE TABLE `eesemka_bidang_perusahaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int DEFAULT NULL,
  `id_bidang` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_bidang_perusahaan
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (16, 3, 4);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (17, 4, 3);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (22, 5, 1);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (23, 6, 2);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (25, 2, 4);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (26, 2, 3);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (27, 2, 2);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (28, 2, 1);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (33, 7, 4);
INSERT INTO `eesemka_bidang_perusahaan` (`id`, `id_perusahaan`, `id_bidang`) VALUES (34, 7, 3);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_file
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_file`;
CREATE TABLE `eesemka_file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int DEFAULT NULL,
  `id_tipefile` int DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_file
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (6, 8, 1, 'e77db205420953fd44642b116bc57b96.png', 'sirinov_smart_logo(1).png', 'c43045a4-718b-4499-91da-c2ed515ecebb', '2023-07-16 19:20:44', '2023-07-17 02:20:44', NULL);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (8, 8, 2, '13b62e65901db47f806991d82b2529fc.png', 'sirionov_db.png', 'c43045a4-718b-4499-91da-c2ed515ecebb', '2023-07-16 19:24:56', '2023-07-17 02:24:56', NULL);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (12, 8, 3, '73bd342e21683a81daee9f46abbaab4c.jpg', 'female-2.jpg', 'c43045a4-718b-4499-91da-c2ed515ecebb', '2023-07-17 03:54:24', '2023-07-17 10:54:24', 1);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (13, 18, 3, '0a0f10b77c0982023726b16bad766860.png', 'cat.png', '603bc4d2-5aa2-4995-9dbe-78f38a8bacfb', '2023-07-19 16:07:36', '2023-07-19 23:07:36', 1);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (14, 7, 3, '9856da989f3e2561da6a81a2bba79ff6.png', 'main-banner.png', '37be9cb0-3e1e-4b1f-a9dc-0f121130e9c5', '2023-07-19 17:53:46', '2023-07-20 00:53:46', 1);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (15, 3, 4, 'c6c0438c2a65be93aba0e16ec72f4554.jpg', 'bg-loker.jpg', 'e6a3ddff-576b-463f-b95a-c4671e11eebd', '2023-07-20 00:54:14', '2023-07-20 07:54:14', 1);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (16, 4, 4, 'cd1424fd6ab7ea0144ed514416385ed0.jpg', 'bg-loker.jpg', 'c9dba097-7682-4b0a-8c1d-89ac52fdb228', '2023-07-20 00:58:43', '2023-07-20 07:58:43', 1);
INSERT INTO `eesemka_file` (`id`, `id_siswa`, `id_tipefile`, `file`, `file_name`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (17, 5, 4, 'e96f732e624f1b48826ec6154e557e8b.png', 'bg-404.png', '36caa8b2-9f93-4d13-bb8d-fb192e6c61b1', '2023-07-20 01:00:47', '2023-07-20 08:00:47', 1);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_kejuruan
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_kejuruan`;
CREATE TABLE `eesemka_kejuruan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kejuruan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_kejuruan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for eesemka_kejuruan_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_kejuruan_sekolah`;
CREATE TABLE `eesemka_kejuruan_sekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sekolah` int DEFAULT NULL,
  `id_kejuruan` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_kejuruan_sekolah
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for eesemka_level
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_level`;
CREATE TABLE `eesemka_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_level
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_level` (`id`, `nama`) VALUES (1, 'Admin');
INSERT INTO `eesemka_level` (`id`, `nama`) VALUES (2, 'Sekolah');
INSERT INTO `eesemka_level` (`id`, `nama`) VALUES (3, 'Perusahaan');
INSERT INTO `eesemka_level` (`id`, `nama`) VALUES (4, 'Siswa');
INSERT INTO `eesemka_level` (`id`, `nama`) VALUES (5, 'Alumni');
COMMIT;

-- ----------------------------
-- Table structure for eesemka_lokasi
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_lokasi`;
CREATE TABLE `eesemka_lokasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_lokasi
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for eesemka_lowongan
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_lowongan`;
CREATE TABLE `eesemka_lowongan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int DEFAULT NULL,
  `nama_lowongan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `persyaratan` text COLLATE utf8mb4_general_ci,
  `status` enum('Publish','Pending','Close') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Publish',
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_lowongan
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_lowongan` (`id`, `id_perusahaan`, `nama_lowongan`, `deskripsi`, `persyaratan`, `status`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (4, 7, 'Lowongan Fresh Graduate', '<p>Lowongan Fresh Graduate</p>', '<p>Lowongan Fresh Graduate</p>', 'Pending', 'c9dba097-7682-4b0a-8c1d-89ac52fdb228', '2023-07-20 07:58:43', '2023-07-20 07:58:43', 1);
INSERT INTO `eesemka_lowongan` (`id`, `id_perusahaan`, `nama_lowongan`, `deskripsi`, `persyaratan`, `status`, `uuid`, `created_at`, `modified_at`, `created_by`) VALUES (5, 6, 'Lowongan IT Engineer', '<p>Lowongan IT</p>', '<p>Lowongan IT</p>', 'Pending', '36caa8b2-9f93-4d13-bb8d-fb192e6c61b1', '2023-07-20 08:00:47', '2023-07-20 08:17:34', 1);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_perusahaan`;
CREATE TABLE `eesemka_perusahaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `jumlah_karyawan` int DEFAULT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_perusahaan
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (2, 'PT Eesemka Deluxe', 'Jalan Karya Sejati', '<p>Perusahaan Kami Bergerak Diseluruh Bidang Bisnis</p>', 3, 'efa7719a-46ce-4635-be40-99468d0adf8c', '2023-07-16 14:11:47', '2023-07-16 22:07:27', NULL, NULL);
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (3, 'PT Alandika Utama', 'Jalan Setiabudi Medan', '<ol><li>Perusahaan Kami Bergerak Dibidang Produksi Alat Mesin Cetak</li></ol>', 4, '036cda86-54d7-4b6c-b360-f9f8f130e241', '2023-07-16 14:15:55', '2023-07-16 14:51:22', NULL, NULL);
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (4, 'PT First Media Utama', 'Jalan Mencirim Utara', '<p>Perusahaan Kami Bergerak Dibidang Jaringan</p>', 5, '2717bb21-dcb9-4b0d-ae6e-8c0a2c41ad78', '2023-07-16 14:20:21', '2023-07-16 14:52:10', NULL, NULL);
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (5, 'PT Amanah Textile', 'Jalann Panda Pingitan', '<p>Perusahaan Kami Bergerak Dibidang Textile</p>', 10, '88323df4-9643-47ec-943c-d55724431f2c', '2023-07-16 14:23:20', '2023-07-16 14:57:01', NULL, NULL);
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (6, 'PT Bina Utama Media', 'Jalan Bima Utomo ', '<p>Perusahaan Kami Bergerak Dibidang Media elektronik</p>', 45, 'b9253947-b816-4c5c-9a28-92e0a6b2f801', '2023-07-16 14:26:05', '2023-07-16 14:58:01', NULL, NULL);
INSERT INTO `eesemka_perusahaan` (`id`, `nama_perusahaan`, `alamat`, `deskripsi`, `jumlah_karyawan`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (7, 'PT Ceria Kenanga Setia', 'Jalan Sembiring Kalutan', '<p>Perusahaan Kami Bergerak Dibidang Produksi Alat-alat rumah tangga</p>', 43, '37be9cb0-3e1e-4b1f-a9dc-0f121130e9c5', '2023-07-16 14:29:06', '2023-07-20 00:48:49', NULL, 3);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_posisi
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_posisi`;
CREATE TABLE `eesemka_posisi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_posisi
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (1, 'Desain Grafis');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (2, 'Videografi');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (3, 'Fotografer');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (4, 'Drafter');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (5, 'Teknisi Listrik');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (6, 'Teknisi Elektronika');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (7, 'Teknisi Mesin');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (8, 'Front End');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (9, 'Back End');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (10, 'Waiter');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (11, 'Koki');
INSERT INTO `eesemka_posisi` (`id`, `nama`) VALUES (12, 'Perawat');
COMMIT;

-- ----------------------------
-- Table structure for eesemka_posisi_lowongan
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_posisi_lowongan`;
CREATE TABLE `eesemka_posisi_lowongan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_lowongan` int DEFAULT NULL,
  `id_posisi` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_posisi_lowongan
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_posisi_lowongan` (`id`, `id_lowongan`, `id_posisi`) VALUES (17, 4, 11);
INSERT INTO `eesemka_posisi_lowongan` (`id`, `id_lowongan`, `id_posisi`) VALUES (18, 4, 10);
INSERT INTO `eesemka_posisi_lowongan` (`id`, `id_lowongan`, `id_posisi`) VALUES (29, 5, 9);
INSERT INTO `eesemka_posisi_lowongan` (`id`, `id_lowongan`, `id_posisi`) VALUES (30, 5, 8);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_sekolah`;
CREATE TABLE `eesemka_sekolah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_sekolah
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_sekolah` (`id`, `nama_sekolah`, `alamat`, `deskripsi`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (1, 'Sekolah Teladan', 'Jalan Binjai Selatan', '<p>Deskripsi penjelasann sekolah yang didaftarakan</p>', NULL, '2023-07-15 20:52:04', '2023-07-16 10:55:34', NULL, NULL);
INSERT INTO `eesemka_sekolah` (`id`, `nama_sekolah`, `alamat`, `deskripsi`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (2, 'Sekolah Bina Bangda', 'Jalan Tegal Sari', '<p>Sekolah Berdedikasi Tinggi</p>', NULL, '2023-07-16 09:34:46', '2023-07-16 09:34:46', NULL, NULL);
INSERT INTO `eesemka_sekolah` (`id`, `nama_sekolah`, `alamat`, `deskripsi`, `uuid`, `created_at`, `modified_at`, `created_by`, `id_user`) VALUES (18, 'SMK Negeri 4 Medan', 'Jalan Seikera', '<p>Jalan Seikera</p>', '603bc4d2-5aa2-4995-9dbe-78f38a8bacfb', '2023-07-16 12:01:14', '2023-07-20 00:48:07', NULL, 2);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_siswa
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_siswa`;
CREATE TABLE `eesemka_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `id_sekolah` int DEFAULT NULL,
  `status` enum('Siswa','Alumni') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_valid` enum('Valid','Tidak Valid') COLLATE utf8mb4_general_ci DEFAULT 'Tidak Valid',
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_siswa
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_siswa` (`id`, `nik`, `nama_siswa`, `jenis_kelamin`, `alamat`, `id_sekolah`, `status`, `deskripsi`, `uuid`, `created_by`, `created_at`, `modified_at`, `is_valid`, `id_user`) VALUES (5, '1212', 'Siska Pariringan', 'Perempuan', 'Jalan Kerinci Barat', 1, 'Siswa', '<p>Siswa Ini Masih Aktif</p>', '72a5a410-8232-4d94-bf9d-9237cce87fe5', NULL, '2023-07-16 12:52:12', '2023-07-16 22:43:42', 'Tidak Valid', NULL);
INSERT INTO `eesemka_siswa` (`id`, `nik`, `nama_siswa`, `jenis_kelamin`, `alamat`, `id_sekolah`, `status`, `deskripsi`, `uuid`, `created_by`, `created_at`, `modified_at`, `is_valid`, `id_user`) VALUES (6, '1313', 'Parto Patrio', 'Laki-laki', 'Jalan Bendahawan Sejati', 18, 'Alumni', '<p>Siswa Ini Sudah Alumni</p>', '4197ba6c-cecc-4e05-9a47-e13dd71026c8', NULL, '2023-07-16 12:52:39', '2023-07-16 22:46:13', 'Valid', NULL);
INSERT INTO `eesemka_siswa` (`id`, `nik`, `nama_siswa`, `jenis_kelamin`, `alamat`, `id_sekolah`, `status`, `deskripsi`, `uuid`, `created_by`, `created_at`, `modified_at`, `is_valid`, `id_user`) VALUES (7, '1515', 'Dhanu Numingga', 'Laki-laki', 'Jalan Perjuangan Hidup', 2, 'Siswa', '<p>Mimpi Adalah Tidur</p>', '91f0e8a9-e5fc-42fa-8c0f-d12c1f0706f5', NULL, '2023-07-16 12:54:33', '2023-07-16 22:20:14', 'Tidak Valid', NULL);
INSERT INTO `eesemka_siswa` (`id`, `nik`, `nama_siswa`, `jenis_kelamin`, `alamat`, `id_sekolah`, `status`, `deskripsi`, `uuid`, `created_by`, `created_at`, `modified_at`, `is_valid`, `id_user`) VALUES (8, '133', 'Bruno Marlobo', 'Laki-laki', 'Jalan Gunung Jati', 18, 'Siswa', '<p>Hidup Perlahan Pasti Sampai Tujuan</p>', 'c43045a4-718b-4499-91da-c2ed515ecebb', NULL, '2023-07-17 00:35:49', '2023-07-20 00:45:52', 'Tidak Valid', 4);
COMMIT;

-- ----------------------------
-- Table structure for eesemka_siswa_pengalaman
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_siswa_pengalaman`;
CREATE TABLE `eesemka_siswa_pengalaman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_siswa` int DEFAULT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengalaman` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_siswa_pengalaman
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_siswa_pengalaman` (`id`, `id_siswa`, `tahun`, `pengalaman`) VALUES (33, 8, '2015', 'Manager');
INSERT INTO `eesemka_siswa_pengalaman` (`id`, `id_siswa`, `tahun`, `pengalaman`) VALUES (34, 8, '2018', 'Direktur');
COMMIT;

-- ----------------------------
-- Table structure for eesemka_tipefile
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_tipefile`;
CREATE TABLE `eesemka_tipefile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of eesemka_tipefile
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_tipefile` (`id`, `nama`) VALUES (1, 'Sertifikat Keahlian');
INSERT INTO `eesemka_tipefile` (`id`, `nama`) VALUES (2, 'Sertifikat Pendukung');
INSERT INTO `eesemka_tipefile` (`id`, `nama`) VALUES (3, 'Foto Profil');
INSERT INTO `eesemka_tipefile` (`id`, `nama`) VALUES (4, 'Foto Feeds');
COMMIT;

-- ----------------------------
-- Table structure for eesemka_user
-- ----------------------------
DROP TABLE IF EXISTS `eesemka_user`;
CREATE TABLE `eesemka_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `authKey` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `accessToken` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `is_active` int DEFAULT '0',
  `id_level` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'default.png',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of eesemka_user
-- ----------------------------
BEGIN;
INSERT INTO `eesemka_user` (`id`, `firstname`, `lastname`, `username`, `password`, `authKey`, `accessToken`, `email`, `phone`, `facebook`, `instagram`, `is_active`, `id_level`, `image`) VALUES (1, 'Admin Eesemka', 'Super', 'admin', '$2y$10$cOoydYvbunFdIcgZu.bbfeh9wayRtVqFkF8HokGikgL7oOwl6a53O', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'default.png');
INSERT INTO `eesemka_user` (`id`, `firstname`, `lastname`, `username`, `password`, `authKey`, `accessToken`, `email`, `phone`, `facebook`, `instagram`, `is_active`, `id_level`, `image`) VALUES (2, 'Sekolah 1', '', 'sekolah1', '$2y$10$cOoydYvbunFdIcgZu.bbfeh9wayRtVqFkF8HokGikgL7oOwl6a53O', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 'default.png');
INSERT INTO `eesemka_user` (`id`, `firstname`, `lastname`, `username`, `password`, `authKey`, `accessToken`, `email`, `phone`, `facebook`, `instagram`, `is_active`, `id_level`, `image`) VALUES (3, 'Perusahaan 1', '', 'perusahaan1', '$2y$10$cOoydYvbunFdIcgZu.bbfeh9wayRtVqFkF8HokGikgL7oOwl6a53O', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 'default.png');
INSERT INTO `eesemka_user` (`id`, `firstname`, `lastname`, `username`, `password`, `authKey`, `accessToken`, `email`, `phone`, `facebook`, `instagram`, `is_active`, `id_level`, `image`) VALUES (4, 'Siswa 1', '', 'siswa1', '$2y$10$cOoydYvbunFdIcgZu.bbfeh9wayRtVqFkF8HokGikgL7oOwl6a53O', NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, 'default.png');
INSERT INTO `eesemka_user` (`id`, `firstname`, `lastname`, `username`, `password`, `authKey`, `accessToken`, `email`, `phone`, `facebook`, `instagram`, `is_active`, `id_level`, `image`) VALUES (5, 'Almunni 1', '', 'alumni1', '$2y$10$cOoydYvbunFdIcgZu.bbfeh9wayRtVqFkF8HokGikgL7oOwl6a53O', NULL, NULL, NULL, NULL, NULL, NULL, 1, 5, 'default.png');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
