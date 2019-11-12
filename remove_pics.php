<?php
session_start();
    if(isset($_POST['image']))
    {
        if (isset($_SESSION['user_name']))
        {
            $dir = "uploads/".$_POST['image'];

            if (is_file($dir))
            {
                unlink($dir.$image);
                echo "success";
            }
        }
    }
?>