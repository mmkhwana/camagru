<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "camagrudb";

// $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
// if (!$conn)
// {
//     die("Connection fail: ".mysqli_connect_error());
// }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>