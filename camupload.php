<?php

    function super_impose($src,$dest,$added)
    {
        $base = imagecreatefrompng($src);
        $superpose= imagecreatefrompng($added);
        list($width, $height) = getimagesize($src);
        list($width_small, $height_small) = getimagesize($added);
        imagecopyresampled($base , $superpose,  20, 20, 0, 0, 50, 50,$width_small, $height_small);
        imagepng($base , $dest);
    }
    super_impose("images/".$name.".png","images/".$name.".png",$_POST['image-name']);

        if (isset($_POST['image']))
    {
        $filteredData = str_replace("data:image/png;base64,", "", $_POST['image']);
        $filter = str_replace(" ", "+", $filteredData);
        $image = base64_decode($filter);
        file_put_contents('images/'.rand(0,100).'.png', $image);

        echo "success";
    }
    else 
    {
        echo "failed";
    }​

?>