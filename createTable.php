<?php
// Include the Conn.php file
include('DBConn.php');

try{
// Create the 'student' table
    $createTable = "DROP TABLE IF EXISTS `user`;
    CREATE TABLE IF NOT EXISTS `user` (
    `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `username` varchar(255) NOT NULL,
    `st_num` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `listing_id` bigint DEFAULT NULL,
    `book_id` bigint DEFAULT NULL,
    PRIMARY KEY (`user_id`),
    KEY `listing_id` (`listing_id`),
    KEY `book_id` (`book_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    LOAD DATA INFILE 'textbook_trove\UserData.txt' INTO TABLE user FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' 
    (name, username, st_num, password, email);
    COMMIT;";
    $stmt = $pdo->prepare($createTable);
    $stmt->execute();

}catch(PDOException $e){
    die("ERROR: Could not execute SQL for 'user' table. " . $e->getMessage());  
}
$pdo = null;
$stmt = null;

?>
