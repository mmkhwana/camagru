<?php
require "header.php";
include "config/database.php";
session_start();
?>
<html>
    <body>
        <?php
        if (isset($_POST['signin-submit']))
        {
            $mailuser = $_POST['user_email'];
            $password = $_POST['user_pwd'];
        
            if (empty($mailuser) || empty($password))
            {
               echo "Error: Empty Fields not allowed";
            }
            else{
                $verify = '1';
                $stmt = $conn->prepare("SELECT `user_id`,`user_name`,`user_email`,`user_pwd`,`firstname`,`lastname`,`country`,`city`,`receive_email`  FROM `users` WHERE user_email = :user_email AND verify = :verify");
                $stmt->bindvalue(':user_email', $mailuser);
                $stmt->bindvalue(':verify', $verify);
                $stmt->execute();
                $value = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($value == false)
                {
                    echo "incorrect email/ Account not active";

                }
                else{
                    $hashed = $value['user_pwd'];
                    $pwdcheck = password_verify($password,$hashed);

                    if ($pwdcheck){
                        $_SESSION['user_id'] = $value["user_id"];
                        $_SESSION['user_name'] = $value["user_name"];
                        $_SESSION['user_email'] = $value["user_email"];
                        $_SESSION['firstname'] = $value["firstname"];
                        $_SESSION['lastname'] = $value["lastname"];
                        $_SESSION['country'] = $value["country"];
                        $_SESSION['city'] = $value["city"];
                        $_SESSION['receive_email'] = $value["receive_email"];
                        header("Location: main.php");
                    }
                    else {
                        echo "incorrect email/password";
                    }
                }
            }
            
        }
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_email" placeholder = "email"  title="Insert correct email" required><br>
            <input type="password" name="user_pwd" placeholder = "password" required><br>
            <button type="submit" name="signin-submit">SIGNIN</button><br>
            <a href="forgetpassword.php">forget password</a>
        </form>
    </body>
</html>
<?php
// require footer
?>