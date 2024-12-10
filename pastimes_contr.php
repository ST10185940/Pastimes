<?php
        declare(strict_types=1);
        include ('DBConn.php');
       

    if($_SERVER["REQUEST_METHOD"] === "POST"){
    
        try{
                   
            $errors = [];

            if(!isset($_SESSION["uid"])){
                $errors["user_exists"] = "You need to login first.";
            }else{
                $uid = $_SESSION["uid"];
                $title = trim(htmlspecialchars(strip_tags($_POST['title']), ENT_QUOTES, 'UTF-8'));
                $description = trim(htmlspecialchars(strip_tags($_POST['description']), ENT_QUOTES, 'UTF-8'));
                $type = trim(htmlspecialchars(strip_tags($_POST['type']), ENT_QUOTES, 'UTF-8'));
                $size = trim(htmlspecialchars(strip_tags($_POST['size']), ENT_QUOTES, 'UTF-8'));
                $condition = trim(htmlspecialchars(strip_tags($_POST['condition']), ENT_QUOTES, 'UTF-8'));
                $price = doubleval(trim(htmlspecialchars(strip_tags($_POST['price']), ENT_QUOTES, 'UTF-8')));
                $available = trim(htmlspecialchars(strip_tags($_POST['available']), ENT_QUOTES, 'UTF-8'));
                $brand = trim(htmlspecialchars(strip_tags($_POST['brand']), ENT_QUOTES, 'UTF-8'));
                $img_url = trim(htmlspecialchars(strip_tags($_POST['image']), ENT_QUOTES, 'UTF-8'));
            }

           if(!is_integer($edition)){
                $errors["valid_edition"] = "Enter a valid edition number e.g. 12";
            }

        
            if(!is_integer($release)){
                $errors["valid_release"] = "Enter a valid release year e.g 2018";
            }

            if(!is_numeric($price)){
                $errors["valid_price"] = "Enter a valid price , please be reasonable here! ";
            }

            if($errors){
                $_SESSION["input_errors"] = $errors;  
                header("Location: your_trove.php");
                die();
            }else{
                $success = "product has now been put on pending books list";
                $_SESSION["pending"] = $success;
                add_product($pdo, $title, $description, $type, $size, $condition, $price, $available, $brand, $img_url);
                header("Location: your_trove.php");
                die();
            }

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }else{
        header("Location: your_closet.php");
        die();
    }

    function add_product(object $pdo, string $title, string $description, string $type, string $size, string $condition, float $price, int $available, int $brand, string $img_url){
        
        $add_book = "INSERT INTO product (title, `description`, `size`, `type`, condition, price, available, brand, img_url)
        VALUES (:title, :`description`, :size, :type, :condition, :price, :available, :brand, :img_url);";

        $stmt = $pdo->prepare($add_book);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':`description`', $description);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':`type`', $type);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':available', $available);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->execute();

    }

?>