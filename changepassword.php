<?php
require 'header.php';
session_start();
    if (isset($_POST['Password-submit']))
    {
        echo "in";
        // print_r($_SESSION);
        if (isset($_SESSION['user_email']))
        {
             echo "check";
            require 'config/setup.php';
            include "config/database.php";
            $userpwd_new = $_POST['user_pwd_new'];
            $userpwd_new_pwd = $_POST['user_pwd_new_pwd'];
            $upper = preg_match('@[A-Z]@', $userpwd_new);
            $lower = preg_match('@[a-z]@', $userpwd_new);
            $number    = preg_match('@[0-9]@', $userpwd_new);
            $specialChars = preg_match('@[^\w]@', $userpwd_new);

            if (empty($userpwd_new) || empty($userpwd_new_pwd))
            {
                echo "Empty fields";
            }
            else if(!$upper || !$lower || !$number || !$specialChars || (strlen($userpwd_new) < 8)) {
                echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            }
            if ($pwdcheck)
            {
                echo "Cant use old password";
            }
            else
            {
                try{
                    $hashed = password_hash($userpwd_new_pwd, PASSWORD_DEFAULT);
                    // $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
                    $stmt = $conn->prepare("SELECT `user_pwd` FROM `users` WHERE user_email = :user_email");
                    $stmt->bindValue(':user_email', $_SESSION['user_email']);
                    $stmt->execute();
                    $value = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($value == false)
                    {
                        echo "Error";
                    }
                    else{
                        $userpwd = $value['user_pwd'];
                        $hashed = password_hash($userpwd_new_pwd, PASSWORD_DEFAULT);
                        // $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
                        $stmt_1 = $conn->prepare("UPDATE `users` SET user_pwd = '$hashed' WHERE user_email = :user_email");
                        $stmt_1->bindParam(':user_email', $_SESSION['user_email']);
                        $stmt_1->execute();
                         echo "Password changed";
                    }
                }
                catch(PDOException $e){
                    echo  $e->getMessage();
                }
            }
         }
    }
?>
<html>
    <h3>Change Password</h3>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
        <input type="password" name="user_pwd_new" placeholder = "New Password" require><br>
        <input type="password" name="user_pwd_new_pwd" placeholder = "Confirm password" require><br>
        <button type="submit" name="Password-submit">Submit</button><br>
    </form>
</html>