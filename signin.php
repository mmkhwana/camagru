<?php
// require header
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
                $stmt = $conn->prepare("SELECT `user_id`,`user_name`, `user_pwd` FROM `users` WHERE user_email = :user_email");
                $stmt->bindvalue(':user_email', $mailuser);
                $stmt->execute();
                $value = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($value == false)
                {
                    echo "incorrect email/password";
                }
                else{
                    $hashed = $value['user_pwd'];
                    $pwdcheck = password_verify($password,$hashed);

                    if ($pwdcheck){
                        $_SESSION['userId'] = $value["user_id"];
                        $_SESSION['username'] = $value["user_name"];
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
            <input type="text" name="user_email" placeholder = "email"><br>
            <input type="password" name="user_pwd" placeholder = "password"><br>
            <button type="submit" name="signin-submit">SIGNIN</button><br>
            <a href="#">Forgert Password</a>
        </form>
    </body>
</html>
<?php
// require footer
?>