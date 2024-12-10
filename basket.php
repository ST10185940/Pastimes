<?php
require_once 'config_session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/style.css"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Textbook Trove | Home</title>
</head>
<body>
    <header>
        <div style="margin-top: 40px;">
            <a href="index.html"><img class="logo" src="_images/pastimes-high-resolution-logo.png" alt="pastimes Logo" align="left" hspace="150"></a> 
            <br>
            <nav>                 
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenu1" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu1">
                            <a class="dropdown-item" href="register.php">Register</a>
                            <a class="dropdown-item" href="login.php">Log-In</a>                            
                        </div>
                    </li>
                    <li><a class="nav-link" href="basket.php">Basket <img src="_images/Basket_alt_duotone_line.png" height="31px" alt=""></a></li>
                    <li><a class="nav-link" href="bookmarks.html">Bookmarks <img src="_images/Bookmark_light.png" height="25px" alt=""></a></li>          
                </ul>                                  
            </nav>
        </div>
        <br>
        <div style="margin-top: auto;">
            <nav class="secondary-nav">
                <ul>
                    <li><a href="index.html">Home <img src="_images/Home_light.png" height="25px" alt=""></a></li>
                    <li><a href="clothes.php">Clothes</a></li>
                    <li><a href="notice.html">Notice Board <img src="_images/Message.png" height="30px" alt=""></a></li>
                    <li><a href="your_closet.php">Your Closet <img src="_images/Mortarboard_light.png" alt=""></a></li>
                    <li><a href="contact.html">Contact Us <img src="_images/Vector.png" alt=""></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br>
    <section>        
        <br>
        <br>
        <main class="about" style="margin-top: 50px; margin-left: 140px;">
            <h2>Your Items</h2>
            <br>
            <div class="text-image">
                <div>
                    <?php
                    ob_end_flush();
                    require_once 'DBConn.php';
                    $uid = $_SESSION["uid"] ?? null;
                    $get = "SELECT p.pid, p.title, p.price
                            FROM product as p 
                            JOIN cartproduct as cp ON cp.cid = cp.cid 
                            JOIN cart as c ON c.cid = cp.cid 
                            JOIN `user` as u ON u.uid = c.uid
                            WHERE p.pid = cp.pid AND u.uid = :uid";
                    $stmt = $pdo->prepare($get);
                    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if(!$row){
                        echo '<div style="margin-top: -150px;" class="alert alert-danger" role="alert">
                                Your basket is empty. Continue <a href="clothes.php">shopping</a>
                              </div>
                              <br>';
                    } else {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<p>' . htmlspecialchars($row['title']) . '&nbsp;R' . htmlspecialchars($row['price']) . '</p>
                                  <form class="login-form" method="POST" action="clothes_contr.php">
                                      <input type="hidden" name="pid" value="' . htmlspecialchars($row['pid']) . '">
                                      <button name="remove" type="submit" class="btn btn-danger">&times;</button>
                                  </form>
                                  <br>';
                        }                        
                    }
                    ?> 
                </div>
                <div class="vr"></div>
                <div style="margin-left: 50px;">
                    <?php
                    require_once 'DBConn.php';
                    $uid = $_SESSION["uid"] ?? null;
                    $get = "SELECT COUNT(p.pid) as num_items, SUM(p.price) as total, c.cid as cid
                            FROM product as p 
                            JOIN cartproduct as cp ON p.pid = cp.pid
                            JOIN cart as c ON cp.cid = c.cid
                            WHERE c.uid = :uid;";
                    $stmt = $pdo->prepare($get);
                    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo '<form class="login-form" method="POST" action="clothes_contr.php">
                              <button name="clear" type="submit" class="btn btn-danger">Clear Basket</button>
                          </form>
                          <br>
                          <br>
                          <h5>Order Summary</h5>
                          <br>
                          <p>Order Num: '.$row['cid'].'</p>
                          <br>
                          <p>Items: '.$row['num_items'].'</p>
                          <br>
                          <p>Total: '.$row['total'].'</p>
                          <br>
                          <br>
                          <br>
                          <form class="login-form" method="POST" action="clothes_contr.php">
                                <select id="paymentmethod" name="method" class="form-control" required>
                                    <option value="" disabled selected>Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="PayPall">PayPall</option>
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                                <br>
                              <button name="checkout" type="submit" class="btn btn-success">Checkout</button>
                          </form>
                          <br>
                          <form method="POST">
                              <button name="history" type="submit" class="btn btn-info">Purchase History</button>
                          </form>';
                    ?>   
                </div>
            </div>
            <?php
                    $uid = $_SESSION["uid"] ?? null;
                    if (!is_null($uid) && isset($_POST["history"])) {
                        echo '<h4>Order History:</h4>';
                        $get_orders = "SELECT oid, checkout_date, total FROM `order` WHERE uid = :uid";
                        $stmt = $pdo->prepare($get_orders);
                        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
                        $stmt->execute();
                    
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                <p>Order Ref: ' . htmlspecialchars($row["oid"]) . ' Date: ' . htmlspecialchars($row["checkout_date"]) . ' Total: ' . htmlspecialchars($row["total"]) . '</p>
                            ';
                        }
                    }                    
             ?>
        </main>
    </section>
    <footer> 
        <br>
        <nav class="footer-nav">
            <ul>
                <li><a href="index.html">Home </a></li>
                <li><a href="clothes.php">Clothes </a></li>
                <li><a href="notice.html">Notice Board </a></li>
                <li><a href="your_closet.php">Your Closet </a></li>
                <li><a href="contact.html">Contact Us </a></li>
            </ul>
        </nav>   
        <div class="social">
            <img src="_images/_facebook_.png" alt="facebook link">
            <img src="_images/_twitter original_.png" alt="twitter link">
            <img src="_images/_instagram_.png" alt="instagram link">
            <img src="_images/_youtube_.png" alt="youtube link">
            <img src="_images/_telegram_.png" alt="telegram link">
            <img src="_images/_envelope lines_.png" height="25px" alt="">
            <p>email@pastimes.com</p>
        </div>   
        <br>     
        <p>&copy; 2024 Pastimes.Com .All rights reserved. </p>
    </footer> 
</body>
</html>