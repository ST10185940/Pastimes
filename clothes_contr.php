<?php
    declare (strict_types=1);
    include('DBConn.php');

    if(($_SERVER["REQUEST_METHOD"] === "POST")){
        require 'config_session.inc.php';
         $uid = $_SESSION["uid"] ?? null;
        
            if(isset($_POST["add"])){  //adds item to basket
                $pid = (int)$_POST["pid"];
                $uid = (int)$_SESSION["uid"];
                $price = floatval(filter_var($_POST["price"],FILTER_SANITIZE_NUMBER_FLOAT));
        
                if(!is_null($uid)){ 
                    if(in_cart($pdo, $uid, $pid)){ //checks if item has been added to basket already
                        $_SESSION["Item status"] = "Item already added to your cart";
                        header("Location: clothes.php");
                    }else{
                        add_to_user_basket($pdo, $uid, $pid, $price);
                        //header("Location: basket.php");
                    }
                }else
                {
                    header("Location: clothes.php");
                    die();
                }
            }elseif(isset($_POST["checkout"]))  {  //checks out item in basket and clears basket reducing item quanties 
                $uid = $_SESSION["uid"] ?? null;
                if(!is_null($uid)){
                    $method = filter_var($POST["method"], FILTER_SANITIZE_SPECIAL_CHARS);
                    $get = "SELECT total FROM cart WHERE uid = :uid";
                    $stmt = $pdo->prepare($get);
                    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row){
                         
                        $date = date("Y-m-d h:i:sa");
                        $total = doubleval($row['total']);
                    
                        update_order_history($pdo , $uid, $date ,$total, $method);  //updates order history table
                        clear_cart($pdo, $uid);  //clears basket after checkout
                        header("Location: login.php");     //redirects to login page after checkout
                    }else{
                        header("Location: clothes.php");
                        die();
                    }
                                
                }else{
                    header("Location: clothes.php");
                    die();
                }
                
            }elseif(isset($_POST["clear"])){

                $uid = $_SESSION["uid"] ?? null;
                if(!is_null($uid)){
                    clear_cart($pdo,$uid);
                    header("Location: basket.php");
                    die();
                }else{
                    header("Location: basket.php");
                    die();
                }

            }elseif(isset($_POST["remove"])){

                $pid = filter_var($_POST["pid"] , FILTER_VALIDATE_INT);
                remove_from_basket($pdo, $uid, $pid);
                header("Location: basket.php");  
            }else{
                header("Location: clothes.php");
                die();
            }

 }
    function add_to_user_basket(object $pdo , int $uid, int $pid, float $price){
        try{
            //checks if item has been added to basket already1
            $get = "SELECT pid FROM cartproduct 
                    WHERE pid = :pid;";
            $stmt = $pdo->prepare($get);
            $stmt->bindParam(':pid', $pid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                $_SESSION["Item status"] = "Item already added to cart";
            }else{ // adds item to basket if not already added

                //gets users cart id 
                $getcid = "SELECT cid from cart WHERE uid = :uid";
                $stmt = $pdo->prepare($getcid);
                $stmt->bindParam(':uid',$uid);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!is_null($result)){
                    $cid = (int)$result["cid"];
                    //updates  the user's cartproduct list and cart total
                    $add = "INSERT INTO cartproduct (pid, cid) 
                            VALUES (:pid , :cid);";
                    $stmt = $pdo->prepare($add);
                    $stmt->bindParam(':pid', $pid);
                    $stmt->bindParam(':cid', $cid);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                   
                    $updatetotal = "UPDATE cart SET total = total + :price 
                                    WHERE cid = :cid;";
                    $stmt = $pdo->prepare($updatetotal);
                    $price = number_format($price, 2, '.', '');
                    $stmt->bindParam(':price', $price, PDO::PARAM_STR);  // Bind as string
                    $stmt->bindParam(':cid', $cid, PDO::PARAM_INT);      // Bind as integer
                    $stmt->execute(); 
                }  
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function in_cart(object $pdo, int $uid ,int $pid){
         //GET user cart id
         $getcid = "SELECT cid FROM cart WHERE uid = :uid;";
         $stmt = $pdo->prepare($getcid);
         $stmt->bindParam(':uid', $uid);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         $cid = $result["cid"];

        $check = "SELECT * FROM cartProduct WHERE cid = :cid AND pid = :pid;";
        $stmt = $pdo->prepare($check);
        $stmt->bindParam(':cid', $cid);
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
        return true;
        }
    }

    function update_order_history(object $pdo , int $uid, $date, float $total, string $paymthd){
        try{
            $getUserDtls = "SELECT (name || ' ' ||surname) as recipient , delivery_info
                            FROM user 
                            WHERE uid = :uid;";
            $stmt = $pdo->prepare($getUserDtls);
            $stmt->bindParam(':uid',$uid);
            $stmt->execute();
            $dtls = $stmt->fetch(PDO::FETCH_ASSOC);

            $update = "INSERT INTO `order` ( checkout_date , payment_method, total, delivery_info , recipient, uid) 
                                    VALUES ( :checkdate, :method , :total , :delivery ,: recipient :uid)";
            $stmt = $pdo->prepare($update);
            $stmt->bindParam(':checkdate', $date);
            $stmt->bindParam(':method',$paymthd);
            $total = number_format($total, 2, '.', '');
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':delivery', $dtls['delivery_info']);
            $stmt->bindParam(':recipient', $dtls['recipient']);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function clear_cart(object $pdo, int $uid){
        try{
            //update cart and set total to 0
            $getcid = "UPDATE cart 
                       SET total = 0
                       WHERE uid = :uid;";
            $stmt = $pdo->prepare($getcid);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
          
            //GET user cart id
            $getcid = "SELECT cid FROM cart WHERE uid =  :uid;";
            $stmt = $pdo->prepare($getcid);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $cid = $result["cid"];

            //update cart product list 
            $clearlist = "DELETE FROM cartproduct WHERE cid = :cid;";
            $stmt = $pdo->prepare($clearlist);
            $stmt->bindParam(':cid', $cid);
            $stmt->execute();

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    

    function remove_from_basket(object $pdo , int $uid, string $pid){
        try{
             //GET user cart id
            $getcid = "SELECT cid FROM cart WHERE uid =: uid;";
            $stmt = $pdo->prepare($getcid);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $cid = $result["cid"];

            $updateCart = "UPDATE cart 
                           SET total = total - (SELECT price FROM product WHERE pid = :pid) 
                           WHERE cid = :cid;";
            $stmt->Prepar($updateCart);
            $stmt->bindParam(':pid',$pid);
            $stmt->bindParam(':cid',$cid);
            $stmt->execute();

            $remove = "DELETE FROM cartproduct 
                       WHERE pid = :pid AND cid = :cid;";
            $stmt = $pdo->prepare($remove);
            $stmt->bindParam(':pid', $pid);
            $stmt->bindParam(':cid', $cid);
            $stmt->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
?>


