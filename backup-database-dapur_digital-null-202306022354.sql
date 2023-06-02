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
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `cart_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `price` bigint(30) NOT NULL,
  `panjang` bigint(20) DEFAULT '1',
  `lebar` bigint(20) DEFAULT '1',
  `total_price` bigint(30) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finishing_id` bigint(20) DEFAULT NULL,
  `cutting_id` bigint(20) DEFAULT NULL,
  `finishing_price` bigint(30) DEFAULT NULL,
  `cutting_price` bigint(30) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `cutting_id` (`cutting_id`),
  KEY `finishing_id` (`finishing_id`),
  KEY `carts_FK` (`customer_id`),
  CONSTRAINT `carts_FK` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`cutting_id`) REFERENCES `cuttings` (`cutting_id`),
  CONSTRAINT `carts_ibfk_3` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`finishing_id`)
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
  `category_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `satuan` enum('M','PCS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(6,'Stiker A3','2023-01-09 05:12:53','2023-01-09 05:12:53','PCS',NULL);
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
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1,'Agung','agung040100@gmail.com','$2y$10$Y91PQwG/yuqsD53LrMJPNeXHBdgs.S5Lxx4jynk9bVjvxS2Bjoib6','6288704145010','Laki - Laki','1999-01-24','jl. jalan','PHOTO-PROFILE-1672913295.jpg','1',NULL,NULL),
(2,'Pelanggan 1','pelanggan1@gmail.com','$2y$10$0aAjGZGIEmN5RT/olYuCD.K3Csna4nxvEG21hC/Z8h3SZwxf9l7HK','6288704145011','Laki - Laki','2009-01-02','alammata pelanggan','PHOTO-PROFILE-1685636588.jpg','1','2023-06-01 16:23:08','2023-06-01 16:23:08');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuttings`
--

