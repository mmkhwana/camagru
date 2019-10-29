<?php
require 'header.php';
    if (isset($_POST['Password-submit']))
    {
        echo "check";
        require 'config/setup.php';
        include "config/database.php";
        $usermail = $_POST['user_email'];
        $userpwd = $_POST['user_pwd'];
        $userpwd_new = $_POST['user_pwd_new'];
        $userpwd_new_pwd = $_POST['user_pwd_new_pwd'];

        if (epmty($userpwd_new) || empty($userpwd_new_pwd) || empty($usermail))
        {
            echo "Empty fields";
        }
        else if ($usermail == $usermail)
        {
            $stmt = $conn->prepare("SELECT `user_email` FROM `users` WHERE user_email = :user_email");
            $stmt->bindvalue(':user_email', $usermail);
            $stmt->execute();
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed = $value['user_pwd'];
            $pwdcheck = password_verify($userpwd,$hashed);

        }
        else if ($pwdcheck == $userpwd_new)
        {
            echo "Cant use old password";
        }
        else
        {
            try{
                $hashed = password_hash($userpwd_new_pwd, PASSWORD_DEFAULT);
                $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
                $stmt = $conn->prepare("SELECT `user_pwd` FROM `users` WHERE user_email = :user_email");
                $stmt->bindValue(':user_email', $email);
                $stmt->execute();
                $value = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($value === false)
                {
                    echo "Error";
                }
                else{
                    $hashed = password_hash($userpwd_new_pwd, PASSWORD_DEFAULT);
                    $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
                    $stmt_1 = $conn->prepare("UPDATE `users` SET user_pwd = 'user_pwd_new_pwd' WHERE user_email = :user_email");
                    $stmt_1->bindParam(':user_email', $usermail);
                    $stmt_1->execute();
        
                }
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
            try{
                $verifymail = rand();
                $hashed = password_hash($userpwd_new_pwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `camagru`.`users` (`user_name`,`user_email`,`user_pwd`, `user_key`)
                VALUES ('".$username."', '".$usermail."', '".$hashed."', '".$verifymail."')";
                $query = $conn->query($sql);
                $messege = "
                    Login with new passsword
                    http://localhost:8081/camagru/verify.php?email=".$usermail."&key=".$verifymail."
                ";
                mail($usermail,"Camagru confirm email",$messege,"FROM Camagru");
                echo "Please check email for new password verification";
                }
                catch(PDOException $e)
                {
                    echo "not vertifed".$e->getMessage();
                }
        }
    }
?>
<html>
    <h3>Create New Password</h3>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
        <input type="text" name="user_email" placeholder = "User email" require><br>
        <input type="password" name="user_pwd_new" placeholder = "New Password" require><br>
        <input type="password" name="user_pwd_new_pwd" placeholder = "Confirm password" require><br>
        <button type="submit" name="Password-submit">Submit</button><br>
    </form>
</html>