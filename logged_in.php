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
    <title>Textbook Trove | loggedIn</title>
</head>
<body>
    <header>
            <div style=" margin-top: 40px;">
            <div>
                <a href="index.html"><img class="logo" src="_images/pastimes-high-resolution-logo.png" alt="pastimes-high-resolution-logo" align="left" hspace="150"></a> 
            </div>
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
                        <li><a href="clothes.php">Clothes <img src="_images/Book.png" alt=""></a></li>
                        <li><a href="notice.html">Notice Board <img src="_images/Message.png" height="30px"></a></li>
                        <li><a href="your_closet.php">Your Closet <img src="_images/Mortarboard_light.png" alt=""></a></li>
                        <li><a href="contact.html">Contact Us <img src="_images/Vector.png" alt=""></a></li>
                    </ul>
                </nav>
    </header>
    <br>
    <section>
        <br>    
        <div style="text-align: center; ">
            <?php 
            if(isset($_SESSION["logged_in_User"])){
                $user_username = $_SESSION["logged_in_User"];
                echo "<h2>You are successfully logged in as @$user_username</h2>";
            }
            ?>
             <p>You may now access Pastimes's resources and buys and sell items.<br> Happy learning!</p>
             <div style="margin-left: 50px;"> 
                <img  style="height: 300px;"  src="https://img.freepik.com/free-vector/verified-concept-illustration_114360-5138.jpg?t=st=1728596186~exp=1728599786~hmac=876a4d7f2e1031c25be7fc21637d003f73d0ddd0cb5f3aafbd7943c57a118ebc&w=740" alt="">
             </div> 
            <br>
        </div>
        <br>
        <div style="margin-left:750px;">
            <form  class="login-form" method="POST" action="logout.php">   
                <button type="submit" value="login" class="btn btn-primary">Log-out</button>
            </form>
        </div>
        <br>
        <br>
    </section>
      
    <footer> 
        <hr style="margin-left: 100px; margin-right: 100px;">
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
                <img src="_images/_envelope lines_.png" height="25px">
                <p> email@pastimes.com</p>   
            </div>     
         <br>     
           <p>&copy; 2024 Pastimes.Com .All rights reserved. </p>     
    </footer> 
</body>
</html>