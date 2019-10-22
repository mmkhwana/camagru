<?php
// require header
include "config/config.php";
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
                $sql = "SELECT * FROM `users` WHERE user_email = '".$mailuser."';";
                $res = $conn->query($sql);

                if (mysqli_num_rows($res) > 0)
                {
                    while ($row = mysqli_fetch_assoc($res)){
                        $hashed = $row['user_pwd'];
                        if (password_verify($password, $hashed))
                        {
                            echo "YES";
                        }
                        else{
                            echo "NO";
                        }
                    }
                }
            }
        }
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
            <input type="text" name="user_email" placeholder = "email"><br>
            <input type="password" name="user_pwd" placeholder = "password"><br>
            <button type="submit" name="signin-submit">SIGNIN</button>
        </form>
    </body>
</html>
<?php
// require footer
?>