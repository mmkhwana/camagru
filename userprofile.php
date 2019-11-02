<?php
require("header.php");
require("config/database.php");
session_start();
if (isset($_POST['update']))
{
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $country    = $_POST['country'];
    $city       = $_POST['city']; 
    $about      = $_POST['about_me'];
    try{       
        $sql = "INSERT INTO `camagru`.`users` (`firstname`,`lastname`,`country`, `city`, `about_me`)
        VALUES ('".$firstname."', '".$lastname."', '".$country."','".$city.",".$about."')";
        $res = $conn->query($sql);

        if (!$res)
            print_r ($conn->errorInfo());
        else
            echo "User Registered";
    }
    catch(PDOException $e)
    {
        echo " hashing    ".$e->getMessage();
    }

}
?>
<html>
    <body>
        <i class="fas fa-user"></i>
        <h2>USER PROFILE</h2>
        <form action="<? echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_name" placeholder = "username" value ="<? if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>" require><br>
            <input type="text" name="firstname" placeholder = "firstname" require><br>
            <input type="text" name="lastname" placeholder = "lastname" require><br>
            <input type="text" name="user_email" placeholder = "useremail" value ="<? if(isset($_SESSION['user_email'])) echo $_SESSION['user_email']; ?>" require><br>
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
            <label for="about">About Me</label><br>
                <textarea name="about_me" placeholder="Write something.." style="height:200px"></textarea><br>
            <button type="submit" name="update">UPDATE</button><br>
        </form>
    </body>
</html>