<?php
// require header
include "config/config.php";
?>
<html>
    <body>
        <?php
            if(isset($_POST['signup-submit']))
            {
                $username = $_POST['user_name'];
                $email = $_POST['user_email'];
                $password = $_POST['user_pwd'];
                $passwordconf = $_POST['user_pwdconf'];
        
                if (empty($username) || empty($email) || empty($password) || empty($passwordconf))
                {
                    echo "Empty fields, fill all field";
                }
                else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    echo "Invalid email address";
                }
                else if($password !== $passwordconf)
                {
                    echo "Passwords not the same";
                }
                else{
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`user_id`,`user_name`,`user_email`,`user_pwd`)
                    VALUES (NULL, '".$username."', '".$email."', '".$hashed."')";
                    $res = $conn->query($sql);
                    if (!$res)
                        echo "Error: ".$conn->error;
                    else
                        echo "User Registered";
                }
            }

        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_name" placeholder = "username"><br>
            <input type="text" name="user_email" placeholder = "email"><br>
            <input type="password" name="user_pwd" placeholder = "password"><br>
            <input type="password" name="user_pwdconf" placeholder = "confirm password"><br>
            <button type="submit" name="signup-submit">SIGNUP</button>
        </form>
    </body>
</html>
<?php
// require footer
?>