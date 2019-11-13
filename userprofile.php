<?php
    require "header.php";
    require "config/database.php";
    session_start();
?>
<html>
<header>
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class = "navbar">
        <a href = "index.php">Gallery</a>
        <!-- <a href = "userprofile.php">Edit Profile</a> -->
        "<a href = 'main.php'>My timeline</a>";
        <a href = "signout.php">Sign Out</a>
    </div>
    </header>
    <body>
        <h2>Edit Profile</h2>
        <?php echo $_SESSION['receive_email']; ?> 
        <h5><a href = "changepassword.php">change password</a></h5>
        <form action = "update.php"  method = "post">
           Receive Email Notification ?<br/>
            Yes <input type="radio" name="receive_email" value="Yes"><? if ($_SESSION['receive_email'] == "Yes") echo " checked"; ?><br>
            No <input type="radio" name="receive_email" value="No"><? if ($_SESSION['receive_email'] == "No") echo " checked"; ?><br>
            Currently Set to: <?php echo $_SESSION['receive_email']; ?>  <br/>
            <input type="text" name="user_name" placeholder = "username" value ="<?php  if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>" ><br>
            <input type="text" name="firstname" placeholder = "firstname" value ="<?php  if (isset($_SESSION['firstname'])) echo $_SESSION['firstname'];?>" ><br>
            <input type="text" name="lastname" placeholder = "lastname" value ="<?php  if (isset($_SESSION['lastname'])) echo $_SESSION['lastname'];?>" ><br>
            <input type="text" name="user_email" placeholder = "useremail" value ="<?php if (isset($_SESSION['user_email'])) echo $_SESSION['user_email'];?>"><br>
            <label for="country">Country</label><br>
            <select id="country" name="country">
                <option value="south_africa">South Africa</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select><br>
            <label for="city">City</label><br>
                <select id="city" name="city"><br>
                    <option value="johhanessburg">JHB</option>
                    <option value="witbank">WITBANK</option>
                    <option value="cape_town">CAPE TOWN</option>
            </select><br>
            <button type="submit" name="update">UPDATE</button><br>
        </form>
<footer>
    <div class="footer">
    <p>&copy; 2019 camagru.com<p>
    </div>
</footer>  
    </body>
</html>