DROP TABLE IF EXISTS `cuttings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuttings` (
  `cutting_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cutting` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cutting_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cutting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuttings`
--

LOCK TABLES `cuttings` WRITE;
/*!40000 ALTER TABLE `cuttings` DISABLE KEYS */;
INSERT INTO `cuttings` VALUES
(2,'Potong Rapi',10000,'2022-12-23 00:25:09','2022-12-23 00:25:09');
/*!40000 ALTER TABLE `cuttings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finishings`
--

DROP TABLE IF EXISTS `finishings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finishings` (
  `finishing_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `finishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finishing_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`finishing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finishings`
--

LOCK TABLES `finishings` WRITE;
/*!40000 ALTER TABLE `finishings` DISABLE KEYS */;
INSERT INTO `finishings` VALUES
(1,'Glossi',10000,'2022-12-23 00:33:58','2022-12-23 00:34:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2023_05_27_154439_create_couriers_table',1),
(2,'2023_05_27_161725_create_customers_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_statuses`
--

DROP TABLE IF EXISTS `payment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_statuses` (
  `payment_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `payment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES
(1,'Tunai',NULL,NULL),
(2,'Transfer - BCA (123456)',NULL,NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `stock` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(2,'X Banner 1',3,1,200,10000,'2022-12-23 22:51:47','2023-01-09 05:11:25','PRODUCT-1673241085.jpg'),
(3,'Banner Flexy',1,1,1000,12000,'2022-12-24 09:38:31','2023-01-09 05:11:05','PRODUCT-1673241065.jpg'),
(4,'Produk 2',2,1,2000,10000,'2022-12-25 09:52:54','2023-01-09 05:11:13','PRODUCT-1673241073.jpg'),
(5,'Produk 123',1,1,300,20000,'2022-12-25 18:24:57','2022-12-25 18:24:57','PRODUCT-1671992697.jpg');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `store_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sosial_media` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES
(1,'Dapur Digital Cibinong Galaxy','Ruko Galaxy, Jl Raya Bogor','2022-11-05 07:25:04','2022-12-22 17:45:31','admin@admin.com','@dapurdigital'),
(2,'Cikaret','Jl Raya Bogor Jakarta','2022-11-05 07:26:14','2022-12-22 17:45:24','admin@admin.com','@dapurdigital');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_lists`
--

DROP TABLE IF EXISTS `transaction_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_lists` (
  `transaction_list_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) NOT NULL,
  `transaction_type_id` bigint(20) NOT NULL,
  `transaction_status_id` bigint(20) NOT NULL,
  `payment_method_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `final_price` bigint(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `payment_status_id` bigint(20) DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci,
  `courier_id` bigint(20) DEFAULT NULL,
  `courier_price` bigint(30) DEFAULT NULL,
  PRIMARY KEY (`transaction_list_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `payment_status_id` (`payment_status_id`),
  KEY `store_id` (`store_id`),
  KEY `transaction_status_id` (`transaction_status_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transaction_lists_ibfk_1` FOREIGN KEY (`payment_method_id`) REFERENCES `payments` (`payment_id`),
  CONSTRAINT `transaction_lists_ibfk_2` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_statuses` (`payment_status_id`),
  CONSTRAINT `transaction_lists_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`),
  CONSTRAINT `transaction_lists_ibfk_4` FOREIGN KEY (`transaction_status_id`) REFERENCES `transaction_statuses` (`transaction_status_id`),
  CONSTRAINT `transaction_lists_ibfk_5` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`transaction_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_lists`
--

LOCK TABLES `transaction_lists` WRITE;
/*!40000 ALTER TABLE `transaction_lists` DISABLE KEYS */;
INSERT INTO `transaction_lists` VALUES
(27,1,1,1,1,0,20000,'2023-01-09 05:16:23','2023-01-09 05:16:23',24,NULL,1,NULL,NULL,NULL,NULL),
(28,1,1,1,1,0,40000,'2023-01-09 05:16:39','2023-01-09 05:16:39',24,NULL,1,NULL,NULL,NULL,NULL),
(29,2,1,1,1,1,10000,'2023-06-01 23:45:57','2023-06-01 23:45:57',1,NULL,2,NULL,NULL,NULL,NULL),
(30,2,1,1,1,1,10000,'2023-06-01 23:46:34','2023-06-01 23:46:34',1,NULL,2,NULL,NULL,NULL,NULL),
(31,2,1,1,1,1,10000,'2023-06-01 23:47:16','2023-06-01 23:47:16',1,NULL,2,NULL,NULL,NULL,NULL),
(32,2,1,1,1,1,10000,'2023-06-01 23:48:28','2023-06-01 23:48:28',1,NULL,2,NULL,NULL,NULL,NULL),
(33,2,1,1,1,1,22000,'2023-06-01 23:50:07','2023-06-01 23:50:07',1,NULL,2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `transaction_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_product_lists`
--

DROP TABLE IF EXISTS `transaction_product_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_product_lists` (
  `transaction_product_list_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_list_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` bigint(30) NOT NULL,
  `panjang` bigint(20) DEFAULT NULL,
  `lebar` bigint(20) DEFAULT NULL,
  `satuan` enum('M','PCS') DEFAULT NULL,
  `price` bigint(30) NOT NULL,
  `total_price` bigint(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `finishing_id` bigint(20) DEFAULT NULL,
  `cutting_id` bigint(20) DEFAULT NULL,
  `finishing_price` bigint(30) DEFAULT NULL,
  `cutting_price` bigint(30) DEFAULT NULL,
  PRIMARY KEY (`transaction_product_list_id`),
  KEY `cutting_id` (`cutting_id`),
  KEY `finishing_id` (`finishing_id`),
  KEY `product_id` (`product_id`),
  KEY `transaction_id` (`transaction_list_id`),
  CONSTRAINT `transaction_product_lists_ibfk_1` FOREIGN KEY (`cutting_id`) REFERENCES `cuttings` (`cutting_id`),
  CONSTRAINT `transaction_product_lists_ibfk_2` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`finishing_id`),
  CONSTRAINT `transaction_product_lists_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `transaction_product_lists_ibfk_4` FOREIGN KEY (`transaction_list_id`) REFERENCES `transaction_lists` (`transaction_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_product_lists`
--

LOCK TABLES `transaction_product_lists` WRITE;
/*!40000 ALTER TABLE `transaction_product_lists` DISABLE KEYS */;
INSERT INTO `transaction_product_lists` VALUES
(30,27,5,1,1,1,'M',20000,20000,'2023-01-09 05:16:23','2023-01-09 05:16:23',NULL,NULL,NULL,NULL),
(31,28,5,1,1,1,'M',20000,40000,'2023-01-09 05:16:39','2023-01-09 05:16:39',1,2,10000,10000),
(32,32,2,1,1,1,'PCS',10000,10000,'2023-06-01 23:48:28','2023-06-01 23:48:28',NULL,NULL,NULL,NULL),
(33,33,3,1,1,1,'M',12000,12000,'2023-06-01 23:50:07','2023-06-01 23:50:07',NULL,NULL,NULL,NULL),
(34,33,2,1,1,1,'PCS',10000,10000,'2023-06-01 23:50:07','2023-06-01 23:50:07',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `transaction_product_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_statuses`
--

DROP TABLE IF EXISTS `transaction_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_statuses` (
  `transaction_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `transaction_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `store_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 = Tidak Aktif, 1 = Aktif',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
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
(24,'Admin Penjualan','admin_penjualan','$2y$10$/UvPe93n0bNxX9xdLVScruL9gVlEaXPKdpRjwnxaie2Rw.ZsYSWA.','2022-12-24 07:56:34','2023-01-05 10:00:40',1,'081212121','Perempuan','1999-01-24','Jl. Jalan Kemana','PHOTO-PROFILE-1671987796.jpg',1,1);
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

-- Dump completed on 2023-06-02 23:54:16
