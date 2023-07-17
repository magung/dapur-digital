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
(1,'BANNER-1686474278.jpg','tes','tes','2023-06-11 09:03:51','2023-06-11 09:04:38');
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
  KEY `product_id` (`product_id`),
  KEY `cutting_id` (`cutting_id`),
  KEY `finishing_id` (`finishing_id`),
  KEY `carts_FK` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES
(2,3,1,12000,1,1,26000,NULL,'M','2023-06-27 00:13:32','2023-06-27 00:13:32',2,2,4000,10000,NULL,1,24);
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
  `courier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`courier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `couriers`
--

LOCK TABLES `couriers` WRITE;
/*!40000 ALTER TABLE `couriers` DISABLE KEYS */;
INSERT INTO `couriers` VALUES
(1,NULL,NULL,'Kurir Dapur Digital'),
(2,NULL,NULL,'Gojek'),
(3,NULL,NULL,'Grab');
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
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` bigint(20) unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1,'Agung Maulana','agung040100@gmail.com','$2y$10$Y91PQwG/yuqsD53LrMJPNeXHBdgs.S5Lxx4jynk9bVjvxS2Bjoib6','6288704145010','Laki - Laki','1999-01-24','jl. jalan','PHOTO-PROFILE-1672913295.jpg','1',NULL,'2023-06-03 09:28:22',NULL,NULL,NULL),
(2,'Pelanggan 1','pelanggan1@gmail.com','$2y$10$0aAjGZGIEmN5RT/olYuCD.K3Csna4nxvEG21hC/Z8h3SZwxf9l7HK','6288704145011','Laki - Laki','2009-01-02','alammata pelanggan','PHOTO-PROFILE-1685636588.jpg','1','2023-06-01 16:23:08','2023-06-01 16:23:08',NULL,NULL,NULL),
(3,'Pelanggan2','pelanggan2@gmail.com','$2y$10$HJTqNDDaGBcErcl3661hluf51NPCFteJHRpQTj1.caOAzQ43pnD4W','6288704145012','Laki - Laki','2005-01-03','alamat palsu','PHOTO-PROFILE-1685787114.jpg','0','2023-06-03 10:11:54','2023-06-03 10:11:54',NULL,NULL,NULL),
(4,'pelanggan3','pelanggan3@gmail.com','$2y$10$Uf91r9jTV11dMW9k5c8okur48z5hgsqGnnLBbzgXmVR3tVfu6ldi6','623333333333','Laki - Laki','2023-06-01','Alamat palsu','PHOTO-PROFILE-1685787889.jpg','0','2023-06-03 10:24:49','2023-06-03 10:24:49',NULL,NULL,NULL),
(5,'pelanggan4','pelanggan4@gmail.com','$2y$10$F6V9aTACL56VGq9hzFEYQedsoURrBmDcoRCn8nPPQnWj1U7uUiTb6','6288704145013','Laki - Laki','2023-05-31','Alamatku','PHOTO-PROFILE-1685788318.jpg','0','2023-06-03 10:31:58','2023-06-03 10:31:58',NULL,NULL,NULL),
(6,'pelanggan5','pelanggan5@gmail.com','$2y$10$lDnk4WAOQWM0HIAQzlo61.p7q5jA9JEZ.CjWcTLom8615q3wGRYua','6288704145015','Laki - Laki','2023-05-31','Alamatnya','PHOTO-PROFILE-1685788407.jpg','1','2023-06-03 10:33:28','2023-06-03 10:43:17',NULL,NULL,NULL);
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
  PRIMARY KEY (`cutting_id`)
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
  PRIMARY KEY (`finishing_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2023_05_27_154439_create_couriers_table',1),
(2,'2023_05_27_161725_create_customers_table',2),
(4,'2023_06_10_132547_create_banners_table',3);
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
(2,'Transfer - BCA (123456)',NULL,NULL),
(3,'Midtrans','2023-06-05 10:04:12','2023-06-05 10:04:12');
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
  `category_id` bigint(20) NOT NULL,
  `stock` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(2,'X Banner 1',3,200,10000,'2022-12-23 22:51:47','2023-01-09 05:11:25','PRODUCT-1673241085.jpg','Ini deskripsi'),
