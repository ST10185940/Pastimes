<?php
      declare(strict_types=1);
      include('DBConn.php');

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            try{         
                require_once 'config_session.inc.php';
                $errors = [];
    
                if(isset($_POST["verify"])){ //verify pending user on verify click on admin dashboard

                    $uid = (int)$_POST["uid"];
                    if(!is_int($uid)){$errors[] = "Please enter a valid user id number";}
                    if(!user_exists($pdo,$uid)){
                        $errors[] = "Account does not exist";       
                    } 
                     
                    if($errors){
                        $_SESSION["uid error"] = $errors; 
                        header("Location: dashboard.php");
                        die();
                    }else{
                        verify_account($pdo, $uid);
                        $success = "Account successfully verified";
                        $_SESSION["uid success"] = $success;                                            
                        header("Location: dashboard.php");
                    }

                }elseif(isset($_POST["delete"])){  //delete user on delete click on admin dashboard

                    $uid = $_POST["uid"];
                    if(!is_int($uid)){$errors[] = "Please enter a valid user id";}
                    if(!user_exists($pdo, $uid )){$errors[] = "Account is not registered or has been removed from users";} 

                    if($errors){
                        $_SESSION["uid error"] = $errors; 
                        header("Location: dashboard.php");
                        die();
                    }else{
                        $success = "Account account has been deleted";
                        $_SESSION["uid success"] = $success;
                        delete_user($pdo, $uid);
                        header("Location: dashboard.php");
                    }
                    
                }else if (isset($_POST["search"])) {  //search for user on admin dashboard
                    $uid = (int)$_POST["uid"];
                    $user_data = find_user($pdo, $uid);
                    if($user_data !==null){
                        $_SESSION["results"] = $user_data;
                        header("Location: dashboard.php");
                    }
                }                   
                else if (isset($_POST["update"])){  //update user on admin dashboard

                    $field = trim(strtolower($_POST["field"]));
                    $value = trim($_POST["new_val"]);
                    $uid = (int)$_POST["uid"];
                    
                    if (!valid_field($field)){
                             $errors[] = "Please enter a valid field , like username or email";
                    }
                    if(valid_field($field) && up_to_date($pdo, $field, $value, $uid)){
                        $errors[] = "The $field for this user is already $value";
                    }
                    if($errors){
                        $_SESSION["update error"] = $errors;
                        header("Location: dashboard.php");
                        die();
                    }else{
                        update_user($pdo, $field, $value, $uid);
                        $success = "Account has been updated";
                        $_SESSION["update success"] = $success;
                        header("Location: dashboard.php");
                    }

                }else if(isset($_POST["verify_all"])){//verify all pending users on admin dashboard
                    verify_all_users($pdo);
                    $success = "All pending users have been verified";
                    $_SESSION["uid success"] = $success;
                    header("Location: dashboard.php"); 

                }else if(isset($_POST["add_listing"])){//add listing on admin dashboard
                    $pid = (int)$_POST["pid"];
                    if(!product_exists($pdo, $pid)){
                        $errors[] = "invalid proudct id";
                    }
                
                    if(!listed($pdo, $pid)){ // add $seller param in in case : students have same clothing item  
                        $errors[] = "product is already for sale";
                    } 

                    if($errors){ 
                        $_SESSION["listing error"] = $errors;
                        header("Location: dashboard.php");
                        die();

                    }else{
                        addListing($pdo, $pid);
                        $success = "Product $pid now availble for purchase";
                        $_SESSION["listing success"] = $success;
                        header("Location: dashboard.php");
                    }
                                       
                }else if (isset($_POST["list_all"])){
                    try{
                        $add_all = "UPDATE product SET available = 1 WHERE available = 0;";
                        $stmt = $pdo->prepare($add_all);
                        $stmt -> execute();
                    
                        $result = "SELECT * FROM product WHERE available = 0;";
                        $stmt = $pdo->prepare($result);
                        $stmt -> execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if(!$row){
                            $success = "All pending books have been listed for sale";
                            $_SESSION["listing success"] = $success;
                        }
                    }catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }finally{
                        $pdo = null;
                        $stmt = null;
                        header("Location: dashboard.php");
                    }
                }
                else if (isset($_POST["delete_item"])){
                    $pid = (int)filter_var($_POST["pid"], FILTER_VALIDATE_INT);
                    if(!product_exists($pdo, $pid)){ 
                        $errors[] = "Product does not exist";
                    }   
                    if($errors){
                        $_SESSION["listing error"] = $errors;
                        header("Location: dashboard.php");
                        die();
                    }else{
                        delete_product($pdo, $pid);
                        $success = "Product $pid has been deleted";
                        $_SESSION["listing success"] = $success;
                        header("Location: dashboard.php");
                    }
                }
            }catch(PDOException $ex){
                echo "Error: " . $ex->getMessage();
            }finally{
                $pdo = null;
                $stmt = null;
            }
        }else{
            header("Location: dashboard.php");
            die();
        }

        function addlisting(object $pdo , int $pid){
            $add = "UPDATE product  
                    SET available = 1
                    WHERE pid = :pid;";
                    $stmt = $pdo->prepare($add);
                    $stmt->bindParam(':pid', $pid);
                    $stmt -> execute();
        }

        function listed( object $pdo, int $pid){
            try{
                $check = "SELECT title FROM product WHERE pid = :pid AND available = 1;";
                $stmt = $pdo->prepare($check);
                $stmt->bindParam(':pid', $pid);
                $stmt -> execute();
                if($stmt->rowCount() > 0){
                    return true;}
                else{ return false;}
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

        }

        function valid_field(string $field){
            $valid_fields = array("uid","name","email","password","username","surname","delivery_info","postal","user_type","phone","banking_dtls");
            if (in_array($field, $valid_fields)){
                return true;
            }
        }

        function up_to_date(object $pdo, string $field , string $new_val ,int $uid){
           try{
                $check = "SELECT $field FROM user WHERE uid = :uid AND $field = :new_val;";
                $stmt = $pdo->prepare($check);
                $stmt->bindParam(':new_val', $new_val);
                $stmt->bindParam(':uid', $uid);
                $stmt->execute();
                
                if($stmt->rowCount() > 0){
                    return true;}
                else{ return false;}
           }catch(PDOException $se){
                echo "". $se->getMessage();
           }
        }

        function update_user(object $pdo, string $field , string $value ,int $uid){
            try{
                $check = "UPDATE user SET $field = :new_val WHERE uid = :uid ";
                $stmt = $pdo->prepare($check);
                $stmt->bindParam(':new_val', $value);
                $stmt->bindParam(':uid', $uid);               
                $stmt->execute();
            }catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }           
        }


  function find_user(object $pdo, int $uid){
    $query = "SELECT uid , email, username , `name` FROM user WHERE uid = :uid;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":uid", $uid);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  function delete_product( object $pdo ,int $pid){
        $find = "DELETE FROM product WHERE pid = :pid AND available = 1;";
        $stmt = $pdo->prepare($find);
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt -> execute(); 
  }

  function delete_user(object $pdo , int $uid){
            $query = "DELETE FROM user WHERE uid = :uid;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':uid', $uid);
            $stmt -> execute();    
  }

  function user_exists(object $pdo, int $uid) {
        try {
            $query = "SELECT * 
            FROM user WHERE `uid` = :uid 
            AND verified_user = 0 ;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) >= 1) {
                return true; // Record exists
            } else {
                return false; // Record does not exist
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function product_exists(object $pdo , int $pid){
        try{
            $query = "SELECT * FROM product WHERE title = :title";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) >= 1) {
                return true; // Record exists
            } else {
                return false; // Record does not exist
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }

    function verify_account( object $pdo, int $uid){ 
        try{ 
           // verifies users and initializes an empty cart for the verified user 
            $verify = "UPDATE user SET verified_user = 1
                       WHERE uid = :uid;
                       INSERT INTO cart (uid , total)
                       VALUES (:uid,0)";
            $stmt = $pdo->prepare($verify);
            $stmt->bindParam(':uid', $uid);
            $stmt -> execute();
            //pass a boolean value to register control script to show user that has just registered can log in 
            $_SESSION["approved"] = true;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
   }
   
    function verify_all_users(object $pdo){
        try{
                $verify = "UPDATE user SET verified_user = 1
                            WHERE verfified_user = 0 or verfified_user is null;";
                $stmt = $pdo->prepare($verify);
                $stmt -> execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
   }
?>