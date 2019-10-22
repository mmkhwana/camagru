<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "camagrudb";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if (!$conn)
{
    die("Connection fail: ".mysqli_connect_error());
}
?>