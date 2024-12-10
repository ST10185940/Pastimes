<?php
        declare(strict_types=1);
        include('DBConn.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){

            require_once 'DBConn.php';           
            require_once 'config_session.inc.php';
             //if user form is filled
            
            if(isset($_POST['user_username'], $_POST['user_password'])){
                require_once 'login_model.php';
                $user_username = htmlspecialchars(strip_tags($_POST['user_username']), ENT_QUOTES, 'UTF-8');
                $user_password = htmlspecialchars(strip_tags($_POST['user_password']), ENT_QUOTES, 'UTF-8');

                if(!is_blank($user_username, $user_password)){
                    try{
                            $errors = [];
                            $success = "Login successful!";
    
                            if(!user_exists($pdo, $user_username)){
                                $errors["user_exists"] = "You dont have an account yet!, try registering first.";
                            }

                            if(!correct_creds($pdo, $user_username, $user_password, "user")){
                                $errors["input_match"] = "Incorrect credentials";
                            }

                            if($errors){
                                $_SESSION["login error"] = $errors;      
                                header("Location: login.php");
                                die();
                            }else{
                                
                                $this_userid = intval(get_user_id($pdo, $user_username));
                               
                                $_SESSION["login success"] = $success;
                                $_SESSION["logged_in_User"] = $user_username;
                                $_SESSION["uid"] = (int)$this_userid;
                                $_SESSION["username"] = $user_username;
                                header("Location: logged_in.php");              
                            }                
                        }catch(PDOException $e){
                            echo "Error: " . $e->getMessage();
                        } finally {
                            $pdo = null;
                            $stmt = null;
                        }
                  }else{
                    $errors["empty_input"] = "Fill in all fields"; 
                    $_SESSION["login error"] = $errors;         
                  }
            }

            require_once 'DBConn.php';           
            require_once 'config_session.inc.php';

            //if admin form is filled
              if(isset($_POST['admin_username'], $_POST['admin_password'])){
                 require_once 'login_model.php';
                    $admin_username = filter_var($_POST['admin_username'], FILTER_SANITIZE_STRING);
                    $admin_password = filter_var($_POST['admin_password'], FILTER_SANITIZE_STRING); 
                    
                    if(!is_blank($admin_username, $admin_password)){
                        try{
                            $errors = [];
                            $success = "Login successful!";
                               
                            if(!admin_exists($pdo, $admin_username)){
                                $errors["user_exists"] = "Please provide valid admin credentials";
                            }
        
                            // if(!correct_creds($pdo, $admin_username, $admin_password, "admin")){
                            //     $errors["input_match"] = "Incorrect credentials!";
                            // }
            
                            if($errors){
                                $_SESSION["login error"] = $errors;      
                                header("Location: login.php");
                                die();
                            }else{
                                $_SESSION["login success"] = $success;              
                                header("Location: dashboard.php");
                                die();
                            }
                            }catch(PDOException $e){
                                echo "Error: " . $e->getMessage();
                            }
                      }else if (is_blank($admin_username, $admin_password)){
                        $errors["empty_input"] = "Fill in all fields"; 
                      }             
              }            
    }else{
        header("Location: index.html");
        die();
    }

    function is_blank( string $user_username, string $user_password) {   
        if (empty($user_username) || empty($user_password)) {
            return true;
        }else{
            return false;  
        }
    } 

?>