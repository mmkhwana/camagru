<?php
require_once("setup.php");
try {
    $conn = new PDO("mysql:host=$servername", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
    // creat database
    $dbase = "CREATE DATABASE IF NOT EXISTS camagru";
    $conn->exec($dbase);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
        echo  $dbase."<br>".$e->getMessage();
        echo "Connection failed: " . $e->getMessage();
    }
try{
    //create table
    $conn = new PDO("mysql:host=$servername;dbname=camagru", $dbusername, $dbpassword);
    $sql = "CREATE TABLE users(
        user_id         INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        user_name       TINYTEXT NOT NULL,
        user_email      TINYTEXT NOT NULL,
        user_pwd        LONGTEXT NOT NULL,
        verify          INT(11) NOT NULL,
        verify_conf     INT(11)
    )";
     // use exc() because no results are returned
     $conn->exec($sql);
     
    echo "Table user created";
    }
catch(PDOException $e)
    {
        echo  $sql."<br>".$e->getMessage();
    }
 //   $conn = null;           
?>