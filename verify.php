<?php
    if (isset($_GET['key']) && isset($_GET['email']))
    {
         require 'config/setup.php';
        $email = $_GET['email'];
        $key = $_GET['key'];
        try{
            $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
            $stmt = $conn->prepare("SELECT `user_email`,`user_key` FROM `users` WHERE user_email = :user_email AND user_key = :user_key");
            $stmt->bindValue(':user_email', $email);
            $stmt->bindValue(':user_key', $key);
            $stmt->execute();
            $value = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($value === false)
            {
                echo "Error";
            }
            else{
                $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
                $stmt_1 = $conn->prepare("UPDATE `users` SET verify_conf = '1' WHERE user_email = :user_email");
                $stmt_2 = $conn->prepare("UPDATE `users` SET verify = '1' WHERE user_email = :user_email");
                $stmt_1->bindParam(':user_email', $email);
                $stmt_2->bindParam(':user_email', $email);
                $stmt_1->execute();
                $stmt_2->execute();
                // echo "Account verified";
                echo "<script language='javascript'>alert('Account verified');</script>";

    
            }
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
         header('Location:signin.php');
    }
?>