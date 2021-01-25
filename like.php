<?php
include "config/database.php";
session_start();
if (isset($_SESSION['user_name']))
{
    if(isset($_POST['like']))
    {
        if(isset($_GET[`user_id`])){
            $UserId = $_GET['user_id'];
            try {

                $sql = "INSERT INTO `likes` (`img_id`, `liker_id`, `like_status`) VALUES ('".$UserId."', 1) ON DUPLICATE KEY UPDATE like_status=IF(like_status=1, 0, 1)";
                $conn->query($sql);
                $messege = "
                         Another Your has liked you post";
                     mail($email,"Notification",$messege,"FROM Camagru");
                    //  echo "Please check email to verify account";
                     echo "<script language='javascript'>alert('Liked');</script>";
                // header("Location: main.php");

                }
            catch(PDOException $e){
                    echo  $e->getMessage();
            }
        }
        
    }
}
?>
