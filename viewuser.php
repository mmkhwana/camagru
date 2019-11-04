<?php
require "header.php";
require "config/database.php";
session_start();
?>
<html>
    <body>
        <i class="fas fa-user"></i>
        <h2>USER PROFILE</h2>
        <form method = "post">
            <input type="text" name="user_name" placeholder = "username" value ="<?php  if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>"><br>
            <input type="text" name="firstname" placeholder = "firstname" value ="<?php  if (isset($_SESSION['firstname'])) echo $_SESSION['firstname'];?>"><br>
            <input type="text" name="lastname" placeholder = "lastname" value ="<?php  if (isset($_SESSION['lastname'])) echo $_SESSION['lastname'];?>"><br>
            <input type="text" name="user_email" placeholder = "useremail" value ="<?php  if (isset($_SESSION['user_email'])) echo $_SESSION['user_email'];?>"><br>
            <label for="country">Country</label><br>
            <select id="country" name="country" value ="<?php  if (isset($_SESSION['country'])) echo $_SESSION['country'];?>" >
                <option value="south_africa">South Africa</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
            </select><br>
            <label for="city">City</label><br>
                <select id="city" name="city" value ="<?php  if (isset($_SESSION['city'])) echo $_SESSION['city'];?>"><br>
                    <option value="johhanessburg">JHB</option>
                    <option value="witbank">WITBANK</option>
                    <option value="cape_town">CAPE TOWN</option>
            </select><br>
            <label for="about">About Me</label><br>
                <textarea name="about_me" placeholder="Write something.." value ="<?php  if (isset($_SESSION['about_me'])) echo $_SESSION['about_me '];?>" style="height:200px"></textarea><br>
            <button type="submit"> <a href = "main.php">back</a></button><br>
        </form>
    </body>
</html>