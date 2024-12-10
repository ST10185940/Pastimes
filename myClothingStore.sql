-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2024 at 09:07 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothingstore`
--
CREATE DATABASE IF NOT EXISTS `clothingstore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `clothingstore`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
(1, 'admin1@example.com', 'hashedpassword1'),
(2, 'admin2@example.com', 'hashedpassword2'),
(3, 'admin3@example.com', 'hashedpassword3'),
(4, 'admin4@example.com', 'hashedpassword4'),
(5, 'admin5@example.com', 'hashedpassword5'),
(6, 'admin6@example.com', 'hashedpassword6'),
(7, 'admin7@example.com', 'hashedpassword7'),
(8, 'admin8@example.com', 'hashedpassword8'),
(9, 'admin9@example.com', 'hashedpassword9'),
(10, 'admin10@example.com', 'hashedpassword10'),
(11, 'admin11@example.com', 'hashedpassword11'),
(12, 'admin12@example.com', 'hashedpassword12'),
(13, 'admin13@example.com', 'hashedpassword13'),
(14, 'admin14@example.com', 'hashedpassword14'),
(15, 'admin15@example.com', 'hashedpassword15'),
(16, 'admin16@example.com', 'hashedpassword16'),
(17, 'admin17@example.com', 'hashedpassword17'),
(18, 'admin18@example.com', 'hashedpassword18'),
(19, 'admin19@example.com', 'hashedpassword19'),
(20, 'admin20@example.com', 'hashedpassword20');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `uid`, `total`) VALUES
(1, 1, 106.00),
(2, 3, 140.00),
(3, 6, 140.00),
(4, 8, 60.00),
(5, 1, 110.00),
(6, 6, 180.00),
(7, 11, 200.00),
(8, 14, 50.00),
(9, 16, 140.00),
(10, 19, 80.00),
(11, 18, 70.00),
(12, 12, 130.00),
(13, 9, 50.00),
(14, 7, 120.00),
(15, 10, 130.00),
(16, 5, 200.00),
(17, 13, 70.00),
(18, 2, 40.00),
(19, 17, 50.00),
(20, 20, 80.00),
(21, 21, 0.00),
(22, 2, 0.00),
(23, 22, 0.00),
(24, 23, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `cartproduct`
--

DROP TABLE IF EXISTS `cartproduct`;
CREATE TABLE IF NOT EXISTS `cartproduct` (
  `cpid` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `cid` int NOT NULL,
  PRIMARY KEY (`cpid`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cartproduct`
--

INSERT INTO `cartproduct` (`cpid`, `pid`, `cid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 2),
(4, 5, 2),
(5, 6, 3),
(6, 12, 3),
(7, 9, 4),
(8, 1, 5),
(9, 9, 5),
(10, 12, 6),
(11, 13, 6),
(12, 18, 7),
(13, 11, 8),
(14, 6, 9),
(15, 17, 10),
(16, 16, 11),
(17, 13, 12),
(18, 20, 13),
(19, 5, 14),
(20, 7, 15),
(21, 8, 16),
(22, 11, 17),
(23, 14, 18),
(24, 9, 19),
(25, 18, 20);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `sid` int NOT NULL,
  `rid` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `sid` (`sid`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `sid`, `rid`, `message`, `timestamp`) VALUES
(1, 1, 3, '\"Hello Bob', '0000-00-00 00:00:00'),
(2, 3, 1, '\"Yes', '0000-00-00 00:00:00'),
(3, 2, 5, '\"Hi Mary', '0000-00-00 00:00:00'),
(4, 5, 2, '\"Sure', '0000-00-00 00:00:00'),
(5, 8, 6, '\"Linda', '0000-00-00 00:00:00'),
(6, 6, 8, '\"You\'re welcome! Hope to shop more.\"', '2024-10-03 15:00:00'),
(7, 7, 14, '\"Hi Emily', '0000-00-00 00:00:00'),
(8, 14, 7, '\"Sure', '0000-00-00 00:00:00'),
(9, 12, 19, '\"Hi Megan', '0000-00-00 00:00:00'),
(10, 19, 12, '\"Yes', '0000-00-00 00:00:00'),
(11, 10, 17, '\"Hey Lisa', '0000-00-00 00:00:00'),
(12, 17, 10, '\"Yes', '0000-00-00 00:00:00'),
(13, 18, 20, '\"Chris', '0000-00-00 00:00:00'),
(14, 20, 18, '\"Great', '0000-00-00 00:00:00'),
(15, 15, 3, '\"Hi Bob', '0000-00-00 00:00:00'),
(16, 3, 15, '\"I\'ll send you more info today.\"', '2024-10-08 10:20:00'),
(17, 9, 12, '\"Hey Michael', '0000-00-00 00:00:00'),
(18, 12, 9, '\"Yes', '0000-00-00 00:00:00'),
(19, 16, 11, '\"Sarah', '0000-00-00 00:00:00'),
(20, 11, 16, '\"Yes', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `oid` int NOT NULL AUTO_INCREMENT,
  `checkout_date` datetime NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('delivered','pending','processed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'processed',
  `delivery_info` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `uid` int DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `checkout_date`, `payment_method`, `total`, `status`, `delivery_info`, `recipient`, `uid`) VALUES
(1, '2024-10-10 12:30:00', 'credit card', 106.00, 'delivered', '123 Street, City', 'John Doe', 1),
(2, '2024-10-09 14:45:00', 'paypal', 140.00, 'processed', '789 Boulevard, City', 'Bob Smith', 3),
(3, '2024-10-07 16:10:00', 'debit card', 140.00, 'pending', '500 Elm St, City', 'Linda Brown', 6),
(4, '2024-10-06 17:20:00', 'credit card', 60.00, 'delivered', '765 Cedar St, City', 'Susan Davis', 8),
(5, '2024-10-06 19:00:00', 'credit card', 110.00, 'processed', '123 Street, City', 'John Doe', 1),
(6, '2024-10-05 10:25:00', 'paypal', 180.00, 'pending', '500 Elm St, City', 'Linda Brown', 6),
(7, '2024-10-05 13:45:00', 'credit card', 200.00, 'delivered', '77 5th Ave, City', 'Sarah Lopez', 11),
(8, '2024-10-04 09:50:00', 'credit card', 50.00, 'processed', '33 Creek St, City', 'Emily Scott', 14),
(9, '2024-10-03 18:30:00', 'paypal', 140.00, 'pending', '92 Bay Rd, City', 'George King', 16),
(10, '2024-10-03 20:15:00', 'credit card', 80.00, 'delivered', '81 Ocean St, City', 'Megan Bell', 19),
(11, '2024-10-03 08:40:00', 'debit card', 70.00, 'delivered', '9 River St, City', 'David Clark', 18),
(12, '2024-10-02 14:55:00', 'credit card', 130.00, 'processed', '22 Tree Ave, City', 'Michael Young', 12),
(13, '2024-10-02 16:25:00', 'paypal', 50.00, 'processed', '125 Oak St, City', 'Kate Wilson', 9),
(14, '2024-10-01 10:30:00', 'credit card', 120.00, 'pending', '432 Maple St, City', 'Tom White', 7),
(15, '2024-10-01 11:45:00', 'debit card', 130.00, 'delivered', '999 Pine St, City', 'James Green', 10),
(16, '2024-10-01 13:00:00', 'paypal', 200.00, 'pending', '654 Road, City', 'Mary Jones', 5),
(17, '2024-09-30 09:15:00', 'credit card', 70.00, 'processed', '55 Hill Rd, City', 'Henry Turner', 13),
(18, '2024-09-30 12:10:00', 'credit card', 40.00, 'delivered', '456 Avenue, City', 'Jane Doe', 2),
(19, '2024-09-29 16:30:00', 'paypal', 50.00, 'delivered', '10 Pearl Rd, City', 'Lisa Parker', 23),
(20, '2024-09-29 18:00:00', 'debit card', 80.00, 'delivered', '15 South Rd, City', 'Chris Evans', 23);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `sid` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `condition` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `sid`, `title`, `description`, `type`, `size`, `condition`, `price`, `available`, `brand`, `img_url`) VALUES
(1, 3, 'Blue Jeans', 'Classic blue denim jeans', 'clothing', 'M', 'New', 50.00, 1, 'Levi\'s', 'bluejeans.jpg'),
(2, 3, 'Black T-shirt', 'Cotton black t-shirt', 'clothing', 'L', 'Used', 16.00, 1, 'Nike', 'blacktshirt.jpeg'),
(3, 5, 'Red Dress', 'Stylish red evening dress', 'clothing', 'S', 'New', 80.00, 0, 'Zara', 'img_url3'),
(4, 5, 'White Sneakers', 'Comfortable white sneakers', 'footwear', '42', 'Used', 60.00, 1, 'Adidas', 'whitesneakers.jpg'),
(5, 3, 'Grey Jacket', 'Casual grey jacket', 'clothing', 'XL', 'New', 90.00, 1, 'H&M', 'greyjacket.jpeg'),
(6, 10, 'Leather Jacket', 'Black leather jacket', 'clothing', 'XL', 'Used', 130.00, 1, 'Zara', 'leatherjacket.jpg'),
(7, 10, 'Running Shoes', 'Lightweight running shoes', 'footwear', '44', 'New', 100.00, 0, 'Reebok', 'img_url7'),
(8, 15, 'Green Skirt', 'Stylish green skirt', 'clothing', 'M', 'New', 50.00, 1, 'Gucci', 'greenskirt.jpeg'),
(9, 12, 'Winter Coat', 'Warm winter coat', 'clothing', 'L', 'Used', 200.00, 0, 'North Face', 'img_url9'),
(10, 12, 'Summer Dress', 'Light summer dress', 'clothing', 'S', 'New', 60.00, 1, 'H&M', 'img_url10'),
(11, 6, 'Boots', 'Leather boots', 'footwear', '41', 'New', 90.00, 1, 'Timberland', 'img_url11'),
(12, 6, 'Sweater', 'Woolen sweater', 'clothing', 'M', 'New', 50.00, 1, 'Uniqlo', 'img_url12'),
(13, 17, 'Bag', 'Leather shoulder bag', 'accessory', 'One Size', 'New', 130.00, 1, 'Coach', 'img_url13'),
(14, 17, 'Scarf', 'Cashmere scarf', 'accessory', 'One Size', 'New', 30.00, 1, 'Prada', 'img_url14'),
(15, 19, 'Denim Jacket', 'Stylish denim jacket', 'clothing', 'L', 'Used', 80.00, 1, 'Levi\'s', 'img_url15'),
(16, 19, 'Sneakers', 'Comfy everyday sneakers', 'footwear', '43', 'New', 70.00, 1, 'Nike', 'img_url16'),
(17, 19, 'Hat', 'Summer straw hat', 'accessory', 'One Size', 'New', 20.00, 1, 'H&M', 'img_url17'),
(18, 12, 'Running Shorts', 'Lightweight running shorts', 'clothing', 'L', 'Used', 26.00, 1, 'Reebok', 'img_url18'),
(19, 15, 'Backpack', 'Stylish backpack', 'accessory', 'One Size', 'New', 100.00, 1, 'Adidas', 'img_url19'),
(20, 3, 'Joggers', 'Comfortable jogger pants', 'clothing', 'XL', 'New', 40.00, 1, 'Puma', 'img_url20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` enum('buyer','seller') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `banking_dtls` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `delivery_info` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `verified_user` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `surname`, `username`, `password`, `email`, `user_type`, `banking_dtls`, `delivery_info`, `phone`, `verified_user`) VALUES
(1, 'John', 'Doe', 'johndoe', '$2a$12$eB5.wCRcdt4uL8Fr1tIRse', 'john@example.com', 'buyer', NULL, '123 Street, City, 12345', '1234567890', 1),
(2, 'Jane', 'Doe', 'janedoe', '$2a$12$mlJn/MFOfklHweQRnFKO1O', 'jane@example.com', 'buyer', NULL, '456 Avenue, City, 67890', '0987654321', 1),
(3, 'Bob', 'Smith', 'bsmith', '$2a$12$h4xjbvFmIO4wJ5QJh2S41q', 'bob@example.com', 'seller', NULL, '789 Boulevard, City, 54321', '1122334455', 1),
(4, 'Alice', 'Johnson', 'ajohnson', '$2a$12$MeG51HWaFekjfv9zWV3.AO', 'alice@example.com', 'buyer', NULL, '321 Lane, City, 98765', '9988776655', 0),
(5, 'Mary', 'Jones', 'mjones', '$2a$12$cROuGQVbwB9u5Ksc5Bt.Oy', 'mary@example.com', 'seller', NULL, '654 Road, City, 11223', '8877665544', 1),
(6, 'Linda', 'Brown', 'lbrown', '$2a$12$FtyMz1qO16aYmjXjbY3HhO', 'linda@example.com', 'buyer', NULL, '500 Elm St, City, 44556', '1233211234', 1),
(7, 'Tom', 'White', 'twhite', '$2a$12$R5MeD5aBmv3Zcm5Alk/WY.I', 'tom@example.com', 'seller', NULL, '432 Maple St, City, 77889', '5556667777', 0),
(8, 'Susan', 'Davis', 'sdavis', '$2a$12$G1gA8Rx7HtQlDCViPLV3ku', 'susan@example.com', 'buyer', NULL, '765 Cedar St, City, 99876', '3332221111', 1),
(9, 'Kate', 'Wilson', 'kwilson', '$2a$12$U1Px5UkeDbW5ot7uMFD69O', 'kate@example.com', 'buyer', NULL, '125 Oak St, City, 45678', '7778889999', 0),
(10, 'James', 'Green', 'jgreen', '$2a$12$Nly2zqlD3aQ9TFYMB8ED6e', 'james@example.com', 'seller', NULL, '999 Pine St, City, 34567', '8889997777', 1),
(11, 'Sarah', 'Lopez', 'slopez', '$2a$12$9kXW1skgHD8D1iHrF21Gxe', 'sarah@example.com', 'buyer', NULL, '77 5th Ave, City, 23456', '5554443322', 1),
(12, 'Michael', 'Young', 'myoung', '$2a$12$h3x6UPdpG2FE3D2htZ5tFO', 'michael@example.com', 'seller', NULL, '22 Tree Ave, City, 67890', '9998887776', 1),
(13, 'Henry', 'Turner', 'hturner', '$2a$12$1kmDgXbC1e3Qv2EEI4h7XG', 'henry@example.com', 'buyer', NULL, '55 Hill Rd, City, 12345', '6667778889', 0),
(14, 'Emily', 'Scott', 'escott', '$2a$12$1m5wxZ8lEz5slAh8M7i7G6', 'emily@example.com', 'buyer', NULL, '33 Creek St, City, 54321', '2223334441', 1),
(15, 'Nancy', 'Lee', 'nlee', '$2a$12$SQhGrPne3aO55yc8Z8TLqu', 'nancy@example.com', 'seller', NULL, '101 Star Rd, City, 67890', '9996665552', 1),
(16, 'George', 'King', 'gking', '$2a$12$E9N.suZyhnUj95cyH2qxqe', 'george@example.com', 'buyer', NULL, '92 Bay Rd, City, 23456', '1112223332', 1),
(17, 'Lisa', 'Parker', 'lparker', '$2a$12$X5k5Q8I2Ut8AdQj2LSz42e', 'lisa@example.com', 'seller', NULL, '10 Pearl Rd, City, 98765', '4443332223', 1),
(18, 'David', 'Clark', 'dclark', '$2a$12$IcH00E/v4F4HQcHJImq1yO', 'david@example.com', 'buyer', NULL, '9 River St, City, 87654', '3214321233', 0),
(19, 'Megan', 'Bell', 'mbell', '$2a$12$GvU/b3K3V2pbI8Wn1e.KH6', 'megan@example.com', 'seller', NULL, '81 Ocean St, City, 76543', '7776665554', 1),
(20, 'Chris', 'Evans', 'cevans', '$2a$12$9jB1.tX/N6wYjndhuFcoH6', 'chris@example.com', 'buyer', NULL, '15 South Rd, City, 65432', '8887776664', 0),
(23, 'test', 'test', 'test', '$2y$12$Hn8tF2ebrVU2qwFZr2GpZOWR797PJL5UQSg3DygXWxCVSjYXZnQqG', 'test@email.com', 'buyer', 'test', 'test', '1234567890', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
