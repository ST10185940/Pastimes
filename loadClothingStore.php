<?php
    include 'DBCon.php';

    try{
        $create_db = "
                    CREATE DATABASE IF NOT EXISTS `clothingstore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
                    USE `clothingstore`;

                    DROP TABLE IF EXISTS `admin`;
                    CREATE TABLE IF NOT EXISTS `admin` (
                    `aid` int NOT NULL AUTO_INCREMENT,
                    `username` varchar(255) NOT NULL,
                    `password` varchar(255) NOT NULL,
                    PRIMARY KEY (`aid`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

                    DROP TABLE IF EXISTS `cart`;
                    CREATE TABLE IF NOT EXISTS `cart` (
                    `cid` int NOT NULL AUTO_INCREMENT,
                    `uid` int NOT NULL,
                    `total` double DEFAULT NULL,
                    PRIMARY KEY (`cid`),
                    KEY `uid` (`uid`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

                    DROP TABLE IF EXISTS `cartproduct`;
                    CREATE TABLE IF NOT EXISTS `cartproduct` (
                    `cpid` int NOT NULL AUTO_INCREMENT,
                    `pid` int NOT NULL,
                    `cid` int NOT NULL,
                    PRIMARY KEY (`cpid`),
                    KEY `pid` (`pid`),
                    KEY `cid` (`cid`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

                    DROP TABLE IF EXISTS `order`;
                    CREATE TABLE IF NOT EXISTS `order` (
                    `oid` int NOT NULL AUTO_INCREMENT,
                    `checkout_date` datetime NOT NULL,
                    `payment_method` varchar(255) DEFAULT NULL,
                    `total` double NOT NULL,
                    `status` enum('delivered','pending','processed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `delivery_info` varchar(255) NOT NULL,
                    `recipeient` varchar(255) NOT NULL,
                    `uid` int DEFAULT NULL,
                    PRIMARY KEY (`oid`),
                    KEY `uid` (`uid`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

                    DROP TABLE IF EXISTS `product`;
                    CREATE TABLE IF NOT EXISTS `product` (
                    `pid` int NOT NULL AUTO_INCREMENT,
                    `sid` int NOT NULL,
                    `title` varchar(255) NOT NULL,
                    `description` varchar(255) NOT NULL,
                    `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `condition` varchar(255) NOT NULL,
                    `price` double NOT NULL,
                    `available` tinyint(1) NOT NULL,
                    `brand` varchar(255) NOT NULL,
                    `img_url` varchar(255) NOT NULL,
                    PRIMARY KEY (`pid`),
                    KEY `sid` (`sid`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
        ";
        $stmt = $spd->query($create_db);
        $stmt->execute();
    }catch(PDOException $e){
        die("ERROR: Could not create clothing database.". $e->getMessage());
    }

    //loads data into tables from csv files (~20 records each while fully relational)
    try{  
        $load_data = "
            LOAD DATA INFILE '_sample_data/sampleUsers.txt'
            INTO TABLE user
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (uid, name, surname, username, password, email, user_type, banking_dtls, delivery_info, phone, verified_user);
            
            LOAD DATA INFILE '_sample_data/sampleAdmins.txt'
            INTO TABLE admin
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (aid, username, password);

            LOAD DATA INFILE '_sample_data/sampleProducts.txt'
            INTO TABLE product
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (pid, sid, title, description, type, size, condition, price, available, brand, img_url);

            LOAD DATA INFILE '_sample_data/sampleCarts.txt'
            INTO TABLE cart
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (cid, uid, total);

            LOAD DATA INFILE '_sample_data/sampleCartProducts.txt'
            INTO TABLE cartproduct
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (cpid, pid, cid);

            LOAD DATA INFILE '_sample_data/sampleOrders.txt'
            INTO TABLE `order`
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (oid, checkout_date, payment_method, total, status, delivery_info, recipeient, uid);

            LOAD DATA INFILE '_sample_data/sampleMessages.txt'
            INTO TABLE message
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\n'
            (mid, sid, rid, message, timestamp);
        ";
        $stmt = $pdo->query($load_data);
        $stmt->exectute();
    }catch(PDOException $se){
        die("ERROR: Could not load data into clothingStore database".$e->getMessage());
    }
?>