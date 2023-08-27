-- MariaDB dump 10.19  Distrib 10.11.3-MariaDB, for osx10.18 (x86_64)
--
-- Host: localhost    Database: dapur_digital
-- ------------------------------------------------------
-- Server version	5.7.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `address_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `addresses_FK` (`customer_id`),
  CONSTRAINT `addresses_FK` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES
(7,1,'Rumah','Agung','088704145010','JAWA BARAT, KABUPATEN BOGOR, SUKARAJA, CIJUJUNG','Jalan darma bakti gang elang no 60, rt.2, rw. 1, Cijujung darma bakti, sukaraja, kab. bogor, 16710 Jawa Barat','16710','-6.57693','106.84112','2023-07-09 12:54:22','2023-07-09 12:54:22'),
(8,0,'Rumah','Agung','0821212','Tamalanrea Indah, Tamalanrea',NULL,'90245',NULL,NULL,'2023-07-19 07:19:52','2023-07-19 07:19:52'),
(9,0,'Rumah','Agung','0821212','Tamalanrea Indah, Tamalanrea',NULL,'90245',NULL,NULL,'2023-07-19 07:21:20','2023-07-19 07:21:20'),
(10,0,'Rumah','Agung','0821212','Tamalanrea Indah, Tamalanrea',NULL,'90245',NULL,NULL,'2023-07-19 07:22:09','2023-07-19 07:22:09'),
(11,0,'Rumah','Agung','0821212','Tamalanrea Indah, Tamalanrea',NULL,'90245',NULL,NULL,'2023-07-19 07:29:04','2023-07-19 07:29:04'),
(12,8,'Rumah','Akmal','0887041450112','Tamalanrea Indah, Tamalanrea',NULL,'90245',NULL,NULL,'2023-07-19 09:07:44','2023-07-19 09:07:44'),
(13,11,'Rumah','Salomo','6289123123123','DKI JAKARTA, KOTA JAKARTA SELATAN, JAGAKARSA, SRENGSENG SAWAH','deket masjid UP','12640','-6.35324','106.83132','2023-07-20 03:26:32','2023-07-20 03:26:32');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `banner_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES
(1,'BANNER-1686474278.jpg','Dapur Digital','https://dapur-digital-cibinong.business.site/','2023-06-11 09:03:51','2023-07-19 11:32:04');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `cart_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` bigint(20) NOT NULL,
  `price` bigint(30) NOT NULL,
  `panjang` bigint(20) DEFAULT '1',
  `lebar` bigint(20) DEFAULT '1',
  `total_price` bigint(30) NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finishing_id` bigint(20) unsigned DEFAULT NULL,
  `cutting_id` bigint(20) unsigned DEFAULT NULL,
  `finishing_price` bigint(30) DEFAULT NULL,
  `cutting_price` bigint(30) DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `luas` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `carts_FK_0` (`product_id`),
  KEY `carts_FK_1` (`cutting_id`),
  KEY `carts_FK_2` (`finishing_id`),
  KEY `carts_FK_3` (`customer_id`),
  KEY `carts_FK_4` (`user_id`),
  CONSTRAINT `carts_FK_0` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `carts_FK_1` FOREIGN KEY (`cutting_id`) REFERENCES `cuttings` (`cutting_id`),
  CONSTRAINT `carts_FK_2` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`finishing_id`),
  CONSTRAINT `carts_FK_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `carts_FK_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `satuan` enum('M','PCS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Banner',NULL,NULL,'M',NULL),
(2,'A3',NULL,NULL,'PCS',NULL),
(3,'X Banner','2022-12-22 22:10:40','2022-12-22 22:12:49','PCS',NULL),
(4,'Stempel','2023-01-09 05:12:24','2023-01-09 05:12:24','PCS',NULL),
(5,'Mug','2023-01-09 05:12:38','2023-01-09 05:12:38','PCS',NULL),
(6,'Stiker A3','2023-01-09 05:12:53','2023-01-09 05:12:53','PCS',NULL),
(7,'Kartu','2023-06-19 23:41:27','2023-06-19 23:41:27','PCS',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `couriers`
--

DROP TABLE IF EXISTS `couriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couriers` (
  `courier_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `courier_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_service_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `courier_service_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_duration_range` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_duration_unit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`courier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couriers`
--

LOCK TABLES `couriers` WRITE;
/*!40000 ALTER TABLE `couriers` DISABLE KEYS */;
INSERT INTO `couriers` VALUES
(1,NULL,NULL,'Gojek','gojek','Instant','instant','Sesuai Permintaan Instan','same_day','parcel','1 - 3','Jam',0),
(2,NULL,NULL,'Gojek','gojek','Same Day','same_day','Sesuai Permintaan dalam 8 jam','same_day','parcel','6 - 8','Jam',0),
(3,NULL,NULL,'Grab','grab','Instant','instant','Sesuai Permintaan Instan','same_day','parcel','1 - 3','Jam',0),
(4,NULL,NULL,'Grab','grab','Same Day','same_day','Sesuai Permintaan dalam 8 jam','same_day','parcel','6 - 8','Jam',0),
(5,NULL,NULL,'JNE','jne','Reguler','reg','Layanan Reguler','standard','parcel','2 - 3','Hari',1),
(6,NULL,NULL,'JNE','jne','YES','yes','Ekspres, hari berikutnya','overnight','parcel','1','Hari',1),
(7,NULL,NULL,'JNE','jne','OKE','oke','Layanan ekonomi','standard','parcel','3 - 4','Hari',1),
(8,NULL,NULL,'JNE','jne','JTR','jtr','Trucking dengan berat minimal 10 kg','standard','freight','3 - 4','Hari',1),
(9,NULL,NULL,'J&T','jnt','EZ','ez','Layanan reguler','standard','freight','2 - 3','Hari',1);
/*!40000 ALTER TABLE `couriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` bigint(20) unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(0,'Umum','','$2y$10$Y91PQwG/yuqsD53LrMJPNeXHBdgs.S5Lxx4jynk9bVjvxS2Bjoib6','','Laki - Laki','1999-01-24','logo.png','1',NULL,'2023-06-03 09:28:22',NULL,NULL,NULL),
(1,'Agung Maulana','agung040100@gmail.com','$2y$10$Y91PQwG/yuqsD53LrMJPNeXHBdgs.S5Lxx4jynk9bVjvxS2Bjoib6','6288704145010','Laki - Laki','1999-01-24','PHOTO-PROFILE-1672913295.jpg','1',NULL,'2023-06-03 09:28:22',NULL,NULL,NULL),
(7,'adi','adi@gmail.com','$2y$10$Vo16jP.q1O6iRBTsrFMsh.4VbGEntud.u9f6qi7yBF4Vr6xuk23w6','62121212112','Laki - Laki','1990-01-01','PHOTO-PROFILE-1687851313.jpg','1','2023-06-27 07:35:14','2023-06-27 07:35:56',NULL,NULL,NULL),
(8,'Akmal','akmal@gmail.com','$2y$10$zZgYEMHbf6SMaGgCduv3SecX6eSyoflyTzmnFEY224oaaYsnZVfae','08123234545','Laki - Laki','2023-07-19','logo.png','1','2023-07-19 04:57:44','2023-07-19 04:57:44',NULL,NULL,NULL),
(9,'Maria','maria@gmail.com','$2y$10$uU99uGH0kHOyimFZOuQT/eQqPPJcpxaTuxnSDSmTL9DLdszfp14za','628124245353','Perempuan',NULL,'logo.png','1','2023-07-19 05:03:28','2023-07-19 05:07:53',1,NULL,NULL),
(11,'Salomo','salomo@gmail.com','$2y$10$Jh0WZl9cZlvMshyj9.tuqOKMkA6n4I.iWKtOTrcc1R0b.RQp30UZG','6289123123123','Laki - Laki','1999-01-20','PHOTO-PROFILE-1689823358.jpg','1','2023-07-20 03:22:38','2023-07-20 03:23:29',1,NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuttings`
--

