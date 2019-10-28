<?php
 require "header.php";
include "config/database.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="mobile-web-app-capable"content="yes">
        <meta name="viewport" content="width=device-with,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>camagru</title>   
    </head>
    <!-- <header>
        <div class="navbar">
                <h1 class="active">CAMAGRU</h1> 
        </div>
    </header> -->
    <body>
        <?php
            if(isset($_POST['signup-submit']))
            {
                $username = $_POST['user_name'];
                $email = $_POST['user_email'];
                $password = $_POST['user_pwd'];
                $passwordconf = $_POST['user_pwdconf'];
                $upper = preg_match('@[A-Z]@', $password);
                $lower = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
        
                 if (empty($username) || empty($email) || empty($password) || empty($passwordconf))
                 {
                     echo "Empty fields, fill all field";
                 }
                 else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                 {
                     echo "Invalid email address";
                 }
                 else if(!preg_match("/^[a-zA-Z0-9]*$/",$username))
                 {
                      echo "invalid username";
                 }
                 else if(!$upper || !$lower || !$number || !$specialChars || strlen($password) < 8) {
                     echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                 }                    
                 else if ($username && $email && ($password == $passwordconf)){

                     // echo $username ;
                     // echo "usernaem ---<br>";
                     // echo $email;
                     //  echo "LOok here<br>";
                     try{
                     $verifymail = rand();
                     $hashed = password_hash($password, PASSWORD_DEFAULT);
                     // echo "LOok here <br>";
                     $sql = "INSERT INTO `camagru`.`users` (`user_name`,`user_email`,`user_pwd`, `user_key`)
                     VALUES ('".$username."', '".$email."', '".$hashed."', '".$verifymail."')";
                     $query = $conn->query($sql);
                     $messege = "
                         Confirm Your Email
                         http://localhost:8081/camagru/verify.php?email=".$email."&key=".$verifymail."
                     ";
                     mail($email,"Camagru confirm email",$messege,"FROM Camagru");
                     echo "Please check email to verify account";
                     }
                     catch(PDOException $e)
                     {
                         echo "not vertifed".$e->getMessage();
                     }
                }
                else if($password !== $passwordconf)
                {
                    echo "Passwords not the same";
                }
                else{
                    try{
                    $verifymail = rand();
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `camagru`.`users` (`user_name`,`user_email`,`user_pwd`, `user_key`)
                    VALUES ('".$username."', '".$email."', '".$hashed."','".$verifymail."')";
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
            }

        ?>
        <div class="signupcontainer">
            <form class="signupform" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_name" placeholder = "username" require><br>
            <input type="text" name="user_email" placeholder = "email" require><br>
            <input type="password" name="user_pwd" placeholder = "password" require><br>
            <input type="password" name="user_pwdconf" placeholder = "confirm password" require><br>
            <button type="submit" name="signup-submit">SIGNUP</button>
            <h4>Already have an account <a href="signin.php">Singin</a></h4>
            </form>
        </div>
    </body>
</html>
<?php
// require footer
?>