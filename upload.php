<?php
    require "config/database.php";
    if (isset($_POST['upload']))
    {
        $image = basename($_FILES["picture"]["name"]);
        $tmp_dir = getimagesize($_FILES["picture"]["tmp_name"]);
        $imagesize = $_FILES['picture']['size'];
        $imagetype = strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $upload_dir = "uploads/";
        $out=$upload_dir.$_FILES["picture"]["name"];
        $upload = 1;
         
        if (!preg_match("/\.(gif|jpg|png|jpeg)$/i",$image))
        {
            echo "Sorry not an image";
            $upload = 0;
        }
        if (file_exists($image))
        {
            echo "file already exits";
            $upload = 0;
        }
        if ($imagesize > 500000)
        {
            echo "Image to large";
            $upload = 0;
        }
        if ($tmp_dir)
        {
            if ($tmp_dir !== false)
            {
                echo "File is an image - " . $check["mime"] . ".";
                $upload = 1;
            } else {
                echo "File is not an image.";
                $upload = 0;
            }
        }
        if ($upload == 0)
        {
            echo "Coulnt upload file";
        }
        else 
        {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $upload_dir.$image))
            {
                $sql = $conn->prepare("INSERT INTO `camagru`.`images` (`img_name`, `img_dir`)
                VALUES (:img_name,:img_dir)");
                $sql->bindValue(':img_name',$image);
                $sql->bindValue(':img_dir',$out);
                $sql->execute();
                echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
                echo "<img src=$out >";
            } else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
?>