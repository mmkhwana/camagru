<?php
require "header.php";
session_start();
echo "Welcome ".$_SESSION['user_name']. "<br/>";
?>
<html>
    <header>
    <div class = "navbar">
        <a href = "userprofile.php">Edit Profile</a>
        <a href = "signout.php">Sign Out</a>
    </div>
    </header>
    <body>
        <div class = "timeline">
            feeds
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="picture" accept = "*/images">
            <button type="submit"  name="upload">Upload</button>
            </form>
            <div class = "post">
                <div class = "user">
                    post
                    <div class = "gallery">
                        image like and comment
                    </div>
                </div> 
            </div>
        </div>
    </body>
</html>