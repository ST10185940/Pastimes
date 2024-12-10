<?php
require_once 'config_session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css\style.css"> 
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Textbook Trove | Home</title>
</head>
<body>
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
    <hr style="margin-left: 100px; margin-right: 100px;">
    <br>
    <section>
        <main class="buy-sell">
            <h2>Book Listing</h2>
            <br>
            <p>Fill in the form below to apply to sell an item and wait for it to be listed </p>
            <br>
            <div class="text-image">
                <div>
                    <form method="POST" action="pastimes_contr.php" style="max-width:150%" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Product Title" required>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <input type="text" name="description" class="form-control" placeholder="Product Description" required>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <select name="type" id="type" class="form-control" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="clothing">Clothing</option>
                                <option value="accessory">Accessory</option>
                                <option value="footwear">Footwear</option>
                                <!-- Add more types as needed -->
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <input type="text" name="size" class="form-control" placeholder="Size (e.g., M, L, 10, etc.)" required>
                        </div>
                        <br>

                        <div class="form-group">
                            <select name="condition" id="condition" class="form-control" required>
                                <option value="" disabled selected>Select Condition</option>
                                <option value="Like-New">Like-New</option>
                                <option value="Gently-Worn">Gently-Worn</option>
                                <option value="Worn">Worn</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="Asking Price (e.g., R350)" required>
                        </div>
                        <br>

                        <div class="form-group">
                            <input type="text" name="brand" class="form-control" placeholder="Brand" required>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="image">Upload Product Image</label><br><br>
                            <input type="file" name="image" accept="image/*" class="form-control" required>   
                        </div>
                        <br>

                        <button type="submit" name="request" class="btn btn-success">Request Product Listing</button>
                    </form>

                </div>
                
                <div style="margin-left:400px; margin-top:-400px;">
                    <h3>Your Listings</h3>
                    <br>
                    <p>Products you have currently listed for sale will appear here</p>
                    <br>
                    <table class=" table table-hover">
                            <thead>
                                <tr>
                                    <th>Title.&nbsp; &nbsp;</th>
                                    <th>Seller (You)</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP code to fetch and display database records -->
                                <?php
                                require_once 'DBConn.php';
                                $uid = $_SESSION["uid"] ?? null;
                                $query = "SELECT title, `sid` as seller, price FROM product WHERE sid = :uid AND available = 1 LIMIT 4;";
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(':uid', $uid);
                                $stmt->execute(); 
                                         
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['seller']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                    echo "</tr>";
                                }       
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <div>
                            <h4>Note:</h4>
                            <br>
                            <?php
                                                                
                                if(isset($_SESSION["input_errors"])){
                                    $errors = $_SESSION["input_errors"];
                                    foreach($errors as $error){
                                    echo '<p style ="color: red; font-family:Stoic Script,cursive;">' . $error . '</p>';
                                    }
                                }else if(isset($_SESSION["pending"])){
                                    $success = $_SESSION["pending"];
                                    echo '<p style ="color: green; font-family:Stoic Script,cursive;">' . $success .'</p>';
                                }
                                                
                            ?>

                        </div>                       
                </div>

            </div>

        </main>
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