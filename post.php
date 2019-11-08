<?php
    require "config/database.php";
    session_start();
     if (isset($_POST['post']))
     {
         try{
                $query = "SELECT * from images"; 
                $stmt = $conn->prepare($query);
                
                // bind the id of the image you want to select
                
                // echo $_GET['image_id'];
                // die();
                //$sql->bindParam(1, $_GET['image_id']);
                $stmt->execute();
                
                
                // to verify if a record is found
                $num = $stmt->rowCount();
        
                // echo "sdfsd";
                // echo $num;
                if( $num ){
                // if found
                $value = $stmt->fetch(PDO::FETCH_ASSOC);
                //  var_dump($value);0
                // specify header with content type,
                // you can do header("Content-type: image/jpg"); for jpg,
                // header("Content-type: image/gif"); for gif, etc.
                 header("Content-type: image/jpg");
                //display the image data
                print $value['img_name'];
                exit;
                }
            }
            catch(PDOException $e)
            {
                echo $e;
            }
     }else
     {
        echo "image not found";
    // //if no image found with the given id,
    // //load/query your default image here
     }
?>