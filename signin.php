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
                //$verify = 1;
                $stmt = $conn->prepare("SELECT `*` FROM `users` WHERE user_email = :user_email");
                $stmt->bindvalue(':user_email', $mailuser);
                //$stmt->bindvalue(':verify_config', $verify);
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
                        $_SESSION['about_me'] = $value["about_me"];
                        header("Location: main.php");
                    }
                    else {
                        echo "incorrect email/password";
                    }
                }
            }
            // else{
            //     $sql = "SELECT * FROM `users` WHERE user_email = '".$mailuser."';";
            //     $res = $conn->query($sql);

            //     if (mysqli_num_rows($res) > 0)
            //     {
            //         while ($row = mysqli_fetch_assoc($res)){
            //             $hashed = $row['user_pwd'];
            //             if (password_verify($password, $hashed))
            //             {
            //                 echo "YES";
            //             }
            //             else{
            //                 echo "NO";
            //             }
            //         }
            //     }
            // }
        }
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_email" placeholder = "email" require><br>
            <input type="password" name="user_pwd" placeholder = "password" require><br>
            <button type="submit" name="signin-submit">SIGNIN</button><br>
            <a href="forgetpassword.php">forget password</a>
        </form>
    </body>
</html>
<?php
// require footer
?>