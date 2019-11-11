<?php
require 'header.php';
session_start();
if (!$_SESSION['user_name'] && !$_SESSION['user_id'] && !$_SESSION['user_email'] )
{
    header('Location:index.php');
}
    if (isset($_POST['Password-submit']))
    {
        // print_r($_SESSION);
        if (isset($_SESSION['user_email']))
        {
        
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
            if ($userpwd_new_pwd != $userpwd_new)
            {
                echo "Pasword dont match";
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
        <input type="password" name="user_pwd_new" placeholder = "New Password" pattern="[A-Za-z]{3}" title="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character." required><br>
        <input type="password" name="user_pwd_new_pwd" placeholder = "Confirm password" required pattern="[A-Za-z]{3}" title="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."><br>
        <button type="submit" name="Password-submit">Submit</button><br>
    </form>
</html>