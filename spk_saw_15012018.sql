/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 5.6.20 : Database - spk_saw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`spk_saw` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;

USE `spk_saw`;

/*Table structure for table `alternatif` */

DROP TABLE IF EXISTS `alternatif`;

CREATE TABLE `alternatif` (
  `AlternatifId` int(5) NOT NULL,
  `NamaAlternatif` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`AlternatifId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `alternatif` */

insert  into `alternatif`(`AlternatifId`,`NamaAlternatif`) values (1,'Nana Setiana'),(2,'Suhendar'),(3,'Ahmad Hudri'),(4,'Aries Alfian'),(5,'Muhamad Anwar'),(6,'Mandana'),(7,'Fahri Faisal'),(8,'Karya Azis'),(9,'Suci Rahmawati'),(10,'Muhamad Ridwan'),(11,'Kiki Amalia'),(12,'Ramdani'),(13,'Sunarto'),(14,'Sugiyani'),(15,'Sopan Sopian'),(16,'Abdul Yudi');

/*Table structure for table `bobot` */

DROP TABLE IF EXISTS `bobot`;

CREATE TABLE `bobot` (
  `BobotId` int(5) NOT NULL,
  `KriteriaId` int(5) NOT NULL,
  `SubkriteriaId` int(5) NOT NULL,
  `NilaiId` int(5) NOT NULL,
  PRIMARY KEY (`BobotId`),
  KEY `fk_subkriteriaid_bobot` (`KriteriaId`,`SubkriteriaId`),
  KEY `fk_nilaiid_bobot` (`NilaiId`),
  CONSTRAINT `fk_nilaiid_bobot` FOREIGN KEY (`NilaiId`) REFERENCES `nilai` (`NilaiId`),
  CONSTRAINT `fk_subkriteriaid_bobot` FOREIGN KEY (`KriteriaId`, `SubkriteriaId`) REFERENCES `subkriteria` (`KriteriaId`, `SubkriteriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `bobot` */

insert  into `bobot`(`BobotId`,`KriteriaId`,`SubkriteriaId`,`NilaiId`) values (1,1,1,1),(2,1,2,2),(3,1,3,3),(4,1,4,4),(5,1,5,5),(6,2,6,1),(7,2,7,2),(8,2,8,3),(9,2,9,4),(10,2,10,5),(11,3,11,1),(12,3,12,2),(13,3,13,3),(14,3,14,4),(15,3,15,5),(16,4,16,1),(17,4,17,2),(18,4,18,3),(19,4,19,4),(20,5,20,1),(21,5,21,2),(22,5,22,3),(23,5,23,4),(24,5,24,5);

/*Table structure for table `groupuser` */

DROP TABLE IF EXISTS `groupuser`;

CREATE TABLE `groupuser` (
  `GroupId` int(3) NOT NULL,
  `NamaGroup` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `groupuser` */

insert  into `groupuser`(`GroupId`,`NamaGroup`) values (0,'Umum'),(1,'Administrator'),(2,'User'),(3,'Manager');

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `KriteriaId` int(5) NOT NULL,
  `NamaKriteria` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `TipeKriteria` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`KriteriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `kriteria` */

insert  into `kriteria`(`KriteriaId`,`NamaKriteria`,`TipeKriteria`) values (1,'Target Penjualan','Benefit'),(2,'Kehadiran','Cost'),(3,'Kedisiplinan','Benefit'),(4,'Lama Bekerja','Cost'),(5,'Pengalaman Bekerja','Benefit');

/*Table structure for table `menuaksessaw` */

DROP TABLE IF EXISTS `menuaksessaw`;

CREATE TABLE `menuaksessaw` (
  `GroupId` int(3) NOT NULL,
  `NoId` int(2) NOT NULL,
  `Class` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `NamaMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `ClassMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `HrefMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `TextMenu` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `DeskripsiMenu` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoId`,`GroupId`),
  KEY `FK_GroupId_aksessaw` (`GroupId`),
  CONSTRAINT `FK_GroupId_aksessaw` FOREIGN KEY (`GroupId`) REFERENCES `groupuser` (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `menuaksessaw` */

insert  into `menuaksessaw`(`GroupId`,`NoId`,`Class`,`NamaMenu`,`ClassMenu`,`HrefMenu`,`TextMenu`,`DeskripsiMenu`) values (0,1,'&#xe3fc','home1','dashboard','home','Halaman Utama','Halaman Utama'),(1,1,'&#xe3fc','home1','dashboard','home','Halaman Utama','Halaman Utama'),(2,1,'&#xe3fc','home1','dashboard','home','Halaman Utama','Halaman Utama'),(3,1,'&#xe3fc','home1','dashboard','home','Halaman Utama','Halaman Utama'),(1,2,'&#xe7ef','group1','group','group','Group User','Group User'),(1,3,'&#xe7fd','register1','register','register','Registrasi User','Registrasi User'),(3,3,'&#xe7fd','register1','register','register','Registrasi User','Registrasi User'),(1,4,'&#xe5c3','entri1','entri','#','Entri Data','Entri Data'),(2,4,'&#xe5c3','entri1','entri','#','Entri Data','Entri Data'),(1,5,'&#xe8f0','nilai1','nilai','#','Nilai Data','Nilai Data'),(2,5,'&#xe8f0','nilai1','nilai','#','Nilai Data','Nilai Data'),(0,6,'&#xe8b8','proses1','proses','proses','Proses Hitung','Proses Hitung'),(1,6,'&#xe8b8','proses1','proses','proses','Proses Hitung','Proses Hitung'),(2,6,'&#xe8b8','proses1','proses','proses','Proses Hitung','Proses Hitung'),(3,6,'&#xe8b8','proses1','proses','proses','Proses Hitung','Proses Hitung'),(1,7,'&#xe8eb','akses1','akses','akses','Akses User','Akses User'),(0,8,'&#xe555','hasil1','hasil','hasil','Hasil Perhitungan','Hasil Perhitungan'),(1,8,'&#xe555','hasil1','hasil','hasil','Hasil Perhitungan','Hasil Perhitungan'),(2,8,'&#xe555','hasil1','hasil','hasil','Hasil Perhitungan','Hasil Perhitungan'),(3,8,'&#xe555','hasil1','hasil','hasil','Hasil Perhitungan','Hasil Perhitungan');

/*Table structure for table `menuaksessawchild` */

DROP TABLE IF EXISTS `menuaksessawchild`;

CREATE TABLE `menuaksessawchild` (
  `GroupId` int(3) NOT NULL,
  `NoIdChild` int(2) NOT NULL,
  `NoId` int(2) NOT NULL,
  `Class` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `NamaMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `HrefMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `TextMenu` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `DeskripsiMenu` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoIdChild`,`NoId`,`GroupId`),
  KEY `FK_GroupId_Akses` (`NoId`,`GroupId`),
  CONSTRAINT `FK_GroupId_Akses` FOREIGN KEY (`NoId`, `GroupId`) REFERENCES `menuaksessaw` (`NoId`, `GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `menuaksessawchild` */

insert  into `menuaksessawchild`(`GroupId`,`NoIdChild`,`NoId`,`Class`,`NamaMenu`,`HrefMenu`,`TextMenu`,`DeskripsiMenu`) values (1,1,4,'','alternatif1','alternatif','Alternatif','Alternatif'),(2,1,4,'','alternatif1','alternatif','Alternatif','Alternatif'),(1,2,4,'','kriteria1','kriteria','Kriteria','Kriteria'),(2,2,4,'','kriteria1','kriteria','Kriteria','Kriteria'),(1,3,4,'','subkriteria1','subkriteria','Sub Kriteria','Sub Kriteria'),(2,3,4,'','subkriteria1','subkriteria','Sub Kriteria','Sub Kriteria'),(1,4,4,'','nilai1','nilai','Nilai Preferensi','Nilai Preferensi'),(2,4,4,'','nilai1','nilai','Nilai Preferensi','Nilai Preferensi'),(1,5,4,'','parameter1','parameter','Parameter Sistem','Parameter Sistem'),(2,5,4,'','parameter1','parameter','Parameter Sistem','Parameter Sistem'),(1,6,5,'','bobot1','bobot','Bobot Kriteria','Bobot Kriteria'),(2,6,5,'','bobot1','bobot','Bobot Kriteria','Bobot Kriteria'),(1,7,5,'','penilaian1','penilaian','Penilaian Karyawan','Penilaian Karyawan'),(2,7,5,'','penilaian1','penilaian','Penilaian Karyawan','Penilaian Karyawan');

/*Table structure for table `menusaw` */

DROP TABLE IF EXISTS `menusaw`;

CREATE TABLE `menusaw` (
  `NoId` int(2) NOT NULL,
  `Class` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `NamaMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `ClassMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `HrefMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `TextMenu` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `DeskripsiMenu` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `menusaw` */

insert  into `menusaw`(`NoId`,`Class`,`NamaMenu`,`ClassMenu`,`HrefMenu`,`TextMenu`,`DeskripsiMenu`) values (1,'&#xe3fc','home1','dashboard','home','Halaman Utama','Halaman Utama'),(2,'&#xe7ef','group1','group','group','Group User','Group User'),(3,'&#xe7fd','register1','register','register','Registrasi User','Registrasi User'),(4,'&#xe5c3','entri1','entri','#','Entri Data','Entri Data'),(5,'&#xe8f0','nilai1','nilai','#','Nilai Data','Nilai Data'),(6,'&#xe8b8','proses1','proses','proses','Proses Hitung','Proses Hitung'),(7,'&#xe8eb','akses1','akses','akses','Akses User','Akses User'),(8,'&#xe555','hasil1','hasil','hasil','Hasil Perhitungan','Hasil Perhitungan');

/*Table structure for table `menusawchild` */

DROP TABLE IF EXISTS `menusawchild`;

CREATE TABLE `menusawchild` (
  `NoIdChild` int(2) NOT NULL,
  `NoId` int(2) NOT NULL,
  `Class` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `NamaMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `HrefMenu` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `TextMenu` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `DeskripsiMenu` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`NoIdChild`),
  KEY `fk_noid` (`NoId`),
  CONSTRAINT `fk_noid` FOREIGN KEY (`NoId`) REFERENCES `menusaw` (`NoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `menusawchild` */

insert  into `menusawchild`(`NoIdChild`,`NoId`,`Class`,`NamaMenu`,`HrefMenu`,`TextMenu`,`DeskripsiMenu`) values (1,4,'','alternatif1','alternatif','Alternatif','Alternatif'),(2,4,'','kriteria1','kriteria','Kriteria','Kriteria'),(3,4,'','subkriteria1','subkriteria','Sub Kriteria','Sub Kriteria'),(4,4,'','nilai1','nilai','Nilai Preferensi','Nilai Preferensi'),(5,4,'','parameter1','parameter','Parameter Sistem','Parameter Sistem'),(6,5,'','bobot1','bobot','Bobot Kriteria','Bobot Kriteria'),(7,5,'','penilaian1','penilaian','Penilaian Karyawan','Penilaian Karyawan');

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `NilaiId` int(5) NOT NULL,
  `KetNilai` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `JmlNilai` double NOT NULL,
  PRIMARY KEY (`NilaiId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `nilai` */

insert  into `nilai`(`NilaiId`,`KetNilai`,`JmlNilai`) values (1,'Sangat Baik',10),(2,'Baik',7.5),(3,'Cukup',5),(4,'Kurang Baik',2.5),(5,'Buruk',0);

/*Table structure for table `nilai_karyawan` */

DROP TABLE IF EXISTS `nilai_karyawan`;

CREATE TABLE `nilai_karyawan` (
  `AlternatifId` int(5) NOT NULL,
  `KriteriaId` int(5) NOT NULL,
  `SubkriteriaId` int(5) NOT NULL,
  PRIMARY KEY (`AlternatifId`,`KriteriaId`,`SubkriteriaId`),
  KEY `fk_subkriteriaid_nilai` (`KriteriaId`,`SubkriteriaId`),
  CONSTRAINT `fk_alternatifid_nilai` FOREIGN KEY (`AlternatifId`) REFERENCES `alternatif` (`AlternatifId`),
  CONSTRAINT `fk_subkriteriaid_nilai` FOREIGN KEY (`KriteriaId`, `SubkriteriaId`) REFERENCES `subkriteria` (`KriteriaId`, `SubkriteriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `nilai_karyawan` */

insert  into `nilai_karyawan`(`AlternatifId`,`KriteriaId`,`SubkriteriaId`) values (2,1,1),(1,1,2),(3,1,3),(4,1,3),(6,1,3),(7,1,3),(8,1,3),(9,1,3),(10,1,3),(11,1,3),(12,1,3),(13,1,3),(15,1,3),(16,1,3),(5,1,4),(14,1,4),(2,2,6),(10,2,6),(12,2,6),(6,2,7),(9,2,7),(11,2,7),(13,2,7),(15,2,7),(1,2,8),(5,2,8),(7,2,8),(8,2,8),(16,2,8),(3,2,9),(4,2,9),(14,2,9),(10,3,11),(12,3,11),(3,3,12),(4,3,12),(6,3,12),(8,3,12),(11,3,12),(14,3,12),(16,3,12),(1,3,13),(2,3,13),(5,3,13),(7,3,13),(13,3,13),(9,3,14),(15,3,14),(3,4,16),(14,4,16),(11,4,17),(1,4,18),(2,4,18),(4,4,18),(5,4,18),(8,4,18),(12,4,18),(13,4,18),(6,4,19),(7,4,19),(9,4,19),(10,4,19),(15,4,19),(16,4,19),(3,5,20),(15,5,21),(1,5,22),(2,5,22),(8,5,22),(9,5,22),(14,5,22),(4,5,23),(5,5,23),(6,5,23),(7,5,23),(10,5,23),(11,5,23),(12,5,23),(13,5,23),(16,5,23);

/*Table structure for table `normalisasi` */

DROP TABLE IF EXISTS `normalisasi`;

CREATE TABLE `normalisasi` (
  `AlternatifId` int(5) NOT NULL,
  `KriteriaId` int(5) NOT NULL,
  `VektorX` double DEFAULT NULL,
  `VektorR` double DEFAULT NULL,
  PRIMARY KEY (`AlternatifId`,`KriteriaId`),
  KEY `fk_kriteriaid_normal` (`KriteriaId`),
  CONSTRAINT `fk_alternatifid_normal` FOREIGN KEY (`AlternatifId`) REFERENCES `alternatif` (`AlternatifId`),
  CONSTRAINT `fk_kriteriaid_normal` FOREIGN KEY (`KriteriaId`) REFERENCES `kriteria` (`KriteriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `normalisasi` */

insert  into `normalisasi`(`AlternatifId`,`KriteriaId`,`VektorX`,`VektorR`) values (1,1,0.75,5.63),(1,2,0.5,2.5),(1,3,0.5,2.5),(1,4,0.5,2.5),(1,5,0.5,2.5),(2,1,1,10),(2,2,0.25,2.5),(2,3,0.5,2.5),(2,4,0.5,2.5),(2,5,0.5,2.5),(3,1,0.5,2.5),(3,2,1,2.5),(3,3,0.75,5.63),(3,4,0.25,2.5),(3,5,1,10),(4,1,0.5,2.5),(4,2,1,2.5),(4,3,0.75,5.63),(4,4,0.5,2.5),(4,5,0.25,0.63),(5,1,0.25,0.63),(5,2,0.5,2.5),(5,3,0.5,2.5),(5,4,0.5,2.5),(5,5,0.25,0.63),(6,1,0.5,2.5),(6,2,0.33,2.48),(6,3,0.75,5.63),(6,4,1,2.5),(6,5,0.25,0.63),(7,1,0.5,2.5),(7,2,0.5,2.5),(7,3,0.5,2.5),(7,4,1,2.5),(7,5,0.25,0.63),(8,1,0.5,2.5),(8,2,0.5,2.5),(8,3,0.75,5.63),(8,4,0.5,2.5),(8,5,0.5,2.5),(9,1,0.5,2.5),(9,2,0.33,2.48),(9,3,0.25,0.63),(9,4,1,2.5),(9,5,0.5,2.5),(10,1,0.5,2.5),(10,2,0.25,2.5),(10,3,1,10),(10,4,1,2.5),(10,5,0.25,0.63),(11,1,0.5,2.5),(11,2,0.33,2.48),(11,3,0.75,5.63),(11,4,0.33,2.48),(11,5,0.25,0.63),(12,1,0.5,2.5),(12,2,0.25,2.5),(12,3,1,10),(12,4,0.5,2.5),(12,5,0.25,0.63),(13,1,0.5,2.5),(13,2,0.33,2.48),(13,3,0.5,2.5),(13,4,0.5,2.5),(13,5,0.25,0.63),(14,1,0.25,0.63),(14,2,1,2.5),(14,3,0.75,5.63),(14,4,0.25,2.5),(14,5,0.5,2.5),(15,1,0.5,2.5),(15,2,0.33,2.48),(15,3,0.25,0.63),(15,4,1,2.5),(15,5,0.75,5.63),(16,1,0.5,2.5),(16,2,0.5,2.5),(16,3,0.75,5.63),(16,4,1,2.5),(16,5,0.25,0.63);

/*Table structure for table `parameter` */

DROP TABLE IF EXISTS `parameter`;

CREATE TABLE `parameter` (
  `ParameterId` int(5) NOT NULL,
  `Tingkat` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `Kondisi` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Keterangan` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `BonusKaryawan` double DEFAULT NULL,
  PRIMARY KEY (`ParameterId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `parameter` */

insert  into `parameter`(`ParameterId`,`Tingkat`,`Kondisi`,`Keterangan`,`BonusKaryawan`) values (1,'Tingkat 1','Between 6 And 9','Antara 6 sampai dengan 9',90000),(2,'Tingkat 2','Between 10 And 15','Antara 10 sampai dengan 15',225000),(3,'Tingkat 3','>= 16','Lebih besar sama dengan 16',450000);

/*Table structure for table `rangking` */

DROP TABLE IF EXISTS `rangking`;

CREATE TABLE `rangking` (
  `RangkingId` int(5) NOT NULL AUTO_INCREMENT,
  `AlternatifId` int(5) NOT NULL,
  `VektorV` double DEFAULT NULL,
  `ParameterId` int(5) NOT NULL,
  PRIMARY KEY (`RangkingId`,`AlternatifId`),
  KEY `fk_alternatifid_rangking` (`AlternatifId`),
  KEY `fk_parameterid_rangking` (`ParameterId`),
  CONSTRAINT `fk_alternatifid_rangking` FOREIGN KEY (`AlternatifId`) REFERENCES `alternatif` (`AlternatifId`),
  CONSTRAINT `fk_parameterid_rangking` FOREIGN KEY (`ParameterId`) REFERENCES `parameter` (`ParameterId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `rangking` */

insert  into `rangking`(`RangkingId`,`AlternatifId`,`VektorV`,`ParameterId`) values (1,1,15.63,3),(2,2,20,3),(3,3,23.13,3),(4,4,13.76,2),(5,5,8.76,1),(6,6,13.74,2),(7,7,10.63,2),(8,8,15.63,3),(9,9,10.61,2),(10,10,18.13,3),(11,11,13.72,2),(12,12,18.13,3),(13,13,10.61,2),(14,14,13.76,2),(15,15,13.74,2),(16,16,13.76,2);

/*Table structure for table `subkriteria` */

DROP TABLE IF EXISTS `subkriteria`;

CREATE TABLE `subkriteria` (
  `SubkriteriaId` int(5) NOT NULL,
  `KriteriaId` int(5) NOT NULL,
  `NamaSubkriteria` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`KriteriaId`,`SubkriteriaId`),
  CONSTRAINT `fk_kriteria_id` FOREIGN KEY (`KriteriaId`) REFERENCES `kriteria` (`KriteriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `subkriteria` */

insert  into `subkriteria`(`SubkriteriaId`,`KriteriaId`,`NamaSubkriteria`) values (1,1,'Masuk target > = 100 %'),(2,1,'Masuk Target >= 75 %'),(3,1,'Masuk Target >= 50 %'),(4,1,'Masuk Target >= 25 %'),(5,1,'Masuk Target < 15 %'),(6,2,'Masuk Terus'),(7,2,'Tidak Masuk 1 Hari'),(8,2,'Tidak Masuk 2 Hari'),(9,2,'Tidak Masuk 3 Hari'),(10,2,'Tidak Masuk 4 Hari'),(11,3,'Tidak Pernah Telat'),(12,3,'Datang Telat 1 kali'),(13,3,'Datang Telat 2 kali'),(14,3,'Datang Telat 3 kali'),(15,3,'Datang Telat >= 4 kali'),(16,4,'>=4 Tahun'),(17,4,'3 Tahun'),(18,4,'2 Tahun'),(19,4,'1 Tahun'),(20,5,'>=4 Tahun'),(21,5,'3 Tahun'),(22,5,'2 Tahun'),(23,5,'1 Tahun'),(24,5,'Tidak Ada');

/*Table structure for table `userlogin` */

DROP TABLE IF EXISTS `userlogin`;

CREATE TABLE `userlogin` (
  `UserId` int(3) NOT NULL,
  `NamaUser` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `PassUser` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `NamaDepan` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `NamaBelakang` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `EmailUser` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `FotoUser` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `GroupId` int(3) NOT NULL,
  PRIMARY KEY (`UserId`),
  KEY `FK_GroupId_User` (`GroupId`),
  CONSTRAINT `FK_GroupId_User` FOREIGN KEY (`GroupId`) REFERENCES `groupuser` (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `userlogin` */

insert  into `userlogin`(`UserId`,`NamaUser`,`PassUser`,`NamaDepan`,`NamaBelakang`,`EmailUser`,`FotoUser`,`GroupId`) values (1,'admin','0192023a7bbd73250516f069df18b500','Administrator','','h.faletehan@gmail.com','552812_433146063363903_1843980130_n.jpg',1),(2,'herry','2ece84f1e0aa7d8819eb776405e364c6','Herry','Faletehan','h.faletehan@gmail.com',NULL,2),(3,'dimas','51947e3cf64ee746b6f2c73d174d525a','dimas','test','',NULL,3);

/* Function  structure for function  `getkondisi` */

/*!50003 DROP FUNCTION IF EXISTS `getkondisi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getkondisi`(v_nilai double) RETURNS varchar(30) CHARSET latin1 COLLATE latin1_general_ci
BEGIN
  DECLARE v_output varchar(30);
  declare v_temp double;
  set v_temp := round(v_nilai, 0);
  IF v_temp = 0 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 1 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 2 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 3 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 4 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 5 THEN SET v_output = '<= 5';
  ELSEIF v_temp = 6 THEN SET v_output = 'Between 6 And 9';
  ELSEIF v_temp = 7 THEN SET v_output = 'Between 6 And 9';
  ELSEIF v_temp = 8 THEN SET v_output = 'Between 6 And 9';
  ELSEIF v_temp = 9 THEN SET v_output = 'Between 6 And 9';
  ELSEIF v_temp = 10 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp = 11 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp = 12 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp = 13 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp = 14 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp = 15 THEN SET v_output = 'Between 10 And 15';
  ELSEIF v_temp >= 16 THEN SET v_output = '>= 16';
  else set v_output = '';
  End if;
  RETURN v_output;
END */$$
DELIMITER ;

/* Function  structure for function  `getrow` */

/*!50003 DROP FUNCTION IF EXISTS `getrow` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getrow`() RETURNS int(11)
    NO SQL
BEGIN
	-- SET @var=0;
	SET @var := IFNULL(@var, 0) + 1;
	RETURN @var;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetBrowseTable` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetBrowseTable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBrowseTable`(v_kode INT)
    READS SQL DATA
BEGIN
	IF v_kode = 1 THEN
		SELECT * FROM groupuser;
	ELSEIF v_kode = 2 THEN
		SELECT * FROM userlogin;
	ELSEIF v_kode = 3 THEN
		SELECT * FROM alternatif;
	ELSEIF v_kode = 4 THEN
		SELECT * FROM kriteria;
	ELSEIF v_kode = 5 THEN
		SELECT * FROM nilai;
	ELSEIF v_kode = 6 THEN
		SELECT * FROM subkriteria;
	ELSEIF v_kode = 7 THEN
		SELECT * FROM bobot;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetDataBobot` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetDataBobot` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDataBobot`()
    READS SQL DATA
BEGIN
	Select NamaKriteria, NamaSubkriteria, JmlNilai NilaiBobot, KetNilai
	From bobot b, subkriteria s, nilai n, kriteria k
	Where b.KriteriaId = s.KriteriaId And b.KriteriaId = k.KriteriaId AND b.SubkriteriaId = s.SubkriteriaId AND b.NilaiId = n.NilaiId
	Order By b.KriteriaId, s.SubkriteriaId;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetEditTable` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetEditTable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEditTable`(v_kode int, v_paramid INT)
    READS SQL DATA
BEGIN
	if v_kode = 1 Then
		SELECT * FROM groupuser WHERE GroupId = v_paramid;
	ELSEIF v_kode = 2 THEN
		SELECT * FROM userlogin WHERE UserId = v_paramid;
	ELSEIF v_kode = 3 THEN
		SELECT * FROM alternatif WHERE AlternatifId = v_paramid;
	ELSEIF v_kode = 4 THEN
		SELECT * FROM kriteria WHERE KriteriaId = v_paramid;
	ELSEIF v_kode = 5 THEN
		SELECT * FROM nilai WHERE NilaiId = v_paramid;
	ELSEIF v_kode = 6 THEN
		SELECT * FROM subkriteria WHERE SubkriteriaId = v_paramid;
	ELSEIF v_kode = 7 THEN
		SELECT * FROM bobot WHERE BobotId = v_paramid;
	ELSEIF v_kode = 8 THEN
		SELECT * FROM parameter WHERE ParameterId = v_paramid;
	End if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetGrafikRangking` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetGrafikRangking` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetGrafikRangking`(v_kode int)
    READS SQL DATA
BEGIN
	if v_kode = 1 Then
		Select (BonusKaryawan + ROUND(((VektorV / 100) * BonusKaryawan), 0)) Jumlah, NamaAlternatif
		From rangking r, alternatif a, parameter p
		Where a.AlternatifId = r.AlternatifId And r.ParameterId = p.ParameterId
		Order By a.AlternatifId Asc;
	elseif v_kode = 2 THEN
		SELECT IFNULL(VektorV, 0) Jumlah, NamaAlternatif
		FROM rangking r, alternatif a
		WHERE a.AlternatifId = r.AlternatifId
		ORDER BY a.AlternatifId ASC;
	End if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetMenuAkses` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetMenuAkses` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenuAkses`(v_groupid INT)
    READS SQL DATA
BEGIN
	SELECT * FROM menuaksessaw WHERE GroupId = v_groupid;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetMenuAksesChild` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetMenuAksesChild` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenuAksesChild`(v_groupid INT, v_menuid INT)
    READS SQL DATA
BEGIN
		SELECT * FROM menuaksessawchild WHERE NoId = v_menuid AND GroupId = v_groupid;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetMenuAksesUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetMenuAksesUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenuAksesUser`(v_groupid INT)
    READS SQL DATA
BEGIN
  SELECT m.NoId, m.Class, m.NamaMenu, m.HrefMenu, m.ClassMenu, m.TextMenu, m.DeskripsiMenu, 
  CASE WHEN GroupId IS NULL THEN '' ELSE 'checked = "checked"' END active
  FROM menusaw m
  LEFT JOIN menuaksessaw u ON u.NoId = m.NoId AND GroupId = v_groupid;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetMenuAksesUserChild` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetMenuAksesUserChild` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenuAksesUserChild`(v_idmenu INT, v_groupid INT)
    READS SQL DATA
BEGIN
		SELECT m.*, CASE WHEN u.GroupId IS NULL THEN '' ELSE 'checked = "checked"' END active 
		FROM menusawchild m
		LEFT JOIN menuaksessawchild u ON u.NoId = m.NoId AND m.NoIdChild = u.NoIdChild AND u.GroupId = v_groupid
		WHERE m.NoId = v_idmenu;
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetStruktur` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetStruktur` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStruktur`(v_database varchar(60))
    READS SQL DATA
BEGIN
  DECLARE exit_flag INT DEFAULT 0;
  DECLARE v_namatable VARCHAR(60);
  DECLARE v_typetable VARCHAR(60);
  DECLARE rst CURSOR FOR
	SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = v_database AND table_type = 'BASE TABLE';
	OPEN rst;
	fetch_loop: LOOP
		FETCH rst INTO v_namatable, v_typetable;
    IF exit_flag THEN
      LEAVE fetch_loop;
    END IF;
		SELECT c.column_name NamaKolom, CONCAT(UCASE(SUBSTRING(c.column_type, 1, 1)), LCASE(SUBSTRING(c.column_type, 2))) TypeKolom, 
		CONCAT(UCASE(SUBSTRING(constraint_name, 1, 1)), LCASE(SUBSTRING(constraint_name, 2))) PriKolom, 
		referenced_table_name ReferensiTable, referenced_column_name ReferensiKolom FROM information_schema.columns c
		LEFT JOIN information_schema.KEY_COLUMN_USAGE k ON c.table_schema = k.table_schema AND c.table_name = k.table_name 
		AND c.ordinal_position = k.ordinal_position
		WHERE c.table_schema = v_database AND c.table_name = v_namatable
		ORDER BY c.table_name, c.ordinal_position;
	END LOOP;
	CLOSE rst;
END */$$
DELIMITER ;

/* Procedure structure for procedure `UserLogin` */

/*!50003 DROP PROCEDURE IF EXISTS  `UserLogin` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `UserLogin`(v_user VARCHAR(30), v_password VARCHAR(32))
    READS SQL DATA
BEGIN
  DECLARE v_passmd5 CHAR(62);
  SET v_passmd5 := CONCAT(v_user, v_password);
	SELECT u.*, CASE WHEN FotoUser IS NULL THEN 'Usericon.png' ELSE FotoUser END FotoUser1, g.NamaGroup FROM userlogin u
	INNER JOIN groupuser g ON g.GroupId = u.GroupId
	WHERE u.NamaUser = v_user AND u.PassUser = MD5(v_passmd5);
END */$$
DELIMITER ;

/*Table structure for table `valternatif` */

DROP TABLE IF EXISTS `valternatif`;

/*!50001 DROP VIEW IF EXISTS `valternatif` */;
/*!50001 DROP TABLE IF EXISTS `valternatif` */;

/*!50001 CREATE TABLE  `valternatif`(
 `noalternatif` int(11) ,
 `NamaAlternatif` varchar(50) ,
 `action` int(5) 
)*/;

/*Table structure for table `vbobot` */

DROP TABLE IF EXISTS `vbobot`;

/*!50001 DROP VIEW IF EXISTS `vbobot` */;
/*!50001 DROP TABLE IF EXISTS `vbobot` */;

/*!50001 CREATE TABLE  `vbobot`(
 `nobobot` int(11) ,
 `NamaSubkriteria` varchar(50) ,
 `NilaiBobot` double ,
 `KetNilai` varchar(45) ,
 `action` int(5) ,
 `KriteriaId` int(5) 
)*/;

/*Table structure for table `vgroupuser` */

DROP TABLE IF EXISTS `vgroupuser`;

/*!50001 DROP VIEW IF EXISTS `vgroupuser` */;
/*!50001 DROP TABLE IF EXISTS `vgroupuser` */;

/*!50001 CREATE TABLE  `vgroupuser`(
 `nogroup` int(11) ,
 `NamaGroup` varchar(20) ,
 `action` int(3) 
)*/;

/*Table structure for table `vkriteria` */

DROP TABLE IF EXISTS `vkriteria`;

/*!50001 DROP VIEW IF EXISTS `vkriteria` */;
/*!50001 DROP TABLE IF EXISTS `vkriteria` */;

/*!50001 CREATE TABLE  `vkriteria`(
 `nokriteria` int(11) ,
 `NamaKriteria` varchar(100) ,
 `TipeKriteria` varchar(20) ,
 `action` int(5) 
)*/;

/*Table structure for table `vnilai` */

DROP TABLE IF EXISTS `vnilai`;

/*!50001 DROP VIEW IF EXISTS `vnilai` */;
/*!50001 DROP TABLE IF EXISTS `vnilai` */;

/*!50001 CREATE TABLE  `vnilai`(
 `nonilai` int(11) ,
 `KetNilai` varchar(45) ,
 `JmlNilai` double ,
 `action` int(5) 
)*/;

/*Table structure for table `vparameter` */

DROP TABLE IF EXISTS `vparameter`;

/*!50001 DROP VIEW IF EXISTS `vparameter` */;
/*!50001 DROP TABLE IF EXISTS `vparameter` */;

/*!50001 CREATE TABLE  `vparameter`(
 `noparameter` int(11) ,
 `Tingkat` varchar(15) ,
 `BonusKaryawan` double ,
 `Kondisi` varchar(30) ,
 `Keterangan` varchar(30) ,
 `action` int(5) 
)*/;

/*Table structure for table `vsubkriteria` */

DROP TABLE IF EXISTS `vsubkriteria`;

/*!50001 DROP VIEW IF EXISTS `vsubkriteria` */;
/*!50001 DROP TABLE IF EXISTS `vsubkriteria` */;

/*!50001 CREATE TABLE  `vsubkriteria`(
 `nosubkriteria` int(11) ,
 `NamaKriteria` varchar(100) ,
 `NamaSubkriteria` varchar(50) ,
 `action` int(5) ,
 `KriteriaId` int(5) 
)*/;

/*Table structure for table `vuserlogin` */

DROP TABLE IF EXISTS `vuserlogin`;

/*!50001 DROP VIEW IF EXISTS `vuserlogin` */;
/*!50001 DROP TABLE IF EXISTS `vuserlogin` */;

/*!50001 CREATE TABLE  `vuserlogin`(
 `NoUser` int(11) ,
 `NamaUser` varchar(25) ,
 `NamaDepan` varchar(25) ,
 `NamaBelakang` varchar(25) ,
 `EmailUser` varchar(30) ,
 `NamaGroup` varchar(20) ,
 `action` int(3) 
)*/;

/*Table structure for table `vuserlogin1` */

DROP TABLE IF EXISTS `vuserlogin1`;

/*!50001 DROP VIEW IF EXISTS `vuserlogin1` */;
/*!50001 DROP TABLE IF EXISTS `vuserlogin1` */;

/*!50001 CREATE TABLE  `vuserlogin1`(
 `NoUser` int(11) ,
 `NamaUser` varchar(25) ,
 `GroupId` int(3) ,
 `NamaGroup` varchar(20) 
)*/;

/*View structure for view valternatif */

/*!50001 DROP TABLE IF EXISTS `valternatif` */;
/*!50001 DROP VIEW IF EXISTS `valternatif` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `valternatif` AS select `getrow`() AS `noalternatif`,`alternatif`.`NamaAlternatif` AS `NamaAlternatif`,`alternatif`.`AlternatifId` AS `action` from `alternatif` */;

/*View structure for view vbobot */

/*!50001 DROP TABLE IF EXISTS `vbobot` */;
/*!50001 DROP VIEW IF EXISTS `vbobot` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vbobot` AS select `getrow`() AS `nobobot`,`s`.`NamaSubkriteria` AS `NamaSubkriteria`,`n`.`JmlNilai` AS `NilaiBobot`,`n`.`KetNilai` AS `KetNilai`,`b`.`BobotId` AS `action`,`s`.`KriteriaId` AS `KriteriaId` from ((`bobot` `b` join `subkriteria` `s`) join `nilai` `n`) where ((`b`.`KriteriaId` = `s`.`KriteriaId`) and (`b`.`SubkriteriaId` = `s`.`SubkriteriaId`) and (`b`.`NilaiId` = `n`.`NilaiId`)) */;

/*View structure for view vgroupuser */

/*!50001 DROP TABLE IF EXISTS `vgroupuser` */;
/*!50001 DROP VIEW IF EXISTS `vgroupuser` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vgroupuser` AS select `getrow`() AS `nogroup`,`groupuser`.`NamaGroup` AS `NamaGroup`,`groupuser`.`GroupId` AS `action` from `groupuser` */;

/*View structure for view vkriteria */

/*!50001 DROP TABLE IF EXISTS `vkriteria` */;
/*!50001 DROP VIEW IF EXISTS `vkriteria` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vkriteria` AS select `getrow`() AS `nokriteria`,`kriteria`.`NamaKriteria` AS `NamaKriteria`,`kriteria`.`TipeKriteria` AS `TipeKriteria`,`kriteria`.`KriteriaId` AS `action` from `kriteria` */;

/*View structure for view vnilai */

/*!50001 DROP TABLE IF EXISTS `vnilai` */;
/*!50001 DROP VIEW IF EXISTS `vnilai` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vnilai` AS select `getrow`() AS `nonilai`,`nilai`.`KetNilai` AS `KetNilai`,`nilai`.`JmlNilai` AS `JmlNilai`,`nilai`.`NilaiId` AS `action` from `nilai` */;

/*View structure for view vparameter */

/*!50001 DROP TABLE IF EXISTS `vparameter` */;
/*!50001 DROP VIEW IF EXISTS `vparameter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vparameter` AS select `getrow`() AS `noparameter`,`parameter`.`Tingkat` AS `Tingkat`,`parameter`.`BonusKaryawan` AS `BonusKaryawan`,`parameter`.`Kondisi` AS `Kondisi`,`parameter`.`Keterangan` AS `Keterangan`,`parameter`.`ParameterId` AS `action` from `parameter` */;

/*View structure for view vsubkriteria */

/*!50001 DROP TABLE IF EXISTS `vsubkriteria` */;
/*!50001 DROP VIEW IF EXISTS `vsubkriteria` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vsubkriteria` AS select `getrow`() AS `nosubkriteria`,`k`.`NamaKriteria` AS `NamaKriteria`,`s`.`NamaSubkriteria` AS `NamaSubkriteria`,`s`.`SubkriteriaId` AS `action`,`k`.`KriteriaId` AS `KriteriaId` from (`subkriteria` `s` join `kriteria` `k`) where (`k`.`KriteriaId` = `s`.`KriteriaId`) */;

/*View structure for view vuserlogin */

/*!50001 DROP TABLE IF EXISTS `vuserlogin` */;
/*!50001 DROP VIEW IF EXISTS `vuserlogin` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuserlogin` AS select `getrow`() AS `NoUser`,`u`.`NamaUser` AS `NamaUser`,`u`.`NamaDepan` AS `NamaDepan`,`u`.`NamaBelakang` AS `NamaBelakang`,`u`.`EmailUser` AS `EmailUser`,`g`.`NamaGroup` AS `NamaGroup`,`u`.`UserId` AS `action` from (`userlogin` `u` join `groupuser` `g`) where (`u`.`GroupId` = `g`.`GroupId`) */;

/*View structure for view vuserlogin1 */

/*!50001 DROP TABLE IF EXISTS `vuserlogin1` */;
/*!50001 DROP VIEW IF EXISTS `vuserlogin1` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuserlogin1` AS select `getrow`() AS `NoUser`,`u`.`NamaUser` AS `NamaUser`,`u`.`GroupId` AS `GroupId`,`g`.`NamaGroup` AS `NamaGroup` from (`userlogin` `u` join `groupuser` `g`) where (`u`.`GroupId` = `g`.`GroupId`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