DROP TABLE IF EXISTS `cuttings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuttings` (
  `cutting_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cutting` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cutting_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`cutting_id`),
  KEY `cuttings_FK` (`category_id`),
  CONSTRAINT `cuttings_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuttings`
--

LOCK TABLES `cuttings` WRITE;
/*!40000 ALTER TABLE `cuttings` DISABLE KEYS */;
INSERT INTO `cuttings` VALUES
(2,'Potong Rapi',10000,'2022-12-23 00:25:09','2022-12-23 00:25:09',1),
(3,'Potong 2',10000,'2023-06-21 13:28:19','2023-06-21 13:30:30',2),
(4,'Stiker Potong',20000,'2023-06-21 13:30:47','2023-06-21 13:30:47',6);
/*!40000 ALTER TABLE `cuttings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishings`
--

DROP TABLE IF EXISTS `finishings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finishings` (
  `finishing_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `finishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finishing_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`finishing_id`),
  KEY `finishings_FK` (`category_id`),
  CONSTRAINT `finishings_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishings`
--

LOCK TABLES `finishings` WRITE;
/*!40000 ALTER TABLE `finishings` DISABLE KEYS */;
INSERT INTO `finishings` VALUES
(1,'Glossi',10000,'2022-12-23 00:33:58','2022-12-23 00:34:09',2),
(2,'Mata Ikan',4000,'2023-06-21 13:33:57','2023-06-21 13:34:44',1),
(3,'Laminasi Glossi',5000,'2023-06-21 13:34:27','2023-06-21 13:34:27',6);
/*!40000 ALTER TABLE `finishings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2023_05_27_154439_create_couriers_table',1),
(2,'2023_05_27_161725_create_customers_table',2),
(4,'2023_06_10_132547_create_banners_table',3),
(6,'2023_07_02_135722_create_locations_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_statuses`
--

DROP TABLE IF EXISTS `payment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_statuses` (
  `payment_status_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_statuses`
--

LOCK TABLES `payment_statuses` WRITE;
/*!40000 ALTER TABLE `payment_statuses` DISABLE KEYS */;
INSERT INTO `payment_statuses` VALUES
(1,'LUNAS',NULL,NULL),
(2,'BELUM LUNAS',NULL,NULL);
/*!40000 ALTER TABLE `payment_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES
(1,'Tunai di Toko',NULL,'2023-06-05 10:04:06'),
(2,'Midtrans',NULL,NULL),
(3,'Transfer BCA (1212121)','2023-06-05 10:04:12','2023-06-05 10:04:12');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `stock` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `weight` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `products_FK` (`category_id`),
  CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(2,'X Banner',3,191,10000,'2022-12-23 22:51:47','2023-07-22 11:27:57','PRODUCT-1673241085.jpg','Ini deskripsi',100),
(3,'Banner Flexy China',1,959,12000,'2022-12-24 09:38:31','2023-07-22 09:57:06','PRODUCT-1673241065.jpg','<div>Selamat datang di halaman produk Banner Flexy China! Apakah Anda mencari solusi periklanan yang inovatif dan efektif? Banner Flexy China adalah pilihan yang tepat untuk Anda!<br></div><div><br></div><div>Banner Flexy China dirancang dengan menggunakan material fleksibel berkualitas tinggi, memungkinkan Anda memasang pesan promosi dengan mudah dan memaksimalkan visibilitas merek Anda. Dalam dunia yang penuh persaingan ini, penting bagi bisnis Anda untuk menonjol dan menarik perhatian target audiens. Dengan desain yang menarik dan mencolok, Banner Flexy China akan memberikan daya tarik visual yang tak terlupakan.</div><div><br></div><div>Salah satu keunggulan utama dari Banner Flexy China adalah daya tahan dan ketahanannya terhadap cuaca ekstrem. Apakah itu hujan, panas, atau angin kencang, banner ini akan tetap terlihat jelas dan profesional. Anda tidak perlu khawatir tentang kerutan atau kerusakan pada banner karena material fleksibel yang digunakan memberikan perlindungan maksimal.</div><div><br></div><div>Pemasangan dan penggunaan Banner Flexy China sangatlah mudah. Dengan sistem pemasangan yang sederhana, Anda dapat dengan cepat memasang atau menggulung banner sesuai kebutuhan Anda. Ini menjadikannya solusi ideal untuk acara promosi, pameran dagang, konferensi, dan berbagai kegiatan bisnis lainnya.</div><div><br></div><div>Kami memahami bahwa setiap bisnis memiliki kebutuhan yang berbeda-beda, oleh karena itu Banner Flexy China dapat sepenuhnya disesuaikan dengan preferensi dan kebutuhan Anda. Desain yang kreatif dan informatif akan membantu meningkatkan kesadaran merek perusahaan Anda dan memberikan keunggulan kompetitif yang Anda cari.</div><div><br></div><div>Investasikan pada Banner Flexy China dan tingkatkan branding serta efektivitas promosi bisnis Anda. Dengan daya tarik visual yang tak tertandingi, Banner Flexy China akan membantu Anda mencapai hasil yang luar biasa dalam upaya pemasaran Anda.</div><div><br></div><div>Jangan lewatkan kesempatan ini! Dapatkan Banner Flexy China sekarang juga dan saksikan bagaimana pesan promosi Anda mencapai target audiens dengan gaya dan profesionalisme yang luar biasa.</div>',500),
(4,'Produk 2',2,1993,10000,'2022-12-25 09:52:54','2023-07-22 09:57:06','PRODUCT-1673241073.jpg','Ini deskripsi',1000),
(5,'Brosur',2,277,10000,'2022-12-25 18:24:57','2023-07-22 09:57:06','PRODUCT-1687217592.jpg','<div>Selamat datang di halaman produk Brosur Online! Apakah Anda membutuhkan alat promosi yang efektif untuk bisnis Anda? Brosur adalah solusi yang tepat, dan kami menyediakan brosur berkualitas tinggi yang dapat Anda beli secara online.</div><div><br></div><div>Brosur adalah media cetak yang dirancang dengan cermat untuk mempromosikan produk, layanan, acara, atau informasi penting lainnya kepada target audiens Anda. Dengan desain yang menarik dan konten yang informatif, brosur dapat menarik perhatian dan memberikan pesan yang jelas kepada calon pelanggan Anda.</div><div><br></div><div>Dalam dunia digital yang terus berkembang, membeli brosur secara online memberikan kemudahan dan kenyamanan. Anda dapat menjelajahi berbagai pilihan desain, ukuran, dan gaya brosur yang tersedia di platform kami. Tersedia pula opsi kustomisasi yang memungkinkan Anda mengubah konten, menambahkan logo atau gambar, dan memilih bahan berkualitas tinggi sesuai preferensi Anda.</div><div><br></div><div>Kami menawarkan brosur yang dicetak menggunakan teknologi mutakhir dan material berkualitas tinggi. Hal ini menjamin hasil cetakan yang tajam, warna yang cerah, dan tampilan yang profesional. Brosur kami juga tahan lama, sehingga mereka tetap terlihat hebat bahkan setelah digunakan dalam waktu yang lama.</div><div><br></div><div>Dengan membeli brosur secara online, Anda dapat menghemat waktu dan tenaga yang berharga. Cukup kunjungi situs web kami, jelajahi opsi brosur yang tersedia, pilih desain yang Anda sukai, dan lakukan pesanan dengan mudah. Tim kami akan mencetak brosur Anda dengan cermat dan mengirimkannya langsung ke pintu Anda.</div><div><br></div><div>Brosur online adalah alat promosi yang sangat efektif untuk meningkatkan visibilitas bisnis Anda. Anda dapat mendistribusikannya secara fisik di tempat-tempat strategis, menyertakannya dalam paket pengiriman, atau membagikannya melalui acara atau pertemuan bisnis. Anda juga dapat memanfaatkan kekuatan digital dengan membagikan versi elektronik brosur Anda melalui email, media sosial, atau situs web Anda.</div><div><br></div><div>Jangan lewatkan kesempatan ini untuk membeli brosur online berkualitas tinggi untuk mempromosikan bisnis Anda dengan cara yang efektif. Dengan brosur kami, Anda dapat menarik perhatian target audiens, meningkatkan kesadaran merek, dan mendorong tindakan positif dari pelanggan potensial Anda.</div><div><br></div><div>Pesan brosur online sekarang dan saksikan bagaimana pesan promosi Anda tersampaikan dengan gaya dan profesionalisme yang tak tertandingi.</div>',100),
(6,'Kartu Nama',7,489,25000,'2023-06-19 23:46:57','2023-07-22 09:57:06','PRODUCT-1687218417.jpg','<p><b>Kartu Nama</b></p><p><br></p><p>Selamat datang di dunia profesionalisme dan jaringan bisnis yang efektif dengan Kartu Nama! Kartu nama adalah produk cetak yang penting bagi siapa pun yang ingin membangun dan memperluas jaringan bisnis mereka.</p><p><br></p><p>Kartu nama kami dirancang dengan cermat untuk memberikan kesan yang kuat dan mengesankan kepada klien, mitra bisnis, dan calon pelanggan Anda. Dengan desain yang elegan dan kualitas cetakan yang tinggi, kartu nama kami akan membantu Anda membedakan diri dari kompetisi dan membuat kesan yang tak terlupakan.</p><p><br></p><p>Kartu nama kami dibuat dengan menggunakan teknologi cetak mutakhir dan bahan berkualitas terbaik. Tersedia berbagai opsi desain, termasuk pilihan warna, jenis huruf, dan layout yang memungkinkan Anda menyesuaikan kartu nama sesuai dengan kepribadian dan merek Anda. Kami juga menggunakan bahan kertas yang tahan lama dan tampilan yang elegan untuk memastikan kartu nama Anda tetap terlihat profesional dan tidak mudah rusak.</p><p><br></p><p>Selain itu, kami menyediakan layanan kustomisasi yang memungkinkan Anda menambahkan logo perusahaan, informasi kontak, situs web, dan media sosial Anda ke kartu nama. Ini akan membantu membangun kesadaran merek Anda dan memudahkan orang untuk menghubungi Anda setelah pertemuan bisnis atau acara networking.</p><p><br></p><p>Kartu nama adalah alat penting untuk menciptakan jaringan bisnis yang kuat dan mengesankan. Mereka dapat diberikan dalam pertemuan bisnis, acara konferensi, pertemuan sosial, atau disimpan dalam tempat yang mudah dijangkau. Membawa kartu nama yang profesional dan informatif menunjukkan keseriusan Anda dalam menjalankan bisnis dan menjalin hubungan yang saling menguntungkan.</p><p><br></p><p>Dengan memilih kartu nama kami, Anda dapat memiliki keyakinan bahwa Anda memberikan kesan yang profesional dan mengesankan kepada orang-orang yang Anda temui. Kami menawarkan kualitas cetak yang tinggi, pilihan desain yang menarik, dan layanan yang cepat dan andal.</p><p><br></p><p>Tingkatkan citra bisnis Anda dan jaringan Anda dengan kartu nama berkualitas tinggi dari kami. Pesan kartu nama sekarang dan siapkan diri Anda untuk meningkatkan kesuksesan bisnis Anda melalui jaringan dan kesempatan yang tak terhitung jumlahnya.</p>',100),
(7,'Produk 3',2,2999,5000,'2023-07-09 08:36:43','2023-07-22 09:57:06','PRODUCT-1688891803.jpg','<p>COBA COABA</p>',100);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = active\n0 = inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Admin Penjualan',1,'2022-11-05 07:06:26','2022-11-05 07:06:26'),
(2,'Admin Produksi',1,'2022-11-05 07:06:36','2022-11-05 07:08:33'),
(3,'Eksekutif',1,'2022-12-22 22:27:28','2022-12-22 00:00:00'),
(4,'Pelanggan',1,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `store_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sosial_media` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES
(1,'Dapur Digital Cibinong Galaxy','Ruko Galaxy, Jl Raya Bogor','2022-11-05 07:25:04','2022-12-22 17:45:31','admin-dapur-digital-cibinong@admin.com','@dapurdigital-cibinong','6288704145010'),
(2,'Cikaret','Jl Raya Bogor Jakarta','2022-11-05 07:26:14','2022-12-22 17:45:24','admin-dapur-digital-cikaret@admin.com','@dapurdigital-cikaret','6288704145011');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_lists`
--

DROP TABLE IF EXISTS `transaction_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_lists` (
  `transaction_list_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned DEFAULT NULL,
  `transaction_type_id` bigint(20) unsigned NOT NULL,
  `transaction_status_id` bigint(20) unsigned NOT NULL,
  `payment_method_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `final_price` bigint(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `payment_status_id` bigint(20) unsigned DEFAULT NULL,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci,
  `courier_id` bigint(20) unsigned DEFAULT NULL,
  `courier_price` bigint(30) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `address_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`transaction_list_id`),
  KEY `store_id` (`store_id`),
  KEY `user_id` (`user_id`),
  KEY `transaction_lists_FK_1` (`courier_id`),
  KEY `transaction_lists_FK_2` (`payment_status_id`),
  KEY `transaction_lists_FK_3` (`payment_method_id`),
  KEY `transaction_lists_FK_4` (`transaction_status_id`),
  KEY `transaction_lists_FK_5` (`transaction_type_id`),
  KEY `transaction_lists_FK` (`address_id`),
  KEY `transaction_lists_FK_6` (`customer_id`),
  CONSTRAINT `transaction_lists_FK` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`),
  CONSTRAINT `transaction_lists_FK_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`courier_id`),
  CONSTRAINT `transaction_lists_FK_2` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_statuses` (`payment_status_id`),
  CONSTRAINT `transaction_lists_FK_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payments` (`payment_id`),
  CONSTRAINT `transaction_lists_FK_4` FOREIGN KEY (`transaction_status_id`) REFERENCES `transaction_statuses` (`transaction_status_id`),
  CONSTRAINT `transaction_lists_FK_5` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`transaction_type_id`),
  CONSTRAINT `transaction_lists_FK_6` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_lists`
--

LOCK TABLES `transaction_lists` WRITE;
/*!40000 ALTER TABLE `transaction_lists` DISABLE KEYS */;
INSERT INTO `transaction_lists` VALUES
(53,1,1,2,2,0,12000,'2023-07-09 14:03:24','2023-07-10 09:44:10',1,22,1,NULL,NULL,NULL,1,NULL),
(54,1,2,5,2,0,10000,'2023-07-09 14:06:35','2023-07-10 08:54:26',1,22,2,NULL,5,10000,1,7),
(55,1,2,7,3,0,10000,'2023-07-09 14:13:46','2023-07-10 08:47:47',1,22,1,'BUKTI-PEMBAYARAN-1-1688912038.jpg',NULL,NULL,1,NULL),
(56,1,1,8,2,0,12000,'2023-07-10 07:37:35','2023-07-10 08:46:05',1,22,1,NULL,NULL,NULL,1,NULL),
(58,1,2,3,2,0,10000,'2023-07-16 07:59:29','2023-07-20 03:30:06',1,22,1,NULL,5,10000,1,7),
(59,NULL,2,1,2,NULL,20000,'2023-07-17 08:04:38','2023-07-19 10:32:10',1,NULL,2,NULL,5,10000,1,7),
(60,1,1,1,2,NULL,47000,'2023-07-18 06:22:27','2023-07-19 10:32:10',1,NULL,2,NULL,NULL,NULL,1,NULL),
(61,1,1,1,2,NULL,10000,'2023-07-19 06:24:11','2023-07-19 06:24:11',1,NULL,2,NULL,NULL,NULL,1,NULL),
(62,2,1,1,2,NULL,10000,'2023-07-19 06:24:45','2023-07-19 06:24:45',1,NULL,2,NULL,NULL,NULL,1,NULL),
(63,2,1,1,2,NULL,12000,'2023-07-20 06:25:27','2023-07-19 10:32:10',1,NULL,2,NULL,NULL,NULL,1,NULL),
(64,1,1,1,2,NULL,12000,'2023-07-19 06:27:06','2023-07-19 06:27:06',1,NULL,2,NULL,NULL,NULL,1,NULL),
(65,1,1,1,1,24,10000,'2023-07-19 07:11:28','2023-07-19 07:24:09',24,NULL,1,NULL,NULL,NULL,0,NULL),
(66,1,1,1,1,24,10000,'2023-07-19 07:16:48','2023-07-19 07:24:09',24,NULL,1,NULL,NULL,NULL,0,NULL),
(67,1,1,1,1,24,10000,'2023-07-19 07:18:19','2023-07-19 07:24:09',24,NULL,1,NULL,NULL,NULL,0,NULL),
(68,1,1,1,1,24,10000,'2023-07-19 07:19:17','2023-07-19 07:19:17',24,NULL,1,NULL,NULL,NULL,9,NULL),
(71,NULL,2,1,1,24,66000,'2023-07-19 07:22:09','2023-07-19 07:25:08',24,NULL,1,NULL,5,0,0,10),
(72,NULL,2,1,1,24,66000,'2023-07-19 07:29:04','2023-07-19 07:29:04',24,NULL,1,NULL,5,0,0,11),
(73,NULL,2,1,1,24,20000,'2023-07-19 07:30:08','2023-07-19 07:30:08',24,NULL,1,NULL,5,0,1,7),
(74,NULL,2,1,1,24,66000,'2023-07-19 09:01:34','2023-07-19 09:01:34',24,NULL,1,NULL,5,0,8,NULL),
(75,NULL,2,1,3,24,66000,'2023-07-19 09:07:44','2023-07-19 09:07:44',24,NULL,1,NULL,5,0,8,12),
(76,NULL,2,1,1,24,116000,'2023-07-19 09:08:15','2023-07-19 09:08:15',24,NULL,1,NULL,9,0,8,12),
(77,NULL,2,1,1,24,60000,'2023-07-19 09:09:34','2023-07-19 09:09:34',24,NULL,1,NULL,9,0,8,12),
(78,2,1,1,3,NULL,110000,'2023-07-19 14:41:48','2023-07-19 14:41:48',1,NULL,2,NULL,NULL,NULL,1,NULL),
(1000,1,2,7,2,0,58000,'2023-07-20 03:27:35','2023-07-20 03:30:50',11,24,1,NULL,5,20000,11,13),
(1001,2,1,1,3,NULL,48000,'2023-07-20 03:31:54','2023-07-20 03:31:54',11,NULL,2,NULL,NULL,NULL,11,NULL),
(1002,2,1,1,3,NULL,48000,'2023-07-20 03:47:53','2023-07-20 03:47:53',11,NULL,2,NULL,NULL,NULL,11,NULL),
(1003,2,1,1,3,NULL,48000,'2023-07-20 03:48:20','2023-07-20 03:48:20',11,NULL,2,NULL,NULL,NULL,11,NULL),
(1004,1,1,1,1,24,10000,'2023-07-20 03:50:08','2023-07-20 03:50:08',24,NULL,1,NULL,NULL,NULL,0,NULL),
(1005,1,1,1,1,24,58000,'2023-07-20 03:50:31','2023-07-20 03:50:31',24,NULL,1,NULL,NULL,NULL,0,NULL),
(1006,NULL,2,7,3,NULL,32000,'2023-07-20 04:31:45','2023-07-20 04:33:12',11,11,1,'BUKTI-PEMBAYARAN-11-1689827522.png',5,10000,11,13),
(1007,1,1,1,1,24,540000,'2023-07-22 09:57:06','2023-07-22 09:57:06',24,NULL,1,NULL,NULL,NULL,0,NULL),
(1008,1,1,1,1,24,10000,'2023-07-22 11:27:57','2023-07-22 11:27:57',24,NULL,1,NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `transaction_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_product_lists`
--

DROP TABLE IF EXISTS `transaction_product_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_product_lists` (
  `transaction_product_list_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_list_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` bigint(30) NOT NULL,
  `panjang` bigint(20) DEFAULT NULL,
  `lebar` bigint(20) DEFAULT NULL,
  `satuan` enum('M','PCS') DEFAULT NULL,
  `price` bigint(30) NOT NULL,
  `total_price` bigint(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `finishing_id` bigint(20) unsigned DEFAULT NULL,
  `cutting_id` bigint(20) unsigned DEFAULT NULL,
  `finishing_price` bigint(30) DEFAULT NULL,
  `cutting_price` bigint(30) DEFAULT NULL,
  `file` text,
  `luas` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`transaction_product_list_id`),
  KEY `transaction_product_lists_FK` (`transaction_list_id`),
  KEY `transaction_product_lists_FK_1` (`product_id`),
  KEY `transaction_product_lists_FK_2` (`cutting_id`),
  KEY `transaction_product_lists_FK_3` (`finishing_id`),
  CONSTRAINT `transaction_product_lists_FK` FOREIGN KEY (`transaction_list_id`) REFERENCES `transaction_lists` (`transaction_list_id`),
  CONSTRAINT `transaction_product_lists_FK_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `transaction_product_lists_FK_2` FOREIGN KEY (`cutting_id`) REFERENCES `cuttings` (`cutting_id`),
  CONSTRAINT `transaction_product_lists_FK_3` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`finishing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_product_lists`
--

LOCK TABLES `transaction_product_lists` WRITE;
/*!40000 ALTER TABLE `transaction_product_lists` DISABLE KEYS */;
INSERT INTO `transaction_product_lists` VALUES
(62,53,3,1,1,1,'M',12000,12000,'2023-07-09 14:03:24','2023-07-09 14:03:24',NULL,NULL,NULL,NULL,NULL,1),
(63,54,4,1,1,1,'PCS',10000,10000,'2023-07-09 14:06:35','2023-07-09 14:06:35',NULL,NULL,NULL,NULL,NULL,NULL),
(64,55,5,1,1,1,'PCS',10000,10000,'2023-07-09 14:13:46','2023-07-09 14:13:46',NULL,NULL,NULL,NULL,NULL,NULL),
(65,56,3,1,1,1,'M',12000,12000,'2023-07-10 07:37:35','2023-07-10 07:37:35',NULL,NULL,NULL,NULL,NULL,1),
(66,58,2,1,1,1,'PCS',10000,10000,'2023-07-10 07:59:29','2023-07-10 07:59:29',NULL,NULL,NULL,NULL,NULL,NULL),
(67,59,2,1,1,1,'PCS',10000,10000,'2023-07-10 08:04:38','2023-07-10 08:04:38',NULL,NULL,NULL,NULL,NULL,NULL),
(68,60,3,1,1,1,'M',12000,12000,'2023-07-19 06:22:27','2023-07-19 06:22:27',NULL,NULL,NULL,NULL,NULL,1),
(69,60,6,1,1,1,'PCS',25000,25000,'2023-07-19 06:22:27','2023-07-19 06:22:27',NULL,NULL,NULL,NULL,NULL,NULL),
(70,60,5,1,1,1,'PCS',10000,10000,'2023-07-19 06:22:27','2023-07-19 06:22:27',NULL,NULL,NULL,NULL,NULL,NULL),
(71,61,4,1,1,1,'PCS',10000,10000,'2023-07-19 06:24:11','2023-07-19 06:24:11',NULL,NULL,NULL,NULL,NULL,NULL),
(72,62,2,1,1,1,'PCS',10000,10000,'2023-07-19 06:24:45','2023-07-19 06:24:45',NULL,NULL,NULL,NULL,NULL,NULL),
(73,63,3,1,1,1,'M',12000,12000,'2023-07-19 06:25:27','2023-07-19 06:25:27',NULL,NULL,NULL,NULL,NULL,1),
(74,64,3,1,1,1,'M',12000,12000,'2023-07-19 06:27:06','2023-07-19 06:27:06',NULL,NULL,NULL,NULL,NULL,1),
(75,65,2,1,1,1,'PCS',10000,10000,'2023-07-19 07:11:28','2023-07-19 07:11:28',NULL,NULL,NULL,NULL,NULL,NULL),
(76,66,2,1,1,1,'PCS',10000,10000,'2023-07-19 07:16:48','2023-07-19 07:16:48',NULL,NULL,NULL,NULL,NULL,NULL),
(77,67,5,1,1,1,'PCS',10000,10000,'2023-07-19 07:18:19','2023-07-19 07:18:19',NULL,NULL,NULL,NULL,NULL,NULL),
(78,68,5,1,1,1,'PCS',10000,10000,'2023-07-19 07:19:17','2023-07-19 07:19:17',NULL,NULL,NULL,NULL,NULL,NULL),
(79,71,2,1,1,1,'PCS',10000,10000,'2023-07-19 07:22:09','2023-07-19 07:22:09',NULL,NULL,NULL,NULL,NULL,NULL),
(80,72,2,1,1,1,'PCS',10000,10000,'2023-07-19 07:29:04','2023-07-19 07:29:04',NULL,NULL,NULL,NULL,NULL,NULL),
(81,73,2,1,1,1,'PCS',10000,10000,'2023-07-19 07:30:08','2023-07-19 07:30:08',NULL,NULL,NULL,NULL,NULL,NULL),
(82,74,2,1,1,1,'PCS',10000,10000,'2023-07-19 09:01:34','2023-07-19 09:01:34',NULL,NULL,NULL,NULL,NULL,NULL),
(83,75,2,1,1,1,'PCS',10000,10000,'2023-07-19 09:07:44','2023-07-19 09:07:44',NULL,NULL,NULL,NULL,NULL,NULL),
(84,76,2,1,1,1,'PCS',10000,10000,'2023-07-19 09:08:15','2023-07-19 09:08:15',NULL,NULL,NULL,NULL,NULL,NULL),
(85,77,2,1,1,1,'PCS',10000,10000,'2023-07-19 09:09:34','2023-07-19 09:09:34',NULL,NULL,NULL,NULL,NULL,NULL),
(86,78,3,1,1,2,'M',24000,34000,'2023-07-19 14:41:48','2023-07-19 14:41:48',NULL,2,0,10000,NULL,2),
(87,78,3,1,1,2,'M',24000,28000,'2023-07-19 14:41:48','2023-07-19 14:41:48',2,NULL,4000,0,NULL,2),
(88,78,3,2,1,2,'M',24000,48000,'2023-07-19 14:41:49','2023-07-19 14:41:49',NULL,NULL,0,0,NULL,2),
(89,1000,2,1,1,1,'PCS',10000,10000,'2023-07-20 03:27:35','2023-07-20 03:27:35',NULL,NULL,NULL,NULL,NULL,NULL),
(90,1000,3,2,2,1,'M',24000,48000,'2023-07-20 03:27:35','2023-07-20 03:27:35',NULL,NULL,0,0,'CETAK-11-1689823483.jpg',2),
(91,1001,3,1,2,2,'M',48000,48000,'2023-07-20 03:31:54','2023-07-20 03:31:54',NULL,NULL,0,0,NULL,4),
(92,1002,3,1,2,2,'M',48000,48000,'2023-07-20 03:47:53','2023-07-20 03:47:53',NULL,NULL,0,0,NULL,4),
(93,1003,3,2,2,1,'M',24000,48000,'2023-07-20 03:48:20','2023-07-20 03:48:20',NULL,NULL,0,0,NULL,2),
(94,1004,2,1,1,1,'PCS',10000,10000,'2023-07-20 03:50:08','2023-07-20 03:50:08',NULL,NULL,NULL,NULL,NULL,NULL),
(95,1005,2,1,1,1,'PCS',10000,10000,'2023-07-20 03:50:31','2023-07-20 03:50:31',NULL,NULL,NULL,NULL,NULL,NULL),
(96,1005,3,1,2,2,'M',48000,48000,'2023-07-20 03:50:31','2023-07-20 03:50:31',NULL,NULL,0,0,NULL,NULL),
(97,1006,2,1,1,1,'PCS',10000,10000,'2023-07-20 04:31:45','2023-07-20 04:31:45',NULL,NULL,NULL,NULL,NULL,NULL),
(98,1006,3,1,1,1,'M',12000,12000,'2023-07-20 04:31:45','2023-07-20 04:31:45',NULL,NULL,NULL,NULL,NULL,1),
(99,1007,3,1,2,4,'M',96000,96000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,0,0,NULL,NULL),
(100,1007,3,1,4,4,'M',192000,192000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,0,0,NULL,NULL),
(101,1007,3,1,3,3,'M',108000,108000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,0,0,NULL,NULL),
(102,1007,3,1,2,3,'M',72000,72000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,0,0,NULL,NULL),
(103,1007,7,1,1,1,'PCS',5000,5000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(104,1007,6,1,1,1,'PCS',25000,25000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(105,1007,5,1,1,1,'PCS',10000,10000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(106,1007,4,1,1,1,'PCS',10000,10000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(107,1007,2,1,1,1,'PCS',10000,10000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(108,1007,3,1,1,1,'M',12000,12000,'2023-07-22 09:57:06','2023-07-22 09:57:06',NULL,NULL,NULL,NULL,NULL,NULL),
(109,1008,2,1,1,1,'PCS',10000,10000,'2023-07-22 11:27:57','2023-07-22 11:27:57',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `transaction_product_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_statuses`
--

DROP TABLE IF EXISTS `transaction_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_statuses` (
  `transaction_status_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_statuses`
--

LOCK TABLES `transaction_statuses` WRITE;
/*!40000 ALTER TABLE `transaction_statuses` DISABLE KEYS */;
INSERT INTO `transaction_statuses` VALUES
(1,'Pending',NULL,NULL),
(2,'Menunggu Konfirmasi',NULL,NULL),
(3,'Diterima',NULL,NULL),
(4,'Ditolak',NULL,NULL),
(5,'Diproses',NULL,NULL),
(6,'Dikirim',NULL,NULL),
(7,'Selesai',NULL,NULL),
(8,'Dibatalkan',NULL,NULL);
/*!40000 ALTER TABLE `transaction_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_types` (
  `transaction_type_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_types`
--

LOCK TABLES `transaction_types` WRITE;
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
INSERT INTO `transaction_types` VALUES
(1,'Diambil',NULL,NULL),
(2,'Dikirim',NULL,NULL);
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Laki - Laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `store_id` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 = Tidak Aktif, 1 = Aktif',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`),
  KEY `users_FK_1` (`store_id`),
  CONSTRAINT `users_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `users_FK_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(22,'Admin Produksi','admin_produksi','$2y$10$hAyWst66fhUcOEEoKGUG..v.Mk7NKSGcaJ8hGyOB/LrBDdu7QsXIe','2022-12-24 06:41:55','2023-01-05 08:31:19',2,'0812121212','Laki - Laki',NULL,'jalan jalan aja','PHOTO-PROFILE-1672907479.jpg',1,1),
(23,'Eksekutif','eksekutif','$2y$10$lMrkb5ozuWZ9blO3ttEEu.VFJwR..YtUoStURBfhflbqZwgkXM1aG','2022-12-24 06:51:30','2023-07-10 18:06:09',3,'081212121211','Laki - Laki','2022-12-24','Jalan Jalan Trus','PHOTO-PROFILE-1689012369.jpg',1,1),
(24,'Admin Penjualan','admin_penjualan','$2y$10$/UvPe93n0bNxX9xdLVScruL9gVlEaXPKdpRjwnxaie2Rw.ZsYSWA.','2022-12-24 07:56:34','2023-06-11 08:45:40',1,'081212121','Perempuan','1999-01-24','Jl. Jalan Kemana','PHOTO-PROFILE-1671987796.jpg',1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dapur_digital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-29 21:37:45
