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
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Textbook Trove | Home</title>
</head>              
<body>
    <header>
            <div style=" margin-top: 40px;">
            <a href="index.html"><img  class="logo" src="_images/pastimes-high-resolution-logo.png" alt="Textbook Trove primary Logo"  align="left" hspace="150"></a> 
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
                            <li><a class="nav-link" href="basket.php">Basket <img src="_images/Basket_alt_duotone_line.png" height="31px" alt=""></a></li>
                            <li><a class="nav-link" href="bookmarks.html">Bookmarks <img src="_images/Bookmark_light.png" height="25px" alt=""></a></li>          
                        </ul>                                  
                </nav>
            </div>
            <br>
            <div style="margin-top: auto;">
                <nav class="secondary-nav">
                    <ul>
                        <li><a href="index.html">Home <img src="_images/Home_light.png" height="25px"></a></li>
                        <li><a href="books.php">Clothes</a></li>
                        <li><a href="notice.html">Notice Board <img src="_images/Message.png" height="30px"></a></li>
                        <li><a href="your_closet.php">Your Closet <img src="_images/Mortarboard_light.png" alt=""></a></li>
                        <li><a href="contact.html">Contact Us <img src="_images/Vector.png" alt=""></a></li>
                    </ul>
                </nav>
    </header>
    <br>
    <section>
           <form class="login-form" method="POST" action="/" style="max-width: 50%; margin-left: 590px;">
                <br>
                <div class="text-image">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" id="Username" placeholder="Title or ISBN" required>
                    </div>
                    <div style="margin-left:10px">
                        <button type="submit" class="btn btn-primary">🔎</button>
                    </div>
                </div>   
            </form>


        <main class="about" style="margin-top:50px; margin-left:140px;">
                    <br>
                    <h3>Available Products</h3>
                    <br>
                    <br>                  
                        <div style=" position: fixed;                           
                                        top: 50%;
                                        left: 50%;
                                        max-width:30%;
                                        transform: translate(-50%, -50%);" >
                         <?php
                            if(!isset($_SESSION["uid"])){
                                echo '
                                    <div class="alert alert-danger" role="alert">
                                        You need to be logged in to add books to your basket.
                                        <button type="button" class="btn btn-secondary" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                               }
                           ?>                          
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var alert = document.querySelector(".alert");
                                alert.addEventListener("click", function() {
                                    alert.style.display = "none";
                                });
                            });
                        </script>
                        <div  style=" position: fixed;                           
                                top: 85%;
                                right: 0%;                            
                                transform: translate(-50%, -50%);">

                                <a href="basket.php"><button class="btn btn-success" >View Cart</button></a>
                                <br>
                                <br>
                                <a href="login.php"><button class="btn btn-warning" >Login</button></a>
                            
                        </div>
                              
                            <!-- PHP code to fetch and display database records -->
                        <div class=product-grid>
                            <?php
                                require_once 'DBConn.php';
                                $path = "_images/";
                                $query = "SELECT p.pid as pid, p.title as title , p.type as type , p.price as price, p.img_url as img_url, u.username as seller
                                FROM product p 
                                JOIN user u ON p.sid = u.uid
                                WHERE available = 1 LIMIT 6 "; // Select only the needed columns
                                $stmt = $pdo->query($query);                         
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo  
                                        '<div class="product-card">' .                                                                          
                                                '   <img  class="img-fluid"  src="' .$path . $row['img_url'] .'" alt="Product Image" style=" height: 250px; margin: 10px;">' .
                                                    '<h5>' . $row['title'] . '</h5>' .
                                                    '<h6>' . $row['type'] . '</h6>'.
                                                    '<h7>' . 'Sold by @'.$row['seller'] . '</h7>'.
                                                    '<br>'.
                                                    '<form  class="login-form" method="POST" action="clothes_contr.php"> 
                                                            <input type="hidden" name="pid" value="'.$row['pid'].'">
                                                            <input type="hidden" name="price" value="'.floatval($row['price']).'">
                                                            <div class="form-group">
                                                              <button name="add"  style="margin-right: 75px" type= "submit" class="btn btn-dark">R'. $row['price']. ' |   
                                                                <img src="_images/Basket_alt_duotone_line.png" height="31px" alt="">
                                                              </button>'.
                                                            '</div>                                                 
                                                    </form>'.                           
                                        '</div>';                                                                                                              
                                }                        
                            ?>
                        </div>                           
                </div>
        </main>
    </section>
    <br>    
    <footer> 
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
                <img src="_images/_envelope lines_.png" height="25px">
                <p> email@pastimes.com</p>      
            </div>     
         <br>     
         <p>&copy; 2024 Pastimes.Com .All rights reserved. </p>    
    </footer> 
</body>
</html>