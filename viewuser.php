<?php
require "header.php";
require "config/database.php";
session_start();
function getuserdata($userid)
{
    $array = array();
    $stmt = $conn->prepare("SELECT `*` FROM `users` WHERE `user_id` = :$userid");
    $stmt->bindvalue(':user_id', $userid);
    $stmt->execute();
    $value = $stmt->fetch(PDO::FETCH_ASSOC);
    while ($value)
    {
        $array['user_id'] = $value['user_id'];
        $array['user_name'] = $value['user_name'];
        $array['firstname'] = $value['firstname'];
        $array['lastname'] = $value['lastname'];
        $array['user_email'] = $value['user_email'];
        $array['country'] = $value['country'];
        $array['city'] = $value['city'];
        $array['about'] = $value['about'];
    }
    return $array;
}
function getid($username)
{
    $stmt = $conn->prepare("SELECT `*` FROM `users` WHERE `user_name` = :$username");
    $stmt->bindvalue(':user_name', $username);
    $stmt->execute();
    $value = $stmt->fetch(PDO::FETCH_ASSOC);
    while ($value)
    {
        return $value['user_id'];
    }

}
if (isset($_SESSION['user_name']))
{
    $userdata = getuserdata(get($_SESSION['user_name']));
}
?>
<html>
    <body>
        <i class="fas fa-user"></i>
        <h2>USER PROFILE</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_name" placeholder = "username" value ="<?php echo $userdata['user_name']?>"><br>
            <input type="text" name="firstname" placeholder = "firstname" value ="<?php echo $userdata['firstname']?>"><br>
            <input type="text" name="lastname" placeholder = "lastname" value ="<?php echo $userdata['lastname']?>"><br>
            <input type="text" name="user_email" placeholder = "useremail" value ="<?php echo $userdata['user_name']?>"><br>
            <label for="country">Country</label><br>
            <select id="country" name="country" >
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
                <textarea name="about_me" placeholder="Write something.." value ="<?php echo $userdata['about_me']?>" style="height:200px"></textarea><br>
            <button type="submit"> <a href = "main.php">back</a></button><br>
        </form>
    </body>
</html>