(3,'Banner Flexy China',1,1000,12000,'2022-12-24 09:38:31','2023-06-19 23:40:42','PRODUCT-1673241065.jpg','<div>Selamat datang di halaman produk Banner Flexy China! Apakah Anda mencari solusi periklanan yang inovatif dan efektif? Banner Flexy China adalah pilihan yang tepat untuk Anda!<br></div><div><br></div><div>Banner Flexy China dirancang dengan menggunakan material fleksibel berkualitas tinggi, memungkinkan Anda memasang pesan promosi dengan mudah dan memaksimalkan visibilitas merek Anda. Dalam dunia yang penuh persaingan ini, penting bagi bisnis Anda untuk menonjol dan menarik perhatian target audiens. Dengan desain yang menarik dan mencolok, Banner Flexy China akan memberikan daya tarik visual yang tak terlupakan.</div><div><br></div><div>Salah satu keunggulan utama dari Banner Flexy China adalah daya tahan dan ketahanannya terhadap cuaca ekstrem. Apakah itu hujan, panas, atau angin kencang, banner ini akan tetap terlihat jelas dan profesional. Anda tidak perlu khawatir tentang kerutan atau kerusakan pada banner karena material fleksibel yang digunakan memberikan perlindungan maksimal.</div><div><br></div><div>Pemasangan dan penggunaan Banner Flexy China sangatlah mudah. Dengan sistem pemasangan yang sederhana, Anda dapat dengan cepat memasang atau menggulung banner sesuai kebutuhan Anda. Ini menjadikannya solusi ideal untuk acara promosi, pameran dagang, konferensi, dan berbagai kegiatan bisnis lainnya.</div><div><br></div><div>Kami memahami bahwa setiap bisnis memiliki kebutuhan yang berbeda-beda, oleh karena itu Banner Flexy China dapat sepenuhnya disesuaikan dengan preferensi dan kebutuhan Anda. Desain yang kreatif dan informatif akan membantu meningkatkan kesadaran merek perusahaan Anda dan memberikan keunggulan kompetitif yang Anda cari.</div><div><br></div><div>Investasikan pada Banner Flexy China dan tingkatkan branding serta efektivitas promosi bisnis Anda. Dengan daya tarik visual yang tak tertandingi, Banner Flexy China akan membantu Anda mencapai hasil yang luar biasa dalam upaya pemasaran Anda.</div><div><br></div><div>Jangan lewatkan kesempatan ini! Dapatkan Banner Flexy China sekarang juga dan saksikan bagaimana pesan promosi Anda mencapai target audiens dengan gaya dan profesionalisme yang luar biasa.</div>'),
(4,'Produk 2',2,2000,10000,'2022-12-25 09:52:54','2023-01-09 05:11:13','PRODUCT-1673241073.jpg','Ini deskripsi'),
(5,'Brosur',2,300,10000,'2022-12-25 18:24:57','2023-06-19 23:33:12','PRODUCT-1687217592.jpg','<div>Selamat datang di halaman produk Brosur Online! Apakah Anda membutuhkan alat promosi yang efektif untuk bisnis Anda? Brosur adalah solusi yang tepat, dan kami menyediakan brosur berkualitas tinggi yang dapat Anda beli secara online.</div><div><br></div><div>Brosur adalah media cetak yang dirancang dengan cermat untuk mempromosikan produk, layanan, acara, atau informasi penting lainnya kepada target audiens Anda. Dengan desain yang menarik dan konten yang informatif, brosur dapat menarik perhatian dan memberikan pesan yang jelas kepada calon pelanggan Anda.</div><div><br></div><div>Dalam dunia digital yang terus berkembang, membeli brosur secara online memberikan kemudahan dan kenyamanan. Anda dapat menjelajahi berbagai pilihan desain, ukuran, dan gaya brosur yang tersedia di platform kami. Tersedia pula opsi kustomisasi yang memungkinkan Anda mengubah konten, menambahkan logo atau gambar, dan memilih bahan berkualitas tinggi sesuai preferensi Anda.</div><div><br></div><div>Kami menawarkan brosur yang dicetak menggunakan teknologi mutakhir dan material berkualitas tinggi. Hal ini menjamin hasil cetakan yang tajam, warna yang cerah, dan tampilan yang profesional. Brosur kami juga tahan lama, sehingga mereka tetap terlihat hebat bahkan setelah digunakan dalam waktu yang lama.</div><div><br></div><div>Dengan membeli brosur secara online, Anda dapat menghemat waktu dan tenaga yang berharga. Cukup kunjungi situs web kami, jelajahi opsi brosur yang tersedia, pilih desain yang Anda sukai, dan lakukan pesanan dengan mudah. Tim kami akan mencetak brosur Anda dengan cermat dan mengirimkannya langsung ke pintu Anda.</div><div><br></div><div>Brosur online adalah alat promosi yang sangat efektif untuk meningkatkan visibilitas bisnis Anda. Anda dapat mendistribusikannya secara fisik di tempat-tempat strategis, menyertakannya dalam paket pengiriman, atau membagikannya melalui acara atau pertemuan bisnis. Anda juga dapat memanfaatkan kekuatan digital dengan membagikan versi elektronik brosur Anda melalui email, media sosial, atau situs web Anda.</div><div><br></div><div>Jangan lewatkan kesempatan ini untuk membeli brosur online berkualitas tinggi untuk mempromosikan bisnis Anda dengan cara yang efektif. Dengan brosur kami, Anda dapat menarik perhatian target audiens, meningkatkan kesadaran merek, dan mendorong tindakan positif dari pelanggan potensial Anda.</div><div><br></div><div>Pesan brosur online sekarang dan saksikan bagaimana pesan promosi Anda tersampaikan dengan gaya dan profesionalisme yang tak tertandingi.</div>'),
(6,'Kartu Nama',7,500,25000,'2023-06-19 23:46:57','2023-06-19 23:46:57','PRODUCT-1687218417.jpg','<p><b>Kartu Nama</b></p><p><br></p><p>Selamat datang di dunia profesionalisme dan jaringan bisnis yang efektif dengan Kartu Nama! Kartu nama adalah produk cetak yang penting bagi siapa pun yang ingin membangun dan memperluas jaringan bisnis mereka.</p><p><br></p><p>Kartu nama kami dirancang dengan cermat untuk memberikan kesan yang kuat dan mengesankan kepada klien, mitra bisnis, dan calon pelanggan Anda. Dengan desain yang elegan dan kualitas cetakan yang tinggi, kartu nama kami akan membantu Anda membedakan diri dari kompetisi dan membuat kesan yang tak terlupakan.</p><p><br></p><p>Kartu nama kami dibuat dengan menggunakan teknologi cetak mutakhir dan bahan berkualitas terbaik. Tersedia berbagai opsi desain, termasuk pilihan warna, jenis huruf, dan layout yang memungkinkan Anda menyesuaikan kartu nama sesuai dengan kepribadian dan merek Anda. Kami juga menggunakan bahan kertas yang tahan lama dan tampilan yang elegan untuk memastikan kartu nama Anda tetap terlihat profesional dan tidak mudah rusak.</p><p><br></p><p>Selain itu, kami menyediakan layanan kustomisasi yang memungkinkan Anda menambahkan logo perusahaan, informasi kontak, situs web, dan media sosial Anda ke kartu nama. Ini akan membantu membangun kesadaran merek Anda dan memudahkan orang untuk menghubungi Anda setelah pertemuan bisnis atau acara networking.</p><p><br></p><p>Kartu nama adalah alat penting untuk menciptakan jaringan bisnis yang kuat dan mengesankan. Mereka dapat diberikan dalam pertemuan bisnis, acara konferensi, pertemuan sosial, atau disimpan dalam tempat yang mudah dijangkau. Membawa kartu nama yang profesional dan informatif menunjukkan keseriusan Anda dalam menjalankan bisnis dan menjalin hubungan yang saling menguntungkan.</p><p><br></p><p>Dengan memilih kartu nama kami, Anda dapat memiliki keyakinan bahwa Anda memberikan kesan yang profesional dan mengesankan kepada orang-orang yang Anda temui. Kami menawarkan kualitas cetak yang tinggi, pilihan desain yang menarik, dan layanan yang cepat dan andal.</p><p><br></p><p>Tingkatkan citra bisnis Anda dan jaringan Anda dengan kartu nama berkualitas tinggi dari kami. Pesan kartu nama sekarang dan siapkan diri Anda untuk meningkatkan kesuksesan bisnis Anda melalui jaringan dan kesempatan yang tak terhitung jumlahnya.</p>');
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
  `store_id` bigint(20) unsigned NOT NULL,
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
  PRIMARY KEY (`transaction_list_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `payment_status_id` (`payment_status_id`),
  KEY `store_id` (`store_id`),
  KEY `transaction_status_id` (`transaction_status_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_lists`
--

LOCK TABLES `transaction_lists` WRITE;
/*!40000 ALTER TABLE `transaction_lists` DISABLE KEYS */;
INSERT INTO `transaction_lists` VALUES
(38,2,1,10,2,NULL,10000,'2023-06-11 10:51:59','2023-06-22 00:24:54',1,1,2,NULL,NULL,NULL,1),
(39,1,2,2,2,0,52000,'2023-06-13 06:42:57','2023-06-21 16:00:52',1,24,1,NULL,NULL,NULL,1),
(40,1,1,5,2,0,4422000,'2023-06-21 14:51:55','2023-06-21 16:00:39',1,24,1,'BUKTI-PEMBAYARAN-1-1687362835.jpg',NULL,NULL,1),
(41,1,1,1,3,NULL,38000,'2023-06-21 15:09:21','2023-06-21 15:09:21',1,NULL,2,NULL,NULL,NULL,1),
(42,1,1,3,2,NULL,90000,'2023-06-24 08:38:43','2023-06-24 08:40:56',1,1,1,'BUKTI-PEMBAYARAN-1-1687595980.jpg',NULL,NULL,1);
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
  KEY `cutting_id` (`cutting_id`),
  KEY `finishing_id` (`finishing_id`),
  KEY `product_id` (`product_id`),
  KEY `transaction_id` (`transaction_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_product_lists`
--

LOCK TABLES `transaction_product_lists` WRITE;
/*!40000 ALTER TABLE `transaction_product_lists` DISABLE KEYS */;
INSERT INTO `transaction_product_lists` VALUES
(40,38,2,1,1,1,'PCS',10000,10000,'2023-06-11 10:51:59','2023-06-11 10:51:59',NULL,NULL,NULL,NULL,NULL,NULL),
(41,39,3,1,1,1,'M',12000,32000,'2023-06-13 06:42:57','2023-06-13 06:42:57',1,2,10000,10000,'CETAK-1-1686612747.jpg',NULL),
(42,39,2,1,1,1,'PCS',10000,20000,'2023-06-13 06:42:57','2023-06-13 06:42:57',1,NULL,10000,0,'CETAK-1-1686610351.jpg',NULL),
(43,40,3,4,1,3,'M',36000,1296000,'2023-06-21 14:51:55','2023-06-21 14:51:55',NULL,NULL,0,0,NULL,NULL),
(44,40,2,3,1,1,'PCS',10000,30000,'2023-06-21 14:51:55','2023-06-21 14:51:55',NULL,NULL,NULL,NULL,NULL,NULL),
(45,40,3,4,2,2,'M',48000,3072000,'2023-06-21 14:51:55','2023-06-21 14:51:55',NULL,NULL,0,0,NULL,NULL),
(46,40,3,1,1,2,'M',24000,24000,'2023-06-21 14:51:55','2023-06-21 14:51:55',NULL,NULL,0,0,NULL,NULL),
(47,41,3,1,1,2,'M',24000,38000,'2023-06-21 15:09:21','2023-06-21 15:09:21',2,2,4000,10000,'CETAK-1-1687359994.jpg',2),
(48,42,2,4,1,1,'PCS',10000,40000,'2023-06-24 08:38:43','2023-06-24 08:38:43',NULL,NULL,NULL,NULL,NULL,NULL),
(49,42,6,2,1,1,'PCS',25000,50000,'2023-06-24 08:38:43','2023-06-24 08:38:43',NULL,NULL,NULL,NULL,'CETAK-1-1687594451.jpg',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_statuses`
--

LOCK TABLES `transaction_statuses` WRITE;
/*!40000 ALTER TABLE `transaction_statuses` DISABLE KEYS */;
INSERT INTO `transaction_statuses` VALUES
(1,'Pending',NULL,NULL),
(2,'Menunggu Konfirmasi',NULL,NULL),
(3,'Approved',NULL,NULL),
(4,'Rejected',NULL,NULL),
(5,'Sedang Diproses',NULL,NULL),
(6,'Selesai Diproses',NULL,NULL),
(7,'Diambil',NULL,NULL),
(8,'Dikirim',NULL,NULL),
(9,'Selesai',NULL,NULL),
(10,'Dibatalkan',NULL,NULL);
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
  `role_id` bigint(20) DEFAULT NULL,
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
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(22,'Admin Produksi','admin_produksi','$2y$10$hAyWst66fhUcOEEoKGUG..v.Mk7NKSGcaJ8hGyOB/LrBDdu7QsXIe','2022-12-24 06:41:55','2023-01-05 08:31:19',2,'0812121212','Laki - Laki',NULL,'jalan jalan aja','PHOTO-PROFILE-1672907479.jpg',1,1),
(23,'Eksekutif','eksekutif','$2y$10$lMrkb5ozuWZ9blO3ttEEu.VFJwR..YtUoStURBfhflbqZwgkXM1aG','2022-12-24 06:51:30','2022-12-24 06:51:30',3,'081212121211','Laki - Laki','2022-12-24','Jalan Jalan Trus','PHOTO-PROFILE-1671864690.jpg',1,1),
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

-- Dump completed on 2023-06-27 14:10:47
