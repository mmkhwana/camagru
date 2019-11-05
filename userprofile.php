<?php

require "header.php";
require "config/database.php";
session_start();
$userdata = NULL;
if (isset($_POST['update']))
{
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $country    = $_POST['country'];
    $city       = $_POST['city']; 
    $about      = $_POST['about_me'];
    $usermail = $_SESSION['user_email'];
    try{
        $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);       
        $sql = $conn->prepare("UPDATE `camagru`.`users` SET firstname = '$firstname', lastname = '$lastname', country = '$country', city = '$city', about_me = '$about'
         WHERE user_email = :user_email");
        $sql->bindParam(':user_email', $usermail);
        $sql->execute();
       
        if (!$sql)
            print_r ($conn->errorInfo());
        else
            echo "Profile Updated";
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
<div class="container">
        <h2>EDIT USER PROFILE</h2>
            <div class="profile-bio">
                <p value ="<?php  if (isset($_SESSION['about_me'])) echo $_SESSION['about_me'];?>"><span class="profile-real-name"></span></p>
            </div>
		<div class="profile">
			<div class="profile-image">
				<img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="">
			</div>
			<div class="profile-user-settings">
				<h1 class="profile-user-name" value ="<?php  if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>"></h1>
			</div>
			
		</div>
		<!-- End of profile section -->
</div>
	<!-- End of container -->

</header>

    <body>
        <form  method = "post">
            <input type="text" name="user_name" placeholder = "username" value ="<?php  if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>" require><br>
            <input type="text" name="firstname" placeholder = "firstname" value ="<?php  if (isset($_SESSION['firstname'])) echo $_SESSION['firstname'];?>" require><br>
            <input type="text" name="lastname" placeholder = "lastname" value ="<?php  if (isset($_SESSION['lastname'])) echo $_SESSION['lastname'];?>" require><br>
            <input type="text" name="user_email" placeholder = "useremail" value ="<?php if (isset($_SESSION['user_email'])) echo $_SESSION['user_email'];?>" require><br>
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
                <textarea name="about_me" placeholder="Write something.." value ="<?php  if (isset($_SESSION['about_me'])) echo $_SESSION['about_me'];?>" style="height:200px"></textarea><br>
            <button type="submit" name="update">UPDATE</button><br>
        </form>
        <script type = "text/javascript" src ="useredit.js">
        </script>
    </body>
</html>