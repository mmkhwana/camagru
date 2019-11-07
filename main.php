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
                <video autoplay id = "play"></video>
                <button type="button" id = "capture">capture</button>
                <canvas width = "400" height = "400" id="main"></canvas>
                <script src = "camera.js"></script>
            <div class = "user">
                    post
                    <!-- <form action="upload.php" method = "">
                    <button type="submit" name = "post" action = "post.php"> Post</button>
                    </form> -->

            
                    <div class = "gallery">
                        image like and comment
                    </div>
                </div> 
            </div>
        <!-- <form method = "POST" >
             <select name="stickers" id="stickers">
                <option value="none">Default</option>
                <option value="./stickers/sticker1.png">Greentoon</option>
                <option value="./stickers/sticker2.png">Linkedin</option>
                <option value="./stickers/sticker3.png">Jordan</option>
                <option value="./stickers/sticker4.png">Google Store</option>
                <option value="./stickers/sticker5.png">Hippy</option>
                <option value="./stickers/sticker7.png">Linux</option>
                <option value="./stickers/sticker8.png">Linux Drunk</option>
    
                <input type = "hidden" id = "url" name = "url"> </p>
                <input type ="submit" name = "apply" value  = "Apply">
            </select>
    </form> -->
        </div>
       
            
    </body>
</html>