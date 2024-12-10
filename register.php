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
    <title>Pastimes | Register</title>
</head>
<body>
    <header>
    <div style="margin-top: 40px;">
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
                        <li><a href="clothes.php">Clothes <img src="_images/Clothing.png" alt=""></a></li>
                        <li><a href="notice.html">Notice Board <img src="_images/Message.png" height="30px"></a></li>
                        <li><a href="your_closet.php">Your Closet <img src="_images/closet.png" alt=""></a></li>
                        <li><a href="contact.html">Contact Us <img src="_images/Vector.png" alt=""></a></li>
                    </ul>
                </nav>
    </header> 
    <hr style="margin-left: 100px; margin-right: 100px;">
    <br>
               <br>
               <div style="text-align: center; font-family:'Stoic Script', cursive;">
                    <h2>Please Note!</h2>
                    <br>
                    <h5>An Admin or moderator will verify your identity before you are successfully logged in and can access Your Closet or list a clothing item.</h5>
                </div>
                <br>

        <main class="about">
            <div class="text-image">
                <div class="image">
                    <section style="font-size: 16px; margin-top: 20px ; margin-left: 20px;">
                        <h2>Register (Buyer/Seller)</h2>
                        <div class="text-image">
                             
                            <div class="image">
                                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
                                <dotlottie-player src="https://lottie.host/ccf451f3-402a-40e6-857f-91171644a007/g2uVNkkDeR.lottie" background="transparent" speed=".6" style="width: 400px; height: 400px;" autoplay></dotlottie-player>  
                            </div>
                            <div>
                                <!-- code by w3codegenerator.com -->
                                    <form method="POST" action="register_contr.php" style="max-width: 250%; margin: auto;">
                                       <div style="display:flex; justify-content: space-between; gap: 30px;">
                                                <div style="flex: 1;">
                                                    <?php
                                                    sticky_input();
                                                    ?>
                                                    <br>                                   
                                                        <input type="password" name="password" class="form-control" id="Password1" placeholder="Password" required style="width: 100%;">     
                                                    <br>                                       
                                                        <label>Confirm Password : </label>
                                                        <input type="password" name="password_confirm" class="form-control" id="Password2" placeholder="Password" required style="width: 100%;">        
                                                </div>
                                                <div style="flex: 1;">
                                                    <br>
                                                    <select name="user_type" class="form-control" required style="width: 100%;">
                                                        <option value="">Select User Type</option>
                                                        <option  name="user_type" value="buyer">Buyer</option>
                                                        <option   name="user_type" value="seller">Seller</option>
                                                    </select>
                                                    <br>
                                                    <input type="text" name="banking_details" class="form-control" placeholder="Banking Details" style="width: 100%;">
                                                    <br>
                                                    <input type="text" name="delivery_info" class="form-control" placeholder="Delivery Info" style="width: 100%;">
                                                    <br>
                                                    <input type="text" name="phone" class="form-control" placeholder="Phone" style="width: 100%;">
                                                    <br>
                                                </div>
                                            </div>
                                        <button type="submit" value="register" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
                                    </form> 
                            </div>
                        </div>
                    </section>
                </div>

                <div style="margin-left:350px;">
                        <?php   // checks register errors                                                                    
                                if(isset($_SESSION["register error"])){
                                    $errors = $_SESSION["register error"];
                                    echo 'Please:'; 
                                    foreach($errors as $error){
                                    echo "<p class='form_control' style ='color: red; font-family:Stoic Script,cursive;'>$error</p>";
                                    }             
                                } else if (isset($_SESSION["register success"])){
                                    $pending = $_SESSION["register success"];
                                    echo "<p class='form_control' style ='color: green; font-family:Stoic Script,cursive;'>$pending</p>";
                                }
                                
                                function sticky_input(){
                                                                 
                                    if(isset($_SESSION["register_data"]["name"])){
                                        echo '<input type="text" name="name" class="form-control" id="Name" placeholder="Name" value="' . $_SESSION["register_data"]["name"] . '">  ';
                                    }else{
                                        echo '<input type="text" name="name" class="form-control" id="Name" placeholder="Name" required>';
                                    }

                                    if(isset($_SESSION["register_data"]["surname"])){
                                        echo '<br> <input type="text" name="surname" class="form-control" id="Surname" placeholder="Surname" value="' . $_SESSION["register_data"]["surname"] . '">';
                                    }else{
                                        echo '<br> <input type="text" name="surname" class="form-control" id="Surname" placeholder="Surname" required>';
                                    } 

                                    if(isset($_SESSION["register_data"]["username"]) && isset($_SESSION["register error"]["usn"])){
                                        echo ' <br> <input type="text" name="username" class="form-control" id="Username" placeholder="@Username" value="' . $_SESSION["register_data"]["username"] . '">';
                                    }else{
                                        echo ' <br> <input type="text" name="username" class="form-control" id="Username" placeholder="@Username" required>';
                                    } 
                            
                                    if(isset($_SESSION["register_data"]["email"]) && isset($_SESSION["register error"]["inv_email"])){
                                        echo '<br> <input type="email" name="email" class="form-control" name="Email" placeholder="Email" value="' . $_SESSION["register_data"]["email"] . '">';
                                    }else{
                                        echo '<br> <input type="email" name="email" class="form-control" name="Email" placeholder="Email" required>';
                                    }
                                }
                        ?>
                </div>       
            </div>         
        </main>
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
