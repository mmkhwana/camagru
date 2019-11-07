
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
    ?>