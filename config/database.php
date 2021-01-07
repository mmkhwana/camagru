<?php
require_once("setup.php");
try {
    $conn = new PDO("mysql:host=$servername", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  echo "Connected";
    // creat database
    $dbase = "CREATE DATABASE IF NOT EXISTS camagru";
    $conn->exec($dbase);
    // echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
        echo  $dbase."<br>".$e->getMessage();
        echo "Connection failed: " . $e->getMessage();
    }
try{
    //create table
    $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
    $sql = "CREATE TABLE IF NOT EXISTS users(
        user_id         INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        user_name       TINYTEXT NOT NULL,
        firstname       TINYTEXT NULL,
        lastname        TINYTEXT NULL,
        country         TINYTEXT NULL,
        city            TINYTEXT NULL,
        user_email      TINYTEXT NOT NULL,
        user_pwd        LONGTEXT NOT NULL,
        user_key        LONGTEXT NOT NULL,
        receive_email   VARCHAR(10) DEFAULT 'Yes',
        verify          INT(11) DEFAULT 0,
        verify_conf     INT(11) DEFAULT 0
    )";
     // use exc() because no results are returned
     $conn->exec($sql);
     
     //echo "Table user created";
    }
catch(PDOException $e)
    {
        echo  $sql."<br>".$e->getMessage();
    }
try{
    //create table
    $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
    $sqll = "CREATE TABLE IF NOT EXISTS images(
            img_id          INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            img_name        VARCHAR(200) NOT NULL,
            img_dir         VARCHAR(300) NULL
            
        )";
         // use exc() because no results are returned
         $conn->exec($sqll);
         
         //echo "Table user created";
        }
    catch(PDOException $e)
        {
            echo  $sqll."<br>".$e->getMessage();
        }

try{
    //create table
    $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
    $sqllike = "CREATE TABLE IF NOT EXISTS likes(
            like_id         INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL
            img_id          INT(11) NOT NULL,
            liker_id        INT(11) NOT NULL,
            date            datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            like_status     INT(11) NOT NULL
                    
        )";
            // use exc() because no results are returned
            $conn->exec($sqllike);
                 
             //echo "Table user created";
            }
        catch(PDOException $e)
        {
            echo  $sqllike."<br>".$e->getMessage();
        }

try{
        //create table
        $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
        $sqlcomment = "CREATE TABLE IF NOT EXISTS comments(
            comments_id         INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL
            img_id              INT(11) NOT NULL,
            user_id             INT(11) NOT NULL,
            comment             VARCHAR(300) NOT NULL,
            comment_date        datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
                            
            )";
            // use exc() because no results are returned
            $conn->exec($sqlcomment);
                         
            //echo "Table user created";
    }

catch(PDOException $e)
                {
                    echo  $sqlcomment."<br>".$e->getMessage();
                }
        
 //   $conn = null;           
?>