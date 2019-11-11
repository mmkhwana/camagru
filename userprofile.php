<?php

require "header.php";
require "config/database.php";
session_start();
if (!$_SESSION['user_name'] && !$_SESSION['user_id'] && !$_SESSION['user_email'] )
{
    header('Location:index.php');
}
$userdata = NULL;
if (isset($_POST['update']))
{
    $username = $_POST['user_name'];
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $country    = $_POST['country'];
    $city       = $_POST['city']; 
    $usermail = $_SESSION['user_email'];
    try{
        $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);       
        $sql = $conn->prepare("UPDATE `camagru`.`users` SET `user_name` = '$username', firstname = '$firstname', lastname = '$lastname', country = '$country', city = '$city', about_me = '$about', user_mail =`$usermail`
         WHERE user_email = :user_email");
        $sql->bindParam(':user_email', $usermail);
        $sql->execute();
       
        if (!$sql)
            print_r ($conn->errorInfo());
        else
        {
            // echo "executedd";
           // if (isset($_POST['check']) && ($_POST['check'] == 'Yes'))
           // {
                echo "Profile Updated";
           // }
        }
    }
    catch(PDOException $e)
    {
        echo " Error".$e->getMessage();
    }
}
//     if (isset($_SESSION['user_name']))
//         {
//             echo "check ->" . $_SESSION['user_name']. $_SESSION['user_id'] ;
//             //  $userdata = getuserdata(getid($_SESSION['user_name']));
//             // $userdata = getuserdata("mali");
//         }
 ?>
<html>
<header>
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <div class = "navbar">
        <a href = "index.php">Gallery</a>
        <!-- <a href = "userprofile.php">Edit Profile</a> -->
        <a href = "signout.php">Sign Out</a>
    </div>
    </header>
    <body>
        <h2>Edit Profile</h2>
         
         <label class="switch">
            <form method = "post">
                <h3>Turn on to get notification  <input type="checkbox" name = "check" value = "Yes"></h3>
                <span class="slider round"></span>
            </form>
        </label>
        <h5><a href = "changepassword.php">change password</a></h5>
        <form  method = "post">
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
        <!-- <script type = "text/javascript" src ="useredit.js"> -->
        <!-- </script> -->
    </body>
</html>