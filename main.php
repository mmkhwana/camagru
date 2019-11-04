<?php
session_start();
echo "Welcome ".$_SESSION['user_name']. "<br/>";
echo "<a href='userprofile.php'>update profile</a> <br>";
echo "<a href='viewuser.php'>viewprofile</a> <br>";
 echo "<a href='signout.php'>SignOut</a><br>";

?>