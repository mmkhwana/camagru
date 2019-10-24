<?php
session_start();
echo "Welcome ".$_SESSION['username']. "<br/>";
 echo "<a href='signout.php'>SignOut</a>";

?>