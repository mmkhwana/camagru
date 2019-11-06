<?php
    if (isset($_POST['image'])){
        echo "success";
        $upload_dir = "uploads/";
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['image']));
        // move_uploaded_file($_FILES["picture"]["tmp_name"], $upload_dir.$image);
         file_put_contents('/uploads/rand(0,50).png', $image);
    }else {
        echo "failed";
    }