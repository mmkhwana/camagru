<?php
session_start();
echo "Welcome ".$_SESSION['username']. "<br/>";
echo "<a href='userprofile'>update profile</a>";
echo "<a href='viewuser.php'>viewprofile</a>";
 echo "<a href='signout.php'>SignOut</a>";

?>