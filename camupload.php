<?php
    require_once "config/database.php";
    session_start();
    function super_impose($src,$dest,$added)
    {
        $superpose;
        $base = imagecreatefrompng($src);
        $superpose= imagecreatefromjpeg($added);
        list($width, $height) = getimagesize($src);
        list($width_small, $height_small) = getimagesize($added);
        imagecopyresampled($base , $superpose,  20, 20, 0, 0, 100, 100,$width_small, $height_small);
        imagepng($base , $dest);
    }
    if (isset($_POST['image']))
    {
        $filteredData = str_replace("data:image/png;base64,", "", $_POST['image']);
        $filter = str_replace(" ", "+", $filteredData);
        $image = base64_decode($filter);
        $name = $_SESSION['user_name'].time().'.png';
        file_put_contents('uploads/'.$name, $image);
        super_impose('uploads/'.$name,'uploads/'.$name,'stickers/'.$_POST['img']);
        $out = 'uploads/'.$name;
        $sql = $conn->prepare("INSERT INTO `camagru`.`images` (`img_name`, `img_dir`)
        VALUES (:img_name,:img_dir)");
        $sql->bindValue(':img_name',$name);
        $sql->bindValue(':img_dir',$out);
        $sql->execute();
        if ($sql->rowCount())
            echo "success";
    }
    else 
    {
        echo "failed";
    }​

?>