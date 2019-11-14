<?php
require "config/database.php";
session_start();
    if(isset($_POST['image']))
    {
        if (isset($_SESSION['user_name']))
        {
            $dir = "uploads/".$_POST['image'];
            $image = $_POST['image'];

            if (is_file($dir))
            {
                unlink($dir);
                try{
                    $query = "DELETE FROM images WHERE img_name = :im_name";
                    $sql = $conn->prepare($query);
                    $sql->bindParam(':im_name', $image);
                    $sql->execute();
                    echo "success";
                }
                catch(PDOException $e)
                {
                    echo " Error".$e->getMessage();
                }
              
            }
        }
    }
?>