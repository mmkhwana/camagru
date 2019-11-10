<?php
require "header.php";
session_start();
echo "Welcome ".$_SESSION['user_name']. "<br/>";
?>
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <div class = "navbar">
        <a href = "index.php">Gallery</a>
        <a href = "userprofile.php">Edit Profile</a>
        <a href = "signout.php">Sign Out</a>
    </div>
    </header>
    <body>
        <div class = "container">
            <div class = "main">
                <div class = "div-sticker">
                    <select name="stickers" id="stickers">
                        <option value="none">Default</option>
                        <option value="laugh.jpg">laugh _emoji</option>
                        <option value="loveyou.jpg">love_you</option>
                        <option value="tounge_out.jpg">tounge_out_emoji</option>
                        <option value="whatsapp.jpg">whatsapp</option>
                    </select>
                </div>
                <div class = "preview">
                    <video autoplay id = "play"></video>
                    <img id = 'chosen-img' width="250px" height="250px"/>
                    <input type="text" id = 'sticker-name' style = "display:none" value = "none"/>
                    <canvas width = "400" height = "400" id="main"></canvas>
                </div>
                <div id = "Pick" class = "capture-btn">
                        <input id = "choose" type="file" name="picture" accept = "*/images"/>
                    <button type="button" id = "capture">capture</button>
                </div>

                <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="picture" accept = "*/images">
                <button type="submit"  name="upload">Upload</button>
                </form>
                <div class = "preview">
                    <video autoplay id = "play"></video>
                    <button type="button" id = "capture">capture</button>
                    <canvas width = "400" height = "400" id="main"></canvas>
                    <script src = "camera.js"></script>
                <div class = "user">
                        post
                        <form action = "post.php" method = "post">
                        <button type="submit" name = "post" > Post</button>
                        <img src=”post.php?id=1” alt = "image" />
                        </form>

                
                        <div class = "gallery">
                            image like and comment
                        </div>
                    </div> 
                </div> -->
            </div>
            <div class = "side">
                <?php
//                    session_start();
                    $img_dir = "uploads/";
                    $images = scandir($img_dir);
    //                $images = preg_grep('~^'.$_SESSION['username'].'.*\.png$~', $images);
                    $list = '<ul id = "list-side">';
                    foreach($images as $img) 	
                    { 
                        if($img === '.' || $img === '..')
                        {
                            continue;
                        } 
                        if (preg_match("/\.(gif|jpg|png|jpeg)$/i",$img))
                        {				
                            $list.='<li id = "'.$img.'" class="li-img"><div class = "gallery"><img onmousedown="removeImage(event)" src=" '.$img_dir.$img.'" width="100" height="100" /></div></li>';
                        } 
                        else 
                        { 
                            continue; 
                        }	
                    }
                    $list .= '</ul>';
                    echo $list; 
                ?> 
            </div>
        <!-- <form method = "POST" >
              
                <input type = "hidden" id = "url" name = "url"> </p>
                <input type ="submit" name = "apply" value  = "Apply">
    </form> -->
        </div>
       
        <script src = "camera.js"></script>        
    </body>
</html>