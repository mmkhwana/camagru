<?php
    if (isset($_POST['image'])){
        $upload_dir = "uploads/";
        $filteredData = str_replace("data:image/png;base64,", "", $_POST['image']);
        $image = str_replace(" ", "+", $filteredData);
      /*  $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['image']));
        // move_uploaded_file($_FILES["picture"]["tmp_name"], $upload_dir.$image);*/
         file_put_contents('uploads/'.rand(0,50).'.png', $image);
         
         echo "success";
         echo "<script>alert(".$_POST['image'].")</script>";
    }else {
        echo "failed";
    }