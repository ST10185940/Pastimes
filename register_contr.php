<?php
    declare(strict_types=1); //strict mode
    include ('DBConn.php');  //connects to database
    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //assigns form data to local variables after filtering
        $name = $_POST['name']; 
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = (string)trim($_POST['password']);
        $password_confirm = (string)trim($_POST['password_confirm']);

        $userType = $_POST['user_type'];
        $bankingDetails = $_POST['banking_details'];
        $deliveryInfo = $_POST['delivery_info'];
        $phone = $_POST['phone'];

        try {
            //includes required files
            require_once 'DBConn.php';
            require_once 'config_session.inc.php';
            require 'register_model.php';  //includes functions for register page
            
            $errors = [];
            //checks that email is valid
            if(validate_email($email) === false) {
               $errors["inv_email"] = "Enter a valid email";
            }
            //checks that entered passwords match AND HASHES PASSWORD to be stored in db 
            // if($password != $password_confirm){
            //    $errors["diff_pswd"] = "Make sure the passwords match";
            // }
              
            //checks username availability 
            if (username_taken( $pdo , $username)){
                $errors["usn"] = "Use a different username , that one's taken!";
            }
            if($errors){ //loads data to superglobal if errors are found to show UI updates on register page
                $_SESSION["register error"] = $errors;
                
                $_SESSION["register_data"] = $register_data;
                header("Location: register.php");
                die();
            }else{ //creates user if no errors 
                $hashed_password = password_hash($password, PASSWORD_BCRYPT,['cost' => 12]);
                $register_data = [
                    "name" => $name,
                    "surname" => $surname,
                    "username" => $username,
                    "email" => $email,
                    "password" => $hashed_password,
                    "user_type" => $userType, // New field
                    "banking_details" => $bankingDetails, // New field
                    "delivery_info" => $deliveryInfo, // New field
                    "phone" => $phone // New field
                ];
                create_user($pdo, $name,$surname,$username, $email, $hashed_password, $userType, $bankingDetails, $deliveryInfo, $phone);

                //set session id 
                $getuid = "SELECT uid FROM user WHERE username = :username;";
                $stmt = $pdo->prepare($getuid);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt -> execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION["uid"] = $result["uid"];
                //sets superglobal to be show UI updates on successful registration submission on 
                $_SESSION["register success"] =  "Registration submitted. Waiting for admin verification!";            
                header("Location: register.php");
                
                if(isset($_SESSION["approved"])){ // waits for super global to be set from admin dashboard if user is verified
                     "Registration successful! You can now log in";
                    $_SESSION["register success"] = $verified;  
                    
                    //redirect to page after  all or any changes 
                    header("Location: register.php");                 
                }    
            }

        }catch(PDOException $e) {
            die('Query failed'. $e->getMessage());
        }finally{
            $pdo = null;
            $stmt = null;
        }
    }else{
        header("Location: index.html");  //redirect to home page if the scripts is accessed directly without a POST request 
        die();
    }


?>