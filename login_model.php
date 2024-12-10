<?php
        declare(strict_types= 1);
        include('DBConn.php');

        function user_exists(object $pdo , string $user_username){     
                $query = "SELECT username FROM user WHERE username = :user_username;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':user_username', $user_username);
                $stmt->execute();          
                if ($stmt->rowCount() > 0) {return true;}else{ return false;}                    
        }

        function correct_creds(object $pdo, string $user_username, string $user_password, string $tbl_name) {
            $query = "SELECT username , `password` FROM $tbl_name WHERE username = :user_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_username', $user_username, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($user_password, $row['password'])) {
                return false; // Password matches
            } else {
                return true; // Password does not match
            }
        }
        
     function get_user_id(object $pdo , string $username) : int{
        $query = "SELECT uid FROM user WHERE username = :username";
        $stmt  = $pdo-> prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $id = $stmt->fetch();
        return intval($id['uid']);
      }

        function admin_exists(object $pdo , string $username){
            $query = "SELECT username FROM `admin` WHERE username = :username;";
            $stmt  = $pdo-> prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            if($stmt->rowCount() >= 1){return true;}else{ return false;}
        }
?>