/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `techstore` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `techstore`;

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `admin` (`email`, `fname`, `lname`, `verification_code`, `image`) VALUES
	('akilagimhana2005@gmail.com', 'Akila', 'Gimhana', '6661e4a612a83', 'resource/Admin2.png');

CREATE TABLE IF NOT EXISTS `admin_chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `admin` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`admin`),
  KEY `fk_chat_user2_idx` (`user`),
  CONSTRAINT `fk_chat_user10` FOREIGN KEY (`admin`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user20` FOREIGN KEY (`user`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_category1_idx` (`category_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

INSERT INTO `brand` (`id`, `name`, `category_id`) VALUES
	(1, 'Apple', 1),
	(2, 'Samsung', 1),
	(3, 'Huawei', 1),
	(4, 'Sony', 1),
	(5, 'Oppo', 1),
	(6, 'Vivo', 1),
	(7, 'HTC', 1),
	(8, 'Nokia', 1),
	(9, 'GoPRO', 3),
	(10, 'Acer', 2),
	(11, 'Apple', 2),
	(12, 'Asus', 2),
	(13, 'Dell', 2),
	(14, 'HP', 2),
	(15, 'Canon', 3),
	(16, 'Sony', 3),
	(17, 'Olympus', 3),
	(18, 'Hisense', 4),
	(19, 'Samsung', 4),
	(20, 'Sony', 4),
	(21, 'TCL', 4),
	(22, 'Vizio', 4),
	(23, 'Samsung', 5);

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

INSERT INTO `cart` (`id`, `qty`, `product_id`, `user_email`) VALUES
	(40, 1, 28, 'akilagimhana2005@gmail.com');

CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Mobiles & Tablets'),
	(2, 'Computers & Laptops'),
	(3, 'Cameras'),
	(4, 'Televisions'),
	(5, 'Peripherals & Spares');

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

INSERT INTO `chat` (`id`, `content`, `date_time`, `status`, `from`, `to`) VALUES
	(1, 'Did you get order', '2022-11-21 15:47:05', 0, 'akilagimhana2005@gmail.com', 'kavishkadevinda0@gmail.com'),
	(2, 'Not Yet', '2022-11-21 15:47:35', 0, 'kavishkadevinda0@gmail.com', 'akilagimhana2005@gmail.com'),
	(3, 'Hi', '2022-11-21 15:59:42', 0, 'merajlakvidu2005@gmail.com', 'akilagimhana2005@gmail.com'),
	(4, 'mk', '2022-11-21 16:19:38', 0, 'akilagimhana2005@gmail.com', 'merajlakvidu2005@gmail.com'),
	(5, 'Are you sure', '2022-11-21 16:20:37', 0, 'akilagimhana2005@gmail.com', 'kavishkadevinda0@gmail.com'),
	(6, 'yes', '2022-11-21 16:21:12', 0, 'kavishkadevinda0@gmail.com', 'akilagimhana2005@gmail.com'),
	(8, 'no way', '2022-11-22 00:17:34', 0, 'akilagimhana2005@gmail.com', 'kavishkadevinda0@gmail.com'),
	(9, 'yeah', '2022-11-22 00:18:37', 0, 'kavishkadevinda0@gmail.com', 'akilagimhana2005@gmail.com'),
	(10, 'its late', '2022-11-22 00:19:10', 0, 'kavishkadevinda0@gmail.com', 'akilagimhana2005@gmail.com'),
	(14, 'ooh', '2022-11-22 12:41:15', 0, 'akilagimhana2005@gmail.com', 'kavishkadevinda0@gmail.com'),
	(15, 'hh', '2023-02-02 14:12:57', 0, 'akilagimhana2005@gmail.com', 'merajlakvidu2005@gmail.com');

CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO `city` (`id`, `name`, `district_id`) VALUES
	(1, 'Colombo', 14),
	(2, 'Kandy', 17),
	(3, 'Rathnapura', 20);

CREATE TABLE IF NOT EXISTS `colour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

INSERT INTO `colour` (`id`, `name`) VALUES
	(1, 'Gold'),
	(2, 'Silver'),
	(3, 'Graphite'),
	(4, 'Jet Black'),
	(5, 'Rose Gold'),
	(6, 'Pacific Blue'),
	(7, 'Red');

CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `condition` (`id`, `name`) VALUES
	(1, 'New'),
	(2, 'Used');

CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Jaffna', 3),
	(2, 'Kilinochchi', 3),
	(3, 'Mannar', 3),
	(4, 'Mullaitivu', 3),
	(5, 'Vavuniya', 3),
	(6, 'Anuradhapura', 9),
	(7, 'Polonnaruwa', 9),
	(8, 'Trincomalee', 6),
	(9, 'Batticaloa', 6),
	(10, 'Ampara', 6),
	(11, 'Puttalam', 8),
	(12, 'Kurunegala', 8),
	(13, 'Gampaha', 1),
	(14, 'Colombo', 1),
	(15, 'Kalutara', 1),
	(16, 'Matale', 7),
	(17, 'Kandy', 7),
	(18, 'Nuwara Eliya', 7),
	(19, 'Kegalle', 5),
	(20, 'Rathnapura', 5),
	(21, 'Monaragala', 4),
	(22, 'Badulla', 4),
	(23, 'Galle', 2),
	(24, 'Matara', 2),
	(25, 'Hambanthota', 2);

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

INSERT INTO `feedback` (`id`, `type`, `feedback`, `date`, `product_id`, `user_email`) VALUES
	(1, 2, 'ok', '2022-11-24 13:40:19', 4, 'akilagimhana2005@gmail.com'),
	(2, 1, 'sdfsd', '2022-11-24 14:32:17', 4, 'akilagimhana2005@gmail.com'),
	(3, 5, 'df', '2022-11-24 14:32:40', 4, 'akilagimhana2005@gmail.com'),
	(27, 1, 'fsf', '2023-04-01 13:04:44', 33, 'akilagimhana2005@gmail.com');

CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

CREATE TABLE IF NOT EXISTS `images` (
  `code` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `images` (`code`, `product_id`) VALUES
	('resource//images//iPhone 12_0_63770778a7f12.jpeg', 1),
	('resource//images//iPhone 12_1_63770778bfede.jpeg', 1),
	('resource//images//iPhone 12_2_63770778d8f5e.jpeg', 1),
	('resource/images/mobile_images/htc_u.jpg', 3),
	('resource/images/mobile_images/huawei_p20.png', 4),
	('resource/images/mobile_images/xperia_10.jpg', 5),
	('resource/images/mobile_images/oppo_a95.png', 6),
	('resource/images/mobile_images/vivo_y20.svg', 8),
	('resource//images//Samsung M02_0_63725ba084dd8.jpeg', 12),
	('resource/images/Acer E5 475G_0_6372734b1648e.jpeg', 18),
	('resource/images/Apple12 MacBook_0_637273bbc6b45.jpeg', 19),
	('resource/images/Asus X550-LB_0_63727410ef02e.jpeg', 20),
	('resource/images/Dell Inspiron 15 5000_0_637274499e637.png', 21),
	('resource/images/Hp Pro G221_0_637274935a190.jpeg', 22),
	('resource/images/GoPro 15GL_0_6372788c42b47.jpeg', 23),
	('resource/images/GoPro 15GL_1_6372788c4e267.jpeg', 23),
	('resource/images/Canon Cam_0_637278d0ab39a.jpeg', 24),
	('resource/images/FujiFilm_0_6372790251b82.jpeg', 25),
	('resource/images/Sony Len 15_0_637279438c095.jpeg', 26),
	('resource/images/Olympus 12 Cam_0_63727986f143c.jpeg', 27),
	('resource/images/Hisense TV_0_63727b756cde8.jpeg', 28),
	('resource/images/Samsung 43inch HD_0_63727bc19ed59.jpeg', 29),
	('resource/images/Sony 18inch HD Android TV_0_63727c142248c.jpeg', 30),
	('resource/images/TCL 21inch UHD_0_63727c47044af.png', 31),
	('resource/images/Vizio 21inch HD_0_63727c801c047.jpeg', 32),
	('resource//images//Bluetooth EarPods_0_63dc6e2c29803.jpeg', 33),
	('resource//images//Bluetooth EarPods_1_63dc6e2c31a79.jpeg', 33),
	('resource//images//Bluetooth EarPods_2_63dc6e2c3a621.jpeg', 33);

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3;

INSERT INTO `invoice` (`id`, `order_id`, `date`, `total`, `qty`, `status`, `user_email`, `product_id`) VALUES
	(61, '642ad371e1147', '2023-04-03 18:54:24', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(62, '642ad3a583557', '2023-04-03 18:55:41', 22000, 1, 0, 'akilagimhana2005@gmail.com', 5),
	(63, '642ad3a583557', '2023-04-03 18:55:41', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(64, '', '2023-04-03 19:34:20', 22000, 1, 0, 'akilagimhana2005@gmail.com', 5),
	(65, '', '2023-04-03 19:34:20', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(66, '642add31d1c1a', '2023-04-03 19:36:03', 4500, 2, 0, 'akilagimhana2005@gmail.com', 33),
	(67, '642add31d1c1a', '2023-04-03 19:36:04', 334000, 1, 0, 'akilagimhana2005@gmail.com', 24),
	(68, '642e8e72a36aa', '2023-04-06 14:49:47', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(69, '642f8d7c36ac5', '2023-04-07 08:58:12', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(70, '642fa1257f424', '2023-04-07 10:21:14', 20500, 1, 2, 'akilagimhana2005@gmail.com', 4),
	(71, '642fa1257f424', '2023-04-07 10:21:14', 2500, 1, 0, 'akilagimhana2005@gmail.com', 33),
	(72, '642fa1257f424', '2023-04-07 10:21:14', 102000, 1, 0, 'akilagimhana2005@gmail.com', 32),
	(73, '642fa1257f424', '2023-04-07 10:21:14', 91000, 1, 0, 'akilagimhana2005@gmail.com', 31);

CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

INSERT INTO `model` (`id`, `name`, `brand_id`) VALUES
	(1, 'U Ultra', 7),
	(2, 'P20 Pro', 3),
	(3, 'iPhone 12', 1),
	(4, 'A9', 5),
	(5, 'Y20', 6),
	(6, 'S6', 2),
	(7, 'Xperia', 4),
	(8, 'GoPRO', 9),
	(9, 'M02', 2),
	(10, 'E5 475G', 10),
	(11, 'apple 12 Mac Book', 11),
	(12, 'X550-LB', 12),
	(13, 'Inspiron 15', 13),
	(14, 'Pro G2', 14),
	(15, 'Go Pro 1', 9),
	(16, 'Canon', 15),
	(17, 'Fuji Film', 16),
	(18, 'len 15', 16),
	(19, 'Olympus 12Cam', 17),
	(20, 'Hisense', 18),
	(21, 'Samsung', 19),
	(22, 'Sony', 20),
	(23, 'TCL', 21),
	(24, 'Vizio', 22),
	(25, 'Samsung', 23);

CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES
	(1, 1, 3),
	(2, 9, 8),
	(3, 7, 1),
	(4, 3, 2),
	(5, 4, 7),
	(6, 5, 4),
	(7, 2, 6),
	(8, 6, 5),
	(9, 2, 9),
	(10, 11, 11),
	(11, 12, 12),
	(12, 13, 13),
	(13, 14, 14),
	(14, 10, 10),
	(15, 9, 15),
	(16, 15, 16),
	(17, 16, 17),
	(18, 16, 18),
	(19, 17, 19),
	(20, 18, 20),
	(21, 19, 21),
	(22, 20, 22),
	(23, 21, 23),
	(24, 22, 24),
	(25, 23, 25),
	(26, 1, 2),
	(27, 9, 13),
	(28, 18, 15);

CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `colour_id` int NOT NULL,
  `status_id` int NOT NULL,
  `condition_id` int NOT NULL,
  `price` double DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `description` text,
  `title` varchar(45) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `discount` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_colour1_idx` (`colour_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_colour1` FOREIGN KEY (`colour_id`) REFERENCES `colour` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3;

INSERT INTO `product` (`id`, `category_id`, `model_has_brand_id`, `colour_id`, `status_id`, `condition_id`, `price`, `qty`, `description`, `title`, `user_email`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `discount`) VALUES
	(1, 1, 1, 1, 1, 1, 25000, '5', 'Good Product', 'iPhone 12', 'akilagimhana2005@gmail.com', '2022-11-13 18:24:50', 1000, 1500, 10),
	(3, 1, 3, 4, 1, 1, 43000, '10', 'Good Product', 'HTC U Ultra', 'akilagimhana2005@gmail.com', '2022-11-13 18:25:20', 1000, 1500, 5),
	(4, 1, 4, 1, 1, 1, 19000, '19', 'Good Product', 'Huawei P20 Pro', 'akilagimhana2005@gmail.com', '2022-11-13 18:25:21', 1000, 1500, 4),
	(5, 1, 5, 6, 1, 1, 20000, '6', 'Good Product', 'X Peria 7', 'akilagimhana2005@gmail.com', '2022-11-13 18:25:22', 1000, 2000, 5),
	(6, 1, 6, 3, 1, 1, 15000, '12', 'Good Product', 'Oppo A9', 'akilagimhana2005@gmail.com', '2022-11-02 18:26:29', 1000, 2000, 5),
	(8, 1, 8, 5, 1, 1, 34000, '9', 'Good Product', 'Vivo Y20', 'akilagimhana2005@gmail.com', '2022-11-09 18:26:38', 1000, 1500, 0),
	(12, 1, 9, 2, 1, 1, 28000, '13', 'Product details of Realme C11 2GB RAM 32GB ROM-TRCSL Approved\r\n5000mAh Massive Battery\r\nSupport Reverse Charging\r\nSuper Power Saving Mode\r\n16.5cm (6.5â) Large Display with 89.5% Screen-to-body Ratio\r\nGeometric Design\r\n2+32GB Large Storage\r\n3-Card Slots-2 SIM + 1 microSD\r\n1080P Video Recording', 'Samsung M02', 'akilagimhana2005@gmail.com', '2022-11-06 17:24:19', 500, 1000, 0),
	(18, 2, 14, 2, 1, 1, 300000, '8', 'Good Product', 'Acer E5 475G', 'akilagimhana2005@gmail.com', '2022-11-06 22:26:42', 1000, 2000, 2),
	(19, 2, 10, 3, 1, 1, 350000, '12', 'Good Product', 'Apple12 MacBook', 'akilagimhana2005@gmail.com', '2022-11-14 22:28:35', 1000, 2000, 1),
	(20, 2, 11, 4, 1, 1, 220000, '4', 'Good Product', 'Asus X550-LB', 'akilagimhana2005@gmail.com', '2022-11-06 22:30:00', 1000, 2000, 0),
	(21, 2, 12, 4, 1, 2, 99000, '11', 'Good Product', 'Dell Inspiron 15 5000', 'akilagimhana2005@gmail.com', '2022-11-05 22:30:57', 1000, 2000, 3),
	(22, 2, 13, 2, 1, 2, 88000, '2', 'Good Product', 'Hp Pro G221', 'akilagimhana2005@gmail.com', '2022-11-05 22:32:11', 1000, 2000, 0),
	(23, 3, 2, 4, 1, 1, 400000, '4', 'Good Quality', 'GoPro 15GL', 'akilagimhana2005@gmail.com', '2022-11-05 22:49:08', 500, 1000, 5),
	(24, 3, 16, 4, 1, 1, 333000, '5', 'Good Quality', 'Canon Cam', 'akilagimhana2005@gmail.com', '2022-11-14 22:50:16', 500, 1000, 0),
	(25, 3, 17, 4, 1, 1, 220000, '1', 'Good Quality', 'FujiFilm', 'akilagimhana2005@gmail.com', '2022-11-05 22:51:06', 500, 1000, 4),
	(26, 3, 18, 4, 1, 2, 88000, '1', 'Good Quality', 'Sony Len 15', 'akilagimhana2005@gmail.com', '2022-11-06 22:52:11', 500, 1000, 0),
	(27, 3, 19, 4, 1, 1, 88000, '4', 'Good Quality', 'Olympus 12 Cam', 'akilagimhana2005@gmail.com', '2022-11-05 22:53:18', 500, 1000, 1),
	(28, 4, 20, 3, 1, 1, 69000, '5', 'Good Product', 'Hisense TV', 'akilagimhana2005@gmail.com', '2022-11-14 23:01:33', 1500, 2000, 0),
	(29, 4, 21, 4, 1, 1, 88000, '5', 'Good Product', 'Samsung 43inch HD', 'akilagimhana2005@gmail.com', '2022-11-06 23:02:49', 1500, 2000, 0),
	(30, 4, 22, 4, 1, 1, 97000, '8', 'Good Product', 'Sony 18inch HD Android TV', 'akilagimhana2005@gmail.com', '2022-11-06 23:04:12', 1500, 2000, 6),
	(31, 4, 23, 6, 1, 1, 89000, '2', 'Good Product', 'TCL 21inch UHD', 'akilagimhana2005@gmail.com', '2022-11-07 23:05:02', 1500, 2000, 0),
	(32, 4, 24, 4, 1, 1, 100000, '5', 'Good Product', 'Vizio 21inch HD', 'akilagimhana2005@gmail.com', '2022-11-04 23:06:00', 1500, 2000, 0),
	(33, 5, 25, 4, 1, 1, 2000, '7', 'Good Product ', 'Bluetooth EarPods', 'akilagimhana2005@gmail.com', '2022-11-14 23:15:37', 200, 500, 10);

CREATE TABLE IF NOT EXISTS `profile_image` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `profile_image` (`path`, `user_email`) VALUES
	('resource//Profile_images//Akila_642fa175aed31.jpeg', 'akilagimhana2005@gmail.com');

CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Western'),
	(2, 'Southern'),
	(3, 'Northerrn'),
	(4, 'Uva'),
	(5, 'Sabaragamuwa'),
	(6, 'Eastern'),
	(7, 'Central'),
	(8, 'North Western'),
	(9, 'North Central');

CREATE TABLE IF NOT EXISTS `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_resent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES
	(1, 28, 'akilagimhana2005@gmail.com'),
	(2, 24, 'akilagimhana2005@gmail.com'),
	(3, 24, 'akilagimhana2005@gmail.com'),
	(4, 30, 'akilagimhana2005@gmail.com'),
	(5, 28, 'akilagimhana2005@gmail.com'),
	(6, 33, 'akilagimhana2005@gmail.com'),
	(7, 22, 'akilagimhana2005@gmail.com'),
	(8, 21, 'akilagimhana2005@gmail.com'),
	(9, 27, 'akilagimhana2005@gmail.com'),
	(10, 26, 'akilagimhana2005@gmail.com'),
	(11, 28, 'akilagimhana2005@gmail.com');

CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'Active'),
	(2, 'Deactive');

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `joined_date`, `varification_code`, `status`, `gender_id`, `description`) VALUES
	('akilagimhana20051122@gmail.com', 'Akila2', 'Gimhana', '123456', '0764012266', '2023-02-03 07:30:14', NULL, 1, 1, NULL),
	('akilagimhana2005@gmail.com', 'Akila', 'Gimhana', '00000', '0710000000', '2022-11-12 18:02:23', '63efcded18237', 0, 1, 'Hi'),
	('kavishkadevinda0@gmail.com', 'Kavishka', 'Devinda', '1234567890', '0763454353', '2022-11-15 18:02:25', '6491b3b050c0a', 0, 1, NULL),
	('merajlakvidu2005@gmail.com', 'Meraj ', 'Lakvindu', '1234567890', '0763454350', '2022-11-21 14:57:13', NULL, 0, 2, NULL);

CREATE TABLE IF NOT EXISTS `user_chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`user`),
  KEY `fk_chat_user2_idx` (`admin`),
  CONSTRAINT `fk_chat_user11` FOREIGN KEY (`user`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user21` FOREIGN KEY (`admin`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `line_1` text,
  `line_2` text,
  `postal_code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_user_has_city_city1_idx` (`city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

INSERT INTO `user_has_address` (`user_email`, `city_id`, `id`, `line_1`, `line_2`, `postal_code`) VALUES
	('akilagimhana2005@gmail.com', 3, 1, 'Rathnapura,Palawela', 'Rathnapura', '2012');

CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

INSERT INTO `watchlist` (`id`, `user_email`, `product_id`) VALUES
	(19, 'akilagimhana2005@gmail.com', 24);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
