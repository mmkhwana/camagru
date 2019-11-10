<?php
    if(isset($_POST['image']))
    {
        $dir = "uploads/".$_POST['image'];

        if (is_file($dir))
        {
            unlink($dir.$image);
            echo "success";
        }
    }
?>