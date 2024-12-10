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
    <title>Dashboard | Admin</title>
    
</head>
<body>

<header>
        <div style=" margin-top: 40px;">
                <img  class="logo" src="_images/pastimes-high-resolution-logo.png" alt="Second Hand Clothing Store primary Logo" style="height: 100px;" align="left" hspace="50">
                <h1>Admin Dashboard</h1>
                <br>
                <form method="post" action="logout.php">
                    <button type="submit" style="background-color: darkolivegreen;" class="btn btn-primary">Log Out</button>
                </form>
            </div>
            <br>
    </header>          
            <main class="about" style="margin-top:100px; margin-left: 85px; max-width: 90%;">
            <div class="text-image">
                    <br>        
                    <div>
                        <br>
                        <br>
                        <h3>Update User</h3>
                        <br>
                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script><dotlottie-player src="https://lottie.host/cfad1cc2-b09a-4a54-8915-4ff16b0b365b/82Tok8dRUW.lottie" background="transparent" speed="1" style="width: 250px; height: 250px" direction="1" mode="bounce" loop autoplay></dotlottie-player>                             
                    </div>

                    <div style="margin-left:150px">
                        <br>
                        <br>                                  
                            <form  class="login-form" method="POST" action="CRUD.php">
                                <div class="text-image">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="uid" placeholder="user id" required>
                                    </div> 
                                    <div style="margin-left:10px;">
                                        <button style= "margin-left:10px" type="submit" name="search" class="btn btn-primary" >🔎</button> 
                                    </div>  
                                </div>                                                                                                                  
                            </form> 
                            <div style="margin-top: -10px; margin-left:30px">
                            <?php
                                if (isset($_SESSION["results"])){
                                        $results = $_SESSION["results"];
                                        echo "<br> uid: " . $results["uid"]."<br>".
                                        "email: " . $results["email"]."<br>".
                                        "username: " . $results["username"]."<br>".
                                        "name: " . $results["name"];                                 
                                }                  
                                ?>
                            </div>                             
                    </div>
                    <div style="margin-left:250px; margin-top:100px">
                        <form  class="login-form" method="POST" action="CRUD.php">
                            <div style = " font-family: 'Stoic Script', cursive;">
                                    Change:                       
                                    <input type="text" class="form-control" name="field"  placeholder="e.g. uid or email" required>
                                    <br>
                                    To:                            
                                    <input type="text" class="form-control" name="new_val"  placeholder="new value" >
                                    <br>
                                    For (User ID):
                                    <input type="text" class="form-control" name="uid"  placeholder="e.g 4" >
                                </div>
                            <br>
                            <button type="submit" name="update" class="btn btn-primary" style="background-color: green;" >Update</button>
                        </form>
                        <?php   
                                if(isset($_SESSION["update error"])){
                                $errors = $_SESSION["update error"];
                                foreach($errors as $error){
                                echo "<br><p class='form_control' style ='color: red; font-family:Stoic Script,cursive;'>$error</p>";
                                } 
                                }  else if (isset($_SESSION["update success"])){
                                        $success = $_SESSION["update success"];
                                        echo "<br><p class='form_control' style ='color: green; font-family:Stoic Script,cursive;'>$success</p>";
                                }                                                                  
                            ?>
                    </div>
                </div>
                <div class="text-image">
                    <div>
                        <br>
                        <h3>Pending/Registered Users:</h3>
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <th>User ID&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                    <th>Username</th>   
                                    <th>Email</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP code to fetch and display database records -->
                                <?php
                                require_once 'DBConn.php';
                                $query = "SELECT `uid`, username , email FROM user
                                          where verified_user = 0  
                                          limit 5 "; 
                                $stmt = $pdo->query($query);                         
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "</tr>";
                                }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-left: 150px">
                            <br>
                            <h3>Verified Users:</h3>
                            <br>
                            <table>
                                <thead>
                                    <tr>
                                        <th>User ID&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Username</th> 
                                        <th>Email</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP code to fetch and display database records -->
                                    <?php
                                    require_once 'DBConn.php';
                                    $query = "SELECT `uid`, username , email FROM user
                                              where verified_user = 1  
                                              limit 5;"; // Select only the 'uid' column
                                    $stmt = $pdo->query($query);                         
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "</tr>";
                                    }                  
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="margin-left: 250px; margin-top : 70px">
                            <form  class="login-form" method="POST" action="CRUD.php" >
                                <br>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="uid" id="Username" placeholder="user id" required>
                                </div>
                                <br>
                                <div  style="display:flex;">
                                        <button type="submit"  name="verify" class="btn btn-primary">Verify User</button>
                                        <button style="margin-left:15px; background-color:orange; color:black;" type="submit"  name="verify_all" class="btn btn-primary">Verify All</button>
                                </div>
                                <br>
                                <button type="submit"  name="delete" style="background-color:red;" class="btn btn-primary">Remove(Delete) User</button>
                            </form> 
                            <?php   
                                if(isset($_SESSION["uid error"])){
                                $errors = $_SESSION["uid error"];
                                foreach($errors as $error){
                                echo "<br><p class='form_control' style ='color: red; font-family:Stoic Script,cursive;'>$error</p>";
                                } 
                                }  else if (isset($_SESSION["uid success"])){
                                        $success = $_SESSION["uid success"];
                                        echo "<br><p class='form_control' style ='color: green; font-family:Stoic Script,cursive;'>$success</p>";
                                }                                                                  
                            ?>
                        </div>
                </div>
                <div class="text-image">
                    <div style="margin-left: 0px">
                            <br>
                            <h3>Manage Listings:</h3>
                            <br>
                            <h5>Pending Items</h5>
                            <table>
                                <thead>
                                    <tr>
                                        <th>PID:&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Item Name:&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Type</th>
                                        <th>Seller</th> 
                                        <th>Asking Price</th> 
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP code to fetch and display database records -->
                                    <?php
                                    require_once 'DBConn.php';
                                    $query = "SELECT p.pid, p.title as title, p.type as type, p.price as price , u.username as seller
                                            FROM product p 
                                            JOIN user u on p.sid = u.uid
                                            WHERE p.available = 0 
                                            LIMIT 5"; // Select only the 'uid' column
                                    $stmt = $pdo->query($query);                         
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['pid']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['seller']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                        echo "</tr>";
                                    }                  
                                    ?>
                                </tbody>
                            </table>
                     </div>
                     <div style="margin-left:120px; margin-top:70px">
                            <br>
                            <h5>Listed Items (Currently For Sale)</h5>
                            <br>
                            <table>
                                <thead>
                                    <tr>
                                        <th>PID:&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Item Name:&nbsp; &nbsp;&nbsp; &nbsp;</th>
                                        <th>Type</th>
                                        <th>Seller</th> 
                                        <th>Asking Price</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP code to fetch and display database records -->
                                    <?php
                                    require_once 'DBConn.php';
                                    $query = "SELECT p.pid, p.title as title, p.type as type, p.price as price , u.username as seller
                                            FROM product p 
                                            JOIN user u on p.sid = u.uid
                                            WHERE p.available = 1
                                            LIMIT 5"; // Select only the 'uid' column
                                    $stmt = $pdo->query($query);                         
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['pid']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['seller']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['price']) . "</td>";     
                                        echo "</tr>";
                                    }                  
                                    ?>
                                </tbody>
                            </table>
                     </div>
                        <div style="margin-left: 180px; margin-top : 70px">
                                <form  class="login-form" method="POST" action="CRUD.php" >
                                    <br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pid" id="item_name" placeholder="Product ID" required>
                                    </div>
                                    <br>
                                    <div style="display:flex;">
                                            <button type="submit"  name="add_listing" class="btn btn-primary">Add To Available Items</button>
                                            <button style="margin-left:15px; background-color:orange; color:black;" type="submit" name="list_all" class="btn btn-primary">Add All</button>
                                    </div>                                         
                                    <br>
                                    <button type="submit" name="delete_item" style="background-color:red;" class="btn btn-primary">Remove(Delete) Item</button>
                                </form> 
                                <?php 
                                    if(isset($_SESSION["listing error"])){
                                    $errors = $_SESSION["listing error"];
                                    foreach($errors as $error){
                                    echo "<br><p class='form_control' style ='color: red; font-family:Stoic Script,cursive;'>$error</p>";
                                    } 
                                    }  else if (isset($_SESSION["listing success"])){
                                            $success = $_SESSION["listing success"];
                                            echo "<br><p class='form_control' style ='color: green; font-family:Stoic Script,cursive;'>$success</p>";
                                    }                                                                  
                                ?>
                        </div>
                </div>               
            </main>               
    <footer>
         <br>
         <p>&copy; 2024 Pastimes.Com .All rights reserved. </p>     
    </footer>
</body>
</html>
